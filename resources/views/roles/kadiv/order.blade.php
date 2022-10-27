@extends('layouts.main')

@section('container')
  <div class="section-body">

    @if (session()->has('success'))
      <div id="success" data-flash="{{ session('success') }}"></div>
    @endif

    <div class="card">
      <div class="card-header">
        <h4>Tabel Usulan</h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped table-md">
            <tr class="text-center">
              <th>No</th>
              <th>Tanggal Usulan</th>
              <th>Deskripsi Usulan</th>
              <th>Status</th>
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
                <td class="align-middle {{ $order->approved_by_kadiv ? 'text-success' : '' }}">
                  {{ $order->approved_by_kadiv ? 'Telah dikonfirmasi' : 'Belum dikonfirmasi' }}</td>
                <td>
                  <div class="dropdown d-inline">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown">
                      <i class="fas fa-chevron-circle-down"></i>
                    </button>
                    <div class="dropdown-menu">
                      <a href="{{ route('kadiv.orderDetail', ['id' => $order->id]) }}" class="dropdown-item has-icon"><i
                          class="fas fa-info-circle text-info"></i>
                        Detail</a>
                      @if (!$order->approved_by_kadiv)
                        <a href="{{ route('kadiv.accept', ['id' => $order->id]) }}" class="dropdown-item has-icon" id="btn-confirm">
                          <i class="fas fa-check-circle text-success"></i> Konfirmasi</a>
                      @endif
                    </div>
                  </div>
                </td>
              </tr>
            @endforeach
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection
