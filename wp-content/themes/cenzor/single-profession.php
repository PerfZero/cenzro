<?php
/**
 * The template for displaying single profession posts
 *
 * @package cenzor
 */

get_header();
?>

<main id="primary" class="site-main">

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

		$custom_title = get_field( 'profession_custom_title' );
		$city_name = do_shortcode('[belingogeo_city_field field="city_name"]');
		
		if ( $custom_title && $city_name ) {
			$title = str_replace( '{city}', $city_name, $custom_title );
		} else {
			$title = get_the_title();
		}

		$badges = get_the_terms( get_the_ID(), 'profession_badge' );
		?>

		<section class="profession-hero"<?php if ( $image_url ) : ?> style="background-image: url('<?php echo esc_url( $image_url ); ?>');"<?php endif; ?>>
			<div class="profession-hero-overlay"></div>
			<div class="container">
				<?php get_template_part( 'template-parts/breadcrumbs' ); ?>
				<div class="profession-hero-content">
					<?php if ( $badges && ! is_wp_error( $badges ) ) : ?>
						<div class="profession-badges">
							<?php foreach ( $badges as $badge ) : ?>
								<span class="profession-badge"><?php echo esc_html( $badge->name ); ?></span>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
					<h1 class="profession-hero-title"><?php echo esc_html( $title ); ?></h1>
					<?php if ( get_the_content() ) : ?>
						<div class="profession-hero-description">
							<?php the_content(); ?>
						</div>
					<?php endif; ?>
					<a href="#consultation" class="profession-consultation-button">Получить консультацию</a>
				</div>
			</div>
		</section>

		<section class="profession-tabs-section">
			<div class="container">
				<div class="profession-tabs-nav">
					<a href="#profession-description" class="profession-tab-btn">Описание</a>
					<a href="#profession-results" class="profession-tab-btn">Результаты</a>
					<a href="#profession-pricing" class="profession-tab-btn">Стоимость</a>
					<a href="#profession-steps" class="profession-tab-btn">4 шага</a>
				</div>
			</div>
		</section>

		<?php 
		$description = get_field( 'profession_tab_description' );
		if ( $description ) : ?>
			<section id="profession-description" class="profession-content-section">
				<div class="container">
					<h2 class="profession-section-title">Описание</h2>
					<div class="profession-tab-content">
						<?php echo wp_kses_post( $description ); ?>
					</div>
				</div>
			</section>
		<?php endif; ?>

		<?php 
		$results = get_field( 'profession_tab_results' );
		if ( $results && is_array( $results ) ) : ?>
			<section id="profession-results" class="profession-content-section">
				<div class="container">
					<h2 class="profession-section-title">Результаты обучения</h2>
					<div class="profession-results-grid">
						<?php foreach ( $results as $result ) : ?>
							<div class="profession-result-item">
								<div class="profession-result-icon">
									<i class="fas fa-check"></i>
								</div>
								<div class="profession-result-text"><?php echo esc_html( $result['result_text'] ); ?></div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</section>
		<?php endif; ?>


		<?php 
		$pricing = get_field( 'profession_tab_pricing' );
		if ( $pricing && is_array( $pricing ) ) : ?>
			<section id="profession-pricing" class="profession-content-section">
				<div class="container">
					<h2 class="profession-section-title">Стоимость обучения на все программы по Транспортной Безопасности</h2>
					<div class="profession-pricing-table">
						<table>
							<thead>
								<tr>
									<th>Программа</th>
									<th>Часы</th>
									<th>Цена</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ( $pricing as $item ) : ?>
									<tr>
										<td><?php echo esc_html( $item['program'] ); ?></td>
										<td><?php echo esc_html( $item['hours'] ); ?></td>
										<td><?php echo esc_html( $item['price'] ); ?></td>
										<td>
											<a href="#consultation" class="profession-pricing-button">Записаться</a>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</section>
		<?php endif; ?>

		<?php 
		$steps = get_field( 'profession_tab_steps' );
		if ( $steps && is_array( $steps ) ) : ?>
			<section id="profession-steps" class="profession-content-section">
				<div class="container">
					<h2 class="profession-section-title">4 ШАГА ДЛЯ ОБУЧЕНИЯ ПО ТРАНСПОРТНОЙ БЕЗОПАСНОСТИ</h2>
					<div class="profession-steps-horizontal">
						<?php foreach ( $steps as $index => $step ) : ?>
							<div class="profession-step-horizontal">
								<div class="profession-step-circle">
									<div class="profession-step-circle-number"><?php echo esc_html( $index + 1 ); ?></div>
								</div>
								<h3 class="profession-step-horizontal-title"><?php echo esc_html( $step['step_title'] ); ?></h3>
								<?php if ( $step['step_description'] ) : ?>
									<div class="profession-step-horizontal-description">
										<?php echo wp_kses_post( nl2br( $step['step_description'] ) ); ?>
									</div>
								<?php endif; ?>
								<?php if ( $index === 0 ) : ?>
									<a href="#consultation" class="profession-step-button">Оставить заявку</a>
								<?php endif; ?>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</section>
		<?php endif; ?>

		<section class="profession-related-section">
			<div class="container">
				<h2 class="profession-related-title">Вас также могут заинтересовать следующие программы обучения</h2>
				<?php
				$current_id = get_the_ID();
				$related_professions = new WP_Query( array(
					'post_type'      => 'profession',
					'posts_per_page' => 6,
					'post_status'    => 'publish',
					'post__not_in'   => array( $current_id ),
					'orderby'        => 'rand',
				) );

				if ( $related_professions->have_posts() ) : ?>
					<div class="profession-related-grid">
						<?php while ( $related_professions->have_posts() ) : $related_professions->the_post();
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
				<?php 
				wp_reset_postdata();
				endif; ?>
			</div>
		</section>

		<?php get_template_part( 'template-parts/certificates-section' ); ?>

		<?php get_template_part( 'template-parts/partners-section' ); ?>

		<?php get_template_part( 'template-parts/reviews-section' ); ?>

		<section class="profession-related-section">
			<div class="container">
				<h2 class="profession-related-title">Вас также могут заинтересовать следующие программы обучения</h2>
				<?php
				$current_id = get_the_ID();
				$related_professions = new WP_Query( array(
					'post_type'      => 'profession',
					'posts_per_page' => 6,
					'post_status'    => 'publish',
					'post__not_in'   => array( $current_id ),
					'orderby'        => 'rand',
				) );

				if ( $related_professions->have_posts() ) : ?>
					<div class="profession-related-grid">
						<?php while ( $related_professions->have_posts() ) : $related_professions->the_post();
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
				<?php 
				wp_reset_postdata();
				endif; ?>
			</div>
		</section>

		<?php get_template_part( 'template-parts/map-section' ); ?>

	<?php endwhile; ?>

</main>

<?php
get_footer();

