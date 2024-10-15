<?php

namespace App\Http\Controllers;

class QuestPageController extends Controller
{
    public function home()
    {
        return view('guest.home');
    }

    public function features()
    {
        return view('guest.features');
    }

    public function pricing()
    {
        return view('guest.pricing');
    }

    public function contact()
    {
        return view('guest.contact');
    }
}
