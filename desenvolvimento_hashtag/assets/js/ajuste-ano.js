let ajusteAnoRodape = () => {
  let elemsAno = document.querySelectorAll("js-ano");
  let anoAtual = new Date().getFullYear();

  elemsAno.forEach((elem) => {
    elem.innerText = anoAtual;
  });
};
