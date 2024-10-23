@extends('layouts.company_users.companyDashboardLayout')
@section('companyId', $companyId)
@section('companyPrefix', $companyPrefix)
@section('content')
    <div class="container">
        <h1>Employee Registration - Multi-Step Form</h1>

        <!-- Form structure for handling multiple steps -->
        <form id="multiStepForm" action="{{ route('employees.storeStep') }}" method="POST">
            @csrf

            <!-- Step 1: Employee Details -->
            <div class="form-step {{ session('step') == 2 ? '' : 'active' }}" id="step-1">
                <h3>Step 1: Employee Details</h3>
                <div class="form-group">
                    <label for="emp_name">Employee Name</label>
                    <input type="text" class="form-control" id="emp_name" name="emp_name" required>
                </div>
                <div class="form-group">
                    <label for="emp_id">Employee ID</label>
                    <input type="text" class="form-control" id="emp_id" name="emp_id" required>
                    <span id="emp_id_status" class="status"></span> <!-- Status for Employee ID -->
                </div>

                <div class="form-group">
                    <label for="emp_username">Employee Username</label>
                    <input type="text" class="form-control" id="emp_username" name="emp_username">
                    <span id="emp_username_status" class="status"></span> <!-- Status for Username -->
                </div>

                <div class="form-group">
                    <label for="emp_email">Employee Email</label>
                    <input type="email" class="form-control" id="emp_email" name="emp_email" required>
                    <span id="emp_email_status" class="status"></span> <!-- Status for Email -->
                </div>

                <div class="form-group">
                    <label for="emp_gender">Gender</label>
                    <select class="form-control" id="emp_gender" name="emp_gender">
                        <option value="0">Male</option>
                        <option value="1">Female</option>
                        <option value="2">Other</option>
                    </select>
                </div>

                <!-- Department Dropdown with Add Button -->
                <div class="form-group">
                    <label for="department_id">Department</label>
                    <div class="d-flex">
                        <select class="form-control" id="department_id" name="department_id" required>
                            <option value="">Select Department</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="emp_role">Employee Role</label>
                    <select class="form-control" id="emp_role" name="emp_role" required>
                        <option value="">Select Role</option>
                    </select>
                </div>
                <input type="hidden" name="step" value="1">
                <button type="button" class="btn btn-primary next-step">Next</button>
            </div>

            <!-- Step 2: Work Details -->
            <div class="form-step {{ session('step') == 2 ? 'active' : '' }}" id="step-2">
                <h3>Step 2: Work Details</h3>
                <div class="form-group">
                    <label for="shift_id">Shift</label>
                    <select class="form-control" id="shift_id" name="shift_id" required>
                        <option value="">Select Shift</option>
                        @foreach ($shifts as $shift)
                            <option value="{{ $shift->id }}">
                                {{ $shift->shift_name }} - {{ $shift->shift_type }} ({{ $shift->shift_start_time }} -
                                {{ $shift->shift_end_time }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="location">Location</label>
                    <input type="text" class="form-control" id="location" name="location" required>
                </div>
                <div class="form-group">
                    <label for="designation">Designation</label>
                    <input type="text" class="form-control" id="designation" name="designation" required>
                </div>
                <div class="form-group">
                    <label for="date_of_joining">Date of Joining</label>
                    <input type="date" class="form-control" id="date_of_joining" name="date_of_joining" required>
                </div>
                <input type="hidden" name="step" value="2">
                <button type="button" class="btn btn-secondary prev-step">Previous</button>
                <button type="button" class="btn btn-primary next-step">Next</button>
            </div>

            <!-- Step 3: Reporting To -->
            <div class="form-step {{ session('step') == 3 ? 'active' : '' }}" id="step-3">
                <h3>Step 3: Reporting To</h3>
                <div class="form-group">
                    <label for="reporting_to_id">Reporting To</label>
                    <select class="form-control" id="reporting_to_id" name="reporting_to_id" style="width: 100%;"
                        required>
                        <!-- Options will be loaded via AJAX -->
                    </select>
                </div>
                <input type="hidden" name="step" value="3">
                <button type="button" class="btn btn-secondary prev-step">Previous</button>
                <button type="button" class="btn btn-primary next-step">Next</button>
            </div>

            <!-- Step 4: Personal Details -->
            <div class="form-step {{ session('step') == 4 ? 'active' : '' }}" id="step-4">
                <h3>Step 4: Personal Details (Optional)</h3>
                <div class="form-group">
                    <label for="date_of_birth">Date of Birth</label>
                    <input type="date" class="form-control" id="date_of_birth" name="date_of_birth">
                </div>
                <div class="form-group">
                    <label for="marital_status">Marital Status</label>
                    <select class="form-control" id="marital_status" name="marital_status">
                        <option value="">Select Marital Status</option>
                        <option value="single">Single</option>
                        <option value="married">Married</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="blood_group">Blood Group</label>
                    <input type="text" class="form-control" id="blood_group" name="blood_group">
                </div>
                <div class="form-group">
                    <label for="present_address">Present Address</label>
                    <textarea class="form-control" id="present_address" name="present_address"></textarea>
                </div>

                <div class="form-group">
                    <input type="checkbox" id="same_as_present" name="same_as_present">
                    <label for="same_as_present">Same as Present Address</label>
                </div>

                <div class="form-group">
                    <label for="permanent_address">Permanent Address</label>
                    <textarea class="form-control" id="permanent_address" name="permanent_address"></textarea>
                </div>

                <input type="hidden" name="step" value="4">
                <button type="button" class="btn btn-secondary prev-step">Previous</button>
                <button type="submit" class="btn btn-success">Finish</button>
            </div>
        </form>
    </div>


@endsection

@section('scripts')
    <script src="{{ asset('assets/js/employees/multi_step_form.js') }}"></script>
@endsection
