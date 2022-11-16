<?php

namespace App\Http\Controllers;

use App\Helpers\ApiFormatter;
use App\Helpers\DataAcceptedHelper;
use App\Http\Controllers\Controller;
use App\Models\DivisionOrder;
use App\Models\Inventory;
use App\Models\InventoryHp;
use App\Models\Propose;
use App\Models\ProposeHp;
use App\Models\Receive;
use App\Models\ReceiveHp;
use Illuminate\Http\Request;

class PpkController extends Controller
{
  public function index()
  {
    $valueHp = DataAcceptedHelper::dataHpAccepted();
    $values = DataAcceptedHelper::dataThpAccepted();

    return view('roles.ppk.index', [
      'proposeHp' => $valueHp,
      'proposes' => $values,
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

    $hp = '';
    foreach ($proposeHp as $value) {
      $hp = $value;
    }
    $thp = '';
    foreach ($propose as $value) {
      $thp = $value;
    }

    $div = DivisionOrder::findOrFail($id);

    return view('roles.ppk.orderDetail', [
      'title' => 'Detail Usulan',
      'header' => 'Detail Usulan ' . $div->userDivision->division->nama,
      'proposeHp' => $proposeHp,
      'propose' => $propose,
      'hp' => $hp,
      'thp' => $thp,
      'order_id' => $id
    ]);
  }

  public function acceptedAll($id)
  {
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

  public function itemReceived(Request $request, $id)
  {
    if ($request->dataType === 'hp') {
      $data = ProposeHp::findOrFail($id);
      $data->jumlah_hp = $data->jumlah_hp - $request->dataNumb;
      $data->deskripsi = $request->dataDesc;
      $data->save();

      // cek apakah data didalam receiveHp ada
      $received = ReceiveHp::where('propose_hp_id', $id)->exists();

      if (!$received) {
        $newReceived = ReceiveHp::with('proposeHp')->create([
          'propose_hp_id' => $id,
          'jumlah' => $request->dataNumb
        ]);

        $invenId =  $newReceived->proposeHp->inventory_hp_id; // 2
        $proposeName = $newReceived->proposeHp->usulan_hp;
        $divId = $newReceived->proposeHp->divisionOrder->userDivision->division->id;

        $inventory = InventoryHp::where('id', $invenId)->exists();

        if ($inventory) {
          $invenHp = InventoryHp::findOrFail($invenId);
          $invenHp->total = ($invenHp->total + $newReceived->jumlah);
          $invenHp->save();
        } else {
          InventoryHp::create([
            'division_id' => $divId,
            'nama_barang' => $proposeName,
            'total' => $newReceived->jumlah
          ]);
        }

        $jumlahUsulan = $data->jumlah_hp;
        if ($jumlahUsulan === 0) {
          $data->jumlah_hp = $newReceived->jumlah;
          $data->status = 'diterima';
          $data->save();
        }
      } else {
        $dataReceved = ReceiveHp::with('proposeHp')->where('propose_hp_id', $id)->first();
        // mengambil invenvtory id dari usulan yang diterima
        $invenId =  $dataReceved->proposeHp->inventory_hp_id; // 2
        // mengambil data inventory berdasarkan id inven dari usulan yang diterima
        $invenHp = InventoryHp::findOrFail($invenId); // 2
        // merubah data total menjadi data semula
        $invenTotal = $invenHp->total - $dataReceved->jumlah; // data awal dari inventory total

        // mengupdate data jumlah di receive
        $dataReceved->jumlah = $dataReceved->jumlah + $request->dataNumb; // 1 + 1 = 2
        $invenHp->total = $invenTotal + $dataReceved->jumlah;

        $dataReceved->save();
        $invenHp->save();

        $jumlahUsulan = $data->jumlah_hp;
        if ($jumlahUsulan === 0) {
          $data->jumlah_hp = $dataReceved->jumlah;
          $data->status = 'diterima';
          $data->save();
        }
      }

      $request->session()->flash('success', 'Barang telah diterima');
      return ApiFormatter::createdApi(200, $data);
    }

    if ($request->dataType === 'thp') {
      $data = Propose::findOrFail($id);
      $data->jumlah_thp = $data->jumlah_thp - $request->dataNumb;
      $data->deskripsi = $request->dataDesc;
      $data->save();

      $received = Receive::where('propose_id', $id)->exists();

      if (!$received) {
        $newReceived = Receive::with('propose')->create([
          'propose_id' => $id,
          'jumlah' => $request->dataNumb
        ]);

        $invenId =  $newReceived->propose->inventory_id; // 2
        $proposeName = $newReceived->propose->usulan_thp;
        $divId = $newReceived->propose->divisionOrder->userDivision->division->id;

        $inventory = Inventory::where('id', $invenId)->exists();

        if ($inventory) {
          $inven = Inventory::findOrFail($invenId);
          $inven->baik = ($inven->baik + $newReceived->jumlah);
          $inven->save();
        } else {
          Inventory::create([
            'division_id' => $divId,
            'nama_barang' => $proposeName,
            'baik' => $newReceived->jumlah,
            'rusak_ringan' => 0,
            'rusak_berat' => 0
          ]);
        }

        $jumlahUsulan = $data->jumlah_hp;
        if ($jumlahUsulan === 0) {
          $data->jumlah_thp = $newReceived->jumlah;
          $data->status = 'diterima';
          $data->save();
        }
      } else {
        $dataReceved = Receive::with('propose')->where('propose_id', $id)->first();
        // mengambil invenvtory id dari usulan yang diterima
        $invenId =  $dataReceved->propose->inventory_id; // 2
        // mengambil data inventory berdasarkan id inven dari usulan yang diterima
        $inven = Inventory::findOrFail($invenId); // 2
        // merubah data baik menjadi data semula
        $invenBaik = $inven->baik - $dataReceved->jumlah; // data awal dari inventory baik

        // mengupdate data jumlah di receive
        $dataReceved->jumlah = $dataReceved->jumlah + $request->dataNumb; // 1 + 1 = 2
        $inven->baik = $invenBaik + $dataReceved->jumlah;

        $dataReceved->save();
        $inven->save();

        $jumlahUsulan = $data->jumlah_hp;
        if ($jumlahUsulan === 0) {
          $data->jumlah_thp = $dataReceved->jumlah;
          $data->status = 'diterima';
          $data->save();
        }
      }

      $request->session()->flash('success', 'Barang Telah diterima');
      return ApiFormatter::createdApi(200, $data);
    }
  }

  public function received()
  {
    $data = [];
    for ($i = 0; $i < 2; $i++) {
      $received = $i === 0 ? ReceiveHp::with('proposeHp')->get() : Receive::with('propose')->get();
      $type = $i === 0 ? 'hp' : 'thp';

      foreach ($received as $receive) {
        $receivedId = $receive->id;
        $receivedName = $i === 0 ? $receive->proposeHp->usulan_hp : $receive->propose->usulan_thp;
        $divisionName = $i === 0 ? $receive->proposeHp->divisionOrder->userDivision->division->nama : $receive->propose->divisionOrder->userDivision->division->nama;
        $amount = $i === 0 ? $receive->proposeHp->jumlah_hp : $receive->propose->jumlah_thp;
        $proposeDate = $i === 0 ? $receive->proposeHp->created_at : $receive->propose->created_at;
        $status = $i === 0 ? $receive->proposeHp->status : $receive->propose->status;
        $receivedDate = $receive->updated_at;

        $firstAmount = '';
        if ($status === 'diterima') {
          $firstAmount = $receive->jumlah;
        } else {
          $firstAmount = $amount + $receive->jumlah;
        }

        $receivedAmount = $receive->jumlah;

        if ($status !== 'diterima') {
          $data[$type][$divisionName][$receivedName] = [
            'id' => $receivedId,
            'first_amount' => $firstAmount,
            'received_amount' => $receivedAmount,
            'propose_date' => $proposeDate,
            'received_date' => $receivedDate
          ];
        }
      }
    }

    return view('roles.ppk.revceived', [
      'proposes' => $data,
    ]);
  }

  public function detailReceived($id, $type)
  {
    $data = [];
    $received = $type === 'hp' ? ReceiveHp::with('proposeHp')->find($id) : Receive::with('propose')->find($id);

    $divisionName = $type === 'hp' ? $received->proposeHp->divisionOrder->userDivision->division->nama : $received->propose->divisionOrder->userDivision->division->nama;
    $receivedName = $type === 'hp' ? $received->proposeHp->usulan_hp : $received->propose->usulan_thp;
    $amount = $received->jumlah;
    $receivedSpesification = $type === 'hp' ? $received->proposeHp->spesifikasi_hp : $received->propose->spesifikasi_thp;
    $receivedJustification = $type === 'hp' ? $received->proposeHp->justifikasi_hp : $received->propose->justifikasi_thp;
    $receivedDesc = $type === 'hp' ? $received->proposeHp->deskripsi : $received->propose->deskripsi;

    $data[$type] = [
      'bagian' => $divisionName,
      'usulan' => $receivedName,
      'jumlah' => $amount,
      'spesisikasi' => $receivedSpesification,
      'justifikasi' => $receivedJustification,
      'deskripsi' => $receivedDesc
    ];

    return view('roles.ppk.detailReceived', [
      'proposes' => $data
    ]);
  }
}
