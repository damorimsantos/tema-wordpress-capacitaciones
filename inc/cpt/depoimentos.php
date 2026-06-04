<?php 

//DEPOIMENTOS

function depoimentos() {
	$labels = array(
		'name'               => _x( 'Depoimentos', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'Depoimento', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'Depoimentos', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'Depoimentos', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Novo', 'depoimento', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Novo Depoimento', 'your-plugin-textdomain' ),
		'new_item'           => __( 'Novo Depoimento', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Editar Depoimento', 'your-plugin-textdomain' ),
		'view_item'          => __( 'Ver Depoimento', 'your-plugin-textdomain' ),
		'all_items'          => __( 'Todos os Depoimentos', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Buscar Depoimento', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent Depoimento:', 'your-plugin-textdomain' ),
		'not_found'          => __( 'Nenhum Depoimento encontrado.', 'your-plugin-textdomain' ),
		'not_found_in_trash' => __( 'No books found in Trash.', 'your-plugin-textdomain' )
	);

	$args = array(
		'labels'             => $labels,
                'description'        => __( 'Descrição.', 'your-plugin-textdomain' ),
		'public'             => false,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'depoimentos' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail' )
	);

	register_post_type( 'depoimentos', $args );
}

add_action( 'init', 'depoimentos' );