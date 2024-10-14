@extends('layouts.common.commonUserDashboard')
@section('content')
    <div class="container">
        <h2>Create Company</h2>

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

        <!-- Company form -->
        <form action="{{ route('company.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="company_name" class="form-label">Company Name</label>
                    <input type="text" class="form-control" id="company_name" name="company_name"
                        value="{{ old('company_name') }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="company_type" class="form-label">Company Type</label>
                    <input type="text" class="form-control" id="company_type" name="company_type"
                        value="{{ old('company_type') }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="company_email" class="form-label">Company Email</label>
                    <input type="email" class="form-control" id="company_email" name="company_email"
                        value="{{ old('company_email') }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="company_phone_number" class="form-label">Company Phone Number</label>
                    <input type="text" class="form-control" id="company_phone_number" name="company_phone_number"
                        value="{{ old('company_phone_number') }}" required>
                </div>

                <!-- Address Line 1 -->
                <div class="col-md-6 mb-3">
                    <label for="company_address_line_1" class="form-label">Address Line 1</label>
                    <input type="text" class="form-control" id="company_address_line_1" name="company_address_line_1"
                        value="{{ old('company_address_line_1') }}" required>
                </div>

                <!-- Address Line 2 -->
                <div class="col-md-6 mb-3">
                    <label for="company_address_line_2" class="form-label">Address Line 2</label>
                    <input type="text" class="form-control" id="company_address_line_2" name="company_address_line_2"
                        value="{{ old('company_address_line_2') }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="city" class="form-label">City</label>
                    <input type="text" class="form-control" id="city" name="city"
                        value="{{ old('city') }}" required>
                </div>

                <!-- Country -->
                <div class="col-md-6 mb-3">
                    <label for="country" class="form-label">Country</label>
                    <select class="form-control" id="country" name="country">
                        <option value="">Select Country</option>
                        <!-- Country options will be dynamically added here -->
                    </select>
                </div>

                <!-- State -->
                <div class="col-md-6 mb-3">
                    <label for="state" class="form-label">State</label>
                    <select class="form-control" id="state" name="state">
                        <option value="">Select State</option>
                        <!-- State options will be dynamically added here based on selected country -->
                    </select>
                </div>

                <!-- Pincode -->
                <div class="col-md-6 mb-3">
                    <label for="company_pincode" class="form-label">Pincode</label>
                    <input type="text" class="form-control" id="company_pincode" name="company_pincode"
                        value="{{ old('company_pincode') }}" required>
                </div>

                <!-- Hidden fields for Country and State Names -->
                <input type="hidden" id="country_name" name="country_name">
                <input type="hidden" id="state_name" name="state_name">

                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="{{ asset('assets/js/company/company_create.js') }}"></script>
@endsection
