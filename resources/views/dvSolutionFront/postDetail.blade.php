@extends($dvsolution)

@section('style')
  <link href="{{ asset('dvNew/style/article_detail.css') }}" rel="stylesheet">
  <style type="text/css">
    pre {
        font-size: 1.125em;
        background-color: #eeeeee;
        padding: 0.750em;
        border-radius: 5px;
    }
    code {
        color: #000000;
    }
    .blog-article{
      width: 100%;
    }
    .post-description p strong.step{
      margin-bottom: 13px;
    }
    .step::before { content: ' '; display: block; }
    .follow-me {
        background-color: #f2efef;
        border-radius: 10px;
        padding: 25px;
    }

    .follow-me .avtar img {
        border: 7px solid #000;
        border-radius: 100%;
        height: 200px;
        width: 170px;
    }
    .post-description p {
        font-size: 15px !important;
        margin-top: 13px !important; 
    }

    .prettyprint p{
        font-size: 12px !important;
        margin-top: 0px !important; 
    }
    pre {
        font-size: 10px !important;
        padding-left: 15px !important; 
        padding-top: 9px !important; 
    }
  </style>
  <link rel="stylesheet" href="{{ asset('dvNew/style/enlighterjs.min.css') }}">
@endsection
@section('content')
        <section id="page_body" class="container-fluid mt-5 pt-4">
            <div class="row mx-0">
                <div class="col-12 col-md-12 col-xl-8 col-sm-12">
                    <section class="article-details-main mb-5 mt-5">
                        <div class="row mx-0">
                            <h1 class="mb-3 p-0">
                                <a href="{{ route('blog.detail',$blog->slug ) }}" title="Laravel send mail with file attachment example">{{ $blog->title }}</a>
                            </h1>

                            <section>
                                {!! $frontSettings['ads-1'] !!}
                            </section>

                            <div class="post-info mb-3">
                                <span class="time">
                                    <i class="fas fa-calendar-alt"></i> {{ $blog->created_at->format('M d, Y') }}</span>
                                <span class="eye">
                                    <i class="fas fa-user"></i> By Admin</span>
                                Category: 
                                    @foreach($blog->blogCategoryConnect as $blogValue)
                                        <span class="category">
                                            <a href="{{ route('blog.cat',$blogValue->slug) }}">{{ $blogValue->name }}</a>
                                        </span>&nbsp;
                                    @endforeach
                            </div>
                            
                            <img class="post-image blog-article" src="{!! !empty($blog->image) ? route('image.asset.storage.file',['folder' => 'blog', 'file' => $blog->image]) : '' !!}" alt="{{ $blog->image }}" />
                            
                            <section>
                                {!! $frontSettings['ads-2'] !!}
                            </section>

                            <div class="col-12">
                            </div>
                            <section class="post-description mb-3">
                              <div class="discription">
<!--                                 @php
                                    $des = str_replace("\n", "</p><p> ", "<p>".$blog->body."</p>");

                                @endphp

                                {!! $des !!} -->
                                {!! $blog->body !!}
                              </div>
                            </section>
                            <div class="row">
                                <div class="col-md-12 col-xs-12 tags-postdetail-page">
                                    @if(!empty($postTags))
                                    <strong><i class="fa fa-tags" aria-hidden="true"></i> Tags:-</strong>
                                        @foreach($postTags->getTags as $key=>$value)
                                            @if(!empty($value->tags->tag))
                                                <a href="" class="tag">
                                                    <span class="txt">{{ $value->tags->tag }}</span><span class="num">{{ $value->tags->post->count() }}</span>
                                                </a>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="seperator">
                        </div>
                        
                        <section class="follow-me my-4">
                        <div class="row mx-0">
                          <div class="col-12 col-md-9 col-sm-9 col-xl-9">
                            <div class="self-description">
                              <h3>Divyang Vadodariya</h3>
                              <p>My name is Divyang Vadodariya. I'm a full-stack developer, entrepreneur and owner of RvSolutionStuff. I
                                live in India and I love to
                                write tutorials and tips that can help to other artisan. I am a big fan of PHP, Javascript, JQuery,
                                Laravel, Codeigniter, VueJS,
                                AngularJS and Bootstrap ,etc from the early stage.</p>
                              <label class="follow-me-links">Follow Me: 
                                <a href="{{ $frontSettings['twitter-link'] }}"><i class="fab fa-twitter ml-3 mr-2"></i></a>
                                <a href="https://github.com/divuvadodariya"><i class="fab fa-github"></i></a></label>
                            </div>
                          </div>
                          <div class="col-12 col-md-3 col-sm-3 col-xl-3 d-flex justify-content-center">
                            <div class="avtar">
                              <img src="{!! !empty($userImage->profile) ? route('image.asset.storage.file',['folder' => 'userImage', 'file' => $userImage->profile]) : asset('adminTheme/dist/img/AdminLTELogo.png') !!}">
                            </div>
                          </div>
                        </div>
                        </section>
                        
                        <div class="seperator">
                        </div>

                        <section>
                            {!! $frontSettings['ads-3'] !!}
                        </section>
                        
                          <section class="recommending-you">
                            <div class="list-boxes mb-50 box-shadow">
                              @if(!empty($relatedBlog))
                                <h4 class="title">We are Recommending you</h4>
                                <ul>
                                  @foreach($relatedBlog as $key => $value)
                                    <li><a href="{{ route('blog.detail',$value->slug) }}">{{ $value->title }}</a></li>
                                  @endforeach
                                </ul>
                              @endif
                            </div>
                          </section>
                    </section>
                </div>
                <div class="col-12 col-md-12 col-xl-4 col-sm-12 sidebar-main">
                    <section class="related-articles mb-5 mt-5">
                        @include('dvsolution.sidebar')
                    </section>
                </div>
            </div>
        </section>
@endsection
@section('script')
<script src="{{ asset('dvNew/js/enlighterjs.min.js') }}" type="text/javascript"></script>
<!-- <script src="https://cdn.jsdelivr.net/gh/google/code-prettify@master/loader/run_prettify.js?autoload=true&amp;skin=desert" defer></script> -->
<script type="text/javascript">
    EnlighterJS.init('pre', 'code', {
            theme: 'enlighter',
            indent : 2
    });
</script>

 @endsection