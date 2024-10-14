<?php

use App\Http\Controllers\CommonController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RazorpayPaymentController;
use App\Http\Controllers\SubscriptionAmountController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Fetch Razorpay key via AJAX
Route::get('/get-razorpay-key', function () {
    return response()->json(['razorpay_key' => env('RAZORPAY_KEY')]);
});

// Razorpay order and payment routes
Route::post('/razorpay-payment', [RazorpayPaymentController::class, 'createOrder'])->name('razorpay.payment');
Route::post('/capture-payment', [RazorpayPaymentController::class, 'capturePayment'])->name('razorpay.capture');

// Authentication routes (login, register, etc.)
Auth::routes();

// Route for the trial subscription (protected, user must be authenticated)
Route::get('/subscription-trial', [SubscriptionController::class, 'showTrial'])->name('subscription.trial')->middleware('auth');

// Route for the basic subscription (protected, user must be authenticated)
Route::get('/subscription-basic', [SubscriptionController::class, 'showBasic'])->name('subscription.basic')->middleware('auth');

// Redirect user based on authentication status
Route::get('/', function () {
    if (Auth::check()) {
        // If user is logged in, redirect to /home
        return redirect('/home');
    } else {
        // If not logged in, redirect to login page
        return view('auth.login');
    }
})->name('home');

Route::get('/success', [RazorpayPaymentController::class, 'showSuccessPage'])->name('success.page');
Route::get('/trail-landing', [CommonController::class, 'trailLanding'])->name('trail.landing');
Route::get('/basic-landing', [CommonController::class, 'basicLanding'])->name('basic.landing');
Route::get('/extend-basic-landing', [CommonController::class, 'extendsBasisLanding'])->name('extends_basic.landing');

Route::resource('subscription_amounts', SubscriptionAmountController::class);

Route::post('/finalize-subscription', [RazorpayPaymentController::class, 'finalizeSubscription'])->name('finalize.subscription');

Route::get('/error', function () {

    if (Auth::check()) {
        // If user is logged in, redirect to /home
        return view('subscription.confirmation.failed');;
    } else {
        // If not logged in, redirect to login page
        return view('auth.login');
    }

});

// Home route (protected, user must be authenticated)
Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');
