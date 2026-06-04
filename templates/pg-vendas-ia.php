<!-- Modelo para a pagina Vendas IA -->

<?php
/*
Template name: Vendas IA
*/
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<script>
    var paramsURL = new URLSearchParams(window.location.search);
    var paramFonte = paramsURL.get("fonte");
    var paramRedir = paramsURL.get("redir");

    function updateURLParam(param, value) {
        var url = new URL(window.location);
        url.searchParams.set(param, value);
        window.history.pushState({}, "", url);
    }

    updateURLParam("curso", "iacap");
    updateURLParam("link", "ap");
    updateURLParam("pg", "pg-inscricao");
    updateURLParam("fonte", "semana");

    if (!paramRedir) {
        var today = new Date(
            new Date().toLocaleString("en-US", {
                timeZone: "America/Sao_Paulo",
            })
        );

        var dataCorte = [
            new Date("May 20 2026 18:00:00 GMT-0300"),
            new Date("May 26 2026 23:59:59 GMT-0300"),
        ];

        var dicSrc = {
            aula: "wnc-pgvendas",
            intensivao: "lnc-pgvendas",
        };

        dicSrc["jornada"] = dicSrc["intensivao"];

        var linkRedir = "https://www.hashtagtreinamentos.com/curso-ia?fonte=lespera";

        if (paramFonte && dicSrc[paramFonte]) {
            linkRedir += "&src=" + dicSrc[paramFonte];
        }

        if (
            paramsURL.size > 0 &&
            ["aula", "jornada", "intensivao"].includes(paramFonte)
        ) {
            var textoParametros = "";

            for (var paramURL of paramsURL) {
                if (paramURL[0] != "fonte") {
                    if (textoParametros != "") {
                        textoParametros += "&";
                    }

                    textoParametros += paramURL[0] + "=" + paramURL[1];
                }
            }

            textoParametros = encodeURI(textoParametros);

            if (paramsURL.has("src")) {
                linkRedir = linkRedir.replace(
                    "&src=" + dicSrc[paramFonte],
                    "&" + textoParametros
                );
            } else if (textoParametros) {
                linkRedir += "&" + textoParametros;
            }
        }

        if (["jornada", "intensivao"].includes(paramFonte)) {
            if (
                today.getTime() < dataCorte[0].getTime() ||
                today.getTime() > dataCorte[1].getTime()
            ) {
                window.location.replace(linkRedir);
            }
        }
    }
</script>

<!-- CSS -->
<link rel="stylesheet"
  href="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/sass/css/vendas-ia/style.css" />
<!-- <link rel="stylesheet" href="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/sass/css/style.css" /> -->

<script src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/js/auxiliares.js"></script>

<link rel="preconnect" href="https://player-vz-4f008646-5e1.tv.pandavideo.com.br">
<link rel="dns-prefetch" href="https://player-vz-4f008646-5e1.tv.pandavideo.com.br">

<?php wp_head(); ?>
<?php the_field('head', 'option'); ?>
</head>

<body>

<link rel="preconnect" href="https://player-vz-4f008646-5e1.tv.pandavideo.com.br">

