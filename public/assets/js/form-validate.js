window.addEventListener("DOMContentLoaded", () => {
  const formSubmit = document.getElementById("form-usulan");
  formSubmit?.addEventListener("submit", (e) => {
    e.preventDefault();

    const usulan = checkUsulan();
    const jumlah = checkJumlah();
    const spesifik = checkSpesifikasi();
    const justifik = checkJustifikasi();

    if (usulan && jumlah && spesifik && justifik) {
      formSubmit.submit();
    }
  });
});

let type = ["hp", "thp"];

const checkUsulan = () => {
  let formStatus = true;
  type.forEach((element) => {
    const elements = document.querySelectorAll(`#usulan_${element}`);

    elements.forEach((element) => {
      const usulanValue = element.value.trim();
      if (!usulanValue) {
        element.classList.add("is-invalid");
        formStatus = formStatus && false;
      } else {
        element.classList.remove("is-invalid");
      }
    });
  });

  return formStatus;
};

const checkJumlah = () => {
  let formStatus = true;
  type.forEach((type) => {
    const elements = document.querySelectorAll(`#jumlah_${type}`);

    elements.forEach((element) => {
      const jumlahValue = element.value.trim();

      if (!jumlahValue) {
        element.classList.add("is-invalid");
        formStatus = formStatus && false;
      } else {
        element.classList.remove("is-invalid");
      }
    });
  });

  return formStatus;
};

const checkSpesifikasi = () => {
  let formStatus = true;
  type.forEach((type) => {
    const elements = document.querySelectorAll(`#spesifikasi_${type}`);

    elements.forEach((element) => {
      const spesifikasiValue = element.value.trim();
      if (!spesifikasiValue) {
        element.classList.add("is-invalid");
        formStatus = formStatus && false;
      } else {
        element.classList.remove("is-invalid");
      }
    });
  });

  return formStatus;
};

const checkJustifikasi = () => {
  let formStatus = true;
  type.forEach((type) => {
    const elements = document.querySelectorAll(`#justifikasi_${type}`);

    elements.forEach((element) => {
      const justifikasiValue = element.value.trim();

      if (!justifikasiValue) {
        element.classList.add("is-invalid");
        formStatus = formStatus && false;
      } else {
        element.classList.remove("is-invalid");
      }
    });
  });

  return formStatus;
};
