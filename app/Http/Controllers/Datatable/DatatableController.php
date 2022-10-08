<?php

namespace App\Http\Controllers\Datatable;

use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Models\DivisionOrder;
use App\Models\Inventory;
use App\Models\InventoryHp;
use App\Models\Propose;
use App\Models\ProposeHp;
use App\Models\UserDivision;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class DatatableController extends Controller
{
  public function homeAdmin(Request $request, $type)
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

  public function orderDetail(Request $request, $type, $id)
  {
    if ($request->ajax()) {
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

      if ($type == 'hp') {
        $data = $usulanHp;
        return DataTables::of($data)->make(true);
      }
      if ($type == 'thp') {
        $data = $usulanThp;
        return DataTables::of($data)->make(true);
      }
    }
  }
}
