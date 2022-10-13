@extends('layouts.main')

@section('container')
  <div class="card">
    <div class="card-header">
      <h4>Barang Habis Pakai</h4>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="used-table">
          <thead>
            <tr>
              <th class="text-center" style="width: 15px">No</th>
              <th class="text-center" style="width: 220px">Nama Barang</th>
              <th class="text-center" style="width: 15px">Total</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-header">
      <h4>Barang Tidak Habis Pakai</h4>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="order-table">
          <thead>
            <tr>
              <th class="text-center" style="width: 15px">No</th>
              <th class="text-center">Nama Barang</th>
              <th class="text-center" style="width: 200px">Baik</th>
              <th class="text-center" style="width: 200px">Rusak Ringan</th>
              <th class="text-center" style="width: 200px">Rusak Berat</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
