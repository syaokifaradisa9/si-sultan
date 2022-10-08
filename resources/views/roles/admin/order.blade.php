@extends('layouts.main')

@section('container')
  <div class="section-body">
    <h2 class="section-title">Order</h2>
    <p class="section-lead">Tabel order dari usulan</p>

    @if (session()->has('success'))
      <div class="alert alert-success alert-dismissible show fade">
        <div class="alert-body">
          <button class="close" data-dismiss="alert">
            <span>&times;</span>
          </button>
          {{ session('success') }}
        </div>
      </div>
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
          <table class="table table-striped table-md">
            <tr class="text-center">
              <th>No</th>
              <th>Tanggal Usulan</th>
              <th>Deskripsi Usulan</th>
              <th>Aksi</th>
            </tr>
            @foreach ($divOrder as $order)
              <tr class="text-center">
                <td class="align-middle">{{ $loop->iteration }}</td>
                <td class="align-middle">{{ date_format($order->created_at, 'd/m/Y H:i') }}</td>
                <td>
                  {{ count($order->proposeHp) . ' Barang Habis Pakai' }} <br>
                  {{ count($order->propose) . ' Barang Tak Habis Pakai' }}
                </td>
                <td><a href="{{ route('addiv.orderDetail', ['id' => $order->id]) }}" class="btn btn-info">Detail</a></td>
              </tr>
            @endforeach
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection
