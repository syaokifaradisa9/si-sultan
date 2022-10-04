@extends('layouts.main')

@section('container')
  <form action="{{ route('addiv.store') }}" method="POST" id="form-usulan">
    @csrf
    {{-- usulan habis pakai --}}
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
              <tr class="text-center duplicate">
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
                    <input type="number" min="0" class="form-control" id="jumlah_hp" name="jumlah_hp[]">
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
                <td class="count">1</td>
                <td class="usulan" id="thp">
                  <select class="form-control form-control-sm eventSelect" id="usulan_thp" name="usulan_thp[]">
                    <option selected hidden value="">Pilih Barang</option>
                    @foreach ($thp as $item)
                      @if (old('usulan_thp.*') == $item->id)
                        <option value="{{ $item->id }}" selected>{{ $item->nama_barang }}</option>
                      @else
                        <option value="{{ $item->id }}">{{ $item->nama_barang }}</option>
                      @endif
                    @endforeach
                    <option value="lainnya">Lainnya...</option>
                  </select>
                </td>
                <td class="baik" name="baik">-</td>
                <td class="rusak_ringan" name="rusak_ringan">-</td>
                <td class="rusak_berat" name="rusak_berat">-</td>
                <td>
                  <div class="input-group">
                    <input type="number" min="0" class="form-control" id="jumlah_thp" name="jumlah_thp[]" value="{{ old('jumlah_thp[]') }}">
                  </div>
                </td>
                <td>
                  <div class="input-group">
                    <textarea class="form-control firstTextarea" id="spesifikasi_thp" name="spesifikasi_thp[]" value="{{ old('spesifikasi_thp[]') }}"></textarea>
                  </div>
                </td>
                <td>
                  <div class="input-group">
                    <textarea class="form-control secondTextarea" id="justifikasi_thp" name="justifikasi_thp[]" value="{{ old('justifikasi_thp[]') }}"></textarea>
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
        </div>
      </div>
    </div>

    {{-- tombol submit --}}
    <div class="card">
      <div class="card-body">
        <div class="float-right" style="padding-right: 2.3rem">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </div>
  </form>
@endsection
