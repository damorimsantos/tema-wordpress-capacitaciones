<?php
/**
 * Plugin Name: Hashtag - Security Headers & CSP (Capacitaciones)
 * Description: Emite os security headers + Content-Security-Policy da Capacitaciones direto no codigo (porte do mu-plugin do hashtag). Cobre Permissions-Policy, COOP/CORP, X-Frame-Options, X-Content-Type-Options, Referrer-Policy, remocao do X-Powered-By, bloqueio de metodos HTTP exoticos (405), DISALLOW_FILE_EDIT e bloqueio de enumeracao de usuario via REST. A CSP comeca em REPORT-ONLY (nao bloqueia) ate validar a allowlist; flip p/ enforce setando HASHTAG_CSP_REPORT_ONLY=false no wp-config. A camada ATIVA (2FA/scan/brute-force/firewall) e do Wordfence (C1.7).
 * Author:      Hashtag Treinamentos
 * Version:     1.0.0
 *
 * Headers emitidos por hooks do WP (send_headers no frontend, admin_init/login_init
 * no backend) — testavel, sem o risco do auto_prepend.
 *
 * CSP: fonte unica versionada no array hashtag_csp_directives(). Allowlist construida
 * por AUDITORIA browser-real (puppeteer) das paginas reais da Cap: GTM/GA/Google Ads,
 * ActiveCampaign (forms), Panda Video (player), YouTube (embeds), Google/Bunny Fonts.
 * Dedup EXATO (array_unique). Para adicionar/remover source: editar o array e subir por
 * SFTP, ou usar o filtro 'hashtag_csp_directives'.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* ----------------------------------------------------------------------------
 * Constantes (sobrescreviveis no wp-config)
 * ------------------------------------------------------------------------- */
if ( ! defined( 'HASHTAG_CSP_ENABLED' ) ) {
	define( 'HASHTAG_CSP_ENABLED', true );
}
// Comeca em report-only (nao bloqueia). Flip p/ enforce: define('HASHTAG_CSP_REPORT_ONLY', false) no wp-config.
if ( ! defined( 'HASHTAG_CSP_REPORT_ONLY' ) ) {
	define( 'HASHTAG_CSP_REPORT_ONLY', true );
}
// CSP no wp-admin: OFF por padrao na Cap (o ACF antigo + Gutenberg gerariam ruido em report-only).
if ( ! defined( 'HASHTAG_CSP_ADMIN' ) ) {
	define( 'HASHTAG_CSP_ADMIN', false );
}
// Endpoint de report (Cloudflare Worker): vazio por ora (sem endpoint dedicado da Cap).
// Em report-only sem endpoint, as violacoes ainda aparecem no console do navegador.
if ( ! defined( 'HASHTAG_CSP_REPORT_ENDPOINT' ) ) {
	define( 'HASHTAG_CSP_REPORT_ENDPOINT', '' );
}
if ( ! defined( 'HASHTAG_CSP_REPORT_GROUP' ) ) {
	define( 'HASHTAG_CSP_REPORT_GROUP', 'csp-endpoint' );
}

/* ----------------------------------------------------------------------------
 * 1) Bloqueio de metodos HTTP exoticos. Pula REST autenticado (nonce) e admin-ajax.
 *    Nunca em wp-cli/cron/CLI (evita exit() que mataria comandos).
 * ------------------------------------------------------------------------- */
( static function () {
	if ( ( defined( 'WP_CLI' ) && WP_CLI ) || 'cli' === PHP_SAPI || ! isset( $_SERVER['REQUEST_METHOD'] ) ) {
		return;
	}
	$uri     = isset( $_SERVER['REQUEST_URI'] ) ? $_SERVER['REQUEST_URI'] : '';
	$is_rest = ( strpos( $uri, 'wp-json/' ) !== false || strpos( $uri, 'rest_route=' ) !== false ) && isset( $_SERVER['HTTP_X_WP_NONCE'] );
	$is_rest = $is_rest || strpos( $uri, 'admin-ajax.php' ) !== false;
	if ( $is_rest ) {
		return;
	}
	$method = isset( $_SERVER['REQUEST_METHOD'] ) ? $_SERVER['REQUEST_METHOD'] : '';
	if ( ! in_array( $method, array( 'GET', 'POST', 'HEAD', 'OPTIONS' ), true ) ) {
		$proto = isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.1';
		header( $proto . ' 405 Method Not Allowed', true, 405 );
		exit;
	}
} )();

/* ----------------------------------------------------------------------------
 * 2) Desabilita o editor de arquivos do admin
 * ------------------------------------------------------------------------- */
