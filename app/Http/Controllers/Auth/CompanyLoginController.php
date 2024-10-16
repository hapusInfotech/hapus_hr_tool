<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CompanyLoginController extends Controller
{
    // Show login form for company users
    public function showLoginForm()
    {
        // Check if the user is already authenticated
        if (Auth::guard('company_login')->check()) {
            // If authenticated, redirect to the dashboard
            return redirect()->route('company.dashboard');
        }
        return view('auth.company_login'); // Create a view file for this
    }

    public function login(Request $request)
    {
        // Validate the form data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $remember = $request->has('remember');

        // Attempt to log the user in
        if (Auth::guard('company_login')->attempt(['email' => $request->email, 'password' => $request->password], $remember)) {

            // Check if the user needs to change their password
            $user = Auth::guard('company_login')->user();

            if ($user->force_password_change) {
                return redirect()->route('company.password.reset');
            }

            // If successful and no need to change password, redirect to the dashboard
            return redirect()->intended(route('company.dashboard'));
        }

        // If unsuccessful, redirect back with input and error message
        return back()->withInput($request->only('email', 'remember'))->withErrors([
            'email' => 'These credentials do not match our records.',
        ]);
    }

    // Log the user out
    public function logout(Request $request)
    {
        Auth::guard('company_login')->logout();
        return redirect()->route('company.login');
    }

    // Show the password reset form
    public function showPasswordResetForm()
    {
        return view('auth.company_reset_password');
    }

// Handle password update
    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|min:8',
        ]);

        // Update the user's password
        $user = Auth::guard('company_login')->user();
        $user->password = Hash::make($request->password);
        $user->force_password_change = false; // Disable the password change requirement
        $user->save();

        // Redirect to the dashboard
        return redirect()->route('company.dashboard')->with('success', 'Password changed successfully!');
    }

    // Dashboard method
    public function dashboard()
    {
        return view('company_users.admin.dashboard');
    }

}
