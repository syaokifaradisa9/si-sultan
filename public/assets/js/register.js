const roles = document.getElementById("role");
const divisions = document.querySelector(".division");

roles.addEventListener("change", function () {
  const role = this.value;

  if (role === "admin_divisi" || role === "kepala_divisi") {
    divisions.classList.remove("d-none");
  } else {
    divisions.classList.add("d-none");
  }
});
