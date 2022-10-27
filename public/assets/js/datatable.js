//! function untuk home
let link = window.location.href;
let splitLink = link.split("/");
let host = splitLink[0];

$(function () {
  $("#order-table").DataTable({
    bAutoWidth: false,
    processing: true,
    serverSide: true,
    ajax: `${host}/datatable/thp/home`,
    columns: [
      {
        data: null,
        render: (data, type, row, meta) => meta.row + 1,
      },
      {
        data: "nama_barang",
        name: "nama_barang",
      },
      {
        data: "baik",
        name: "baik",
      },
      {
        data: "rusak_ringan",
        name: "rusak_ringan",
      },
      {
        data: "rusak_berat",
        name: "rusak_berat",
      },
    ],
  });
});

$(function () {
  $("#used-table").DataTable({
    bAutoWidth: false,
    processing: true,
    serverSide: true,
    ajax: `${host}/datatable/hp/home`,
    columns: [
      {
        data: null,
        render: (data, type, row, meta) => meta.row + 1,
      },
      {
        data: "nama_barang",
        name: "nama_barang",
      },
      {
        data: "total",
        name: "total",
      },
    ],
  });
});
//! end of home page

//? function untuk order detail
let url = window.location.href;
let splitUrl = url.split("/");

let domain = splitUrl[0];
let id = splitUrl[5];

$(function () {
  $("#detail-hp").DataTable({
    bAutoWidth: false,
    processing: true,
    serverSide: true,
    ajax: `${domain}/datatable/hp/${id}/detail`,
    columns: [
      {
        data: null,
        render: (data, type, row, meta) => meta.row + 1,
      },
      {
        data: "usulan_hp",
        name: "usulan_hp",
      },
      {
        data: "jumlah_hp",
        name: "jumlah_hp",
      },
      {
        data: "spesifikasi_hp",
        name: "spesifikasi_hp",
      },
      {
        data: "justifikasi_hp",
        name: "justifikasi_hp",
      },
      {
        data: "status",
        name: "status",
      },
    ],
  });
});

$(function () {
  $("#detail-thp").DataTable({
    bAutoWidth: false,
    processing: true,
    serverSide: true,
    ajax: `${domain}/datatable/thp/${id}/detail`,
    columns: [
      {
        data: null,
        render: (data, type, row, meta) => meta.row + 1,
      },
      {
        data: "usulan_thp",
        name: "usulan_thp",
      },
      {
        data: "jumlah_thp",
        name: "jumlah_thp",
      },
      {
        data: "spesifikasi_thp",
        name: "spesifikasi_thp",
      },
      {
        data: "justifikasi_thp",
        name: "justifikasi_thp",
      },
      {
        data: "status",
        name: "status",
      },
    ],
  });
});

//? end of order detail
