<?php

use App\Http\Controllers\Addiv\AdminDivisiController;
use App\Http\Controllers\Adum\AdministrasiUmumController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Kadiv\KepalaDivisiController;
use App\Http\Controllers\Lead\KepalaLpfkController;
use App\Http\Controllers\Auth\Login\LoginController;
use App\Http\Controllers\Ppk\PpkController;
use App\Http\Controllers\Auth\Register\RegisterController;
use App\Http\Controllers\Admin\SuperadminController;
use App\Http\Controllers\Datatable\DatatableController;
use App\Http\Controllers\To\TataOperasionalController;
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

Route::name('datatable.')->prefix('datatable')->group(function () {
  Route::get('/{type}/home', [DatatableController::class, 'home'])->name('home');
  Route::get('/{type}/{id}/detail', [DatatableController::class, 'orderDetail'])->name('detail');
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
    Route::get('/{id}/detail', [KepalaDivisiController::class, 'orderDetail'])->name('orderDetail');
  });
});

// Tata Operasional
Route::name('to.')->prefix('to')->middleware(['to'])->group(function () {
  Route::get('/home', [TataOperasionalController::class, 'index'])->name('home');
  Route::prefix('order')->group(function () {
    Route::get('/', [TataOperasionalController::class, 'order'])->name('order');
    Route::get('/{id}/detail', [TataOperasionalController::class, 'orderDetail'])->name('orderDetail');
  });
});

// Administrasi Umum
Route::name('adum.')->prefix('adum')->middleware(['adum'])->group(function () {
  Route::get('/home', [AdministrasiUmumController::class, 'index'])->name('home');
  Route::get('/order', [AdministrasiUmumController::class, 'order'])->name('order');
  Route::get('/order/detail', [AdministrasiUmumController::class, 'orderDetail'])->name('orderDetail');
});

// Kepala LPFK
Route::name('lpfk.')->prefix('lpfk')->middleware(['leader'])->group(function () {
  Route::get('/home', [KepalaLpfkController::class, 'index'])->name('home');
  Route::get('/order', [KepalaLpfkController::class, 'order'])->name('order');
  Route::get('/order/detail', [KepalaLpfkController::class, 'orderDetail'])->name('orderDetail');
});

// PPK
Route::name('ppk.')->prefix('ppk')->middleware(['ppk'])->group(function () {
  Route::get('/home', [PpkController::class, 'index'])->name('home');
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
