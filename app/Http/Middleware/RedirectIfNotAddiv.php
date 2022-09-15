<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotAddiv
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('division')->check()) {
            if (Auth::guard('division')->user()->role !== 'admin_divisi') {
                abort(403);
            }
        }

        if (Auth::guard('web')->check()) {
            if (Auth::guard('web')->user()->role !== 'superadmin') {
                abort(403);
            }
        }


        return $next($request);
    }
}
