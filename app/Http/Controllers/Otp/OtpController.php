<?php

namespace App\Http\Controllers\Otp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;

class OtpController extends Controller
{
    /**
     * Handle form submission and send OTP
     */
    public function sendOtp(Request $request)
    {
        // Validate company email input
        $request->validate([
            'company_email' => 'required|email', // Use the correct field name
        ]);

        // Generate a random 6-digit OTP
        $otp = rand(100000, 999999);

        // Cache the OTP for 5 minutes using the company email
        Cache::put('otp_' . $request->company_email, $otp, now()->addMinutes(5));

        // Send the OTP to the provided company email
        Mail::to($request->company_email)->send(new OtpMail($otp));

        // Return success message, redirect back with a message
        return back()->with('message', 'OTP has been sent to your email.');
    }

    /**
     * Validate the OTP entered by the user
     */
    public function validateOtp(Request $request)
    {
        // Validate input
        $request->validate([
            'company_email' => 'required|email', // Ensure you're validating the correct field name
            'otp'   => 'required|integer',
        ]);

        // Retrieve the cached OTP using the correct key
        $cachedOtp = Cache::get('otp_' . $request->company_email);

        // Check if OTP matches
        if ($cachedOtp && $request->otp == $cachedOtp) {
            // OTP is valid, clear OTP from cache
            Cache::forget('otp_' . $request->company_email);
            return back()->with('message', 'OTP is valid!');
        }

        // Invalid or expired OTP
        return back()->with('error', 'Invalid or expired OTP.');
    }
}
