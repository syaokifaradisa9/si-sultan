@extends('layouts.main')

@section('container')
  <form action="{{ route('addiv.storeReapply') }}" method="POST">
    @csrf

    {{-- Barang habis pakai --}}
    <div class="card">
      <div class="card-header">
        <h4>Usulan Barang Habis Pakai</h4>
        <div class="card-header-form">
        </div>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr class="text-center">
                <th>No</th>
                <th>Nama Alat</th>
                <th>Total</th>
                <th style="width: 8rem">Jumlah</th>
                <th>Spesifikasi</th>
                <th>Justifikasi</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody class="duplicate-form">
              @foreach ($proposeHp as $data)
                {{-- @foreach ($propose as $data) --}}
                <tr class="text-center duplicate">
                  <input type="hidden" name="inventory_hp_id[]" value="{{ $data->inventory_hp_id }}">
                  <td class="count">{{ $loop->iteration }}</td>
                  <td class="usulan" id="hp">
                    <?php
                    $isDropdown = false;
                    foreach ($invenHp as $habis_pakai) {
                        if ($habis_pakai->nama_barang === $data->usulan_hp) {
                            $isDropdown = true;
                            break;
                        }
                    }
                    ?>

                    @if ($isDropdown)
                      <select class="form-control form-control-sm eventSelect" id="usulan_hp" name="usulan_hp[]">
                        <option selected hidden value="">Pilih Barang</option>
                        @foreach ($invenHp as $inventory)
                          <option value="{{ $inventory->id }}" @if ($inventory->id == $data->inventory_hp_id) selected @endif>{{ $inventory->nama_barang }}
                          </option>
                        @endforeach
                        <option value="lainnya">Lainnya...</option>
                      </select>
                    @else
                      <div class="input-group">
                        <input type="text" class="form-control" name="usulan_hp[]" id="usulan_hp" value="{{ $data->usulan_hp }}">
                      </div>
                    @endif

                  </td>
                  <td>
                    <div class="total">{{ $data->inventory_hp_id ? $data->inventoryHp->total : '0' }}</div>
                  </td>
                  <td>
                    <div class="input-group">
                      <input type="number" min="0" class="form-control input-jumlah" id="jumlah_hp" name="jumlah_hp[]"
                        value="{{ $data->jumlah_hp }}">
                    </div>
                  </td>
                  <td>
                    <div class="input-group">
                      <textarea class="form-control firstTextarea" id="spesifikasi_hp" name="spesifikasi_hp[]">{{ $data->spesifikasi_hp }}</textarea>
                    </div>
                  </td>
                  <td>
                    <div class="input-group">
                      <textarea class="form-control secondTextarea" id="justifikasi_hp" name="justifikasi_hp[]">{{ $data->justifikasi_hp }}</textarea>
                    </div>
                  </td>
                  <td>
                    <button type="button" class="btn btn-danger btn-delete"><i class="fas fa-trash" style="pointer-events: none"></i></button>
                  </td>
                </tr>
                {{-- @endforeach --}}
              @endforeach
              <tr class="text-center">
                <td colspan="6"></td>
                <td>
                  <button type="button" class="btn btn-primary btn-add"><i class="fas fa-plus-circle"></i></button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>


    {{-- Barang tidak habis pakai --}}
    <div class="card">
      <div class="card-header">
        <h4>Usulan Barang Tidak Habis Pakai</h4>
        <div class="card-header-form">
        </div>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr class="text-center">
                <th style="width: 0.5rem">No</th>
                <th>Nama Alat</th>
                <th style="width: 1rem">Baik</th>
                <th style="width: 1rem">Rusak Ringan</th>
                <th style="width: 1rem">Rusak Berat</th>
                <th style="width: 8rem">Jumlah</th>
                <th>Spesifikasi</th>
                <th>Justifikasi</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody class="duplicate-form">
              @foreach ($proposes as $data)
                <tr class="text-center duplicate">
                  <input type="hidden" name="inventory_id[]" value="{{ $data->inventory_id }}">
                  <td class="count">{{ $loop->iteration }}</td>
                  <td class="usulan" id="thp">
                    <?php
                    $isDropdown = false;
                    foreach ($invenThp as $tak_habis_pakai) {
                        if ($tak_habis_pakai->nama_barang === $data->usulan_thp) {
                            $isDropdown = true;
                            break;
                        }
                    }
                    ?>

                    @if ($isDropdown)
                      <select class="form-control form-control-sm eventSelect" id="usulan_thp" name="usulan_thp[]">
                        <option selected hidden value="">Pilih Barang</option>
                        @foreach ($invenThp as $inventory)
                          <option value="{{ $inventory->id }}" @if ($inventory->id == $data->inventory_id) selected @endif>{{ $inventory->nama_barang }}
                          </option>
                        @endforeach
                        <option value="lainnya">Lainnya...</option>
                      </select>
                    @else
                      <div class="input-group">
                        <input type="text" class="form-control " name="usulan_thp[]" id="usulan_thp" value="{{ $data->usulan_thp }}">
                      </div>
                    @endif
                  </td>
                  <td class="baik" name="baik">{{ $data->inventory ? $data->inventory->baik : '0' }}</td>
                  <td class="rusak_ringan" name="rusak_ringan">{{ $data->inventory ? $data->inventory->rusak_ringan : '0' }}</td>
                  <td class="rusak_berat" name="rusak_berat">{{ $data->inventory ? $data->inventory->rusak_berat : '0' }}</td>
                  <td>
                    <div class="input-group">
                      <input type="number" min="0" class="form-control input-jumlah" id="jumlah_thp" name="jumlah_thp[]"
                        value="{{ $data->jumlah_thp }}">
                    </div>
                  </td>
                  <td>
                    <div class="input-group">
                      <textarea class="form-control firstTextarea" id="spesifikasi_thp" name="spesifikasi_thp[]">{{ $data->spesifikasi_thp }}</textarea>
                    </div>
                  </td>
                  <td>
                    <div class="input-group">
                      <textarea class="form-control secondTextarea" id="justifikasi_thp" name="justifikasi_thp[]">{{ $data->justifikasi_thp }}</textarea>
                    </div>
                  </td>
                  <td>
                    <button type="button" class="btn btn-danger btn-delete"><i class="fas fa-trash" style="pointer-events: none"></i></button>
                  </td>
                </tr>
              @endforeach
              <tr class="text-center">
                <td colspan="8"></td>
                <td>
                  <button type="button" class="btn btn-primary btn-add"><i class="fas fa-plus-circle" style="pointer-events: none"></i></button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="float-right">
      <a href="{{ route('addiv.home') }}" class="btn btn-light mr-2">Kembali</a>
      <button type="submit" class="btn btn-primary">Kirim Pengajuan</button>
    </div>
  </form>
@endsection

@push('js-extends')
  <script src="{{ asset('assets/js/form-validate.js') }}"></script>
  <script src="{{ asset('assets/js/usulan-script.js') }}"></script>
@endpush
