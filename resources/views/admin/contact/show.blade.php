@extends($adminTheme)

@section('title')
	Contact Us
@endsection

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Contact Us Show</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ route('contactus.index') }}">Contact Us</a></li>
          <li class="breadcrumb-item active">Contact Us Show</li>
        </ol>
      </div>
    </div>
  </div>
</section>
<section class="content">
    	<div class="container-fluid">
      	<div class="row">
        		<div class="col-md-12">
        			<div class="card">
          			<div class="card-body">
	              	<div class="table-responsive">
                    <table class="table table-bordered  ">
                      <tr>
                          <td width="200px"><b>Name</b></td>    
                          <td>{{ $contactu->name }}</td>    
                      </tr>
                      <tr>
                          <td width="200px"><b>Email</b></td>    
                          <td>{{ $contactu->email }}</td>    
                      </tr>
                      <tr>
                          <td width="200px"><b>Message</b></td>    
                          <td>{{ $contactu->message }}</td>    
                      </tr>
                    </table>
			            </div>
          			</div>
        			</div>
        		</div>
       	</div>
      </div>
  </section>
@endsection