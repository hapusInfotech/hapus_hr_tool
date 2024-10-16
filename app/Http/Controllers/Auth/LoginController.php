<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
     */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Handle post-login redirection based on user role.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    protected function authenticated($request, $user)
    {
        // Check user's role and redirect accordingly
        if ($user->hasRole('super admin')) {
            return redirect('/admin/home');
        } elseif ($user->hasRole('support admin')) {
            return redirect('/home');

            // return redirect('/support/home');
        } elseif ($user->hasRole('company super admin')) {
            return redirect('/home');

            // return redirect('/company/home');
        } elseif ($user->hasRole('company admin')) {
            return redirect('/home');

            // return redirect('/company/home');
        } else {

            return redirect('/home');
        }
    }
}
