<?php

namespace App\Http\Controllers;

use App\Helpers\CurrencyHelper;
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
    
            // Create order or subscription based on the plan
            if ($current_plan == 'trial') {
                // Create a trial subscription plan
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
    
            } else {
                // Create a normal payment order for basic or other plans
                $order = $api->order->create([
                    'receipt' => (string)rand(),
                    'amount' => $convertedAmount,
                    'currency' => $currency,
                ]);
            }
    
            // Return payment page with all required data
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
                'subscription' => $subscription ?? null, // For trial (auto-debit)
                'order' => $order ?? null, // For basic or other plans
            ]);
    
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
            $order_id = $request->input('order_id');
            $user_id = $request->input('user_id');
            $razorpay_payment_id = $request->input('razorpay_payment_id');

            if (!$razorpay_payment_id) {
                return redirect()->back()->with('error', 'Payment ID is missing');
            }
            $response = $api->payment->fetch($razorpay_payment_id);

            $capture = $response->capture(['amount' => $response['amount']]);

            // Successful payment capture
            Session::flash('success', 'Payment successful!');
            return redirect('/');

        } catch (Exception $e) {
            // Handle payment failure
            Session::flash('error', 'Payment failed: ' . $e->getMessage());
            return redirect('/error');
        }
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


}
