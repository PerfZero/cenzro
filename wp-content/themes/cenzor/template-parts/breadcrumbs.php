<?php
if ( ! function_exists( 'get_home_url' ) ) {
	return;
}

$home_url = home_url( '/' );
$home_text = 'Главная';
$separator = ' / ';

$breadcrumbs = array();
$breadcrumbs[] = array(
	'name' => $home_text,
	'url'  => $home_url,
);

if ( is_front_page() ) {
	$breadcrumbs = array( $breadcrumbs[0] );
} elseif ( is_home() ) {
	$breadcrumbs[] = array(
		'name' => 'Блог',
		'url'  => get_permalink( get_option( 'page_for_posts' ) ),
	);
} elseif ( is_page() ) {
	$post = get_queried_object();
	if ( $post->post_parent ) {
		$ancestors = get_post_ancestors( $post->ID );
		$ancestors = array_reverse( $ancestors );
		foreach ( $ancestors as $ancestor ) {
			$breadcrumbs[] = array(
				'name' => get_the_title( $ancestor ),
				'url'  => get_permalink( $ancestor ),
			);
		}
	}
	$breadcrumbs[] = array(
		'name' => get_the_title(),
		'url'  => get_permalink(),
	);
} elseif ( is_singular( 'profession' ) ) {
	$archive_url = get_post_type_archive_link( 'profession' );
	if ( $archive_url ) {
		$post_type_object = get_post_type_object( 'profession' );
		$breadcrumbs[] = array(
			'name' => $post_type_object->labels->name,
			'url'  => $archive_url,
		);
	}
	$breadcrumbs[] = array(
		'name' => get_the_title(),
		'url'  => get_permalink(),
	);
} elseif ( is_singular( 'osnovnye_svedeniya' ) ) {
	$post = get_queried_object();
	if ( $post->post_parent ) {
		$ancestors = get_post_ancestors( $post->ID );
		$ancestors = array_reverse( $ancestors );
		foreach ( $ancestors as $ancestor ) {
			$breadcrumbs[] = array(
				'name' => get_the_title( $ancestor ),
				'url'  => get_permalink( $ancestor ),
			);
		}
	}
	$breadcrumbs[] = array(
		'name' => get_the_title(),
		'url'  => get_permalink(),
	);
} elseif ( is_singular() ) {
	$post_type = get_post_type();
	$post_type_object = get_post_type_object( $post_type );
	if ( $post_type_object ) {
		$archive_url = get_post_type_archive_link( $post_type );
		if ( $archive_url ) {
			$breadcrumbs[] = array(
				'name' => $post_type_object->labels->name,
				'url'  => $archive_url,
			);
		}
	}
	$breadcrumbs[] = array(
		'name' => get_the_title(),
		'url'  => get_permalink(),
	);
} elseif ( is_category() ) {
	$category = get_queried_object();
	$breadcrumbs[] = array(
		'name' => 'Категория: ' . $category->name,
		'url'  => get_category_link( $category->term_id ),
	);
} elseif ( is_tag() ) {
	$tag = get_queried_object();
	$breadcrumbs[] = array(
		'name' => 'Метка: ' . $tag->name,
		'url'  => get_tag_link( $tag->term_id ),
	);
} elseif ( is_tax() ) {
	$term = get_queried_object();
	$taxonomy = get_taxonomy( $term->taxonomy );
	$breadcrumbs[] = array(
		'name' => $taxonomy->labels->singular_name . ': ' . $term->name,
		'url'  => get_term_link( $term ),
	);
} elseif ( is_post_type_archive() ) {
	$post_type = get_query_var( 'post_type' );
	$post_type_object = get_post_type_object( $post_type );
	if ( $post_type_object ) {
		$breadcrumbs[] = array(
			'name' => $post_type_object->labels->name,
			'url'  => get_post_type_archive_link( $post_type ),
		);
	}
} elseif ( is_archive() ) {
	$breadcrumbs[] = array(
		'name' => get_the_archive_title(),
		'url'  => get_post_type_archive_link( get_post_type() ),
	);
} elseif ( is_search() ) {
	$breadcrumbs[] = array(
		'name' => 'Результаты поиска: ' . get_search_query(),
		'url'  => get_search_link(),
	);
} elseif ( is_404() ) {
	$request_uri = isset( $_SERVER['REQUEST_URI'] ) ? esc_url_raw( home_url( $_SERVER['REQUEST_URI'] ) ) : '';
	$breadcrumbs[] = array(
		'name' => 'Страница не найдена',
		'url'  => $request_uri,
	);
}

$breadcrumbs_json = array(
	'@context' => 'https://schema.org',
	'@type'    => 'BreadcrumbList',
	'itemListElement' => array(),
);

foreach ( $breadcrumbs as $index => $crumb ) {
	$position = $index + 1;
	$item_data = array(
		'@type'    => 'ListItem',
		'position' => $position,
		'name'     => $crumb['name'],
	);
	if ( ! empty( $crumb['url'] ) ) {
		$item_data['item'] = $crumb['url'];
	}
	$breadcrumbs_json['itemListElement'][] = $item_data;
}
?>

<nav class="breadcrumbs" aria-label="Хлебные крошки">
	<div class="container">
		<div class="breadcrumbs-list">
			<?php foreach ( $breadcrumbs as $index => $crumb ) : ?>
				<?php if ( $index > 0 ) : ?>
					<span class="breadcrumbs-separator"><?php echo esc_html( $separator ); ?></span>
				<?php endif; ?>
				<?php if ( $index === count( $breadcrumbs ) - 1 ) : ?>
					<span class="breadcrumbs-item breadcrumbs-current"><?php echo esc_html( $crumb['name'] ); ?></span>
				<?php else : ?>
					<a href="<?php echo esc_url( $crumb['url'] ); ?>" class="breadcrumbs-item"><?php echo esc_html( $crumb['name'] ); ?></a>
				<?php endif; ?>
			<?php endforeach; ?>
		</div>
	</div>
</nav>

<script type="application/ld+json">
<?php echo wp_json_encode( $breadcrumbs_json, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ); ?>
</script>









