<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use Exception;
use Storage;
use Response;

class StorageFileController extends Controller
{
    public function getImageAssetStorgeFile($folder,$filename)
    {
        $path =  '/public/'.$folder.'/'. $filename;

        if (!Storage::exists($path)) {
            abort(404);
        }

        $file = Storage::get($path);
        $type = Storage::mimeType($path);

        $response = Response::make($file, 200);

        if($type == 'image/svg'){
            $type = 'image/svg+xml';
        }
        $response->header("Content-Type", $type);

        return $response;
    }
}
