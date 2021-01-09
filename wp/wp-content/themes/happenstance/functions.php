<?php
/**
 * HappenStance functions and definitions.
 * @package HappenStance
 * @since HappenStance 1.0.0
*/

/**
 * HappenStance Theme Customization API.
 *  
*/    
// Include Theme Customization admin screen.  
require_once (get_template_directory() . '/inc/customizer.php');
// Include Theme Customization headerdata.  
require_once (get_template_directory() . '/inc/headerdata.php');

/**
 * HappenStance theme basic setup.
 *  
*/
if ( ! function_exists( 'happenstance_setup' ) ) {
function happenstance_setup() {
// Makes HappenStance available for translation.
  load_theme_textdomain( 'happenstance', get_template_directory() . '/languages' );
// This theme styles the visual editor to resemble the theme style.
  $happenstance_font_url = add_query_arg( 'family', 'Oswald', "//fonts.googleapis.com/css" );
  add_editor_style( array( 'editor-style.css', $happenstance_font_url ) );
// Adds RSS feed links to <head> for posts and comments.  
  add_theme_support( 'automatic-feed-links' );
// This theme supports custom Background Color and Image.
  $defaults = array(
    'default-color' => 'dedede', 
    'default-image' => '',
    'default-repeat' => 'no-repeat',
    'default-attachment' => 'fixed',
    'wp-head-callback' => '_custom_background_cb',
    'admin-head-callback' => '',
    'admin-preview-callback' => '' );  
  add_theme_support( 'custom-background', $defaults );
// This theme supports Post Thumbnails.
  add_theme_support( 'post-thumbnails' );
  set_post_thumbnail_size( 1170, 9999 );
// This theme supports a custom Header Image.
  $args = array(
    'width' => 2000,
    'height' => 400,
    'default-image' => get_template_directory_uri() . '/images/header.jpg',
    'flex-width' => true,
    'flex-height' => true,
    'header-text' => false,
    'random-default' => true,);
  add_theme_support( 'custom-header', $args );
// This theme supports a custom Header Logo.
  add_theme_support( 'custom-logo' );
// This theme supports Post Formats.
  add_theme_support( 'post-formats', array( 'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video' ) );
// This theme supports Title Tag feature.
  add_theme_support( 'title-tag' );
// This theme supports selective refresh in the Customizer.
  add_theme_support( 'customize-selective-refresh-widgets' );
// This theme supports WooCommerce.
  add_theme_support( 'woocommerce' );
// Content width.
  global $content_width;
  if ( ! isset( $content_width ) ) { $content_width = 734; }
}
add_action( 'after_setup_theme', 'happenstance_setup' );
}

