@extends('layouts.company.login_layout')
@section('head')
<style>
    [type="checkbox"]:not(:checked), [type="checkbox"]:checked {
    position: absolute !important;
    left: 0px !important;
}
</style>
@endsection

@section('content')
    <h2 class="text-center">Company Login</h2>

    <!-- Check for session flash messages -->
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <!-- Display validation errors if any -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Login form -->
    <form method="POST" action="{{ route('company.login.submit') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required autofocus>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="remember" name="remember">
            <label class="form-check-label" for="remember">Remember Me</label>
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Login</button>
        </div>

        <!-- Forgot Password Link -->
        <div class="text-center mt-3">
            <a href="#">Forgot your password?</a>
        </div>
    </form>
@endsection
