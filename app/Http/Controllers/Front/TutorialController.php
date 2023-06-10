<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Front\FrontController;
use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\Tutorial;

class TutorialController extends FrontController
{
    public function index()
    {
        view()->share('meta_title','Free Script Tutorials - laravel.com');
        view()->share('meta_description','Free Script Tutorials - laravel.com');
        view()->share('meta_keyword','Free Script Tutorials - laravel.com');

        //Get Language
        $languageData = Language::get();

        return view('front.tutorial.index',compact('languageData'));

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function tutorialDetails($languageSlug, $tutorialSlug)
    {
        //Get Tutorial
        $tutorialData = Tutorial::where('slug',$tutorialSlug)->first();
        //Get Language Related Tutorial
        $tutorialList = Language::where('slug',$languageSlug)->first()->tutorials;
        //Get Language
        $languageData = Language::get();

        view()->share('meta_title',$tutorialData->meta_title);
        view()->share('meta_description',$tutorialData->meta_description);
        view()->share('meta_keyword',$tutorialData->meta_description);
        
        return view('front.tutorial.details',compact('tutorialData','tutorialList','languageData'));

    }
}
