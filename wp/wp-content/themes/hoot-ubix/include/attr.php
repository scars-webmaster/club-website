<?php
/**
 * HTML attribute filters.
 * Most of these functions filter the generic values from the framework found in hybrid/inc/functions-attr.php
 * Attributes for non-generic structural elements (mostly theme specific) can be loaded in this file.
 *
 * @package    Hoot
 * @subpackage Hoot Ubix
 */

/* Modify Original Filters from Framework */
add_filter( 'hybrid_attr_header', 'hootubix_theme_attr_header', 10, 2 );
add_filter( 'hybrid_attr_menu', 'hootubix_theme_attr_menu', 7, 2 );
add_filter( 'hybrid_attr_content', 'hootubix_theme_attr_content' );
add_filter( 'hybrid_attr_sidebar', 'hootubix_theme_attr_sidebar', 10, 2 );
add_filter( 'hybrid_attr_branding', 'hootubix_theme_attr_branding', 7 );
add_filter( 'hybrid_attr_entry-summary', 'hootubix_theme_attr_entry_summary', 7, 2 );

if ( function_exists( 'hybrid_attr_post' ) )
	add_filter( 'hybrid_attr_page', 'hybrid_attr_post', 7 ); // Alternate for "post".

/* Reintroduce original filters from framework */

/* New Theme Filters */
add_filter( 'hybrid_attr_page-wrapper', 'hootubix_theme_attr_page_wrapper' );
add_filter( 'hybrid_attr_topbar', 'hootubix_theme_attr_topbar' );
add_filter( 'hybrid_attr_header-part', 'hootubix_theme_attr_header_part', 10, 2 );
add_filter( 'hybrid_attr_header-aside', 'hootubix_theme_attr_header_aside' );
add_filter( 'hybrid_attr_below-header', 'hootubix_theme_attr_below_header' );
add_filter( 'hybrid_attr_main', 'hootubix_theme_attr_main' );
add_filter( 'hybrid_attr_frontpage-content', 'hootubix_theme_frontpage_content', 10, 2 );
add_filter( 'hybrid_attr_loop-meta-wrap', 'hootubix_theme_attr_loop_meta_wrap', 7 );
add_filter( 'hybrid_attr_loop-meta', 'hootubix_theme_attr_loop_meta', 7, 2 ); // hybrid_attr_archive-header in v3.0.0 ; we use it for generic loop (archive / singular etc )
add_filter( 'hybrid_attr_loop-title', 'hootubix_theme_attr_loop_title', 7, 2 ); // hybrid_attr_archive-title in v3.0.0 ; we use it for generic loop (archive / singular etc )
add_filter( 'hybrid_attr_loop-description', 'hootubix_theme_attr_loop_description', 7, 2 ); // hybrid_attr_archive-description in v3.0.0 ; we use it for generic loop (archive / singular etc )
add_filter( 'hybrid_attr_sub-footer', 'hootubix_theme_attr_sub_footer' );
add_filter( 'hybrid_attr_post-footer', 'hootubix_theme_attr_post_footer' );

/* Misc Filters */
add_filter( 'hybrid_attr_frontpage-area', 'hootubix_theme_attr_frontpage_area', 10, 2 );
add_filter( 'hybrid_attr_social-icons-icon', 'hootubix_theme_attr_social_icons_icon', 10, 2 );
add_filter( 'hybrid_attr_page-wrapper', 'hootubix_theme_attr_page_wrapper_plugins' );

/**
 * Modify <header> element attributes
 *
 * @since 1.0
 * @access public
 * @param array $attr
 * @param string $context
 * @return array
 */
function hootubix_theme_attr_header( $attr, $context ) {
	$attr['class'] = ( empty( $attr['class'] ) ) ? '' : $attr['class'];
	$attr['class'] .= ' header-layout-primary-' . hootubix_get_mod( 'primary_menuarea' );
	$attr['class'] .= ' header-layout-secondary-' . hootubix_get_mod( 'secondary_menu_location' );
	$attr['class'] .= ( hootubix_get_mod( 'disable_table_menu' ) ) ? '' : ' tablemenu';
	return $attr;
}

/**
 * Nav menu attributes.
 *
 * @since 1.0
 * @access public
 * @param array $attr
 * @param string $context
 * @return array
 */
