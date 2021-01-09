<?php

/**
 * Define some constats
 */
if( ! defined( 'ILOVEWP_AUTHOR' ) ) {
	define( 'ILOVEWP_AUTHOR', 'https://www.ilovewp.com' );
}
if( ! defined( 'ILOVEWP_THEME_URL' ) ) {
	define( 'ILOVEWP_THEME_URL', 'https://www.ilovewp.com/themes/faith/' );
}
if( ! defined( 'ILOVEWP_VERSION' ) ) {
	define( 'ILOVEWP_VERSION', '1.1.4' );
}
if( ! defined( 'ILOVEWP_DIR' ) ) {
	define( 'ILOVEWP_DIR', trailingslashit( get_template_directory() ) );
}
if( ! defined( 'ILOVEWP_DIR_URI' ) ) {
	define( 'ILOVEWP_DIR_URI', trailingslashit( get_template_directory_uri() ) );
}

/**
 * Faith functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package Faith
 */

if ( ! function_exists( 'faith_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function faith_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Faith, use a find and replace
	 * to change 'faith' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'faith', get_template_directory() . '/languages' );

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

	set_post_thumbnail_size( 240, 150, true );
	
	// Featured Post Main Thumbnail on the front page & single page template
	add_image_size( 'faith-large-thumbnail', 1600, 500, true );
	add_image_size( 'faith-normal-thumbnail', 480, 300, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary'	=> esc_html__( 'Primary Menu', 'faith' ),
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
	   'height'      => 100,
	   'width'       => 400,
	   'flex-width'  => true,
	   'flex-height' => true,
	) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', faith_fonts_url() ) );
	add_action( 'customize_controls_print_styles', 'faith_customizer_stylesheet' );

}
endif; // faith_setup
add_action( 'after_setup_theme', 'faith_setup' );

add_filter( 'image_size_names_choose', 'faith_custom_sizes' );
 
function faith_custom_sizes( $sizes ) {
	return array_merge( $sizes, array(
		'faith-large-thumbnail' => __( 'Featured Image: Slideshow Size', 'faith' ),
		'post-thumbnail' => __( 'Featured Image: Thumbnail', 'faith' ),
	) );
}

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function faith_content_width() {
	
	$GLOBALS['content_width'] = apply_filters( 'faith_content_width', 780 );

}
add_action( 'after_setup_theme', 'faith_content_width', 0 );

/* Custom Excerpt Length
==================================== */

add_filter( 'excerpt_length', 'faith_new_excerpt_length' );

function faith_new_excerpt_length( $length ) {
	return is_admin() ? $length : 30;
}

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function faith_widgets_init() {
	
	register_sidebar( array(
		'name'          => esc_html__( 'Main Sidebar', 'faith' ),
		'id'            => 'sidebar-main',
		'description'   => esc_html__( 'This is the main sidebar area that appears on all pages.', 'faith' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<p class="widget-title">',
		'after_title'   => '</p>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Homepage: Left Column', 'faith' ),
		'id'            => 'home-col-1',
		'description'   => esc_html__( 'Works best with a standard Text Widget. The widget title will be wrapped in a <h1></h1> tag.', 'faith' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h1 class="site-home-title">',
		'after_title'   => '</h1>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Homepage: Right Column', 'faith' ),
		'id'            => 'home-col-2',
		'description'   => esc_html__( 'Works best with a widget like Recent Posts.', 'faith' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<p class="widget-title">',
		'after_title'   => '</p>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Site Header', 'faith' ),
		'id'            => 'site-header',
		'description'   => esc_html__( 'Works best with a search widget.', 'faith' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<p class="widget-title">',
		'after_title'   => '</p>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer: Column 1', 'faith' ),
		'id'            => 'sidebar-footer-1',
		'description'   => esc_html__( 'This is displayed in the footer of the website. By default has a width of 275px.', 'faith' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<p class="widget-title">',
		'after_title'   => '</p>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer: Column 2', 'faith' ),
		'id'            => 'sidebar-footer-2',
		'description'   => esc_html__( 'This is displayed in the footer of the website. By default has a width of 275px.', 'faith' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<p class="widget-title">',
		'after_title'   => '</p>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer: Column 3', 'faith' ),
		'id'            => 'sidebar-footer-3',
		'description'   => esc_html__( 'This is displayed in the footer of the website. By default has a width of 275px.', 'faith' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<p class="widget-title">',
		'after_title'   => '</p>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer: Column 4', 'faith' ),
		'id'            => 'sidebar-footer-4',
		'description'   => esc_html__( 'This is displayed in the footer of the website. By default has a width of 275px.', 'faith' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<p class="widget-title">',
		'after_title'   => '</p>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer: Column 5', 'faith' ),
		'id'            => 'sidebar-footer-5',
		'description'   => esc_html__( 'This is displayed in the footer of the website. By default has a width of 275px.', 'faith' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<p class="widget-title">',
		'after_title'   => '</p>',
	) );

}
add_action( 'widgets_init', 'faith_widgets_init' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function faith_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
	}
}
add_action( 'wp_head', 'faith_pingback_header' );

