@extends('layouts.admin.adminDashboardLayout')
@section('head')
<meta name="csrf-token" content="{{ csrf_token() }}">

@endsection
@section('content')
    <div class="container">
        <div class="my-4 text-right">
            <a href="/subscription_amounts" class="btn btn-primary">
                <i class="fas fa-dollar-sign"></i> Manage Subscription Amounts
            </a>
        </div>
        <div class="row">
            <!-- Subscription Table -->
            <div class="col-lg-12 d-flex grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-wrap justify-content-between">
                            <h4 class="card-title mb-3">Payment Transaction Detail</h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Country</th>
                                        <th>Plan</th>
                                        <th>Status</th>
                                        <th>Payment Status</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subscriptions as $subscription)
                                        <tr>
                                            <td>{{ $subscription->name }}</td>
                                            <td>{{ $subscription->phone }}</td>
                                            <td>{{ $subscription->email }}</td>
                                            <td>{{ $subscription->address }}</td>
                                            <td>{{ $subscription->country }}</td>
                                            <td>{{ $subscription->plan }}</td>
                                            <td>{{ $subscription->status }}</td>
                                            <td>{{ $subscription->payment_status }}</td>
                                            <td>{{ $subscription->created_at }}</td>
                                            <td>{{ $subscription->updated_at }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Separate Payment Table -->
            <div class="col-lg-12 d-flex grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Payment Data</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Payment Type</th>
                                        <th>Transaction ID</th>
                                        <th>Payment Status</th>
                                        <th>Amount</th>
                                        <th>Payment Gateway</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subscriptions as $subscription)
                                        @if ($subscription->payment_type)
                                            <!-- Ensure payments exist -->
                                            <tr>
                                                <td>{{ $subscription->payment_type }}</td>
                                                <td>{{ $subscription->transaction_id }}</td>
                                                <td>{{ $subscription->payment_status }}</td>
                                                <td>{{ $subscription->amount_id }}</td>
                                                <td>{{ $subscription->payment_gateway }}</td>
                                                <td>{{ $subscription->created_at }}</td>
                                                <td>{{ $subscription->updated_at }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Users Table -->
            <div class="col-lg-12 d-flex grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-3">User Details</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role Name</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->role_name }}</td>
                                            <td>{{ $user->created_at }}</td>
                                            <td>{{ $user->updated_at }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Company Table -->
            <div class="col-lg-12 d-flex grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Company Details</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">S.No</th>
                                        <th scope="col">Company Name</th>
                                        <th scope="col">Company Type</th>
                                        <th scope="col">Company Email</th>
                                        <th scope="col">Company Phone Number</th>
                                        <th scope="col">Company Address</th>
                                        <th scope="col">User Name</th>
                                        <th scope="col">User Email</th>
                                        <th scope="col">Subscription Plan</th>
                                        <th scope="col">Email Status</th>
                                        <th scope="col">Company Status</th>
                                        <th scope="col">Actions</th> <!-- Actions column -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!$companies->isEmpty())
                                        @foreach ($companies as $index => $company)
                                            <tr>
                                                <td>{{ $index + 1 }}</td> <!-- Auto-incrementing S.No -->
                                                <td>{{ $company->company_name }}</td>
                                                <td>{{ $company->company_type }}</td>
                                                <td>{{ $company->company_email }}</td>
                                                <td>{{ $company->company_phone_number }}</td>
                                                <td>
                                                    @php
                                                        // Explode the company address to extract components
                                                        $addressParts = explode(', ', $company->company_address);

                                                        // Extract country and state parts
                                                        $countryParts = explode('-', $addressParts[3] ?? '');
                                                        $stateParts = explode('-', $addressParts[4] ?? '');

                                                        // Rebuild the address without country_id and state_id
                                                        $formattedAddress =
                                                            $addressParts[0] .
                                                                ', ' . // Address line 1
                                                                $addressParts[1] .
                                                                ', ' . // Address line 2
                                                                $addressParts[2] .
                                                                ', ' . // City
                                                                ($countryParts[1] ?? '') .
                                                                ', ' . // Country name
                                                                ($stateParts[1] ?? '') .
                                                                ', ' . // State name
                                                                $addressParts[5] ??
                                                            ''; // Pincode
                                                    @endphp
                                                    {{ $formattedAddress }}
                                                </td>
                                                <td>{{ $company->user->name ?? 'N/A' }}</td>
                                                <td>{{ $company->user->email ?? 'N/A' }}</td>
                                                <td>{{ $company->subscription->plan ?? 'N/A' }}</td>
                                                <td>{{ $company->email_status == 1 ? 'Active' : 'Inactive' }}</td>
                                                <td>
                                                    <input type="checkbox" class="company-status-toggle"
                                                    data-company-id="{{ $company->id }}"
                                                    {{ $company->company_status == 1 ? 'checked' : '' }}> <span class="company-status">{{ $company->company_status == 1 ? 'Active' : 'Inactive' }}</span>
                                                </td>

                                                <td>
                                                    <!-- Edit Button -->
                                                    <a href="{{ route('company.company_edit', Crypt::encrypt($company->id)) }}"
                                                        class="btn btn-sm btn-warning">Edit</a>

                                                    <!-- Delete Button triggers modal -->
                                                    <button type="button" class="btn btn-sm btn-danger"
                                                        data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                        data-company-id="{{ Crypt::encrypt($company->id) }}"
                                                        data-company-name="{{ $company->company_name }}">
                                                        Delete
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="12" class="text-center">No records found</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this company?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE') <!-- Method Spoofing for DELETE -->
                        <button type="submit" class="btn btn-danger">Confirm</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/company/company_list.js') }}"></script> <!-- Adjust script path -->
@endsection
