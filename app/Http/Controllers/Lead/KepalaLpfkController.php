<?php

namespace App\Http\Controllers\Lead;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KepalaLpfkController extends Controller
{
    public function index()
    {
        return view('roles.kepala_lpfk.index');
    }

    public function order()
    {
      return view('roles.kepala_lpfk.order', [
        'header' => 'Order'
      ]);
    }
    public function orderDetail()
    {
      return view('roles.kepala_lpfk.orderDetail', [
        'header' => 'Detail'
      ]);
    }
}
