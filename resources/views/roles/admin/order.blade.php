@extends('layouts.main')

@section('container')
  <div class="section-body">
    <h2 class="section-title">Order</h2>
    <p class="section-lead">Tabel order dari usulan</p>

    @if (session()->has('success'))
      <div id="success" data-flash="{{ session('success') }}"></div>
    @endif

    <div class="card">
      <div class="card-header">
        <h4>Tabel Order</h4>
        <div class="ml-auto">
          <a href="{{ route('addiv.create') }}" class="btn btn-primary"v>Buat Usulan</a>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-md">
            <thead>
              <tr class="text-center">
                <th rowspan="2" style="vertical-align: middle">No</th>
                <th rowspan="2" style="vertical-align: middle">Tanggal Usulan</th>
                <th rowspan="2" style="vertical-align: middle">Deskripsi Usulan</th>
                <th colspan="4">Status</th>
                <th rowspan="2" style="vertical-align: middle">Aksi</th>
              </tr>
              <tr class="text-center">
                <th width="100px" style="vertical-align: middle">Kepala Divisi</th>
                <th width="100px" style="vertical-align: middle">Mutu</th>
                <th width="100px" style="vertical-align: middle">Administrasi Umum</th>
                <th width="100px" style="vertical-align: middle">Kepala LPFK</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($divOrder as $order)
                <tr class="text-center">
                  <td class="align-middle">{{ $loop->iteration }}</td>
                  <td class="align-middle">{{ date_format($order->created_at, 'd/m/Y H:i') }}</td>
                  <td>
                    {{ count($order->proposeHp) . ' Barang Habis Pakai' }} <br>
                    {{ count($order->propose) . ' Barang Tak Habis Pakai' }}
                  </td>
                  <td style="vertical-align: middle" class="{{ $order->approved_by_kadiv ? 'text-success' : 'text-warning' }}">
                    <i class="fas {{ $order->approved_by_kadiv ? 'fa-check' : 'fa-history' }}" style="font-size: 20px"></i>
                  </td>
                  <td style="vertical-align: middle" class="{{ $order->approved_by_mutu ? 'text-success' : 'text-warning' }}">
                    @if ($order->description_by_mutu)
                      <i class="fas fa-times text-danger" style="font-size: 20px"></i>
                    @elseif ($order->approved_by_mutu)
                      <i class="fas fa-check" style="font-size: 20px"></i>
                    @else
                      <i class="fas fa-history" style="font-size: 20px"></i>
                    @endif
                  </td>
                  <td style="vertical-align: middle" class="{{ $order->approved_by_adum ? 'text-success' : 'text-warning' }}">
                    <i class="fas {{ $order->approved_by_adum ? 'fa-check' : 'fa-history' }}" style="font-size: 20px"></i>
                  </td>
                  <td style="vertical-align: middle" class="{{ $order->approved_by_kepala ? 'text-success' : 'text-warning' }}">
                    <i class="fas {{ $order->approved_by_kepala ? 'fa-check' : 'fa-history' }}" style="font-size: 20px"></i>
                  </td>
                  <td><a href="{{ route('addiv.orderDetail', ['id' => $order->id]) }}" class="btn btn-info">Detail</a></td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection
