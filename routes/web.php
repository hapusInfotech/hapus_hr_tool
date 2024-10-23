<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\CompanyLoginController;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuestPageController;
use App\Http\Controllers\RazorpayPaymentController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\SubscriptionAmountController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Authentication routes (login, register, etc.)
Auth::routes();

//for refrence
// Route::get('/', function () {
//     // Check if the user is authenticated
//     if (Auth::check()) {
//         // Get the authenticated user
//         $user = Auth::user();

//         // Check the user's role and redirect to the appropriate home page
//         if ($user->hasRole('super admin')) {
//             return redirect('/admin/home'); // Admin home page
//         } elseif ($user->hasRole('manager')) {
//             return redirect('/manager-home'); // Manager home page
//         } elseif ($user->hasRole('employee')) {
//             return redirect('/employee-home'); // Employee home page
//         } elseif ($user->hasRole('customer')) {
//             return redirect('/customer-home'); // Customer home page
//         } else {
//             return redirect('/default-home'); // Default home page for other roles
//         }
//     } else {
//         // If the user is not logged in, call the QuestPageController home method
//         return app(QuestPageController::class)->home();
//     }
// })->name('guest_home');

//guest route
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

// guest pages routes

// Route::get('/', [QuestPageController::class, 'home'])->name('guest_home');
Route::get('/features', [QuestPageController::class, 'features'])->name('features');
Route::get('/pricing', [QuestPageController::class, 'pricing'])->name('pricing');
Route::get('/contact', [QuestPageController::class, 'contact'])->name('contact');
Route::post('/contact-submit', [ContactController::class, 'submit'])->name('contact.submit');
// Free demo page route
Route::get('/demo', [DemoController::class, 'show'])->name('demo.show');

// Form submission route for demo requests
Route::post('/demo-submit', [DemoController::class, 'submit'])->name('demo.submit');
//

//payment Route
// Fetch Razorpay key via AJAX
Route::get('/get-razorpay-key', function () {
    return response()->json(['razorpay_key' => env('RAZORPAY_KEY')]);
});

// Razorpay order and payment routes
Route::post('/razorpay-payment', [RazorpayPaymentController::class, 'createOrder'])->name('razorpay.payment');
Route::post('/capture-payment', [RazorpayPaymentController::class, 'capturePayment'])->name('razorpay.capture');
//
//subscription route
// Route for the trial subscription (protected, user must be authenticated)
Route::get('/subscription-trial', [SubscriptionController::class, 'showTrial'])->name('subscription.trial')->middleware('auth');

// Route for the basic subscription (protected, user must be authenticated)
Route::get('/subscription-basic', [SubscriptionController::class, 'showBasic'])->name('subscription.basic')->middleware('auth');

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

// Redirect user based on authentication status
//subscription route landing pages
Route::get('/trail-landing', [CommonController::class, 'trailLanding'])->name('trail.landing');
Route::get('/basic-landing', [CommonController::class, 'basicLanding'])->name('basic.landing');
Route::get('/extend-basic-landing', [CommonController::class, 'extendsBasisLanding'])->name('extends_basic.landing');

