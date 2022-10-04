<?php

namespace App\Http\Controllers\Auth\Login;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
  public function index()
  {
    return view('auth.login.index', [
      'title' => 'Login | SI-SULTAN',
      'header' => 'Login'
    ]);
  }

  public function authenticate(LoginRequest $request)
  {
    $validate = $request->only('email', 'password');

    $request->session()->regenerate();

    if (Auth::guard('division')->attempt($validate)) {
      if (Auth::guard('division')->user()->role === 'admin_divisi') {
        return redirect()->intended(route('addiv.home'));
      }
      if (Auth::guard('division')->user()->role === 'kepala_divisi') {
        return redirect()->intended(route('kadiv.home'));
      }
    }

    if (Auth::guard('web')->attempt($validate)) {
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

    return redirect(route('login'))->with('error', 'Login gagal');
  }

  public function logout(Request $request)
  {
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');
  }
}
