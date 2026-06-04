function trocarImagemPorVideo(elem, idVideoYT) {
  let elemPai = elem.parentElement;
  let iframeYT = document.createElement("iframe");

  iframeYT.setAttribute("width", "100%");
  iframeYT.setAttribute("height", "100%");
  iframeYT.setAttribute("style", "aspect-ratio: 1280/720");
  iframeYT.setAttribute("frameborder", "0");
  iframeYT.setAttribute(
    "allow",
    "accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
  );
  iframeYT.setAttribute("referrerpolicy", "strict-origin-when-cross-origin");
  iframeYT.setAttribute("allowfullscreen", "");
  iframeYT.setAttribute(
    "src",
    `https://www.youtube.com/embed/${idVideoYT}?autoplay=1`
  );

  elemPai.appendChild(iframeYT);
  elemPai.removeChild(elem);

  console.log(`Trocou a imagem de ID ${idVideoYT} por um iframe com vídeo`);
}

function atribuirSRCImagens() {
  let elemsImagemFakeSRC = document.querySelectorAll("[fakeSRC]");

  elemsImagemFakeSRC.forEach((img) => {
    let idVideoYT = img.getAttribute("fakeSRC");

    img.src = `https://img.youtube.com/vi/${idVideoYT}/mqdefault.jpg`;

    img.parentElement.addEventListener("click", () => {
      trocarImagemPorVideo(img, idVideoYT);
    });
  });
}

atribuirSRCImagens();
