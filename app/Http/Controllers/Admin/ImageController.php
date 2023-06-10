<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\MainController;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\ImageUpload;
use Illuminate\Support\Str;
use Storage;

class ImageController extends MainController
{
    public function create()
    {
        if(\Auth::user()->is_admin == 1){
            return view('admin.image.create');
        }else{
            return view('userauth.image.create');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->hasfile('file')){

            $file = $request->file;

            $filename = $file->getClientOriginalName();
            
            $file->move(storage::path('/public/blog/'),$filename);
        }
    }
}
