<!-- CSS -->
<!-- <link rel="stylesheet" href="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/sass/css/style.css" /> -->
<link rel="stylesheet"
  href="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/sass/css/header-capacitaciones/style.css" />

<?php $blog_url = 'https://hashtagcapacitaciones.com/blog'; ?>

<header class="header grade-conteudo">
  <div class="fuga">
    <a href="https://www.hashtagcapacitaciones.com/" class="header__logo">
      <img src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Global/logo-hashtag.webp"
        alt="Logo Hashtag Capacitaciones" />
    </a>

    <!-- logo e nav juntos, 991px pra cima -->
    <div class="header__logo-nav">
      <a href="https://www.hashtagcapacitaciones.com/" class="header__logo">
        <img src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Global/logo-hashtag.webp"
          alt="Logo Hashtag Capacitaciones" />
      </a>
      <nav class="header__nav header__nav--inline" aria-label="Menú principal">
        <div class="header__menu">
          <div class="header__menu-central"></div>
        </div>
        <ul>
          <li class="header__item header__item--blog">
            <a class="header__titulo" href="<?php echo esc_url($blog_url); ?>">
              Blog
            </a>
          </li>
        </ul>
      </nav>
    </div>
    <!-- fim logo e nav juntos -->

    <nav class="header__nav" aria-label="Menú principal móvil">
      <div class="header__menu">
        <div class="header__menu-central"></div>
      </div>
      <ul>
        <li class="header__item header__item--blog">
          <a class="header__titulo" href="<?php echo esc_url($blog_url); ?>">
            Blog
          </a>
        </li>
      </ul>
    </nav>

    <div class="header__botoes">
      <a href="<?php echo esc_url(home_url('/acceso-portal')); ?>" class="botao botao--sm botao--sem-fundo botao--login">Inicio de
        sesión</a>
      <a class="js-botaoOferta botao botao--sm url-curso-lancamento--excel botao-semana-excel"
        href="https://lp.hashtagcapacitaciones.com/excel/pg-inscripcion?fonte=lespera&utm_source=site&utm_medium=header&utm_content=header-matriculese&utm_campaign=capacitacion">Inscríbete</a>
    </div>
  </div>
</header>

<!-- Header -->
<script src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/js/header.js"></script>

<!-- Conversion form -->
<!-- <script src="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/js/utm-conversion-form.js"></script> -->
