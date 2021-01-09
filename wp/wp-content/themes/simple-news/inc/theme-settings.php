<?php
/**
 * Check and setup theme's default settings
 *
 * @package SimpleNews
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'simplenews_setup_theme_default_settings' ) ) {
	/**
	 * Store default theme settings in database.
	 */
	function simplenews_setup_theme_default_settings() {
		$defaults = simplenews_get_theme_default_settings();
		$settings = get_theme_mods();
		foreach ( $defaults as $setting_id => $default_value ) {
			// Check if setting is set, if not set it to its default value.
			if ( ! isset( $settings[ $setting_id ] ) ) {
				set_theme_mod( $setting_id, $default_value );
			}
		}
	}
}

if ( ! function_exists( 'simplenews_get_theme_default_settings' ) ) {
	/**
	 * Retrieve default theme settings.
	 *
	 * @return array
	 */
	function simplenews_get_theme_default_settings() {
		$defaults = array(
			'simplenews_posts_index_style' => 'default',   // Latest blog posts style.
			'simplenews_sidebar_position'  => 'both',     // Sidebar position.
			'simplenews_container_type'    => 'container-fluid', // Container width.
		);

		/**
		 * Filters the default theme settings.
		 *
		 * @param array $defaults Array of default theme settings.
		 */
		return apply_filters( 'simplenews_theme_default_settings', $defaults );
	}
}
