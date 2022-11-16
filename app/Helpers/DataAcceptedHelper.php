<?php

namespace App\Helpers;

use App\Models\Propose;
use App\Models\ProposeHp;
use App\Models\Receive;
use App\Models\ReceiveHp;

class DataAcceptedHelper
{
  public static function dataHpAccepted()
  {
    $dataHp = [];
    $proposes = ProposeHp::with('divisionOrder')->where('status', 'disetujui')->get();
    $type = "hp";

    foreach ($proposes as $propose) {
      $proposeName = $propose->usulan_hp;
      $div_order_id = $propose->division_order_id;
      $inventory_id = $propose->inventory_hp_id;
      $status = $propose->status;

      $filteredPrepose = $proposes->filter(function ($proposeItem) use ($div_order_id, $proposeName, $inventory_id, $status) {
        $isDivisionOrderSame = $proposeItem->division_order_id === $div_order_id;
        $isProposeNameSame =  $proposeItem->usulan_hp  === $proposeName;
        $isInventoryIdSame =  $proposeItem->inventory_hp_id === $inventory_id;
        $isStatusSame = $proposeItem->status ===  $status;
        return $isDivisionOrderSame && $isProposeNameSame && $isInventoryIdSame && $isStatusSame;
      });

      $filteredPending = $filteredPrepose->filter(fn ($proposeItem) => $proposeItem->status == "disetujui");

      $uniqueCode = '';
      foreach ($filteredPending as $value) {
        $uniqueCode = $uniqueCode . ($uniqueCode == '' ? "" : "-") . $value->id;
      }

      $firstAmount = '';
      foreach ($filteredPending as $propose) {
        $received = ReceiveHp::with('proposeHp')->where('propose_hp_id', $propose->id)->get();
        foreach ($received as $receive) {
          if ($receive->proposeHp->status === 'diterima') {
            $firstAmount = $receive->jumlah;
          } else {
            $firstAmount = $receive->jumlah + $propose->jumlah_hp;
          }
        }
      }

      $finalProposeCount = $filteredPending->sum("jumlah_hp");

      if ($finalProposeCount !== 0) {
        $isFilled = isset($data[$type][$proposeName]);
        if (!$isFilled) {
          $dataHp[$type][$proposeName] = [
            'id' => $uniqueCode,
            'name' => $propose->usulan_hp,
            'accepted' => $firstAmount ? $firstAmount : $propose->jumlah_hp,
            'not_received' => $propose->jumlah_hp,
            'spesification' => $propose->spesifikasi_hp,
            'justification' => $propose->justifikasi_hp,
            'status' => $propose->status
          ];
        }
      }
    }

    return $dataHp;
  }

  public static function dataThpAccepted()
  {
    $datas = [];
    $proposes = Propose::with('divisionOrder')->where('status', 'disetujui')->get();
    $type = "thp";

    foreach ($proposes as $propose) {
      $proposeName = $propose->usulan_thp;
      $div_order_id = $propose->division_order_id;
      $inventory_id = $propose->inventory_id;
      $status = $propose->status;

      $filteredPrepose = $proposes->filter(function ($proposeItem) use ($div_order_id, $proposeName, $inventory_id, $status) {
        $isDivisionOrderSame = $proposeItem->division_order_id === $div_order_id;
        $isProposeNameSame =  $proposeItem->usulan_thp  === $proposeName;
        $isInventoryIdSame =  $proposeItem->inventory_id === $inventory_id;
        $isStatusSame = $proposeItem->status ===  $status;
        return $isDivisionOrderSame && $isProposeNameSame && $isInventoryIdSame && $isStatusSame;
      });

      $filteredPending = $filteredPrepose->filter(fn ($proposeItem) => $proposeItem->status == "disetujui");

      $uniqueCode = '';
      foreach ($filteredPending as $value) {
        $uniqueCode = $uniqueCode . ($uniqueCode == '' ? "" : "-") . $value->id;
      }

      $firstAmount = '';
      foreach ($filteredPending as $propose) {
        $received = Receive::with('propose')->where('propose_id', $propose->id)->get();
        foreach ($received as $receive) {
          if ($receive->propose->status === 'diterima') {
            $firstAmount = $receive->jumlah;
          } else {
            $firstAmount = $receive->jumlah + $propose->jumlah_thp;
          }
        }
      }

      $finalProposeCount = $filteredPending->sum("jumlah_thp");

      if ($finalProposeCount !== 0) {
        $isFilled = isset($data[$type][$proposeName]);
        if (!$isFilled) {
          $datas[$type][$proposeName] = [
            'id' => $uniqueCode,
            'name' => $propose->usulan_thp,
            'accepted' => $firstAmount ? $firstAmount : $propose->jumlah_thp,
            'not_received' => $propose->jumlah_thp,
            'spesification' => $propose->spesifikasi_thp,
            'justification' => $propose->justifikasi_thp,
            'status' => $propose->status
          ];
        }
      }
    }

    return $datas;
  }
}
