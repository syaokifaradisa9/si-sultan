<?php

namespace App\Http\Controllers\Adum;

use App\Http\Controllers\Controller;
use App\Models\DivisionOrder;
use Illuminate\Http\Request;

class AdministrasiUmumController extends Controller
{
  public function index()
  {
    return view('roles.adum.index', [
      'title' => 'Beranda | Administrasi Umum',
      'header' => 'Beranda Administrasi Umum'
    ]);
  }
  public function order()
  {
    $orders = DivisionOrder::with('userDivision')->where('approved_by_kadiv', 1)->where('approved_by_mutu', 1)->get();

    return view('roles.adum.order', [
      'title' => 'Usulan | Administrasi Umum',
      'header' => 'Usulan Administrasi Umum',
      'orders' => collect($orders)->sortByDesc('created_at')
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

    return redirect()->route('adum.order')->with('success', 'Usulan berhasil dikonfirmasi');
  }
}
