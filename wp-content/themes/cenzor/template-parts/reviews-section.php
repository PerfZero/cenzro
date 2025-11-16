<?php
/**
 * Template part for displaying reviews section
 *
 * @package cenzor
 */
?>

<section class="reviews-section">
	<div class="container">
		<h2 class="reviews-title">Отзывы наших клиентов</h2>
		<div class="reviews-widget">
			<?php
			if ( is_active_sidebar( 'yandex-reviews' ) ) {
				dynamic_sidebar( 'yandex-reviews' );
			}
			?>
		</div>
	</div>
</section>

