<?php
/**
 * Register custom theme menus
 * This file is loaded via the 'after_setup_theme' hook at priority '10'
 *
 * @package    Hoot
 * @subpackage Hoot Ubix
 */

/* Register custom menus. */
add_action( 'init', 'hootubix_base_register_menus', 5 );

/**
 * Registers nav menu locations.
 *
 * @since 1.0
 * @access public
 * @return void
 */
function hootubix_base_register_menus() {
	register_nav_menu( 'hoot-primary', _x( 'Header Area (right of logo)', 'nav menu location', 'hoot-ubix' ) );
	register_nav_menu( 'hoot-secondary', _x( 'Full width Menu Area (below logo)', 'nav menu location', 'hoot-ubix' ) );
}

/**
 * Display Menu Nav Item Description
 *
 * @since 1.6
 * @param string   $title The menu item's title.
 * @param WP_Post  $item  The current menu item.
 * @param stdClass $args  An object of wp_nav_menu() arguments.
 * @param int      $depth Depth of menu item. Used for padding.
 * @return string
 */
if ( !function_exists( 'hootubix_theme_menu_description' ) ):
function hootubix_theme_menu_description( $title, $item, $args, $depth ) {

	$return = '';
	$return .= '<span class="menu-title">' . $title . '</span>';
	if ( !empty( $item->description ) )
		$return .= '<span class="menu-description">' . $item->description . '</span>';

	return $return;
}
endif;
add_filter( 'nav_menu_item_title', 'hootubix_theme_menu_description', 5, 4 );