@extends('layouts.main')

@section('container')
  <form action="{{ route('addiv.store') }}" method="POST">
    @csrf
    <div class="card">
      <div class="card-header">
        <h4>Usulan Barang Habis Pakai</h4>
        <div class="card-header-form">
        </div>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-striped ">
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
                <td>
                  <select class="form-control form-control-sm" name="usulan_hp[]">
                    <option>Option 1</option>
                    <option>Option 2</option>
                    <option>Option 3</option>
                  </select>
                </td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>
                  <div class="input-group" id="input">
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
                <td colspan="8"></td>
                <td>
                  <button type="button" class="btn btn-primary btn-add"><i class="fas fa-plus-circle"></i></button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

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
                <th>No</th>
                <th>Nama Alat</th>
                <th style="width: 8rem">Jumlah</th>
                <th>Spesifikasi</th>
                <th>Justifikasi</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody class="duplicate-form">
              <tr class="text-center duplicate">
                <td class="count">1</td>
                <td>
                  <select class="form-control form-control-sm" name="usulan_thp[]">
                    <option>Option 1</option>
                    <option>Option 2</option>
                    <option>Option 3</option>
                  </select>
                </td>
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
                <td colspan="5"></td>
                <td>
                  <button type="button" class="btn btn-primary btn-add"><i class="fas fa-plus-circle" style="pointer-events: none"></i></button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

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

        newForm.querySelector('input').value = ''
        newForm.querySelector('.firstTextarea').value = ''
        newForm.querySelector('.secondTextarea').value = ''

        const lastRow = parent.children[parent.children.length - 2]
        newForm.querySelector('.count').innerText = parseInt(lastRow.querySelector('.count').innerText) + 1

        newForm.querySelector('.btn-delete').addEventListener('click', btnOnDelete)

        parent.insertBefore(newForm, node)
      })
    });

    btnDelete.forEach(element => {
      element.addEventListener('click', btnOnDelete)
    });
  </script>
@endsection
