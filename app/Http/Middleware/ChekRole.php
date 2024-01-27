<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ChekRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (!auth()->check() || auth()->user()->role->name !== $role) {
            abort(403, 'Unauthorized action.');
        }
        return $next($request);
    }
}
