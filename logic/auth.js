const sign_in_btn = document.querySelector("#sign-in-btn");
const sign_up_btn = document.querySelector("#sign-up-btn");
const container = document.querySelector(".container");

sign_up_btn.addEventListener("click", () => {
  container.classList.add("sign-up-mode");
});

sign_in_btn.addEventListener("click", () => {
  container.classList.remove("sign-up-mode");
});

// popup over balance
const popup = document.querySelector("#popup"),
  progres = document.querySelector(".progres"),
  tombola = document.querySelector(".tombola");

setTimeout(() => {
  popup.classList.add("active");
  progres.classList.add("active");
  setTimeout(() => {
    popup.classList.remove("active");
  }, 5000);
}, 300);
