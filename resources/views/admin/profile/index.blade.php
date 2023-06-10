@extends($adminTheme)

@section('title')
  User Profile
@endsection

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>User Profile</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">User Profile</li>
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
                <div class="card-header">
                      <h3 class="card-title">Profile Update</h3>
                  </div>
                    {!! Form::open(array('route' => 'admin.profile.update','method'=>'POST')) !!}
                    <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Name : <span class="text-danger">*</span></label>
                              {!! Form::text('name',$user->name, array('placeholder' => 'Enter Name','class' => 'form-control')) !!}
                              @error('name')
                                  <span class="text-danger">{{ $message }}</span>
                              @enderror
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Email : <span class="text-danger">*</span></label>
                              {!! Form::text('email', $user->email, array('placeholder' => 'Enter Email','class' => 'form-control')) !!}
                              @error('email')
                                  <span class="text-danger">{{ $message }}</span>
                              @enderror
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Password : </label>
                              {!! Form::password('new_password', array('placeholder' => 'Password','class'=>'form-control','AutoComplete'=>'off')) !!}
                              @error('new_password')
                                  <span class="text-danger">{{ $message }}</span>
                              @enderror
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Confirm Password : </label>
                              {!! Form::password('confirm_password', array('placeholder' => 'Confirm Password','class'=>'form-control','AutoComplete'=>'off')) !!}
                               @error('confirm_password')
                                  <span class="text-danger">{{ $message }}</span>
                              @enderror
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="card-footer text-center">
                        <button type="submit" class="btn btn-success btn-sm mr-1" data-toggle="tooltip" data-placement="top" data-original-title="Submit">Submit</button>
                      </div>
                    {!! Form::close() !!}
                </div>
            </div>
          </div>
        </div>
    </section>
@endsection