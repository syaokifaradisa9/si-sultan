<?php

namespace App\Http\Controllers\Kadiv;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class KepalaDivisiController extends Controller
{
    public function index()
    {
        return view('roles.kadiv.index', [
            'header' => 'Beranda',
          ]);
    }
    public function order()
    {
      return view('roles.kadiv.order', [
        'header' => 'Order'
      ]);
    }
    public function orderDetail()
    {
      return view('roles.kadiv.orderDetail', [
        'header' => 'Detail'
      ]);
    }
}
