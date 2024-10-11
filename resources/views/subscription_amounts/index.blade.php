@extends('layouts.common.commonUserDashboard')

@section('content')
<div class="container">
    <h2 class="text-center">Subscription Amounts</h2>
    <div class="text-right mb-3">
        <a href="{{ route('subscription_amounts.create') }}" class="btn btn-primary">Create New Subscription Amount</a>
    </div>
    @if ($subscriptionAmounts->count())
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>User ID</th>
                    <th>Status</th>
                    <th>Subscription Type</th>
                    <th>Amount</th>
                    <th>Flag</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($subscriptionAmounts as $subscriptionAmount)
                <tr>
                    <td>{{ $subscriptionAmount->id }}</td>
                    <td>{{ $subscriptionAmount->uid }}</td>
                    <td>{{ $subscriptionAmount->status }}</td>
                    <td>{{ $subscriptionAmount->subscription_type }}</td>
                    <td>{{ $subscriptionAmount->amount }}</td>
                    <td>{{ $subscriptionAmount->flag }}</td>
                    <td>
                        <a href="{{ route('subscription_amounts.edit', $subscriptionAmount) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('subscription_amounts.destroy', $subscriptionAmount) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?');">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <p class="text-center">No subscription amounts found.</p>
    @endif
</div>

@endsection
