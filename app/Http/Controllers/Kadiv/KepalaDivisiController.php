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
    $division = UserDivision::with('division')->where('division_id', Auth::guard('division')->user()->division_id)->get();

    $divisions = [];
    foreach ($division as $div) {
      array_push($divisions, $div->division->nama);
    }

    return view('roles.kadiv.index', [
      'title' => 'Beranda | ' . $divisions[0],
      'header' => 'Beranda ' . $divisions[0],
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
    $division = UserDivision::with('division')->where('division_id', Auth::guard('division')->user()->division_id)->get();

    $divisions = [];
    foreach ($division as $div) {
      array_push($divisions, $div->division->nama);
    }

    return view('roles.kadiv.order', [
      'title' => 'Usulan |' . $divisions[0],
      'header' => 'Usulan ' . $divisions[0],
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