function hootubix_theme_attr_menu( $attr, $context ) {
	$attr['class'] = ( empty( $attr['class'] ) ) ? '' : $attr['class'];
	$attr['class'] .= ' nav-menu';

	$mobile_menu = hootubix_get_mod( 'mobile_menu' );
	$attr['class'] .= " mobilemenu-{$mobile_menu}";
	$mobile_submenu_click = hootubix_get_mod( 'mobile_submenu_click' );
	$attr['class'] .= ( $mobile_submenu_click ) ? ' mobilesubmenu-click' : ' mobilesubmenu-open';

	return $attr;
}

/**
 * Modify Main content container of the page attributes.
 *
 * @since 1.0
 * @access public
 * @param array $attr
 * @return array
 */
function hootubix_theme_attr_content( $attr ) {
	$attr['class'] = ( empty( $attr['class'] ) ) ? '' : $attr['class'];

	$layout_class = hootubix_main_layout_class( 'content' );
	if ( !empty( $layout_class ) )
		$attr['class'] .= ' ' . $layout_class;

	if ( is_page_template() ) {
		$template_slug = basename( get_page_template(), '.php' );
		$attr['class'] .= ' ' . sanitize_html_class( 'content-' . $template_slug );
	}

	return $attr;
}

/**
 * Modify Sidebar attributes.
 *
 * @since 1.0
 * @access public
 * @param array $attr
 * @param string $context
 * @return array
 */
function hootubix_theme_attr_sidebar( $attr, $context ) {
	$attr['class'] = ( empty( $attr['class'] ) ) ? '' : $attr['class'];
	if ( !empty( $context ) && ( $context == 'primary' || $context == 'secondary' ) ) {
		$layout_class = hootubix_main_layout_class( "sidebar" );
		if ( !empty( $layout_class ) )
			$attr['class'] .= $layout_class;
	}

	return $attr;
}

/**
 * Branding attributes.
 *
 * @since 1.0
 * @access public
 * @param array $attr
 * @return array
 */
function hootubix_theme_attr_branding( $attr ) {
	$attr['class'] = ( empty( $attr['class'] ) ) ? '' : $attr['class'];
	$attr['class'] .= ' branding table-cell-mid';
	return $attr;
}

/**
 * Post summary/excerpt attributes.
 *
 * @since 1.0
 * @access public
 * @param array $attr
 * @return array
 */
function hootubix_theme_attr_entry_summary( $attr, $context ) {

	// Overwrite $attr['itemprop'] from Hybrid
	$attr['itemprop'] = ( $context == 'content') ? 'mainEntityOfPage' : 'description';

	return $attr;
}

/**
 * Page wrapper attributes.
 *
 * @since 1.0
 * @access public
 * @param array $attr
 * @return array
 */
function hootubix_theme_attr_page_wrapper( $attr ) {
	$attr['id'] = 'page-wrapper';
	$attr['class'] = ( empty( $attr['class'] ) ) ? '' : $attr['class'];

	// Set site layout class
	$site_layout = hootubix_get_mod( 'site_layout' );
	$attr['class'] .= ( $site_layout == 'boxed' ) ? ' hgrid site-boxed' : ' site-stretch';
	$attr['class'] .= ' page-wrapper';

	// Set sidebar layout class
	global $hootubix_theme;
	if ( empty( $hootubix_theme->currentlayout ) )
		hootubix_main_layout('');
	if ( !empty( $hootubix_theme->currentlayout['layout'] ) ) :
		$attr['class'] .= ' sitewrap-'. $hootubix_theme->currentlayout['layout'];
		switch( $hootubix_theme->currentlayout['layout'] ) {
			case 'none' :
			case 'full' :
			case 'full-width' :
				$attr['class'] .= ' sidebars0';
				break;
			case 'narrow-right' :
			case 'wide-right' :
			case 'narrow-left' :
			case 'wide-left' :
				$attr['class'] .= ' sidebarsN sidebars1';
				break;
			case 'narrow-left-left' :
			case 'narrow-left-right' :
			case 'narrow-right-left' :
			case 'narrow-right-right' :
				$attr['class'] .= ' sidebarsN sidebars2';
				break;
		}
	endif;

	return $attr;
}

