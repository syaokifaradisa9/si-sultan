@extends('layouts.main')

@section('container')
  <div class="section-body">
    <h2 class="section-title">Order</h2>
    <p class="section-lead">Tabel order dari usulan yang telah disetujui oleh Kepala Bagian</p>

    @if (session()->has('success'))
      <div id="success" data-flash="{{ session('success') }}"></div>
    @endif

    <div class="card">
      <div class="card-header">
        <h4>Tabel Order</h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped table-md">
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
                <td class="align-middle">{{ date_format($order->created_at, 'd/m/Y H:i') }}</td>
                <td>
                  {{ count($order->proposeHp) . ' Barang Habis Pakai' }} <br>
                  {{ count($order->propose) . ' Barang Tidak Habis Pakai' }}
                </td>
                <td class="align-middle" style="max-width: 700px;">
                  @if (!$order->description_by_mutu)
                    Tidak ada deskripsi
                  @else
                    {{ $order->description_by_mutu }}
                  @endif
                </td>
                <td class="align-middle text-danger">
                  {{ $order->description_by_mutu ? 'Ditolak' : '' }}
                </td>
                <td>
                  <a href="{{ route('mutu.orderDetail', [$order->id]) }}" class="btn btn-primary">Detail</a>
                  @if (!$order->approved_by_mutu && !$order->description_by_mutu)
                    <a href="{{ route('mutu.accept', ['id' => $order->id]) }}" class="btn btn-success" id="btn-confirm">Konfirmasi</a>
                  @endif
                  @if (!$order->approved_by_mutu && !$order->description_by_mutu)
                    <a href="{{ route('mutu.reject', ['id' => $order->id]) }}" class="btn btn-danger" id="btn-reject">Tolak</a>
                  @endif
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
