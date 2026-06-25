<?php
/**
 * Motor do grafo de dados estruturados (JSON-LD) — fonte unica de schema do tema (Cap).
 * Porte do hashtag. Consolida todo o schema num UNICO `@graph` por pagina, ligado por @id.
 *
 * Substitui o schema do Rank Math Pro (rich-snippet), que hoje emite bagunca na Cap
 * (Article na home, EducationalOrganization solto, 3 blocos). O grafo nativo emite 1 bloco.
 *
 * Arquitetura (pull model): cada area registra um PROVIDER via
 * hashtag_schema_register($cb, $prio); no wp_head prio 99 o coletor junta os nos, dedup
 * por @id e emite 1 <script id="hashtag-schema-graph">.
 *
 * NEUTRALIZACAO DO RM: gated por HASHTAG_SCHEMA_NEUTRALIZE_RM (constante wp-config) ou
 * filtro hashtag_schema_neutralize_rm. Default TRUE (estado-alvo). Durante o build/validacao
 * pode-se setar false p/ emitir ao lado do RM. No cutover fica true (RM nao emite JSON-LD).
 *
 * @package Hashtag\Schema
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!function_exists('hashtag_schema_register')) {
    /**
     * Registra um provider de nos do grafo.
     *
     * @param callable $callback  Retorna array<int,array>|array|null (nos JSON-LD).
     * @param int      $priority  Ordem de montagem (menor primeiro). Entidades-base
     *                            (Organization/WebSite/WebPage) usam prioridades baixas.
     */
    function hashtag_schema_register(callable $callback, int $priority = 50): void
    {
        $GLOBALS['hashtag_schema_providers'][] = [$priority, $callback];
    }
}

if (!function_exists('hashtag_schema_is_emittable')) {
    function hashtag_schema_is_emittable(): bool
    {
        if (is_admin() || is_feed() || is_embed() || is_robots() || is_trackback()) {
            return false;
        }
        if (defined('REST_REQUEST') && REST_REQUEST) {
            return false;
        }
        if (defined('DOING_AJAX') && DOING_AJAX) {
            return false;
        }

        return (bool) apply_filters('hashtag_schema_enabled', true);
    }
}

if (!function_exists('hashtag_schema_normalize_nodes')) {
    /**
     * Achata o retorno de um provider numa lista plana de nos.
     *
     * @param mixed $result
     * @return array<int,array<string,mixed>>
     */
    function hashtag_schema_normalize_nodes($result): array
    {
        if (empty($result) || !is_array($result)) {
            return [];
        }
        if (isset($result['@type']) || isset($result['@id'])) {
            return [$result];
        }
        $out = [];
        foreach ($result as $node) {
            if (is_array($node) && (isset($node['@type']) || isset($node['@id']))) {
                $out[] = $node;
            }
        }
        return $out;
    }
}

if (!function_exists('hashtag_schema_build_graph')) {
    /**
     * Monta a lista de nos do grafo da pagina atual a partir dos providers registrados.
     * Ordena por prioridade; dedup por @id (primeira ocorrencia vence).
     *
     * @return array<int,array<string,mixed>>
     */
    function hashtag_schema_build_graph(): array
    {
        $providers = $GLOBALS['hashtag_schema_providers'] ?? [];
        if (!$providers) {
            return [];
        }

        usort($providers, static function ($a, $b) {
            return $a[0] <=> $b[0];
        });

        $nodes   = [];
        $seen_id = [];
        foreach ($providers as [$priority, $callback]) {
            $result = call_user_func($callback);
            foreach (hashtag_schema_normalize_nodes($result) as $node) {
                $id = $node['@id'] ?? null;
                if ($id !== null && $id !== '') {
                    if (isset($seen_id[$id])) {
                        continue;
                    }
                    $seen_id[$id] = true;
                }
                unset($node['@context']);
                $nodes[] = $node;
            }
        }

        return apply_filters('hashtag_schema_graph_nodes', $nodes);
    }
}

/**
 * Neutraliza o JSON-LD do Rank Math (gated). CRITICO: o rich-snippet do RM esta ativo
 * (pt_post=article, pt_page=course) e, sem este filtro, despejaria Course em TODA pagina
 * + Article duplicado. So ligar quando o grafo nativo cobrir tudo (cutover).
 */
if (!function_exists('hashtag_schema_should_neutralize_rm')) {
    function hashtag_schema_should_neutralize_rm(): bool
    {
        $default = defined('HASHTAG_SCHEMA_NEUTRALIZE_RM') ? (bool) HASHTAG_SCHEMA_NEUTRALIZE_RM : true;
        return (bool) apply_filters('hashtag_schema_neutralize_rm', $default);
    }
}
if (hashtag_schema_should_neutralize_rm()) {
    add_filter('rank_math/json_ld', static function () {
        return [];
    }, 99);
}

if (!function_exists('hashtag_schema_emit')) {
    function hashtag_schema_emit(): void
    {
        if (!hashtag_schema_is_emittable()) {
            return;
        }

        $nodes = hashtag_schema_build_graph();
        if (!$nodes) {
            return;
        }

        $graph = [
            '@context' => 'https://schema.org',
            '@graph'   => array_values($nodes),
        ];

        $json = wp_json_encode($graph, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        if (!$json) {
            return;
        }

        echo "\n<script type=\"application/ld+json\" id=\"hashtag-schema-graph\">"
            . $json
            . "</script>\n";
    }
    add_action('wp_head', 'hashtag_schema_emit', 99);
}