if ( ! defined( 'DISALLOW_FILE_EDIT' ) ) {
	define( 'DISALLOW_FILE_EDIT', true );
}

/* ----------------------------------------------------------------------------
 * 3) CSP - fonte unica versionada + compilacao com dedup EXATO
 *    Allowlist da Capacitaciones (auditoria browser-real 2026-06-25).
 * ------------------------------------------------------------------------- */
function hashtag_csp_directives() {
	$directives = array(
		'default-src' => array(
			"'self'",
		),
		'script-src' => array(
			"'self'",
			"'unsafe-inline'",
			"'unsafe-eval'",
			"blob:",
			"https://www.googletagmanager.com",
			"https://www.google-analytics.com",
			"https://googleads.g.doubleclick.net",
			"https://static.doubleclick.net",
			"https://www.googleadservices.com",
			"https://www.google.com",
			"https://www.gstatic.com",
			"https://www.youtube.com",
			"https://player-vz-4f008646-5e1.tv.pandavideo.com.br",
			"https://hashtagtreinamentos.activehosted.com",
			"https://connect.facebook.net",
			"https://client.crisp.chat",
		),
		'script-src-elem' => array(
			"'self'",
			"'unsafe-inline'",
			"blob:",
			"https://www.googletagmanager.com",
			"https://www.google-analytics.com",
			"https://googleads.g.doubleclick.net",
			"https://static.doubleclick.net",
			"https://www.googleadservices.com",
			"https://www.google.com",
			"https://www.gstatic.com",
			"https://www.youtube.com",
			"https://player-vz-4f008646-5e1.tv.pandavideo.com.br",
			"https://hashtagtreinamentos.activehosted.com",
			"https://connect.facebook.net",
			"https://client.crisp.chat",
		),
		'style-src' => array(
			"'self'",
			"'unsafe-inline'",
			"https://fonts.googleapis.com",
			"https://fonts.bunny.net",
			"https://www.youtube.com",
			"https://player-vz-4f008646-5e1.tv.pandavideo.com.br",
			"https://client.crisp.chat",
		),
		'style-src-elem' => array(
			"'self'",
			"'unsafe-inline'",
			"https://fonts.googleapis.com",
			"https://fonts.bunny.net",
			"https://www.youtube.com",
			"https://player-vz-4f008646-5e1.tv.pandavideo.com.br",
			"https://client.crisp.chat",
		),
		'font-src' => array(
			"'self'",
			"data:",
			"https://fonts.gstatic.com",
			"https://fonts.bunny.net",
			"https://client.crisp.chat",
		),
		'img-src' => array(
			"'self'",
			"data:",
			"blob:",
			"https://i.ytimg.com",
			"https://img.youtube.com",
			"https://www.youtube.com",
			"https://thumbs.tv.pandavideo.com.br",
			"https://player-vz-4f008646-5e1.tv.pandavideo.com.br",
			"https://cdn.pandavideo.com",
			"https://client.crisp.chat",
			"https://image.crisp.chat",
			"https://cdn.prod.website-files.com",
			"https://daks2k3a4ib2z.cloudfront.net",
			"https://www.googletagmanager.com",
			"https://www.google-analytics.com",
			"https://stats.g.doubleclick.net",
			"https://googleads.g.doubleclick.net",
			"https://www.google.com",
			"https://www.google.com.br",
			"https://www.google.com.mx",
			"https://www.google.com.co",
			"https://www.google.com.ar",
			"https://www.google.com.pe",
			"https://www.google.cl",
			"https://www.gstatic.com",
			"https://secure.gravatar.com",
			"https://s.w.org",
			"https://ts.w.org",
			"https://ps.w.org",
		),
		'connect-src' => array(
			"'self'",
			"data:",
			"https://www.google-analytics.com",
			"https://region1.analytics.google.com",
			"https://analytics.google.com",
			"https://googleads.g.doubleclick.net",
			"https://stats.g.doubleclick.net",
			"https://www.googletagmanager.com",
			"https://jnn-pa.googleapis.com",
			"https://www.google.com",
			"https://www.youtube.com",
			"https://b-vz-4f008646-5e1.tv.pandavideo.com.br",
			"https://config.tv.pandavideo.com.br",
			"https://hit-video.pandavideo.com:6443",
			"https://cdn.pandavideo.com",
			"https://player-vz-4f008646-5e1.tv.pandavideo.com.br",
			"https://client.crisp.chat",
			"wss://client.relay.crisp.chat",
			"wss://client.relay.rescue.crisp.chat",
		),
		'frame-src' => array(
			"'self'",
			"blob:",
			"https://www.youtube.com",
			"https://www.youtube-nocookie.com",
			"https://player-vz-4f008646-5e1.tv.pandavideo.com.br",
			"https://www.googletagmanager.com",
			"https://td.doubleclick.net",
		),
		'media-src' => array(
			"'self'",
			"data:",
			"blob:",
			"https://b-vz-4f008646-5e1.tv.pandavideo.com.br",
			"https://cdn.pandavideo.com",
		),
		'frame-ancestors' => array(
			"'self'",
		),
		'upgrade-insecure-requests' => array(),
	);

	return apply_filters( 'hashtag_csp_directives', $directives );
}

