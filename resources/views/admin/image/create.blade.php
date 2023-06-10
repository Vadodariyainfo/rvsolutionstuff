@extends($adminTheme)

@section('title')
  Images
@endsection

@section('style')
<style type="text/css">
  .dropzone .dz-message .dz-button {
    color: #000;
  }
</style>
@endsection

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Image Create</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Image Create</li>
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
                  {!! Form::open(array('route' => 'image.store','method'=>'POST','files'=>'true','class' => 'dropzone', 'id'=>'dropzone')) !!}
                  {!! Form::close() !!}
                </div>
              </div>
          </div>
        </div>
      </div>
  </section>
@endsection
@section('script')
<script type="text/javascript">
Dropzone.options.dropzone =
 {
    maxFilesize: 50,
    renameFile: function(file) {
       return file.name;
    },
    acceptedFiles: ".jpeg,.jpg,.png,.gif,.pdf,.csv,.mp4,.mp3",
    timeout: 5000,
    success: function(file, response) 
    {
        console.log(response);
    },
    error: function(file, response)
    {
       return false;
    }
};
</script>
@endsection