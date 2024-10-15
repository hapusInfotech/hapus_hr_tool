<?php

namespace App\Http\Controllers;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function super_admin_index()
    {
        // You can pass any data to the view if needed
        return view('admin.home');
    }
    public function support_admin_index()
    {
        // You can pass any data to the view if needed
        return view('home');
    }
    public function company_admin_index()
    {
        // You can pass any data to the view if needed
        return view('home');

    }

}
