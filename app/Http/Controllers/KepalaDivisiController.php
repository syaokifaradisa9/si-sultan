<?php

namespace App\Http\Controllers;

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
    $division = UserDivision::with('division')->where('division_id', Auth::guard('division')->user()->division_id)->first();

    return view('roles.kadiv.index', [
      'title' => 'Beranda | ' . $division->division->nama,
      'header' => 'Beranda ' . $division->division->nama,
    ]);
  }
  public function order()
  {
    // untuk menampilkan data sesuai dengan divisi user
    $users = UserDivision::where('division_id', Auth::guard('division')->user()->division_id)->get();

    $orders = [];
    foreach ($users as $user) {
      foreach ($user->divisionOrders as $order) {
        array_push($orders, $order);
      }
    }

    // untuk menampilkan nama divisi user
    $division = UserDivision::with('division')->where('division_id', Auth::guard('division')->user()->division_id)->first();

    return view('roles.kadiv.order', [
      'title' => 'Usulan |' . $division->division->nama,
      'header' => 'Usulan ' . $division->division->nama,
      'orders' => collect($orders)->sortByDesc('created_at')
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
