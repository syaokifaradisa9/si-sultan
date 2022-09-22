<?php

namespace App\Http\Controllers\Addiv;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\InventoryHp;
use App\Models\Propose;
use Illuminate\Http\Request;

class AdminDivisiController extends Controller
{
  public function index()
  {
    return view('roles.admin.index', [
      'header' => 'Home',
      'inventories' => Inventory::all(),
      'inventory_hps' => InventoryHp::all()
    ]);
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

  public function store(Request $request)
  {
    dd($request->all());
  }
}
