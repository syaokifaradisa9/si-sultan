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
              <table class="table table-bordered table-striped table-md" id="detail-hp">
                <thead>
                  <tr class="text-center">
                    <th class="align-middle">No</th>
                    <th class="align-middle">Nama Usulan</th>
                    <th class="align-middle">Jumlah</th>
                    <th class="align-middle">Spesifikasi</th>
                    <th class="align-middle">Justifikasi</th>
                    <th class="align-middle">Status</th>
                  </tr>
                </thead>
                <tbody>
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
              <table class="table table-bordered table-striped table-md" id="detail-thp">
                <thead>
                  <tr class="text-center">
                    <th class="align-middle">No</th>
                    <th class="align-middle">Nama Usulan</th>
                    <th class="align-middle">Jumlah</th>
                    <th class="align-middle">Spesifikasi</th>
                    <th class="align-middle">Justifikasi</th>
                    <th class="align-middle">Status</th>
                  </tr>
                </thead>
                <tbody>
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
          <a href="{{ route('kadiv.order') }}" class="btn btn-light mr-2">Kembali</a>
          @if (!$order->approved_by_kadiv)
            <a href="{{ route('kadiv.accept', ['id' => $order->id]) }}" class="btn btn-success" id="btn-confirm">Konfirmasi</a>
          @endif
        </div>
      </div>
    </div>
  </div>
@endsection

@push('js-extends')
  <script src="{{ asset('assets/js/btn-function.js') }}"></script>
  <script src="{{ asset('assets/js/detail-datatable.js') }}"></script>
@endpush
