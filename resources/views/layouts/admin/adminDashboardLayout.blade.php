@if (Auth::check() && Auth::user()->hasRole('super admin'))
    <!doctype html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="{{ asset('admin_asset/css/vertical-layout-light/style.css') }}">
        @yield('head')
    </head>


    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo" href="{{ route('admin.home') }}">
                    <img src="https://hapusinfotech.com/sites/default/files/hapus_logo_1.png" alt="logo" />
                </a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <ul class="navbar-nav mr-lg-2">
                    <li class="nav-item  d-none d-lg-flex">
                        <a class="nav-link" href="#">Calendar</a>
                    </li>
                    <li class="nav-item  d-none d-lg-flex">
                        <a class="nav-link active" href="#">Statistic</a>
                    </li>
                    <li class="nav-item  d-none d-lg-flex">
                        <a class="nav-link" href="#">Employee</a>
                    </li>
                </ul>
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item d-none d-lg-flex  mr-2">
                        <a class="nav-link" href="#">Help</a>
                    </li>
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle  pl-0 pr-0" href="#" data-toggle="dropdown"
                            id="profileDropdown">
                            <i class="typcn typcn-user-outline mr-0"></i>
                            <span class="nav-profile-name">Evan Morales</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown"
                            aria-labelledby="profileDropdown">
                            <a class="dropdown-item"><i class="typcn typcn-cog text-primary"></i>Settings</a>
                            <a class="dropdown-item"><i class="typcn typcn-power text-primary"></i>Logout</a>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                    <span class="typcn typcn-th-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <div class="d-flex sidebar-profile">
                            <div class="sidebar-profile-image">
                                <img src="{{ asset('assets/img/profile.jpg') }}" alt="image">
                                <span class="sidebar-status-indicator"></span>
                            </div>
                            <div class="sidebar-profile-name">
                                <p class="sidebar-name"> @auth
                                        {{ Auth::user()->name }}
                                    @endauth </p>
                                <p class="sidebar-designation">
                                    @if (Auth::user()->hasRole('super admin'))
                                        Super Admin
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="nav-search">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Type to search..."
                                    aria-label="search" aria-describedby="search">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="search"><i
                                            class="typcn typcn-zoom"></i></span>
                                </div>
                            </div>
                        </div>
                        <p class="sidebar-menu-title">Dash menu</p>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.home') }}">
                            <i class="typcn typcn-device-desktop menu-icon"></i>
                            <span class="menu-title">Dashboard <span class="badge badge-primary ml-3">New</span></span>
                        </a>
                    </li>
                    <!-- Add the rest of the sidebar navigation items -->
                </ul>
            </nav>

            <div class="main-panel">
                <div class="content-wrapper">

                    @yield('content')



                </div>
            </div>
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- Scripts -->
    <script src="{{ asset('assets/lib/core/jquery.3.2.1.min.js') }}"></script>
    <script src="{{ asset('assets/lib/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/lib/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/lib/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/lib/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('assets/lib/plugin/bootstrap-toggle/bootstrap-toggle.min.js') }}"></script>
    <script src="{{ asset('assets/lib/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

    <script src="{{ asset('assets/js/ready.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/lib/plugin/parsley/js/parsley.min.js') }}"></script>

    <script src="{{ asset('admin_asset/js/dashboard.js') }}"></script>
    @yield('scripts')

    </body>

    </html>
@else
    <script>
        window.location.href = '/';
    </script>
@endif
