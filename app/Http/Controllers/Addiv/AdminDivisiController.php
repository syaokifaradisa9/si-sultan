<?php

namespace App\Http\Controllers\Addiv;

use App\Helpers\DataPendingHelper;
use App\Helpers\DBHelper;
use App\Models\Inventory;
use App\Models\InventoryHp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Models\DivisionOrder;
use App\Models\Propose;
use App\Models\ProposeHp;
use App\Models\UserDivision;
use Illuminate\Support\Facades\Auth;

class AdminDivisiController extends Controller
{
  public function index()
  {
    $division = UserDivision::with('division')->where('division_id', Auth::guard('division')->user()->division_id)->get();

    $divisions = [];
    foreach ($division as $div) {
      array_push($divisions, $div->division->nama);
    }

    $valueHp = DataPendingHelper::getHpPending();
    $values = DataPendingHelper::getThpPending();

    return view('roles.admin.index', [
      'title' => 'Beranda | ' . $divisions[0],
      'header' => 'Beranda ' . $divisions[0],
      'proposeHp' => $valueHp,
      'proposes' => $values,
    ]);
  }

  public function order()
  {
    // untuk menampilkan data sesuai dengan divisi user
    $users = UserDivision::with('divisionOrders')->where('division_id', Auth::guard('division')->user()->division_id)->get();

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

    return view('roles.admin.order', [
      'title' => 'Usulan | ' . $divisions[0],
      'header' => 'Usulan ' . $divisions[0],
      'divOrder' => collect($orders)->sortByDesc('created_at')
    ]);
  }

  public function orderDetail($id)
  {
    $divOrders = DivisionOrder::findOrFail($id);

    if ($divOrders->user_division_id !== Auth::guard('division')->user()->id) {
      return redirect()->route('addiv.order');
    }

    $proposeHp = ProposeHp::where('division_order_id', $id)->get();
    $propose = Propose::where('division_order_id', $id)->get();

    return view('roles.admin.orderDetail', [
      'header' => 'Detail',
      'order_id' => $id,
      'divOrder' => $divOrders,
      'proposeHp' => $proposeHp,
      'propose' => $propose
    ]);
  }

  public function create()
  {
    return view('roles.admin.usulan', [
      'header' => 'Usulan',
      'hp' => InventoryHp::where('division_id', Auth::guard('division')->user()->division_id)->get(),
      'thp' => Inventory::where('division_id', Auth::guard('division')->user()->division_id)->get(),
      'type' => 'create'
    ]);
  }

