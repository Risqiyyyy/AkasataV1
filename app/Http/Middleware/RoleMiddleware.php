<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, ...$roles)
    {
        if (Auth::check()) {

            if (is_array($roles)) {

                foreach ($roles as $role) {
                    if (Auth::user()->role == $role) {
                        return $next($request);
                    }
                }
              
                return redirect()->back()->with('error', 'Unauthorized.');
            } else {
              
                return redirect()->back()->with('error', 'Invalid role check.');
            }
        }
        return redirect()->route('login')->with('error', 'You need to login first.');
    }
}
