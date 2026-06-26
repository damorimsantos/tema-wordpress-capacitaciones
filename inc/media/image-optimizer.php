<?php

/**
 * Otimizador de imagens nativo do tema (substitui o Imagify).
 *
 * O QUE FAZ
 *  - Na geracao de metadata de um upload (JPEG/PNG/WebP), cria irmaos AVIF e WebP
 *    para a imagem cheia e para CADA sub-tamanho registrado (responsivo).
 *  - Na entrega, embrulha o <img> do conteudo do blog em <picture> com fontes
 *    AVIF -> WebP -> original (fallback triplo). Browser escolhe o mais leve que suporta.
 *  - WP-CLI `wp hashtag-image regenerate` faz backfill do acervo existente.
 *  - Limpa os irmaos quando o anexo e deletado.
 *
 * POR QUE ASSIM
 *  - 100% local (sem API/cloud/cota/custo). Usa o WP_Image_Editor nativo (Imagick ou GD),
 *    detectando em runtime quais formatos o servidor consegue gerar (degrada com graca:
 *    se nao houver AVIF, entrega so WebP; se nenhum, nao mexe).
 *  - Convencao de nome por APPEND (`foto.jpg.avif`, `foto.jpg.webp`): deterministica,
 *    sem colisao, e a entrega mapeia url->irmao so concatenando a extensao.
 *
 * Constantes (definir no wp-config para sobrescrever):
 *  - HASHTAG_IMG_OPTIMIZER       (bool)  liga/desliga tudo. default true
 *  - HASHTAG_IMG_AVIF_QUALITY    (int)   default 55  (q AVIF; menor = mais leve)
 *  - HASHTAG_IMG_WEBP_QUALITY    (int)   default 80
 *
 * Filtros:
 *  - hashtag_img_target_formats        array de formatos-alvo (apos deteccao de caps)
 *  - hashtag_img_source_mimes          mimes de origem aceitos
 *  - hashtag_img_wrap_picture_enabled  bool por request (gate da entrega <picture>)
 */

if (! defined('ABSPATH')) {
    exit;
}

if (! defined('HASHTAG_IMG_OPTIMIZER')) {
    define('HASHTAG_IMG_OPTIMIZER', true);
}
if (! defined('HASHTAG_IMG_AVIF')) {
    // AVIF do otimizador runtime DESLIGADO de proposito.
    // O encoder AVIF disponivel em prod (Imagick; o GD-AVIF do Cloudways grava 0 byte)
    // DESCARTA o canal alpha: PNG/WebP transparente (logos, selos, bandeiras de pagamento)
    // vira uma caixa solida/lixo no <picture>. O WebP irmao PRESERVA o alpha e ja cobre a
    // economia. So religar (=true) com um encoder que mantenha alpha (ex.: avifenc estatico)
    // E regerar os irmaos existentes. Ver CLAUDE.md "Otimizador De Imagens".
    define('HASHTAG_IMG_AVIF', false);
}
if (! defined('HASHTAG_IMG_AVIF_QUALITY')) {
    define('HASHTAG_IMG_AVIF_QUALITY', 50); // JPEG/foto: q50 ~= 65% de economia, visualmente sem perda
}
if (! defined('HASHTAG_IMG_AVIF_QUALITY_PNG')) {
    define('HASHTAG_IMG_AVIF_QUALITY_PNG', 62); // PNG (screenshot/UI/texto): q maior preserva nitidez
}
if (! defined('HASHTAG_IMG_WEBP_QUALITY')) {
    define('HASHTAG_IMG_WEBP_QUALITY', 80);
}
if (! defined('HASHTAG_IMG_MAX_PIXELS')) {
    define('HASHTAG_IMG_MAX_PIXELS', 25000000); // guarda de memoria: nao encodar acima disso
}

// ---------------------------------------------------------------------------
// Capacidade / configuracao
// ---------------------------------------------------------------------------

/** Mimes de origem que processamos. */
function hashtag_img_source_mimes(): array
{
    return apply_filters('hashtag_img_source_mimes', ['image/jpeg', 'image/png', 'image/webp']);
}

/**
 * Formatos-alvo realmente suportados pelo editor de imagem deste servidor.
 * Cacheado por request. Retorna lista de ['ext','mime','quality'].
 */
