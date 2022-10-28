@extends('layouts.main')

@section('container')
  <div class="section-body">
    @if (session()->has('success'))
      <div id="success" data-flash="{{ session('success') }}"></div>
    @endif

    <div class="card">
      <div class="card-header">
        <h4>Tabel Usulan</h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped table-md">
            <tr class="text-center">
              <th>No</th>
              <th>Order</th>
              <th>Tanggal Usulan</th>
              <th>Jumlah Usulan</th>
              <th>Deskripsi</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
            @foreach ($orders as $order)
              <tr class="text-center">
                <td class="align-middle">{{ $loop->iteration }}</td>
                <td class="align-middle">{{ $order->userDivision->division->nama }}</td>
                <td class="align-middle">{{ date_format($order->created_at, 'd F Y / H:i') }}</td>
                <td class="text-left">
                  {{ count($order->proposeHp) . ' Barang Habis Pakai' }} <br>
                  {{ count($order->propose) . ' Barang Tidak Habis Pakai' }}
                </td>
                <td class="align-middle text-left" style="max-width: 450px;">
                  {{ $description_by_mutu ?? '-' }}
                </td>
                <td class="align-middle">
                  <div class="{{ $order->description_by_mutu ? 'badge badge-danger' : 'badge badge-success' }}">
                    @if ($order->description_by_mutu)
                      {{ 'Ditolak' }}
                    @elseif ($order->approved_by_mutu)
                      {{ 'Disetujui' }}
                    @else
                      {{ '-' }}
                    @endif
                  </div>
                </td>
                <td>
                  <div class="dropdown d-inline">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown">
                      <i class="fas fa-chevron-circle-down"></i>
                    </button>
                    <div class="dropdown-menu">
                      <a href="{{ route('mutu.orderDetail', [$order->id]) }}" class="dropdown-item has-icon"><i
                          class="fas fa-info-circle text-info"></i>
                        Detail</a>
                      @if (!$order->approved_by_mutu && !$order->description_by_mutu)
                        <a href="{{ route('mutu.accept', ['id' => $order->id]) }}" class="dropdown-item has-icon" id="btn-confirm"><i
                            class="fas fa-check-circle text-success"></i> Konfirmasi</a>
                      @endif
                      @if (!$order->approved_by_mutu && !$order->description_by_mutu)
                        <a href="{{ route('mutu.reject', ['id' => $order->id]) }}" class="dropdown-item has-icon" id="btn-reject">
                          <i class="fas fa-times-circle text-danger"></i> Tolak</a>
                      @endif
                    </div>
                  </div>
                </td>
              </tr>
            @endforeach
          </table>
        </div>
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
