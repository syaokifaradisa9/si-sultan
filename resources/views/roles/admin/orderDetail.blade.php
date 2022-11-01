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
                    <th class="align-middle">No</th>
                    <th class="align-middle">Nama Usulan</th>
                    <th class="align-middle">Jumlah</th>
                    <th class="align-middle">Spesifikasi</th>
                    <th class="align-middle">Justifikasi</th>
                    @if ($divOrder->approved_by_kepala)
                      <th class="align-middle">Status</th>
                      <th style="width: 350px;" class="align-middle">Deskripsi</th>
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
                        <td class="align-middle">
                          <div
                            class="@if ($hp->status === 'disetujui') badge badge-success
                            @elseif ($hp->status === 'ditunda') badge badge-warning
                            @elseif ($hp->status == 'diajukan kembali') badge badge-info
                            @else badge badge-primary @endif">
                            {{ $hp->status }}
                          </div>
                        </td>
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
                    <th class="align-middle">No</th>
                    <th class="align-middle">Nama Usulan</th>
                    <th class="align-middle">Jumlah</th>
                    <th class="align-middle">Spesifikasi</th>
                    <th class="align-middle">Justifikasi</th>
                    @if ($divOrder->approved_by_kepala)
                      <th class="align-middle">Status</th>
                      <th style="width: 350px;" class="align-middle">Deskripsi</th>
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
                        <td class="align-middle">
                          <div
                            class="@if ($thp->status === 'disetujui') badge badge-success
                          @elseif ($thp->status === 'ditunda') badge badge-warning
                          @elseif ($thp->status == 'diajukan kembali') badge badge-info
                          @else badge badge-primary @endif">
                            {{ $thp->status }}
                          </div>
                        </td>
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
          @if (!$divOrder->approved_by_kadiv || $divOrder->description_by_mutu)
            <a href="{{ route('addiv.edit', ['id' => $order_id]) }}" class="btn btn-warning">Edit</a>
          @endif
        </div>
      </div>
    </div>
  </div>
@endsection
