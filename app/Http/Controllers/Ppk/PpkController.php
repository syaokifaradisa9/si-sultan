<?php

namespace App\Http\Controllers\Ppk;

use App\Http\Controllers\Controller;
use App\Models\DivisionOrder;
use Illuminate\Http\Request;

class PpkController extends Controller
{
  public function index()
  {
    return view('roles.ppk.index', [
      'title' => 'Beranda | PPK',
      'header' => 'Beranda PPK'
    ]);
  }

  public function order()
  {
    $orders = DivisionOrder::with('userDivision')->where('approved_by_kadiv', 1)->where('approved_by_mutu', 1)->where('approved_by_adum', 1)->where('approved_by_kepala', 1)->get();


    return view('roles.ppk.order', [
      'title' => 'Order | PPK',
      'header' => 'Order PPK',
      'orders' => collect($orders)->sortByDesc('created_at'),
    ]);
  }
}
