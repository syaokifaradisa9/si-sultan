<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
   * @param  string|null  ...$guards
   * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
   */
  public function handle(Request $request, Closure $next, ...$guards)
  {
    // $guards = empty($guards) ? [null] : $guards;

    // foreach ($guards as $guard) {
    //     if (Auth::guard($guard)->user()->role === 'superadmin') {
    //         return redirect()->intended(route('admin.home'));
    //     }
    // }

    if (Auth::guard('web')->check()) {
      if (Auth::guard('web')->user()->role === 'tata_operasional') {
        return redirect()->intended(route('to.home'));
      }
      if (Auth::guard('web')->user()->role === 'administrasi_umum') {
        return redirect()->intended(route('adum.home'));
      }
      if (Auth::guard('web')->user()->role === 'kepala_lpfk') {
        return redirect()->intended(route('lpfk.home'));
      }
      if (Auth::guard('web')->user()->role === 'ppk') {
        return redirect()->intended(route('ppk.home'));
      }
      if (Auth::guard('web')->user()->role === 'superadmin') {
        return redirect()->intended(route('admin.home'));
      }
    }

    if (Auth::guard('division')->check()) {
      if (Auth::guard('division')->user()->role === 'admin_divisi') {
        return redirect()->intended(route('addiv.home'));
      }
      if (Auth::guard('division')->user()->role === 'kepala_divisi') {
        return redirect()->intended(route('kadiv.home'));
      }
    }

    return $next($request);
  }
}
