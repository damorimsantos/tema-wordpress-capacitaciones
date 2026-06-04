<!-- Páginas criadas pelo menu 'Páginas', ex: Curso Power BI Online, Treinamentos para Empresas... -->
<?php get_header(); ?>
<section class="bread bg-azul claro pb-4">
  <div class="container">
    <h1 class="h1 tit centro"><?php the_title(); ?></h1>
	  <div id="breadcrumbs"><?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?></div>
  </div>
</section>

<section class="padrao py-5">
  <div class="container">
       <?php while ( have_posts() ) : the_post() ?>
        <?php the_content(); ?>
        <?php endwhile; ?>
    </div>
</section>
<?php get_footer(); ?>