@extends($adminTheme)

@section('title')
  Blog Create
@endsection

@section('style')
<style type="text/css">
  .display-none{
    display: none;
  }
  .display-block{
    display: block;
  }
  .toggle-on.btn-xs{
    padding-right: 10px !important;
  }
</style>
@endsection

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Blog Create</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><button class="btn-sm btn-info"  data-toggle="modal" data-target="#infoModal" data-toggle="tooltip" data-placement="top" data-original-title="info blog"><i class="fas fa-info"></i></button></li>
          <li class="breadcrumb-item"><a href="{{ route('user.admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ route('auth.blog.index') }}">Blog</a></li>
          <li class="breadcrumb-item active">Blog Create</li>
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
                      {!! Form::open(array('route' => 'auth.blog.store','method'=>'POST','files'=>'true')) !!}
                        @include('admin.blog.form')
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
  $('.is-publish').change(function(event) {
    alert();
    var is_publish = $(this).prop('checked');
    if (is_publish == false) {
      $('.publish-date').removeClass('display-none');
      $('.publish-date').addClass('display-block');
    }else{
      $('.publish-date').removeClass('display-block');
      $('.publish-date').addClass('display-none');
      $('.publish-date-input').val('');
    }
  });
  //Date picker
    $('#datepicker').datepicker({
        autoclose: true
    })
</script>
@endsection