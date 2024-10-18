<?php

namespace App\Http\Controllers;

use App\Models\SubscriptionAmount;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function showTrial(Request $request)
    {
        $plan = $request->query('plan', '');
        $no_of_ppl = $request->query('no_of_ppl', '');

        if (!empty($no_of_ppl) && !empty($plan) && $plan == 'trial') {
            $no_of_people = 10;
        } else {
            $no_of_people = 1;
        }
        $costs_trials = $this->getCostPerHeadAmt();
        $costs_trial = $costs_trials['trial'];

        // Get the 'plan' value from URL
        return view('subscription.subscriptionTrail', compact('plan', 'no_of_people', 'costs_trial'));
    }
    public function showBasic(Request $request)
    {
        $plan = $request->query('plan', '');
        $no_of_ppl = $request->query('no_of_ppl', '');

        if (!empty($no_of_ppl) && !empty($plan) && $plan == 'basic') {
            $no_of_people = 25;
        } else {
            $no_of_people = 1;
        }
        $costs_basics = $this->getCostPerHeadAmt();
        $costs_basic = $costs_basics['basic'];
        // Get the 'plan' value from URL
        return view('subscription.subscriptionBasic', compact('plan', 'no_of_people', 'costs_basic'));
    }
    public function getCostPerHeadAmt()
    {
        // Fetch all the subscription amounts
        $subscriptionAmounts = SubscriptionAmount::all();
        $pass_cost = [];

        // Loop through each subscription amount and store the subscription type and amount as key-value pairs
        foreach ($subscriptionAmounts as $subscriptionAmount) {
            $pass_cost[$subscriptionAmount->subscription_type] = $subscriptionAmount->amount;
        }

        return $pass_cost;
    }
}
