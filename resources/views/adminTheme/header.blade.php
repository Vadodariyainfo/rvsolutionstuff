  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        @if(Auth::user()->is_admin == 1)
        <a href="{{ route('admin.dashboard') }}" class="nav-link">Home</a>
        @else
        <a href="{{ route('user.admin.dashboard') }}" class="nav-link">Home</a>
        @endif
      </li>
      @if(Auth::user()->is_admin == 1)
        <li class="nav-item d-none d-sm-inline-block">
          <a href="{{ route('contactus.index') }}" class="nav-link">Contact</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="{{ route('front.home') }}" target="_blank" class="nav-link">Site View</a>
        </li>
      @endif
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
<!--       <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline" style="width:91%;">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li> -->

<!--       <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-cog"></i>
        </a>
      </li> -->
      <div class="dropdown">
        <li class="nav-item dropdown" id="dropdownMenuButton">
          <button class="btn btn-default dropdown-toggle" type="button"  data-toggle="dropdown" aria-haspopup="true">
              <i class="fa fa-cog" aria-hidden="true"></i>
            </button>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
             @csrf
          </form>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            @if(Auth::user()->is_admin == 1)
              <a class="dropdown-item" href="{{ route('admin.profile') }}"><i class="fas fa-user"></i> Update Profile</a>
              <a class="dropdown-item" href="{{ route('front.settings') }}"><i class="fas fa-cog"></i> Front Settings</a>
            @endif  
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link dropdown-item"><i class="fas fa-sign-out-alt"></i> Logout</a>
          </div>
        </li>
      </div>
    </ul>
  </nav>
  <!-- /.navbar -->