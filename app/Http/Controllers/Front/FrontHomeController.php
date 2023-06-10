<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Front\FrontController;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Blog;
use App\Models\Tag;
use App\Models\BlogCategory;
use App\Models\BlogCategoryConnect;
use App\Models\FrontSetting;
use App\Models\RelatedBlog;
use App\Models\Subscriber;
use App\Models\PostMethod;
use App\Models\PostTag;
use App\Models\User;
use Illuminate\Support\Str;
use Artisan;
use Validator;
use App;
use URL;
use DB;
use SEOMeta;
use OpenGraph;
use Twitter;
use SEO;
use Redirect;
use Exception;

class FrontHomeController extends FrontController
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        parent::__construct();

        //Get Latest Category
        $latestCategory = BlogCategory::get();
        view()->share('latestCategory',$latestCategory);

        //Get Random Post Siderbar
        $randomPostSidebar = Blog::where('is_publish', '1')->inRandomOrder()->take(15)->get();
        view()->share('randomPostSidebar',$randomPostSidebar);

        //Get Random Post Footer
        $randomPostFooter = Blog::where('is_publish', '1')->inRandomOrder()->take(9)->get();
        view()->share('randomPostFooter',$randomPostFooter);

        //Get Latest Blog Limit
        $latestBlogLimit = Blog::where('is_publish', '1')->latest()->take(10)->get();
        view()->share('latestBlogLimit',$latestBlogLimit);

        //Get Latest Blog Limit
        $blogfeatured = Blog::where('is_publish', '1')->where('is_featured','1')->first();
        view()->share('blogfeatured',$blogfeatured);

        // popularPosts
        $popularPosts = Blog::where("total_view",">",500)->orderBy(\DB::raw('RAND()'))->take(10)->get();
        view()->share('popularPosts',$popularPosts);

        //front setting
        $frontSettings = \Cache::remember('frontSettings', 1000, function (){
            return FrontSetting::pluck('value','slug');
        });
        view()->share('frontSettings',$frontSettings);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page = '';
        if($request->has('page')){
            $page = ' - Page - '.$request->page;
        }

        SEOMeta::setDescription($this->frontSettingsData['site-description'].$page);
        SEOMeta::addMeta('keywords', $this->frontSettingsData['site-keyword']);

        OpenGraph::setDescription($this->frontSettingsData['site-description'].$page);
        OpenGraph::setUrl(URL::full());

        Twitter::setSite(URL::full());

        ## Ou

        SEO::setDescription($this->frontSettingsData['site-description'].$page);
        SEO::opengraph()->setUrl(URL::full());

        OpenGraph::addImage(['url' => URL::to($this->frontSettingsData['site-logo'])]);
        SEOMeta::addMeta('twitter:image', URL::to($this->frontSettingsData['site-logo']));

        // view()->share('meta_title','dvsolution.tech | IT | Web | Code Blog Tutorials');
        // view()->share('meta_description','dvsolution.tech Blog provides you latest Code Tutorials on PHP, Laravel, Codeigniter, JQuery, Node js, React js, Vue js, PHP, and Javascript. Mobile technologies like Android, React Native, Ionic etc.');
        // view()->share('meta_keyword','dvsolution tech provides you latest Code Tutorials on PHP, Laravel, Codeigniter, JQuery, Node js, React js, Vue js, PHP, and Javascript. Mobile technologies like Android, React Native, Ionic etc.');
        // view()->share('meta_image',asset('blog/v.png'));

        //Get Latest Blog
        $latestBlog = Blog::where('is_publish', '1')->latest()->limit(9)->paginate(9);
        // dd($popularPosts);
        return view('dvSolutionFront.home',compact('latestBlog'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function blogDetail($slug)
    {
        $userImage = User::where('email','divyangvadodariya9@gmail.com')->first();
        $blog = Blog::where('slug',$slug)->where('is_publish', '1')->first();

        if(is_null($blog)){
            return back();
        }

        SEOMeta::setTitle($blog->title.' - '.$this->frontSettingsData['site-title']);
        SEOMeta::setDescription($blog->meta_description);
        SEOMeta::addMeta('keywords', $blog->meta_description);

        OpenGraph::setDescription($blog->meta_description);
        OpenGraph::setTitle($blog->title.' - '.$this->frontSettingsData['site-title']);
        OpenGraph::setUrl(URL::full());

        SEOMeta::addMeta('twitter:card', $blog->meta_description);
        Twitter::setTitle($blog->title.' - '.$this->frontSettingsData['site-title']);
        Twitter::setSite('@RvSolutionStuff.com');

        ## Ou

        SEO::setTitle($blog->title.' - '.$this->frontSettingsData['site-title']);
        SEO::setDescription($blog->meta_description);
        SEO::opengraph()->setUrl(URL::full());

        if(!empty($blog->img)){
            OpenGraph::addImage(['url' => URL::to($blog->img)]);
            SEOMeta::addMeta('twitter:image', URL::to($blog->img));
        }else{
            OpenGraph::addImage(['url' => URL::to($this->frontSettingsData['site-logo'])]);
            SEOMeta::addMeta('twitter:image', URL::to($this->frontSettingsData['site-logo']));
        }

        //Blog View
        Blog::where('slug',$slug)->increment('total_view',1);

        //Get First Record Blog  
        // $blog = Blog::where('slug',$slug)->where('is_publish', '1')->first();

        // view()->share('meta_title',$blog->title.' - dvsolution.tech');
        // view()->share('meta_description',$blog->meta_description);
        // view()->share('meta_keyword',$blog->meta_description);

        // if (!empty($blog->image)) {
        //     view()->share('meta_image',asset($blog->image));
        // }else{
        //     view()->share('meta_image',asset('blog/v.png'));
        // }

        $recommendedBlogs = '';

        //Get Random Post
        $randomPosts = Blog::where('is_publish','1')->inRandomOrder()->take(10)->get();
        //Get Blog Category Id
        $blogCat = $blog->blogCategoryConnect->pluck('id')->all();
        //Get Related Blog
        $relatedBlogs = RelatedBlog::where('blog_id',$blog->id)->first();


        if (!empty($relatedBlogs)) {
            $recommendedBlogs = json_decode($relatedBlogs->body);
        }
        //Get All Blog
        $allBlogs = Blog::all();

        $relatedBlog = '';
        
        if(!empty($relatedBlogs->body)){
            $relatedBlogsId = $relatedBlogs->body;
            $relatedBlogsId = str_replace('[', "",$relatedBlogsId);
            $relatedBlogsId = str_replace(']', "",$relatedBlogsId);
            $relatedBlogsId = str_replace('"', "",$relatedBlogsId);
            $relatedBlogsId = explode(",",$relatedBlogsId);

            $relatedBlog = Blog::whereIn('id', $relatedBlogsId)->get();
        }
         // get previous Blog id
        $previousBlog = Blog::where('id', '<', $blog->id)->orderBy('id','desc')->first();
        // get next blog id
        $nextBlog = Blog::where('id', '>', $blog->id)->orderBy('id','asc')->first();

        return view('dvSolutionFront.postDetail',compact('blog', 'randomPosts','recommendedBlogs','allBlogs','nextBlog','previousBlog','relatedBlog','userImage'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function blogCat(Request $request ,$slug)
    {
        $blogsCat = BlogCategory::where('slug',$slug)->first();
        if(is_null($blogsCat)){
            return back();
        }
        $page = $page2 = '';
        if($request->has('page')){
            $page = ' - Page '.$request->page;
            $page2 = 'Page '.$request->page.' ';
        }

        $Lnew = "Latest Post Of ";

        $pageTitle = $blogsCat->name. " Category" . $page. " - RvSolutionStuff.com";
        $pageDescription = $page2 . "we provides list of ".$Lnew.$blogsCat->meta_description." category tutorials posts, ".$blogsCat->meta_description." popular articles, ".$blogsCat->meta_description." collections of examples, ".$blogsCat->meta_description." category best practices script. we have lists of tutorials and examples about category ".$blogsCat->meta_description;

        SEOMeta::setTitle($pageTitle);
        SEOMeta::setDescription($pageDescription);
        SEOMeta::addMeta('keywords', $blogsCat->meta_keyword);

        OpenGraph::setDescription($pageDescription);
        OpenGraph::setTitle($pageTitle);
        OpenGraph::setUrl(URL::full());

        Twitter::setTitle($pageTitle);
        Twitter::setSite(URL::full());

        ## Ou

        SEO::setTitle($pageTitle);
        SEO::setDescription($pageDescription);
        SEO::opengraph()->setUrl(URL::full());

        OpenGraph::addImage(['url' => URL::to($this->frontSettingsData['site-logo'])]);
        SEOMeta::addMeta('twitter:image', URL::to($this->frontSettingsData['site-logo']));

        //Get Blog Category
        // $blogsCat = BlogCategory::where('slug',$slug)->first();

        // view()->share('meta_title',Str::slug($blogsCat->name ?? 'dvsolution').'- DvSolution.com');
        // view()->share('meta_description',$blogsCat->meta_description ?? 'dvsolution');
        // view()->share('meta_keyword',$blogsCat->meta_description ?? 'dvsolution');
        // view()->share('meta_image',asset('blog/v.png'));

        if (is_null($blogsCat)) {
            $blogsCatDetail = '';
            $blogsCatName = ucfirst(str_replace('-',' ',$slug));
        }else{
        //Get Blog Detail
            $blogsCatDetail = $blogsCat->categoryConnect()->where('is_publish', '1')->orderBy('id' ,'DESC')->paginate(10);
            $blogsCatName = ucfirst($blogsCat->name);
        }

        return view('dvSolutionFront.blogsCat',compact('blogsCatName','blogsCatDetail'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function categories()
    {
        $keywords = 'php,laravel,bootstrap,package,composer,jquery,js';
        $title = 'Categories - RvSolutionStuff.com';
        $description = 'we are provide examples and demos of php,laravel,bootstrap,js,jquery,javacript,html,css,facebook api,twitter api, jquery plugin etc';

        SEOMeta::setTitle($title);
        SEOMeta::setDescription($description);
        SEOMeta::addMeta('keywords', $keywords);

        OpenGraph::setDescription($description);
        OpenGraph::setTitle($title);
        OpenGraph::setUrl(URL::full());

        Twitter::setTitle($title);
        Twitter::setSite(URL::full());

        ## Ou

        SEO::setTitle($title);
        SEO::setDescription($description);
        SEO::opengraph()->setUrl(URL::full());

        OpenGraph::addImage(['url' => URL::to($this->frontSettingsData['site-logo'])]);
        SEOMeta::addMeta('twitter:image', URL::to($this->frontSettingsData['site-logo']));

        // view()->share('meta_title','Blog Category - DvSolution.com');
        // view()->share('meta_description','Blog Category');
        // view()->share('meta_keyword','Blog Category');
        // view()->share('meta_image',asset('blog/v.png'));
        
        //Get Category 
        $categories = BlogCategory::withCount('categoryConnect')->latest('category_connect_count')->get();

        return view('dvSolutionFront.categories',compact('categories'));
    }

   /**
     * Write code on Method
     *
     * @return response()
     */
    public function latestPost(Request $request)
    {
        $page = '';
        if($request->has('page')){
            $page = ' - Page - '.$request->page;
        }

        $pageTitle = 'Latest Post - RvSolutionStuff.com'.$page;
        $pageDescription = 'dvsolution privode several latest and new posts of php framework, packages, jquery plugin, bootstrap, elasticsearch, laravel packages etc '. $page;
        $pageKeywords = 'latest,post,posts,new,nice,good,blog,examples,codes,demos';

        SEOMeta::setTitle($pageTitle);
        SEOMeta::setDescription($pageDescription);
        SEOMeta::addMeta('keywords', $pageKeywords);

        OpenGraph::setDescription($pageDescription);
        OpenGraph::setTitle($pageTitle);
        OpenGraph::setUrl(URL::full());

        Twitter::setTitle($pageTitle);
        Twitter::setSite(URL::full());

        ## Ou

        SEO::setTitle($pageTitle);
        SEO::setDescription($pageDescription);
        SEO::opengraph()->setUrl(URL::full());

        OpenGraph::addImage(['url' => URL::to($this->frontSettingsData['site-logo'])]);
        SEOMeta::addMeta('twitter:image', URL::to($this->frontSettingsData['site-logo']));

        // view()->share('meta_title','Blog Disclaimer - DvSolution.com');
        // view()->share('meta_description','Blog');
        // view()->share('meta_keyword','Blog');
        // view()->share('meta_image',asset('blog/v.png'));

        //Get Latest Blog
        $latestBlog = Blog::where('is_publish', '1')->latest()->paginate(10);

        return view('dvSolutionFront.latestpost',compact('latestBlog'));
    }

    /**
    * Write code on Method
    *
    * @return response()
    */
    public function disclaimer(Request $request)
    {
        $page = '';
        if($request->has('page')){
            $page = ' - Page - '.$request->page;
        }

        $pageTitle = 'Disclaimer - RvSolutionStuff.com'.$page;
        $pageDescription = 'Blog privode several latest and new posts of php framework, packages, jquery plugin, bootstrap, elasticsearch, laravel packages etc '. $page;
        $pageKeywords = 'latest,post,posts,new,nice,good,blog,examples,codes,demos';

        SEOMeta::setTitle($pageTitle);
        SEOMeta::setDescription($pageDescription);
        SEOMeta::addMeta('keywords', $pageKeywords);

        OpenGraph::setDescription($pageDescription);
        OpenGraph::setTitle($pageTitle);
        OpenGraph::setUrl(URL::full());

        Twitter::setTitle($pageTitle);
        Twitter::setSite(URL::full());

        ## Ou

        SEO::setTitle($pageTitle);
        SEO::setDescription($pageDescription);
        SEO::opengraph()->setUrl(URL::full());

        OpenGraph::addImage(['url' => URL::to($this->frontSettingsData['site-logo'])]);
        SEOMeta::addMeta('twitter:image', URL::to($this->frontSettingsData['site-logo']));

        // view()->share('meta_title','Blog Disclaimer - DvSolution.com');
        // view()->share('meta_description','Blog');
        // view()->share('meta_keyword','Blog');
        // view()->share('meta_image',asset('blog/v.png'));

        return view('dvSolutionFront.disclaimer');
    }

    /**
    * Write code on Method
    *
    * @return response()
    */
    public function privacypolicy(Request $request)
    {
        $page = '';
        if($request->has('page')){
            $page = ' - Page - '.$request->page;
        }

        $pageTitle = 'Privacy Policy - RvSolutionStuff.com'.$page;
        $pageDescription = 'Blog privode several latest and new posts of php framework, packages, jquery plugin, bootstrap, elasticsearch, laravel packages etc '. $page;
        $pageKeywords = 'latest,post,posts,new,nice,good,blog,examples,codes,demos';

        SEOMeta::setTitle($pageTitle);
        SEOMeta::setDescription($pageDescription);
        SEOMeta::addMeta('keywords', $pageKeywords);

        OpenGraph::setDescription($pageDescription);
        OpenGraph::setTitle($pageTitle);
        OpenGraph::setUrl(URL::full());

        Twitter::setTitle($pageTitle);
        Twitter::setSite(URL::full());

        ## Ou

        SEO::setTitle($pageTitle);
        SEO::setDescription($pageDescription);
        SEO::opengraph()->setUrl(URL::full());

        OpenGraph::addImage(['url' => URL::to($this->frontSettingsData['site-logo'])]);
        SEOMeta::addMeta('twitter:image', URL::to($this->frontSettingsData['site-logo']));

        // view()->share('meta_title','Privacy Policy - DvSolution.com');
        // view()->share('meta_description','Blog');
        // view()->share('meta_keyword','Blog');
        // view()->share('meta_image',asset('blog/v.png'));

        return view('dvSolutionFront.privacypolicy');
    }

    /**
    * Write code on Method
    *
    * @return response()
    */
    public function aboutus(Request $request)
    {
        $page = '';
        if($request->has('page')){
            $page = ' - Page - '.$request->page;
        }

        $pageTitle = 'About Us - RvSolutionStuff.com'.$page;
        $pageDescription = 'Blog privode several latest and new posts of php framework, packages, jquery plugin, bootstrap, elasticsearch, laravel packages etc '. $page;
        $pageKeywords = 'latest,post,posts,new,nice,good,blog,examples,codes,demos';

        SEOMeta::setTitle($pageTitle);
        SEOMeta::setDescription($pageDescription);
        SEOMeta::addMeta('keywords', $pageKeywords);

        OpenGraph::setDescription($pageDescription);
        OpenGraph::setTitle($pageTitle);
        OpenGraph::setUrl(URL::full());

        Twitter::setTitle($pageTitle);
        Twitter::setSite(URL::full());

        ## Ou

        SEO::setTitle($pageTitle);
        SEO::setDescription($pageDescription);
        SEO::opengraph()->setUrl(URL::full());

        OpenGraph::addImage(['url' => URL::to($this->frontSettingsData['site-logo'])]);
        SEOMeta::addMeta('twitter:image', URL::to($this->frontSettingsData['site-logo']));

        // view()->share('meta_title','About Us - DvSolution.com');
        // view()->share('meta_description','Blog');
        // view()->share('meta_keyword','Blog');
        // view()->share('meta_image',asset('blog/v.png'));

        return view('dvSolutionFront.aboutUs');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function snipestPostIndex(Request $request)
    {
        $page = '';
        if($request->has('page')){
            $page = ' - Page - '.$request->page;
        }

        $pageTitle = 'Snippet - RvSolutionStuff.com'.$page;
        $pageDescription = 'we provides good layouts design of snippets like profile, grid, pagination, chat, forms, buttons, model, slider, search, social, badges, controls, footer, select, calender, timeline etc. You can simple take html, css and js code and get layout of available snippets. We provide bootstrap design widget and we also provide without bootstrap snippets '. $page;
        $pageKeywords = 'we provides good layouts design of snippets like profile, grid, pagination, chat, forms, buttons, model, slider, search, social, badges, controls, footer, select, calender, timeline etc. You can simple take html, css and js code and get layout of available snippets. We provide bootstrap design widget and we also provide without bootstrap snippets '. $page;

        SEOMeta::setTitle($pageTitle);
        SEOMeta::setDescription($pageDescription);
        SEOMeta::addMeta('keywords', $pageKeywords);

        OpenGraph::setDescription($pageDescription);
        OpenGraph::setTitle($pageTitle);
        OpenGraph::setUrl(URL::full());

        Twitter::setTitle($pageTitle);
        Twitter::setSite(URL::full());

        ## Ou

        SEO::setTitle($pageTitle);
        SEO::setDescription($pageDescription);
        SEO::opengraph()->setUrl(URL::full());

        OpenGraph::addImage(['url' => URL::to($this->frontSettingsData['site-logo'])]);
        SEOMeta::addMeta('twitter:image', URL::to($this->frontSettingsData['site-logo']));


        // view()->share('meta_title',$page.'Dvsolution.tech Free code of snippet for HTML, Bootstrap');
        // view()->share('meta_description',$page.'we provides good layouts design of snippets like profile, grid, pagination, chat, forms, buttons, model, slider, search, social, badges, controls, footer, select, calender, timeline etc. You can simple take html, css and js code and get layout of available snippets. We provide bootstrap design widget and we also provide without bootstrap snippets.');
        // view()->share('meta_keyword',$page.'we provides good layouts design of snippets like profile, grid, pagination, chat, forms, buttons, model, slider, search, social, badges, controls, footer, select, calender, timeline etc. You can simple take html, css and js code and get layout of available snippets. We provide bootstrap design widget and we also provide without bootstrap snippets.');

        $posts = PostMethod::latest()->paginate(8);

        return view('dvSolutionFront.snippet.home',compact('posts'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function snipestPostDetail($slug)
    {
        //Get Post
        $post = PostMethod::where('slug',$slug)->where('status','PUBLISHED')->first();

        if(is_null($post)){
            return back();
        }

        SEOMeta::setTitle($post->seo_title.' - '.$this->frontSettingsData['site-title']);
        SEOMeta::setDescription($post->meta_description);
        SEOMeta::addMeta('keywords', $post->meta_keywords);

        OpenGraph::setDescription($post->meta_description);
        OpenGraph::setTitle($post->seo_title.' - '.$this->frontSettingsData['site-title']);
        OpenGraph::setUrl(URL::full());

        SEOMeta::addMeta('twitter:card', $post->meta_description);
        Twitter::setTitle($post->seo_title.' - '.$this->frontSettingsData['site-title']);
        Twitter::setSite('@RvSolutionStuff.com');

        ## Ou

        SEO::setTitle($post->seo_title.' - '.$this->frontSettingsData['site-title']);
        SEO::setDescription($post->meta_description);
        SEO::opengraph()->setUrl(URL::full());

        if(!empty($post->image)){
            OpenGraph::addImage(['url' => URL::to($post->image)]);
            SEOMeta::addMeta('twitter:image', URL::to($post->image));
        }else{
            OpenGraph::addImage(['url' => URL::to($this->frontSettingsData['site-logo'])]);
            SEOMeta::addMeta('twitter:image', URL::to($this->frontSettingsData['site-logo']));
        }

        // if(is_null($post)){
        //     return redirect()->route('snippet');
        // }

        //Total View
        PostMethod::where('slug',$slug)->increment('total_view',1);

        //Get Latest Post
        // $latestpost = PostMethod::where('status','PUBLISHED')->latest()->get()->take(5);

        //Get Random Post
        $relatedBlog = PostMethod::where('status','PUBLISHED')->inRandomOrder()->take(10)->get();

        //Get Random Blog
        // $randomblogs = Blog::where('is_publish','1')->inRandomOrder()->take(5)->get();
        // $randomblogpost = Blog::where('is_publish','1')->inRandomOrder()->take(4)->get();

        // view()->share('meta_title',$post->title);
        // view()->share('meta_description',$post->meta_description);
        // view()->share('meta_keyword',$post->meta_keywords);
        // view()->share('meta_image',url('/').$post->path);

        //Get Tag
        $tagPostList = Tag::take(15)->get();

        //Get Post Related Tag
        $postTags = PostMethod::find($post->id);

        return view('dvSolutionFront.snippet.snippestPostDetail',compact('post','tagPostList','postTags','relatedBlog'));
    }

    /**
    * Write code on Method
    *
    * @return response()
    */
    public function contactus(Request $request)
    {
        $page = '';
        if($request->has('page')){
            $page = ' - Page - '.$request->page;
        }

        $pageTitle = 'Contact Us - RvSolutionStuff.com'.$page;
        $pageDescription = 'Blog privode several latest and new posts of php framework, packages, jquery plugin, bootstrap, elasticsearch, laravel packages etc '. $page;
        $pageKeywords = 'latest,post,posts,new,nice,good,blog,examples,codes,demos';

        SEOMeta::setTitle($pageTitle);
        SEOMeta::setDescription($pageDescription);
        SEOMeta::addMeta('keywords', $pageKeywords);

        OpenGraph::setDescription($pageDescription);
        OpenGraph::setTitle($pageTitle);
        OpenGraph::setUrl(URL::full());

        Twitter::setTitle($pageTitle);
        Twitter::setSite(URL::full());

        ## Ou

        SEO::setTitle($pageTitle);
        SEO::setDescription($pageDescription);
        SEO::opengraph()->setUrl(URL::full());

        OpenGraph::addImage(['url' => URL::to($this->frontSettingsData['site-logo'])]);
        SEOMeta::addMeta('twitter:image', URL::to($this->frontSettingsData['site-logo']));

        // view()->share('meta_title','Ccontact Us - DvSolution.com');
        // view()->share('meta_description','Blog');
        // view()->share('meta_keyword','Blog');
        // view()->share('meta_image',asset('blog/v.png'));

        return view('dvSolutionFront.contactus');
    }

    /**
    * Write code on Method
    *
    * @return response()
    */
    public function contactusStore(Request $request)
    {
        $input = $request->all();

        $errors = Validator::make($input, [
            'name' => 'required',
            'email' => 'required|unique',
            'message' => 'required',
        ]);

        if(empty($errors->errors()->all())){
            $contacts = Contact::create($input);
            // return response()->json(['success'=>'contact created Successfully','true'=>1]);
            return back()->with('success','Message Send Successfully');
        }
 
        return response()->json(['errors'=>$errors->errors()->all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function subscriberStore(Request $request)
    {
        $input = $request->all();
        $request->validate([
            'email'=>'required|email|unique:subscribers',
        ]); 
        
        Subscriber::create($input);
        return redirect()->back()->with('success','Dvsolution Subscribe Successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function siteMap()
    {
        // create new sitemap object
        $sitemap = App::make("sitemap");

        // add item to the sitemap (url, date, priority, freq)
        $sitemap->add(URL::to('/'), '2021-07-11 09:51:00+02:00', '1.0', 'daily');
        $sitemap->add(URL::to('disclaimer'), '2021-07-11 09:51:00+02:00', '1.0', 'daily');
        $sitemap->add(URL::to('contact-us'), '2021-07-11 09:51:00+02:00', '1.0', 'daily');
        $sitemap->add(URL::to('about-us'), '2021-07-11 09:51:00+02:00', '1.0', 'daily');
        $sitemap->add(URL::to('popular-post'), '2021-07-11 09:51:00+02:00', '1.0', 'daily');
        // $sitemap->add(URL::to('featured-post'), '2021-07-11 09:51:00+02:00', '1.0', 'daily');
        $sitemap->add(URL::to('categories'), '2021-07-11 09:51:00+02:00', '1.0', 'daily');
        $sitemap->add(URL::to('latestpost'), '2021-07-11 09:51:00+02:00', '1.0', 'daily');

        // add every category to the sitemap

        $categories = BlogCategory::latest()->get();
        foreach ($categories as $post)
        {
            $sitemap->add(URL::route('blog.cat',$post->slug), $post->updated_at, '1.0', 'daily');
        }

        // add every post to the sitemap
        $posts = Blog::where('is_publish','1')->orderBy('created_at', 'desc')->get();
        foreach ($posts as $post)
        {
            $img = URL::to('/').'/blog/defult/default.png';
            if(!empty($post->img)){
                $img = URL::to('/').$post->img;
            }
            $images = [
                        ['url' => $img, 'title' => $post->title, 'caption' => $post->title],
                    ];
            $sitemap->add(URL::route('blog.detail',$post->slug), $post->created_at, '1.0', 'daily',$images);
        }
        
        // $tags = Tag::latest()->get();
        // foreach ($tags as $post)
        // {
        //     $sitemap->add(URL::route('blog.cat',$post->slug), $post->updated_at, '1.0', 'daily');
        // }

        return $sitemap->render('xml');
    }

    public function tagPages($slug)
    {   
        $page = '';
        if (request()->has('page')) {
            $page = "Page ".request()->get('page')." - ";
        }

        //Get Tag
        $tagname = Tag::where('slug',$slug)->first();

        if(is_null($tagname)){
            return redirect()->route('snippet');
        }

        view()->share('meta_title',$page.ucfirst($tagname->tag).' - RvSolutionStuff.com');
        view()->share('meta_description',$page.'we provides good layouts design of '.$tagname->tag.' snippets like profile, grid, pagination, chat, forms, buttons, model, slider, search, social, badges, controls, footer, select, calender, timeline etc. You can simple take html, css and js code and get layout of available snippets of '.$tagname->tag.'. We provide bootstrap design widget and we also provide without bootstrap snippets of '.$tagname->tag.'.');
        view()->share('meta_keyword',$page.'we provides good layouts design of '.$tagname->tag.' snippets like profile, grid, pagination, chat, forms, buttons, model, slider, search, social, badges, controls, footer, select, calender, timeline etc. You can simple take html, css and js code and get layout of available snippets of '.$tagname->tag.'. We provide bootstrap design widget and we also provide without bootstrap snippets of '.$tagname->tag.'.');

        if($slug == "bootstrap-4"){
            view()->share('meta_image','http://RvSolutionStuff.com/image/tag-bootstrap-4.png');
        }

        //Tag Related Post
       $posts = Tag::where('slug',$slug)
                    ->first()
                    ->post()
                    ->paginate(6);

       return view('front.tagdetail',compact('posts','tagname'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function taglist()
    {
        view()->share('meta_title','RvSolutionStuff.com Free code of snippet for html');
        view()->share('meta_description','we provides good layouts design of snippets like profile, grid, pagination, chat, forms, buttons, model, slider, search, social, badges, controls, footer, select, calender, timeline etc. You can simple take html, css and js code and get layout of available snippets. We provide bootstrap design widget and we also provide without bootstrap snippets.');
        view()->share('meta_keyword','we provides good layouts design of snippets like profile, grid, pagination, chat, forms, buttons, model, slider, search, social, badges, controls, footer, select, calender, timeline etc. You can simple take html, css and js code and get layout of available snippets. We provide bootstrap design widget and we also provide without bootstrap snippets.'); 

        //Get Tag
        $taglist = Tag::get();

        return view('front.tag',compact('taglist'));
    }
}
