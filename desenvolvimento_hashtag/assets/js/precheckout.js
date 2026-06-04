function atribuirFuncoesBotao(botoes, tipoLink, pixBillet) {
  botoes.forEach((botao) => {
    botao.href = "javascript:void(0)";

    botao.addEventListener("click", function () {
      definirLinkCheckout(
        dicLinksCheckout[parametroFonte][tipoLink][parametroCurso],
        dicSrcPadrao,
        pixBillet
      );
    });
  });
}

function togglePopupAberto(spinner) {
  if (popupContainerEl) {
    popupContainerEl.classList.toggle("visivel");
    popupContainerEl.removeAttribute("style");
  } else {
    bodyEl.classList.toggle("popup-aberto");
  }

  if (spinner) {
    togglePopupSpinner();
  }
}

function trocarConteudoPopup(conteudo, texto, togglePopup) {
  let divConteudo = formActive.parentElement.querySelector(".popup__conteudo");

  if (conteudo == "trilha") {
    formActive.style.display = "none";

    divConteudo.removeAttribute("style");
    divConteudo.innerText = texto;
  } else {
    divConteudo.style.display = "none";
    formActive.removeAttribute("style");
  }

  if (togglePopup) {
    togglePopupAberto(false);
  }
}

function togglePopupSpinner() {
  if (popupContainerEl) {
    popupContainerEl
      .querySelector(".caixa-popup")
      .classList.add("carregando-spinner");
    popupContainerEl
      .querySelector(".fundo-spinner")
      .classList.add("carregando-spinner");
  } else {
    bodyEl.classList.add("popup-aberto--spinner");
  }
}

function enviarFormulario() {
  togglePopupSpinner();
  formActive.submit();
}

function definirLinkCheckout(IDLinkTemp, srcForm, pixBillet) {
  if (
    linkTempIDProdutoForm &&
    linkTempIDOfertaForm &&
    linkTempSRCForm &&
    linkTempPixBilletForm
  ) {
    console.log(IDLinkTemp[0], IDLinkTemp[1], srcForm, pixBillet);
    linkTempIDProdutoForm.value = IDLinkTemp[0];
    linkTempIDOfertaForm.value = IDLinkTemp[1];
    linkTempSRCForm.value = srcForm;
    linkTempPixBilletForm.value = pixBillet;
  }

  trocarConteudoPopup("precheckout", "", false);

  var formCompleto = true;

  inputsForm.forEach(function (elInput) {
    if (
      elInput.value == "" &&
      elInput.getAttribute("name") != "field[6]" &&
      elInput.getAttribute("name") != "s"
    ) {
      formCompleto = false;
    }
  });

  if (formCompleto) {
    enviarFormulario();
  } else {
    togglePopupAberto(false);
  }
}

