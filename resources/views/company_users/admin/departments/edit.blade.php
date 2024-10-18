@extends('layouts.company_users.companyDashboardLayout')

@section('companyId', $companyId)
@section('companyPrefix', $companyPrefix)

@section('content')
    <h1>Edit Department</h1>

    <form method="POST"
        action="{{ route('departments.update', ['department' => Crypt::encrypt($department->id)]) }}">
        @csrf
        @method('PUT')
        <div>
            <label for="department">Department Name:</label>
            <input type="text" name="department" id="department" value="{{ $department->department }}" required>
        </div>
        <div>
            <label for="weight">Weight:</label>
            <input type="number" name="weight" id="weight" value="{{ $department->weight }}">
        </div>
        <button type="submit">Update</button>
    </form>
@endsection
