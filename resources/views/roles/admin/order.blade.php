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
          <a href="{{ route('addiv.usulan') }}" class="btn btn-primary"v>Buat Usulan</a>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped table-md">
            <tr class="text-center">
              <th>No</th>
              <th>Order</th>
              <th>Tanggal</th>
              <th>Aksi</th>
            </tr>
            <tr class="text-center">
              <td>1</td>
              <td>Order 1</td>
              <td>1 September 2022</td>
              <td><a href="{{ route('addiv.orderDetail') }}" class="btn btn-primary">Detail</a></td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection
