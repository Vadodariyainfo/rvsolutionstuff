@extends($adminTheme)

@section('title')
  Update Post
@endsection

@section('style')
<style type="text/css">
  .tag-list-div{
    margin-top: 5px;

  }
  .tag-list-div .tag-list{
    display: inline-block;
  }
  .tag-list{
    background-color: #378496;
    color: white;
    padding: 5px;
    margin: 5px;
    border-radius: 10%;
  }
</style>
@endsection

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Post Update</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Post Update</li>
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
                      {!! Form::open(array('route' =>'tag.store','method'=>'POST','files'=>'true')) !!}
                <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                          <label>Post:</label>
                          {!! Form::select('post',$getpost, null,['class'=>'chosen form-control select-post']) !!}
                      </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                          <label>Tag</label>
                          <select data-placeholder="Choose tags ..." name="tag_id[]" multiple class="chosen-select form-control">
                          @foreach($tagList as $key => $value)
                            @if(!empty($tag_id) && in_array($key, $tag_id))
                            <option selected="true" value="{{ $key }}">{{ $value }}</option>
                            @else
                            <option  value="{{ $key }}">{{ $value }}</option>
                            @endif
                          @endforeach
                      </select> 
                      <div class="tag-list-div"></div>
                      </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                        <label>Image:</label>
                        {!! Form::file('image',['class'=>'form-control']) !!}
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label>Upload Snippet Zip : </label>
                        {!! Form::file('uploadzip',['class'=>'form-control']) !!}
                        <span class="is-snippet-zip"></span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>is_demo Check : </label><br>
                      {{ Form::checkbox('is_demo',1,null,['class'=>'is-demo-checkbox']) }}
                    </div>
                  </div>
                </div>
                <div class="row ">
                  <div class="col-md-12 text-center">
                    <div class="form-group">
                      <button type="submit" class="btn btn-success btn-flat">submit</button>
                    </div>
                  </div>
                </div>
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
     $(".chosen-select").chosen({width: "100%"}); 
  });
</script>
<script type="text/javascript">
    $("body").on("change",".select-post",function(){
      var post_id = $(this).val();
      var token = $('meta[name="csrf-token"]').attr('content');
      $.ajax({ 
          url: "{{ route('getajax.post.data') }}",
          method: 'POST',
          data: {_token:token, post_id:post_id},
          success: function(data) {
              if(data.error == 'ture'){
                  alert('Somethings Want To Wrong.');
              }else{
                $(".tag-list-div").empty();
                $.each(data.tagData, function( index, value ) {
                  $(".tag-list-div").append('<span class="tag-list">'+ value+'</span>');  
          });

                $('.is-snippet-zip').empty();
                if(data.postData.is_download == '1'){
                  $('.is-snippet-zip').html('Zip Uploaded');
                }else{
                  $('.is-snippet-zip').html('Zip Not Uploaded');
                }

                if(data.postData.is_demo == '1'){
                  $('.is-demo-checkbox').attr('checked', true);
                }else{
                  $('.is-demo-checkbox').attr('checked', false);
                }
              }
              
          }
      });
    });
</script>
@endsection
