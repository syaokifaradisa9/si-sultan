@extends('layouts.main')

@section('container')
  <div class="section-body">
    <h2 class="section-title">Rekapitulasi Usulan</h2>
    <p class="section-lead">Usulan dari semua bagian yang telah disetujui oleh kepala LPFK</p>

    @if (session()->has('success'))
      <div id="success" data-flash="{{ session('success') }}"></div>
    @endif

    <div class="card">
      <div class="card-header">
        <h4>Tabel Usulan Habis Pakai</h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped table-md">
            <tr class="text-center">
              <th>No</th>
              <th>Order</th>
              <th>Usulan</th>
              <th>Tanggal Usulan</th>
              <th>Jumlah</th>
              <th>Spesifikasi</th>
              <th>Justifikasi</th>
              <th>Aksi</th>
            </tr>
            @foreach ($orders as $hp)
              <tr class="text-center">
                <td class="align-middle">{{ $loop->iteration }}</td>
                <td class="align-middle">{{ $hp->userDivision->division->nama }}</td>
                <td class="align-middle">
                  @foreach ($hp->proposeHp as $item)
                    {{ $item->usulan_hp }} <br>
                  @endforeach
                </td>
                <td class="align-middle">{{ date_format($hp->created_at, 'd/m/Y H:i') }}</td>
                <td class="align-middle">
                  @foreach ($hp->proposeHp as $item)
                    {{ $item->jumlah_hp }} <br>
                  @endforeach
                </td>
                <td class="align-middle">
                  @foreach ($hp->proposeHp as $item)
                    {{ $item->spesifikasi_hp }} <br>
                  @endforeach
                </td>
                <td class="align-middle">
                  @foreach ($hp->proposeHp as $item)
                    {{ $item->justifikasi_hp }} <br>
                  @endforeach
                </td>
                <td class="align-middle">
                  <a href="" class="btn btn-success btn-confirm" id="btn-confirm">Konfirmasi</a>
                </td>
              </tr>
            @endforeach
          </table>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-header">
        <h4>Tabel Usulan Tidak Habis Pakai</h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped table-md">
            <tr class="text-center">
              <th>No</th>
              <th>Order</th>
              <th>Usulan</th>
              <th>Tanggal Usulan</th>
              <th>Jumlah</th>
              <th>Spesifikasi</th>
              <th>Justifikasi</th>
              <th>Aksi</th>
            </tr>
            @foreach ($orders as $thp)
              {{-- @if ($thp->divisionOrder->approved_by_kadiv && $thp->divisionOrder->approved_by_mutu && $thp->divisionOrder->approved_by_adum && $thp->divisionOrder->approved_by_kepala) --}}
              <tr class="text-center">
                <td class="align-middle">{{ $loop->iteration }}</td>
                <td class="align-middle">{{ $thp->userDivision->division->nama }}</td>
                <td class="align-middle">
                  @foreach ($thp->propose as $item)
                    {{ $item->usulan_thp }} <br>
                  @endforeach
                </td>
                <td class="align-middle">{{ date_format($thp->created_at, 'd/m/Y H:i') }}</td>
                <td class="align-middle">
                  @foreach ($thp->propose as $item)
                    {{ $item->jumlah_thp }} <br>
                  @endforeach
                </td>
                <td class="align-middle">
                  @foreach ($thp->propose as $item)
                    {{ $item->spesifikasi_thp }} <br>
                  @endforeach
                </td>
                <td class="align-middle">
                  @foreach ($thp->propose as $item)
                    {{ $item->justifikasi_thp }} <br>
                  @endforeach
                </td>
                <td>
                  <a href="" class="btn btn-success btn-confirm" id="btn-confirm">Konfirmasi</a>
                </td>
              </tr>
              {{-- @endif --}}
            @endforeach
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection
