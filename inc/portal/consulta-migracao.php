<?php
/**
 * Consulta de migracao de portal — endpoint server-side (capacitaciones).
 *
 * O aluno informa o e-mail na pagina /acceso-portal e este endpoint consulta a
 * API do portal antigo (Bubble) para descobrir se a conta ja foi migrada para a
 * nova plataforma, devolvendo a URL de destino correta. O token da API fica
 * server-side (constante API_TOKEN_CONSULTA_MIGRACAO no wp-config) e NUNCA e
 * exposto ao browser. APIs compartilhadas com o projeto hashtag (mesmos tokens).
 *
 * Endpoint:  POST /wp-json/hashtag/v1/consulta-portal
 * Body JSON: { "email": "alumno@ejemplo.com", "website": "" (honeypot) }
 * Resposta:  { "ok": true,  "url": "https://...", "portal": "novo|antigo|nao_aluno" }
 *            { "ok": false, "error": "...", "message": "..." }
 *
 * Contrato do upstream (Bubble), campo `response`:
 *   { "migrado": true }   -> aluno ja migrado  -> portal novo
 *   { "migrado": false }  -> aluno nao migrado -> portal antigo
 *   { "isUser": false }   -> nao e aluno       -> 2a verificacao -> portal antigo
 *
 * Credencial (definir no wp-config.php de prod e no wp-config-ddev.php — NUNCA no repo):
 *   define('API_TOKEN_CONSULTA_MIGRACAO', '<token>');
 *
 * @package Hashtag
 */

if (! defined('ABSPATH')) {
    exit;
}

/**
 * Endpoint upstream (Bubble Workflow API) que resolve a migracao por e-mail.
 * Aceita GET com ?email= e exige Authorization: Bearer <token>.
 */
function hashtag_portal_api_endpoint()
{
    return apply_filters(
        'hashtag_portal_api_endpoint',
        'https://portalhashtag.com/api/1.1/wf/consulta-migracao'
    );
}

/**
 * Endpoint do portal NOVO (backoffice LMS) para a 2a verificacao por e-mail.
 * POST com header `X-Api-Key` e body `{ "email": "..." }`.
 */
function hashtag_portal_novo_endpoint()
{
    return apply_filters(
        'hashtag_portal_novo_endpoint',
        'https://backoffice-prod.hashtaglms.com/external/v1/handle-signature/verificar-aluno'
    );
}

/**
 * URLs de destino. Filtraveis para ajuste sem editar codigo.
 *  - novo:   aluno ja migrado para a nova plataforma (por ora aponta para o
 *            portal novo do Brasil; Diego ajusta para o destino ES depois)
 *  - antigo: aluno no portal legado (versao /es) — tambem o destino de quem o
 *            portal antigo nao reconhece (nao-aluno), apos a 2a verificacao
 */
function hashtag_portal_destinos()
{
    return apply_filters('hashtag_portal_destinos', [
        'novo'   => 'https://login.hashtagtreinamentos.com/login',
        'antigo' => 'https://portalhashtag.com/login/es',
    ]);
}

/**
 * Hosts autorizados a chamar o endpoint (anti-CSRF leve via Origin/Referer).
 */
function hashtag_portal_allowed_hosts()
{
    if (function_exists('hashtag_ac_allowed_hosts')) {
        return hashtag_ac_allowed_hosts();
    }
    return apply_filters('hashtag_portal_allowed_hosts', [
        'www.hashtagcapacitaciones.com',
        'hashtagcapacitaciones.com',
        'lp.hashtagcapacitaciones.com',
        'capacitaciones.ddev.site',
    ]);
}

/** IP do cliente (reusa helper do tema; respeita proxy Cloudflare). */
function hashtag_portal_client_ip()
{
    if (function_exists('hashtag_ac_client_ip')) {
        return hashtag_ac_client_ip();
    }
    foreach (['HTTP_CF_CONNECTING_IP', 'HTTP_X_FORWARDED_FOR', 'REMOTE_ADDR'] as $key) {
        if (! empty($_SERVER[$key])) {
            $ip = explode(',', $_SERVER[$key])[0];
            return filter_var(trim($ip), FILTER_VALIDATE_IP) ?: '';
        }
    }
    return '';
}

/**
 * Registro da rota REST.
 */
