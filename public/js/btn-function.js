// tombol konfirmasi
const btnCofirm = document.querySelectorAll("#btn-confirm");

btnCofirm.forEach((element) => {
  element.addEventListener("click", (e) => {
    e.preventDefault();

    const href = e.target.getAttribute("href");

    Swal.fire({
      title: "Apakah anda yakin?",
      text: "Usulan yang telah dikonfirmasi akan diteruskan ke bagian selanjutnya!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Konfirmasi!",
    }).then((result) => {
      if (result.isConfirmed) {
        location.href = href;
      }
    });
  });
});
