<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ApiController;
use App\Http\Controllers\PpkController;
use App\Http\Controllers\MutuController;
use App\Http\Controllers\KepalaLpfkController;
use App\Http\Controllers\Admin\SuperadminController;
use App\Http\Controllers\Auth\Login\LoginController;
use App\Http\Controllers\AdminDivisiController;
use App\Http\Controllers\KepalaDivisiController;
use App\Http\Controllers\Datatable\DatatableController;
use App\Http\Controllers\AdministrasiUmumController;
use App\Http\Controllers\Auth\Register\RegisterController;

Route::middleware('guest')->controller(LoginController::class)->group(function () {
  Route::get('/', 'index')->name('login');
  Route::get('/login', 'index')->name('login');
  Route::post('/login', 'authenticate')->name('login.auth');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// API
Route::prefix('api')->group(function () {
  Route::prefix('inventory')->group(function () {
    Route::get('/{type}', [ApiController::class, 'getOption']);
    Route::get('/{id}/{type}', [ApiController::class, 'getBmn']);
  });
  Route::get('propose/{id}/{type}', [ApiController::class, 'getPropose']);
});


// Route Datatable
Route::name('datatable.')->controller(DatatableController::class)->prefix('datatable')->group(function () {
  Route::prefix('{type}')->group(function () {
    Route::get('/home', 'home')->name('home');
    Route::get('/{id}/detail', 'detail')->name('detail');
  });
});

// Admin Divisi
Route::name('addiv.')->controller(AdminDivisiController::class)->prefix('addiv')->middleware(['addiv'])->group(function () {
  Route::get('/home', 'index')->name('home');
  Route::prefix('order')->group(function () {
    Route::get('/', 'order')->name('order');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/reapply', 'reapply')->name('reapply');
    Route::post('/storeReapply', 'storeReapply')->name('storeReapply');
    Route::prefix('{id}')->group(function () {
      Route::get('/detail', 'orderDetail')->name('orderDetail');
      Route::get('/edit', 'edit')->name(('edit'));
      Route::put('/update', 'update')->name('update');
    });
  });
  Route::prefix('inventory')->group(function () {
    Route::get('/', 'inventory')->name('inventory');
    Route::get('/create', 'createInventory')->name('createInven');
    Route::post('/store', 'storeInventory')->name('storeInven');
    Route::prefix('{id}')->group(function () {
      Route::put('/update/{type}', 'updateInventory')->name('updateInven');
      Route::delete('/delete/{type}', 'deleteInventory')->name('deleteInven');
    });
  });
});

// Kepala Divisi
Route::name('kadiv.')->controller(KepalaDivisiController::class)->prefix('kadiv')->middleware(['kadiv'])->group(function () {
  Route::get('/home', 'index')->name('home');
  Route::prefix('/order')->group(function () {
    Route::get('/', 'order')->name('order');
    Route::prefix('{id}')->group(function () {
      Route::get('/detail', 'orderDetail')->name('orderDetail');
      Route::get('/accept', 'accept')->name('accept');
    });
  });
});

// Mutu Operasional
Route::name('mutu.')->controller(MutuController::class)->prefix('mutu')->middleware(['mutu'])->group(function () {
  Route::get('/home', 'index')->name('home');
  Route::prefix('/approved')->group(function () {
    Route::get('/', 'approvedByPpk')->name('approvedByPPK');
    Route::get('/{id}/{type}', 'detailApproved')->name('detailApproved');
  });
  Route::prefix('pending')->group(function () {
    Route::get('/', 'pendingByPpk')->name('pendingByPPK');
    Route::get('{id}/{type}', 'detailPending')->name('detailPending');
  });
  Route::prefix('order')->group(function () {
    Route::get('/', 'order')->name('order');
    Route::prefix('{id}')->group(function () {
      Route::get('/accept', 'accept')->name('accept');
      Route::post('/reject', 'reject')->name('reject');
      Route::get('/detail', 'orderDetail')->name('orderDetail');
    });
  });
});

// Administrasi Umum
Route::name('adum.')->controller(AdministrasiUmumController::class)->prefix('adum')->middleware(['adum'])->group(function () {
  Route::get('/home', 'index')->name('home');
  Route::prefix('order')->group(function () {
    Route::get('/', 'order')->name('order');
    Route::prefix('{id}')->group(function () {
      Route::get('/detail', 'orderDetail')->name('orderDetail');
      Route::get('/accept', 'accept')->name('accept');
    });
  });
});

// Kepala LPFK
Route::name('lpfk.')->controller(KepalaLpfkController::class)->prefix('lpfk')->middleware(['leader'])->group(function () {
  Route::get('/home', 'index')->name('home');
  Route::prefix('order')->group(function () {
    Route::get('/', 'order')->name('order');
    Route::prefix('{id}')->group(function () {
      Route::get('/detail', 'orderDetail')->name('orderDetail');
      Route::get('/accept', 'accept')->name('accept');
    });
  });
});

// PPK
Route::name('ppk.')->controller(PpkController::class)->prefix('ppk')->middleware(['ppk'])->group(function () {
  Route::prefix('home')->group(function () {
    Route::get('/', 'index')->name('home');
    Route::post('/{id}/received', 'itemReceived')->name('itemReceived');
  });
  Route::prefix('received')->group(function () {
    Route::get('/', 'received')->name('received');
    Route::get('/{id}/{type}/detail', 'detailReceived')->name('detailReceived');
  });
  Route::prefix('order')->group(function () {
    Route::get('/', 'order')->name('order');
    Route::prefix('{id}')->group(function () {
      Route::get('/detail', 'orderDetail')->name('orderDetail');
      Route::get('/approved/{type}', 'approved')->name('approved');
      Route::post('/pending', 'pending')->name('pending');
      Route::get('/acceptedAll', 'acceptedAll')->name('acceptAll');
    });
  });
});

// Superadmin
Route::name('admin.')->prefix('admin')->middleware(['superadmin'])->group(function () {
  Route::get('/home', [SuperadminController::class, 'index'])->name('home');
  Route::prefix('register')->group(function () {
    Route::get('/', [RegisterController::class, 'index'])->name('register');
    Route::post('/', [RegisterController::class, 'store'])->name('store');
  });
});

Route::get('{prefix}', function () {
  return back();
});
