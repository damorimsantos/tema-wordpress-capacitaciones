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
		// Fonte unica de numeros (answer-first/llms/schema). Carregar primeiro.
		'/inc/hashtag-stats.php',
		// Fase 2 — SEO Core
		'/inc/seo/title-tag-support.php',
		'/inc/seo/sitemap-canonical.php',
		'/inc/seo/lowercase-url-redirect.php',
		'/inc/seo/asset-404-no-guess.php',
		'/inc/seo/blog-filter-noindex.php',
		// Fase 3 — Schema (grafo nativo). schema-graph PRIMEIRO (define register +
		// neutraliza RM), depois entities/providers. (schema-course depende do catalogo
		// -> carregado DEPOIS de inc/cursos/, no fim desta lista.)
		'/inc/seo/schema/schema-graph.php',
		'/inc/seo/schema/schema-entities.php',
		'/inc/seo/schema/schema-post.php',
		// Fase 5 — Performance: substituicao do WP Rocket (trata site-wide na Cap).
		'/inc/perf/wp-rocket-replacement.php',
		// Fase 5 — Performance: perf do post de blog (single 'post'). Defer do embed
		// ActiveCampaign (INP) + strip do css2 render-blocking + dequeue Roboto.
		// Definir hashtag_is_post_perf() aqui faz o wp-rocket-replacement excluir o
		// post do tratamento generico (por design) -> este modulo repoe o dns-prefetch.
		'/inc/perf/post-perf.php',
		// Fase 5 — Otimizador de imagens nativo (substitui Imagify; paridade com o
		// hashtag -> AVIF OFF/WebP-only/alpha-safe). Gera irmaos .webp no upload +
		// entrega <picture> no the_content. Autocontido (sem dep de outros modulos).
		'/inc/media/image-optimizer.php',
		// Fase 6 — Catalogo single-source dos cursos (C6.2). Engine (define a classe +
		// le o data file via __DIR__) ANTES dos template-tags (wrappers globais).
		// Hoje so a camada de DADOS e consumida (schema-course C3.4 / llms / answer-first);
		// os renderers ficam dormentes ate o wiring visual (C6.3, Regra 0).
		'/inc/cursos/course-catalog.php',
		'/inc/cursos/template-tags.php',
		// Fase 3 — Course schema (C3.4). DEPOIS do catalogo (consome Hashtag_Course_Catalog)
		// e de schema-graph (usa hashtag_schema_register). So o curso visivel (Excel) recebe
		// Course; a oferta do Excel e a home -> o no sai na front-page.
		'/inc/seo/schema/schema-course.php',
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
