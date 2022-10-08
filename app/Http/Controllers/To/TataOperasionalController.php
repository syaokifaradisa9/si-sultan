<?php

namespace App\Http\Controllers\To;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TataOperasionalController extends Controller
{
  public function index()
  {
    return view('roles.tata_operasional.index');
  }
  public function order()
  {
    return view('roles.tata_operasional.order', [
      'header' => 'Order'
    ]);
  }
  public function orderDetail()
  {
    return view('roles.tata_operasional.orderDetail', [
      'header' => 'Detail'
    ]);
  }
}
