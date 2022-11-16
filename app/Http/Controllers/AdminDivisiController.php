<?php

namespace App\Http\Controllers;

use App\Helpers\DataPendingHelper;
use App\Helpers\DBHelper;
use App\Helpers\RequestHelper;
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
    $division = UserDivision::with('division')->where('division_id', Auth::guard('division')->user()->division_id)->first();

    $valueHp = DataPendingHelper::getHpPending();
    $values = DataPendingHelper::getThpPending();

    $hp = '';
    foreach ($valueHp as $value) {
      $hp = $value;
    }

    $thp = '';
    foreach ($values as $value) {
      $thp = $value;
    }

    return view('roles.admin.index', [
      'title' => 'Beranda | ' . $division->division->nama,
      'header' => 'Beranda ' . $division->division->nama,
      'proposeHp' => $valueHp,
      'proposes' => $values,
      'hp' => $hp,
      'thp' => $thp
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
    $division = UserDivision::with('division')->where('division_id', Auth::guard('division')->user()->division_id)->first();

    return view('roles.admin.order', [
      'title' => 'Usulan | ' . $division->division->nama,
      'header' => 'Usulan ' . $division->division->nama,
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

  public function store(Request $request)
  {
    $proposeHp = RequestHelper::requestHp($request);
    $proposeThp = RequestHelper::requestThp($request);

    if ($proposeHp || $proposeThp) {
      $divOrder = DivisionOrder::create([
        'user_division_id' => Auth::guard('division')->user()->id
      ]);
    }

    if ($proposeHp) {
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
    }

    if ($proposeThp) {
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

  public function update(Request $request, $id)
  {
    $proposeHp = RequestHelper::requestHp($request);
    $proposeThp = RequestHelper::requestThp($request);

    // menghapus deskripsi by mutu
    $desc = DivisionOrder::findOrFail($id);
    if ($desc->description_by_mutu) {
      $desc->description_by_mutu = null;
      $desc->save();
    }

    if ($proposeHp) {
      // menghapus tabel usulan habis pakai
      ProposeHp::where('division_order_id', $id)->delete();
      // reset auto increment id
      DBHelper::resetAutoIncrement('propose_hps');
    }

    if ($proposeThp) {
      // menghapus tabel usulan tidak habis pakai
      Propose::where('division_order_id', $id)->delete();
      // reset auto increment id
      DBHelper::resetAutoIncrement('proposes');
    }


    if ($proposeHp) {
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
    }

    if ($proposeThp) {
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
    }

    return redirect()->route('addiv.order')->with('success', 'Usulan berhasil diperbaharui');
  }

  public function reapply()
  {
    $valueHp = DataPendingHelper::getHpPending();
    $values = DataPendingHelper::getThpPending();

    dd($valueHp);

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
    // mengupdate status data lama menjadi diajukan kembali
    $proposeHp = ProposeHp::findOrFail($request->id_hp);
    $propose = Propose::findOrFail($request->id_thp);

    foreach ($proposeHp as $hp) {
      $hp->status = 'diajukan kembali';
      $hp->save();
    }
    foreach ($propose as $thp) {
      $thp->status = 'diajukan kembali';
      $thp->save();
    }

    // menduplikat data lama untuk diajukan kembali dan merubah status menjadi diajukan
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
        'status' => 'diajukan'
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
        'status' => 'diajukan'
      ]);
    }

    return redirect()->route('addiv.home')->with('success', 'Usulan berhasil diajukan kembali');
  }

  public function inventory()
  {
    $divId = Auth::guard('division')->user()->division_id;

    return view('roles.admin.inventaris.inventory', [
      'invenHp' => InventoryHp::where('division_id', $divId)->get(),
      'invenThp' => Inventory::where('division_id', $divId)->get()
    ]);
  }

  public function createInventory()
  {
    return view('roles.admin.inventaris.create');
  }

  public function storeInventory(Request $request)
  {
    try {
      $inventoryHp = RequestHelper::inventoryHp($request);
      $inventoryThp = RequestHelper::inventoryThp($request);

      $divId = Auth::guard('division')->user()->division_id;

      if ($inventoryHp) {
        $inven_hp = $request->inventory_hp;
        $count_hp = count($inven_hp);

        for ($i = 0; $i < $count_hp; $i++) {
          InventoryHp::create([
            'division_id' => $divId,
            'nama_barang' => $request->inventory_hp[$i],
            'total' => $request->total_hp[$i]
          ]);
        }
      }

      if ($inventoryThp) {
        $inven_thp = $request->inventory_thp;
        $count_thp = count($inven_thp);


        for ($i = 0; $i < $count_thp; $i++) {
          if (($request->baik_thp[$i] + $request->rusak_ringan_thp[$i] + $request->rusak_berat_thp[$i]) > 0) {
            Inventory::create([
              'division_id' => $divId,
              'nama_barang' => $request->inventory_thp[$i],
              'baik' => $request->baik_thp[$i],
              'rusak_ringan' => $request->rusak_ringan_thp[$i],
              'rusak_berat' => $request->rusak_berat_thp[$i]
            ]);
          }
        }
      }
    } catch (\Throwable $e) {
      dd($e);
    }


    return redirect()->route('addiv.inventory')->with('success', 'Inventory Berhasil Ditambahkan');
  }

  public function updateInventory(Request $request, $id, $type)
  {
    if ($type === 'hp') {
      InventoryHp::where('id', $id)->update($request->except(['_method', '_token']));
    } else {
      Inventory::where('id', $id)->update($request->except(['_method', '_token']));
    }

    return redirect()->route('addiv.inventory')->with('success', 'Data berhasil diperbaharui');
  }

  public function deleteInventory($id, $type)
  {
    if ($type === 'hp') {
      InventoryHp::destroy($id);
    } else {
      Inventory::destroy($id);
    }

    return redirect()->route('addiv.inventory')->with('success', 'Data berhasil dihapus');
  }
}
