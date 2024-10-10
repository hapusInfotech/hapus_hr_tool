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
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="{{ asset('assets/css/ready.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">

</head>
<script>
    var isLoggedIn = {{ auth()->check() ? 'true' : 'false' }};
</script>

<body>
    <div class="wrapper subscription">
        <!-- Navbar -->
        <div class="main-header">
            <div class="logo-header">
                <a href="{{ Auth::check() ? url('/home') : url('/') }}" class="logo text-decoration-none">
                    {{ config('app.name') }}
                </a>
                <button class="navbar-toggler sidenav-toggler ml-auto" type="button"
                    data-toggle="collapse" data-target="collapse" aria-controls="sidebar"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <button class="topbar-toggler more"><i class="la la-ellipsis-v"></i></button>
            </div>
            <nav class="navbar navbar-header navbar-expand-lg">
                <div class="container-fluid">
                    <form class="navbar-left navbar-form nav-search mr-md-3">
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
                        <li class="nav-item dropdown hidden-caret">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="la la-bell"></i>
                                <span class="notification">3</span>
                            </a>
                            <ul class="dropdown-menu notif-box" aria-labelledby="navbarDropdown">
                                <li>
                                    <div class="dropdown-title">You have 4 new notifications</div>
                                </li>
                                <li>
                                    <div class="notif-center">
                                        <a href="#">
                                            <div class="notif-icon notif-primary"><i class="la la-user-plus"></i></div>
                                            <div class="notif-content">
                                                <span class="block">New user registered</span>
                                                <span class="time">5 minutes ago</span>
                                            </div>
                                        </a>
                                        <a href="#">
                                            <div class="notif-icon notif-success"><i class="la la-comment"></i></div>
                                            <div class="notif-content">
                                                <span class="block">Rahmad commented on Admin</span>
                                                <span class="time">12 minutes ago</span>
                                            </div>
                                        </a>
                                        <a href="#">
                                            <div class="notif-img">
                                                <img src="assets/img/profile2.jpg" alt="Img Profile">
                                            </div>
                                            <div class="notif-content">
                                                <span class="block">Reza sent messages to you</span>
                                                <span class="time">12 minutes ago</span>
                                            </div>
                                        </a>
                                        <a href="#">
                                            <div class="notif-icon notif-danger"><i class="la la-heart"></i></div>
                                            <div class="notif-content">
                                                <span class="block">Farrah liked Admin</span>
                                                <span class="time">17 minutes ago</span>
                                            </div>
                                        </a>
                                    </div>
                                </li>
                                <li>
                                    <a class="see-all" href="javascript:void(0);"><strong>See all notifications</strong> <i class="la la-angle-right"></i></a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                                <img src="assets/img/profile.jpg" alt="user-img" width="36" class="img-circle">
                                <span>{{ Auth::user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li class="user-box">
                                    <div class="u-img"><img src="assets/img/profile.jpg" alt="user"></div>
                                    <div class="u-text">
                                        <h4>{{ Auth::user()->name }}</h4>
                                        <a href="profile.html" class="btn btn-rounded btn-danger btn-sm">View Profile</a>
                                    </div>
                                </li>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#"><i class="ti-user"></i> My Profile</a>
                                <a class="dropdown-item" href="#"><i class="ti-email"></i> Inbox</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>

        <!-- Sidebar -->
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
                        <a href="index.html"><i class="la la-dashboard"></i><p>Dashboard</p><span class="badge badge-count">5</span></a>
                    </li>
                </ul>
            </div>
        </div>

    </div>

    <!-- Main Content -->
    <div class="container mt-5">
        <!-- User Details Section -->
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header bg-primary text-white text-center">
                        <h4>User Details</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6><strong>Name:</strong></h6>
                                <p>{{ Auth::user()->name }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6><strong>Email:</strong></h6>
                                <p>{{ Auth::user()->email }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6><strong>Phone:</strong></h6>
                                <p>{{ $phone }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6><strong>Company Name:</strong></h6>
                                <p>{{ $company_name }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6><strong>Number of People:</strong></h6>
                                <p> {{ $no_of_people }}</p>
                            </div>
                            <div class="col-md-6">
                                <p>Total Amount: {{ $currency_symbol }}{{ number_format($amount / 100, 2) }} {{ $currency }}</p>

                                <!--<h6><strong>Total Amount:</strong></h6>
                                <p id="total_amount"> $cost_per_head }}</p>
                                -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Section -->
        <div class="row mt-5">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header bg-success text-white text-center">
                        <h4>Payment Information</h4>
                    </div>
                    <div class="card-body">
                        <form action="/capture-payment" method="POST" id="paymentForm">
                            @csrf
                            <!-- Generate Unique Order ID -->
                            @php
                                $order_id = uniqid('order_');
                            @endphp
                            <input type="hidden" name="order_id" id="order_id" value="{{ $order_id }}">
                            <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
                            <input type="hidden" name="subscription_id" id="subscription_id" value="{{ $subscription ? $subscription->id : '' }}">

                            <input type="hidden" name="amount" id="amount" value="{{ $amount }}"> 
                            <input type="hidden" name="currency" id="currency" value="{{ $currency }}">
                            <input type="hidden" name="company_name" id="company_name" value="{{ $company_name }}">
                            <input type="hidden" name="name" id="name" value="{{ $name }}">
                            <input type="hidden" name="email" id="email" value="{{ $email }}">
                            <input type="hidden" name="phone" id="phone" value="{{ $phone }}">
                            <input type="hidden" id="plan" name="plan" value="{{ $plan }}" class="form-control" readonly>
                            @if($plan == 'trial')
                            <!-- Show button for subscription payment (auto-debit) -->
                            <button type="button" id="payBtn" class="btn btn-primary btn-block">Pay for Trial (Auto-debit)</button>
                        @else
                            <!-- Show button for one-time payment -->
                            <button type="button" id="payBtn" class="btn btn-primary btn-block">Pay Now</button>
                        @endif
                        
                            <button type="button" id="cancel-pay" class="btn btn-danger">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/lib/core/jquery.3.2.1.min.js') }}"></script>
    <script src="{{ asset('assets/lib/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/lib/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/lib/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/lib/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('assets/lib/plugin/bootstrap-toggle/bootstrap-toggle.min.js') }}"></script>
    <script src="{{ asset('assets/lib/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

    <!-- Razorpay Scripts -->
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script src="{{ asset('assets/js/subscription/payment.js') }}"></script>

</body>
</html>
@else
   <script>
    location.href = '/';
   </script>
@endif
