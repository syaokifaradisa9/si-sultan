@extends('layouts.main')

@section('container')
  <div class="section-body">
    <h2 class="section-title">Order</h2>
    <p class="section-lead">Tabel order dari usulan yang telah disetujui oleh Kepala Urusan Administrasi Umum</p>

    @if (session()->has('success'))
      <div id="success" data-flash="{{ session('success') }}"></div>
    @endif

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
                <td class="align-middle">{{ date_format($order->created_at, 'd/m/Y H:i') }}</td>
                <td>
                  {{ count($order->proposeHp) . ' Barang Habis Pakai' }} <br>
                  {{ count($order->propose) . ' Tidak Barang Habis Pakai' }}
                </td>
                <td>
                  <a href="{{ route('lpfk.orderDetail', ['id' => $order->id]) }}" class="btn btn-primary">Detail</a>
                  @if (!$order->approved_by_kepala)
                    <a href="{{ route('lpfk.accept', ['id' => $order->id]) }}" class="btn btn-success btn-confirm" id="btn-confirm">Konfirmasi</a>
                  @endif
                </td>
              </tr>
            @endforeach
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection
