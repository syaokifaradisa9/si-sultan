<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
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

Route::get('/', [LoginController::class, 'index'])->name('login');

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');

Route::get('/register', [RegisterController::class, 'index'])->name('register')->middleware('auth');
Route::post('/register', [RegisterController::class, 'store'])->name('regis.store')->middleware('auth');
