// ==================================================
// Configuracao dos botoes de abertura do precheckout
// ==================================================
function atribuirFuncoesBotao(botoes, tipoLink, pixBillet) {
    botoes.forEach((botao) => {
        botao.href = "javascript:void(0)";

        botao.addEventListener("click", function () {
            const linkCheckout =
                dicLinksCheckout[parametroFonte] &&
                dicLinksCheckout[parametroFonte][tipoLink] &&
                dicLinksCheckout[parametroFonte][tipoLink][parametroCurso];

            if (!linkCheckout) {
                console.error("Link de checkout não encontrado", {
                    parametroFonte,
                    tipoLink,
                    parametroCurso,
                });
                return;
            }

            definirLinkCheckout(
                linkCheckout,
                dicSrcPadrao,
                pixBillet,
                sckPadrao,
            );
        });
    });
}

// ==================================================
// Controle de abertura, fechamento e carregamento
// ==================================================
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

// ==================================================
// Preparacao dos campos de checkout
// ==================================================
function definirLinkCheckout(IDLinkTemp, srcForm, pixBillet, sckForm) {
    if (
        linkTempIDProdutoForm &&
        linkTempIDOfertaForm &&
        linkTempSRCForm &&
        linkTempPixBilletForm
    ) {
        console.log(IDLinkTemp);
        console.log(IDLinkTemp[0], IDLinkTemp[1], srcForm, pixBillet);
        linkTempIDProdutoForm.value = IDLinkTemp[0];
        linkTempIDOfertaForm.value = IDLinkTemp[1];
        linkTempSRCForm.value = srcForm;
        linkTempPixBilletForm.value = pixBillet;
    }

    if (campoSCKForm) {
        campoSCKForm.value = sckForm;
    }

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
        togglePopupAberto(true);
        enviarFormulario();
    } else {
        togglePopupAberto(false);
    }
}

// ==================================================
// Referencias principais da pagina e do formulario
// ==================================================
var bodyEl = document.body;
var formActive = document.querySelector(".form");

if (!formActive) {
    formActive = document.querySelector("form");
}

var popupContainerEl = document.getElementById("fundo-popup");

// ==================================================
// Leitura dos parametros da URL
// ==================================================
var parametrosURL = new URLSearchParams(window.location.search);
var parametroSRC = parametrosURL.get("src");
var parametroSCK = parametrosURL.get("sck");
var parametroConversion = parametrosURL.get("conversion");
var parametroUTMCampaign = parametrosURL.get("utm_campaign");
var parametroUTMSource = parametrosURL.get("utm_source");
var parametroUTMMedium = parametrosURL.get("utm_medium");
var parametroUTMContent = parametrosURL.get("utm_content");
var parametroUTMTerm = parametrosURL.get("utm_term");
var parametroFonte = parametrosURL.get("fonte"); // Lista de Espera, Perpétuo...
var parametroCurso = parametrosURL.get("curso"); // Excel, JavaScript...
var parametroTipo =
    parametrosURL.get("tipo") ||
    (window.location.pathname.match(/inscripcion-([a-z])$/) || [])[1]; // Teste A, Teste B...

// ==================================================
// Campos do formulario e campos ocultos do checkout
// ==================================================
let inputsForm = formActive.querySelectorAll("input");
let fullnameForm = document.querySelector("#fullname");
let emailForm = document.querySelector("#email");
let prefixForm = document.querySelector("#prefix, [name='field[59]']");
let nationalPhoneForm = document.querySelector(
    "#national-phone, [name='field[60]']",
);
let phoneForm = document.querySelector("#phone, [name='phone']");

let linkTempIDProdutoForm = document.querySelector("[name='field[112]']");
let linkTempIDOfertaForm = document.querySelector("[name='field[113]']");
let linkTempSRCForm = document.querySelector("[name='field[114]']");
let linkTempPixBilletForm = document.querySelector("[name='field[115]']");
let campoSCKForm = document.querySelector("[name='field[158]']");
// const linkTempForm = document.querySelector("[name='field[58]']");

// ==================================================
// Dropdown de prefixo telefonico
// ==================================================
// Funcionamento do dropdown de prefixo de pais

