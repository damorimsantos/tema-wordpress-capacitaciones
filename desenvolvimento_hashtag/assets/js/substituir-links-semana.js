(function () {
    console.log("SOBRESCREVENDO LINKS SEMANA EXCEL");
    const NOVO_LINK =
        "https://lp.hashtagcapacitaciones.com/excel/semana/espera?curso=excel&utm_source=site&utm_medium=curso-excel-gratis&utm_content=secao-header&utm_campaign=capacitacion";
    const SRC_EXCEL_GRATIS = "src=lesexcap-semana-site";
    const pathname = window.location.pathname.replace(/\/$/, "");
    const linkSemanaExcel = pathname.endsWith("/curso-excel-gratis")
        ? `${NOVO_LINK}&${SRC_EXCEL_GRATIS}`
        : NOVO_LINK;

    // document.addEventListener("DOMContentLoaded", () => {
    const btns = document.querySelectorAll(".botao-semana-excel");
    btns.forEach((btn) => {
        btn.setAttribute("href", linkSemanaExcel);
        console.log("link semana excel atualizado");
        btn.setAttribute("target", "_blank");
    });
    // });
})();
