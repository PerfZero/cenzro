<?php
/**
 * Template part for displaying partners section
 *
 * @package cenzor
 */
?>

<section class="partners-section">
	<div class="container">
		<h2 class="partners-title">Наши партнеры и компании с кем мы сотрудничаем</h2>
		<div class="partners-grid">
			<?php
			$partners = new WP_Query( array(
				'post_type'      => 'partner',
				'posts_per_page' => -1,
				'post_status'    => 'publish',
				'orderby'        => 'menu_order',
				'order'          => 'ASC',
			) );

			$empty_positions = array( 3, 5 );
			$partner_index = 0;
			$partners_array = array();
			if ( $partners->have_posts() ) {
				$partners_array = $partners->posts;
			}
			
			for ( $i = 1; $i <= 17; $i++ ) :
				if ( $i == 3 ) :
					?>
					<div class="partner-item div<?php echo $i; ?>">
						<div class="partner-text">20 +</div>
					</div>
					<?php
				elseif ( $i == 5 ) :
					?>
					<div class="partner-item div<?php echo $i; ?>">
						<div class="partner-text"></div>
					</div>
					<?php
				elseif ( in_array( $i, $empty_positions ) ) :
					?>
					<div class="partner-item div<?php echo $i; ?>"></div>
					<?php
				else :
					if ( isset( $partners_array[ $partner_index ] ) ) :
						$partner = $partners_array[ $partner_index ];
						$partner_image = '';
						if ( has_post_thumbnail( $partner->ID ) ) {
							$partner_image = get_the_post_thumbnail_url( $partner->ID, 'full' );
						}
						?>
						<div class="partner-item div<?php echo $i; ?>">
							<?php if ( $partner_image ) : ?>
								<div class="partner-image">
									<img src="<?php echo esc_url( $partner_image ); ?>" alt="<?php echo esc_attr( $partner->post_title ); ?>">
								</div>
							<?php endif; ?>
						</div>
						<?php
						$partner_index++;
					else :
						?>
						<div class="partner-item div<?php echo $i; ?>"></div>
						<?php
					endif;
				endif;
			endfor;
			
			wp_reset_postdata();
			?>
		</div>
	</div>
</section>