const countries = [
    { name: "Afganistán", code: "+93" },
    { name: "Albania", code: "+355" },
    { name: "Alemania", code: "+49" },
    { name: "Andorra", code: "+376" },
    { name: "Angola", code: "+244" },
    { name: "Arabia Saudí", code: "+966" },
    { name: "Argelia", code: "+213" },
    { name: "Argentina", code: "+54" },
    { name: "Armenia", code: "+374" },
    { name: "Aruba", code: "+297" },
    { name: "Australia", code: "+61" },
    { name: "Austria", code: "+43" },
    { name: "Azerbaiyán", code: "+944" },
    { name: "Bahamas", code: "+1" },
    { name: "Bahrain", code: "+973" },
    { name: "Bangladesh", code: "+880" },
    { name: "Barbados", code: "+1" },
    { name: "Bélgica", code: "+32" },
    { name: "Belice", code: "+501" },
    { name: "Benín", code: "+229" },
    { name: "Bermudas", code: "+1" },
    { name: "Bielorrusia", code: "+375" },
    { name: "Bolivia", code: "+591" },
    { name: "Bosnia", code: "+387" },
    { name: "Botsuana", code: "+267" },
    { name: "Brasil", code: "+55" },
    { name: "Brunei", code: "+673" },
    { name: "Bulgaria", code: "+359" },
    { name: "Burkina Faso", code: "+226" },
    { name: "Burundi", code: "+257" },
    { name: "Bután", code: "+975" },
    { name: "Camboya", code: "+855" },
    { name: "Camerún", code: "+237" },
    { name: "Canadá", code: "+1" },
    { name: "Chad", code: "+235" },
    { name: "Chile", code: "+56" },
    { name: "China", code: "+86" },
    { name: "Chipre", code: "+357" },
    { name: "Colombia", code: "+57" },
    { name: "Congo", code: "+242" },
    { name: "Corea del Norte", code: "+850" },
    { name: "Corea del Sur", code: "+82" },
    { name: "Costa de Marfil", code: "+225" },
    { name: "Costa Rica", code: "+506" },
    { name: "Croacia", code: "+385" },
    { name: "Cuba", code: "+53" },
    { name: "Diego García", code: "+246" },
    { name: "Dinamarca", code: "+45" },
    { name: "Dominica", code: "+1" },
    { name: "Ecuador", code: "+593" },
    { name: "Egipto", code: "+20" },
    { name: "El Salvador", code: "+503" },
    {
        name: "Emiratos Árabes Unidos",
        code: "+971",
    },
    { name: "Eritrea", code: "+291" },
    { name: "Eslovaquia", code: "+421" },
    { name: "Eslovenia", code: "+386" },
    { name: "España", code: "+34" },
    { name: "Estados Unidos", code: "+1" },
    { name: "Estonia", code: "+372" },
    { name: "Etiopía", code: "+251" },
    { name: "Filipinas", code: "+63" },
    { name: "Finlandia", code: "+358" },
    { name: "Fiyi", code: "+679" },
    { name: "Francia", code: "+33" },
    { name: "Gabón", code: "+241" },
    { name: "Gambia", code: "+220" },
    { name: "Georgia", code: "+995" },
    { name: "Ghana", code: "+233" },
    { name: "Gibraltar", code: "+350" },
    { name: "Granada", code: "+1" },
    { name: "Grecia", code: "+30" },
    { name: "Groenlandia", code: "+299" },
    { name: "Guatemala", code: "+502" },
    { name: "Guinea Ecuatorial", code: "+240" },
    { name: "Honduras", code: "+504" },
    {
        name: "Isla de la Ascensión",
        code: "+247",
    },
    { name: "Islas Feroe", code: "+298" },
    { name: "Islas Marianas", code: "+1" },
    { name: "Islas Marshall", code: "+692" },
    { name: "Islas Norfolk", code: "+672" },
    { name: "Islas Salomón", code: "+677" },
    {
        name: "Islas Vírgenes Británicas",
        code: "+1",
    },
    { name: "Israel", code: "+972" },
    { name: "Italia", code: "+39" },
    { name: "Jamaica", code: "+1" },
    { name: "Japón", code: "+81" },
    { name: "Jordania", code: "+962" },
    { name: "Kazajistán", code: "+7" },
    { name: "Kenia", code: "+254" },
    { name: "Kirguistán", code: "+996" },
    { name: "Kiribati", code: "+686" },
    { name: "Kuwait", code: "+965" },
    { name: "Laos", code: "+856" },
    { name: "Lesoto", code: "+266" },
    { name: "Letonia", code: "+371" },
    { name: "Líbano", code: "+961" },
    { name: "Liberia", code: "+231" },
    { name: "Libia", code: "+218" },
    { name: "Liechtenstein", code: "+423" },
    { name: "México", code: "+52" },
    { name: "Nauru", code: "+674" },
    { name: "Nepal", code: "+977" },
    { name: "Nicaragua", code: "+505" },
    { name: "Níger", code: "+227" },
    { name: "Nigeria", code: "+234" },
    { name: "Niue", code: "+683" },
    { name: "Noruega", code: "+47" },
    { name: "Nueva Caledonia", code: "+687" },
    { name: "Nueva Zelanda", code: "+64" },
    { name: "Oman", code: "+968" },
    { name: "Pakistán", code: "+92" },
    { name: "Palau", code: "+680" },
    { name: "Palestina", code: "+970" },
    { name: "Panamá", code: "+507" },
    {
        name: "Papúa Nueva Guinea",
        code: "+675",
    },
    { name: "Paraguay", code: "+595" },
    { name: "Perú", code: "+51" },
    {
        name: "Polinesia francesa",
        code: "+689",
    },
    { name: "Polonia", code: "+48" },
    { name: "Portugal", code: "+351" },
    { name: "Qatar", code: "+974" },
    { name: "Reino Unido", code: "+44" },
    {
        name: "República Centroafricana",
        code: "+236",
    },
    { name: "República Checa", code: "+420" },
    {
        name: "República Democrática del Congo",
        code: "+243",
    },
    {
        name: "República Dominicana",
        code: "+809",
    },
    { name: "Ruanda", code: "+250" },
    { name: "Rumania", code: "+40" },
    { name: "Rusia", code: "+7" },
    { name: "Samoa oriental", code: "+685" },
    {
        name: "San Cristóbal y Nieves",
        code: "+1",
    },
    { name: "San Marino", code: "+378" },
    {
        name: "San Pedro y Miquelón",
        code: "+508",
    },
    {
        name: "San Vicente y las Granadinas",
        code: "+1",
    },
    { name: "Santa Elena", code: "+290" },
    { name: "Santa Lucía", code: "+1" },
    { name: "Santo Tomé", code: "+239" },
    { name: "Senegal", code: "+221" },
    { name: "Serbia", code: "+381" },
    { name: "Seychelles", code: "+248" },
    { name: "Sierra Leona", code: "+232" },
    { name: "Singapur", code: "+65" },
    { name: "Siria", code: "+963" },
    { name: "Somalia", code: "+252" },
    { name: "Sri Lanka", code: "+94" },
    { name: "Suazilandia", code: "+268" },
    { name: "Sudáfrica", code: "+27" },
    { name: "Sudán", code: "+249" },
    { name: "Suecia", code: "+46" },
    { name: "Suiza", code: "+41" },
    { name: "Surinam", code: "+597" },
    { name: "Tailandia", code: "+66" },
    { name: "Taiwán", code: "+886" },
    { name: "Tanzania", code: "+255" },
    { name: "Tayikistán", code: "+992" },
    { name: "Timor del Este", code: "+670" },
    { name: "Togo", code: "+228" },
    { name: "Tokelau", code: "+690" },
    { name: "Tonga", code: "+676" },
    { name: "Trinidad y Tobago", code: "+1" },
    { name: "Túnez", code: "+216" },
    { name: "Turquía", code: "+90" },
    { name: "Tuvalu", code: "+688" },
    { name: "Ucrania", code: "+380" },
    { name: "Uganda", code: "+256" },
    { name: "Uruguay", code: "+598" },
    { name: "Uzbekistán", code: "+998" },
    { name: "Vanuatu", code: "+678" },
    { name: "Venezuela", code: "+58" },
    { name: "Vietnam", code: "+84" },
    { name: "Wallis y Futuna", code: "+681" },
    { name: "Yemen", code: "+967" },
    { name: "Yibouti", code: "+253" },
    { name: "Zambia", code: "+260" },
    { name: "Zimbabue", code: "+263" },
];

