<?php
/**
 * Controle de sitemap (Capacitaciones) — Rank Math serve o indice em /sitemap.xml.
 *
 * Porte do hashtag. A Cap usava o padrao do RM (/sitemap_index.xml); este modulo
 * forca o indice p/ /sitemap.xml (paridade com hashtag + tooling AEO uniforme) e
 * 301 do /sitemap_index.xml (que com o slug novo passa a 404) -> /sitemap.xml.
 *
 * O que faz:
 *  - Desliga o sitemap nativo do WP core (so o do Rank Math).
 *  - Forca o INDICE do RM a responder em /sitemap.xml via rank_math/sitemap/index/slug.
 *  - Re-inclui a homepage (gotcha do trailing slash; ver comentario).
 *  - 301 dos sitemaps alternativos (/sitemap_index.xml + /wp-sitemap.xml, +.gz) -> /sitemap.xml.
 *
 * So redireciona os paths exatos abaixo; nao normaliza URL generica (nao afeta o REST do RM).
 */

if (!defined('ABSPATH')) {
    exit;
}

// 1) Sitemap nativo do WP core desligado (so o do Rank Math).
add_filter('wp_sitemaps_enabled', '__return_false');

// 2) Servir o indice do Rank Math em /sitemap.xml.
add_filter('rank_math/sitemap/index/slug', static function () {
    return 'sitemap';
});

// 3) Re-incluir a homepage no sitemap (o RM dropa a front-page estatica por mismatch
//    de trailing slash: canonical SEM barra vs get_permalink() COM barra). Normaliza
//    o loc da front-page p/ SEM barra (== canonical real que o site emite).
add_filter('rank_math/sitemap/xml_post_url', static function ($url, $post) {
    $front_id = (int) get_option('page_on_front');
    if ($front_id && isset($post->ID) && (int) $post->ID === $front_id) {
        return untrailingslashit($url);
    }
    return $url;
}, 10, 2);

// 4) 301 dos sitemaps alternativos -> /sitemap.xml.
function hashtag_canonicalizar_sitemaps()
{
    if (is_admin() || wp_doing_ajax()) {
        return;
    }

    $uri  = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
    $path = parse_url($uri, PHP_URL_PATH);

    $indesejados = array(
        '/sitemap_index.xml',
        '/sitemap_index.xml.gz',
        '/wp-sitemap.xml',
        '/wp-sitemap.xml.gz',
    );

    if (in_array($path, $indesejados, true)) {
        wp_safe_redirect(home_url('/sitemap.xml'), 301);
        exit;
    }
}
add_action('init', 'hashtag_canonicalizar_sitemaps', 1);
