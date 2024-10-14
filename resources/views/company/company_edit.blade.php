@extends('layouts.common.commonUserDashboard')
@section('content')
<div class="container">
    <h2>Edit Company</h2>
    <!-- Hidden fields to store the selected country and state -->
    <input type="hidden" id="selectedCountry" value="{{ $country }}">
    <input type="hidden" id="selectedState" value="{{ $state }}">

    <!-- Display validation errors if any -->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <!-- Edit Company form -->
    <!-- Edit Company form -->
    <form action="{{ route('company.company_update', $company->id) }}" method="POST" data-parsley-validate>
        @csrf
        @method('PUT')
        <!-- This ensures a PUT request is made -->

        <div class="row">
            <!-- Company Name -->
            <div class="col-md-6 mb-3">
                <label for="company_name" class="form-label">Company Name</label>
                <input type="text" class="form-control" id="company_name" name="company_name" value="{{ old('company_name', $company->company_name) }}" required data-parsley-required-message="Company name is required.">
            </div>

            <!-- Company Type -->
            <div class="col-md-6 mb-3">
                <label for="company_type" class="form-label">Company Type</label>
                <input type="text" class="form-control" id="company_type" name="company_type" value="{{ old('company_type', $company->company_type) }}" required data-parsley-required-message="Company type is required.">
            </div>

            <!-- Company Email -->
            <div class="col-md-6 mb-3">
                <label for="company_email" class="form-label">Company Email</label>
                <input type="email" class="form-control" id="company_email" name="company_email" value="{{ old('company_email', $company->company_email) }}" required data-parsley-type="email" data-parsley-required-message="A valid email is required.">
            </div>

            <!-- Company Phone Number -->
            <div class="col-md-6 mb-3">
                <label for="company_phone_number" class="form-label">Company Phone Number</label>
                <input type="text" class="form-control" id="company_phone_number" name="company_phone_number" value="{{ old('company_phone_number', $company->company_phone_number) }}" required data-parsley-type="digits" data-parsley-required-message="Phone number is required." data-parsley-minlength="10" data-parsley-maxlength="15">
            </div>

            <!-- Address Line 1 -->
            <div class="col-md-6 mb-3">
                <label for="company_address_line_1" class="form-label">Address Line 1</label>
                <input type="text" class="form-control" id="company_address_line_1" name="company_address_line_1" value="{{ old('company_address_line_1', $company_address_line_1) }}" required data-parsley-required-message="Address Line 1 is required.">
            </div>

            <!-- Address Line 2 -->
            <div class="col-md-6 mb-3">
                <label for="company_address_line_2" class="form-label">Address Line 2</label>
                <input type="text" class="form-control" id="company_address_line_2" name="company_address_line_2" value="{{ old('company_address_line_2', $company_address_line_2) }}">
            </div>

            <!-- City -->
            <div class="col-md-6 mb-3">
                <label for="city" class="form-label">City</label>
                <input type="text" class="form-control" id="city" name="city" value="{{ old('city', $city) }}" required data-parsley-required-message="City is required.">
            </div>

            <!-- Country -->
            <div class="col-md-6 mb-3">
                <label for="country" class="form-label">Country</label>
                <select class="form-control" id="country" name="country" required data-parsley-required-message="Country is required.">
                    <option value="">Select Country</option>
                    <!-- Dynamic country options -->
                </select>
            </div>

            <!-- State -->
            <div class="col-md-6 mb-3">
                <label for="state" class="form-label">State</label>
                <select class="form-control" id="state" name="state" required data-parsley-required-message="State is required.">
                    <option value="">Select State</option>
                    <!-- Dynamic state options -->
                </select>
            </div>

            <!-- Pincode -->
            <div class="col-md-6 mb-3">
                <label for="company_pincode" class="form-label">Pincode</label>
                <input type="text" class="form-control" id="company_pincode" name="company_pincode" value="{{ old('company_pincode', $company_pincode) }}" required data-parsley-type="digits" data-parsley-required-message="Pincode is required." data-parsley-minlength="6" data-parsley-maxlength="6">
            </div>

            <!-- Hidden fields for Country and State Names -->
            <input type="hidden" id="country_name" name="country_name" value="{{ $country_name }}">
            <input type="hidden" id="state_name" name="state_name" value="{{ $state_name }}">

            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
    </form>

</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script src="{{ asset('assets/js/company/company_edit.js') }}"></script> <!-- Adjust script path -->
@endsection