const inputPrefixo = document.getElementById("prefix");
const dropdownPrefixo = document.getElementById("dropdown");

if (inputPrefixo && dropdownPrefixo) {
    inputPrefixo.addEventListener("input", () => {
        const query = inputPrefixo.value.toLowerCase();

        if (/^\d+$/.test(query)) {
            const matched = countries.find(
                (c) => c.code.replace("+", "") === query,
            );
            if (matched) {
                inputPrefixo.value = matched.code;
                showSuccess(inputPrefixo);
                dropdownPrefixo.classList.add("hidden");
                return;
            }
        }

        dropdownPrefixo.innerHTML = "";

        if (!query) {
            dropdownPrefixo.classList.add("hidden");
            return;
        }

        const filtered = countries.filter(
            (c) =>
                c.name.toLowerCase().includes(query) || c.code.includes(query),
        );

        if (filtered.length === 0) {
            dropdownPrefixo.innerHTML = "<div>Ning�n pa�s encontrado</div>";
        } else {
            filtered.forEach((c) => {
                const item = document.createElement("div");
                item.textContent = `${c.name} (${c.code})`;
                item.addEventListener("click", () => {
                    inputPrefixo.value = `${c.code}`;
                    dropdownPrefixo.classList.add("hidden");

                    showSuccess(inputPrefixo);
                });
                dropdownPrefixo.appendChild(item);
            });
        }

        dropdownPrefixo.classList.remove("hidden");
    });

    // inputPrefixo.addEventListener("focus", () => {
    //     dropdownPrefixo.classList.remove("hidden");
    // });

    inputPrefixo.addEventListener("click", () => {
        // Mostra todas as opcoes quando o input e clicado
        if (dropdownPrefixo.classList.contains("hidden")) {
            dropdownPrefixo.innerHTML = "";

            countries.forEach((c) => {
                const item = document.createElement("div");
                item.textContent = `${c.name} (${c.code})`;
                item.addEventListener("click", () => {
                    inputPrefixo.value = `${c.code}`;
                    dropdownPrefixo.classList.add("hidden");
                    showSuccess(inputPrefixo);
                });
                dropdownPrefixo.appendChild(item);
            });

            dropdownPrefixo.classList.remove("hidden");
        }
    });

    const divPrefixo = document.querySelector(".form-campo-prefixo");

    // Oculta o dropdown ao clicar fora
    document.addEventListener("click", (e) => {
        if (!e.target.closest(".phone-prefix-selector")) {
            dropdownPrefixo.classList.add("hidden");
        }
    });
}

