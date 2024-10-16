<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function super_admin_index()
    {
        // Fetch data from subscriptions and subscription_details using join
        $subscriptions = DB::table('subscriptions')
        ->join('subscription_details', 'subscriptions.id', '=', 'subscription_details.subscription_id')
        ->leftJoin('subscription_payments', 'subscriptions.id', '=', 'subscription_payments.subscription_id')
        ->select(
            'subscriptions.id',
            'subscriptions.type',
            'subscriptions.uid',
            'subscriptions.status',
            'subscriptions.plan',
            'subscriptions.created_at',
            'subscriptions.updated_at',
            'subscription_details.name',
            'subscription_details.phone',
            'subscription_details.email',
            'subscription_details.address',
            'subscription_details.country',
            'subscription_details.payment_status',
            'subscription_payments.payment_type',
            'subscription_payments.transaction_id',
            'subscription_payments.status as payment_status',
            'subscription_payments.amount_id',
            'subscription_payments.payment_gateway'
        )
        ->get();
        $users = DB::table('users')->select('id', 'name', 'email', 'role_name', 'created_at', 'updated_at')->get();

    
        // Pass the data to the view
        return view('admin.home', ['subscriptions' => $subscriptions, 'users' => $users]);
    }
    
    public function support_admin_index()
    {
        // You can pass any data to the view if needed
        return view('home');
    }
    public function company_super_admin_index()
    {
        // You can pass any data to the view if needed
        return view('home');

    }
    public function company_admin_index()
    {
        // You can pass any data to the view if needed
        return view('home');

    }

}
