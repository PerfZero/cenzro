<?php
get_header();
?>

<main id="primary" class="site-main">

	<?php if ( have_posts() ) : ?>

		<section class="profession-archive-section">
			<div class="container">
				<header class="profession-archive-header">
					<?php
					the_archive_title( '<h1 class="profession-archive-title">', '</h1>' );
					the_archive_description( '<div class="profession-archive-description">', '</div>' );
					?>
				</header>

				<div class="profession-related-grid">
					<?php
					while ( have_posts() ) :
						the_post();

						$profession_image = get_field( 'profession_image' );
						$image_url = '';
						
						if ( $profession_image ) {
							if ( is_array( $profession_image ) && isset( $profession_image['url'] ) ) {
								$image_url = $profession_image['url'];
							} elseif ( is_numeric( $profession_image ) ) {
								$image_url = wp_get_attachment_image_url( $profession_image, 'full' );
							} elseif ( is_string( $profession_image ) ) {
								$image_url = $profession_image;
							}
						}
						
						if ( ! $image_url && has_post_thumbnail() ) {
							$image_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
						}

						$min_price = get_field( 'profession_min_price' );
						if ( ! $min_price ) {
							$pricing = get_field( 'profession_tab_pricing' );
							if ( $pricing && is_array( $pricing ) && ! empty( $pricing ) ) {
								$prices = array();
								foreach ( $pricing as $item ) {
									if ( isset( $item['price'] ) ) {
										$price_clean = preg_replace( '/[^0-9]/', '', $item['price'] );
										if ( $price_clean ) {
											$prices[] = intval( $price_clean );
										}
									}
								}
								if ( ! empty( $prices ) ) {
									$min_price = min( $prices );
									$min_price = number_format( $min_price, 0, ',', ' ' );
								}
							}
						}
						?>
						<div class="profession-related-card">
							<?php if ( $image_url ) : ?>
								<div class="profession-related-image">
									<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
								</div>
							<?php endif; ?>
							<div class="profession-related-card-content">
								<div class="profession-related-name"><?php echo esc_html( get_the_title() ); ?></div>
								<?php if ( $min_price ) : ?>
									<div class="profession-related-price">
										<span class="profession-related-price-label">Стоимость</span>
										<span class="profession-related-price-value">от <?php echo esc_html( $min_price ); ?> руб.</span>
									</div>
								<?php endif; ?>
								<a href="<?php the_permalink(); ?>" class="profession-related-button">Подробнее</a>
							</div>
						</div>
					<?php endwhile; ?>
				</div>

				<?php the_posts_pagination(); ?>

			</div>
		</section>

	<?php else : ?>

		<section class="profession-archive-section">
			<div class="container">
				<?php get_template_part( 'template-parts/content', 'none' ); ?>
			</div>
		</section>

	<?php endif; ?>

</main>

<?php
get_footer();