<main>
    <section class="secao hero" id="form-inscricao">
        <div class="container">
            <div class="hero__topo">
                <div class="logo">
                    <img src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Global/logo-hashtag-escura.png" alt="Logo Hashtag">
                </div>

                <a class="hero__botao-topo" href="#secao-oferta">
                    <div>Quiero inscribirme</div>
                </a>
            </div>

            <h1 class="titulo">Mira el vídeo para que conozcas <span class="destaque">todo</span> sobre el <span class="destaque">programa completo IA Impresionante</span></h1>

            <iframe class="hero__video" src="https://player-vz-4f008646-5e1.tv.pandavideo.com.br/embed/?v=8c1a86e3-c9b6-49ea-81fc-c8b7d51bf196" style="border:none;" allow="accelerometer;gyroscope;autoplay;encrypted-media;picture-in-picture" allowfullscreen=true width="100%" height="100%" fetchpriority="high"></iframe>

            <a class="botao" href="#secao-oferta">
                <div>Quiero asegurar mi lugar</div>
            </a>
        </div>
    </section>

    <section class="secao ferramentas">
        <div class="container">
            <h2 class="titulo">Herramientas de IA que vas a aprender</h2>

            <ul class="lista">
                <li class="item">
                    <img src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/pg-vendas-liacap-temp/icone-chatgpt.svg" alt="">
                    <span>ChatGPT</span>
                </li>
                <li class="item">
                    <img src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/pg-vendas-liacap-temp/icone-claude.svg" alt="">
                    <span>Claude</span>
                </li>
                <li class="item">
                    <img src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/pg-vendas-liacap-temp/icone-copilot.svg" alt="">
                    <span>Copilot</span>
                </li>
                <li class="item">
                    <img src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/pg-vendas-liacap-temp/icone-gemini.svg" alt="">
                    <span>Gemini</span>
                </li>
                <li class="item">
                    <img src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/pg-vendas-liacap-temp/icone-grok.svg" alt="">
                    <span>Grok</span>
                </li>
                <li class="item">
                    <img src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/pg-vendas-liacap-temp/icone-manus.svg" alt="">
                    <span>Manus</span>
                </li>
                <li class="item">
                    <img src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/pg-vendas-liacap-temp/icone-perplexity.svg" alt="">
                    <span>Perplexity</span>
                </li>
                <li class="item">
                    <img src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/pg-vendas-liacap-temp/icone-notebooklm.svg" alt="">
                    <span>NotebookLM</span>
                </li>
                <li class="item">
                    <img src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/pg-vendas-liacap-temp/icone-gamma.svg" alt="">
                    <span>Gamma</span>
                </li>
                <li class="item">
                    <img src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/pg-vendas-liacap-temp/icone-midjourney.svg" alt="">
                    <span>Midjourney</span>
                </li>
                <li class="item item--magnific">
                    <img src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/pg-vendas-liacap-temp/icone-magnific.svg" alt="">
                    <span>Magnific</span>
                </li>
                <li class="item item--elevenlabs">
                    <img src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/pg-vendas-liacap-temp/icone-elevenlabs.svg" alt="">
                    <span>Eleven Labs</span>
                </li>
            </ul>

            <p class="paragrafo destaque">Y muchas más...</p>
            <p class="paragrafo">Y no te preocupes! Si surge una nueva herramienta de IA relevante, la desmenuzamos y grabamos nuevas clases para sumarlas al programa. Sin coste adicional para ti durante tu tiempo de acceso.</p>
        </div>
    </section>

    <section class="secao metodo">
        <div class="container">
            <h2 class="titulo">¿Por qué el <span class="destaque">método impresionante</span> va a revolucionar tu forma de aprender Inteligencia Artificial?</h2>

            <div class="metodo__grid">
                <div class="metodo__item metodo__item--domina">
                    <img class="metodo__check" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/pg-vendas-liacap-temp/metodo-check.svg" alt="">
                    <h3 class="titulo">Domina la IA</h3>
                    <p class="paragrafo">Aprende inteligencia artificial desde cero. Qué es, cómo funciona, sus principales herramientas y cuándo y cómo usar cada una.</p>
                    <p class="paragrafo">En Hashtag, tenemos más de 200.000 alumnos y podemos confirmar que uno aprende independientemente de su formación o edad.</p>
                </div>

                <div class="metodo__imagem">
                    <img src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/pg-vendas-liacap-temp/metodo.webp" alt="Metodo de aprendizado de IA Impresionante" loading="lazy">
                </div>

                <div class="metodo__item metodo__item--aplica">
                    <img class="metodo__check" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/pg-vendas-liacap-temp/metodo-check.svg" alt="">
                    <h3 class="titulo">Aplícalo en tu día a día</h3>
                    <p class="paragrafo">Aprende con ejemplos prácticos y utiliza las herramientas enseñadas en tu vida profesional y personal desde el módulo 1.</p>
                </div>

                <div class="metodo__item metodo__item--destaca">
                    <img class="metodo__check" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/pg-vendas-liacap-temp/metodo-check.svg" alt="">
                    <h3 class="titulo">Destaca en cualquier sector</h3>
                    <p class="paragrafo">La implementación de la IA es clave para optimizar procesos y maximizar la productividad en todos los sectores de una organización. Si tu empresa todavía no utiliza IA, estás ante la ventana de oportunidad perfecta para tomar la delantera.</p>
                </div>
            </div>
        </div>
    </section>

    <div class="fundo-publico-niveis">
        <section class="secao publico">
        <div class="container">
            <div class="publico__cima">
                <div class="publico__wrapper-textos">
                    <h2 class="titulo">¿Para quién es este curso?</h2>
                    <p class="paragrafo">Este curso esta pensado para:</p>
                </div>

                <div class="lista">
                    <div class="item">
                        <div class="item__icone">
                            <img src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/pg-vendas-liacap-temp/publico-1.svg" alt="">
                        </div>
                        <p class="paragrafo">Quienes desean aportar más valor a sus trabajos freelance o impulsar su propio negocio aprovechando todo el potencial de la IA</p>
                    </div>

                    <div class="item">
                        <div class="item__icone">
                            <img src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/pg-vendas-liacap-temp/publico-2.svg" alt="">
                        </div>
                        <p class="paragrafo">Quienes desean destacar ante las mejores empresas, incorporando la IA como una ventaja competitiva clave en su curriculum</p>
                    </div>

                    <div class="item">
                        <div class="item__icone">
                            <img src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/pg-vendas-liacap-temp/publico-3.svg" alt="">
                        </div>
                        <p class="paragrafo">Quienes desean destacar en su empleo actual gracias a sus conocimientos en inteligencia artificial</p>
                    </div>

                    <div class="item">
                        <div class="item__icone">
                            <img src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/pg-vendas-liacap-temp/publico-4.svg" alt="">
                        </div>
                        <p class="paragrafo">Quienes desean estar al tanto de la tecnología más importante de la actualidad de manera fácil y práctica</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

        <section class="secao niveis">
        <div class="container">
            <h2 class="titulo">Independientemente de tu nivel actual</h2>

            <div class="cards">
                <div class="card">
                    <img src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/pg-vendas-liacap-temp/nivel-1.webp" alt="Aulas para quien empieza desde cero" loading="lazy">
                    <h3 class="titulo">Cero</h3>
                    <p class="paragrafo">Si nunca has abierto ninguna herramienta de IA o si has intentado aprender pero no lo has logrado, este curso es para ti.</p>
                    <p class="paragrafo">Te enseñaremos TODO, desde cero, con una didáctica que no encontrarás en ningún otro curso. Aunque ahora no sepas nada, podrás aprender inteligencia artificial con nosotros.</p>
                </div>

                <div class="card">
                    <img src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/pg-vendas-liacap-temp/nivel-2.webp" alt="Aulas para principiantes" loading="lazy">
                    <h3 class="titulo">Principiante</h3>
                    <p class="paragrafo">Si estás empezando con ChatGPT u otra herramienta, pero todavía sientes que tu nivel es básico, este curso es perfecto para ti.</p>
                    <p class="paragrafo">Verás que ampliarás tus conocimientos y mejorarás tus habilidades con cualquier herramienta de IA de forma mucho más rápida. Cada semana aprenderás (y aprenderás de verdad) lo que sueles aprender en 1 mes de estudio. Y esto es posible debido a 3 pilares: didáctica, ejemplos reales y soporte de lunes a viernes de nuestro equipo de expertos.</p>
                </div>

                <div class="card">
                    <img src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/pg-vendas-liacap-temp/nivel-3.webp" alt="Aulas para quien quiere saber mas" loading="lazy">
                    <h3 class="titulo">Sabe algo más</h3>
                    <p class="paragrafo">Si usas herramientas de IA a diario, en este curso, encontrarás lo que necesitas para destacar en tu carrera profesional.</p>
                    <p class="paragrafo">Eso porque el programa IA Impresionante está 100% enfocado en el mundo laboral. Entonces, aprenderás qué herramientas usar en cada tarea para obtener los mejores resultados, ya sea en la elaboración de documentos, el diseño de presentaciones o el análisis de datos.</p>
                </div>
            </div>
        </div>
    </section>

    </div>

    <section class="secao depoimentos largura-total destacar">
        <h2 class="titulo">
            Testimonios de algunos de nuestros alumnos de <span class="destaque">IA Impressionadora</span> <span class="weight-normal">(este mismo curso, pero en portugués)</span>
        </h2>

        <div class="carrossel carrossel--automatico largura-total">
            <div class="carrossel__controles">
                <div class="carrossel__seta">
                    <svg viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M13.8282 6.28275H3.62507L8.31164 1.59618L7.12113 0.414062L0.414062 7.12113L7.12113 13.8282L8.30325 12.6461L3.62507 7.95952H13.8282V6.28275Z" fill="currentColor" />
                    </svg>
                </div>

                <div class="carrossel__seta">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" fill="none">
                        <path d="M6.87895 0.414062L5.69682 1.59618L10.375 6.28275H0.171875V7.95952H10.375L5.69682 12.6461L6.87895 13.8282L13.586 7.12113L6.87895 0.414062Z" fill="currentColor" />
                    </svg>
                </div>
            </div>

            <div class="carrossel__track carrossel__track--mask-duplo destacar__carrossel">
                <div class="destacar__item">
                    <div class="destacar__video">
                        <img loading="lazy" src="" fakeSRC="7yX3yZojrto" alt="Testimonio de Guillermo Santacoloma" title="Testimonio de Guillermo Santacoloma" />
                        <svg aria-hidden="true" class="e-font-icon-svg e-eicon-play" viewBox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg">
                            <path d="M838 162C746 71 633 25 500 25 371 25 258 71 163 162 71 254 25 367 25 500 25 633 71 746 163 837 254 929 367 979 500 979 633 979 746 933 838 837 929 746 975 633 975 500 975 367 929 254 838 162M808 192C892 279 933 379 933 500 933 621 892 725 808 808 725 892 621 938 500 938 379 938 279 896 196 808 113 725 67 621 67 500 67 379 108 279 196 192 279 108 383 62 500 62 621 62 721 108 808 192M438 392V642L642 517 438 392Z"></path>
                        </svg>
                    </div>

                    <div class="destacar__texto">
                        "Me demoraba casi dos semanas en tomar las decisiones y analizar y organizar todo. Ahora, ya no me demoro sino máximo 2 días. Se han sentido agradecidos con mi trabajo y recibí un aumento salarial."
                        <span class="destacar__nome">Guillermo Santacoloma 🇨🇴</span>
                    </div>
                </div>

                <div class="destacar__item">
                    <div class="destacar__video">
                        <img loading="lazy" src="" fakeSRC="fs8vzbN_THo" alt="Testimonio de Verónica del Río" title="Testimonio de Verónica del Río" />
                        <svg aria-hidden="true" class="e-font-icon-svg e-eicon-play" viewBox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg">
                            <path d="M838 162C746 71 633 25 500 25 371 25 258 71 163 162 71 254 25 367 25 500 25 633 71 746 163 837 254 929 367 979 500 979 633 979 746 933 838 837 929 746 975 633 975 500 975 367 929 254 838 162M808 192C892 279 933 379 933 500 933 621 892 725 808 808 725 892 621 938 500 938 379 938 279 896 196 808 113 725 67 621 67 500 67 379 108 279 196 192 279 108 383 62 500 62 621 62 721 108 808 192M438 392V642L642 517 438 392Z"></path>
                        </svg>
                    </div>

                    <div class="destacar__texto">
                        "La planilla que pude crear gracias al curso redundó en un menor costo y en una mayor rentabilidad para la consultora. Y también los clientes salen mucho más satisfechos."
                        <span class="destacar__nome">Verónica del Río 🇦🇷</span>
                    </div>
                </div>

                <div class="destacar__item">
                    <div class="destacar__video">
                        <img loading="lazy" src="" fakeSRC="uJeb1Oh7Xu8" alt="Testimonio de Enriqueta García" title="Testimonio de Enriqueta García" />
                        <svg aria-hidden="true" class="e-font-icon-svg e-eicon-play" viewBox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg">
                            <path d="M838 162C746 71 633 25 500 25 371 25 258 71 163 162 71 254 25 367 25 500 25 633 71 746 163 837 254 929 367 979 500 979 633 979 746 933 838 837 929 746 975 633 975 500 975 367 929 254 838 162M808 192C892 279 933 379 933 500 933 621 892 725 808 808 725 892 621 938 500 938 379 938 279 896 196 808 113 725 67 621 67 500 67 379 108 279 196 192 279 108 383 62 500 62 621 62 721 108 808 192M438 392V642L642 517 438 392Z"></path>
                        </svg>
                    </div>

                    <div class="destacar__texto">
                        "Generé tablas dinámicas y solucioné la situación en 15 minutos. Mi jefa me llamó y me dijo que estaba muy contenta conmigo."
                        <span class="destacar__nome">Enriqueta García 🇲🇽</span>
                    </div>
                </div>

                <div class="destacar__item">
                    <div class="destacar__video">
                        <img loading="lazy" src="" fakeSRC="jtN7mreha7E" alt="Testimonio de Barbara Vega" title="Testimonio de Barbara Vega" />
                        <svg aria-hidden="true" class="e-font-icon-svg e-eicon-play" viewBox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg">
                            <path d="M838 162C746 71 633 25 500 25 371 25 258 71 163 162 71 254 25 367 25 500 25 633 71 746 163 837 254 929 367 979 500 979 633 979 746 933 838 837 929 746 975 633 975 500 975 367 929 254 838 162M808 192C892 279 933 379 933 500 933 621 892 725 808 808 725 892 621 938 500 938 379 938 279 896 196 808 113 725 67 621 67 500 67 379 108 279 196 192 279 108 383 62 500 62 621 62 721 108 808 192M438 392V642L642 517 438 392Z"></path>
                        </svg>
                    </div>

                    <div class="destacar__texto">
                        "Yo, personalmente, uso Excel todos los días y, no solo me está ayudando a que haga reportes más completos o análisis de datos más rápidos, también me está ayudando a la seguridad que tengo a la hora de presentar mi trabajo."
                        <span class="destacar__nome">Barbara Vega 🇦🇷</span>
                    </div>
                </div>

                <div class="destacar__item">
                    <div class="destacar__video">
                        <img loading="lazy" src="" fakeSRC="zBfeCxp7zPA" alt="Testimonio de Jesús Agüero" title="Testimonio de Jesús Agüero" />
                        <svg aria-hidden="true" class="e-font-icon-svg e-eicon-play" viewBox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg">
                            <path d="M838 162C746 71 633 25 500 25 371 25 258 71 163 162 71 254 25 367 25 500 25 633 71 746 163 837 254 929 367 979 500 979 633 979 746 933 838 837 929 746 975 633 975 500 975 367 929 254 838 162M808 192C892 279 933 379 933 500 933 621 892 725 808 808 725 892 621 938 500 938 379 938 279 896 196 808 113 725 67 621 67 500 67 379 108 279 196 192 279 108 383 62 500 62 621 62 721 108 808 192M438 392V642L642 517 438 392Z"></path>
                        </svg>
                    </div>

                    <div class="destacar__texto">
                        "Comencé a tener beneficios muy rápidamente. Ya desde felicitaciones de mis compañeros, pasando por mis superiores directos hasta llegar a la cúpula directiva de la empresa."
                        <span class="destacar__nome">Jesús Agüero 🇦🇷</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="secao comparacao">
        <div class="container">
            <div class="comparacao__tabela">
                <div class="comparacao__cabecalho comparacao__cabecalho--antes">
                    Antes de IA Impresionante
                </div>

                <div class="comparacao__cabecalho comparacao__cabecalho--depois">
                    Despues de IA Impresionante
                </div>

                <div class="comparacao__linha">
                    <div class="comparacao__item comparacao__item--antes">
                        <p class="comparacao__titulo-mobile">Antes de IA Impresionante</p>
                        <img src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/pg-vendas-liacap-temp/comparacao-menos.svg" alt="">
                        <p>Escuchas a alguien de tu trabajo hablando sobre una herramienta nueva que empezó a utilizar y los resultados fantásticos que logró, pero no tienes idea de qué habla</p>
                    </div>
                    <div class="comparacao__item comparacao__item--depois">
                        <p class="comparacao__titulo-mobile">
                            <img src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/pg-vendas-liacap-temp/comparacao-logo.svg" alt="">
                            Despues de IA Impresionante
                        </p>
                        <img class="comparacao__check" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/pg-vendas-liacap-temp/comparacao-check.svg" alt="">
                        <p>Eres tú la persona que prueba y propone el uso de una herramienta nueva en tu trabajo</p>
                    </div>
                </div>

                <div class="comparacao__linha">
                    <div class="comparacao__item comparacao__item--antes">
                        <p class="comparacao__titulo-mobile">Antes de IA Impresionante</p>
                        <img src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/pg-vendas-liacap-temp/comparacao-menos.svg" alt="">
                        <p>Ves las publicaciones en LinkedIn de alguien que automatizó un proceso en su trabajo y solo te queda felicitarlo</p>
                    </div>
                    <div class="comparacao__item comparacao__item--depois">
                        <p class="comparacao__titulo-mobile">
                            <img src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/pg-vendas-liacap-temp/comparacao-logo.svg" alt="">
                            Despues de IA Impresionante
                        </p>
                        <img class="comparacao__check" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/pg-vendas-liacap-temp/comparacao-check.svg" alt="">
                        <p>Tú publicas los logros obtenidos al implementar IA para automatizar tus procesos</p>
                    </div>
                </div>

                <div class="comparacao__linha">
                    <div class="comparacao__item comparacao__item--antes">
                        <p class="comparacao__titulo-mobile">Antes de IA Impresionante</p>
                        <img src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/pg-vendas-liacap-temp/comparacao-menos.svg" alt="">
                        <p>Trabajas de forma manual, invirtiendo horas o días enteros en crear planillas, reportes y presentaciones que cumplen su función, pero carecen de impacto</p>
                    </div>
                    <div class="comparacao__item comparacao__item--depois">
                        <p class="comparacao__titulo-mobile">
                            <img src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/pg-vendas-liacap-temp/comparacao-logo.svg" alt="">
                            Despues de IA Impresionante
                        </p>
                        <img class="comparacao__check" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/pg-vendas-liacap-temp/comparacao-check.svg" alt="">
                        <p>Trabajas de manera automatizada utilizando agentes que crean planillas, reportes y presentaciones impactantes rápidamente para ti</p>
                    </div>
                </div>

                <div class="comparacao__linha">
                    <div class="comparacao__item comparacao__item--antes">
                        <p class="comparacao__titulo-mobile">Antes de IA Impresionante</p>
                        <img src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/pg-vendas-liacap-temp/comparacao-menos.svg" alt="">
                        <p>Abres ChatGPT para hacerle preguntas como si fuera Google y desaprovechas más del 90% de su potencial</p>
                    </div>
                    <div class="comparacao__item comparacao__item--depois">
                        <p class="comparacao__titulo-mobile">
                            <img src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/pg-vendas-liacap-temp/comparacao-logo.svg" alt="">
                            Despues de IA Impresionante
                        </p>
                        <img class="comparacao__check" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/pg-vendas-liacap-temp/comparacao-check.svg" alt="">
                        <p>Abres ChatGPT y sabes exactamente qué recurso utilizar para sacarle el máximo provecho con el prompt adecuado</p>
                    </div>
                </div>

                <div class="comparacao__linha">
                    <div class="comparacao__item comparacao__item--antes">
                        <p class="comparacao__titulo-mobile">Antes de IA Impresionante</p>
                        <img src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/pg-vendas-liacap-temp/comparacao-menos.svg" alt="">
                        <p>Puedes realizar 1 o 2 trabajos freelance en paralelo, dependiendo del alcance del proyecto y de tu disponibilidad</p>
                    </div>
                    <div class="comparacao__item comparacao__item--depois">
                        <p class="comparacao__titulo-mobile">
                            <img src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/pg-vendas-liacap-temp/comparacao-logo.svg" alt="">
                            Despues de IA Impresionante
                        </p>
                        <img class="comparacao__check" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/pg-vendas-liacap-temp/comparacao-check.svg" alt="">
                        <p>Multiplicas tus posibilidades de ingresos adicionales poniendo a la IA a prospectar, trabajar y gestionar por ti</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="scroller-ia infinite-scroller" aria-label="Hashtag Capacitaciones IA Impresionante">
        <div class="scroller-ia__lista">
            <span class="scroller-ia__item">
                <img src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Global/logo-h.webp" alt="">
                <span>Hashtag Capacitaciones | IA Impresionante</span>
            </span>
            <span class="scroller-ia__item">
                <img src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Global/logo-h.webp" alt="">
                <span>Hashtag Capacitaciones | IA Impresionante</span>
            </span>
            <span class="scroller-ia__item">
                <img src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Global/logo-h.webp" alt="">
                <span>Hashtag Capacitaciones | IA Impresionante</span>
            </span>
            <span class="scroller-ia__item">
                <img src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Global/logo-h.webp" alt="">
                <span>Hashtag Capacitaciones | IA Impresionante</span>
            </span>
        </div>
    </div>

    <section class="secao programa">
        <div class="container">
            <h2 class="titulo">El programa completo IA Impresionante incluye</h2>

            <div class="programa__cards programa__cards--principais">
                <div class="programa__card programa__card--principal">
                    <div class="programa__icone programa__icone--principal">
                        <img src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/pg-vendas-liacap-temp/programa-video.svg" alt="">
                    </div>
                    <h3 class="titulo">1 año de acceso al curso IA Impresionante</h3>
                    <p class="paragrafo">Más de 30h de contenido, más de 20 herramientas y constantes actualizaciones.</p>
                    <img class="programa__imagem programa__imagem--curso" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/pg-vendas-liacap-temp/programa-1.webp" alt="Curso IA Impresionante" loading="lazy">
                </div>

                <div class="programa__card programa__card--principal">
                    <div class="programa__icone programa__icone--principal">
                        <img src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/pg-vendas-liacap-temp/programa-livro.svg" alt="">
                    </div>
                    <h3 class="titulo">Material didáctico y soporte a dudas</h3>
                    <p class="paragrafo">Guía digital con el paso a paso del contenido del curso y archivos para practicar y soporte diario de nuestro equipo de expertos.</p>
                    <img class="programa__imagem programa__imagem--material" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/pg-vendas-liacap-temp/programa-2.webp" alt="Material didactico IA Impresionante" loading="lazy">
                </div>

                <div class="programa__card programa__card--principal">
                    <div class="programa__icone programa__icone--principal">
                        <img src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/pg-vendas-liacap-temp/programa-certificado.svg" alt="">
                    </div>
                    <h3 class="titulo">Certificado de finalización</h3>
                    <p class="paragrafo">Al final del curso, obtendrás un certificado de nivel avanzado que podrás presentar en cualquier empresa.</p>
                    <img class="programa__imagem programa__imagem--certificado" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/pg-vendas-liacap-temp/programa-3.webp" alt="Certificado IA Impresionante" loading="lazy">
                </div>
            </div>

            <div class="programa__bonus-faixa">
                <img src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/pg-vendas-liacap-temp/programa-presente.svg" alt="">
                <span>+ 4 Bonus exclusivos:</span>
            </div>

            <div class="programa__cards programa__cards--bonus">
                <div class="programa__card programa__card--bonus">
                    <div class="programa__icone programa__icone--bonus">
                        <img src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/pg-vendas-liacap-temp/bonus-prompts.svg" alt="">
                    </div>
                    <h4 class="titulo">Prompts avanzados</h4>
                    <p class="paragrafo">Accede a una biblioteca con más de 200 prompts listos para usar en tu día a día y logra resultados impresionantes.</p>
                </div>

                <div class="programa__card programa__card--bonus">
                    <div class="programa__icone programa__icone--bonus">
                        <img src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/pg-vendas-liacap-temp/bonus-automacao.svg" alt="">
                    </div>
                    <h4 class="titulo">Proyecto de automatización con N8N</h4>
                    <p class="paragrafo">Un proyecto completo para crear un agente con n8n y automatizar la interacción con tus clientes vía correo electrónico.</p>
                </div>

                <div class="programa__card programa__card--bonus">
                    <div class="programa__icone programa__icone--bonus">
                        <img src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/pg-vendas-liacap-temp/bonus-lovable.svg" alt="">
                    </div>
                    <h4 class="titulo">2 proyectos en Lovable</h4>
                    <p class="paragrafo">2 proyectos completos, desde cero y paso a paso, en Lovable, para crear dashboards y sitios web sin saber programar.</p>
                </div>

                <div class="programa__card programa__card--bonus">
                    <div class="programa__icone programa__icone--bonus">
                        <img src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/pg-vendas-liacap-temp/bonus-acesso.svg" alt="">
                    </div>
                    <h4 class="titulo">1 año de acceso adicional</h4>
                    <p class="paragrafo">¡Todo lo que incluye esta oferta por 12 meses más!</p>
                </div>
            </div>

            <a class="botao" href="#secao-oferta">
                <div>Quiero asegurar mi lugar</div>
            </a>
        </div>
    </section>

    <section class="secao ementa">
        <div class="container">
            <h2 class="titulo">Temario completo de <span class="destaque">IA Impresionante</span></h2>

            <div class="acordeao-html">
                <ul class="accordeon accordeon-ementa">
                    <li class="accordeon-item">
                        <a class="accordeon-title" href="#"><p>Módulo 1 - Conceptos generales <span>(8 clases)</span></p></a>
                        <div class="accordeon-content">
                            <p>Fundamentos esenciales para entender qué es la IA y usarla con criterio profesional.</p>
                            <ol>
                                <li>Qué es la inteligencia artificial (IA)</li>
                                <li>Cómo te ayuda y los tipos de IA generativa</li>
                                <li>Cómo piensa, aprende y funciona</li>
                                <li>Los cuidados al utilizar la IA en tu día a día</li>
                                <li>Grandes hallazgos de la IA</li>
                                <li>Cuándo usar y no usar la IA</li>
                                <li>[Opcional] La historia de la IA - Hasta el principio del siglo XX</li>
                                <li>[Opcional] La historia de la IA - Desde el siglo XX hasta la actualidad</li>
                            </ol>
                        </div>
                    </li>
                    <li class="accordeon-item">
                        <a class="accordeon-title" href="#"><p>Módulo 2 - Lo esencial de ChatGPT <span>(16 clases)</span></p></a>
                        <div class="accordeon-content">
                            <p>Dominio completo de ChatGPT, la herramienta más popular del mercado.</p>
                            <ol>
                                <li>Primer acceso y tus primeros prompts</li>
                                <li>Interfaz de ChatGPT</li>
                                <li>Configuraciones de ChatGPT</li>
                                <li>Generación de imágenes</li>
                                <li>Dictar y Modo de voz</li>
                                <li>Todo lo que puedes añadir a tu prompt</li>
                                <li>Investigación a fondo</li>
                                <li>Modo Canvas</li>
                                <li>Busca en la web, Estudia y aprende y Compras</li>
                                <li>Modo de agente</li>
                                <li>Integraciones</li>
                                <li>Prompt de sistema</li>
                                <li>Proyectos</li>
                                <li>GPTs</li>
                                <li>Prompt maestro</li>
                                <li>Planes de ChatGPT</li>
                            </ol>
                        </div>
                    </li>
                    <li class="accordeon-item">
                        <a class="accordeon-title" href="#"><p>Módulo 3 - Principios de Ingeniería de Prompt — Prompt Avanzado <span>(15 clases)</span></p></a>
                        <div class="accordeon-content">
                            <p>Las técnicas para que tus prompts produzcan resultados brillantes y no genéricos.</p>
                            <ol>
                                <li>Qué es la ingeniería de prompt</li>
                                <li>La estructura de un buen prompt</li>
                                <li>Prompts malos x prompts elaborados</li>
                                <li>Técnicas de ingeniería de prompts: meta prompting</li>
                                <li>Técnicas de ingeniería de prompts: zero shot y few shot</li>
                                <li>Técnicas de ingeniería de prompts: cadena de pensamiento</li>
                                <li>Técnicas de ingeniería de prompts: autoconsistencia</li>
                                <li>Técnicas de ingeniería de prompts: indicadores de conocimiento</li>
                                <li>Técnicas de ingeniería de prompts: cadena de instrucciones</li>
                                <li>Técnicas de ingeniería de prompts: árbol de pensamiento</li>
                                <li>[Opcional] Técnicas de ingeniería de prompts: generación aumentada por recuperación (RAG)</li>
                                <li>[Opcional] Técnicas de ingeniería de prompts: ingeniero de prompts automático</li>
                                <li>[Opcional] Técnicas de ingeniería de prompts: prompting activo</li>
                                <li>Técnicas de ingeniería de prompts: directional stimulus prompting</li>
                                <li>[Opcional] Técnicas de ingeniería de prompts: reflexión</li>
                            </ol>
                        </div>
                    </li>
                    <li class="accordeon-item">
                        <a class="accordeon-title" href="#"><p>Módulo 4 - Las IAs de Google <span>(15 clases)</span></p></a>
                        <div class="accordeon-content">
                            <p>Cómo aprovechar Gemini junto con todas las integraciones del ecosistema Google.</p>
                            <ol>
                                <li>Infos iniciales, recursos, modelos y planes</li>
                                <li>Prompteando con Gemini</li>
                                <li>Deep Research, aprendizaje guiado y Diseño Visual</li>
                                <li>Canvas</li>
                                <li>Gems</li>
                                <li>Generación de Imágenes y Vídeos</li>
                                <li>Integraciones de Google con Gemini: Google Sheets</li>
                                <li>Integraciones de Google con Gemini: Google Slides</li>
                                <li>Integraciones de Google con Gemini: Google Docs</li>
                                <li>Integraciones de Google con Gemini: Google Drive</li>
                                <li>Integraciones de Google con Gemini: Google Calendar</li>
                                <li>Integraciones de Google con Gemini: Gmail</li>
                                <li>Integraciones de Google con Gemini: Google Meet</li>
                                <li>Presentación de la Interfaz (NotebookLM)</li>
                                <li>Tipos de Materiales Generables (NotebookLM)</li>
                            </ol>
                        </div>
                    </li>
                    <li class="accordeon-item">
                        <a class="accordeon-title" href="#"><p>Módulo 5 - La IA de Microsoft — Copilot <span>(7 clases)</span></p></a>
                        <div class="accordeon-content">
                            <p>Copilot integrado en todo el ecosistema Microsoft 365.</p>
                            <ol>
                                <li>Infos iniciales, recursos y planes</li>
                                <li>Modelos y apartados especiales</li>
                                <li>Herramientas de Copilot</li>
                                <li>Integraciones de Copilot: Excel</li>
                                <li>Integraciones de Copilot: PowerPoint</li>
                                <li>Integraciones de Copilot: Word</li>
                                <li>Los agentes de Copilot</li>
                                <li>Caso práctico de creación de un agente</li>
                            </ol>
                        </div>
                    </li>
                    <li class="accordeon-item">
                        <a class="accordeon-title" href="#"><p>Módulo 6 - La IA más humana — Claude <span>(19 clases)</span></p></a>
                        <div class="accordeon-content">
                            <p>Claude a fondo, una de las IAs más potentes y mejor diseñadas del mercado.</p>
                            <ol>
                                <li>Infos iniciales y recursos</li>
                                <li>Planes de Claude</li>
                                <li>Primer Acceso y presentación de la interfaz</li>
                                <li>Configuraciones de Claude</li>
                                <li>Los modelos de Claude: Haiku, Sonnet y Opus</li>
                                <li>Creación de Documentos y Otros: Los Artefactos de Claude</li>
                                <li>Los diagramas de Claude</li>
                                <li>Subiendo Archivos a Claude</li>
                                <li>¿Qué son las Habilidades de Claude?</li>
                                <li>Caso Práctico 1: Creación de Habilidad</li>
                                <li>Caso Práctico 2: Creación de Habilidad Avanzada</li>
                                <li>Proyectos en Claude</li>
                                <li>Claude desde Chrome</li>
                                <li>Instalando Claude en tu Computadora</li>
                                <li>Claude Cowork</li>
                                <li>Claude en Excel</li>
                                <li>Claude en PowerPoint</li>
                                <li>Claude en Word</li>
                                <li>Claude Design</li>
                            </ol>
                        </div>
                    </li>
                    <li class="accordeon-item">
                        <a class="accordeon-title" href="#"><p>Módulo 7 - Otras Herramientas de IA <span>(11 clases)</span></p></a>
                        <div class="accordeon-content">
                            <p>Panorama de herramientas especializadas para tareas específicas.</p>
                            <ol>
                                <li>Grok - La IA de Twitter (actual X)</li>
                                <li>Deepseek - La IA china</li>
                                <li>Perplexity AI - La IA para investigaciones</li>
                                <li>Manus - El agente pionero</li>
                                <li>Manus - Ejemplos de qué puede hacer</li>
                                <li>QuillBot - La IA para escritura</li>
                                <li>ElevenLabs - Texto para audio</li>
                                <li>Suno - Creación de músicas con IA</li>
                                <li>Wispr Flow - Transcripción a texto</li>
                                <li>Arena IA - Compara modelos lado a lado</li>
                                <li>Goblin Tools - Herramientas prácticas para tu día a día</li>
                            </ol>
                        </div>
                    </li>
                    <li class="accordeon-item">
                        <a class="accordeon-title" href="#"><p>Módulo 8 - Generación de Imágenes con IA <span>(19 clases)</span></p></a>
                        <div class="accordeon-content">
                            <p>Crea imágenes profesionales con IA desde cero, sin saber diseñar.</p>
                            <ol>
                                <li>Los principales generadores de imágenes, sus costes, ventajas y desventajas</li>
                                <li>El método sencillo</li>
                                <li>El método Blueprint</li>
                                <li>El método narrativo</li>
                                <li>El método de apilamiento</li>
                                <li>El método de dirección cinematográfica</li>
                                <li>Cómo insertarte en una imagen de IA</li>
                                <li>Buscando inspiraciones</li>
                                <li>Creación de imágenes con Midjourney: Primeros pasos</li>
                                <li>Creación de imágenes con Midjourney: Jugueteando con las configuraciones</li>
                                <li>Creación de imágenes con Midjourney: Prompts con imágenes</li>
                                <li>Creación de imágenes con Midjourney: Los estilos y moodboards</li>
                                <li>Creación de imágenes con Midjourney: Configuraciones de cuenta y planes</li>
                                <li>[Opcional] Creación de imágenes con Midjourney: Creación con parámetros</li>
                                <li>Creación de imágenes con FreePik: Primeros pasos</li>
                                <li>Creación de imágenes con FreePik: Generación de imágenes al detalle</li>
                                <li>Creación de imágenes con FreePik: Todo lo que puedes hacer con una imagen en FreePik</li>
                                <li>Creación de imágenes con FreePik: Planes disponibles</li>
                                <li>Creación de imágenes con Higgsfield</li>
                            </ol>
                        </div>
                    </li>
                    <li class="accordeon-item">
                        <a class="accordeon-title" href="#"><p>Módulo 9 - Generación de Vídeos con IA <span>(14 clases)</span></p></a>
                        <div class="accordeon-content">
                            <p>Generación de videos con IA, una de las áreas que más rápido está evolucionando.</p>
                            <ol>
                                <li>Introducción a la generación de vídeos con IA</li>
                                <li>La anatomía de un buen prompt: Sujeto, Acción, Entorno y Contexto</li>
                                <li>La anatomía de un buen prompt: Movimientos de cámara</li>
                                <li>La anatomía de un buen prompt: Iluminación, Ritmo, Estilo Visual, Encuadre y Duración</li>
                                <li>Tipos de generación de vídeos: Texto a Vídeo</li>
                                <li>Tipos de generación de vídeos: Imagen a Vídeo</li>
                                <li>Tipos de generación de vídeos: Vídeo a Vídeo</li>
                                <li>Qué flujo elegir al momento de generar</li>
                                <li>Creación de vídeos con Midjourney</li>
                                <li>Creación de vídeos con Higgsfield</li>
                                <li>Pensando antes de generar: el frameboard</li>
                                <li>Coherencia narrativa</li>
                                <li>Proyecto Completo Generación de Vídeos (Parte 1)</li>
                                <li>Proyecto Completo Generación de Vídeos (Parte 2)</li>
                            </ol>
                        </div>
                    </li>
                    <li class="accordeon-item">
                        <a class="accordeon-title" href="#"><p>Módulo 10 - Utilidades para el Trabajo: Presentaciones <span>(13 clases)</span></p></a>
                        <div class="accordeon-content">
                            <p>Crea presentaciones profesionales con IA sin pasar horas diseñando.</p>
                            <ol>
                                <li>Las ventajas de usar inteligencia artificial en tus presentaciones</li>
                                <li>Gamma: La principal herramienta de creación de presentaciones con IA</li>
                                <li>Gamma: Creando presentaciones a partir de un texto o documento</li>
                                <li>Prezi AI</li>
                                <li>Creando presentaciones con Gemini, ChatGPT, Claude y Manus</li>
                                <li>Flujo de trabajo sugerido</li>
                                <li>Ejemplo práctico: Fase 1 - Clarificación estratégica</li>
                                <li>Ejemplo práctico: Fase 2 - Investigación e ideación</li>
                                <li>Ejemplo práctico: Fase 3 - Arquitectura de contenido</li>
                                <li>Ejemplo práctico: Fase 4 - Diseño y visualización</li>
                                <li>Ejemplo práctico: Fase 4 - Creación en Gamma</li>
                                <li>Ejemplo práctico: Fase 5 - Refinamiento iterativo</li>
                                <li>Ejemplo práctico: Fase 6 (Opcional) - Preparación para entrega + Fase 7 - Post-entrega y consideraciones finales</li>
                            </ol>
                        </div>
                    </li>
                    <li class="accordeon-item">
                        <a class="accordeon-title" href="#"><p>Módulo 11 - Utilidades para el Trabajo: Análisis de Datos <span>(21 clases)</span></p></a>
                        <div class="accordeon-content">
                            <p>Análisis completo de datos con IA, desde leer una hoja hasta contar historias con números.</p>
                            <ol>
                                <li>Conceptos iniciales y formatos de datos</li>
                                <li>Transformando datos no estructurados en datos estructurados</li>
                                <li>Limpiando bases de datos</li>
                                <li>Checklist pre-análisis</li>
                                <li>Seguridad de datos: Qué puedes y qué no debes subir a la IA</li>
                                <li>Límites de las herramientas al procesar datos</li>
                                <li>Caso práctico y lógica de los análisis</li>
                                <li>Primer paso: Saber preguntar</li>
                                <li>[Opcional] El análisis descriptivo</li>
                                <li>Qué hacer con outliers y análisis descriptivo usando IA</li>
                                <li>Análisis de tendencias</li>
                                <li>El prompt integrador del análisis descriptivo</li>
                                <li>Cómo explicar un resultado</li>
                                <li>El análisis de correlación</li>
                                <li>El análisis de concentración</li>
                                <li>El prompt integrador del análisis diagnóstico</li>
                                <li>[Opcional] El análisis predictivo</li>
                                <li>El prompt integrador del análisis predictivo</li>
                                <li>El análisis prescriptivo</li>
                                <li>El prompt consolidador de los resultados</li>
                                <li>Storytelling con datos</li>
                            </ol>
                        </div>
                    </li>
                    <li class="accordeon-item">
                        <a class="accordeon-title" href="#"><p>Módulo 12 - Escritura y comunicación profesional <span>(En construcción)</span></p></a>
                        <div class="accordeon-content">
                            <p>Escribe mejor y más rápido todo lo que tu trabajo te exige.</p>
                        </div>
                    </li>
                    <li class="accordeon-item">
                        <a class="accordeon-title" href="#"><p>Módulo 13 - Reuniones, notas y captura de información <span>(En construcción)</span></p></a>
                        <div class="accordeon-content">
                            <p>Aprovecha cada reunión: preparación, captura y entregables.</p>
                        </div>
                    </li>
                    <li class="accordeon-item">
                        <a class="accordeon-title" href="#"><p>Módulo 14 - IA para investigación y para profesores <span>(En construcción)</span></p></a>
                        <div class="accordeon-content">
                            <p>Investiga cualquier tema con la profundidad de un experto y arma tu cerebro digital.</p>
                        </div>
                    </li>
                    <li class="accordeon-item">
                        <a class="accordeon-title" href="#"><p>Módulo 15 - Marketing y creación de contenido <span>(En construcción)</span></p></a>
                        <div class="accordeon-content">
                            <p>Crea contenido para redes que la gente realmente quiera ver y consumir.</p>
                        </div>
                    </li>
                    <li class="accordeon-item">
                        <a class="accordeon-title" href="#"><p>Módulo 16 - IA para finanzas <span>(En construcción)</span></p></a>
                        <div class="accordeon-content">
                            <p>Toma mejores decisiones financieras con ayuda de la IA, sin ser experto en finanzas.</p>
                        </div>
                    </li>
                    <li class="accordeon-item">
                        <a class="accordeon-title" href="#"><p>Módulo 17 - APIs y uso avanzado <span>(En construcción)</span></p></a>
                        <div class="accordeon-content">
                            <p>El techo técnico del curso: ir más allá de las herramientas estándar con APIs y funciones avanzadas.</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <section class="secao oferta" id="secao-oferta">
        <div class="container">
            <div class="oferta__caixa oferta__caixa--itens">
                <h2 class="titulo">IA Impresionante</h2>

                <ul class="oferta__lista">
                    <li class="oferta__item">
                        <span class="oferta__numero">1</span>
                        <span class="oferta__nome">1 año de acceso al curso IA Impresionante</span>
                        <strong class="oferta__valor">US$ 247</strong>
                    </li>
                    <li class="oferta__item">
                        <span class="oferta__numero">2</span>
                        <span class="oferta__nome">Biblioteca de prompts impresionantes</span>
                        <strong class="oferta__valor">US$ 47</strong>
                    </li>
                    <li class="oferta__item">
                        <span class="oferta__numero">3</span>
                        <span class="oferta__nome">Proyecto de automatización con N8N</span>
                        <strong class="oferta__valor">US$ 97</strong>
                    </li>
                    <li class="oferta__item">
                        <span class="oferta__numero">4</span>
                        <span class="oferta__nome">2 proyectos en Lovable</span>
                        <strong class="oferta__valor">US$ 97</strong>
                    </li>
                    <li class="oferta__item">
                        <span class="oferta__numero">5</span>
                        <span class="oferta__nome">1 año de acceso adicional</span>
                        <strong class="oferta__valor">US$ 247</strong>
                    </li>
                </ul>

                <div class="oferta__total">
                    <span>Total</span>
                    <strong>US$ 735</strong>
                </div>
            </div>

            <div class="oferta__caixa oferta__caixa--preco">
                <p class="oferta__chamada"><span>Precio exclusivo</span> para inscritos en la Semana de la Inteligencia Artificial</p>
                <p class="oferta__de">de <span>US$ 735</span> por:</p>
                <p class="oferta__preco">US$ <span>197</span><sup>*</sup></p>
                <p class="oferta__obs">(si te inscribes hoy mismo)</p>

                <a class="botao" id="botaoOfertaCapacitaciones">
                    <div>Quiero inscribirme</div>
                    <img src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/pg-vendas-liacap-temp/oferta-seta.svg" alt="">
                </a>

                <p class="oferta__urgencia">¡Esta es una oferta por tiempo limitado!</p>
                <p class="oferta__rodape">*descuento adicional si eres alumno de Excel Impressionante</p>
            </div>
        </div>
    </section>

    <div class="fundo">
        <section class="secao garantia">
            <div class="container">
                <div class="garantia__selo" aria-label="Garantia de 30 dias">
                    <p class="garantia__numero">30</p>
                    <svg class="garantia__circulo garantia__circulo--interno" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path id="garantia30PathInterno" fill="transparent" d="M 10,50 a 40,40 0 1,1 80,0 a 40,40 0 1,1 -80,0"></path>
                        <text>
                            <textPath href="#garantia30PathInterno">GARANTIA DE 30 DIAS · GARANTIA DE 30 DIAS · GARANTIA DE 30 DIAS ·</textPath>
                        </text>
                    </svg>
                    <svg class="garantia__circulo garantia__circulo--externo" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path id="garantia30PathExterno" fill="transparent" d="M 10,50 a 40,40 0 1,1 80,0 a 40,40 0 1,1 -80,0"></path>
                        <text>
                            <textPath href="#garantia30PathExterno">GARANTIA DE 30 DIAS · GARANTIA DE 30 DIAS · GARANTIA DE 30 DIAS ·</textPath>
                        </text>
                    </svg>
                </div>

                <div class="garantia__textos">
                    <h2 class="titulo"><span class="destaque">Garantía</span> de 30 días</h2>
                    <p class="paragrafo">Si, por el motivo que sea, no te identificas con el programa o te arrepientes, puedes usar la garantía de 30 días naturales. Es decir, si accedes al portal, ves las clases, descargas los materiales y, en los primeros 30 días contados a partir del día en el que te inscribiste, decides cancelar tu inscripción, puedes solicitar la devolución de tu dinero.</p>
                </div>
            </div>
        </section>

        <section class="secao faq">
            <div class="container">
                <h2 class="titulo">Preguntas frecuentes</h2>

                <div class="acordeao-html">
                    <ul class="accordeon accordeon-faq">
                        <li class="accordeon-item">
                            <a class="accordeon-title" href="#"><p>¿Cuándo recibiré mi acceso al programa?</p></a>
                            <div class="accordeon-content">
                                <p>Si pagaste con tarjeta, recibirás tu acceso al curso y a los bonus en algunos minutos. Si utilizaste otro método de pago, debido al tiempo que tarda en ser procesado, recibirás un correo electrónico con tu usuario y contraseña hasta 2 días después de la confirmación del pago.</p>
                            </div>
                        </li>
                        <li class="accordeon-item">
                            <a class="accordeon-title" href="#"><p>Voy a empezar de cero. ¿Este curso me sirve?</p></a>
                            <div class="accordeon-content">
                                <p>Seguro que sí. El programa IA Impresionante fue creado para cogerte de la mano y llevarte del absoluto cero al nivel impresionante en Inteligencia Artificial debido a su didáctica: enseñar todo desde cero, en detalle y paso a paso para que cualquiera pueda seguir las videoclases cortas (en promedio, 10min). Aprenderás todo lo que necesitas para dominar la tecnología más importante del momento y destacar en cualquier empresa.</p>
                            </div>
                        </li>
                        <li class="accordeon-item">
                            <a class="accordeon-title" href="#"><p>¿Podré resolver dudas durante el curso?</p></a>
                            <div class="accordeon-content">
                                <p>Claro que sí! Nuestro equipo de expertos responde a cualquier duda de Inteligencia Artificial de lunes a viernes en el portal – sea una duda sobre el contenido del curso sea una duda de tu trabajo.</p>
                            </div>
                        </li>
                        <li class="accordeon-item">
                            <a class="accordeon-title" href="#"><p>¿Cuánto tiempo tendré acceso al curso?</p></a>
                            <div class="accordeon-content">
                                <p>Con esta oferta, tu tiempo de acceso es de 2 años. Así podrás ver todas las clases y volver a ver las que necesites, sea para practicar una vez más, sea para estar al tanto de alguna actualización en una herramienta que ya existe en el curso.</p>
                            </div>
                        </li>
                        <li class="accordeon-item">
                            <a class="accordeon-title" href="#"><p>¿A qué tendré acceso?</p></a>
                            <div class="accordeon-content">
                                <p>Al curso completo IA Impresionante, desde lo básico hasta el nivel impresionante;</p>
                                <p>A la guía completa, con todas las clases para que estudies y practiques;</p>
                                <p>Al soporte diario a todas tus dudas por nuestro equipo de expertos;</p>
                                <p>A estos bonus exclusivos: Biblioteca de Prompts Impresionantes, Proyecto de automación en Whatsapp/Email con N8N, 2 proyectos completos con Lovable y 1 año de acceso adicional al curso.</p>
                            </div>
                        </li>
                        <li class="accordeon-item">
                            <a class="accordeon-title" href="#"><p>¿Cómo puedo pagar?</p></a>
                            <div class="accordeon-content">
                                <p>Usamos la plataforma digital Hotmart. Un sitio 100% seguro.</p>
                                <p>Los métodos de pago dependen del país en el que estás. Si tienes cualquier duda, haz clic en el chat que está en la esquina inferior derecha del sitio web, envíanos un mensaje y, encantados, te responderemos.</p>
                            </div>
                        </li>
                        <li class="accordeon-item">
                            <a class="accordeon-title" href="#"><p>¿Y si no me gusta el curso?</p></a>
                            <div class="accordeon-content">
                                <p>Si algo no te gusta, estaremos a tu disposición para ayudarte a que saques el máximo provecho del programa.</p>
                                <p>Pero si decides aún así no seguir aprendiendo con nosotros, por el motivo que sea, te devolveremos tu dinero. Nos enviarás un correo electrónico en los primeros 30 días contados a partir del día en el que te inscribiste y te devolveremos tu dinero. Sin trampa y sin letras pequeñas.</p>
                            </div>
                        </li>
                        <li class="accordeon-item">
                            <a class="accordeon-title" href="#"><p>¿El programa tiene certificado de finalización?</p></a>
                            <div class="accordeon-content">
                                <p>Sí! Si cumples al menos el 80% del curso, podrás descargar tu certificado de finalización en la plataforma.</p>
                            </div>
                        </li>
                    </ul>
                </div>

                <a class="botao" href="#secao-oferta">
                    <div>Quiero asegurar mi lugar</div>
                </a>
            </div>
        </section>
    </div>

    <section class="secao rodape">
        <div class="container">
            <p class="paragrafo">
                <img src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Global/logo-h.webp" alt="">
                Política de privacidad | Términos y condiciones
            </p>
        </div>
    </section>
