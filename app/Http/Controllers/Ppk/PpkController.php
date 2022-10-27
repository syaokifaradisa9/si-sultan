<?php

namespace App\Http\Controllers\Ppk;

use App\Helpers\ApiFormatter;
use App\Http\Controllers\Controller;
use App\Models\DivisionOrder;
use App\Models\Propose;
use App\Models\ProposeHp;
use Illuminate\Http\Request;

class PpkController extends Controller
{
  public function index()
  {
    return view('roles.ppk.index', [
      'title' => 'Beranda | PPK',
      'header' => 'Beranda'
    ]);
  }

  public function order()
  {
    $orders = DivisionOrder::with('userDivision')->where('approved_by_kadiv', 1)->where('approved_by_mutu', 1)->where('approved_by_adum', 1)->where('approved_by_kepala', 1)->get();

    return view('roles.ppk.order', [
      'title' => 'Usulan | PPK',
      'header' => 'Usulan',
      'orders' => collect($orders)->sortByDesc('created_at'),
    ]);
  }

  public function orderDetail($id)
  {
    $proposeHp = ProposeHp::where('division_order_id', $id)->get();
    $propose = Propose::where('division_order_id', $id)->get();

    $div = DivisionOrder::findOrFail($id);

    return view('roles.ppk.orderDetail', [
      'title' => 'Detail Usulan',
      'header' => 'Detail Usulan ' . $div->userDivision->division->nama,
      'proposeHp' => $proposeHp,
      'propose' => $propose,
      'order_id' => $id
    ]);
  }

  public function acceptedAll($id)
  {
    // $proposeHp = ProposeHp::where('division_order_id', $id)->where('status', 'diajukan')->get();
    $proposeHp = ProposeHp::where('division_order_id', $id)->where('status', 'diajukan')->get();
    $propose = Propose::where('division_order_id', $id)->where('status', 'diajukan')->get();

    foreach ($proposeHp as $thp) {
      $thp->status = 'disetujui';
      $thp->save();
    }

    foreach ($propose as $hp) {
      $hp->status = 'disetujui';
      $hp->save();
    }

    return redirect()->route('ppk.orderDetail', ['id' => $id])->with('success', 'Usulan telah dikonfirmasi');
  }

  public function approved($id, $type)
  {

    if ($type === 'hp') {
      $proposeHp = ProposeHp::findOrFail($id);

      $proposeHp->status = 'disetujui';
      $proposeHp->deskripsi = null;
      $proposeHp->save();
    }

    if ($type === 'thp') {
      $propose = Propose::findOrFail($id);

      $propose->status = 'disetujui';
      $propose->deskripsi = null;
      $propose->save();
    }

    return redirect()->back()->with('success', 'Usulan telah disetujui');
  }

  public function pending(Request $request, $id)
  {
    if ($request->dataType === 'hp') {
      $dataHp = ProposeHp::findOrFail($id);
      if ($request->dataNumb != $dataHp->jumlah_hp) {
        $new = $dataHp->create([
          'division_order_id' => $dataHp->division_order_id,
          'inventory_hp_id' => $dataHp->inventory_hp_id,
          'usulan_hp' => $dataHp->usulan_hp,
          'jumlah_hp' => $request->dataNumb,
          'spesifikasi_hp' => $dataHp->spesifikasi_hp,
          'justifikasi_hp' => $dataHp->justifikasi_hp,
          'status' => 'ditunda',
          'deskripsi' => $request->dataDesc
        ]);

        $jumlahUsulan = $dataHp->jumlah_hp;
        $jumlahTunda = $new->jumlah_hp;
        $dataHp->jumlah_hp = ($jumlahUsulan - $jumlahTunda);
        $dataHp->save();
      } else {
        $dataHp->status = 'ditunda';
        $dataHp->deskripsi = $request->dataDesc;
        $dataHp->save();
      }

      $request->session()->flash('success', 'Usulan sedang dipending');
      return ApiFormatter::createdApi(200, $dataHp);
    }

    if ($request->dataType === 'thp') {
      $data = Propose::findOrFail($id);
      if ($request->dataNumb != $data->jumlah_thp) {
        $new = $data->create([
          'division_order_id' => $data->division_order_id,
          'inventory_id' => $data->inventory_id,
          'usulan_thp' => $data->usulan_thp,
          'jumlah_thp' => $request->dataNumb,
          'spesifikasi_thp' => $data->spesifikasi_thp,
          'justifikasi_thp' => $data->justifikasi_thp,
          'status' => 'ditunda',
          'deskripsi' => $request->dataDesc
        ]);

        $jumlahUsulan = $data->jumlah_thp;
        $jumlahTunda = $new->jumlah_thp;
        $data->jumlah_thp = ($jumlahUsulan - $jumlahTunda);
        $data->save();
      } else {
        $data->status = 'ditunda';
        $data->deskripsi = $request->dataDesc;
        $data->save();
      }

      $request->session()->flash('success', 'Usulan sedang dipending');
      return ApiFormatter::createdApi(200, $data);
    }
  }
}
