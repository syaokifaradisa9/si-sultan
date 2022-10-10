<?php

namespace App\Http\Controllers\Kadiv;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DivisionOrder;
use App\Models\ProposeHp;
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
  public function orderDetail($id)
  {
    $orders = DivisionOrder::findOrFail($id);

    return view('roles.kadiv.orderDetail', [
      'header' => 'Detail',
      'order' => $orders
    ]);
  }

  public function accept($id)
  {
    $orders = DivisionOrder::findOrFail($id);

    $orders->approved_by_kadiv = 1;
    $orders->save();

    return redirect()->route('kadiv.order')->with('success', 'Usulan berhasil disetujui');
  }
}
