<?php
/**
 * cenzor Theme Customizer
 *
 * @package cenzor
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function cenzor_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'cenzor_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'cenzor_customize_partial_blogdescription',
			)
		);
	}

	$wp_customize->add_setting(
		'header_phone',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'header_phone',
		array(
			'label'    => esc_html__( 'Header Phone', 'cenzor' ),
			'section'  => 'title_tagline',
			'type'     => 'text',
		)
	);
}
add_action( 'customize_register', 'cenzor_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function cenzor_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function cenzor_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function cenzor_customize_preview_js() {
	wp_enqueue_script( 'cenzor-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), _S_VERSION, true );
}
add_action( 'customize_preview_init', 'cenzor_customize_preview_js' );
