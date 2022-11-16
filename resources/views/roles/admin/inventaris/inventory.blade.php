@extends('layouts.main', ['header' => 'Inventaris Barang'])

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
                  <th class="text-center" style="width: 10px">No</th>
                  <th class="text-center">Nama Barang</th>
                  <th class="text-center">Total</th>
                  <th class="text-center">Aksi</th>
                </tr>
              </thead>
              <tbody class="text-center">
                @foreach ($invenHp as $item)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama_barang }}</td>
                    <td>{{ $item->total }}</td>
                    <td>
                      <a href="#" class="badge badge-warning" data-toggle="modal" data-target="#edit-inven{{ $item->id }}-hp">
                        <i class="fas fa-edit ml-0"></i>
                      </a>
                      <form action="{{ route('addiv.deleteInven', ['id' => $item->id, 'type' => 'hp']) }}" method="POST" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="badge bg-danger border-0 btn-delete" onclick="return confirm('Apakah anda yakin?')"
                          onfocus="this.style.outline = 'none'"><i class="fas fa-trash ml-0 text-white"></i></button>
                      </form>
                    </td>
                  </tr>
                  @include('roles.admin.inventaris.update', ['id' => $item->id, 'type' => 'hp'])
                @endforeach
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
          <div class="ml-auto">
            <a href="{{ route('addiv.createInven') }}" class="btn btn-primary">Tambah Inventaris</a>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-md" id="order-table">
              <thead>
                <tr>
                  <th class="text-center align-middle" style="width: 10px">No</th>
                  <th class="text-center align-middle">Nama Barang</th>
                  <th class="text-center align-middle">Baik</th>
                  <th class="text-center align-middle">Rusak Ringan</th>
                  <th class="text-center align-middle">Rusak Berat</th>
                  <th class="text-center align-middle">Aksi</th>
                </tr>
              </thead>
              <tbody class="text-center">
                @foreach ($invenThp as $item)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama_barang }}</td>
                    <td>{{ $item->baik }}</td>
                    <td>{{ $item->rusak_ringan }}</td>
                    <td>{{ $item->rusak_berat }}</td>
                    <td>
                      <a href="#" class="badge badge-warning" data-toggle="modal" data-target="#edit-inven{{ $item->id }}-thp">
                        <i class="fas fa-edit ml-0"></i>
                      </a>
                      <form action="{{ route('addiv.deleteInven', ['id' => $item->id, 'type' => 'thp']) }}" method="POST" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="badge bg-danger border-0 btn-delete" onclick="return confirm('Apakah anda yakin?')"
                          onfocus="this.style.outline = 'none'"><i class="fas fa-trash ml-0 text-white"></i></button>
                      </form>
                    </td>
                  </tr>
                  @include('roles.admin.inventaris.update', ['id' => $item->id, 'type' => 'thp'])
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