function ajustesVideoVendas() {
  let elemVideo = document.querySelector("#js-video");

  if (elemVideo) {
    if (
      parametroFonte == "aula" ||
      parametroFonte == "intensivao" ||
      parametroFonte == "jornada" ||
      parametroFonte == "up"
    ) {
      // Alterar o src do vídeo se existir na tabela

      if (
        dicSRCVideo[parametroFonte] &&
        dicSRCVideo[parametroFonte][parametroCurso]
      ) {
        if (dicSRCVideo[parametroFonte][parametroCurso][1]) {
          if (
            dicSRCVideo[parametroFonte][parametroCurso][1] == "amazon" &&
            elemVideo.tagName == "iframe"
          ) {
            criarVideoYouTube(
              "js-video",
              dicSRCVideo[parametroFonte][parametroCurso][0]
            );
            return;
          }
        }

        elemVideo.src = dicSRCVideo[parametroFonte][parametroCurso][0];
      }
    }

    if (parametroCurso == "excel") {
      if (parametroFonte == "perpetuo" && parametroTipo == "vsl") {
        var idOnboarding = new URLSearchParams(window.location.search).get(
          "video"
        );
        var dictCorrespondencia = {
          "0.0":
            "https://player-vz-4f008646-5e1.tv.pandavideo.com.br/embed/?v=3219d8f1-b5c5-4c73-9130-497afd8a87fd&availableSpeeds=1,1.25,1.5",
          1.1: "https://player-vz-4f008646-5e1.tv.pandavideo.com.br/embed/?v=fdab6a69-fc12-420b-be75-352615705453&availableSpeeds=1,1.25,1.5",
          2.1: "https://player-vz-4f008646-5e1.tv.pandavideo.com.br/embed/?v=43f24f84-cd7b-429d-9512-99265e2f1414&availableSpeeds=1,1.25,1.5",
          3.1: "https://player-vz-4f008646-5e1.tv.pandavideo.com.br/embed/?v=a7eceafc-cf1c-42db-bc52-c7c4aea578aa&availableSpeeds=1,1.25,1.5",
          4.1: "https://player-vz-4f008646-5e1.tv.pandavideo.com.br/embed/?v=7fa778ec-6eee-4962-9b8f-7d755caeb884&availableSpeeds=1,1.25,1.5",
          5.1: "https://player-vz-4f008646-5e1.tv.pandavideo.com.br/embed/?v=0038e43e-5f07-4709-a220-3580400496cc&availableSpeeds=1,1.25,1.5",
          6.1: "https://player-vz-4f008646-5e1.tv.pandavideo.com.br/embed/?v=ceabbf31-d864-448f-ac6e-2f2d548d6f5f&availableSpeeds=1,1.25,1.5",
          1.2: "https://player-vz-4f008646-5e1.tv.pandavideo.com.br/embed/?v=983d48f4-c1a0-4b61-be1e-148d75f9e81d&availableSpeeds=1,1.25,1.5",
          2.2: "https://player-vz-4f008646-5e1.tv.pandavideo.com.br/embed/?v=8a0c5111-e519-4ee3-95b3-35ac28086b73&availableSpeeds=1,1.25,1.5",
          3.2: "https://player-vz-4f008646-5e1.tv.pandavideo.com.br/embed/?v=3273f2f2-6d32-4bd3-8b3e-153fe129f2c6&availableSpeeds=1,1.25,1.5",
          4.2: "https://player-vz-4f008646-5e1.tv.pandavideo.com.br/embed/?v=321ebb3d-bf5d-4410-ac86-38a206e74f9e&availableSpeeds=1,1.25,1.5",
          5.2: "https://player-vz-4f008646-5e1.tv.pandavideo.com.br/embed/?v=7fcc5698-8ce3-4c7e-b5ec-8120dbaeda06&availableSpeeds=1,1.25,1.5",
          6.2: "https://player-vz-4f008646-5e1.tv.pandavideo.com.br/embed/?v=9464a43b-bea6-4507-84fa-7ba662323d9e&availableSpeeds=1,1.25,1.5",
          1.3: "https://player-vz-4f008646-5e1.tv.pandavideo.com.br/embed/?v=787bc8cf-2595-4bf1-8e99-d130857a34c8&availableSpeeds=1,1.25,1.5",
          2.3: "https://player-vz-4f008646-5e1.tv.pandavideo.com.br/embed/?v=e50c2da5-4552-49b1-99a9-5e57fad5eaa5&availableSpeeds=1,1.25,1.5",
          3.3: "https://player-vz-4f008646-5e1.tv.pandavideo.com.br/embed/?v=5a3ec0d7-840c-4d36-b226-20201bdae125&availableSpeeds=1,1.25,1.5",
          4.3: "https://player-vz-4f008646-5e1.tv.pandavideo.com.br/embed/?v=52177aab-990b-48af-a5ce-ab32e90cd9ea&availableSpeeds=1,1.25,1.5",
          5.3: "https://player-vz-4f008646-5e1.tv.pandavideo.com.br/embed/?v=41a329d8-9412-4743-beef-4b4f9c8244cc&availableSpeeds=1,1.25,1.5",
          6.3: "https://player-vz-4f008646-5e1.tv.pandavideo.com.br/embed/?v=e51e64d7-3e90-4790-ab76-20ae0c33c3a5&availableSpeeds=1,1.25,1.5",
        };

        // Ajustar atributos do vídeo para o panda
        elemVideo.id = "panda-5c9e3909-45c3-4421-afff-b3d9cef7b867";
        elemVideo.allow =
          "accelerometer;gyroscope;autoplay;encrypted-media;picture-in-picture";
        elemVideo.allowFullscreen = true;
        elemVideo.setAttribute("fetchpriority", "high");

        // Editar vídeo conforme o ID de Onboarding
        if (idOnboarding && dictCorrespondencia[idOnboarding]) {
          elemVideo.src = dictCorrespondencia[idOnboarding];
        } else {
          elemVideo.src = dictCorrespondencia["0.0"];
        }

        // Carregar o JS do Panda
        loadJS(
          "https://player.pandavideo.com.br/api.v2.js",
          true,
          onPandaPlayerApiLoad
        );

        function onPandaPlayerApiLoad() {
          const player = new PandaPlayer("panda-player", {
            onReady: () => {
              console.log("Player is ready", player.getCurrentTime());

              player.onEvent(
                throttle(function ({ message }) {
                  if (message === "panda_timeupdate") {
                    console.log("Tempo atualizou", player.getCurrentTime());

                    // Passando dos 20 min
                    if (
                      player.getCurrentTime() > 1200 &&
                      !hasClass(document.body, "pgvex-liberada")
                    ) {
                      document.body.classList.add("pgvex-liberada");
                      document.body.classList.remove("pgvex-fechada");
                      loadJS("//code.jivosite.com/widget/mULhfvoict");
                    }
                  }
                }, 5000)
              );
            },
            onError: (event) => {
              console.log("Player onError", event);
            },
          });
        }
      } else if (parametroFonte == "jornada") {
        elemVideo.id = "js-video";
        elemVideo.style = "";
        elemVideo.allow =
          "accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share";
        elemVideo.allowFullscreen = "";
        elemVideo.removeAttribute("fetchpriority");
        elemVideo.setAttribute(
          "referrerpolicy",
          "strict-origin-when-cross-origin"
        );
        elemVideo.setAttribute("frameborder", "0");
      }
    }
  }
}

