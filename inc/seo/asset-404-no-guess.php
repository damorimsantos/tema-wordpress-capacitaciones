<?php
/**
 * Faz ASSET ESTATICO inexistente devolver 404 limpo, em vez de 301 para uma pagina.
 * Porte do hashtag.
 *
 * Causa-raiz: o WP Rocket serve CSS/JS minificados em /wp-content/cache/min/1/... com
 * HASH de conteudo no nome; o hash muda a cada purge. Crawler le o HTML com o hash
 * vigente, busca o asset depois do purge -> arquivo ausente -> 404 -> o core
 * `redirect_guess_404_permalink` (em redirect_canonical @10) casa por LIKE e emite 301
 * pra uma pagina parecida. Resultado: cluster de "JS/CSS redirected" no Ahrefs.
 *
 * Solucao (cirurgica, so ASSET): intercepta template_redirect @4 (depois do
 * lowercase @1, antes do redirect_canonical @10). Em 404 cujo path aparenta arquivo
 * estatico (sob /wp-content/ ou com extensao de asset) -> 404 limpo + exit. Slug de
 * pagina (sem extensao) NAO e tocado (o palpite de typo /curso-pythn->/curso-python segue).
 *
 * @package Hashtag
 */

defined( 'ABSPATH' ) || exit;

add_action( 'template_redirect', 'hashtag_serve_clean_404_for_missing_assets', 4 );

function hashtag_serve_clean_404_for_missing_assets() {
	if ( ! is_404() ) {
		return;
	}

	if ( empty( $_SERVER['REQUEST_URI'] ) ) {
		return;
	}

	$uri  = wp_unslash( $_SERVER['REQUEST_URI'] );
	$qpos = strpos( $uri, '?' );
	$path = ( false !== $qpos ) ? substr( $uri, 0, $qpos ) : $uri;

	if ( ! hashtag_request_path_is_static_asset( $path ) ) {
		return;
	}

	status_header( 404 );
	nocache_headers();
	exit;
}

/**
 * Heuristica: o path parece um arquivo estatico (nao uma pagina)?
 *
 * @param string $path Path da requisicao (sem query string).
 * @return bool
 */
function hashtag_request_path_is_static_asset( $path ) {
	if ( ! is_string( $path ) || '' === $path ) {
		return false;
	}

	// Tudo sob /wp-content/ e arquivo (uploads/plugins/themes + cache/min do Rocket).
	if ( false !== stripos( $path, '/wp-content/' ) ) {
		return true;
	}

	return (bool) preg_match(
		'/\.(?:js|mjs|css|map|json|xml|txt|png|jpe?g|gif|svg|webp|avif|ico|bmp|woff2?|ttf|otf|eot|mp4|webm|pdf|zip)$/i',
		$path
	);
}
