<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        // Check if the request is for a company login
        if ($request->is('company/*')) {
            return route('company.login');
        }

        // Default redirection for other guards
        if (!$request->expectsJson()) {
            return route('login');
        }
    }
}