// Body e Formulário
var bodyEl = document.body;
var formActive = document.querySelector(".form");

if (!formActive) {
  formActive = document.querySelector("form");
}

var popupContainerEl = document.getElementById("fundo-popup");

// Parâmetros de URL
var parametrosURL = new URLSearchParams(window.location.search);
var parametroSRC = parametrosURL.get("src");
var parametroFonte = parametrosURL.get("fonte"); // Lista de Espera, Perpétuo...
var parametroCurso = parametrosURL.get("curso"); // Excel, JavaScript...
var parametroTipo = parametrosURL.get("tipo"); // Teste A, Teste B...

// Campos do formulário
let inputsForm = formActive.querySelectorAll("input");
let fullnameForm = document.querySelector("#fullname");
let emailForm = document.querySelector("#email");
let linkTempIDProdutoForm = document.querySelector("[name='field[112]']");
let linkTempIDOfertaForm = document.querySelector("[name='field[113]']");
let linkTempSRCForm = document.querySelector("[name='field[114]']");
let linkTempPixBilletForm = document.querySelector("[name='field[115]']");
// const linkTempForm = document.querySelector("[name='field[58]']");

// Botões Comunidade
var elemsBotaoPadrao = document.querySelectorAll(
  '[id*="botaoPopupPadrao"], [id*="botao-linkcomu-padrao"], .js-botaoPadrao'
);
var elemsBotaoPix = document.querySelectorAll(
  '[id*="botaoPopupPix"], [id*="botao-linkcomu-pix"]'
);
var elemsBotaoRecorrente = document.querySelectorAll(
  '[id*="botaoPopupRecorrente"], [id*="botao-linkcomu-limite"]'
);

// Botões Oferta
var elemsBotaoOferta = document.querySelectorAll(".js-botaoOferta");

// Botões Popup Trilha
var elemsBotaoPopupTrilha = document.querySelectorAll(".js-botaoPopupTrilha");

// Botões Avulso
var elemsBotaoAvulsoPadrao = document.querySelectorAll(
  '[id*="botaoPopupAvulsoPadrao"], [id*="botao-link-padrao"]'
);
var elemsBotaoAvulsoPix = document.querySelectorAll(
  '[id*="botaoPopupAvulsoPix"], [id*="botao-link-pix"]'
);
var elemsBotaoAvulsoRecorrente = document.querySelectorAll(
  '[id*="botaoPopupAvulsoRecorrente"], [id*="botao-link-limite"]'
);

// Botão Fechar Popup
var elemsBotaoFechar = document.querySelectorAll('[id*="botaoPopupFechar"]');

// Elementos que mudam conforme a fonte
let elemsPrecoParcelado = document.querySelectorAll(".js-preco-parcelado");
let elemsPrecoParceladoInt = document.querySelectorAll(
  ".js-preco-parcelado-int"
);
let elemsPrecoParceladoDec = document.querySelectorAll(
  ".js-preco-parcelado-dec"
);
let elemPrecoDe = document.querySelectorAll(".js-preco-de");
let elemContainerToggle = document.querySelectorAll(
  "[class*=pgto__container-toggle]"
);
let elemPrecoFoco = document.querySelectorAll(
  ".preco__caixa:not(.preco__caixa--semfoco)"
);
let elemPrecoSemFoco = document.querySelectorAll(".preco__caixa--semfoco");
let elemBlocoToggle = document.querySelector(".bloco-toggle-pgvpy");
let elemsBlocoPlano = document.querySelectorAll(".bloco-planos-pgvpy");

let elemsQtdAulas = document.querySelectorAll(".js-qtd-aulas");
let elemsQtdHoras = document.querySelectorAll(".js-qtd-horas");
let elemsQtdCursosCom = document.querySelectorAll(".js-qtd-cursos-com");
let elemsCursosCom = document.querySelectorAll(".js-cursos-com");
let elemsDescricaoCursosCom = document.querySelectorAll(
  ".js-descricao-cursos-com"
);

let dicQtdAulas = {
  pa: "200 aulas",
  vba: "400",
  ppt: "120",
  fe: "400",
  js: "500",
};
let dicQtdHoras = {
  pa: "20 horas",
  vba: "87",
  ppt: "27",
  fe: "100",
  js: "115",
};

