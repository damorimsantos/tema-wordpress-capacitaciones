<?php
/**
 * Substituicao do WP Rocket (codigo do tema) — Capacitaciones.
 * ---------------------------------------------------------------------------
 * Porte do inc/perf/wp-rocket-replacement.php do hashtag. Na Cap o WP Rocket e
 * a versao 3.21 (atual), mas a config de prod so liga **minify CSS + minify JS
 * + cache de pagina** (defer_all_js/delay_js/async_css/lazyload/RUCSS = OFF —
 * medido 2026-06-25). Logo, ao remover o Rocket:
 *   - Cache de pagina   -> Varnish (Cloudways) + Cloudflare (edge). JA COBRE.
 *   - Brotli/gzip       -> Cloudflare entrega `br`. JA COBRE.
 *   - Minify CSS/JS     -> NAO reimplementado: marginal sob Brotli (economia de
 *     poucos % vs o `br` que o CF ja faz). Opcao futura = minify no build, nao
 *     em runtime.
 *   - DEFER de JS       -> o Rocket da Cap NEM fazia (defer_all_js=0). Este
 *     modulo ADICIONA (Script Loading Strategy API) = GANHO liquido vs o Rocket.
 *
 * DIFERENCA vs o hashtag: a Cap ainda NAO tem a stack de perf-pages
 * (hashtag_is_perf_page e cia. nao existem aqui). Os function_exists() abaixo
 * entao retornam false e `hashtag_is_generic_perf_context()` trata TODAS as
 * paginas de frontend (home/landings/blog/genericas) — o modulo vira o
 * otimizador SITE-WIDE da Cap. Quando (e se) a Cap ganhar uma stack de
 * perf-page propria, basta definir os gates que este modulo se ajusta sozinho.
 *
 * Camadas que permanecem fora do tema (nao mexer aqui): Varnish + Cloudflare.
 *
 * @package hashtag
 */

if (!defined('ABSPATH')) {
    exit;
}

/* =========================================================================
 * 1. GATE — pagina de frontend tratavel (na Cap: praticamente todas)
 * ========================================================================= */

if (!function_exists('hashtag_is_generic_perf_context')) {
    /**
     * True quando a request e uma pagina de frontend a ser otimizada. Na Cap,
     * como nao ha stack de perf-page, isso e ~todo o frontend. Os
     * function_exists() protegem a janela de deploy SFTP nao-atomico E ja deixam
     * o modulo pronto pra quando a Cap tiver gates de perf-page proprios.
     */
    function hashtag_is_generic_perf_context(): bool
    {
        if (is_admin() || wp_doing_ajax() || wp_doing_cron()) {
            return false;
        }
        if (defined('REST_REQUEST') && REST_REQUEST) {
            return false;
        }
        if (is_feed() || is_trackback() || is_robots() || is_404()) {
            return false;
        }

        // Se um dia existir stack de perf-page propria, exclui-la daqui.
        if (function_exists('hashtag_is_perf_page') && hashtag_is_perf_page()) {
            return false;
        }
        if (function_exists('hashtag_is_post_perf') && hashtag_is_post_perf()) {
            return false;
        }

        return true;
    }
}

/* =========================================================================
 * 2. CLEANUP SITE-WIDE (frontend) — sempre seguro, o Rocket fazia global
 * ========================================================================= */

/**
 * jquery-migrate: shim de compat pra jQuery pre-1.9. Tira o migrate como
 * dependencia do 'jquery' no FRONTEND (admin mantem). Seguro: nenhum JS do tema
 * usa jQuery.
 */
add_action('wp_default_scripts', function ($scripts) {
    if (is_admin()) {
        return;
    }
    if (!empty($scripts->registered['jquery'])) {
        $scripts->registered['jquery']->deps = array_diff(
            $scripts->registered['jquery']->deps,
            ['jquery-migrate']
        );
    }
});

/**
 * Heartbeat: 60s reduz o polling pela metade+ sem matar autosave do editor.
 */
add_filter('heartbeat_settings', function ($settings) {
    $settings['interval'] = 60;
    return $settings;
});

/**
 * Emoji do WordPress: script + CSS de deteccao em toda pagina. Browsers
 * modernos renderizam emoji nativamente — bloat. Remove frontend + admin.
 */
