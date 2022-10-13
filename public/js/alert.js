// alert success dan failed
let success = $("#success").data("flash");
let failed = $("#failed").data("flash");

if (success) {
  Swal.fire({
    icon: "success",
    title: "Berhasil!",
    text: success,
  });
} else if (failed) {
  Swal.fire({
    icon: "error",
    title: "Oops...",
    text: failed,
  });
}