let dicCursosCom = {
  Excel:
    "para quem está buscando uma vaga no mercado (praticamente todas as vagas boas têm Excel como pré requisito - às vezes até como prova no processo seletivo) e também pra quem precisa usar o Excel no dia a dia na empresa e dominar tudo do básico ao avançado da principal ferramenta do Mercado de Trabalho.",
  "Power BI":
    "uma das melhores formas de você se destacar tanto em processos seletivos quanto na sua empresa com a ferramenta que atualmente é um dos maiores diferenciais no Mercado, pra aprender a criar Relatórios e Dashboards que impressionam dentro de qualquer empresa, além de entrar em vagas da área de Dados (Business Intelligence, por exemplo), que pagam bem acima da média.",
  Python:
    "a linguagem de programação que mais cresce no mundo. Nesse programa você vai aprender a dominar o Python pra fazer automações incríveis, Desenvolver sites, construir análises com Ciência de Dados (uma das carreiras mais valorizadas no Mercado), trabalhar com Inteligência Artificial, e muito mais, mesmo que você nunca tenha programado na vida, pra surfar essa onda que na minha opinião é uma das maiores oportunidades de crescimento na carreira e ser o profissional que as empresas cada vez estão buscando mais.",
  VBA: "vai te ajudar a automatizar praticamente qualquer tarefa repetitiva que você faça dentro do Excel (inclusive mandar e-mail, criar apresentação em PowerPoint automaticamente, gerar relatórios automáticos em PDF, etc).",
  SQL: "a linguagem mais importante do mundo para quem trabalha com dados. Nesse programa você vai aprender tudo sobre como trabalhar com grande volume de dados, uma das habilidades mais importantes do mercado com o aumento do volume de informações. Você vai aprender como trabalhar com bancos de dados seja pra se destacar na sua empresa atual, pra conseguir um diferencial em processos seletivos ou até mesmo para entrar em áreas de dados - existe MUITA vaga promissora pra quem domina o SQL.",
  PowerPoint:
    "esse é um programa único, sem comparativo no mercado, onde vou te mostrar como realmente Dominar a Arte da Apresentação para ser reconhecido e receber as Melhores Oportunidades no Mercado de Trabalho. Você não vai aprender “apenas” a montar uma apresentação de impacto, mas também todas as técnicas de Persuasão, Linguagem Corporal, Como perder a timidez, e como IMPRESSIONAR em qualquer apresentação (formal ou informal).",
  JavaScript:
    "a linguagem de programação que manda quando o assunto é desenvolvimento WEB. Para você ter uma ideia, 98,3% de todos os sites no mundo utilizam JavaScript. Isso acontece, pois essa linguagem de programação é responsável por tornar os sites interativos e inteligentes, mas não para por aí. Além de ser utilizado na grande maioria dos sites, o JavaScript é muito popular por ser uma das poucas linguagens que permite o desenvolvedor trabalhar em todas as áreas do desenvolvimento, sendo elas: front-end (parte visual); backend (parte da inteligência que roda por trás); banco de dados (armazenamento de informações).",
  "HTML & CSS":
    "o HTML e CSS são as linguagens de programação utilizadas para criar e estilizar sites na WEB. Todo e qualquer site existente hoje na Internet utiliza essas duas linguagens em seus códigos. O HTML atua na parte da construção da estrutura do site, já o CSS atua na estilização das páginas. Então, enquanto o HTML monta o esqueleto da página, o CSS deixa a página bonita e visual. O HTML e o CSS atuam em conjunto para criar páginas bonitas e bem estruturadas.",
  "Inteligência Artificial":
    "aprenda como usar da melhor forma as principais tecnologias de Inteligência Artificial para se destacar no Mercado de Trabalho. São elas: ChatGPT, Gemini, Copilot, Midjourney, Dall-e, Bardeen, Gamma, Copilot 365, Perplexity, Claude, Make AI, e muito mais!",
  "Power Automate":
    "aprenda a ferramenta da Microsoft focada em otimizar e automatizar todo e qualquer fluxo de trabalho. Impressione na sua empresa fazendo automações de tarefas e processos integrando esse programa com as principais ferramentas do Mercado de Trabalho",
};
let qtdCursosCom = Object.keys(dicCursosCom).length;
let cursosCom = "";
let descricaoCursosCom = "";

var dicSRCVideo = {
  aula: {
    js: [
      "https://webinarios-hashtag.s3.us-east-2.amazonaws.com/Live+de+Apresenta%C3%A7%C3%A3o+do+Programa+Full+Stack+Impressionador.mp4",
      "amazon",
    ],
    sql: [
      "https://webinarios-hashtag.s3.us-east-2.amazonaws.com/Live+de+Apresenta%C3%A7%C3%A3o+do+Programa+SQL+Impressionador.mp4",
      "amazon",
    ],
    com: [
      "https://webinarios-hashtag.s3.us-east-2.amazonaws.com/live_da_comunidade_impressionadora+(1080p).mp4",
      "amazon",
    ],
  },
  jornada: { excel: ["https://youtube.com/embed/oo28Ki1ZZ8A", "yt"] },
};

