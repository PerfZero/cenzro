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
	wp_enqueue_script( 'inputmask', 'https://cdn.jsdelivr.net/npm/inputmask@5.0.8/dist/inputmask.min.js', array(), '5.0.8', true );
	wp_enqueue_script( 'inputmask-phone', 'https://cdn.jsdelivr.net/npm/inputmask@5.0.8/dist/inputmask/inputmask.phone.min.js', array( 'inputmask' ), '5.0.8', true );
	wp_enqueue_script( 'cenzor-course-pdf-download', get_template_directory_uri() . '/js/course-pdf-download.js', array( 'inputmask', 'inputmask-phone' ), _S_VERSION, true );
	wp_enqueue_script( 'cenzor-reviews', get_template_directory_uri() . '/js/reviews.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'cenzor-quiz', get_template_directory_uri() . '/js/quiz.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'cenzor-search-popup', get_template_directory_uri() . '/js/search-popup.js', array(), _S_VERSION, true );
	
	wp_localize_script( 'cenzor-course-pdf-download', 'cenzorAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
	wp_localize_script( 'cenzor-reviews', 'cenzorAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
	wp_localize_script( 'cenzor-quiz', 'cenzorAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );

	if ( is_singular( 'profession' ) ) {
		wp_enqueue_script( 'cenzor-profession-single-tabs', get_template_directory_uri() . '/js/profession-single-tabs.js', array(), _S_VERSION, true );
	}

	if ( is_singular( 'quiz' ) ) {
		wp_enqueue_script( 'cenzor-quiz', get_template_directory_uri() . '/js/quiz.js', array(), _S_VERSION, true );
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

function cenzor_add_acf_options_page() {
	if ( function_exists( 'acf_add_options_page' ) ) {
		acf_add_options_page( array(
			'page_title' => 'Настройки курсов',
			'menu_title' => 'Курсы PDF',
			'menu_slug'  => 'acf-options',
			'capability' => 'edit_posts',
		) );
	}
}
add_action( 'acf/init', 'cenzor_add_acf_options_page' );

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
		'Обучение БДД',
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

function cenzor_generate_pricing_for_profession_575() {
	$profession_id = 575;
	
	$post = get_post( $profession_id );
	if ( ! $post || $post->post_type !== 'profession' ) {
		return array(
			'success' => false,
			'message' => 'Профессия с ID ' . $profession_id . ' не найдена',
		);
	}
	
	$pricing_data = array(
		array(
			'program' => '1 категория - Повышение квалификации работников, назначенных в качестве лиц, ответственных за обеспечение транспортной безопасности в субъекте транспортной инфраструктуры',
			'hours' => '40',
			'price' => '3000,00',
		),
		array(
			'program' => '2 категория - Повышение квалификации работников, назначенных в качестве лиц, ответственных за обеспечение транспортной безопасности на объекте транспортной инфраструктуры и (или) транспортном средстве',
			'hours' => '60',
			'price' => '3000,00',
		),
		array(
			'program' => '8 категория - Повышение квалификации иных работников субъекта транспортной инфраструктуры, подразделения транспортной безопасности, руководящих выполнением работ, непосредственно связанных с обеспечением транспортной безопасности объекта транспортной инфраструктуры и (или) транспортного средства',
			'hours' => '20',
			'price' => '3000,00',
		),
		array(
			'program' => '3 категория - Повышение квалификации работников субъекта транспортной инфраструктуры, подразделения транспортной безопасности, руководящих выполнением работ, непосредственно связанных с обеспечением транспортной безопасности объекта транспортной инфраструктуры и (или) транспортного средства',
			'hours' => '80',
			'price' => '3000,00',
		),
		array(
			'program' => '4 категория - Повышение квалификации работников, включенных в состав группы быстрого реагирования',
			'hours' => '80',
			'price' => '3000,00',
		),
		array(
			'program' => '5 категория - Повышение квалификации работников, осуществляющих досмотр, дополнительный досмотр, повторный досмотр в целях обеспечения транспортной безопасности',
			'hours' => '80',
			'price' => '3000,00',
		),
		array(
			'program' => '6 категория - Повышение квалификации работников, осуществляющих наблюдение и (или) собеседование в целях обеспечения транспортной безопасности',
			'hours' => '80',
			'price' => '3000,00',
		),
		array(
			'program' => '7 категория - Повышение квалификации работников, управляющих техническими средствами обеспечения транспортной безопасности',
			'hours' => '80',
			'price' => '3000,00',
		),
	);
	
	$result = update_field( 'profession_tab_pricing', $pricing_data, $profession_id );
	
	if ( $result ) {
		return array(
			'success' => true,
			'message' => 'Прайс успешно сгенерирован для профессии ID ' . $profession_id . '. Добавлено ' . count( $pricing_data ) . ' программ.',
		);
	} else {
		return array(
			'success' => false,
			'message' => 'Ошибка при сохранении прайса',
		);
	}
}

function cenzor_add_pricing_generator_admin_page() {
	add_submenu_page(
		'edit.php?post_type=profession',
		'Генерация прайса',
		'Генерация прайса',
		'manage_options',
		'generate-pricing-575',
		'cenzor_pricing_generator_admin_page_callback'
	);
}
add_action( 'admin_menu', 'cenzor_add_pricing_generator_admin_page' );

function cenzor_pricing_generator_admin_page_callback() {
	if ( isset( $_GET['generate'] ) && $_GET['generate'] === '575' && current_user_can( 'manage_options' ) ) {
		$result = cenzor_generate_pricing_for_profession_575();
		wp_die(
			'<div style="padding: 20px; font-family: Arial, sans-serif;">
				<h1>' . ( $result['success'] ? '✓ Успешно!' : '✗ Ошибка!' ) . '</h1>
				<p>' . esc_html( $result['message'] ) . '</p>
				<p><a href="' . admin_url( 'edit.php?post_type=profession&page=generate-pricing-575' ) . '">Вернуться назад</a></p>
			</div>',
			$result['success'] ? 'Генерация прайса' : 'Ошибка',
			array( 'response' => $result['success'] ? 200 : 500 )
		);
	}
	
	if ( isset( $_POST['generate_pricing'] ) && check_admin_referer( 'generate_pricing_action' ) ) {
		$result = cenzor_generate_pricing_for_profession_575();
		?>
		<div class="notice <?php echo $result['success'] ? 'notice-success' : 'notice-error'; ?> is-dismissible">
			<p><strong><?php echo $result['success'] ? 'Успешно!' : 'Ошибка!'; ?></strong></p>
			<p><?php echo esc_html( $result['message'] ); ?></p>
		</div>
		<?php
	}
	?>
	<div class="wrap">
		<h1>Генерация прайса для профессии ID 575</h1>
		<p>Эта функция сгенерирует прайс для профессии с ID 575.</p>
		<p>Вы также можете использовать прямую ссылку: <a href="<?php echo admin_url( 'edit.php?post_type=profession&page=generate-pricing-575&generate=575' ); ?>"><?php echo admin_url( 'edit.php?post_type=profession&page=generate-pricing-575&generate=575' ); ?></a></p>
		<form method="post" action="">
			<?php wp_nonce_field( 'generate_pricing_action' ); ?>
			<p>
				<input type="submit" name="generate_pricing" class="button button-primary" value="Сгенерировать прайс" onclick="return confirm('Вы уверены, что хотите сгенерировать прайс для профессии ID 575? Существующий прайс будет перезаписан.');">
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

function cenzor_download_course_pdf() {
	$name = sanitize_text_field( $_POST['name'] ?? '' );
	$phone = sanitize_text_field( $_POST['phone'] ?? '' );
	$email = sanitize_email( $_POST['email'] ?? '' );
	$entity_type = sanitize_text_field( $_POST['entity_type'] ?? 'individual' );
	$course_index = intval( $_POST['course_index'] ?? 0 );
	$company_name = sanitize_text_field( $_POST['company_name'] ?? '' );
	$inn = sanitize_text_field( $_POST['inn'] ?? '' );

	if ( empty( $name ) || empty( $phone ) || empty( $email ) || $course_index < 0 ) {
		wp_send_json_error( array( 'message' => 'Заполните все обязательные поля' ) );
	}

	if ( $entity_type === 'legal' && ( empty( $company_name ) || empty( $inn ) ) ) {
		wp_send_json_error( array( 'message' => 'Заполните название организации и ИНН' ) );
	}

	$courses = get_field( 'courses_pdf_list', 'option' );
	
	if ( ! $courses || ! isset( $courses[ $course_index ] ) ) {
		wp_send_json_error( array( 'message' => 'Курс не найден' ) );
	}

	$course = $courses[ $course_index ];
	$course_name = $course['course_name'] ?? '';
	$course_file = $course['course_pdf'] ?? null;

	if ( ! $course_file || empty( $course_file['url'] ) ) {
		wp_send_json_error( array( 'message' => 'Файл не найден для выбранного курса' ) );
	}

	$file_url = $course_file['url'];
	$file_filename = $course_file['filename'] ?? 'file';

	$form_data = array(
		'name' => $name,
		'phone' => $phone,
		'email' => $email,
		'entity_type' => $entity_type,
		'course' => $course_name,
		'date' => current_time( 'mysql' ),
	);

	if ( $entity_type === 'legal' ) {
		$form_data['company_name'] = $company_name;
		$form_data['inn'] = $inn;
	}

	$post_content = 'Имя: ' . $name . "\n";
	$post_content .= 'Телефон: ' . $phone . "\n";
	$post_content .= 'Email: ' . $email . "\n";
	$post_content .= 'Тип лица: ' . ( $entity_type === 'legal' ? 'Юридическое лицо' : 'Физическое лицо' ) . "\n";
	
	if ( $entity_type === 'legal' ) {
		$post_content .= 'Название организации: ' . $company_name . "\n";
		$post_content .= 'ИНН: ' . $inn . "\n";
	}
	
	$post_content .= 'Курс: ' . $course_name . "\n";
	$post_content .= 'Дата: ' . current_time( 'mysql' );

	$post_id = wp_insert_post( array(
		'post_title'   => 'Заявка на коммерческое предложение: ' . $name . ' - ' . $course_name,
		'post_content' => $post_content,
		'post_status'  => 'publish',
		'post_type'    => 'course_request',
	) );

	if ( $post_id && ! is_wp_error( $post_id ) ) {
		add_post_meta( $post_id, '_request_name', $name );
		add_post_meta( $post_id, '_request_phone', $phone );
		add_post_meta( $post_id, '_request_email', $email );
		add_post_meta( $post_id, '_request_entity_type', $entity_type );
		add_post_meta( $post_id, '_request_course', $course_name );
		add_post_meta( $post_id, '_request_date', current_time( 'mysql' ) );
		add_post_meta( $post_id, '_request_processed', '0' );
		
		if ( $entity_type === 'legal' ) {
			add_post_meta( $post_id, '_request_company_name', $company_name );
			add_post_meta( $post_id, '_request_inn', $inn );
		}
	}

	$admin_email = get_option( 'admin_email' );
	$subject = 'Новая заявка на коммерческое предложение: ' . $course_name;
	$email_message = "Новая заявка на коммерческое предложение\n\n";
	$email_message .= "Имя: " . $name . "\n";
	$email_message .= "Телефон: " . $phone . "\n";
	$email_message .= "Email: " . $email . "\n";
	$email_message .= "Тип лица: " . ( $entity_type === 'legal' ? 'Юридическое лицо' : 'Физическое лицо' ) . "\n";
	
	if ( $entity_type === 'legal' ) {
		$email_message .= "Название организации: " . $company_name . "\n";
		$email_message .= "ИНН: " . $inn . "\n";
	}
	
	$email_message .= "Курс: " . $course_name . "\n";
	$email_message .= "Дата: " . current_time( 'mysql' ) . "\n";

	wp_mail( $admin_email, $subject, $email_message );

	if ( ! empty( $email ) && is_email( $email ) ) {
		$file_path = null;
		if ( isset( $course_file['ID'] ) && ! empty( $course_file['ID'] ) ) {
			$file_path = get_attached_file( $course_file['ID'] );
		} elseif ( isset( $course_file['path'] ) && ! empty( $course_file['path'] ) ) {
			$file_path = $course_file['path'];
		}
		
		$user_subject = 'Коммерческое предложение: ' . $course_name;
		$user_message = "Здравствуйте, " . $name . "!\n\n";
		$user_message .= "Благодарим за запрос коммерческого предложения по курсу «" . $course_name . "».\n\n";
		
		$headers = array( 'Content-Type: text/plain; charset=UTF-8' );
		$attachments = array();
		
		if ( $file_path && file_exists( $file_path ) ) {
			$user_message .= "Коммерческое предложение во вложении.\n\n";
			$attachments[] = $file_path;
		}
		
		$user_message .= "Наш специалист свяжется с вами в ближайшее время для уточнения деталей.\n\n";
		$user_message .= "С уважением,\n";
		$user_message .= "Учебный центр «ЦЕНЗОР»";
		
		wp_mail( $email, $user_subject, $user_message, $headers, $attachments );
	}

	do_action( 'cenzor_course_pdf_request', $form_data );

	wp_send_json_success( array(
		'message' => 'Заявка успешно отправлена! Коммерческое предложение будет отправлено на указанный email.',
	) );
}
add_action( 'wp_ajax_download_course_pdf', 'cenzor_download_course_pdf' );
add_action( 'wp_ajax_nopriv_download_course_pdf', 'cenzor_download_course_pdf' );

function cenzor_register_course_request_post_type() {
	$labels = array(
		'name'                  => 'Заявки на курсы',
		'singular_name'         => 'Заявка на курс',
		'menu_name'             => 'Заявки на курсы',
		'add_new'               => 'Добавить новую',
		'add_new_item'          => 'Добавить новую заявку',
		'edit_item'              => 'Редактировать заявку',
		'new_item'               => 'Новая заявка',
		'view_item'              => 'Просмотреть заявку',
		'search_items'           => 'Искать заявки',
		'not_found'              => 'Заявки не найдены',
		'not_found_in_trash'     => 'В корзине заявок не найдено',
	);

	$args = array(
		'label'                 => 'Заявки на курсы',
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor' ),
		'hierarchical'          => false,
		'public'                => false,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 25,
		'menu_icon'             => 'dashicons-email-alt',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => false,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'  => true,
		'publicly_queryable'    => false,
		'capability_type'       => 'post',
		'show_in_rest'          => false,
	);

	register_post_type( 'course_request', $args );
}
add_action( 'init', 'cenzor_register_course_request_post_type', 0 );

function cenzor_course_request_columns( $columns ) {
	$new_columns = array();
	$new_columns['cb'] = $columns['cb'];
	$new_columns['title'] = 'Заявка';
	$new_columns['request_status'] = 'Статус';
	$new_columns['request_name'] = 'Имя';
	$new_columns['request_phone'] = 'Телефон';
	$new_columns['request_email'] = 'Email';
	$new_columns['request_entity_type'] = 'Тип лица';
	$new_columns['request_company'] = 'Организация';
	$new_columns['request_inn'] = 'ИНН';
	$new_columns['request_course'] = 'Курс';
	$new_columns['date'] = 'Дата';
	return $new_columns;
}
add_filter( 'manage_course_request_posts_columns', 'cenzor_course_request_columns' );

function cenzor_course_request_column_content( $column, $post_id ) {
	switch ( $column ) {
		case 'request_status':
			$processed = get_post_meta( $post_id, '_request_processed', true );
			if ( $processed === '1' ) {
				echo '<span style="color: #46b450; font-weight: bold;">✓ Обработано</span>';
			} else {
				echo '<span style="color: #dc3232; font-weight: bold;">● Не обработано</span>';
			}
			break;
		case 'request_name':
			echo esc_html( get_post_meta( $post_id, '_request_name', true ) );
			break;
		case 'request_phone':
			$phone = get_post_meta( $post_id, '_request_phone', true );
			if ( $phone ) {
				echo '<a href="tel:' . esc_attr( $phone ) . '">' . esc_html( $phone ) . '</a>';
			}
			break;
		case 'request_email':
			$email = get_post_meta( $post_id, '_request_email', true );
			if ( $email ) {
				echo '<a href="mailto:' . esc_attr( $email ) . '">' . esc_html( $email ) . '</a>';
			}
			break;
		case 'request_entity_type':
			$entity_type = get_post_meta( $post_id, '_request_entity_type', true );
			if ( $entity_type === 'legal' ) {
				echo 'Юридическое лицо';
			} else {
				echo 'Физическое лицо';
			}
			break;
		case 'request_company':
			$company_name = get_post_meta( $post_id, '_request_company_name', true );
			echo $company_name ? esc_html( $company_name ) : '—';
			break;
		case 'request_inn':
			$inn = get_post_meta( $post_id, '_request_inn', true );
			echo $inn ? esc_html( $inn ) : '—';
			break;
		case 'request_course':
			echo esc_html( get_post_meta( $post_id, '_request_course', true ) );
			break;
	}
}
add_action( 'manage_course_request_posts_custom_column', 'cenzor_course_request_column_content', 10, 2 );

function cenzor_course_request_menu_badge() {
	global $menu;
	
	$args = array(
		'post_type'      => 'course_request',
		'post_status'    => 'publish',
		'posts_per_page' => -1,
		'meta_query'     => array(
			'relation' => 'OR',
			array(
				'key'     => '_request_processed',
				'value'   => '1',
				'compare' => '!=',
			),
			array(
				'key'     => '_request_processed',
				'compare' => 'NOT EXISTS',
			),
		),
	);
	
	$unprocessed = new WP_Query( $args );
	$pending_count = $unprocessed->found_posts;
	wp_reset_postdata();
	
	if ( $pending_count > 0 ) {
		foreach ( $menu as $key => $item ) {
			if ( $item[2] === 'edit.php?post_type=course_request' ) {
				$menu[ $key ][0] .= ' <span class="awaiting-mod count-' . $pending_count . '"><span class="pending-count">' . $pending_count . '</span></span>';
				break;
			}
		}
	}
}
add_action( 'admin_menu', 'cenzor_course_request_menu_badge', 999 );

function cenzor_course_request_bulk_actions( $bulk_actions ) {
	$bulk_actions['mark_processed'] = 'Отметить как обработанные';
	$bulk_actions['mark_unprocessed'] = 'Отметить как необработанные';
	return $bulk_actions;
}
add_filter( 'bulk_actions-edit-course_request', 'cenzor_course_request_bulk_actions' );

function cenzor_course_request_handle_bulk_action( $redirect_to, $action, $post_ids ) {
	if ( $action === 'mark_processed' ) {
		foreach ( $post_ids as $post_id ) {
			update_post_meta( $post_id, '_request_processed', '1' );
		}
		$redirect_to = add_query_arg( 'marked_processed', count( $post_ids ), $redirect_to );
	}
	
	if ( $action === 'mark_unprocessed' ) {
		foreach ( $post_ids as $post_id ) {
			update_post_meta( $post_id, '_request_processed', '0' );
		}
		$redirect_to = add_query_arg( 'marked_unprocessed', count( $post_ids ), $redirect_to );
	}
	
	return $redirect_to;
}
add_filter( 'handle_bulk_actions-edit-course_request', 'cenzor_course_request_handle_bulk_action', 10, 3 );

function cenzor_course_request_bulk_action_admin_notice() {
	if ( ! empty( $_REQUEST['marked_processed'] ) ) {
		$count = intval( $_REQUEST['marked_processed'] );
		printf( '<div id="message" class="updated notice is-dismissible"><p>Отмечено как обработанные: %d заявок.</p></div>', $count );
	}
	
	if ( ! empty( $_REQUEST['marked_unprocessed'] ) ) {
		$count = intval( $_REQUEST['marked_unprocessed'] );
		printf( '<div id="message" class="updated notice is-dismissible"><p>Отмечено как необработанные: %d заявок.</p></div>', $count );
	}
}
add_action( 'admin_notices', 'cenzor_course_request_bulk_action_admin_notice' );

function cenzor_course_request_meta_boxes() {
	add_meta_box(
		'course_request_details',
		'Детали заявки',
		'cenzor_course_request_meta_box_callback',
		'course_request',
		'normal',
		'high'
	);
	
	add_meta_box(
		'course_request_status',
		'Статус заявки',
		'cenzor_course_request_status_meta_box_callback',
		'course_request',
		'side',
		'high'
	);
}
add_action( 'add_meta_boxes', 'cenzor_course_request_meta_boxes' );

function cenzor_course_request_status_meta_box_callback( $post ) {
	wp_nonce_field( 'cenzor_course_request_status', 'cenzor_course_request_status_nonce' );
	$processed = get_post_meta( $post->ID, '_request_processed', true );
	?>
	<p>
		<label>
			<input type="checkbox" name="request_processed" value="1" <?php checked( $processed, '1' ); ?>>
			Заявка обработана
		</label>
	</p>
	<?php
}

function cenzor_course_request_save_status( $post_id ) {
	if ( ! isset( $_POST['cenzor_course_request_status_nonce'] ) ) {
		return;
	}
	
	if ( ! wp_verify_nonce( $_POST['cenzor_course_request_status_nonce'], 'cenzor_course_request_status' ) ) {
		return;
	}
	
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	
	if ( isset( $_POST['request_processed'] ) ) {
		update_post_meta( $post_id, '_request_processed', '1' );
	} else {
		update_post_meta( $post_id, '_request_processed', '0' );
	}
}
add_action( 'save_post_course_request', 'cenzor_course_request_save_status' );

function cenzor_course_request_meta_box_callback( $post ) {
	$name = get_post_meta( $post->ID, '_request_name', true );
	$phone = get_post_meta( $post->ID, '_request_phone', true );
	$email = get_post_meta( $post->ID, '_request_email', true );
	$entity_type = get_post_meta( $post->ID, '_request_entity_type', true );
	$company_name = get_post_meta( $post->ID, '_request_company_name', true );
	$inn = get_post_meta( $post->ID, '_request_inn', true );
	$course = get_post_meta( $post->ID, '_request_course', true );
	$date = get_post_meta( $post->ID, '_request_date', true );
	
	?>
	<table class="form-table">
		<tr>
			<th><label>Имя</label></th>
			<td><strong><?php echo esc_html( $name ); ?></strong></td>
		</tr>
		<tr>
			<th><label>Телефон</label></th>
			<td><a href="tel:<?php echo esc_attr( $phone ); ?>"><?php echo esc_html( $phone ); ?></a></td>
		</tr>
		<tr>
			<th><label>Email</label></th>
			<td><a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a></td>
		</tr>
		<tr>
			<th><label>Тип лица</label></th>
			<td><?php echo $entity_type === 'legal' ? 'Юридическое лицо' : 'Физическое лицо'; ?></td>
		</tr>
		<?php if ( $entity_type === 'legal' ) : ?>
		<tr>
			<th><label>Название организации</label></th>
			<td><strong><?php echo esc_html( $company_name ); ?></strong></td>
		</tr>
		<tr>
			<th><label>ИНН</label></th>
			<td><strong><?php echo esc_html( $inn ); ?></strong></td>
		</tr>
		<?php endif; ?>
		<tr>
			<th><label>Курс</label></th>
			<td><strong><?php echo esc_html( $course ); ?></strong></td>
		</tr>
		<tr>
			<th><label>Дата заявки</label></th>
			<td><?php echo esc_html( $date ); ?></td>
		</tr>
	</table>
	<?php
}

function cenzor_register_review_post_type() {
	$labels = array(
		'name'                  => 'Отзывы',
		'singular_name'         => 'Отзыв',
		'menu_name'             => 'Отзывы',
		'add_new'               => 'Добавить новый',
		'add_new_item'          => 'Добавить новый отзыв',
		'edit_item'             => 'Редактировать отзыв',
		'new_item'              => 'Новый отзыв',
		'view_item'             => 'Просмотреть отзыв',
		'search_items'          => 'Искать отзывы',
		'not_found'             => 'Отзывы не найдены',
		'not_found_in_trash'    => 'В корзине отзывов не найдено',
	);

	$args = array(
		'label'                 => 'Отзывы',
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 26,
		'menu_icon'             => 'dashicons-star-filled',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => false,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => true,
		'publicly_queryable'    => false,
		'capability_type'       => 'post',
		'show_in_rest'          => true,
	);

	register_post_type( 'review', $args );
}
add_action( 'init', 'cenzor_register_review_post_type', 0 );

function cenzor_submit_review() {
	$name = sanitize_text_field( $_POST['name'] ?? '' );
	$course = sanitize_text_field( $_POST['course'] ?? '' );
	$rating = intval( $_POST['rating'] ?? 5 );
	$text = sanitize_textarea_field( $_POST['text'] ?? '' );

	if ( empty( $name ) || empty( $text ) || $rating < 1 || $rating > 5 ) {
		wp_send_json_error( array( 'message' => 'Заполните все обязательные поля' ) );
	}

	$post_id = wp_insert_post( array(
		'post_title'   => 'Отзыв от ' . $name,
		'post_content' => $text,
		'post_status'  => 'pending',
		'post_type'    => 'review',
	) );

	if ( $post_id && ! is_wp_error( $post_id ) ) {
		update_field( 'review_name', $name, $post_id );
		update_field( 'review_rating', $rating, $post_id );
		update_field( 'review_course', $course, $post_id );
		update_field( 'review_approved', 0, $post_id );

		if ( ! empty( $_FILES['photo'] ) && $_FILES['photo']['error'] === UPLOAD_ERR_OK ) {
			require_once( ABSPATH . 'wp-admin/includes/image.php' );
			require_once( ABSPATH . 'wp-admin/includes/file.php' );
			require_once( ABSPATH . 'wp-admin/includes/media.php' );

			$attachment_id = media_handle_upload( 'photo', $post_id );
			if ( ! is_wp_error( $attachment_id ) ) {
				update_field( 'review_photo', $attachment_id, $post_id );
			}
		}

		$admin_email = get_option( 'admin_email' );
		$subject = 'Новый отзыв на модерацию';
		$message = "Новый отзыв требует модерации\n\n";
		$message .= "Имя: " . $name . "\n";
		$message .= "Курс: " . ( $course ? $course : 'Общий отзыв' ) . "\n";
		$message .= "Оценка: " . $rating . "/5\n";
		$message .= "Текст: " . $text . "\n";

		wp_mail( $admin_email, $subject, $message );

		wp_send_json_success( array( 'message' => 'Спасибо за отзыв! Он будет опубликован после модерации.' ) );
	} else {
		wp_send_json_error( array( 'message' => 'Ошибка при сохранении отзыва' ) );
	}
}
add_action( 'wp_ajax_submit_review', 'cenzor_submit_review' );
add_action( 'wp_ajax_nopriv_submit_review', 'cenzor_submit_review' );

function cenzor_review_columns( $columns ) {
	$new_columns = array();
	$new_columns['cb'] = $columns['cb'];
	$new_columns['title'] = 'Отзыв';
	$new_columns['review_text'] = 'Текст отзыва';
	$new_columns['review_name'] = 'Имя';
	$new_columns['review_rating'] = 'Рейтинг';
	$new_columns['review_course'] = 'Профессия';
	$new_columns['review_approved'] = 'Одобрен';
	$new_columns['date'] = 'Дата';
	return $new_columns;
}
add_filter( 'manage_review_posts_columns', 'cenzor_review_columns' );

function cenzor_review_column_content( $column, $post_id ) {
	switch ( $column ) {
		case 'review_text':
			$content = get_post_field( 'post_content', $post_id );
			$excerpt = wp_trim_words( $content, 20 );
			echo esc_html( $excerpt );
			break;
		case 'review_name':
			echo esc_html( get_field( 'review_name', $post_id ) );
			break;
		case 'review_rating':
			$rating = get_field( 'review_rating', $post_id ) ?: 0;
			echo str_repeat( '★', $rating ) . ' (' . $rating . '/5)';
			break;
		case 'review_course':
			$course = get_field( 'review_course', $post_id );
			echo $course ? esc_html( $course ) : '<span style="color: #999;">Общий</span>';
			break;
		case 'review_approved':
			$approved = get_field( 'review_approved', $post_id );
			if ( $approved ) {
				echo '<span style="color: green;">✓ Да</span>';
			} else {
				echo '<span style="color: red;">✗ Нет</span>';
			}
			break;
	}
}
add_action( 'manage_review_posts_custom_column', 'cenzor_review_column_content', 10, 2 );

function cenzor_submit_quiz() {
	$quiz_id = intval( $_POST['quiz_id'] ?? 0 );
	$total_points = intval( $_POST['total_points'] ?? 0 );
	$answers = $_POST['answers'] ?? array();
	$name = sanitize_text_field( $_POST['name'] ?? '' );
	$phone = sanitize_text_field( $_POST['phone'] ?? '' );
	$email = sanitize_email( $_POST['email'] ?? '' );

	if ( ! $quiz_id ) {
		wp_send_json_error( array( 'message' => 'Квиз не найден' ) );
	}

	if ( empty( $name ) ) {
		wp_send_json_error( array( 'message' => 'Укажите ваше имя' ) );
	}

	if ( empty( $phone ) && empty( $email ) ) {
		wp_send_json_error( array( 'message' => 'Укажите телефон или email' ) );
	}

	$results = get_field( 'quiz_results', $quiz_id );
	$result_html = '<div class="quiz-result-default"><h2>Спасибо за прохождение квиза!</h2><p>Вы набрали ' . $total_points . ' баллов.</p></div>';

	if ( $results ) {
		foreach ( $results as $result ) {
			$min_points = intval( $result['result_min_points'] ?? 0 );
			$max_points = intval( $result['result_max_points'] ?? 0 );
			
			if ( $total_points >= $min_points && $total_points <= $max_points ) {
				$result_title = $result['result_title'] ?? '';
				$result_description = $result['result_description'] ?? '';
				
				$result_html = '<div class="quiz-result-item">';
				$result_html .= '<h2 class="quiz-result-title">' . esc_html( $result_title ) . '</h2>';
				if ( $result_description ) {
					$result_html .= '<div class="quiz-result-description">' . wp_kses_post( nl2br( $result_description ) ) . '</div>';
				}
				$result_html .= '<div class="quiz-result-points">Вы набрали: ' . $total_points . ' баллов</div>';
				$result_html .= '</div>';
				break;
			}
		}
	}

	$post_id = wp_insert_post( array(
		'post_title'   => 'Результат квиза #' . $quiz_id . ' - ' . $name . ' - ' . $total_points . ' баллов',
		'post_content' => 'Имя: ' . $name . "\n" . 'Телефон: ' . $phone . "\n" . 'Email: ' . $email . "\n" . 'Баллы: ' . $total_points . "\n" . 'Ответы: ' . json_encode( $answers ),
		'post_status'  => 'publish',
		'post_type'    => 'quiz_result',
	) );

	if ( $post_id && ! is_wp_error( $post_id ) ) {
		add_post_meta( $post_id, '_quiz_id', $quiz_id );
		add_post_meta( $post_id, '_quiz_points', $total_points );
		add_post_meta( $post_id, '_quiz_answers', $answers );
		add_post_meta( $post_id, '_quiz_name', $name );
		add_post_meta( $post_id, '_quiz_phone', $phone );
		add_post_meta( $post_id, '_quiz_email', $email );
	}

	$admin_email = get_option( 'admin_email' );
	$subject = 'Новый результат квиза: ' . $name;
	$message = "Новый результат квиза\n\n";
	$message .= "Имя: " . $name . "\n";
	$message .= "Телефон: " . ( $phone ? $phone : 'не указан' ) . "\n";
	$message .= "Email: " . ( $email ? $email : 'не указан' ) . "\n";
	$message .= "Квиз ID: " . $quiz_id . "\n";
	$message .= "Баллы: " . $total_points . "\n";

	wp_mail( $admin_email, $subject, $message );

	wp_send_json_success( array( 'html' => $result_html ) );
}
add_action( 'wp_ajax_submit_quiz', 'cenzor_submit_quiz' );
add_action( 'wp_ajax_nopriv_submit_quiz', 'cenzor_submit_quiz' );

function cenzor_register_quiz_result_post_type() {
	$labels = array(
		'name'                  => 'Результаты квизов',
		'singular_name'         => 'Результат квиза',
		'menu_name'             => 'Результаты квизов',
		'add_new'               => 'Добавить новый',
		'add_new_item'          => 'Добавить новый результат',
		'edit_item'             => 'Редактировать результат',
		'new_item'              => 'Новый результат',
		'view_item'             => 'Просмотреть результат',
		'search_items'          => 'Искать результаты',
		'not_found'             => 'Результаты не найдены',
		'not_found_in_trash'    => 'В корзине результатов не найдено',
	);

	$args = array(
		'label'                 => 'Результаты квизов',
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor' ),
		'hierarchical'          => false,
		'public'                => false,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 28,
		'menu_icon'             => 'dashicons-chart-bar',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => false,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => true,
		'publicly_queryable'    => false,
		'capability_type'       => 'post',
		'show_in_rest'          => false,
	);

	register_post_type( 'quiz_result', $args );
}
add_action( 'init', 'cenzor_register_quiz_result_post_type', 0 );

function cenzor_quiz_result_columns( $columns ) {
	$new_columns = array();
	$new_columns['cb'] = $columns['cb'];
	$new_columns['title'] = 'Результат';
	$new_columns['quiz_result_name'] = 'Имя';
	$new_columns['quiz_result_phone'] = 'Телефон';
	$new_columns['quiz_result_email'] = 'Email';
	$new_columns['quiz_result_points'] = 'Баллы';
	$new_columns['date'] = 'Дата';
	return $new_columns;
}
add_filter( 'manage_quiz_result_posts_columns', 'cenzor_quiz_result_columns' );

function cenzor_quiz_result_column_content( $column, $post_id ) {
	switch ( $column ) {
		case 'quiz_result_name':
			echo esc_html( get_post_meta( $post_id, '_quiz_name', true ) );
			break;
		case 'quiz_result_phone':
			$phone = get_post_meta( $post_id, '_quiz_phone', true );
			if ( $phone ) {
				echo '<a href="tel:' . esc_attr( $phone ) . '">' . esc_html( $phone ) . '</a>';
			} else {
				echo '<span style="color: #999;">—</span>';
			}
			break;
		case 'quiz_result_email':
			$email = get_post_meta( $post_id, '_quiz_email', true );
			if ( $email ) {
				echo '<a href="mailto:' . esc_attr( $email ) . '">' . esc_html( $email ) . '</a>';
			} else {
				echo '<span style="color: #999;">—</span>';
			}
			break;
		case 'quiz_result_points':
			$points = get_post_meta( $post_id, '_quiz_points', true );
			echo esc_html( $points ? $points : '0' ) . ' баллов';
			break;
	}
}
add_action( 'manage_quiz_result_posts_custom_column', 'cenzor_quiz_result_column_content', 10, 2 );

function cenzor_register_quiz_post_type() {
	$labels = array(
		'name'                  => 'Квизы',
		'singular_name'         => 'Квиз',
		'menu_name'             => 'Квизы',
		'add_new'               => 'Добавить новый',
		'add_new_item'          => 'Добавить новый квиз',
		'edit_item'             => 'Редактировать квиз',
		'new_item'              => 'Новый квиз',
		'view_item'             => 'Просмотреть квиз',
		'search_items'          => 'Искать квизы',
		'not_found'             => 'Квизы не найдены',
		'not_found_in_trash'    => 'В корзине квизов не найдено',
	);

	$args = array(
		'label'                 => 'Квизы',
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 27,
		'menu_icon'             => 'dashicons-clipboard',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
		'show_in_rest'          => true,
	);

	register_post_type( 'quiz', $args );
}
add_action( 'init', 'cenzor_register_quiz_post_type', 0 );

function cenzor_create_sample_quiz() {
	global $wpdb;
	
	$quiz_title = 'Какую профессию выбрать?';
	$post_id = $wpdb->get_var( $wpdb->prepare(
		"SELECT ID FROM {$wpdb->posts} WHERE post_title = %s AND post_type = 'quiz' LIMIT 1",
		$quiz_title
	) );

	if ( $post_id ) {
		return;
	}

	$quiz_id = wp_insert_post( array(
		'post_title'   => 'Какую профессию выбрать?',
		'post_content' => 'Пройдите наш квиз, чтобы узнать, какая профессия вам подходит больше всего.',
		'post_status'  => 'publish',
		'post_type'    => 'quiz',
	) );

	if ( is_wp_error( $quiz_id ) || ! $quiz_id ) {
		return;
	}

	$questions = array(
		array(
			'question_text' => 'Какой формат работы вам больше подходит?',
			'question_answers' => array(
				array(
					'answer_text'   => 'Работа в офисе с коллегами',
					'answer_points' => 2,
				),
				array(
					'answer_text'   => 'Работа из дома',
					'answer_points' => 5,
				),
				array(
					'answer_text'   => 'Смешанный формат',
					'answer_points' => 4,
				),
				array(
					'answer_text'   => 'Работа на выезде, командировки',
					'answer_points' => 3,
				),
			),
		),
		array(
			'question_text' => 'Что для вас важнее в работе?',
			'question_answers' => array(
				array(
					'answer_text'   => 'Стабильный доход',
					'answer_points' => 3,
				),
				array(
					'answer_text'   => 'Возможность карьерного роста',
					'answer_points' => 5,
				),
				array(
					'answer_text'   => 'Интересные задачи и творчество',
					'answer_points' => 4,
				),
				array(
					'answer_text'   => 'Гибкий график и свободное время',
					'answer_points' => 2,
				),
			),
		),
		array(
			'question_text' => 'Какой уровень ответственности вы готовы взять на себя?',
			'question_answers' => array(
				array(
					'answer_text'   => 'Минимальный, выполнять простые задачи',
					'answer_points' => 1,
				),
				array(
					'answer_text'   => 'Средний, работать в команде',
					'answer_points' => 3,
				),
				array(
					'answer_text'   => 'Высокий, управлять проектами',
					'answer_points' => 5,
				),
				array(
					'answer_text'   => 'Максимальный, принимать важные решения',
					'answer_points' => 4,
				),
			),
		),
		array(
			'question_text' => 'Как вы относитесь к обучению новому?',
			'question_answers' => array(
				array(
					'answer_text'   => 'Очень люблю, постоянно изучаю новое',
					'answer_points' => 5,
				),
				array(
					'answer_text'   => 'Готов учиться, если это нужно для работы',
					'answer_points' => 4,
				),
				array(
					'answer_text'   => 'Предпочитаю работать с уже известными инструментами',
					'answer_points' => 2,
				),
				array(
					'answer_text'   => 'Не люблю перемены, лучше стабильность',
					'answer_points' => 1,
				),
			),
		),
		array(
			'question_text' => 'Какой тип задач вам интереснее?',
			'question_answers' => array(
				array(
					'answer_text'   => 'Работа с людьми, общение, продажи',
					'answer_points' => 3,
				),
				array(
					'answer_text'   => 'Аналитика, работа с данными',
					'answer_points' => 5,
				),
				array(
					'answer_text'   => 'Творчество, дизайн, креатив',
					'answer_points' => 4,
				),
				array(
					'answer_text'   => 'Технические задачи, программирование',
					'answer_points' => 5,
				),
			),
		),
	);

	update_field( 'quiz_questions', $questions, $quiz_id );

	$results = array(
		array(
			'result_min_points' => 20,
			'result_max_points' => 25,
			'result_title'     => 'Вы готовы к карьерному росту!',
			'result_description' => 'Отлично! Вы показали высокую мотивацию к развитию и готовность брать на себя ответственность. Рекомендуем рассмотреть профессии с высоким потенциалом роста: IT-специалист, менеджер проектов, аналитик данных.',
		),
		array(
			'result_min_points' => 15,
			'result_max_points' => 19,
			'result_title'     => 'Вы ищете баланс между стабильностью и развитием',
			'result_description' => 'Вы цените стабильность, но готовы к развитию. Рассмотрите профессии, которые предлагают хороший баланс: маркетолог, специалист по HR, бухгалтер с перспективой роста.',
		),
		array(
			'result_min_points' => 10,
			'result_max_points' => 14,
			'result_title'     => 'Вы предпочитаете стабильную работу',
			'result_description' => 'Для вас важна стабильность и предсказуемость. Рекомендуем профессии с четкими задачами и стабильным графиком: администратор, оператор call-центра, специалист по документообороту.',
		),
		array(
			'result_min_points' => 5,
			'result_max_points' => 9,
			'result_title'     => 'Начните с простых профессий',
			'result_description' => 'Рекомендуем начать с профессий, которые не требуют высокой ответственности и позволяют постепенно развивать навыки: помощник специалиста, курьер, упаковщик.',
		),
	);

	update_field( 'quiz_results', $results, $quiz_id );
}
add_action( 'after_setup_theme', 'cenzor_create_sample_quiz' );

function cenzor_quiz_shortcode( $atts ) {
	$atts = shortcode_atts( array(
		'id' => 0,
	), $atts );

	$quiz_id = intval( $atts['id'] );
	if ( ! $quiz_id ) {
		return '';
	}

	$quiz = get_post( $quiz_id );
	if ( ! $quiz || $quiz->post_type !== 'quiz' || $quiz->post_status !== 'publish' ) {
		return '';
	}

	$questions = get_field( 'quiz_questions', $quiz_id );
	if ( ! $questions ) {
		return '';
	}

	ob_start();
	?>
	<div class="quiz-embed-container" data-quiz-id="<?php echo esc_attr( $quiz_id ); ?>">
		<div class="quiz-embed-progress">
			<div class="quiz-embed-progress-bar">
				<div class="quiz-embed-progress-fill" id="quiz-embed-progress-fill-<?php echo $quiz_id; ?>"></div>
			</div>
			<span class="quiz-embed-progress-text" id="quiz-embed-progress-text-<?php echo $quiz_id; ?>">Вопрос 1 из <?php echo count( $questions ); ?></span>
		</div>

		<form class="quiz-embed-form" id="quiz-embed-form-<?php echo $quiz_id; ?>">
			<?php foreach ( $questions as $q_index => $question ) : ?>
				<?php
				$question_text = $question['question_text'] ?? '';
				$answers = $question['question_answers'] ?? array();
				?>
				<?php if ( $question_text && ! empty( $answers ) ) : ?>
					<div class="quiz-embed-question" data-question="<?php echo $q_index; ?>" <?php echo ( $q_index > 0 ) ? 'style="display: none;"' : ''; ?>>
						<h3 class="quiz-embed-question-title"><?php echo esc_html( $question_text ); ?></h3>
						<div class="quiz-embed-answers">
							<?php foreach ( $answers as $a_index => $answer ) : ?>
								<?php
								$answer_text = $answer['answer_text'] ?? '';
								$answer_points = $answer['answer_points'] ?? 1;
								?>
								<?php if ( $answer_text ) : ?>
									<label class="quiz-embed-answer">
										<input type="radio" name="question_<?php echo $q_index; ?>" value="<?php echo esc_attr( $a_index ); ?>" data-points="<?php echo esc_attr( $answer_points ); ?>" required>
										<span class="quiz-embed-answer-text"><?php echo esc_html( $answer_text ); ?></span>
									</label>
								<?php endif; ?>
							<?php endforeach; ?>
						</div>
						<div class="quiz-embed-navigation">
							<?php if ( $q_index > 0 ) : ?>
								<button type="button" class="quiz-embed-btn quiz-embed-btn-prev">Назад</button>
							<?php endif; ?>
							<?php if ( $q_index < count( $questions ) - 1 ) : ?>
								<button type="button" class="quiz-embed-btn quiz-embed-btn-next">Далее</button>
							<?php else : ?>
								<button type="submit" class="quiz-embed-btn quiz-embed-btn-submit">Завершить квиз</button>
							<?php endif; ?>
						</div>
					</div>
				<?php endif; ?>
			<?php endforeach; ?>
		</form>

		<div class="quiz-embed-result" id="quiz-embed-result-<?php echo $quiz_id; ?>" style="display: none;">
			<div class="quiz-embed-result-content" id="quiz-embed-result-content-<?php echo $quiz_id; ?>"></div>
			<button type="button" class="quiz-embed-btn quiz-embed-btn-restart" data-quiz-id="<?php echo $quiz_id; ?>">Пройти заново</button>
		</div>
	</div>
	<?php
	return ob_get_clean();
}
add_shortcode( 'quiz', 'cenzor_quiz_shortcode' );

