<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\MainController;
use Illuminate\Http\Request;
use App\Models\PostMethod;
use Yajra\Datatables\Datatables;
use App\Models\Tag;
use App\Models\PostTag;
use App\Models\ImageUpload;
use Storage;

class PostController extends MainController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = PostMethod::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action',function($row){
                        $btn = '';
                            $btn = '<a href="'.route('post.clear.cache',$row->slug).'" class="btn btn-warning btn-sm btn-flat mb-1" data-toggle="tooltip" data-placement="top" data-original-title="Tag" title="Clear Cache"><i class="fa fa-times"></i>Clear Cache</a>';
                            $btn = $btn.' <a href="'.route('post.tag.create',[$row->id]).'" class="btn btn-primary btn-sm btn-flat mb-1" data-toggle="tooltip" data-placement="top" data-original-title="Tag" title="Tag"><i class="fa fa-tag"></i></a>';
                            $btn = $btn.' <a href="'.route('post.detail',$row->slug).'" class="btn btn-info btn-sm btn-flat mb-1" data-toggle="tooltip" data-placement="top" data-original-title="Show" title="Show"><i class="fa fa-eye"></i></a>';
                            $btn = $btn.' <a href="'. route('posts.edit',[$row->id]) .'" class="btn btn-primary btn-sm btn-flat mb-1" data-toggle="tooltip" data-placement="top" data-original-title="Edit" title="Edit"><i class="fa fa-edit"></i></a>';
                            $btn = $btn.' <button class="btn btn-danger btn-sm btn-flat remove-crud mb-1" data-id="'. $row->id .'" data-action="'. route('posts.destroy',$row->id) .'"  data-toggle="tooltip" data-placement="top" data-original-title="Delete" title="Delete"> <i class="fa fa-trash"></i></button>';
                        return $btn;    
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('admin.posts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
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
            'title'=>'required',
            'seo_title'=>'required',
            'body'=>'required',
            'slug'=>'required',
            'meta_description'=>'required',
            'meta_keywords'=>'required',
        ]);

        $input['author_id'] = auth()->user()->id;
        $input['status'] = 'PUBLISHED';
        $input['excerpt'] = ' ';
        $input['total_view'] = 0;
        $input['is_download'] = 0;

        if($request->hasFile('image')){
            $input['image'] = ImageUpload::logo('public/images/',$request->file('image'));
        }

        $posts = PostMethod::create($input);

        notificationMsg('success',$this->crudMessage('add','Post'));

        return redirect()->route('posts.index');
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
    public function edit($id)
    {
        $posts = PostMethod::find($id);
        return view('admin.posts.edit',compact('posts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $request->validate([
            'title'=>'required',
            'seo_title'=>'required',
            'body'=>'required',
            'slug'=>'required',
            'meta_description'=>'required',
            'meta_keywords'=>'required',
        ]);
        
        $input['author_id'] = auth()->user()->id;
        $input['status'] = 'PUBLISHED';
        $input['excerpt'] = ' ';
        $input['total_view'] = 0;
        $input['is_download'] = 0;

        if($request->hasFile('image')){
            if(!empty($blog->image)){
                ImageUpload::removeFile('public/images/'.$blog->image);
            }
            $input['image'] = ImageUpload::logo('public/images/',$request->file('image'));
        }

        if($request->hasfile('uploadzip')){
            $zipFile = $request->file('uploadzip');
            $zipName = $input['slug'].'.'.$zipFile->getClientOriginalExtension();
            $request->file('uploadzip')->move(storage::path('public//download'),$zipName);
            $input['is_download'] = 1;
        }

        $input['is_demo'] =  !isset($input['is_demo']) ? 0 : 1;

        $posts = PostMethod::find($id);

        $posts->update($input);

        notificationMsg('success',$this->crudMessage('update','Post'));
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PostMethod::find($id)->delete();

        notificationMsg('success',$this->crudMessage('delete','Post'));
        return redirect()->route('posts.index');
    }

    public function createTag($id)
    {   
        $post = PostMethod::find($id);

        $tags = $post->getTags;

        $tag_id = [];
        
        foreach ($tags as $key => $value) {
            $tag_id[] = $value->tags->id;
        }

        $tagList = Tag::pluck('tag','id')->all();

        return view('admin.posts.tagEdit',compact('tagList','id','tag_id'));
    }

    public function addTag(Request $request)
    {
        $input = $request->all();

        $request->validate([
            'tag_id' => 'required'
        ]);

        $postTags = PostTag::where('post_id',$input['post_id'])->get();
        
        if(!empty($postTags) && $postTags->count()){
            $post = PostTag::where('post_id', $input['post_id'])->delete();
        }

        foreach ($input['tag_id'] as $key => $value) {
            PostTag::create(
                ['post_id' => $request->post_id, 'tag_id' => $value]);
        }
        notificationMsg('success',$this->crudMessage('add','tag'));

        return redirect()->route('posts.index');   
    }

    public function postClearCache($slug)
    {
        $postData = PostMethod::where("slug",$slug)->first();

        \Cache::forget('sn-'.$slug);

        \Cache::forget('getTagWithPostId-'.$postData->id);

        notificationMsg('success','cache clear successfully');

        return redirect()->back();
    }
}