function hashtag_img_target_formats(): array
{
    static $base = null;
    if ($base === null) {
        $defs = [];
        // AVIF so entra se explicitamente religado (encoder de prod perde alpha — ver HASHTAG_IMG_AVIF).
        if (HASHTAG_IMG_AVIF) {
            $defs[] = ['ext' => 'avif', 'mime' => 'image/avif', 'quality' => (int) HASHTAG_IMG_AVIF_QUALITY];
        }
        $defs[] = ['ext' => 'webp', 'mime' => 'image/webp', 'quality' => (int) HASHTAG_IMG_WEBP_QUALITY];

        $base = [];
        foreach ($defs as $def) {
            // Disponivel se o editor do WP suportar (Imagick OU GD via _wp_image_editor_choose)
            // OU se a funcao GD direta existir (nosso encoder prefere GD e a usa por conta propria,
            // util se algum filtro restringir o editor a um Imagick sem AVIF).
            $ok = wp_image_editor_supports(['mime_type' => $def['mime']]);
            if (! $ok) {
                $ok = ($def['mime'] === 'image/avif' && function_exists('imageavif'))
                   || ($def['mime'] === 'image/webp' && function_exists('imagewebp'));
            }
            if ($ok) {
                $base[] = $def;
            }
        }
    }

    // Filtro aplicado a CADA chamada (cache so a deteccao): permite restringir os
    // formatos por rodada (ex.: --formats=webp), mesmo que enabled() ja tenha chamado antes.
    return apply_filters('hashtag_img_target_formats', $base);
}

/** Liga/desliga global (constante + ha pelo menos 1 formato moderno disponivel). */
function hashtag_img_enabled(): bool
{
    if (! HASHTAG_IMG_OPTIMIZER) {
        return false;
    }
    return ! empty(hashtag_img_target_formats());
}

/** Cache do diretorio de uploads. */
function hashtag_img_uploads(): array
{
    static $u = null;
    if ($u === null) {
        $u = wp_get_upload_dir();
    }
    return $u;
}

// ---------------------------------------------------------------------------
// Geracao dos irmaos modernos
// ---------------------------------------------------------------------------

/** Qualidade alvo por formato/origem (filtravel). PNG (texto/UI) usa AVIF mais alto. */
function hashtag_img_quality(string $mime, string $src_mime): int
{
    if ($mime === 'image/avif') {
        $q = ($src_mime === 'image/png') ? (int) HASHTAG_IMG_AVIF_QUALITY_PNG : (int) HASHTAG_IMG_AVIF_QUALITY;
    } else {
        $q = (int) HASHTAG_IMG_WEBP_QUALITY;
    }
    return (int) apply_filters('hashtag_img_quality', $q, $mime, $src_mime);
}

/** Aplica a orientacao EXIF num recurso GD (so afeta originais nao-orientados). */
function hashtag_img_gd_apply_orientation($img, int $o)
{
    switch ($o) {
        case 2:
            imageflip($img, IMG_FLIP_HORIZONTAL);
            break;
        case 3:
            $r = imagerotate($img, 180, 0);
            imagedestroy($img);
            $img = $r;
            break;
        case 4:
            imageflip($img, IMG_FLIP_VERTICAL);
            break;
        case 5:
            imageflip($img, IMG_FLIP_HORIZONTAL);
            $r = imagerotate($img, -90, 0);
            imagedestroy($img);
            $img = $r;
            break;
        case 6:
            $r = imagerotate($img, -90, 0);
            imagedestroy($img);
            $img = $r;
            break;
        case 7:
            imageflip($img, IMG_FLIP_HORIZONTAL);
            $r = imagerotate($img, 90, 0);
            imagedestroy($img);
            $img = $r;
            break;
        case 8:
            $r = imagerotate($img, 90, 0);
            imagedestroy($img);
            $img = $r;
            break;
    }
    return $img;
}

/**
 * Alguns builds do GD anunciam AVIF (gd_info "AVIF Support"=true, imageavif existe)
 * mas o encoder real falha ("No codec available") e grava 0 byte — caso do Cloudways.
 * Probe 1x por request: encoda um tile minusculo e confere bytes > 0.
 */
