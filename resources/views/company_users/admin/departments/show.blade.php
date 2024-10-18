@extends('layouts.company_users.companyDashboardLayout')

@section('companyId', $companyId)
@section('companyPrefix', $companyPrefix)

@section('content')
    <h1>Department Details</h1>

    <p>Department Name: {{ $department->department }}</p>
    <p>Weight: {{ $department->weight }}</p>
    <p>Company ID: {{ $department->company_id }}</p>
    <p>User ID: {{ $department->uid }}</p>

    <!-- Encrypt the department ID for the edit route -->
    <a href="{{ route('departments.edit', ['department' => Crypt::encrypt($department->id)]) }}">Edit</a>

    <!-- Encrypt the department ID for the delete route -->
    <form method="POST" action="{{ route('departments.destroy', ['department' => Crypt::encrypt($department->id)]) }}">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('Are you sure you want to delete this department?')">Delete</button>
    </form>
@endsection
