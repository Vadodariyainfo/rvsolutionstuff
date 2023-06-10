  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    @if(auth()->user()->is_admin == 1)
      <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <img src="{!! route('image.asset.storage.file',['folder' => 'site-logos', 'file' => 'logo.png']) !!}" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ env('APP_NAME') }}</span>
      </a>
    @else
      <a href="{{ route('user.admin.dashboard') }}" class="brand-link">
        <img src="{!! route('image.asset.storage.file',['folder' => 'site-logos', 'file' => 'logo.png']) !!}" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ env('APP_NAME') }}</span>
      </a>
    @endif
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          @if(!empty(auth()->user()->profile) && is_null(auth()->user()->google_id))
            <img src="{!! !empty(auth()->user()->profile) ? route('image.asset.storage.file',['folder' => 'userImage', 'file' => auth()->user()->profile]) : asset('adminTheme/dist/img/AdminLTELogo.png') !!}" style="width: 40px;height: 40px; border-radius: 50%; " class=" elevation-2" alt="User Image">
            <!-- <img src="{{ asset('upload/userImage/'.auth()->user()->profile) }}" style="width: 40px;height: 40px; border-radius: 50%; " class=" elevation-2" alt="User Image"> -->
          @elseif(!is_null(auth()->user()->google_id) && !empty(auth()->user()->profile))
            <img src="{!! !empty(auth()->user()->profile) ? route('image.asset.storage.file',['folder' => 'userImage', 'file' => auth()->user()->profile]) : asset('adminTheme/dist/img/AdminLTELogo.png') !!}" style="width: 40px;height: 40px; border-radius: 50%; " class=" elevation-2" alt="User Image">       
          @else
            <img src="{{ asset('adminTheme/dist/img/AdminLTELogo.png') }}" class="user-image">
          @endif
        </div>
        <div class="info">
          @if(auth()->user()->is_admin == 1)
            <a href="{{ route('admin.dashboard') }}" class="d-block">{{ Auth::user()->name }}</a>
          @else  
            <a href="{{ route('user.admin.dashboard') }}" class="d-block">{{ Auth::user()->name }}</a>
          @endif
        </div>
      </div>

      <!-- SidebarSearch Form -->
<!--       <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          @if(auth()->user()->is_admin == 1)
            <li class="nav-item {{ Request::is('admin/dashboard') ? 'menu-open' : '' }}">
              <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>
            <li class="nav-item {{ Request::is('admin/users*') ? 'menu-open' : '' }}">
              <a href="{{ route('users.index') }}" class="nav-link {{ Request::is('admin/users*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-user"></i>
                <p>
                  User
                </p>
              </a>
            </li>
            <li class="nav-item {{ Request::is('admin/category*') ? 'menu-open' : '' }}">
              <a href="{{ route('categorys.index') }}"  class="nav-link {{ Request::is('admin/category*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Category
                </p>
              </a>
            </li>
             <li class="nav-item {{ Request::is('admin/post*') ? 'menu-open' : '' }}">
              <a href="{{ route('posts.index') }}"  class="nav-link {{ Request::is('admin/post*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Post
                </p>
              </a>
            </li>
            <li class="nav-item {{ Request::is('admin/update-post*') ? 'menu-open' : '' }}">
              <a href="{{ route('update.post') }}"  class="nav-link {{ Request::is('admin/update-post*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Update Post
                </p>
              </a>
            </li>
            <li class="nav-item {{ Request::is('admin/tag*') ? 'menu-open' : '' }}">
              <a href="{{ route('tags.index') }}"  class="nav-link {{ Request::is('admin/tag*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-tag"></i>
                <p>
                  Tag
                </p>
              </a>
            </li>
            <li class="nav-item {{ Request::is('admin/languages*') ? 'menu-open' : '' }}">
              <a href="{{ route('languages.index') }}"  class="nav-link {{ Request::is('admin/languages*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-language"></i>
                <p>
                  Languages
                </p>
              </a>
            </li>
            <li class="nav-item {{ Request::is('admin/tutorial*') ? 'menu-open' : '' }}">
              <a href="{{ route('tutorials.index') }}"  class="nav-link {{ Request::is('admin/tutorial*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-book"></i>
                <p>
                  Tutorial
                </p>
              </a>
            </li>
            <li class="nav-item {{ Request::is('admin/blogs*') ? 'menu-open' : '' }}">
              <a href="{{ route('blogs.index') }}"  class="nav-link {{ Request::is('admin/blogs*') ? 'active' : '' }}">
                <i class="nav-icon fa fa-edit"></i>
                <p>
                  Blog
                </p>
              </a>
            </li>
            <li class="nav-item {{ Request::is('admin/image*') ? 'menu-open' : '' }}">
              <a href="{{ route('image.create') }}"  class="nav-link {{ Request::is('admin/image*') ? 'active' : '' }}">
                <i class="nav-icon fa fa-image"></i>
                <p>
                  Image
                </p>
              </a>
            </li>
            <li class="nav-item {{ Request::is('admin/subscriber*') ? 'menu-open' : '' }}">
              <a href="{{ route('admin.subscriber.index') }}"  class="nav-link {{ Request::is('admin/subscriber*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-mail-bulk"></i>
                <p>
                  Subscriber
                </p>
              </a>
            </li>
            <li class="nav-item {{ Request::is('admin/backup*') ? 'menu-open' : '' }}">
              <a href="{{ route('database.backup.index') }}"  class="nav-link {{ Request::is('admin/backup*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-book"></i>
                <p>
                  DataBase Backup
                </p>
              </a>
            </li>
          @else
            <li class="nav-item {{ Request::is('user/dashboard') ? 'menu-open' : '' }}">
              <a href="{{ route('user.admin.dashboard') }}" class="nav-link {{ Request::is('user/dashboard') ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>
            <li class="nav-item {{ Request::is('user/auth-users-profile*') ? 'menu-open' : '' }}">
              <a href="{{ route('user.admin.profile') }}"  class="nav-link {{ Request::is('user/auth-users-profile*') ? 'active' : '' }}">
                <i class="nav-icon fa fa-user"></i>
                <p>
                  Update Profile
                </p>
              </a>
            </li>
            <li class="nav-item {{ Request::is('user/auth/blog*') ? 'menu-open' : '' }}">
            <a href="{{ route('auth.blog.index') }}"  class="nav-link {{ Request::is('user/auth/blog*') ? 'active' : '' }}">
              <i class="nav-icon fa fa-edit"></i>
              <p>
                Blog
              </p>
            </a>
          </li>
          <li class="nav-item {{ Request::is('user/auth/image/create*') ? 'menu-open' : '' }}">
            <a href="{{ route('auth.user.image.create') }}"  class="nav-link {{ Request::is('user/auth/image/create*') ? 'active' : '' }}">
              <i class="nav-icon fa fa-image"></i>
              <p>
                Image
              </p>
            </a>
          </li>
          @endif
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>