function hashtag_img_gd_avif_works(): bool
{
    static $ok = null;
    if ($ok !== null) {
        return $ok;
    }
    if (! function_exists('imageavif')) {
        return $ok = false;
    }
    $im = @imagecreatetruecolor(4, 4);
    if (! $im) {
        return $ok = false;
    }
    $ok  = false;
    $tmp = @tempnam(sys_get_temp_dir(), 'htavif');
    if ($tmp) {
        $r  = @imageavif($im, $tmp, 50, 8);
        $ok = ($r && @filesize($tmp) > 0);
        @unlink($tmp);
    }
    imagedestroy($im);
    return $ok;
}

/**
 * Encoda via GD direto (qualidade AVIF/WebP respeitada e ajustavel — o editor
 * Imagick ignora a qualidade do AVIF). Retorna true em sucesso. Preserva alpha
 * (PNG/WebP) e orientacao EXIF (JPEG). Retorna false p/ cair no fallback (Imagick).
 */
function hashtag_img_encode_gd(string $src, string $dest, string $mime, int $quality, string $src_mime): bool
{
    if ($mime === 'image/avif' && ! hashtag_img_gd_avif_works()) {
        return false; // GD avif ausente ou quebrado (0 byte) -> usa Imagick
    }
    if ($mime === 'image/webp' && ! function_exists('imagewebp')) {
        return false;
    }

    $img = false;
    try {
        if ($src_mime === 'image/jpeg') {
            $img = @imagecreatefromjpeg($src);
        } elseif ($src_mime === 'image/png') {
            $img = @imagecreatefrompng($src);
        } elseif ($src_mime === 'image/webp' && function_exists('imagecreatefromwebp')) {
            $img = @imagecreatefromwebp($src);
        }
    } catch (\Throwable $e) {
        $img = false;
    }
    if (! $img) {
        return false;
    }

    if ($src_mime === 'image/jpeg' && function_exists('exif_read_data')) {
        $exif = @exif_read_data($src);
        if (! empty($exif['Orientation']) && (int) $exif['Orientation'] > 1) {
            $img = hashtag_img_gd_apply_orientation($img, (int) $exif['Orientation']);
        }
    }

    if ($src_mime === 'image/png' || $src_mime === 'image/webp') {
        @imagepalettetotruecolor($img);
        imagealphablending($img, false);
        imagesavealpha($img, true);
    }

    $ok = false;
    try {
        if ($mime === 'image/avif') {
            $speed = (int) apply_filters('hashtag_img_avif_speed', 6);
            $ok = imageavif($img, $dest, $quality, $speed);
        } else {
            $ok = imagewebp($img, $dest, $quality);
        }
    } catch (\Throwable $e) {
        $ok = false;
    }
    imagedestroy($img);

    return $ok && file_exists($dest) && filesize($dest) > 0;
}

/** Encoda um formato: GD direto preferido, fallback no editor nativo do WP. */
function hashtag_img_encode(string $src, string $dest, string $mime, int $quality, string $src_mime): bool
{
    if (hashtag_img_encode_gd($src, $dest, $mime, $quality, $src_mime)) {
        return true;
    }

    $editor = wp_get_image_editor($src, ['mime_type' => $mime]);
    if (is_wp_error($editor)) {
        return false;
    }
    $editor->set_quality($quality);
    $saved = $editor->save($dest, $mime);
    if (is_wp_error($saved) || empty($saved['path']) || ! file_exists($saved['path'])) {
        return false;
    }
    if ($saved['path'] !== $dest) {
        @rename($saved['path'], $dest);
    }
    return file_exists($dest);
}

/**
 * Gera AVIF/WebP ao lado de um arquivo de imagem (cheia ou sub-tamanho).
 * Idempotente: pula quem ja existe e esta mais novo que o original.
 * Retorna [gerados, pulados].
 */
