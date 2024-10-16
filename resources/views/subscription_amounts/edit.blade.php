@extends('layouts.admin.adminDashboardLayout')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Edit Subscription Amount</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('subscription_amounts.update', $subscriptionAmount) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="uid" class="form-label">User ID</label>
                            <input type="text" class="form-control" name="uid" id="uid" value="{{ $subscriptionAmount->uid }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="subscription_type" class="form-label">Subscription Type</label>
                            <select class="form-control" name="subscription_type" id="subscription_type">
                                <option value="trial" {{ $subscriptionAmount->subscription_type == 'trial' ? 'selected' : '' }}>Trial</option>
                                <option value="basic" {{ $subscriptionAmount->subscription_type == 'basic' ? 'selected' : '' }}>Basic</option>
                                <option value="premium" {{ $subscriptionAmount->subscription_type == 'premium' ? 'selected' : '' }}>Premium</option>
                                <option value="custom" {{ $subscriptionAmount->subscription_type == 'custom' ? 'selected' : '' }}>Custom</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="amount" class="form-label">Amount</label>
                            <input type="number" class="form-control" name="amount" id="amount" value="{{ $subscriptionAmount->amount }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="flag" class="form-label">Flag</label>
                            <select class="form-control" name="flag" id="flag">
                                <option value="1" {{ $subscriptionAmount->flag == 1 ? 'selected' : '' }}>Active</option>
                                <option value="2" {{ $subscriptionAmount->flag == 2 ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="amount_in_paisa" class="form-label">Amount in Paisa</label>
                            <input type="text" class="form-control" name="amount_in_paisa" id="amount_in_paisa" value="{{ $subscriptionAmount->amount_in_paisa }}" readonly>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Update</button>
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