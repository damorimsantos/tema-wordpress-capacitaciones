<!-- Modelo para a Home Capacitaciones Excel NOVO -->

<?php
/*
Template name: Home CapacitSaciones
*/
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- titulo emitido por wp_head() (add_theme_support title-tag) + Rank Math -->

  <!-- CSS -->
  <link rel="stylesheet"
    href="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/sass/css/home-capacitaciones-excel/style.css" />
  <!-- <link rel="stylesheet" href="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/sass/css/style.css" /> -->

  <?php wp_head(); ?>

  <!-- Scripts do Head configurados em 'Opções do Site'/ https://www.hashtagtreinamentos.com/wp-admin/admin.php?page=opcoes-do-site  -->
  <?php the_field('head', 'option'); ?>

  <!-- <script>
    if (!window.location.search.includes("redirected=1")) {
      var today = new Date(
        new Date().toLocaleString("en-US", {
          timeZone: "America/Bogota",
        })
      );

      var linkRedir = "https://lp.hashtagcapacitaciones.com/excel/semana/inscripcion?redirected=1";

      var datasCorte = [
        new Date("October 13 2025 13:00:00 GMT-0500"),
        new Date("November 3 2025 23:59:59 GMT-0500"),
      ];

      if (
        today.getTime() >= datasCorte[0].getTime() &&
        today.getTime() <= datasCorte[1].getTime()
      ) {
        var params = new URLSearchParams(window.location.search);
        if (params.toString()) {
          linkRedir += "&" + params.toString();
        }
        window.location.replace(linkRedir);
      }
    }
  </script> -->

</head>

