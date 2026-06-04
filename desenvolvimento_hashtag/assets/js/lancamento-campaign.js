console.log("JS LANCAMENTO RODOU");

const gerarMesAno = (data) =>
    data.toLocaleString("default", { month: "short" }).substring(0, 3) +
    data.getFullYear().toString().substr(-2);

const campaignEvento = (parametroCurso) => {
    if (dominioCapacitaciones && !parametroCurso.includes("cap"))
        parametroCurso += "cap";

    return dictUTMCampaign[parametroCurso] ?? "";
};

const conversionEvento = (parametroCurso, parametroFonte) => {
    if (dominioCapacitaciones && !parametroCurso.includes("cap"))
        parametroCurso += "cap";

    // normalizar ExcelGS para usar tabela do ExcelCAP
    if (parametroCurso === "excelgscap") {
        parametroCurso = "excelcap";
    }

    if (parametroCurso === "ia") {
        parametroCurso = "iacap";
    }

    const dataHoje = new Date(
        new Date().toLocaleString("en-US", {
            timeZone: "America/Sao_Paulo",
        }),
    );

    let ehLancamento = ["intensivao", "semana", "jornada"].includes(
        parametroFonte,
    );

    let conversion = "";

    if (ehLancamento) {
        var tabelaLancamentoCurso = dictTabelaLancamentos[parametroCurso];
        var mesAnoConversion, nLancamento;

        if (tabelaLancamentoCurso) {
            mesAnoConversion = gerarMesAno(tabelaLancamentoCurso[0][1]);
            nLancamento = tabelaLancamentoCurso[0][0];

            var lancamentoAlterado = false;

            tabelaLancamentoCurso.forEach((listaCurso) => {
                var dataIni = listaCurso[1];
                var dataFim = listaCurso[2];
                var lancamento = listaCurso[0];

                // Comparando com a data de fim do lançamento + 1 dia
                if (
                    dataHoje.getTime() <
                        dataFim.getTime() + 1000 * 60 * 60 * 24 * 1 &&
                    !lancamentoAlterado
                ) {
                    mesAnoConversion = gerarMesAno(dataIni);

                    nLancamento = lancamento;
                    lancamentoAlterado = true;
                }
            });
        } else {
            ehLancamento = false;
        }
    }

    // Início do conversion
    ehLancamento ? (conversion += "lcto-") : (conversion += "perpetuo-");

    // Padrão da fonte: les, l, w, up_... / Default é "les"
    conversion += dicSrcPadrao[parametroFonte] ?? dicSrcPadrao["lespera"];

    // Padrão do curso / Default é o próprio curso
    conversion += dicCodigosCurso[parametroCurso] ?? parametroCurso;

    // Início do conversion
    ehLancamento ? (conversion += `${nLancamento}-${mesAnoConversion}`) : "";

    return conversion;
};

var dicCodigosCurso = {
    js: "js",
    excel: "ex",
    excel2: "ex",
    pa: "pa",
    sql: "sql",
    vba: "vba",
    ppt: "ppt",
    fe: "fe",
    com: "ci",
    prog: "prog",
    ing: "ing",
    fullstack: "fs",
    aws: "aws",
    ia: "ia",
    python: "py",
    vit: "vit",
    ss: "ss",
    excelcap: "excap",
    excelgs: "excelgs",
    iacap: "iacap",
    papps: "papps",
    hmp: "hmp",
    n8n: "n8n",
    exia: "exia",
    lov: "lov",
    pbi: "pbi",
};

dicCodigosCurso["ingles"] = dicCodigosCurso["ing"];
dicCodigosCurso["fullstack-imersao"] = dicCodigosCurso["fullstack"];

var dicSrcPadrao = {
    lespera: "les",
    perpetuo: "vtsd_",
    "perpetuo-vsl": "vsl",
    intensivao: "l",
    aula: "w",
    up: "up_",
    patrocinio: "vpi_",
    afiliado: "af_",
};

// Mesmo SRC para Jornada, Intensivão e Semana
dicSrcPadrao["jornada"] = dicSrcPadrao["intensivao"];
dicSrcPadrao["semana"] = dicSrcPadrao["intensivao"];

var dictTabelaLancamentos = {
    excelcap: [
        [
            "03",
            new Date("June 30 2025 GMT-0500"),
            new Date("July 11 2025 GMT-0500"),
        ],
        [
            "04",
            new Date("September 8 2025 GMT-0500"),
            new Date("September 19 2025 GMT-0500"),
        ],
        [
            "05",
            new Date("November 3 2025 GMT-0500"),
            new Date("November 14 2025 GMT-0500"),
        ],
        [
            "07",
            new Date("January 19 2026 GMT-0300"),
            new Date("February 04 2026 GMT-0300"),
        ],
        [
            "08",
            new Date("March 30 2026 GMT-0300"),
            new Date("April 10 2026 GMT-0300"),
        ],
        [
            "09",
            new Date("May 1 2026 GMT-0300"),
            new Date("May 24 2026 GMT-0300"),
        ],
    ],

    iacap: [
        [
            "01",
            new Date("June 10 2026 GMT-0500"),
            new Date("July 19 2026 GMT-0500"),
        ],
    ],
};

dictTabelaLancamentos["excelgs"] = dictTabelaLancamentos["excelcap"];

dictTabelaLancamentos["ingles"] = dictTabelaLancamentos["ing"];
dictTabelaLancamentos["fullstack-imersao"] = dictTabelaLancamentos["fullstack"];

var dictUTMCampaign = {
    python: "programacao",
    excel: "treinamento",
    pbi: "treinamento",
    ad: "treinamento",
    cd: "programacao",
    ia: "treinamento",
    vit: "vitalicio",
    ing: "idioma",
    fullstack: "programacao",
    vba: "programacao",
    aws: "programacao",
    ss: "treinamento",
    htmlcss: "programacao",
    js: "programacao",
    ppt: "treinamento",
    sql: "programacao",
    pa: "treinamento",
    excelcap: "capacitacion",
    excelgs: "capacitacion",
    iacap: "capacitacion",
    com: "geral",
    apps: "treinamento",
    hmp: "treinamento",
    n8n: "treinamento",
    exia: "treinamento",
    lov: "treinamento",
};

dictUTMCampaign["ingles"] = dictUTMCampaign["ing"];
dictUTMCampaign["fullstack-imersao"] = dictUTMCampaign["fullstack"];

var dominioCapacitaciones = window.location.hostname.includes(
    "hashtagcapacitaciones",
);

function adicionarConversionURL() {
    var parametrosURL = new URLSearchParams(window.location.search);

    if (parametrosURL.get("conversion")) {
        return;
    }
    var parametroCurso = parametrosURL.get("curso") || "iacap";
    var parametroFonte = parametrosURL.get("fonte") || "semana";
    var parametroConversion = conversionEvento(parametroCurso, parametroFonte);

    if (parametroConversion) {
        var url = new URL(window.location);
        url.searchParams.set("conversion", parametroConversion);
        window.history.pushState({}, "", url);
    }
}

adicionarConversionURL();
