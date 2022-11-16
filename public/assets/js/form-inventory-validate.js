window.addEventListener("DOMContentLoaded", () => {
  const formSubmit = document.getElementById("form-inventory");
  formSubmit.addEventListener("submit", (e) => {
    e.preventDefault();

    const barangHp = checkBarang();
    const total = checkTotal();
    const barangThp = checkBarangThp();
    const barangBaik = checkBarangBaik();
    const rusakRingan = checkRusakRingan();
    const rusakBerat = checkRusakBerat();

    if (barangHp || total) {
      const removeInvalid = document.querySelectorAll(".input-thp");
      removeInvalid.forEach((element) => {
        element.classList.remove("is-invalid");
      });
    }

    if (barangThp || barangBaik || rusakRingan || rusakBerat) {
      const removeInvalid = document.querySelectorAll(".input-hp");
      removeInvalid.forEach((element) => {
        element.classList.remove("is-invalid");
      });
    }

    if (
      (barangHp && total) ||
      (barangThp && barangBaik && rusakRingan && rusakBerat)
    ) {
      formSubmit.submit();
    }
  });
});

const checkBarang = () => {
  let formStatus = true;
  const barangHp = document.querySelectorAll("#inventory_hp");

  barangHp.forEach((element) => {
    const inventoryHpValue = element.value.trim();
    if (!inventoryHpValue) {
      element.classList.add("is-invalid");
      formStatus = formStatus && false;
    } else {
      element.classList.remove("is-invalid");
    }
  });

  return formStatus;
};

const checkTotal = () => {
  let formStatus = true;
  const totalHp = document.querySelectorAll("#total_hp");

  totalHp.forEach((element) => {
    const totalValue = element.value.trim();
    if (!totalValue) {
      element.classList.add("is-invalid");
      formStatus = formStatus && false;
    } else {
      element.classList.remove("is-invalid");
    }
  });

  return formStatus;
};

const checkBarangThp = () => {
  let formStatus = true;
  const barangThp = document.querySelectorAll("#inventory_thp");

  barangThp.forEach((element) => {
    const inventotyThpValue = element.value.trim();

    if (!inventotyThpValue) {
      element.classList.add("is-invalid");
      formStatus = formStatus && false;
    } else {
      element.classList.remove("is-invalid");
    }
  });

  return formStatus;
};

const checkBarangBaik = () => {
  let formStatus = true;
  const barangBaik = document.querySelectorAll("#baik_thp");

  barangBaik.forEach((element) => {
    const barangBaikValue = element.value.trim();

    if (!barangBaikValue) {
      element.classList.add("is-invalid");
      formStatus = formStatus && false;
    } else {
      element.classList.remove("is-invalid");
    }
  });

  return formStatus;
};

const checkRusakRingan = () => {
  let formStatus = true;
  const rusakRingan = document.querySelectorAll("#rusak_ringan_thp");

  rusakRingan.forEach((element) => {
    const rusakRinganValue = element.value.trim();

    if (!rusakRinganValue) {
      element.classList.add("is-invalid");
      formStatus = formStatus && false;
    } else {
      element.classList.remove("is-invalid");
    }
  });

  return formStatus;
};

const checkRusakBerat = () => {
  let formStatus = true;
  const rusakBerat = document.querySelectorAll("#rusak_berat_thp");

  rusakBerat.forEach((element) => {
    const rusakBeratValue = element.value.trim();

    if (!rusakBeratValue) {
      element.classList.add("is-invalid");
      formStatus = formStatus && false;
    } else {
      element.classList.remove("is-invalid");
    }
  });

  return formStatus;
};
