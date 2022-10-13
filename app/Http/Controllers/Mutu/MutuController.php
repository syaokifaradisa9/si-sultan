<?php

namespace App\Http\Controllers\Mutu;

use App\Helpers\ApiFormatter;
use App\Http\Controllers\Controller;
use App\Models\DivisionOrder;
use Illuminate\Http\Request;

class MutuController extends Controller
{
  public function index()
  {
    return view('roles.mutu.index', [
      'title' => 'Beranda | Mutu',
      'header' => 'Beranda Mutu Operasional'
    ]);
  }
  public function order()
  {
    $divOrders = DivisionOrder::with('userDivision')->get();

    return view('roles.mutu.order', [
      'title' => 'Order',
      'header' => 'Order',
      'orders' => collect($divOrders)->sortByDesc('created_at')
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

    return redirect()->route('mutu.order')->with('success', 'Usulan telah disetujui');
  }

  public function acceptedAll()
  {
    $orders = DivisionOrder::where('approved_by_kadiv', 1)->get();

    foreach ($orders as $order) {
      $order->approved_by_mutu = 1;
      $order->save();
    }

    return redirect()->route('mutu.order')->with('success', 'Usulan telah disetujui');
  }

  public function reject(Request $request, $id)
  {
    $orders = DivisionOrder::findOrFail($id);

    $orders->description_by_mutu = $request->data;
    $orders->save();

    $request->session()->flash('success', 'Usulan telah ditolak');
    return ApiFormatter::createdApi(200, $orders);
  }
}
