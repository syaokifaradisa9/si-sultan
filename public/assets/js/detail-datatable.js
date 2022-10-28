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
        class: "align-middle",
      },
      {
        data: "usulan_hp",
        name: "usulan_hp",
        class: "align-middle",
      },
      {
        data: "jumlah_hp",
        name: "jumlah_hp",
        class: "align-middle",
      },
      {
        data: "spesifikasi_hp",
        name: "spesifikasi_hp",
        class: "align-middle",
      },
      {
        data: "justifikasi_hp",
        name: "justifikasi_hp",
        class: "align-middle",
      },
      {
        data: "status",
        name: "status",
        class: "align-middle",
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
        class: "align-middle",
      },
      {
        data: "usulan_thp",
        name: "usulan_thp",
        class: "align-middle",
      },
      {
        data: "jumlah_thp",
        name: "jumlah_thp",
        class: "align-middle",
      },
      {
        data: "spesifikasi_thp",
        name: "spesifikasi_thp",
        class: "align-middle",
      },
      {
        data: "justifikasi_thp",
        name: "justifikasi_thp",
        class: "align-middle",
      },
      {
        data: "status",
        name: "status",
        class: "align-middle",
      },
    ],
  });
});

//? end of order detail
