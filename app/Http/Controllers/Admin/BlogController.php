<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\MainController;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Arr;
use App\Models\BlogCategory;
use App\Models\BlogCategoryConnect;
use App\Models\Blog;
use App\Models\ImageUpload;
use App\Models\RelatedBlog;
use App\Models\Subscriber;
use Illuminate\Support\Str;
use Redirect;
use Auth;

class BlogController extends MainController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Blog::select('*')->latest();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('image',function($row){
                        if(!empty($row->image)){
                            return '<img src="'. route('image.asset.storage.file',['folder' => 'blog', 'file' => $row->image]) .'" width="100px">';
                        }else{
                            return '-';
                        }
                    })
                    ->addColumn('blog-category',function($row){
                        $category = '';
                        foreach ($row->blogCategoryConnect as $key => $value) {
                            $category .= ' <span class="badge badge-primary">'. $value->name.'</span>';
                        }
                        return $category;
                    })
                    // ->addColumn('publish',function($row){
                    //     $lable = $row->is_publish == 1 ? '<span class="badge badge-success">Yes</span>' : '<span class="badge badge-danger">No</span>';
                        
                    //     if ($row->is_featured == 1) {
                    //         $lable = $lable.'<br><span class="badge badge-warning"><i class="fas fa-fist-raised"></i> Featured</span>';
                    //     }

                    //     return $lable;
                    // })
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
                            $btn = $row->is_publish == 1 ? ' <a href="'. route('blog.detail',$row->slug) .'" class="btn btn-info btn-sm btn-flat" target="_blank" data-toggle="tooltip" data-placement="top" data-original-title="View" title="View"><i class="fa fa-eye"></i></a>' : ' <a href="#" class="btn btn-info btn-sm btn-flat disable" data-toggle="tooltip" data-placement="top" data-original-title="View" title="View"><i class="fa fa-eye"></i></a>';
                            $btn = $btn.' <a href="'. route('blogs.edit',[$row->id]) .'" class="btn btn-primary btn-sm btn-flat" data-toggle="tooltip" data-placement="top" data-original-title="Edit" title="Edit"><i class="fa fa-edit"></i></a>';
                            $btn = $btn.' <a href="'. route('admin.related.blogs',[$row->id]) .'" class="btn btn-primary btn-sm btn-flat" data-toggle="tooltip" data-placement="top" data-original-title="Related Blogs" title="Related Blogs"><i class="fa fa-link"></i>&nbsp<span class="badge badge-light">'.blogrelatedpostcount($row->relatedBlog).'</span></a>';
                            $btn = $btn.' <button class="btn btn-danger btn-sm btn-flat remove-crud" data-id="'. $row->id .'" data-action="'. route('blogs.destroy',$row->id) .'"  data-toggle="tooltip" data-placement="top" data-original-title="Delete" title="Delete"> <i class="fa fa-trash"></i></button>';
                        return $btn;    
                    })
                     ->editColumn('created_at', function ($row) {
                       return [
                          'display' => e($row->created_at->format('d/m/Y')),
                          'timestamp' => $row->created_at->timestamp
                       ];
                    })
                    ->addColumn('is_publish',function($row){
                        if($row->user_type == 0){
                            if($row->is_publish == 1){
                                $status = '<input type="checkbox" name="status" data-on="Published" data-off="Unpublished"  checked data-onstyle="success" class="change-status toggle" data-offstyle="danger" data-toggle="toggle" data-id="'.$row->id.'">';
                            }
                            else{
                                $status = '<input type="checkbox" name="status" data-on="Published" data-off="Unpublished" data-onstyle="success" class="change-status toggle" data-offstyle="danger" data-toggle="toggle" data-id="'.$row->id.'">';
                            }
                        }else{
                            $status = '-';
                        }
                        return $status;    
                    })  
                    ->filterColumn('created_at', function ($query, $keyword) {
                       $query->whereRaw("DATE_FORMAT(created_at,'%d/%m/%Y') LIKE ?", ["%$keyword%"]);
                    })
                    ->rawColumns(['action','image','created-date','blog-category','publish_date','total_view','is_publish'])
                    ->make(true);
        }

        return view('admin.blog.index');
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

        return view('admin.blog.create',compact('blogCategoryList'));
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
            'publish_date'=>'required_without:is_publish',
            'meta_description'=>'required',
        ],
        [
            'publish_date.required_without' => 'The publish date field is required when publish is no',
        ]);


        $input['slug'] = Str::slug( $input['title']);

        $input['total_view'] = 0;
        $input['user_id'] = Auth::user()->id;

        $input['is_publish'] = isset($input['is_publish']) ? '1' : '0';
        
        $input['is_featured'] = isset($input['is_featured']) ? '1' : '0';

        if (isset($input['publish_date']) && !empty($input['publish_date'])) {
            $input['publish_date'] = \Carbon\Carbon::createFromFormat('m/d/Y', $input['publish_date'])->format('Y-m-d');
        }else{
            unset($input['publish_date']);
        }
        
        if($request->hasFile('image')){
            $input['image'] = ImageUpload::logo('public/blog/',$request->file('image'));
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

        // $details = [
        //     'title' => 'Mail from dvsolution.tech',
        //     'body' => 'dvsolution.tech is a added new post '.$blog->title,
        // ];
        
        // $subscriber = Subscriber::pluck('email');
        // $mail = $subscriber;
        // foreach ($mail as $mails)
        // {
        //     \Mail::to($mails)->send(new \App\Mail\MyTestMail($details));
        // }

        notificationMsg('success',$this->crudMessage('add','Blog'));
        return redirect()->route('blogs.index');
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

        return view('admin.blog.edit',compact('blogCategoryList','blog','blogCategoryConnect'));
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
            'publish_date'=>'required_without:is_publish',
            'meta_description'=>'required',
        ],
        [
            'publish_date.required_without' => 'The publish date field is required when publish is no',
        ]);

        $input['is_publish'] = isset($input['is_publish']) ? '1' : '0';
        
        $input['is_featured'] = isset($input['is_featured']) ? '1' : '0';

       if($input['is_featured'] == 1){
           $blogs = Blog::all();

           foreach ($blogs as $key => $value) {
               $value->is_featured = 0;
               $value->save();
           }
        }
        
        if($request->hasFile('image')){
            if(!empty($blog->image)){
                ImageUpload::removeFile('public/blog/'.$blog->image);
            }
            $input['image'] = ImageUpload::logo('public/blog/',$request->file('image'));
        }

        if (isset($input['publish_date']) && !empty($input['publish_date']) && $input['is_publish'] == '0') {
            $input['publish_date'] = \Carbon\Carbon::createFromFormat('m/d/Y', $input['publish_date'])->format('Y-m-d');
        }else{
            $input['publish_date'] = NULL;
        }

        $blog->update($input);

        $blog->categories()->sync($input['blog_category_id']);

        notificationMsg('success',$this->crudMessage('update','blog'));

        return redirect()->route('blogs.index');
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

        return redirect()->route('blogs.index');
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

        return view('admin.blog.releatedBlogs',compact('blog','id','taglist'));
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
        
        return redirect()->route('blogs.index');
    }

    /**
     * Ajax status update user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function blogChangeStatus(Request $request,Blog $blog,$id)
    {
        $blog = Blog::find($id);
        $blog->update(['is_publish' => $request->status]);
        return response()->json(['success'=>'Post Published successfully.']); 
    }

    public function postPublish(Request $request)
    {
        \Artisan::call('post:publish');
        return Redirect::back();
    }
}
