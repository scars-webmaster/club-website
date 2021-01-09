<?php if( ! defined( 'ABSPATH' ) ) exit;
/**
 * Sample implementation of the Custom Header feature.
 *
 */
function super_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'super_custom_header_args', array(
		'default-image' => get_template_directory_uri() . '/framework/images/header.jpg',	
		'default-text-color'     => 'fff',
		'width'                  => 1335,
		'height'                 => 600,
		'flex-height'            => true,
		'flex-width'            => true,
		'wp-head-callback'       => 'super_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'super_custom_header_setup' );

register_default_headers( array(
	'yourimg' => array(
	'url' => get_template_directory_uri() . '/framework/images/header.jpg',
	'thumbnail_url' => get_template_directory_uri() . '/framework/images/header.jpg',
	'description' => _x( 'Default Image', 'header image description', 'super' )),
));

if ( ! function_exists( 'super_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog.
 *
 * @see super_custom_header_setup().
 */
function super_header_style() {
	$super_header_text_color = get_header_textcolor();

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
		<?php
			// Has the text been hidden?
			if ( ! display_header_text() ) :
		?>
			.site-title,
			.site-description {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
			}
			.site-title,
			.site-description {
				display: none !important;
			}
		<?php
			// If the user has set a custom color for the text use that.
			else :
		?>
			header .site-branding .site-title a, header .header-img .site-title a, header .header-img .site-description,
			header  .site-branding .site-description {
				color: #<?php echo esc_attr( $super_header_text_color ); ?>;
			}
		<?php endif; ?>
	</style>
	<?php
}
endif;

/**
 * Custom Header Options
 */

add_action( 'customize_register', 'super_customize_custom_header_meta' );

function super_customize_custom_header_meta($wp_customize ) {
	
    $wp_customize->add_setting(
        'custom_header_position',
        array(
            'default'    => 'all',
            'capability' => 'edit_theme_options',
			'sanitize_callback' => 'super_sanitize_select',			
        )
    );

    $wp_customize->add_control(
        'custom_header_position',
        array(
            'settings' => 'custom_header_position',	
			'priority'    => 1,
            'label'    => __( 'Activate Header Image:', 'super' ),
            'section'  => 'header_image',
            'type'     => 'select',
            'choices'  => array(
                'deactivate' => __( 'Deactivate Header Image', 'super' ),
                'all' => __( 'All Pages', 'super' ),
                'home'  => __( 'Home Page', 'super' )
            ),
			'default'    => 'all'
        )
    );

	
}

function super_customize_css () { ?>
	<style>
		<?php if(get_theme_mod('header_height')) { ?> .header-img { height: <?php echo esc_attr(get_theme_mod('header_height')); ?>px; } <?php } ?>
	</style>
<?php	
}

add_action('wp_head','super_customize_css');


function super_sanitize_select( $input ) {
	$valid = array(
                'deactivate' => __( 'Deactivate Header Image', 'super' ),
                'all' => __( 'All Pages', 'super' ),
                'home'  => __( 'Home Page', 'super' )
	);

	if ( array_key_exists( $input, $valid ) ) {
		return $input;
	} else {
		return '';
	}
}
