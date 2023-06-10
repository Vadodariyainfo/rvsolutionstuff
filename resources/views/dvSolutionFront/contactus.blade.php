@extends($dvsolution)

@section('style')
  <link href="{{ asset('dvNew/style/article_detail.css') }}" rel="stylesheet">
@endsection

@section('content')
        <section id="page_body" class="container-fluid mt-5 pt-4">
            <section>
                {!! $frontSettings['ads-1'] !!}
            </section>

            <div class="row mx-0">
                <div class="col-12 col-md-12 col-xl-8 col-sm-12">
                    <div class="article-details-main mb-5 mt-5">
                        <section class="category-post mb-50">
                          <div class="row mt-4 contact-us-main">
                            <div class="col-12 col-md-6 col-xl-6 col-sm-12 left">
                              <span class="title">Contact Me</span>
                              <div class="social-media-details">
                                <div class="social-media-contacts">
                                  <span class="social-name"><i class="fas fa-envelope"></i> Mail</span>
                                  <span class="social-id"><a href="mailto:{{ $frontSettings['email'] }}">{{ $frontSettings['email'] }}</a></span>
                                </div>

                                <div class="social-media-contacts">
                                  <span class="social-name"><i class="fas fa-envelope"></i> Skype</span>
                                  <span class="social-id">{{ $frontSettings['skype-link'] }}</span>
                                </div>
                              </div>

                              <div class="social-media-links mb-4">
                                <ul>
                                  <li><a href="{{ $frontSettings['facebook-link'] }}"><i class="fab fa-facebook-f"></i></a></li>
                                  <li><a href="{{ $frontSettings['twitter-link'] }}"><i class="fab fa-twitter"></i></a></li>
                                  <li><a href="{{ $frontSettings['linked-in-link'] }}"><i class="fab fa-linkedin-in"></i></a></li>
                                  <li><a href="{{ $frontSettings['github-link'] }}"><i class="fab fa-github"></i></a></li>
                                  <li><a href="{{ $frontSettings['skype-link'] }}"><i class="fab fa-skype"></i></a></li>
                                </ul>
                              </div>
                              
                            </div>

                            <div class="col-12 col-md-6 col-xl-6 col-sm-12">

                              <div class="contact-form-main box-shadow">
                                {!! Form::open(array('route' => 'blog.contactus.store','autocomplete'=>'off','class'=>'row g-3')) !!}
                                  <div class="col-md-12">
                                    {!! Form::text('name',Request::get('name'),array('class'=>'form-control','placeholder'=>'First &amp; Last Name')) !!}
                                    {!! $errors->first('name', '<span class="error">:message</span>') !!}
                                  </div>
                                  <div class="col-md-12">
                                    {!! Form::email('email',Request::get('email'),array('class'=>'form-control','placeholder'=>'example@xyz.com')) !!}
                                    {!! $errors->first('email', '<span class="error">:message</span>') !!}
                                  </div>
                                  <div class="col-md-12">
                                    {!! Form::textarea('message',Request::get('message'),array('class'=>'form-control','placeholder'=>'Enter Message','rows'=>'5')) !!}
                                    {!! $errors->first('message', '<span class="error">:message</span>') !!}
                                  </div>
                                  <div class="col-12 btn-submit">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                  </div>
                                 {!! Form::close() !!}
                              </div>
                            </div>
                          </div>
                        </div>
                        
                        <section>
                            {!! $frontSettings['ads-2'] !!}
                        </section>

                      @include('dvSolutionFront.rendomPost')

                        <section>
                            {!! $frontSettings['ads-3'] !!}
                        </section>
                            
                  </div>
                <div class="col-12 col-md-12 col-xl-4 col-sm-12 sidebar-main mt-5 pt-4"> 
                    @include('dvsolution.sidebar')
                </div>
            </div>
        </section>
@endsection