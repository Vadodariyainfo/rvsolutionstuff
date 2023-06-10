<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\MainController;
use Illuminate\Http\Request;
use App\Models\User; 
use App\Models\PostMethod;
use App\Models\Tutorial;
use App\Models\BlogCategory;
use App\Models\Blog;
use App\Models\ImageUpload;
use Carbon\Carbon;
use DB;

class DashBoardController extends MainController
{
    // super admin
    public function adminDashboard(Request $request)
    {
        $userCount  = User::count();
        $postCount  = PostMethod::count();
        $tutorialCount  = Tutorial::count();
        $blogCategoryCount  = BlogCategory::count();
        $blogCount  = Blog::count();
        $admin_blog  = Blog::where('user_id',\Auth::user()->id)->count();
        $blogView = Blog::sum('total_view');

        //Start Get Popular Post
        $searchBlogDays =  $request->searchBlogDay; 
        
        if (empty($request->searchBlogDay)) {
          $blogpopular =  Blog::where('is_publish',1)
                            ->whereDate('created_at','>',Carbon::now()->subDays(1))
                            ->orderBy('total_view', 'desc')   // Order by the 
                            ->take(10)                           // Take the first 5
                            ->get(); 

            $searchBlogDays = 1;
        }
        elseif ($request->searchBlogDay == "all")
        {
            $blogpopular =  Blog::orderBy('total_view', 'desc')   // Order by the 
                                ->take(10)                           // Take the first 5
                                ->get(); 
        }else{
            $blogpopular =  Blog::where('is_publish',1)
                                ->whereDate('created_at','>',Carbon::now()->subDays($request->searchBlogDay))
                                ->orderBy('total_view', 'desc')   // Order by the 
                                ->take(10)                           // Take the first 5
                                ->get(); 
        }    
         //End Get Popular Post

        //Start Get Current Year Post
        $i = 0;
        $currentMonth = date('m');
        $currentYear = date('Y');   

        $visitor = DB::table('blogs')
                    ->select(DB::raw("MONTH(created_at) as date"),DB::raw("COUNT(id) as total_posts"))
                    ->whereRaw('YEAR(created_at) = ?',$currentYear)
                    ->groupBy(DB::raw("MONTH(created_at)"))
                    ->get();

        if (!empty($request->currentYearChart)) {
            $visitor = DB::table('blogs')
                    ->select(
                        DB::raw("MONTH(created_at) as date"),
                        DB::raw("count(id) as total_posts"))
                    ->whereRaw('YEAR(created_at) = ?',$request->currentYearChart) 
                    ->groupBy(DB::raw("MONTH(created_at)"))
                    ->get();

        }
        $result[] = ['Date','Blog'];

        foreach ($visitor as $key => $value) {
            $myDate = $value->date;
            $date = Carbon::createFromFormat('m', $myDate);
            $monthName = $date->format('F');
            $result[++$key] = [$monthName, (int)$value->total_posts];
        }

        //End Get Current Year Post

        $monthlyView = DB::table('blogs')
            ->select(DB::raw("MONTH(created_at) as date"),DB::raw("sum(total_view) as views"))
            ->whereRaw('YEAR(created_at) = ?',$currentYear)
            ->groupBy(DB::raw("MONTH(created_at)"))
            ->get();

        if (!empty($request->currentYearChart)) {
            $monthlyView = DB::table('blogs')
                    ->select(
                        DB::raw("MONTH(created_at) as date"),
                        DB::raw("sum(total_view) as views"))
                    ->whereRaw('YEAR(created_at) = ?',$request->currentYearChart) 
                    ->groupBy(DB::raw("MONTH(created_at)"))
                    ->get();

        }
        $viewresult[] = ['Date','View'];

        foreach ($monthlyView as $key => $value) {
            $myDate = $value->date;
            $date = Carbon::createFromFormat('m', $myDate);
            $monthName = $date->format('F');
            $viewresult[++$key] = [$monthName, (int)$value->views];
        }

        //Start Get Blog Category 
        $blogcategorychart = BlogCategory::latest()->get();

        $result1[] = ['Name','Total'];

        foreach ($blogcategorychart as $key => $value) {
            $result1[++$key] = [$value->name, count($value->CategoryConnect)];
        }
        //End Get Current Year Post
        
        return view('admin.dashboard.index',compact('blogView','userCount','postCount','tutorialCount','blogCount','blogCategoryCount','blogpopular','i','searchBlogDays','admin_blog'))->with('visitor',json_encode($result))->with('monthlyView',json_encode($viewresult))->with('blogcategorychart',json_encode($result1));
    }

    // user admin
    public function userDashboard()
    {
        $blogCategoryCount  = BlogCategory::count();
        $blogCount = Blog::where('user_id',\Auth::user()->id)->count();

        return view('userauth.dashboard.index',compact('blogCategoryCount','blogCount'));
    }
}
