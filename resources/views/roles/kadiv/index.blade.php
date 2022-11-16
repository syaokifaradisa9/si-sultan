@extends('layouts.main')

@section('container')
  <div class="row">
    <div class="col-12 col-md-6 col-lg-6">
      <div class="card">
        <div class="card-header">
          <h4>Barang Habis Pakai</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-md" id="used-table">
              <thead>
                <tr>
                  <th class="text-center">No</th>
                  <th class="text-center">Nama Barang</th>
                  <th class="text-center">Total</th>
                </tr>
              </thead>
              <tbody class="text-center">
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-6 col-lg-6">
      <div class="card">
        <div class="card-header">
          <h4>Barang Tidak Habis Pakai</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-md" id="order-table">
              <thead>
                <tr>
                  <th class="text-center">No</th>
                  <th class="text-center">Nama Barang</th>
                  <th class="text-center">Baik</th>
                  <th class="text-center">Rusak Ringan</th>
                  <th class="text-center">Rusak Berat</th>
                </tr>
              </thead>
              <tbody class="text-center">
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('js-extends')
  <script src="{{ asset('assets/js/admin-datatable.js') }}"></script>
@endpush
