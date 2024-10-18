@extends('layouts.company_users.companyDashboardLayout')
@section('companyId', $companyId)
@section('companyPrefix', $companyPrefix)
@section('content')
    <h1>Create Department</h1>

    <form method="POST"
        action="{{ route('departments.store', ['company_id' => $companyId, 'company_prefix' => $companyPrefix]) }}">
        @csrf
        <div>
            <label for="department">Department Name:</label>
            <input type="text" name="department" id="department" required>
        </div>
        <div>
            <label for="weight">Weight:</label>
            <input type="number" name="weight" id="weight">
        </div>
        <button type="submit">Create</button>
    </form>
@endsection
