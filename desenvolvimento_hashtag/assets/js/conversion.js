console.log("SCRIPT CONVERSION");

(function () {
    function updateURLParam(param, value) {
        var url = new URL(window.location);
        url.searchParams.set(param, value);
        window.history.pushState({}, "", url);
    }

    function isBlogContext() {
        var body = document.body;
        if (!body) return false;

        if (
            body.classList.contains("pg-blog") ||
            body.classList.contains("pg-post")
        ) {
            return true;
        }

        var pathname = window.location.pathname.toLowerCase();

        if (pathname === "/blog" || pathname === "/blog/") {
            return true;
        }

        return false;
    }

    var campoConversion = document.querySelectorAll('[name="field[134]"]');

    // conversion -----------------------------------------------------------------

    const gerarMesAno = (data) =>
        data.toLocaleString("default", { month: "short" }).substring(0, 3) +
        data.getFullYear().toString().substr(-2);

    var dictTabelaLancamentos = {
        excel: [
            [
                "01",
                new Date("January 27 2025 GMT-0500"),
                new Date("February 07 2025 GMT-0500"),
            ],
            [
                "02",
                new Date("March 31 2025 GMT-0500"),
                new Date("April 11 2025 GMT-0500"),
            ],
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
        ],
    };

    const conversionEvento = () => {
        const dataHoje = new Date(
            new Date().toLocaleString("en-US", {
                location: "America/Sao_Paulo",
            })
        );

        let conversion = "";

        var tabelaLancamentoCurso = dictTabelaLancamentos["excel"];
        var mesAnoConversion, nLancamento;

        if (tabelaLancamentoCurso) {
            mesAnoConversion = gerarMesAno(tabelaLancamentoCurso[0][1]);
            nLancamento = tabelaLancamentoCurso[0][0];

            var lancamentoAlterado = false;

            tabelaLancamentoCurso.forEach((listaCurso) => {
                var dataIni = listaCurso[1];
                var dataFim = listaCurso[2];
                var lancamento = listaCurso[0];

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
        }

        conversion += "lcto-lexcap";
        conversion += `${nLancamento}-${mesAnoConversion}`;

        return conversion;
    };

    var parametroConversion = conversionEvento();

    if (!isBlogContext()) {
        updateURLParam("conversion", parametroConversion);
    }

    campoConversion.forEach((campo) => {
        campo.value = parametroConversion;
    });

    const elemsLinkExcel = document.querySelectorAll(
        ".url-curso-lancamento--excel"
    );

    if (elemsLinkExcel.length > 0) {
        elemsLinkExcel.forEach((elem) => {
            if (
                elem.getAttribute("href") &&
                elem.getAttribute("href") !== "#"
            ) {
                elem.href += `&conversion=${parametroConversion}`;
                console.log(elem);
                // console.log("Parâmetro conversion adicionado ao link" + elem);
            }
        });
    }
})();
