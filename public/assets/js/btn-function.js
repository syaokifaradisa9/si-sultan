// tombol konfirmasi
const btnCofirm = document.querySelectorAll("#btn-confirm");

btnCofirm.forEach((element) => {
  element.addEventListener("click", (e) => {
    e.preventDefault();

    const href = e.target.getAttribute("href");

    Swal.fire({
      title: "Apakah anda yakin?",
      text: "Usulan ini akan dikonfirmasi!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Konfirmasi!",
      cancelButtonText: "Batal",
      allowOutsideClick: false,
      allowEscapeKey: false,
    }).then((result) => {
      if (result.isConfirmed) {
        location.href = href;
      }
    });
  });
});
