@extends('layouts.main')

@section('container')
  <div class="section-body">

    @foreach ($proposals as $type => $proposal)
      <div class="card">
        <div class="card-header">
          <h4>Tabel Usulan @if ($type === 'thp')
              Tak
            @endif Habis Pakai</h4>
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
                  <th>Awal Usulan</th>
                  <th>Disetujui</th>
                  <th>Awal Usulan</th>
                  <th>Disetujui</th>
                </tr>
              </thead>
              <?php $num = 1; ?>
              <tbody>
                @foreach ($proposal as $divisionName => $proposes)
                  @foreach ($proposes as $name => $data)
                    <tr>
                      <td class="text-center">{{ $num }}</td>
                      <td>{{ $name }}</td>
                      <td>{{ $divisionName }}</td>
                      <td class="text-center">{{ $data['start'] }}</td>
                      <td class="text-center">{{ $data['final'] }}</td>
                      <td>{{ date_format($data['propose_date'], 'd F Y H:i') }}</td>
                      <td>{{ date_format($data['approved_date'], 'd F Y H:i') }}</td>
                      <td class="text-center">
                        <a href="{{ route('mutu.detailApproved', ['id' => $data['id'], 'type' => $type]) }}" class="btn btn-primary"><i
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
