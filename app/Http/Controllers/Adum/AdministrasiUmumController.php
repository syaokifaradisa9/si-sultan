<?php

namespace App\Http\Controllers\Adum;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdministrasiUmumController extends Controller
{
    public function index()
    {
        return view('roles.administrasi_umum.index');
    }
    public function order()
    {
      return view('roles.administrasi_umum.order', [
        'header' => 'Order'
      ]);
    }
    public function orderDetail()
    {
      return view('roles.administrasi_umum.orderDetail', [
        'header' => 'Detail'
      ]);
    }
}
