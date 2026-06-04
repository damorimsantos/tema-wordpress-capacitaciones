<!-- Modelo padrÃ£o para a pÃ¡gina inicial do blog -->

<?php
/*
Template name: Blog
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
   <!-- NÃƒO MEXER AQUI CODEX NEM NOS COMENTÃRIOS -->
  <!-- <link rel="stylesheet" href="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/sass/css/style.css" /> -->
  <link rel="stylesheet" href="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/sass/css/blog/style.css" />

  <?php wp_head(); ?>
  <!-- Scripts do Head configurados em 'OpÃ§Ãµes do Site'/ https://www.hashtagtreinamentos.com/wp-admin/admin.php?page=opcoes-do-site  -->
  <?php the_field('head', 'option'); ?>
</head>

<body <?php body_class('header--blog pg-blog'); ?>>
  <?php get_header('capacitaciones'); ?>

  <?php
  $blog_page_id = (int) get_option('page_for_posts');
  $blog_page_url = '';

  if (is_page()) {
    $blog_page_url = get_permalink();
  } elseif ($blog_page_id) {
    $blog_page_url = get_permalink($blog_page_id);
  }

  if (!$blog_page_url) {
    $blog_page = get_page_by_path('blog');
    $blog_page_url = $blog_page ? get_permalink($blog_page->ID) : home_url('/');
  }

  $search_term = isset($_GET['s']) ? sanitize_text_field(wp_unslash($_GET['s'])) : '';
  $selected_category_slug = isset($_GET['categoria']) ? sanitize_title(wp_unslash($_GET['categoria'])) : '';
  $selected_category = $selected_category_slug ? get_category_by_slug($selected_category_slug) : null;
  $paged = max(1, (int) get_query_var('paged'), (int) get_query_var('page'));

  $blog_query_args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'posts_per_page' => 12,
    'paged' => $paged,
    'ignore_sticky_posts' => true,
  );

  if ($search_term !== '') {
    $blog_query_args['s'] = $search_term;
  }

  if ($selected_category instanceof WP_Term) {
    $blog_query_args['cat'] = $selected_category->term_id;
  }

  $blog_query = new WP_Query($blog_query_args);
  $pagination_format = get_option('permalink_structure') ? 'page/%#%/' : '?paged=%#%';
  ?>

  <main class="blog">
    <section class="blog-hero"
      style="background-image: url('/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/imgs/Global/bg-blog.webp');">

      <div class="container">
        <div class="blog-hero__content">
          <h1 class="blog-hero__title">
            <?php
            if ($selected_category instanceof WP_Term) {
              echo esc_html($selected_category->name);
            } elseif ($search_term !== '') {
              echo 'Resultados para: ' . esc_html($search_term);
            } else {
              echo 'Blog de Hashtag';
            }
            ?>
          </h1>

          <p class="blog-hero__subtitle">
            Tutoriales para impulsar tu aprendizaje efectivo.
          </p>
        </div>
      </div>
    </section>

    <section class="blog-search">
      <div class="container">
        <form role="search" method="get" action="<?php echo esc_url($blog_page_url); ?>" class="blog-search__form">
          <?php if ($selected_category instanceof WP_Term) : ?>
            <input type="hidden" name="categoria" value="<?php echo esc_attr($selected_category->slug); ?>">
          <?php endif; ?>

            <input
            type="search"
            name="s"
            placeholder="Buscar"
            value="<?php echo esc_attr($search_term); ?>">
        </form>
      </div>
    </section>

    <section class="blog-categorias">
      <div class="container">
        <div class="blog-categorias__wrapper">
          <button class="blog-categorias__nav blog-categorias__nav--prev" aria-label="Anterior" type="button">
            &lsaquo;
          </button>

          <div class="blog-categorias__track-wrapper">
            <div class="blog-categorias__track">
              <a
                href="<?php echo esc_url($blog_page_url . ($search_term !== '' ? '?s=' . rawurlencode($search_term) : '')); ?>"
                class="blog-categorias__chip <?php echo $selected_category ? '' : 'is-active'; ?>"
                data-category="all">
                Todos
              </a>

              <?php
              $categories = get_categories(array(
                'orderby' => 'name',
                'order' => 'ASC',
                'hide_empty' => true,
              ));

              foreach ($categories as $category) :
                $category_query_args = array('categoria' => $category->slug);

                if ($search_term !== '') {
                  $category_query_args['s'] = $search_term;
                }

                $category_url = add_query_arg($category_query_args, $blog_page_url);
                $is_active_category = $selected_category && $selected_category->slug === $category->slug;
              ?>
                <a
                  href="<?php echo esc_url($category_url); ?>"
                  class="blog-categorias__chip <?php echo $is_active_category ? 'is-active' : ''; ?>"
                  data-category="<?php echo esc_attr($category->slug); ?>">
                  <?php echo esc_html($category->name); ?>
                </a>
              <?php endforeach; ?>
            </div>
          </div>

          <button class="blog-categorias__nav blog-categorias__nav--next" aria-label="Siguiente" type="button">
            &rsaquo;
          </button>
        </div>
      </div>
    </section>

    <section class="blog-content">
      <div class="container blog-content__layout">
        <div class="blog-content__posts">
          <?php if ($blog_query->have_posts()) : ?>
            <div class="blog-grid">
              <?php while ($blog_query->have_posts()) : $blog_query->the_post(); ?>
                <?php
                $cats = get_the_category();
                $cat_slug = $cats ? $cats[0]->slug : '';
                $cat_name = $cats ? $cats[0]->name : '';
                ?>

                <article class="blog-card" data-category="<?php echo esc_attr($cat_slug); ?>">
                  <a href="<?php the_permalink(); ?>" class="blog-card__thumb">
                    <?php if (has_post_thumbnail()) : ?>
                      <?php the_post_thumbnail('medium_large'); ?>
                    <?php endif; ?>
                  </a>

                  <div class="blog-card__body">
                    <?php if ($cat_name) : ?>
                      <span class="blog-card__category">
                        <?php echo esc_html($cat_name); ?>
                      </span>
                    <?php endif; ?>

                    <h3 class="blog-card__title">
                      <a href="<?php the_permalink(); ?>">
                        <?php the_title(); ?>
                      </a>
                    </h3>

                    <p class="blog-card__excerpt">
                      <?php echo esc_html(wp_trim_words(get_the_excerpt(), 18)); ?>
                    </p>

                    <a href="<?php the_permalink(); ?>" class="blog-card__link">
                      Leer más &rarr;
                    </a>
                  </div>
                </article>
              <?php endwhile; ?>
            </div>

            <div class="blog-pagination">
              <?php
              $pagination_args = array();

              if ($search_term !== '') {
                $pagination_args['s'] = $search_term;
              }

              if ($selected_category instanceof WP_Term) {
                $pagination_args['categoria'] = $selected_category->slug;
              }

              echo paginate_links(array(
                'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                'format' => $pagination_format,
                'total' => $blog_query->max_num_pages,
                'current' => $paged,
                'mid_size' => 2,
                'prev_text' => '&lsaquo;',
                'next_text' => '&rsaquo;',
                'type' => 'list',
                'add_args' => $pagination_args,
              ));
              ?>
            </div>

            <?php wp_reset_postdata(); ?>
          <?php else : ?>
            <p>No se encontrÃ³ ningÃºn post.</p>
          <?php endif; ?>
        </div>
      </div>
    </section>
  </main>

  <?php get_footer('hashtag'); ?>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const track = document.querySelector(".blog-categorias__track");
      const prev = document.querySelector(".blog-categorias__nav--prev");
      const next = document.querySelector(".blog-categorias__nav--next");

      if (track && prev && next) {
        prev.addEventListener("click", () => {
          track.scrollBy({
            left: -200,
            behavior: "smooth"
          });
        });

        next.addEventListener("click", () => {
          track.scrollBy({
            left: 200,
            behavior: "smooth"
          });
        });
      }
    });
  </script>

  <?php wp_footer(); ?>
  <?php the_field('footer', 'option'); ?>

  <style>
    .blog-content .container,
    .blog-content__layout {
      grid-template-columns: minmax(0, 1fr) !important;
      gap: 0 !important;
    }

    .blog-content__posts {
      width: 100%;
      max-width: none;
    }

    .blog-grid {
      grid-template-columns: repeat(4, minmax(0, 1fr));
    }

    .blog-content__aside {
      display: none !important;
    }

    .blog-categorias__chip {
      display: inline-flex;
      align-items: center;
      justify-content: center;
    }

    .blog-categorias__chip,
    .blog-categorias__chip:link,
    .blog-categorias__chip:visited,
    .blog-categorias__chip:hover,
    .blog-categorias__chip:active {
      text-decoration: none;
    }

    @media (max-width: 1440px) {
      .blog-grid {
        grid-template-columns: repeat(3, minmax(0, 1fr));
      }
    }

    @media (max-width: 1024px) {
      .blog-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
      }
    }

    @media (max-width: 768px) {
      .blog-grid {
        grid-template-columns: 1fr;
      }
    }
  </style>

  <?php if (is_home() || is_category() || is_single()) : ?>
    <style>
      .footer__luz,
      .footer__luz--ingles {
        display: none !important;
      }
    </style>
  <?php endif; ?>
</body>

</html>

