@extends('layouts.company_users.companyDashboardLayout')
@section('companyId', $companyId)
@section('companyPrefix', $companyPrefix)
@section('content')
    <form action="{{ route('roles.store') }}" method="POST">
        @csrf
        <!-- Ensure that department_id is encrypted when passed to the form -->
        <input type="hidden" name="department_id" value="{{ $department_id }}">

        <div class="form-group">
            <label for="roles">Role Name:</label>
            <input type="text" class="form-control" id="roles" name="roles" required>
        </div>

        <div class="form-group">
            <label for="weight">Weight:</label>
            <input type="number" class="form-control" id="weight" name="weight" required>
        </div>

        <button type="submit" class="btn btn-success">Create Role</button>
        <a href="{{ route('roles.index', ['department_id' => Crypt::encrypt($department_id)]) }}" class="btn btn-secondary">Cancel</a>
    </form>

@endsection