function hashtag_img_make_siblings(string $path): array
{
    if (! file_exists($path)) {
        return [0, 0];
    }

    $formats = hashtag_img_target_formats();
    if (! $formats) {
        return [0, 0];
    }

    $src_ext   = strtolower(pathinfo($path, PATHINFO_EXTENSION));
    $type      = wp_check_filetype($path);
    $src_mime  = (is_array($type) && ! empty($type['type'])) ? $type['type'] : '';
    $src_mtime = filemtime($path);
    $src_size  = filesize($path);

    // Guarda de memoria: imagens gigantes (raras; original nao-escalado) sao puladas.
    $dim = @getimagesize($path);
    if (is_array($dim) && ! empty($dim[0]) && ! empty($dim[1]) && ($dim[0] * $dim[1]) > HASHTAG_IMG_MAX_PIXELS) {
        return [0, 0];
    }

    $made    = 0;
    $skipped = 0;
    foreach ($formats as $fmt) {
        // Nao re-encodar pro mesmo formato (origem .webp nao precisa de irmao .webp).
        if ($src_ext === $fmt['ext']) {
            continue;
        }
        $dest = $path . '.' . $fmt['ext'];
        if (file_exists($dest) && filemtime($dest) >= $src_mtime) {
            $skipped++;
            continue;
        }

        $quality = hashtag_img_quality($fmt['mime'], $src_mime);
        if (! hashtag_img_encode($path, $dest, $fmt['mime'], $quality, $src_mime)) {
            continue;
        }

        // Sem ganho real (raro, ex.: icone minusculo): descarta o irmao.
        if (file_exists($dest) && filesize($dest) >= $src_size) {
            @unlink($dest);
            continue;
        }
        $made++;
    }

    return [$made, $skipped];
}

/** Apaga os irmaos modernos de um arquivo. */
function hashtag_img_delete_siblings(string $path): void
{
    foreach (['avif', 'webp'] as $ext) {
        $sib = $path . '.' . $ext;
        if (file_exists($sib)) {
            @unlink($sib);
        }
    }
}

/** Lista os caminhos fisicos (cheia + sub-tamanhos) de um anexo. */
function hashtag_img_attachment_paths(int $attachment_id, $metadata = null): array
{
    $file = get_attached_file($attachment_id);
    if (! $file) {
        return [];
    }

    $meta = is_array($metadata) ? $metadata : wp_get_attachment_metadata($attachment_id);
    $dir  = dirname($file);

    $paths = [$file];
    if (! empty($meta['sizes']) && is_array($meta['sizes'])) {
        foreach ($meta['sizes'] as $size) {
            if (! empty($size['file'])) {
                $paths[] = $dir . '/' . $size['file'];
            }
        }
    }

    return array_values(array_unique($paths));
}

/**
 * Hook principal: apos o WP gerar os sub-tamanhos, cria os irmaos modernos.
 */
function hashtag_img_on_generate_metadata($metadata, $attachment_id)
{
    if (! hashtag_img_enabled()) {
        return $metadata;
    }

    $mime = get_post_mime_type($attachment_id);
    if (! in_array($mime, hashtag_img_source_mimes(), true)) {
        return $metadata;
    }

    foreach (hashtag_img_attachment_paths($attachment_id, $metadata) as $path) {
        hashtag_img_make_siblings($path);
    }

    return $metadata;
}
add_filter('wp_generate_attachment_metadata', 'hashtag_img_on_generate_metadata', 20, 2);

/** Limpeza ao deletar o anexo. */
function hashtag_img_on_delete_attachment($attachment_id): void
{
    foreach (hashtag_img_attachment_paths((int) $attachment_id) as $path) {
        hashtag_img_delete_siblings($path);
    }
}
add_action('delete_attachment', 'hashtag_img_on_delete_attachment', 10, 1);

/**
 * Auto-heal do mime em uploads/.htaccess.
 *
 * Gotcha de prod (Cloudways): o irmao `foto.png.avif` rota pelo Apache, cujo
 * mime nao mapeia `.avif` -> serve com Content-Type da extensao interna (image/png).
 * (`.jpg.avif` e bare `.avif` o nginx serve certo.) Browsers ainda decodificam o
 * AVIF por sniffing, mas o tipo correto importa p/ CDN/proxies/corretude. Este
 * AddType (escopo uploads) corrige. E idempotente e se re-adiciona se algum
 * plugin regenerar o .htaccess. So append (nunca reescreve o resto). Checa ~1x/dia.
 */
