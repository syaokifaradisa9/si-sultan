window.addEventListener("DOMContentLoaded", () => {
  const formSubmit = document.getElementById("form-usulan");
  formSubmit?.addEventListener("submit", (e) => {
    e.preventDefault();

    const usulanHp = checkUsulan();
    const usulanThp = checkUsulanThp();
    const jumlahHp = checkJumlah();
    const jumlahThp = checkJumlahThp();
    const spesifikHp = checkSpesifikasi();
    const spesifikThp = checkSpesifikasiThp();
    const justifikHp = checkJustifikasi();
    const justifikThp = checkJustifikasiThp();

    if (usulanHp || jumlahHp || spesifikHp || justifikHp) {
      const elements = document.querySelectorAll(".input-thp");

      elements.forEach((element) => {
        element.classList.remove("is-invalid");
      });
    }

    if (usulanThp || jumlahThp || spesifikThp || justifikThp) {
      const elements = document.querySelectorAll(".input-hp");

      elements.forEach((element) => {
        element.classList.remove("is-invalid");
      });
    }

    const proposeHp = usulanHp && jumlahHp && spesifikHp && justifikHp;
    const proposeThp = usulanThp && jumlahThp && spesifikThp && justifikThp;

    if (proposeHp || proposeThp) {
      formSubmit.submit();
    }
  });
});

const checkUsulan = () => {
  let formStatus = true;
  const elements = document.querySelectorAll(`#usulan_hp`);

  elements.forEach((element) => {
    const usulanValue = element.value.trim();
    if (!usulanValue) {
      element.classList.add("is-invalid");
      formStatus = formStatus && false;
    } else {
      element.classList.remove("is-invalid");
    }
  });

  return formStatus;
};

const checkUsulanThp = () => {
  let formStatus = true;

  const elements = document.querySelectorAll("#usulan_thp");

  elements.forEach((element) => {
    const usulanValue = element.value.trim();
    if (!usulanValue) {
      element.classList.add("is-invalid");
      formStatus = formStatus && false;
    } else {
      element.classList.remove("is-invalid");
    }
  });

  return formStatus;
};

const checkJumlah = () => {
  let formStatus = true;
  const elements = document.querySelectorAll(`#jumlah_hp`);

  elements.forEach((element) => {
    const jumlahValue = element.value.trim();

    if (!jumlahValue) {
      element.classList.add("is-invalid");
      formStatus = formStatus && false;
    } else {
      element.classList.remove("is-invalid");
    }
  });

  return formStatus;
};

const checkJumlahThp = () => {
  let formStatus = true;
  const elements = document.querySelectorAll(`#jumlah_thp`);

  elements.forEach((element) => {
    const jumlahValue = element.value.trim();

    if (!jumlahValue) {
      element.classList.add("is-invalid");
      formStatus = formStatus && false;
    } else {
      element.classList.remove("is-invalid");
    }
  });

  return formStatus;
};

const checkSpesifikasi = () => {
  let formStatus = true;
  const elements = document.querySelectorAll(`#spesifikasi_hp`);

  elements.forEach((element) => {
    const spesifikasiValue = element.value.trim();
    if (!spesifikasiValue) {
      element.classList.add("is-invalid");
      formStatus = formStatus && false;
    } else {
      element.classList.remove("is-invalid");
    }
  });

  return formStatus;
};
const checkSpesifikasiThp = () => {
  let formStatus = true;
  const elements = document.querySelectorAll(`#spesifikasi_thp`);

  elements.forEach((element) => {
    const spesifikasiValue = element.value.trim();
    if (!spesifikasiValue) {
      element.classList.add("is-invalid");
      formStatus = formStatus && false;
    } else {
      element.classList.remove("is-invalid");
    }
  });

  return formStatus;
};

const checkJustifikasi = () => {
  let formStatus = true;
  const elements = document.querySelectorAll(`#justifikasi_hp`);

  elements.forEach((element) => {
    const justifikasiValue = element.value.trim();

    if (!justifikasiValue) {
      element.classList.add("is-invalid");
      formStatus = formStatus && false;
    } else {
      element.classList.remove("is-invalid");
    }
  });

  return formStatus;
};

const checkJustifikasiThp = () => {
  let formStatus = true;
  const elements = document.querySelectorAll(`#justifikasi_thp`);

  elements.forEach((element) => {
    const justifikasiValue = element.value.trim();

    if (!justifikasiValue) {
      element.classList.add("is-invalid");
      formStatus = formStatus && false;
    } else {
      element.classList.remove("is-invalid");
    }
  });

  return formStatus;
};
