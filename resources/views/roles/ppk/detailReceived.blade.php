@extends('layouts.main', ['header' => 'Detail'])

@section('container')
  <div class="section-body">
    @foreach ($proposes as $type => $data)
      <div class="card">
        <div class="card-header">
          <h4>Detail Barang yang diterima</h4>
          <div class="ml-auto">
            <a href="{{ route('ppk.received') }}" class="btn btn-primary"><i class="fas fa-chevron-circle-left"></i> Kembali</a>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-striped table-md">
              <tr class="text-center">
                <th>No</th>
                <th>Bagian</th>
                <th>Usulan</th>
                <th style="width: 150px">Jumlah Diterima</th>
                <th>Spesifikasi</th>
                <th>Justifikasi</th>
                <th>Deskripsi</th>
              </tr>
              <?php $i = 1; ?>
              <tr class="text-center">
                <td class="align-middle">{{ $i }}</td>
                <td class="align-middle">{{ $data['bagian'] }}</td>
                <td class="align-middle">{{ $data['usulan'] }}</td>
                <td class="align-middle"> {{ $data['jumlah'] }}</td>
                <td class="align-middle text-left">{{ $data['spesisikasi'] }}</td>
                <td class="align-middle text-left">{{ $data['justifikasi'] }}</td>
                <td class="align-middle text-left">{{ $data['deskripsi'] }}</td>
              </tr>
              <?php $i++; ?>
            </table>
          </div>
        </div>
      </div>
    @endforeach
  </div>
@endsection
