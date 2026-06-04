<!-- Modelo padrão para a página de Posts do blog -->

<?php
/*
Template name: Post Blog Old
*/
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>
    <?php wp_title('|', true, 'right'); ?>
  </title>

  <!-- CSS -->
  <!-- <link rel="stylesheet" href="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/sass/css/style.css" /> -->
  <link rel="stylesheet"
    href="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/sass/css/post-blog/style.css" />

  <?php wp_head(); ?>
  <!-- Scripts do Head configurados em 'Opções do Site'/ https://www.hashtagtreinamentos.com/wp-admin/admin.php?page=opcoes-do-site  -->
  <?php the_field('head', 'option'); ?>
</head>

<body class="header--blog pg-post">
  <?php get_header('capacitaciones'); ?>

  <main>
    <section class="secao titulo-aside-conteudo">
      <div class="container">

        <div class="titulo">
          <div class="breadcrumbs-h1">
            <div id="breadcrumbs">
              <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?></div>
            <h1><?php the_title(); ?></h1>
          </div>
          <hr>
        </div>

        <!-- <div class="aside-conteudo"> -->
        <div class="aside">
          <div class="categorias">
            <h2>Categorias</h2>
            <ul class="lista-categorias">
              <a class="categoria" href="#">
                <li>Dicas da Hashtag</li>
              </a>
              <a class="categoria" href="#">
                <li>Excel Avançado</li>
              </a>
              <a class="categoria" href="#">
                <li>Excel Básico</li>
              </a>
              <a class="categoria" href="#">
                <li>Excel Intermediário</li>
              </a>
              
            </ul>
          </div>
        </div>

        <div class="conteudo">
          <div class="container-conteudo">
            <?php while ( have_posts() ) : the_post() ?>
            <?php $foto = get_the_post_thumbnail_url();
                                if ($foto) {
                                ?>
            <div class="foto d-none" style="background-image:url(<?php echo $foto; ?>)"></div>
            <?php } ?>
            <div class="postado-em">
              <span>Postado em </span>
              <div class="lista-categorias-post">
                <?php the_category(); ?>
              </div>
              <span>em <?php echo get_the_date(); ?></span>
            </div>
            <?php the_content(); ?>

            <?php endwhile; ?>
          </div>
        </div>
        <!-- </div> -->
      </div>
    </section>
  </main>

  <?php get_footer('hashtag'); ?>

  <?php wp_footer(); ?>
  <?php the_field('footer', 'option'); ?>
  <!-- Pega o campo 'footer' da página 'Opções do Site'/https://www.hashtagtreinamentos.com/wp-admin/admin.php?page=opcoes-do-site -->
</body>

</html>