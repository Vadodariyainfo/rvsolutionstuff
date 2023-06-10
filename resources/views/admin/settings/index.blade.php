@extends($adminTheme)

@section('title')
  Front Site Setting
@endsection

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Front Site Setting</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Front Site Setting</li>
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
                      <h3 class="card-title">Front Site Setting</h3>
                  </div>
                    <section class="content">
                      <div class="container-fluid">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="card">
                              <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                  <li class="nav-item"><a class="nav-link active" href="#header-verify" data-toggle="tab">Header Verify</a></li>
                                  <li class="nav-item"><a class="nav-link" href="#site-setting" data-toggle="tab">Site Setting</a></li>
                                  <li class="nav-item"><a class="nav-link" href="#about-us" data-toggle="tab">About Us</a></li>
                                  <li class="nav-item"><a class="nav-link" href="#disclaimer" data-toggle="tab">Disclaimer</a></li>
                                  <li class="nav-item"><a class="nav-link" href="#privacy-policy" data-toggle="tab">Privacy Policy</a></li>
                                  <li class="nav-item"><a class="nav-link" href="#ads-setting" data-toggle="tab">Ads Setting</a></li>
                                </ul>
                              </div>
                              <div class="card-body">
                                <div class="tab-content">
                                  <div class="active tab-pane" id="header-verify">                                    
                                    {!! Form::open(array('route' => 'front.settings.update','method'=>'POST','class'=>'form-horizontal','autocomplete'=>'off','files'=>'true')) !!}  
                                      <label>Header Verify :</label>
                                      {!! Form::textarea('header-verify-tag', $frontSettings['header-verify-tag'], array('placeholder' => 'Enter Title','class' => 'form-control','style'=>'height:350px;')) !!}
                                      <div class="form-group row mt-2">
                                        <div class="col-sm-3">
                                          <button type="submit" class="btn btn-block btn-info btn-flat" data-toggle="tooltip" data-placement="top" data-original-title="Submit">Submit</button>
                                        </div>
                                      </div>
                                    {!! Form::close() !!}
                                  </div>
                                  <div class="tab-pane" id="site-setting">                                    
                                    {!! Form::open(array('route' => 'front.settings.update','method'=>'POST','class'=>'form-horizontal','autocomplete'=>'off','files'=>'true')) !!}  
                                    <div class="row">
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>Site Favicon Logo : <span class="text-danger">*</span></label>
                                          <input type="file" name="site-favicon" value="$frontSettings['site-favicon']" class="form-control">
                                        </div>    
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>Site Logo : <span class="text-danger">*</span></label>
                                          <input type="file" name="site-logo" value="$frontSettings['site-logo']" class="form-control">
                                        </div>    
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>Meta Keyword : <span class="text-danger">*</span></label>
                                          {!! Form::textarea('site-keyword', $frontSettings['site-keyword'], array('placeholder' => 'Enter Meta Keyword','class' => 'form-control','style'=>'height:80px;')) !!}
                                        </div>    
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>Meta Description : <span class="text-danger">*</span></label>
                                          {!! Form::textarea('site-description', $frontSettings['site-description'], array('placeholder' => 'Enter Meta Description','class' => 'form-control','style'=>'height:80px;')) !!}
                                        </div>    
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>Site Title : <span class="text-danger">*</span></label>
                                          {!! Form::text('site-title', $frontSettings['site-title'], array('placeholder' => 'Enter Site Title','class' => 'form-control')) !!}
                                        </div>    
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>Address 1 : <span class="text-danger">*</span></label>
                                          {!! Form::text('address1', $frontSettings['address1'], array('placeholder' => 'Enter Address 1','class' => 'form-control')) !!}
                                        </div>    
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>Address 2 : <span class="text-danger">*</span></label>
                                          {!! Form::text('address2', $frontSettings['address2'], array('placeholder' => 'Enter Address 2','class' => 'form-control')) !!}
                                        </div>    
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>City : <span class="text-danger">*</span></label>
                                          {!! Form::text('city', $frontSettings['city'], array('placeholder' => 'Enter City','class' => 'form-control')) !!}
                                        </div>    
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>Phone Number : <span class="text-danger">*</span></label>
                                          {!! Form::text('phone-number', $frontSettings['phone-number'], array('placeholder' => 'Enter Phone Number','class' => 'form-control')) !!}
                                        </div>    
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>E-mail : <span class="text-danger">*</span></label>
                                          {!! Form::text('email', $frontSettings['email'], array('placeholder' => 'Enter E-mail','class' => 'form-control')) !!}
                                        </div>    
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>Footer Copyright : <span class="text-danger">*</span></label>
                                          {!! Form::text('footer-text', $frontSettings['footer-text'], array('placeholder' => 'Enter Footer Copyright','class' => 'form-control')) !!}
                                        </div>    
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>Facebook Link : <span class="text-danger">*</span></label>
                                          {!! Form::text('facebook-link', $frontSettings['facebook-link'], array('placeholder' => 'Enter Facebook Link','class' => 'form-control')) !!}
                                        </div>    
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>Twitter Link : <span class="text-danger">*</span></label>
                                          {!! Form::text('twitter-link', $frontSettings['twitter-link'], array('placeholder' => 'Enter Twitter Link','class' => 'form-control')) !!}
                                        </div>    
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>Linked In Link : <span class="text-danger">*</span></label>
                                          {!! Form::text('linked-in-link', $frontSettings['linked-in-link'], array('placeholder' => 'Enter Linked In Link','class' => 'form-control')) !!}
                                        </div>    
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>Github Link : <span class="text-danger">*</span></label>
                                          {!! Form::text('github-link', $frontSettings['github-link'], array('placeholder' => 'Enter Github Link','class' => 'form-control')) !!}
                                        </div>    
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>Skype Link : <span class="text-danger">*</span></label>
                                          {!! Form::text('skype-link', $frontSettings['skype-link'], array('placeholder' => 'Enter Skype Link','class' => 'form-control')) !!}
                                        </div>    
                                      </div>
                                    </div>
                                    <div class="col-md-12 text-center">
                                      <div class="box-footer">
                                        <button type="submit" class="btn btn-success btn-flat">Submit</button>
                                      </div>
                                    </div>
                                    {!! Form::close() !!}
                                  </div>
                                  <div class="tab-pane" id="about-us">                                    
                                    {!! Form::open(array('route' => 'front.settings.update','method'=>'POST','class'=>'form-horizontal','autocomplete'=>'off','files'=>'true')) !!}  
                                      <label>About Us :</label>
                                        {!! Form::textarea('about-us', $frontSettings['about-us'], array('class' => 'form-control','style'=>'height:350px;')) !!}
                                      <div class="form-group row mt-2">
                                        <div class="col-sm-3">
                                          <button type="submit" class="btn btn-block btn-info btn-flat" data-toggle="tooltip" data-placement="top" data-original-title="Submit">Submit</button>
                                        </div>
                                      </div>
                                    {!! Form::close() !!}
                                  </div>
                                  <div class="tab-pane" id="disclaimer">
                                    {!! Form::open(array('route' => 'front.settings.update','method'=>'POST','class'=>'form-horizontal','autocomplete'=>'off','files'=>'true')) !!}  
                                      <label>Disclaimer :</label>
                                        {!! Form::textarea('disclaimer', $frontSettings['disclaimer'], array('class' => 'form-control','style'=>'height:350px;')) !!}
                                      <div class="form-group row mt-2">
                                        <div class="col-sm-3">
                                          <button type="submit" class="btn btn-block btn-info btn-flat" data-toggle="tooltip" data-placement="top" data-original-title="Submit">Submit</button>
                                        </div>
                                      </div>
                                    {!! Form::close() !!}
                                  </div>                               
                                  <div class="tab-pane" id="privacy-policy">
                                    {!! Form::open(array('route' => 'front.settings.update','method'=>'POST','class'=>'form-horizontal','autocomplete'=>'off','files'=>'true')) !!}  
                                      <label>Privacy Policy :</label>
                                        {!! Form::textarea('privacy-policy', $frontSettings['privacy-policy'], array('class' => 'form-control','style'=>'height:350px;')) !!}
                                      <div class="form-group row mt-2">
                                        <div class="col-sm-3">
                                          <button type="submit" class="btn btn-block btn-info btn-flat" data-toggle="tooltip" data-placement="top" data-original-title="Submit">Submit</button>
                                        </div>
                                      </div>
                                    {!! Form::close() !!}
                                  </div>
                                  <div class="tab-pane" id="ads-setting">                                    
                                    {!! Form::open(array('route' => 'front.settings.update','method'=>'POST','class'=>'form-horizontal','autocomplete'=>'off','files'=>'true')) !!}  
                                    <div class="row">
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>Header Ads 1 : <span class="text-danger">*</span></label>
                                          {!! Form::textarea('ads-1', $frontSettings['ads-1'], array('placeholder' => 'Enter Header Ads 1','class' => 'form-control','style'=>'height:80px;')) !!}
                                        </div>    
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>Footer Ads 2 : <span class="text-danger">*</span></label>
                                          {!! Form::textarea('ads-2', $frontSettings['ads-2'], array('placeholder' => 'Enter Footer Ads 2','class' => 'form-control','style'=>'height:80px;')) !!}
                                        </div>    
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>Ads 3 : <span class="text-danger">*</span></label>
                                          {!! Form::textarea('ads-3', $frontSettings['ads-3'], array('placeholder' => 'Enter Ads 3','class' => 'form-control','style'=>'height:80px;')) !!}
                                        </div>    
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>Ads 4 : <span class="text-danger">*</span></label>
                                          {!! Form::textarea('ads-4', $frontSettings['ads-4'], array('placeholder' => 'Enter Ads 4','class' => 'form-control','style'=>'height:80px;')) !!}
                                        </div>    
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>Ads 5 : <span class="text-danger">*</span></label>
                                          {!! Form::textarea('ads-5', $frontSettings['ads-5'], array('placeholder' => 'Enter Ads 5','class' => 'form-control','style'=>'height:80px;')) !!}
                                        </div>    
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>Ads 6 : <span class="text-danger">*</span></label>
                                          {!! Form::textarea('ads-6', $frontSettings['ads-6'], array('placeholder' => 'Enter Ads 6','class' => 'form-control','style'=>'height:80px;')) !!}
                                        </div>    
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label>Ads 7 : <span class="text-danger">*</span></label>
                                          {!! Form::textarea('ads-7', $frontSettings['ads-7'], array('placeholder' => 'Enter Ads 7','class' => 'form-control','style'=>'height:80px;')) !!}
                                        </div>    
                                      </div>
                                    </div>
                                    <div class="col-md-12 text-center">
                                      <div class="box-footer">
                                        <button type="submit" class="btn btn-success btn-flat">Submit</button>
                                      </div>
                                    </div>
                                    {!! Form::close() !!}
                                  </div>
                              
                                </div>
                          
                              </div>
                            </div>
                      
                          </div>
                    
                        </div>
                   
                      </div>
                    </section>
              
                </div>
            </div>
          </div>
        </div>
    </section>
@endsection