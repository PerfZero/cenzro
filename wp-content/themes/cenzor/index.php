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
	<div class="hero-background"></div>
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

<?php
get_footer();
