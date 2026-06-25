<?php

/**
 * Gerador reprodutivel de llms.txt e llms-full.txt (Capacitaciones — AEO).
 *
 * Porte do scripts/llms/gen-llms.php do hashtag, com 1 diferenca: o CATALOGO de
 * cursos e OPCIONAL (a Cap ainda nao tem `inc/cursos/course-catalog-data.php`).
 * Sem catalogo, toda entry usa `url` fixa (em vez de `course => slug`) e a
 * validacao de drift por catalogo e pulada.
 *
 * Fonte unica de dados:
 *   - Numeros da marca -> inc/hashtag-stats.php
 *   - Texto editorial  -> scripts/llms/llms-data.php (em espanhol)
 *   - URLs de curso    -> catalogo (se existir) OU `url` fixa na entry
 *
 * Escreve na RAIZ do WordPress: llms.txt e llms-full.txt (servidos publicamente).
 * NAO saem pelo SFTP do tema — subir manualmente (so os 2 .txt da raiz).
 *
 * Uso (da raiz do projeto, com DDEV ligado):
 *   ddev exec php wp-content/themes/hashtag/scripts/llms/gen-llms.php
 *   ddev exec php wp-content/themes/hashtag/scripts/llms/gen-llms.php --dry-run
 *
 * Nao depende do bootstrap do WordPress. Stuba apenas get_template_directory_uri().
 */

// --- Caminhos (relativos a este arquivo, validos no container e no host) -----
$theme_dir = dirname(__DIR__, 2);                 // .../themes/hashtag
$wp_root   = dirname(__DIR__, 5);                 // raiz do WordPress

$catalog_data_file = $theme_dir . '/inc/cursos/course-catalog-data.php'; // opcional
$stats_file        = $theme_dir . '/inc/hashtag-stats.php';
$content_file      = __DIR__ . '/llms-data.php';

$dry_run = in_array('--dry-run', $argv, true) || in_array('--dry', $argv, true);

// --- Helpers -----------------------------------------------------------------

/** Translitera acentos PT/ES para ASCII (consistencia com os arquivos servidos). */
function llms_ascii($s)
{
    $map = [
        'á' => 'a', 'à' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a',
        'é' => 'e', 'ê' => 'e', 'è' => 'e', 'ë' => 'e',
        'í' => 'i', 'î' => 'i', 'ì' => 'i', 'ï' => 'i',
        'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ò' => 'o', 'ö' => 'o',
        'ú' => 'u', 'û' => 'u', 'ù' => 'u', 'ü' => 'u',
        'ç' => 'c', 'ñ' => 'n', '¿' => '', '¡' => '',
        'Á' => 'A', 'À' => 'A', 'Â' => 'A', 'Ã' => 'A',
        'É' => 'E', 'Ê' => 'E', 'Í' => 'I', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O',
        'Ú' => 'U', 'Ç' => 'C', 'Ñ' => 'N',
    ];
    return strtr((string) $s, $map);
}

function llms_fail($msg)
{
    fwrite(STDERR, "ERRO: $msg\n");
    exit(1);
}

// --- Carrega fontes ----------------------------------------------------------

if (!is_file($stats_file)) {
    llms_fail("stats nao encontrado: $stats_file");
}
if (!is_file($content_file)) {
    llms_fail("conteudo nao encontrado: $content_file");
}

// Stub minimo (so usado se houver catalogo).
if (!function_exists('get_template_directory_uri')) {
    function get_template_directory_uri()
    {
        return 'https://hashtagcapacitaciones.com/wp-content/themes/hashtag';
    }
}

require $stats_file;                          // define hashtag_stats_data()
if (!function_exists('hashtag_stats_data')) {
    llms_fail('hashtag_stats_data() nao definida apos require do stats.');
}
$stats = hashtag_stats_data();

// Catalogo OPCIONAL: a Cap ainda nao tem. Sem ele, entries usam `url` fixa.
$courses = [];
if (is_file($catalog_data_file)) {
    $catalog = require $catalog_data_file;
    if (is_array($catalog) && isset($catalog['courses']) && is_array($catalog['courses'])) {
        $courses = $catalog['courses'];
    }
}

$data = require $content_file;

// --- Tokens (resolvidos no final sobre o output inteiro) ---------------------

