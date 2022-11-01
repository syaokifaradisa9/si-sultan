@extends('layouts.main', ['title' => 'Beranda | PPK', 'header' => 'Beranda'])

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
                  <th class="text-center">No</th>
                  <th class="text-center">Nama Barang</th>
                  <th class="text-center">Total</th>
                </tr>
              </thead>
              <tbody class="text-center">
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
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-md" id="order-table">
              <thead>
                <tr>
                  <th class="text-center">No</th>
                  <th class="text-center">Nama Barang</th>
                  <th class="text-center">Baik</th>
                  <th class="text-center">Rusak Ringan</th>
                  <th class="text-center">Rusak Berat</th>
                </tr>
              </thead>
              <tbody class="text-center">
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="row">
    <div class="col-12 ">
      <div class="card">
        <div class="card-header">
          <h4>Barang Habis Pakai yang Disetujui</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-md" id="pending-table">
              <thead>
                <tr class="text-center">
                  <th class="align-middle" rowspan="2">No</th>
                  <th class="align-middle" rowspan="2">Nama Barang</th>
                  <th class="align-middle" colspan="2">Jumlah</th>
                  <th class="align-middle" rowspan="2">Spesifikasi</th>
                  <th class="align-middle" rowspan="2">Justifikasi</th>
                  <th class="align-middle" rowspan="2">Status</th>
                  <th class="align-middle" rowspan="2">Aksi</th>
                </tr>
                <tr>
                  <th class="align-middle" style="width: 150px">Disetujui</th>
                  <th class="align-middle" style="width: 150px">Belum Diterima</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($proposeHp as $propose)
                  <tr id="hp">
                    <td class="align-middle">{{ $loop->iteration }}</td>
                    <td class="align-middle">{{ $propose->usulan_hp }}</td>
                    <td class="align-middle">{{ $firstAmountHp }}</td>
                    <td class="align-middle">{{ $propose->jumlah_hp }}</td>
                    <td class="align-middle text-left" style="max-width: 300px">{{ $propose->spesifikasi_hp }}</td>
                    <td class="align-middle text-left" style="max-width: 300px">{{ $propose->justifikasi_hp }}</td>
                    <td class="align-middle text-center">
                      <div class="badge badge-success">
                        {{ $propose->status }}
                      </div>
                    </td>
                    <td class="align-middle text-center">
                      <div class="dropdown d-inline">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown">
                          <i class="fas fa-chevron-circle-down"></i>
                        </button>
                        <div class="dropdown-menu">
                          <a href="{{ route('ppk.itemReceived', ['id' => $propose->id]) }}" class="dropdown-item has-icon" id="btn-received">
                            <i class="fas fa-check-circle text-success"></i> Barang Diterima</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>

        <hr style="margin: 36px 28px 0">
        <div class="card-header">
          <h4>Barang Tak Habis Pakai yang Disetujui</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-md" id="pending-table">
              <thead>
                <tr class="text-center">
                  <th class="align-middle" rowspan="2">No</th>
                  <th class="align-middle" rowspan="2">Nama Barang</th>
                  <th class="align-middle" colspan="2">Jumlah</th>
                  <th class="align-middle" rowspan="2">Spesifikasi</th>
                  <th class="align-middle" rowspan="2">Justifikasi</th>
                  <th class="align-middle" rowspan="2">Status</th>
                  <th class="align-middle" rowspan="2">Aksi</th>
                </tr>
                <tr>
                  <th class="align-middle" style="width: 150px">Disetujui</th>
                  <th class="align-middle" style="width: 150px">Belum Diterima</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($proposes as $propose)
                  <tr id="thp">
                    <td class="align-middle">{{ $loop->iteration }}</td>
                    <td class="align-middle">{{ $propose->usulan_thp }}</td>
                    <td class="align-middle">{{ $firstAmount }}</td>
                    <td class="align-middle">{{ $propose->jumlah_thp }}</td>
                    <td class="align-middle text-left" style="max-width: 300px">{{ $propose->spesifikasi_thp }}</td>
                    <td class="align-middle text-left" style="max-width: 300px">{{ $propose->justifikasi_thp }}</td>
                    <td class="align-middle text-center">
                      <div class="badge badge-success">
                        {{ $propose->status }}
                      </div>
                    </td>
                    <td class="align-middle text-center">
                      <div class="dropdown d-inline">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown">
                          <i class="fas fa-chevron-circle-down"></i>
                        </button>
                        <div class="dropdown-menu">
                          <a href="{{ route('ppk.itemReceived', ['id' => $propose->id]) }}" class="dropdown-item has-icon" id="btn-received">
                            <i class="fas fa-check-circle text-success"></i> Barang Diterima</a>
                        </div>
                      </div>
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

  <script>
    const btnPending = document.querySelectorAll("#btn-received");

    btnPending.forEach((element) => {
      element.addEventListener("click", (e) => {
        e.preventDefault();

        const href = e.target.getAttribute('href')

        const splitHref = href.split("/")
        const id = splitHref[5]
        const type = e.target.parentElement.closest('tr').getAttribute('id')

        $.ajax({
          type: "GET",
          url: `http://si-sultan.test/api/propose/${id}/${type}`,
          contentType: "application/json",
          dataType: 'json',
          success: function(response) {
            if (response) {
              let jumlahHp = response.data.jumlah_hp
              let jumlah = response.data.jumlah_thp
              Swal.fire({
                input: 'number',
                width: '32em',
                inputLabel: 'Masukkan jumlah barang yang diterima',
                inputPlaceholder: `Jumlah barang yang belum diterima : ${type == 'hp' ? response.data.jumlah_hp : response.data.jumlah_thp}`,
                showCancelButton: true,
                allowOutsideClick: false,
                allowEscapeKey: false,
                cancelButtonText: 'Batal',
                inputValidator: (value) => {
                  if (!value || value < 1) {
                    return 'Silahkan masukkan jumlah barang yang valid'
                  } else if (value > jumlah || value > jumlahHp) {
                    return 'Jumlah barang lebih dari jumlah barang yang sebelumnya'
                  }
                }
              }).then((resultNumb) => {
                if (resultNumb.isConfirmed) {
                  Swal.fire({
                    input: "textarea",
                    inputLabel: "Deskripsi",
                    inputPlaceholder: "Tuliskan deskripsi disini...",
                    inputAttributes: {
                      "aria-label": "Tuliskan deskripsi disini",
                    },
                    showCancelButton: true,
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    cancelButtonText: 'Batal',
                    inputValidator: (value) => {
                      if (!value) {
                        return 'Silahkan masukkan deskripsi penolakan'
                      }
                    }
                  }).then((resultDesc) => {
                    if (resultDesc.isConfirmed) {
                      $.ajax({
                        type: "POST",
                        url: href,
                        cache: false,
                        headers: {
                          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                        },
                        data: {
                          dataType: type,
                          dataNumb: resultNumb.value,
                          dataDesc: resultDesc.value,
                        },
                        success: function(response) {
                          if (response) {
                            window.location.href = "";
                          }
                        },
                      });
                    }
                  });
                }
              })
            }
          },
        });
      });
    });
  </script>
@endsection

@push('js-extends')
  <script src="{{ asset('assets/js/datatable.js') }}"></script>
@endpush
