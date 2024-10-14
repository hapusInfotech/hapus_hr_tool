<?php

namespace App\Http\Controllers;

use App\Helpers\CommonHelper;
use App\Models\Subscription;
use App\Models\SubscriptionDetail;
use App\Models\SubscriptionPayment;
use App\Services\CurrencyService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Razorpay\Api\Api; // Import Razorpay package
use Stevebauman\Location\Facades\Location;

class RazorpayPaymentController extends Controller
{
    protected $currencyService;

    public function __construct(CurrencyService $currencyService)
    {
        $this->currencyService = $currencyService;
    }

    public function createOrder(Request $request)
    {

        try {

            // Capture form inputs
            $name = $request->input('name');
            $email = $request->input('email');
            $company_name = $request->input('company_name');
            $address = $request->input('address');
            $phone = $request->input('phone');
            $no_of_people = $request->input('no_of_people');
            $cost_per_head = $request->input('cost_per_head');
            $current_plan = $request->input('plan'); // Get the plan type

            // Calculate total amount in INR (base currency)
            $amount = $cost_per_head * 100; // Amount in INR (paise)

            // Fetch user's location and determine currency
            $location = Location::get($request->ip());
            $country = $location->countryCode ?? 'IN'; // Default to INR if location fails
            $currencyDetails = $this->currencyService->getCurrencyByCountry($country);
            $currency = $currencyDetails['currency'] ?? 'INR'; // Default currency
            $currencySymbol = $currencyDetails['symbol'] ?? '₹';

            // Convert amount to the user's currency (if different)
            if ($currency !== 'INR') {
                $convertedAmount = $this->currencyService->convertCurrency($amount, 'INR', $currency);
            } else {
                $convertedAmount = $amount;
            }

            // Razorpay API initialization
            $razorpay_key = env('RAZORPAY_KEY');
            $razorpay_secret = env('RAZORPAY_SECRET');
            $api = new Api($razorpay_key, $razorpay_secret);

            // Check the plan type
            if ($current_plan == 'trial') {
                // Auto-debit subscription logic for the trial plan
                $plan = $api->plan->create([
                    "period" => "monthly",
                    "interval" => 1,
                    "item" => [
                        "name" => "Trial Plan",
                        "amount" => $convertedAmount,
                        "currency" => $currency,
                        "description" => "Trial subscription plan",
                    ],
                ]);

                // Create the subscription for auto-debit
                $subscription = $api->subscription->create([
                    'plan_id' => $plan->id,
                    'total_count' => 12, // 12 billing cycles (12 months)
                    'quantity' => 1,
                    'customer_notify' => 1,
                    'start_at' => now()->addMinutes(5)->timestamp,
                ]);

                return view('razorpay.paymentPage', [
                    'name' => $name,
                    'email' => $email,
                    'company_name' => $company_name,
                    'address' => $address,
                    'phone' => $phone,
                    'no_of_people' => $no_of_people,
                    'cost_per_head' => $cost_per_head,
                    'amount' => $convertedAmount,
                    'currency' => $currency,
                    'currency_symbol' => $currencySymbol,
                    'country' => $country,
                    'plan' => $current_plan,
                    'subscription' => $subscription, // Pass the subscription object
                ]);
            } else {
                // Normal payment logic for the basic plan
                $order = $api->order->create([
                    'receipt' => (string) rand(),
                    'amount' => $convertedAmount,
                    'currency' => $currency,
                ]);

                return view('razorpay.paymentPage', [
                    'name' => $name,
                    'email' => $email,
                    'company_name' => $company_name,
                    'address' => $address,
                    'phone' => $phone,
                    'no_of_people' => $no_of_people,
                    'cost_per_head' => $cost_per_head,
                    'amount' => $convertedAmount,
                    'currency' => $currency,
                    'currency_symbol' => $currencySymbol,
                    'country' => $country,
                    'plan' => $current_plan,
                    'order' => $order, // Pass the order object
                ]);
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Error creating order: ' . $e->getMessage());
        }
    }

    public function capturePayment(Request $request)
    {

        $razorpay_key = env('RAZORPAY_KEY');
        $razorpay_secret = env('RAZORPAY_SECRET');

        $api = new Api($razorpay_key, $razorpay_secret);

        try {
            $razorpay_payment_id = $request->input('razorpay_payment_id');

            if (!$razorpay_payment_id) {
                return redirect()->back()->with('error', 'Payment ID is missing');
            }

            $response = $api->payment->fetch($razorpay_payment_id);
            $capture = $response->capture(['amount' => $response['amount']]);

            if ($capture['status'] !== 'captured') {
                // If capture failed, handle the error
                return redirect()->back()->with('error', 'Payment capture failed.');
            }
            $currencyDetails = $this->currencyService->getCurrencyByCountry($country);
            dd($capture ,$request);
            $this->finalizeSubscription($request);
            // Prepare the data for redirection
            $payment_data = [
                'uid' => auth()->user()->id,
                'payment_id' => $capture['id'],
                
                'email' => auth()->user()->email, // fixed to pass the email
                'amount' => $request->input('amount'),
                'plan' => $request->input('plan'),
                'status' => 'Success',
            ];

// Redirect to the success page and pass the payment data
            return redirect()->route('success.page')->with('payment_data', $payment_data);
        } catch (Exception $e) {
            // Handle payment failure
            Session::flash('error', 'Payment failed: ' . $e->getMessage());
            return redirect('/error');
        }

        // Redirect to the success page with the data

    }
    
    public function showSuccessPage(Request $request)
    {
        // Retrieve the payment data passed during redirection
        $payment_data = session('payment_data');

        // If no payment data exists, redirect to error
        if (!$payment_data) {
            return redirect()->route('error.page')->with('error', 'No payment data found.');
        }

        // Pass the payment data to the success view
        return view('subscription.confirmation.success', compact('payment_data'));
    }

    public function finalizeSubscription(Request $request)
    {

        if (!empty($request->input('plan')) && $request->input('plan') == "trial") {
            $type = CommonHelper::PLAN_TRIAL;
        } else {
            $type = CommonHelper::PLAN_BASIC;

        }

        $set_amt = [];

        $check_amounts = $this->fetchAmount();
        foreach ($check_amounts as $key => $check_amount) {
            if ($request->input('plan') == $check_amount->subscription_type) {
                $get_amt_id = $check_amount->id;
                $get_amt = $check_amount->amount;

                // Set both the ID and the amount correctly in the array
                $set_amt['get_amt_id'] = $get_amt_id;
                $set_amt['get_amt'] = $get_amt;

                // Break out of the loop once a match is found
                break;
            }
        }

        // If no match is found, default values will remain null
        if (empty($set_amt)) {
            $set_amt['get_amt_id'] = null;
            $set_amt['get_amt'] = null;
        }

        if ($request->input('plan') == "trial") {
            $subscription = Subscription::create([
                'uid' => auth()->user()->id,
                'type' => $type,
                'status' => CommonHelper::STATUS_PENDING,
                'plan' => $request->input('plan'),
                'trial_start' => now(),
                'trial_end' => now()->addMonth(),

                'paid_subscription_start' => null,
                'paid_subscription_end' => null,
                'amount_id' => $set_amt['get_amt_id'],
                'amount' => $set_amt['get_amt'],
                'trial_signature' => $request->input('razorpay_signature'),
                'trial_razorpay_order_id' => $request->input('razorpay_subscription_id'),
                'payment_id' => $request->input('razorpay_payment_id'),
                'transaction_id' => $request->input('transaction_id'),
                'mail_flag' => 0,
                'company_id' => $request->input('company_id'),
            ]);
        } else {
            $subscription = Subscription::create([
                'uid' => auth()->user()->id,
                'type' => $type,
                'status' => CommonHelper::STATUS_COMPLETED,
                'plan' => $request->input('plan'),
                'trial_start' => null,
                'trial_end' => null,
                'paid_subscription_start' => now(),
                'paid_subscription_end' => now()->addMonth(),
                'amount_id' => $set_amt['get_amt_id'],
                'amount' => $request->input('amount'),
                'trial_signature' => null,
                'trial_razorpay_order_id' => null,
                'payment_id' => $request->input('razorpay_payment_id'),
                'transaction_id' => $request->input('subscription_id'),
                'mail_flag' => 0,
                'company_id' => $request->input('company_id'),
            ]);
        }
        if (!empty($subscription) && $request->input('plan') == "trial") {

            SubscriptionPayment::create([
                'subscription_id' => $subscription->id,
                'uid' => auth()->user()->id,
                'payment_type' => CommonHelper::PAYMENT_TYPE,
                'transaction_id' => $request->input('subscription_id'),
                'status' => CommonHelper::TRIAL_METHOD_VALUE,
                'amount_id' => $request->input('amount'),
                'payment_gateway' => CommonHelper::PAYMENT_RAZORPAY,
            ]);
            // subscription Details

            SubscriptionDetail::create([
                'subscription_id' => $subscription->id,
                'uid' => auth()->user()->id,
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'address' => null,
                'country' => $request->input('currency'),
                'payment_status' => CommonHelper::TRIAL_METHOD_VALUE,
                'flag' => 0,
            ]);

        } elseif (!empty($subscription) && $request->input('plan') == "basic") {
            SubscriptionPayment::create([
                'subscription_id' => $subscription->id,
                'uid' => auth()->user()->id,
                'payment_type' => CommonHelper::PAYMENT_TYPE,
                'transaction_id' => $request->input('subscription_id'),
                'status' => CommonHelper::BASIC_METHOD_VALUE,
                'amount_id' => $request->input('amount'),
                'payment_gateway' => CommonHelper::PAYMENT_RAZORPAY,
            ]);
            SubscriptionDetail::create([
                'subscription_id' => $subscription->id,
                'uid' => auth()->user()->id,
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'address' => null,
                'country' => $request->input('currency'),
                'payment_status' => CommonHelper::BASIC_METHOD_VALUE,
                'flag' => 0,
            ]);
        }
        return true;

    }

    public function fetchAmount()
    {
        // Fetch all rows from the subscription_amounts table
        $amounts = DB::table('subscription_amounts')
            ->select('id', 'uid', 'status', 'subscription_type', 'amount', 'country', 'amount_in_paisa')
            ->get();

        return $amounts;

    }

    public function handleWebhook(Request $request)
    {
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        $payload = $request->all();
        $webhookSignature = $request->header('X-Razorpay-Signature');

        try {
            // Verify the webhook signature
            $api->utility->verifyWebhookSignature(json_encode($payload), $webhookSignature, env('RAZORPAY_WEBHOOK_SECRET'));

            // Handle subscription events
            if ($payload['event'] === 'subscription.charged') {
                // Auto-debit payment successful
                // Handle logic for successful auto-debit payment, like updating subscription status
            } elseif ($payload['event'] === 'subscription.failed') {
                // Handle failed auto-debit payment, notify the customer, etc.
            }

        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }

        return response()->json(['status' => 'success']);
    }

    public function savePaymentDetails($subscriptionId, $userId, $razorpayPaymentId, $amount)
    {
        // Save the payment record in subscription_payments table
        return SubscriptionPayment::create([
            'subscription_id' => $subscriptionId,
            'UID' => $userId,
            'payment_type' => 'Online Payment',
            'transaction_id' => $razorpayPaymentId,
            'status' => 'Captured',
            'amount_id' => $amount,
            'payment_gateway' => 'Razorpay',
        ]);
    }
}
