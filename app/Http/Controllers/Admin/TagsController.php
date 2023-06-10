<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\MainController;
use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\PostMethod;
use App\Models\PostTag;
use Storage;

class TagsController extends MainController
{
    public function index()
    {
        $getpost = PostMethod::where('status','PUBLISHED')
                        ->pluck('title','id')
                        ->toArray();

        $tagList = Tag::pluck('tag','id')
                        ->toArray();

        return view('admin.tagUpdate.index',compact('getpost','tagList'));
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
        $postTag = PostMethod::find($input['post']);
         if($request->hasfile('image')){
            $imagename=$request->file('image');
            $imageName = $imagename->getClientOriginalName();
            $request->file('image')->move(Storage::path('public/images'),$imageName);
            $input['path'] = 'public/images/'.$imageName;
        }

        if($request->hasfile('uploadzip')){
            $zipFile = $request->file('uploadzip');
            $zipName = $postTag->slug.'.'.$zipFile->getClientOriginalExtension();
            $request->file('uploadzip')->move(public_path('public/download'),$zipName);
            $input['is_download'] = 1;
        }

        $input['is_demo'] =  !isset($input['is_demo']) ? 0 : 1;

        if (!empty($input['tag_id'])) {
            foreach ($input['tag_id'] as $key => $value) {
                PostTag::updateOrCreate(
                    ['tag_id' => $value],
                    ['post_id' => $input['post'], 'tag_id' => $value]
                );
            }
        }

        PostMethod::find($input['post'])->update($input);

        notificationMsg('success',$this->crudMessage('update','post'));

        return redirect()->route('update.post');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getAjaxPost(Request $request)
    {
        $post = PostMethod::find($request->post_id);

        $tags = $post->getTags;

        $tag_id = [];

        foreach ($tags as $key => $value) {
            if (!empty($value->tags)) {
                $tag_id[] = $value->tags->tag;
            }
        }

        $input['tagData'] = $tag_id;

        $input['postData'] = $post;

        return response()->json($input);
    }
}
