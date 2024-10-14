@extends('layouts.common.commonUserDashboard')
@section('head')
    <link rel="stylesheet" href="{{ asset('assets/css/trail_landing.css') }}">
@endsection
@section('content')
    <div class="first-card">
        <!-- Card Header -->
        <div class="card-header text-center p-4 bg-light">
            <p class="m-0 text-uppercase fs-6">TRIAL PLAN</p>
            <h1 class="display-4">Free</h1>
            <p class="fs-5 text-muted">Up to 10 Users</p>
        </div>

        <!-- Plan Features Section -->
        <div class="card-features p-4">
            <h2 class="text-center">What's Included</h2>
            <div class="feature-list d-flex flex-wrap justify-content-center">
                <ul class="text-start">
                    <li class="fw-bold mb-2 fs-5">Access to <span class="fw-normal">core HR management features</span></li>
                    <li class="fw-bold mb-2 fs-5">Manage <span class="fw-normal">up to 10 employees</span></li>
                    <li class="fw-bold mb-2 fs-5">Track <span class="fw-normal">attendance and leaves</span></li>
                    <li class="fw-bold mb-2 fs-5">Basic <span class="fw-normal">payroll management</span></li>
                    <li class="fw-bold mb-2 fs-5">Generate <span class="fw-normal">simple reports</span></li>
                    <li class="fw-bold mb-2 fs-5">Limited <span class="fw-normal">support</span></li>
                </ul>
            </div>
        </div>

        <!-- Highlights Section with Icons -->
        <div class="highlights-section py-5 bg-light text-center">
            <div class="container">
                <h3 class="fw-bold">Why Choose Our Trial Plan?</h3>
                <div class="row justify-content-center">
                    <div class="col-md-4 mb-4">
                        <i class="fas fa-credit-card fa-2x mb-2"></i>
                        <h5 class="fw-bold">No Credit Card Required</h5>
                        <p>Sign up without commitment.</p>
                    </div>
                    <div class="col-md-4 mb-4">
                        <i class="fas fa-clock fa-2x mb-2"></i>
                        <h5 class="fw-bold">Free for 30 Days</h5>
                        <p>Test our core features with no limits.</p>
                    </div>
                    <div class="col-md-4 mb-4">
                        <i class="fas fa-arrow-up fa-2x mb-2"></i>
                        <h5 class="fw-bold">Easy Upgrade</h5>
                        <p>Seamless transition to paid plans.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Testimonials Section -->
        <div class="testimonials py-5 text-center">
            <h3 class="fw-bold">What Our Customers Are Saying</h3>
            <div class="testimonial-cards d-flex justify-content-center">
                <div class="card mx-3 p-4">
                    <p class="fs-5 fst-italic">"This trial plan helped us organize our small team effortlessly."</p>
                    <p class="fw-bold">- John Doe, HR Manager</p>
                </div>
                <div class="card mx-3 p-4">
                    <p class="fs-5 fst-italic">"An excellent starting point for businesses wanting to try out HR management
                        tools."</p>
                    <p class="fw-bold">- Jane Smith, Business Owner</p>
                </div>
            </div>
        </div>

        <!-- FAQ Section with Accordions -->
        <div class="faq-section py-5 bg-light">
            <div class="container text-center">
                <h3 class="fw-bold">Frequently Asked Questions</h3>
                <div class="accordion mt-4" id="faqAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                How long is the trial?
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                The trial plan lasts for 30 days from the date of registration.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Do I need to provide a credit card for the trial?
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                No, we don’t require a credit card for the trial plan.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                What happens after the trial ends?
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                You can choose to upgrade to one of our paid plans or cancel your subscription.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Call-to-Action Button -->
        <div class="price-button text-center py-4">
            <a href="{{ route('subscription.trial', ['plan' => 'trial', 'no_of_ppl' => '10']) }}"
                class="btn btn-lg btn-primary">Start Free Trial</a>
        </div>

        <!-- Call-to-Action for Upgrade -->
        <div class="upgrade-info text-center py-5 bg-light">
            <h3 class="fw-bold">Looking for More?</h3>
            <p class="fs-5 text-muted">Upgrade to our premium plan to unlock advanced HR features.</p>
            <a href="{{ route('home') }}" class="btn btn-lg btn-outline-secondary">Learn More About Premium
                Plans</a>
        </div>

        <!-- Additional Visual Content: Video Demo -->
        <div class="video-demo-section py-5 text-center">
            <h3 class="fw-bold">Watch Our Product in Action</h3>
            <p>See how our HR management tool can transform your team operations.</p>
            <div class="video-embed mt-4">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/KLuTLF3x9sA?si=k-csBjyTDvl8_cAX"
                    frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
    </div>
@endsection