var dicCodigosCurso = {
  js: "js",
  excel: "ex",
  pa: "pa",
  sql: "sql",
  vba: "vba",
  ppt: "ppt",
  fe: "fe",
  com: "ci",
};

let dicHueModeBotaoForm = {
  js: ["292", "dark"],
  excel: ["159", "dark"],
  pa: ["198", "dark"],
  sql: ["193", "light"],
  vba: ["193", "light"],
  ppt: ["193", "light"],
  fe: ["181", "dark"],
  com: ["211", "dark"],
};

var dicSrcPadrao = {
  lespera: "les",
  perpetuo: "vtsd_",
  intensivao: "l",
  aula: "w",
  up: "up_",
  afiliado: "af_",
  email: "em_",
};

// Mesmo SRC para Jornada e Intensivão
dicSrcPadrao["jornada"] = dicSrcPadrao["intensivao"];

var dicIDForm = {
  lespera: {
    js: "6132",
    excel: "5344",
    sql: "5372",
    vba: "5374",
    ppt: "5376",
    fe: "8211",
    com: "7807",
  },
  perpetuo: {
    js: "6842",
    excel: "5056",
    sql: "5858",
    vba: "5860",
    ppt: "5862",
    fe: "6882",
  },
  intensivao: { js: "6690", excel: "5976" },
  up: {
    js: "6128",
    excel: "5978",
    sql: "6110",
    vba: "6112",
    ppt: "6114",
    fe: "8212",
  },
  aula: { js: "7672", pa: "8173", sql: "8148", fe: "7739", com: "7837" },
  vpi: { com: "7809" },
  afiliado: { com: "8307" },
  email: {
    com: "7807",
  },
};

// Mesmo Pré Checkout para Jornada e Intensivão
dicIDForm["jornada"] = dicIDForm["intensivao"];

var dicPrecosFonte = {
  lespera: "124,75",
  intensivao: "97,14",
};

// Perpétuo mesmo preço de lista de espera
dicPrecosFonte["perpetuo"] = dicPrecosFonte["lespera"];

// Upsell e Webinar mesmo preço de lançamento
dicPrecosFonte["up"] = dicPrecosFonte["intensivao"];
dicPrecosFonte["aula"] = dicPrecosFonte["intensivao"];
dicPrecosFonte["jornada"] = dicPrecosFonte["intensivao"];
dicPrecosFonte["afiliado"] = dicPrecosFonte["intensivao"];
dicPrecosFonte["email"] = dicPrecosFonte["intensivao"];

// IDProduto, IDOferta
var dicLinksCheckout = {
  lespera: {
    cp: {
      js: ["L16941472G", "o466y1zw"],
      excel: ["L16941472G", "evy4c5jw"],
      sql: ["L16941472G", "l6qs1d9q"],
      vba: ["L16941472G", "l6qs1d9q"],
      com: ["L16941472G", "l6qs1d9q"],
      ppt: ["L16941472G", "jlk5p56u"],
      fe: ["L16941472G", "uxbsd9ly"],
    },
    cl: {
      js: ["L16941472G", "7q1t1kri"],
      excel: ["L16941472G", "8l5juetb"],
      sql: ["L16941472G", "ajh1pi3z"],
      vba: ["L16941472G", "ajh1pi3z"],
      com: ["L16941472G", "ajh1pi3z"],
      ppt: ["L16941472G", "57gawgd8"],
      fe: ["L16941472G", "wid30kqp"],
    },
    ap: {
      js: ["X82392969H", "uncreodq"],
      excel: ["V6008994R", "siu1b7e5"],
      sql: ["Q57557503P", "voyqecd5"],
      vba: ["B14959865K", "0mblo3v9"],
      ppt: ["F18811894U", "hlitsf7v"],
    },
    al: {
      js: ["E82396870B", "x4qtpyu5"],
      excel: ["V39120067A", "3gmjcbsi"],
      sql: ["R57560907X", "tqyv3g0f"],
      vba: ["T39166951K", "yb8krum7"],
      ppt: ["N39169236Y", "9r3iyzi4"],
    },
  },

  up: {
    cp: {
      js: ["L16941472G", "0ut8zmvo"],
      excel: ["L16941472G", "fu9uivcl"],
      sql: ["L16941472G", "fu9uivcl"],
      vba: ["L16941472G", "fu9uivcl"],
      ppt: ["L16941472G", "fu9uivcl"],
    },
    cl: {
      js: ["L16941472G", "gbgo569m"],
      excel: ["L16941472G", "auytd52f"],
      sql: ["L16941472G", "auytd52f"],
      vba: ["L16941472G", "auytd52f"],
      ppt: ["L16941472G", "auytd52f"],
    },
    ap: {
      js: ["X82392969H", "6mi3451a"],
      excel: ["V6008994R", "h57kjitn"],
      sql: ["Q57557503P", "bc67cz0q"],
      vba: ["B14959865K", "ootxgwf2"],
      ppt: ["F18811894U", "dafuwesx"],
    },
    al: {
      js: ["E82396870B", "1sn5wpx4"],
      excel: ["V39120067A", "2izh008r"],
      sql: ["R57560907X", "hslic8st"],
      vba: ["T39166951K", "is87li4s"],
      ppt: ["N39169236Y", "vw7edcwf"],
    },
  },

  aula: {
    cp: {
      js: ["A91410311H", "zvxm01v4"],
      pa: ["A91410311H", "8vjtclg8"],
      sql: ["A91410311H", "qrr2pqbp"],
      fe: ["A91410311H", "x78z4o0n"],
      com: ["A91410311H", "kho5z8of"],
    },
    cl: {
      js: ["A91410311H", "d4eakybv"],
      pa: ["A91410311H", "3tltkc36"],
      sql: ["A91410311H", "amwq10z6"],
      fe: ["A91410311H", "9ef79q52"],
      com: ["A91410311H", "u4diob8m"],
    },
  },

  afiliado: {
    cp: {
      com: ["L16941472G", "pjxk6v22"],
    },
    cl: {
      com: ["L16941472G", "tn5px8v4"],
    },
  },

  vpi: {
    cp: { com: ["L16941472G", "pjxk6v22"] },
    cl: { com: ["L16941472G", "tn5px8v4"] },
  },

  intensivao: {
    cp: { js: ["L16941472G", "ob5jfv87"] },
    cl: { js: ["L16941472G", "gdsml483"] },
  },

  jornada: {
    cp: { excel: ["L16941472G", "iqf27ssx"] },
    cl: { excel: ["L16941472G", "dmf4vn6q"] },
  },
};

