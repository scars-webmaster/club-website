<?php
/**
 * Simplenews Theme Customizer
 *
 * @package SimpleNews
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
if ( ! function_exists( 'simplenews_customize_register' ) ) {
	/**
	 * Register basic customizer support.
	 *
	 * @param object $wp_customize Customizer reference.
	 */
	function simplenews_customize_register( $wp_customize ) {
		if ( $wp_customize->get_control( 'custom_logo' ) ) {
			$wp_customize->get_setting( 'custom_logo' )->transport = 'refresh';
		}
		$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial(
				'blogname',
				array(
					'selector'        => '.site-title a',
					'render_callback' => 'simplenews_customize_partial_blogname',
				)
			);
			$wp_customize->selective_refresh->add_partial(
				'blogdescription',
				array(
					'selector'        => '.site-description',
					'render_callback' => 'simplenews_customize_partial_blogdescription',
				)
			);
		}
	}
}
add_action( 'customize_register', 'simplenews_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function simplenews_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function simplenews_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

if ( ! function_exists( 'simplenews_theme_customize_register' ) ) {
	/**
	 * Register individual settings through customizer's API.
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer reference.
	 */
	function simplenews_theme_customize_register( $wp_customize ) {

		// Theme layout settings.
		$wp_customize->add_section(
			'simplenews_theme_layout_options',
			array(
				'title'       => __( 'Theme Layout Settings', 'simple-news' ),
				'capability'  => 'edit_theme_options',
				'description' => __( 'Container width and sidebar defaults', 'simple-news' ),
				'priority'    => apply_filters( 'simplenews_theme_layout_options_priority', 160 ),
			)
		);

		/**
		 * Select sanitization function
		 *
		 * @param string               $input   Slug to sanitize.
		 * @param WP_Customize_Setting $setting Setting instance.
		 * @return string Sanitized slug if it is a valid choice; otherwise, the setting default.
		 */
		function simplenews_theme_slug_sanitize_select( $input, $setting ) {

			// Ensure input is a slug (lowercase alphanumeric characters, dashes and underscores are allowed only).
			$input = sanitize_key( $input );

			// Get the list of possible select options.
			$choices = $setting->manager->get_control( $setting->id )->choices;

			// If the input is a valid key, return it; otherwise, return the default.
			return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

		}

		$wp_customize->add_setting(
			'simplenews_container_type',
			array(
				'default'           => 'container',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'simplenews_theme_slug_sanitize_select',
				'capability'        => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'simplenews_container_type',
				array(
					'label'       => __( 'Container Width', 'simple-news' ),
					'description' => __( 'Choose between Bootstrap\'s container and container-fluid', 'simple-news' ),
					'section'     => 'simplenews_theme_layout_options',
					'settings'    => 'simplenews_container_type',
					'type'        => 'select',
					'choices'     => array(
						'container'       => __( 'Fixed width container', 'simple-news' ),
						'container-fluid' => __( 'Full width container', 'simple-news' ),
					),
					'priority'    => apply_filters( 'simplenews_container_type_priority', 10 ),
				)
			)
		);

		$wp_customize->add_setting(
			'simplenews_sidebar_position',
			array(
				'default'           => 'right',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_text_field',
				'capability'        => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'simplenews_sidebar_position',
				array(
					'label'             => __( 'Sidebar Positioning', 'simple-news' ),
					'description'       => __(
						'Set sidebar\'s default position. Can either be: right, left, both or none. Note: this can be overridden on individual pages.',
						'simple-news'
					),
					'section'           => 'simplenews_theme_layout_options',
					'settings'          => 'simplenews_sidebar_position',
					'type'              => 'select',
					'sanitize_callback' => 'simplenews_theme_slug_sanitize_select',
					'choices'           => array(
						'right' => __( 'Right sidebar', 'simple-news' ),
						'left'  => __( 'Left sidebar', 'simple-news' ),
						'both'  => __( 'Left & Right sidebars', 'simple-news' ),
						'none'  => __( 'No sidebar', 'simple-news' ),
					),
					'priority'          => apply_filters( 'simplenews_sidebar_position_priority', 20 ),
				)
			)
		);
	}
} // endif function_exists( 'simplenews_theme_customize_register' ).
add_action( 'customize_register', 'simplenews_theme_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
if ( ! function_exists( 'simplenews_customize_preview_js' ) ) {
	/**
	 * Setup JS integration for live previewing.
	 */
	function simplenews_customize_preview_js() {
		wp_enqueue_script(
			'simplenews_customizer',
			get_template_directory_uri() . '/js/customizer.js',
			array( 'customize-preview' ),
			'20151215',
			true
		);
	}
}
add_action( 'customize_preview_init', 'simplenews_customize_preview_js' );
