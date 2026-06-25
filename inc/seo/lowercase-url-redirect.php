<?php
/**
 * Redirecionamento canonico de URLs para minusculas (lowercase). Porte do hashtag.
 *
 * GOTCHA CRITICO: roda em 'template_redirect' (NUNCA 'init'). Em 'init' a constante
 * REST_REQUEST ainda nao existe, entao nao da pra excluir o REST -> forcaria lowercase
 * nas rotas camelCase do Rank Math (ex.: /wp-json/rankmath/v1/.../getViewData) e o 301
 * troca POST->GET -> rest_no_route (404), derrubando o painel do RM (Status & Tools,
 * Redirects, nota de SEO). template_redirect NAO dispara em REST/admin/ajax/cron.
 *
 * - So o PATH e normalizado; query string preservada (case pode ser significativo:
 *   tokens, base64, UTM). Sequencias percent-encoded (%XX) nao tem o case alterado.
 * - Paths que aparentam arquivo (contem ".") nao sao alterados (filesystem case-sensitive).
 * - So GET/HEAD. wp_safe_redirect() (sanitiza destino, impede open redirect).
 *
 * @package Hashtag
 */

defined( 'ABSPATH' ) || exit;

add_action( 'template_redirect', 'hashtag_force_lowercase_url_redirect', 1 );

function hashtag_force_lowercase_url_redirect() {
	if (
		is_admin()
		|| wp_doing_ajax()
		|| wp_doing_cron()
		|| ( defined( 'REST_REQUEST' ) && REST_REQUEST )
	) {
		return;
	}

	$method = isset( $_SERVER['REQUEST_METHOD'] )
		? strtoupper( sanitize_text_field( wp_unslash( $_SERVER['REQUEST_METHOD'] ) ) )
		: 'GET';
	if ( 'GET' !== $method && 'HEAD' !== $method ) {
		return;
	}

	if ( empty( $_SERVER['REQUEST_URI'] ) ) {
		return;
	}

	$request_uri = wp_unslash( $_SERVER['REQUEST_URI'] );
	$location    = hashtag_compute_lowercase_redirect( $request_uri );

	if ( null === $location ) {
		return;
	}

	wp_safe_redirect( $location, 301 );
	exit;
}

/**
 * Calcula o destino lowercase para um REQUEST_URI, ou null se nao ha redirect.
 * Funcao pura (testavel).
 *
 * @param string $request_uri Valor cru de $_SERVER['REQUEST_URI'] (path + query).
 * @return string|null
 */
function hashtag_compute_lowercase_redirect( $request_uri ) {
	if ( ! is_string( $request_uri ) || '' === $request_uri ) {
		return null;
	}

	// Nunca tocar nas rotas da REST API.
	if (
		false !== stripos( $request_uri, '/wp-json/' )
		|| false !== stripos( $request_uri, 'rest_route=' )
	) {
		return null;
	}

	$path  = $request_uri;
	$query = '';
	$qpos  = strpos( $request_uri, '?' );
	if ( false !== $qpos ) {
		$path  = substr( $request_uri, 0, $qpos );
		$query = substr( $request_uri, $qpos + 1 );
	}

	// Paths que aparentam arquivo (contem ".") nao sao alterados.
	if ( false !== strpos( $path, '.' ) ) {
		return null;
	}

	if ( ! preg_match( '/[A-Z]/', $path ) ) {
		return null;
	}

	// Lowercase preservando o case das sequencias percent-encoded.
	$lc_path = preg_replace_callback(
		'/%[0-9A-Fa-f]{2}|[A-Z]+/',
		static function ( $matches ) {
			return '%' === $matches[0][0] ? $matches[0] : strtolower( $matches[0] );
		},
		$path
	);

	if ( null === $lc_path || $lc_path === $path ) {
		return null;
	}

	return $lc_path . ( '' !== $query ? '?' . $query : '' );
}
