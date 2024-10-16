@extends('layouts.admin.adminDashboardLayout')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Create Subscription Amount</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('subscription_amounts.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="uid" class="form-label">User ID</label>
                            <input type="text" class="form-control" name="uid" id="uid" placeholder="Enter User ID" value="{{ Auth::user()->id }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlSelect1">Subscription
                                Type</label>
                            <select class="form-control" name="subscription_type" id="subscription_type">
                                <option value="trial">Trial</option>
                                <option value="basic">Basic </option>
                                <option value="premium">Premium </option>

                                <option value="custom">Custom </option>
                            </select>

                        </div>



                        <div class="mb-3">
                            <label for="amount" class="form-label">Amount</label>
                            <input type="number" class="form-control" name="amount" id="amount" placeholder="Enter Amount" required>
                        </div>

                        <div class="mb-3">
                            <label for="flag" class="form-label">Flag</label>
                            <select class="form-control" name="flag" id="flag">
                                <option value="">-Select-</option>
                                <option value="1">Active</option>
                                <option value="2">In Active</option>

                            </select>

                        </div>
                        <div class="mb-3">
                            <label for="amount" class="form-label">Amout in Paisa</label>
                            <input type="text" class="form-control" name="amount_in_paisa" id="amount_in_paisa" value="0" readonly>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('assets/js/subscription/form/amountcalculation.js') }}"></script>


@endsection