<?php

namespace App\Http\Controllers\API;

use App\Helpers\ApiFormatter;
use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\InventoryHp;
use Illuminate\Http\Request;

class ApiController extends Controller
{
  public function getOption($type)
  {
    if ($type === 'hp') {
      $data = InventoryHp::all();

      if ($data) {
        return ApiFormatter::createdApi(200, $data);
      }
    }

    if ($type === 'thp') {
      $data = Inventory::all();

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
}
