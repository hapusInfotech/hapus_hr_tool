<?php

namespace App\Http\Controllers;

use App\Models\SubscriptionAmount;
use Illuminate\Http\Request;

class SubscriptionAmountController extends Controller
{
    // Show all records (Read)
    public function index()
    {
        $subscriptionAmounts = SubscriptionAmount::all();
        return view('subscription_amounts.index', compact('subscriptionAmounts'));
    }

    // Show a form to create a new record (Create)
    public function create()
    {
        return view('subscription_amounts.create');
    }

    // Store a new record (Create)
    public function store(Request $request)
    {

        $response = new SubscriptionAmount();
        $response->uid = $request->input('uid');
        $response->status = ($request->input('flag') == 1) ? 'Active' : 'InActive';
        $response->country = 'India';
        $response->subscription_type = $request->input('subscription_type');
        $response->amount = $request->input('amount');
        $response->amount_in_paisa = $request->input('amount_in_paisa');
        $response->flag = $request->input('flag');
        $response->save();

        return redirect()->route('subscription_amounts.index')->with('success', 'Subscription amount created successfully.');
    }

    // Show the form to edit an existing record (Update)
    public function edit(SubscriptionAmount $subscriptionAmount)
    {
        return view('subscription_amounts.edit', compact('subscriptionAmount'));
    }

    // Update an existing record (Update)
    public function update(Request $request, SubscriptionAmount $subscriptionAmount)
    {
       
        $subscriptionAmount->uid = $request->input('uid');
        $subscriptionAmount->status = ($request->input('flag') == 1) ? 'Active' : 'InActive';
        $subscriptionAmount->country = 'India';
        $subscriptionAmount->subscription_type = $request->input('subscription_type');
        $subscriptionAmount->amount = $request->input('amount');
        $subscriptionAmount->amount_in_paisa = $request->input('amount_in_paisa');
        $subscriptionAmount->flag = $request->input('flag');
        $subscriptionAmount->update();
        return redirect()->route('subscription_amounts.index')->with('success', 'Subscription amount updated successfully.');
    }

    // Delete a record (Delete)
    public function destroy(SubscriptionAmount $subscriptionAmount)
    {
        $subscriptionAmount->delete();
        return redirect()->route('subscription_amounts.index')->with('success', 'Subscription amount deleted successfully.');
    }
}
