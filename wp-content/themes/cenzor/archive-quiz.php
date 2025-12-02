<?php
get_header();
?>

<main id="primary" class="site-main">
	<?php get_template_part( 'template-parts/breadcrumbs' ); ?>

	<?php if ( have_posts() ) : ?>
		<section class="quiz-archive-section">
			<div class="container">
				<header class="quiz-archive-header">
					<h1 class="quiz-archive-title">Квизы</h1>
				</header>

				<div class="quiz-archive-grid">
					<?php
					while ( have_posts() ) :
						the_post();
						?>
						<article class="quiz-card">
							<?php if ( has_post_thumbnail() ) : ?>
								<div class="quiz-card-image">
									<a href="<?php the_permalink(); ?>">
										<?php the_post_thumbnail( 'medium' ); ?>
									</a>
								</div>
							<?php endif; ?>
							<div class="quiz-card-content">
								<h2 class="quiz-card-title">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h2>
								<?php if ( get_the_content() ) : ?>
									<div class="quiz-card-excerpt">
										<?php echo wp_trim_words( get_the_content(), 20 ); ?>
									</div>
								<?php endif; ?>
								<a href="<?php the_permalink(); ?>" class="quiz-card-button">Пройти квиз</a>
							</div>
						</article>
					<?php endwhile; ?>
				</div>

				<?php
				the_posts_pagination(
					array(
						'mid_size'  => 2,
						'prev_text' => '←',
						'next_text' => '→',
					)
				);
				?>
			</div>
		</section>
	<?php else : ?>
		<section class="quiz-archive-section">
			<div class="container">
				<p>Квизы не найдены.</p>
			</div>
		</section>
	<?php endif; ?>
</main>

<?php
get_footer();




