<?php
/**
 * Suporte nativo a <title> via title-tag (Capacitaciones). Porte da regra do hashtag.
 *
 * O tema-fork tinha <title><?php wp_title('|', true, 'right'); ?></title> manual em
 * varios templates (index/front-page/single/curso-excel-gratis) E chamava wp_head().
 * Sem title-tag support o wp_head nao emitia <title>, entao nao havia DUPLICATA, mas o
 * wp_title() do RM devolvia "%title% - %sitename%" -> a home saia "Hashtag Capacitaciones
 * - Hashtag Capacitaciones" (marca dobrada).
 *
 * Solucao (regra firme do hashtag): add_theme_support('title-tag') + remover o <title>
 * manual dos templates. Assim o wp_head() emite o <title> e o Rank Math o sobrescreve
 * via pre_get_document_title -> 1 title limpo, controlado 100% pelo RM.
 *
 * Carregado pelo mu-plugin loader em after_setup_theme (sem tocar functions.php).
 *
 * @package Hashtag
 */

defined( 'ABSPATH' ) || exit;

// after_setup_theme ja esta em curso quando o loader requer este arquivo.
add_theme_support( 'title-tag' );