/**
 * Enqueues scripts and styles for front-end.
 *
*/
function happenstance_scripts_styles() {
global $wp_styles, $wp_scripts;
// Adds JavaScript
  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
    wp_enqueue_script( 'comment-reply' );
  if ( !is_page_template('template-landing-page.php') && get_theme_mod('happenstance_secondary_menu_format') == 'Slider' && has_nav_menu( 'secondary-navigation' ) ) {
    wp_enqueue_script( 'happenstance-caroufredsel', get_template_directory_uri() . '/js/caroufredsel.min.js', array( 'jquery' ), '6.2.1', true );
    wp_enqueue_script( 'happenstance-caroufredsel-settings', get_template_directory_uri() . '/js/caroufredsel-settings.js', array(), '1.0', true ); }
  if ( get_theme_mod('happenstance_post_entry_format') == 'Grid - Masonry' ) {
  if ( is_home() || is_archive() || is_search() ) {
    wp_enqueue_script( 'jquery-masonry' );
    if ( !is_rtl() ) {
      wp_enqueue_script( 'happenstance-masonry-settings', get_template_directory_uri() . '/js/masonry-settings.js', array(), '1.0', true ); } else {
      wp_enqueue_script( 'happenstance-masonry-settings-rtl', get_template_directory_uri() . '/js/masonry-settings-rtl.js', array(), '1.0', true ); }}}
  if ( get_theme_mod('happenstance_related_posts_format') != 'Unordered List' && is_single() ) {
    wp_enqueue_script( 'happenstance-flexslider', get_template_directory_uri() . '/js/flexslider.min.js', array( 'jquery' ), '2.6.1', true );
    if ( !is_rtl() ) {
      wp_enqueue_script( 'happenstance-flexslider-settings', get_template_directory_uri() . '/js/flexslider-settings.js', array( 'jquery' ), '1.0', true ); } else {
      wp_enqueue_script( 'happenstance-flexslider-settings-rtl', get_template_directory_uri() . '/js/flexslider-settings-rtl.js', array( 'jquery' ), '1.0', true ); }}
    wp_enqueue_script( 'happenstance-placeholders', get_template_directory_uri() . '/js/placeholders.js', array( 'jquery' ), '2.0.8', true );
  if ( get_theme_mod('happenstance_display_scroll_top') != 'Hide' ) {
    wp_enqueue_script( 'happenstance-scroll-to-top', get_template_directory_uri() . '/js/scroll-to-top.js', array( 'jquery' ), '1.0', true ); }
  if ( get_theme_mod('happenstance_fixed_menu') != 'Disable' && !is_page_template('template-landing-page.php') ) {
    wp_enqueue_script( 'happenstance-menubox', get_template_directory_uri() . '/js/menubox.js', array(), '1.0', true ); }
    wp_enqueue_script( 'happenstance-selectnav', get_template_directory_uri() . '/js/selectnav.js', array(), '0.1', true );
      $happenstance_site_parameters = array(
        'message_menu' => __( '= Menu =', 'happenstance' ),
        'message_home' => __( 'Home', 'happenstance' ),
        'link_home' => esc_url(home_url('/')) );
      wp_localize_script( 'happenstance-selectnav', 'HappenStanceSiteParameters', $happenstance_site_parameters );
    wp_enqueue_script( 'happenstance-responsive', get_template_directory_uri() . '/js/responsive.js', array(), '1.0', true );
    wp_enqueue_script( 'happenstance-html5-ie', get_template_directory_uri() . '/js/html5.js', array(), '3.7.3', false );
      wp_script_add_data( 'happenstance-html5-ie', 'conditional', 'lt IE 9' );
// Adds CSS
    wp_enqueue_style( 'happenstance-elegantfont', get_template_directory_uri() . '/css/elegantfont.css' );
    wp_enqueue_style( 'happenstance-google-font-default', '//fonts.googleapis.com/css?family=Oswald&amp;subset=latin,latin-ext' );
  if ( class_exists( 'woocommerce' ) ) {
    wp_enqueue_style( 'happenstance-woocommerce-custom', get_template_directory_uri() . '/css/woocommerce-custom.css' ); }
}
add_action( 'wp_enqueue_scripts', 'happenstance_scripts_styles' );

/**
 * Backwards compatibility for older WordPress versions that do not support the Title Tag feature.
 *  
*/
if ( ! function_exists( 'happenstance_wp_title' ) ) {
if ( ! function_exists( '_wp_render_title_tag' ) ) {
function happenstance_wp_title( $title, $sep ) {
	if ( is_feed() )
		return $title;
	$title .= get_bloginfo( 'name' );
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";
	return $title;
}
add_filter( 'wp_title', 'happenstance_wp_title', 10, 2 );
}}

/**
 * Register our menus.
 *
 */
function happenstance_register_my_menus() {
  register_nav_menus(
    array(
      'main-navigation' => __( 'Primary Header Menu', 'happenstance' ),
      'secondary-navigation' => __( 'Secondary Header Menu', 'happenstance' ),
      'social-links-navigation' => __( 'Social Links Menu', 'happenstance' )
    )
  );
}
add_action( 'after_setup_theme', 'happenstance_register_my_menus' );

