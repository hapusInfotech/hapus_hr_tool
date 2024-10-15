@extends('layouts.guest.guest')

@section('title', 'Free Demo')

@section('head')
    <link rel="stylesheet" href="{{ asset('assets/css/guest/demo.css') }}">
@endsection

@section('content')
<div class="container">
    <h1 class="text-center my-5">Request a Free Demo</h1>

    <!-- Introductory Block -->
    <div class="row mb-5">
        <div class="col-md-6">
            <h3>Why Choose Hapus HR Tool?</h3>
            <p>Hapus HR Tool simplifies your HR processes, offering powerful features like employee management, payroll automation, and performance tracking. Request a demo to see how it can benefit your organization.</p>
        </div>
        <div class="col-md-6">
            <img src="https://via.placeholder.com/600x400" alt="Demo Image" class="img-fluid rounded">
        </div>
    </div>

    <!-- Demo Request Form -->
    <div class="row">
        <div class="col-md-8">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('demo.submit') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" required placeholder="Enter your name">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required placeholder="Enter your email">
                </div>
                <div class="mb-3">
                    <label for="phone_number" class="form-label">Phone Number</label>
                    <input type="text" name="phone_number" class="form-control" required placeholder="Enter your phone number">
                </div>
                <div class="mb-3">
                    <label for="company" class="form-label">Company</label>
                    <input type="text" name="company" class="form-control" required placeholder="Enter your company name">
                </div>
                <div class="mb-3">
                    <label for="country" class="form-label">Country</label>
                    <input type="text" name="country" class="form-control" required placeholder="Enter your country">
                </div>
                <div class="mb-3">
                    <label for="state" class="form-label">State</label>
                    <input type="text" name="state" class="form-control" required placeholder="Enter your state">
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Message (optional)</label>
                    <textarea name="message" class="form-control" rows="5" placeholder="Your message..."></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

        <!-- Info Block -->
        <div class="col-md-4">
            <div class="p-4 bg-light rounded">
                <h4>Contact Us</h4>
                <p>If you have any questions about the demo or our tool, feel free to reach out to our team.</p>
                <p><strong>Email:</strong> demo@hapushrtool.com</p>
                <p><strong>Phone:</strong> +1 234 567 890</p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/guest/demo.js') }}"></script>
@endsection
