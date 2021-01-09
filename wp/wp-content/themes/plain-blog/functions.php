<?php
/**
 * The main theme functions file loads styles/scripts, allows some theme functionality and provides some helper functions.
 */

/**
 * This theme only works in WordPress 4.2 or later.
 */

if ( version_compare( $GLOBALS['wp_version'], '4.2', '<' ) ) {
    require get_template_directory() . '/inc/back-compat.php';
}

if ( ! isset( $content_width ) ) $content_width = 1140;

/**
 * Include the Dropdown class.
 */

require_once dirname( __FILE__ ) . '/classes/DropDown_Nav_Menu.php';

if ( ! function_exists( 'plain_blog_getAssetsPath' ) ) :

	function plain_blog_getAssetsPath($path) {
		return get_template_directory_uri() . '/assets/' . $path;
	}

endif;

if ( ! function_exists( 'plain_blog_image' ) ) :

function plain_blog_image($name) {
    return getAssetsPath('img/'.$name);
}

endif;

if ( ! function_exists( 'plain_blog_fonts_url' ) ) :

function plain_blog_fonts_url() {
    $fonts_url = '';
 
    /* Translators: If there are characters in your language that are not
    * supported by Lora, translate this to 'off'. Do not translate
    * into your own language.
    */
    $Lato = _x( 'on', 'Lato font: on or off', 'plain-blog' );
 
    /* Translators: If there are characters in your language that are not
    * supported by Open Sans, translate this to 'off'. Do not translate
    * into your own language.
    */
    $open_sans = _x( 'on', 'Open Sans font: on or off', 'plain-blog' );
 
    if ( 'off' !== $Lato || 'off' !== $open_sans ) {
        $font_families = array();
 
        if ( 'off' !== $Lato ) {
            $font_families[] = 'Lato:400,700,400italic';
        }
 
        if ( 'off' !== $open_sans ) {
            $font_families[] = 'Open Sans:700italic,400,800,600';
        }
 
        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );
 
        $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
    }
 
    return esc_url_raw( $fonts_url );
}

endif;

function plain_blog_scripts_styles() {
    wp_enqueue_style( 'plain-blog-fonts', plain_blog_fonts_url(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'plain_blog_scripts_styles' );	

// Load Styles
function plain_blog_loadStyles() {
 
    //Load the latest compiled and minified version of Twitter Bootstrap's stylesheet
    wp_enqueue_style('plain-blog-bootstrap', plain_blog_getAssetsPath('bootstrap/css/bootstrap.min.css'));

    //Load Font CSS
    wp_enqueue_style('plain-blog-font-awesome', plain_blog_getAssetsPath('custom/css/font-awesome.min.css'));

    //Load the main theme stylesheet.
    wp_enqueue_style('plain-blog-style', get_stylesheet_uri());

}

// Load Scripts
function plain_blog_loadScripts() {
 
    //Load the latest compiled and minified version of Twiter Bootstrap's javascript
    wp_enqueue_script('plain-blog-bootstrap', plain_blog_getAssetsPath('bootstrap/js/bootstrap.min.js'), array( 'jquery' ));

    //Load the menu's javascript
    wp_enqueue_script('plain-blog-script', plain_blog_getAssetsPath('menu/script.js'), array( 'jquery' ));

}

add_action('wp_enqueue_scripts', 'plain_blog_loadStyles');
add_action('wp_enqueue_scripts', 'plain_blog_loadScripts');


if ( ! function_exists( 'plain_blog_theme_setup' ) ) :

function plain_blog_theme_setup() {
	
	// Translation
	load_theme_textdomain('plain-blog', get_template_directory() . '/languages');
	
	// Post Thumbnail Size
	set_post_thumbnail_size( 777, 390, true ); 
	
    //Add featured image support
    add_theme_support('post-thumbnails');

    //This feature enables plugins and themes to manage the document title tag.
    add_theme_support('title-tag');

    //This feature adds RSS feed links to HTML <head>.
    add_theme_support( 'automatic-feed-links' );
 	
	//Navigation Menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'plain-blog')
    ));

}
endif;

add_action( 'after_setup_theme', 'plain_blog_theme_setup' );
 
if ( ! function_exists( 'plain_blog_ourWidgetsInit' ) ) :

