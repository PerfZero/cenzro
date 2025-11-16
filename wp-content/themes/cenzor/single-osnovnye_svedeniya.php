<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package cenzor
 */

get_header();
?>

<main id="primary" class="site-main">

	<?php
	while ( have_posts() ) :
		the_post();
		?>

		<?php get_template_part( 'template-parts/breadcrumbs' ); ?>

		<section class="page-content">
			<div class="container">
				<div class="page-layout-wrapper">
					<div class="page-main-content">
						<?php get_template_part( 'template-parts/content', 'page' ); ?>
					</div>
					<?php get_template_part( 'template-parts/callback-form' ); ?>
				</div>
			</div>
		</section>

		<?php
		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;
		?>

	<?php endwhile; // End of the loop. ?>

</main><!-- #main -->

<?php
get_footer();
