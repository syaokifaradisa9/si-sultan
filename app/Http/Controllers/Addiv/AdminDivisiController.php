<?php

namespace App\Http\Controllers\Addiv;

use App\Models\Inventory;
use App\Models\InventoryHp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProposeRequest;
use App\Models\DivisionOrder;
use App\Models\Propose;
use App\Models\ProposeHp;
use Illuminate\Support\Facades\Auth;
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
      if ($type == 'hp') {
        $data = InventoryHp::all();
        return DataTables::of($data)->make(true);
      }
      if ($type == 'thp') {
        $data = Inventory::all();
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
      'header' => 'Usulan',
      'hp' => InventoryHp::all(),
      'thp' => Inventory::all()
    ]);
  }
  public function orderDetail()
  {
    return view('roles.admin.orderDetail', [
      'header' => 'Detail'
    ]);
  }

  public function store(ProposeRequest $request)
  {
    $divOrder = DivisionOrder::create([
      'user_division_id' => Auth::guard('division')->user()->id
    ]);

    $data_hp = $request->usulan_hp;
    $count_hp = count($data_hp);


    for ($i = 0; $i < $count_hp; $i++) {
      $name_hp = $request->usulan_hp[$i];

      if (is_numeric($name_hp)) {
        $name_hp = InventoryHp::find($name_hp)->nama_barang;
      }

      ProposeHp::create([
        'division_order_id' => $divOrder->id,
        'usulan_hp' => $name_hp,
        'jumlah_hp' => $request->jumlah_hp[$i],
        'spesifikasi_hp' => $request->spesifikasi_hp[$i],
        'justifikasi_hp' => $request->justifikasi_hp[$i]
      ]);
    }

    $data_thp = $request->usulan_thp;
    $count_thp = count($data_thp);

    for ($i = 0; $i  < $count_thp; $i++) {
      $name_thp = $request->usulan_thp[$i];

      if (is_numeric($name_thp)) {
        $name_thp = Inventory::find($name_thp)->nama_barang;
      }

      Propose::create([
        'division_order_id' => $divOrder->id,
        'usulan_thp' => $name_thp,
        'jumlah_thp' => $request->jumlah_thp[$i],
        'spesifikasi_thp' => $request->spesifikasi_thp[$i],
        'justifikasi_thp' => $request->justifikasi_thp[$i]
      ]);
    }

    return redirect()->route('addiv.order')->with('success', 'Usulan berhasil ditambahkan');
  }
}