add_action('rest_api_init', function () {
    register_rest_route('hashtag/v1', '/consulta-portal', [
        'methods'             => 'POST',
        'callback'            => 'hashtag_portal_handle_consulta',
        'permission_callback' => '__return_true', // publico; protegido por origin + honeypot + rate-limit
    ]);
});

/**
 * Handler: valida, consulta o portal antigo e devolve o destino do aluno.
 */
function hashtag_portal_handle_consulta(WP_REST_Request $request)
{
    // ---- Origin / Referer ----------------------------------------------
    $source = $request->get_header('origin') ?: $request->get_header('referer');
    if ($source) {
        $host = wp_parse_url($source, PHP_URL_HOST);
        if ($host && ! in_array(strtolower($host), hashtag_portal_allowed_hosts(), true)) {
            return new WP_REST_Response(['ok' => false, 'error' => 'origin'], 403);
        }
    }

    $params = $request->get_json_params();
    if (! is_array($params)) {
        $params = $request->get_params();
    }

    // ---- Honeypot: se preenchido, e bot --------------------------------
    if (! empty($params['website']) || ! empty($params['_gotcha'])) {
        return new WP_REST_Response(['ok' => false, 'error' => 'bot'], 200);
    }

    // ---- Rate limit por IP (anti-flood) --------------------------------
    $ip = hashtag_portal_client_ip();
    if ($ip) {
        $bucket = 'hashtag_portal_rl_' . md5($ip);
        $hits = (int) get_transient($bucket);
        if ($hits >= 12) {
            return new WP_REST_Response(['ok' => false, 'error' => 'rate', 'message' => 'Demasiados intentos. Espera unos instantes e intenta de nuevo.'], 429);
        }
        set_transient($bucket, $hits + 1, MINUTE_IN_SECONDS);
    }

    // ---- Validacao -----------------------------------------------------
    $email = isset($params['email']) ? sanitize_email($params['email']) : '';
    if (! is_email($email)) {
        return new WP_REST_Response(['ok' => false, 'error' => 'email', 'message' => 'Ingresa un correo electronico valido.'], 400);
    }

    // ---- Token ---------------------------------------------------------
    $token = defined('API_TOKEN_CONSULTA_MIGRACAO') ? API_TOKEN_CONSULTA_MIGRACAO : '';
    if ('' === $token) {
        error_log('[hashtag-portal] API_TOKEN_CONSULTA_MIGRACAO ausente no wp-config.');
        return new WP_REST_Response(['ok' => false, 'error' => 'config', 'message' => 'Servicio no disponible en este momento.'], 503);
    }

    // ---- Consulta upstream (Bubble, GET + Bearer) ----------------------
    // Encoding manual (rawurlencode): add_query_arg re-encodaria o '%' e o
    // Bubble receberia o e-mail corrompido (ex.: a%2540b.com).
    $url = hashtag_portal_api_endpoint() . '?email=' . rawurlencode($email);
    $response = wp_remote_get($url, [
        'timeout' => 12,
        'headers' => [
            'Authorization' => 'Bearer ' . $token,
            'Accept'        => 'application/json',
        ],
    ]);

    if (is_wp_error($response)) {
        error_log('[hashtag-portal] erro de rede: ' . $response->get_error_message());
        return new WP_REST_Response(['ok' => false, 'error' => 'upstream', 'message' => 'No fue posible consultar ahora. Intenta de nuevo.'], 502);
    }

    $code = (int) wp_remote_retrieve_response_code($response);
    $raw  = wp_remote_retrieve_body($response);
    $body = json_decode($raw, true);

    if ($code < 200 || $code >= 300 || ! is_array($body) || ($body['status'] ?? '') !== 'success') {
        error_log('[hashtag-portal] upstream code=' . $code . ' body=' . $raw);
        return new WP_REST_Response(['ok' => false, 'error' => 'upstream', 'message' => 'No fue posible consultar ahora. Intenta de nuevo.'], 502);
    }

    $data = (isset($body['response']) && is_array($body['response'])) ? $body['response'] : [];

    // Diagnostico (so com WP_DEBUG): confirma o schema real do Bubble.
    if (defined('WP_DEBUG') && WP_DEBUG) {
        error_log('[hashtag-portal] response p/ ' . $email . ': ' . wp_json_encode($data));
    }

    $resultado = hashtag_portal_decide($data);

    // 2a verificacao: o portal antigo nao conhece a pessoa. Quem comprou apos o
    // inicio da migracao foi direto pro portal novo, sem passar pelo antigo — entao
    // confirmamos no backoffice do portal novo; se nao estiver la, vai pro antigo.
    if ('nao_aluno' === $resultado['portal'] && true === hashtag_portal_verifica_novo($email)) {
        $destinos = hashtag_portal_destinos();
        $resultado = ['portal' => 'novo', 'url' => $destinos['novo']];
    }

    if ('' === $resultado['url']) {
        // Resposta em formato inesperado: loga p/ ajuste e falha suave.
        error_log('[hashtag-portal] schema inesperado p/ ' . $email . ': ' . wp_json_encode($data));
        return new WP_REST_Response(['ok' => false, 'error' => 'schema', 'message' => 'No fue posible identificar tu acceso. Intenta de nuevo.'], 502);
    }

    return new WP_REST_Response([
        'ok'     => true,
        'portal' => $resultado['portal'],
        'url'    => $resultado['url'],
    ], 200);
}

