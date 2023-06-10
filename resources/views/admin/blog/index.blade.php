@extends($adminTheme)

@section('title')
	Blog
@endsection

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Blog</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Blog</li>
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
              <div class="col-md-9 col-9">
                <h3 class="card-title mt-2">Blog List</h3>
              </div>
              <div class="col-md-3 col-3 text-right">
                <div class="row">
                  <div class="col-md-6 col-6 text-right">
                    <a href="{{ route('admin.post.publish') }}" class="btn btn-info btn-sm"><i class="fa fa-fire pr-1"></i> Post Publish</a>
                  </div>
                  <div class="col-md-6 col-6 text-right">
                    <a href="{{ route('blogs.create') }}" class="btn btn-info btn-sm"><i class="fa fa-plus pr-1"></i> Create Blog</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card-body">
            <table class="table table-bordered table-striped data-table" style="width:100% !important;">
              <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th width="100px">Image</th>
                    <th width="200px">Title</th>
                    <th>Blog Category</th>
                    <!-- <th>Publish</th> -->
                    <th>Post View</th>
                    <th>Publish Date</th>
                    <th>Create Date</th>
                    <th>Is Publish</th>
                    <th width="170px">Action</th>
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
        ajax: "{{ route('blogs.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex',orderable: false, searchable: false},
                {data: 'image', name: 'image'},
                {data: 'title', name: 'title'},
                {data: 'blog-category', name: 'blog-category'},
                // {data: 'publish', name: 'publish'},
                {data: 'total_view', name: 'total_view'},
                {data: 'publish_date', name: 'publish_date'},
                {data: 'created-date', name: 'created-date'},
                {data: 'is_publish', name: 'is_publish'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
                {
	               data: 'created_at',
	               type: 'num',
	               targets: [9],
	               visible: false,
	               render: {
	                  _: 'display',
	                  sort: 'timestamp'
	               }  
	            },
            ],
            "fnDrawCallback": function() {
                jQuery('.toggle').bootstrapToggle();
            }
    });

    $.fn.dataTable.ext.errMode = 'throw';
});

    $('body').on('change','.change-status',function () {
    var status = $(this).prop('checked') == true ? '1' : '0';
    var id = $(this).data('id');
    var url = 'blog/change-status/'+id;
        $.ajax({
            url: url,
            method: "POST",
            data: {_token:token,status:status},
            success: function(data){
                toastr.success('Post Updated successfully.');
            }
        });
    });
</script>
@endsection