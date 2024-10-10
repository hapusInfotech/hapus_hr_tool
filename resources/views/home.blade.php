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

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


    <!-- Styles -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="{{ asset('assets/css/ready.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    <div class="wrapper">
        <div class="main-header">
            <div class="logo-header">
                <a href="{{ Auth::check() ? url('/home') : url('/') }}" class="logo text-decoration-none">
                    {{ config('app.name') }}
                </a>
                <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse"
                    data-target="collapse" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
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
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                            <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"
                                aria-expanded="false">
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

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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
                        <img src="assets/img/profile.jpg">
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
                        <a href="/"><i class="la la-dashboard"></i>
                            <p>Dashboard</p><span class="badge badge-count">5</span>
                        </a>
                    </li>

                    <li class="nav-item update-pro">
                        <button data-toggle="modal" data-target="#modalUpdate"><i class="la la-hand-pointer-o"></i>
                            <p>Update To Pro</p>
                        </button>
                    </li>
                </ul>
            </div>
        </div>

        <div class="main-panel">
            <div class="content">


                <div class="pricing-plans">

                    <div class="container">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="pricing-wrapper second-section z-1 position-relative">
                                    <div class="last-card"></div>
                                    <div class="first-card">
                                        <div class="card-content text-center">
                                            <p class="m-0">TRAIL</p>
                                            <h1 class="">Free</h1>
                                            <p class="">10 Users included</p>
                                        </div>
                                        <div class="card-list d-flex justify-content-center">
                                            <ul>
                                                <li class="fw-bold mb-2 fs-5">All courses<span class="fw-normal"> and
                                                        videos</span>
                                                </li>
                                                <li class="fw-bold  mb-2 fs-5">Source files,<span class="fw-normal">
                                                        ePub</span></li>
                                                <li class="fw-bold  mb-2 fs-5">Certificates<span class="fw-normal">
                                                        Tests</span></li>
                                                <li class="fw-bold  mb-2 fs-5">Premium <span class="fw-normal">
                                                        tutorials</span></li>

                                                <li class="fw-bold  mb-2 fs-5">UI <span class="fw-normal"> icons,
                                                        illustrations</span>
                                                </li>

                                                <li class="fw-bold  mb-2 fs-5">Commercial <span class="fw-normal">
                                                        use</span></li>

                                            </ul>
                                        </div>
                                        <div class="price-button d-flex justify-content-center">
                                            <a href="{{ route('subscription.trial', ['plan' => 'trial', 'no_of_ppl' => '10']) }}"
                                                class="btn btn-lg btn-primary">Get Started</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="pricing-wrapper second-section second z-1 position-relative">
                                    <div class="last-card"></div>
                                    <div class="first-card">
                                        <div class="card-content text-center">
                                            <p class="m-0">BASIC</p>
                                            <h1 class="">$9.99/month</h1>
                                            <p class="">30 Users included</p>
                                        </div>
                                        <div class="card-list d-flex justify-content-center">
                                            <ul>
                                                <li class="fw-bold mb-2 fs-5">All courses<span class="fw-normal"> and
                                                        videos</span>
                                                </li>
                                                <li class="fw-bold  mb-2 fs-5">Source files,<span class="fw-normal">
                                                        ePub</span></li>
                                                <li class="fw-bold  mb-2 fs-5">Certificates<span class="fw-normal">
                                                        Tests</span></li>
                                                <li class="fw-bold  mb-2 fs-5">Premium <span class="fw-normal">
                                                        tutorials</span></li>

                                                <li class="fw-bold  mb-2 fs-5">UI <span class="fw-normal"> icons,
                                                        illustrations</span>
                                                </li>

                                                <li class="fw-bold  mb-2 fs-5">Commercial <span class="fw-normal">
                                                        use</span></li>

                                            </ul>
                                        </div>
                                        <div class="price-button d-flex justify-content-center">
                                            <a href="{{ route('subscription.basic', ['plan' => 'basic', 'no_of_ppl' => 25]) }}"
                                                class="btn btn-lg btn-primary">Get Started</a>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="pricing-wrapper second-section third z-1 position-relative">
                                    <div class="last-card"></div>
                                    <div class="first-card">
                                        <div class="card-content text-center">
                                            <p class="m-0">TRAIL</p>
                                            <h1 class="">Free</h1>
                                            <p class="">10 members included</p>
                                        </div>
                                        <div class="card-list d-flex justify-content-center">
                                            <ul>
                                                <li class="fw-bold mb-2 fs-5">All courses<span class="fw-normal"> and
                                                        videos</span>
                                                </li>
                                                <li class="fw-bold  mb-2 fs-5">Source files,<span class="fw-normal">
                                                        ePub</span></li>
                                                <li class="fw-bold  mb-2 fs-5">Certificates<span class="fw-normal">
                                                        Tests</span></li>
                                                <li class="fw-bold  mb-2 fs-5">Premium <span class="fw-normal">
                                                        tutorials</span></li>

                                                <li class="fw-bold  mb-2 fs-5">UI <span class="fw-normal"> icons,
                                                        illustrations</span>
                                                </li>

                                                <li class="fw-bold  mb-2 fs-5">Commercial <span class="fw-normal">
                                                        use</span></li>

                                            </ul>
                                        </div>
                                        <div class="price-button d-flex justify-content-center">
                                            <a href="{{ route('subscription.trial', ['plan' => 'trial', 'no_of_ppl' => '10']) }}"
                                                class="btn btn-lg btn-primary">Get Started</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="container-fluid">
                    <!--   <h4 class="page-title">Dashboard</h4> -->

                    <!-- Pricing Section -->
                    <i class="background"></i>
                    <!-- Combined Subscription Plans Section -->
                    <!-- Combined Subscription Plans Section -->
                    <section class="subscription-plans-section">
                        <div class="container-fluid">


                            <!-- Bootstrap Notify Alerts -->
                            @if (Session::has('success'))
                                <script type="text/javascript">
                                    $.notify({
                                        message: "{{ Session::get('success') }}"
                                    }, {
                                        type: 'success',
                                        delay: 5000,
                                        placement: {
                                            from: "top",
                                            align: "right"
                                        },
                                    });
                                </script>
                            @endif

                            @if (Session::has('error'))
                                <script type="text/javascript">
                                    $.notify({
                                        message: "{{ Session::get('error') }}"
                                    }, {
                                        type: 'danger',
                                        delay: 5000,
                                        placement: {
                                            from: "top",
                                            align: "right"
                                        },
                                    });
                                </script>
                            @endif

                            @if (Session::has('warning'))
                                <script type="text/javascript">
                                    $.notify({
                                        message: "{{ Session::get('warning') }}"
                                    }, {
                                        type: 'warning',
                                        delay: 5000,
                                        placement: {
                                            from: "top",
                                            align: "right"
                                        },
                                    });
                                </script>
                            @endif

                            <div class="container">
                              

                                <!-- Plan Details Section -->
                                <div class="row mt-5">
                                    <!-- Trial Plan Details -->
                                    <div class="col-sm-6">
                                        <div class="plan-details trial-details p-4 shadow-sm rounded">
                                            <h3 class="text-center mb-4">Trial Subscription Plan Details</h3>
                                            <p class="text-muted text-center">
                                                The <strong>Trial</strong> plan is a risk-free opportunity to test our
                                                HR tool for <strong>14 days</strong>. You can register up to <strong>10
                                                    users</strong> and access essential features that are perfect for
                                                getting started and exploring the platform.
                                            </p>
                                            <ul>
                                                <li><strong>10 Users:</strong> Suitable for small teams or groups
                                                    testing the system.</li>
                                                <li><strong>1 GB RAM:</strong> Provides enough power to handle light
                                                    applications and basic operations.</li>
                                                <li><strong>20 GB Storage:</strong> Ideal for storing initial data,
                                                    files, and projects while exploring the system.</li>
                                                <li><strong>5 Email Accounts:</strong> Set up a few key email accounts
                                                    for communication and management during the trial period.</li>
                                                <li><strong>Limited Support:</strong> During the trial, access to basic
                                                    support for resolving minor issues or queries.</li>
                                            </ul>
                                            <p class="text-muted text-center">
                                                This plan is perfect for small teams who want to experience our HR
                                                platform's core functionalities without any financial commitment. After
                                                the trial, you can upgrade to a paid plan for full access.
                                            </p>
                                            <div class="text-center">
                                                <a href="{{ route('subscription.trial', ['plan' => 'trial', 'no_of_ppl' => '10']) }}"
                                                    class="btn btn-lg btn-success">Start Free Trial</a>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Basic Plan Details -->
                                    <div class="col-sm-6">
                                        <div class="plan-details basic-details p-4 shadow-sm rounded">
                                            <h3 class="text-center mb-4">Basic Subscription Plan Details</h3>
                                            <p class="text-muted text-center">
                                                The <strong>Basic</strong> plan is designed for small to medium-sized
                                                teams. For just <strong>$9.99/month</strong>, you get access to all the
                                                essential features needed to manage your team effectively, with support
                                                for up to <strong>30 users</strong>.
                                            </p>
                                            <ul>
                                                <li><strong>30 Users:</strong> Ideal for small to medium teams, with
                                                    sufficient capacity for managing multiple employees or team members.
                                                </li>
                                                <li><strong>2 GB RAM:</strong> Power to handle more complex applications
                                                    and tasks, perfect for growing teams.</li>
                                                <li><strong>40 GB Storage:</strong> Store important files, documents,
                                                    and data securely with adequate storage space.</li>
                                                <li><strong>10 Email Accounts:</strong> Manage email communication more
                                                    effectively with up to 10 email addresses.</li>
                                                <li><strong>Limited Support:</strong> Gain access to essential support,
                                                    ensuring smooth operations and troubleshooting.</li>
                                            </ul>
                                            <p class="text-muted text-center">
                                                This plan is perfect for businesses looking for a cost-effective
                                                solution to manage their teams, data, and internal communications
                                                without compromising on key functionalities.
                                            </p>
                                            <div class="text-center">
                                                <a href="{{ route('subscription.basic', ['plan' => 'basic', 'no_of_ppl' => 25]) }}"
                                                    class="btn btn-lg btn-primary">Get Started with Basic</a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </section>



                    <!-- End Pricing Section -->




                </div>
            </div>
        </div>
    </div>


    <!-- Scripts -->
    <script src="{{ asset('assets/lib/core/jquery.3.2.1.min.js') }}"></script>
    <script src="{{ asset('assets/lib/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/lib/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/lib/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/lib/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('assets/lib/plugin/bootstrap-toggle/bootstrap-toggle.min.js') }}"></script>
    <script src="{{ asset('assets/lib/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>


    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>



    <script src="{{ asset('assets/js/ready.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>
