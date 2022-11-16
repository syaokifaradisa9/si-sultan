<?php

namespace App\Helpers;

use Illuminate\Http\Request;

class RequestHelper
{
  public static function requestHp(Request $request)
  {
    $usulanHp = true;
    foreach ($request->usulan_hp as $hp) {
      if (empty($hp)) {
        $usulanHp = false;
      }
    }

    $jumlahHp = true;
    foreach ($request->jumlah_hp as $hp) {
      if (empty($hp)) {
        $jumlahHp = false;
      }
    }

    $spesifikasiHp = true;
    foreach ($request->spesifikasi_hp as $hp) {
      if (empty($hp)) {
        $spesifikasiHp = false;
      }
    }

    $justifikasiHp = true;
    foreach ($request->justifikasi_hp as $hp) {
      if (empty($hp)) {
        $justifikasiHp = false;
      }
    }

    $proposeHp = $usulanHp && $jumlahHp && $spesifikasiHp && $justifikasiHp;
    return $proposeHp;
  }

  public static function requestThp(Request $request)
  {
    $usulanThp = true;
    foreach ($request->usulan_thp as $thp) {
      if (empty($thp)) {
        $usulanThp = false;
      }
    }

    $jumlahThp = true;
    foreach ($request->jumlah_thp as $thp) {
      if (empty($thp)) {
        $jumlahThp = false;
      }
    }

    $spesifikasiThp = true;
    foreach ($request->spesifikasi_thp as $thp) {
      if (empty($thp)) {
        $spesifikasiThp = false;
      }
    }

    $justfikasiThp = true;
    foreach ($request->justifikasi_thp as $thp) {
      if (empty($thp)) {
        $justfikasiThp = false;
      }
    }

    $proposeThp = $usulanThp && $jumlahThp && $spesifikasiThp && $justfikasiThp;
    return $proposeThp;
  }

  public static function inventoryHp(Request $request)
  {
    $inventoryHp = true;
    foreach ($request->inventory_hp as $hp) {
      if (empty($hp)) {
        $inventoryHp = false;
      }
    }

    $total = true;
    foreach ($request->total_hp as $hp) {
      if (empty($hp)) {
        $total = false;
      }
    }

    $invenHp = $inventoryHp && $total;
    return $invenHp;
  }

  public static function inventoryThp(Request $request)
  {
    $inventoryThp = true;
    foreach ($request->inventory_thp as $thp) {
      if (is_null($thp)) {
        $inventoryThp = false;
      }
    }

    $goodStuff = true;
    foreach ($request->baik_thp as $thp) {
      if (is_null($thp)) {
        $goodStuff = false;
      }
    }

    $lightDamage = true;
    foreach ($request->rusak_ringan_thp as $thp) {
      if (is_null($thp)) {
        $lightDamage = false;
      }
    }

    $heavyDamage = true;
    foreach ($request->rusak_berat_thp as $thp) {
      if (is_null($thp)) {
        $heavyDamage = false;
      }
    }

    $invenThp = $inventoryThp && $goodStuff && $lightDamage && $heavyDamage;
    return $invenThp;
  }
}
