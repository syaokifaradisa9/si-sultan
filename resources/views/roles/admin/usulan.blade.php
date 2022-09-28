@extends('layouts.main')

@section('container')
  <form action="{{ route('addiv.store') }}" method="POST">
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
              {{-- untuk mendapatkan old value --}}
              @if (old('usulan_hp.0'))
                {{ $i = 0 }}
                @while (old('usulan_hp.'.$i) !== null)
                  <tr class="text-center duplicate">
                    <td class="count">1</td>
                    <td class="usulan" id="hp">
                      <select class="form-control form-control-sm eventSelect  @error('usulan_hp.*') is-invalid @enderror" name="usulan_hp[]">
                        <option selected hidden value="">Pilih Barang</option>
                        @foreach ($hp as $item)
                          @if (old('usulan_hp.'.$i) == $item->id)
                            <option value="{{ $item->id }}" selected>{{ $item->nama_barang }}</option>
                          @else
                            <option value="{{ $item->id }}">{{ $item->nama_barang }}</option>
                          @endif
                        @endforeach
                        <option value="lainnya">Lainnya...</option>
                      </select>
                    </td>
                    <td>
                      <div class="total">-</div>
                    </td>
                    <td>
                      <div class="input-group">
                        <input type="number" min="0" class="form-control @error('jumlah_hp.*') is-invalid @enderror" aria-label="Sizing example input" name="jumlah_hp[]"
                        value="{{ old('jumlah_hp.'.$i) }}">
                      </div>
                    </td>
                    <td>
                      <div class="input-group">
                        <textarea class="form-control firstTextarea  @error('spesifikasi_hp.*') is-invalid @enderror" aria-label="With textarea" name="spesifikasi_hp[]">{{ old('spesifikasi_hp.'.$i) }}</textarea>
                      </div>
                    </td>
                    <td>
                      <div class="input-group">
                        <textarea class="form-control secondTextarea  @error('justifikasi_hp.*') is-invalid @enderror" aria-label="With textarea" name="justifikasi_hp[]">{{ old('justifikasi_hp.'.$i) }}</textarea>
                      </div>
                    </td>
                    <td>
                      <button type="button" class="btn btn-danger btn-delete"><i class="fas fa-trash" style="pointer-events: none"></i></button>
                    </td>
                  </tr>
                  {{ $i++ }}
                @endwhile
              @else
                <tr class="text-center duplicate">
                  <td class="count">1</td>
                  <td class="usulan" id="hp">
                    <select class="form-control form-control-sm eventSelect  @error('usulan_hp.*') is-invalid @enderror" name="usulan_hp[]">
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
                      <input type="number" min="0" class="form-control @error('jumlah_hp.*') is-invalid @enderror" aria-label="Sizing example input" name="jumlah_hp[]">
                    </div>
                  </td>
                  <td>
                    <div class="input-group">
                      <textarea class="form-control firstTextarea  @error('spesifikasi_hp.*') is-invalid @enderror" aria-label="With textarea" name="spesifikasi_hp[]"></textarea>
                    </div>
                  </td>
                  <td>
                    <div class="input-group">
                      <textarea class="form-control secondTextarea  @error('justifikasi_hp.*') is-invalid @enderror" aria-label="With textarea" name="justifikasi_hp[]"></textarea>
                    </div>
                  </td>
                  <td>
                    <button type="button" class="btn btn-danger btn-delete"><i class="fas fa-trash" style="pointer-events: none"></i></button>
                  </td>
                </tr>
              @endif
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
              {{-- untuk mendapatkan old value --}}
              @if (old('usulan_thp.0'))
                {{ $i = 0 }}
                @while (old('usulan_thp.'.$i) !== null)
                  <tr class="text-center duplicate">
                    <td class="count">1</td>
                    <td class="usulan" id="thp">
                      <select class="form-control form-control-sm eventSelect @error('usulan_thp.*') is-invalid @enderror" name="usulan_thp[]" >
                        <option selected hidden value="">Pilih Barang</option>
                        @foreach ($thp as $item)
                          @if (old('usulan_thp.'.$i) == $item->id)
                            <option value="{{ $item->id }}" selected>{{ $item->nama_barang }}</option>
                          @else
                            <option value="{{ $item->id }}">{{ $item->nama_barang }}</option>
                          @endif
                        @endforeach
                        <option value="lainnya">Lainnya...</option>
                      </select>
                    </td>
                    <td class="baik" name="baik">{{ Request::json('test') ?? '-' }}</td>
                    <td class="rusak_ringan" name="rusak_ringan" value="{{ old('rusak_ringan') }}">-</td>
                    <td class="rusak_berat" name="rusak_berat" value="{{ old('rusak_berat') }}">-</td>
                    <td>
                      <div class="input-group">
                        <input type="number" min="0" class="form-control @error('jumlah_thp.*') is-invalid @enderror" name="jumlah_thp[]"
                          value="{{ old('jumlah_thp.'.$i) }}">
                      </div>
                    </td>
                    <td>
                      <div class="input-group">
                        <textarea class="form-control firstTextarea @error('spesifikasi_thp.*') is-invalid @enderror" name="spesifikasi_thp[]">{{ old('spesifikasi_thp.'.$i) }}</textarea>
                      </div>
                    </td>
                    <td>
                      <div class="input-group">
                        <textarea class="form-control secondTextarea @error('justifikasi_thp.*') is-invalid @enderror" name="justifikasi_thp[]">{{ old('justifikasi_thp.'.$i) }}</textarea>
                      </div>
                    </td>
                    <td>
                      <button type="button" class="btn btn-danger btn-delete"><i class="fas fa-trash" style="pointer-events: none"></i></button>
                    </td>
                  </tr>
                  {{ $i++ }}
                @endwhile
              @else
                <tr class="text-center duplicate">
                  <td class="count">1</td>
                  <td class="usulan" id="thp">
                    <select class="form-control form-control-sm eventSelect @error('usulan_thp.*') is-invalid @enderror" name="usulan_thp[]" >
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
                      <input type="number" min="0" class="form-control @error('jumlah_thp.*') is-invalid @enderror" name="jumlah_thp[]"
                        value="{{ old('jumlah_thp[]') }}">
                    </div>
                  </td>
                  <td>
                    <div class="input-group">
                      <textarea class="form-control firstTextarea @error('spesifikasi_thp.*') is-invalid @enderror" name="spesifikasi_thp[]" value="{{ old('spesifikasi_thp[]') }}"></textarea>
                    </div>
                  </td>
                  <td>
                    <div class="input-group">
                      <textarea class="form-control secondTextarea @error('justifikasi_thp.*') is-invalid @enderror" name="justifikasi_thp[]" value="{{ old('justifikasi_thp[]') }}"></textarea>
                    </div>
                  </td>
                  <td>
                    <button type="button" class="btn btn-danger btn-delete"><i class="fas fa-trash" style="pointer-events: none"></i></button>
                  </td>
                </tr>
              @endif
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

  <script>
    const btnAdd = document.querySelectorAll('.btn-add')
    const btnDelete = document.querySelectorAll('.btn-delete')
    const select = document.querySelectorAll('.eventSelect')
    const option = document.querySelectorAll('.usulan')
    
    // untuk mendapatkan nilai bpm
    const getBpm = async (e) => {
      const selectId = e.target.value
      const type = e.target.parentElement.getAttribute('id')

      if(selectId !== "lainnya" && type !== null){
        const response = await fetch(`http://si-sultan.test/api/inventory/${selectId}/${type}`)
        const responseJson = await response.json()

        if(responseJson.status == 200) {
          if (type === 'hp') {
            e.target.parentElement.closest('tr').querySelector('.total').innerHTML = responseJson.data.total
          }
          if (type === 'thp') {
            e.target.parentElement.closest('tr').querySelector('.baik').innerHTML = responseJson.data.baik
            e.target.parentElement.closest('tr').querySelector('.rusak_ringan').innerHTML = responseJson.data.rusak_ringan
            e.target.parentElement.closest('tr').querySelector('.rusak_berat').innerHTML = responseJson.data.rusak_ringan
          }
        }
      } else {
        if (type === 'hp') {
          e.target.parentElement.closest('tr').querySelector('.total').innerHTML = '0'
        }

        if (type === 'thp') {
          e.target.parentElement.closest('tr').querySelector('.baik').innerHTML = '0'
          e.target.parentElement.closest('tr').querySelector('.rusak_ringan').innerHTML = '0'
          e.target.parentElement.closest('tr').querySelector('.rusak_berat').innerHTML = '0'
        }
      }
    }

    // fungsi untuk tombol hapus
    const btnOnDelete = (e) => {
      e.preventDefault()

      const form = e.target.closest('.duplicate-form')

      if ((form.children.length - 1) > 1) {
        const deletedRow = e.target.closest('tr')
        const deletedIndex = deletedRow.querySelector('.count').innerText - 1

        deletedRow.remove()

        for (let i = deletedIndex; i < form.children.length - 1; i++) {
          form.children[i].querySelector('.count').innerText = i + 1
        }
      };
    }

    // fungsi untuk tombol tambah form
    btnAdd.forEach(element => {
      element.addEventListener('click', (e) => {
        e.preventDefault()

        // mendapatkan row tabel (tr)
        const duplicated = e.target.closest('.duplicate-form').querySelector('.duplicate')

        // mendapatkan parent dari row (tbody)
        const parent = e.target.closest('.duplicate-form')

        // duplikat form
        const newForm = duplicated.cloneNode(true)

        // mendapatkan element terakhir dari form
        const node = parent.lastElementChild

        // untuk membuat nilai bpm di form baru menjadi kosong
        const type = newForm.querySelector('.usulan').getAttribute('id')

        if (type === 'hp') {
          newForm.querySelector('.total').innerHTML = '-'
        }
        if (type === 'thp') {
          newForm.querySelector('.baik').innerHTML = '-'
          newForm.querySelector('.rusak_ringan').innerHTML = '-'
          newForm.querySelector('.rusak_berat').innerHTML = '-'
        }

        // untuk membuat inputan di form baru menjadi kosong
        newForm.querySelector('input').value = ''
        newForm.querySelector('.firstTextarea').value = ''
        newForm.querySelector('.secondTextarea').value = ''

        // mengambil element terakhir dari node yang di duplikat
        const lastRow = parent.children[parent.children.length - 2]

        // merubah nomor agar inrement
        newForm.querySelector('.count').innerText = parseInt(lastRow.querySelector('.count').innerText) + 1

        // fungsi button delete
        newForm.querySelector('.btn-delete').addEventListener('click', btnOnDelete)

        const formId = newForm.querySelector('.usulan')?.getAttribute('id');

        if (formId === 'hp') {
          newForm.querySelector('.usulan').innerHTML = `
            <select class="form-control form-control-sm eventSelect" name="usulan_hp[]">
              <option selected hidden value="">Pilih Barang</option>
              @foreach ($hp as $item)
                <option value="{{ $item->id }}">{{ $item->nama_barang }}</option>
              @endforeach
              <option value="lainnya">Lainnya...</option>
            </select>
          `
        } 
        
        if (formId === 'thp'){
          newForm.querySelector('.usulan').innerHTML = `
            <select class="form-control form-control-sm eventSelect" name="usulan_thp[]">
              <option selected hidden value="">Pilih Barang</option>
              @foreach ($thp as $item)
                <option value="{{ $item->id }}">{{ $item->nama_barang }}</option>
              @endforeach
              <option value="lainnya">Lainnya...</option>
            </select>
          `
        }

        const optionNewForm = newForm.querySelectorAll('.usulan')
        
        optionNewForm.forEach(element => {
          element.addEventListener('change', getBpm)
        })

        newForm.querySelectorAll('.eventSelect')?.forEach(element => {
          element.addEventListener('click', event)
        });

        parent.insertBefore(newForm, node)
      })
    });

    // untuk menjalankan fungsi delete
    btnDelete.forEach(element => {
      element.addEventListener('click', btnOnDelete)
    });

    // merubah inputan ketika memilih opsi lainnya
    const event = (e) => {
      e.preventDefault()

      if (e.target.value == 'lainnya') {
        const name = e.target.getAttribute('name');
        e.target.closest('td').innerHTML = `
          <div class="input-group">
            <input type="text" class="form-control  @error('${name}') is-invalid @enderror" name="${name}">
          </div>
        `;
      }
    }

    // menjalankan fungsi inputan
    select.forEach(element => {
      element.addEventListener('click', event)
    });

    // menjalankan fungsi getBpm untuk menampilkan data dari tabel inventory
    option.forEach(element => {
      element.addEventListener('change', getBpm)
    });
  </script>
@endsection
