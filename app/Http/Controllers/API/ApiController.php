<?php

namespace App\Http\Controllers\API;

use App\Models\Propose;
use App\Models\Inventory;
use App\Models\ProposeHp;
use App\Models\InventoryHp;
use Illuminate\Http\Request;
use App\Helpers\ApiFormatter;
use App\Models\DivisionOrder;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
  public function getOption($type)
  {
    if ($type === 'hp') {
      $data = InventoryHp::where('division_id', Auth::guard('division')->user()->division_id)->get();

      if ($data) {
        return ApiFormatter::createdApi(200, $data);
      }
    }

    if ($type === 'thp') {
      $data = Inventory::where('division_id', Auth::guard('division')->user()->division_id)->get();

      if ($data) {
        return ApiFormatter::createdApi(200, $data);
      }
    }
  }

  public function getBmn($id, $type)
  {
    if ($type === 'hp') {
      $data = InventoryHp::findOrFail($id);

      if ($data) {
        return ApiFormatter::createdApi(200, $data);
      }
    }

    if ($type === 'thp') {
      $data = Inventory::findOrFail($id);

      if ($data) {
        return ApiFormatter::createdApi(200, $data);
      }
    }
  }

  public function getPropose($id, $type)
  {
    if ($type === 'hp') {
      $data = ProposeHp::findOrFail($id);

      if ($data) {
        return ApiFormatter::createdApi(200, $data);
      }
    }

    if ($type === 'thp') {
      $data = Propose::findOrFail($id);

      if ($data) {
        return ApiFormatter::createdApi(200, $data);
      }
    }
  }
}
