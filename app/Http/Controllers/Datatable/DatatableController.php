<?php

namespace App\Http\Controllers\Datatable;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\InventoryHp;
use App\Models\Propose;
use App\Models\ProposeHp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class DatatableController extends Controller
{
  public function home(Request $request, $type)
  {
    if ($request->ajax()) {
      if ($type == 'hp') {
        if (Auth::guard('division')->check()) {
          $data = InventoryHp::where('division_id', Auth::guard('division')->user()->division_id)->get();
          return DataTables::of($data)->make(true);
        } else {
          $data = InventoryHp::with('division')->get();
          return DataTables::of($data)->toJson();
        }
      }
      if ($type == 'thp') {
        if (Auth::guard('division')->check()) {
          $data = Inventory::where('division_id', Auth::guard('division')->user()->division_id)->get();
          return DataTables::of($data)->make(true);
        } else {
          $data = Inventory::with('division')->get();
          return DataTables::of($data)->make(true);
        }
      }
    }
  }

  public function detail(Request $request, $type, $id)
  {
    if ($request->ajax()) {
      $proposeHp = ProposeHp::where('division_order_id', $id)->get();
      $propose = Propose::with('divisionOrder')->where('division_order_id', $id)->get();

      $usulanHp = [];
      foreach ($proposeHp as $hp) {
        array_push($usulanHp, $hp);
      }

      $usulanThp = [];
      foreach ($propose as $thp) {
        array_push($usulanThp, $thp);
      }

      if ($type == 'hp') {
        $data = $usulanHp;
        $hp = DataTables::of($data);
        return $hp->make(true);
      }

      if ($type == 'thp') {
        $data = $usulanThp;
        $thp = DataTables::of($data);
        return $thp->toJson();
      }
    }
  }
}
