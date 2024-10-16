@extends('layouts.common.commonUserDashboard')
@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
    <div class="container">
        <h2>Thank You for Registering Your Company!</h2>

        <p>Your company has been successfully registered. Here are your login credentials:</p>

        <div class="alert alert-info">
            <strong>Login URL:</strong> <a href="{{ route('company.login') }}">{{ route('company.login') }}</a><br>
            <strong>Email:</strong> {{ $email }}<br>
            <strong>Password:</strong> {{ $password }}<br>
        </div>

        <p>
            Please make sure to change your password when you log in for the first time.
        </p>

        <a href="{{ route('company.login') }}" class="btn btn-primary">Go to Login Page</a>
    </div>
@endsection