/**
 * --------------------------------------------
 * Enqueue scripts and styles for the backend.
 *
 * @package Faith
 * --------------------------------------------
 */

if ( ! function_exists( 'faith_scripts_admin' ) ) {
	/**
	 * Enqueue admin styles and scripts
	 *
	 * @since  1.0.0
	 * @return void
	 */
	function faith_scripts_admin( $hook ) {
		// if ( 'widgets.php' !== $hook ) return;

		// Styles
		wp_enqueue_style(
			'faith-style-admin',
			get_template_directory_uri() . '/ilovewp-admin/css/ilovewp_theme_settings.css',
			'', ILOVEWP_VERSION, 'all'
		);
	}
}
add_action( 'admin_enqueue_scripts', 'faith_scripts_admin' );


if ( ! function_exists( 'faith_fonts_url' ) ) :
/**
 * Register Google fonts for Faith.
 *
 * Create your own faith_fonts_url() function to override in a child theme.
 *
 * @since Faith 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function faith_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Lato, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Lato font: on or off', 'faith' ) ) {
		$fonts[] = 'Lato:400,400i,700,700i';
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
function faith_scripts() {

	$theme_version = wp_get_theme()->get( 'Version' );

	wp_enqueue_style( 'faith-style', get_stylesheet_uri(), array(), $theme_version );

	// Add Dashicons font.
	wp_enqueue_style( 'dashicons' );

	// Add Genericons font.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.3.1' );

	wp_enqueue_script(
		'jquery-fitvids',
		get_template_directory_uri() . '/js/jquery.fitvids.js',
		array('jquery'),
		'1.7.10',
		true
	);

	wp_enqueue_script(
		'jquery-slicknav',
		get_template_directory_uri() . '/js/jquery.slicknav.min.js',
		array('jquery'),
		true
	);

	wp_enqueue_script(
		'jquery-superfish',
		get_template_directory_uri() . '/js/superfish.min.js',
		array('jquery'),
		true
	);

	wp_enqueue_script(
		'jquery-flexslider',
		get_template_directory_uri() . '/js/jquery.flexslider.js',
		array('jquery'),
		true
	);

	wp_register_script( 'faith-scripts', get_template_directory_uri() . '/js/faith.js', array( 'jquery' ), $theme_version, true );

	/* Contains the strings used in our JavaScript file */
	$faithStrings = array (
		'slicknav_menu_home' => _x( 'Click for Menu', 'The main label for the expandable mobile menu', 'faith' )
	);

	wp_localize_script( 'faith-scripts', 'faithStrings', $faithStrings );

	wp_enqueue_script( 'faith-scripts' );

	// Loads our default Google Webfont
	wp_enqueue_style( 'faith-webfonts', faith_fonts_url(), array(), null, null );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'faith_scripts' );

if ( ! function_exists( 'wp_body_open' ) ) {
    function wp_body_open() {
        do_action( 'wp_body_open' );
    }
}

/**
 * Implement the Custom Header feature.
 */
require get_parent_theme_file_path( '/inc/custom-header.php' );

/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_parent_theme_file_path() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_parent_theme_file_path() . '/inc/customizer.php';

/* Include Additional Options and Components
================================== */

require_once( get_template_directory() . '/ilovewp-admin/helper-functions.php');

//require only in admin!
if(is_admin()){	
	require_once('ilovewp-admin/ilovewp-theme-settings.php');

	if (current_user_can( 'manage_options' ) ) {
		require_once(get_template_directory() . '/ilovewp-admin/admin-notices/ilovewp-notices.php');
		require_once(get_template_directory() . '/ilovewp-admin/admin-notices/ilovewp-notice-welcome.php');
		require_once(get_template_directory() . '/ilovewp-admin/admin-notices/ilovewp-notice-review.php');

		// Remove theme data from database when theme is deactivated.
		add_action('switch_theme', 'faith_db_data_remove');

		if ( ! function_exists( 'faith_db_data_remove' ) ) {
			function faith_db_data_remove() {

				delete_option( 'faith_admin_notices');
				delete_option( 'faith_theme_installed_time');

			}
		}

	}

}