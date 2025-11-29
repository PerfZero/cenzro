<?php
$args = array(
	'post_type'      => 'review',
	'posts_per_page' => -1,
	'post_status'    => 'publish',
	'meta_query'     => array(
		'relation' => 'OR',
		array(
			'key'     => 'review_approved',
			'value'   => '1',
			'compare' => '=',
		),
		array(
			'key'     => 'review_approved',
			'compare' => 'NOT EXISTS',
		),
	),
);

$reviews_query = new WP_Query( $args );
?>

<section class="reviews-section">
	<div class="container">
		<h2 class="reviews-title">Отзывы наших клиентов</h2>

		<div class="reviews-grid">
			<?php if ( $reviews_query->have_posts() ) : ?>
				<?php while ( $reviews_query->have_posts() ) : $reviews_query->the_post(); ?>
					<?php
					$review_name = get_field( 'review_name' );
					$review_rating = get_field( 'review_rating' ) ?: 5;
					$review_course = get_field( 'review_course' );
					$review_photo = get_field( 'review_photo' );
					?>
					<div class="review-card">
						<?php if ( $review_photo ) : ?>
							<div class="review-photo">
								<img src="<?php echo esc_url( $review_photo['sizes']['thumbnail'] ?? $review_photo['url'] ); ?>" alt="<?php echo esc_attr( $review_name ); ?>">
							</div>
						<?php else : ?>
							<div class="review-photo review-photo-placeholder">
								<span><?php echo esc_html( mb_substr( $review_name, 0, 1 ) ); ?></span>
							</div>
						<?php endif; ?>
						<div class="review-content">
							<div class="review-header">
								<h3 class="review-name"><?php echo esc_html( $review_name ); ?></h3>
								<?php if ( $review_course ) : ?>
									<span class="review-course"><?php echo esc_html( $review_course ); ?></span>
								<?php endif; ?>
							</div>
							<div class="review-rating">
								<?php for ( $i = 1; $i <= 5; $i++ ) : ?>
									<span class="star <?php echo ( $i <= $review_rating ) ? 'filled' : ''; ?>">★</span>
								<?php endfor; ?>
							</div>
							<div class="review-text">
								<?php the_content(); ?>
							</div>
							<div class="review-date">
								<?php echo get_the_date(); ?>
							</div>
						</div>
					</div>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			<?php else : ?>
				<p class="reviews-empty">Пока нет отзывов. Будьте первым!</p>
			<?php endif; ?>
		</div>

		<button class="review-add-btn" id="review-add-btn">Оставить отзыв</button>
	</div>
</section>

<div id="review-form-modal" class="modal-overlay">
	<div class="modal-content">
		<button class="modal-close" aria-label="Закрыть">&times;</button>
		<h2 class="modal-title">Оставить отзыв</h2>
		<form id="review-form" class="modal-form" method="post" action="">
			<div class="form-group">
				<label for="review-name">Ваше имя *</label>
				<input type="text" id="review-name" name="name" required>
			</div>
			<?php
			$current_profession = '';
			if ( is_singular( 'profession' ) ) {
				$current_profession = get_the_title();
			}
			?>
			<?php if ( ! empty( $current_profession ) ) : ?>
				<input type="hidden" id="review-course" name="course" value="<?php echo esc_attr( $current_profession ); ?>">
			<?php else : ?>
				<div class="form-group">
					<label for="review-course">Профессия (необязательно)</label>
					<select id="review-course" name="course">
						<option value="">Общий отзыв</option>
						<?php
						$professions = get_posts( array(
							'post_type'      => 'profession',
							'posts_per_page' => -1,
							'post_status'    => 'publish',
							'orderby'        => 'title',
							'order'          => 'ASC',
						) );
						if ( $professions ) {
							foreach ( $professions as $profession ) {
								echo '<option value="' . esc_attr( $profession->post_title ) . '">' . esc_html( $profession->post_title ) . '</option>';
							}
						}
						?>
					</select>
				</div>
			<?php endif; ?>
			<div class="form-group">
				<label for="review-rating">Оценка *</label>
				<div class="rating-input">
					<?php for ( $i = 5; $i >= 1; $i-- ) : ?>
						<input type="radio" id="rating-<?php echo $i; ?>" name="rating" value="<?php echo $i; ?>" <?php echo ( $i === 5 ) ? 'checked' : ''; ?> required>
						<label for="rating-<?php echo $i; ?>" class="star-label">★</label>
					<?php endfor; ?>
				</div>
			</div>
			<div class="form-group">
				<label for="review-text">Ваш отзыв *</label>
				<textarea id="review-text" name="text" rows="5" required></textarea>
			</div>
			<div class="form-group">
				<label for="review-photo">Фото (необязательно)</label>
				<input type="file" id="review-photo" name="photo" accept="image/*">
			</div>
			<div class="form-group">
				<label class="checkbox-label">
					<input type="checkbox" name="consent" required>
					<span>Я согласен на <a href="/soglasie-na-obrabotku-personalnyh-dannyh/" target="_blank">обработку персональных данных</a></span>
				</label>
			</div>
			<button type="submit" class="modal-submit">Отправить отзыв</button>
		</form>
	</div>
</div>
