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
  </div>

  <div class="card">
    <div class="card-body">
      <div class="float-right" style="padding-right: 2.3rem">
        <a href="{{ route('adum.order') }}" class="btn btn-light mr-2">Kembali</a>
        @if (!$order->approved_by_adum)
          <a href="{{ route('adum.accept', ['id' => $order->id]) }}" class="btn btn-success" onclick="confirm('Apakah anda yakin?')">Konfirmasi</a>
        @endif
      </div>
    </div>
  </div>
@endsection