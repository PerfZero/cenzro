<?php

if ( ! defined( '_S_VERSION' ) ) {
	define( '_S_VERSION', '1.2.0' );
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
	wp_enqueue_style( 'cenzor-montserrat', get_template_directory_uri() . '/assets/css/montserrat.css', array(), _S_VERSION );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', array(), '6.4.0' );
	wp_enqueue_style( 'swiper', get_template_directory_uri() . '/assets/css/swiper-bundle.min.css', array(), '11.0.0' );
	wp_enqueue_style( 'glightbox', get_template_directory_uri() . '/assets/css/glightbox.min.css', array(), '3.2.0' );
	wp_enqueue_style( 'bvi', get_template_directory_uri() . '/button-visually-impaired-javascript-master/dist/css/bvi.min.css', array(), '1.0.0' );
	
	wp_enqueue_style( 'cenzor-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'cenzor-style', 'rtl', 'replace' );

	wp_enqueue_script( 'swiper', get_template_directory_uri() . '/assets/js/swiper-bundle.min.js', array(), '11.0.0', true );
	wp_enqueue_script( 'glightbox', get_template_directory_uri() . '/assets/js/glightbox.min.js', array(), '3.2.0', true );
	wp_enqueue_script( 'bvi', get_template_directory_uri() . '/button-visually-impaired-javascript-master/dist/js/bvi.min.js', array(), '1.0.0', true );
	wp_enqueue_script( 'cenzor-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'cenzor-professions', get_template_directory_uri() . '/js/professions.js', array( 'swiper', 'glightbox' ), _S_VERSION, true );
	wp_enqueue_script( 'cenzor-professions-tabs', get_template_directory_uri() . '/js/professions-tabs.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'cenzor-modal', get_template_directory_uri() . '/js/modal.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'cenzor-search-popup', get_template_directory_uri() . '/js/search-popup.js', array(), _S_VERSION, true );

	if ( is_singular( 'profession' ) ) {
		wp_enqueue_script( 'cenzor-profession-single-tabs', get_template_directory_uri() . '/js/profession-single-tabs.js', array(), _S_VERSION, true );
	}

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

function cenzor_register_profession_badges_taxonomy() {
	$labels = array(
		'name'              => 'Метки',
		'singular_name'     => 'Метка',
		'search_items'      => 'Искать метки',
		'all_items'         => 'Все метки',
		'edit_item'         => 'Редактировать метку',
		'update_item'       => 'Обновить метку',
		'add_new_item'      => 'Добавить новую метку',
		'new_item_name'     => 'Новое имя метки',
		'menu_name'         => 'Метки',
	);

	$args = array(
		'hierarchical'      => false,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'profession-badge' ),
		'show_in_rest'      => true,
	);

	register_taxonomy( 'profession_badge', array( 'profession' ), $args );
}
add_action( 'init', 'cenzor_register_profession_badges_taxonomy', 0 );

function cenzor_register_certificate_post_type() {
	$labels = array(
		'name'                  => 'Сертификаты',
		'singular_name'         => 'Сертификат',
		'menu_name'             => 'Сертификаты',
		'add_new'               => 'Добавить новый',
		'add_new_item'          => 'Добавить новый сертификат',
		'edit_item'             => 'Редактировать сертификат',
		'new_item'              => 'Новый сертификат',
		'view_item'             => 'Просмотреть сертификат',
		'search_items'          => 'Искать сертификаты',
		'not_found'             => 'Сертификаты не найдены',
		'not_found_in_trash'    => 'В корзине сертификатов не найдено',
	);

	$args = array(
		'label'                 => 'Сертификаты',
		'labels'                => $labels,
		'supports'              => array( 'title', 'thumbnail' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 21,
		'menu_icon'             => 'dashicons-awards',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => false,
		'can_export'            => true,
		'has_archive'            => false,
		'exclude_from_search'   => true,
		'publicly_queryable'    => false,
		'capability_type'       => 'post',
		'show_in_rest'          => true,
	);

	register_post_type( 'certificate', $args );
}
add_action( 'init', 'cenzor_register_certificate_post_type', 0 );

function cenzor_register_partner_post_type() {
	$labels = array(
		'name'                  => 'Партнеры',
		'singular_name'         => 'Партнер',
		'menu_name'             => 'Партнеры',
		'add_new'               => 'Добавить нового',
		'add_new_item'          => 'Добавить нового партнера',
		'edit_item'             => 'Редактировать партнера',
		'new_item'              => 'Новый партнер',
		'view_item'             => 'Просмотреть партнера',
		'search_items'          => 'Искать партнеров',
		'not_found'             => 'Партнеры не найдены',
		'not_found_in_trash'    => 'В корзине партнеров не найдено',
	);

	$args = array(
		'label'                 => 'Партнеры',
		'labels'                => $labels,
		'supports'              => array( 'title', 'thumbnail', 'page-attributes' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 22,
		'menu_icon'             => 'dashicons-groups',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => false,
		'can_export'            => true,
		'has_archive'            => false,
		'exclude_from_search'   => true,
		'publicly_queryable'    => false,
		'capability_type'       => 'post',
		'show_in_rest'          => true,
	);

	register_post_type( 'partner', $args );
}
add_action( 'init', 'cenzor_register_partner_post_type', 0 );

function cenzor_register_teacher_post_type() {
	$labels = array(
		'name'                  => 'Преподаватели',
		'singular_name'         => 'Преподаватель',
		'menu_name'             => 'Преподаватели',
		'add_new'               => 'Добавить нового',
		'add_new_item'          => 'Добавить нового преподавателя',
		'edit_item'             => 'Редактировать преподавателя',
		'new_item'              => 'Новый преподаватель',
		'view_item'             => 'Просмотреть преподавателя',
		'search_items'          => 'Искать преподавателей',
		'not_found'             => 'Преподаватели не найдены',
		'not_found_in_trash'    => 'В корзине преподавателей не найдено',
	);

	$args = array(
		'label'                 => 'Преподаватели',
		'labels'                => $labels,
		'supports'              => array( 'title', 'thumbnail', 'editor', 'page-attributes' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 23,
		'menu_icon'             => 'dashicons-businessperson',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => false,
		'can_export'            => true,
		'has_archive'            => false,
		'exclude_from_search'   => true,
		'publicly_queryable'    => false,
		'capability_type'       => 'post',
		'show_in_rest'          => true,
	);

	register_post_type( 'teacher', $args );
}
add_action( 'init', 'cenzor_register_teacher_post_type', 0 );

function cenzor_widgets_init() {
	register_sidebar( array(
		'name'          => 'Яндекс отзывы',
		'id'            => 'yandex-reviews',
		'description'   => 'Область для виджета Яндекс отзывы',
		'before_widget' => '<div class="yandex-reviews-widget">',
		'after_widget'  => '</div>',
		'before_title'  => '',
		'after_title'   => '',
	) );
}
add_action( 'widgets_init', 'cenzor_widgets_init' );

function cenzor_generate_professions() {
	$professions = array(
		'Транспортная безопасность',
		'Экологическая безопасность',
		'Работник охраны образовательных организаций',
		'Гражданская оборона',
		'ГО и ЧС',
		'ДОПОГ',
		'Обучение на спецсигналы для водителей',
		'Охрана труда для руководителей',
		'Курсы для работников ТБ',
		'Диспетчер Контролер Специалист БДД',
		'Обучение БДД дистанционно',
		'Обучение контролера ТС',
		'Курсы для специалистов по охране труда',
		'Ответственный за транспортную безопасность',
		'ГБА',
		'Обучения охранников 4 разряда',
		'Охрана труда',
		'Пожарная безопасность',
		'Промышленная безопасность',
		'Мобилизационная подготовка',
		'Электробезопасность',
		'Новая пожарная безопасность',
		'Стропальщик',
		'Оператор котельной',
		'Обучение работников промбезопасности',
		'Безопасность работы с опасными отходами',
	);

	$created = 0;
	$skipped = 0;
	$errors = array();

	foreach ( $professions as $profession_name ) {
		$profession_name = trim( $profession_name );
		
		if ( empty( $profession_name ) ) {
			continue;
		}
		
		$existing = get_posts( array(
			'post_type'      => 'profession',
			'title'          => $profession_name,
			'post_status'    => 'any',
			'posts_per_page' => 1,
		) );
		
		if ( ! empty( $existing ) ) {
			$skipped++;
			continue;
		}
		
		$post_data = array(
			'post_title'   => $profession_name,
			'post_type'    => 'profession',
			'post_status'  => 'publish',
			'post_parent'  => 0,
		);
		
		$post_id = wp_insert_post( $post_data );
		
		if ( is_wp_error( $post_id ) ) {
			$errors[] = $profession_name . ' - ' . $post_id->get_error_message();
		} else {
			$created++;
		}
	}

	return array(
		'created' => $created,
		'skipped' => $skipped,
		'errors'  => $errors,
	);
}

function cenzor_add_professions_admin_page() {
	add_submenu_page(
		'edit.php?post_type=profession',
		'Генерация профессий',
		'Генерация профессий',
		'manage_options',
		'generate-professions',
		'cenzor_professions_admin_page_callback'
	);
}
add_action( 'admin_menu', 'cenzor_add_professions_admin_page' );

function cenzor_professions_admin_page_callback() {
	if ( isset( $_POST['generate_professions'] ) && check_admin_referer( 'generate_professions_action' ) ) {
		$result = cenzor_generate_professions();
		?>
		<div class="notice notice-success is-dismissible">
			<p><strong>Генерация завершена!</strong></p>
			<p>Создано: <?php echo esc_html( $result['created'] ); ?></p>
			<p>Пропущено (уже существуют): <?php echo esc_html( $result['skipped'] ); ?></p>
			<?php if ( ! empty( $result['errors'] ) ) : ?>
				<p><strong>Ошибки:</strong></p>
				<ul>
					<?php foreach ( $result['errors'] as $error ) : ?>
						<li><?php echo esc_html( $error ); ?></li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</div>
		<?php
	}
	?>
	<div class="wrap">
		<h1>Генерация профессий</h1>
		<p>Эта функция создаст все профессии из предустановленного списка.</p>
		<form method="post" action="">
			<?php wp_nonce_field( 'generate_professions_action' ); ?>
			<p>
				<input type="submit" name="generate_professions" class="button button-primary" value="Сгенерировать профессии" onclick="return confirm('Вы уверены, что хотите создать все профессии? Существующие профессии будут пропущены.');">
			</p>
		</form>
	</div>
	<?php
}

function cenzor_register_osnovnye_svedeniya_post_type() {
	$labels = array(
		'name'                  => 'Основные сведения',
		'singular_name'         => 'Основное сведение',
		'menu_name'             => 'Основные сведения',
		'add_new'               => 'Добавить новое',
		'add_new_item'          => 'Добавить новое сведение',
		'edit_item'             => 'Редактировать сведение',
		'new_item'              => 'Новое сведение',
		'view_item'             => 'Просмотреть сведение',
		'search_items'          => 'Искать сведения',
		'not_found'             => 'Сведения не найдены',
		'not_found_in_trash'    => 'В корзине сведений не найдено',
	);

	$args = array(
		'label'                 => 'Основные сведения',
		'labels'                => $labels,
		'supports'              => array( 'title', 'thumbnail', 'editor', 'page-attributes' ),
		'hierarchical'          => true,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 24,
		'menu_icon'             => 'dashicons-info',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'show_in_rest'          => true,
	);

	register_post_type( 'osnovnye_svedeniya', $args );
}
add_action( 'init', 'cenzor_register_osnovnye_svedeniya_post_type', 0 );

function cenzor_generate_osnovnye_svedeniya() {
	$pages = array(
		'Общие сведения' => array(
			'Основные сведения',
			'Структура и органы управления',
			'Руководство. Педагогический состав',
		),
		'Документы' => array(
			'Документы',
			'Самообследование автошколы',
			'Образовательные стандарты и требования',
		),
		'Инфраструктура и условия обучения' => array(
			'Материально‑техническое обеспечение и оснащенность образовательного процесса',
			'Учебные кабинеты',
			'Библиотека',
			'Объекты для проведения практических занятий',
			'Об объектах спорта',
			'Условия питания',
			'Условия охраны здоровья обучающихся',
		),
		'Вопрос‑Ответ / Прочее' => array(
			'Стипендии и иные виды материальной поддержки',
			'Международное сотрудничество',
			'Доступная среда',
			'Платные образовательные услуги',
			'Вакантные места для приёма (перевода) обучающихся',
			'Финансово‑хозяйственная деятельность',
		),
	);

	$created = 0;
	$skipped = 0;
	$errors = array();
	$parent_ids = array();

	foreach ( $pages as $parent_title => $children ) {
		$existing_parent = get_posts( array(
			'post_type'      => 'osnovnye_svedeniya',
			'title'          => $parent_title,
			'post_status'    => 'any',
			'posts_per_page' => 1,
		) );

		if ( ! empty( $existing_parent ) ) {
			$parent_id = $existing_parent[0]->ID;
		} else {
			$parent_data = array(
				'post_title'   => $parent_title,
				'post_type'    => 'osnovnye_svedeniya',
				'post_status'  => 'publish',
				'post_parent'  => 0,
			);
			
			$parent_id = wp_insert_post( $parent_data );
			
			if ( is_wp_error( $parent_id ) ) {
				$errors[] = $parent_title . ' - ' . $parent_id->get_error_message();
				continue;
			} else {
				$created++;
			}
		}

		$parent_ids[ $parent_title ] = $parent_id;

		foreach ( $children as $child_title ) {
			$existing_child = get_posts( array(
				'post_type'      => 'osnovnye_svedeniya',
				'title'          => $child_title,
				'post_status'    => 'any',
				'posts_per_page' => 1,
			) );

			if ( ! empty( $existing_child ) ) {
				$skipped++;
				continue;
			}

			$child_data = array(
				'post_title'   => $child_title,
				'post_type'    => 'osnovnye_svedeniya',
				'post_status'  => 'publish',
				'post_parent'  => $parent_id,
			);
			
			$child_id = wp_insert_post( $child_data );
			
			if ( is_wp_error( $child_id ) ) {
				$errors[] = $child_title . ' - ' . $child_id->get_error_message();
			} else {
				$created++;
			}
		}
	}

	return array(
		'created' => $created,
		'skipped' => $skipped,
		'errors'  => $errors,
	);
}

function cenzor_add_osnovnye_svedeniya_admin_page() {
	add_submenu_page(
		'edit.php?post_type=osnovnye_svedeniya',
		'Генерация страниц',
		'Генерация страниц',
		'manage_options',
		'generate-osnovnye-svedeniya',
		'cenzor_osnovnye_svedeniya_admin_page_callback'
	);
}
add_action( 'admin_menu', 'cenzor_add_osnovnye_svedeniya_admin_page' );

function cenzor_osnovnye_svedeniya_admin_page_callback() {
	if ( isset( $_POST['generate_pages'] ) && check_admin_referer( 'generate_osnovnye_svedeniya_action' ) ) {
		$result = cenzor_generate_osnovnye_svedeniya();
		?>
		<div class="notice notice-success is-dismissible">
			<p><strong>Генерация завершена!</strong></p>
			<p>Создано: <?php echo esc_html( $result['created'] ); ?></p>
			<p>Пропущено (уже существуют): <?php echo esc_html( $result['skipped'] ); ?></p>
			<?php if ( ! empty( $result['errors'] ) ) : ?>
				<p><strong>Ошибки:</strong></p>
				<ul>
					<?php foreach ( $result['errors'] as $error ) : ?>
						<li><?php echo esc_html( $error ); ?></li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</div>
		<?php
	}
	?>
	<div class="wrap">
		<h1>Генерация страниц</h1>
		<p>Эта функция создаст все страницы из предустановленного списка с иерархической структурой.</p>
		<form method="post" action="">
			<?php wp_nonce_field( 'generate_osnovnye_svedeniya_action' ); ?>
			<p>
				<input type="submit" name="generate_pages" class="button button-primary" value="Сгенерировать страницы" onclick="return confirm('Вы уверены, что хотите создать все страницы? Существующие страницы будут пропущены.');">
			</p>
		</form>
	</div>
	<?php
}

function cenzor_search_only_professions( $query ) {
	if ( ! is_admin() && $query->is_main_query() ) {
		if ( $query->is_search() ) {
			$query->set( 'post_type', 'profession' );
		}
	}
}
add_action( 'pre_get_posts', 'cenzor_search_only_professions' );

function cenzor_redirect_single_search_result() {
	if ( ! is_admin() && is_search() ) {
		$search_query = trim( get_search_query() );
		
		if ( ! empty( $search_query ) ) {
			global $wpdb;
			
			$exact_match = $wpdb->get_var( $wpdb->prepare(
				"SELECT ID FROM {$wpdb->posts} 
				WHERE post_type = 'profession' 
				AND post_status = 'publish' 
				AND post_title = %s 
				LIMIT 1",
				$search_query
			) );
			
			if ( $exact_match ) {
				wp_safe_redirect( get_permalink( $exact_match ), 302 );
				exit;
			}
			
			$search_results = new WP_Query( array(
				'post_type'      => 'profession',
				's'              => $search_query,
				'posts_per_page' => 2,
				'post_status'    => 'publish',
			) );
			
			if ( $search_results->found_posts === 1 ) {
				$search_results->the_post();
				wp_safe_redirect( get_permalink(), 302 );
				exit;
			}
			
			wp_reset_postdata();
		}
	}
}
add_action( 'template_redirect', 'cenzor_redirect_single_search_result' );

