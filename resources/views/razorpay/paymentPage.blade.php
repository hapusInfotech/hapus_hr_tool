@extends('layouts.common.commonUserDashboard')

@section('content')
<!-- Main Content -->
<div class="container mt-5">
    <!-- User Details Section -->
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header bg-primary text-white text-center">
                    <h4>User Details</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6><strong>Name:</strong></h6>
                            <p>{{ Auth::user()->name }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6><strong>Email:</strong></h6>
                            <p>{{ Auth::user()->email }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6><strong>Phone:</strong></h6>
                            <p>{{ $phone }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6><strong>Company Name:</strong></h6>
                            <p>{{ $company_name }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6><strong>Number of People:</strong></h6>
                            <p> {{ $no_of_people }}</p>
                        </div>
                        <div class="col-md-6">
                            <p>Total Amount: {{ $currency_symbol }}{{ number_format($amount / 100, 2) }} {{ $currency }}</p>

                            <!--<h6><strong>Total Amount:</strong></h6>
                                <p id="total_amount"> $cost_per_head }}</p>
                                -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Section -->
    <div class="row mt-5">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header bg-success text-white text-center">
                    <h4>Payment Information</h4>
                </div>
                <div class="card-body">
                    <form action="/capture-payment" method="POST" id="paymentForm">
                        @csrf
                        <!-- Generate Unique Order ID -->
                        @php
                        $order_id = uniqid('order_');
                        @endphp

                        <input type="hidden" name="order_id" id="order_id" value="{{ $order_id }}">
                        <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
                        @if($plan == 'trial')

                        <input type="hidden" name="subscription_id" id="subscription_id" value="{{ $subscription ? $subscription->id : '' }}">
                        @else
                        <input type="hidden" name="subscription_id" id="subscription_id" value="{{ $order ? $order->id : '' }}">
                        @endif


                        <input type="hidden" name="amount" id="amount" value="{{ $amount }}">
                        <input type="hidden" name="currency" id="currency" value="{{ $currency }}">
                        <input type="hidden" name="company_name" id="company_name" value="{{ $company_name }}">
                        <input type="hidden" name="name" id="name" value="{{ $name }}">
                        <input type="hidden" name="email" id="email" value="{{ $email }}">
                        <input type="hidden" name="phone" id="phone" value="{{ $phone }}">
                        <input type="hidden" id="plan" name="plan" value="{{ $plan }}" class="form-control" readonly>
                        @if($plan == 'trial')
                        <!-- Show button for subscription payment (auto-debit) -->
                        <button type="button" id="payBtn" class="btn btn-primary btn-block">Pay for Trial (Auto-debit)</button>
                        @else
                        <!-- Show button for one-time payment -->
                        <button type="button" id="payBtn" class="btn btn-primary btn-block">Pay Now</button>
                        @endif

                        <button type="button" id="cancel-pay" class="btn btn-danger">Cancel</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
@section('scripts')
<script>
    var isLoggedIn = {{ auth()->check() ? 'true' : 'false' }};
</script>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script src="{{ asset('assets/js/subscription/payment.js') }}"></script>
@endsection