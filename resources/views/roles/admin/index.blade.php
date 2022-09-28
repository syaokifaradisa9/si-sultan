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
          <tbody class="text-center">
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
          <tbody class="text-center">
          </tbody>
        </table>
      </div>
    </div>
  </div>

  </div>

  <script>
    $(function() {
      let i = 1
      let table = $('#order-table').DataTable({
        bAutoWidth: false,
        processing: true,
        serverSide: true,
        ajax: "{{ route('addiv.datatable', ['type' => 'thp']) }}",
        columns: [{
            data: null,
            render: function(data, type, row) {
              return i++
            }
          },
          {
            data: 'nama_barang',
            name: 'nama_barang'
          },
          {
            data: 'baik',
            name: 'baik'
          },
          {
            data: 'rusak_ringan',
            name: 'rusak_ringan',
          },
          {
            data: 'rusak_berat',
            name: 'rusak_berat',
          },
        ]
      });
    });

    $(function() {
      let i = 1
      let table = $('#used-table').DataTable({
        bAutoWidth: false,
        processing: true,
        serverSide: true,
        ajax: "{{ route('addiv.datatable', ['type' => 'hp']) }}",
        columns: [{
            data: null,
            render: function(data, type, row) {
              return i++
            }
          },
          {
            data: 'nama_barang',
            name: 'nama_barang'
          },
          {
            data: 'total',
            name: 'total'
          },
        ]
      });
    });
  </script>
@endsection
