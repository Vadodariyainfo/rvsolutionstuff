@extends($adminTheme)

@section('title')
	Post Edit
@endsection

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Post Edit</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ route('posts.index') }}">Post</a></li>
          <li class="breadcrumb-item active">Post Edit</li>
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
                      {!! Form::model($posts, ['method' => 'PUT','route' => ["posts.update", $posts->id],'files'=>true]) !!} 
                        @include('admin.posts.form')
                      {!! Form::close() !!}
                </div>
              </div>
          </div>
        </div>
      </div>
  </section>
@endsection