@extends('layouts.common.commonUserDashboard')
@section('head')
    <link rel="stylesheet" href="{{ asset('assets/css/basic_landing.css') }}">
@endsection
@section('content')

<div class="pricing-detail">
    <div class="container-fluid">
        <span class="pricing-features-bg"></span>
        <div class="row d-flex align-items-center">
            <div class="col-md-12 col-lg-5">
                <div class="features-img d-flex justify-content-center align-items-center">
                    <h4 class="text-white text-center">Our Features includes</h4>
                </div>
            </div>
            <div class="col-md-12 col-lg-7">
                <div class="features-grid">

                    <div class="row no-gutters">
                        <div class="col-md-4 d-flex">
                            <div class="custom-card mb-4 w-100 border-0 card-first">
                                <div class="card-body">
                                    <div class="feature-one">
                                       <img src="{{ asset('assets/img/management.png')}}" alt="" width="100">

                                        <h6 class="mt-4">Access to core HR management features</h6>

                                    </div>

                                </div>
                            </div>

                        </div>
                        <div class="col-md-4 d-flex">
                            <div class="custom-card mb-4 w-100 border-0 card-second">
                                <div class="card-body">
                                    <div class="feature-one">
                                       <img src="{{ asset('assets/img/public-service.png')}}"  alt="" width="100">

                                        <h6 class="mt-4">Manage up to 10 employees</h6>

                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-4 d-flex">
                            <div class="custom-card card-third mb-4 w-100 border-0">
                                <div class="card-body">
                                    <div class="feature-one">
                                       <img src="{{ asset('assets/img/calendar (1).png')}}" alt="" width="100">

                                        <h6 class="mt-4">Track attendance and leaves</h6>

                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-4 d-flex ">

                            <div class="custom-card card-fourth mb-4 w-100 border-0">
                                <div class="card-body">
                                    <div class="feature-one ">
                                       <img src="{{ asset('assets/img/business-case.png')}}" alt="" width="100">

                                        <h6 class="mt-4">Basic payroll management</h6>

                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-4 d-flex ">

                            <div class="custom-card card-fifth mb-4 w-100 border-0">
                                <div class="card-body">
                                    <div class="feature-one ">
                                       <img src="{{ asset('assets/img/report (1).png')}}" alt="" width="100">

                                        <h6 class="mt-4">Generate simple reports</h6>

                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-4 d-flex ">

                            <div class="custom-card card-sixth mb-4 w-100 border-0">
                                <div class="card-body">
                                    <div class="feature-one ">
                                       <img src="{{ asset("assets/img/customer-service.png") }}" alt="" width="100">

                                        <h6 class="mt-4">Limited support</h6>

                                    </div>
                                </div>
                            </div>

                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>