// Links do perpétuo são os mesmos da lista de espera
dicLinksCheckout["perpetuo"] = dicLinksCheckout["lespera"];

// Links de E-mail são os mesmos da aula
dicLinksCheckout["email"] = dicLinksCheckout["aula"];

// Links de webinar avulso são os mesmos de comunidade
dicLinksCheckout["aula"]["ap"] = dicLinksCheckout["aula"]["cp"];
dicLinksCheckout["aula"]["al"] = dicLinksCheckout["aula"]["cl"];

// Links de lançamento avulso são os mesmos de comunidade
dicLinksCheckout["intensivao"]["ap"] = dicLinksCheckout["intensivao"]["cp"];
dicLinksCheckout["intensivao"]["al"] = dicLinksCheckout["intensivao"]["cl"];

// Links de lançamento avulso são os mesmos de comunidade
dicLinksCheckout["jornada"]["ap"] = dicLinksCheckout["jornada"]["cp"];
dicLinksCheckout["jornada"]["al"] = dicLinksCheckout["jornada"]["cl"];

// Definindo fonte se não tiver nenhuma
if (!parametroFonte) {
  if (parametroCurso == "pa") {
    parametroFonte = "aula";
    updateURLParam("fonte", "aula");
  } else {
    parametroFonte = "lespera";
  }
} else if (!dicLinksCheckout[parametroFonte]) {
  dicLinksCheckout[parametroFonte] = dicLinksCheckout["lespera"];
}

// Definindo curso se não tiver nenhum
if (!parametroCurso || !dicCodigosCurso[parametroCurso]) {
  parametroCurso = "com";
}

// Atualizar SRC se tiver algum parâmetro na URL
if (parametroSRC) {
  dicSrcPadrao = parametroSRC;
} else {
  if (!dicSrcPadrao[parametroFonte]) {
    dicSrcPadrao[parametroFonte] = dicSrcPadrao["lespera"];
  }

  dicSrcPadrao =
    dicSrcPadrao[parametroFonte] +
    dicCodigosCurso[parametroCurso] +
    "-pgvendas";
}

// Incluir o tipo da página no SRC, se existir
if (parametroTipo) {
  dicSrcPadrao += "_" + parametroTipo;
}

// Adicionar o evento de clique nos botões de oferta
elemsBotaoOferta.forEach((botao) => {
  botao.href = "javascript:void(0)";

  const funcaoBotao = () => {
    irAteElementoID("secao-oferta");

    botao.href = "#secao-oferta";

    botao.removeEventListener("click", funcaoBotao);
  };

  botao.addEventListener("click", funcaoBotao);
});

// Adicionar o evento de clique nos botões de Popup de Trilha
elemsBotaoPopupTrilha.forEach((botao) => {
  botao.addEventListener("click", () => {
    trocarConteudoPopup("trilha", botao.getAttribute("textotrilha"), true);
  });
});