$tokens = [
    '{ano}'           => (string) ($stats['ano_fundacao'] ?? ''),
    '{alunos}'        => llms_ascii($stats['alunos_formatado_curto_np'] ?? ''),
    '{alunos_grupo}'  => llms_ascii($stats['alunos_grupo_formatado_curto_np'] ?? ''),
    '{youtube}'       => llms_ascii($stats['youtube_inscritos_curto'] ?? ''),
    '{empresas}'      => llms_ascii($stats['empresas_atendidas_curto'] ?? ''),
    '{ra}'            => llms_ascii($stats['ra_selo'] ?? ''),
    '{google_nota}'   => llms_ascii($stats['google_nota'] ?? ''),
    '{google_aval}'   => llms_ascii((string) ($stats['google_avaliacoes'] ?? '')),
    '{sitemap_url}'   => (string) ($data['sitemap_url'] ?? ''),
    '{llms_url}'      => (string) ($data['llms_url'] ?? ''),
    '{llms_full_url}' => (string) ($data['llms_full_url'] ?? ''),
];

// --- Resolucao de URL de uma entry (fixa ou do catalogo) ---------------------

$referenced_courses = [];

$resolve_url = static function (array $entry) use ($courses, &$referenced_courses) {
    if (isset($entry['course'])) {
        $slug = $entry['course'];
        if (!isset($courses[$slug])) {
            llms_fail("entry referencia curso inexistente no catalogo: '$slug' (e a Cap pode nao ter catalogo — use 'url' fixa).");
        }
        $link = (string) ($courses[$slug]['link'] ?? '');
        if ($link === '') {
            llms_fail("curso '$slug' sem 'link' no catalogo.");
        }
        $referenced_courses[$slug] = true;
        return $link;
    }
    if (!isset($entry['url']) || $entry['url'] === '') {
        llms_fail("entry '" . ($entry['title'] ?? '?') . "' sem url nem course.");
    }
    return (string) $entry['url'];
};

// --- Builders ----------------------------------------------------------------

$default_label = (string) ($data['default_bullets_label'] ?? 'Contenido util para LLMs:');

/** llms.txt: uma secao = bloco "## h" + bloco com a lista de itens contigua. */
$build_llms_section = static function (array $section) use ($resolve_url) {
    if (empty($section['llms_h'])) {
        return [];
    }

    $blocks = ['## ' . $section['llms_h']];

    if (($section['type'] ?? 'entries') === 'bullets') {
        $lines = [];
        foreach ($section['items'] as $item) {
            $lines[] = '- ' . $item;
        }
        $blocks[] = implode("\n", $lines);
        return $blocks;
    }

    $lines = [];
    foreach ($section['entries'] as $entry) {
        $url = $resolve_url($entry);
        $lines[] = sprintf('- [%s](%s): %s', $entry['title'], $url, $entry['short']);
    }
    $blocks[] = implode("\n", $lines);

    return $blocks;
};

/** llms-full.txt: secao = "## h" + por entry blocos (### t / URL / long / [label / bullets]). */
$build_full_section = static function (array $section) use ($resolve_url, $default_label) {
    if (empty($section['full_h'])) {
        return [];
    }

    $blocks = ['## ' . $section['full_h']];

    if (($section['type'] ?? 'entries') === 'bullets') {
        $lines = [];
        foreach ($section['items'] as $item) {
            $lines[] = '- ' . $item;
        }
        $blocks[] = implode("\n", $lines);
        return $blocks;
    }

    foreach ($section['entries'] as $entry) {
        $url  = $resolve_url($entry);
        $long = $entry['long'] ?? $entry['short'];

        $blocks[] = '### ' . $entry['title'];
        $blocks[] = 'URL: ' . $url;
        $blocks[] = $long;

        if (!empty($entry['bullets'])) {
            $blocks[] = $entry['bullets_label'] ?? $default_label;
            $lines = [];
            foreach ($entry['bullets'] as $b) {
                $lines[] = '- ' . $b;
            }
            $blocks[] = implode("\n", $lines);
        }
    }

    return $blocks;
};

// --- Monta llms.txt ----------------------------------------------------------

