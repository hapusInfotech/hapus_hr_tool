<?php

use App\Http\Controllers\CommonController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuestPageController;
use App\Http\Controllers\RazorpayPaymentController;
use App\Http\Controllers\SubscriptionAmountController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // Check if the user is authenticated
    if (Auth::check()) {
        // If the user is logged in, redirect to /home
        return redirect('/home');
    } else {
        // If the user is not logged in, call the QuestPageController home method
        return app(QuestPageController::class)->home();
    }
})->name('guest_home');
// Route::get('/', [QuestPageController::class, 'home'])->name('guest_home');
Route::get('/features', [QuestPageController::class, 'features'])->name('features');
Route::get('/pricing', [QuestPageController::class, 'pricing'])->name('pricing');
Route::get('/contact', [QuestPageController::class, 'contact'])->name('contact');
Route::post('/contact-submit', [ContactController::class, 'submit'])->name('contact.submit');
// Free demo page route
Route::get('/demo', [DemoController::class, 'show'])->name('demo.show');

// Form submission route for demo requests
Route::post('/demo-submit', [DemoController::class, 'submit'])->name('demo.submit');

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

Route::get('/trail-landing', [CommonController::class, 'trailLanding'])->name('trail.landing');
Route::get('/basic-landing', [CommonController::class, 'basicLanding'])->name('basic.landing');
Route::get('/extend-basic-landing', [CommonController::class, 'extendsBasisLanding'])->name('extends_basic.landing');

Route::resource('subscription_amounts', SubscriptionAmountController::class);

Route::get('/finalize-subscription', [RazorpayPaymentController::class, 'finalizeSubscription'])->name('finalize.subscription');

Route::get('/success', [RazorpayPaymentController::class, 'showSuccessPage'])->name('success.page');

Route::get('/failed', function () {

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

//CRUD for company
Route::get('/companies', [CompanyController::class, 'index'])->name('company.company_index');
Route::get('/company/create', [CompanyController::class, 'create'])->name('company.company_create');
Route::post('/company', [CompanyController::class, 'store'])->name('company.store');
Route::get('/company/{id}/edit', [CompanyController::class, 'edit'])->name('company.company_edit');
Route::put('/company/{id}', [CompanyController::class, 'update'])->name('company.company_update');
Route::delete('/company/{id}', [CompanyController::class, 'destroy'])->name('company.company_destroy');
