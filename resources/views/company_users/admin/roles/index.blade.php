@extends('layouts.company_users.companyDashboardLayout')

@section('companyId', $companyId)
@section('companyPrefix', $companyPrefix)

@section('content')
    <div class="container">

        <a href="{{ route('roles.create', ['department_id' => $department_id]) }}" class="btn btn-primary mb-3">Add New
            Role</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Role</th>
                    <th>Weight</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                    <tr>
                        <td>{{ $role->roles }}</td>
                        <td>{{ $role->weight }}</td>
                        <td>
                            <!-- Edit the role -->
                            <a href="{{ route('roles.edit', Crypt::encrypt($role->id)) }}" class="btn btn-warning">Edit</a>

                            <!-- Delete the role -->
                            <form action="{{ route('roles.destroy', Crypt::encrypt($role->id)) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
