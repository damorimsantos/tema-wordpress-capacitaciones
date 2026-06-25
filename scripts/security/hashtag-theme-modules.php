<?php
/**
 * Plugin Name: Hashtag - Theme Modules Loader (Capacitaciones)
 * Description: Carrega os modulos novos do tema (inc/seo, inc/media, inc/perf...) via
 *              after_setup_theme, SEM tocar no functions.php. Motivo: o functions.php de
 *              prod diverge do HEAD (tem o include prod-only ajax/hash_oferta_ia.php e NAO
 *              tem o require do acceso-portal) — deployar o functions.php do HEAD lancaria
 *              o acceso-portal (decisao do Diego). Este loader carrega os modulos de
 *              paridade (SEO/schema/perf) sem esse risco. Mesmo padrao do mu-plugin
 *              hashtag-jornada-inscricao do hashtag (after_setup_theme -> require do tema).
 * Version:     1.0.0
 * Author:      Hashtag Treinamentos
 *
 * after_setup_theme roda DEPOIS do functions.php do tema carregar por completo, entao os
 * helpers do tema ja estao definidos quando os modulos sao requeridos. Cada require tem
 * guard file_exists (deploy SFTP nao-atomico). Reversivel: remover este mu-plugin.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'after_setup_theme', static function () {
	$base = get_template_directory();

	// Ordem importa quando ha dependencia entre modulos (motor antes dos providers).
	$modules = array(
		// Fase 2 — SEO Core
		'/inc/seo/title-tag-support.php',
		'/inc/seo/sitemap-canonical.php',
		'/inc/seo/lowercase-url-redirect.php',
		'/inc/seo/asset-404-no-guess.php',
		'/inc/seo/blog-filter-noindex.php',
	);

	/**
	 * Permite a outras frentes (schema, perf) registrarem modulos sem editar este arquivo.
	 * @param string[] $modules caminhos relativos ao get_template_directory()
	 */
	$modules = apply_filters( 'hashtag_theme_modules', $modules );

	foreach ( $modules as $rel ) {
		$path = $base . $rel;
		if ( file_exists( $path ) ) {
			require_once $path;
		}
	}
}, 9 );
