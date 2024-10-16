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
            'name' =>$request->input('name'),
            'email' =>  $request->input('email'),
            'phone_number' => $request->input('phone_number'),
            'company' => $request->input('company'),
            'country' =>  $request->input('country'), // Store country name
            'state' => $request->input('state'), // Store state name
            'message' =>  $request->input('message'),
        ]);

        // Redirect back with a success message
        return redirect()->route('demo.show')->with('success', 'Your demo request has been submitted successfully!');
    }
}
