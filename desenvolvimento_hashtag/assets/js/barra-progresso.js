// setTimeout(() => {
//   var appendProgressBarStyle = document.head.appendChild(
//     document.createElement("style")
//   );

//   appendProgressBarStyle.innerHTML =
//     ".barra-progresso::before {--perc-progr-azul: 20%; --perc-progr-amarelo: 50%; --perc-progr-verde: 100%;}";
// }, 3000);

function checarBarraProgresso(elem) {
  let elemNivel = document.querySelector(".nivel");

  if (elem == elemNivel) {
    let filhosNivel = elemNivel.getElementsByTagName("*");

    for (let nivel of filhosNivel) {
      if (hasClass(nivel, "barra-progresso") && !barraProgressoInicializada) {
        let appendProgressBarStyle = document.head.appendChild(
          document.createElement("style")
        );

        setTimeout(() => {
          appendProgressBarStyle.innerHTML =
            ".barra-progresso::before {--perc-progr-azul: 1%; --perc-progr-amarelo: 50%; --perc-progr-verde: 100%;}";
        }, 1000);

        console.log("Barra de Progresso Inicializada");
        barraProgressoInicializada = true;
      }
    }
  }
}

let barraProgressoInicializada = false;
