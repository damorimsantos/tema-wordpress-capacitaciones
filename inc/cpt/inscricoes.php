<?php

//INSCRICOES

function inscricoes() {
	$labels = array(
		'name'               => _x( 'Inscrições', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'Inscrição', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'Inscrições', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'Inscrições', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Nova Inscrição', 'local', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Nova Inscrição', 'your-plugin-textdomain' ),
		'new_item'           => __( 'Nova Inscrição', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Editar Inscrição', 'your-plugin-textdomain' ),
		'view_item'          => __( 'Ver Inscrição', 'your-plugin-textdomain' ),
		'all_items'          => __( 'Todas as Inscrições', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Buscar Inscrição', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent Inscrição:', 'your-plugin-textdomain' ),
		'not_found'          => __( 'Nenhum Inscrição Encontrado.', 'your-plugin-textdomain' ),
		'not_found_in_trash' => __( 'Nenhum Inscrição Encontrado na lixeira.', 'your-plugin-textdomain' )
	);

	$args = array(
		'labels'             => $labels,
                'description'        => __( 'Descrição.', 'your-plugin-textdomain' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'inscricoes' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail' )
	);

	register_post_type( 'inscricoes', $args );
}

add_action( 'init', 'inscricoes' );
