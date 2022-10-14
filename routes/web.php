<?php

use App\Http\Controllers\Addiv\AdminDivisiController;
use App\Http\Controllers\Adum\AdministrasiUmumController;
use App\Http\Controllers\Kadiv\KepalaDivisiController;
use App\Http\Controllers\Lead\KepalaLpfkController;
use App\Http\Controllers\Auth\Login\LoginController;
use App\Http\Controllers\Ppk\PpkController;
use App\Http\Controllers\Auth\Register\RegisterController;
use App\Http\Controllers\Admin\SuperadminController;
use App\Http\Controllers\Datatable\DatatableController;
use App\Http\Controllers\Mutu\MutuController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('guest')->group(function () {
  Route::get('/', [LoginController::class, 'index'])->name('login');
  Route::get('/login', [LoginController::class, 'index'])->name('login');
  Route::post('/login', [LoginController::class, 'authenticate'])->name('login.auth');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Route Datatable
Route::name('datatable.')->prefix('datatable')->group(function () {
  Route::get('/{type}/home', [DatatableController::class, 'home'])->name('home');
  Route::get('/{type}/{id}/detail', [DatatableController::class, 'detail'])->name('detail');
});

// Admin Divisi
Route::name('addiv.')->prefix('addiv')->middleware(['addiv'])->group(function () {
  Route::get('/home', [AdminDivisiController::class, 'index'])->name('home');
  Route::prefix('order')->group(function () {
    Route::get('/', [AdminDivisiController::class, 'order'])->name('order');
    Route::get('/create', [AdminDivisiController::class, 'create'])->name('create');
    Route::post('/store', [AdminDivisiController::class, 'store'])->name('store');
    Route::prefix('{id}')->group(function () {
      Route::get('/detail', [AdminDivisiController::class, 'orderDetail'])->name('orderDetail');
      Route::get('/edit', [AdminDivisiController::class, 'edit'])->name(('edit'));
      Route::put('/update', [AdminDivisiController::class, 'update'])->name('update');
    });
  });
});

// Kepala Divisi
Route::name('kadiv.')->prefix('kadiv')->middleware(['kadiv'])->group(function () {
  Route::get('/home', [KepalaDivisiController::class, 'index'])->name('home');
  Route::prefix('/order')->group(function () {
    Route::get('/', [KepalaDivisiController::class, 'order'])->name('order');
    Route::prefix('{id}')->group(function () {
      Route::get('/detail', [KepalaDivisiController::class, 'orderDetail'])->name('orderDetail');
      Route::get('/accept', [KepalaDivisiController::class, 'accept'])->name('accept');
    });
  });
});

// Mutu Operasional
Route::name('mutu.')->prefix('mutu')->middleware(['to'])->group(function () {
  Route::get('/home', [MutuController::class, 'index'])->name('home');
  Route::prefix('order')->group(function () {
    Route::get('/', [MutuController::class, 'order'])->name('order');
    Route::prefix('{id}')->group(function () {
      Route::get('/detail', [MutuController::class, 'orderDetail'])->name('orderDetail');
      Route::get('/accept', [MutuController::class, 'accept'])->name('accept');
      Route::post('/reject', [MutuController::class, 'reject'])->name('reject');
    });
  });
});

// Administrasi Umum
Route::name('adum.')->prefix('adum')->middleware(['adum'])->group(function () {
  Route::get('/home', [AdministrasiUmumController::class, 'index'])->name('home');
  Route::prefix('order')->group(function () {
    Route::get('/', [AdministrasiUmumController::class, 'order'])->name('order');
    Route::prefix('{id}')->group(function () {
      Route::get('/detail', [AdministrasiUmumController::class, 'orderDetail'])->name('orderDetail');
      Route::get('/accept', [AdministrasiUmumController::class, 'accept'])->name('accept');
    });
  });
});

// Kepala LPFK
Route::name('lpfk.')->prefix('lpfk')->middleware(['leader'])->group(function () {
  Route::get('/home', [KepalaLpfkController::class, 'index'])->name('home');
  Route::prefix('order')->group(function () {
    Route::get('/', [KepalaLpfkController::class, 'order'])->name('order');
    Route::prefix('{id}')->group(function () {
      Route::get('/detail', [KepalaLpfkController::class, 'orderDetail'])->name('orderDetail');
      Route::get('/accept', [KepalaLpfkController::class, 'accept'])->name('accept');
    });
  });
});

// PPK
Route::name('ppk.')->prefix('ppk')->middleware(['ppk'])->group(function () {
  Route::get('/home', [PpkController::class, 'index'])->name('home');
  Route::prefix('order')->group(function () {
    Route::get('/', [PpkController::class, 'order'])->name('order');
  });
});

// Superadmin
Route::name('admin.')->prefix('admin')->middleware(['superadmin'])->group(function () {
  Route::get('/home', [SuperadminController::class, 'index'])->name('home');
  Route::get('/register', [RegisterController::class, 'index'])->name('register');
  Route::post('/register', [RegisterController::class, 'store'])->name('store');
});

Route::get('{prefix}', function () {
  return back();
});
