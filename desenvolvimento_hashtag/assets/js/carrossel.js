let elemsCarrossel = document.querySelectorAll(".carrossel");
let carrosselAutomaticoInicializado = false;
let intervaloCarrossel = 3000;

function checarCarrosselAutomatico(elem) {
  elem.classList.add("carrossel--automatico-ini");

  console.log("Adicionou a classe de Carrossel Automático");
  carrosselAutomaticoInicializado = true;
}

elemsCarrossel.forEach((carrossel) => {
  const rodarCarrosselAutomatico = () => {
    console.log("Carrossel Automático Inicializado");

    let idSetInterval = setInterval(() => {
      if (elemTrack.classList.contains("js-user-interaction")) {
        clearInterval(idSetInterval);
      } else {
        if (elemTrack.classList.contains("js-scrollable-right")) {
          passarDireita();
        } else {
          elemTrack.scrollTo({
            left: 0,
            behavior: "smooth",
          });
        }
      }
    }, intervaloCarrossel);
  };

  const toggleScrolled = () => {
    let scrollLeft = elemTrack.scrollLeft;

    if (scrollLeft > 0) {
      if (!elemTrack.hasAttribute("scrolled")) {
        elemTrack.setAttribute("scrolled", "");
        // console.log("Adicionou scrolled");
      }
    } else {
      elemTrack.removeAttribute("scrolled");
      // console.log("Removeu scrolled");
    }

    checkSetas();
  };

  const passarDireita = () => {
    const scrollTo = () => {
      elemTrack.scrollTo({
        left: scrollLeft + childWidth,
        behavior: "smooth",
      });
    };

    let scrollLeft = elemTrack.scrollLeft;

    if (elemsSetas) {
      if (elemsSetas[1].classList.contains("carrossel__seta--habilitada")) {
        scrollTo();
      }
    } else {
      scrollTo();
    }
  };

  const passarEsquerda = () => {
    let scrollLeft = elemTrack.scrollLeft;

    if (elemsSetas[0].classList.contains("carrossel__seta--habilitada")) {
      elemTrack.scrollTo({
        left: Math.max(scrollLeft - childWidth, 0),
        behavior: "smooth",
      });
    }
  };

  const checkSetas = () => {
    let scrollLeft = elemTrack.scrollLeft;

    if (Math.floor(trackFullWidth) > Math.floor(trackWidth)) {
      if (
        scrollLeft <
        Math.round((trackFullWidth - trackWidth - trackGap) / 10, 0) * 10
      ) {
        // Tem scroll para a direita
        if (elemsSetas) {
          elemsSetas[1].classList.add("carrossel__seta--habilitada");
        }

        elemTrack.classList.add("js-scrollable-right");
      } else {
        // Não tem scroll para a direita
        if (elemsSetas) {
          elemsSetas[1].classList.remove("carrossel__seta--habilitada");
        }

        elemTrack.classList.remove("js-scrollable-right");
      }

      if (scrollLeft > trackPaddingLeft) {
        // Tem scroll para a esquerda
        if (elemsSetas) {
          elemsSetas[0].classList.add("carrossel__seta--habilitada");
        }

        elemTrack.classList.add("js-scrollable-left");
      } else {
        // Não tem scroll para a esquerda
        if (elemsSetas) {
          elemsSetas[0].classList.remove("carrossel__seta--habilitada");
        }

        elemTrack.classList.remove("js-scrollable-left");
      }
    } else {
      // Não tem scroll
      if (elemsSetas) {
        elemControles.classList.add("carrossel__controles--semscroll");
      }

      elemTrack.classList.remove("js-scrollable-left");
      elemTrack.classList.remove("js-scrollable-right");
    }
  };

  if (carrossel.classList.contains("carrossel--automatico")) {
    // console.log("Aguardando o Carrossel automático ser inicializado");

    let idIntervaloCarrossel = setInterval(() => {
      // console.log("Checando se o Carrossel automático foi inicializado");

      if (carrossel.classList.contains("carrossel--automatico-ini")) {
        // console.log("Foi inicializado");

        rodarCarrosselAutomatico();
        clearInterval(idIntervaloCarrossel);
      }
    }, intervaloCarrossel);
  }

  let elemTrack = carrossel.querySelector(".carrossel__track");

  // Auxiliares
  let elemTrackChildren = elemTrack.children;
  let childWidth = elemTrackChildren[0].offsetWidth;
  let trackGap = parseFloat(getComputedStyle(elemTrack).gap.replace("px", ""));
  let trackPaddingRight = parseFloat(
    getComputedStyle(elemTrack).paddingRight.replace("px", "")
  );
  let trackPaddingLeft = parseFloat(
    getComputedStyle(elemTrack).paddingLeft.replace("px", "")
  );

  let trackFullWidth =
    elemTrackChildren.length * childWidth +
    (elemTrackChildren.length - 1) * trackGap +
    trackPaddingRight;
  let trackWidth = elemTrack.offsetWidth;

  let elemControles = carrossel.querySelector(".carrossel__controles");
  let elemsSetas;

  // Monitorar scroll no Track para adicionar mask
  elemTrack.addEventListener("scroll", throttle(toggleScrolled, 100), false);

  // Monitorar clique no Track tirar o scroll automático
  elemTrack.addEventListener("click", () => {
    elemTrack.classList.add("js-user-interaction");
  });

  if (elemControles) {
    elemsSetas = elemControles.querySelectorAll(".carrossel__seta");

    // Clique no botão direito
    elemsSetas[1].addEventListener("click", () => {
      passarDireita();

      if (!elemTrack.classList.contains("js-user-interaction")) {
        elemTrack.classList.add("js-user-interaction");
      }
    });

    // Clique no botão esquerdo
    elemsSetas[0].addEventListener("click", () => {
      passarEsquerda();

      if (!elemTrack.classList.contains("js-user-interaction")) {
        elemTrack.classList.add("js-user-interaction");
      }
    });
  }

  // Setar classe das Setas
  checkSetas();
});
