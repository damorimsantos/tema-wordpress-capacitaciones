<!-- Modelo padrÃ£o para a pÃ¡gina inicial do blog -->

<?php
/*
Template name: Blog Antigo
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
  <link rel="stylesheet" href="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/sass/css/blog/style.css" />

  <?php wp_head(); ?>
  <!-- Scripts do Head configurados em 'OpÃ§Ãµes do Site'/ https://www.hashtagtreinamentos.com/wp-admin/admin.php?page=opcoes-do-site  -->
  <?php the_field('head', 'option'); ?>
</head>

<body class="header--blog">
  <?php get_header('capacitaciones'); ?>

  <main>
    <section class="secao titulo-aside-conteudo">
      <div class="container">
        <div class="titulo">
          <?php if(is_category()):
      
          $queried_object = get_queried_object();
          $term_id = $queried_object->term_id;
          ?>
            <div class="breadcrumbs-h1-descricao">
              <div class="breadcrumbs-h1">
                <div id="breadcrumbs"><?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?></div>
                <h1 class="h1 tit"><?php single_cat_title(); ?></h1>
              </div>
              <div class="descricao-categoria"><?php echo category_description(); ?></div>
            </div>
            <hr>
          
          <?php elseif(is_archive()): ?>
          
            <div class="breadcrumbs-h1">
              <h1 class="h1 tit">Arquivos de <?php the_time('F - Y'); ?></h1>
              <div id="breadcrumbs"><?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?></div>
            </div>
            <hr>
          
          <?php elseif(is_search()):
          
          global $wp_query;
          $total_results = $wp_query->found_posts;
          ?>
            <div class="breadcrumbs-h1">
              <div id="breadcrumbs"><?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?></div>
              <h1 class="h1 tit"><?php echo $_GET['s']; ?></h1>
            </div>
            <h2 class="h2 tit">VocÃª pesquisou por <?php echo $_GET['s']; ?></h2>
            <hr>
      
          <?php else: ?>
          
            <div class="breadcrumbs-h1">
              <div id="breadcrumbs"><?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?></div>
              <h1 class="h1 tit">Blog</h1>
            </div>
            <hr>
          
          <?php endif; ?>
        </div>

        <div class="conteudo">
            <div class="container-conteudo">
              <?php 
                $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                if(is_category()):
                  $args = array(
                    'post_type' => 'post',
                    'posts_per_page' => 12,
                    'post_status' => 'publish',
                    'cat' => $term_id,
                    'paged' => $paged
                  );
                elseif(is_archive()):
                  $args = array(
                    'post_type' => 'post',
                    'posts_per_page' => 12,
                    'post_status' => 'publish',
                    'date_query' => array (
                    'year' => get_the_time('Y'),
                    'month' => get_the_time('m')
                  ),
                  'paged' => $paged
                  );
                elseif(is_search()):
                  $args = array(
                    'post_type' => 'post',
                    'posts_per_page' => 12,
                    'post_status' => 'publish',
                    's' => $_GET['s'],
                    'paged' => $paged
                  );
                else:
                  $args = array(
                      'post_type' => 'post',
                      'posts_per_page' => 12,
                      'post_status' => 'publish',
                      'paged' => $paged
                    );
                endif;
                  $the_query = new WP_Query( $args );
                  if ( $the_query->have_posts() ) :
                    while ( $the_query->have_posts() ) : $the_query->the_post();
              ?>
                      <div class="artigo mb-5">
                        <?php $foto = get_the_post_thumbnail_url();
                          if ($foto) {
                        ?>
                          <a class="link-foto" href="<?php the_permalink(); ?>"><div class="foto" style="background-image:url(<?php echo $foto; ?>)"></div></a>
                        <?php } ?>
                        <div class="dados">
                          <span>Postado em </span>
                          <?php the_category(); ?>
                          <span>em <?php echo get_the_date(); ?></span>
                        </div>
                        <div class="cont">
                          <h4><?php the_title(); ?></h4>
                          <?php the_excerpt(); ?>
                          <a href="<?php the_permalink(); ?>" class="botao btn">Leer más</a>
                        </div>
                      </div>
                    <?php endwhile; ?>
              <div class="paginacao">
                <?php 
                  echo paginate_links( array(
                      'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
                      'total'        => $the_query->max_num_pages,
                      'current'      => max( 1, get_query_var( 'paged' ) ),
                      'format'       => '?page=%#%',
                      'show_all'     => false,
                      'type'         => 'plain',
                      'end_size'     => 4,
                      'mid_size'     => 1,
                      'prev_next'    => true,
                      'prev_text'    => sprintf( '%1$s', __( '<', 'text-domain' ) ),
                      'next_text'    => sprintf( '%1$s', __( '>', 'text-domain' ) ),
                      'add_args'     => false,
                      'add_fragment' => '',
                  ));
                ?>
              </div>
              <?php wp_reset_postdata(); ?>
              <?php else : ?>
              <p><?php _e( 'Nenhuma postagem encontrada.' ); ?></p>
              <?php endif; ?>
            </div>
        </div>
        
        <div class="aside">
          <!-- sidebar -->
          <!-- <div class="container-sidebar">
            <div class="sidebar">
              <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Widget Blog") ) : ?>
              <?php endif;?>
            </div>
          </div> -->

          <div class="categorias">
            <h2>Categorias</h2>
            <ul class="lista-categorias">
              <a class="categoria" href="https://www.hashtagtreinamentos.com/category/ciencia-de-dados">
                <li>CiÃªncia de Dados</li>
              </a>
              <a class="categoria" href="https://www.hashtagtreinamentos.com/category/dicas-da-hashtag">
                <li>Dicas da Hashtag</li>
              </a>
              <a class="categoria" href="https://www.hashtagtreinamentos.com/category/excel-avancado">
                <li>Excel AvanÃ§ado</li>
              </a>
              <a class="categoria" href="https://www.hashtagtreinamentos.com/category/excel-basico">
                <li>Excel BÃ¡sico</li>
              </a>
              <a class="categoria" href="https://www.hashtagtreinamentos.com/category/excel-intermediario">
                <li>Excel IntermediÃ¡rio</li>
              </a>
              <a class="categoria" href="https://www.hashtagtreinamentos.com/category/html-e-css">
                <li>HTML e CSS</li>
              </a>
              <a class="categoria" href="https://www.hashtagtreinamentos.com/category/inteligencia-artificial">
                <li>InteligÃªncia Artificial</li>
              </a>
              <a class="categoria" href="https://www.hashtagtreinamentos.com/category/javascript">
                <li>JavaScript</li>
              </a>
              <a class="categoria" href="https://www.hashtagtreinamentos.com/category/modelos-de-planilhas">
                <li>Modelos de Planilhas</li>
              </a>
              <a class="categoria" href="https://www.hashtagtreinamentos.com/category/power-apps">
                <li>Power Apps</li>
              </a>
              <a class="categoria" href="https://www.hashtagtreinamentos.com/category/power-automate">
                <li>Power Automate</li>
              </a>
              <a class="categoria" href="https://www.hashtagtreinamentos.com/category/power-bi">
                <li>Power BI</li>
              </a>
              <a class="categoria" href="https://www.hashtagtreinamentos.com/category/powerpoint">
                <li>PowerPoint</li>
              </a>
              <a class="categoria" href="https://www.hashtagtreinamentos.com/category/python">
                <li>Python</li>
              </a>
              <a class="categoria" href="https://www.hashtagtreinamentos.com/category/sql">
                <li>SQL</li>
              </a>
              <a class="categoria" href="https://www.hashtagtreinamentos.com/category/treinamentos-corporativos">
                <li>Treinamentos Corporativos</li>
              </a>
              <a class="categoria" href="https://www.hashtagtreinamentos.com/category/vba">
                <li>VBA</li>
              </a>
            </ul>
          </div>
        </div>
      </div>
    </section>



  </main>

  <?php get_footer('hashtag'); ?>

  <?php wp_footer(); ?>
  <?php the_field('footer', 'option'); ?>
  <!-- Pega o campo 'footer' da pÃ¡gina 'OpÃ§Ãµes do Site'/https://www.hashtagtreinamentos.com/wp-admin/admin.php?page=opcoes-do-site -->
</body>

</html>