</div>






    <div class="first-card">
        <!-- Card Header -->
        <div class="card-header text-center p-4 bg-light">
            <p class="m-0 text-uppercase fs-6">BASIC PLAN</p>
            <h1 class="display-4">$10.99/month</h1>
            <p class="fs-5 text-muted">25 Users included</p>
        </div>

        <!-- Plan Features Section -->
        <div class="card-features p-4">
            <h2 class="text-center">What's Included</h2>
            <div class="feature-list d-flex flex-wrap justify-content-center">
                <ul class="text-start">
                    <li class="fw-bold mb-2 fs-5">Manage <span class="fw-normal">up to 25 employees</span></li>
                    <li class="fw-bold mb-2 fs-5">Advanced <span class="fw-normal">HR management features</span></li>
                    <li class="fw-bold mb-2 fs-5">Attendance <span class="fw-normal">tracking and reporting</span></li>
                    <li class="fw-bold mb-2 fs-5">Payroll <span class="fw-normal">processing</span></li>
                    <li class="fw-bold mb-2 fs-5">Email <span class="fw-normal">export for reports</span></li>
                    <li class="fw-bold mb-2 fs-5">Generate <span class="fw-normal">detailed performance reviews</span></li>
                </ul>
            </div>
        </div>

        <!-- Highlights Section with Icons -->
        <div class="highlights-section py-5 bg-light text-center">
            <div class="container">
                <h3 class="fw-bold">Why Choose Our Basic Plan?</h3>
                <div class="row justify-content-center">
                    <div class="col-md-4 mb-4">
                        <i class="fas fa-users fa-2x mb-2"></i>
                        <h5 class="fw-bold">Employee Management</h5>
                        <p>Manage up to 25 employees effectively.</p>
                    </div>
                    <div class="col-md-4 mb-4">
                        <i class="fas fa-cogs fa-2x mb-2"></i>
                        <h5 class="fw-bold">Advanced HR Tools</h5>
                        <p>Unlock powerful HR features.</p>
                    </div>
                    <div class="col-md-4 mb-4">
                        <i class="fas fa-chart-line fa-2x mb-2"></i>
                        <h5 class="fw-bold">Detailed Reporting</h5>
                        <p>Track performance, attendance, and more.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Testimonials Section -->
        <div class="testimonials py-5 text-center">
            <h3 class="fw-bold">What Our Customers Are Saying</h3>
            <div class="testimonial-cards d-flex justify-content-center">
                <div class="card mx-3 p-4">
                    <p class="fs-5 fst-italic">"The Basic Plan has everything we need to manage our growing team."</p>
                    <p class="fw-bold">- Michael Lee, HR Director</p>
                </div>
                <div class="card mx-3 p-4">
                    <p class="fs-5 fst-italic">"Great features for small and medium-sized businesses at a reasonable price."
                    </p>
                    <p class="fw-bold">- Sarah Kim, CEO</p>
                </div>
            </div>
        </div>

        <!-- FAQ Section with Accordions -->
        <div class="faq-section py-5 bg-light">
            <div class="container text-center">
                <h3 class="fw-bold">Frequently Asked Questions</h3>
                <div class="accordion mt-4" id="basicFaqAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#basicCollapseOne" aria-expanded="false" aria-controls="basicCollapseOne">
                                How many users are included in the Basic Plan?
                            </button>
                        </h2>
                        <div id="basicCollapseOne" class="accordion-collapse collapse" data-bs-parent="#basicFaqAccordion">
                            <div class="accordion-body">
                                The Basic Plan includes support for up to 25 users.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#basicCollapseTwo" aria-expanded="false" aria-controls="basicCollapseTwo">
                                Can I upgrade from the Basic Plan later?
                            </button>
                        </h2>
                        <div id="basicCollapseTwo" class="accordion-collapse collapse" data-bs-parent="#basicFaqAccordion">
                            <div class="accordion-body">
                                Yes, you can easily upgrade to a higher plan as your business grows.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Call-to-Action Button -->
        <div class="price-button text-center py-4">
            <a href="{{ route('subscription.basic', ['plan' => 'basic', 'no_of_ppl' => 25]) }}"
                class="btn btn-lg btn-primary">Get Started</a>
        </div>

        <!-- Call-to-Action for Upgrade -->
        <div class="upgrade-info text-center py-5 bg-light">
            <h3 class="fw-bold">Need More Features?</h3>
            <p class="fs-5 text-muted">Upgrade to our premium plan for even more advanced tools and unlimited users.</p>
            <a href="{{ route('home') }}" class="btn btn-lg btn-outline-secondary">Explore Premium Plans</a>
        </div>

        <!-- Additional Visual Content: Video Demo -->
        <div class="video-demo-section py-5 text-center">
            <h3 class="fw-bold">Watch How It Works</h3>
            <p>Learn how the Basic Plan can streamline your HR management tasks.</p>
            <div class="video-embed mt-4">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/KLuTLF3x9sA?si=k-csBjyTDvl8_cAX" frameborder="0"
                    allowfullscreen></iframe>
            </div>
        </div>
    </div>
@endsection