</main>

<!-- <div class="popup">
  <div class="popup-container">
    <div class="popup-spinner">
      <img loading="lazy" src="" alt="Loader" />
    </div>

    <button type="button" class="btn btn--fechar btn--popup" id="botaoPopupFechar">
      X
    </button>

    <form method="POST" action="https://hashtagtreinamentos.activehosted.com/proc.php" id="_form_7807_" class="form" novalidate>
      <input type="hidden" name="u" value="7807" />
      <input type="hidden" name="f" value="7807" />
      <input type="hidden" name="act" value="sub" />

      <div class="form-inputs">
        <div class="form-campo">
          <input type="text" id="fullname" name="fullname" placeholder="*Seu nome e sobrenome" required />
          <small></small>
        </div>

        <div class="form-campo">
          <input type="text" id="email" name="email" placeholder="*Seu melhor e-mail" required />
          <small></small>
        </div>

        <div class="form-campo form-campo--duplo">
          <input type="text" id="field[59]" name="field[59]" value="" placeholder="DDD" />
          <input type="text" id="field[60]" name="field[60]" placeholder="Seu celular" />
        </div>

        <input type="hidden" name="field[6]" value="" />
        <input type="hidden" name="field[10]" value="" />
        <input type="hidden" name="field[58]" value="" />
        <input type="hidden" name="field[112]" value="" />
        <input type="hidden" name="field[113]" value="" />
        <input type="hidden" name="field[114]" value="" />
        <input type="hidden" name="field[115]" value="" />
        <input type="hidden" name="field[158]" value="" />
      </div>

      <button class="btn btn--hero" id="_form_7807_submit" type="submit">
        Garantir minha vaga
      </button>
    </form>

    <div class="popup__conteudo"></div>
  </div>
