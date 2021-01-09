<?php
/**
 * Enqueue scripts and styles for the theme.
 * This file is loaded via the 'after_setup_theme' hook at priority '10'
 *
 * @package    Hoot
 * @subpackage Hoot Ubix
 */

/* Add custom scripts. Set priority to 10 so that the main script.js is loaded after theme scripts. */
add_action( 'wp_enqueue_scripts', 'hootubix_base_enqueue_scripts', 10 );

/* Localize scripts (Must be called after the script has been registered). Use priority 10 to localie both theme script (enqueues above at priority 10) and core main script.js (which is registered at priority 0, but enqueues at 12) */
add_action( 'wp_enqueue_scripts', 'hootubix_localize_theme_script', 10 );

/* Add custom styles. Set priority to default 10 so that theme's main style is loaded after these styles (at priority 12), and can thus easily override any style without over-qualification. */
add_action( 'wp_enqueue_scripts', 'hootubix_base_enqueue_styles', 10 );

/* Dequeue font awesome */
add_action( 'wp_enqueue_scripts', 'hootubix_base_dequeue_fontawesome', 99 );

/**
 * Load scripts for the front end.
 *
 * @since 1.0
 * @access public
 * @return void
 */

if ( !function_exists( 'hootubix_base_enqueue_scripts' ) ) :
function hootubix_base_enqueue_scripts() {

	/* Load jquery */
	wp_enqueue_script( 'jquery' );

	/* Load modernizr */
	$script_uri = hybridextend_locate_script( 'js/modernizr.custom' );
	wp_enqueue_script( 'hootubix-modernizr', $script_uri, array(), '2.8.3' );

	/* Load Superfish and WP's hoverIntent */
	// WordPress prior to v3.6 uses an older version of HoverIntent which doesn't support event delegation :( 
	wp_enqueue_script( 'hoverIntent' );
	$script_uri = hybridextend_locate_script( 'js/jquery.superfish' );
	wp_enqueue_script( 'jquery-superfish', $script_uri, array( 'jquery', 'hoverIntent'), '1.7.5', true );

	/* Load lightSlider if 'hootubix-light-slider' is active. */
	if ( current_theme_supports( 'hootubix-light-slider' ) ) {
		$script_uri = hybridextend_locate_script( 'js/jquery.lightSlider' );
		wp_enqueue_script( 'jquery-lightSlider', $script_uri, array( 'jquery' ), '1.1.1', true );
	}

	/* Load fitvids */
	$script_uri = hybridextend_locate_script( 'js/jquery.fitvids' );
	wp_enqueue_script( 'jquery-fitvids', $script_uri, array(), '1.1', true );

	/* Load parallax */
	$script_uri = hybridextend_locate_script( 'js/jquery.parallax' );
	wp_enqueue_script( 'jquery-parallax', $script_uri, array(), '1.4.2', true );

	/* Load Theme Javascript */
	$script_uri = hybridextend_locate_script( 'js/hoot.theme' );
	wp_enqueue_script( 'hootubix', $script_uri, array(), HYBRIDEXTEND_THEME_VERSION, true );

}
endif;

/**
 * Pass data to Theme Javascript
 *
 * @since 1.0
 * @access public
 * @return void
 */
if ( !function_exists( 'hootubix_localize_theme_script' ) ) :
function hootubix_localize_theme_script() {
	$data = array();
	$data = apply_filters( 'hootubix_localize_theme_script', $data );
	if ( !empty( $data ) )
		wp_localize_script( 'hootubix', 'hootubixData', $data );
}
endif;

/**
 * Load stylesheets for the front end.
 *
 * @since 1.0
 * @access public
 * @return void
 */
if ( !function_exists( 'hootubix_base_enqueue_styles' ) ) :
function hootubix_base_enqueue_styles() {

	/* Load Google Fonts if 'google-fonts' is active. */
	if ( current_theme_supports( 'hootubix-google-fonts' ) ) {
		wp_enqueue_style( 'hootubix-google-fonts', hootubix_google_fonts_enqueue_url(), array(), null );
	}

	/* Load lightSlider style if 'hootubix-light-slider' is active. */
	if ( current_theme_supports( 'hootubix-light-slider' ) ) {
		$style_uri = hybridextend_locate_style( 'css/lightSlider' );
		wp_enqueue_style( 'jquery-lightSlider', $style_uri, false, '1.1.0' );
	}

	/* Load gallery style if 'cleaner-gallery' is active. */
	if ( current_theme_supports( 'cleaner-gallery' ) )
		wp_enqueue_style( 'hybrid-gallery' );

	/* Load gallery styles if Jetpack 'tiled-gallery' module is active */
	if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'tiled-gallery' ) ) {
		wp_enqueue_style( 'hybrid-gallery' );
		$style_uri = hybridextend_locate_style( 'css/jetpack' );
		wp_enqueue_style( 'hootubix-jetpack', $style_uri );
	}

	/* Load font awesome if 'font-awesome' is active. */
	if ( current_theme_supports( 'font-awesome' ) ) {
		if ( apply_filters( 'hootubix_force_theme_fa', true, 'frontend' ) )
			wp_deregister_style( 'font-awesome' ); // Bug Fix for plugins using older font-awesome library
		$style_uri = hybridextend_locate_style( HYBRIDEXTEND_CSS . 'font-awesome' );
		wp_enqueue_style( 'font-awesome', $style_uri, false, '5.0.10' );
	}

###	/* Load rtl style if current locale is RTL */
###	if ( is_rtl() ) {
###		$style_uri = hybridextend_locate_style( 'css/rtl' );
###		wp_enqueue_style( 'style-rtl', $style_uri, false, HYBRIDEXTEND_THEME_VERSION );
###	}

}
endif;

/**
 * Dequeue font awesome from frontend if a similar handle exists (registered by another plugin)
 * but it is already enqueued using the theme
 *
 * @since 1.0
 * @access public
 * @return void
 */
if ( !function_exists( 'hootubix_base_dequeue_fontawesome' ) ) :
function hootubix_base_dequeue_fontawesome() {
	if ( current_theme_supports( 'font-awesome' ) && wp_style_is( 'fontawesome' ) )
		wp_dequeue_style( 'fontawesome' );
}
endif;