// ==================================================
// Botoes usados nesta pagina
// ==================================================
var elemsBotaoAvulsoPadrao = document.querySelectorAll(
    '[id*="botaoPopupAvulsoPadrao"]',
);

var elemsBotaoOfertaCapacitaciones = document.querySelectorAll(
    '[id*="botaoOfertaCapacitaciones"]',
);

var elemsBotaoFechar = document.querySelectorAll('[id*="botaoPopupFechar"]');

// ==================================================
// Elementos dinamicos da pagina
// ==================================================
let elemVideo = document.querySelector("#js-video");
if (!elemVideo) {
    elemVideo = document.querySelector(".js-video");

    if (!elemVideo) {
        elemVideo = document.querySelector("iframe");
    }
}

let elemContainerVideo = document.querySelector(".js-video");
let elemsPrecoAVista = document.querySelectorAll(".js-preco-avista");
let elemsPrecoDe = document.querySelectorAll(".js-preco-de");

// Bloco para ocultar o avulso em páginas de lançamento
let elemContainerToggle = document.querySelectorAll(
    "[class*=pgto__container-toggle]",
);
let elemPrecoFoco = document.querySelectorAll(
    ".preco__caixa:not(.preco__caixa--semfoco)",
);
let elemPrecoSemFoco = document.querySelectorAll(".preco__caixa--semfoco");
let elemBlocoToggle = document.querySelector(".bloco-toggle-pgvpy");
let elemsBlocoPlano = document.querySelectorAll(".bloco-planos-pgvpy");

let elemsQtdclases = document.querySelectorAll(".js-qtd-clases");
let elemsQtdHoras = document.querySelectorAll(".js-qtd-horas");

let elemsTextoDesconto = document.querySelectorAll(".js-textodesconto");

// ==================================================
// Regras de preco promocional
// ==================================================
let validacaoPrecoPromocional = [
    "jornada",
    "intensivao",
    "semana",
    "up",
    "clase",
].includes(parametroFonte);

let dicQtdclases = {
    excelcap: "",
};