</div> -->

<div class="popup">
    <div class="popup-container">
        <div class="popup-spinner">
            <img
                src="https://daks2k3a4ib2z.cloudfront.net/61b9e0dd381626819c8d4f83/6331d9916652e734346e35db_9.gif"
                alt=""
                loading="lazy"
            />
        </div>

        <form
            method="POST"
            action="https://hashtagtreinamentos.activehosted.com/proc.php"
            id="_form_5344_"
            class="form"
            novalidate
        >
            <button
                type="button"
                class="btn btn--fechar btn--popup"
                id="botaoPopupFechar"
            >
                X
            </button>

            <!-- Inputs obrigatórios dos formulários do activecampaign -->
            <input type="hidden" name="u" value="5344" />
            <input type="hidden" name="f" value="5344" />
            <input type="hidden" name="act" value="sub" />

            <div class="form-inputs">
                <div class="form-campo">
                    <input
                        type="text"
                        id="fullname"
                        name="fullname"
                        placeholder="*Tu nombre y apellido"
                        required
                    />
                    <small></small>
                </div>

                <div class="form-campo">
                    <input
                        type="text"
                        id="email"
                        name="email"
                        placeholder="*E-mail más usado"
                        required
                    />
                    <small></small>
                </div>

                <div class="form-campo-duplo">
                    <div class="form-campo form-campo-prefixo">
                        <div class="phone-prefix-selector">
                            <input
                                type="text"
                                id="prefix"
                                name="prefix"
                                placeholder="*Prefijo de país"
                                autocomplete="off"
                            />
                            <div id="dropdown" class="dropdown hidden fundo-escuro"></div>
                            <small></small>
                        </div>
                    </div>
                    <div class="form-campo form-campo-numero-nacional">
                        <input
                            type="text"
                            id="national-phone"
                            name="national-phone"
                            placeholder="*WhatsApp"
                            required
                        />
                        <small></small>
                    </div>
                </div>

                <input
                    type="text"
                    id="phone"
                    name="phone"
                    placeholder="WhatsApp"
                />

                <!-- OrigemURL -->
                <input type="hidden" name="field[6]" value="" />

                <!-- OrigemRef -->
                <input type="hidden" name="field[10]" value="" />

                <!-- linkTemp -->
                <input type="hidden" name="field[58]" value="" />

                <!-- FonteTemp -->
                <input type="hidden" name="field[62]" value="" />

                <!-- linkTempIDProduto -->
                <input type="hidden" name="field[112]" value="" />

                <!-- linkTempIDOferta -->
                <input type="hidden" name="field[113]" value="" />

                <!-- linkTempSRC -->
                <input type="hidden" name="field[114]" value="" />

                <!-- linkTempPixBillet -->
                <input type="hidden" name="field[115]" value="" />

                <!-- sck -->
                <input type="hidden" name="field[158]" value="" />
            </div>

            <button class="btn btn--hero" id="_form_5344_submit" type="submit">
                Asegurar mi lugar
            </button>
        </form>
    </div>
</div>

<script src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/js/trocar-imagem-video.js"></script>
<script src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/js/carrossel.js"></script>
<script src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/js/infinite-scroller.js"></script>
<script src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/js/lancamento-campaign.js"></script>
<script src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/js/precheckout-global.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const titles = document.querySelectorAll(".accordeon-title");
    const contents = document.querySelectorAll(".accordeon-content");

    for (let content of contents) {
        content.style.maxHeight = "2000px";
    }

    for (let title of titles) {
        title.addEventListener("click", (e) => {
            for (let t of titles) {
                if (title !== t) {
                    t.parentNode.classList.remove("opened");
                }
            }

            title.parentNode.classList.toggle("opened");
            e.preventDefault();
        });
    }
});
</script>

<?php wp_footer(); ?>
<?php the_field('footer', 'option'); ?>
</body>

</html>
