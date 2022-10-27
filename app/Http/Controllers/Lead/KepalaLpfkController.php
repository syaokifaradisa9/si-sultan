<?php

namespace App\Http\Controllers\Lead;

use App\Http\Controllers\Controller;
use App\Models\DivisionOrder;
use Illuminate\Http\Request;

class KepalaLpfkController extends Controller
{
  public function index()
  {
    return view('roles.kepala_lpfk.index', [
      'title' => 'Beranda | Kepala LPFK',
      'header' => 'Inventaris Barang'
    ]);
  }

  public function order()
  {
    $divOrders = DivisionOrder::with('userDivision')->where('approved_by_kadiv', 1)->where('approved_by_mutu', 1)->where('approved_by_adum', 1)->get();

    return view('roles.kepala_lpfk.order', [
      'title' => 'Usulan | Kepala LPFK',
      'header' => 'Usulan',
      'orders' => collect($divOrders)->sortByDesc('created_at')
    ]);
  }
  public function orderDetail($id)
  {
    $orders = DivisionOrder::findOrFail($id);

    return view('roles.kepala_lpfk.orderDetail', [
      'header' => 'Detail',
      'order' => $orders
    ]);
  }

  public function accept($id)
  {
    $orders = DivisionOrder::findOrFail($id);

    $orders->approved_by_kepala = 1;
    $orders->save();

    return redirect()->route('lpfk.order')->with('success', 'Usulan berhasil disetujui');
  }
}
