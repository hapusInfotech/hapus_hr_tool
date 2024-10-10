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
                <button class="navbar-toggler sidenav-toggler ml-auto" type="button"
                    data-toggle="collapse" data-target="collapse" aria-controls="sidebar"
                    aria-expanded="false" aria-label="Toggle navigation">
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
                                            <div class="notif-icon notif-primary"> <i class="la la-user-plus"></i> </div>
                                            <div class="notif-content">
                                                <span class="block">New user registered</span>
                                                <span class="time">5 minutes ago</span>
                                            </div>
                                        </a>
                                        <a href="#">
                                            <div class="notif-icon notif-success"> <i class="la la-comment"></i> </div>
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
                                            <div class="notif-icon notif-danger"> <i class="la la-heart"></i> </div>
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
                                        <div class="u-img"><img src="assets/img/profile.jpg" alt="user"></div>
                                        <div class="u-text">
                                            <h4>{{ Auth::user()->name }}</h4>
                                            <a href="profile.html" class="btn btn-rounded btn-danger btn-sm">View Profile</a>
                                        </div>
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
                        <a href="index.html"><i class="la la-dashboard"></i><p>Dashboard</p><span class="badge badge-count">5</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="forms.html"><i class="la la-keyboard-o"></i><p>Forms</p><span class="badge badge-count">50</span></a>
                    </li>
                    <li class="nav-item update-pro">
                        <button data-toggle="modal" data-target="#modalUpdate"><i class="la la-hand-pointer-o"></i><p>Update To Pro</p></button>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-panel">
        <div class="content">
            <div class="container-fluid">
                <h4 class="page-title">Subscription Form</h4>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Complete the Form</div>
                            </div>
                            <div class="card-body">
                                <!-- Subscription Form -->
                                <form id="subscription-form" action="{{ route('razorpay.payment') }}" method="POST" data-parsley-validate>
                                        @csrf
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required data-parsley-pattern="^[a-zA-Z\s]+$" data-parsley-error-message="Please enter a valid name">
                                        </div>

                                        <div class="form-group">
                                            <label for="company_name">Company Name</label>
                                            <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Enter your company name" required data-parsley-minlength="3" data-parsley-error-message="Company name must be at least 3 characters">
                                        </div>

                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required data-parsley-type="email" data-parsley-error-message="Please enter a valid email">
                                        </div>

                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <textarea class="form-control" id="address" name="address" rows="3" placeholder="Enter your address" required data-parsley-error-message="Please enter a valid address"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="phone">Phone Number</label>
                                            <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter your phone number" required data-parsley-pattern="^\d{10}$" data-parsley-error-message="Please enter a valid 10-digit phone number">
                                        </div>
                                        <div class="form-group">
        <label for="plan">Plan</label>
        <input type="text" id="plan" name="plan" value="{{ $plan }}" class="form-control" readonly>
    </div>
    @if($plan == 'trial')
         
    <div class="form-group">
        <label for="no_of_people">Number of People</label>
        <input type="number" class="form-control" id="no_of_people" name="no_of_people" value="{{$no_of_people}}" placeholder="Enter the number of people" required data-parsley-min="1" data-parsley-error-message="Number of people must be at least 1" readonly >
    </div>
    @else
    <div class="form-group">
        <label for="no_of_people">Number of People</label>
        <input type="number" class="form-control" id="no_of_people" name="no_of_people" value="{{$no_of_people}}" placeholder="Enter the number of people" required data-parsley-min="1" data-parsley-error-message="Number of people must be at least 1" >
    </div>
    @endif
  

<div class="form-group">
    <label for="cost_per_head">Total Cost</label>
    <input type="number" class="form-control" id="cost_per_head" name="cost_per_head" value="100" readonly>
</div>


                                        <div class="card-action">
                                            <button type="submit" class="btn btn-success">Submit</button>
                                            <button type="reset" class="btn btn-danger">Cancel</button>
                                        </div>
                                    </form>
                                <!-- End Subscription Form -->
                            </div>
                        </div>
                    </div>
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
  

    <script src="{{ asset('assets/js/ready.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/lib/plugin/parsley/js/parsley.min.js') }}"></script>
   
    <script src="{{ asset('assets/js/subscription/form/custom.js') }}"></script>
</body>
</html>
@else
   <script>
    location.href = '/';
   </script>
@endif