/**
 * Register our sidebars and widgetized areas.
 *
*/
function happenstance_widgets_init() {
  register_sidebar( array(
		'name' => __( 'Sidebar', 'happenstance' ),
		'id' => 'sidebar-1',
		'description' => __( 'Main sidebar that is displayed on all pages and posts.', 'happenstance' ),
		'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => ' <p class="sidebar-headline"><span class="sidebar-headline-text">',
		'after_title' => '</span></p>',
	) );
  register_sidebar( array(
		'name' => __( 'Footer Left Widget Area', 'happenstance' ),
		'id' => 'sidebar-2',
		'description' => __( 'Left column with widgets in footer.', 'happenstance' ),
		'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<p class="footer-headline"><span class="footer-headline-text">',
		'after_title' => '</span></p>',
	) );
  register_sidebar( array(
		'name' => __( 'Footer Middle Widget Area', 'happenstance' ),
		'id' => 'sidebar-3',
		'description' => __( 'Middle column with widgets in footer.', 'happenstance' ),
		'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<p class="footer-headline"><span class="footer-headline-text">',
		'after_title' => '</span></p>',
	) );
  register_sidebar( array(
		'name' => __( 'Footer Right Widget Area', 'happenstance' ),
		'id' => 'sidebar-4',
		'description' => __( 'Right column with widgets in footer.', 'happenstance' ),
		'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<p class="footer-headline"><span class="footer-headline-text">',
		'after_title' => '</span></p>',
	) );
  register_sidebar( array(
		'name' => __( 'Footer Notices', 'happenstance' ),
		'id' => 'sidebar-5',
		'description' => __( 'Line for copyright and other notices.', 'happenstance' ),
		'before_widget' => '<div class="footer-signature"><div class="footer-signature-content">',
		'after_widget' => '</div></div>',
		'before_title' => '',
		'after_title' => '',
	) );
  register_sidebar( array(
		'name' => __( 'Latest Posts Page Widget Area', 'happenstance' ),
		'id' => 'sidebar-6',
		'description' => __( 'Widget area that is displayed at the top of the Latest Posts (Blog) page.', 'happenstance' ),
		'before_widget' => '<div id="%1$s" class="blog-widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => ' <p class="blog-headline"><span class="blog-headline-text">',
		'after_title' => '</span></p>',
	) );
}
add_action( 'widgets_init', 'happenstance_widgets_init' );

/**
 * Post excerpt settings.
 *
*/
if ( ! function_exists( 'happenstance_custom_excerpt_length' ) ) {
function happenstance_custom_excerpt_length( $length ) {
if (get_theme_mod('happenstance_excerpt_length') != '') {
return get_theme_mod('happenstance_excerpt_length');
} else { return 40; }
}
add_filter( 'excerpt_length', 'happenstance_custom_excerpt_length', 20 );
}

if ( ! function_exists( 'happenstance_new_excerpt_more' ) ) {
function happenstance_new_excerpt_more( $more ) {
global $post;
return '...<br /><a class="read-more-button" href="'. esc_url( get_permalink($post->ID) ) . '">' . __( 'Read more', 'happenstance' ) . '</a>';}
add_filter( 'excerpt_more', 'happenstance_new_excerpt_more' ); 
}

/**
 * Displays navigation to next/previous pages when applicable.
 *
*/
if ( ! function_exists( 'happenstance_content_nav' ) ) {
function happenstance_content_nav( $html_id ) {
	global $wp_query;
	$html_id = esc_attr( $html_id );
	if ( $wp_query->max_num_pages > 1 ) : ?>
		<div id="<?php echo $html_id; ?>" class="navigation" role="navigation">
    <div class="navigation-inner">
			<h2 class="navigation-headline section-heading"><?php _e( 'Post navigation', 'happenstance' ); ?></h2>
      <div class="nav-wrapper">
			 <p class="navigation-links">
<?php $big = 999999999;
echo paginate_links( array(
	'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
	'format' => '?paged=%#%',
	'current' => max( 1, get_query_var('paged') ),
  'prev_text' => __( '&larr; Previous', 'happenstance' ),
	'next_text' => __( 'Next &rarr;', 'happenstance' ),
	'total' => $wp_query->max_num_pages,
	'add_args' => false
) );
?>
        </p>
      </div>
		</div>
    </div>
	<?php endif;
}
}

