<?php
get_header();
?>

<main id="primary" class="site-main">
	<?php
	while ( have_posts() ) :
		the_post();
		?>
		<?php get_template_part( 'template-parts/breadcrumbs' ); ?>

		<section class="quiz-section">
			<div class="container">
				<h1 class="quiz-title"><?php the_title(); ?></h1>
				<?php if ( get_the_content() ) : ?>
					<div class="quiz-description">
						<?php the_content(); ?>
					</div>
				<?php endif; ?>

				<?php
				$questions = get_field( 'quiz_questions' );
				if ( $questions ) :
					?>
					<div class="quiz-container" id="quiz-container">
						<div class="quiz-progress">
							<div class="quiz-progress-bar">
								<div class="quiz-progress-fill" id="quiz-progress-fill"></div>
							</div>
							<span class="quiz-progress-text" id="quiz-progress-text">Вопрос 1 из <?php echo count( $questions ); ?></span>
						</div>

						<form id="quiz-form" class="quiz-form" data-quiz-id="<?php echo get_the_ID(); ?>">
							<?php foreach ( $questions as $q_index => $question ) : ?>
								<?php
								$question_text = $question['question_text'] ?? '';
								$answers = $question['question_answers'] ?? array();
								?>
								<?php if ( $question_text && ! empty( $answers ) ) : ?>
									<div class="quiz-question" data-question="<?php echo $q_index; ?>" <?php echo ( $q_index > 0 ) ? 'style="display: none;"' : ''; ?>>
										<h2 class="quiz-question-title"><?php echo esc_html( $question_text ); ?></h2>
										<div class="quiz-answers">
											<?php foreach ( $answers as $a_index => $answer ) : ?>
												<?php
												$answer_text = $answer['answer_text'] ?? '';
												$answer_points = $answer['answer_points'] ?? 1;
												?>
												<?php if ( $answer_text ) : ?>
													<label class="quiz-answer">
														<input type="radio" name="question_<?php echo $q_index; ?>" value="<?php echo esc_attr( $a_index ); ?>" data-points="<?php echo esc_attr( $answer_points ); ?>" required>
														<span class="quiz-answer-text"><?php echo esc_html( $answer_text ); ?></span>
													</label>
												<?php endif; ?>
											<?php endforeach; ?>
										</div>
										<div class="quiz-navigation">
											<?php if ( $q_index > 0 ) : ?>
												<button type="button" class="quiz-btn quiz-btn-prev">Назад</button>
											<?php endif; ?>
											<?php if ( $q_index < count( $questions ) - 1 ) : ?>
												<button type="button" class="quiz-btn quiz-btn-next">Далее</button>
											<?php else : ?>
												<button type="submit" class="quiz-btn quiz-btn-submit">Завершить квиз</button>
											<?php endif; ?>
										</div>
									</div>
								<?php endif; ?>
							<?php endforeach; ?>
						</form>

					<div class="quiz-contact-form" id="quiz-contact-form" style="display: none;">
						<h3 class="quiz-contact-title">Оставьте контакты для получения результатов</h3>
						<form id="quiz-contact-form-inner" class="quiz-contact-form-inner">
							<div class="form-group">
								<label for="quiz-contact-name">Ваше имя *</label>
								<input type="text" id="quiz-contact-name" name="name" required>
							</div>
							<div class="form-group">
								<label for="quiz-contact-phone">Телефон</label>
								<input type="tel" id="quiz-contact-phone" name="phone">
							</div>
							<div class="form-group">
								<label for="quiz-contact-email">Email</label>
								<input type="email" id="quiz-contact-email" name="email">
							</div>
							<div class="form-group">
								<label class="checkbox-label">
									<input type="checkbox" name="consent" required>
									<span>Я согласен на <a href="/soglasie-na-obrabotku-personalnyh-dannyh/" target="_blank">обработку персональных данных</a></span>
								</label>
							</div>
							<button type="submit" class="quiz-btn quiz-btn-submit-contact">Получить результаты</button>
						</form>
					</div>

					<div class="quiz-result" id="quiz-result" style="display: none;">
						<div class="quiz-result-content" id="quiz-result-content"></div>
						<button type="button" class="quiz-btn quiz-btn-restart" id="quiz-restart">Пройти заново</button>
					</div>
					</div>
				<?php else : ?>
					<p>Вопросы для квиза не добавлены.</p>
				<?php endif; ?>
			</div>
		</section>

	<?php endwhile; ?>
</main>

<?php
get_footer();
