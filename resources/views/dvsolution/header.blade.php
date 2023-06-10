<div class="globle-searchbar">
<form method="get" action="#">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <input type="search" name="q" class="form-control" placeholder="Search for blog and categories..">
        </div>
    </div>
</form>
<div class="searchbar-close" id="seachbar-close">
    <i class="fas fa-times"></i>
</div>
</div>
<div class="main-wrap">
<header class="site-header">
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-brand">
                <a href="{{ route('front.home') }}">
                    <img class="logo-image" src="{!! !empty($frontSettings['site-logo']) ? route('image.asset.storage.file',['folder' => 'site-logos', 'file' => $frontSettings['site-logo']]) : asset('hiii.png') !!}">
                </a>
                <div class="burger" id="burger">
                    <span class="burger-open">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="16">
                            <g fill="#252a32" fill-rule="evenodd">
                                <path d="M0 0h24v2H0zM0 7h24v2H0zM0 14h24v2H0z" />
                            </g>
                        </svg>
                    </span>
                    <span class="burger-close">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20">
                            <path fill="#252a32" fill-rule="evenodd" d="M17.778.808l1.414 1.414L11.414 10l7.778 7.778-1.414 1.414L10 11.414l-7.778 7.778-1.414-1.414L8.586 10 .808 2.222 2.222.808 10 8.586 17.778.808z" />
                        </svg>
                    </span>
                </div>
                <div class="upper-header d-none d-sm-block">
                    <div class="menu-item">
                        <!--<a href="#" id="seachbar-show" class="search-menu">-->
                        <!--    <i class="fas fa-search"></i>-->
                        <!--</a>-->
                    </div>
                </div>
            </div>
            <ul class="navbar-nav menu" id="menu">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('latest.post') }}">Latest Articles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('snippet') }}">Snippets</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('blog.cat','php') }}">PHP</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('blog.cat','laravel-8') }}">Laravel 8</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('blog.cat','vue') }}">Vue</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('blog.cat','react') }}">React</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('blog.cat','codeigniter-4') }}">Codeigniter 4</a>
                </li>
<!--                 <li class="nav-item submit-menu">
                    @if (Auth::check()) 
                        @if (Auth::user()->is_admin == 1)
                            <a class="nav-link" target="_blank" href="{{ route('admin.dashboard') }}">{{ Auth::user()->name }}</a>
                        @else
                            <a class="nav-link" target="_blank" href="{{ route('user.admin.dashboard') }}">{{ Auth::user()->name }}</a>
                        @endif
                    @else
                        <a class="nav-link" target="_blank" href="{{ route('login') }}">Admin Login</a>
                    @endif
                </li> -->

                <li class="nav-item submit-menu">
                    <a class="nav-link" href="{{ route('blog.categories') }}">All Categories</a>
                </li>
            </ul>
        </div>
    </nav>
</header>
