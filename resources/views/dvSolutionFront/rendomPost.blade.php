<section class="feature-posts mb-50">
  <div class="special-heading-2">
    <h3 class="title mb-5 mt-5">OUR
      <span class="bold"> Featured Posts</span>
    </h3>
  </div>
  
  <section>
      {!! $frontSettings['ads-1'] !!}
  </section>

  <div class="row mt-4 ">
      @foreach($randomPostFooter as $key => $value)
      <div class="col-12 col-md-4 col-xl-4 col-sm-6">
        <div class="feature-post-box">
          <div class="post-image">
            @if($value->image != null)
                <img class="post-image" style="height: 100px;" src="{!! !empty($value->image) ? route('image.asset.storage.file',['folder' => 'blog', 'file' => $value->image]) : asset('/blog/default/default.png') !!}" alt="{{ $value->image }}" />
            @else
                <div class="card" style="border:none; height: 100px;">
                    <div class="card-body bg-dark text-light m-2" style="border-radius:10px;">
                        <h5 class="post-image text-center" alt="{{ $value->title }}" data-sizes="auto">{{ $value->title }}</h5>
                    </div>
                </div>                 
            @endif
          </div>
          <a href="{{ route('blog.detail',$value->slug) }}">{{ $value->title }}</a>
          <label class="bottom-line"></label>
        </div>
      </div>
      @endforeach
  </div>
</section>