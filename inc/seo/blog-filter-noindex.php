<?php
/**
 * Marca como noindex as VIEWS FILTRADAS da pagina do blog (/blog?s=, ?categoria=).
 * Porte do hashtag, adaptado aos params do index.php da Cap.
 *
 * Causa-raiz (soft 404 no GSC): /blog e a posts page (is_home()), servida por index.php,
 * que le os filtros por query (?s= busca, ?categoria= categoria). Sem resultado renderiza
 * "Nenhum post encontrado" com HTTP 200 + meta robots index -> o Google marca soft 404.
 * E mesmo com resultado, a view filtrada e subconjunto de /blog (conteudo duplicado),
 * sem valor proprio de indice.
 *
 * Solucao: filtro rank_math/frontend/robots forca noindex quando ha param de filtro/busca
 * na posts page. /blog limpa segue index. (A Cap NAO tem filtro ?autor — so s/categoria.)
 *
 * @package Hashtag
 */

defined( 'ABSPATH' ) || exit;

add_filter( 'rank_math/frontend/robots', 'hashtag_noindex_blog_filtered_views', 20 );

/**
 * @param array $robots Diretivas do Rank Math (chaves 'index'/'follow').
 * @return array
 */
function hashtag_noindex_blog_filtered_views( $robots ) {
	if ( ! is_home() && ! is_page( 'blog' ) ) {
		return $robots;
	}

	if ( isset( $_GET['s'] ) || isset( $_GET['categoria'] ) ) {
		$robots['index'] = 'noindex';
	}

	return $robots;
}
