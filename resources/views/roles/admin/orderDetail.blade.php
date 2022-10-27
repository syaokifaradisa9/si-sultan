@extends('layouts.main')

@section('container')
  <div class="section-body">

    @if ($divOrder->description_by_mutu)
      <div class="card">
        <div class="card-header">
          <h4 class="badge badge-warning text-white">Deskripsi Penolakan</h4>
        </div>
        <div class="card-body">
          <p>{{ $divOrder->description_by_mutu }}</p>
        </div>
      </div>
    @endif

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Detail Usulan Habis Pakai</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped table-md">
                <thead>
                  <tr class="text-center">
                    <th>No</th>
                    <th>Nama Usulan</th>
                    <th>Jumlah</th>
                    <th>Spesifikasi</th>
                    <th>Justifikasi</th>
                    @if ($divOrder->approved_by_kepala)
                      <th>Status</th>
                      <th style="width: 350px;">Deskripsi</th>
                    @endif
                  </tr>
                </thead>
                <tbody>
                  @foreach ($proposeHp as $hp)
                    <tr class="text-center">
                      <td class="align-middle">{{ $loop->iteration }}</td>
                      <td class="align-middle">{{ $hp->usulan_hp }}</td>
                      <td class="align-middle">{{ $hp->jumlah_hp }}</td>
                      <td class="align-middle text-left">{{ $hp->spesifikasi_hp }}</td>
                      <td class="align-middle text-left">{{ $hp->justifikasi_hp }}</td>
                      @if ($divOrder->approved_by_kepala)
                        <td
                          @if ($hp->status == 'disetujui') class="text-success align-middle"
                      @elseif ($hp->status == 'ditunda') class="text-danger align-middle" @endif>
                          {{ $hp->status }}</td>
                        <td class="align-middle text-left">
                          {{ $hp->deskripsi ? $hp->deskripsi : '-' }}
                        </td>
                      @endif
                    </tr>
                  @endforeach
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
              <table class="table table-striped table-md">
                <thead>
                  <tr class="text-center">
                    <th>No</th>
                    <th>Nama Usulan</th>
                    <th>Jumlah</th>
                    <th>Spesifikasi</th>
                    <th>Justifikasi</th>
                    @if ($divOrder->approved_by_kepala)
                      <th>Status</th>
                      <th style="width: 350px;">Deskripsi</th>
                    @endif
                  </tr>
                </thead>
                <tbody>
                  @foreach ($propose as $thp)
                    <tr class="text-center">
                      <td class="align-middle">{{ $loop->iteration }}</td>
                      <td class="align-middle">{{ $thp->usulan_thp }}</td>
                      <td class="align-middle">{{ $thp->jumlah_thp }}</td>
                      <td class="align-middle text-left">{{ $thp->spesifikasi_thp }}</td>
                      <td class="align-middle text-left">{{ $thp->justifikasi_thp }}</td>
                      @if ($divOrder->approved_by_kepala)
                        <td
                          @if ($thp->status == 'disetujui') class="text-success align-middle"
                          @elseif ($thp->status == 'ditunda') class="text-danger align-middle" @endif>
                          {{ $thp->status }}</td>
                        <td class="align-middle text-left">
                          {{ $thp->deskripsi ? $thp->deskripsi : '-' }}
                        </td>
                      @endif
                    </tr>
                  @endforeach
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
          @if (!$divOrder->approved_by_kadiv)
            <a href="{{ route('addiv.edit', ['id' => $order_id]) }}" class="btn btn-warning">Edit</a>
          @endif
        </div>
      </div>
    </div>
  </div>
@endsection
