@extends($dvsolution)

@section('title')
      <title>www.rvsolutionstuff.com -Tutorial It Language Site| See Example</title>
@endsection

@section('content')
<section id="main-home-banner" class="mb-50 mt-5 container-fluid">
    <h1>Coding and programming stuff</h1>
    <p>Welcome to the www.rvsolutionstuff.com programming website. We are providing</p>
    <div class="banner-buttons">
        <button type="button" onclick="location.href='{{ route('latest.post') }}'" class="btn">
            <i class="fas fa-chevron-right"></i>Best Articles</button>
    </div>
</section>
        
<section>
    {!! $frontSettings['ads-1'] !!}
</section>

<section id="page_body" class="responsive-home-mt-0">
    <div class="row mx-0">
         <section class="who-we-are mb-80 container-fluid">
            <h1 class="title mb-4">Who
                <span class="bold">we are</span>
            </h1>
            <div class="row">
                <div class="col-12 col-md-12 col-xl-8 col-sm-12 left">
                    <p class="mb-5">
                        <a href="{{ route('front.home') }}">RVSolutionStuff.com </a>is a team of developers and designers working towards learning programming and design easy for the world. We also provide Server related and linux articles. We work day after day to gather amazing tutorials of design and programming at one place so that you don’t have to waste your time googling! We are a community of thousands of developers helping each other learn and become a better version of themselves.</p>
                    <button type="button" onclick="location.href='{{ route('latest.post') }}'" class="btn bordered-btn">Our articles
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </div>
                <div class="col-12 col-md-12 col-xl-4 col-sm-12 right box-shadow d-flex">
                    <img alt="home-first-right" title="home-first-right" src="{{ asset('dvNew/home-first-right.png') }}">
                </div>
            </div>
        </section>
        
        <section>
            {!! $frontSettings['ads-2'] !!}
        </section>

        <section class="recent-articles mb-50">
            <div class="container-fluid pt-5 pb-5">
                <h3 class="title mb-5">Recent
                    <span class="bold">Articles</span>
                </h3>
                <div class="row">
                    @if(!empty($latestBlog) && $latestBlog->count())
                        @foreach($latestBlog as $key => $value)
                            <div class="col-12 col-md-6 col-xl-4 col-sm-6 recent-articles-inner mb-5">
                                <div class="main">
                                    <a href="{{ route('blog.detail',$value->slug) }}">
                                        <div class="image">
                                            <div class="overlay"></div>
                                            @if($value->image != null)
                                                <img class="lazyload" data-src="{!! !empty($value->image) ? route('image.asset.storage.file',['folder' => 'blog', 'file' => $value->image]) : asset('/blog/default/default.png') !!}" alt="{{ $value->title }}" data-sizes="auto">
                                            @else
                                                <div class="card" style="border:none;">
                                                    <div class="card-body m-4 bg-dark text-light" style="border-radius:10px;">
                                                        <h2 class="lazyload text-center" style="padding: 2.2rem !important;" alt="{{ $value->title }}" data-sizes="auto">{{ Str::limit(strip_tags($value->title), 45, '...') }}</h2>
                                                    </div>
                                                </div>                 
                                            @endif
                                        </div>
                                        <div class="content">
                                            <p class="desc">{{ Str::limit(strip_tags($value->title), 45, '...') }}</p>
                                        </div>
                                        <div class="read-more">
                                            <div class="link">Read More
                                                <i class="fas fa-arrow-right"></i>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </section>
        <section>
            {!! $frontSettings['ads-3'] !!}
        </section>
        <!-- category -->
        @if(!empty($latestCategory) && $latestCategory->count())
            <section class="browse-article mb-80 container-fluid">
                <h3 class="title mb-5">Browse
                    <span class="bold">Articles By Categories</span>
                </h3>
                <div class="row">
                    <ul class="inner-sec">
                        @foreach($latestCategory as $key => $value)
                            <li>
                                <a href="{{ route('blog.cat', $value->slug ) }}">
                                    <div class="browse-main">
                                        <img class="lazyload" alt="{{$value->image}}" data-src="{!! !empty($value->image) ? route('image.asset.storage.file',['folder' => 'category', 'file' => $value->image]) : asset('/blog/default/default.png') !!}" data-sizes="auto">
                                        <h5 class="browse-title">{{ $value->name }}</h5>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </section>
        @endif
        <section>
            {!! $frontSettings['ads-4'] !!}
        </section>  
        @include('dvsolution.newsletter')
        <section>
            {!! $frontSettings['ads-5'] !!}
        </section>
    </div>
</section>
@endsection