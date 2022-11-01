@extends('layouts.main', ['header' => 'Barang yang Diterima'])

@section('container')
  <div class="section-body">

    @foreach ($proposes as $type => $propose)
      <div class="card">
        <div class="card-header">
          <h4>Tabel Usulan Habis @if ($type === 'thp')
              Tak
            @endif Pakai</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-striped table-md">
              <thead>
                <tr class="text-center">
                  <th rowspan="2" class="align-middle">No</th>
                  <th rowspan="2" class="align-middle">Nama Barang</th>
                  <th rowspan="2" class="align-middle">Bagian</th>
                  <th colspan="2">Jumlah</th>
                  <th colspan="2">Tanggal</th>
                  <th rowspan="2" class="align-middle">Aksi</th>
                </tr>
                <tr class="text-center">
                  <th>Awal</th>
                  <th>Diterima</th>
                  <th>Usulan</th>
                  <th>Diterima</th>
                </tr>
              </thead>
              <?php $num = 1; ?>
              <tbody>
                @foreach ($propose as $divisionName => $received)
                  @foreach ($received as $receivedName => $data)
                    <tr>
                      <td class="text-center">{{ $num }}</td>
                      <td>{{ $receivedName }}</td>
                      <td>{{ $divisionName }}</td>
                      <td class="text-center">{{ $data['first_amount'] }}</td>
                      <td class="text-center">{{ $data['received_amount'] }}</td>
                      <td>{{ date_format($data['propose_date'], 'd F Y H:i') }}</td>
                      <td>{{ date_format($data['received_date'], 'd F Y H:i') }}</td>
                      <td class="text-center">
                        <a href="{{ route('ppk.detailReceived', ['id' => $data['id'], 'type' => $type]) }}" class="btn btn-primary"><i
                            class="fas fa-info-circle"></i>
                          Detail</a>
                      </td>
                    </tr>
                    <?php $num++; ?>
                  @endforeach
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    @endforeach
  </div>
@endsection
