@extends('layouts.main', ['header' => 'Detail'])

@section('container')
  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Detail Usulan Habis Pakai</h4>
            <div class="ml-auto">
              @if ($order->description_by_mutu)
                <div class="badge badge-danger" disabled>Usulan telah ditolak</div>
              @endif
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped table-md" id="detail-hp">
                <thead>
                  <tr class="text-center">
                    <th>No</th>
                    <th>Nama Usulan</th>
                    <th>Jumlah</th>
                    <th>Spesifikasi</th>
                    <th>Justifikasi</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="text-center">
                  </tr>
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
              <table class="table table-bordered table-striped table-md" id="detail-thp">
                <thead>
                  <tr class="text-center">
                    <th>No</th>
                    <th>Nama Usulan</th>
                    <th>Jumlah</th>
                    <th>Spesifikasi</th>
                    <th>Justifikasi</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="text-center">
                  </tr>
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
        <a href="{{ route('mutu.order') }}" class="btn btn-light mr-2">Kembali</a>
        @if (!$order->approved_by_mutu && !$order->description_by_mutu)
          <a href="{{ route('mutu.accept', ['id' => $order->id]) }}" class="btn btn-success mr-2" id="btn-confirm">Konfirmasi</a>
        @endif
        @if (!$order->approved_by_mutu && !$order->description_by_mutu)
          <a href="{{ route('mutu.reject', ['id' => $order->id]) }}" class="btn btn-danger" id="btn-reject">Tolak</a>
        @endif
      </div>
    </div>
  </div>

  <script>
    const btnReject = document.querySelectorAll("#btn-reject");

    btnReject.forEach((element) => {
      element.addEventListener("click", (e) => {
        e.preventDefault();

        const href = e.target.getAttribute("href");

        Swal.fire({
          title: "Apakah anda yakin untuk menolak usulan?",
          text: "Silahkan masukkan deskripsi penolakan",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Tolak!",
          allowOutsideClick: false,
          allowEscapeKey: false,
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.isConfirmed) {
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
              cancelButtonText: 'Batal'
            }).then((result) => {
              if (result.isConfirmed) {
                $.ajax({
                  type: "POST",
                  url: href,
                  cache: false,
                  headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                  },
                  data: {
                    data: result.value,
                  },
                  success: function(response) {
                    if (response) {
                      window.location.href = "{{ route('mutu.order') }}";
                    }
                  },
                });
              }
            });
          }
        });
      });
    });
  </script>
@endsection

@push('js-extends')
  <script src="{{ asset('assets/js/btn-function.js') }}"></script>
  <script src="{{ asset('assets/js/detail-datatable.js') }}"></script>
@endpush
