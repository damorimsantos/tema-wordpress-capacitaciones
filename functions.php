<?php

/*********************************************
 * ASSETS
 **********************************************/

function app_scripts()
{

    // registro de scripts gerais ----------------------------------------------------------
    wp_register_script('auxiliares', get_template_directory_uri() . '/desenvolvimento_hashtag/assets/js/auxiliares.js', [], null, true);
    wp_register_script('scroll-on-view', get_template_directory_uri() . '/desenvolvimento_hashtag/assets/js/scroll-on-view.js', [], null, true);
    wp_register_script('acordeao', get_template_directory_uri() . '/desenvolvimento_hashtag/assets/js/acordeao.js', [], null, true);
    wp_register_script('infinite-scroller', get_template_directory_uri() . '/desenvolvimento_hashtag/assets/js/infinite-scroller.js', [], null, true);
    wp_register_script('carrossel', get_template_directory_uri() . '/desenvolvimento_hashtag/assets/js/carrossel.js', [], null, true);
    wp_register_script('trocar-imagem-video', get_template_directory_uri() . '/desenvolvimento_hashtag/assets/js/trocar-imagem-video.js', [], null, true);
    wp_register_script('form-inscricao', get_template_directory_uri() . '/desenvolvimento_hashtag/assets/js/form-inscricao.js', [], null, true);
    wp_register_script('ajuste-ano', get_template_directory_uri() . '/desenvolvimento_hashtag/assets/js/ajuste-ano.js', [], null, true);
    wp_register_script('barra-progresso', get_template_directory_uri() . '/desenvolvimento_hashtag/assets/js/barra-progresso.js', [], null, true);
    wp_register_script('precheckout', get_template_directory_uri() . '/desenvolvimento_hashtag/assets/js/precheckout.js', [], null, true);
    wp_register_script(
        'faixa-evento',
        get_template_directory_uri() . '/desenvolvimento_hashtag/assets/js/faixa-evento.js',
        [],
        filemtime(get_template_directory() . '/desenvolvimento_hashtag/assets/js/faixa-evento.js'),
        true
    );

    $is_blog_context = is_home() || is_category() || is_archive() || is_search() || is_page_template('index.php') || is_single();

    if (!$is_blog_context && !is_page(['pg-inscripcion-ia', 'blablbalbla'])) {
        wp_enqueue_script('substituir-links-semana', get_template_directory_uri() . '/desenvolvimento_hashtag/assets/js/substituir-links-semana.js', [], null, true);
        wp_enqueue_script('conversion', get_template_directory_uri() . '/desenvolvimento_hashtag/assets/js/conversion.js', ['substituir-links-semana'], null, true);
    }

    // wp_add_inline_script(
    //     'conversion',
    //     'window.paramFonte = new URLSearchParams(window.location.search).get("fonte") || null;',
    //     'before'
    // );

    wp_enqueue_script('ajuste-ano');
    if ($is_blog_context) {
        wp_enqueue_script('faixa-evento');
    }

    if (is_home() || is_category() || is_archive() || is_search() || is_page_template('index.php')) {
        wp_enqueue_style(
            'hashtag-blog',
            get_template_directory_uri() . '/desenvolvimento_hashtag/assets/sass/css/blog/style.css',
            [],
            null,
            'all'
        );
    }

    // scripts do tema enfileirados de acordo com o slug da página -------------------------

     // páginas de inscrição
        if (is_page(['teste123456', 'curso-excel-gratis'])) {
        wp_enqueue_script('auxiliares');
        wp_enqueue_script('scroll-on-view');
        wp_enqueue_script('infinite-scroller');
        wp_enqueue_script('trocar-imagem-video');
        }

         // posts
        if (is_single()) {
            wp_enqueue_script('script-post-blog', get_template_directory_uri() . '/desenvolvimento_hashtag/assets/js/post-blog.js', [], null, true);
        }

    //home
    if(is_front_page()) {
        wp_enqueue_script('auxiliares');
        wp_enqueue_script('scroll-on-view');
        wp_enqueue_script('infinite-scroller');
        wp_enqueue_script('trocar-imagem-video');
    }

    // local
    if(is_page("curso-excel-gratis")) {
        // wp_enqueue_script('substituir-links-semana');
    }

    // local
    if(is_page("blablbalbla")) {
        // wp_enqueue_script('substituir-links-semana');
    }
    
    // wp_enqueue_script('substituir-links-semana', $url, [], $ver, true);
    // wp_enqueue_script('conversion', $url, ['substituir-links-semana'], $ver, true); // tem que ser depois do "substituir-links-semana"
    
    // ------------------------------------------------------------------------------------- 
    
}

