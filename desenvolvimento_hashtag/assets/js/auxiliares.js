function debounce(fn, ms) {
  // https://remysharp.com/2010/07/21/throttling-function-calls

  // Executa uma função ('fn') 'ms' tempo depois do usuário terminar de executar o evento
  var time = null;
  return function () {
    var a = arguments,
      t = this;
    clearTimeout(time);
    time = setTimeout(function () {
      fn.apply(t, a);
    }, ms);
  };
}

function throttle(fn, ms) {
  // Ryan Taylor comment - https://remysharp.com/2010/07/21/throttling-function-calls
  // Executa uma função ('fn') a cada 'ms' tempo.
  var time,
    last = 0;
  return function () {
    var a = arguments,
      t = this,
      now = +new Date(),
      exe = function () {
        last = now;
        fn.apply(t, a);
      };
    clearTimeout(time);
    now >= last + ms ? exe() : (time = setTimeout(exe, ms));
  };
}

function hasClass(el, cls) {
  if (el.className.match("(?:^|\\s)" + cls + "(?!\\S)")) {
    return true;
  }
}

function addClass(el, cls) {
  if (!el.className.match("(?:^|\\s)" + cls + "(?!\\S)")) {
    el.className += " " + cls;
  }
}

function delClass(el, cls) {
  el.className = el.className.replace(
    new RegExp("(?:^|\\s)" + cls + "(?!\\S)"),
    ""
  );
}

function updateURLParam(param, value) {
  var url = new URL(window.location);
  url.searchParams.set(param, value);
  window.history.pushState({}, "", url);
}

function criarVideoPanda(
  id,
  src,
  allow = "accelerometer;gyroscope;autoplay;encrypted-media;picture-in-picture",
  allowfullscreen = "true",
  fetchpriority = "high",
  style = "aspect-ratio: 1280/720; border:none",
  width = "755",
  height = "425"
) {
  let elemiFrame = document.createElement("iframe");
  let elemVideo = document.querySelector(".video");
  let elemThumb = elemVideo.querySelector("img");

  elemiFrame.setAttribute("id", id);
  elemiFrame.setAttribute("src", src);
  elemiFrame.setAttribute("allow", allow);
  elemiFrame.setAttribute("allowfullscreen", allowfullscreen);
  elemiFrame.setAttribute("fetchpriority", fetchpriority);
  elemiFrame.setAttribute("style", style);
  elemiFrame.setAttribute("width", width);
  elemiFrame.setAttribute("height", height);

  if (elemThumb) {
    elemThumb.style.display = "none";
  }
  elemVideo.appendChild(elemiFrame);

  ajustesVideoVendas();
}

function criarVideoYouTube(
  id = "js-video",
  src,
  width = "755",
  height = "425",
  type = "video/mp4"
) {
  let elemVideo = document.createElement("video");
  let elemSource = document.createElement("source");
  let elemContainerVideo = document.querySelector(".video");
  let elemOutroVideo = elemContainerVideo.querySelector("iframe");
  let elemThumb = elemContainerVideo.querySelector("img");

  if (elemOutroVideo) {
    elemContainerVideo.removeChild(elemOutroVideo);
  }

  elemVideo.setAttribute("id", id);
  elemVideo.setAttribute("width", width);
  elemVideo.setAttribute("height", height);
  elemVideo.setAttribute("controls", "");

  elemSource.setAttribute("src", src);
  elemSource.setAttribute("type", type);

  if (elemThumb) {
    elemThumb.style.display = "none";
  }

  elemVideo.appendChild(elemSource);
  elemContainerVideo.appendChild(elemVideo);

  ajustesVideoVendas();
}

function irAteElementoID(idElementoChegada) {
  function ir_ate_elemento(elem) {
    if (
      document.documentElement.scrollTop < elem.offsetTop &&
      !concluiuScroll
    ) {
      elem.scrollIntoView({ block: "start", behavior: "smooth" });
    }
  }

  var concluiuScroll = false;
  elem = document.getElementById(idElementoChegada);

  if (elem) {
    console.log(`Executou scroll até elemento de ID: ${idElementoChegada}`);
    ir_ate_elemento(elem);

    let idInterval = setInterval(() => {
      ir_ate_elemento(elem);

      if (document.documentElement.scrollTop >= elem.offsetTop - 100) {
        clearTimeout(idInterval);
        console.log(
          `Limpou intervalo de scroll até elemento de ID: ${idElementoChegada}`
        );

        concluiuScroll = true;
      }
    }, 750);
  }
}
