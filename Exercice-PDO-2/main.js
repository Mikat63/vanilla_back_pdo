const buttonDelete = document.querySelectorAll(".button_delete");
const modalConfirm = document.querySelector(".modal_confirm");
const buttonYes = document.querySelector("#modal_yes");
const buttonNo = document.querySelector("#modal_no");

buttonDelete.forEach((button) => {
  button.addEventListener("click", function (event) {
    event.preventDefault();

    modalConfirm.style.display = "block";
  });
});

buttonNo.addEventListener("click", function () {
  modalConfirm.style.display = "none";
});
