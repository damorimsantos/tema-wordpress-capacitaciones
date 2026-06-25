<?php
/**
 * Plugin Name: Hashtag — Security Hardening
 * Description: Endurecimento leve do site. Remove o generator do WordPress (version disclosure) sem tocar no functions.php do tema. Carrega cedo como mu-plugin. Porte do hashtag (Capacitaciones nao usa Elementor; o filtro do Elementor fica inerte/resiliente caso seja adicionado).
 * Author:      Hashtag Treinamentos
 * Version:     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
 * Generator / version disclosure
 * ------------------------------
 * Esconde a versao exata do WordPress (e do Elementor, se um dia houver) do HTML
 * e dos feeds para um scanner nao cruzar a versao com CVEs conhecidos.
 */

// WordPress core — tira o generator do <head> e de TODOS os contextos
// (feeds RSS/Atom, export etc.) via o filtro the_generator.
remove_action( 'wp_head', 'wp_generator' );
add_filter( 'the_generator', '__return_empty_string' );

// Elementor — INERTE na Capacitaciones (sem Elementor). Mantido por paridade e
// resiliencia: se o Elementor for instalado, ja suprime o generator dele
// (logica invertida do plugin: option '1' = suprime), sem gravar no banco.
add_filter(
	'option_elementor_meta_generator_tag',
	static function () {
		return '1';
	}
);
