<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        // Create a new contact submission
        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile_no' => $request->mobile_no,
            'message' => $request->message,
        ]);

        // Redirect with a success message
        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }
}
