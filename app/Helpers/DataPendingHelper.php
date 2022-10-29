<?php

namespace App\Helpers;

use App\Models\Propose;
use App\Models\ProposeHp;
use Illuminate\Support\Facades\Auth;

class DataPendingHelper
{
  public static function getHpPending()
  {
    $dataHp = [];
    $proposes = ProposeHp::with('divisionOrder')->get()->sortByDesc('updated_at');
    $type = "hp";

    foreach ($proposes as $propose) {
      $proposeName = $propose->usulan_hp;
      $div_order_id = $propose->division_order_id;
      $inventory_id = $propose->inventory_hp_id;
      $divisionId = $propose->divisionOrder->userDivision->division->id;
      $status = $propose->status;

      $filteredPrepose = $proposes->filter(function ($proposeItem) use ($div_order_id, $proposeName, $inventory_id, $divisionId, $status) {
        $isDivisionOrderSame = $proposeItem->division_order_id === $div_order_id;
        $isProposeNameSame =  $proposeItem->usulan_hp  === $proposeName;
        $isInventoryIdSame =  $proposeItem->inventory_hp_id === $inventory_id;
        $isDivNameSame = Auth::guard('division')->user()->division_id === $divisionId;
        $isStatusSame = $proposeItem->status === $status;
        return $isDivisionOrderSame && $isProposeNameSame && $isInventoryIdSame && $isDivNameSame && $isStatusSame;
      });

      $filteredPending = $filteredPrepose->filter(fn ($proposeItem) => $proposeItem->status == "ditunda");

      $uniqueCode = '';
      foreach ($filteredPending as $value) {
        $uniqueCode = $uniqueCode . ($uniqueCode == '' ? "" : "-") . $value->id;
      }

      $finalProposeCount = $filteredPending->sum("jumlah_hp");

      if ($finalProposeCount !== 0) {
        $isFilled = isset($data[$type][$proposeName]);
        if (!$isFilled) {
          $dataHp[$type][$proposeName] = [
            'id' => $uniqueCode,
          ];
        }
      }
    }

    $valueHp = [];
    foreach ($dataHp as $data) {
      foreach ($data as $id) {
        $dataId = explode('-', $id['id']);
        foreach ($dataId as $value) {
          $proposeHp = ProposeHp::with('divisionOrder')->find($value);

          array_push($valueHp, $proposeHp);
        }
      }
    }

    return $valueHp;
  }

  public static function getThpPending()
  {
    // Barang Tidak Habis Pakai
    $datas = [];
    $proposes = Propose::with('divisionOrder')->get()->sortByDesc('updated_at');
    $type = "thp";

    foreach ($proposes as $propose) {
      $proposeName = $propose->usulan_thp;
      $div_order_id = $propose->division_order_id;
      $inventory_id = $propose->inventory_id;
      $divisionId = $propose->divisionOrder->userDivision->division->id;
      $status = $propose->status;

      $filteredPrepose = $proposes->filter(function ($proposeItem) use ($div_order_id, $proposeName, $inventory_id, $divisionId, $status) {
        $isDivisionOrderSame = $proposeItem->division_order_id === $div_order_id;
        $isProposeNameSame =  $proposeItem->usulan_thp  === $proposeName;
        $isInventoryIdSame =  $proposeItem->inventory_id === $inventory_id;
        $isDivNameSame = Auth::guard('division')->user()->division_id === $divisionId;
        $isStatusSame = $proposeItem->status === $status;
        return $isDivisionOrderSame && $isProposeNameSame && $isInventoryIdSame && $isDivNameSame && $isStatusSame;
      });

      $filteredPending = $filteredPrepose->filter(fn ($proposeItem) => $proposeItem->status == "ditunda");

      $uniqueCode = '';
      foreach ($filteredPending as $value) {
        $uniqueCode = $uniqueCode . ($uniqueCode == '' ? "" : "-") . $value->id;
      }

      $finalProposeCount = $filteredPending->sum("jumlah_thp");

      if ($finalProposeCount !== 0) {
        $isFilled = isset($data[$type][$proposeName]);
        if (!$isFilled) {
          $datas[$type][$proposeName] = [
            'id' => $uniqueCode,
          ];
        }
      }
    }

    $values = [];
    foreach ($datas as $data) {
      foreach ($data as $id) {
        $dataId = explode('-', $id['id']);
        foreach ($dataId as $value) {
          $proposes = Propose::with('divisionOrder')->find($value);

          array_push($values, $proposes);
        }
      }
    }

    return $values;
  }
}
