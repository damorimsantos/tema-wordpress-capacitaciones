const header = document.querySelector(".header");
const links = document.querySelectorAll(".link");
const elementos = document.querySelectorAll(".container");
console.log(elementos);

links.forEach((link) => {
    link.addEventListener("click", (event) => {
        event.preventDefault();
        const idCompleto = link.id;
        const inicioId = "link-".length;
        const nomeCurso = idCompleto.substring(inicioId);

        elementos.forEach((elemento) => {
            if (elemento.id === nomeCurso) {
                const alturaHeader = header.clientHeight;
                const meioElemento =
                    elemento.offsetTop - alturaHeader - window.innerHeight / 20;
                console.log(meioElemento);

                window.scrollTo({
                    top: meioElemento,
                    behavior: "smooth",
                });
            }
        });
    });
});