add_action("wp_enqueue_scripts", "app_scripts");

// add_action('wp_enqueue_scripts', 'slick_register_styles');
add_action('wp_head', function () {
  echo '<script>window.paramFonte = new URLSearchParams(window.location.search).get("fonte") || null;</script>';
}, 1);

function slick_register_styles()
{
    wp_enqueue_style('slick-css', untrailingslashit(get_template_directory_uri()) . '/assets/css/slick.css', [], false, 'all');
    wp_enqueue_style('slick-theme-css', untrailingslashit(get_template_directory_uri()) . '/assets/css/slick-theme.css', ['slick-css'], false, 'all');
    // wp_enqueue_script('carousel-js', untrailingslashit(get_template_directory_uri()) . '/assets/src/carousel/index.js', ['jquery', 'slick-js'], filemtime(untrailingslashit(get_template_directory()) . '/assets/src/carousel/index.js'), true);
}


require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';

register_nav_menus(array(
    'menu' => __('Menu Principal', 'hashtag'),
));

function custom_logo_setup()
{
    $defaults = array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array('site-title', 'site-description'),
    );
    add_theme_support('custom-logo', $defaults);
}
add_action('after_setup_theme', 'custom_logo_setup');

add_theme_support('post-thumbnails');

// 1. customize ACF path
add_filter('acf/settings/path', 'my_acf_settings_path');

function my_acf_settings_path($path)
{

    // update path
    $path = get_stylesheet_directory() . '/inc/acf/';

    // return
    return $path;
}


// 2. customize ACF dir
add_filter('acf/settings/dir', 'my_acf_settings_dir');

function my_acf_settings_dir($dir)
{

    // update path
    $dir = get_stylesheet_directory_uri() . '/inc/acf/';

    // return
    return $dir;
}


// 3. Hide ACF field group menu item
//add_filter('acf/settings/show_admin', '__return_false');


// 4. Opcoes do Site — substituto NATIVO do ACF (inc/acf removido). Define get_field/the_field.
$hashtag_site_options = get_stylesheet_directory() . '/inc/options/site-options.php';
if (file_exists($hashtag_site_options)) {
    require_once $hashtag_site_options;
}


add_filter('acf/settings/save_json', 'my_acf_json_save_point');

function my_acf_json_save_point($path)
{

    // update path
    $path = get_stylesheet_directory() . '/json';


    // return
    return $path;
}

add_filter('wpcf7_form_elements', function ($content) {
    $content = preg_replace('/<(span).*?class="\s*(?:.*\s)?wpcf7-form-control-wrap(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', '\2', $content);

    return $content;
});

add_action('wp_footer', 'redirect_cf7');

function redirect_cf7()
{
?>
<script type="text/javascript">
document.addEventListener('wpcf7mailsent', function(event) {
  location = '<?php echo get_home_url(); ?>/obrigado/';
}, false);
</script>
<?php
}


if (function_exists('register_sidebar'))
    register_sidebar(
        array(
            'name' => 'Widget Blog',
            'before_widget' => '<div class = "widget_blog">',
            'after_widget' => '</div>',
            'before_title' => '<h5>',
            'after_title' => '</h5>',
        )
    );

// Painel "Opcoes do Site" nativo (substitui a options page do ACF; mesmo slug).
$hashtag_site_options_admin = get_stylesheet_directory() . '/inc/options/site-options-admin.php';
if (file_exists($hashtag_site_options_admin)) {
    require_once $hashtag_site_options_admin;
}

add_filter('sanitize_file_name', 'sa_sanitize_spanish_chars', 10);

function sa_sanitize_spanish_chars($filename)
{
    return remove_accents($filename);
}

/*********************************************
 * INCLUDES
 **********************************************/
//PAINEL
require get_template_directory() . '/inc/painel/wp-admin-theme-cd.php';
//PORTAL (pagina /acceso-portal — consulta de migracao)
require get_template_directory() . '/inc/portal/consulta-migracao.php';
//CPT
include('inc/cpt/depoimentos.php');
//include('inc/cpt/cursos.php');
include('inc/cpt/inscricoes.php');

//AJAX
include('ajax/turmas.php');
include('ajax/hash_oferta_ia.php');

add_theme_support('rank-math-breadcrumbs');
?>
