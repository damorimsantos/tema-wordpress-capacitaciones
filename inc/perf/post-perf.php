<?php
/**
 * Perf do post de blog (single 'post') — Capacitaciones.
 * ---------------------------------------------------------------------------
 * Porte do bloco de perf do post do functions.php do hashtag (la sao funcoes
 * soltas; aqui viram um modulo carregado pelo loader hashtag-theme-modules.php,
 * para nao tocar no functions.php de prod — ver "Carregamento De Modulos Do
 * Tema" no CLAUDE.md). Cartao C5.4 do plano de paridade.
 *
 * O que faz (gate `is_singular('post')`):
 *   1. DEFER do embed ActiveCampaign — alavanca de INP. 48/49 posts publish da
 *      Cap trazem `<script src=".../f/embed.php?id=...">` DIRETO no post_content
 *      (form de lead inline). O script de terceiro injeta o form via
 *      createElement/appendChild (NAO document.write -> seguro adiar). Viramos
 *      placeholder inerte e carregamos na 1a interacao do usuario.
 *   2. STRIP do <link> Google Fonts css2 (Lato/Montserrat/Roboto) render-blocking
 *      que vem do bloco reutilizavel `rodape_excel` (wp_block id 89), expandido
 *      no the_content. Montserrat ja e self-hosted pelo tema; esse css2 e
 *      redundante e o display=swap dele reflui o artigo (CLS). O filtro roda
 *      @99 (depois do `do_blocks`@9 expandir o bloco), entao pega o link.
 *   3. DEQUEUE de Roboto/Roboto Slab do Elementor — NO-OP na Cap (sem Elementor),
 *      mantido por paridade/defesa (se algum dia um plugin enfileirar Roboto).
 *      A fonte render-blocking REAL do post da Cap e o css2 do item 2, nao um
 *      handle enfileirado.
 *   4. dns-prefetch de GTM/GA/Ads + activehosted — o post SAI do contexto generico
 *      do wp-rocket-replacement assim que `hashtag_is_post_perf()` passa a existir
 *      (ver gate la, que exclui o post); este filtro repoe o dns-prefetch (e
 *      adiciona o host do AC, especifico do post).
 *
 * jQuery: o cartao pede "jQuery condicional", mas o tema da Cap NAO enfileira
 * jQuery no single (app_scripts so registra `script-post-blog`) e nenhum dos 49
 * posts usa `jquery`/`$(` no conteudo (verificado no DB) — o post ja serve com
 * ZERO jQuery (confirmado no HTML renderizado). Logo nao ha o que tornar
 * condicional: o objetivo do cartao ja esta satisfeito. Nada a remover aqui
 * (dequeue defensivo de jQuery so introduziria risco de quebrar dep oculta sem
 * ganho). Se um dia jQuery passar a ser enfileirado no post, revisitar.
 *
 * @package hashtag
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!function_exists('hashtag_is_post_perf')) {
    /**
     * Gate do pipeline de perf do post. Definir esta funcao tambem faz o
     * wp-rocket-replacement `hashtag_is_generic_perf_context()` EXCLUIR o post do
     * tratamento generico (por design — ver a checagem `function_exists` la).
     */
    function hashtag_is_post_perf()
    {
        return !is_admin() && is_singular('post');
    }
}

/**
 * Dequeue de Roboto/Roboto Slab (fontes do Elementor, render-blocking). No-op na
 * Cap (sem Elementor); mantido por paridade com o hashtag.
 */
function hashtag_dequeue_post_bloat()
{
    if (!hashtag_is_post_perf()) {
        return;
    }

    foreach (['elementor-gf-roboto', 'elementor-gf-robotoslab'] as $handle) {
        wp_dequeue_style($handle);
        wp_deregister_style($handle);
    }
}

add_action('wp_enqueue_scripts', 'hashtag_dequeue_post_bloat', 999);

/**
 * Rede de seguranca: tira o <link> do Roboto por handle/href, caso escape do
 * dequeue por handle. 'css?family=Roboto' casa Roboto e Roboto+Slab, mas NAO o
 * 'css2?family=Lato...Montserrat' (esse e tratado pelo strip do conteudo).
 */
function hashtag_filter_post_style_tag($html, $handle, $href, $media)
{
    if (!hashtag_is_post_perf()) {
        return $html;
    }

    if ($handle === 'elementor-gf-roboto' || $handle === 'elementor-gf-robotoslab') {
        return '';
    }

    if (strpos((string) $href, 'fonts.googleapis.com/css?family=Roboto') !== false) {
        return '';
    }

    return $html;
}

