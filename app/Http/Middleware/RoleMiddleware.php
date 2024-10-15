<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect('/login'); // Redirect to login if not authenticated
        }

        // Get the authenticated user
        $user = Auth::user();

        // Check if the user has the specified role (e.g., Super Admin)
        if (!$user->hasRole($role)) {
            return redirect('/home'); // Redirect to home if they don't have the required role
        }

        // If the user is a Super Admin, redirect them to /admin/home
        if ($user->hasRole('Super Admin')) {
            return redirect('/admin/home');
        }

        // Continue with the next request
        return $next($request);
    }
}
