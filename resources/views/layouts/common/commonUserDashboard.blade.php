<!-- resources/views/layouts/main.blade.php -->
@if(Auth::check() && Auth::user()->name !== null)

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="{{ asset('assets/lib/plugin/parsley/css/parsley.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/ready.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
</head>
<body>
    <div class="wrapper">
        <div class="main-header">
            <div class="logo-header">
                <a href="{{ Auth::check() ? url('/home') : url('/') }}" class="logo text-decoration-none">
                    {{ config('app.name') }}
                </a>
                <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <button class="topbar-toggler more"><i class="la la-ellipsis-v"></i></button>
            </div>
            <nav class="navbar navbar-header navbar-expand-lg">
                <div class="container-fluid">
                    <form class="navbar-left navbar-form nav-search mr-md-3" action>
                        <div class="input-group">
                            <input type="text" placeholder="Search ..." class="form-control">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="la la-search search-icon"></i>
                                </span>
                            </div>
                        </div>
                    </form>
                    <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                        <!-- Authentication Links -->
                        <li class="nav-item dropdown hidden-caret">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="la la-envelope"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                                <img src="assets/img/profile.jpg" alt="user-img" width="36" class="img-circle">
                                <span>{{ Auth::user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                @guest
                                @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                                @endif
                                @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                                @endif
                                @else
                                <li>
                                    <div class="user-box">

                                        <div class="u-text">
                                            <i class="fa-solid fa-user"></i>
                                            <h4 class="text-uppercase">{{ Auth::user()->name }}</h4>

                                        </div>
                                    </div>
                                </li>
                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                                @endguest
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>

        <div class="sidebar">
            <div class="scrollbar-inner sidebar-wrapper">
                <div class="user">
                    <div class="photo">
                        <img src="{{ asset('assets/img/profile.jpg') }}">
                    </div>
                    <div class="info">
                        <a class="" data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                            <span>
                                @auth
                                {{ Auth::user()->name }}
                                @endauth
                                <span class="user-level">Administrator</span>
                                <span class="caret"></span>
                            </span>
                        </a>
                        <div class="clearfix"></div>
                        <div class="collapse in" id="collapseExample" aria-expanded="true">
                            <ul class="nav">
                                <li><a href="#profile"><span class="link-collapse">My Profile</span></a></li>
                                <li><a href="#edit"><span class="link-collapse">Edit Profile</span></a></li>
                                <li><a href="#settings"><span class="link-collapse">Settings</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <ul class="nav">
                    <li class="nav-item active">
                        <a href="index.html"><i class="la la-dashboard"></i>
                            <p>Dashboard</p><span class="badge badge-count">5</span>
                        </a>
                    </li>

                </ul>
            </div>
        </div>

        <div class="main-panel">
            <div class="content">

                @yield('content')
            </div>
        </div>
    </div>


</body>
<!-- Scripts -->
<script src="{{ asset('assets/lib/core/jquery.3.2.1.min.js') }}"></script>
<script src="{{ asset('assets/lib/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets/lib/core/popper.min.js') }}"></script>
<script src="{{ asset('assets/lib/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/lib/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
<script src="{{ asset('assets/lib/plugin/bootstrap-toggle/bootstrap-toggle.min.js') }}"></script>
<script src="{{ asset('assets/lib/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

<script src="{{ asset('assets/js/ready.min.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
<script src="{{ asset('assets/lib/plugin/parsley/js/parsley.min.js') }}"></script>
<script src="{{ asset('assets/js/subscription/form/custom.js') }}"></script>

@yield('scripts')


</html>
@else
<script>
    location.href = '/';

</script>
@endif