add_filter('style_loader_tag', 'hashtag_filter_post_style_tag', 20, 4);

/**
 * Remove o <link> render-blocking pro Google Fonts css2 (Lato/Montserrat/Roboto)
 * que o bloco reutilizavel `rodape_excel` (wp_block 89) cola no fim do post.
 * Montserrat ja e self-hosted pelo tema; o display=swap desse link reflui o
 * artigo (CLS). Roda no the_content @99 (depois do do_blocks@9 expandir o bloco).
 */
function hashtag_strip_post_content_google_fonts($content)
{
    if (is_admin() || !hashtag_is_post_perf() || strpos($content, 'fonts.googleapis.com/css2') === false) {
        return $content;
    }

    return preg_replace(
        '#<link\b[^>]*fonts\.googleapis\.com/css2\?family=Lato[^>]*>#i',
        '',
        $content
    );
}

add_filter('the_content', 'hashtag_strip_post_content_google_fonts', 99);

/**
 * Lazy-load do embed do ActiveCampaign (form de lead inline em ~48/49 posts).
 * O <script src=.../f/embed.php> e um terceiro pesado que injeta o form via
 * createElement/appendChild (NAO usa document.write -> seguro adiar). Converte
 * pra placeholder inerte; o loader (wp_footer) carrega na 1a interacao.
 */
function hashtag_defer_activecampaign_embed($content)
{
    if (is_admin() || !hashtag_is_post_perf() || strpos($content, 'activehosted.com/f/embed.php') === false) {
        return $content;
    }

    return preg_replace_callback(
        '#<script\b[^>]*\bsrc=(["\'])(https?://[^"\']*activehosted\.com/f/embed\.php[^"\']*)\1[^>]*></script>#i',
        static function ($m) {
            return '<script type="text/plain" data-ac-embed="' . esc_url($m[2]) . '"></script>';
        },
        $content
    );
}

add_filter('the_content', 'hashtag_defer_activecampaign_embed', 99);

/**
 * Hidrata os placeholders do AC na 1a interacao do usuario (ou fallback ocioso),
 * garantindo o form bem antes de o leitor chegar nele.
 */
function hashtag_print_activecampaign_loader()
{
    if (!hashtag_is_post_perf()) {
        return;
    }
    ?>
    <script>
        (function () {
            var phs = document.querySelectorAll('script[type="text/plain"][data-ac-embed]');
            if (!phs.length) return;
            var done = false;
            var events = ['scroll', 'pointerdown', 'keydown', 'touchstart', 'mousemove'];
            function load() {
                if (done) return;
                done = true;
                events.forEach(function (ev) { window.removeEventListener(ev, load, { passive: true }); });
                phs.forEach(function (ph) {
                    var s = document.createElement('script');
                    s.src = ph.getAttribute('data-ac-embed');
                    s.charset = 'utf-8';
                    ph.parentNode.insertBefore(s, ph.nextSibling);
                });
            }
            events.forEach(function (ev) { window.addEventListener(ev, load, { passive: true }); });
            // Fallback: carrega sozinho se o usuario nao interagir, garantindo o form mesmo sem scroll.
            if ('requestIdleCallback' in window) {
                requestIdleCallback(function () { setTimeout(load, 3500); });
            } else {
                setTimeout(load, 5000);
            }
        })();
    </script>
    <?php
}

add_action('wp_footer', 'hashtag_print_activecampaign_loader', 99);

/**
 * Repoe o dns-prefetch no post. Ao existir `hashtag_is_post_perf()`, o
 * wp-rocket-replacement deixa de tratar o post (seu gate o exclui), entao o
 * dns-prefetch generico nao age mais aqui. Repomos GTM/GA/Ads + o host do
 * ActiveCampaign (especifico do post; o generico nao tinha).
 */
function hashtag_post_perf_resource_hints($hints, $relation_type)
{
    if ($relation_type !== 'dns-prefetch' || !hashtag_is_post_perf()) {
        return $hints;
    }

    $domains = [
        'https://www.googletagmanager.com',
        'https://www.google-analytics.com',
        'https://googleads.g.doubleclick.net',
        'https://hashtagtreinamentos.activehosted.com',
    ];

    foreach ($domains as $domain) {
        if (!in_array($domain, $hints, true)) {
            $hints[] = $domain;
        }
    }

    return $hints;
}

add_filter('wp_resource_hints', 'hashtag_post_perf_resource_hints', 10, 2);
