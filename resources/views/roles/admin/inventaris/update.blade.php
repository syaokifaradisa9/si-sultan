@if ($type === 'hp')
  <form action="{{ route('addiv.updateInven', ['id' => $id, 'type' => $type]) }}" method="POST">
    @method('PUT')
    @csrf
    <div class="col-6 md-6">
      <div class="modal fade" id="edit-inven{{ $item->id }}-{{ $type }}" data-backdrop="false" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">Inventaris Barang Habis Pakai</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="card-body">
                <label>Nama Barang</label>
                <input type="text" name="nama_barang" class="form-control" value="{{ $item->nama_barang }}">
              </div>
              <div class="card-body" style="width: 150px">
                <label>Total</label>
                <input type="number" name="total" min="0" class="form-control" value="{{ $item->total }}">
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
@else
  <form action="{{ route('addiv.updateInven', ['id' => $id, 'type' => $type]) }}" method="POST">
    @method('PUT')
    @csrf
    <div class="col-6 md-6">
      <div class="modal fade" id="edit-inven{{ $item->id }}-{{ $type }}" data-backdrop="false" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">Inventaris Barang Habis Pakai</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="card-body">
                <label>Nama Barang</label>
                <input type="text" name="nama_barang" class="form-control" value="{{ $item->nama_barang }}">
                <div class="form-row mt-4">
                  <div class="form-group col-md-3">
                    <label>Baik</label>
                    <input type="number" min="0" name="baik" class="form-control" value="{{ $item->baik }}" style="width: 100px">
                  </div>
                  <div class="form-group col-md-3 ml-5">
                    <label>Rusak Ringan</label>
                    <input type="number" min="0" name="rusak_ringan" class="form-control" value="{{ $item->rusak_ringan }}"
                      style="width: 100px">
                  </div>
                  <div class="form-group col-md-3 ml-5">
                    <label>Rusak Berat</label>
                    <input type="number" min="0" name="rusak_berat" class="form-control" value="{{ $item->rusak_berat }}"
                      style="width: 100px">
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
@endif
