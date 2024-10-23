@extends('layouts.company_users.companyDashboardLayout')

@section('companyId', $companyId)
@section('companyPrefix', $companyPrefix)

@section('content')
<div class="container">

    <form action="{{ route('roles.update', Crypt::encrypt($role_id)) }}" method="POST">
        @csrf
        @method('PUT') <!-- Use the PUT method for updating the role -->

        <input type="hidden" name="department_id" value="{{ $role->department_id }}">

        <div class="form-group">
            <label for="roles">Role Name:</label>
            <input type="text" class="form-control" id="roles" name="roles" value="{{ $role->roles }}" required>
        </div>

        <div class="form-group">
            <label for="weight">Weight:</label>
            <input type="number" class="form-control" id="weight" name="weight" value="{{ $role->weight }}" required>
        </div>

        <button type="submit" class="btn btn-success">Update Role</button>
        <a href="{{ route('roles.index', ['department_id' => Crypt::encrypt($role->department_id)]) }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
