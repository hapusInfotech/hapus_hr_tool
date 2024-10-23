@if (Auth::check())
    {{-- && Auth::user()->hasRole('company admin') --}}
    <!doctype html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- plugins:css -->
        <link rel="stylesheet" href="{{ asset('company_dashboard/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('company_dashboard/assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">

        <link rel="stylesheet" href="{{ asset('company_dashboard/assets/vendors/jquery-bar-rating/css-stars.css') }}" />
        <link rel="stylesheet"
            href="{{ asset('company_dashboard/assets/vendors/font-awesome/css/font-awesome.min.css') }}" />

        <link rel="stylesheet" href="{{ asset('company_dashboard/assets/css/company/style.css') }}" />
        <!-- End layout styles -->
        <link rel="shortcut icon" href="{{ asset('company_dashboard/assets/images/favicon.png') }}" />
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    </head>
    @yield('head')

    <body>
        <div class="container-scroller">
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item nav-profile border-bottom">
                        <a href="#" class="nav-link flex-column">
                            <div class="nav-profile-image">
                                <img src="{{ asset('company_dashboard/assets/images/faces/face1.jpg') }}"
                                    alt="profile" />
                                <!--change to offline or busy as needed-->
                            </div>
                            <div class="nav-profile-text d-flex ml-0 mb-3 flex-column">
                                <span class="font-weight-semibold mb-1 mt-2 text-center">
                                    {{ Auth::user()->name }}</span>

                            </div>
                        </a>
                    </li>
                    <li class="nav-item pt-3">
                        <a class="nav-link d-block" href="{{ route('company.dashboard') }}">
                            <img class="sidebar-brand-logo"
                                src="{{ asset('company_dashboard/assets/images/logo.svg') }}" alt="" />


                        </a>
                        <form class="d-flex align-items-center" action="#">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <i class="input-group-text border-0 mdi mdi-magnify"></i>
                                </div>
                                <input type="text" class="form-control border-0" placeholder="Search" />
                            </div>
                        </form>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('company.dashboard') }}">
                            <i class="mdi mdi-compass-outline menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('departments.index') }}">
                            <i class="mdi mdi-contacts menu-icon"></i>
                            <span class="menu-title">Department</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('employees.index') }}">
                            <i class="mdi mdi-contacts menu-icon"></i>
                            <span class="menu-title">Employees</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('shifts.index') }}">
                            <i class="mdi mdi-contacts menu-icon"></i>
                            <span class="menu-title">Shifts</span>
                        </a>
                    </li>

                </ul>
            </nav>
            <!-- partial -->
            <div class="container-fluid page-body-wrapper">
                <!-- partial:partials/_settings-panel.html -->
                <div id="settings-trigger"><i class="mdi mdi-settings"></i></div>
                <div id="theme-settings" class="settings-panel">
                    <i class="settings-close mdi mdi-close"></i>
                    <p class="settings-heading">SIDEBAR SKINS</p>
                    <div class="sidebar-bg-options selected" id="sidebar-default-theme">
                        <div class="img-ss rounded-circle bg-light border mr-3"></div>Default
                    </div>
                    <div class="sidebar-bg-options" id="sidebar-dark-theme">
                        <div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark
                    </div>
                    <p class="settings-heading mt-2">HEADER SKINS</p>
                    <div class="color-tiles mx-0 px-4">
                        <div class="tiles default primary"></div>
                        <div class="tiles success"></div>
                        <div class="tiles warning"></div>
                        <div class="tiles danger"></div>
                        <div class="tiles info"></div>
                        <div class="tiles dark"></div>
                        <div class="tiles light"></div>
                    </div>
                </div>
                <!-- partial -->
                <!-- partial:partials/_navbar.html -->
                <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
                    <div class="navbar-menu-wrapper d-flex align-items-stretch">
                        <button class="navbar-toggler navbar-toggler align-self-center" type="button"
                            data-toggle="minimize">
                            <span class="mdi mdi-chevron-double-left"></span>
                        </button>
                        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                            <a class="navbar-brand brand-logo-mini"
                                href="{{ route('company.dashboard') }}"><img
                                    src="{{ asset('company_dashboard/assets/images/logo-mini.svg') }}"
                                    alt="logo" /></a>
                        </div>
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link" id="messageDropdown" href="#" data-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="mdi mdi-email-outline"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-left navbar-dropdown preview-list"
                                    aria-labelledby="messageDropdown">
                                    <h6 class="p-3 mb-0 font-weight-semibold">Messages</h6>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item preview-item">
                                        <div class="preview-thumbnail">
                                            <img src="{{ asset('company_dashboard/assets/images/faces/face1.jpg') }}"
                                                alt="image" class="profile-pic">
                                        </div>
                                        <div
                                            class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                            <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Mark send you
                                                a
                                                message</h6>
                                            <p class="text-gray mb-0"> 1 Minutes ago </p>
                                        </div>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item preview-item">
                                        <div class="preview-thumbnail">
                                            <img src="{{ asset('company_dashboard/assets/images/faces/face6.jpg') }}"
                                                alt="image" class="profile-pic">
                                        </div>
                                        <div
                                            class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                            <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Cregh send you
                                                a
                                                message</h6>
                                            <p class="text-gray mb-0"> 15 Minutes ago </p>
                                        </div>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item preview-item">
                                        <div class="preview-thumbnail">
                                            <img src="{{ asset('company_dashboard/assets/images/faces/face7.jpg') }}"
                                                alt="image" class="profile-pic">
                                        </div>
                                        <div
                                            class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                            <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Profile
                                                picture
                                                updated</h6>
                                            <p class="text-gray mb-0"> 18 Minutes ago </p>
                                        </div>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <h6 class="p-3 mb-0 text-center text-primary font-13">4 new messages</h6>
                                </div>
                            </li>
                            <li class="nav-item dropdown ml-3">
                                <a class="nav-link" id="notificationDropdown" href="#" data-toggle="dropdown">
                                    <i class="mdi mdi-bell-outline"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-left navbar-dropdown preview-list"
                                    aria-labelledby="notificationDropdown">
                                    <h6 class="px-3 py-3 font-weight-semibold mb-0">Notifications</h6>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item preview-item">
                                        <div class="preview-thumbnail">
                                            <div class="preview-icon bg-success">
                                                <i class="mdi mdi-calendar"></i>
                                            </div>
                                        </div>
                                        <div
                                            class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                            <h6 class="preview-subject font-weight-normal mb-0">New order received</h6>
                                            <p class="text-gray ellipsis mb-0"> 45 sec ago </p>
                                        </div>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item preview-item">
                                        <div class="preview-thumbnail">
                                            <div class="preview-icon bg-warning">
                                                <i class="mdi mdi-settings"></i>
                                            </div>
                                        </div>
                                        <div
                                            class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                            <h6 class="preview-subject font-weight-normal mb-0">Server limit reached
                                            </h6>
                                            <p class="text-gray ellipsis mb-0"> 55 sec ago </p>
                                        </div>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item preview-item">
                                        <div class="preview-thumbnail">
                                            <div class="preview-icon bg-info">
                                                <i class="mdi mdi-link-variant"></i>
                                            </div>
                                        </div>
                                        <div
                                            class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                            <h6 class="preview-subject font-weight-normal mb-0">Kevin Karvelle</h6>
                                            <p class="text-gray ellipsis mb-0"> 11:09 PM </p>
                                        </div>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <h6 class="p-3 font-13 mb-0 text-primary text-center">View all notifications</h6>
                                </div>
                            </li>
                        </ul>
                        <ul class="navbar-nav navbar-nav-right">
                            <li class="nav-item nav-logout d-none d-md-block mr-3">
                                <a class="nav-link" href="#">Status</a>
                            </li>
                            <li class="nav-item nav-logout d-none d-md-block">
                                <button class="btn btn-sm btn-danger">Trailing</button>
                            </li>
                            <li class="nav-item nav-profile dropdown d-none d-md-block">
                                <a class="nav-link dropdown-toggle" id="profileDropdown" href="#"
                                    data-toggle="dropdown" aria-expanded="false">
                                    <div class="nav-profile-text">English </div>
                                </a>
                                <div class="dropdown-menu center navbar-dropdown" aria-labelledby="profileDropdown">
                                    <a class="dropdown-item" href="#">
                                        <i class="flag-icon flag-icon-bl mr-3"></i> French </a>
                                    <div class="dropdown-divider"></div>

                                </div>
                            </li>
                            <li class="nav-item nav-logout d-none d-lg-block">
                                <a class="nav-link" href="{{ asset('company_dashboard/index.html') }}">
                                    <i class="mdi mdi-home-circle"></i>
                                </a>
                            </li>
                        </ul>
                        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                            data-toggle="offcanvas">
                            <span class="mdi mdi-menu"></span>
                        </button>
                    </div>
                </nav>
                <!-- partial -->
                <div class="main-panel">
                    <div class="content-wrapper pb-0">
                        @yield('content')
                    </div>
                    <!-- main-panel ends -->
                </div>
                <!-- page-body-wrapper ends -->
            </div>

            <script src="{{ asset('company_dashboard/assets/vendors/js/vendor.bundle.base.js') }}"></script>

            <script src="{{ asset('company_dashboard/assets/vendors/jquery-bar-rating/jquery.barrating.min.js') }}"></script>
            <script src="{{ asset('company_dashboard/assets/vendors/chart.js/Chart.min.js') }}"></script>

            <script src="{{ asset('company_dashboard/assets/js/settings.js') }}"></script>

            <script src="{{ asset('company_dashboard/assets/js/dashboard.js') }}"></script>
            <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
            @yield('scripts')
            <!-- End custom js for this page -->
    </body>

    </html>
@endif