  public function store(StoreRequest $request)
  {
    // dd($request->all());
    $divOrder = DivisionOrder::create([
      'user_division_id' => Auth::guard('division')->user()->id
    ]);

    $data_hp = $request->usulan_hp;
    $count_hp = count($data_hp);

    for ($i = 0; $i < $count_hp; $i++) {
      $name_hp = $request->usulan_hp[$i];
      $invenId = $request->usulan_hp[$i];

      if (is_numeric($name_hp)) {
        $name_hp = InventoryHp::find($name_hp)->nama_barang;
      }

      if (is_numeric($invenId)) {
        $invenId = InventoryHp::find($invenId)->id;
      } else {
        $invenId = null;
      }

      ProposeHp::create([
        'inventory_hp_id' => $invenId,
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
      $invenId = $request->usulan_thp[$i];

      if (is_numeric($name_thp)) {
        $name_thp = Inventory::find($name_thp)->nama_barang;
      }

      if (is_numeric($invenId)) {
        $invenId = Inventory::find($invenId)->id;
      } else {
        $invenId = null;
      }

      Propose::create([
        'inventory_id' => $invenId,
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
    $divOrder = DivisionOrder::findOrFail($id);

    if ($divOrder->approved_by_kadiv === 1 && !$divOrder->description_by_mutu) {
      return redirect()->back();
    }

    $divId = Auth::guard('division')->user()->division_id;

    return view('roles.admin.usulan', [
      'header' => 'Edit Usulan',
      'invenHp' => InventoryHp::where('division_id', $divId)->get(),
      'invenThp' => Inventory::where('division_id', $divId)->get(),
      'hp' => ProposeHp::with('inventoryHp')->where('division_order_id', $id)->get(),
      'thp' => Propose::with('inventory')->where('division_order_id', $id)->get(),
      'order_id' => $id,
      'type' => 'edit',
    ]);
  }

  public function update(StoreRequest $request, $id)
  {
    // menghapus deskripsi by mutu
    $desc = DivisionOrder::findOrFail($id);
    if ($desc->description_by_mutu) {
      $desc->description_by_mutu = null;
      $desc->save();
    }

    // menghapus tabel usulan habis pakai
    ProposeHp::where('division_order_id', $id)->delete();
    // menghapus tabel usulan tidak habis pakai
    Propose::where('division_order_id', $id)->delete();
    // reset auto increment id
    DBHelper::resetAutoIncrement('propose_hps');
    DBHelper::resetAutoIncrement('proposes');

    $data_hp = $request->usulan_hp;
    $count_hp = count($data_hp);

    for ($i = 0; $i < $count_hp; $i++) {
      $name_hp = $request->usulan_hp[$i];
      $invenId = $request->usulan_hp[$i];

      if (is_numeric($name_hp)) {
        $name_hp = InventoryHp::find($name_hp)->nama_barang;
      }

      if (is_numeric($invenId)) {
        $invenId = InventoryHp::find($invenId)->id;
      } else {
        $invenId = null;
      }

      ProposeHp::create([
        'inventory_hp_id' => $invenId,
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
      $invenId = $request->usulan_thp[$i];

      if (is_numeric($name_thp)) {
        $name_thp = Inventory::find($name_thp)->nama_barang;
      }

      if (is_numeric($invenId)) {
        $invenId = Inventory::find($invenId)->id;
      } else {
        $invenId = null;
      }

      Propose::create([
        'inventory_id' => $invenId,
        'division_order_id' => $id,
        'usulan_thp' => $name_thp,
        'jumlah_thp' => $request->jumlah_thp[$i],
        'spesifikasi_thp' => $request->spesifikasi_thp[$i],
        'justifikasi_thp' => $request->justifikasi_thp[$i]
      ]);
    }

    return redirect()->route('addiv.order')->with('success', 'Usulan berhasil diperbaharui');
  }

  public function reapply()
  {
    $valueHp = DataPendingHelper::getHpPending();
    $values = DataPendingHelper::getThpPending();

    $divId = Auth::guard('division')->user()->division_id;

    return view('roles.admin.reapply', [
      'header' => 'Pengajuan Ulang Usulan',
      'proposeHp' => $valueHp,
      'proposes' => $values,
      'invenHp' => InventoryHp::where('division_id', $divId)->get(),
      'invenThp' => Inventory::where('division_id', $divId)->get(),
    ]);
  }

  public function storeReapply(Request $request)
  {
    // dd($request->all());

    $valueHp = DataPendingHelper::getHpPending();
    $values = DataPendingHelper::getThpPending();

    // dd($values);
    foreach ($valueHp as $hp) {
      $hp->delete();
    }

    foreach ($values as $thp) {
      $thp->delete();
    }

    DBHelper::resetAutoIncrement('propose_hps');
    DBHelper::resetAutoIncrement('proposes');


    $divOrderId = DivisionOrder::create([
      'user_division_id' => Auth::guard('division')->user()->id
    ]);

    $data_hp = $request->usulan_hp;
    $count_hp = count($data_hp);

    for ($i = 0; $i < $count_hp; $i++) {
      $name_hp = $request->usulan_hp[$i];
      $invenId = $request->usulan_hp[$i];

      if (is_numeric($name_hp)) {
        $name_hp = InventoryHp::find($name_hp)->nama_barang;
      }

      if (is_numeric($invenId)) {
        $invenId = InventoryHp::find($invenId)->id;
      } else {
        $invenId = null;
      }

      ProposeHp::create([
        'inventory_hp_id' => $invenId,
        'division_order_id' => $divOrderId->id,
        'usulan_hp' => $name_hp,
        'jumlah_hp' => $request->jumlah_hp[$i],
        'spesifikasi_hp' => $request->spesifikasi_hp[$i],
        'justifikasi_hp' => $request->justifikasi_hp[$i],
        'status' => 'diajukan kembali'
      ]);
    }

    $data_thp = $request->usulan_thp;
    $count_thp = count($data_thp);

    for ($i = 0; $i  < $count_thp; $i++) {
      $name_thp = $request->usulan_thp[$i];
      $invenId = $request->usulan_thp[$i];

      if (is_numeric($name_thp)) {
        $name_thp = Inventory::find($name_thp)->nama_barang;
      }

      if (is_numeric($invenId)) {
        $invenId = Inventory::find($invenId)->id;
      } else {
        $invenId = null;
      }

      Propose::create([
        'inventory_id' => $invenId,
        'division_order_id' => $divOrderId->id,
        'usulan_thp' => $name_thp,
        'jumlah_thp' => $request->jumlah_thp[$i],
        'spesifikasi_thp' => $request->spesifikasi_thp[$i],
        'justifikasi_thp' => $request->justifikasi_thp[$i],
        'status' => 'diajukan kembali'
      ]);
    }

    return redirect()->route('addiv.home')->with('success', 'Usulan berhasil diajukan kembali');
  }
}
