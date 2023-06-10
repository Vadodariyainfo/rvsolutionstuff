@extends($adminTheme)

@section('title')
	Database Backup
@endsection

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Database Backup</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Database Backup</li>
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
                <div class="row">
                  <div class="col-md-6 col-6">
                    <h3 class="card-title mt-2">Database Backup History</h3>
                  </div>
                  <div class="col-md-6 col-6 text-right">
                    <a href="{{ route('admin.backup.store') }}" class="btn btn-info btn-sm"><i class="fa fa-plus pr-1"></i> New Database Backup</a>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-6">
                <div class="row">
                  <div class="col-md-6 col-6">
                    <h3 class="card-title mt-2">Media Backup History</h3>
                  </div>
                  <div class="col-md-6 col-6 text-right">
                    <a href="{{ route('admin.media.backup.store') }}" class="btn btn-info btn-sm"><i class="fa fa-plus pr-1"></i> New Media Backup</a>
                  </div>
                </div>
              </div>
          </div>
          <div class="card-body">
            <div class="row">            
              <div class="col-md-6">
                <div class="main-tb">
                <table class="table companies-table"  style="margin-top: 0px !important;">
                    <thead>
                        <tr class="companies-table-head">
                            <th width="70%">&nbsp;&nbsp;&nbsp;&nbsp; 
                                Name
                            </th>
                            <th width="30%">&nbsp;&nbsp;&nbsp;&nbsp; 
                                Action
                            </th>
                        </tr>
                        <tr class="shadeow-color-tr"></tr>
                    </thead>
                    <tbody>
                    @if(!empty($databasefiles) && count($databasefiles))
                        @foreach($databasefiles as $key => $value)
                            <tr>
                                <td>{{ pathinfo($value)['basename'] }} ( {{ number_format(Storage::size($value) / 1048576,2)  }} MB )</td>
                                <td>
                                    <a href="{{ route('admin.backup.download',['file' => pathinfo($value)['basename']]) }}" class="btn btn-success">Download</a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3">
                                <p>No data found</p>
                            </td>
                        </tr>
                    @endif
                    </tbody>
                </table>
                </div>
            </div>
            <div class="col-md-6">
                <div class="main-tb">
                <table class="table companies-table"  style="margin-top: 0px !important;">
                    <thead>
                        <tr class="companies-table-head">
                            <th width="70%">&nbsp;&nbsp;&nbsp;&nbsp; 
                                Name
                            </th>
                            <th width="20%">&nbsp;&nbsp;&nbsp;&nbsp; 
                                Action
                            </th>
                        </tr>
                        <tr class="shadeow-color-tr"></tr>
                    </thead>
                    <tbody>
                    @if(!empty($mediafiles) && count($mediafiles))
                        @foreach($mediafiles as $key => $value)
                            <tr>
                                <td>{{ pathinfo($value)['basename'] }} ( {{ number_format(Storage::size($value) / 1048576,2)  }} MB )</td>
                                <td>
                                    <a href="{{ route('admin.media.backup.download',['file' => pathinfo($value)['basename']]) }}" class="btn btn-success">Download</a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3">
                                <p>No data found</p>
                            </td>
                        </tr>
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
  </div>
</section>
@endsection

@section('script')
@endsection