<?php

namespace App\Http\Controllers;

use App\Helpers\CommonHelper;
use App\Models\Subscription;
use App\Models\SubscriptionPayment;
use App\Services\CurrencyService;
use Exception;
use Illuminate\Http\Request;
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

            // Prepare the data to pass to the success page
            $data = [
                'uid' => auth()->user()->id,
                'type' => $request->input('plan') === 'trial' ? 1 : 2, // 1 for trial, 2 for paid
                'status' => 'pending',
                'plan' => $request->input('plan'),
                'trial_start' => $request->input('plan') === 'trial' ? now() : null,
                'trial_end' => $request->input('plan') === 'trial' ? now()->addMonth() : null,
                'trial_signature' => $request->input('razorpay_signature'),
                'trial_razorpay_order_id' => $request->input('razorpay_order_id'),
                'paid_subscription_start' => $request->input('plan') !== 'trial' ? now() : null,
                'paid_subscription_end' => $request->input('plan') !== 'trial' ? now()->addYear() : null,
                'amount_id' => $response['amount'],
                'trial_renewal' => 0,
                'paid_renewal' => 0,
                'payment_id' => $request->input('razorpay_payment_id'),
                'transaction_id' => $request->input('transaction_id'),
                'mail_flag' => 0,
                'company_id' => $request->input('company_id'),
            ];

            // Redirect to the success page with the data
            return redirect()->route('success.page')->with('payment_data', $data);
        } catch (Exception $e) {
            // Handle payment failure
            Session::flash('error', 'Payment failed: ' . $e->getMessage());
            return redirect('/error');
        }
    }

    public function finalizeSubscription(Request $request)
    {
        if (!empty($request->input('plan')) && $request->input('plan') == "trial") {
            $type = CommonHelper::PLAN_TRIAL;
        } else {
            $type = CommonHelper::PLAN_BASIC;

        }
        // dd($request);
        if ($request->input('plan') == "trial") {
            $subscription = Subscription::create([
                'uid' => $request->input('uid'),
                'type' => $type,
                'status' => CommonHelper::STATUS_PENDING,
                'plan' => $request->input('plan'),
                'trial_start' => now(),
                'trial_end' => now()->addMonth(),

                'paid_subscription_start' => null,
                'paid_subscription_end' => null,
                'amount_id' => $request->input('amount'),
                'trial_signature' => $request->input('trial_signature'),
                'trial_razorpay_order_id' => $request->input('trial_razorpay_order_id'),
                'payment_id' => $request->input('razorpay_payment_id'),
                'transaction_id' => $request->input('transaction_id'),
                'mail_flag' => 0,
                'company_id' => $request->input('company_id'),
            ]);
        } else {
            $subscription = Subscription::create([
                'uid' => $request->input('uid'),
                'type' => $type,
                'status' => CommonHelper::STATUS_COMPLETED,
                'plan' => $request->input('plan'),
                'trial_start' => $request->input('trial_start'),
                'trial_end' => $request->input('trial_end'),
                'paid_subscription_start' =>now(),
                'paid_subscription_end' => now()->addMonth(),
                'amount_id' => $request->input('amount'),
                'trial_signature' => $request->input('trial_signature'),
                'trial_razorpay_order_id' => $request->input('trial_razorpay_order_id'),
                'payment_id' => $request->input('razorpay_payment_id'),
                'transaction_id' => $request->input('transaction_id'),
                'mail_flag' => 0,
                'company_id' => $request->input('company_id'),
            ]);
        }
        if (!empty($subscription)) {

            SubscriptionPayment::create([
                'subscription_id' => $subscription->id,
                'uid' => $request->input('uid'),
                'payment_type' => 'Online Payment',
                'transaction_id' => $request->input('razorpay_payment_id'),
                'status' => 'Captured',
                'amount_id' => $request->input('amount'),
                'payment_gateway' => 'Razorpay',
            ]);
        }
         return redirect()->route('success.page');

    }


    // public function fetchAmount(){
    //     $amount = 
    //     return $amount;
    // }
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
    public function showSuccessPage(Request $request)
    {
        // Get the payment data from the session
        $paymentData = session('payment_data');
        // dd($paymentData);
        // Check if paymentData exists and is not empty
        if (!empty($paymentData)) {
            return view('subscription.confirmation.success', compact('paymentData'));
        }

        // If payment data is missing, return an error
        return redirect('/error')->with('error', 'Payment data not found.');
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
