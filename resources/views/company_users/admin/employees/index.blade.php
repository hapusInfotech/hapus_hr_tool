@extends('layouts.company_users.companyDashboardLayout')

@section('content')
    <div class="container">
        <h1>Employees List</h1>
        <a href="{{ route('employees.create') }}" class="btn btn-success"> Add Employee</a>
        <!-- Show the credentials if they exist in the session -->
        @if (session('emp_email') && session('generated_password'))
            <div class="alert alert-success">
                <strong>New Employee Credentials:</strong><br>
                Email: {{ session('emp_email') }}<br>
                Password: {{ session('generated_password') }}<br>
                Please inform the employee to change their password after the first login.
            </div>
        @endif

        <!-- Success alert for status update -->
        <div class="alert alert-success d-none" id="statusUpdateAlert">
            Employee status updated successfully!
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Employee ID</th>
                    <th>Employee Name</th>
                    <th>Department</th>
                    <th>Role</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($employees as $index => $employee)
                    <tr>
                        <td>{{ $index + 1 }}</td> <!-- Serial Number -->
                        <td>
                            <a href="{{ route('employees.show', $employee->emp_id) }}">
                                {{ $employee->emp_id }}
                            </a>
                        </td>
                        <td>{{ $employee->emp_name }}</td> <!-- Employee Name -->
                        <td>{{ $employee->department }}</td> <!-- Department Name -->
                        <td>{{ $employee->roles }}</td> <!-- Role -->
                        <td>
                            <!-- Toggle Status with Spinner -->
                            <input type="checkbox" class="status-toggle" data-employee-id="{{ $employee->emp_id }}"
                                @if ($employee->active_status == 1) checked @endif>
                            <div class="spinner-border text-success d-none" id="spinner-{{ $employee->emp_id }}"
                                style="width: 1rem; height: 1rem;" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <!-- Status text -->
                            <span id="status-text-{{ $employee->emp_id }}">
                                @if ($employee->active_status == 1)
                                    Active
                                @else
                                    Inactive
                                @endif
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">No employees found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/employees/index.js') }}"></script>
@endsection