function hashtag_img_ensure_htaccess(): void
{
    if (! hashtag_img_enabled() || ! is_admin()) {
        return;
    }
    if (get_transient('hashtag_img_htaccess_ok')) {
        return;
    }

    $u = hashtag_img_uploads();
    if (empty($u['basedir'])) {
        return;
    }

    $ht     = $u['basedir'] . '/.htaccess';
    $marker = '# BEGIN Hashtag Image Optimizer';
    $now    = is_readable($ht) ? (string) file_get_contents($ht) : '';

    if (strpos($now, $marker) !== false) {
        set_transient('hashtag_img_htaccess_ok', 1, DAY_IN_SECONDS);
        return;
    }

    $can_write = file_exists($ht) ? is_writable($ht) : is_writable(dirname($ht));
    if (! $can_write) {
        return; // tenta de novo no proximo ciclo; sem transient
    }

    $block = "\n# BEGIN Hashtag Image Optimizer (AVIF/WebP mime)\n"
        . "<IfModule mod_mime.c>\n"
        . "AddType image/avif .avif\n"
        . "AddType image/webp .webp\n"
        . "</IfModule>\n"
        . "# END Hashtag Image Optimizer (AVIF/WebP mime)\n";

    if (@file_put_contents($ht, $block, FILE_APPEND | LOCK_EX) !== false) {
        set_transient('hashtag_img_htaccess_ok', 1, DAY_IN_SECONDS);
    }
}
add_action('admin_init', 'hashtag_img_ensure_htaccess');

// ---------------------------------------------------------------------------
// Entrega: <img> do conteudo -> <picture> AVIF/WebP/original
// ---------------------------------------------------------------------------

/** Mapeia uma URL de upload para o caminho fisico (ou '' se nao for de uploads). */
function hashtag_img_url_to_path(string $url): string
{
    $u = hashtag_img_uploads();
    if (empty($u['baseurl']) || empty($u['basedir'])) {
        return '';
    }

    // Normaliza protocolo-relativo e http/https para casar com baseurl.
    $baseurl = $u['baseurl'];
    $url_norm = preg_replace('#^https?:#', '', $url);
    $base_norm = preg_replace('#^https?:#', '', $baseurl);

    if (strpos($url_norm, $base_norm) !== 0) {
        return '';
    }

    $rel = ltrim(substr($url_norm, strlen($base_norm)), '/');
    // Tira query string (ex.: ?ver=).
    $rel = preg_replace('/\?.*$/', '', $rel);

    return $u['basedir'] . '/' . $rel;
}

/** Retorna a URL do irmao moderno se o arquivo existir; senao ''. */
function hashtag_img_sibling_url(string $url, string $ext): string
{
    static $cache = [];
    $key = $ext . '|' . $url;
    if (isset($cache[$key])) {
        return $cache[$key];
    }

    $clean = preg_replace('/\?.*$/', '', $url);
    $path  = hashtag_img_url_to_path($clean);

    $result = '';
    if ($path !== '' && file_exists($path . '.' . $ext)) {
        $result = $clean . '.' . $ext;
    }

    $cache[$key] = $result;
    return $result;
}

/**
 * Embrulha um <img> em <picture> com fontes AVIF/WebP, mantendo o <img> como
 * fallback. So inclui um formato se TODOS os candidatos do srcset tiverem irmao
 * (all-or-nothing: evita servir variante moderna degradada durante backfill).
 */
