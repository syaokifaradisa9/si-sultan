<?php

use App\Http\Controllers\AdminDivisiController;
use App\Http\Controllers\AdministrasiUmumController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KepalaDivisiController;
use App\Http\Controllers\KepalaLpfkController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PpkController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SuperadminController;
use App\Http\Controllers\TataOperasionalController;
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

// Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/register', [RegisterController::class, 'index'])->name('register')->middleware('superadmin');
Route::post('/register', [RegisterController::class, 'store'])->name('regis.store');

// Admin Divisi
Route::name('addiv.')->prefix('addiv')->middleware('addiv')->group(function () {
  Route::get('/home', [AdminDivisiController::class, 'index'])->name('home');
});

// Kepala Divisi
Route::name('kadiv.')->prefix('kadiv')->middleware('kadiv')->group(function () {
  Route::get('/home', [KepalaDivisiController::class, 'index'])->name('home');
});

// Tata Operasional
Route::name('to.')->prefix('to')->middleware('to')->group(function () {
  Route::get('/home', [TataOperasionalController::class, 'index'])->name('home');
});

// Administrasi Umum
Route::name('adum.')->prefix('adum')->middleware('adum')->group(function () {
  Route::get('/home', [AdministrasiUmumController::class, 'index'])->name('home');
});

// Kepala LPFK
Route::name('lpfk.')->prefix('lpfk')->middleware('leader')->group(function () {
  Route::get('/home', [KepalaLpfkController::class, 'index'])->name('home');
});

// PPK
Route::name('ppk.')->prefix('ppk')->middleware('ppk')->group(function () {
  Route::get('/home', [PpkController::class, 'index'])->name('home');
});

// Superadmin
Route::name('admin.')->prefix('admin')->middleware('superadmin')->group(function () {
  Route::get('/home', [SuperadminController::class, 'index'])->name('home');
});
