@extends('layouts.company.login_layout')
@section('head')
@endsection

@section('content')
    <div class="container">
        <h2>Reset Password</h2>

        <form method="POST" action="{{ route('company.password.update') }}">
            @csrf

            <div class="mb-3">
                <label for="password" class="form-label">New Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                    required>
            </div>

            <button type="submit" class="btn btn-primary">Reset Password</button>
        </form>
    </div>
@endsection
