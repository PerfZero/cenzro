<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package cenzor
 */

get_header();
?>

<section class="hero-section">
	<div class="container">
	<?php
	$hero_image = get_field( 'hero_background_image' );
	$hero_image_url = '';
	if ( $hero_image ) {
		if ( is_array( $hero_image ) && isset( $hero_image['url'] ) ) {
			$hero_image_url = $hero_image['url'];
		} elseif ( is_numeric( $hero_image ) ) {
			$hero_image_url = wp_get_attachment_image_url( $hero_image, 'full' );
		} elseif ( is_string( $hero_image ) ) {
			$hero_image_url = $hero_image;
		}
	}
	?>
	<div class="hero-background"<?php echo $hero_image_url ? ' style="background-image: url(' . esc_url( $hero_image_url ) . ');"' : ''; ?>></div>
		<div class="hero-content">
			<h1 class="hero-title"><span>ЦЕНЗОР</span> - Дистанционное обучение по всей России</h1>
			<p class="hero-description">Дополнительное обучение<br>Повышение квалификации<br>Профессиональная переподготовка<br>После обучения бесплатно доставим документы в любую точку России<br>стань профессионалом в новой профессии</p>
			<a href="#" class="hero-button">Консультация</a>
		</div>
	

	<div class="hero_bottom">		
	<div class="hero-navigation">
		<button class="nav-arrow nav-prev">
			<i class="fas fa-chevron-left"></i>
		</button>
		<button class="nav-arrow nav-next">
			<i class="fas fa-chevron-right"></i>
		</button>
		<div class="progress-bar">
			<div class="progress-fill"></div>
		</div>
	</div>
	
	<div class="hero-stats">
			<div class="stats-grid">
				<div class="stat-item">
					<div class="stat-number">31127</div>
					<div class="stat-label">Выпускников</div>
				</div>
				<div class="stat-item">
					<div class="stat-number">11 Лет</div>
					<div class="stat-label">На рынке</div>
				</div>
				<div class="stat-item">
					<div class="stat-number">67 Человек</div>
					<div class="stat-label">Обучаются сегодня</div>
				</div>
		</div>
	</div>
	</div>
	</div>
</section>

<section class="professions-section">
	<div class="container">
		<h2 class="professions-title">Какую профессию хотите выбрать?</h2>
		<div class="swiper professions-swiper">
			<div class="swiper-wrapper">
				<?php
				$professions = new WP_Query( array(
					'post_type'      => 'profession',
					'posts_per_page' => -1,
					'post_status'    => 'publish',
				) );

				if ( $professions->have_posts() ) :
					while ( $professions->have_posts() ) : $professions->the_post();
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
						?>
						<div class="swiper-slide">
							<div class="profession-card">
								<?php if ( $image_url ) : ?>
									<div class="profession-image">
										<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
									</div>
								<?php endif; ?>
								<div class="profession-name"><?php echo esc_html( get_the_title() ); ?></div>
							</div>
						</div>
						<?php
					endwhile;
					wp_reset_postdata();
				endif;
				?>
			</div>
			<div class="swiper-button-next"></div>
			<div class="swiper-button-prev"></div>
			<div class="swiper-pagination"></div>
		</div>
	</div>
</section>

<?php
get_footer();
