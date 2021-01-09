<?php
/**
 * Simplenews modify editor
 *
 * @package SimpleNews
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

add_theme_support( 'editor-styles' );
add_action( 'admin_init', 'simplenews_add_editor_styles' );
if ( ! function_exists( 'simplenews_add_editor_styles' ) ) {
	function simplenews_add_editor_styles() {
		add_editor_style( 'css/theme.min.css' );
		add_editor_style( 'css/editor-style.min.css' );
	}
}