let dicQtdHoras = {
    excelcap: "",
};

// ==================================================
// Videos por fonte e curso
// ==================================================
var dicSRCVideo = {
    semana: {
        excelcap:
            "https://player-vz-4f008646-5e1.tv.pandavideo.com.br/embed/?v=48bb4f9f-72c1-45ae-b447-4ebbed4bf40b",
        // "https://player-vz-4f008646-5e1.tv.pandavideo.com.br/embed/?v=4fe5153d-e263-4e93-934b-a0d0e54f85c4",
        excelbf:
            "https://player-vz-4f008646-5e1.tv.pandavideo.com.br/embed/?v=f01446f2-4a52-480f-a8cf-6901ca88b1b4",
        iacap: "https://player-vz-4f008646-5e1.tv.pandavideo.com.br/embed/?v=48bb4f9f-72c1-45ae-b447-4ebbed4bf40b",
    },
    lespera: {
        excelcap:
            "https://player-vz-4f008646-5e1.tv.pandavideo.com.br/embed/?v=f18b0a20-794d-492b-9f9f-462e71a9ea49",
    },
    clase: {
        excelcap: "https://www.youtube.com/embed/x0B5CTufnlU",
    },
};

// ==================================================
// Cores do formulario
// ==================================================
let dicHueModeBotaoForm = {
    excelcap: ["159", "dark"],
    excelbf: ["320", "dark"],
    iacap: ["270", "dark"],
};

dicHueModeBotaoForm["excelgs"] = dicHueModeBotaoForm["excelcap"];

// ==================================================
// SRC padrao por fonte
// ==================================================
var dicSrcPadrao = {
    lespera: "les",
    perpetuo: "vtsd_",
    semana: "l",
    clase: "w",
    up: "up_",
};

// Mesmo SRC para Jornada, Intensivão e Semana
dicSrcPadrao["intensivao"] = dicSrcPadrao["semana"];
dicSrcPadrao["jornada"] = dicSrcPadrao["semana"];

// ==================================================
// IDs do formulario ActiveCampaign
// ==================================================
var dicIDForm = {
    semana: {
        excelcap: "9804",
        excelbf: "12823",
        excelgs: { default: "13578", a: "14474", b: "14476", c: "14478" },
        iacap: "14982",
    },

    lespera: {
        excelcap: "9806",
        excelbf: "12825",
    },

    up: {
        excelcap: "9808",
        excelbf: "12827",
    },

    clase: {
        excelcap: "14330",
    },
};

// Mesmo Pré Checkout para Jornada, Intensivão e Semana
dicIDForm["jornada"] = dicIDForm["semana"];
dicIDForm["intensivao"] = dicIDForm["semana"];

// ==================================================
// Precos por fonte
// ==================================================
var dicPrecosFonte = {
    lespera: "247",
    semana: "197",
};

// Perpétuo mesmo preço de lista de espera
dicPrecosFonte["perpetuo"] = dicPrecosFonte["lespera"];

// Upsell e Webinar mesmo preço de lançamento
dicPrecosFonte["up"] = dicPrecosFonte["semana"];
dicPrecosFonte["clase"] = dicPrecosFonte["semana"];
dicPrecosFonte["jornada"] = dicPrecosFonte["semana"];
dicPrecosFonte["intensivao"] = dicPrecosFonte["semana"];

// ==================================================
// Aplicacao do preco na pagina
// ==================================================
function aplicarPrecoFonte() {
    const elems = document.querySelectorAll(".js-preco-avista");

    if (!elems.length) {
        // Webflow às vezes demora pra renderizar
        setTimeout(aplicarPrecoFonte, 100);
        return;
    }

    const preco = dicPrecosFonte[parametroFonte] || dicPrecosFonte["lespera"];

    elems.forEach((el) => {
        el.innerText = preco;
    });

    console.log("Preço aplicado:", preco, "fonte:", parametroFonte);
}

