<?php

namespace App\Http\Controllers\Kadiv;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DivisionOrder;
use App\Models\UserDivision;
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
    $users = UserDivision::where('division_id', Auth::guard('division')->user()->division_id)->get();

    $orders = [];
    foreach ($users as $user) {
      foreach ($user->divisionOrders as $order) {
        array_push($orders, $order);
      }
    }

    return view('roles.kadiv.order', [
      'header' => 'Order',
      'orders' => $orders
    ]);
  }
  public function orderDetail()
  {
    return view('roles.kadiv.orderDetail', [
      'header' => 'Detail'
    ]);
  }
}
