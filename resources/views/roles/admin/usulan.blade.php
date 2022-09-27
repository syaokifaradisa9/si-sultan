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
              <tr class="text-center duplicate">
                <td class="count">1</td>
                <td class="usulan" id="hp">
                  <select class="form-control form-control-sm eventSelect" name="usulan_hp[]">
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
                    <input type="number" min="0" class="form-control" aria-label="Sizing example input" name="jumlah_hp[]"
                      aria-describedby="inputGroup-sizing-default">
                  </div>
                </td>
                <td>
                  <div class="input-group">
                    <textarea class="form-control firstTextarea" aria-label="With textarea" name="spesifikasi_hp[]"></textarea>
                  </div>
                </td>
                <td>
                  <div class="input-group">
                    <textarea class="form-control secondTextarea" aria-label="With textarea" name="justifikasi_hp[]"></textarea>
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
                  <select class="form-control form-control-sm eventSelect" name="usulan_thp[]">
                    <option selected hidden value="">Pilih Barang</option>
                    @foreach ($thp as $item)
                      <option value="{{ $item->id }}">{{ $item->nama_barang }}</option>
                    @endforeach
                    <option value="lainnya">Lainnya...</option>
                  </select>
                </td>
                <td class="baik">-</td>
                <td class="rusak_ringan">-</td>
                <td class="rusak_berat">-</td>
                <td>
                  <div class="input-group">
                    <input type="number" min="0" class="form-control" aria-label="Sizing example input" name="jumlah_thp[]"
                      aria-describedby="inputGroup-sizing-default">
                  </div>
                </td>
                <td>
                  <div class="input-group">
                    <textarea class="form-control firstTextarea" aria-label="With textarea" name="spesifikasi_thp[]"></textarea>
                  </div>
                </td>
                <td>
                  <div class="input-group">
                    <textarea class="form-control secondTextarea" aria-label="With textarea" name="justifikasi_thp[]"></textarea>
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

  <script>
    const btnAdd = document.querySelectorAll('.btn-add')
    const btnDelete = document.querySelectorAll('.btn-delete')
    const select = document.querySelectorAll('.eventSelect')
    const option = document.querySelectorAll('.usulan')
    
    // untuk mendapatkan nilai bpm
    const getBpm = async (e) => {
      const selectId = e.target.value
      const type = e.target.parentElement.getAttribute('id')

      if(selectId !== "lainnya"){
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
          e.target.parentElement.closest('tr').querySelector('.total').innerHTML = '-'
        }

        if (type === 'thp') {
          e.target.parentElement.closest('tr').querySelector('.baik').innerHTML = '-'
          e.target.parentElement.closest('tr').querySelector('.rusak_ringan').innerHTML = '-'
          e.target.parentElement.closest('tr').querySelector('.rusak_berat').innerHTML = '-'
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
        console.log(type);

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
        
        newForm.addEventListener('change', getBpm)

        newForm.querySelectorAll('.eventSelect')?.forEach(element => {
          element.addEventListener('click', event)
        });

        parent.insertBefore(newForm, node)
      })
    });

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
            <input type="text" class="form-control" name="${name}">
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
