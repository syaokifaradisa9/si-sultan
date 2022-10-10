<?php

namespace App\Http\Controllers\To;

use App\Http\Controllers\Controller;
use App\Models\DivisionOrder;
use App\Models\UserDivision;
use Illuminate\Http\Request;

class TataOperasionalController extends Controller
{
  public function index()
  {
    return view('roles.to.index', [
      'header' => 'Beranda'
    ]);
  }
  public function order()
  {

    $dviOrders = DivisionOrder::with('userDivision')->get();

    return view('roles.to.order', [
      'header' => 'Order',
      'orders' => $dviOrders
    ]);
  }
  public function orderDetail()
  {
    return view('roles.to.orderDetail', [
      'header' => 'Detail'
    ]);
  }
}