function hashtag_img_wrap_picture(string $html): string
{
    if (strpos($html, '<img') === false || stripos($html, '<picture') !== false) {
        return $html;
    }

    $formats = hashtag_img_target_formats();
    if (! $formats) {
        return $html;
    }

    $srcset = '';
    if (preg_match('/\ssrcset=("|\')(.*?)\1/is', $html, $m)) {
        $srcset = $m[2];
    }
    $src = '';
    if (preg_match('/\ssrc=("|\')(.*?)\1/is', $html, $m)) {
        $src = $m[2];
    }
    $sizes_raw = '';
    if (preg_match('/\ssizes=("|\')(.*?)\1/is', $html, $m)) {
        $sizes_raw = $m[2];
    }

    // Monta a lista de candidatos: cada item do srcset (url + descritor) ou o src.
    $candidates = [];
    if ($srcset !== '') {
        foreach (explode(',', $srcset) as $part) {
            $part = trim($part);
            if ($part === '') {
                continue;
            }
            $sp = preg_split('/\s+/', $part, 2);
            $candidates[] = ['url' => $sp[0], 'desc' => isset($sp[1]) ? ' ' . $sp[1] : ''];
        }
    } elseif ($src !== '') {
        $candidates[] = ['url' => $src, 'desc' => ''];
    }

    if (! $candidates) {
        return $html;
    }

    // Largura "base" = a do `src` (imagem default que o autor inseriu). So serve um formato
    // moderno se ele cobre ESSA largura — evita o browser escolher um modern pequeno p/ um
    // slot grande (upscale borrado) quando a cobertura e parcial, SEM ser estrito demais com
    // a largura FULL do srcset (que em geral nao tem irmao por no-gain — gatear nela dropava
    // todos os formatos e servia o original cru).
    $gate_url = $src !== '' ? $src : ($candidates[0]['url'] ?? '');

    $sources = '';
    foreach ($formats as $fmt) {
        // Exige irmao na largura-base (anti-upscale). Senao pula o formato.
        if ($gate_url !== '' && hashtag_img_sibling_url($gate_url, $fmt['ext']) === '') {
            continue;
        }
        // Inclui todas as larguras que TEM irmao (browser escolhe via `sizes`).
        $modern = [];
        foreach ($candidates as $c) {
            $sib = hashtag_img_sibling_url($c['url'], $fmt['ext']);
            if ($sib !== '') {
                $modern[] = $sib . $c['desc'];
            }
        }
        if (! $modern) {
            continue;
        }

        $source  = '<source type="' . esc_attr($fmt['mime']) . '" srcset="' . esc_attr(implode(', ', $modern)) . '"';
        if ($sizes_raw !== '') {
            $source .= ' sizes="' . esc_attr($sizes_raw) . '"';
        }
        $source .= '>';
        $sources .= $source;
    }

    if ($sources === '') {
        return $html;
    }

    return '<picture>' . $sources . $html . '</picture>';
}

/** Filtro do conteudo: WP 6.0+ passa cada <img> do post body por aqui. */
function hashtag_img_filter_content_img($filtered_image, $context, $attachment_id)
{
    if (is_admin() || is_feed()) {
        return $filtered_image;
    }
    if (! hashtag_img_enabled()) {
        return $filtered_image;
    }
    if (! apply_filters('hashtag_img_wrap_picture_enabled', true, $context, $attachment_id)) {
        return $filtered_image;
    }

    return hashtag_img_wrap_picture($filtered_image);
}
add_filter('wp_content_img_tag', 'hashtag_img_filter_content_img', 20, 3);

// ---------------------------------------------------------------------------
// WP-CLI: backfill do acervo existente
// ---------------------------------------------------------------------------

