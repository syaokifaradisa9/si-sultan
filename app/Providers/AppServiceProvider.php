<?php

namespace App\Providers;

use App\Models\User;
use App\Models\UserDivision;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('isAdminDiv', function () {
            if (Auth::guard('division')->check()) {
                return auth()->guard('division')->user()->role === 'admin_divisi';
            }

            if (Auth::guard('web')->check()) {
                return auth()->guard('web')->user()->role === 'superadmin';
            }
        });
        Blade::if('isKadiv', function () {
            if (Auth::guard('division')->check()) {
                return auth()->guard('division')->user()->role === 'kepala_divisi';
            }

            if (Auth::guard('web')->check()) {
                return auth()->guard('web')->user()->role === 'superadmin';
            }
        });
        Blade::if('isTo', function () {
            if (Auth::guard('web')->check()) {
                return auth()->guard('web')->user()->role === 'mutu' || auth()->guard('web')->user()->role === 'superadmin';
            }
        });
        Blade::if('isAdum', function () {
            if (Auth::guard('web')->check()) {
                return auth()->guard('web')->user()->role === 'administrasi_umum' || auth()->guard('web')->user()->role === 'superadmin';
            }
        });
        Blade::if('isLead', function () {
            if (Auth::guard('web')->check()) {
                return auth()->guard('web')->user()->role === 'kepala_lpfk' || auth()->guard('web')->user()->role === 'superadmin';
            }
        });
        Blade::if('isPpk', function () {
            if (Auth::guard('web')->check()) {
                return auth()->guard('web')->user()->role === 'ppk' || auth()->guard('web')->user()->role === 'superadmin';
            }
        });
        Blade::if('isSuperadmin', function () {
            if (Auth::guard('web')->check()) {
                return auth()->guard('web')->user()->role === 'superadmin';
            }
        });
    }
}
