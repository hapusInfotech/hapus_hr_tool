<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/lib/plugin/parsley/css/parsley.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/ready.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    @yield('head')
</head>

<body>
    <!-- Include Navbar -->
    @include('partials.navbar')

    <div class="container-fluid">
        @yield('content')
    </div>

    <!-- Include Footer -->
    @include('partials.footer')
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

    <!-- Bootstrap 5 JS and Popper.js -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}
    <script src="{{ asset('assets/lib/plugin/parsley/js/parsley.min.js') }}"></script>
    @yield('scripts')

</body>

</html>