add_action('init', function () {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    add_filter('emoji_svg_url', '__return_false');
    add_filter('tiny_mce_plugins', function ($plugins) {
        return is_array($plugins) ? array_diff($plugins, ['wpemoji']) : $plugins;
    });
});

/**
 * wp-embed.js: client do oEmbed do proprio WordPress. O site nao incorpora
 * outros posts WP — bloat. Tira no frontend.
 */
add_action('wp_footer', function () {
    wp_dequeue_script('wp-embed');
}, 1);

/* =========================================================================
 * 3. RESOURCE HINTS — dns-prefetch dos dominios de tracking
 * ========================================================================= */

add_filter('wp_resource_hints', function ($hints, $relation_type) {
    if ($relation_type !== 'dns-prefetch' || !hashtag_is_generic_perf_context()) {
        return $hints;
    }

    // Dominios reais que a Cap chama (auditados na CSP: GTM/GA/Ads + AC + Panda + YouTube + fontes).
    $domains = [
        'https://www.googletagmanager.com',
        'https://www.google-analytics.com',
        'https://googleads.g.doubleclick.net',
        'https://fonts.gstatic.com',
    ];

    foreach ($domains as $domain) {
        if (!in_array($domain, $hints, true)) {
            $hints[] = $domain;
        }
    }

    return $hints;
}, 10, 2);

/* =========================================================================
 * 4. DEQUEUE DE ASSETS INUTEIS
 * -------------------------------------------------------------------------
 * Na Cap nao ha Elementor (sem elementor-gf-roboto) nem Enlighter — esses
 * dequeues sao no-op aqui, mantidos por defesa/paridade. O ganho real na Cap e
 * block-library quando a pagina nao usa blocos Gutenberg.
 * ========================================================================= */

add_action('wp_enqueue_scripts', function () {
    if (!hashtag_is_generic_perf_context()) {
        return;
    }

    $styles  = ['elementor-gf-roboto', 'elementor-gf-robotoslab'];
    $scripts = [];

    // Gutenberg block CSS — so quando a pagina nao usa blocos.
    if (!has_blocks(get_post())) {
        array_push(
            $styles,
            'wp-block-library',
            'wp-block-library-theme',
            'global-styles',
            'classic-theme-styles'
        );
    }

    foreach ($styles as $handle) {
        wp_dequeue_style($handle);
        wp_deregister_style($handle);
    }
    foreach ($scripts as $handle) {
        wp_dequeue_script($handle);
        wp_deregister_script($handle);
    }
}, 100);

/**
 * Rede de seguranca: tira o <link> do Google Fonts Roboto por href, caso algum
 * plugin o enfileire tarde (escapando do dequeue por handle).
 */
add_filter('style_loader_tag', function ($html, $handle, $href, $media) {
    if (!hashtag_is_generic_perf_context()) {
        return $html;
    }
    if ($handle === 'elementor-gf-roboto' || $handle === 'elementor-gf-robotoslab') {
        return '';
    }
    if (strpos((string) $href, 'fonts.googleapis.com/css?family=Roboto') !== false) {
        return '';
    }
    return $html;
}, 20, 4);

/* =========================================================================
 * 5. DEFER DE JS (Script Loading Strategy API, WP 6.3+)
 * -------------------------------------------------------------------------
 * Usa a API nativa (nunca rebaixa ordem de dependencia; se um dependente nao
 * puder ser deferido, o core mantem blocking). So scripts no <head> (group!=1)
 * — deferir script de footer nao melhora FCP e infla TBT. Exclui jQuery (e
 * pares): conteudo/forms inline podem usar $ na hora. Defere o que o Rocket NEM
 * deferia (defer_all_js=0 na Cap) = ganho.
 * ========================================================================= */

add_action('wp_enqueue_scripts', function () {
    if (!hashtag_is_generic_perf_context()) {
        return;
    }

    $scripts = wp_scripts();

    $exclude = [
        'jquery',
        'jquery-core',
        'jquery-migrate',
    ];

    foreach (array_keys($scripts->registered) as $handle) {
        if (in_array($handle, $exclude, true)) {
            continue;
        }
        if ((int) $scripts->get_data($handle, 'group') === 1) {
            continue; // footer: ja nao bloqueia render
        }
        wp_script_add_data($handle, 'strategy', 'defer');
    }
}, 99);
