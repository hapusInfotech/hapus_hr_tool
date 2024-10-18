@extends('layouts.admin.adminDashboardLayout')
@section('head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
    <div class="container">
        <h1>Company Details: {{ $company->company_name }}</h1>

        <!-- You can display the company's information or any related tables here -->
        <p>Company ID: {{ $company->id }}</p>
        <p>Company Type: {{ $company->company_type }}</p>
        <p>Company Email: {{ $company->company_email }}</p>
        <p>Company Phone: {{ $company->company_phone_number }}</p>

        <!-- Add any additional information you want to show about the company -->
    </div>
    <!-- Display flash messages -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Display the list of tables -->
    <h2>Company Specific Tables</h2>
    @if (count($tables) > 0)
        <div class="col-lg-12 d-flex grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-3">Company Details</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>S.No</th>
                                    <th>Table Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tables as $index => $table)
                                    <tr>
                                        <td>{{ $index + 1 }}</td> <!-- Serial number -->
                                        <td>{{ $table->table_name }}</td> <!-- Table name -->

                                        <td>
                                            <!-- Delete button -->
                                            <form method="POST"
                                                action="{{ route('admin.company.table_delete', ['table' => $table->table_name]) }}"
                                                onsubmit="return confirm('Are you sure you want to delete this table?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @else
        <p>No tables found for this company.</p>
    @endif
@endsection

@section('scripts')
@endsection
