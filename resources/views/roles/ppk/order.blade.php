@extends('layouts.main')

@section('container')
  <div class="section-body">
    <h2 class="section-title">Rekapitulasi Usulan</h2>
    <p class="section-lead">Usulan dari semua bagian yang telah disetujui oleh kepala LPFK</p>

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
              <th>Bagian</th>
              <th>Tanggal Usulan</th>
              <th>Deskripsi Usulan</th>
              <th>Aksi</th>
            </tr>
            @foreach ($orders as $order)
              <tr class="text-center">
                <td class="align-middle">{{ $loop->iteration }}</td>
                <td class="align-middle">{{ $order->userDivision->division->nama }}</td>
                <td class="align-middle">{{ date_format($order->created_at, 'd/m/Y H:i') }}</td>
                <td class="align-middle">
                  {{ count($order->proposeHp) . ' Usulan Habis Pakai' }} <br>
                  {{ count($order->propose) . ' Usulan Tidak Habis Pakai' }} <br>
                </td>
                <td class="align-middle">
                  <a href="{{ route('ppk.orderDetail', ['id' => $order->id]) }}" class="btn btn-primary">Detail</a>
                </td>
              </tr>
            @endforeach
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection
