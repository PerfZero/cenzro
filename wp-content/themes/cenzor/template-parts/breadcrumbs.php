<?php
if ( ! function_exists( 'get_home_url' ) ) {
	return;
}

$home_url = home_url( '/' );
$home_text = 'Главная';
$separator = ' / ';
?>

<nav class="breadcrumbs" aria-label="Хлебные крошки">
	<div class="container">
		<div class="breadcrumbs-list">
			<a href="<?php echo esc_url( $home_url ); ?>" class="breadcrumbs-item"><?php echo esc_html( $home_text ); ?></a>
			<span class="breadcrumbs-separator"><?php echo esc_html( $separator ); ?></span>
			<?php
			$post_type = get_post_type();
			$post_type_object = get_post_type_object( $post_type );
			
			if ( $post_type_object ) {
				$archive_url = get_post_type_archive_link( $post_type );
				if ( $archive_url ) {
					?>
					<a href="<?php echo esc_url( $archive_url ); ?>" class="breadcrumbs-item"><?php echo esc_html( $post_type_object->labels->name ); ?></a>
					<span class="breadcrumbs-separator"><?php echo esc_html( $separator ); ?></span>
					<?php
				}
			}
			?>
			<span class="breadcrumbs-item breadcrumbs-current"><?php echo esc_html( get_the_title() ); ?></span>
		</div>
	</div>
</nav>