<body>
  <?php get_header('capacitaciones'); ?>

  <main>
    <section class="secao hero">
      <div class="hero__placeholder"></div>
      <div class="hero__textos">
        <h1>
          Curso Completo Excel Impresionante: conviértete en un referente en el mercado laboral
        </h1>
        <p class="hero__paragrafo realce-azul">
          Aprende, con Hashtag Capacitaciones, todo lo que necesitas saber de Excel para destacar en cualquier empresa
        </p>
        <a class="botao-verde" id="botaoPopup" href="#">
          Quiero aprender
          <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20" fill="none">
            <rect width="20" height="20" transform="translate(0.5)" fill="black" fill-opacity="0.01"></rect>
            <path fill-rule="evenodd" clip-rule="evenodd"
              d="M11.3632 4.19527C11.6236 3.93491 12.0457 3.93491 12.306 4.19527L17.6394 9.5286C17.8997 9.78895 17.8997 10.2111 17.6394 10.4714L12.306 15.8048C12.0457 16.0651 11.6236 16.0651 11.3632 15.8048C11.1029 15.5444 11.1029 15.1223 11.3632 14.8619L15.5585 10.6667H3.83464C3.46645 10.6667 3.16797 10.3682 3.16797 10C3.16797 9.63182 3.46645 9.33334 3.83464 9.33334H15.5585L11.3632 5.13807C11.1029 4.87772 11.1029 4.45562 11.3632 4.19527Z"
              fill="black"></path>
          </svg>
        </a>
      </div>
    </section>

    <section class="secao conteudo">
      <div class="container">
        <h2>¿Qué aprenderás en nuestro <span class="realce">curso de Excel?</span></h2>
        <p class="conteudo__subtitulo">Nuestro curso está cuidadosamente estructurado para que avances paso a paso y
          <b>veas resultados desde las
            primeras lecciones</b>. Aquí te mostramos lo principal de cada bloque de contenido:
        </p>

        <div class="conteudo__itens">
          <div class="conteudo__item">
            <h3>Módulos básicos e intermedios</h3>

            <div class="conteudo__texto ef-slide ef-slide--visivel">
              <p>
                Aprende a navegar en Excel como un profesional. <b>Domina los atajos de teclado esenciales, formatos
                  avanzados, fórmulas fundamentales y herramientas de datos</b> para organizar y analizar tu información
                con precisión.
              </p>
            </div>
          </div>

          <div class="conteudo__item">
            <h3>Tablas dinámicas, gráficos e informes</h3>

            <div class="conteudo__texto ef-slide ef-slide--visivel">
              <p>
                Lleva tus informes al siguiente nivel debido a su aspecto visual impactante. <b>Aprende a crear tablas
                  dinámicas interactivas, gráficos claros y reportes profesionales</b> que comuniquen tus resultados de
                manera efectiva.
              </p>
            </div>
          </div>

          <div class="conteudo__item">
            <h3>Automatización y macros, Power Query y Power Pivot</h3>

            <div class="conteudo__texto ef-slide ef-slide--visivel">
              <p>
                Descubre cómo automatizar tareas repetitivas y ahorrar tiempo. <b>Integra macros en tus hojas, importa y
                  transforma datos con Power Query y analiza grandes volúmenes de información con Power
                  Pivot.</b>
              </p>
            </div>
          </div>

          <div class="conteudo__item">
            <h3>Dashboards e inteligencia artificial</h3>

            <div class="conteudo__texto ef-slide ef-slide--visivel">
              <p>
                Aprende a crear <b>dashboards interactivos para el seguimiento de KPIs</b>. Y sí: también verás cómo la
                <b>inteligencia artificial te puede ayudar a trabajar con Excel de manera más eficiente</b>.
              </p>
            </div>
          </div>

          <div class="conteudo__item">
            <h3>Hojas de cálculo de Google y complementos</h3>

            <div class="conteudo__texto ef-slide ef-slide--visivel">
              <p>
                Explora el potencial de Google Sheets, sus <b>atajos y cómo trabajar de forma colaborativa</b>. También
                instalarás complementos útiles para potenciar tus hojas de cálculo.
              </p>
            </div>
          </div>

          <div class="conteudo__item">
            <h3>Bonos opcionales: carrera y plantillas</h3>

            <div class="conteudo__texto ef-slide ef-slide--visivel">
              <p>
                Además del curso principal, tendrás acceso a <b>módulos para impulsar tu carrera, una biblioteca de
                  plantillas profesionales</b> listas para usar y <b>estrategias para monetizar tus habilidades de
                  Excel.</b>
              </p>
            </div>
          </div>
        </div>
        <a class="botao-neon" href="https://tinyurl.com/temario-excel-impresionante"
          target="_blank">
          Ver el temario completo
          </svg>
        </a>
      </div>
    </section>

    <section class="secao diferenciais">
      <div class="container">
        <div class="diferenciais__caixa-img">
          <img loading="lazy" class="diferenciais__img"
            src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Home/img-diferenciais.webp"
            alt="Laptop con la plataforma de Hashtag y dashboards" />
        </div>
        <div class="diferenciais__textos">
          <h2>
            Conoce los puntos de destaque de <b>Hashtag Capacitaciones</b>
          </h2>
          <p class="diferenciais__paragrafo">
            Comprende por qué nuestro curso es la elección ideal para transformar tu carrera profesional
          </p>
          <a class="botao-verde" id="botaoPopup" href="#">
            Quiero aprender
            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20" fill="none">
              <rect width="20" height="20" transform="translate(0.5)" fill="black" fill-opacity="0.01"></rect>
              <path fill-rule="evenodd" clip-rule="evenodd"
                d="M11.3632 4.19527C11.6236 3.93491 12.0457 3.93491 12.306 4.19527L17.6394 9.5286C17.8997 9.78895 17.8997 10.2111 17.6394 10.4714L12.306 15.8048C12.0457 16.0651 11.6236 16.0651 11.3632 15.8048C11.1029 15.5444 11.1029 15.1223 11.3632 14.8619L15.5585 10.6667H3.83464C3.46645 10.6667 3.16797 10.3682 3.16797 10C3.16797 9.63182 3.46645 9.33334 3.83464 9.33334H15.5585L11.3632 5.13807C11.1029 4.87772 11.1029 4.45562 11.3632 4.19527Z"
                fill="black"></path>
            </svg>
          </a>
        </div>
      </div>
    </section>

    <section class="secao porque">
      <div class="container">
        <h2>
          <b>¿Por qué elegir nuestro
            <span class="realce">curso de Excel?</span></b>
        </h2>
        <p class="porque__texto">
          Cuando eliges Hashtag Capacitaciones, no solo aprendes Excel, sino también cómo aplicarlo para resolver
          problemas reales, mejorar tu trabajo y destacar profesionalmente. Aquí está qué hace diferente a nuestro
          curso:
        </p>
        <div class="porque__grid">
          <div class="porque__item ef-slide ef-slide--visivel">
            <img loading="lazy" class="porque__icone"
              src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Global/check-redondo.png"
              alt="Ícone check" />

            <h3 class="porque__titulo">
              Didáctica sencilla desde cero
            </h3>
            <p class="porque__p">
              Explicamos todo de forma clara y directa, para que incluso quien nunca abrió una hoja de cálculo pueda
              aprender sin frustraciones y avanzar rápido.
            </p>
          </div>
          <div class="porque__item ef-slide ef-slide--visivel">

            <img loading="lazy" class="porque__icone"
              src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Global/check-redondo.png"
              alt="Ícone check" />

            <h3 class="porque__titulo">
              Enfoque práctico con casos reales
            </h3>
            <p class="porque__p">
              Cada módulo incluye ejercicios y ejemplos inspirados en situaciones reales de empresas para que, desde el
              primer día, sepas cómo usar Excel en tu trabajo o negocio.
            </p>
          </div>

          <div class="porque__item ef-slide ef-slide--visivel">
            <img loading="lazy" class="porque__icone"
              src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Global/check-redondo.png"
              alt="Ícone check" />

            <h3 class="porque__titulo">
              Soporte diario de expertos
            </h3>
            <p class="porque__p">
              No te quedarás con dudas. Nuestro equipo de especialistas está disponible para responder a tus preguntas y
              orientarte paso a paso de lunes a viernes (excepto festivos).
            </p>
          </div>
        </div>
    </section>

    <section class="secao largura-total comparacao">
      <div class="comparacao">
        <div class="comparacao__item comparacao__item--titulo comparacao__item--tradicional comparacao__item--hidem">
          <h3>Curso normalito</h3>
        </div>

        <div class="comparacao__item comparacao__item--titulo comparacao__item--hidem">
          <img loading="lazy" width="27" height="38" style="aspect-ratio: 27/38"
            src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Global/logo-h.webp"
            alt="Logo Hashtag" />
          <h3>Excel Impresionante</h3>
        </div>

        <div
          class="comparacao__item comparacao__item--titulo comparacao__item--tradicional ef-slide-100 ef-slide--visivel"
          aria-hidden="true">
          <h3>Curso normalito</h3>
        </div>

        <div class="comparacao__item ef-slide-100 ef-slide--visivel">
          <img loading="lazy" width="21" height="21" style="aspect-ratio: 21/21"
            src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Global/x.webp" alt="Icono check" />
          <p>Desactualizado y sin aplicaciones reales</p>
        </div>

        <div class="comparacao__item comparacao__item--titulo ef-slide-100 ef-slide--visivel" aria-hidden="true">
          <img loading="lazy" width="27" height="38" style="aspect-ratio: 27/38"
            src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Global/logo-h.webp"
            alt="Logo Hashtag" />
          <h3>Excel Impresionante</h3>
        </div>

        <div class="comparacao__item ef-slide-100 ef-slide--visivel">
          <img loading="lazy" width="21" height="21" style="aspect-ratio: 21/21"
            src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Global/check-quadrado.webp"
            alt="Icono check" />
          <p>
            Constantemente actualizado y te prepara para el mundo laboral
          </p>
        </div>

        <hr aria-hidden="true" class="ef-slide-100 ef-slide--visivel" />

        <div
          class="comparacao__item comparacao__item--titulo comparacao__item--tradicional ef-slide-100 ef-slide--visivel"
          aria-hidden="true">
          <h3>Curso normalito</h3>
        </div>

        <div class="comparacao__item ef-slide-100 ef-slide--visivel">
          <img loading="lazy" width="21" height="21" style="aspect-ratio: 21/21"
            src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Global/x.webp" alt="Icono check" />
          <p>
            Sin didáctica, lenguaje muy técnico y difícil de seguir
          </p>
        </div>

        <div class="comparacao__item comparacao__item--titulo ef-slide-100 ef-slide--visivel" aria-hidden="true">
          <img loading="lazy" width="27" height="38" style="aspect-ratio: 27/38"
            src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Global/logo-h.webp"
            alt="Logo Hashtag" />
          <h3>Excel Impresionante</h3>
        </div>

        <div class="comparacao__item ef-slide-100 ef-slide--visivel">
          <img loading="lazy" width="21" height="21" style="aspect-ratio: 21/21"
            src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Global/check-quadrado.webp"
            alt="Icono check" />
          <p>
            Todo desde cero, con didáctica y lenguaje simple, para que puedas seguir todas las clases independientemente
            de tu nivel
          </p>
        </div>

        <hr aria-hidden="true" class="ef-slide-100 ef-slide--visivel" />

        <div
          class="comparacao__item comparacao__item--titulo comparacao__item--tradicional ef-slide-100 ef-slide--visivel"
          aria-hidden="true">
          <h3>Curso normalito</h3>
        </div>

        <div class="comparacao__item ef-slide-100 ef-slide--visivel">
          <img loading="lazy" width="21" height="21" style="aspect-ratio: 21/21"
            src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Global/x.webp" alt="Icono check" />
          <p>Sin soporte a dudas</p>
        </div>

        <div class="comparacao__item comparacao__item--titulo ef-slide-100 ef-slide--visivel" aria-hidden="true">
          <img loading="lazy" width="27" height="38" style="aspect-ratio: 27/38"
            src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Global/logo-h.webp"
            alt="Logo Hashtag" />
          <h3>Excel Impresionante</h3>
        </div>

        <div class="comparacao__item ef-slide-100 ef-slide--visivel">
          <img loading="lazy" width="21" height="21" style="aspect-ratio: 21/21"
            src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Global/check-quadrado.webp"
            alt="Icono check" />
          <p>
            Soporte a todas tus dudas (sobre el contenido de las clases o retos de tu trabajo) por nuestro equipo de
            expertos de lunes a viernes
          </p>
        </div>

        <hr aria-hidden="true" class="ef-slide-100 ef-slide--visivel" />

        <div
          class="comparacao__item comparacao__item--titulo comparacao__item--tradicional ef-slide-100 ef-slide--visivel"
          aria-hidden="true">
          <h3>Curso normalito</h3>
        </div>

        <div class="comparacao__item ef-slide-100 ef-slide--visivel">
          <img loading="lazy" width="21" height="21" style="aspect-ratio: 21/21"
            src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Global/x.webp" alt="Icono check" />
          <p>Sin ejercicios para que practiques</p>
        </div>

        <div class="comparacao__item comparacao__item--titulo ef-slide-100 ef-slide--visivel" aria-hidden="true">
          <img loading="lazy" width="27" height="38" style="aspect-ratio: 27/38"
            src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Global/logo-h.webp"
            alt="Logo Hashtag" />
          <h3>Excel Impresionante</h3>
        </div>

        <div class="comparacao__item ef-slide-100 ef-slide--visivel">
          <img loading="lazy" width="21" height="21" style="aspect-ratio: 21/21"
            src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Global/check-quadrado.webp"
            alt="Icono check" />
          <p>
            Ejercicios, retos y proyectos reales a lo largo del curso para que domines todo el contenido
          </p>
        </div>
      </div>
    </section>

    <section class="secao depoimentos largura-total destacar">
      <h2>
        Testimonios de algunos de nuestros alumnos:
      </h2>

      <div class="div-carrossel largura-total destacar">
        <div
            class="carrossel carrossel--automatico largura-total efeito-slidein-800 efeito-slidein-800--visivel"
            >
          <div class="carrossel__controles">
            <div class="carrossel__seta">
              <svg
                  viewBox="0 0 14 14"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                  >
                <path
                      d="M13.8282 6.28275H3.62507L8.31164 1.59618L7.12113 0.414062L0.414062 7.12113L7.12113 13.8282L8.30325 12.6461L3.62507 7.95952H13.8282V6.28275Z"
                      fill="currentColor"
                      />
              </svg>
            </div>

            <!-- carrossel__seta--habilitada -->
            <div class="carrossel__seta">
              <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 14 14"
                  fill="none"
                  >
                <path
                      d="M6.87895 0.414062L5.69682 1.59618L10.375 6.28275H0.171875V7.95952H10.375L5.69682 12.6461L6.87895 13.8282L13.586 7.12113L6.87895 0.414062Z"
                      fill="currentColor"
                      />
              </svg>
            </div>
          </div>

          <div
              class="carrossel__track carrossel__track--mask-duplo destacar__carrossel"
              >

            <!-- guillermo -->
            <div class="destacar__item">
              <div class="destacar__video">
                <img
                    loading="lazy"
                    fakeSRC="7yX3yZojrto"
                    alt="Thumbnail do Vídeo"
                    />
                <svg
                    aria-hidden="true"
                    class="e-font-icon-svg e-eicon-play"
                    viewBox="0 0 1000 1000"
                    xmlns="http://www.w3.org/2000/svg"
                    >
                  <path
                        d="M838 162C746 71 633 25 500 25 371 25 258 71 163 162 71 254 25 367 25 500 25 633 71 746 163 837 254 929 367 979 500 979 633 979 746 933 838 837 929 746 975 633 975 500 975 367 929 254 838 162M808 192C892 279 933 379 933 500 933 621 892 725 808 808 725 892 621 938 500 938 379 938 279 896 196 808 113 725 67 621 67 500 67 379 108 279 196 192 279 108 383 62 500 62 621 62 721 108 808 192M438 392V642L642 517 438 392Z"
                        ></path>
                </svg>
              </div>

              <div class="destacar__texto">
                "Me demoraba casi dos semanas en tomar las decisiones y analizar y organizar todo. Ahora, ya no me demoro sino máximo 2 días. Se han sentido agradecidos con mi trabajo y recibí un aumento salarial."
                <div class="destacar__nome-bandeira"><span class="destacar__nome"> Guillermo Santacoloma </span><img src="https://cdn.prod.website-files.com/66c79de3f922194cc4966c89/689a62d964d441aa3cf225ee_emoji-bandeira-colombia.webp"/></div>
              </div>
            </div>

            <!-- veronica -->
            <div class="destacar__item">
              <div class="destacar__video">
                <img
                    loading="lazy"
                    fakeSRC="fs8vzbN_THo"
                    alt="Thumbnail do Vídeo"
                    />
                <svg
                    aria-hidden="true"
                    class="e-font-icon-svg e-eicon-play"
                    viewBox="0 0 1000 1000"
                    xmlns="http://www.w3.org/2000/svg"
                    >
                  <path
                        d="M838 162C746 71 633 25 500 25 371 25 258 71 163 162 71 254 25 367 25 500 25 633 71 746 163 837 254 929 367 979 500 979 633 979 746 933 838 837 929 746 975 633 975 500 975 367 929 254 838 162M808 192C892 279 933 379 933 500 933 621 892 725 808 808 725 892 621 938 500 938 379 938 279 896 196 808 113 725 67 621 67 500 67 379 108 279 196 192 279 108 383 62 500 62 621 62 721 108 808 192M438 392V642L642 517 438 392Z"
                        ></path>
                </svg>
              </div>

              <div class="destacar__texto">
                "La planilla que pude crear gracias al curso redundó en un menor costo y en una mayor rentabilidad para la consultora. Y también los clientes salen mucho más satisfechos."
                <div class="destacar__nome-bandeira"><span class="destacar__nome"> Verónica del Río </span><img src="https://cdn.prod.website-files.com/66c79de3f922194cc4966c89/689a62d9610b5d111857ca89_emoji-bandeira-argentina.webp"/></div>
              </div>
            </div>

            <!-- enriqueta -->
            <div class="destacar__item">
              <div class="destacar__video">
                <img
                    loading="lazy"
                    fakeSRC="uJeb1Oh7Xu8"
                    alt="Thumbnail do Vídeo"
                    />
                <svg
                    aria-hidden="true"
                    class="e-font-icon-svg e-eicon-play"
                    viewBox="0 0 1000 1000"
                    xmlns="http://www.w3.org/2000/svg"
                    >
                  <path
                        d="M838 162C746 71 633 25 500 25 371 25 258 71 163 162 71 254 25 367 25 500 25 633 71 746 163 837 254 929 367 979 500 979 633 979 746 933 838 837 929 746 975 633 975 500 975 367 929 254 838 162M808 192C892 279 933 379 933 500 933 621 892 725 808 808 725 892 621 938 500 938 379 938 279 896 196 808 113 725 67 621 67 500 67 379 108 279 196 192 279 108 383 62 500 62 621 62 721 108 808 192M438 392V642L642 517 438 392Z"
                        ></path>
                </svg>
              </div>

              <div class="destacar__texto">
                "Generé tablas dinámicas y solucioné la situación en 15 minutos. Mi jefa me llamó y me dijo que estaba muy contenta conmigo."
                <div class="destacar__nome-bandeira"><span class="destacar__nome"> Enriqueta García </span><img src="https://cdn.prod.website-files.com/66c79de3f922194cc4966c89/689a62d948439500210b7b67_emoji-bandeira-mexico.webp"/></div>
              </div>
            </div>   

            <!-- barbara-->
            <div class="destacar__item">
              <div class="destacar__video">
                <img
                    loading="lazy"
                    fakeSRC="jtN7mreha7E"
                    alt="Thumbnail do Vídeo"
                    />
                <svg
                    aria-hidden="true"
                    class="e-font-icon-svg e-eicon-play"
                    viewBox="0 0 1000 1000"
                    xmlns="http://www.w3.org/2000/svg"
                    >
                  <path
                        d="M838 162C746 71 633 25 500 25 371 25 258 71 163 162 71 254 25 367 25 500 25 633 71 746 163 837 254 929 367 979 500 979 633 979 746 933 838 837 929 746 975 633 975 500 975 367 929 254 838 162M808 192C892 279 933 379 933 500 933 621 892 725 808 808 725 892 621 938 500 938 379 938 279 896 196 808 113 725 67 621 67 500 67 379 108 279 196 192 279 108 383 62 500 62 621 62 721 108 808 192M438 392V642L642 517 438 392Z"
                        ></path>
                </svg>
              </div>

              <div class="destacar__texto">
                "Yo, personalmente, uso Excel todos los días y, no solo me está ayudando a que haga reportes más completos o análisis de datos más rápidos, también me está ayudando a la seguridad que tengo a la hora de presentar mi trabajo."
                <div class="destacar__nome-bandeira"><span class="destacar__nome"> Barbara Vega </span><img src="https://cdn.prod.website-files.com/66c79de3f922194cc4966c89/689a62d9610b5d111857ca89_emoji-bandeira-argentina.webp"/></div>
              </div>
            </div>

            <!-- jesús-->
            <div class="destacar__item">
              <div class="destacar__video">
                <img
                    loading="lazy"
                    fakeSRC="zBfeCxp7zPA"
                    alt="Thumbnail do Vídeo"
                    />
                <svg
                    aria-hidden="true"
                    class="e-font-icon-svg e-eicon-play"
                    viewBox="0 0 1000 1000"
                    xmlns="http://www.w3.org/2000/svg"
                    >
                  <path
                        d="M838 162C746 71 633 25 500 25 371 25 258 71 163 162 71 254 25 367 25 500 25 633 71 746 163 837 254 929 367 979 500 979 633 979 746 933 838 837 929 746 975 633 975 500 975 367 929 254 838 162M808 192C892 279 933 379 933 500 933 621 892 725 808 808 725 892 621 938 500 938 379 938 279 896 196 808 113 725 67 621 67 500 67 379 108 279 196 192 279 108 383 62 500 62 621 62 721 108 808 192M438 392V642L642 517 438 392Z"
                        ></path>
                </svg>
              </div>

              <div class="destacar__texto">
                "Comencé a tener beneficios muy rápidamente. Ya desde felicitaciones de mis compañeros, pasando por mis superiores directos hasta llegar a la cúpula directiva de la empresa."
                <div class="destacar__nome-bandeira"><span class="destacar__nome"> Jesús Agüero </span><img src="https://cdn.prod.website-files.com/66c79de3f922194cc4966c89/689a62d9610b5d111857ca89_emoji-bandeira-argentina.webp"/></div>
              </div>
            </div>


          </div>
        </div>
      </div>

      <!-- <a href="https://pages.hashtagtreinamentos.com/r2x-powerpoint" target="_blank" class="botao-verde">
        Veja mais depoimentos
        <img loading="lazy" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Global/seta-botao.svg"
          alt="Seta para a direita" />
      </a> -->
    </section>

    <section class="secao cursos">
      <div class="container">
        <h2>
          Conoce nuestro
          <span class="realce-azul">curso</span>
        </h2>
        <div class="card card--excel">
          <div class="card__nome-curso">
            <img loading="lazy"
              src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Global/Ícone/icone-excel.svg"
              alt="Icono Excel" />

            <div>
              <p><b>Excel</b></p>
              <p>Impresionante</p>
            </div>
          </div>

          <div class="card__botoes">
            <div class="card__nome-professor card__nome-professor--excel">
              Olivia
            </div>
            <a class="card__saber-mais card__saber-mais--excel" id="botaoPopup" href="#">Más
              información</a>
          </div>
        </div>
      </div>
    </section>



    <!-- <section class="secao quem">
      <div class="container">
        <h2><b>¿A quién está dirigido?</b></h2>
        <p>Este curso está diseñado para todos los que quieren dominar Excel y usarlo para crecer profesionalmente:</p>

        <div class="quem__grid">
          <div class="quem__item">
            <div class="quem__circulo-verde">
              <svg width="74" height="74" viewBox="0 0 74 74" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="74" height="74" rx="37" fill="#FFC13E" />
                <path
                  d="M25.7 49C24.9575 49 24.3221 48.7425 23.7938 48.2276C23.2655 47.7127 23.0009 47.093 23 46.3684V31.8947C23 31.1711 23.2646 30.5518 23.7938 30.0368C24.323 29.5219 24.9584 29.264 25.7 29.2632H31.1V26.6316C31.1 25.9079 31.3646 25.2886 31.8938 24.7737C32.423 24.2588 33.0584 24.0009 33.8 24H39.2C39.9425 24 40.5783 24.2579 41.1075 24.7737C41.6367 25.2895 41.9009 25.9088 41.9 26.6316V29.2632H47.3C48.0425 29.2632 48.6783 29.5211 49.2075 30.0368C49.7367 30.5526 50.0009 31.1719 50 31.8947V46.3684C50 47.0921 49.7358 47.7118 49.2075 48.2276C48.6792 48.7434 48.0434 49.0009 47.3 49H25.7ZM33.8 29.2632H39.2V26.6316H33.8V29.2632Z"
                  fill="#060D21" />
              </svg>
            </div>
            <p>
              Personas que empiezan desde cero y buscan un curso de Excel para principiantes;
            </p>
          </div>

          <div class="quem__item quem__item--meio">
            <div class="quem__circulo-verde">
              <svg width="74" height="74" viewBox="0 0 74 74" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="74" height="74" rx="37" fill="#121F43" />
                <rect width="74" height="74" rx="37" fill="#FFC13E" />
                <path
                  d="M44.2727 30.7H47.1818V27.8H44.2727V30.7ZM45.7273 51C43.7151 51 42.0002 50.2929 40.5825 48.8786C39.1648 47.4644 38.4555 45.7549 38.4545 43.75C38.4536 41.7451 39.1629 40.0356 40.5825 38.6213C42.0022 37.2071 43.7171 36.5 45.7273 36.5C47.7374 36.5 49.4528 37.2071 50.8734 38.6213C52.2941 40.0356 53.0029 41.7451 53 43.75C52.9971 45.7549 52.2877 47.4649 50.872 48.8801C49.4562 50.2953 47.7413 51.0019 45.7273 51ZM45 48.1H46.4545V44.475H50.0909V43.025H46.4545V39.4H45V43.025H41.3636V44.475H45V48.1ZM53 36.6812C52.0545 35.6662 50.9515 34.8987 49.6909 34.3786C48.4303 33.8586 47.1091 33.599 45.7273 33.6C45.4606 33.6 45.2119 33.6063 44.9811 33.6188C44.7503 33.6314 44.5142 33.6614 44.2727 33.7087V32.15L34.0909 24.8275V22H53V36.6812ZM21 48.1V33.6L31.1818 26.35L41.3636 33.6V34.5787C39.6182 35.4004 38.2121 36.6513 37.1455 38.3313C36.0788 40.0114 35.5455 41.8176 35.5455 43.75C35.5455 44.4992 35.6245 45.2425 35.7825 45.9801C35.9406 46.7177 36.1888 47.4243 36.5273 48.1H34.0909V39.4H28.2727V48.1H21Z"
                  fill="black" />
              </svg>
            </div>
            <p>
              Quienes ya conocen lo básico y quieren avanzar a un nivel intermedio o avanzado;
            </p>
          </div>


          <div class="quem__item quem__item--meio">
            <div class="quem__circulo-verde">
              <svg width="74" height="74" viewBox="0 0 74 74" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="74" height="74" rx="37" fill="#121F43" />
                <rect width="74" height="74" rx="37" fill="#FFC13E" />
                <path
                  d="M44.2727 30.7H47.1818V27.8H44.2727V30.7ZM45.7273 51C43.7151 51 42.0002 50.2929 40.5825 48.8786C39.1648 47.4644 38.4555 45.7549 38.4545 43.75C38.4536 41.7451 39.1629 40.0356 40.5825 38.6213C42.0022 37.2071 43.7171 36.5 45.7273 36.5C47.7374 36.5 49.4528 37.2071 50.8734 38.6213C52.2941 40.0356 53.0029 41.7451 53 43.75C52.9971 45.7549 52.2877 47.4649 50.872 48.8801C49.4562 50.2953 47.7413 51.0019 45.7273 51ZM45 48.1H46.4545V44.475H50.0909V43.025H46.4545V39.4H45V43.025H41.3636V44.475H45V48.1ZM53 36.6812C52.0545 35.6662 50.9515 34.8987 49.6909 34.3786C48.4303 33.8586 47.1091 33.599 45.7273 33.6C45.4606 33.6 45.2119 33.6063 44.9811 33.6188C44.7503 33.6314 44.5142 33.6614 44.2727 33.7087V32.15L34.0909 24.8275V22H53V36.6812ZM21 48.1V33.6L31.1818 26.35L41.3636 33.6V34.5787C39.6182 35.4004 38.2121 36.6513 37.1455 38.3313C36.0788 40.0114 35.5455 41.8176 35.5455 43.75C35.5455 44.4992 35.6245 45.2425 35.7825 45.9801C35.9406 46.7177 36.1888 47.4243 36.5273 48.1H34.0909V39.4H28.2727V48.1H21Z"
                  fill="black" />
              </svg>
            </div>
            <p>
              Profesionales que necesitan un curso de Excel con certificado para mejorar su CV y sus oportunidades
              laborales;
            </p>
          </div>

          <div class="quem__item">
            <div class="quem__circulo-verde">
              <svg width="74" height="74" viewBox="0 0 74 74" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="74" height="74" rx="37" fill="#121F43" />
                <rect width="74" height="74" rx="37" fill="#FFC13E" />
                <path
                  d="M26.939 20L21 27.1568H24.5634V33.1208H29.3145V27.1568H32.8779L26.939 20ZM43.568 20V25.964H40.0047L45.9436 33.1208L51.8826 25.964H48.3192V20H43.568ZM49.5141 35.2756C49.1221 35.2845 48.756 35.4558 48.2565 35.991L47.7694 36.5105L47.2636 36.0095C46.7152 35.4668 46.2825 35.317 45.8438 35.3364C45.4052 35.3557 44.8895 35.5872 44.3127 36.0561L43.851 36.4311L43.4126 36.0304C42.7519 35.4301 42.1888 35.2523 41.6494 35.2803C41.2569 35.3007 40.8495 35.4492 40.4431 35.709L43.4845 41.2023C44.6318 41.907 46.9761 42.1721 48.5883 41.3563L51.5276 35.8883C50.9701 35.66 50.469 35.4261 50.0359 35.3364C49.8791 35.3038 49.7336 35.2798 49.5927 35.2756C49.5665 35.2749 49.5403 35.2749 49.514 35.2756H49.5141ZM23.9695 35.5064C21 35.5064 21 35.5064 21 38.4884V50.4205C21 53.3984 21 53.3984 23.9695 53.3984H29.9084C32.8779 53.3984 32.8779 53.3984 32.8779 50.4164V38.4884C32.8779 35.5064 32.8779 35.5064 29.9084 35.5064H23.9695ZM42.8349 42.4466V42.4467C41.4961 43.3966 40.421 45.0349 40.0047 47.4344C39.6012 49.7601 40.2368 51.3307 41.3618 52.4011C42.4868 53.4716 44.1755 54.0217 45.8902 53.9993C47.6051 53.977 49.3152 53.3798 50.4651 52.2895C51.615 51.199 52.2654 49.6485 51.8966 47.4297C51.5152 45.1368 50.5306 43.5421 49.2841 42.577C47.1697 43.6994 44.5261 43.4609 42.8349 42.4466Z"
                  fill="black" />
              </svg>
            </div>
            <p>
              Emprendedores que quieren organizar y analizar datos para tomar mejores decisiones en su negocio.
            </p>
          </div>
        </div>

      </div>
    </section> -->

    <section class="secao quem">
      <div class="container">
        <h2>
          <b>¿A quién está dirigido?</b>
        </h2>
        <div class="quem__img-texto">
          <img loading="lazy" src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Home/img-quem.png"
            alt="Título de notícia dizendo: 'Demanda por profissionais na área de dados cresce quase 500%; salários chegam a R$ 22mil'"
            class="quem__img ef-slide ef-slide--visivel" />

          <div class="quem__paragrafos ef-slide ef-slide--visivel">
            <p>Este curso está diseñado para todos los que quieren dominar Excel y usarlo para crecer profesionalmente:
            </p>
            <ul class="quem__lista">
              <li class="quem__item-lista">
                <p>
                  &#9989; Personas que empiezan desde cero y buscan un curso de Excel para principiantes;
                </p>
              </li>
              <li class="quem__item-lista">
                <p>
                  &#9989; Quienes ya conocen lo básico y quieren avanzar a un nivel intermedio o avanzado;
                </p>
              </li>
              <li class="quem__item-lista">
                <p>
                  &#9989; Profesionales que necesitan un curso de Excel con certificado para mejorar su CV y sus
                  oportunidades laborales;
                </p>
              </li>
              <li class="quem__item-lista">
                <p>
                  &#9989; Emprendedores que quieren organizar y analizar datos para tomar mejores decisiones en su
                  negocio.
                </p>
              </li>
            </ul>
            <p>
              <b>
                No importa tu nivel actual: aquí aprenderás desde lo básico hasta las herramientas más avanzadas,
                siempre a tu ritmo.
              </b>
            </p>
          </div>
        </div>
      </div>
    </section>

    <div class="container-luz container-luz--1">
      <section class="secao gratuitos">
        <div class="container">
          <h2>
            Contenido
            <span class="realce-azul"><b> 100% gratuito </b></span>de Hashtag Capacitaciones
          </h2>
          <!-- youtube -->
          <div class="caixa-youtube gratuitos__item ef-slide ef-slide--visivel">
            <div class="caixa-youtube__textos">
              <div class="caixa-youtube__logo-seguidores logo-seguidores">
                <svg width="126" height="28" viewBox="0 0 126 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <g clip-path="url(#clip0_676_13325)">
                    <path
                      d="M39.1618 4.37254C38.7009 2.65052 37.3475 1.29727 35.6255 0.836312C32.5076 2.50339e-07 19.999 0 19.999 0C19.999 0 7.49059 2.50339e-07 4.37252 0.836312C2.65052 1.29727 1.29727 2.65052 0.836312 4.37254C2.5034e-07 7.49059 0 14 0 14C0 14 2.5034e-07 20.5094 0.836312 23.6275C1.29727 25.3495 2.65052 26.7028 4.37252 27.1636C7.49059 28 19.999 28 19.999 28C19.999 28 32.5076 28 35.6255 27.1636C37.3475 26.7028 38.7009 25.3495 39.1618 23.6275C39.9981 20.5094 39.9981 14 39.9981 14C39.9981 14 39.9948 7.49059 39.1618 4.37254Z"
                      fill="#FF0000" />
                    <path d="M15.9961 19.9996L26.3875 14.0006L15.9961 8.00146V19.9996Z" fill="white" />
                    <path
                      d="M48.4437 18.2051L43.9526 1.9859H47.8708L49.4447 9.3382C49.8464 11.1491 50.1394 12.6933 50.3303 13.9708H50.4456C50.5773 13.0555 50.8737 11.5212 51.3313 9.36454L52.9611 1.9859H56.8793L52.3322 18.2051V25.9855H48.4405V18.2051H48.4437Z"
                      fill="white" />
                    <path
                      d="M58.0588 25.4711C57.2687 24.9377 56.7056 24.108 56.3697 22.9819C56.0372 21.8559 55.8694 20.3611 55.8694 18.4909V15.9457C55.8694 14.059 56.0603 12.5412 56.4423 11.3987C56.8242 10.2562 57.4202 9.41988 58.2301 8.89636C59.0401 8.37285 60.1035 8.10944 61.4207 8.10944C62.7179 8.10944 63.755 8.37614 64.5386 8.90954C65.319 9.44292 65.8918 10.2792 66.254 11.4119C66.6162 12.5478 66.7974 14.059 66.7974 15.9457V18.4909C66.7974 20.3611 66.6196 21.8625 66.2673 22.9951C65.9149 24.1311 65.3421 24.9608 64.5518 25.4843C63.7616 26.0079 62.6882 26.2712 61.335 26.2712C59.9389 26.2745 58.8491 26.0045 58.0588 25.4711ZM62.4907 22.7252C62.708 22.1523 62.82 21.2205 62.82 19.9232V14.4608C62.82 13.203 62.7113 12.2811 62.4907 11.7016C62.27 11.1188 61.8849 10.8291 61.3316 10.8291C60.7984 10.8291 60.4197 11.1188 60.2024 11.7016C59.9817 12.2844 59.8731 13.203 59.8731 14.4608V19.9232C59.8731 21.2205 59.9784 22.1555 60.1892 22.7252C60.3999 23.2981 60.7785 23.5845 61.3316 23.5845C61.8849 23.5845 62.27 23.2981 62.4907 22.7252Z"
                      fill="white" />
                    <path
                      d="M79.5425 25.9888H76.4541L76.1117 23.8421H76.0261C75.1864 25.462 73.9286 26.2719 72.2495 26.2719C71.0872 26.2719 70.2279 25.89 69.6747 25.1295C69.1216 24.3655 68.845 23.1737 68.845 21.5538V8.45257H72.7928V21.3232C72.7928 22.1069 72.8784 22.6633 73.0496 22.9959C73.2208 23.3284 73.5073 23.4963 73.9089 23.4963C74.2514 23.4963 74.5806 23.391 74.8968 23.1803C75.2129 22.9694 75.4433 22.7027 75.598 22.3802V8.44928H79.5425V25.9888Z"
                      fill="white" />
                    <path d="M90.2652 5.16262H86.347V25.9881H82.4848V5.16262H78.5667V1.98859H90.2652V5.16262Z"
                      fill="white" />
                    <path
                      d="M99.7879 25.9888H96.6995L96.357 23.8421H96.2715C95.4319 25.462 94.1741 26.2719 92.4948 26.2719C91.3326 26.2719 90.4733 25.89 89.9201 25.1295C89.367 24.3655 89.0903 23.1737 89.0903 21.5538V8.45257H93.0382V21.3232C93.0382 22.1069 93.1237 22.6633 93.295 22.9959C93.4662 23.3284 93.7526 23.4963 94.1544 23.4963C94.4967 23.4963 94.826 23.391 95.1421 23.1803C95.4582 22.9694 95.6887 22.7027 95.8434 22.3802V8.44928H99.7879V25.9888Z"
                      fill="white" />
                    <path
                      d="M112.854 11.2542C112.613 10.1479 112.228 9.3478 111.695 8.85062C111.161 8.35345 110.427 8.1065 109.492 8.1065C108.768 8.1065 108.089 8.31064 107.46 8.72221C106.831 9.13378 106.344 9.67047 106.002 10.3389H105.972V1.09991H102.169V25.9851H105.429L105.83 24.3257H105.916C106.222 24.9183 106.68 25.3826 107.289 25.7284C107.898 26.0708 108.577 26.242 109.321 26.242C110.654 26.242 111.639 25.6263 112.268 24.3981C112.896 23.1667 113.212 21.2471 113.212 18.6329V15.8573C113.212 13.8981 113.091 12.3605 112.854 11.2542ZM109.235 18.4089C109.235 19.6864 109.182 20.6874 109.077 21.4118C108.972 22.1361 108.797 22.6531 108.547 22.956C108.3 23.2621 107.964 23.4136 107.546 23.4136C107.22 23.4136 106.92 23.3379 106.644 23.1832C106.367 23.0317 106.143 22.8013 105.972 22.4983V12.5449C106.104 12.0675 106.334 11.6789 106.66 11.3727C106.983 11.0665 107.339 10.9151 107.717 10.9151C108.119 10.9151 108.428 11.0731 108.646 11.3859C108.866 11.702 109.018 12.2288 109.103 12.9729C109.189 13.717 109.232 14.7739 109.232 16.1469V18.4089H109.235Z"
                      fill="white" />
                    <path
                      d="M118.812 19.4198C118.812 20.5458 118.845 21.3887 118.911 21.9518C118.977 22.5148 119.115 22.9231 119.326 23.1833C119.537 23.44 119.859 23.5684 120.297 23.5684C120.887 23.5684 121.295 23.338 121.512 22.8803C121.733 22.4226 121.851 21.6588 121.871 20.592L125.276 20.7928C125.295 20.9442 125.305 21.1549 125.305 21.4216C125.305 23.0416 124.861 24.2533 123.975 25.0534C123.089 25.8535 121.835 26.2551 120.215 26.2551C118.269 26.2551 116.906 25.646 116.125 24.4245C115.342 23.203 114.953 21.3163 114.953 18.7612V15.6991C114.953 13.0684 115.358 11.1456 116.168 9.9339C116.978 8.72223 118.364 8.11639 120.33 8.11639C121.683 8.11639 122.724 8.36334 123.448 8.86052C124.173 9.35769 124.683 10.1282 124.979 11.1785C125.276 12.2288 125.424 13.6775 125.424 15.5279V18.5308H118.812V19.4198ZM119.313 11.1554C119.112 11.4024 118.98 11.8074 118.911 12.3704C118.845 12.9334 118.812 13.7862 118.812 14.9321V16.1898H121.7V14.9321C121.7 13.806 121.66 12.9532 121.585 12.3704C121.509 11.7876 121.371 11.3793 121.17 11.139C120.969 10.9019 120.659 10.7801 120.241 10.7801C119.82 10.7834 119.51 10.9085 119.313 11.1554Z"
                      fill="white" />
                  </g>
                  <defs>
                    <clipPath id="clip0_676_13325">
                      <rect width="126" height="28" fill="white" />
                    </clipPath>
                  </defs>
                </svg>
                <div class="caixa-youtube__seguidores caixa-pilula caixa-pilula--1">
                  +115k suscriptores
                </div>
              </div>
              <h3>Nuevos vídeos todos los <b>lunes, miércoles y viernes</b></h3>
              <p class="caixa-youtube__paragrafo">
                Contenido gratuito para que te conviertas en un referente en el mercado laboral
              </p>
              <div class="caixa-youtube__links">
                <a class="caixa-pilula caixa-pilula--2" href="https://www.youtube.com/@HashtagCapacitaciones"
                  target="_blank">Canal Hashtag Capacitaciones</a>
              </div>
            </div>
            <div class="caixa-youtube__caixa-img">
              <img loading="lazy" class="caixa-youtube__img"
                src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Home/youtube-gratuitos.webp"
                alt="Laptop con el canal de YouTube de Hashtag Capacitaciones" />
            </div>
          </div>

          <!-- instagram -->
          <div class="caixa-instagram gratuitos__item ef-slide ef-slide--visivel">
            <div class="caixa-instagram__textos">
              <div class="caixa-instagram__logo-seguidores logo-seguidores">
                <svg width="39" height="39" viewBox="0 0 39 39" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M29.8594 0H9.14062C4.0924 0 0 4.0924 0 9.14062V29.8594C0 34.9076 4.0924 39 9.14062 39H29.8594C34.9076 39 39 34.9076 39 29.8594V9.14062C39 4.0924 34.9076 0 29.8594 0Z"
                    fill="url(#paint0_radial_676_13284)" />
                  <path
                    d="M29.8594 0H9.14062C4.0924 0 0 4.0924 0 9.14062V29.8594C0 34.9076 4.0924 39 9.14062 39H29.8594C34.9076 39 39 34.9076 39 29.8594V9.14062C39 4.0924 34.9076 0 29.8594 0Z"
                    fill="url(#paint1_radial_676_13284)" />
                  <path
                    d="M19.5014 4.26562C15.364 4.26562 14.8447 4.28375 13.2198 4.35764C11.5979 4.43198 10.4908 4.68868 9.52225 5.06543C8.52013 5.45452 7.6702 5.97507 6.82348 6.82211C5.97599 7.66898 5.45543 8.51891 5.06513 9.52057C4.68731 10.4895 4.43031 11.597 4.35734 13.2181C4.28467 14.8432 4.26562 15.3626 4.26562 19.5002C4.26562 23.6377 4.28391 24.1553 4.35764 25.7802C4.43229 27.4021 4.68899 28.5092 5.06543 29.4778C5.45482 30.4799 5.97538 31.3298 6.82241 32.1765C7.66898 33.024 8.51891 33.5458 9.52027 33.9349C10.4896 34.3116 11.5969 34.5683 13.2184 34.6427C14.8435 34.7166 15.3623 34.7347 19.4995 34.7347C23.6374 34.7347 24.155 34.7166 25.7799 34.6427C27.4018 34.5683 28.5101 34.3116 29.4794 33.9349C30.4811 33.5458 31.3298 33.024 32.1762 32.1765C33.0237 31.3298 33.5441 30.4799 33.9346 29.4782C34.309 28.5092 34.5662 27.4018 34.6424 25.7805C34.7153 24.1556 34.7344 23.6377 34.7344 19.5002C34.7344 15.3626 34.7153 14.8435 34.6424 13.2184C34.5662 11.5966 34.309 10.4896 33.9346 9.52103C33.5441 8.51891 33.0237 7.66898 32.1762 6.82211C31.3289 5.97477 30.4814 5.45421 29.4785 5.06558C28.5073 4.68868 27.3996 4.43183 25.7778 4.35764C24.1527 4.28375 23.6354 4.26562 19.4966 4.26562H19.5014ZM18.1347 7.01101C18.5404 7.0104 18.993 7.01101 19.5014 7.01101C23.5691 7.01101 24.0511 7.02564 25.6574 7.09861C27.1428 7.16655 27.949 7.41472 28.486 7.62328C29.197 7.89933 29.7038 8.22946 30.2367 8.76281C30.7699 9.29602 31.0999 9.80378 31.3767 10.5148C31.5853 11.051 31.8338 11.8572 31.9014 13.3426C31.9744 14.9486 31.9902 15.4309 31.9902 19.4966C31.9902 23.5624 31.9744 24.0449 31.9014 25.6507C31.8334 27.1361 31.5853 27.9423 31.3767 28.4787C31.1007 29.1897 30.7699 29.6959 30.2367 30.2288C29.7035 30.762 29.1973 31.092 28.486 31.3682C27.9496 31.5777 27.1428 31.8252 25.6574 31.8932C24.0514 31.9661 23.5691 31.982 19.5014 31.982C15.4335 31.982 14.9513 31.9661 13.3455 31.8932C11.8601 31.8246 11.0539 31.5764 10.5164 31.3679C9.80561 31.0917 9.29769 30.7617 8.76449 30.2285C8.23128 29.6953 7.90131 29.1888 7.6245 28.4775C7.41594 27.9411 7.16747 27.1349 7.09983 25.6495C7.02686 24.0435 7.01223 23.5612 7.01223 19.4928C7.01223 15.4247 7.02686 14.9448 7.09983 13.3388C7.16777 11.8534 7.41594 11.0472 7.6245 10.5102C7.9007 9.79921 8.23129 9.29145 8.76464 8.75824C9.29784 8.22504 9.8056 7.89491 10.5166 7.61825C11.0536 7.40878 11.8601 7.16122 13.3455 7.09297C14.7508 7.02944 15.2955 7.0104 18.1347 7.0072V7.01101ZM27.6335 9.54053C26.6242 9.54053 25.8054 10.3586 25.8054 11.368C25.8054 12.3773 26.6242 13.1962 27.6335 13.1962C28.6428 13.1962 29.4616 12.3773 29.4616 11.368C29.4616 10.3588 28.6428 9.53992 27.6335 9.53992V9.54053ZM19.5014 11.6765C15.1809 11.6765 11.6779 15.1795 11.6779 19.5002C11.6779 23.8208 15.1809 27.3221 19.5014 27.3221C23.822 27.3221 27.3238 23.8208 27.3238 19.5002C27.3238 15.1797 23.8217 11.6765 19.5011 11.6765H19.5014ZM19.5014 14.4219C22.3059 14.4219 24.5796 16.6954 24.5796 19.5002C24.5796 22.3046 22.3059 24.5784 19.5014 24.5784C16.6967 24.5784 14.4233 22.3046 14.4233 19.5002C14.4233 16.6954 16.6967 14.4219 19.5014 14.4219Z"
                    fill="white" />
                  <defs>
                    <radialGradient id="paint0_radial_676_13284" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse"
                      gradientTransform="translate(10.3594 42.0038) rotate(-90) scale(38.6519 35.9493)">
                      <stop stop-color="#FFDD55" />
                      <stop offset="0.1" stop-color="#FFDD55" />
                      <stop offset="0.5" stop-color="#FF543E" />
                      <stop offset="1" stop-color="#C837AB" />
                    </radialGradient>
                    <radialGradient id="paint1_radial_676_13284" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse"
                      gradientTransform="translate(-6.53265 2.80937) rotate(78.681) scale(17.2776 71.2189)">
                      <stop stop-color="#3771C8" />
                      <stop offset="0.128" stop-color="#3771C8" />
                      <stop offset="1" stop-color="#6600FF" stop-opacity="0" />
                    </radialGradient>
                  </defs>
                </svg>
                <div class="caixa-instagram__seguidores caixa-pilula caixa-pilula--1">
                  +140K seguidores
                </div>
              </div>
              <h3>
                <b>
                  Visita nuestro perfil en Instagram
                </b>
              </h3>
              <div class="caixa-instagram__links">
                <a class="caixa-pilula caixa-pilula--2" href="https://www.instagram.com/hashtagcapacitaciones/"
                  target="_blank"><svg width="20" height="21" viewBox="0 0 20 21" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M10 14.5C11.0609 14.5 12.0783 14.0786 12.8284 13.3284C13.5786 12.5783 14 11.5609 14 10.5C14 9.43913 13.5786 8.42172 12.8284 7.67157C12.0783 6.92143 11.0609 6.5 10 6.5C8.93913 6.5 7.92172 6.92143 7.17157 7.67157C6.42143 8.42172 6 9.43913 6 10.5C6 11.5609 6.42143 12.5783 7.17157 13.3284C7.92172 14.0786 8.93913 14.5 10 14.5Z"
                      stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path
                      d="M1 14.5V6.5C1 5.17392 1.52678 3.90215 2.46447 2.96447C3.40215 2.02678 4.67392 1.5 6 1.5H14C15.3261 1.5 16.5979 2.02678 17.5355 2.96447C18.4732 3.90215 19 5.17392 19 6.5V14.5C19 15.8261 18.4732 17.0979 17.5355 18.0355C16.5979 18.9732 15.3261 19.5 14 19.5H6C4.67392 19.5 3.40215 18.9732 2.46447 18.0355C1.52678 17.0979 1 15.8261 1 14.5Z"
                      stroke="white" stroke-width="1.5" />
                    <path d="M15.5 5.01L15.51 4.999" stroke="white" stroke-width="1.5" stroke-linecap="round"
                      stroke-linejoin="round" />
                  </svg>
                  <span>Hashtag Capacitaciones</span></a>
              </div>
            </div>
            <img loading="lazy" class="caixa-instagram__img"
              src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Home/instagram-gratuitos.webp"
              alt="Teléfono con el Instagram de Hashtag Capacitaciones" />
          </div>
        </div>
      </section>

      <img loading="lazy" class="luz-gratuitos"
        src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Home/luz-gratuitos.webp" />
    </div>

    <div class="container-luz container-luz--2">

      <section class="secao ajudar">
        <div class="container">
          <img loading="lazy" class="ajudar__img ef-slide ef-slide--visivel"
            src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Home/hashday-2024.webp"
            alt="Equipo de Hashtag detrás de un letrero y frente a un paisaje verde" />
        </div>

        <div class="container ajudar__parte ajudar__parte--1">
          <h2>
            <svg width="44" height="62" viewBox="0 0 44 62" fill="none" xmlns="http://www.w3.org/2000/svg"
              xmlns:xlink="http://www.w3.org/1999/xlink">
              <rect width="43.3948" height="61.0239" fill="url(#pattern0_676_16588)" />
              <defs>
                <pattern id="pattern0_676_16588" patternContentUnits="objectBoundingBox" width="1" height="1">
                  <use xlink:href="#image0_676_16588" transform="matrix(0.00446428 0 0 0.0031746 -0.575893 -1.06667)" />
                </pattern>
                <image id="image0_676_16588" width="1080" height="1080"
                  xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAABDgAAAQ4CAYAAADsEGyPAAAACXBIWXMAAAsTAAALEwEAmpwYAAEhT0lEQVR4nOz9ebRsaXrXd/6e990RcaY7Zt6cMysrs+ZSSSohqRAajJAsQAMIWSAbtxma9oCabmM3bbVtVmOwaTdr2Q2YpWU3bjW025hxmQZj2gZsYxmE1KCSkFSqkkqqMSune/NOZ4yI/b5P/7H3jth7R8QZ7j13iKrvZ63ME3vHjh07dpysVe/vPO/zmrsLAAAAAABgnYVHfQEAAAAAAAD3i4ADAAAAAACsPQIOAAAAAACw9gg4AAAAAADA2iPgAAAAAAAAa4+AAwAAAAAArD0CDgAAAAAAsPYIOAAAAAAAwNoj4AAAAAAAAGuPgAMAAAAAAKw9Ag4AAAAAALD2CDgAAAAAAMDaI+AAAAAAAABrj4ADAAAAAACsPQIOAAAAAACw9gg4AAAAAADA2iPgAAAAAAAAa4+AAwAAAAAArD0CDgAAAAAAsPYIOAAAAAAAwNoj4AAAAAAAAGuPgAMAAAAAAKw9Ag4AAAAAALD2CDgAAAAAAMDaI+AAAAAAAABrj4ADAAAAAACsPQIOAAAAAACw9gg4AAAAAADA2iPgAAAAAAAAa4+AAwAAAAAArD0CDgAAAAAAsPYIOAAAAAAAwNoj4AAAAAAAAGuPgAMAAAAAAKw9Ag4AAAAAALD2CDgAAAAAAMDaI+AAAAAAAABrj4ADAAAAAACsPQIOAAAAAACw9gg4AAAAAADA2iPgAAAAAAAAa4+AAwAAAAAArD0CDgAAAAAAsPYIOAAAAAAAwNoj4AAAAAAAAGuPgAMAAAAAAKw9Ag4AAAAAALD2CDgAAAAAAMDaI+AAAAAAAABrj4ADAAAAAACsPQIOAAAAAACw9gg4AAAAAADA2iPgAAAAAAAAa4+AAwAAAAAArD0CDgAAAAAAsPYIOAAAAAAAwNoj4AAAAAAAAGuPgAMAAAAAAKw9Ag4AAAAAALD2CDgAAAAAAMDaI+AAAAAAAABrj4ADAAAAAACsPQIOAAAAAACw9gg4AAAAAADA2iPgAAAAAAAAa4+AAwAAAAAArD0CDgAAAAAAsPYIOAAAAAAAwNoj4AAAAAAAAGuPgAMAAAAAAKw9Ag4AAAAAALD2CDgAAAAAAMDaI+AAAAAAAABrj4ADAAAAAACsPQIOAAAAAACw9gg4AAAAAADA2iPgAAAAAAAAa4+AAwAAAAAArD0CDgAAAAAAsPYIOAAAAAAAwNoj4AAAAAAAAGuPgAMAAAAAAKw9Ag4AAAAAALD2CDgAAAAAAMDaI+AAAAAAAABrj4ADAAAAAACsPQIOAAAAAACw9gg4AAAAAADA2iPgAAAAAAAAa4+AAwAAAAAArD0CDgAAAAAAsPYIOAAAAAAAwNoj4AAAAAAAAGuPgAMAAAAAAKw9Ag4AAAAAALD2CDgAAAAAAMDaI+AAAAAAAABrj4ADAAAAAACsPQIOAAAAAACw9gg4AAAAAADA2iPgAAAAAAAAa4+AAwAAAAAArD0CDgAAAAAAsPYIOAAAAAAAwNoj4AAAAAAAAGuPgAMAAAAAAKw9Ag4AAAAAALD2CDgAAAAAAMDaI+AAAAAAAABrj4ADAAAAAACsPQIOAAAAAACw9gg4AAAAAADA2iPgAAAAAAAAa4+AAwAAAAAArD0CDgAAAAAAsPYIOAAAAAAAwNoj4AAAAAAAAGuPgAMAAAAAAKw9Ag4AAAAAALD2CDgAAAAAAMDaI+AAAAAAAABrj4ADAAAAAACsPQIOAAAAAACw9gg4AAAAAADA2iPgAAAAAAAAa4+AAwAAAAAArD0CDgAAAAAAsPYIOAAAAAAAwNoj4AAAAAAAAGuPgAMAAAAAAKw9Ag4AAAAAALD2CDgAAAAAAMDaI+AAAAAAAABrj4ADAAAAAACsPQIOAAAAAACw9gg4AAAAAADA2iPgAAAAAAAAa4+AAwAAAAAArD0CDgAAAAAAsPYIOAAAAAAAwNoj4AAAAAAAAGuPgAMAAAAAAKw9Ag4AAAAAALD2CDgAAAAAAMDaI+AAAAAAAABrj4ADAAAAAACsPQIOAAAAAACw9gg4AAAAAADA2iPgAAAAAAAAa4+AAwAAAAAArD0CDgAAAAAAsPYIOAAAAAAAwNoj4AAAAAAAAGuPgAMAAAAAAKw9Ag4AAAAAALD2CDgAAAAAAMDaI+AAAAAAAABrj4ADAAAAAACsPQIOAAAAAACw9gg4AAAAAADA2iPgAAAAAAAAa4+AAwAAAAAArD0CDgAAAAAAsPYIOAAAAAAAwNoj4AAAAAAAAGuPgAMAAAAAAKw9Ag4AAAAAALD2CDgAAAAAAMDaI+AAAAAAAABrj4ADAAAAAACsPQIOAAAAAACw9gg4AAAAAADA2iPgAAAAAAAAa4+AAwAAAAAArD0CDgAAAAAAsPYIOAAAAAAAwNoj4AAAAAAAAGuPgAMAAAAAAKw9Ag4AAAAAALD2CDgAAAAAAMDaI+AAAAAAAABrj4ADAAAAAACsPQIOAAAAAACw9gg4AAAAAADA2iPgAAAAAAAAa4+AAwAAAAAArD0CDgAAAAAAsPYIOAAAAAAAwNoj4AAAAAAAAGuPgAMAAAAAAKw9Ag4AAAAAALD2CDgAAAAAAMDaI+AAAAAAAABrj4ADAAAAAACsPQIOAAAAAACw9gg4AAAAAADA2iPgAAAAAAAAa4+AAwAAAAAArD0CDgAAAAAAsPYIOAAAAAAAwNoj4AAAAAAAAGuPgAMAAAAAAKw9Ag4AAAAAALD2CDgAAAAAAMDaI+AAAAAAAABrj4ADAAAAAACsPQIOAAAAAACw9gg4AAAAAADA2iPgAAAAAAAAa4+AAwAAAAAArD0CDgAAAAAAsPYIOAAAAAAAwNoj4AAAAAAAAGuPgAMAAAAAAKw9Ag4AAAAAALD2CDgAAAAAAMDaI+AAAAAAAABrj4ADAAAAAACsPQIOAAAAAACw9gg4AAAAAADA2iPgAAAAAAAAa4+AAwAAAAAArD0CDgAAAAAAsPYIOAAAAAAAwNoj4AAAAAAAAGuPgAMAAAAAAKw9Ag4AAAAAALD2CDgAAAAAAMDaI+AAAAAAAABrj4ADAAAAAACsPQIOAAAAAACw9gg4AAAAAADA2iPgAAAAAAAAa4+AAwAAAAAArD0CDgAAAAAAsPYIOAAAAAAAwNoj4AAAAAAAAGuPgAMAAAAAAKw9Ag4AAAAAALD2CDgAAAAAAMDaI+AAAAAAAABrj4ADAAAAAACsPQIOAAAAAACw9gg4AAAAAADA2iPgAAAAAAAAa4+AAwAAAAAArD0CDgAAAAAAsPYIOAAAAAAAwNoj4AAAAAAAAGuPgAMAAAAAAKw9Ag4AAAAAALD2CDgAAAAAAMDaI+AAAAAAAABrj4ADAAAAAACsPQIOAAAAAACw9gg4AAAAAADA2iPgAAAAAAAAa4+AAwAAAAAArD0CDgAAAAAAsPYIOAAAAAAAwNoj4AAAAAAAAGuPgAMAAAAAAKw9Ag4AAAAAALD2CDgAAAAAAMDaI+AAAAAAAABrj4ADAAAAAACsPQIOAAAAAACw9gg4AAAAAADA2iPgAAAAAAAAa4+A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AyBwwJzxxfG2W8AuCxj7e1G9Mrm1u8Jx4FNUtkZLtDvEnXLxOy0RUTu9iFpjOIhH27rx/nLkQtn4yvFD0T9yw8rR7g3D+sQtNTpfN+x0j5aI0o32y2fixgfr6qdPHT19+8P9o48Pejc1EY+Np8ZoHAAAcN0pddsLOQAAAIBr34H/h18AAACAJ0vgAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgPYEDAAAASE/gAAAAANITOAAAAID0BA4AAAAgvf8Hy/EUfrI9I/AAAAAASUVORK5CYII=" />
              </defs>
            </svg><b>¿Cómo Hashtag te puede ayudar?</b>
          </h2>
          <div class="ajudar__grid">
            <div class="ajudar__item">
              <img loading="lazy" class="ajudar__check"
                src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Global/check-quadrado.webp"
                alt="Icono check" />
              <span>¿Quieres convertirte en un referente en la empresa donde trabajas?</span>
            </div>
            <div class="ajudar__item">
              <img loading="lazy" class="ajudar__check"
                src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Global/check-quadrado.webp"
                alt="Icono check" />
              <span>¿Quieres destacar en un proceso de selección?</span>
            </div>
            <div class="ajudar__item">
              <img loading="lazy" class="ajudar__check"
                src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Global/check-quadrado.webp"
                alt="Icono check" />
              <span>
                ¿Quieres hacer trabajos freelance y ganar dinero con Excel?
              </span>
            </div>
            <div class="ajudar__item">
              <img loading="lazy" class="ajudar__check"
                src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Global/check-quadrado.webp"
                alt="Icono check" />
              <span>¿Quieres aplicar Excel a tu propio negocio?</span>
            </div>
          </div>
        </div>

        <div class="ajudar__parte ajudar__parte--3">
          <img loading="lazy" class="ajudar__fundo ajudar__fundo--1"
            src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Home/bg-ajudar-1.webp" />
          <img loading="lazy" class="ajudar__fundo ajudar__fundo--2"
            src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Home/bg-ajudar-2.webp" />
          <img loading="lazy" class="ajudar__fundo ajudar__fundo--3"
            src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Home/bg-ajudar-3.webp" />

          <div class="container ajudar__parte ajudar__parte--2">
            <h3>
              Si respondiste <b>'sí'</b> a alguna de estas preguntas, te podemos ayudar.
            </h3>
            <div class="ajudar__cursos-paragrafos">


              <div class="hero__cursos infinite-scroller largura-total">
                <div class="curso">
                  <div class="curso__item">
                    <img loading="lazy"
                      src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Global/Ícone/icone-excel.svg"
                      alt="Icono de Excel" />
                    <p>Excel Impresionante</p>
                  </div>
                  <div class="curso__item">
                    <img loading="lazy"
                      src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Global/Ícone/icone-excel.svg"
                      alt="Icono de Excel" />
                    <p>Excel Impresionante</p>
                  </div>
                  <div class="curso__item">
                    <img loading="lazy"
                      src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Global/Ícone/icone-excel.svg"
                      alt="Icono de Excel" />
                    <p>Excel Impresionante</p>
                  </div>
                  <div class="curso__item">
                    <img loading="lazy"
                      src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Global/Ícone/icone-excel.svg"
                      alt="Icono de Excel" />
                    <p>Excel Impresionante</p>
                  </div>
                  <div class="curso__item">
                    <img loading="lazy"
                      src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Global/Ícone/icone-excel.svg"
                      alt="Icono de Excel" />
                    <p>Excel Impresionante</p>
                  </div>
                  <div class="curso__item">
                    <img loading="lazy"
                      src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Global/Ícone/icone-excel.svg"
                      alt="Icono de Excel" />
                    <p>Excel Impresionante</p>
                  </div>
                  <div class="curso__item">
                    <img loading="lazy"
                      src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Global/Ícone/icone-excel.svg"
                      alt="Icono de Excel" />
                    <p>Excel Impresionante</p>
                  </div>
                  <div class="curso__item">
                    <img loading="lazy"
                      src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Global/Ícone/icone-excel.svg"
                      alt="Icono de Excel" />
                    <p>Excel Impresionante</p>
                  </div>


                </div>
              </div>

              <div class="ajudar__paragrafos">
                <p>
                  Hashtag Capacitaciones fue creada por Hashtag Treinamentos, una empresa brasileña que comenzó en 2016
                  y, actualmente, es una de las empresas más fuertes en capacitación profesional por medio de cursos
                  online.
                </p>
                <p>
                  Tenemos más de 140 mil alumnos capacitados.
                </p>
                <p>
                  En nuestro canal de YouTube Hashtag Treinamentos, tenemos más de 1,5 millón de suscriptores. En
                  nuestro canal Hashtag Capacitaciones, creado hace pocos meses, tenemos ya más de 110 mil suscriptores.
                  En ambos podrás ver muchas reseñas positivas, tanto de nuestros seguidores como de nuestros alumnos.
                </p>
                <p>
                  Todos nuestros programas son súper didácticos, con una satisfacción superior al 98,3% y llevan a
                  cualquiera desde lo básico hasta el nivel impresionante, que está por encima del avanzado.
                </p>
                <p>
                  Además de nuestros cursos online, Hashtag ya realizó capacitaciones in-company en grandes empresas
                  como LinkedIn, L’Oréal, Icatu Seguros, Kempetro y Niely.
                </p>
              </div>
            </div>

            <a class="botao-verde" id="botaoPopup" href="#">
              <span><b>Excel Impresionante</b></span>
              <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20" fill="none">
                <rect width="20" height="20" transform="translate(0.5)" fill="black" fill-opacity="0.01"></rect>
                <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M11.3632 4.19527C11.6236 3.93491 12.0457 3.93491 12.306 4.19527L17.6394 9.5286C17.8997 9.78895 17.8997 10.2111 17.6394 10.4714L12.306 15.8048C12.0457 16.0651 11.6236 16.0651 11.3632 15.8048C11.1029 15.5444 11.1029 15.1223 11.3632 14.8619L15.5585 10.6667H3.83464C3.46645 10.6667 3.16797 10.3682 3.16797 10C3.16797 9.63182 3.46645 9.33334 3.83464 9.33334H15.5585L11.3632 5.13807C11.1029 4.87772 11.1029 4.45562 11.3632 4.19527Z"
                  fill="black"></path>
              </svg>
            </a>


          </div>

        </div>

        <img loading="lazy" class="ajudar__luz"
          src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Home/luz-ajudar.webp" />
      </section>
    </div>

    <section class="secao empresas">
        <div class="container">
          <h2>Empresas que ya confiaron en Hashtag</h2>
          <div class="empresas__imgs">
            <!-- disney -->
            <svg class="empresas__item" width="137" height="57" viewBox="0 0 137 57" fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="M68.826 6.44885C69.7469 6.49192 70.6265 6.84366 71.3232 7.44744C72.2725 8.34617 72.5215 9.84478 72.0721 11.0438C70.3253 14.6395 66.171 17.0411 63.3323 17.8357C61.6339 18.2351 59.487 18.2351 57.9384 17.636C57.1888 18.0853 56.5563 19.5376 55.641 18.9341C54.316 17.8993 55.4629 16.2799 54.6981 15.1308C54.5403 14.8942 54.1431 14.8768 53.9434 14.4897C52.8941 12.1922 54.193 9.99457 55.641 8.24704C58.0549 5.55374 64.9807 2.5529 68.826 6.44885ZM60.7851 8.24631C59.4363 8.49596 57.9131 9.08282 57.0896 10.0445C56.2654 11.0055 55.7415 11.9425 56.2408 12.9411C57.9891 11.643 58.8379 9.84478 60.7859 8.74634C60.7851 8.54589 61.0847 8.3961 60.7851 8.24631ZM68.9265 8.74634C65.48 8.44603 62.8829 11.0438 60.4356 13.5403C60.2859 13.9397 59.3871 14.3891 60.0861 14.8385C63.3829 15.138 66.5292 14.1901 68.9265 11.9918C69.6263 11.3427 70.1241 10.4939 69.7761 9.59441C69.6263 9.24563 69.2739 8.89612 68.9265 8.74634ZM98.7909 23.6289C100.389 27.5249 101.737 33.6669 98.7909 37.4131C97.992 38.3118 96.594 39.1404 95.6953 38.4616C92.3985 35.8154 91.0012 32.0193 88.9533 28.6226C88.6538 28.4728 88.6538 28.873 88.504 29.0228C87.755 32.4686 89.1531 36.9637 86.8064 39.6599C85.9076 39.8097 85.0668 39.3473 84.7585 38.4616C83.6094 34.9159 84.807 31.2197 85.1066 27.674C85.8063 25.8758 86.1059 23.7787 87.6544 22.4299C90.1516 23.4285 91.35 26.226 92.7972 28.2738C93.8472 29.8216 94.6952 31.5699 95.8935 32.9679C96.9421 32.5186 96.4261 31.148 96.3936 30.3209C95.9927 27.0748 95.0939 24.0783 94.2444 20.982C94.1959 20.1831 93.7466 18.8343 94.5939 18.335C96.8444 19.3343 97.7916 21.681 98.7909 23.6289ZM83.7086 22.4299C83.7086 23.1796 83.1094 24.1159 82.6087 24.2281C77.8147 24.977 72.4708 24.5277 67.9764 26.0256C67.8267 26.5748 68.4757 26.6746 68.8252 26.8244C72.6698 27.4236 76.7163 27.5734 80.4624 28.5228C82.443 29.0257 83.1601 31.3702 83.3099 33.3174C83.4018 34.853 82.8113 36.7134 81.312 37.7626C77.6172 40.11 71.9737 40.0094 68.2268 37.8632C66.7948 37.06 65.43 35.7662 65.3302 34.1677C65.3389 32.8985 65.8801 31.8991 66.7789 31.4208C70.3752 29.9722 74.8197 30.7725 77.9167 32.6191C78.115 33.6185 77.0339 33.5642 76.5166 33.918C73.07 35.9159 70.4736 31.6719 67.2774 33.2183C66.8281 33.5179 66.5032 34.3537 67.0278 34.6171C70.9729 36.3653 75.3682 35.1163 79.2634 34.0179C79.7128 33.8681 80.2627 33.4187 80.3119 32.9694C80.1621 31.3709 78.3647 31.0221 77.2156 30.5728C73.8196 29.724 70.0742 29.724 66.4279 29.3745C65.7289 29.2247 64.8381 28.7377 64.6304 28.1761C64.231 26.9778 64.231 25.3294 65.1297 24.3308C69.7739 20.2352 76.8154 20.5854 82.7085 21.6839C83.1087 21.8308 83.5581 21.9805 83.7086 22.4299ZM61.8843 24.328C62.3337 29.1219 62.5833 33.5678 62.4835 38.6114C62.3836 39.2598 61.6347 39.4103 61.1354 39.6599C60.3365 39.8097 59.3039 39.6397 58.9877 39.2106C57.8393 37.3617 58.2387 34.866 58.1389 32.6184C58.2887 29.0734 58.2387 25.2274 59.2381 21.9306C59.4291 21.4516 59.987 21.0319 60.4364 21.3307C61.6347 21.9306 61.8344 23.1296 61.8843 24.328ZM117.371 23.6289C117.611 24.0327 117.863 24.6565 117.371 24.9271C115.124 25.9257 112.078 25.4763 109.48 25.7759C108.781 26.3751 108.231 27.3737 108.48 28.2731C108.731 28.4229 108.955 28.6508 109.231 28.6219C110.828 28.7225 113.226 27.8729 114.276 29.3708C114.532 29.8166 114.241 31.4809 113.527 31.5185C111.578 31.7696 108.374 31.2739 107.432 31.7696C106.234 32.5685 106.333 34.1163 105.884 35.366C106.733 35.9152 107.623 35.353 108.63 35.2155C110.479 34.9159 112.527 34.3667 114.374 34.7661C114.723 35.4152 115.223 36.1149 114.873 36.9138C111.725 39.411 107.664 41.9704 103.337 40.1599C101.714 39.432 100.99 36.9637 101.54 34.8674C101.889 33.3688 103.437 31.9209 102.489 30.3224C102.339 29.6226 102.739 29.0242 103.338 28.8744C104.986 28.8744 104.636 26.8266 105.485 25.8772C104.536 24.8287 102.14 24.8786 102.389 22.7809C103.539 22.1817 104.937 22.3814 106.234 22.1817C109.181 21.5818 112.477 21.2323 115.475 21.5818C116.072 21.702 116.872 22.88 117.371 23.6289ZM46.0523 12.2421C50.661 16.0093 56.6403 22.4306 55.8913 29.8216C54.9919 35.6656 48.7992 40.0601 43.5551 41.4588C38.4609 42.9567 32.0684 42.8069 26.8736 41.6086C26.5241 42.558 26.1746 43.7057 25.0761 44.1058C24.3771 44.3555 23.4777 44.2057 22.9285 43.7563C21.3806 42.3076 22.6289 39.5109 20.3813 38.6129C15.9861 36.7647 11.2413 33.1184 8.9945 28.6241C8.69493 27.7253 9.04443 26.8266 9.59366 26.1276C13.0402 23.3807 17.3848 22.2823 21.7301 21.4328C21.9798 21.5326 21.8799 21.1831 22.0797 21.0833C22.3293 18.0868 22.4292 15.0396 23.3778 12.3427C23.5942 11.9643 24.1268 11.8434 24.477 12.0931C27.2238 14.1901 25.9249 18.1367 27.124 20.9827C32.368 21.2323 37.6121 21.482 41.7569 24.4293C43.1557 25.5776 43.4965 27.7709 43.0551 29.0242C42.6144 30.2754 41.1578 31.1719 39.809 31.2703C38.9095 31.2703 37.2119 31.3579 37.3118 30.6719C37.4116 29.9852 40.3669 28.8614 39.4595 27.9243C38.1548 26.5777 31.627 25.7766 27.5813 25.2773C27.082 25.1775 26.624 25.3273 26.624 25.8765C26.5241 29.6719 26.2245 33.8667 26.8736 37.5137C26.9235 37.7641 27.2231 38.0636 27.4735 38.1121C34.6149 39.2612 42.1564 38.6114 47.7499 34.5165C50.347 32.4202 51.1965 29.4714 50.7464 26.226C48.4989 17.1866 39.06 11.7421 31.3188 8.24631C23.778 4.95024 15.4369 3.25192 6.49731 3.70201C5.07395 3.80621 2.81844 4.29754 2.8018 4.80118C2.78516 5.30481 5.35689 5.14634 5.04863 6.09934C4.74109 7.05162 2.12739 6.48648 1.35312 6.24913C0.578851 6.01179 0.654107 4.90031 0.853825 4.2013C2.8018 0.755442 8.2376 0.476851 10.6928 0.356007C24.2766 0.0057767 37.4124 5.17891 46.0523 12.2421ZM21.5804 25.6268C18.1338 25.6768 14.4882 26.0263 11.292 27.2246C10.6429 27.4742 9.84331 28.1732 10.3426 29.0228C11.6408 30.7703 13.4976 32.2052 15.2371 33.2176C16.9767 34.2285 19.2829 35.5151 21.3806 35.8154C21.8799 32.5685 21.8799 29.3723 21.83 26.0263C21.6296 25.9264 21.8293 25.7267 21.5804 25.6268ZM124.811 21.0818C124.662 25.4264 120.615 28.124 120.615 32.4686C120.765 32.6184 120.866 32.8181 121.065 32.7197C124.312 29.1733 127.508 24.129 132.252 22.6311C133.503 22.5312 134.632 23.6174 135.1 24.4293C136.748 27.7253 136.35 32.3702 134.052 35.3667C131.681 38.3082 127.558 41.2598 122.866 40.7598C120.918 45.5545 119.567 50.5988 118.818 55.8429C118.419 56.8914 117.471 55.9427 116.872 55.743C112.827 52.5468 116.148 44.0856 116.423 43.0059C116.697 41.9292 117.779 39.3893 118.571 37.2626C116.673 33.8674 117.871 29.771 119.419 26.6247C120.617 24.527 122.267 22.4292 124.214 20.8314C124.462 20.8322 124.662 20.8821 124.811 21.0818ZM132.854 26.4756C132.255 26.3758 132.004 27.1754 131.506 27.3252C129.209 29.9222 126.911 32.5193 125.762 35.6156C127.311 35.8154 128.608 34.8168 129.958 34.2675C132.255 32.8189 133.703 30.423 133.553 27.6754C133.453 27.2246 133.053 26.8751 132.854 26.4756Z"
                fill="white" />
            </svg>
            <!-- vale -->
            <svg class="empresas__item" width="110" height="44" viewBox="0 0 110 44" fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" clip-rule="evenodd"
                d="M51.0508 13.7905C43.5443 19.4251 36.5978 18.8179 30.207 11.971C43.1615 7.00545 49.9875 -0.666781 56.6372 5.91166L51.7052 12.9673H51.6968V12.9778H51.6884L51.6874 12.9788V12.9893H51.6769V12.9924H51.6685C51.6633 12.9924 51.6654 12.9987 51.6622 12.9987V13.0019H51.6612V13.005H51.6591L51.658 13.0113H51.6559L51.6538 13.0155C51.6538 13.0187 51.6496 13.0187 51.6496 13.0207H51.6475V13.026C51.6381 13.026 51.6318 13.0396 51.6266 13.0396L51.6245 13.0449L51.6203 13.0533L51.6108 13.0596V13.0627H51.6087C51.6087 13.069 51.5962 13.0847 51.5909 13.0879V13.09H51.5888V13.1057H51.5857V13.1099H51.5836V13.1172L51.5783 13.1193H51.5762L51.571 13.1235V13.1256C51.5678 13.1267 51.5657 13.1288 51.5657 13.134L51.5626 13.1382L51.55 13.1434V13.1455L51.5469 13.1476C51.5229 13.174 51.5008 13.2021 51.4808 13.2315L51.4787 13.2357H51.4766C51.4766 13.242 51.4703 13.2494 51.4703 13.2588L51.4693 13.2619C51.4598 13.2661 51.442 13.2871 51.4315 13.2871V13.2903C51.4126 13.2997 51.3969 13.3165 51.3759 13.3249V13.328H51.3686V13.3312H51.3665L51.3633 13.3375C51.3592 13.3375 51.3581 13.3406 51.3539 13.3406V13.3427L51.3382 13.3532V13.3584H51.335V13.3605C51.3254 13.3687 51.3148 13.3757 51.3036 13.3815L51.291 13.3972H51.2878V13.4004L51.2836 13.4088V13.4119H51.2774C51.2774 13.5399 51.097 13.587 51.097 13.6699H51.0938C51.0938 13.6793 51.0729 13.6982 51.0729 13.7108H51.0697C51.0666 13.715 51.0561 13.7255 51.0561 13.7297H51.0529C51.0445 13.7391 51.0508 13.779 51.0508 13.7905Z"
                fill="#ECB833" />
              <path fill-rule="evenodd" clip-rule="evenodd"
                d="M51.7158 12.9538C32.143 30.6683 24.4687 -11.2333 0.105469 4.62505L27.5581 43.7014" fill="#00939A" />
              <path fill-rule="evenodd" clip-rule="evenodd"
                d="M62.9266 38.5228L56.2255 23.9942L58.9416 23.904L63.7425 34.6091L67.7275 23.8138L70.3534 23.903L64.4661 38.5113L62.9266 38.5228ZM74.0658 38.5113L71.1683 38.42L77.4164 23.903H79.4991L85.3854 38.5113L82.578 38.42L81.4035 34.8828H75.2435L74.0658 38.5113ZM80.1795 32.6145H76.4661L78.5488 27.4885L80.1795 32.6145Z"
                fill="white" />
              <path
                d="M89.4637 38.3298V24.4713H92.0278V35.9755H98.4038V38.3298M101.61 38.2396V24.1766H109.909V25.2631C109.304 25.6406 108.73 26.1188 108.169 26.5561H103.81V29.6728H109.28V32.0429H103.81V35.8685H109.895V38.2396"
                fill="white" />
            </svg>
            <!-- globo -->
            <svg class="empresas__item" width="77" height="67" viewBox="0 0 77 67" fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" clip-rule="evenodd"
                d="M38.4192 0.527039C27.1304 0.527039 17.9683 9.74765 17.9683 21.0354C17.9683 32.3439 27.1304 41.5659 38.4192 41.5659C49.7307 41.5659 58.8915 32.3439 58.8915 21.0354C58.8915 9.74765 49.7307 0.527039 38.4192 0.527039ZM36.6868 10.8017C37.2687 10.7999 37.8465 10.8008 38.4192 10.8039C43.0223 10.7805 47.9542 10.8915 52.3811 11.3743C53.6756 11.506 54.3535 11.8136 54.5084 13.2184C54.748 15.7654 54.7713 18.3784 54.7713 21.0354C54.7713 23.7143 54.7479 26.3274 54.5084 28.8743C54.3535 30.2797 53.6756 30.5874 52.3811 30.7191C47.9542 31.2022 43.0223 31.2898 38.4192 31.2898C33.838 31.2898 28.9059 31.2023 24.4781 30.7191C23.1851 30.5874 22.5054 30.2797 22.352 28.8743C22.1109 26.3274 22.089 23.7143 22.089 21.0354C22.089 18.3784 22.1109 15.7654 22.352 13.2184C22.5054 11.8136 23.1851 11.506 24.4781 11.3743C28.3524 10.9519 32.6132 10.8139 36.6868 10.8017ZM38.4192 12.7353C33.8161 12.7353 30.1114 16.4682 30.1114 21.0354C30.1114 25.6245 33.8161 29.3355 38.4192 29.3355C43.0442 29.3355 46.7484 25.6245 46.7484 21.0354C46.7484 16.4682 43.0442 12.7353 38.4192 12.7353ZM33.4689 46.9259C28.1786 46.9259 23.8613 51.2427 23.8613 56.5328C23.8613 61.8231 28.1786 66.1399 33.4689 66.1399C38.759 66.1399 43.0753 61.8231 43.0753 56.5328C43.0753 51.2427 38.759 46.9259 33.4689 46.9259ZM66.4305 46.9259C61.1405 46.9259 56.8225 51.2427 56.8225 56.5328C56.8225 61.8231 61.1405 66.1399 66.4305 66.1399C71.7201 66.1399 76.0367 61.8231 76.0367 56.5328C76.0367 51.2427 71.7201 46.9259 66.4305 46.9259ZM10.0497 46.9304C4.93506 47.039 0.92175 51.4168 0.908813 56.1372C0.908813 61.9142 5.53698 65.6353 10.1967 65.6353H23.8439V61.5375H18.2802L26.7912 47.4298H21.3186V47.4301L16.6926 55.1168H10.0497V59.1H14.578C13.7146 60.3821 12.5436 61.2977 10.4205 61.2851C7.96685 61.2709 5.62839 59.6559 5.62839 56.262C5.62839 53.3809 8.11401 51.4477 10.322 51.4489C12.0089 51.4503 14.0675 51.9531 15.4615 54.2655L17.9464 50.1521C15.8786 47.9613 13.5865 46.9304 10.0497 46.9304ZM43.9452 47.43V65.6353H50.5697C54.2593 65.6353 56.3271 63.2074 56.3271 60.0632C56.3271 58.3998 55.5288 56.7809 53.9808 55.973C55.1966 55.078 55.6577 53.9612 55.6488 52.2973C55.6364 50.0045 54.0844 47.43 50.003 47.43H43.9452ZM48.5968 51.4112L49.9064 51.4121C50.5894 51.4128 51.3984 51.9333 51.4 52.8954C51.4012 53.8244 50.7671 54.4859 49.8876 54.4859H48.5968V51.4112ZM33.4689 51.6612C36.1516 51.6612 38.3395 53.8501 38.3395 56.5328C38.3395 59.2147 36.1516 61.4048 33.4689 61.4048C30.786 61.4048 28.5976 59.215 28.5976 56.5328C28.5976 53.8501 30.786 51.6612 33.4689 51.6612ZM66.4305 51.6612C69.1125 51.6612 71.3016 53.8501 71.3016 56.5328C71.3016 59.2147 69.1125 61.4048 66.4305 61.4048C63.7481 61.4048 61.5583 59.215 61.5583 56.5328C61.5583 53.8501 63.7481 51.6612 66.4305 51.6612ZM48.5968 57.9779H50.0622C51.164 57.9779 51.9316 58.8131 51.9316 59.8077C51.9316 60.7241 51.1676 61.6119 50.1677 61.6119H48.5968V57.9779Z"
                fill="#00AEEF" />
            </svg>
            <!-- yamaha -->
            <svg class="empresas__item" width="199" height="46" viewBox="0 0 199 46" fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="M22.4698 24.2459L21.6793 23.7892V22.8765L22.4698 22.4198L23.2603 22.8765V23.7892L22.4698 24.2459ZM22.9136 15.7363C23.0315 15.8557 23.0982 16.0164 23.0995 16.1842V18.9532L22.4709 19.3161L21.8413 18.953V16.1839C21.8423 16.0165 21.9087 15.856 22.0265 15.737C22.141 15.6228 22.3063 15.5543 22.4698 15.5543C22.6351 15.5543 22.8007 15.6228 22.9136 15.7363ZM15.7323 27.2201C15.6492 27.0762 15.626 26.9055 15.6675 26.7447C15.7127 26.584 15.8184 26.4471 15.9623 26.3626C15.9626 26.3624 15.963 26.3623 15.9633 26.3621L18.3601 24.9781L18.9897 25.3411V26.0667L16.5928 27.4508C16.4467 27.5329 16.2746 27.5555 16.1122 27.5138C15.952 27.4696 15.8155 27.3641 15.7323 27.2201ZM25.9486 25.3411L26.5782 24.9781L28.9747 26.3619C28.9751 26.3621 28.9754 26.3623 28.9758 26.3625C29.1196 26.4471 29.2244 26.5849 29.2676 26.7461C29.3107 26.9071 29.2889 27.0785 29.2069 27.2235C29.1227 27.3671 28.9858 27.4722 28.8254 27.5165C28.6635 27.5586 28.4916 27.5361 28.3461 27.4536C28.3458 27.4534 28.3454 27.4532 28.3451 27.453L25.9486 26.0692V25.3411Z"
                fill="white" stroke="white" stroke-width="0.885798" />
              <path
                d="M37.97 7.83557L37.97 7.83562C42.028 11.8936 44.3893 17.5932 44.3893 23.3347C44.3893 29.0725 42.028 34.7733 37.9701 38.8312L37.97 7.83557ZM37.97 7.83557C33.9107 3.77762 28.21 1.41628 22.4697 1.41628C16.7294 1.41628 11.0286 3.77762 6.97061 7.83562C2.91262 11.8936 0.551269 17.5932 0.551269 23.3347C0.551269 29.0737 2.9126 34.7732 6.97052 38.8312C11.0286 42.8918 16.7294 45.2531 22.4697 45.2531C28.2099 45.2531 33.9108 42.8918 37.97 38.8313L37.97 7.83557ZM6.92144 7.78407L6.92149 7.78402C10.9903 3.71521 16.7145 1.34329 22.4697 1.34329C28.2249 1.34329 33.9491 3.71521 38.0192 7.78407C42.0879 11.8528 44.4599 17.5782 44.4599 23.3347C44.4599 29.0887 42.0879 34.8128 38.0191 38.8817L38.019 38.8818C33.9491 42.9541 28.2262 45.3236 22.4697 45.3236C16.7145 45.3236 10.9903 42.9517 6.92153 38.8817L6.92144 38.8816C2.85143 34.8128 0.47952 29.0886 0.47952 23.3347C0.47952 17.5782 2.85146 11.8528 6.92144 7.78407Z"
                fill="white" stroke="white" stroke-width="0.885798" />
              <mask id="path-3-inside-1_676_13628" fill="white">
                <path
                  d="M37.969 32.5018C37.9068 32.5307 37.8373 32.5398 37.7698 32.5278L33.0588 31.6457C32.9424 31.6238 32.8365 31.5642 32.7573 31.4761C32.6782 31.388 32.6302 31.2763 32.6208 31.1583C32.5924 30.8192 32.4621 30.4967 32.2472 30.2329C32.0297 29.9716 31.7376 29.7829 31.41 29.6921C31.0824 29.6012 30.7348 29.6125 30.4138 29.7244C29.8399 29.9267 29.2291 30.0023 28.6233 29.9461C28.0174 29.89 27.4309 29.7033 26.904 29.3991L25.5085 28.5962V37.7621H23.5427V27.4605L22.4701 26.8419L21.3975 27.4605V37.7621H19.4329V28.5962L18.0362 29.3991C17.5094 29.7037 16.9229 29.8906 16.317 29.9467C15.7111 30.0029 15.1002 29.9271 14.5264 29.7244C14.2866 29.6396 14.0306 29.611 13.778 29.641C13.5254 29.671 13.2831 29.7587 13.0699 29.8973C12.8566 30.0359 12.6781 30.2217 12.5482 30.4404C12.4183 30.6591 12.3404 30.9047 12.3206 31.1583C12.3113 31.2762 12.2635 31.3877 12.1846 31.4758C12.1057 31.5639 12 31.6236 11.8839 31.6457L7.17162 32.5278C7.12142 32.5366 7.06986 32.5339 7.0209 32.5197C6.97193 32.5055 6.92685 32.4804 6.88912 32.4461C6.85139 32.4118 6.822 32.3694 6.8032 32.322C6.78441 32.2746 6.77671 32.2236 6.78069 32.1727C6.78713 32.1044 6.81432 32.0396 6.85863 31.9872L9.97746 28.35C10.0539 28.2596 10.1582 28.1972 10.2739 28.1723C10.3896 28.1475 10.5103 28.1617 10.6171 28.2126C10.9226 28.3574 11.2715 28.4056 11.6043 28.35C11.9371 28.2943 12.2513 28.1347 12.4926 27.8984C12.7338 27.6634 12.8996 27.3504 12.9627 27.0188C13.0736 26.4204 13.3132 25.8531 13.6647 25.3563C14.0163 24.8595 14.4716 24.4449 14.999 24.1412L16.3957 23.3371L8.45578 18.7535L9.43806 17.0524L18.3603 22.2039L19.4329 21.5853V20.3469L10.5107 15.1955L11.4917 13.4944L19.4317 18.078V16.4635C19.4317 15.8586 19.5641 15.2524 19.8164 14.7006C20.0713 14.1501 20.4437 13.6552 20.9039 13.2606C21.1614 13.0383 21.3448 12.7426 21.4297 12.4132C21.5146 12.0838 21.4969 11.7363 21.3789 11.4172C21.2584 11.0994 21.0445 10.8256 20.7653 10.6316C20.6683 10.5639 20.5961 10.4664 20.5595 10.3539C20.5229 10.2414 20.5239 10.12 20.5624 10.0081L22.1546 5.48762C22.1777 5.42303 22.2202 5.36713 22.2762 5.32751C22.3322 5.28789 22.399 5.26647 22.4676 5.26617C22.5362 5.26647 22.6031 5.28789 22.6591 5.32751C22.7151 5.36713 22.7575 5.42303 22.7806 5.48762L24.3741 10.0081C24.4126 10.12 24.4136 10.2414 24.377 10.3539C24.3404 10.4664 24.2682 10.5639 24.1712 10.6316C23.8915 10.8253 23.6779 11.1 23.5589 11.4187C23.4399 11.7373 23.4213 12.0848 23.5056 12.4144C23.5897 12.741 23.7765 13.0404 24.0326 13.2606C24.4943 13.6569 24.865 14.1483 25.1193 14.7011C25.3736 15.2539 25.5055 15.855 25.506 16.4635V18.0768L33.446 13.4932L34.4283 15.1942L25.506 20.3457V21.584L26.5786 22.2026L35.5009 17.0512L36.4832 18.7522L28.5445 23.3358L29.9412 24.14C30.4678 24.4449 30.9224 24.8598 31.274 25.3564C31.6256 25.853 31.866 26.4196 31.9788 27.0176C32.0406 27.3491 32.2076 27.6621 32.4476 27.8972C32.6889 28.1335 33.0044 28.2931 33.3359 28.3487C33.6699 28.4044 34.0188 28.3562 34.3231 28.2114C34.43 28.1606 34.5506 28.1466 34.6663 28.1714C34.7819 28.1962 34.8862 28.2586 34.9627 28.3487L38.0816 31.9859C38.1257 32.0382 38.1527 32.1028 38.1589 32.171C38.1651 32.2391 38.1502 32.3075 38.1162 32.367C38.0833 32.4268 38.0315 32.4742 37.969 32.5018ZM35.9426 9.85967C32.4155 6.33135 27.4583 4.27893 22.4689 4.27893C17.4807 4.27893 12.5235 6.33258 8.99517 9.85967C5.46684 13.388 3.41443 18.3452 3.41443 23.3346C3.41443 28.3215 5.46684 33.2812 8.99517 36.8095C12.5235 40.3354 17.4807 42.389 22.4689 42.389C27.457 42.389 32.4155 40.3354 35.9426 36.8095C39.4709 33.2812 41.5245 28.324 41.5245 23.3346C41.5245 18.3452 39.4709 13.388 35.9426 9.85967ZM151.752 42.0266V4.63894H158.298V18.97H165.466V4.63894H172.158V42.0266H165.466V25.6109H158.298V42.0266H151.752ZM55.9954 27.5656L48.7272 4.63894H55.2593L59.734 19.205L64.6801 4.63894H70.8015L63.2673 26.8209V42.0266H55.9954V27.5656ZM94.8824 42.0266H100.745V13.8445L105.747 38.3448H111.221L115.658 13.4486V42.0266H122.531V4.63894H111.879L108.741 22.4241L105.104 4.63894H94.8824V42.0266ZM183.699 27.0955L186.486 10.3743L189.19 27.0955H183.699ZM192.108 4.63894H181.983L175.149 42.0266H181.208L182.659 33.3257H190.197L191.606 42.0266H198.28L192.108 4.63894ZM134.07 27.0955L136.857 10.3743L139.562 27.0955H134.07ZM142.48 4.63894H132.355L125.523 42.0266H131.581L133.031 33.3257H140.568L141.975 42.0266H148.651L142.48 4.63894ZM77.2 27.0955L79.9872 10.3743L82.6916 27.0955H77.2ZM85.61 4.63894H75.4853L68.6513 42.0266H74.7121L76.162 33.3257H83.6986L85.1065 42.0266H91.7809L85.61 4.63894Z" />
              </mask>
              <path
                d="M37.969 32.5018C37.9068 32.5307 37.8373 32.5398 37.7698 32.5278L33.0588 31.6457C32.9424 31.6238 32.8365 31.5642 32.7573 31.4761C32.6782 31.388 32.6302 31.2763 32.6208 31.1583C32.5924 30.8192 32.4621 30.4967 32.2472 30.2329C32.0297 29.9716 31.7376 29.7829 31.41 29.6921C31.0824 29.6012 30.7348 29.6125 30.4138 29.7244C29.8399 29.9267 29.2291 30.0023 28.6233 29.9461C28.0174 29.89 27.4309 29.7033 26.904 29.3991L25.5085 28.5962V37.7621H23.5427V27.4605L22.4701 26.8419L21.3975 27.4605V37.7621H19.4329V28.5962L18.0362 29.3991C17.5094 29.7037 16.9229 29.8906 16.317 29.9467C15.7111 30.0029 15.1002 29.9271 14.5264 29.7244C14.2866 29.6396 14.0306 29.611 13.778 29.641C13.5254 29.671 13.2831 29.7587 13.0699 29.8973C12.8566 30.0359 12.6781 30.2217 12.5482 30.4404C12.4183 30.6591 12.3404 30.9047 12.3206 31.1583C12.3113 31.2762 12.2635 31.3877 12.1846 31.4758C12.1057 31.5639 12 31.6236 11.8839 31.6457L7.17162 32.5278C7.12142 32.5366 7.06986 32.5339 7.0209 32.5197C6.97193 32.5055 6.92685 32.4804 6.88912 32.4461C6.85139 32.4118 6.822 32.3694 6.8032 32.322C6.78441 32.2746 6.77671 32.2236 6.78069 32.1727C6.78713 32.1044 6.81432 32.0396 6.85863 31.9872L9.97746 28.35C10.0539 28.2596 10.1582 28.1972 10.2739 28.1723C10.3896 28.1475 10.5103 28.1617 10.6171 28.2126C10.9226 28.3574 11.2715 28.4056 11.6043 28.35C11.9371 28.2943 12.2513 28.1347 12.4926 27.8984C12.7338 27.6634 12.8996 27.3504 12.9627 27.0188C13.0736 26.4204 13.3132 25.8531 13.6647 25.3563C14.0163 24.8595 14.4716 24.4449 14.999 24.1412L16.3957 23.3371L8.45578 18.7535L9.43806 17.0524L18.3603 22.2039L19.4329 21.5853V20.3469L10.5107 15.1955L11.4917 13.4944L19.4317 18.078V16.4635C19.4317 15.8586 19.5641 15.2524 19.8164 14.7006C20.0713 14.1501 20.4437 13.6552 20.9039 13.2606C21.1614 13.0383 21.3448 12.7426 21.4297 12.4132C21.5146 12.0838 21.4969 11.7363 21.3789 11.4172C21.2584 11.0994 21.0445 10.8256 20.7653 10.6316C20.6683 10.5639 20.5961 10.4664 20.5595 10.3539C20.5229 10.2414 20.5239 10.12 20.5624 10.0081L22.1546 5.48762C22.1777 5.42303 22.2202 5.36713 22.2762 5.32751C22.3322 5.28789 22.399 5.26647 22.4676 5.26617C22.5362 5.26647 22.6031 5.28789 22.6591 5.32751C22.7151 5.36713 22.7575 5.42303 22.7806 5.48762L24.3741 10.0081C24.4126 10.12 24.4136 10.2414 24.377 10.3539C24.3404 10.4664 24.2682 10.5639 24.1712 10.6316C23.8915 10.8253 23.6779 11.1 23.5589 11.4187C23.4399 11.7373 23.4213 12.0848 23.5056 12.4144C23.5897 12.741 23.7765 13.0404 24.0326 13.2606C24.4943 13.6569 24.865 14.1483 25.1193 14.7011C25.3736 15.2539 25.5055 15.855 25.506 16.4635V18.0768L33.446 13.4932L34.4283 15.1942L25.506 20.3457V21.584L26.5786 22.2026L35.5009 17.0512L36.4832 18.7522L28.5445 23.3358L29.9412 24.14C30.4678 24.4449 30.9224 24.8598 31.274 25.3564C31.6256 25.853 31.866 26.4196 31.9788 27.0176C32.0406 27.3491 32.2076 27.6621 32.4476 27.8972C32.6889 28.1335 33.0044 28.2931 33.3359 28.3487C33.6699 28.4044 34.0188 28.3562 34.3231 28.2114C34.43 28.1606 34.5506 28.1466 34.6663 28.1714C34.7819 28.1962 34.8862 28.2586 34.9627 28.3487L38.0816 31.9859C38.1257 32.0382 38.1527 32.1028 38.1589 32.171C38.1651 32.2391 38.1502 32.3075 38.1162 32.367C38.0833 32.4268 38.0315 32.4742 37.969 32.5018ZM35.9426 9.85967C32.4155 6.33135 27.4583 4.27893 22.4689 4.27893C17.4807 4.27893 12.5235 6.33258 8.99517 9.85967C5.46684 13.388 3.41443 18.3452 3.41443 23.3346C3.41443 28.3215 5.46684 33.2812 8.99517 36.8095C12.5235 40.3354 17.4807 42.389 22.4689 42.389C27.457 42.389 32.4155 40.3354 35.9426 36.8095C39.4709 33.2812 41.5245 28.324 41.5245 23.3346C41.5245 18.3452 39.4709 13.388 35.9426 9.85967ZM151.752 42.0266V4.63894H158.298V18.97H165.466V4.63894H172.158V42.0266H165.466V25.6109H158.298V42.0266H151.752ZM55.9954 27.5656L48.7272 4.63894H55.2593L59.734 19.205L64.6801 4.63894H70.8015L63.2673 26.8209V42.0266H55.9954V27.5656ZM94.8824 42.0266H100.745V13.8445L105.747 38.3448H111.221L115.658 13.4486V42.0266H122.531V4.63894H111.879L108.741 22.4241L105.104 4.63894H94.8824V42.0266ZM183.699 27.0955L186.486 10.3743L189.19 27.0955H183.699ZM192.108 4.63894H181.983L175.149 42.0266H181.208L182.659 33.3257H190.197L191.606 42.0266H198.28L192.108 4.63894ZM134.07 27.0955L136.857 10.3743L139.562 27.0955H134.07ZM142.48 4.63894H132.355L125.523 42.0266H131.581L133.031 33.3257H140.568L141.975 42.0266H148.651L142.48 4.63894ZM77.2 27.0955L79.9872 10.3743L82.6916 27.0955H77.2ZM85.61 4.63894H75.4853L68.6513 42.0266H74.7121L76.162 33.3257H83.6986L85.1065 42.0266H91.7809L85.61 4.63894Z"
                fill="white" stroke="white" stroke-width="1.7716" mask="url(#path-3-inside-1_676_13628)" />
            </svg>
            <!-- petrobras -->
            <svg class="empresas__item" width="229" height="45" viewBox="0 0 229 45" fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" clip-rule="evenodd" d="M44.7086 44.488V0.124756H0.204102V44.488H44.7086Z"
                fill="#FBFBFB" />
              <path fill-rule="evenodd" clip-rule="evenodd"
                d="M12.5647 19.5819H16.2743C17.0098 19.5819 17.6784 20.0556 17.6784 20.8351C17.6784 21.886 16.8406 22.6241 15.6775 22.6241H11.7074L12.5647 19.5819ZM30.814 19.6026H34.3177C35.98 19.6026 36.0446 20.7328 36.0446 21.0531C36.0446 21.8032 35.3845 23.2805 33.3666 23.2805H29.7959C29.7971 23.2805 30.7957 19.6915 30.814 19.6026ZM10.8098 25.7795H14.0176C15.5886 25.7795 15.6775 26.2057 15.8943 26.5686C16.1086 26.9328 16.0088 27.7012 15.8614 27.9643C15.6739 28.2943 15.356 29.3246 13.349 29.3246H9.78687L10.8098 25.7795Z"
                fill="#278B5F" />
              <path fill-rule="evenodd" clip-rule="evenodd"
                d="M44.7086 16.295V44.4879H0.204102V16.295H8.76791L4.02323 32.7066H13.7367C17.9443 32.7066 18.6774 31.7238 19.5311 31.0077C20.6722 30.0517 21.2836 27.7756 20.7709 26.1912C20.408 25.0707 19.3497 24.3924 19.2327 24.3595C20.548 23.7506 21.3128 22.4122 21.4066 22.2161C21.8949 21.2017 22.2725 19.364 21.0595 17.8855C20.0511 16.6567 18.0916 16.3194 16.6704 16.2938H27.0695L22.3078 32.7382H27.1267L28.8865 26.5041H31.64C33.6409 26.5041 33.4583 27.7475 33.5082 28.2858L33.6653 32.8722L38.1396 32.8698C38.1396 32.8698 37.9375 27.722 37.9204 27.3469C37.8607 26.0267 36.9839 25.43 36.2386 25.43C37.672 25.0427 38.9166 23.7409 39.4135 22.9067C39.9871 21.9458 40.4194 20.4137 39.8507 18.8939C39.0274 16.6872 36.9047 16.3218 35.4214 16.295H44.7086Z"
                fill="#278B5F" />
              <path fill-rule="evenodd" clip-rule="evenodd" d="M0.204102 10.905H44.7086V0.124756H0.204102V10.905Z"
                fill="#ECB739" />
              <path fill-rule="evenodd" clip-rule="evenodd"
                d="M114.598 18.677L115.218 16.5214H100.126L98.9147 20.8325H103.759L100.303 32.9415H105.679L109.134 20.8325H113.978L114.598 18.677ZM126.383 16.5214H118.644L114.598 30.7871L113.978 32.9427H119.383L120.977 27.2152H122.602C123.605 27.2152 124.226 27.3321 124.581 27.5976C125.142 28.0117 125.054 28.7801 124.668 30.0783C124.64 30.1977 124.609 30.2854 124.581 30.3731C124.257 31.6737 124.107 32.6187 124.138 32.9415H129.602L129.749 32.4422C129.1 32.4422 129.364 31.7309 129.984 29.5754C130.928 26.2665 129.984 25.8525 128.447 25.2034C130.516 24.6724 131.786 23.077 132.348 21.1869C133.233 17.9986 131.875 16.5214 126.383 16.5214ZM127.121 22.0443C126.824 23.0782 125.97 23.5227 124.581 23.6104H121.98L122.927 20.332H125.435C126.679 20.332 127.444 20.8922 127.121 22.0443ZM78.6548 32.9415H92.3883L93.4807 29.1029H85.1227L85.8607 26.5344H92.655L93.7474 22.6946H86.9531L87.6339 20.332H95.6375L96.7299 16.5214H83.3215L78.6548 32.9415ZM72.9846 16.5214H65.0686L60.3739 32.9415H65.7786L67.2254 27.8327H69.9424C70.2371 27.8327 70.5331 27.8327 70.8278 27.8046C75.022 27.5379 77.4735 25.3836 78.4185 22.0455C79.3636 18.677 77.7098 16.5214 72.9846 16.5214ZM73.2793 22.0747C72.8957 23.4046 71.9506 23.9344 70.8278 23.994H68.3178L69.3518 20.332H70.8875C72.0395 20.332 73.6933 20.5378 73.2793 22.0747ZM201.073 16.5214L200.718 17.0536L190.823 32.4434L190.499 32.9427H195.787L197.027 30.7871H202.403V32.9427H207.778L206.568 16.5226L201.073 16.5214ZM200.718 27.3614H199.035L200.719 24.3472L202.372 21.4536L202.432 27.3614H200.718ZM227.979 21.2771C228.391 18.4127 226.976 16.0781 222.425 16.0781C218.29 16.0781 214.776 17.8208 213.803 21.3355C212 27.5976 221.954 25.8841 221.245 28.3941C221.038 29.1625 220.003 29.6046 218.674 29.6046C218.143 29.6046 217.613 29.4572 217.259 29.193C216.874 28.8958 216.667 28.4818 216.725 27.8923H211.557C210.848 30.8468 212.947 33.3872 217.287 33.3872C221.806 33.3872 225.527 31.5251 226.59 27.717C228.302 21.7508 218.41 23.2573 219.119 20.8058C219.266 20.2151 219.887 19.8595 221.098 19.8595C221.599 19.8595 222.071 19.9484 222.396 20.1554C222.72 20.3625 222.929 20.7168 222.838 21.2783L227.979 21.2771ZM166.224 16.5214H158.336L153.67 32.9415H161.705C162.059 32.9415 162.411 32.9415 162.768 32.9135C166.489 32.7064 169.236 31.3766 170.18 28.0117C170.682 26.2105 170.18 24.6748 168.527 24.2303C169.767 23.5812 171.215 22.3414 171.686 20.6572C172.602 17.3788 169.916 16.5214 166.224 16.5214ZM165.278 27.5976C164.954 28.7801 163.98 29.0748 162.768 29.1029H160.168L161.024 26.0912H162.767C164.45 26.0912 165.692 26.1801 165.278 27.5976ZM166.372 21.6607C166.105 22.6057 165.189 23.0782 164.098 23.0782H161.88L162.649 20.332H164.54C165.692 20.332 166.724 20.3612 166.372 21.6607ZM145.962 16.0781C145.136 16.0781 144.309 16.167 143.512 16.3448C139.466 17.2314 136.157 20.2736 134.917 24.5835C133.353 30.1965 135.891 33.3872 141.031 33.3872C141.887 33.3872 142.715 33.2971 143.512 33.1205C147.41 32.2351 150.836 29.2819 152.164 24.6431C153.407 20.3016 151.842 16.0781 145.962 16.0781ZM146.761 24.6431C146.169 26.7999 145.108 28.5134 143.512 29.1345C143.098 29.2819 142.656 29.3696 142.182 29.3696C139.613 29.3696 139.701 26.7415 140.322 24.6431C140.796 22.9613 141.827 21.0116 143.512 20.332C143.916 20.1738 144.347 20.0937 144.782 20.0958C147.175 20.0373 147.41 22.3999 146.761 24.6431ZM190.823 21.5133C190.883 21.3952 190.913 21.3075 190.943 21.1882C191.297 19.9472 191.297 18.9437 190.823 18.2045C190.117 17.0524 188.313 16.5214 184.977 16.5214H177.208L172.544 32.9415H177.919L179.572 27.214H181.196C182.2 27.214 182.821 27.3309 183.175 27.5964C183.737 28.0105 183.647 28.7789 183.263 30.0771C183.233 30.1965 183.203 30.2842 183.175 30.3718C182.821 31.6725 182.702 32.6175 182.731 32.9402H188.197L188.313 32.4409C187.692 32.4409 187.959 31.7297 188.58 29.5742C189.524 26.2653 188.58 25.8512 187.043 25.2021C188.994 24.7028 190.264 23.256 190.823 21.5133ZM185.717 22.0443C185.42 23.0782 184.564 23.5227 183.177 23.6104H180.577L181.52 20.332H184.032C185.272 20.332 186.041 20.8922 185.717 22.0443Z"
                fill="#278B5F" />
            </svg>
            <!-- loreal -->
            <svg class="empresas__item" width="122" height="23" viewBox="0 0 122 23" fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" clip-rule="evenodd"
                d="M16.152 18.2001V20.7754H0.0472412V3.06507H2.94656V18.2001H16.152ZM13.8976 9.50542L17.1178 3.38657H14.0584L11.6426 9.50542H13.8976ZM40.2274 5.97217C39.1832 4.32903 37.6581 2.94775 35.8619 2.00659C34.0658 1.06478 31.9988 0.563086 29.9324 0.563086C27.866 0.563086 25.7983 1.06478 24.0028 2.00659C22.2067 2.94775 20.6808 4.32903 19.6366 5.97217C18.5924 7.61467 18.0285 9.51968 18.0285 11.4247C18.0285 13.329 18.5924 15.2341 19.6366 16.8766C20.6808 18.5197 22.206 19.901 24.0028 20.8421C25.7989 21.7839 27.866 22.2856 29.9324 22.2856C31.9988 22.2856 34.0658 21.7846 35.8619 20.8421C37.6581 19.901 39.1832 18.5197 40.2274 16.8766C41.2723 15.2341 41.8356 13.3284 41.8356 11.4247C41.8356 9.52032 41.2723 7.61532 40.2274 5.97217ZM37.7216 15.7617C36.9425 17.0503 35.8023 18.1373 34.4567 18.8794C33.111 19.621 31.5606 20.0164 30.0095 20.0164C28.4584 20.0164 26.9079 19.621 25.5623 18.8794C24.2173 18.1373 23.0772 17.0509 22.2974 15.7617C21.5177 14.4724 21.0989 12.9816 21.0989 11.4908C21.0989 9.99933 21.5177 8.50851 22.2974 7.21992C23.0772 5.93133 24.2167 4.84433 25.5623 4.10281C26.9079 3.36064 28.459 2.96525 30.0095 2.96525C31.5599 2.96525 33.111 3.36064 34.4567 4.10281C35.8023 4.84433 36.9418 5.93069 37.7216 7.21992C38.5015 8.50832 38.916 9.98473 38.9207 11.4908C38.9158 12.9968 38.5013 14.4732 37.7216 15.7617ZM62.0524 10.7026C61.528 11.8564 60.5363 12.5234 59.7604 12.9265C58.9846 13.3303 58.4252 13.4704 57.8619 13.4503L63.4985 20.776H60.2777L54.8265 13.692H47.7159V20.776H44.8172V3.06507H56.4119C57.5838 3.06507 58.7726 3.29582 59.8214 3.88567C60.8701 4.47552 61.7776 5.37195 62.2041 6.64045C62.6299 7.90829 62.5755 9.54884 62.0524 10.7026ZM58.8096 10.5814C59.4201 10.0654 59.7818 9.21698 59.7501 8.37564C59.719 7.53365 59.2944 6.70008 58.6883 6.19126C58.0816 5.68308 57.3064 5.64095 56.5733 5.64095H47.7159V11.1155H56.5733C57.3563 11.1155 58.199 11.098 58.8096 10.5814ZM78.7976 10.6326V13.0471H68.9737V18.2001H82.1791V20.7754H66.0744V3.06507H82.1791V5.64095H68.9737V10.6326H78.7976ZM78.9583 0.327148H74.6097L72.8388 2.58153L78.9583 0.327148ZM87.8572 16.2673L85.5607 20.7754H82.6627L91.6802 3.06442H94.5795L103.598 20.7754H100.699L98.4038 16.2673H87.8572ZM93.1295 5.91124L89.0039 14.0135H97.2552L93.1295 5.91124ZM121.151 18.2001V20.7754H105.048V3.06507H107.946V18.2001H121.151ZM119.896 6.61906L119.871 6.19644C119.867 6.11866 119.874 6.04088 119.842 5.95272C119.81 5.86198 119.761 5.778 119.699 5.70512C119.654 5.65024 119.59 5.61433 119.52 5.60465C119.645 5.56105 119.751 5.47476 119.819 5.36094C119.895 5.23973 119.942 5.07962 119.94 4.90785C119.938 4.73608 119.885 4.552 119.794 4.41589C119.596 4.12615 119.248 4.07689 118.943 4.09115H117.661V7.0501H118.158V5.83475H118.903C118.984 5.83475 119.119 5.82374 119.255 5.92939C119.434 6.14135 119.354 6.42007 119.386 6.65665C119.389 6.79796 119.402 6.93148 119.461 7.0501H120.02V6.9587C119.918 6.91657 119.909 6.76879 119.896 6.61906ZM119.281 5.31556C119.127 5.41409 118.967 5.41474 118.857 5.41279H118.155V4.51181C118.461 4.5157 118.77 4.49885 119.074 4.52348C119.144 4.53104 119.211 4.55647 119.268 4.59733C119.326 4.63819 119.372 4.69311 119.402 4.75683C119.466 4.95258 119.468 5.16259 119.281 5.31556Z"
                fill="white" />
              <path fill-rule="evenodd" clip-rule="evenodd"
                d="M120.979 4.31224C120.761 3.935 120.442 3.61609 120.065 3.3983C119.687 3.18051 119.252 3.06384 118.816 3.06384C118.381 3.06384 117.945 3.18051 117.568 3.3983C117.191 3.61609 116.872 3.935 116.654 4.31224C116.436 4.68948 116.318 5.12506 116.318 5.56064C116.318 5.99622 116.436 6.4318 116.654 6.8084C116.872 7.18499 117.191 7.50454 117.568 7.72233C117.945 7.94012 118.381 8.05679 118.816 8.05679C119.252 8.05679 119.687 7.94012 120.065 7.72233C120.442 7.50454 120.761 7.18564 120.979 6.8084C121.196 6.43115 121.314 5.99622 121.314 5.56064C121.314 5.12506 121.196 4.68948 120.979 4.31224ZM120.68 6.64635C120.492 6.96787 120.225 7.23505 119.903 7.42158C119.58 7.60701 119.214 7.70488 118.841 7.70548C118.469 7.70522 118.103 7.60728 117.781 7.42142C117.458 7.23556 117.19 6.9683 117.003 6.64635C116.817 6.32429 116.72 5.95902 116.72 5.58722C116.72 5.21541 116.817 4.85014 117.003 4.52808C117.285 4.04094 117.749 3.68563 118.292 3.54026C118.836 3.39489 119.415 3.47136 119.903 3.75286C120.223 3.93759 120.494 4.20788 120.68 4.52808C120.865 4.85035 120.963 5.21546 120.964 5.58722C120.964 5.95668 120.865 6.32615 120.68 6.64635Z"
                fill="white" />
            </svg>
            <!-- rappi -->
            <svg class="empresas__item" width="122" height="52" viewBox="0 0 122 52" fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd" clip-rule="evenodd"
                d="M94.7726 20.5671C94.604 21.4821 94.3378 22.5387 93.9806 23.7031C93.6217 24.8675 93.1616 26.0959 92.619 27.3412C92.0293 28.5966 91.4175 29.7711 90.8042 30.8294C90.1975 31.8775 89.5909 32.779 89.0095 33.5087C88.4417 34.2198 87.9142 34.7455 87.4458 35.0724C87.0919 35.3185 86.8947 35.3454 86.8273 35.3454C86.7956 35.3454 86.77 35.3404 86.7431 35.3282C86.6838 35.3015 86.4869 35.1698 86.401 34.5447C86.3201 33.9717 86.3641 33.2185 86.5274 32.3069C86.6959 31.3683 86.9605 30.3016 87.3194 29.1439C87.6732 27.9863 88.1333 26.7578 88.6843 25.4957C89.2303 24.2437 89.8268 23.0759 90.4604 22.0227C91.0906 20.9712 91.704 20.0798 92.2854 19.372C92.8499 18.6812 93.3773 18.1638 93.8525 17.8319C94.2081 17.5858 94.4035 17.5589 94.4709 17.5589C94.505 17.5589 94.5302 17.5639 94.5535 17.5761C94.6127 17.6016 94.8096 17.7345 94.8972 18.3596C94.9763 18.9326 94.9342 19.674 94.7726 20.5671ZM71.1171 20.5671C70.9486 21.4821 70.6824 22.5387 70.3251 23.7031C69.9645 24.8742 69.5045 26.101 68.9636 27.3412C68.3721 28.6 67.7604 29.7745 67.1487 30.8294C66.5404 31.8792 65.9354 32.7807 65.3541 33.5087C64.7862 34.2198 64.2604 34.7455 63.7886 35.0724C63.4348 35.3185 63.2393 35.3454 63.1719 35.3454C63.1401 35.3454 63.1145 35.3404 63.0876 35.3288C63.0283 35.3021 62.8315 35.1705 62.7455 34.5453C62.6646 33.974 62.7068 33.2225 62.8719 32.3075C63.0387 31.3705 63.305 30.3072 63.6639 29.1445C64.0178 27.9852 64.4778 26.7584 65.0288 25.4963C65.5765 24.2409 66.1747 23.0731 66.8032 22.0233C67.4368 20.9701 68.0502 20.0787 68.6299 19.3726C69.1961 18.6818 69.7252 18.1627 70.197 17.8325C70.5509 17.5864 70.748 17.5595 70.8154 17.5595C70.8495 17.5595 70.8747 17.5645 70.898 17.5761C70.9572 17.6016 71.1558 17.7345 71.2418 18.3596C71.321 18.9326 71.2787 19.674 71.1171 20.5671ZM45.4868 20.3312C45.3823 21.2614 45.1801 22.323 44.8852 23.4891C44.5886 24.6518 44.1842 25.8752 43.6803 27.1289C43.1781 28.3759 42.644 29.5487 42.0896 30.6137C41.547 31.6551 40.9993 32.5431 40.4584 33.2542C39.9327 33.9451 39.4389 34.4608 38.989 34.786C38.6571 35.027 38.4717 35.0539 38.4093 35.0539C38.3807 35.0539 38.3552 35.0489 38.3284 35.0368C38.2679 35.01 38.0588 34.8733 37.951 34.238C37.8499 33.6566 37.8414 32.9068 37.9223 32.007C38.0066 31.0936 38.197 30.0438 38.4901 28.8878C38.7834 27.7302 39.1895 26.5051 39.695 25.248C40.2039 23.9842 40.7397 22.8131 41.2874 21.7616C41.8267 20.7219 42.376 19.8237 42.9203 19.0907C43.4426 18.3829 43.9381 17.8606 44.3863 17.5353C44.7182 17.2943 44.9036 17.2674 44.9677 17.2674C44.9963 17.2674 45.0218 17.2724 45.0452 17.2846C45.1092 17.3113 45.3265 17.4531 45.4597 18.0968C45.5776 18.6697 45.5875 19.4196 45.4868 20.3312ZM97.3137 12.6034C98.5523 12.6034 99.6173 12.9825 100.48 13.7324C101.312 14.4553 101.907 15.4882 102.246 16.8009C102.575 18.0732 102.642 19.6117 102.448 21.376C102.254 23.1184 101.746 25.1068 100.932 27.2856C100.165 29.3448 99.2853 31.1563 98.3214 32.6678C97.8546 33.4025 97.3744 34.09 96.8874 34.7253C96.825 34.8062 96.9182 34.9124 97.007 34.8635C97.2901 34.7102 97.5715 34.5434 97.8496 34.3614C98.4831 33.9519 99.0915 33.5104 99.6695 33.0436C101.282 31.7376 102.453 29.9717 103.023 27.9866C103.363 26.7919 103.741 25.6073 104.152 24.4395C104.826 22.5168 105.545 20.7222 106.292 19.1045C107.033 17.4918 107.65 16.2853 108.125 15.5152C108.665 14.639 109.419 14.093 110.375 13.8908C111.268 13.7021 112.122 13.7155 112.908 13.9277C113.711 14.1468 114.369 14.5445 114.859 15.114C115.393 15.7358 115.509 16.4436 115.193 17.1614C115.098 17.4091 114.851 17.9753 114.456 18.8465C114.06 19.7228 113.615 20.7456 113.098 21.9791C112.601 23.1637 112.09 24.4461 111.581 25.7874C111.084 27.1052 110.695 28.3353 110.425 29.4441C110.163 30.5226 110.06 31.419 110.119 32.1082C110.176 32.7671 110.427 32.7671 110.564 32.7671C110.756 32.7671 111.096 32.6761 111.625 32.2447C112.134 31.8234 112.672 31.3162 113.226 30.7298C113.781 30.1417 114.313 29.5081 114.805 28.8476C115.255 28.246 115.641 27.7135 115.954 27.2636C116.227 26.8709 116.662 26.6468 117.146 26.6468C117.656 26.6468 118.152 26.903 118.409 27.2989C118.661 27.6865 118.654 28.1482 118.388 28.5628C118.054 29.0835 117.471 29.9563 116.605 31.2353C115.747 32.4992 114.721 33.8017 113.555 35.1094C112.368 36.4355 111.073 37.6134 109.699 38.6093C108.255 39.6591 106.796 40.1899 105.365 40.1899C104.071 40.1899 103.105 39.7417 102.494 38.8553C101.938 38.0465 101.655 36.9613 101.655 35.6301V35.4177C101.658 35.2594 101.473 35.1701 101.35 35.2695C101.078 35.4869 100.799 35.7026 100.514 35.9149C98.8318 37.1669 96.8906 38.2285 94.7404 39.0727C92.8211 39.8277 90.7063 40.2102 88.455 40.2102L87.9966 40.2051L87.5366 40.1898C86.0032 40.1865 84.8657 39.7062 84.1529 38.7575C84.0266 38.5907 83.9103 38.4188 83.8075 38.2419C83.725 38.1003 83.5109 38.1239 83.4638 38.282C83.2329 39.0521 83.0139 39.7952 82.8116 40.5063C82.3735 42.0347 81.9994 43.3575 81.6708 44.5505C81.3405 45.747 81.0541 46.8372 80.8182 47.796C80.5907 48.7195 80.4323 49.4677 80.3514 50.022L80.3463 50.0426C80.139 51.0924 79.4296 51.4614 78.8684 51.5878C78.619 51.6432 78.3596 51.6721 78.0966 51.6721C77.6215 51.6721 77.1193 51.5794 76.6053 51.3991C75.8235 51.1227 75.1208 50.6459 74.5141 49.9803C73.8856 49.2894 73.5671 48.4249 73.5671 47.4105C73.5671 47.2049 73.6193 46.755 74.0221 45.0985C74.3237 43.8769 74.7299 42.3569 75.2337 40.5791C75.5741 39.3743 75.9617 38.0633 76.3914 36.6613C76.4417 36.4927 76.2498 36.3529 76.1049 36.4523C74.6068 37.4718 72.9268 38.3531 71.0934 39.0726C69.1724 39.8275 67.0593 40.2101 64.808 40.2101C64.5046 40.2101 64.1946 40.2031 63.8879 40.1897C62.3562 40.1863 61.2188 39.706 60.5043 38.7573C60.3779 38.5905 60.2633 38.4203 60.1605 38.2417C60.0763 38.1001 59.8639 38.1254 59.8168 38.2818C59.5842 39.0536 59.3651 39.7984 59.163 40.5061C58.7231 42.0396 58.3491 43.3641 58.0238 44.5504C57.6935 45.7468 57.4054 46.8371 57.1695 47.7959C56.942 48.721 56.7853 49.4692 56.7027 50.0219L56.6993 50.0424C56.4921 51.0922 55.781 51.4613 55.2198 51.5877C54.9704 51.6431 54.7126 51.6719 54.4497 51.6719C53.9746 51.6719 53.4724 51.5792 52.9567 51.3989C52.1749 51.1226 51.4739 50.6457 50.8672 49.9801C50.2387 49.2892 49.9202 48.4247 49.9202 47.4103C49.9202 47.2031 49.9705 46.7531 50.3752 45.0984C50.6786 43.8649 51.0846 42.3449 51.5851 40.5789C51.8817 39.5291 52.2103 38.4102 52.5793 37.202C52.6334 37.02 52.4108 36.8818 52.2693 37.0116C51.6407 37.5845 50.9936 38.1187 50.3297 38.6073C48.9058 39.6572 47.4566 40.1896 46.0243 40.1896C44.7301 40.1896 43.7629 39.7414 43.1529 38.855C42.9069 38.4976 42.7149 38.0848 42.575 37.6213C42.452 37.2085 41.9229 37.0821 41.6229 37.3939C41.2016 37.832 40.7382 38.2313 40.2411 38.5835C39.5941 39.0419 38.8712 39.4261 38.0893 39.726C37.2838 40.0327 36.4126 40.1894 35.4993 40.1894C34.2641 40.1894 33.1806 39.8137 32.2807 39.0705C31.4045 38.3527 30.7557 37.3349 30.3496 36.0424C29.9553 34.7904 29.8104 33.2519 29.9182 31.4674C30.0261 29.7047 30.4271 27.7264 31.1113 25.5847C32.5689 21.1428 34.4697 17.845 36.7631 15.7774C39.0987 13.671 41.4679 12.6027 43.8051 12.6027C44.7943 12.6027 45.6318 12.8015 46.2907 13.1924C46.9394 13.58 47.4399 14.0923 47.7786 14.7158C48.0044 15.1354 48.1696 15.5853 48.2707 16.0639C48.2889 16.1481 48.4038 16.1649 48.4459 16.0893C48.5639 15.877 48.6768 15.6866 48.783 15.513C49.3222 14.6401 50.067 14.0942 50.9989 13.8903C51.8701 13.7016 52.7227 13.7133 53.5299 13.9259C54.3573 14.145 55.0262 14.5444 55.5183 15.1139C56.0525 15.7357 56.1687 16.4435 55.8502 17.1613C55.7576 17.4056 55.5183 17.9583 55.1155 18.8464C54.7229 19.7159 54.2646 20.7691 53.7573 21.979C53.2551 23.1771 52.7446 24.4595 52.2408 25.7873C51.7419 27.1051 51.3527 28.3369 51.0848 29.444C50.8219 30.5241 50.7191 31.4206 50.7781 32.1081C50.8355 32.767 51.0865 32.767 51.2214 32.767C51.4152 32.767 51.7555 32.676 52.283 32.2446C52.5745 32.0036 52.8778 31.7324 53.1879 31.4341C54.3893 30.2764 55.1948 29.0126 55.7324 27.4404C56.4468 25.3543 57.1984 23.2951 57.9702 21.31C58.7942 19.1986 59.598 17.3029 60.3596 15.6751C60.7573 14.8325 61.3875 14.2646 62.2267 13.9917C63.0137 13.7355 63.8208 13.6816 64.6145 13.8316C65.4065 13.9832 66.1008 14.2984 66.6771 14.7702C66.9332 14.9792 67.1371 15.2049 67.2887 15.4426C67.3289 15.5066 67.3764 15.5133 67.432 15.461C68.1127 14.8325 68.8643 14.2562 69.6748 13.7422C70.8611 12.9856 72.2042 12.6031 73.6668 12.6031C74.9037 12.6031 75.9704 12.9823 76.8314 13.7321C77.6656 14.4567 78.2604 15.488 78.5991 16.8007C78.9277 18.0713 78.9952 19.6114 78.8013 21.3757C78.6075 23.1164 78.0969 25.1065 77.2847 27.2854C76.5163 29.3463 75.6367 31.1577 74.6728 32.6676C74.2061 33.4023 73.7258 34.0898 73.2388 34.7251C73.1764 34.806 73.2705 34.9121 73.3601 34.8633C73.6416 34.7099 73.923 34.5431 74.2027 34.3611C74.656 34.0679 75.0958 33.7578 75.5204 33.4343C77.1348 32.2076 78.3396 30.5292 78.9816 28.6183L79.2344 27.8718C79.9927 25.6306 80.7948 23.4231 81.6171 21.31C82.4428 19.1952 83.2466 17.2995 84.0083 15.6751C84.4043 14.8325 85.0328 14.2663 85.8754 13.9916C86.6623 13.7355 87.4695 13.6816 88.2631 13.8316C89.0551 13.9832 89.7477 14.2984 90.324 14.7685C90.5802 14.9791 90.784 15.205 90.9357 15.4425C90.9763 15.5066 91.0233 15.5133 91.0789 15.461C91.7597 14.8325 92.5113 14.2562 93.3218 13.7422C94.5097 12.9856 95.8528 12.6034 97.3137 12.6034ZM19.8093 2.10689C21.5854 2.10689 23.3649 2.31247 25.1005 2.71518C26.848 3.12298 28.4337 3.74308 29.8104 4.55867C31.204 5.38437 32.3482 6.4207 33.2109 7.63903C34.0905 8.87926 34.5354 10.3335 34.5354 11.9613C34.5354 13.7138 34.1445 15.3585 33.3727 16.8481C32.6077 18.3225 31.5545 19.6689 30.2452 20.8502C28.9476 22.023 27.4091 23.0577 25.6718 23.9238C24.2395 24.6383 22.7178 25.2483 21.1372 25.7387C21.0361 25.7705 21.0007 25.8229 21.0058 25.924C21.0395 26.6991 21.095 27.4659 21.1743 28.2039C21.2636 29.0515 21.3815 29.8772 21.5265 30.6608C21.668 31.4309 21.8399 32.1808 22.0337 32.8902C22.1853 33.4395 22.3539 33.9737 22.5342 34.4809C22.6487 34.8045 22.7701 35.1213 22.8931 35.4178C23.1408 36.0161 23.4138 36.589 23.7036 37.1198C23.9884 37.6422 24.2968 38.1376 24.6203 38.5926C24.9355 39.0358 25.2742 39.452 25.6263 39.8328C25.9701 40.2035 26.3341 40.5439 26.7082 40.8472C27.0722 41.1421 27.4564 41.41 27.849 41.6392C28.2315 41.865 28.6326 42.0605 29.042 42.2223C29.4448 42.3807 29.861 42.5088 30.2806 42.6014C30.7019 42.6941 31.1349 42.7531 31.573 42.7817C32.0095 42.8085 32.4645 42.8034 32.9178 42.7633C33.3795 42.7231 33.8513 42.6487 34.3198 42.5391C34.8 42.4279 35.2887 42.2813 35.7757 42.101C36.2745 41.9157 36.7783 41.6898 37.2754 41.4354C37.4659 41.3376 37.6579 41.2332 37.8484 41.1254C38.4685 40.7715 39.2605 40.94 39.6767 41.5129C40.0946 42.0858 40.002 42.8778 39.4627 43.3429C39.1981 43.5704 38.9319 43.7928 38.669 44.0052C38.0304 44.5208 37.39 44.9994 36.7649 45.4257C36.1717 45.8301 35.5684 46.2076 34.9719 46.5429C34.6737 46.7115 34.3602 46.8766 34.0417 47.035C33.4301 47.3416 32.8116 47.6113 32.1999 47.8371C31.5916 48.0612 30.9799 48.2483 30.3834 48.3898C29.7885 48.5313 29.1887 48.6341 28.6039 48.6931C28.186 48.7351 27.7681 48.7571 27.3603 48.7571C27.1952 48.7571 27.03 48.7537 26.8649 48.7454C26.2987 48.7216 25.7359 48.6562 25.1899 48.55C24.9203 48.4978 24.6473 48.4337 24.3811 48.3595C24.1232 48.2904 23.8587 48.2079 23.5941 48.1119C23.0869 47.93 22.583 47.7059 22.1011 47.4448C21.6293 47.1886 21.1642 46.8937 20.7227 46.5668C20.3655 46.3022 20.015 46.0107 19.683 45.7024C19.2836 45.3316 18.8944 44.9188 18.5253 44.4807C18.1614 44.0476 17.8125 43.5791 17.489 43.0888C17.1638 42.6001 16.8571 42.0777 16.574 41.5385C16.2925 40.9992 16.0247 40.4263 15.782 39.8365C15.541 39.2518 15.3169 38.6317 15.113 37.9897C14.9125 37.3594 14.7288 36.6921 14.567 36.0046C14.4069 35.3188 14.267 34.6077 14.1508 33.8898C14.0464 33.2545 13.9587 32.5957 13.8896 31.9267C13.8692 31.7245 13.5779 31.6975 13.5189 31.8948C13.2661 32.7677 13.0369 33.6136 12.8347 34.4225C12.5803 35.4369 12.346 36.3603 12.1337 37.1894C11.9265 38.0016 11.7799 38.6554 11.6956 39.1323C11.5271 39.9782 10.966 40.5124 10.0661 40.686C9.29266 40.8376 8.4619 40.7736 7.60588 40.5006C6.75996 40.2293 5.99155 39.7592 5.3192 39.1003C4.61483 38.4095 4.25759 37.5416 4.25759 36.5188C4.25759 35.6863 4.46993 34.3703 4.90467 32.4981C5.32928 30.6698 5.941 28.5028 6.72625 26.0543C7.50477 23.6261 8.45011 20.9485 9.53363 18.1007C10.4638 15.6539 11.5086 13.1903 12.641 10.7604C13.0117 9.965 13.7784 9.41735 14.6631 9.31624C16.6633 9.08709 18.3989 9.14434 19.87 9.48476C20.7564 9.69035 21.2316 10.639 20.8609 11.4563C19.9121 13.5425 19.0376 15.6236 18.2557 17.6491C17.6238 19.2887 17.0172 20.9114 16.4442 22.4903C16.3888 22.6471 16.5504 22.792 16.702 22.7229C17.4654 22.3774 18.2186 21.9696 18.955 21.5045C20.1615 20.7412 21.2602 19.8296 22.2224 18.7966C23.1795 17.7636 23.9648 16.5992 24.5563 15.3337C25.1393 14.08 25.4359 12.7184 25.4359 11.2827C25.4359 9.43756 24.9169 8.07432 23.894 7.23345C22.8577 6.38248 21.3984 5.94941 19.5549 5.94941C17.5918 5.94941 15.7971 6.40777 14.2216 7.31265C12.6039 8.23945 11.2052 9.37858 10.0644 10.6997C8.91519 12.0309 8.00861 13.4531 7.37333 14.9276C6.74313 16.3886 6.42293 17.6693 6.42293 18.7359C6.42293 19.4993 6.01348 20.0503 5.27032 20.2879C4.6182 20.4969 3.89866 20.4666 3.16058 20.1952C2.45115 19.9357 1.79397 19.4218 1.20587 18.6702C0.614389 17.9153 0.314453 16.8924 0.314453 15.6303C0.314453 14.5283 0.739068 13.2307 1.61198 11.6636C2.46127 10.1352 3.71835 8.64726 5.34447 7.2402C6.9689 5.83652 9.01799 4.61819 11.4412 3.62061C13.8778 2.61629 16.6936 2.10689 19.8093 2.10689ZM116.478 0.940796C119.196 0.940796 121.399 3.11457 121.399 5.79388C121.399 8.47319 119.196 10.647 116.478 10.647C113.76 10.647 111.558 8.47319 111.558 5.79388C111.558 3.11457 113.76 0.940796 116.478 0.940796Z"
                fill="#FF441F" />
            </svg>
            <!-- ipiranga -->
            <svg class="empresas__item" width="196" height="61" viewBox="0 0 196 61" fill="none"
              xmlns="http://www.w3.org/2000/svg">
              <g clip-path="url(#clip0_676_13643)">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M0.424194 60.435H195.771V0.177612H0.424194V60.435Z"
                  fill="#F6D43C" />
                <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M99.1876 42.4452L100.345 40.7624L101.162 38.9217L101.686 37.1066L101.845 35.4482L101.609 33.792L100.898 32.635L99.8457 31.8725L98.4785 31.6335L96.7957 31.7658L95.3751 32.1614L94.297 32.765L93.5334 33.503L93.7968 31.9247H89.194L84.6957 49.9668H89.7198L90.7201 45.4974L91.5349 45.6274L92.5863 45.6541L93.7701 45.523L95.4274 45.1017L97.3214 44.1291L98.2684 43.3911L99.1876 42.4452ZM82.4082 45.523L86.8532 27.7676H81.5401L77.0952 45.523H82.4082ZM107.396 45.4974L110.761 31.9247H105.608L102.267 45.4974H107.396ZM116.812 41.4459L118.179 38.1836L118.785 37.3155L119.68 36.3941L120.678 35.7127L121.625 35.4215L122.782 35.5549L123.52 31.7402L122.153 31.6602L120.862 31.8469L119.757 32.2915L118.915 32.8973L118.338 33.4764L118.679 31.9769H114.183L110.867 45.523H115.602L116.812 41.4459ZM130.437 43.9713L130.068 45.4974H134.539L137.774 32.6083L137.012 32.2659L135.855 31.9769L134.38 31.7146L132.592 31.6079L130.068 31.8725L128.911 32.2137L127.857 32.6605L126.071 33.8176L124.57 35.2915L123.44 36.9487L122.677 38.6827L122.204 40.3678L122.019 41.9717L122.308 43.2088L123.019 44.4181L124.228 45.3385L124.991 45.6019L125.86 45.7053L127.438 45.5496L128.544 45.1539L130.437 43.9713ZM147.533 35.1859L148.242 35.0814L148.531 35.1592L148.506 35.5805L146.087 45.5752H150.978L153.082 36.842L153.398 35.4738L153.476 34.3456L153.398 33.6075L153.187 33.0295L152.899 32.556L152.504 32.187L151.531 31.7402L150.504 31.6335L148.531 31.7924L147.112 32.2393L146.139 32.845L145.481 33.503L145.821 31.9769H141.167L137.801 45.523H142.641L143.377 42.7075L144.272 39.9987L145.27 37.7101L146.19 36.3163L146.848 35.6583L147.533 35.1859ZM154.16 41.9972L154.423 43.2355L155.214 44.4448L156.423 45.3651L157.159 45.6274L158 45.7342L159.132 45.6541L160.026 45.4429L161.867 44.4448L161.526 45.523L161.261 46.2855L160.894 46.8912L160.421 47.3381L159.815 47.6526L158.211 47.8116L156.002 47.4948L155.214 50.0735L156.817 50.3881L158.421 50.5203L160.236 50.4925L162.184 50.1002L163.971 49.2577L164.761 48.573L165.471 47.7593L166.049 46.7323L166.443 45.4974L170.18 31.6079H164.655L162.421 31.8991L161.368 32.2137L160.369 32.6872L158.578 33.8176L157.054 35.2915L155.819 36.9487L154.925 38.6827L154.344 40.3933L154.16 41.9972ZM173.729 33.8176L172.231 35.2915L171.126 36.9487L170.336 38.6827L169.862 40.3678L169.707 41.9717L169.969 43.2088L170.757 44.3926L171.968 45.3385L173.572 45.7053L175.151 45.5752L176.253 45.1539L178.097 43.9713L177.728 45.4974H182.2L185.434 32.6083L184.671 32.2659L183.514 31.9769L182.041 31.7146L180.253 31.6079L177.728 31.8725L176.571 32.2137L175.544 32.6605L173.729 33.8176ZM34.6442 9.22535C25.6743 9.22535 18.1527 15.222 16.1264 23.954L10.182 49.6256H25.0952L41.7712 25.0578H49.7408L43.4541 50.0724L45.3748 49.7812C51.8716 48.783 56.8167 44.2847 58.3939 37.9191L65.4954 9.22424L34.6442 9.22535Z"
                  fill="#1879BF" />
                <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M127.911 42.5496L127.412 42.3929L127.148 42.0761L127.017 41.5503L127.332 39.6574L128.28 37.341L128.936 36.2384L129.726 35.3436L130.595 34.7123L131.567 34.5011H132.41L131.646 36.9742L130.804 38.9738L129.701 41.1557L129.068 41.9716L128.544 42.3673L127.911 42.5496ZM96.6123 35.0813L96.7957 35.3436L96.8212 36.0016L96.48 37.6578L95.5852 39.972L94.9016 41.0513L94.1125 41.9972L93.1921 42.6296L92.114 42.8664L91.2714 42.8141L91.8772 40.9734L92.5608 39.3684L93.9024 36.922L94.507 36.1317L95.1117 35.5548L95.7164 35.1336L96.1643 34.9746L96.6123 35.0813ZM160.395 37.3688L161.079 36.264L161.841 35.3703L162.735 34.7379L163.708 34.5278H164.55L163.789 37.1065L162.92 39.1294L162.211 40.5233L161.763 41.1813L160.972 41.8649L160.315 42.2339L159.737 42.3929L159.368 42.2083L159.157 41.577L159.473 39.683L160.395 37.3688ZM176.571 36.2384L177.359 35.3436L178.227 34.7123L179.2 34.5011H180.068L179.28 36.9742L178.464 38.9738L177.333 41.1557L176.701 41.9716L176.176 42.3673L175.57 42.5496L175.044 42.3929L174.782 42.0761L174.649 41.5503L174.966 39.6574L175.913 37.341L176.571 36.2384ZM54.9482 12.7499L46.164 21.4819L42.6393 12.7499H54.9482Z"
                  fill="#F6D43C" />
              </g>
              <defs>
                <clipPath id="clip0_676_13643">
                  <rect width="195.397" height="60.3331" fill="white" transform="translate(0.398926 0.139893)" />
                </clipPath>
              </defs>
            </svg>
          </div>
        </div>
    </section>

  </main>

  <?php get_footer('hashtag'); ?>

  <?php wp_footer(); ?>

  <?php the_field('footer', 'option'); ?>
  <!-- Pega o campo 'footer' da página 'Opções do Site'/https://www.hashtagtreinamentos.com/wp-admin/admin.php?page=opcoes-do-site -->

  <div class="popup">
    <div class="popup-container">
      <button id="botaoPopup3" class="btn btn--fechar btn--popup">X</button>

      <form method="POST" action="https://hashtagtreinamentos.activehosted.com/proc.php" id="_form_12142_" class="form">
        <!-- Inputs obrigatórios dos formulários do activecampaign -->
        <input type="hidden" name="u" value="12142" />
        <input type="hidden" name="f" value="12142" />
        <input type="hidden" name="act" value="sub" />

        <div class="form-inputs">
          <div class="form-campo">
            <input type="text" id="firstname" name="firstname" placeholder="*Tu nombre y apellido" required />
            <small></small>
          </div>

          <div class="form-campo">
            <input type="text" id="email" name="email" placeholder="*E-mail más usado" required />
            <small></small>
          </div>

          <div class="form-campo-duplo">
            <div class="form-campo form-campo-prefixo">
              <div class="phone-prefix-selector">
                <input type="text" id="prefix" name="prefix" placeholder="*Prefijo de país" autocomplete="off" />
                <div id="dropdown" class="dropdown hidden"></div>
                <small></small>
              </div>
            </div>
            <div class="form-campo form-campo-numero-nacional">
              <input type="text" id="national-phone" name="national-phone" placeholder="*WhatsApp" required />
              <small></small>
            </div>
          </div>

          <input type="text" id="phone" name="phone" placeholder="WhatsApp" />

          <!-- OrigemURL -->
          <input type="hidden" name="field[6]" value="" />

          <!-- FonteTemp -->
          <input type="hidden" name="field[62]" value="" />

          <!-- UtmSource -->
          <input type="hidden" name="field[135]" value="" />

          <!-- UtmMedium -->
          <input type="hidden" name="field[136]" value="" />

          <!-- UtmTerm -->
          <input type="hidden" name="field[137]" value="" />

          <!-- UtmContent -->
          <input type="hidden" name="field[138]" value="" />

          <!-- UtmCampaign -->
          <input type="hidden" name="field[139]" value="" />

          <!-- Conversion -->
          <input type="hidden" name="field[134]" value="" />
        </div>
        <button class="btn btn--hero" id="_form_12142_submit" type="submit">
          Asegurar mi lugar
        </button>

        <!-- redireciona após envio -->
        <!-- <input type="hidden" name="redirect" value="https://lp.hashtagcapacitaciones.com/excel/espera/inscripcion" /> -->
      </form>
    </div>
  </div>

  <script>
  // funcionamento dropdown prefixo de país

  const countries = [{
      name: "Afganistán",
      code: "+93"
    },
    {
      name: "Albania",
      code: "+355"
    },
    {
      name: "Alemania",
      code: "+49"
    },
    {
      name: "Andorra",
      code: "+376"
    },
    {
      name: "Angola",
      code: "+244"
    },
    {
      name: "Arabia Saudí",
      code: "+966"
    },
    {
      name: "Argelia",
      code: "+213"
    },
    {
      name: "Argentina",
      code: "+54"
    },
    {
      name: "Armenia",
      code: "+374"
    },
    {
      name: "Aruba",
      code: "+297"
    },
    {
      name: "Australia",
      code: "+61"
    },
    {
      name: "Austria",
      code: "+43"
    },
    {
      name: "Azerbaiyán",
      code: "+944"
    },
    {
      name: "Bahamas",
      code: "+1"
    },
    {
      name: "Bahrain",
      code: "+973"
    },
    {
      name: "Bangladesh",
      code: "+880"
    },
    {
      name: "Barbados",
      code: "+1"
    },
    {
      name: "Bélgica",
      code: "+32"
    },
    {
      name: "Belice",
      code: "+501"
    },
    {
      name: "Benín",
      code: "+229"
    },
    {
      name: "Bermudas",
      code: "+1"
    },
    {
      name: "Bielorrusia",
      code: "+375"
    },
    {
      name: "Bolivia",
      code: "+591"
    },
    {
      name: "Bosnia",
      code: "+387"
    },
    {
      name: "Botsuana",
      code: "+267"
    },
    {
      name: "Brasil",
      code: "+55"
    },
    {
      name: "Brunei",
      code: "+673"
    },
    {
      name: "Bulgaria",
      code: "+359"
    },
    {
      name: "Burkina Faso",
      code: "+226"
    },
    {
      name: "Burundi",
      code: "+257"
    },
    {
      name: "Bután",
      code: "+975"
    },
    {
      name: "Camboya",
      code: "+855"
    },
    {
      name: "Camerún",
      code: "+237"
    },
    {
      name: "Canadá",
      code: "+1"
    },
    {
      name: "Chad",
      code: "+235"
    },
    {
      name: "Chile",
      code: "+56"
    },
    {
      name: "China",
      code: "+86"
    },
    {
      name: "Chipre",
      code: "+357"
    },
    {
      name: "Colombia",
      code: "+57"
    },
    {
      name: "Congo",
      code: "+242"
    },
    {
      name: "Corea del Norte",
      code: "+850"
    },
    {
      name: "Corea del Sur",
      code: "+82"
    },
    {
      name: "Costa de Marfil",
      code: "+225"
    },
    {
      name: "Costa Rica",
      code: "+506"
    },
    {
      name: "Croacia",
      code: "+385"
    },
    {
      name: "Cuba",
      code: "+53"
    },
    {
      name: "Diego García",
      code: "+246"
    },
    {
      name: "Dinamarca",
      code: "+45"
    },
    {
      name: "Dominica",
      code: "+1"
    },
    {
      name: "Ecuador",
      code: "+593"
    },
    {
      name: "Egipto",
      code: "+20"
    },
    {
      name: "El Salvador",
      code: "+503"
    },
    {
      name: "Emiratos Árabes Unidos",
      code: "+971",
    },
    {
      name: "Eritrea",
      code: "+291"
    },
    {
      name: "Eslovaquia",
      code: "+421"
    },
    {
      name: "Eslovenia",
      code: "+386"
    },
    {
      name: "España",
      code: "+34"
    },
    {
      name: "Estados Unidos",
      code: "+1"
    },
    {
      name: "Estonia",
      code: "+372"
    },
    {
      name: "Etiopía",
      code: "+251"
    },
    {
      name: "Filipinas",
      code: "+63"
    },
    {
      name: "Finlandia",
      code: "+358"
    },
    {
      name: "Fiyi",
      code: "+679"
    },
    {
      name: "Francia",
      code: "+33"
    },
    {
      name: "Gabón",
      code: "+241"
    },
    {
      name: "Gambia",
      code: "+220"
    },
    {
      name: "Georgia",
      code: "+995"
    },
    {
      name: "Ghana",
      code: "+233"
    },
    {
      name: "Gibraltar",
      code: "+350"
    },
    {
      name: "Granada",
      code: "+1"
    },
    {
      name: "Grecia",
      code: "+30"
    },
    {
      name: "Groenlandia",
      code: "+299"
    },
    {
      name: "Guatemala",
      code: "+502"
    },
    {
      name: "Guinea Ecuatorial",
      code: "+240"
    },
    {
      name: "Honduras",
      code: "+504"
    },
    {
      name: "Isla de la Ascensión",
      code: "+247",
    },
    {
      name: "Islas Feroe",
      code: "+298"
    },
    {
      name: "Islas Marianas",
      code: "+1"
    },
    {
      name: "Islas Marshall",
      code: "+692"
    },
    {
      name: "Islas Norfolk",
      code: "+672"
    },
    {
      name: "Islas Salomón",
      code: "+677"
    },
    {
      name: "Islas Vírgenes Británicas",
      code: "+1",
    },
    {
      name: "Israel",
      code: "+972"
    },
    {
      name: "Italia",
      code: "+39"
    },
    {
      name: "Jamaica",
      code: "+1"
    },
    {
      name: "Japón",
      code: "+81"
    },
    {
      name: "Jordania",
      code: "+962"
    },
    {
      name: "Kazajistán",
      code: "+7"
    },
    {
      name: "Kenia",
      code: "+254"
    },
    {
      name: "Kirguistán",
      code: "+996"
    },
    {
      name: "Kiribati",
      code: "+686"
    },
    {
      name: "Kuwait",
      code: "+965"
    },
    {
      name: "Laos",
      code: "+856"
    },
    {
      name: "Lesoto",
      code: "+266"
    },
    {
      name: "Letonia",
      code: "+371"
    },
    {
      name: "Líbano",
      code: "+961"
    },
    {
      name: "Liberia",
      code: "+231"
    },
    {
      name: "Libia",
      code: "+218"
    },
    {
      name: "Liechtenstein",
      code: "+423"
    },
    {
      name: "México",
      code: "+52"
    },
    {
      name: "Nauru",
      code: "+674"
    },
    {
      name: "Nepal",
      code: "+977"
    },
    {
      name: "Nicaragua",
      code: "+505"
    },
    {
      name: "Níger",
      code: "+227"
    },
    {
      name: "Nigeria",
      code: "+234"
    },
    {
      name: "Niue",
      code: "+683"
    },
    {
      name: "Noruega",
      code: "+47"
    },
    {
      name: "Nueva Caledonia",
      code: "+687"
    },
    {
      name: "Nueva Zelanda",
      code: "+64"
    },
    {
      name: "Oman",
      code: "+968"
    },
    {
      name: "Pakistán",
      code: "+92"
    },
    {
      name: "Palau",
      code: "+680"
    },
    {
      name: "Palestina",
      code: "+970"
    },
    {
      name: "Panamá",
      code: "+507"
    },
    {
      name: "Papúa Nueva Guinea",
      code: "+675",
    },
    {
      name: "Paraguay",
      code: "+595"
    },
    {
      name: "Perú",
      code: "+51"
    },
    {
      name: "Polinesia francesa",
      code: "+689",
    },
    {
      name: "Polonia",
      code: "+48"
    },
    {
      name: "Portugal",
      code: "+351"
    },
    {
      name: "Qatar",
      code: "+974"
    },
    {
      name: "Reino Unido",
      code: "+44"
    },
    {
      name: "República Centroafricana",
      code: "+236",
    },
    {
      name: "República Checa",
      code: "+420"
    },
    {
      name: "República Democrática del Congo",
      code: "+243",
    },
    {
      name: "República Dominicana",
      code: "+809",
    },
    {
      name: "Ruanda",
      code: "+250"
    },
    {
      name: "Rumania",
      code: "+40"
    },
    {
      name: "Rusia",
      code: "+7"
    },
    {
      name: "Samoa oriental",
      code: "+685"
    },
    {
      name: "San Cristóbal y Nieves",
      code: "+1",
    },
    {
      name: "San Marino",
      code: "+378"
    },
    {
      name: "San Pedro y Miquelón",
      code: "+508",
    },
    {
      name: "San Vicente y las Granadinas",
      code: "+1",
    },
    {
      name: "Santa Elena",
      code: "+290"
    },
    {
      name: "Santa Lucía",
      code: "+1"
    },
    {
      name: "Santo Tomé",
      code: "+239"
    },
    {
      name: "Senegal",
      code: "+221"
    },
    {
      name: "Serbia",
      code: "+381"
    },
    {
      name: "Seychelles",
      code: "+248"
    },
    {
      name: "Sierra Leona",
      code: "+232"
    },
    {
      name: "Singapur",
      code: "+65"
    },
    {
      name: "Siria",
      code: "+963"
    },
    {
      name: "Somalia",
      code: "+252"
    },
    {
      name: "Sri Lanka",
      code: "+94"
    },
    {
      name: "Suazilandia",
      code: "+268"
    },
    {
      name: "Sudáfrica",
      code: "+27"
    },
    {
      name: "Sudán",
      code: "+249"
    },
    {
      name: "Suecia",
      code: "+46"
    },
    {
      name: "Suiza",
      code: "+41"
    },
    {
      name: "Surinam",
      code: "+597"
    },
    {
      name: "Tailandia",
      code: "+66"
    },
    {
      name: "Taiwán",
      code: "+886"
    },
    {
      name: "Tanzania",
      code: "+255"
    },
    {
      name: "Tayikistán",
      code: "+992"
    },
    {
      name: "Timor del Este",
      code: "+670"
    },
    {
      name: "Togo",
      code: "+228"
    },
    {
      name: "Tokelau",
      code: "+690"
    },
    {
      name: "Tonga",
      code: "+676"
    },
    {
      name: "Trinidad y Tobago",
      code: "+1"
    },
    {
      name: "Túnez",
      code: "+216"
    },
    {
      name: "Turquía",
      code: "+90"
    },
    {
      name: "Tuvalu",
      code: "+688"
    },
    {
      name: "Ucrania",
      code: "+380"
    },
    {
      name: "Uganda",
      code: "+256"
    },
    {
      name: "Uruguay",
      code: "+598"
    },
    {
      name: "Uzbekistán",
      code: "+998"
    },
    {
      name: "Vanuatu",
      code: "+678"
    },
    {
      name: "Venezuela",
      code: "+58"
    },
    {
      name: "Vietnam",
      code: "+84"
    },
    {
      name: "Wallis y Futuna",
      code: "+681"
    },
    {
      name: "Yemen",
      code: "+967"
    },
    {
      name: "Yibouti",
      code: "+253"
    },
    {
      name: "Zambia",
      code: "+260"
    },
    {
      name: "Zimbabue",
      code: "+263"
    },
  ];

  const input = document.getElementById("prefix");
  const dropdown = document.getElementById("dropdown");

  input.addEventListener("input", () => {
    const query = input.value.toLowerCase();

    if (/^\d+$/.test(query)) {
      const matched = countries.find((c) => c.code.replace("+", "") === query);
      if (matched) {
        input.value = matched.code;
        showSuccess(input);
        dropdown.classList.add("hidden");
        return;
      }
    }

    dropdown.innerHTML = "";

    if (!query) {
      dropdown.classList.add("hidden");
      return;
    }

    const filtered = countries.filter(
      (c) => c.name.toLowerCase().includes(query) || c.code.includes(query)
    );

    if (filtered.length === 0) {
      dropdown.innerHTML = "<div>Ningún país encontrado</div>";
    } else {
      filtered.forEach((c) => {
        const item = document.createElement("div");
        item.textContent = `${c.name} (${c.code})`;
        item.addEventListener("click", () => {
          input.value = `${c.code}`;
          dropdown.classList.add("hidden");

          showSuccess(input);
        });
        dropdown.appendChild(item);
      });
    }

    dropdown.classList.remove("hidden");
  });

  // input.addEventListener("focus", () => {
  //     dropdown.classList.remove("hidden");
  // });

  input.addEventListener("click", () => {
    // Mostra todas as opções quando o input é clicado
    if (dropdown.classList.contains("hidden")) {
      dropdown.innerHTML = "";

      countries.forEach((c) => {
        const item = document.createElement("div");
        item.textContent = `${c.name} (${c.code})`;
        item.addEventListener("click", () => {
          input.value = `${c.code}`;
          dropdown.classList.add("hidden");
          showSuccess(input);
        });
        dropdown.appendChild(item);
      });

      dropdown.classList.remove("hidden");
    }
  });

  const divPrefixo = document.querySelector(".form-campo-prefixo");

  // Oculta o dropdown ao clicar fora
  document.addEventListener("click", (e) => {
    if (!e.target.closest(".phone-prefix-selector")) {
      dropdown.classList.add("hidden");
    }
  });
  </script>

  <script>
  // Abrir o Popup
  function eventoClick(ele) {
    ele.addEventListener("click", function() {
      bodyEl.classList.toggle("popup-aberto");
    });
  }

  const btnsPopupEl = document.querySelectorAll('[id*="botaoPopup"]');
  const bodyEl = document.body;

  btnsPopupEl.forEach(eventoClick);

  // Validação do formulário

  const firstnameForm = document.querySelector("#firstname");
  const emailForm = document.querySelector("#email");
  const prefixForm = document.querySelector("#prefix");
  const nationalPhoneForm = document.querySelector("#national-phone");
  const phoneForm = document.querySelector("#phone");

  const formActive = document.querySelector(".form");

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

  const checkFirstname = () => {
    let valid = false;
    const firstname = firstnameForm.value.trim();

    if (!isRequired(firstname)) {
      showError(firstnameForm, "Tu nombre no puede estar vacío.");
    } else {
      showSuccess(firstnameForm);
      valid = true;
    }
    return valid;
  };

  const checkEmail = () => {
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
    } else if (!countries.some((c) => c.code === prefix)) {
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
        "Tu número de teléfono no puede estar vacío."
      );
    } else if (!isPhoneValid(nationalPhone)) {
      showError(
        nationalPhoneForm,
        "El número de teléfono ingresado no es válido."
      );
    } else {
      showSuccess(nationalPhoneForm);
      valid = true;
    }
    return valid;
  };

  const checkFullPhone = () => {
    let valid = false;

    if (checkPhonePrefix() && checkNationalPhone()) {
      valid = true;
      buildPhone();
    }
    console.log("Checando telefone completo");
    console.log(checkNationalPhone());
    return valid;
  };

  // prefixForm.addEventListener("blur", () => {
  //     checkPhonePrefix();
  // });

  const buildPhone = () => {
    const prefix = prefixForm.value.trim();
    const nationalPhone = nationalPhoneForm.value.trim();

    phoneForm.value = prefix + nationalPhone;
    console.log(phoneForm.value);
  };

  formActive.addEventListener(
    "input",
    debounce(function(e) {
      switch (e.target.id) {
        case "firstname":
          checkFirstname();
          break;
        case "email":
          checkEmail();
          break;
        case "prefix":
          checkPhonePrefix();
          break;
        case "national-phone":
          checkNationalPhone();
          break;
      }
    })
  );

  formActive.addEventListener("submit", function(e) {
    e.preventDefault();

    let isFirstnameValid = checkFirstname(),
      isEmailValid = checkEmail(),
      isPhoneValid = checkFullPhone();

    let isFormValid = isFirstnameValid && isEmailValid && isPhoneValid;

    console.log(isFormValid);

    if (isFormValid) {
      formActive.submit();
    }
  });
  </script>

  <script>
  (function() {
    const OPEN_CLASS = 'popup-aberto';

    function openPopup() {
      document.body.classList.add(OPEN_CLASS);
      const first = document.getElementById('firstname');
      if (first) setTimeout(() => first.focus(), 30);
    }

    document.addEventListener('click', function(e) {
      const btn = e.target.closest('.js-botaoOferta.url-curso-lancamento--excel');
      if (!btn) return;

      e.preventDefault();
      e.stopImmediatePropagation();
      openPopup();
    }, true);

    document.addEventListener('keydown', function(e) {
      if (e.key === 'Enter' && document.activeElement?.matches('.js-botaoOferta.url-curso-lancamento--excel')) {
        e.preventDefault();
        e.stopImmediatePropagation();
        openPopup();
      }
    }, true);

    // Fallback: reescreve o href quando tudo carregar (se algum script ficar forçando navegação)
    window.addEventListener('load', () => {
      const btn = document.querySelector('.js-botaoOferta.url-curso-lancamento--excel');
      if (btn) {
        btn.setAttribute('href', '#');
        btn.setAttribute('role', 'button');
      }
    });
  })();
  </script>

  <script>
  (function() {
    const getParam = k => new URLSearchParams(location.search).get(k);
    const qsa = sel => Array.from(document.querySelectorAll(sel));
    const setVal = (selectors, val) => {
      if (!val) return;
      selectors.forEach(sel => qsa(sel).forEach(el => {
        if (el) el.value = val;
      }));
    };

    // mapeia todos os possíveis seletores dos campos
    const MAP = {
      origemurl: ['[name="field[6]"]', '[name="origemurl"]', '#origemurl'],
      utm_source: ['[name="field[135]"]', '[name="utm_source"]', '#utm_source'],
      utm_medium: ['[name="field[136]"]', '[name="utm_medium"]', '#utm_medium'],
      utm_term: ['[name="field[137]"]', '[name="utm_term"]', '#utm_term'],
      utm_content: ['[name="field[138]"]', '[name="utm_content"]', '#utm_content'],
      utm_campaign: ['[name="field[139]"]', '[name="utm_campaign"]', '#utm_campaign'],
      conversion: ['[name="field[134]"]', '[name="conversion"]', '#conversion'],
    };

    // origem default se não vier na URL
    const buildOrigemUrl = () => {
      const fonte = getParam('fonte');
      return 'hashtag_' + (fonte && fonte !== 'org' ? fonte : 'semana') + '_org_lesexcap';
    };

    function fill() {
      const values = {
        utm_source: getParam('utm_source') || 'site',
        utm_medium: getParam('utm_medium') || 'curso-excel-gratis',
        utm_content: getParam('utm_content') || 'home',
        utm_campaign: getParam('utm_campaign') || 'capacitacion',
        utm_term: getParam('utm_term') || '',
        conversion: getParam('conversion') || '',
        origemurl: getParam('origemurl') || buildOrigemUrl(),
      };
      Object.entries(values).forEach(([k, v]) => setVal(MAP[k], v));
      // console.debug('[UTM-FILL] aplicado:', values);
    }

    document.addEventListener('DOMContentLoaded', () => {
      fill();
      // re-tentativas para popup / DOM tardio
      setTimeout(fill, 200);
      setTimeout(fill, 800);

      document.querySelectorAll('[id*="botaoPopup"], .js-open-popup, .btn--popup')
        .forEach(btn => btn.addEventListener('click', () => {
          setTimeout(fill, 50);
          setTimeout(fill, 300);
        }));
    });
  })();
  </script>

  <script>
  function debounce(fn, wait = 200) {
    let t;
    return function(...args) {
      clearTimeout(t);
      t = setTimeout(() => fn.apply(this, args), wait);
    }
  }
  </script>




  <!-- <script type="application/ld+json">
    {
    "@context": "https://schema.org/", 
    "@type": "BreadcrumbList", 
    "itemListElement": [{
        "@type": "ListItem", 
        "position": 1, 
        "name": "Home",
        "item": "https://www.hashtagtreinamentos.com"  
    },{
        "@type": "ListItem", 
        "position": 2, 
        "name": "Curso de Excel Online",
        "item": "https://www.hashtagtreinamentos.com/curso-de-excel-online"  
    },{
        "@type": "ListItem", 
        "position": 3, 
        "name": "Curso de Power BI",
        "item": "https://www.hashtagtreinamentos.com/curso-power-bi"  
    },{
        "@type": "ListItem", 
        "position": 4, 
        "name": "Curso de Python Online",
        "item": "https://www.hashtagtreinamentos.com/curso-python"  
    },{
        "@type": "ListItem", 
        "position": 5, 
        "name": "Cursos Hashtag Treinamentos",
        "item": "https://www.hashtagtreinamentos.com/cursos-hashtag-treinamentos"  
    },{
        "@type": "ListItem", 
        "position": 6, 
        "name": "Curso de VBA Excel",
        "item": "https://www.hashtagtreinamentos.com/curso-vba-excel"  
    },{
        "@type": "ListItem", 
        "position": 7, 
        "name": "Todos os Cursos",
        "item": "https://www.hashtagtreinamentos.com/todos-os-cursos"  
    },{
        "@type": "ListItem", 
        "position": 8, 
        "name": "Curso de SQL",
        "item": "https://www.hashtagtreinamentos.com/curso-sql"  
    },{
        "@type": "ListItem", 
        "position": 9, 
        "name": "Blog",
        "item": "https://www.hashtagtreinamentos.com/blog"  
    },{
        "@type": "ListItem", 
        "position": 10, 
        "name": "Cursos Hashtag Programação",
        "item": "https://www.hashtagtreinamentos.com/cursos-hashtag-programacao"  
    },{
        "@type": "ListItem", 
        "position": 11, 
        "name": "Contato",
        "item": "https://www.hashtagtreinamentos.com/contato"  
    },{
        "@type": "ListItem", 
        "position": 12, 
        "name": "Treinamentos Corporativos",
        "item": "https://www.hashtagtreinamentos.com/treinamentos-corporativos"  
    },{
        "@type": "ListItem", 
        "position": 13, 
        "name": "Curso PowerPoint",
        "item": "https://www.hashtagtreinamentos.com/curso-powerpoint"  
    },{
        "@type": "ListItem", 
        "position": 14, 
        "name": "Banco de Vagas",
        "item": "https://www.hashtagtreinamentos.com/banco-de-vagas"  
    }]
    }
</script> -->

  <!-- JSON-LD da home agora vem do grafo nativo (inc/seo/schema/*). O bloco
       EducationalOrganization inline aqui era duplicado e estava INVALIDO (comentario
       malformado dentro do JSON) — removido. Ver Schema (Grafo Nativo) no CLAUDE.md. -->

</body>

</html>