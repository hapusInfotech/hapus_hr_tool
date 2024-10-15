@extends('layouts.guest.guest')

@section('title', 'Pricing')

@section('head')

    <link rel="stylesheet" href="{{ asset('assets/css/guest/pricing.css') }}">

@endsection

@section('content')
    <!-- Banner Section -->
    <section class="pricing-banner text-center text-dark">
        <div class="container">
            <h1>Pricing Plans</h1>
            <p class="lead">Choose the perfect plan for your business needs.</p>
        </div>
    </section>

    <!-- Pricing Cards Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Our Pricing Plans</h2>
            <div class="row">
                <!-- Pricing Card 1 -->
                <div class="col-md-4 mb-4">
                    <div class="pricing-card text-center">
                        <h3>Basic Plan</h3>
                        <p class="price">$19/month</p>
                        <ul class="feature-list">
                            <li><i class="fas fa-check"></i> Employee Management</li>
                            <li><i class="fas fa-check"></i> Attendance Tracking</li>
                            <li><i class="fas fa-times"></i> Payroll Automation</li>
                            <li><i class="fas fa-times"></i> Performance Reviews</li>
                        </ul>
                        <a href="{{ route('register') }}" class="btn btn-primary">Get Started</a>
                    </div>
                </div>

                <!-- Pricing Card 2 -->
                <div class="col-md-4 mb-4">
                    <div class="pricing-card text-center">
                        <h3>Standard Plan</h3>
                        <p class="price">$49/month</p>
                        <ul class="feature-list">
                            <li><i class="fas fa-check"></i> Employee Management</li>
                            <li><i class="fas fa-check"></i> Attendance Tracking</li>
                            <li><i class="fas fa-check"></i> Payroll Automation</li>
                            <li><i class="fas fa-times"></i> Performance Reviews</li>
                        </ul>
                        <a href="{{ route('register') }}" class="btn btn-primary">Get Started</a>
                    </div>
                </div>

                <!-- Pricing Card 3 -->
                <div class="col-md-4 mb-4">
                    <div class="pricing-card text-center">
                        <h3>Premium Plan</h3>
                        <p class="price">$99/month</p>
                        <ul class="feature-list">
                            <li><i class="fas fa-check"></i> Employee Management</li>
                            <li><i class="fas fa-check"></i> Attendance Tracking</li>
                            <li><i class="fas fa-check"></i> Payroll Automation</li>
                            <li><i class="fas fa-check"></i> Performance Reviews</li>
                        </ul>
                        <a href="{{ route('register') }}" class="btn btn-primary">Get Started</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Comparison Table Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Compare Our Plans</h2>
            <table class="table comparison-table">
                <thead>
                    <tr>
                        <th>Features</th>
                        <th>Basic</th>
                        <th>Standard</th>
                        <th>Premium</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Employee Management</td>
                        <td><i class="fas fa-check text-success"></i></td>
                        <td><i class="fas fa-check text-success"></i></td>
                        <td><i class="fas fa-check text-success"></i></td>
                    </tr>
                    <tr>
                        <td>Attendance Tracking</td>
                        <td><i class="fas fa-check text-success"></i></td>
                        <td><i class="fas fa-check text-success"></i></td>
                        <td><i class="fas fa-check text-success"></i></td>
                    </tr>
                    <tr>
                        <td>Payroll Automation</td>
                        <td><i class="fas fa-times text-danger"></i></td>
                        <td><i class="fas fa-check text-success"></i></td>
                        <td><i class="fas fa-check text-success"></i></td>
                    </tr>
                    <tr>
                        <td>Performance Reviews</td>
                        <td><i class="fas fa-times text-danger"></i></td>
                        <td><i class="fas fa-times text-danger"></i></td>
                        <td><i class="fas fa-check text-success"></i></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-5 faq-section">
        <div class="container">
            <h2 class="text-center mb-5">Frequently Asked Questions</h2>
            <div class="row">
                <div class="col-md-6 faq-item">
                    <h3>Is there a free trial available?</h3>
                    <p>Yes, we offer a 14-day free trial for all our plans. You can try any plan without any commitment.</p>
                </div>
                <div class="col-md-6 faq-item">
                    <h3>Can I cancel my subscription at any time?</h3>
                    <p>Yes, you can cancel your subscription at any time with no hidden fees or penalties.</p>
                </div>
                <div class="col-md-6 faq-item">
                    <h3>What payment methods do you accept?</h3>
                    <p>We accept major credit cards and PayPal for your convenience.</p>
                </div>
                <div class="col-md-6 faq-item">
                    <h3>Do you offer support?</h3>
                    <p>Yes, all our plans come with 24/7 customer support.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Customer Support Section -->
    <section class="support-section text-center">
        <div class="container">
            <h2>Need Help?</h2>
            <p>If you have any questions, feel free to contact our support team. We are here to help you 24/7!</p>
            <a href="{{ route('contact') }}" class="btn btn-primary">Contact Support</a>
        </div>
    </section>
@endsection
