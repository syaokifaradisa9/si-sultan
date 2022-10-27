@extends('layouts.main')

@section('container')
  <form action="{{ $type == 'create' ? route('addiv.store') : route('addiv.update', $order_id) }}" method="POST" id="form-usulan">
    @csrf
    @if ($type != 'create')
      @method('PUT')
    @endif

    {{-- usulan habis pakai --}}
    <div class="card">
      <div class="card-header">
        <h4>Usulan Barang Habis Pakai</h4>
        <div class="card-header-form">
        </div>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive">
          @if (urlHelper::has('edit'))
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
                @foreach ($hp as $item)
                  <tr class="text-center duplicate">
                    <input type="hidden" name="inventory_hp_id[]" value="{{ $item->inventory_hp_id }}">
                    <td class="count">{{ $loop->iteration }}</td>
                    <td class="usulan" id="hp">
                      <?php
                      $isDropdown = false;
                      foreach ($invenHp as $habis_pakai) {
                          if ($habis_pakai->nama_barang === $item->usulan_hp) {
                              $isDropdown = true;
                              break;
                          }
                      }
                      ?>

                      @if ($isDropdown)
                        <select class="form-control form-control-sm eventSelect" id="usulan_hp" name="usulan_hp[]">
                          <option selected hidden value="">Pilih Barang</option>
                          @foreach ($invenHp as $inventory)
                            <option value="{{ $inventory->id }}" @if ($inventory->id == $item->inventory_hp_id) selected @endif>{{ $inventory->nama_barang }}
                            </option>
                          @endforeach
                          <option value="lainnya">Lainnya...</option>
                        </select>
                      @else
                        <div class="input-group">
                          <input type="text" class="form-control" name="usulan_hp[]" id="usulan_hp" value="{{ $item->usulan_hp }}">
                        </div>
                      @endif

                    </td>
                    <td>
                      <div class="total">{{ $item->inventoryHp ? $item->inventoryHp->total : '0' }}</div>
                    </td>
                    <td>
                      <div class="input-group">
                        <input type="number" min="0" class="form-control input-jumlah" id="jumlah_hp" name="jumlah_hp[]"
                          value="{{ $item->jumlah_hp }}">
                      </div>
                    </td>
                    <td>
                      <div class="input-group">
                        <textarea class="form-control firstTextarea" id="spesifikasi_hp" name="spesifikasi_hp[]">{{ $item->spesifikasi_hp }}</textarea>
                      </div>
                    </td>
                    <td>
                      <div class="input-group">
                        <textarea class="form-control secondTextarea" id="justifikasi_hp" name="justifikasi_hp[]">{{ $item->justifikasi_hp }}</textarea>
                      </div>
                    </td>
                    <td>
                      <button type="button" class="btn btn-danger btn-delete"><i class="fas fa-trash" style="pointer-events: none"></i></button>
                    </td>
                  </tr>
                @endforeach
                <tr class="text-center">
                  <td colspan="6"></td>
                  <td>
                    <button type="button" class="btn btn-primary btn-add"><i class="fas fa-plus-circle"></i></button>
                  </td>
                </tr>
              </tbody>
            </table>
          @else
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
                <tr class="text-center duplicate">
                  <input type="hidden" name="inventory_hp_id[]">
                  <td class="count">1</td>
                  <td class="usulan" id="hp">
                    <select class="form-control form-control-sm eventSelect" id="usulan_hp" name="usulan_hp[]">
                      <option selected hidden value="">Pilih Barang</option>
                      @foreach ($hp as $item)
                        <option value="{{ $item->id }}">{{ $item->nama_barang }}</option>
                      @endforeach
                      <option value="lainnya">Lainnya...</option>
                    </select>
                  </td>
                  <td>
                    <div class="total">-</div>
                  </td>
                  <td>
                    <div class="input-group">
                      <input type="number" min="0" class="form-control input-jumlah" id="jumlah_hp" name="jumlah_hp[]">
                    </div>
                  </td>
                  <td>
                    <div class="input-group">
                      <textarea class="form-control firstTextarea" id="spesifikasi_hp" name="spesifikasi_hp[]"></textarea>
                    </div>
                  </td>
                  <td>
                    <div class="input-group">
                      <textarea class="form-control secondTextarea" id="justifikasi_hp" name="justifikasi_hp[]"></textarea>
                    </div>
                  </td>
                  <td>
                    <button type="button" class="btn btn-danger btn-delete"><i class="fas fa-trash" style="pointer-events: none"></i></button>
                  </td>
                </tr>
                <tr class="text-center">
                  <td colspan="6"></td>
                  <td>
                    <button type="button" class="btn btn-primary btn-add"><i class="fas fa-plus-circle"></i></button>
                  </td>
                </tr>
              </tbody>
            </table>
          @endif
        </div>
      </div>
    </div>

    {{-- usulan tidak habis pakai --}}
    <div class="card">
      <div class="card-header">
        <h4>Usulan Barang Tidak Habis Pakai</h4>
        <div class="card-header-form">
        </div>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive">
          @if (urlHelper::has('edit'))
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
                @foreach ($thp as $item)
                  <tr class="text-center duplicate">
                    <input type="hidden" name="inventory_id[]" value="{{ $item->inventory_id }}">
                    <td class="count">{{ $loop->iteration }}</td>
                    <td class="usulan" id="thp">
                      <?php
                      $isDropdown = false;
                      foreach ($invenThp as $tak_habis_pakai) {
                          if ($tak_habis_pakai->nama_barang === $item->usulan_thp) {
                              $isDropdown = true;
                              break;
                          }
                      }
                      ?>

                      @if ($isDropdown)
                        <select class="form-control form-control-sm eventSelect" id="usulan_thp" name="usulan_thp[]">
                          <option selected hidden value="">Pilih Barang</option>
                          @foreach ($invenThp as $inventory)
                            <option value="{{ $inventory->id }}" @if ($inventory->id == $item->inventory_id) selected @endif>{{ $inventory->nama_barang }}
                            </option>
                          @endforeach
                          <option value="lainnya">Lainnya...</option>
                        </select>
                      @else
                        <div class="input-group">
                          <input type="text" class="form-control " name="usulan_thp[]" id="usulan_thp" value="{{ $item->usulan_thp }}">
                        </div>
                      @endif
                    </td>
                    <td class="baik" name="baik">{{ $item->inventory ? $item->inventory->baik : '0' }}</td>
                    <td class="rusak_ringan" name="rusak_ringan">{{ $item->inventory ? $item->inventory->rusak_ringan : '0' }}</td>
                    <td class="rusak_berat" name="rusak_berat">{{ $item->inventory ? $item->inventory->rusak_berat : '0' }}</td>
                    <td>
                      <div class="input-group">
                        <input type="number" min="0" class="form-control input-jumlah" id="jumlah_thp" name="jumlah_thp[]"
                          value="{{ $item->jumlah_thp }}">
                      </div>
                    </td>
                    <td>
                      <div class="input-group">
                        <textarea class="form-control firstTextarea" id="spesifikasi_thp" name="spesifikasi_thp[]">{{ $item->spesifikasi_thp }}</textarea>
                      </div>
                    </td>
                    <td>
                      <div class="input-group">
                        <textarea class="form-control secondTextarea" id="justifikasi_thp" name="justifikasi_thp[]">{{ $item->justifikasi_thp }}</textarea>
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
          @else
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
                <tr class="text-center duplicate">
                  <input type="hidden" name="inventory_id[]">
                  <td class="count">1</td>
                  <td class="usulan" id="thp">
                    <select class="form-control form-control-sm eventSelect" id="usulan_thp" name="usulan_thp[]">
                      <option selected hidden value="">Pilih Barang</option>
                      @foreach ($thp as $item)
                        <option value="{{ $item->id }}">{{ $item->nama_barang }}</option>
                      @endforeach
                      <option value="lainnya">Lainnya...</option>
                    </select>
                  </td>
                  <td class="baik" name="baik">-</td>
                  <td class="rusak_ringan" name="rusak_ringan">-</td>
                  <td class="rusak_berat" name="rusak_berat">-</td>
                  <td>
                    <div class="input-group">
                      <input type="number" min="0" class="form-control input-jumlah" id="jumlah_thp" name="jumlah_thp[]">
                    </div>
                  </td>
                  <td>
                    <div class="input-group">
                      <textarea class="form-control firstTextarea" id="spesifikasi_thp" name="spesifikasi_thp[]"></textarea>
                    </div>
                  </td>
                  <td>
                    <div class="input-group">
                      <textarea class="form-control secondTextarea" id="justifikasi_thp" name="justifikasi_thp[]"></textarea>
                    </div>
                  </td>
                  <td>
                    <button type="button" class="btn btn-danger btn-delete"><i class="fas fa-trash" style="pointer-events: none"></i></button>
                  </td>
                </tr>
                <tr class="text-center">
                  <td colspan="8"></td>
                  <td>
                    <button type="button" class="btn btn-primary btn-add"><i class="fas fa-plus-circle" style="pointer-events: none"></i></button>
                  </td>
                </tr>
              </tbody>
            </table>
          @endif
        </div>
      </div>
    </div>

    {{-- tombol submit --}}
    <div class="card">
      <div class="card-body">
        <div class="float-right" style="padding-right: 2.3rem">
          <a href="{{ route('addiv.order') }}" class="btn btn-light mr-2">Kembali</a>
          <button type="submit" class="btn btn-primary">{{ $type == 'create' ? 'Submit' : 'Update' }}</button>
        </div>
      </div>
    </div>
  </form>
@endsection
