let body = document.querySelector("body"),
  sidebar = body.querySelector("nav"),
  homes = body.querySelector(".home"),
  toggle = body.querySelector(".toggle"),
  searchBtn = body.querySelector(".search-box"),
  modeSwitch = body.querySelector(".toggle-switch"),
  btnThames = body.querySelector(".btn-thames"),
  modeText = body.querySelector(".mode-text");

toggle.addEventListener("click", () => {
  sidebar.classList.toggle("close");
  homes.classList.toggle("close");
});
searchBtn.addEventListener("click", () => {
  sidebar.classList.remove("close");
});
// Thames Dark Mode
let thames = localStorage.getItem("thames"),
  mode = localStorage.getItem("mode");
if (!thames) {
  localStorage.setItem("thames", "light");
}
if (!mode) {
  localStorage.setItem("mode", JSON.stringify(["Light mode", "Enable dark theme"]));
}
modeText.innerText = JSON.parse(localStorage.getItem("mode"))[0];
const darkMode = () => {
  body.classList.add("dark");
  localStorage.setItem("thames", "dark");
  localStorage.setItem("mode", JSON.stringify(["Light mode", "Disable dark theme"]));
};
const lightMode = () => {
  body.classList.remove("dark");
  localStorage.setItem("thames", "light");
  localStorage.setItem("mode", JSON.stringify(["Dark mode", "Enable dark theme"]));
};
if (thames === "dark") {
  darkMode();
}

btnThames.addEventListener("click", function () {
  thames = localStorage.getItem("thames");
  if (thames === "light") {
    darkMode();
    modeText.innerText = "Light mode";
  } else {
    lightMode();
    modeText.innerText = "Dark mode";
  }
});

// Modal Box Logout
const logoutModal = document.querySelector("#logoutModal"),
  logout = document.querySelector(".logout"),
  XClose = document.querySelector(".XClose"),
  modalClose = document.querySelector(".Modalclose");

logout.onclick = function () {
  logoutModal.classList.add("show");
};
XClose.onclick = function () {
  logoutModal.classList.remove("show");
};
modalClose.onclick = function () {
  logoutModal.classList.remove("show");
};

// Button Navbar
const navigasiBar = document.querySelector("#navigasiBar");
let lastScrolly = window.scrollY;

window.addEventListener("scroll", () => {
  if (lastScrolly < window.scrollY) {
    navigasiBar.classList.add("navHidden");
  } else {
    navigasiBar.classList.remove("navHidden");
  }

  lastScrolly = window.scrollY;
});
