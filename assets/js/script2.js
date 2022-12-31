const form = document.querySelector(".form");
const cloneBody = document.querySelector(".clone-body");
const btnModifier = document.querySelector(
  ".date_sejour > .button_modifier > input"
);

btnModifier.addEventListener("click", (e) => {
  e.preventDefault();
  form.classList.toggle("active");
  cloneBody.classList.toggle("active");
});

cloneBody.addEventListener("click", () => {
  form.classList.toggle("active");
  cloneBody.classList.toggle("active");
});
