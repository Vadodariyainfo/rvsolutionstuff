<?php

use Illuminate\Support\Str;
use App\Models\BlogCategory;
use App\Models\BlogCategoryConnect;

function notificationMsg($type, $message)
{
	\Session::put($type, $message);
}

function getPostImagePath($path)
{		
	if(\File::exists(public_path($path))){
		Image::make(public_path($path))->resize(400,205)->save(public_path($path));
		return $path; 
	}else{
		return "/image/img_default.png";
	}
}

function blogrelatedpostcount($blogrel)
{	
	$countblog = 0;
	if(isset($blogrel->body)){
		$blogrelId = $blogrel->body;
	    $blogrelId = str_replace('[', "",$blogrelId);
	    $blogrelId = str_replace(']', "",$blogrelId);
	    $blogrelId = str_replace('"', "",$blogrelId);
	    $blogrelId = explode(",",$blogrelId);
	    $countblog = count($blogrelId);
	}

    return $countblog;
}

?>