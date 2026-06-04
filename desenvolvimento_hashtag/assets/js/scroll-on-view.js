function elementFromTop(elem, classToAdd, distanceFromTop, unit) {
  var winY = window.innerHeight || document.documentElement.clientHeight,
    elemLength = elem.length,
    distTop,
    distPercent,
    distPixels,
    distUnit,
    i;
  for (i = 0; i < elemLength; ++i) {
    distTop = elem[i].getBoundingClientRect().top;
    distPercent = Math.round((distTop / winY) * 100);
    distPixels = Math.round(distTop);
    distUnit = unit == "percent" ? distPercent : distPixels;
    if (distUnit <= distanceFromTop) {
      if (!hasClass(elem[i], classToAdd)) {
        addClass(elem[i], classToAdd);

        if (window.checarBarraProgresso) {
          if (!barraProgressoInicializada) {
            checarBarraProgresso(elem[i]);
          }
        }

        if (window.checarCarrosselAutomatico) {
          if (
            !carrosselAutomaticoInicializado &&
            elem[i].classList.contains("carrossel--automatico")
          ) {
            console.log("Apareceu o Carrossel Automático");
            checarCarrosselAutomatico(elem[i]);
          }
        }
      }
    } else {
      delClass(elem[i], classToAdd);
    }
  }
}
// params: element, classes to add, distance from top, unit ('percent' or 'pixels')

window.addEventListener("scroll", throttle(rodarElementFromTop, 100), false);

window.addEventListener("resize", debounce(rodarElementFromTop, 100), false);

function rodarElementFromTop() {
  elementFromTop(listaSlideIn, "ef-slide--visivel", 80, "percent");

  elementFromTop(listaSlideIn90, "ef-slide--visivel", 90, "percent");

  elementFromTop(listaSlideIn100, "ef-slide--visivel", 100, "percent");

  elementFromTop(listaFadeIn, "ef-fade--visivel", 80, "percent");
}

var listaSlideIn = document.querySelectorAll(".ef-slide");
var listaSlideIn90 = document.querySelectorAll(".ef-slide-90");
var listaSlideIn100 = document.querySelectorAll(".ef-slide-100");
var listaFadeIn = document.querySelectorAll(".ef-fade");

listaSlideIn.forEach(function (elem) {
  elem.classList.remove("ef-slide--visivel");
});

listaSlideIn90.forEach(function (elem) {
  elem.classList.remove("ef-slide--visivel");
});

listaSlideIn100.forEach(function (elem) {
  elem.classList.remove("ef-slide--visivel");
});

listaFadeIn.forEach(function (elem) {
  elem.classList.remove("ef-fade--visivel");
});
