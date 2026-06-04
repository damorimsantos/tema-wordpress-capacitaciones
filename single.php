<!-- Modelo padrao para a pagina de Posts do blog -->

<?php
/*
Template name: Post Blog
*/

$current_post_type = get_post_type();
$is_web_story = in_array($current_post_type, ['web-story', 'web_story', 'web-stories'], true);
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>
    <?php wp_title('|', true, 'right'); ?>
  </title>

  <!-- CSS -->
   <!-- não mexer aqui codex, deixe os comentários -->
  <!-- <link rel="stylesheet" href="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/sass/css/style.css" /> -->
  <link rel="stylesheet"
    href="/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/sass/css/post-blog/style.css" />

  <?php wp_head(); ?>
  <?php if (!$is_web_story) : ?>
    <!-- Scripts do Head configurados em 'Opcoes do Site'/ https://www.hashtagtreinamentos.com/wp-admin/admin.php?page=opcoes-do-site  -->
    <?php the_field('head', 'option'); ?>
  <?php endif; ?>
</head>

<body class="header--blog pg-post">
  <?php get_header('capacitaciones'); ?>

  <?php
  $blog_page_id = (int) get_option('page_for_posts');
  $blog_url = $blog_page_id ? get_permalink($blog_page_id) : '';

  if (!$blog_url) {
    $blog_page = get_page_by_path('blog');
    $blog_url = $blog_page ? get_permalink($blog_page->ID) : home_url('/blog');
  }
  ?>

  <main class="post">
    <div class="post__top">
      <div class="container">
        <a href="<?php echo esc_url($blog_url); ?>" class="post__back">
          <span class="post__back-icon" aria-hidden="true">&larr;</span>
          <span>Volver al blog</span>
        </a>
      </div>
    </div>

    <?php if (have_posts()) : ?>
      <?php while (have_posts()) : the_post(); ?>
        <?php
        $post_id = get_the_ID();
        $author_id = (int) get_the_author_meta('ID');
        $author_name = get_the_author();
        $author_description = get_the_author_meta('description');
        $author_url = get_author_posts_url($author_id);
        $categories = get_the_category();
        $primary_category = $categories ? $categories[0] : null;
        $primary_category_slug = $primary_category ? $primary_category->slug : '';
        $primary_category_name = $primary_category ? $primary_category->name : '';
        $course_banner_aliases = [
          'inteligencia-artificial' => 'ia',
          'ingles' => 'ingles',
          'python' => 'python',
          'power-bi' => 'powerbi',
          'excel-basico' => 'excel',
          'excel-intermediario' => 'excel',
          'excel-avancado' => 'excel',
          'modelos-de-planilhas' => 'excel',
          'uncategorized' => 'comunidade-impressionadora',
          'sem-categoria' => 'comunidade-impressionadora',
          'dicas-da-hashtag' => 'comunidade-impressionadora',
          'treinamentos-corporativos-hashtag' => 'comunidade-impressionadora',
          'negocios' => 'comunidade-impressionadora',
          'r' => 'comunidade-impressionadora',
          'no-code' => 'comunidade-impressionadora',
          'ciencia-de-dados' => 'ciencia-dados',
          'javascript' => 'javascript',
          'vba' => 'vba',
          'sql' => 'sql',
          'html-e-css' => 'html-css',
          'power-apps' => 'power-apps',
          'power-automate' => 'power-automate',
          'powerpoint' => 'powerpoint',
          'analise-de-dados' => 'analise-dados',
          'full-stack' => 'full-stack',
          'front-end' => 'front-end',
          'n8n' => 'n8n',
          'make' => 'make',
          'flutterflow' => 'flutterflow',
        ];
        $course_banner_slug = $course_banner_aliases[$primary_category_slug] ?? '';
        $post_content = apply_filters('the_content', get_the_content());
        $heading_count = 0;

        if ($course_banner_slug !== '') {
          $post_content = preg_replace_callback(
            '/<h2\b[^>]*>.*?<\/h2>/is',
            static function ($matches) use (&$heading_count) {
              $heading_count++;

              if ($heading_count === 2) {
                return '<div class="post__course-banner-slot" data-course-banner-slot></div>' . $matches[0];
              }

              return $matches[0];
            },
            $post_content
          );
        }
        ?>

        <section class="post__hero">
          <div class="container post__layout">
            <article class="post__content">
              <header class="post__header">
                <?php if ($primary_category) : ?>
                  <a href="<?php echo esc_url(get_category_link($primary_category->term_id)); ?>" class="post__category">
                    <?php echo esc_html($primary_category->name); ?>
                  </a>
                <?php endif; ?>

                <h1 class="post__title"><?php the_title(); ?></h1>

                <div class="post__meta">
                  <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                    <?php echo esc_html(get_the_date('j \d\e F \d\e Y')); ?>
                  </time>
                  <span class="post__meta-separator" aria-hidden="true"></span>
                  <span><?php echo esc_html($author_name); ?></span>
                </div>
              </header>

              <?php if (has_post_thumbnail()) : ?>
                <figure class="post__thumbnail">
                  <?php the_post_thumbnail('full'); ?>
                </figure>
              <?php endif; ?>

              <div class="post__text">
                <?php echo $post_content; ?>
              </div>

              <section class="post__author" aria-label="Sobre el autor">
                <div class="post__author-main">
                  <div class="post__author-avatar">
                    <?php echo get_avatar($author_id, 96, '', esc_attr($author_name)); ?>
                  </div>

                  <div class="post__author-content">
                    <p class="post__author-label">Autor del artículo</p>
                    <h2 class="post__author-name"><?php echo esc_html($author_name); ?></h2>
                    <p class="post__author-description">
                      <?php
                      echo esc_html(
                        $author_description
                          ? $author_description
                          : 'Redactor de contenidos de Hashtag Capacitaciones, creando materiales didácticos y accesibles sobre tecnología.'
                      );
                      ?>
                    </p>
                  </div>
                </div>

                <a href="<?php echo esc_url($author_url); ?>" class="post__author-link">
                  <span>Ver más posts</span>
                  <span aria-hidden="true">&rarr;</span>
                </a>
              </section>
            </article>

            <aside class="post__aside" aria-label="Temas del post">
              <div class="post__toc post__toc--sticky" data-post-toc>
                <h2 class="post__toc-title">En este artículo</h2>
                <ul id="post-toc" class="post__toc-list"></ul>
              </div>
            </aside>
          </div>
        </section>

      <?php endwhile; ?>
    <?php endif; ?>
  </main>

  <?php get_footer('hashtag'); ?>

  <?php wp_footer(); ?>

  <?php if (!empty($course_banner_slug)) : ?>
    <script>
      (function() {
        const courseBannerSlug = <?php echo wp_json_encode($course_banner_slug); ?>;
        const courseBannerPostSlug = <?php echo wp_json_encode(get_post_field('post_name', get_the_ID())); ?>;
        const courseBannerTrackingMap = {
          ia: { curso: "ia", categoria: "treinamento" },
          ingles: { curso: "ing", categoria: "idioma" },
          python: { curso: "py", categoria: "programacao" },
          powerbi: { curso: "pbi", categoria: "treinamento" },
          excel: { curso: "ex", categoria: "treinamento" },
          "ciencia-dados": { curso: "cd", categoria: "programacao" },
          javascript: { curso: "js", categoria: "programacao" },
          vba: { curso: "vba", categoria: "treinamento" },
          sql: { curso: "sql", categoria: "programacao" },
          "html-css": { curso: "htmlcss", categoria: "programacao" },
          "power-apps": { curso: "powerapps", categoria: "treinamento" },
          powerpoint: { curso: "ppt", categoria: "treinamento" },
          "power-automate": { curso: "pa", categoria: "treinamento" },
          "analise-dados": { curso: "ad", categoria: "treinamento" },
          "full-stack": { curso: "fullstack", categoria: "programacao" },
          "front-end": { curso: "fe", categoria: "programacao" },
          n8n: { curso: "n8n", categoria: "programacao" },
          "comunidade-impressionadora": { curso: "comunidade-impressionadora", categoria: "treinamento" },
          make: { curso: "make", categoria: "programacao" },
          flutterflow: { curso: "flutterflow", categoria: "programacao" }
        };
        
        if (!courseBannerSlug) {
          return;
        }

        const getInsertionPoint = () => {
          const content = document.querySelector(".post__text");
          if (!content) return null;

          const headings = Array.from(content.querySelectorAll("h2")).filter((heading) => {
            return heading.textContent.trim() !== "";
          });

          return headings[1] || null;
        };

        const applyTrackingParams = (button) => {
          if (!button) return;

          try {
            const url = new URL(button.getAttribute("href"), window.location.origin);
            const trackingConfig = courseBannerTrackingMap[courseBannerSlug];

            url.searchParams.set("origemurl", `hashtag_site_org_blog_banner_${courseBannerPostSlug}`);
            url.searchParams.set("utm_source", "site-org");
            url.searchParams.set("utm_medium", "blog-banner");
            if (trackingConfig?.categoria) {
              url.searchParams.set("utm_campaign", trackingConfig.categoria);
            }
            url.searchParams.set("utm_content", courseBannerPostSlug);

            if (
              trackingConfig?.curso &&
              typeof window.dictTabelaLancamentos !== "undefined" &&
              typeof window.criarConversionLancamentoForm === "function" &&
              trackingConfig.curso in window.dictTabelaLancamentos
            ) {
              url.searchParams.set("conversion", window.criarConversionLancamentoForm(trackingConfig.curso));
            } else if (
              trackingConfig?.curso &&
              typeof window.criarConversionPerpetuoForm === "function"
            ) {
              url.searchParams.set("conversion", window.criarConversionPerpetuoForm(trackingConfig.curso));
            }

            button.setAttribute("href", url.toString());
          } catch (error) {}
        };

        const renderBanner = () => {
          const insertionPoint = getInsertionPoint();

          if (!insertionPoint) {
            return false;
          }

          if (
            insertionPoint.previousElementSibling?.matches("[data-course-banner='dynamic']") ||
            document.querySelector("[data-course-banner='dynamic']")
          ) {
            return true;
          }

          if (typeof window.criarBanner !== "function") {
            return false;
          }

          const wrapper = document.createElement("div");
          wrapper.className = "cursos";
          wrapper.setAttribute("data-course-banner", "dynamic");
          wrapper.innerHTML = window.criarBanner(courseBannerSlug);

          if (!wrapper.children.length) {
            return false;
          }

          applyTrackingParams(wrapper.querySelector(".botao"));
          document.querySelectorAll("[data-course-banner-slot]").forEach((slot) => slot.remove());
          insertionPoint.insertAdjacentElement("beforebegin", wrapper);

          return true;
        };

        const ensureBannerFactory = (callback) => {
          if (typeof window.criarBanner === "function") {
            callback();
            return;
          }

          const existingScript = document.querySelector("script[data-course-banner-loader]");
          if (existingScript) {
            existingScript.addEventListener("load", callback, {
              once: true
            });
            return;
          }

          const script = document.createElement("script");
          script.src = "/wp-content/themes/hashtag/desenvolvimento_hashtag/assets/js/components/componente-banners.js";
          script.async = true;
          script.dataset.courseBannerLoader = "true";
          script.addEventListener("load", callback, {
            once: true
          });
          document.body.appendChild(script);
        };

        ensureBannerFactory(() => {
          if (renderBanner()) {
            return;
          }

          let attempts = 0;
          const interval = window.setInterval(() => {
            attempts += 1;

            if (renderBanner() || attempts >= 20) {
              window.clearInterval(interval);
            }
          }, 250);

          window.addEventListener("load", renderBanner, {
            once: true
          });
        });
      })();
    </script>
  <?php endif; ?>
  <?php if (!$is_web_story) : ?>
    <?php the_field('footer', 'option'); ?>
  <?php endif; ?>
</body>

</html>