// Trocar IDs formulário de pré-checkout
if (parametroFonte && dicIDForm[parametroFonte][parametroCurso]) {
  var numFormActive = dicIDForm[parametroFonte][parametroCurso];

  if (numFormActive != formActive.id.replace("_form_", "").replace("_", "")) {
    document.querySelector("#" + formActive.id + "submit").id =
      "_form_" + numFormActive + "_submit";
    formActive.id = "_form_" + numFormActive + "_";
    document.querySelectorAll("[type=hidden]")[0].value = numFormActive;
    document.querySelectorAll("[type=hidden]")[1].value = numFormActive;
  }
}

// Ajustar cores do popup de pre-checkout
if (dicHueModeBotaoForm[parametroCurso]) {
  document.body.setAttribute(
    "style",
    `--hue-botao-form: ${dicHueModeBotaoForm[parametroCurso][0]}`
  );
  document.body.setAttribute(dicHueModeBotaoForm[parametroCurso][1], "");
}

// Adicionar o evento de clique nos botões padrões, de recorrência e no botão de fechar o popup e também zera os links para deixar apenas o clique no botão

// Comunidade
atribuirFuncoesBotao(elemsBotaoPadrao, "cp", 1);
atribuirFuncoesBotao(elemsBotaoPix, "cp", 0);
atribuirFuncoesBotao(elemsBotaoRecorrente, "cl", 1);

// Avulsos
atribuirFuncoesBotao(elemsBotaoAvulsoPadrao, "ap", 1);
atribuirFuncoesBotao(elemsBotaoAvulsoPix, "ap", 0);
atribuirFuncoesBotao(elemsBotaoAvulsoRecorrente, "al", 1);

// Botão fechar popup precheckout
elemsBotaoFechar.forEach(function (elem) {
  elem.href = "#";

  elem.addEventListener("click", function () {
    togglePopupAberto();
  });
});

// Atualizar quantidade de Aulas e Horas do curso
if (dicQtdAulas[parametroCurso]) {
  elemsQtdAulas.forEach((elem) => {
    elem.innerText = dicQtdAulas[parametroCurso];
  });
}

if (dicQtdHoras[parametroCurso]) {
  elemsQtdHoras.forEach((elem) => {
    elem.innerText = dicQtdHoras[parametroCurso];
  });
}

// Criando a lista de cursos da comunidade
Object.keys(dicCursosCom).forEach((chave, i, lista) => {
  if (cursosCom) {
    if (i == lista.length - 1) {
      cursosCom += " e ";
    } else {
      cursosCom += ", ";
    }
  }

  cursosCom += chave;

  if (dicCursosCom[chave]) {
    if (descricaoCursosCom) {
      descricaoCursosCom += "<br><br>";
    }

    descricaoCursosCom += `<strong>${chave}:</strong> ${dicCursosCom[chave]}`;
  }
});

// Atualizar quantidade, cursos e descrição da Comunidade
elemsCursosCom.forEach((elem) => {
  elem.innerText = cursosCom;
});

elemsQtdCursosCom.forEach((elem) => {
  elem.innerText = qtdCursosCom;
});

elemsDescricaoCursosCom.forEach((elem) => {
  elem.innerHTML = descricaoCursosCom;
});

// Acertar Preços de acordo com a Página Carregada
elemsPrecoParcelado.forEach((elem) => {
  elem.innerText = "R$ " + dicPrecosFonte[parametroFonte];
});

elemsPrecoParceladoInt.forEach((elem) => {
  elem.innerText = dicPrecosFonte[parametroFonte].substring(
    0,
    dicPrecosFonte[parametroFonte].indexOf(",")
  );
});

elemsPrecoParceladoDec.forEach((elem) => {
  elem.innerText = dicPrecosFonte[parametroFonte].substring(
    dicPrecosFonte[parametroFonte].indexOf(",") + 1
  );
});

if (
  parametroFonte == "aula" ||
  parametroFonte == "intensivao" ||
  parametroFonte == "jornada" ||
  parametroFonte == "up"
) {
  elemPrecoDe.forEach((precoDe) => {
    precoDe.innerHTML = '<span class="cortado">R$ 1.500</span> por 12x de';
  });

  if (
    parametroFonte == "aula" ||
    parametroFonte == "intensivao" ||
    parametroFonte == "jornada"
  ) {
    // Ocultar o container de toggle
    elemContainerToggle.forEach((container) => {
      container.style.display = "none";
    });

    // Ocultar caixa avulso
    elemPrecoSemFoco.forEach((elemPreco, i) => {
      elemPreco.style.display = "none";

      if (i == 0) {
        elemPreco.parentElement.classList.remove("container--oferta-duplo");
        elemPreco.parentElement.classList.add("container--oferta");
      }
    });

    // Ocultar melhor opção na caixa padrão
    elemPrecoFoco.forEach((elemPreco) => {
      let melhorPreco = elemPreco.querySelector(
        '[class*="preco__melhoropcao"]'
      );
      melhorPreco.style.display = "none";
    });

    // Ocultar opções de pagamento e caixa avulso na versão antiga da página de vendas
    if (elemBlocoToggle) {
      elemBlocoToggle.classList.add("oculto");
    }

    elemsBlocoPlano.forEach((bloco) => {
      let elemBlocoNormal = bloco.querySelector(
        ".bloco-plano-pgvpy:not(.destaque-bloco-plano-pgvpy)"
      );
      let elemBlocoDestaque = bloco.querySelector(
        ".destaque-bloco-plano-pgvpy"
      );

      bloco.classList.add("bloco-unico");
      elemBlocoDestaque.classList.add("bloco-unico");
      elemBlocoNormal.classList.add("oculto");
    });
  }
}

