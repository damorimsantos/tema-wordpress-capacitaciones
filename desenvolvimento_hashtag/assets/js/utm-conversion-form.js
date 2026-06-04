// function updateURLParam(param, value) {
//     var url = new URL(window.location);
//     url.searchParams.set(param, value);
//     window.history.pushState({}, "", url);
// }

// var parametrosURL = new URLSearchParams(window.location.search);
// var parametroOrigemURL = parametrosURL.get("origemurl");
// var parametroConversion = parametrosURL.get("conversion");
// var parametroUTMContent = parametrosURL.get("utm_content");
// var parametroUTMCampaign = parametrosURL.get("utm_campaign");

// var campoOrigemURL = document.querySelectorAll('[name="field[6]"]');
// var campoUTMContent = document.querySelectorAll('[name="field[138]"]');
// var campoUTMCampaign = document.querySelectorAll('[name="field[139]"]');
// var campoConversion = document.querySelectorAll('[name="field[134]"]');

// if (!parametroOrigemURL) {
//     parametroOrigemURL = "hashtag_";

//     if (paramFonte && paramFonte != "org") {
//         parametroOrigemURL += paramFonte;
//     } else {
//         parametroOrigemURL += "semana";
//     }

//     parametroOrigemURL += "_org_lesexcap";

//     updateURLParam("origemurl", parametroOrigemURL);

//     campoOrigemURL.forEach((campo) => {
//         campo.value = parametroOrigemURL;
//     });
// }

// if (!parametroUTMCampaign) {
//     parametroUTMCampaign = "capacitacion";

//     updateURLParam("utm_campaign", parametroUTMCampaign);

//     campoUTMCampaign.forEach((campo) => {
//         campo.value = parametroUTMCampaign;
//     });
// }

// if (!parametroUTMContent) {
//     parametroUTMContent = "excel/espera/inscripcion";

//     updateURLParam("utm_content", parametroUTMContent);

//     campoUTMContent.forEach((campo) => {
//         campo.value = parametroUTMContent;
//     });
// }

// // conversion -----------------------------------------------------------------

// const gerarMesAno = (data) =>
//     data.toLocaleString("default", { month: "short" }).substring(0, 3) +
//     data.getFullYear().toString().substr(-2);

// var dictTabelaLancamentos = {
//     excel: [
//     [
//         "01",
//         new Date("January 27 2025 GMT-0500"),
//         new Date("February 07 2025 GMT-0500"),
//     ],
//     [
//         "02",
//         new Date("March 31 2025 GMT-0500"),
//         new Date("April 11 2025 GMT-0500"),
//     ],
//     [
//         "03",
//         new Date("June 30 2025 GMT-0500"),
//         new Date("July 11 2025 GMT-0500"),
//     ],
//     [
//         "04",
//         new Date("September 8 2025 GMT-0500"),
//         new Date("September 19 2025 GMT-0500"),
//     ],
//     ],
// };

// const conversionEvento = () => {
//     const dataHoje = new Date(
//         new Date().toLocaleString("en-US", {
//             location: "America/Sao_Paulo",
//         })
//     );

//     let conversion = "";

//     var tabelaLancamentoCurso = dictTabelaLancamentos["excel"];
//     var mesAnoConversion, nLancamento;

//     if (tabelaLancamentoCurso) {
//         mesAnoConversion = gerarMesAno(tabelaLancamentoCurso[0][1]);
//         nLancamento = tabelaLancamentoCurso[0][0];

//         var lancamentoAlterado = false;

//         tabelaLancamentoCurso.forEach((listaCurso) => {
//             var dataIni = listaCurso[1];
//             var dataFim = listaCurso[2];
//             var lancamento = listaCurso[0];

//             // Comparando com a data de fim do lançamento + 1 dia
//             if (
//                 dataHoje.getTime() <
//                     dataFim.getTime() + 1000 * 60 * 60 * 24 * 1 &&
//                 !lancamentoAlterado
//             ) {
//                 mesAnoConversion = gerarMesAno(dataIni);

//                 nLancamento = lancamento;
//                 lancamentoAlterado = true;
//             }
//         });
//     }

//     conversion += "lcto-lexcap";
//     conversion += `${nLancamento}-${mesAnoConversion}`;

//     return conversion;
// };

// if (!parametroConversion) {
//     // só no formato de lançamentos por enquanto (fonte=semana)
//     //parametroConversion = `lcto-cap-lexcap02`;

//     parametroConversion = conversionEvento();
//     updateURLParam("conversion", parametroConversion);

//     campoConversion.forEach((campo) => {
//         campo.value = parametroConversion;
//     });
// }