// ==================================================
// Links de checkout por fonte, tipo e curso
// ==================================================
// IDProduto, IDOferta
var dicLinksCheckout = {
    lespera: {
        // ap (botaoPopupAvulsoPadrao) - Colômbia, Chile, México e Peru
        ap: {
            excelcap: ["S103217330B", "zgq3h4o5"],
            excelbf: ["K102345273W", "82mhjfqd"], // Black Friday - link padrão 12x
        },
        // al - Outros países
        al: {
            excelcap: ["S103217330B", "h57qgrdo"],
            excelbf: ["K102345273W", "x572f6ml"], // Black Friday - 3x $49
        },
    },

    semana: {
        // ap (botaoPopupAvulsoPadrao) - Colômbia, Chile, México e Peru
        ap: {
            excelcap: ["Q103216947C", "woh9m5m7"],
            excelbf: ["K102345273W", "lepa272t"], // Black Friday - 6x $24,50
            excelgs: ["B103469133E", "ipwnbl25"],
            iacap: ["F105501525O", "gp3zce1s"],
        },
        // al - Outros países
        al: {
            excelcap: ["Q103216947C", "w43k6ick"],
            excelbf: ["K102345273W", "82mhjfqd"], // Repete o principal se quiser
        },
    },

    up: {
        ap: {
            excelcap: ["E97460096H", "t590wv0r"],
            excelbf: ["K102345273W", "82mhjfqd"],
        },
        al: {
            excelcap: ["E97460096H", "724x39ro"],
            excelbf: ["K102345273W", "82mhjfqd"],
        },
    },

    clase: {
        ap: { excelcap: ["T104870977K", "jiuq0ise"] },
        al: { excelcap: ["T104870977K", "ds0q0uq7"] },
    },
};

// ==================================================
// Aliases de fonte e tipo de checkout
// ==================================================
// Enquanto não tivermos comunidade, os botões ficam iguais aos de avulso
dicLinksCheckout["lespera"]["cp"] = dicLinksCheckout["lespera"]["ap"];
dicLinksCheckout["lespera"]["cl"] = dicLinksCheckout["lespera"]["al"];

dicLinksCheckout["semana"]["cp"] = dicLinksCheckout["semana"]["ap"];
dicLinksCheckout["semana"]["cl"] = dicLinksCheckout["semana"]["al"];

// Links do perpétuo são os mesmos da lista de espera
dicLinksCheckout["perpetuo"] = dicLinksCheckout["lespera"];
dicLinksCheckout["intensivao"] = dicLinksCheckout["semana"];
dicLinksCheckout["jornada"] = dicLinksCheckout["semana"];

// ==================================================
// Normalizacao da fonte
// ==================================================
// Definindo fonte se não tiver nenhuma
if (!parametroFonte) {
    parametroFonte = "lespera";
    updateURLParam("fonte", "lespera");
} else if (!dicLinksCheckout[parametroFonte]) {
    dicLinksCheckout[parametroFonte] = dicLinksCheckout["lespera"];
}

// ==================================================
// Normalizacao do curso
// ==================================================
// Dicionário de cursos existentes
var dicCodigosCurso = {
    ia: "iacap",
    excelcap: "excap",
    excelbf: "excelbf",
    excelgs: "excelgs",
    iacap: "iacap",
};

// Definindo curso se não tiver nenhum
if (!parametroCurso || !dicCodigosCurso[parametroCurso]) {
    parametroCurso = "iacap";
} else if (parametroCurso === "ia") {
    parametroCurso = "iacap";
}

// ==================================================
// Fallback de fonte para SRC
// ==================================================
// Se a fonte não estiver nos SRCs, usar o da lista de espera
if (!dicSrcPadrao[parametroFonte]) {
    dicSrcPadrao[parametroFonte] = dicSrcPadrao["lespera"];
}

// ==================================================
// Montagem do SCK
// ==================================================
// Atualizar SCK se tiver algum parâmetro na URL
if (parametroSCK) {
    sckPadrao = parametroSCK;

    console.log(`Preenchendo SCK direto pelo que está preenchido na URL`);
} else {
    var dataHoje = new Date(
        new Date().toLocaleString("en-US", {
            location: "America/Sao_Paulo",
        }),
    );

    sckPadrao = "utm_source=";

    if (parametroUTMSource) {
        sckPadrao += parametroUTMSource;
    } else {
        sckPadrao += "pg-vendas";
    }

    sckPadrao += "&utm_campaign=";

    if (parametroUTMCampaign) {
        sckPadrao += `&utm_campaign=${parametroUTMCampaign}`;
    } else {
        sckPadrao += campaignEvento(parametroCurso);
    }

    sckPadrao += "&utm_content=";

    if (parametroUTMContent) {
        sckPadrao += parametroUTMContent;
    } else {
        sckPadrao += "pg-vendas";
    }

    if (parametroUTMMedium) {
        sckPadrao += `&utm_medium=${parametroUTMMedium}`;
    }

    if (parametroUTMTerm) {
        sckPadrao += `&utm_term=${parametroUTMTerm}`;
    }

    sckPadrao += "&conversion=";

    if (parametroConversion) {
        sckPadrao += parametroConversion;
    } else {
        sckPadrao += conversionEvento(parametroCurso, parametroFonte);
    }

    console.log(`Não tem SCK na URL`);
}

