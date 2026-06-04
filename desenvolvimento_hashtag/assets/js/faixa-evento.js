(function () {
    if (window.__hcFaixaScriptLoaded) return;
    window.__hcFaixaScriptLoaded = true;

    function tzNow() {
        return new Date();
    }

    function inRange(date, start, end) {
        var time = date.getTime();
        return time >= start.getTime() && time <= end.getTime();
    }

    function onDomReady(callback) {
        if (document.readyState === "loading") {
            document.addEventListener("DOMContentLoaded", callback);
        } else {
            callback();
        }
    }

    function getHost() {
        return (window.location.hostname || "").toLowerCase();
    }

    function getPath() {
        return (window.location.pathname || "").toLowerCase();
    }

    function pathNormalizado() {
        return getPath().replace(/^\/+|\/+$/g, "");
    }

    function getSlug() {
        var partes = pathNormalizado().split("/");
        return partes.length ? partes[partes.length - 1] : "";
    }

    function parseCampaignDate(value) {
        var date = new Date(value);
        return isNaN(date.getTime()) ? null : date;
    }

    function hasBodyClass(className) {
        var body = document.body;
        return !!(body && body.classList && body.classList.contains(className));
    }

    function isWordPressAdminContext() {
        var path = getPath();
        var body = document.body;
        var bodyClasses = body && body.classList ? body.classList : null;

        if (
            path === "/wp-login.php" ||
            path.indexOf("/wp-login.php") === 0 ||
            path === "/wp-admin" ||
            path.indexOf("/wp-admin/") === 0
        ) {
            return true;
        }

        if (!bodyClasses) return false;

        return (
            bodyClasses.contains("wp-admin") ||
            bodyClasses.contains("wp-core-ui") ||
            bodyClasses.contains("login") ||
            bodyClasses.contains("wp-login")
        );
    }

    function isLocalhostHost(host) {
        return (
            host === "localhost" ||
            host === "127.0.0.1" ||
            host === "0.0.0.0" ||
            host.indexOf("localhost") !== -1
        );
    }

    function isMainDomainHost(host) {
        return (
            host === "hashtagcapacitaciones.com" ||
            host === "www.hashtagcapacitaciones.com"
        );
    }

    function detectarContexto() {
        var host = getHost();
        var slug = getSlug();
        var isLocalhost = isLocalhostHost(host);
        var isMainDomain = isMainDomainHost(host);
        var modo = "";

        if (isBlogContext()) {
            modo = "principal";
        }

        return {
            host: host,
            slug: slug,
            modo: modo,
            isLocalhost: isLocalhost,
            isMainDomain: isMainDomain,
        };
    }

    function getEstado(agora) {
        var inicio = parseCampaignDate("2026-04-27T00:00:00-03:00");
        var fim = parseCampaignDate("2026-05-15T23:59:59-03:00");

        if (!inicio || !fim || !inRange(agora, inicio, fim)) return null;

        return {
            titulo:
                "<strong>Excel Gran Salto</strong> | Aprende c&oacute;mo presentar tus an&aacute;lisis como un pro + ser eficiente en Excel usando la IA",
            botao: "M\u00e1s informaci\u00f3n",
            href: "https://lp.hashtagcapacitaciones.com/excel/gran-salto/inscripcion?curso=excelgs&fonte=semana&utm_source=site-org&utm_medium=blog-banner&utm_campaign=treinamento&utm_content=faixa-evento-blog&origemurl=hashtag_site_org_blog_banner_faixa_evento&conversion=lcto-lexcap09-mai26",
            exibirCronometro: false,
        };
    }

    function getHtmlFaixa() {
        return (
            "<style>" +
            "section.faixa-evento,section.faixa-evento *{padding:0;margin:0;box-sizing:border-box}" +
            "section.faixa-evento{display:flex;align-items:center;position:relative;z-index:11;width:100%;font-family:Montserrat,system-ui,sans-serif;padding:1.4rem 1.6rem;color:#000;font-weight:400;font-size:1.82rem;line-height:1.15;background-image:linear-gradient(to right,#ede02a,#ff8228)}" +
            "section.faixa-evento .faixa-evento__container{display:flex;max-width:1280px;width:100%;justify-content:center;flex-flow:row wrap;align-items:center;text-align:center;gap:1rem;row-gap:.5rem;margin:0 auto;padding:0}" +
            "section.faixa-evento .titulo-evento{font:inherit;line-height:1.15;text-wrap:pretty;max-width:88rem}" +
            "section.faixa-evento .titulo-evento strong,section.faixa-evento .titulo-evento span{font-weight:700}" +
            "section.faixa-evento .coluna-evento{display:flex;flex-flow:column;align-items:center;justify-content:center;gap:10.2px;flex:0 0 auto}" +
            "section.faixa-evento .link-evento{font:inherit;font-weight:500;text-decoration:none;padding:.6rem 1.28rem;border-radius:100vw;background-color:#2984f9;color:#fff;font-size:1.6rem;line-height:1;display:inline-flex;align-items:center;justify-content:center;min-height:3.2rem}" +
            "body.header--blog section.faixa-evento{position:sticky;top:var(--faixa-evento-top,0px);z-index:998;padding-inline:2rem}body.header--blog section.faixa-evento .faixa-evento__container{max-width:1280px}body.header--blog section.faixa-evento .titulo-evento{flex:1 1 36rem}body.header--blog section.faixa-evento .coluna-evento{align-items:flex-end}@media(max-width:930px){section.faixa-evento .faixa-evento__container{gap:.75rem}}@media(max-width:640px){section.faixa-evento{font-size:1.4rem;padding:1.4rem 1.6rem}section.faixa-evento .faixa-evento__container{max-width:36rem;gap:.6rem}section.faixa-evento .titulo-evento{max-width:none;line-height:1.2}section.faixa-evento .coluna-evento{width:100%;align-items:center}section.faixa-evento .link-evento{font-size:1.4rem;min-height:3.4rem;padding:.6rem 1.4rem}body.header--blog section.faixa-evento{padding-inline:1.2rem}}" +
            "</style>" +
            '<section class="faixa-evento"><div class="faixa-evento__container"><p class="titulo-evento"><strong>Excel Gran Salto</strong> | Aprende c\u00f3mo presentar tus an\u00e1lisis como un pro + ser eficiente en Excel usando la IA</p><div class="coluna-evento"><a class="link-evento" href="https://lp.hashtagcapacitaciones.com/excel/gran-salto/inscripcion?curso=excelgs&fonte=semana&utm_source=site-org&utm_medium=blog-banner&utm_campaign=treinamento&utm_content=faixa-evento-blog">M\u00e1s informaci\u00f3n</a></div></div></section>'
        );
    }

    function atualizarOffsetFaixa() {
        var header = document.querySelector("header.header") || document.querySelector("header");
        var body = document.body;
        var alturaHeader = header ? header.offsetHeight : 0;

        if (body && isBlogContext()) {
            body.style.setProperty("--faixa-evento-top", alturaHeader + "px");
        }
    }

    function removerFaixaExistente() {
        var faixa = document.querySelector("section.faixa-evento");
        var hero = document.querySelector("section.hero.hero-home");

        if (faixa && faixa.parentNode) {
            faixa.parentNode.removeChild(faixa);
        }

        if (hero && hero.classList) {
            hero.classList.remove("hero-home--com-faixa");
        }
    }

    function isBlogPage() {
        return hasBodyClass("pg-blog");
    }

    function isPostBlogPage() {
        return hasBodyClass("pg-post");
    }

    function isBlogContext() {
        return isBlogPage() || isPostBlogPage();
    }

    function inserirFaixa(contexto) {
        var header;
        var body = document.body;

        if (document.querySelector("section.faixa-evento")) {
            return document.querySelector("section.faixa-evento");
        }

        header =
            document.querySelector("header.header") ||
            document.querySelector("header");

        if (header && header.insertAdjacentHTML) {
            header.insertAdjacentHTML("afterend", getHtmlFaixa());
            return document.querySelector("section.faixa-evento");
        }

        if (body) {
            if (body.firstChild) {
                body.insertAdjacentHTML("afterbegin", getHtmlFaixa());
            } else {
                body.innerHTML = getHtmlFaixa();
            }
        }

        return document.querySelector("section.faixa-evento");
    }

    function atualizarFaixa(contexto, estado) {
        var faixa = inserirFaixa(contexto);
        var titulo;
        var btn;

        if (!faixa) return;

        faixa.className = "faixa-evento";

        atualizarOffsetFaixa();

        titulo = faixa.querySelector("p.titulo-evento");
        if (titulo) {
            titulo.innerHTML = estado.titulo;
        }

        btn = faixa.querySelector("a.link-evento");
        if (btn) {
            btn.textContent = estado.botao;
            btn.href = estado.href;
            btn.target = "_blank";
            btn.rel = "noopener";
        }
    }

    function montarFaixaSeNecessario() {
        if (window.__hcFaixaMounted) return;

        var agora = tzNow();
        var contexto = detectarContexto();
        var estado;

        if (!contexto.modo || !isBlogContext()) {
            removerFaixaExistente();
            return;
        }

        if (isWordPressAdminContext()) {
            removerFaixaExistente();
            return;
        }

        estado = getEstado(agora);

        if (!estado) {
            removerFaixaExistente();
            return;
        }

        window.__hcFaixaMounted = true;
        atualizarFaixa(contexto, estado);
    }

    onDomReady(function () {
        var contexto = detectarContexto();

        if (!contexto.modo || !isBlogContext()) {
            removerFaixaExistente();
            return;
        }

        if (isWordPressAdminContext()) {
            removerFaixaExistente();
            return;
        }

        montarFaixaSeNecessario();

        window.addEventListener("resize", atualizarOffsetFaixa);
        window.addEventListener("orientationchange", atualizarOffsetFaixa);
    });
})();
