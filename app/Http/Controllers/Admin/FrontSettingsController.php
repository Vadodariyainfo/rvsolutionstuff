<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\MainController;
use Illuminate\Http\Request;
use App\Models\FrontSetting;
use App\Models\ImageUpload;

class FrontSettingsController extends MainController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(FrontSetting $frontsetting)
    {
        $frontSettings = FrontSetting::pluck('value','slug');
        return view('admin.settings.index',compact('frontSettings'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $input = $request->all();
        $input = $request->except(['_token','step']);

        if($request->hasFile('site-logo')){
            $input['site-logo'] = ImageUpload::logo('public/site-logos/',$request->file('site-logo'));
        }
        if($request->hasFile('site-favicon')){
            $input['site-favicon'] = ImageUpload::logo('public/site-logos/',$request->file('site-favicon'));
        }
        
        foreach ($input as $key => $value) {
            FrontSetting::where('slug', $key)->update(['value'=>$value]);
        }

        return back()
            ->with('success','Front Setting Updated Successfully')
            ->withInput();
    }
}