console.log({ sckPadrao });

// ==================================================
// Montagem do SRC
// ==================================================
// Atualizar SRC se tiver algum parâmetro na URL
if (parametroSRC) {
    dicSrcPadrao = parametroSRC;
} else if (parametroFonte && parametroFonte === "clase") {
    dicSrcPadrao = "wadcap";
} else {
    if (parametroCurso == "excelcap") {
        if (parametroFonte === "semana") {
            dicSrcPadrao = "lexcap";
        } else {
            dicSrcPadrao = "lesexcap";
        }
    } else if (parametroCurso == "excelgs") {
        dicSrcPadrao = "lexcap-pgvendas";
    } else {
        dicSrcPadrao =
            dicSrcPadrao[parametroFonte] +
            dicCodigosCurso[parametroCurso] +
            "-pgvendas";
    }
}

// Incluir o tipo da página no SRC, se existir
if (parametroTipo) {
    dicSrcPadrao += "_" + parametroTipo;
}

// ==================================================
// Ajuste do formulario de precheckout
// ==================================================
// Trocar IDs formulário de pré-checkout
if (
    parametroFonte &&
    dicIDForm[parametroFonte] &&
    dicIDForm[parametroFonte][parametroCurso]
) {
    var numFormActive = dicIDForm[parametroFonte][parametroCurso];
    if (typeof numFormActive === "object") {
        numFormActive =
            numFormActive[parametroTipo] || numFormActive["default"];
    }

    if (numFormActive != formActive.id.replace("_form_", "").replace("_", "")) {
        document.querySelector("#" + formActive.id + "submit").id =
            "_form_" + numFormActive + "_submit";
        formActive.id = "_form_" + numFormActive + "_";
        document.querySelectorAll("[type=hidden]")[0].value = numFormActive;
        document.querySelectorAll("[type=hidden]")[1].value = numFormActive;

        console.log(`ID do formulário alterado para ${numFormActive}`);
    }
}

// ==================================================
// Ajuste visual do popup de precheckout
// ==================================================
// Ajustar cores do popup de pre-checkout
if (dicHueModeBotaoForm[parametroCurso]) {
    document.body.setAttribute(
        "style",
        `--hue-botao-form: ${dicHueModeBotaoForm[parametroCurso][0]}`,
    );
    document.body.setAttribute(dicHueModeBotaoForm[parametroCurso][1], "");
}

// ==================================================
// Eventos dos botoes
// ==================================================
if (parametroCurso && parametroCurso == "excelgs") {
    atribuirFuncoesBotao(elemsBotaoAvulsoPadrao, "ap", 0);
} else {
    atribuirFuncoesBotao(elemsBotaoAvulsoPadrao, "ap", 1);
}

setTimeout(function () {
    elemsBotaoOfertaCapacitaciones.forEach(function (elem) {
        elem.href =
            "https://hashaqui.com/capacitaciones/oferta" +
            window.location.search;
    });
}, 500);

// Botao fechar popup precheckout
elemsBotaoFechar.forEach(function (elem) {
    elem.href = "#";

    elem.addEventListener("click", function () {
        togglePopupAberto();
    });
});

// ==================================================
// Textos e precos promocionais
// ==================================================
// Deixar visiveis os textos que falam do desconto de lançamento
if (validacaoPrecoPromocional) {
    elemsTextoDesconto.forEach((elem) => {
        elem.classList.remove("oculto");
    });
}

// Acertar o texto "de preço por tal preço"
if (validacaoPrecoPromocional) {
    elemsPrecoDe.forEach((precoDe) => {
        precoDe.classList.remove("oculto");
        precoDe.innerHTML = '<span class="cortado">de 247 USD</span> por';
    });
}

