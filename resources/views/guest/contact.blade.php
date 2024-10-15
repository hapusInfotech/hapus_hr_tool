@extends('layouts.guest.guest')

@section('title', 'Contact Us')

@section('head')
    <link rel="stylesheet" href="{{ asset('assets/css/guest/contact.css') }}">
@endsection

@section('content')
    <div class="container">
        <h1 class="text-center my-5">Contact Us</h1>

        <!-- Contact Form -->
        <div class="row">
            <div class="col-md-8">
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
                            data-parsley-minlength="10" data-parsley-maxlength="15" placeholder="Enter your phone number">
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea name="message" class="form-control" rows="5" required
                            data-parsley-required-message="Message is required." placeholder="Type your message..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>

            <!-- Contact Info Block -->
            <div class="col-md-4">
                <div class="p-4 bg-light rounded">
                    <h4>Our Office</h4>
                    <p>123 Hapus Street, HR City, 456789</p>
                    <p><strong>Email:</strong> support@hapushrtool.com</p>
                    <p><strong>Phone:</strong> +1 234 567 890</p>
                </div>
            </div>
        </div>

        <!-- Customer Support Section -->
        <div class="support-section py-5">
            <div class="container text-center">
                <h2>Need Help?</h2>
                <p>If you have any questions, feel free to contact our support team. We are here to help you 24/7!</p>
                <a href="mailto:support@hapushrtool.com" class="btn btn-secondary">Contact Support</a>
            </div>
        </div>

        <!-- FAQ Section -->
        <div class="faq-section py-5">
            <h2 class="text-center mb-5">Frequently Asked Questions</h2>
            <div class="row">
                <div class="col-md-6">
                    <div class="faq-item">
                        <h4>Do you offer a free trial?</h4>
                        <p>Yes, we offer a 14-day free trial for all our plans.</p>
                    </div>
                    <div class="faq-item">
                        <h4>How do I contact support?</h4>
                        <p>You can contact our support team via email at <a
                                href="mailto:support@hapushrtool.com">support@hapushrtool.com</a>.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="faq-item">
                        <h4>Can I cancel my subscription at any time?</h4>
                        <p>Yes, you can cancel your subscription anytime without any penalties.</p>
                    </div>
                    <div class="faq-item">
                        <h4>What payment methods are accepted?</h4>
                        <p>We accept major credit cards and PayPal for secure transactions.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Map Section -->
        <div class="map-section py-5">
            <h2 class="text-center mb-5">Find Us</h2>
            <div class="map-container">
                <iframe src="https://www.google.com/maps/embed?pb=..." width="100%" height="400" frameborder="0"
                    style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="{{ asset('assets/js/guest/guest_contact.js') }}"></script>
@endsection
