<?php 

//CURSOS

function cursos() {
	$labels = array(
		'name'               => _x( 'Cursos', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'Curso', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'Cursos', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'Cursos', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Novo Curso', 'local', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Novo Curso', 'your-plugin-textdomain' ),
		'new_item'           => __( 'Novo Curso', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Editar Curso', 'your-plugin-textdomain' ),
		'view_item'          => __( 'Ver Curso', 'your-plugin-textdomain' ),
		'all_items'          => __( 'Todos os Cursos', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Buscar Curso', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent Curso:', 'your-plugin-textdomain' ),
		'not_found'          => __( 'Nenhum Curso Encontrado.', 'your-plugin-textdomain' ),
		'not_found_in_trash' => __( 'Nenhum Curso Encontrado na lixeira.', 'your-plugin-textdomain' )
	);

	$args = array(
		'labels'             => $labels,
                'description'        => __( 'Descrição.', 'your-plugin-textdomain' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'curso' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail' )
	);

	register_post_type( 'cursos', $args );
}

add_action( 'init', 'cursos' );

function categorias() {

  $labels = array(
    'name' => _x( 'Categorias', 'taxonomy general name' ),
    'singular_name' => _x( 'Categoria', 'taxonomy singular name' ),
    'search_items' =>  __( 'Buscar Categorias' ),
    'all_items' => __( 'Todas as Categorias' ),
    'parent_item' => __( 'Parent Categoria' ),
    'parent_item_colon' => __( 'Parent Categoria:' ),
    'edit_item' => __( 'Editar Categoria' ),
    'update_item' => __( 'Atualizar Categoria' ),
    'add_new_item' => __( 'Adicionar Nova Categoria' ),
    'new_item_name' => __( 'Adicionar Nova Categoria' ),
    'menu_name' => __( 'Categorias' ),
  );
  register_taxonomy('categoria',array('cursos'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
      "public" => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'cursos' ),
  ));

}

add_action( 'init', 'categorias', 0 );