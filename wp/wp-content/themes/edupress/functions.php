<?php

/**
 * Define some constats
 */
if( ! defined( 'ILOVEWP_AUTHOR' ) ) {
	define( 'ILOVEWP_AUTHOR', 'https://www.ilovewp.com' );
}
if( ! defined( 'ILOVEWP_THEME_URL' ) ) {
	define( 'ILOVEWP_THEME_URL', 'https://www.ilovewp.com/themes/edupress/' );
}
if( ! defined( 'ILOVEWP_VERSION' ) ) {
	define( 'ILOVEWP_VERSION', '1.5.1' );
}
if( ! defined( 'ILOVEWP_DIR' ) ) {
	define( 'ILOVEWP_DIR', trailingslashit( get_template_directory() ) );
}
if( ! defined( 'ILOVEWP_DIR_URI' ) ) {
	define( 'ILOVEWP_DIR_URI', trailingslashit( get_template_directory_uri() ) );
}

/**
 * EduPress functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package EduPress
 */

if ( ! function_exists( 'edupress_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function edupress_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on EduPress, use a find and replace
	 * to change 'edupress' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'edupress', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	set_post_thumbnail_size( 240, 180, true );
	
	// Featured Post Main Thumbnail on the front page & single page template
	add_image_size( 'edupress-large-thumbnail', 780, 400, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary'	=> esc_html__( 'Primary Menu', 'edupress' )
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'gallery',
		'caption',
	) );

    add_theme_support( 'custom-logo', array(
	   'height'      => 50,
	   'width'       => 300,
	   'flex-width'  => true,
	   'flex-height' => true,
	) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', edupress_fonts_url() ) );
	add_action( 'customize_controls_print_styles', 'edupress_customizer_stylesheet' );

}
endif; // edupress_setup
add_action( 'after_setup_theme', 'edupress_setup' );

add_filter( 'image_size_names_choose', 'edupress_custom_sizes' );
 
function edupress_custom_sizes( $sizes ) {
	return array_merge( $sizes, array(
		'edupress-large-thumbnail' => __( 'Featured Image: Slideshow Size', 'edupress' ),
		'post-thumbnail' => __( 'Featured Image: Thumbnail', 'edupress' ),
	) );
}

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function edupress_content_width() {
	
	$GLOBALS['content_width'] = apply_filters( 'edupress_content_width', 780 );

}
add_action( 'after_setup_theme', 'edupress_content_width', 0 );

/* Custom Excerpt Length
==================================== */

add_filter( 'excerpt_length', 'edupress_new_excerpt_length' );

function edupress_new_excerpt_length( $length ) {
	return is_admin() ? $length : 30;
}

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function edupress_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
	}
}
add_action( 'wp_head', 'edupress_pingback_header' );

/**
 * --------------------------------------------
 * Enqueue scripts and styles for the backend.
 *
 * @package EduPress
 * --------------------------------------------
 */

if ( ! function_exists( 'edupress_scripts_admin' ) ) {
	/**
	 * Enqueue admin styles and scripts
	 *
	 * @since  1.0.0
	 * @return void
	 */
	function edupress_scripts_admin( $hook ) {
		// if ( 'widgets.php' !== $hook ) return;

		// Styles
		wp_enqueue_style(
			'edupress-style-admin',
			get_template_directory_uri() . '/ilovewp-admin/css/ilovewp_theme_settings.css',
			'', ILOVEWP_VERSION, 'all'
		);
	}
}
add_action( 'admin_enqueue_scripts', 'edupress_scripts_admin' );

if ( ! function_exists( 'edupress_fonts_url' ) ) :
/**
 * Register Google fonts for EduPress.
 *
 * Create your own edupress_fonts_url() function to override in a child theme.
 *
 * @since EduPress 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function edupress_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Lato, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Lato font: on or off', 'edupress' ) ) {
		$fonts[] = 'Lato:400,400i,700,700i';
	}

	/* translators: If there are characters in your language that are not supported by Roboto, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Roboto font: on or off', 'edupress' ) ) {
		$fonts[] = 'Roboto:400,700';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), '//fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/**
 * Enqueue scripts and styles.
 */
function edupress_scripts() {

	wp_enqueue_style( 'edupress-style', get_stylesheet_uri() );

	wp_enqueue_script(
		'jquery-slicknav',
		get_template_directory_uri() . '/js/jquery.slicknav.min.js',
		array('jquery'),
		null
	);

	wp_enqueue_script(
		'jquery-superfish',
		get_template_directory_uri() . '/js/superfish.min.js',
		array('jquery'),
		null
	);

	wp_enqueue_script(
		'jquery-flexslider',
		get_template_directory_uri() . '/js/jquery.flexslider.js',
		array('jquery'),
		null
	);

	// wp_enqueue_script( 'edupress-scripts', get_template_directory_uri() . '/js/edupress.js', array( 'jquery' ), '20160820', true );
	wp_register_script( 'edupress-scripts', get_template_directory_uri() . '/js/edupress.js', array( 'jquery' ), '20200911', true );

	/* Contains the strings used in our JavaScript file */
	$edupressStrings = array (
		'slicknav_menu_home' => _x( 'Click for Menu', 'The main label for the expandable mobile menu', 'edupress' )
	);

	wp_localize_script( 'edupress-scripts', 'edupressStrings', $edupressStrings );

	wp_enqueue_script( 'edupress-scripts' );

	// Loads our default Google Webfont
	wp_enqueue_style( 'edupress-webfonts', edupress_fonts_url(), array(), null, null );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'edupress_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Modifies tag cloud widget arguments to have all tags in the widget same font size.
 *
 * @since EduPress 1.0
 *
 * @param array $args Arguments for tag cloud widget.
 * @return array A new modified arguments.
 */
function edupress_widget_tag_cloud_args( $args ) {
	$args['largest'] = 1;
	$args['smallest'] = 1;
	$args['unit'] = 'em';
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'edupress_widget_tag_cloud_args' );

if ( ! function_exists( 'wp_body_open' ) ) {
    function wp_body_open() {
        do_action( 'wp_body_open' );
    }
}

/* Include Additional Options and Components
================================== */

require_once( get_template_directory() . '/ilovewp-admin/sidebars.php');
require_once( get_template_directory() . '/ilovewp-admin/helper-functions.php');

/* Include Theme Options Page for Admin
================================== */

//require only in admin!
if( is_admin() ) {	
	require_once('ilovewp-admin/ilovewp-theme-settings.php');

	if (current_user_can( 'manage_options' ) ) {
		require_once(get_template_directory() . '/ilovewp-admin/admin-notices/ilovewp-notices.php');
		require_once(get_template_directory() . '/ilovewp-admin/admin-notices/ilovewp-notice-welcome.php');
		require_once(get_template_directory() . '/ilovewp-admin/admin-notices/ilovewp-notice-review.php');

		// Remove theme data from database when theme is deactivated.
		add_action('switch_theme', 'edupress_db_data_remove');

		if ( ! function_exists( 'edupress_db_data_remove' ) ) {
			function edupress_db_data_remove() {

				delete_option( 'edupress_admin_notices');
				delete_option( 'edupress_theme_installed_time');

			}
		}

	}

}