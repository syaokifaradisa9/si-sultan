@extends('layouts.main')

@section('container')
  <div class="section-body">
    <h2 class="section-title">Order</h2>
    <p class="section-lead">Tabel order dari usulan yang ada</p>

    <div class="card">
      <div class="card-header">
        <h4>Tabel Order</h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped table-md">
            <tr class="text-center">
              <th>No</th>
              <th>Tanggal Usulan</th>
              <th>Deskripsi Usulan</th>
              <th>Aksi</th>
            </tr>
            @foreach ($orders as $order)
              <tr class="text-center">
                <td class="align-middle">{{ $loop->iteration }}</td>
                <td class="align-middle">{{ $order->created_at }}</td>
                <td>
                  {{ count($order->proposeHp) . ' Barang Habis Pakai' }} <br>
                  {{ count($order->proposeHp) . ' Tidak Barang Habis Pakai' }}
                </td>
                <td><a href="{{ route('kadiv.orderDetail', ['id' => $order->id]) }}" class="btn btn-primary">Detail</a>
                  <a href="" class="btn btn-success">Konfirmasi</a>
                </td>
              </tr>
            @endforeach
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection
