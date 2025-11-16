<?php
/**
 * Template part for displaying certificates section
 *
 * @package cenzor
 */
?>

<section class="certificates-section">
	<div class="container">
		<h2 class="certificates-title">Сертификаты</h2>
		<div class="swiper certificates-swiper">
			<div class="swiper-wrapper">
				<?php
				$certificates = new WP_Query( array(
					'post_type'      => 'certificate',
					'posts_per_page' => -1,
					'post_status'    => 'publish',
					'orderby'        => 'menu_order',
					'order'          => 'ASC',
				) );

				if ( $certificates->have_posts() ) :
					while ( $certificates->have_posts() ) : $certificates->the_post();
						$certificate_image = '';
						if ( has_post_thumbnail() ) {
							$certificate_image = get_the_post_thumbnail_url( get_the_ID(), 'full' );
						}
						?>
						<div class="swiper-slide">
							<div class="certificate-card">
								<?php if ( $certificate_image ) : ?>
									<div class="certificate-image">
										<img src="<?php echo esc_url( $certificate_image ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
									</div>
								<?php endif; ?>
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
		<div class="certificates-license-text">
			<p>Государственная лицензия образовательного учреждения Российской Федерации позволяет выдавать учебному центру «Цензор» дипломы и удостоверения соответствующие требованиям любых контролирующих органов.</p>
		</div>
	</div>
</section>

