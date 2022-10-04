<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAdum
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

    if (Auth::guard('web')->check()) {
      if (Auth::guard('web')->user()->role === 'administrasi_umum') {
        return $next($request);
      } elseif (Auth::guard('web')->user()->role === 'superadmin') {
        return $next($request);
      }
    }

    return redirect()->route('login');
  }
}
