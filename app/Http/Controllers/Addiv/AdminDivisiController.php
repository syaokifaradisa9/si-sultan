<?php

namespace App\Http\Controllers\Addiv;

use App\Helpers\DBHelper;
use App\Models\Inventory;
use App\Models\InventoryHp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Http\Requests\UpdateRequest;
use App\Models\DivisionOrder;
use App\Models\Propose;
use App\Models\ProposeHp;
use App\Models\UserDivision;
use Illuminate\Support\Facades\Auth;

class AdminDivisiController extends Controller
{
  public function index()
  {
    return view('roles.admin.index', [
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
    return view('roles.admin.order', [
      'header' => 'Order',
      'divOrder' => $orders
    ]);
  }

  public function orderDetail($id)
  {
    $proposeHp = ProposeHp::where('division_order_id', $id)->get();
    $propose = Propose::where('division_order_id', $id)->get();

    $usulanHp = [];
    foreach ($proposeHp as $hp) {
      array_push($usulanHp, $hp);
    }

    $usulanThp = [];
    foreach ($propose as $thp) {
      array_push($usulanThp, $thp);
    }

    return view('roles.admin.orderDetail', [
      'header' => 'Detail',
      'hp' => $usulanHp,
      'thp' => $usulanThp,
      'order_id' => $id
    ]);
  }

  public function create()
  {
    return view('roles.admin.usulan', [
      'header' => 'Usulan',
      'hp' => InventoryHp::all(),
      'thp' => Inventory::all(),
      'type' => 'create'
    ]);
  }

  public function store(StoreRequest $request)
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

  public function edit($id)
  {
    $hp = ProposeHp::where('division_order_id', $id)->get();
    $thp = Propose::where('division_order_id', $id)->get();

    return view('roles.admin.usulan', [
      'header' => 'Edit Usulan',
      'invenHp' => InventoryHp::all(),
      'invenThp' => Inventory::all(),
      'hp' => $hp,
      'thp' => $thp,
      'order_id' => $id,
      'type' => 'edit',
    ]);
  }

  public function update(StoreRequest $request, $id)
  {
    // menghapus tabel usulan habis pakai
    ProposeHp::where('division_order_id', $id)->delete();
    // menghapus tabel usulan tidak habis pakai
    Propose::where('division_order_id', $id)->delete();

    DBHelper::resetAutoIncrement('propose_hps');
    DBHelper::resetAutoIncrement('proposes');

    $data_hp = $request->usulan_hp;
    $count_hp = count($data_hp);

    for ($i = 0; $i < $count_hp; $i++) {
      $name_hp = $request->usulan_hp[$i];

      if (is_numeric($name_hp)) {
        $name_hp = InventoryHp::find($name_hp)->nama_barang;
      }

      ProposeHp::create([
        'division_order_id' => $id,
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
        'division_order_id' => $id,
        'usulan_thp' => $name_thp,
        'jumlah_thp' => $request->jumlah_thp[$i],
        'spesifikasi_thp' => $request->spesifikasi_thp[$i],
        'justifikasi_thp' => $request->justifikasi_thp[$i]
      ]);
    }

    return redirect()->route('addiv.order')->with('success', 'Usulan berhasil diperbaharui');
  }
}
