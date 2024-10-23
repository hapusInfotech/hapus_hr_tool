@extends('layouts.company_users.companyDashboardLayout')

@section('content')
    <div class="container">
        <h1>Employee Details</h1>
        <h3>{{ $employee->emp_name }} ({{ $employee->emp_id }})</h3>
        <hr>

        <!-- Personal Details -->
        <h4>Personal Details</h4>
        <p>Date of Birth: {{ $personalDetails->date_of_birth ?? 'N/A' }}</p>
        <p>Marital Status: {{ $personalDetails->marital_status ?? 'N/A' }}</p>
        <p>Blood Group: {{ $personalDetails->blood_group ?? 'N/A' }}</p>
        <p>Present Address: {{ $personalDetails->present_address ?? 'N/A' }}</p>
        <p>Permanent Address: {{ $personalDetails->permanent_address ?? 'N/A' }}</p>

        <!-- Work Details -->
        <h4>Work Details</h4>
        <p>Shift: {{ $workDetails->shift ?? 'N/A' }}</p>
        <p>Location: {{ $workDetails->location ?? 'N/A' }}</p>
        <p>Designation: {{ $workDetails->designation ?? 'N/A' }}</p>
        <p>Date of Joining: {{ $workDetails->date_of_joining ?? 'N/A' }}</p>

        <!-- Reporting To -->
        <h4>Reporting To</h4>
        <p>Reporting To: {{ $reportingTo->reporting_to_name ?? 'N/A' }}</p>

        <!-- Educational Details -->
        <h4>Educational Details</h4>
        <ul>
            @forelse ($educationalDetails as $education)
                <li>{{ $education->degree_diploma }} in {{ $education->specialization }} from {{ $education->institute_name }} (Completed: {{ $education->date_of_completion }})</li>
            @empty
                <li>No educational details found.</li>
            @endforelse
        </ul>

        <!-- Experience Details -->
        <h4>Experience Details</h4>
        <ul>
            @forelse ($experienceDetails as $experience)
                <li>{{ $experience->designation }} at {{ $experience->organization_name }} ({{ $experience->date_of_joining }} - {{ $experience->date_of_releaving ?? 'Present' }})</li>
            @empty
                <li>No experience details found.</li>
            @endforelse
        </ul>

        <a href="{{ route('employees.index') }}" class="btn btn-primary">Back to Employees List</a>
    </div>
@endsection
