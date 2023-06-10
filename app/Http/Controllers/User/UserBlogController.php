<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Admin\MainController;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Arr;
use App\Models\BlogCategory;
use App\Models\BlogCategoryConnect;
use App\Models\Blog;
use App\Models\ImageUpload;
use App\Models\RelatedBlog;
use Illuminate\Support\Str;
use Auth;

class UserBlogController extends MainController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Blog::select('*')->where('user_id',Auth::user()->id);
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('blog-category',function($row){
                        $category = '';
                        foreach ($row->blogCategoryConnect as $key => $value) {
                            $category .= ' <span class="badge badge-primary">'. $value->name.'</span>';
                        }
                        return $category;
                    })
                    ->addColumn('publish',function($row){
                        $lable = $row->is_publish == 1 ? '<span class="badge badge-success">Yes</span>' : '<span class="badge badge-danger">No</span>';
                        
                        if ($row->is_featured == 1) {
                            $lable = $lable.'<br><span class="badge badge-warning"><i class="fas fa-fist-raised"></i> Featured</span>';
                        }

                        return $lable;
                    })
                    ->addColumn('total_view',function($row){
                        $total_view = '<span class="badge badge-warning">'. $row->total_view.'</span>';
                        return $total_view;
                    })
                    ->addColumn('publish_date',function($row){
                        return !empty($row->publish_date) ? \Carbon\Carbon::createFromFormat('Y-m-d', $row->publish_date)->format('d/m/Y') : '-';
                    })
                    ->addColumn('created-date',function($row){
                        return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $row->created_at)->format('d/m/Y');
                    })
                    ->addColumn('action',function($row){
                        $btn = '';
                            $btn = $row->is_publish == 1 ? ' <a href="'. route('blog.detail',$row->slug) .'" class="btn btn-info btn-sm btn-flat" data-toggle="tooltip" data-placement="top" data-original-title="View" title="View"><i class="fa fa-eye"></i></a>' : ' <a href="#" class="btn btn-info btn-sm btn-flat disable" data-toggle="tooltip" data-placement="top" data-original-title="View" title="View"><i class="fa fa-eye"></i></a>';
                            $btn = $btn.' <a href="'. route('auth.blog.edit',[$row->id]) .'" class="btn btn-primary btn-sm btn-flat" data-toggle="tooltip" data-placement="top" data-original-title="Edit" title="Edit"><i class="fa fa-edit"></i></a>';
                            $btn = $btn.' <a href="'. route('auth.blog.related.blog',[$row->id]) .'" class="btn btn-primary btn-sm btn-flat" data-toggle="tooltip" data-placement="top" data-original-title="Related Blogs" title="Related Blogs"><i class="fa fa-file"></i> Related Blogs <span class="badge badge-light">'.blogrelatedpostcount($row->relatedBlog).'</span></a>';
                            $btn = $btn.' <button class="btn btn-danger btn-sm btn-flat remove-crud" data-id="'. $row->id .'" data-action="'. route('auth.blog.destroy',$row->id) .'"  data-toggle="tooltip" data-placement="top" data-original-title="Delete" title="Delete"> <i class="fa fa-trash"></i></button>';
                        return $btn;    
                    })
                     ->editColumn('created_at', function ($row) {
                       return [
                          'display' => e($row->created_at->format('d/m/Y')),
                          'timestamp' => $row->created_at->timestamp
                       ];
                    })  
                    ->filterColumn('created_at', function ($query, $keyword) {
                       $query->whereRaw("DATE_FORMAT(created_at,'%d/%m/%Y') LIKE ?", ["%$keyword%"]);
                    })
                    ->rawColumns(['action','created-date','blog-category','publish','publish_date','total_view'])
                    ->make(true);
        }

        return view('userauth.userBlog.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $blogCategoryList = BlogCategory::latest()
                                        ->pluck('name','id')
                                        ->toArray();

        return view('userauth.userBlog.create',compact('blogCategoryList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $request->validate([
            'title'=>'required|unique:blogs,title',
            'blog_category_id'=>'required',
            'body'=>'required',
            // 'publish_date'=>'required_without:is_publish',
            'meta_description'=>'required',
        ],
        [
            'publish_date.required_without' => 'The publish date field is required when publish is no',
            'title.unique' => 'The Post Title All Ready Here In RvSolutionStuff Site.',
        ]);


        $input['slug'] = Str::slug( $input['title']);

        $input['total_view'] = 0;
        $input['user_id'] = Auth::user()->id;

        $input['is_publish'] = 0;
        
        $input['is_featured'] = isset($input['is_featured']) ? '1' : '0';

        if (isset($input['publish_date']) && !empty($input['publish_date'])) {
            $input['publish_date'] = \Carbon\Carbon::createFromFormat('m/d/Y', $input['publish_date'])->format('Y-m-d');
        }else{
            unset($input['publish_date']);
        }
        
        if($request->hasFile('image')){
            $input['image'] = ImageUpload::logo('public/upload/blog/',$request->file('image'));
        }
        
        if($input['is_featured'] == 1){
           $blogs = Blog::all();

           foreach ($blogs as $key => $value) {
               $value->is_featured = 0;
               $value->save();
           }
        }
        $blog = Blog::create($input);

        $blog->categories()->attach($input['blog_category_id']);

        notificationMsg('success',$this->crudMessage('add','Blog'));
        return redirect()->route('auth.blog.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        $blogCategoryList = BlogCategory::latest()->pluck('name','id')
                                    ->toArray();

        $blogCategoryConnect = BlogCategoryConnect::where('blog_id',$blog->id)
                                    ->pluck('blog_category_id','blog_category_id')
                                    ->all();

        return view('userauth.userBlog.edit',compact('blogCategoryList','blog','blogCategoryConnect'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Blog $blog)
    {
        $input = $request->all();

        $request->validate([
            'title'=>'required|unique:blogs,title,'.$blog->id,
            'body'=>'required',
            'blog_category_id'=>'required',
            // 'publish_date'=>'required_without:is_publish',
            'meta_description'=>'required',
        ],
        [
            'publish_date.required_without' => 'The publish date field is required when publish is no',
            'title.unique' => 'The Post Title All Ready Here In RvSolutionStuff Site.'
        ]);

        $input['is_publish'] = 0;
        
        $input['is_featured'] = isset($input['is_featured']) ? '1' : '0';

       if($input['is_featured'] == 1){
           $blogs = Blog::all();

           foreach ($blogs as $key => $value) {
               $value->is_featured = 0;
               $value->save();
           }
        }

        if (isset($input['publish_date']) && !empty($input['publish_date']) && $input['is_publish'] == '0') {
            $input['publish_date'] = \Carbon\Carbon::createFromFormat('m/d/Y', $input['publish_date'])->format('Y-m-d');
        }else{
            $input['publish_date'] = NULL;
        }
        
        if($request->hasFile('image')){
            if(!empty($blog->image)){
                ImageUpload::removeFile('public/upload/blog/'.$blog->image);
            }
            $input['image'] = ImageUpload::logo('public/upload/blog/',$request->file('image'));
        }

        $blog->update($input);

        $blog->categories()->sync($input['blog_category_id']);

        notificationMsg('success',$this->crudMessage('update','blog'));

        return redirect()->route('auth.blog.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();

        notificationMsg('success',$this->crudMessage('delete','blog'));

        return redirect()->route('auth.blog.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function relatedBlogs($id)
    {
        $taglist = '';
        $blog = Blog::latest()
                     ->pluck('title','id')
                     ->toArray();

        $tags = RelatedBlog::where('blog_id',$id)
                    ->first();

        if (!empty($tags)) {
            $taglist = json_decode($tags->body);
        }

        return view('userauth.userBlog.releatedBlogs',compact('blog','id','taglist'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function relatedBlogStore(Request $request)
    {
        RelatedBlog::updateOrCreate(
                ['blog_id' => $request->blog_id],
                ['blog_id' => $request->blog_id, 'body' => json_encode($request->tags)]
            );

        notificationMsg('success',$this->crudMessage('update','Tags'));
        
        return redirect()->route('auth.blog.index');
    }
}