function hashtag_csp_build() {
	$directives = hashtag_csp_directives();
	if ( empty( $directives ) ) {
		return '';
	}

	$parts = array();
	foreach ( $directives as $name => $sources ) {
		$sources = array_values( array_unique( array_filter( (array) $sources, 'strlen' ) ) );
		$parts[] = empty( $sources ) ? $name : $name . ' ' . implode( ' ', $sources );
	}
	$csp = implode( '; ', $parts );

	$endpoint = HASHTAG_CSP_REPORT_ENDPOINT;
	if ( $endpoint && filter_var( $endpoint, FILTER_VALIDATE_URL ) ) {
		$csp .= '; report-uri ' . $endpoint . '; report-to ' . HASHTAG_CSP_REPORT_GROUP;
	}

	return $csp;
}

/* ----------------------------------------------------------------------------
 * 4) Emissao dos headers (estaticos + CSP)
 * ------------------------------------------------------------------------- */
function hashtag_security_headers_emit() {
	static $done = false;
	if ( $done || headers_sent() ) {
		return;
	}
	$done = true;

	header( 'X-Content-Type-Options: nosniff' );
	header( 'X-XSS-Protection: 0' );
	header( 'Referrer-Policy: strict-origin-when-cross-origin' );
	header( 'X-Frame-Options: SAMEORIGIN' );
	header( 'Cross-Origin-Opener-Policy: same-origin-allow-popups' );
	header( 'Cross-Origin-Resource-Policy: cross-origin' );
	header( 'Permissions-Policy: accelerometer=(), autoplay=(*), camera=(), encrypted-media=(*), fullscreen=(*), geolocation=(*), microphone=(), midi=(), payment=(), display-capture=(*)' );

	if ( function_exists( 'header_remove' ) ) {
		header_remove( 'X-Powered-By' );
	}

	$emit_csp = HASHTAG_CSP_ENABLED && ( ! is_admin() || HASHTAG_CSP_ADMIN );
	if ( ! $emit_csp ) {
		return;
	}

	$csp = hashtag_csp_build();
	if ( ! $csp ) {
		return;
	}
	$header_name = HASHTAG_CSP_REPORT_ONLY ? 'Content-Security-Policy-Report-Only' : 'Content-Security-Policy';
	header( $header_name . ': ' . $csp );

	$endpoint = HASHTAG_CSP_REPORT_ENDPOINT;
	if ( $endpoint && filter_var( $endpoint, FILTER_VALIDATE_URL ) ) {
		$report_to = wp_json_encode(
			array(
				'group'              => HASHTAG_CSP_REPORT_GROUP,
				'max_age'            => 10886400,
				'endpoints'          => array( array( 'url' => $endpoint ) ),
				'include_subdomains' => false,
			)
		);
		if ( $report_to ) {
			header( 'Report-To: ' . $report_to, false );
		}
		header( sprintf( 'Reporting-Endpoints: %s="%s"', HASHTAG_CSP_REPORT_GROUP, $endpoint ), false );
	}
}
add_action( 'send_headers', 'hashtag_security_headers_emit' );
add_action( 'login_init', 'hashtag_security_headers_emit' );
add_action( 'admin_init', 'hashtag_security_headers_emit' );

/* ----------------------------------------------------------------------------
 * 5) Hardening: bloqueio de enumeracao de usuario via REST (/wp/v2/users)
 *    para visitantes nao autenticados.
 * ------------------------------------------------------------------------- */
add_filter(
	'rest_endpoints',
	static function ( $endpoints ) {
		if ( is_user_logged_in() ) {
			return $endpoints;
		}
		foreach ( array( '/wp/v2/users', '/wp/v2/users/(?P<id>[\d]+)' ) as $route ) {
			if ( isset( $endpoints[ $route ] ) ) {
				unset( $endpoints[ $route ] );
			}
		}
		return $endpoints;
	}
);
