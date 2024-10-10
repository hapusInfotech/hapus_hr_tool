<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function showTrial(Request $request)
    {
        $plan = $request->query('plan', '');
        $no_of_ppl = $request->query('no_of_ppl','');

        if (!empty($no_of_ppl) && !empty($plan) && $plan == 'trial') {
            $no_of_people =  10 ;
        }else{
            $no_of_people =  1 ;
        }
        
        // Get the 'plan' value from URL
        return view('subscription.subscriptionTrail', compact('plan','no_of_people'));
    }
    public function showBasic(Request $request)
    {
        $plan = $request->query('plan', '');
        $no_of_ppl = $request->query('no_of_ppl','');

        if (!empty($no_of_ppl) && !empty($plan) && $plan == 'basic') {
            $no_of_people =  25 ;
        }else{
            $no_of_people =  1 ;
        }
        
        // Get the 'plan' value from URL
        return view('subscription.subscriptionBasic', compact('plan','no_of_people'));
    }
    
}
