<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::user() && Auth::user()->role === 'Administrator') {
            return $next($request);
        }

        return redirect('/'); // Redirect to home if not an admin
    }
}