// Ajustes na página se for Perpétuo de VSL de Excel
if (parametroCurso == "excel") {
  if (parametroFonte == "perpetuo" && parametroTipo == "vsl") {
    var elemSecaoVSL = document.querySelector("#secao-vsl");

    // Ocultar seção pós-VSL e interações da página
    elemSecaoVSL.classList.add("secao-pgvex--ocultas");
    document.body.classList.add("pgvex-fechada");
  }
}

// Ajustes no Vídeo de Vendas
ajustesVideoVendas();

// Funções para validar o formulário
const isRequired = (value) => (value === "" ? false : true);

const isEmailValid = (email) => {
  const re =
    /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
};

const showError = (input, message) => {
  const formField = input.parentElement;

  formField.classList.remove("sucesso");
  formField.classList.add("erro");

  const erro = formField.querySelector("small");
  erro.textContent = message;
};

const showSuccess = (input) => {
  const formField = input.parentElement;

  formField.classList.remove("erro");
  formField.classList.add("sucesso");

  const error = formField.querySelector("small");
  error.textContent = "";
};

const checkfullname = () => {
  let valid = false;
  const fullname = fullnameForm.value.trim();

  if (!isRequired(fullname)) {
    showError(fullnameForm, "Seu nome não pode ser vazio.");
  } else {
    showSuccess(fullnameForm);
    valid = true;
  }
  return valid;
};

const checkEmail = () => {
  let valid = false;
  const email = emailForm.value.trim();

  if (!isRequired(email)) {
    showError(emailForm, "Seu e-mail não pode ser vazio.");
  } else if (!isEmailValid(email)) {
    showError(emailForm, "O e-mail digitado não é válido.");
  } else {
    showSuccess(emailForm);
    valid = true;
  }
  return valid;
};

formActive.addEventListener(
  "input",
  debounce(function (e) {
    switch (e.target.id) {
      case "fullname":
        checkfullname();
        break;
      case "email":
        checkEmail();
        break;
    }
  })
);

formActive.addEventListener("submit", function (e) {
  e.preventDefault();

  let isfullnameValid = checkfullname(),
    isEmailValid = checkEmail();

  let isFormValid = isfullnameValid && isEmailValid;

  if (isFormValid) {
    enviarFormulario();
  }
});

// Script para preencher o formulário de pre-checkout com os parâmetros da URL
function editarValorCampoForm(elemsForm, valorForm) {
  elemsForm.forEach(function (element) {
    element.value = valorForm;
  });
}

var elemsFormFullname = document.querySelectorAll("#fullname");
var elemsFormEmail = document.querySelectorAll("#email");
var elemsFormPhone = document.querySelectorAll("#phone");
var elemsFormDDD = document.querySelectorAll("[id='field[59]']");
var elemsFormCelular = document.querySelectorAll("[id='field[60]']");

var parametrosURLCheckout = new URLSearchParams(window.location.search);

var valorFirstname = parametrosURLCheckout.get("firstname");
var valorFullname = parametrosURLCheckout.get("fullname");
var valorEmail = parametrosURLCheckout.get("email");
var valorDDD = parametrosURLCheckout.get("ddd");
var valorCelular = parametrosURLCheckout.get("celular");
var valorPhone = parametrosURLCheckout.get("phone");

if (valorFullname) {
  editarValorCampoForm(elemsFormFullname, valorFullname);
} else if (valorFirstname) {
  editarValorCampoForm(elemsFormFullname, valorFirstname);
}

if (valorEmail) {
  editarValorCampoForm(elemsFormEmail, valorEmail);
}

if (elemsFormPhone.length > 0) {
  if (valorDDD && valorCelular) {
    editarValorCampoForm(elemsFormPhone, valorDDD + valorCelular);
  } else if (valorPhone) {
    editarValorCampoForm(elemsFormPhone, valorPhone);
  }
} else {
  if (valorDDD && valorCelular) {
    editarValorCampoForm(elemsFormDDD, valorDDD);
    editarValorCampoForm(elemsFormCelular, valorCelular);
  } else if (valorPhone) {
    editarValorCampoForm(elemsFormDDD, valorPhone.substring(0, 2));
    editarValorCampoForm(elemsFormCelular, valorPhone.substring(2));
  }
}
