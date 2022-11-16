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