if (defined('WP_CLI') && WP_CLI) {

    /**
     * Processa um anexo (cheia + sub-tamanhos). Retorna [gerados, pulados].
     */
    function hashtag_img_process_attachment(int $attachment_id, bool $force = false): array
    {
        $mime = get_post_mime_type($attachment_id);
        if (! in_array($mime, hashtag_img_source_mimes(), true)) {
            return [0, 0];
        }

        $made = 0;
        $skipped = 0;
        foreach (hashtag_img_attachment_paths($attachment_id) as $path) {
            if (! file_exists($path)) {
                continue;
            }
            if ($force) {
                hashtag_img_delete_siblings($path);
            }
            [$m, $s] = hashtag_img_make_siblings($path);
            $made    += $m;
            $skipped += $s;
        }

        return [$made, $skipped];
    }

    class Hashtag_Image_Optimizer_CLI
    {
        /**
         * Gera AVIF/WebP para o acervo existente.
         *
         * ## OPTIONS
         *
         * [--limit=<n>]
         * : Quantos anexos processar. default: todos.
         *
         * [--offset=<n>]
         * : Pular os primeiros N anexos. default: 0.
         *
         * [--ids=<lista>]
         * : IDs especificos separados por virgula (ignora limit/offset).
         *
         * [--force]
         * : Regera mesmo que os irmaos ja existam.
         *
         * [--sleep=<ms>]
         * : Pausa em milissegundos entre anexos (alivia CPU). default: 0.
         *
         * [--formats=<lista>]
         * : Limita os formatos gerados nesta rodada (ex.: webp ou avif,webp).
         *   Util p/ um passe rapido so de WebP e um passe lento de AVIF depois.
         *
         * ## EXAMPLES
         *     wp hashtag-image regenerate --limit=50
         *     wp hashtag-image regenerate --ids=123,456 --force
         *     wp hashtag-image regenerate --formats=webp --skip-plugins
         *
         * @when after_wp_load
         */
        public function regenerate($args, $assoc)
        {
            if (! hashtag_img_enabled()) {
                WP_CLI::error('Otimizador desligado ou nenhum formato moderno suportado neste servidor.');
            }

            // Restringe os formatos desta rodada (passe so-WebP ou so-AVIF).
            if (! empty($assoc['formats'])) {
                $want = array_filter(array_map('trim', explode(',', strtolower($assoc['formats']))));
                add_filter('hashtag_img_target_formats', function ($formats) use ($want) {
                    return array_values(array_filter($formats, fn ($f) => in_array($f['ext'], $want, true)));
                }, 99);
            }

            $formats = array_map(fn ($f) => $f['ext'], hashtag_img_target_formats());
            if (! $formats) {
                WP_CLI::error('Nenhum formato selecionado/suportado.');
            }
            WP_CLI::log('Formatos desta rodada: ' . implode(', ', $formats));

            $force = ! empty($assoc['force']);
            $sleep = isset($assoc['sleep']) ? (int) $assoc['sleep'] : 0;

            if (! empty($assoc['ids'])) {
                $ids = array_filter(array_map('intval', explode(',', $assoc['ids'])));
            } else {
                $query_args = [
                    'post_type'      => 'attachment',
                    'post_status'    => 'inherit',
                    'post_mime_type' => hashtag_img_source_mimes(),
                    'fields'         => 'ids',
                    'orderby'        => 'ID',
                    'order'          => 'ASC',
                    'posts_per_page' => isset($assoc['limit']) ? (int) $assoc['limit'] : -1,
                    'offset'         => isset($assoc['offset']) ? (int) $assoc['offset'] : 0,
                    'no_found_rows'  => true,
                ];
                $ids = get_posts($query_args);
            }

            $total = count($ids);
            if (! $total) {
                WP_CLI::success('Nenhum anexo elegivel.');
                return;
            }

            $progress = \WP_CLI\Utils\make_progress_bar('Gerando AVIF/WebP', $total);
            $made = 0;
            $att  = 0;
            foreach ($ids as $id) {
                [$m] = hashtag_img_process_attachment((int) $id, $force);
                $made += $m;
                $att++;
                if ($sleep > 0) {
                    usleep($sleep * 1000);
                }
                $progress->tick();
            }
            $progress->finish();

            WP_CLI::success("Anexos: {$att} | arquivos modernos gerados: {$made}");
        }

        /**
         * Conta quantos anexos ja tem (ou nao) os irmaos modernos.
         *
         * ## OPTIONS
         *
         * [--limit=<n>]
         * : Amostra os primeiros N anexos. default: 500.
         *
         * @when after_wp_load
         */
        public function status($args, $assoc)
        {
            $formats = hashtag_img_target_formats();
            if (! $formats) {
                WP_CLI::error('Nenhum formato moderno suportado.');
            }

            $limit = isset($assoc['limit']) ? (int) $assoc['limit'] : 500;
            $ids = get_posts([
                'post_type'      => 'attachment',
                'post_status'    => 'inherit',
                'post_mime_type' => hashtag_img_source_mimes(),
                'fields'         => 'ids',
                'posts_per_page' => $limit,
                'no_found_rows'  => true,
            ]);

            $with = 0;
            $without = 0;
            foreach ($ids as $id) {
                $file = get_attached_file((int) $id);
                if (! $file) {
                    continue;
                }
                $has = file_exists($file . '.' . $formats[0]['ext']);
                $has ? $with++ : $without++;
            }

            WP_CLI::log('Amostra: ' . count($ids) . ' anexos');
            WP_CLI::log("Com {$formats[0]['ext']} (cheia): {$with}");
            WP_CLI::log("Sem {$formats[0]['ext']} (cheia): {$without}");
        }
    }

    WP_CLI::add_command('hashtag-image', 'Hashtag_Image_Optimizer_CLI');
}
