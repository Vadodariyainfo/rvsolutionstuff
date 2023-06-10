@extends($adminTheme)

@section('title')
  Contact Replay
@endsection

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Contact Replay</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ route('contactus.index') }}">Contact</a></li>
          <li class="breadcrumb-item active">Contact Replay</li>
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
                      {!! Form::model($user, ['method' => 'POST','route' => ["contactus.replay.send"] ]) !!} 
                        <div class="box-body">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
							          <label>Email : <span class="text-danger">*</span></label>
							          {!! Form::text('email', old('email'), array('placeholder' => 'Enter Email','class' => 'form-control')) !!}
							          @error('email')
							            <span class="text-danger">{{ $message }}</span>
							          @enderror
								    </div>		
								</div>
								<div class="col-md-12">
									<div class="form-group">
							          <label>Title : <span class="text-danger">*</span></label>
							          {!! Form::text('title', old('title'), array('placeholder' => 'Enter Title','class' => 'form-control')) !!}
							          @error('title')
							            <span class="text-danger">{{ $message }}</span>
							          @enderror
								    </div>		
								</div>
								<div class="col-md-12">
									<div class="form-group">
									    <label>Body : <span class="text-danger">*</span></label>
									    {!! Form::textarea('body', old('body'), array('placeholder' => 'Enter Body','class' => 'form-control','rows'=>'5')) !!}
								        @error('body')
								            <span class="text-danger">{{ $message }}</span>
								        @enderror
							    	</div>		
								</div>
							</div>
						</div>
						<!-- /.box-body -->
						<div class="box-footer text-center">
							<a href="{{ route('contactus.index') }}" class="btn btn-danger btn-flat" style="width:77px;">Back</a>
							<button type="submit" class="btn btn-success btn-flat">Submit</button>
						</div>
                      {!! Form::close() !!}
                </div>
              </div>
          </div>
        </div>
      </div>
  </section>
@endsection