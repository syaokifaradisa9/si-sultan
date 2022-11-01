@extends('layouts.main')

@section('container')
  <div class="section-body">
    @if (session()->has('success'))
      <div id="success" data-flash="{{ session('success') }}"></div>
    @endif

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Detail Usulan Habis Pakai</h4>
            <div class="ml-auto">
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped table-md">
                <thead>
                  <tr class="text-center">
                    <th class="align-middle">No</th>
                    <th class="align-middle">Nama Usulan</th>
                    <th class="align-middle">Jumlah</th>
                    <th class="align-middle">Spesifikasi</th>
                    <th class="align-middle">Justifikasi</th>
                    <th class="align-middle">Status</th>
                    <th class="align-middle">Deskripsi</th>
                    <th class="align-middle">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($proposeHp as $hp)
                    <tr class="text-center" id="hp">
                      <td class="align-middle">{{ $loop->iteration }}</td>
                      <td class="align-middle">{{ $hp->usulan_hp }}</td>
                      <td class="align-middle">{{ $hp->jumlah_hp }}</td>
                      <td class="align-middle text-left">{{ $hp->spesifikasi_hp }}</td>
                      <td class="align-middle text-left">{{ $hp->justifikasi_hp }}</td>
                      <td class="align-middle">
                        <div
                          class="@if ($hp->status == 'disetujui') badge badge-success 
                          @elseif ($hp->status == 'ditunda') badge badge-warning
                          @elseif ($hp->status == 'diajukan kembali') badge badge-info 
                          @else badge badge-light @endif">
                          {{ $hp->status }}
                        </div>
                      </td>
                      <td class="align-middle text-left" style="width: 350px">
                        {{ $hp->deskripsi ? $hp->deskripsi : 'Tidak ada deskripsi' }}
                      </td>
                      @if ($hp->status === 'diajukan')
                        <td class="align-middle">
                          <div class="dropdown d-inline">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown">
                              <i class="fas fa-chevron-circle-down"></i>
                            </button>
                            <div class="dropdown-menu">
                              <a href="{{ route('ppk.approved', ['id' => $hp->id, 'type' => 'hp']) }}" class="dropdown-item has-icon" id="btn-confirm">
                                <i class="fas fa-check-circle text-success"></i> Setuju</a>
                              <a href="{{ route('ppk.pending', ['id' => $hp->id]) }}" class="dropdown-item has-icon" id="btn-pending">
                                <i class="fas fa-times-circle text-danger"></i> Tunda</a>
                            </div>
                          </div>
                        </td>
                      @else
                        <td class="align-middle">-</td>
                      @endif
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Detail Usulan Tidak Habis Pakai</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped table-md">
                <thead>
                  <tr class="text-center">
                    <th class="align-middle">No</th>
                    <th class="align-middle">Nama Usulan</th>
                    <th class="align-middle">Jumlah</th>
                    <th class="align-middle">Spesifikasi</th>
                    <th class="align-middle">Justifikasi</th>
                    <th class="align-middle">Status</th>
                    <th class="align-middle">Deskripsi</th>
                    <th class="align-middle">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($propose as $thp)
                    <tr class="text-center" id="thp">
                      <td class="align-middle">{{ $loop->iteration }}</td>
                      <td class="align-middle">{{ $thp->usulan_thp }}</td>
                      <td class="align-middle">{{ $thp->jumlah_thp }}</td>
                      <td class="align-middle text-left">{{ $thp->spesifikasi_thp }}</td>
                      <td class="align-middle text-left">{{ $thp->justifikasi_thp }}</td>
                      <td class="align-middle">
                        <div
                          class="@if ($thp->status == 'disetujui') badge badge-success 
                          @elseif ($thp->status == 'ditunda') badge badge-warning
                          @elseif ($thp->status == 'diajukan kembali') badge badge-info
                          @else badge badge-light @endif">
                          {{ $thp->status }}
                        </div>
                      </td>
                      <td class="align-middle text-left" style="width: 350px">
                        {{ $thp->deskripsi ? $thp->deskripsi : 'Tidak ada deskripsi' }}
                      </td>
                      @if ($thp->status === 'diajukan')
                        <td class="align-middle">
                          <div class="dropdown d-inline">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown">
                              <i class="fas fa-chevron-circle-down"></i>
                            </button>
                            <div class="dropdown-menu">
                              <a href="{{ route('ppk.approved', ['id' => $thp->id, 'type' => 'thp']) }}" class="dropdown-item has-icon"
                                id="btn-confirm">
                                <i class="fas fa-check-circle text-success"></i> Setuju</a>
                              <a href="{{ route('ppk.pending', ['id' => $thp->id]) }}" class="dropdown-item has-icon" id="btn-pending">
                                <i class="fas fa-times-circle text-danger"></i> Tunda</a>
                            </div>
                          </div>
                        </td>
                      @else
                        <td class="align-middle">-</td>
                      @endif
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

  <div class="card">
    <div class="card-body">
      <div class="float-right" style="padding-right: 2.3rem">
        <a href="{{ route('ppk.order') }}" class="btn btn-light mr-2">Kembali</a>
        <a href="{{ route('ppk.acceptAll', ['id' => $order_id]) }}" class="btn btn-success mr-2" id="btn-confirm"><i class="fas fa-check-circle"></i>
          Konfirmasi Semua Usulan</a>
      </div>
    </div>
  </div>

  <script>
    const btnPending = document.querySelectorAll("#btn-pending");

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
                inputLabel: 'Masukkan jumlah usulan yang ditunda',
                inputPlaceholder: `Jumlah usulan saat ini : ${type == 'hp' ? response.data.jumlah_hp : response.data.jumlah_thp}`,
                showCancelButton: true,
                allowOutsideClick: false,
                allowEscapeKey: false,
                cancelButtonText: 'Batal',
                inputValidator: (value) => {
                  if (!value || value < 1) {
                    return 'Silahkan masukkan jumlah usulan yang valid'
                  } else if (value > jumlah || value > jumlahHp) {
                    return 'Jumlah usulan lebih dari jumlah usulan yang sebelumnya'
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
  <script src="{{ asset('assets/js/btn-function.js') }}"></script>
@endpush