/**
 * Displays navigation to next/previous posts on single posts pages.
 *
*/
if ( ! function_exists( 'happenstance_prev_next' ) ) {
function happenstance_prev_next($nav_id) { ?>
<?php $happenstance_previous_post = get_adjacent_post( false, "", true );
$happenstance_next_post = get_adjacent_post( false, "", false ); ?>
<div id="<?php echo $nav_id; ?>" class="navigation" role="navigation">
	<div class="nav-wrapper">
<?php if ( !empty($happenstance_previous_post) ) { ?>
  <p class="nav-previous"><a href="<?php echo esc_url(get_permalink($happenstance_previous_post->ID)); ?>" title="<?php echo esc_attr($happenstance_previous_post->post_title); ?>"><?php _e( '&larr; Previous post', 'happenstance' ); ?></a></p>
<?php } if ( !empty($happenstance_next_post) ) { ?>
	<p class="nav-next"><a href="<?php echo esc_url(get_permalink($happenstance_next_post->ID)); ?>" title="<?php echo esc_attr($happenstance_next_post->post_title); ?>"><?php _e( 'Next post &rarr;', 'happenstance' ); ?></a></p>
<?php } ?>
   </div>
</div>
<?php } 
}

/**
 * Template for comments and pingbacks.
 *
*/
if ( ! function_exists( 'happenstance_comment' ) ) {
function happenstance_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'happenstance' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'happenstance' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>" class="comment">
			<div class="comment-meta comment-author vcard">
				<?php
					echo get_avatar( $comment, 44 );
					printf( '<span><b class="fn">%1$s</b> %2$s</span>',
						get_comment_author_link(),
						( $comment->user_id === $post->post_author ) ? '<span>' . __( '(Post author)', 'happenstance' ) . '</span>' : ''
					);
					printf( '<time datetime="%2$s">%3$s</time>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						// translators: 1: date, 2: time
						sprintf( __( '%1$s at %2$s', 'happenstance' ), get_comment_date(''), get_comment_time() )
					);
				?>
			</div><!-- .comment-meta -->

			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'happenstance' ); ?></p>
			<?php endif; ?>

			<div class="comment-content comment">
				<?php comment_text(); ?>
			 <div class="reply">
			   <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'happenstance' ), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
			   <?php edit_comment_link( __( 'Edit', 'happenstance' ), '<p class="edit-link">', '</p>' ); ?>
			</div><!-- .comment-content -->
		</div><!-- #comment-## -->
	<?php
		break;
	endswitch;
}
}

/**
 * Function for adding custom classes to the menu objects.
 *
*/
if ( ! function_exists( 'happenstance_filter_menu_class' ) ) {
add_filter( 'wp_nav_menu_objects', 'happenstance_filter_menu_class', 10, 2 );
function happenstance_filter_menu_class( $objects, $args ) {

    $ids        = array();
    $parent_ids = array();
    $top_ids    = array();
    foreach ( $objects as $i => $object ) {

        if ( 0 == $object->menu_item_parent ) {
            $top_ids[$i] = $object;
            continue;
        }
 
        if ( ! in_array( $object->menu_item_parent, $ids ) ) {
            $objects[$i]->classes[] = 'first-menu-item';
            $ids[]          = $object->menu_item_parent;
        }
 
        if ( in_array( 'first-menu-item', $object->classes ) )
            continue;
 
        $parent_ids[$i] = $object->menu_item_parent;
    }
 
    $sanitized_parent_ids = array_unique( array_reverse( $parent_ids, true ) );
 
    foreach ( $sanitized_parent_ids as $i => $id )
        $objects[$i]->classes[] = 'last-menu-item';
 
    return $objects; 
}
}

/**
 * Function for rendering CSS3 features in IE.
 *
*/
if ( ! function_exists( 'happenstance_pie' ) ) {
add_filter( 'wp_head' , 'happenstance_pie' );
function happenstance_pie() { ?>
<!--[if IE]>
<style type="text/css" media="screen">
#container-shadow, .attachment-post-thumbnail, .attachment-thumbnail {
        behavior: url("<?php echo get_template_directory_uri() . '/css/pie/PIE.php'; ?>");
        zoom: 1;
}
</style>
<![endif]-->
<?php }
}

