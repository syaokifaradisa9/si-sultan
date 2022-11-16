const btnAdd = document.querySelectorAll(".btn-add");
const btnDelete = document.querySelectorAll(".btn-delete");

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

btnAdd.forEach((element) => {
  element.addEventListener("click", (e) => {
    e.preventDefault();

    const duplicated = e.target
      .closest(".duplicate-form")
      .querySelector(".duplicate");

    const parent = e.target.closest(".duplicate-form");

    const newForm = duplicated.cloneNode(true);

    const type = newForm.querySelector(".inventory").getAttribute("id");

    if (type === "hp") {
      newForm.querySelector(".input-inventory-hp").value = "";
      newForm.querySelector(".input-total-hp").value = "";
    }

    if (type === "thp") {
      newForm.querySelector(".input-inventory-thp").value = "";
      newForm.querySelector(".input-baik-thp").value = "";
      newForm.querySelector(".input-rusak-ringan-thp").value = "";
      newForm.querySelector(".input-rusak-berat-thp").value = "";
    }

    newForm.querySelectorAll(".form-control").forEach((element) => {
      element.classList.remove("is-invalid");
    });

    const lastRow = parent.children[parent.children.length - 2];
    newForm.querySelector(".count").innerText =
      parseInt(lastRow.querySelector(".count").innerText) + 1;

    newForm.querySelector(".btn-delete").addEventListener("click", btnOnDelete);

    const node = parent.lastElementChild;
    parent.insertBefore(newForm, node);
  });
});

btnDelete.forEach((element) => {
  element.addEventListener("click", btnOnDelete);
});