// ==================================================
// Video dinamico
// ==================================================
// Trocando o SRC do vídeo da página para o src da fonte correta
if (elemVideo) {
    if (
        parametroFonte &&
        dicSRCVideo[parametroFonte] &&
        dicSRCVideo[parametroFonte][parametroCurso]
    ) {
        elemVideo.src = dicSRCVideo[parametroFonte][parametroCurso];
        console.log(`trocou o vídeo para ${elemVideo.src}`);
    } else {
        elemVideo.style.display = "none";
    }
}

// ==================================================
// Validacao do formulario
// ==================================================
// Funções para validar o formulário
const isRequired = (value) => (value === "" ? false : true);

const isEmailValid = (email) => {
    const re =
        /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
};

const isPhoneValid = (phone) => {
    // const re = /^\d{3,5}[-\s]?\d{3,4}[-\s]?\d{2,4}$/;
    const re = /^(?:\(?\d{2,4}\)?[\s.-]?)?\d{4,5}[\s.-]?\d{4}$/;
    return re.test(phone);
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

window.checkfullname = () => {
    let valid = false;
    const fullname = fullnameForm.value.trim();

    if (!isRequired(fullname)) {
        showError(fullnameForm, "Tu nombre no puede estar vacío.");
    } else {
        showSuccess(fullnameForm);
        valid = true;
    }
    return valid;
};

window.checkEmail = () => {
    let valid = false;
    const email = emailForm.value.trim();

    if (!isRequired(email)) {
        showError(emailForm, "Tu e-mail no puede estar vacío.");
    } else if (!isEmailValid(email)) {
        showError(emailForm, "El e-mail ingresado no es válido.");
    } else {
        showSuccess(emailForm);
        valid = true;
    }
    return valid;
};

const checkPhonePrefix = () => {
    // return countries.some((c) => c.code === inputValue);

    let valid = false;
    const prefix = prefixForm.value.trim();

    console.log("Checando prefixo");

    if (prefix === "") {
        showError(prefixForm, "Tu prefijo de país no puede estar vacío.");
    } else if (
        typeof countries !== "undefined" &&
        !countries.some((c) => c.code === prefix)
    ) {
        showError(prefixForm, "El prefijo de país ingresado no es válido.");
    } else {
        showSuccess(prefixForm);
        valid = true;
    }

    return valid;
};

const checkNationalPhone = () => {
    let valid = false;
    const nationalPhone = nationalPhoneForm.value.trim();

    console.log("Checando telefone");

    if (!isRequired(nationalPhone)) {
        showError(
            nationalPhoneForm,
            "Tu número de teléfono no puede estar vacío.",
        );
    } else if (!isPhoneValid(nationalPhone)) {
        showError(
            nationalPhoneForm,
            "El número de teléfono ingresado no es válido.",
        );
    } else {
        showSuccess(nationalPhoneForm);
        valid = true;
    }
    return valid;
};

window.checkFullPhone = () => {
    let valid = false;

    if (checkPhonePrefix() && checkNationalPhone()) {
        valid = true;
        buildPhone();
    }
    console.log("Checando telefone completo");
    console.log(checkNationalPhone());
    return valid;
};

const buildPhone = () => {
    const prefix = prefixForm.value.trim();
    const nationalPhone = nationalPhoneForm.value.trim();

    if (phoneForm) {
        phoneForm.value = prefix + nationalPhone;
        console.log(phoneForm.value);
    }
};

// ==================================================
// Validacao em tempo real
// ==================================================
formActive.addEventListener(
    "input",
    debounce(function (e) {
        switch (e.target.id) {
            case "fullname":
                window.checkfullname();
                break;
            case "email":
                window.checkEmail();
                break;
            case "prefix":
                checkPhonePrefix();
                break;
            case "national-phone":
                checkNationalPhone();
                break;
        }
    }),
);

// ==================================================
// Envio do formulario
// ==================================================
formActive.addEventListener("submit", function (e) {
    e.preventDefault();

    let isfullnameValid = window.checkfullname(),
        isEmailValid = window.checkEmail(),
        isPhoneValid = window.checkFullPhone();

    let isFormValid = isfullnameValid && isEmailValid && isPhoneValid;

    console.log(isFormValid);

    if (isFormValid) {
        enviarFormulario();
    }
});

// ==================================================
// Inicializacao
// ==================================================
document.addEventListener("DOMContentLoaded", aplicarPrecoFonte);
