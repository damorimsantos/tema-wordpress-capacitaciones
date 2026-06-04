// JS do Header
document.body.classList.add("sticky");

const headerEl = document.querySelector(".header");
const headerNavEl = document.querySelector(".header-nav");
const botaoHeaderEl = document.querySelector(".header-botao");
const listItemEls = document.querySelectorAll(".header-list-item");

function abrirNav() {
  headerEl.classList.toggle("header-nav-open");
}

function dropdownOpen(elemento) {
  elemento.classList.toggle("dropdown-open");
  headerNavEl.classList.toggle("dropdown-open");
}

botaoHeaderEl.addEventListener("click", abrirNav);

listItemEls.forEach(function (el) {
  el.addEventListener("click", function () {
    dropdownOpen(el);
  });
});

// Ionic Icons
function loadJS(FILE_URL, type, async = true) {
  let scriptEle = document.createElement("script");

  scriptEle.setAttribute("src", FILE_URL);
  scriptEle.setAttribute("type", type);
  scriptEle.setAttribute("async", async);

  document.body.appendChild(scriptEle);
}

loadJS(
  "https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js",
  "module",
  true
);