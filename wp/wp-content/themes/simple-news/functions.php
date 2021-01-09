<?php
/**
 * Simplenews functions and definitions
 *
 * @package SimpleNews
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$simplenews_includes = array(
	'/theme-settings.php',					// Initialize theme default settings.
	'/setup.php',							// Theme setup and custom theme supports.
	'/widgets.php',							// Register widget area.
	'/enqueue.php',							// Enqueue scripts and styles.
	'/template-tags.php',					// Custom template tags for this theme.
	'/pagination.php',						// Custom pagination for this theme.
	'/hooks.php',							// Custom hooks.
	'/extras.php',							// Custom functions that act independently of the theme templates.
	'/custom-comments.php',					// Custom Comments file.
	'/jetpack.php',							// Load Jetpack compatibility file.
	'/class-wp-bootstrap-navwalker.php',	// Load custom WordPress nav walker.
	'/editor-styles.php',					// Load admin editor stylesheet.
	'/customizer.php',                      // Customizer functions.
	'/miscellaneous.php'					// Miscellaneous functions.
);

foreach ( $simplenews_includes as $file ) {
	require_once get_template_directory() . '/inc' . $file;
}
