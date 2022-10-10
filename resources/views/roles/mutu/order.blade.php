@extends('layouts.main')

@section('container')
  <div class="section-body">
    <h2 class="section-title">Order</h2>
    <p class="section-lead">Tabel order dari usulan yang ada</p>

    <div class="card">
      <div class="card-header">
        <h4>Tabel Order</h4>
        <div class="ml-auto">
          <a href="" class="btn btn-success">Konfirmasi</a>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped table-md">
            <tr class="text-center">
              <th>No</th>
              <th>Order</th>
              <th>Tanggal Usulan</th>
              <th>Deskripsi Usulan</th>
              <th>Aksi</th>
            </tr>
            @foreach ($orders as $order)
              @if ($order->approved_by_kadiv)
                <tr class="text-center">
                  <td class="align-middle">{{ $loop->iteration }}</td>
                  <td class="align-middle">{{ $order->userDivision->division->nama }}</td>
                  <td class="align-middle">{{ date_format($order->created_at, 'd/m/Y H:i') }}</td>
                  <td>
                    {{ count($order->proposeHp) . ' Barang Habis Pakai' }} <br>
                    {{ count($order->propose) . ' Barang Tidak Habis Pakai' }}
                  </td>
                  <td>
                    <a href="{{ route('mutu.orderDetail', [$order->id]) }}" class="btn btn-primary">Detail</a>
                    @if (!$order->approved_by_mutu)
                      <a href="{{ route('mutu.accept', ['id' => $order->id]) }}" class="btn btn-success"
                        onclick="confirm('Apakah anda yakin?')">Konfirmasi</a>
                    @endif
                    <a href="" class="btn btn-danger" onclick="confirm('Apakah anda yakin?')">Tolak</a>
                  </td>
                </tr>
              @endif
            @endforeach
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection
