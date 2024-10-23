@extends('layouts.company_users.companyDashboardLayout')

@section('companyId', $companyId)
@section('companyPrefix', $companyPrefix)

@section('content')
    <h1>Departments</h1>
    <a href="{{ route('departments.create') }}" class="btn btn-primary mb-3">
        Add Department
    </a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>S.No</th>
                <th>Department</th>
                <th>Weight</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($departments as $index => $department)
                <tr>
                    <td>{{ $index + 1 }}</td> <!-- Serial Number -->
                    <td>
                        <!-- Link to roles index with encrypted department_id -->
                        <a href="{{ route('roles.index', ['department_id' => Crypt::encrypt($department->id)]) }}">
                            {{ $department->department }}
                        </a>
                    </td>

                    <td>{{ $department->weight }}</td> <!-- Weight -->
                    <td>
                        {{-- <a href="{{ route('departments.show', ['department' => Crypt::encrypt($department->id)]) }}"
                            class="btn btn-info btn-sm">View</a> --}}
                        <a href="{{ route('departments.edit', ['department' => Crypt::encrypt($department->id)]) }}"
                            class="btn btn-warning btn-sm">Edit</a>

                        <!-- Delete Button with Confirmation -->
                        <form action="{{ route('departments.destroy', ['department' => Crypt::encrypt($department->id)]) }}"
                            method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure you want to delete this department?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