/**
 * Topbar attributes.
 *
 * @since 1.0
 * @access public
 * @param array $attr
 * @return array
 */
function hootubix_theme_attr_topbar( $attr ) {
	$attr['id'] = 'topbar';
	$attr['class'] = ( empty( $attr['class'] ) ) ? '' : $attr['class'];
	$attr['class'] .= ' topbar';
	return $attr;
}

/**
 * Modify header part attributes.
 *
 * @since 1.0
 * @access public
 * @param array $attr
 * @param string $context
 * @return array
 */
function hootubix_theme_attr_header_part( $attr, $context ) {
	$attr['id'] = 'header-' . $context;
	$attr['class'] = ( empty( $attr['class'] ) ) ? '' : $attr['class'];

	$attr['class'] .= ' header-part';
	if ( $context == 'primary' ) {
		$attr['class'] .= ' header-primary-' . hootubix_get_mod( 'primary_menuarea' );
	} elseif ( $context == 'supplementary' ) {
		$attr['class'] .= ' header-supplementary-' . hootubix_get_mod( 'secondary_menu_location' );
		$attr['class'] .= ' header-supplementary-' . hootubix_get_mod( 'secondary_menu_align' );
	}

	return $attr;
}

/**
 * Header Aside attributes.
 *
 * @since 1.0
 * @access public
 * @param array $attr
 * @return array
 */
function hootubix_theme_attr_header_aside( $attr ) {
	$attr['id'] = 'header-aside';
	$attr['class'] = ( empty( $attr['class'] ) ) ? '' : $attr['class'];
	$attr['class'] .= ' header-aside table-cell-mid';
	return $attr;
}

/**
 * Below Header attributes.
 *
 * @since 1.0
 * @access public
 * @param array $attr
 * @return array
 */
function hootubix_theme_attr_below_header( $attr ) {
	$attr['id'] = 'below-header';
	$attr['class'] = ( empty( $attr['class'] ) ) ? '' : $attr['class'];
	$attr['class'] .= ' below-header';
	return $attr;
}

/**
 * Main attributes.
 *
 * @since 1.0
 * @access public
 * @param array $attr
 * @return array
 */
function hootubix_theme_attr_main( $attr ) {
	$attr['id'] = 'main';
	$attr['class'] = ( empty( $attr['class'] ) ) ? '' : $attr['class'];
	$attr['class'] .= ' main';
	return $attr;
}

/**
 * Main content container of the frontpage
 *
 * @since 1.0
 * @access public
 * @param array $attr
 * @param string $context
 * @return array
 */
function hootubix_theme_frontpage_content( $attr, $context ) {

	if ( $context == 'none' ) {
		$attr['id']       = 'content';
		$attr['class']    = 'content no-sidebar layout-none content-frontpage';
		$attr['role']     = 'main';
		$attr['itemprop'] = 'mainContentOfPage';
	} else {
		// Get page attributes for main content container of a regular page
		$attr = apply_filters( 'hybrid_attr_content', $attr, $context );
	}

	return $attr;
}

/**
 * Loop meta attributes.
 *
 * @since 1.0
 * @access public
 * @param array $attr
 * @return array
 */
function hootubix_theme_attr_loop_meta_wrap( $attr ) {

	$attr['id'] = 'loop-meta';
	$attr['class'] = ( empty( $attr['class'] ) ) ? '' : $attr['class'];
	$attr['class'] .= ' loop-meta-wrap pageheader-bg-default';

	return $attr;
}

/**
 * Loop meta attributes.
 * hybrid_attr_archive_header in v3.0.0 ; we use it for generic loop (archive / singular etc )
 *
 * @since 1.0
 * @access public
 * @param array $attr
 * @param string $context
 * @return array
 */
function hootubix_theme_attr_loop_meta( $attr, $context ) {

	$attr['class'] = ( empty( $attr['class'] ) ) ? '' : $attr['class'];
	$attr['class'] .= ' loop-meta';
	if ( $context == 'archive' ) $attr['class'] .= ' archive-header';
	$attr['itemscope'] = 'itemscope';
	$attr['itemtype']  = 'https://schema.org/WebPageElement';
	return $attr;

}

