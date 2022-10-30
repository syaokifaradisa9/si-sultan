@extends('layouts.main')

@section('container')
  @if (session()->has('success'))
    <div id="success" data-flash="{{ session('success') }}"></div>
  @endif

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

  <div class="row">
    <div class="col-12 ">
      <div class="card">
        <div class="card-header">
          <h4>Barang Habis Pakai yang Ditunda</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-md" id="pending-table">
              <thead>
                <tr>
                  <th class="align-middle text-center">No</th>
                  <th class="align-middle text-center">Nama Barang</th>
                  <th class="align-middle text-center">Jumlah</th>
                  <th class="align-middle text-center">Spesifikasi</th>
                  <th class="align-middle text-center">Justifikasi</th>
                  <th class="align-middle text-center">Status</th>
                  <th class="align-middle text-center">Deskripsi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($proposeHp as $propose)
                  <tr>
                    <td class="align-middle">{{ $loop->iteration }}</td>
                    <td class="align-middle">{{ $propose->usulan_hp }}</td>
                    <td class="align-middle">{{ $propose->jumlah_hp }}</td>
                    <td class="align-middle text-left" style="max-width: 300px">{{ $propose->spesifikasi_hp }}</td>
                    <td class="align-middle text-left" style="max-width: 300px">{{ $propose->justifikasi_hp }}</td>
                    <td class="align-middle text-center">
                      <div class="badge badge-warning">
                        {{ $propose->status }}
                      </div>
                    </td>
                    <td class="align-middle">{{ $propose->deskripsi }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>

        <hr style="margin: 36px 28px 0">
        <div class="card-header">
          <h4>Barang Tak Habis Pakai yang Ditunda</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-md" id="pending-table">
              <thead>
                <tr>
                  <th class="text-center">No</th>
                  <th class="text-center">Nama Barang</th>
                  <th class="text-center">Jumlah</th>
                  <th class="text-center">Spesifikasi</th>
                  <th class="text-center">Justifikasi</th>
                  <th class="text-center">Status</th>
                  <th class="text-center">Deskripsi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($proposes as $propose)
                  <tr>
                    <td class="align-middle">{{ $loop->iteration }}</td>
                    <td class="align-middle">{{ $propose->usulan_thp }}</td>
                    <td class="align-middle">{{ $propose->jumlah_thp }}</td>
                    <td class="align-middle text-left" style="max-width: 300px">{{ $propose->spesifikasi_thp }}</td>
                    <td class="align-middle text-left" style="max-width: 300px">{{ $propose->justifikasi_thp }}</td>
                    <td class="align-middle text-center">
                      <div class="badge badge-warning">
                        {{ $propose->status }}
                      </div>
                    </td>
                    <td class="align-middle">{{ $propose->deskripsi }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          @if ($hp || $thp)
            <div class="float-right">
              <a href="{{ route('addiv.reapply') }}" class="btn btn-primary mt-3 mb-3">Ajukan Ulang</a>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
@endsection

@push('js-extends')
  <script src="{{ asset('assets/js/datatable.js') }}"></script>
@endpush
