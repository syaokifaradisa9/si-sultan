<?php

namespace App\Http\Controllers\Mutu;

use App\Http\Controllers\Controller;
use App\Models\DivisionOrder;
use Illuminate\Http\Request;

class MutuController extends Controller
{
  public function index()
  {
    return view('roles.mutu.index', [
      'header' => 'Beranda'
    ]);
  }
  public function order()
  {
    $divOrders = DivisionOrder::with('userDivision')->get();

    return view('roles.mutu.order', [
      'header' => 'Order',
      'orders' => $divOrders
    ]);
  }
  public function orderDetail($id)
  {
    $orders = DivisionOrder::findOrFail($id);

    return view('roles.mutu.orderDetail', [
      'header' => 'Detail',
      'order' => $orders
    ]);
  }

  public function accept($id)
  {
    $orders = DivisionOrder::findOrFail($id);

    $orders->approved_by_mutu = 1;
    $orders->save();

    return redirect()->route('mutu.order')->with('success', 'Usulan berhasil disetujui');
  }

  public function reject($id)
  {
  }
}
