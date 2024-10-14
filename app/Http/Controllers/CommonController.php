<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommonController extends Controller
{
    //
    public function trailLanding(){
        return view('subscription.landing.trail');
    }

    public function basicLanding(){
        return view('subscription.landing.basic');
    }

    public function extendsBasisLanding(){
        return view('subscription.landing.extends_basic');
    }
}
