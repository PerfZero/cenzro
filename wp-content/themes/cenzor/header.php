<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package cenzor
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'cenzor' ); ?></a>

	<div class="header-top-bar">
		<div class="container">
			<div class="header-top-bar-content">
				<div class="header-top-bar-left">
					<a href="#" class="bvi-open">Версия для слабовидящих</a>
				</div>
				<div class="header-top-bar-right">
					<a href="mailto:cenzor61@mail.ru" class="header-top-email">
						<i class="fas fa-envelope"></i>
						<span>cenzor61@mail.ru</span>
					</a>
					<a href="<?php echo esc_url( wp_login_url() ); ?>" class="header-top-login">
						<i class="fas fa-user"></i>
						<span>Личный кабинет</span>
					</a>
				</div>
			</div>
		</div>
	</div>

	<header id="masthead" class="site-header">
		<div class="container header-container">
			<div class="header-top">
				<div class="site-branding">
					<?php
					if ( has_custom_logo() ) {
						the_custom_logo();
					} else {
						?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
							<span class="site-title"><?php bloginfo( 'name' ); ?></span>
						</a>
						<?php
					}
					?>
				</div>

				<nav id="site-navigation" class="main-navigation">
					<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
						<i class="fas fa-bars"></i>
						<span class="menu-toggle-text"><?php esc_html_e( 'Menu', 'cenzor' ); ?></span>
					</button>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary-menu',
							'menu_class'     => 'menu',
							'container'      => false,
							'depth'          => 3,
							'fallback_cb'    => false,
						)
					);
					?>
				</nav>

				<div class="header-right">
					<div class="header-phone">
						<?php echo do_shortcode( '[belingogeo_city_field field="city_phone"]' ); ?>
					</div>

					<div class="header-city">
					<?php echo do_shortcode('[belingogeo_selector]')?>
					</div>

					<div class="header-login">
						<a href="<?php echo esc_url( wp_login_url() ); ?>" class="login-button">Войти</a>
					</div>
				</div>
			</div>
		</div>
	</header>

