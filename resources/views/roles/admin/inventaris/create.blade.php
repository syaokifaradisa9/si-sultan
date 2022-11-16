@extends('layouts.main', ['header' => 'Inventaris'])

@section('container')
  <form action="{{ route('addiv.storeInven') }}" method="POST" id="form-inventory">
    @csrf
    <div class="row">
      <div class="col-12 col-md-6 col-lg-6">
        <div class="card">
          <div class="card-header">
            <h4>Inventaris Barang Habis Pakai</h4>
            <div class="card-header-form">
            </div>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr class="text-center">
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th style="width: 200px">Total</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody class="duplicate-form">
                  <tr class="text-center duplicate">
                    <td class="count">1</td>
                    <td>
                      <div class="input-group inventory" id="hp">
                        <input type="text" class="form-control input-hp input-inventory-hp" placeholder="Nama Barang" name="inventory_hp[]"
                          id="inventory_hp">
                      </div>
                    </td>
                    <td>
                      <div class="input-group">
                        <input type="number" min="0" class="form-control input-hp input-total-hp" name="total_hp[]" id="total_hp">
                      </div>
                    </td>
                    <td>
                      <button type="button" class="btn btn-danger btn-delete"><i class="fas fa-trash" style="pointer-events: none"></i></button>
                    </td>
                  </tr>
                  <tr class="text-center">
                    <td colspan="3"></td>
                    <td>
                      <button type="button" class="btn btn-primary btn-add"><i class="fas fa-plus-circle"></i></button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12 col-md-6 col-lg-6">
        <div class="card">
          <div class="card-header">
            <h4>Inventaris Barang Habis Pakai</h4>
            <div class="card-header-form">
            </div>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr class="text-center">
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th style="width: 120px">Baik</th>
                    <th style="width: 120px">Rusak Ringan</th>
                    <th style="width: 120px">Rusak Berat</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody class="duplicate-form">
                  <tr class="text-center duplicate">
                    <td class="count">1</td>
                    <td>
                      <div class="input-group inventory" id="thp">
                        <input type="text" class="form-control input-thp input-inventory-thp" placeholder="Nama Barang" name="inventory_thp[]"
                          id="inventory_thp">
                      </div>
                    </td>
                    <td>
                      <div class="input-group">
                        <input type="number" min="0" class="form-control input-thp input-baik-thp" name="baik_thp[]" id="baik_thp">
                      </div>
                    </td>
                    <td>
                      <div class="input-group">
                        <input type="number" min="0" class="form-control input-thp input-rusak-ringan-thp" name="rusak_ringan_thp[]"
                          id="rusak_ringan_thp">
                      </div>
                    </td>
                    <td>
                      <div class="input-group">
                        <input type="number" min="0" class="form-control input-thp input-rusak-berat-thp" name="rusak_berat_thp[]"
                          id="rusak_berat_thp">
                      </div>
                    </td>
                    <td>
                      <button type="button" class="btn btn-danger btn-delete"><i class="fas fa-trash" style="pointer-events: none"></i></button>
                    </td>
                  </tr>
                  <tr class="text-center">
                    <td colspan="5"></td>
                    <td>
                      <button type="button" class="btn btn-primary btn-add"><i class="fas fa-plus-circle"></i></button>
                    </td>
                  </tr>
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
          <a href="{{ route('addiv.inventory') }}" class="btn btn-light mr-2">Kembali</a>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </div>
    </div>
  </form>
@endsection

@push('js-extends')
  <script src="{{ asset('assets/js/form-inventory-validate.js') }}"></script>
  <script src="{{ asset('assets/js/inventory-script.js') }}"></script>
@endpush
