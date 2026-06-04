const elsItemAcordeao = document.querySelectorAll(
    ".perguntas-frequentes__item"
);

elsItemAcordeao.forEach(function (item) {
    item.addEventListener("click", function () {
        const corpo = item.querySelector(".perguntas-frequentes__corpo");
        console.log(corpo);
        corpo.classList.toggle("aberto");

        const seta = item.querySelector(".perguntas-frequentes__seta");
        console.log(seta);
        seta.classList.toggle("invertida");
    });
});
