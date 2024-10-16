@extends('layouts.admin.adminDashboardLayout')
@section('content')
<div class="container">
  <div class="my-4 text-right">
    <a href="/subscription_amounts" class="btn btn-primary">
      <i class="fas fa-dollar-sign"></i> Manage Subscription Amounts
    </a>
  </div>  <div class="row">
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
                @foreach($subscriptions as $subscription)
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
                @foreach($subscriptions as $subscription)
                @if($subscription->payment_type)
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
                @foreach($users as $user)
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

  </div>
</div>
@endsection
