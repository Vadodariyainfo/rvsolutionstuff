@extends($adminTheme)
   
@section('title')
    Dashboard
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <a href="{{ route('blogs.index') }}">

              <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-edit"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">BLog</span>
                  <span class="info-box-number">
                    {{ $blogCount }}
                  </span>
                </div>
                <!-- /.info-box-content -->
              </div>
            </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <a href="{{ route('categorys.index') }}">

              <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fab fa-blogger-b"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Category</span>
                  <span class="info-box-number">{{ $blogCategoryCount }}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
            </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <a href="{{ route('posts.index') }}">

              <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fa fa-th"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Post</span>
                  <span class="info-box-number">{{ $postCount }}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
            </a>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <a href="{{ route('users.index') }}">

              <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">New Members</span>
                  <span class="info-box-number">{{ $userCount }}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
            </a>
            <!-- /.info-box -->
          </div>

          <div class="col-12 col-sm-6 col-md-3">
            <a href="{{ route('blogs.index') }}">
              
              <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-edit"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">Admin BLog</span>
                  <span class="info-box-number">
                    {{ $admin_blog }}
                  </span>
                </div>
                <!-- /.info-box-content -->
              </div>
            </a>
            <!-- /.info-box -->
          </div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-eye"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Site View</span>
                <span class="info-box-number">
                  {{ $blogView }}
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- /.row -->
        <div class="row">
          <div class="col-sm-12">
              <div class="card">
                <div class="card-body">
                <div class="box box-info">
                  <div class="box-header with-border row" style="margin-bottom: 10px;">
                    <div class="col-md-8">
                      <h4 class="box-title">Most Popular Blog</h4>
                    </div>
                    <div class="col-md-4">
                      <div class="box-tools" style="right: 70px;">
                          <form action="{{ route('admin.dashboard') }}" method="get">
                            {{ Form::select('searchBlogDay', ['1'=>'Today','2'=>'Yesterday','7'=>'7 Days','30'=>'30 Days','182'=>'6 Month','365'=>'1 Year','all'=>'All Time'], Request::get('searchBlogDay'), ['class'=>'form-control']) }}
                          </form>
                      </div>
                    </div>  
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <div class="table-responsive">
                      <table class="table no-margin">
                        <thead>
                        <tr>
                          <th>No</th>
                          <th>Title</th>
                          <th>View</th>
                          <th>Create Date</th>
                          <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                          @if(!empty($blogpopular) && count($blogpopular) > 0)
                            @foreach($blogpopular as $key => $value)
                            <tr>
                                <td class="id-width">{{ ++$i }}</td>
                                <td>{{ $value->title }}</td>
                                <td>
                                 <label class="badge badge-success" >{{ $value->total_view }}</label>
                                </td>
                                <td>
                                  @if(!is_null($value->publish_date))
                                  {{  \Carbon\Carbon::createFromFormat('Y-m-d', $value->publish_date)->format('d-m-Y') }}
                                  @else
                                  {{  \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value->created_at)->format('d-m-Y') }}</td>
                                  @endif
                                <td>
                                  <a href="{{ route('blog.detail',$value->slug) }}" class="btn btn-info btn-xs btn-flat" data-toggle="tooltip" title="View" target="_black"><i class="fa fa-eye"></i> View</a>
                                </td>
                            </tr>
                            @endforeach
                          @else
                              <td class="text-center" colspan="6">There Are No Blog.</td>
                          @endif
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.row -->
        <div class="row">
          <div class="col-12 col-sm-12 col-md-6 col-lg-6">
            <div class="card">
              <div class="card-body">
                <div class="box box-info">
                  <div class="box-header with-border row">
                    <div class="col-md-8">
                      <h4 class="box-title">Month In Total Blog</h4>
                    </div>
                    <div class="col-md-4">
                      <div class="box-tools" style="right: 70px;">
                        <form action="{{ URL::route('admin.dashboard') }}" method="get">
                        {{ Form::select('currentYearChart', ['2022'=>'Year 2022','2023'=>'Year 2023','2024'=>'Year 2024'], Request::get('currentYearChart'), ['class'=>'form-control']) }}
                        </form>
                      </div>
                    </div>
                    <div class="box-body" style="margin: 0 auto;">
                       <div id="columnchart_values" style="width: 100%; height: 400px;"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-12 col-md-6 col-lg-6">
            <div class="card">
              <div class="card-body">
                <div class="box box-info">
                  <div class="box-header with-border row">
                    <div class="col-md-8">
                      <h4 class="box-title">Month In Total View</h4>
                    </div>
                    <div class="col-md-4">
                      <div class="box-tools" style="right: 70px;">
                        <form action="{{ URL::route('admin.dashboard') }}" method="get">
                        {{ Form::select('currentYearViewChart', ['2022'=>'Year 2022','2023'=>'Year 2023','2024'=>'Year 2024'], Request::get('currentYearViewChart'), ['class'=>'form-control']) }}
                        </form>
                      </div>
                    </div>
                    <div class="box-body" style="margin: 0 auto;">
                       <div id="column_view_chart_values" style="width: 100%; height: 400px;"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-12 col-md-6 col-lg-6">
            <div class="card">
              <div class="card-body">
                <div class="box box-info">
                  <div class="box-header with-border row">
                    <div class="col-md-8">
                      <h4 class="box-title">Total Language In Blog</h4>
                    </div>
                    <div class="box-body">
                       <div id="pieChart" style="width: 100%; height: 400px;"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('script')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
 <script>
    $("select[name='searchBlogDay']").change(function(){
      $(this).parents('form').submit();
    });

    $("select[name='currentYearChart']").change(function(){
       $(this).parents('form').submit();
    });

    $("select[name='currentYearViewChart']").change(function(){
       $(this).parents('form').submit();
    });

   var visitor = <?php echo $visitor; ?>;
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable(visitor);
        var options = {
          curveType: 'function',
          colors: ['green'],
          legend: { position: 'bottom' },
        };
        var chart = new google.visualization.ColumnChart(document.getElementById('columnchart_values'));
        chart.draw(data, options);
      }
 </script>

 <script type="text/javascript">
   var monthlyView = <?php echo $monthlyView; ?>;
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable(monthlyView);
        var options = {
          curveType: 'function',
          colors: ['blue'],
          legend: { position: 'bottom' },
        };
        var chart = new google.visualization.ColumnChart(document.getElementById('column_view_chart_values'));
        chart.draw(data, options);
      }
 </script>

 <script>
  var blogcategorychart = <?php echo $blogcategorychart; ?>;
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable(blogcategorychart);
        var options = {
          curveType: 'function',
          pieHole: 0.3,
          pieSliceText: 'label',
          legend: { position: 'bottom' },
        };
        var chart = new google.visualization.PieChart(document.getElementById('pieChart'));
        chart.draw(data, options);
      }
 </script>
@endsection