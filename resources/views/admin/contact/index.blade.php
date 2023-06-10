@extends($adminTheme)

@section('title')
	Contact Us
@endsection

@section('style')
<style type="text/css">
  .disable { 
      cursor: not-allowed; 
      pointer-events: none; 
      opacity: .4;
  }
</style>
@endsection

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Manage Contact Us</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Manage Contact Us</li>
        </ol>
      </div>
    </div>
  </div>
</section>
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <div class="row">            
              <div class="col-md-6 col-6">
                <h3 class="card-title mt-2">Manage Contact Us List</h3>
              </div>
              <div class="col-md-6 col-6 text-right mt-1">
              {!! Form::open(array('route' => 'contact.truncate','method'=>'DELETE')) !!}
                <button type="submit" class="btn btn-info btn-sm"><i class="fa fa-trash pr-1"></i></button>
              {!! Form::close()!!}
              </div>
            </div>
          </div>
          <div class="card-body">
            <table class="table table-bordered table-striped data-table">
              <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th width="150px">Action</th>
                  </tr>
              </thead>
              <tbody>
              	
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
@section('script')

<script>
$(function () {

    var table = $('.data-table').DataTable({
    	rowReorder: {
            selector: 'td:nth-child(2)'
        },
    	responsive: true,
        processing: true,
        serverSide: true,
        ajax: "/admin/contactus",
        columns: [
          {data: 'DT_RowIndex', name: 'DT_RowIndex'},
          {data: 'name', name: 'name'},
          {data: 'email', name: 'email'},
          {data: 'message', name: 'message'},
          {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    $.fn.dataTable.ext.errMode = 'throw';
});
</script>
@endsection