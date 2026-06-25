<?php
/**
 * Endurecimento compartilhado dos endpoints REST publicos (Capacitaciones).
 * Hoje cobre /wp-json/hashtag/v1/consulta-portal (oraculo de enumeracao de alunos
 * + queima de quota Bubble/LMS). Porte do hashtag (tema-agnostico).
 *
 * Camadas: Origin/Referer ESTRITO (rejeita AUSENCIA, nao so divergencia),
 * rate-limit por IP em janela dupla (minuto + hora), verificacao Cloudflare
 * Turnstile (anti-bot, INERTE ate ter secret) e log de abuso grep-avel.
 *
 * Carregado por require_once com guard file_exists; call-sites com fallback
 * function_exists. As funcoes rodam em tempo de request.
 *
 * TURNSTILE E INERTE ate HASHTAG_TURNSTILE_SECRET no wp-config:
 * hashtag_turnstile_verify() devolve true e nada e bloqueado.
 *
 * @package Hashtag
 */

if (! defined('ABSPATH')) {
    exit;
}

if (! function_exists('hashtag_sec_reject_bad_origin')) {
    /**
     * Origin/Referer obrigatorio E dentro da allowlist. AUSENCIA tambem e
     * rejeitada (navegador real sempre manda Origin em POST fetch/XHR; curl/bot
     * que omitem o header — o vetor de enumeracao/injecao — sao barrados aqui).
     *
     * @return WP_REST_Response|null  403 para barrar, ou null p/ seguir
     */
    function hashtag_sec_reject_bad_origin(WP_REST_Request $request, array $allowed_hosts)
    {
        $source = $request->get_header('origin');
        if (! $source) {
            $source = $request->get_header('referer');
        }

        $host = $source ? strtolower((string) wp_parse_url($source, PHP_URL_HOST)) : '';
        $allowed = array_map('strtolower', $allowed_hosts);

        if ('' === $host || ! in_array($host, $allowed, true)) {
            return new WP_REST_Response(['ok' => false, 'error' => 'origin'], 403);
        }

        return null;
    }
}

if (! function_exists('hashtag_sec_rate_limit')) {
    /**
     * Rate-limit por IP em janela dupla (curto + longo). Conta toda tentativa.
     * CF-Connecting-IP da o IP real (granular mesmo atras da Cloudflare).
     *
     * @return WP_REST_Response|null  429 quando estoura, ou null
     */
    function hashtag_sec_rate_limit($prefix, $ip, $per_minute, $per_hour)
    {
        if (! $ip) {
            return null;
        }

        $m_key = $prefix . '_m_' . md5($ip);
        $h_key = $prefix . '_h_' . md5($ip);

        $m = (int) get_transient($m_key);
        $h = (int) get_transient($h_key);

        if ($m >= $per_minute || $h >= $per_hour) {
            return new WP_REST_Response([
                'ok'      => false,
                'error'   => 'rate',
                'message' => 'Demasiados intentos. Espera unos instantes e intenta de nuevo.',
            ], 429);
        }

        set_transient($m_key, $m + 1, MINUTE_IN_SECONDS);
        set_transient($h_key, $h + 1, HOUR_IN_SECONDS);

        return null;
    }
}

if (! function_exists('hashtag_turnstile_enabled')) {
    /** Turnstile esta configurado? (secret presente no wp-config) */
    function hashtag_turnstile_enabled()
    {
        return defined('HASHTAG_TURNSTILE_SECRET') && '' !== trim((string) HASHTAG_TURNSTILE_SECRET);
    }
}

if (! function_exists('hashtag_turnstile_sitekey')) {
    /** Site key publica (vai no front). '' se nao configurada. */
    function hashtag_turnstile_sitekey()
    {
        $key = defined('HASHTAG_TURNSTILE_SITEKEY') ? trim((string) HASHTAG_TURNSTILE_SITEKEY) : '';
        return apply_filters('hashtag_turnstile_sitekey', $key);
    }
}

if (! function_exists('hashtag_turnstile_verify')) {
    /**
     * Valida o token do Turnstile no siteverify da Cloudflare.
     *
     * INERTE quando nao configurado: devolve true (nao bloqueia). Fail-OPEN em
     * erro de rede do siteverify (nao derruba usuario legitimo por falha de infra;
     * origin + honeypot + rate-limit seguem ativos). Token vazio com Turnstile
     * ligado = bloqueio (false).
     *
     * @return bool  true = ok/inerte; false = desafio falhou
     */
    function hashtag_turnstile_verify($token, $ip)
    {
        if (! hashtag_turnstile_enabled()) {
            return true; // inerte ate configurar o secret
        }

        $token = trim((string) $token);
        if ('' === $token) {
            return false;
        }

        $resp = wp_remote_post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
            'timeout' => 8,
            'body'    => [
                'secret'   => HASHTAG_TURNSTILE_SECRET,
                'response' => $token,
                'remoteip' => $ip,
            ],
        ]);

        if (is_wp_error($resp)) {
            error_log('[hashtag-sec] turnstile siteverify erro de rede: ' . $resp->get_error_message());
            return true; // fail-open em falha de infra
        }

        $body = json_decode(wp_remote_retrieve_body($resp), true);

        return is_array($body) && ! empty($body['success']);
    }
}

if (! function_exists('hashtag_sec_log_block')) {
    /**
     * Log estruturado de bloqueio (grep-avel: "[hashtag-sec] BLOCK").
     * Dispara o gancho hashtag_sec_abuse p/ alerta externo opcional.
     */
    function hashtag_sec_log_block($endpoint, $reason, $ip, $extra = '')
    {
        error_log(sprintf(
            '[hashtag-sec] BLOCK endpoint=%s reason=%s ip=%s %s',
            $endpoint,
            $reason,
            $ip ?: '-',
            $extra
        ));

        do_action('hashtag_sec_abuse', $endpoint, $reason, $ip, $extra);
    }
}
