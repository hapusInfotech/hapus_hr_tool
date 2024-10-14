@extends('layouts.common.commonUserDashboard')
@section('head')
    <link rel="stylesheet" href="{{ asset('assets/css/extends_basic_landing.css') }}">
@endsection
@section('content')
    <div class="first-card">
        <!-- Card Header -->
        <div class="card-header text-center p-4 bg-light">
            <p class="m-0 text-uppercase fs-6">EXTENDED BASIC PLAN</p>
            <h1 class="display-4">$25.99/month</h1>
            <p class="fs-5 text-muted">For more than 30 users</p>
        </div>

        <!-- Plan Features Section -->
        <div class="card-features p-4">
            <h2 class="text-center">What's Included</h2>
            <div class="feature-list d-flex flex-wrap justify-content-center">
                <ul class="text-start">
                    <li class="fw-bold mb-2 fs-5">Advanced HR Features<span class="fw-normal"> for managing large
                            teams</span></li>
                    <li class="fw-bold mb-2 fs-5">Manage <span class="fw-normal">more than 30 users</span></li>
                    <li class="fw-bold mb-2 fs-5">Comprehensive attendance tracking<span class="fw-normal"> and leave
                            management</span></li>
                    <li class="fw-bold mb-2 fs-5">Full payroll processing</li>
                    <li class="fw-bold mb-2 fs-5">Performance evaluations<span class="fw-normal"> and reporting tools</span>
                    </li>
                    <li class="fw-bold mb-2 fs-5">Premium support<span class="fw-normal"> for larger teams</span></li>
                </ul>
            </div>
        </div>

        <!-- Highlights Section with Icons -->
        <div class="highlights-section py-5 bg-light text-center">
            <div class="container">
                <h3 class="fw-bold">Why Choose Our Extended Basic Plan?</h3>
                <div class="row justify-content-center">
                    <div class="col-md-4 mb-4">
                        <i class="fas fa-users-cog fa-2x mb-2"></i>
                        <h5 class="fw-bold">Manage Large Teams</h5>
                        <p>Seamless management of over 30 users.</p>
                    </div>
                    <div class="col-md-4 mb-4">
                        <i class="fas fa-business-time fa-2x mb-2"></i>
                        <h5 class="fw-bold">Comprehensive Tools</h5>
                        <p>Advanced HR tools for performance tracking.</p>
                    </div>
                    <div class="col-md-4 mb-4">
                        <i class="fas fa-headset fa-2x mb-2"></i>
                        <h5 class="fw-bold">Premium Support</h5>
                        <p>Get priority support for large teams.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Testimonials Section -->
        <div class="testimonials py-5 text-center">
            <h3 class="fw-bold">What Our Customers Are Saying</h3>
            <div class="testimonial-cards d-flex justify-content-center">
                <div class="card mx-3 p-4">
                    <p class="fs-5 fst-italic">"The Extended Basic Plan gave us the scalability we needed to manage our
                        growing team."</p>
                    <p class="fw-bold">- Alex Johnson, Team Lead</p>
                </div>
                <div class="card mx-3 p-4">
                    <p class="fs-5 fst-italic">"With the advanced tools, managing attendance and payroll has never been
                        easier."</p>
                    <p class="fw-bold">- Maria Gonzales, Operations Manager</p>
                </div>
            </div>
        </div>

        <!-- FAQ Section with Accordions -->
        <div class="faq-section py-5 bg-light">
            <div class="container text-center">
                <h3 class="fw-bold">Frequently Asked Questions</h3>
                <div class="accordion mt-4" id="extendedFaqAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#extendedCollapseOne" aria-expanded="false"
                                aria-controls="extendedCollapseOne">
                                How many users can I manage with the Extended Basic Plan?
                            </button>
                        </h2>
                        <div id="extendedCollapseOne" class="accordion-collapse collapse"
                            data-bs-parent="#extendedFaqAccordion">
                            <div class="accordion-body">
                                The Extended Basic Plan is designed for teams with more than 30 users.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#extendedCollapseTwo" aria-expanded="false"
                                aria-controls="extendedCollapseTwo">
                                Can I upgrade to a higher plan?
                            </button>
                        </h2>
                        <div id="extendedCollapseTwo" class="accordion-collapse collapse"
                            data-bs-parent="#extendedFaqAccordion">
                            <div class="accordion-body">
                                Yes, you can easily upgrade to our premium plans as your team continues to grow.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Call-to-Action Button -->
        <div class="price-button text-center py-4">
            <a href="{{ route('subscription.basic', ['plan' => 'basic', 'no_of_ppl' => 30]) }}"
                class="btn btn-lg btn-primary">Get Started</a>
        </div>

        <!-- Call-to-Action for Upgrade -->
        <div class="upgrade-info text-center py-5 bg-light">
            <h3 class="fw-bold">Need More Users?</h3>
            <p class="fs-5 text-muted">Upgrade to our premium plan for unlimited users and advanced HR management tools.</p>
            <a href="{{ route('home') }}" class="btn btn-lg btn-outline-secondary">Explore Premium Plans</a>
        </div>

        <!-- Additional Visual Content: Video Demo -->
        <div class="video-demo-section py-5 text-center">
            <h3 class="fw-bold">Watch Our Product in Action</h3>
            <p>Learn how the Extended Basic Plan can help manage your team effectively.</p>
            <div class="video-embed mt-4">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/KLuTLF3x9sA?si=k-csBjyTDvl8_cAX" frameborder="0"
                    allowfullscreen></iframe>
            </div>
        </div>
    </div>
@endsection
