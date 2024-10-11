@extends('layouts.common.commonUserDashboard')

@section('content')

<div class="container-fluid">
    <h4 class="page-title">Subscription Form</h4>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Complete the Form</div>
                </div>
                <div class="card-body">
                    <!-- Subscription Form -->
                    <form id="subscription-form" action="{{ route('razorpay.payment') }}" method="POST" data-parsley-validate>
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required data-parsley-pattern="^[a-zA-Z\s]+$" data-parsley-error-message="Please enter a valid name">
                        </div>

                        <div class="form-group">
                            <label for="company_name">Company Name</label>
                            <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Enter your company name" required data-parsley-minlength="3" data-parsley-error-message="Company name must be at least 3 characters">
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required data-parsley-type="email" data-parsley-error-message="Please enter a valid email">
                        </div>

                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea class="form-control" id="address" name="address" rows="3" placeholder="Enter your address" required data-parsley-error-message="Please enter a valid address"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter your phone number" required data-parsley-pattern="^\d{10}$" data-parsley-error-message="Please enter a valid 10-digit phone number">
                        </div>
                        <div class="form-group">
                            <label for="plan">Plan</label>
                            <input type="text" id="plan" name="plan" value="{{ $plan }}" class="form-control" readonly>
                        </div>
                        @if($plan == 'trial')

                        <div class="form-group">
                            <label for="no_of_people">Number of People</label>
                            <input type="number" class="form-control" id="no_of_people" name="no_of_people" value="{{$no_of_people}}" placeholder="Enter the number of people" required data-parsley-min="1" data-parsley-error-message="Number of people must be at least 1" readonly>
                        </div>
                        @else
                        <div class="form-group">
                            <label for="no_of_people">Number of People</label>
                            <input type="number" class="form-control" id="no_of_people" name="no_of_people" value="{{$no_of_people}}" placeholder="Enter the number of people" required data-parsley-min="1" data-parsley-error-message="Number of people must be at least 1">
                        </div>
                        @endif


                        <div class="form-group">
                            <label for="cost_per_head">Total Cost</label>
                            <input type="number" class="form-control" id="cost_per_head" name="cost_per_head" value="100" readonly>
                        </div>


                        <div class="card-action">
                            <button type="submit" class="btn btn-success">Submit</button>
                            <button type="reset" class="btn btn-danger">Cancel</button>
                        </div>
                    </form>
                    <!-- End Subscription Form -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection