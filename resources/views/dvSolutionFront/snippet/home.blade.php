@extends($dvsolution)

@section('style')
  <link href="{{ asset('dvNew/style/article_listing.css') }}" rel="stylesheet">
@endsection

@section('content')
        <section id="page_body" class="container-fluid mt-5 pt-4">
            <div class="row mx-0">
                <div class="col-12 col-md-12 col-xl-8 col-sm-12">
                    <section class="article-listing">
                        <h3 class="title mb-5 mt-5">ALL Articles Of
                            <span class="bold">Snippest</span>
                        </h3>

                        <section>
                            {!! $frontSettings['ads-1'] !!}
                        </section>

                        <div class="row mx-0">

                        <div class="row mx-0">
                        @if(!empty($posts))
                          @foreach($posts as $key => $value)
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 mb-4">
                                <div class="vr-post-box">
                                    <a href="{{ route('post.detail',$value->slug) }}">
                                        <div class="image-box">
                                            <img class="lazyload" alt="{{ $value->image }}" data-src="{!! !empty($value->image) ? route('image.asset.storage.file',['folder' => 'images', 'file' => $value->image]) : '' !!}" data-sizes="auto" />
                                        </div>
                                        <div class="content-box">
                                            <h3><a href="{{ route('post.detail',$value->slug) }}">{{ $value->title }}</a></h3>
                                            <div class="post-info">
                                                <span class="user">
                                                    <i class="fas fa-user"></i> By Site Admin</span>
                                                <span class="time">
                                                    <i class="far fa-clock"></i> {{ $value->created_at->format('M d, Y') }}</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                          @endforeach
                        </div>
                        
                        <section>
                            {!! $frontSettings['ads-2'] !!}
                        </section>

                        <div class="row action-btns-bottom mb-4">
                          <div class="col justify-content-center d-flex">
                            @if($posts->currentPage() != 1)
                              <a href="{{ $posts->previousPageUrl() }}"><button type="button" class="btn btn-primary btn-lg next"><i
                                  class="fas fa-chevron-left"></i> Previous</button></a>
                            @else
                              <a href="{{ $posts->previousPageUrl() }}"><button type="button" class="btn btn-primary btn-lg disabled previous"><i
                                  class="fas fa-chevron-left"></i> Previous</button></a>
                            @endif
                            <a href="{{ $posts->nextPageUrl() }}"><button type="button" class="btn btn-secondary btn-lg next">Next<i
                                class="fas fa-chevron-right"></i></button></a>
                          </div>
                        </div>
                      @endif
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