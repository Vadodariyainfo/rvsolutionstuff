@extends($adminTheme)

@section('title')
  Blog Releated
@endsection

@section('style')
<style type="text/css">
    .select-class{
        height: 200px;
        width: 200px;
    }
    .box-footer{
        margin-top: 5px;
    }
</style>
@endsection

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Blog Releated Create</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ route('blogs.index') }}">Blog</a></li>
          <li class="breadcrumb-item active">Blog Releated Create</li>
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
                    {!! Form::open(array('route' => 'admin.related.blog.store','method'=>'POST','autocomplete'=>'off','files'=>'true')) !!}
                        <select data-placeholder="Choose tags ..." name="tags[]" multiple class="chosen-select">
                            @foreach($blog as $key => $value)
                                @if(!empty($taglist) && in_array($key, $taglist))
                                <option selected="true" value="{{ $key }}">{{ $value }}</option>
                                @else
                                <option  value="{{ $key }}">{{ $value }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('tag_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div class="box-footer">
                            <button type="submit" class="btn btn-success btn-flat">Submit</button>
                        </div>
                        <input type="hidden" name="blog_id" value="{{ $id }}">
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