//Add our Widget Locations
function plain_blog_ourWidgetsInit() {

    register_sidebar(array(
        'name' => __('Sidebar Area', 'plain-blog'),
        'id' => 'right_sidebar',
        'before_widget' => '<div id="%1$s" class="%2$s clearfix sidebar_widget"><div class="blue_border"></div>',
        'after_widget' => '</div>'
    ));

    register_sidebar(array(
        'name' => __('Footer Area 1', 'plain-blog'),
        'id' => 'footer_area_1',
        'before_widget' => '<div class="footer_widget">',
        'after_widget' => '</div>'
    ));

    register_sidebar(array(
        'name' => __('Footer Area 2', 'plain-blog'),
        'id' => 'footer_area_2',
        'before_widget' => '<div class="footer_widget">',
        'after_widget' => '</div>'
    ));

    register_sidebar(array(
        'name' => __('Footer Area 3', 'plain-blog'),
        'id' => 'footer_area_3',
        'before_widget' => '<div class="footer_widget">',
        'after_widget' => '</div>'
    ));

}

endif;

add_action('widgets_init', 'plain_blog_ourWidgetsInit');


if ( ! function_exists( 'plain_blog_numeric_posts_nav' ) ) :

function plain_blog_numeric_posts_nav() {

    if( is_singular() )
        return;

    global $wp_query;

    /** Stop execution if there's only 1 page */
    if( $wp_query->max_num_pages <= 1 )
        return;

    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    $max   = intval( $wp_query->max_num_pages );

    /**	Add current page to the array */
    if ( $paged >= 1 )
        $links[] = $paged;

    /**	Add the pages around the current page to the array */
    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }

    if ( ( $paged + 2 ) <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }

    echo '<div class="text-center"><ul class="pagination">' . "\n";

    /**	Previous Post Link */
    if ( get_previous_posts_link() )
        printf( '<li>%s</li>' . "\n", esc_url(get_previous_posts_link()));

    /**	Link to first page, plus ellipses if necessary */
    if ( ! in_array( 1, $links ) ) {
        $class = 1 == $paged ? ' class="active"' : '';

        printf( '<li><a href="%s" %s>%s</a></li>' . "\n", esc_url( get_pagenum_link( 1 ) ), $class, '1' );
    }

    /**	Link to current page, plus 2 pages in either direction if necessary */
    sort( $links );
    foreach ( (array) $links as $link ) {
        $class = $paged == $link ? ' class="active"' : '';
        printf( '<li><a href="%s" %s>%s</a></li>' . "\n", esc_url( get_pagenum_link( $link ) ), $class, $link );
    }

    /**	Link to last page, plus ellipses if necessary */
    if ( ! in_array( $max, $links ) ) {
        $class = $paged == $max ? ' class="active"' : '';
        printf( '<li><a href="%s" %s>%s</a></li>' . "\n", esc_url( get_pagenum_link( $max ) ), $class, $max );
    }

    /**	Next Post Link */
    if ( get_next_posts_link() )
        printf( '<li>%s</li>' . "\n", esc_url(get_next_posts_link()) );

    echo '</ul></div>' . "\n";

}

endif;


if ( ! function_exists( 'plain_blog_remove_thumbnail_dimensions' ) ) :

function plain_blog_remove_thumbnail_dimensions( $html, $post_id, $post_image_id ) {
    $html = preg_replace( '/(height)=\"\d*\"\s/', "", $html );
    return $html;
}
endif;

add_filter( 'post_thumbnail_html', 'plain_blog_remove_thumbnail_dimensions', 10, 3 );



if ( ! function_exists( 'plain_blog_custom_excerpt_length' ) ) :

//Customize excerpt word count
function plain_blog_custom_excerpt_length($length) {
    return 20; //20 words
}

endif;

add_filter('excerpt_length', 'plain_blog_custom_excerpt_length');
 
if ( ! function_exists( 'plain_blog_new_excerpt_more' ) ) :
 
function plain_blog_new_excerpt_more( $more ) {
	return '<div class="border bottom-border text-center"><br />
	 <a class="readmore" href="' . get_permalink( get_the_ID() ) . '">' . __( 'Read More', 'plain-blog' ) . '</a>
	  </div>';
}
endif;

add_filter( 'excerpt_more', 'plain_blog_new_excerpt_more' );
