<?php

if ( ! defined( '_S_VERSION' ) ) {
	define( '_S_VERSION', '1.0.0' );
}


function cenzor_setup() {

	load_theme_textdomain( 'cenzor', get_template_directory() . '/languages' );

	add_theme_support( 'title-tag' );

	add_theme_support( 'post-thumbnails' );

	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'cenzor' ),
		)
	);

	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);
	
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'cenzor_setup' );


function cenzor_scripts() {
	wp_enqueue_style( 'cenzor-google-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap', array(), null );
	wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0' );
	wp_enqueue_style( 'swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', array(), '11.0.0' );
	
	wp_enqueue_style( 'cenzor-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'cenzor-style', 'rtl', 'replace' );

	wp_enqueue_script( 'swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), '11.0.0', true );
	wp_enqueue_script( 'cenzor-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'cenzor-professions', get_template_directory_uri() . '/js/professions.js', array( 'swiper' ), _S_VERSION, true );
	wp_enqueue_script( 'cenzor-professions-tabs', get_template_directory_uri() . '/js/professions-tabs.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'cenzor_scripts' );


require get_template_directory() . '/inc/custom-header.php';

require get_template_directory() . '/inc/template-tags.php';


require get_template_directory() . '/inc/template-functions.php';


require get_template_directory() . '/inc/customizer.php';

if ( function_exists( 'acf_add_local_field_group' ) ) {
	require get_template_directory() . '/inc/acf-fields.php';
}

if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

function cenzor_register_profession_post_type() {
	$labels = array(
		'name'                  => 'Профессии',
		'singular_name'         => 'Профессия',
		'menu_name'             => 'Профессии',
		'add_new'               => 'Добавить новую',
		'add_new_item'          => 'Добавить новую профессию',
		'edit_item'             => 'Редактировать профессию',
		'new_item'              => 'Новая профессия',
		'view_item'             => 'Просмотреть профессию',
		'search_items'          => 'Искать профессии',
		'not_found'             => 'Профессии не найдены',
		'not_found_in_trash'    => 'В корзине профессий не найдено',
	);

	$args = array(
		'label'                 => 'Профессии',
		'labels'                => $labels,
		'supports'              => array( 'title', 'thumbnail', 'editor', 'page-attributes' ),
		'hierarchical'          => true,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 20,
		'menu_icon'             => 'dashicons-groups',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'show_in_rest'          => true,
	);

	register_post_type( 'profession', $args );
}
add_action( 'init', 'cenzor_register_profession_post_type', 0 );

