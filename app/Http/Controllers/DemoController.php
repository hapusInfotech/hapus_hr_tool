<?php

namespace App\Http\Controllers;

use App\Models\DemoRequest;
use Illuminate\Http\Request;

class DemoController extends Controller
{
    public function show()
    {
        return view('guest.demo');
    }

    public function submit(Request $request)
    {

        // Create a new demo request
        DemoRequest::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'company' => $request->company,
            'country' => $request->country, // Store country name
            'state' => $request->state, // Store state name
            'message' => $request->message,
        ]);

        // Redirect back with a success message
        return redirect()->route('demo.show')->with('success', 'Your demo request has been submitted successfully!');
    }
}
