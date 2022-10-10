<?php

namespace App\Http\Controllers\Adum;

use App\Http\Controllers\Controller;
use App\Models\DivisionOrder;
use Illuminate\Http\Request;

class AdministrasiUmumController extends Controller
{
  public function index()
  {
    return view('roles.adum.index');
  }
  public function order()
  {
    $orders = DivisionOrder::with('userDivision')->get();

    return view('roles.adum.order', [
      'header' => 'Order',
      'orders' => $orders
    ]);
  }
  public function orderDetail($id)
  {
    $orders = DivisionOrder::findOrFail($id);

    return view('roles.adum.orderDetail', [
      'header' => 'Detail',
      'order' => $orders
    ]);
  }

  public function accept($id)
  {
    $order = DivisionOrder::findOrFail($id);

    $order->approved_by_adum = 1;
    $order->save();
  }
}
