<?php

namespace App\Http\Controllers\Addiv;

use App\Models\Inventory;
use App\Models\InventoryHp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class AdminDivisiController extends Controller
{
  public function index()
  {
    return view('roles.admin.index', [
      'header' => 'Beranda',
    ]);
  }

  public function datatable(Request $request, $type)
  {
    if ($request->ajax()) {
      if ($type == 'thp') {
        $data = Inventory::all();
        return DataTables::of($data)->make(true);
      } else {
        $data = InventoryHp::all();
        return DataTables::of($data)->make(true);
      }
    }
  }

  public function order()
  {
    return view('roles.admin.order', [
      'header' => 'Order'
    ]);
  }

  public function usulan()
  {
    return view('roles.admin.usulan', [
      'header' => 'Usulan'
    ]);
  }
  public function orderDetail()
  {
    return view('roles.admin.orderDetail', [
      'header' => 'Detail'
    ]);
  }

  public function store(Request $request)
  {
    dd($request->all());
  }
}
