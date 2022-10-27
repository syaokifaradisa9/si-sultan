@extends('layouts.main', ['header' => 'Detail'])

@section('container')
  <div class="section-body">

    <div class="card">
      <div class="card-header">
        <h4>Tabel Usulan Habis Pakai</h4>
        <div class="ml-auto">
          <a href="{{ route('mutu.approvedByPPK') }}" class="btn btn-primary"><i class="fas fa-chevron-circle-left"></i> Kembali</a>
        </div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped table-md">
            <tr class="text-center">
              <th>No</th>
              <th>Bagian</th>
              <th>Usulan</th>
              <th>Jumlah</th>
              <th>Spesifikasi</th>
              <th>Justifikasi</th>
            </tr>
            @foreach ($proposes as $data)
              <tr class="text-center">
                <td class="align-middle">{{ $loop->iteration }}</td>
                <td class="align-middle">{{ $data->divisionOrder->userDivision->division->nama }}</td>
                <td class="align-middle">{{ $data->usulan }}</td>
                <td class="align-middle"> {{ $data->jumlah }}</td>
                <td class="align-middle text-left">{{ $data->spesifikasi }}</td>
                <td class="align-middle text-left">{{ $data->justifikasi }}</td>
              </tr>
            @endforeach
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection
