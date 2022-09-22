@extends('layouts.main')

@section('container')
  <div class="card">
    <div class="card-header">
      <h4>Barang Tidak Habis Pakai</h4>
      <div class="card-header-form">
        <form>
        </form>
      </div>
    </div>
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-bordered" id="order-table">
          <thead>
            <tr>
              <th class="text-center" style="width: 15px">No</th>
              <th class="text-center" style="width: 220px">Nama Barang</th>
              <th class="text-center" style="width: 15px">Baik</th>
              <th class="text-center" style="width: 15px">Rusak Ringan</th>
              <th class="text-center" style="width: 15px">Rusak Berat</th>
              <th class="text-center" style="width: 300px">Spesifikasi</th>
              <th class="text-center" style="width: 300px">Justifikasi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($inventories as $index => $inventory)
              <tr>
                <td class="text-center align-middle">
                  {{ $loop->iteration }}
                </td>
                <td>
                  {{ $inventory->nama_barang }}
                </td>
                <td class="text-center align-middle">
                  {{ $inventory->baik }}
                </td>
                <td class="text-center align-middle">
                  {{ $inventory->rusak_ringan }}
                </td>
                <td class="text-center align-middle">
                  {{ $inventory->rusak_berat }}
                </td>

              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header">
      <h4>Barang Habis Pakai</h4>
      <div class="card-header-form">
        <form>
        </form>
      </div>
    </div>
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-bordered" id="order-table">
          <thead>
            <tr>
              <th class="text-center" style="width: 15px">No</th>
              <th class="text-center" style="width: 220px">Nama Barang</th>
              <th class="text-center" style="width: 15px">Total</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($inventory_hps as $index => $inventory_hp)
              <tr>
                <td class="text-center align-middle">
                  {{ $index + 1 }}
                </td>
                <td class="text-center align-middle">
                  {{ $inventory_hp->nama_barang }}
                </td>
                <td class="text-center align-middle">
                  {{ $inventory_hp->total }}
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
  </div>
  </div>
  </div>
  </div>

  </div>
@endsection