/**
 * Loop title attributes.
 * hybrid_attr_archive_title in v3.0.0 ; we use it for generic loop (archive / singular etc )
 *
 * @since 1.0
 * @access public
 * @param array $attr
 * @param string $context
 * @return array
 */
function hootubix_theme_attr_loop_title( $attr, $context ) {

	$attr['class'] = ( empty( $attr['class'] ) ) ? '' : $attr['class'];
	$attr['class'] .= ' loop-title entry-title';
	if ( $context == 'archive' ) $attr['class'] .= ' archive-title';
	$attr['itemprop']  = 'headline';

	return $attr;
}

/**
 * Loop description attributes.
 * hybrid_attr_archive_description in v3.0.0 ; we use it for generic loop (archive / singular etc
 *
 * @since 1.0
 * @access public
 * @param array $attr
 * @param string $context
 * @return array
 */
function hootubix_theme_attr_loop_description( $attr, $context ) {

	$attr['class'] = ( empty( $attr['class'] ) ) ? '' : $attr['class'];
	$attr['class'] .= ' loop-description';
	if ( $context == 'archive' ) $attr['class'] .= ' archive-description';
	$attr['itemprop']  = 'text';

	return $attr;
}

/**
 * Subfooter attributes.
 *
 * @since 1.0
 * @access public
 * @param array $attr
 * @return array
 */
function hootubix_theme_attr_sub_footer( $attr ) {
	$attr['id'] = 'sub-footer';
	// $attr['class'] = ( empty( $attr['class'] ) ) ? '' : $attr['class'];
	return $attr;
}

/**
 * Postfooter attributes.
 *
 * @since 1.0
 * @access public
 * @param array $attr
 * @return array
 */
function hootubix_theme_attr_post_footer( $attr ) {
	$attr['id'] = 'post-footer';
	// $attr['class'] = ( empty( $attr['class'] ) ) ? '' : $attr['class'];
	return $attr;
}

/**
 * Frontpage Area
 *
 * @since 1.0
 * @access public
 * @param array $attr
 * @param string $context
 * @return array
 */
function hootubix_theme_attr_frontpage_area( $attr, $context ) {

	$key = $context;
	$attr['class'] = ( empty( $attr['class'] ) ) ? '' : $attr['class'];
	$module_bg = hootubix_get_mod( "frontpage_sectionbg_{$key}-type" );

	if ( $module_bg == 'image' ) {
		$module_bg_img = hootubix_get_mod( "frontpage_sectionbg_{$key}-image" );
		if ( !empty( $module_bg_img ) ) {
			$module_bg_parallax = hootubix_get_mod( "frontpage_sectionbg_{$key}-parallax" );
			$attr['class'] .= ( $module_bg_parallax ) ? ' bg-fixed' : ' bg-scroll';
			if ( $module_bg_parallax ) {
				$attr['data-parallax'] = 'scroll';
				// $attr['data-speed'] = '0.4'; // Default is 0.2 :: range [0-1]
				$attr['data-image-src'] = esc_url($module_bg_img);
			} else {
				$attr['style'] = 'background-image:url(' . esc_attr($module_bg_img) . ');';
			}
		}
	}
	return $attr;
}

/**
 * Social Icons Widget - Icons
 *
 * @since 1.0
 * @access public
 * @param array $attr
 * @param string $context
 * @return array
 */
function hootubix_theme_attr_social_icons_icon( $attr, $context ) {
	$attr['class'] = ( empty( $attr['class'] ) ) ? '' : $attr['class'];

	$attr['class'] .= ' social-icons-icon';
	if ( $context != 'fa-envelope' )
		$attr['target'] = '_blank';

	return $attr;
}

/**
 * Page wrapper attributes for external plugins
 *
 * @since 1.0
 * @access public
 * @param array $attr
 * @return array
 */
function hootubix_theme_attr_page_wrapper_plugins( $attr ) {
	$attr['class'] = ( empty( $attr['class'] ) ) ? '' : $attr['class'];

	$classes = apply_filters( 'hootubix_theme_attr_page_wrapper_plugins', array( 'hootubix-cf7-style', 'hootubix-mapp-style', 'hootubix-jetpack-style' ) );
	$classes = array_map( 'sanitize_html_class', $classes );
	foreach ( $classes as $class ) {
		$attr['class'] .= ' ' . $class;
	}

	return $attr;
}