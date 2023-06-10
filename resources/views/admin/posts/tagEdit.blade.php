@extends($adminTheme)

@section('title')
	Tag Edit
@endsection

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Tag Edit</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ route('posts.index') }}">Post</a></li>
          <li class="breadcrumb-item active">Tag Edit</li>
        </ol>
      </div>
    </div>
  </div>
</section>
<section class="content">
  <div class="container-fluid">
        <div class="row">
          <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                      {!! Form::open(array('route' => 'post.tag.store','method'=>'POST','autocomplete'=>'off')) !!}
                  <div class="row">
                  <div class="col-md-12">
                    <select data-placeholder="Choose tags ..." name="tag_id[]" multiple class="chosen-select">
                        @foreach($tagList as $key => $value)
                          @if(!empty($tag_id) && in_array($key, $tag_id))
                          <option selected="true" value="{{ $key }}">{{ $value }}</option>
                          @else
                          <option  value="{{ $key }}">{{ $value }}</option>
                          @endif
                        @endforeach
                    </select>
                  </div>                      
                     <input type="hidden" name="post_id" value="{{ $id }}">
                  </div>
                  <div class="box-footer mt-2">
                    <button type="submit" class="btn btn-success btn-flat">Submit</button>
                  </div>
                <!-- /.box-body -->
                  {!! Form::close() !!}
                </div>
              </div>
          </div>
        </div>
      </div>
  </section>
@endsection

@section('script')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.css" integrity="sha256-0LjJurLJoa1jcHaRwMDnX2EQ8VpgpUMFT/4i+TEtLyc=" crossorigin="anonymous" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js" integrity="sha256-c4gVE6fn+JRKMRvqjoDp+tlG4laudNYrXI1GncbfAYY=" crossorigin="anonymous"></script>
<script type="text/javascript">
  jQuery(document).ready(function(){
     $(".chosen-select").chosen({width: "50%"}); 
  });
</script>
@endsection