/**
 * 2a verificacao: consulta o backoffice do portal NOVO se o e-mail ja e aluno la.
 * Schema da resposta: { "status":"ok", "data": { "result": true|false } }.
 *
 * @return bool|null  true = aluno no novo; false = nao; null = indeterminado (erro/sem key)
 */
function hashtag_portal_verifica_novo($email)
{
    $key = defined('API_TOKEN_CONSULTA_MIGRACAO_PORTAL_NOVO') ? API_TOKEN_CONSULTA_MIGRACAO_PORTAL_NOVO : '';
    if ('' === $key) {
        error_log('[hashtag-portal] API_TOKEN_CONSULTA_MIGRACAO_PORTAL_NOVO ausente no wp-config.');
        return null;
    }

    $response = wp_remote_post(hashtag_portal_novo_endpoint(), [
        'timeout' => 12,
        'headers' => [
            'X-Api-Key'    => $key,
            'Content-Type' => 'application/json',
            'Accept'       => 'application/json',
        ],
        'body'    => wp_json_encode(['email' => $email]),
    ]);

    if (is_wp_error($response)) {
        error_log('[hashtag-portal] portal novo erro de rede: ' . $response->get_error_message());
        return null;
    }

    $code = (int) wp_remote_retrieve_response_code($response);
    $raw  = wp_remote_retrieve_body($response);
    $body = json_decode($raw, true);

    if ($code < 200 || $code >= 300 || ! is_array($body)) {
        error_log('[hashtag-portal] portal novo code=' . $code . ' body=' . $raw);
        return null;
    }

    if (defined('WP_DEBUG') && WP_DEBUG) {
        error_log('[hashtag-portal] portal novo p/ ' . $email . ': ' . wp_json_encode($body['data'] ?? $body));
    }

    return ! empty($body['data']['result']);
}

/**
 * Resolve o portal de destino a partir do `response` do Bubble.
 *
 * @return array{portal:string,url:string}  portal: 'novo'|'antigo'|'nao_aluno'|''
 */
function hashtag_portal_decide($data)
{
    $destinos = hashtag_portal_destinos();

    // Aluno existente: o campo booleano "migrado" decide o portal.
    if (array_key_exists('migrado', $data)) {
        return hashtag_portal_truthy($data['migrado'])
            ? ['portal' => 'novo',   'url' => $destinos['novo']]
            : ['portal' => 'antigo', 'url' => $destinos['antigo']];
    }

    // Nao e aluno (isUser:false) ou resposta vazia: portal antigo. O handler ainda
    // roda a 2a verificacao (quem comprou ja na nova plataforma vai pro portal novo).
    if (empty($data) || (array_key_exists('isUser', $data) && ! hashtag_portal_truthy($data['isUser']))) {
        return ['portal' => 'nao_aluno', 'url' => $destinos['antigo']];
    }

    // Formato inesperado (o handler loga e responde erro suave).
    return ['portal' => '', 'url' => ''];
}

/** Normaliza valores "verdadeiros" comuns do Bubble (true/yes/1/sim). */
function hashtag_portal_truthy($v)
{
    if (is_bool($v)) {
        return $v;
    }
    if (is_numeric($v)) {
        return (int) $v === 1;
    }
    $v = strtolower(trim((string) $v));
    return in_array($v, ['yes', 'true', '1', 'sim', 'migrado', 'novo'], true);
}
