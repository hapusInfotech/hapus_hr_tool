@extends('layouts.common.commonUserDashboard')
@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

@endsection
@section('content')
    <div class="container d-flex flex-column justify-content-center align-items-center min-vh-100">
        <div class="card shadow-lg p-4" style="max-width: 400px; width: 100%; border-radius: 15px;">
            <div class="card-body">
                <!-- Logo or Icon (Optional) -->
                <div class="text-center mb-4">
                    <i class="fas fa-shield-alt fa-3x text-primary"></i>
                </div>

                <h3 class="text-center mb-4" style="font-family: 'Roboto', sans-serif; font-weight: 500;">
                    Enter OTP to Verify
                </h3>

                <!-- Error Message -->
                @if (session('error'))
                    <div class="alert alert-danger text-center" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="text-center mb-3">
                    <p id="countdown-timer" class="text-danger" style="font-weight: 500; font-size: 1.1rem;">
                        OTP expires in <span id="timer">05:00</span>
                    </p>
                </div>
                <!-- OTP Form -->
                <form action="{{ route('company.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="company_email" value="{{ $email }}">

                    <!-- OTP Input -->
                    <div class="mb-3">
                        <label for="otp" class="form-label" style="font-weight: 500;">Enter OTP</label>
                        <div class="input-group">
                            <span class="input-group-text bg-primary text-white">
                                <i class="fas fa-key"></i>
                            </span>
                            <input type="text" class="form-control" name="otp" id="otp" required
                                placeholder="6-digit OTP" style="border-radius: 0 15px 15px 0;">
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg" style="border-radius: 15px;">
                            <i class="fas fa-check-circle me-2"></i> Verify OTP
                        </button>
                    </div>
                </form>

                <!-- Footer (Optional) -->
                <div class="text-center mt-3">
                    <p class="text-muted" style="font-size: 0.9rem;">Didn't receive the OTP? <a href="#" class="text-primary">Resend</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
<script src="{{ asset('assets/js/otp-timer.js') }}"></script>
@endsection