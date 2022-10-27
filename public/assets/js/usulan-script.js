const btnAdd = document.querySelectorAll(".btn-add");
const btnDelete = document.querySelectorAll(".btn-delete");
const select = document.querySelectorAll(".eventSelect");
const option = document.querySelectorAll(".usulan");

// untuk mendapatkan nilai bmn
const getBmn = async (e) => {
  const selectId = e.target.value;
  const type = e.target.parentElement.getAttribute("id");

  if (selectId !== "lainnya" && type !== null) {
    const response = await fetch(
      `http://si-sultan.test/api/inventory/${selectId}/${type}`
    );
    const responseJson = await response.json();

    if (responseJson.status == 200) {
      if (type === "hp") {
        e.target.parentElement.closest("tr").querySelector(".total").innerHTML =
          responseJson.data.total;
      }
      if (type === "thp") {
        e.target.parentElement.closest("tr").querySelector(".baik").innerHTML =
          responseJson.data.baik;
        e.target.parentElement
          .closest("tr")
          .querySelector(".rusak_ringan").innerHTML =
          responseJson.data.rusak_ringan;
        e.target.parentElement
          .closest("tr")
          .querySelector(".rusak_berat").innerHTML =
          responseJson.data.rusak_ringan;
      }
    }
  } else {
    if (type === "hp") {
      e.target.parentElement.closest("tr").querySelector(".total").innerHTML =
        "0";
    }

    if (type === "thp") {
      e.target.parentElement.closest("tr").querySelector(".baik").innerHTML =
        "0";
      e.target.parentElement
        .closest("tr")
        .querySelector(".rusak_ringan").innerHTML = "0";
      e.target.parentElement
        .closest("tr")
        .querySelector(".rusak_berat").innerHTML = "0";
    }
  }
};

// fungsi untuk tombol hapus
const btnOnDelete = (e) => {
  e.preventDefault();

  const form = e.target.closest(".duplicate-form");

  if (form.children.length - 1 > 1) {
    const deletedRow = e.target.closest("tr");
    const deletedIndex = deletedRow.querySelector(".count").innerText - 1;

    deletedRow.remove();

    for (let i = deletedIndex; i < form.children.length - 1; i++) {
      form.children[i].querySelector(".count").innerText = i + 1;
    }
  }
};

// fungsi untuk tombol tambah form
btnAdd.forEach((element) => {
  element.addEventListener("click", async (e) => {
    e.preventDefault();

    // mendapatkan row tabel (tr)
    const duplicated = e.target
      .closest(".duplicate-form")
      .querySelector(".duplicate");

    // mendapatkan parent dari row (tbody)
    const parent = e.target.closest(".duplicate-form");

    // duplikat form
    const newForm = duplicated.cloneNode(true);

    // mendapatkan element terakhir dari form
    const node = parent.lastElementChild;

    // untuk membuat nilai bpm di form baru menjadi kosong
    const type = newForm.querySelector(".usulan").getAttribute("id");

    if (type === "hp") {
      newForm.querySelector(".total").innerHTML = "-";
    }
    if (type === "thp") {
      newForm.querySelector(".baik").innerHTML = "-";
      newForm.querySelector(".rusak_ringan").innerHTML = "-";
      newForm.querySelector(".rusak_berat").innerHTML = "-";
    }

    // untuk membuat inputan di form baru menjadi kosong
    newForm.querySelector(".input-jumlah").value = "";
    newForm.querySelector(".firstTextarea").value = "";
    newForm.querySelector(".secondTextarea").value = "";

    newForm.querySelectorAll(".form-control").forEach((element) => {
      element.classList.remove("is-invalid");
    });

    // mengambil element terakhir dari node yang di duplikat
    const lastRow = parent.children[parent.children.length - 2];

    // merubah nomor agar increment
    newForm.querySelector(".count").innerText =
      parseInt(lastRow.querySelector(".count").innerText) + 1;

    // fungsi button delete
    newForm.querySelector(".btn-delete").addEventListener("click", btnOnDelete);

    // fungsi untuk merubah tampilan option menjadi seperti semula
    const getOption = async () => {
      const type = newForm.querySelector(".usulan")?.getAttribute("id");
      const response = await fetch(
        `http://si-sultan.test/api/inventory/${type}`
      );
      const responseJson = await response.json();
      const data = responseJson.data;

      if (responseJson.status == 200) {
        const pilihan = newForm.querySelector(".usulan");

        if (type == "hp") {
          let options = "";
          data.forEach((element) => {
            options += `<option value="${element.id}">${element.nama_barang}</option>`;
          });

          pilihan.innerHTML = `
          <select class="form-control form-control-sm eventSelect" id="usulan_hp" name="usulan_hp[]">
            <option selected hidden value="">Pilih Barang</option>
            ${options}
            <option value="lainnya">Lainnya...</option>
          </select>
          `;
        }

        if (type == "thp") {
          let options = "";
          data.forEach((element) => {
            options += `<option value="${element.id}">${element.nama_barang}</option>`;
          });

          pilihan.innerHTML = `
          <select class="form-control form-control-sm eventSelect" id="usulan_thp" name="usulan_thp[]">
            <option selected hidden value="">Pilih Barang</option>
            ${options}
            <option value="lainnya">Lainnya...</option>
          </select>
          `;
        }
      }
    };

    await getOption();

    const optionNewForm = newForm.querySelectorAll(".usulan");

    optionNewForm.forEach((element) => {
      element.addEventListener("change", getBmn);
    });

    newForm.querySelectorAll(".eventSelect").forEach((element) => {
      element.addEventListener("click", changeEvent);
    });

    parent.insertBefore(newForm, node);
  });
});

// untuk menjalankan fungsi delete
btnDelete.forEach((element) => {
  element.addEventListener("click", btnOnDelete);
});

// merubah inputan ketika memilih opsi lainnya
const changeEvent = (e) => {
  e.preventDefault();

  if (e.target.value == "lainnya") {
    const name = e.target.getAttribute("name");
    const id = e.target.getAttribute("id");
    e.target.closest(".usulan").innerHTML = `
          <div class="input-group">
            <input type="text" class="form-control" name="${name}" id="${id}">
          </div>
        `;
  }
};

// menjalankan fungsi inputan
select.forEach((element) => {
  element.addEventListener("click", changeEvent);
});

// menjalankan fungsi getBmn untuk menampilkan data dari tabel inventory
option.forEach((element) => {
  element.addEventListener("change", getBmn);
});
