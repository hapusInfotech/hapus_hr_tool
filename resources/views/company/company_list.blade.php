@extends('layouts.common.commonUserDashboard')
@section('content')
    <div class="container">
        <h2>Company List</h2>
        <!-- Add Company Button -->
        <div class="mb-3">
            <a href="{{ route('company.company_create') }}" class="btn btn-primary">Add Company</a>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">S.No</th>
                    <th scope="col">Company Name</th>
                    <th scope="col">Company Type</th>
                    <th scope="col">Company Email</th>
                    <th scope="col">Company Phone Number</th>
                    <th scope="col">Company Address</th>
                    <th scope="col">User ID</th>
                    <th scope="col">Subscription ID</th>
                    <th scope="col">Role ID</th>
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
                            <td>{{ $company->uid }}</td>
                            <td>{{ $company->subscription_id }}</td>
                            <td>{{ $company->roles_id }}</td>
                            <td>{{ $company->email_status }}</td>
                            <td>{{ $company->company_status }}</td>
                            <td>
                                <!-- Edit Button -->
                                <a href="{{ route('company.company_edit', Crypt::encrypt($company->id)) }}"
                                    class="btn btn-sm btn-warning">Edit</a>

                                <!-- Delete Button triggers modal -->
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal" data-company-id="{{ Crypt::encrypt($company->id) }}"
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

    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/company/company_list.js') }}"></script> <!-- Adjust script path -->
@endsection
