<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\MainController;
use Illuminate\Http\Request;
use Storage;
use File;
use Redirect;
use App\Models\Blog;

class BackupController extends MainController
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function backup(Request $request)
    {
        // Get backup files 
        $databasefiles = Storage::allfiles('/public/db-backup/');
        rsort($databasefiles);
        unset($databasefiles[array_search('public/db-backup/.gitignore',$databasefiles)]);

        $mediafiles = Storage::allfiles('/public/mediaBackup/');
        rsort($mediafiles);
        unset($mediafiles[array_search('public/mediaBackup/.gitignore',$mediafiles)]);
        return view('admin.backup.index',compact('databasefiles','mediafiles'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        \Artisan::call('databaseBackup:cron');
        return Redirect::back();
  
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeMedia(Request $request)
    {
        \Artisan::call('mediaBackup:cron');


        return Redirect::back();
  
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function mediaDownload(Request $request)
    {
        $file = Storage::path('/public/mediaBackup/'.$request->file);
        return response()->download($file);
  
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function download(Request $request)
    {
        $file = Storage::path('/public/db-backup/'.$request->file);
        return response()->download($file);
    }
}