/**
 * Include the TGM_Plugin_Activation class.
 *  
*/
if ( ! function_exists( 'happenstance_my_theme_register_required_plugins' ) ) {
if ( current_user_can ( 'install_plugins' ) ) {
require_once get_template_directory() . '/class-tgm-plugin-activation.php'; 
add_action( 'happenstance_register', 'happenstance_my_theme_register_required_plugins' );

function happenstance_my_theme_register_required_plugins() {

$plugins = array(
		array(
			'name'     => 'Breadcrumb NavXT',
			'slug'     => 'breadcrumb-navxt',
			'required' => false,
		),
    array(
			'name'     => 'The Events Calendar',
			'slug'     => 'the-events-calendar',
			'required' => false,
		),
	);
  
$config = array(
		'domain'       => 'happenstance',
    'menu'         => 'install-my-theme-plugins',
		'strings'    	 => array(
		'page_title'             => __( 'Install Recommended Plugins', 'happenstance' ),
		'menu_title'             => __( 'Install Plugins', 'happenstance' ),
		'instructions_install'   => __( 'The %1$s plugin is required for this theme. Click on the big blue button below to install and activate %1$s.', 'happenstance' ),
		'instructions_activate'  => __( 'The %1$s is installed but currently inactive. Please go to the <a href="%2$s">plugin administration page</a> page to activate it.', 'happenstance' ),
		'button'                 => __( 'Install %s Now', 'happenstance' ),
		'installing'             => __( 'Installing Plugin: %s', 'happenstance' ),
		'oops'                   => __( 'Something went wrong with the plugin API.', 'happenstance' ), // */
		'notice_can_install'     => __( 'This theme requires the %1$s plugin. <a href="%2$s"><strong>Click here to begin the installation process</strong></a>. You may be asked for FTP credentials based on your server setup.', 'happenstance' ),
		'notice_cannot_install'  => __( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'happenstance' ),
		'notice_can_activate'    => __( 'This theme requires the %1$s plugin. That plugin is currently inactive, so please go to the <a href="%2$s">plugin administration page</a> to activate it.', 'happenstance' ),
		'notice_cannot_activate' => __( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'happenstance' ),
		'return'                 => __( 'Return to Recommended Plugins Installer', 'happenstance' ),
),
); 
happenstance_tgmpa( $plugins, $config ); 
}}
}

/**
 * WooCommerce custom template modifications.
 *  
*/
if ( ! function_exists( 'happenstance_woocommerce_modifications' ) ) {
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
function happenstance_woocommerce_modifications() {
  remove_action ( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 ); 
}  
add_action ( 'init', 'happenstance_woocommerce_modifications' );
add_filter ( 'woocommerce_show_page_title', '__return_false' );
}
}

/**
 * Outputs Breadcrumb Navigation.
 *  
*/
if ( ! function_exists( 'happenstance_get_breadcrumb' ) ) {
function happenstance_get_breadcrumb() { 
if ( function_exists( 'bcn_display' ) && !is_front_page() ) { echo '<p class="breadcrumb-navigation">'; ?><?php bcn_display(); ?><?php echo '</p>'; }
} 
}

/**
 * Outputs Featured Image on single posts.
 *  
*/
if ( ! function_exists( 'happenstance_get_display_image_post' ) ) {
function happenstance_get_display_image_post() { 
if ( get_theme_mod('happenstance_display_image_post') != 'Hide' ) {
if ( has_post_thumbnail() ) {
the_post_thumbnail();
}}
}
}

/**
 * Outputs Featured Image on pages.
 *  
*/
if ( ! function_exists( 'happenstance_get_display_image_page' ) ) {
function happenstance_get_display_image_page() { 
if ( has_post_thumbnail() ) {
the_post_thumbnail();
}
}
}

/**
 * Outputs Custom Logo URL.
 *  
*/
if ( ! function_exists( 'happenstance_custom_logo' ) ) {
function happenstance_custom_logo() {	
if ( function_exists('the_custom_logo') ) {
$custom_logo_id = get_theme_mod('custom_logo');
$image = wp_get_attachment_image_src($custom_logo_id , 'full');
return $image[0];
} else {
return '';
}
}
} ?>