// admin amount alter rout FUll CRUD
Route::middleware(['auth', 'role:super admin'])->group(function () {
    Route::resource('subscription_amounts', SubscriptionAmountController::class);
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
Route::post('/check-company-prefix', [CompanyController::class, 'checkCompanyPrefix'])->name('company.checkPrefix');
Route::post('/check-company-email', [CompanyController::class, 'checkCompanyEmail'])->name('company.checkEmail');
Route::get('company/thankyou', [CompanyController::class, 'thankyou'])->name('company.thankyou');
Route::post('/company/update-status/{id}', [CompanyController::class, 'updateStatus'])->name('company.update_status');

//super admin Routes
Route::get('/admin/home', [AdminController::class, 'super_admin_index'])
    ->middleware('role:super admin')
    ->name('admin.home');

Route::get('/support/home', [AdminController::class, 'support_admin_index'])
    ->middleware('role:support admin')
    ->name('support.home');

// Route for company tables page
Route::get('/admin/company/tables/{id}', [AdminController::class, 'showCompanyTables'])->middleware('role:super admin')->name('admin.company.tables');
Route::delete('/admin/company/table-delete/{table}', [AdminController::class, 'deleteCompanyTable'])->name('admin.company.table_delete');

Route::get('/company/admin/home', [AdminController::class, 'company_super_admin_index'])
    ->middleware('role:company super admin')
    ->name('company.admin.home');

Route::get('/company/home', [AdminController::class, 'company_admin_index'])
    ->middleware('role:company admin')
    ->name('company.home');
//
//company
Route::get('company/login', [CompanyLoginController::class, 'showLoginForm'])->name('company.login');
Route::post('company/login', [CompanyLoginController::class, 'login'])->name('company.login.submit');
Route::post('company/logout', [CompanyLoginController::class, 'logout'])->name('company.logout');
Route::get('company/password/reset', [CompanyLoginController::class, 'showPasswordResetForm'])->name('company.password.reset');
Route::post('company/password/reset', [CompanyLoginController::class, 'resetPassword'])->name('company.password.update');
Route::get('company/dashboard', [CompanyLoginController::class, 'dashboard'])
    ->middleware('auth:company_login')
    ->name('company.dashboard');

Route::middleware('auth:company_login')->group(function () {
    Route::resource('departments', DepartmentController::class);
    // web.php
    Route::post('/departments/add', [DepartmentController::class, 'add'])->name('departments.add');

});

// Group all role-related routes with the auth:company_login middleware
Route::middleware('auth:company_login')->group(function () {
    Route::get('roles/department/{department_id}', [RolesController::class, 'index'])->name('roles.index');
    Route::get('roles/create/{department_id}', [RolesController::class, 'create'])->name('roles.create');
    Route::post('roles/store', [RolesController::class, 'store'])->name('roles.store');
    Route::get('roles/{role_id}/edit', [RolesController::class, 'edit'])->name('roles.edit');
    Route::put('roles/{role_id}/update', [RolesController::class, 'update'])->name('roles.update');
    Route::delete('roles/{role_id}/delete', [RolesController::class, 'destroy'])->name('roles.destroy');
});

// Group all role-related routes with the auth:company_login middleware
Route::middleware('auth:company_login')->group(function () {
    Route::get('/employees/create', [EmployeeController::class, 'showForm'])->name('employees.create');
    Route::post('/employees/store', [EmployeeController::class, 'storeStep'])->name('employees.storeStep');
    Route::get('/employees/departments', [EmployeeController::class, 'getDepartments'])->name('employees.getDepartments');
    Route::get('/employees/roles/{departmentId}', [EmployeeController::class, 'getRoles'])->name('employees.getRoles');
    Route::get('/employees/search', [EmployeeController::class, 'searchEmployees']);
    Route::post('/employees/check-availability', [EmployeeController::class, 'checkAvailability']);
    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
    Route::post('/employees/update-status', [EmployeeController::class, 'updateStatus'])->name('employees.updateStatus');
    Route::get('/employees/{emp_id}', [EmployeeController::class, 'show'])->name('employees.show');

});

Route::middleware('auth:company_login')->group(function () {
    Route::get('/shifts', [ShiftController::class, 'index'])->name('shifts.index');
    Route::get('/shifts/create', [ShiftController::class, 'create'])->name('shifts.create');
    Route::post('/shifts', [ShiftController::class, 'store'])->name('shifts.store');
    Route::get('/shifts/{id}/edit', [ShiftController::class, 'edit'])->name('shifts.edit');
    Route::put('/shifts/{id}', [ShiftController::class, 'update'])->name('shifts.update');
    Route::delete('/shifts/{id}', [ShiftController::class, 'destroy'])->name('shifts.destroy');
});
