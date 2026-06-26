<?php
/**
 * Opcoes do Site — substituto NATIVO do ACF Pro (inc/acf removido por seguranca).
 *
 * Contexto (Capacitaciones): o tema (fork antigo do hashtag) usava ACF Pro vendorizado
 * APENAS para a pagina de opcoes "Opcoes do Site". Os campos de option referenciados nos
 * templates sao escalares:
 *   - head, footer    -> textarea, HTML/script cru (GTM)
 *   - youtube, instagram, whatsapp_alon -> text (URLs, so em parts/* legados)
 * Os valores vivem em wp_options como `options_<campo>` (mesmo storage que o ACF usava) —
 * por isso ESTE shim le/escreve as mesmas chaves: zero migracao de dados. Hoje a pagina
 * esta VAZIA (0 chaves `options_*`; o GTM e hardcoded no template) -> o shim devolve ''
 * = saida byte-identica a do ACF.
 *
 * NAO e ACF. E codigo proprio do tema. Define so o subconjunto minimo da API que os
 * templates chamam (get_field/the_field, contexto 'option') + stubs de degradacao
 * graciosa para qualquer chamada de repeater/sub-field perdida (codigo morto: nunca
 * dao fatal).
 *
 * Painel de edicao: inc/options/site-options-admin.php (slug `opcoes-do-site`).
 *
 * @package hashtag
 */

if (!defined('ABSPATH')) {
    exit;
}

// Prefixo historico do ACF para a options page (chaves `options_head`, etc.).
if (!defined('HASHTAG_OPTION_PREFIX')) {
    define('HASHTAG_OPTION_PREFIX', 'options_');
}

/**
 * True quando o $post_id representa a pagina de opcoes (contexto 'option'/'options').
 *
 * @param mixed $post_id
 * @return bool
 */
if (!function_exists('hashtag_is_option_context')) {
    function hashtag_is_option_context($post_id)
    {
        return is_string($post_id) && stripos($post_id, 'option') !== false;
    }
}

/**
 * Le o valor CRU de um campo de Opcoes do Site (sem filtros de formatacao).
 *
 * @param string $name    Nome do campo (ex.: 'head').
 * @param string $default Valor padrao se ausente.
 * @return mixed
 */
if (!function_exists('hashtag_get_site_option')) {
    function hashtag_get_site_option($name, $default = '')
    {
        $value = get_option(HASHTAG_OPTION_PREFIX . $name, $default);

        return $value === false ? $default : $value;
    }
}

/**
 * Resolve um $post_id ACF-style para um ID numerico de post (ou 0).
 *
 * @param mixed $post_id
 * @return int
 */
if (!function_exists('hashtag_resolve_post_id')) {
    function hashtag_resolve_post_id($post_id)
    {
        if ($post_id === false || $post_id === null || $post_id === '') {
            $post_id = get_the_ID();
        }

        if (is_object($post_id) && isset($post_id->ID)) {
            $post_id = $post_id->ID;
        }

        return is_numeric($post_id) ? (int) $post_id : 0;
    }
}

/**
 * Substituto de ACF get_field().
 * - Contexto 'option'/'options' -> wp_options `options_<selector>`.
 * - $post_id numerico/objeto/false -> post meta (cobre qualquer chamada residual).
 * Aplica o filtro `acf/format_value/name=<selector>` (mesma assinatura do ACF) para
 * preservar o processamento de head/footer caso o tema registre filtros no futuro.
 *
 * @param string $selector
 * @param mixed  $post_id
 * @param bool   $format_value
 * @return mixed
 */
if (!function_exists('get_field')) {
    function get_field($selector, $post_id = false, $format_value = true)
    {
        if (hashtag_is_option_context($post_id)) {
            $value = hashtag_get_site_option($selector, '');
        } else {
            $resolved = hashtag_resolve_post_id($post_id);
            $value = $resolved ? get_post_meta($resolved, $selector, true) : '';
        }

        if ($format_value) {
            // Mesmo hook dinamico que o ACF disparava; se o tema registrar filtros
            // `acf/format_value/name=...` no futuro, rodam aqui na ordem de prioridade.
            $field = array('name' => $selector, 'key' => '', 'type' => '');
            $value = apply_filters('acf/format_value/name=' . $selector, $value, $post_id, $field);
        }

        return $value;
    }
}

/**
 * Substituto de ACF the_field(): ecoa get_field().
 *
 * @param string $selector
 * @param mixed  $post_id
 * @return void
 */
if (!function_exists('the_field')) {
    function the_field($selector, $post_id = false)
    {
        echo get_field($selector, $post_id);
    }
}

/**
 * Substituto de ACF update_field(): grava em options_<sel> (contexto option) ou post meta.
 *
 * @param string $selector
 * @param mixed  $value
 * @param mixed  $post_id
 * @return bool
 */
if (!function_exists('update_field')) {
    function update_field($selector, $value, $post_id = false)
    {
        if (hashtag_is_option_context($post_id)) {
            return (bool) update_option(HASHTAG_OPTION_PREFIX . $selector, $value);
        }

        $resolved = hashtag_resolve_post_id($post_id);

        return $resolved ? (bool) update_post_meta($resolved, $selector, $value) : false;
    }
}

/* -------------------------------------------------------------------------- *
 * Stubs de degradacao graciosa.
 * O tema ATIVO nao usa repeater/flexible/sub-field (auditado: o unico uso de
 * the_sub_field/have_rows esta em parts/content-presencial.php, content-online.php
 * e archive-cursos.php — codigo MORTO, nao incluido por nenhum template / CPT
 * `cursos` comentado). Estes stubs evitam fatal caso sobre alguma chamada legada.
 * Sempre "vazio".
 * -------------------------------------------------------------------------- */

if (!function_exists('get_fields')) {
    function get_fields($post_id = false, $format_value = true)
    {
        return array();
    }
}

if (!function_exists('have_rows')) {
    function have_rows($selector, $post_id = false)
    {
        return false;
    }
}

if (!function_exists('the_row')) {
    function the_row($format = false)
    {
        return array();
    }
}

if (!function_exists('get_row')) {
    function get_row($format = false)
    {
        return false;
    }
}

if (!function_exists('get_row_layout')) {
    function get_row_layout()
    {
        return '';
    }
}

if (!function_exists('get_sub_field')) {
    function get_sub_field($selector, $format_value = true)
    {
        return false;
    }
}

if (!function_exists('the_sub_field')) {
    function the_sub_field($selector, $format_value = true)
    {
        // no-op
    }
}

if (!function_exists('get_sub_field_object')) {
    function get_sub_field_object($selector, $format_value = true, $load_value = true)
    {
        return false;
    }
}

if (!function_exists('get_field_object')) {
    function get_field_object($selector, $post_id = false, $format_value = true, $load_value = true)
    {
        return false;
    }
}

if (!function_exists('acf_add_options_page')) {
    // A pagina e registrada nativamente em site-options-admin.php; aqui so evitamos fatal.
    function acf_add_options_page($args = array())
    {
        return $args;
    }
}

if (!function_exists('acf_add_options_sub_page')) {
    function acf_add_options_sub_page($args = array())
    {
        return $args;
    }
}

if (!function_exists('register_field_group')) {
    function register_field_group($field_group)
    {
        // no-op
    }
}

if (!function_exists('acf_add_local_field_group')) {
    function acf_add_local_field_group($field_group)
    {
        // no-op
    }
}
