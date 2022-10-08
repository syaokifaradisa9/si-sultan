@extends('layouts.main')

@section('container')
  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Detail Usulan Habis Pakai</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped table-md" id="detail-hp">
                <thead>
                  <tr class="text-center">
                    <th>No</th>
                    <th>Nama Usulan</th>
                    <th>Jumlah</th>
                    <th>Spesifikasi</th>
                    <th>Justifikasi</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="text-center">
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Detail Usulan Tidak Habis Pakai</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped table-md" id="detail-thp">
                <thead>
                  <tr class="text-center">
                    <th>No</th>
                    <th>Nama Usulan</th>
                    <th>Jumlah</th>
                    <th>Spesifikasi</th>
                    <th>Justifikasi</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="text-center">
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-body">
        <div class="float-right" style="padding-right: 2.3rem">
          <a href="{{ route('addiv.order') }}" class="btn btn-light mr-2">Kembali</a>
          <a href="{{ route('addiv.edit', ['id' => $order_id]) }}" class="btn btn-warning">Edit</a>
        </div>
      </div>
    </div>

    <script>
      let url = window.location.href
      let splitUrl = url.split('/')

      let domain = splitUrl[0];
      let id = splitUrl[5]

      $(function() {
        let table = $('#detail-hp').DataTable({
          bAutoWidth: false,
          processing: true,
          serverSide: true,
          ajax: `${domain}/datatable/hp/${id}/detail`,
          columns: [{
              data: null,
              render: (data, type, row, meta) => meta.row + 1
            },
            {
              data: 'usulan_hp',
              name: 'usulan_hp'
            },
            {
              data: 'jumlah_hp',
              name: 'jumlah_hp',
            },
            {
              data: 'spesifikasi_hp',
              name: 'spesifikasi_hp',
            },
            {
              data: 'justifikasi_hp',
              name: 'justifikasi_hp',
            },
          ]
        });
      });

      $(function() {
        let table = $('#detail-thp').DataTable({
          bAutoWidth: false,
          processing: true,
          serverSide: true,
          ajax: `${domain}/datatable/thp/${id}/detail`,
          columns: [{
              data: null,
              render: (data, type, row, meta) => meta.row + 1
            },
            {
              data: 'usulan_thp',
              name: 'usulan_thp'
            },
            {
              data: 'jumlah_thp',
              name: 'jumlah_thp',
            },
            {
              data: 'spesifikasi_thp',
              name: 'spesifikasi_thp',
            },
            {
              data: 'justifikasi_thp',
              name: 'justifikasi_thp',
            },
          ]
        });
      });
    </script>
  @endsection
