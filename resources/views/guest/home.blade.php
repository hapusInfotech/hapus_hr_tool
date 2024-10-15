@extends('layouts.guest.guest')

@section('title', 'Home')
@section('head')

    <link rel="stylesheet" href="{{ asset('assets/css/guest/home.css') }}">

@endsection

@section('content')
    <!-- Banner Section -->
    <section class="banner text-center text-dark">
        <div class="container">
            <h1>Welcome to Hapus HR Tool</h1>
            <p class="lead">Streamline your HR processes with ease.</p>
            <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Get Started</a>
        </div>
    </section>

    <!-- About Us Section -->
    <section class="about-us">
        <div class="container">
            <h2 class="section-title text-center">About Us</h2>
            <p class="text-center">Hapus HR Tool is designed to simplify and automate your HR operations, helping businesses
                of all sizes to manage employees, track performance, and handle payroll with ease.</p>
        </div>
    </section>

    <!-- Tools Features Section -->
    <section class="features">
        <div class="container">
            <h2 class="section-title text-center">Our Tools Features</h2>
            <div class="row text-center">
                <div class="col-md-4 mb-4">
                    <div class="feature-box">
                        <h4>Employee Management</h4>
                        <p>Keep track of employee details, leave, and attendance.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="feature-box">
                        <h4>Payroll Automation</h4>
                        <p>Automate salary calculations and generate payroll reports.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="feature-box">
                        <h4>Performance Tracking</h4>
                        <p>Monitor employee performance and set key milestones.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials">
        <div class="container">
            <h2 class="section-title text-center">What Our Clients Say</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <p>"Hapus HR Tool has transformed how we manage our workforce. It's user-friendly and
                                efficient!"</p>
                            <h5 class="card-title">John Doe</h5>
                            <p class="card-text">CEO, XYZ Company</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <p>"Payroll management has never been easier. I highly recommend this tool!"</p>
                            <h5 class="card-title">Jane Smith</h5>
                            <p class="card-text">HR Manager, ABC Corp</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <p>"Our performance tracking process has improved significantly. Thank you, Hapus HR Tool!"</p>
                            <h5 class="card-title">Mike Johnson</h5>
                            <p class="card-text">CTO, Tech Solutions</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact">
        <div class="container">
            <h2 class="section-title text-center">Get in Touch</h2>
            <div class="row">
                <div class="col-md-6 offset-md-3">

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('contact.submit') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" required
                                data-parsley-required-message="Name is required." placeholder="Enter your name">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required data-parsley-type="email"
                                data-parsley-required-message="A valid email is required." placeholder="Enter your email">
                        </div>
                        <div class="mb-3">
                            <label for="mobile_no" class="form-label">Phone No</label>
                            <input type="text" name="mobile_no" class="form-control" id="mobile_no" required
                                data-parsley-required-message="Phone number is required." data-parsley-type="digits"
                                data-parsley-minlength="10" data-parsley-maxlength="15"
                                placeholder="Enter your phone number">
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea name="message" class="form-control" rows="5" required
                                data-parsley-required-message="Message is required." placeholder="Type your message..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="{{ asset('assets/js/guest/guest_contact.js') }}"></script>
@endsection
