        <div class="list-boxes mb-50 box-shadow">
          <h4 class="title">Search</h4>
          <ul>
                <script async src="https://cse.google.com/cse.js?cx=b7d2c2b49b4e0dc63"></script>
                <div class="gcse-search">
          </ul>
        </div>
        <!-- Sidebar  -->
          @if(!empty($popularPosts) && $popularPosts->count())
            <div class="list-boxes mb-50 box-shadow">
              <h4 class="title">Popular Posts</h4>
              <ul>
                  @foreach($popularPosts as $key => $value)
                    <li><i class="fas fa-chevron-right"></i> <a href="{{ route('blog.detail', $value->slug ) }}">{{ $value->title }}</a></li>
                  @endforeach
              </ul>
            </div>
          @endif

          <section>
              {!! $frontSettings['ads-3'] !!}
          </section>

          @if(!empty($randomPostSidebar) && $randomPostSidebar->count())
            <div class="list-boxes mb-50 box-shadow">
              <h4 class="title">Random Posts</h4>
              <ul>
                @foreach($randomPostSidebar as $key => $value)
                  <li><i class="fas fa-chevron-right"></i> <a href="{{ route('blog.detail', $value->slug ) }}">{{ $value->title }}</a></li>
                @endforeach
              </ul>
            </div>
          @endif    
              
          @if(!empty($latestCategory) && $latestCategory->count())
            <div class="mb-50 box-shadow round-boxes">
              <h4 class="title">Categories</h4>
              <ul>
                @foreach($latestCategory as $key => $value)
                  <li><a href="{{ route('blog.cat', $value->slug ) }}">{{ $value->name }}</a></li>
                @endforeach
              </ul>
            </div>
          @endif    
          
          <section>
              {!! $frontSettings['ads-4'] !!}
          </section>

          @if(!empty($latestBlogLimit) && $latestBlogLimit->count())
            <div class="list-boxes mb-50 box-shadow">
              <h4 class="title">Latest Posts</h4>
              <ul>
                @foreach($latestBlogLimit as $key => $value)
                  <li><i class="fas fa-chevron-right"></i> <a href="{{ route('blog.detail', $value->slug ) }}">{{ $value->title }}</a></li>
                @endforeach
              </ul>
            </div>
          @endif