$llms_blocks = [];
$llms_blocks[] = '# Hashtag Capacitaciones';
$llms_blocks[] = '> ' . $data['tagline_base'] . ' ' . $data['stats_sentence'];
$llms_blocks[] = $data['llms_lead'];
$llms_blocks[] = '## Archivos para LLMs';
$llms_blocks[] = sprintf(
    '- [llms-full.txt](%s): Version expandida en Markdown con contexto inline sobre Hashtag Capacitaciones, cursos, paginas principales y contenidos gratuitos.',
    '{llms_full_url}'
);

foreach ($data['sections'] as $section) {
    foreach ($build_llms_section($section) as $block) {
        $llms_blocks[] = $block;
    }
}

// --- Monta llms-full.txt -----------------------------------------------------

$full_blocks = [];
$full_blocks[] = '# Hashtag Capacitaciones';
$full_blocks[] = '> ' . $data['tagline_base'];
foreach ($data['full_lead'] as $p) {
    $full_blocks[] = $p;
}
$full_blocks[] = '## Resumen del sitio';
foreach ($data['full_resumo'] as $p) {
    $full_blocks[] = $p;
}
foreach ($data['sections'] as $section) {
    foreach ($build_full_section($section) as $block) {
        $full_blocks[] = $block;
    }
}

// --- Resolve tokens e finaliza -----------------------------------------------

$finalize = static function (array $blocks) use ($tokens) {
    $out = implode("\n\n", $blocks) . "\n";
    return strtr($out, $tokens);
};

$llms_txt = $finalize($llms_blocks);
$full_txt = $finalize($full_blocks);

// --- Validacao de drift (so se houver catalogo) ------------------------------

$warnings = [];
if ($courses) {
    $excluded = array_flip($data['courses_excluded_ranked'] ?? []);
    foreach (($data['courses_excluded_ranked'] ?? []) as $slug) {
        if (!isset($courses[$slug])) {
            $warnings[] = "excluido '$slug' nao existe no catalogo (lista desatualizada).";
        }
    }
    foreach ($courses as $slug => $course) {
        $ranking = $course['ranking'] ?? null;
        if ($ranking === null) {
            continue;
        }
        if (isset($referenced_courses[$slug]) || isset($excluded[$slug])) {
            continue;
        }
        $name = llms_ascii($course['name'] ?? $slug);
        $warnings[] = "curso '$slug' (ranking $ranking, $name) tem ranking mas NAO esta no llms nem em courses_excluded_ranked.";
    }
}

// --- Escreve / relata --------------------------------------------------------

$llms_path = $wp_root . '/llms.txt';
$full_path = $wp_root . '/llms-full.txt';

$report = static function ($path, $new) {
    $exists  = is_file($path);
    $old     = $exists ? file_get_contents($path) : '';
    $changed = $old !== $new;
    return [
        'exists'  => $exists,
        'changed' => $changed,
        'bytes'   => strlen($new),
    ];
};

$r_llms = $report($llms_path, $llms_txt);
$r_full = $report($full_path, $full_txt);

echo "== gen-llms (Capacitaciones) ==\n";
echo sprintf("catalogo: %s\n", $courses ? (count($courses) . ' cursos') : 'ausente (entries usam url fixa)');
echo sprintf("llms.txt      : %d bytes, %s%s\n", $r_llms['bytes'], $r_llms['exists'] ? '' : '(novo) ', $r_llms['changed'] ? 'MUDOU' : 'igual');
echo sprintf("llms-full.txt : %d bytes, %s%s\n", $r_full['bytes'], $r_full['exists'] ? '' : '(novo) ', $r_full['changed'] ? 'MUDOU' : 'igual');

if ($warnings) {
    echo "\nAVISOS de drift (" . count($warnings) . "):\n";
    foreach ($warnings as $w) {
        echo "  - $w\n";
    }
} else {
    echo "\nsem avisos de drift.\n";
}

if ($dry_run) {
    echo "\n--dry-run: nada escrito.\n";
    exit(0);
}

if (file_put_contents($llms_path, $llms_txt) === false) {
    llms_fail("falha ao escrever $llms_path");
}
if (file_put_contents($full_path, $full_txt) === false) {
    llms_fail("falha ao escrever $full_path");
}

echo "\nescrito:\n  $llms_path\n  $full_path\n";
