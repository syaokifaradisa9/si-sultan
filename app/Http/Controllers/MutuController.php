<?php

namespace App\Http\Controllers;

use App\Helpers\ApiFormatter;
use App\Http\Controllers\Controller;
use App\Models\DivisionOrder;
use App\Models\Propose;
use App\Models\ProposeHp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    $divOrders = DivisionOrder::with('userDivision')->where('approved_by_kadiv', 1)->orderBy('created_at', 'DESC')->get();
    return view('roles.mutu.order', [
      'title' => 'Usulan',
      'header' => 'Usulan',
      'orders' => $divOrders
    ]);
  }
  public function orderDetail($id)
  {
    $order = DivisionOrder::findOrFail($id);
    return view('roles.mutu.orderDetail', compact('order'));
  }

  public function approvedByPpk()
  {
    $data = [];
    for ($i = 0; $i < 2; $i++) {
      $proposes = $i === 0 ? ProposeHp::with('divisionOrder')->get()->sortByDesc('updated_at') : Propose::with('divisionOrder')->get()->sortByDesc('updated_at');
      $type = $i === 0 ? "hp" : "thp";

      foreach ($proposes as $propose) {
        $proposeName = $i === 0 ? $propose->usulan_hp : $propose->usulan_thp;
        $divisionOrderId = $propose->division_order_id;
        $inventoryId = $i === 0 ? $propose->inventory_hp_id : $propose->inventory_id;

        $filteredPrepose = $proposes->filter(function ($proposeItem) use ($proposeName, $divisionOrderId, $inventoryId, $i) {
          $isProposeNameSame = ($i === 0 ? $proposeItem->usulan_hp : $proposeItem->usulan_thp) === $proposeName;
          $isDivisionOrderSame = $proposeItem->division_order_id === $divisionOrderId;
          $isInvetoryIdSame = ($i === 0 ? $proposeItem->inventory_hp_id : $proposeItem->inventory_id) === $inventoryId;
          return $isProposeNameSame && $isDivisionOrderSame && $isInvetoryIdSame;
        });

        $filteredApproved = $filteredPrepose->filter(fn ($proposeItem) => $proposeItem->status == "disetujui");

        $uniqueCode = '';
        foreach ($filteredApproved as $value) {
          $uniqueCode = $uniqueCode . ($uniqueCode == '' ? "" : "-") . $value->id;
        }

        $finalProposeCount = $filteredApproved->sum("jumlah_$type");

        if ($finalProposeCount !== 0) {
          $divisionName = $propose->divisionOrder->userDivision->division->nama;
          $startProposeCount = $filteredPrepose->sum("jumlah_$type");

          $proposeDate = $propose->created_at;
          $approvedDate = $propose->updated_at;

          $isFilled = isset($data[$type][$divisionName][$proposeName]);

          if (!$isFilled) {
            $data[$type][$divisionName][$proposeName] = [
              'id' => $uniqueCode,
              'start' => $startProposeCount,
              'final' => $finalProposeCount,
              'propose_date' => $proposeDate,
              'approved_date' => $approvedDate
            ];
          }
        }
      }
    }

    return view('roles.mutu.approved', [
      'header' => 'Usulan yang disetujui oleh PPK',
      'proposals' => $data
    ]);
  }

  public function detailApproved($id, $type)
  {
    $dataId = explode("-", $id);

    $data = [];
    foreach ($dataId as $value) {
      $proposes = $type === 'hp' ? ProposeHp::with('divisionOrder')->select("id", 'division_order_id', 'usulan_hp as usulan', 'jumlah_hp as jumlah', 'spesifikasi_hp as spesifikasi', 'justifikasi_hp as justifikasi', 'deskripsi')->find($value) : Propose::with('divisionOrder')->select("id", 'division_order_id', 'usulan_thp as usulan', 'jumlah_thp as jumlah', 'spesifikasi_thp as spesifikasi', 'justifikasi_thp as justifikasi', 'deskripsi')->find($value);

      array_push($data, $proposes);
    }

    return view('roles.mutu.detailApproved', [
      'proposes' => $data
    ]);
  }

  public function pendingByPpk()
  {
    $data = [];
    for ($i = 0; $i < 2; $i++) {
      // Pengambilan Habis Pakai Jika i = 0 dan seterusnya
      $proposes = $i === 0 ? ProposeHp::with('divisionOrder')->get()->sortByDesc('updated_at') : Propose::with('divisionOrder')->get()->sortByDesc('updated_at');
      $type = $i === 0 ? "hp" : "thp";

      // Proses Pendataan Usulan Ditolak
      foreach ($proposes as $propose) {
        // Atribut dari Usulan
        $proposeName = $i === 0 ? $propose->usulan_hp : $propose->usulan_thp;
        $div_order_id = $propose->division_order_id;
        $inventory_id = $i === 0 ? $propose->inventory_hp_id : $propose->inventory_id;

        // Memfilter Usulan Berdasarkan Order, Nama Barang Usulan, ID Inventory
        $filteredPrepose = $proposes->filter(function ($proposeItem) use ($div_order_id, $proposeName, $inventory_id, $i) {
          $isDivisionOrderSame = $proposeItem->division_order_id === $div_order_id;
          $isProposeNameSame = ($i === 0 ? $proposeItem->usulan_hp : $proposeItem->usulan_thp) === $proposeName;
          $isInventoryIdSame = ($i === 0 ? $proposeItem->inventory_hp_id : $proposeItem->inventory_id) === $inventory_id;
          return $isDivisionOrderSame && $isProposeNameSame && $isInventoryIdSame;
        });


        // Memfilter Usulan yang dipending
        $filteredPending = $filteredPrepose->filter(fn ($proposeItem) => $proposeItem->status == "ditunda");

        $uniqueCode = '';
        foreach ($filteredPending as $value) {
          $uniqueCode = $uniqueCode . ($uniqueCode == '' ? "" : "-") . $value->id;
        }

        // Perhitungan Jumlah Pending
        $finalProposeCount = $filteredPending->sum("jumlah_$type");

        // Jika Jumlah Pending Tidak Ada
        if ($finalProposeCount !== 0) {
          // Menghitung Jumlah Usulan Awal
          $startProposeCount = $filteredPrepose->sum("jumlah_$type");
          $divisionName = $propose->divisionOrder->userDivision->division->nama;

          // Tanggal Usulan dan Tanggal Penundaan Oleh PPK
          $proposeDate = $propose->created_at;
          $pendingDate = $propose->updated_at;

          // Jika Usulan Pending Divisi dan Barang Sudah Terdata 
          $isFilled = isset($data[$type][$divisionName][$proposeName]);

          // Filter Hanya Status Ditunda
          if (!$isFilled) {
            $data[$type][$divisionName][$proposeName] = [
              'id' => $uniqueCode,
              "start" => $startProposeCount,
              "final" => $finalProposeCount,
              "propose_date" => $proposeDate,
              "pending_date" => $pendingDate
            ];
          }
        }
      }
    }

    return view('roles.mutu.pending', [
      'header' => 'Usulan yang ditunda oleh PPK',
      'proposals' => $data,
    ]);
  }

  public function detailPending($id, $type)
  {
    $dataId = explode("-", $id);

    $data = [];
    foreach ($dataId as $value) {
      $proposes = $type === 'hp' ? ProposeHp::with('divisionOrder')->select("id", 'division_order_id', 'usulan_hp as usulan', 'jumlah_hp as jumlah', 'spesifikasi_hp as spesifikasi', 'justifikasi_hp as justifikasi', 'deskripsi')->find($value) : Propose::with('divisionOrder')->select("id", 'division_order_id', 'usulan_thp as usulan', 'jumlah_thp as jumlah', 'spesifikasi_thp as spesifikasi', 'justifikasi_thp as justifikasi', 'deskripsi')->find($value);

      array_push($data, $proposes);
    }

    return view('roles.mutu.detailPending', [
      'proposes' => $data,
    ]);
  }

  public function accept($id)
  {
    $orders = DivisionOrder::findOrFail($id);

    $orders->approved_by_mutu = 1;
    $orders->save();

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
