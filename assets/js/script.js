const btnAdd = document.querySelector(".add");
const form = document.querySelector(".form");
const cloneBody = document.querySelector(".clone-body");
btnAdd.addEventListener("click", () => {
    btnAdd.classList.toggle("active");
    form.classList.toggle("active");
    cloneBody.classList.toggle("active");
});
