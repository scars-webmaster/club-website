<?php
/**
 * Faith Theme Customizer.
 *
 * @package Faith
 */

/**
 * Sets up the WordPress core custom header and custom background features.
 *
 * @since Faith 1.0
 *
 * @see faith_header_style()
 */
function faith_custom_header_and_background() {
	$color_scheme             = faith_get_color_scheme();
	$default_background_color = sanitize_hex_color_no_hash( $color_scheme[0], '#' );
	$default_text_color       = sanitize_hex_color_no_hash( $color_scheme[4], '#' );

	/**
	 * Filter the arguments used when adding 'custom-background' support in Faith.
	 *
	 * @since Faith 1.0
	 *
	 * @param array $args {
	 *     An array of custom-background support arguments.
	 *
	 *     @type string $default-color Default color of the background.
	 * }
	 */
	add_theme_support( 'custom-background', apply_filters( 'faith_custom_background_args', array(
		'default-color' => $default_background_color,
	) ) );

}
add_action( 'after_setup_theme', 'faith_custom_header_and_background' );

// Extra styles
function faith_customizer_stylesheet() {
	
	// Stylesheet
	wp_enqueue_style( 'faith-customizer-css', get_template_directory_uri().'/inc/customizer-styles.css', NULL, NULL, 'all' );
	
}

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function faith_customize_register( $wp_customize ) {

	// Custom help section
	class Faith_WP_Help_Customize_Control extends WP_Customize_Control {
		public $type = 'text_help';
		public function render_content() {
			$faith_ep_activated = '';
			if ( get_option( 'faith_ep_license_status' ) == 'valid' ) {
				$faith_ep_activated = 'bnt-customizer-ep-active';
			}
			echo '
				<div class="bnt-customizer-help">
					<a class="bnt-customizer-link bnt-support-link" href="https://www.ilovewp.com/documentation/faith/" target="_blank">
						<span class="dashicons dashicons-book">
						</span>
						'.esc_html__( 'Theme Documentation', 'faith' ).'
					</a>
					<a class="bnt-customizer-link bnt-support-link" href="https://www.ilovewp.com/themes/faith/" target="_blank">
						<span class="dashicons dashicons-info">
						</span>
						'.esc_html__( 'Official Theme Page', 'faith' ).'
					</a>
					<a class="bnt-customizer-link bnt-support-link" href="https://wordpress.org/support/theme/faith/" target="_blank">
						<span class="dashicons dashicons-sos">
						</span>
						'.esc_html__( 'Support Forum', 'faith' ).'
					</a>
					<a class="bnt-customizer-link bnt-rate-link" href="https://wordpress.org/support/theme/faith/reviews/" target="_blank">
						<span class="dashicons dashicons-heart">
						</span>
						'.esc_html__( 'Rate Faith', 'faith' ).'
					</a>
				</div>
			';
		}
	}

    $theme_header_style = array(
        'default' => esc_html__('Default', 'faith'),
        'centered' => esc_html__('Centered', 'faith')
    );

	$color_scheme = faith_get_color_scheme();
	
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

		$wp_customize->add_section( 
			'faith_theme_support', 
			array(
				'title' => esc_html__( 'Theme Help & Support', 'faith' ),
				'priority' => 19,
			) 
		);
		
		$wp_customize->add_setting( 
			'faith_support', 
			array(
				'type' => 'theme_mod',
				'default' => '',
				'sanitize_callback' => 'esc_attr',
			)
		);
		$wp_customize->add_control(
			new Faith_WP_Help_Customize_Control(
			$wp_customize,
			'faith_support', 
				array(
					'section' => 'faith_theme_support',
					'type' => 'text_help',
				)
			)
		);

		// Add page background color setting and control.
		$wp_customize->add_setting( 'page_background_color', array(
			'default'           => $color_scheme[1],
			'sanitize_callback' => 'sanitize_hex_color',
		) );
	
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'page_background_color', array(
			'label'       => __( 'Page (Content Frame) Background Color', 'faith' ),
			'section'     => 'colors',
		) ) );

		// Add link color setting and control.
		$wp_customize->add_setting( 'link_color', array(
			'default'           => $color_scheme[3],
			'sanitize_callback' => 'sanitize_hex_color',
		) );
	
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
			'label'       => __( 'Link Color', 'faith' ),
			'section'     => 'colors',
		) ) );

		// Add link color setting and control.
		$wp_customize->add_setting( 'link_color_hover', array(
			'default'           => $color_scheme[4],
			'sanitize_callback' => 'sanitize_hex_color',
		) );
	
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color_hover', array(
			'label'       => __( 'Link Color :hover', 'faith' ),
			'section'     => 'colors',
		) ) );
	
		// Add main text color setting and control.
		$wp_customize->add_setting( 'main_text_color', array(
			'default'           => $color_scheme[5],
			'sanitize_callback' => 'sanitize_hex_color',
		) );
	
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'main_text_color', array(
			'label'       => __( 'Main Text Color', 'faith' ),
			'section'     => 'colors',
		) ) );
	
		// Add secondary text color setting and control.
		$wp_customize->add_setting( 'secondary_text_color', array(
			'default'           => $color_scheme[6],
			'sanitize_callback' => 'sanitize_hex_color',
		) );
	
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'secondary_text_color', array(
			'label'       => __( 'Secondary Text Color', 'faith' ),
			'section'     => 'colors',
		) ) );

		$wp_customize->add_setting( 'header_background_color', array(
			'default'           => $color_scheme[2],
			'sanitize_callback' => 'sanitize_hex_color',
		) );
	
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_background_color', array(
			'label'       => __( 'Header Background Color', 'faith' ),
			'section'     => 'colors',
		) ) );

		$wp_customize->add_setting( 'footer_background_color', array(
			'default'           => $color_scheme[7],
			'sanitize_callback' => 'sanitize_hex_color',
		) );
	
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_background_color', array(
			'label'       => __( 'Footer Background Color', 'faith' ),
			'section'     => 'colors',
		) ) );

		$wp_customize->add_setting( 'footer_text_color', array(
			'default'           => $color_scheme[7],
			'sanitize_callback' => 'sanitize_hex_color',
		) );
	
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_text_color', array(
			'label'       => __( 'Footer Text Color', 'faith' ),
			'section'     => 'colors',
		) ) );
	
		// Remove the core header textcolor control, as it shares the main text color.
		$wp_customize->remove_control( 'header_textcolor' );
	
		$wp_customize->add_setting( 'highlight_background_color', array(
			'default'           => $color_scheme[8],
			'sanitize_callback' => 'sanitize_hex_color',
		) );
	
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'highlight_background_color', array(
			'label'       => __( 'Accent Background Color', 'faith' ),
			'section'     => 'colors',
		) ) );
		
	$wp_customize->add_panel( 'faith_panel', array(
		'priority'       => 130,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => esc_html__( 'Theme Settings', 'faith' ),
		'description'    => esc_html__( 'Faith Theme Settings', 'faith' ),
	) );

	$wp_customize->add_section( 'faith_other_options', array(
		'title'		  => esc_html__( 'General Options', 'faith' ),
		'panel'		  => 'faith_panel',
	) );

		$wp_customize->add_setting( 'theme-header-style', array(
			'default'           => 'default',
			'sanitize_callback' => 'ilovewp_sanitize_text',
		) );

		$wp_customize->add_control( 'theme-header-style', array(
			'label'             => esc_html__( 'Header Layout', 'faith' ),
			'section'           => 'faith_other_options',
			'type'              => 'select',
			'choices' 			=> $theme_header_style,
		) );

		$wp_customize->add_setting( 'faith_single_featured_image', array(
			'default'           => 1,
			'sanitize_callback' => 'faith_sanitize_checkbox',
		) );

		$wp_customize->add_control( 'faith_single_featured_image', array(
			'label'             => esc_html__( 'Display the Featured Images in Posts and Pages', 'faith' ),
			'section'           => 'faith_other_options',
			'description' => esc_html( 'The recommended width of featured images is 1600px.', 'faith' ),
			'type'              => 'checkbox',
		) );

		$wp_customize->add_setting( 'faith_single_dynamic_menu', array(
			'default'           => 1,
			'sanitize_callback' => 'faith_sanitize_checkbox',
		) );

		$wp_customize->add_control( 'faith_single_dynamic_menu', array(
			'label'             => esc_html__( 'Display the Dynamic Menu in Sidebar', 'faith' ),
			'section'           => 'faith_other_options',
			'description' => esc_html( 'This will be displayed for child pages that have the same parent (if there are more than 1 child pages)', 'faith' ),
			'type'              => 'checkbox',
		) );

		$wp_customize->add_setting( 'faith_single_gravatar', array(
			'default'           => 0,
			'sanitize_callback' => 'faith_sanitize_checkbox',
		) );

		$wp_customize->add_control( 'faith_single_gravatar', array(
			'label'             => esc_html__( 'Display the Author Gravatar in Posts', 'faith' ),
			'section'           => 'faith_other_options',
			'type'              => 'checkbox',
		) );

	$wp_customize->add_section( 'faith_front_page', array(
		'title'		  => esc_html__( 'Featured Content', 'faith' ),
		'panel'		  => 'faith_panel',
	) );

		// Featured Pages checkbox
		$wp_customize->add_setting( 'faith_front_featured_pages', array(
			'default'           => 1,
			'sanitize_callback' => 'faith_sanitize_checkbox',
		) );

		$wp_customize->add_control( 'faith_front_featured_pages', array(
			'label'             => esc_html__( 'Display the Featured Pages Slideshow on the Front Page', 'faith' ),
			'section'           => 'faith_front_page',
			'type'              => 'checkbox',
		) );

		// Featured Pages
		$wp_customize->add_setting( 'faith_featured_page_1', array(
			'default'           => 'none',
			'sanitize_callback' => 'faith_sanitize_pages',
		) );

		$wp_customize->add_control( 'faith_featured_page_1', array(
			'label'             => esc_html__( 'Slideshow: Featured Page #1', 'faith' ),
			'description'		=> /* translators: pages URL */ sprintf( wp_kses( __( 'This list is populated with <a href="%1$s">Pages</a>.', 'faith' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'edit.php?post_type=page' ) ) ),
			'section'           => 'faith_front_page',
			'type'              => 'select',
			'choices' 			=> faith_get_pages(),
		) );
		
		$wp_customize->add_setting( 'faith_featured_page_2', array(
			'default'           => 'none',
			'sanitize_callback' => 'faith_sanitize_pages',
		) );

		$wp_customize->add_control( 'faith_featured_page_2', array(
			'label'             => esc_html__( 'Slideshow: Featured Page #2', 'faith' ),
			'section'           => 'faith_front_page',
			'type'              => 'select',
			'choices' 			=> faith_get_pages(),
		) );
		
		$wp_customize->add_setting( 'faith_featured_page_3', array(
			'default'           => 'none',
			'sanitize_callback' => 'faith_sanitize_pages',
		) );

		$wp_customize->add_control( 'faith_featured_page_3', array(
			'label'             => esc_html__( 'Slideshow: Featured Page #3', 'faith' ),
			'section'           => 'faith_front_page',
			'type'              => 'select',
			'choices' 			=> faith_get_pages(),
		) );
		
		$wp_customize->add_setting( 'faith_featured_page_4', array(
			'default'           => 'none',
			'sanitize_callback' => 'faith_sanitize_pages',
		) );

		$wp_customize->add_control( 'faith_featured_page_4', array(
			'label'             => esc_html__( 'Slideshow: Featured Page #4', 'faith' ),
			'section'           => 'faith_front_page',
			'type'              => 'select',
			'choices' 			=> faith_get_pages(),
		) );

		$wp_customize->add_setting( 'faith_featured_page_5', array(
			'default'           => 'none',
			'sanitize_callback' => 'faith_sanitize_pages',
		) );

		$wp_customize->add_control( 'faith_featured_page_5', array(
			'label'             => esc_html__( 'Slideshow: Featured Page #5', 'faith' ),
			'section'           => 'faith_front_page',
			'type'              => 'select',
			'choices' 			=> faith_get_pages(),
		) );

		$wp_customize->add_setting( 'faith_front_featured_pages_columns', array(
			'default'           => 1,
			'sanitize_callback' => 'faith_sanitize_checkbox',
		) );

		$wp_customize->add_control( 'faith_front_featured_pages_columns', array(
			'label'             => esc_html__( 'Display the Featured Pages (Columns) Section on the Front Page', 'faith' ),
			'section'           => 'faith_front_page',
			'type'              => 'checkbox',
		) );

		$wp_customize->add_setting( 'faith_front_featured_pages_columns_excerpt', array(
			'default'           => 1,
			'sanitize_callback' => 'faith_sanitize_checkbox',
		) );

		$wp_customize->add_control( 'faith_front_featured_pages_columns_excerpt', array(
			'label'             => esc_html__( 'Display the page excerpts for featured pages.', 'faith' ),
			'section'           => 'faith_front_page',
			'type'              => 'checkbox',
		) );

		$wp_customize->add_setting( 'faith_featured_page_column_1', array(
			'default'           => 'none',
			'sanitize_callback' => 'faith_sanitize_pages',
		) );

		$wp_customize->add_control( 'faith_featured_page_column_1', array(
			'label'             => esc_html__( 'Front Page: Featured Page #1', 'faith' ),
			'description'		=> /* translators: pages URL */sprintf( wp_kses( __( 'This list is populated with <a href="%1$s">Pages</a>.', 'faith' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'edit.php?post_type=page' ) ) ),
			'section'           => 'faith_front_page',
			'type'              => 'select',
			'choices' 			=> faith_get_pages(),
		) );
		
		$wp_customize->add_setting( 'faith_featured_page_column_2', array(
			'default'           => 'none',
			'sanitize_callback' => 'faith_sanitize_pages',
		) );

		$wp_customize->add_control( 'faith_featured_page_column_2', array(
			'label'             => esc_html__( 'Front Page: Featured Page #2', 'faith' ),
			'section'           => 'faith_front_page',
			'type'              => 'select',
			'choices' 			=> faith_get_pages(),
		) );
		
		$wp_customize->add_setting( 'faith_featured_page_column_3', array(
			'default'           => 'none',
			'sanitize_callback' => 'faith_sanitize_pages',
		) );

		$wp_customize->add_control( 'faith_featured_page_column_3', array(
			'label'             => esc_html__( 'Front Page: Featured Page #3', 'faith' ),
			'section'           => 'faith_front_page',
			'type'              => 'select',
			'choices' 			=> faith_get_pages(),
		) );
		
		$wp_customize->add_setting( 'faith_featured_page_column_4', array(
			'default'           => 'none',
			'sanitize_callback' => 'faith_sanitize_pages',
		) );

		$wp_customize->add_control( 'faith_featured_page_column_4', array(
			'label'             => esc_html__( 'Front Page: Featured Page #4', 'faith' ),
			'section'           => 'faith_front_page',
			'type'              => 'select',
			'choices' 			=> faith_get_pages(),
		) );

		$wp_customize->add_setting( 'faith_featured_page_column_5', array(
			'default'           => 'none',
			'sanitize_callback' => 'faith_sanitize_pages',
		) );

		$wp_customize->add_control( 'faith_featured_page_column_5', array(
			'label'             => esc_html__( 'Front Page: Featured Page #5', 'faith' ),
			'section'           => 'faith_front_page',
			'type'              => 'select',
			'choices' 			=> faith_get_pages(),
		) );

	$wp_customize->add_section( 'faith_footer_options', array(
		'title'		  => esc_html__( 'Footer', 'faith' ),
		'panel'		  => 'faith_panel',
	) );

		// Display disclaimer text in footer
		$wp_customize->add_setting( 'faith_footer_disclaimer_text', array(
			'default'           => '',
			'sanitize_callback' => 'wp_kses_post',
		) );

		$wp_customize->add_control( 'faith_footer_disclaimer_text', array(
			'label'             => esc_html__( 'Disclaimer text in footer', 'faith' ),
			'section'           => 'faith_footer_options',
			'type'              => 'textarea',
		) );

	return $wp_customize;

}
add_action( 'customize_register', 'faith_customize_register' );


if ( ! function_exists( 'faith_get_terms' ) ) :
/**
 * Return an array of tag names and slugs
 *
 * @since 1.0.0.
 *
 * @return array                The list of terms.
 */
function faith_get_terms() {

	$choices = array( 0 );

	// Default
	$choices = array( 'none' => esc_html__( 'None', 'faith' ) );

	// Post Tags
	$type_terms = get_terms( 'post_tag' );
	if ( ! empty( $type_terms ) ) {
		$type_slugs = wp_list_pluck( $type_terms, 'slug' );
		$type_names = wp_list_pluck( $type_terms, 'name' );
		$type_list = array_combine( $type_slugs, $type_names );
		$choices = $choices + $type_list;
	}

	return apply_filters( 'faith_get_terms', $choices );
}
endif;

if ( ! function_exists( 'faith_sanitize_terms' ) ) :
/**
 * Sanitize a value from a list of allowed values.
 *
 * @since 1.0.0.
 *
 * @param  mixed    $value      The value to sanitize.
 * @return mixed                The sanitized value.
 */
function faith_sanitize_terms( $value ) {

	$choices = faith_get_terms();
	$valid	 = array_keys( $choices );

	if ( ! in_array( $value, $valid ) ) {
		$value = 'none';
	}

	return $value;
}
endif;

if ( ! function_exists( 'faith_get_categories' ) ) :
/**
 * Return an array of tag names and slugs
 *
 * @since 1.0.0.
 *
 * @return array                The list of terms.
 */
function faith_get_categories() {

	$choices = array( 0 );

	// Default
	$choices = array( 'none' => esc_html__( 'None', 'faith' ) );

	// Categories
	$type_terms = get_terms( 'category' );
	if ( ! empty( $type_terms ) ) {

		$type_names = wp_list_pluck( $type_terms, 'name', 'term_id' );
		$choices = $choices + $type_names;

	}

	return apply_filters( 'faith_get_categories', $choices );
}
endif;

if ( ! function_exists( 'faith_sanitize_categories' ) ) :
/**
 * Sanitize a value from a list of allowed values.
 *
 * @since 1.0.0.
 *
 * @param  mixed    $value      The value to sanitize.
 * @return mixed                The sanitized value.
 */
function faith_sanitize_categories( $value ) {

	$choices = faith_get_categories();
	$valid	 = array_keys( $choices );

	if ( ! in_array( $value, $valid ) ) {
		$value = 'none';
	}

	return $value;
}
endif;

/**
 * Allow only certain tags and attributes in a string.
 *
 * @param  string    $string    The unsanitized string.
 * @return string               The sanitized string.
 */
function ilovewp_sanitize_text( $string ) {
    global $allowedtags;
    $expandedtags = $allowedtags;

    // span
    $expandedtags['span'] = array();

    // Enable id, class, and style attributes for each tag
    foreach ( $expandedtags as $tag => $attributes ) {
        $expandedtags[$tag]['id']    = true;
        $expandedtags[$tag]['class'] = true;
        $expandedtags[$tag]['style'] = true;
    }

    // br (doesn't need attributes)
    $expandedtags['br'] = array();

    /**
     * Customize the tags and attributes that are allows during text sanitization.
     *
     * @param array     $expandedtags    The list of allowed tags and attributes.
     * @param string    $string          The text string being sanitized.
     */
    apply_filters( 'ilovewp_sanitize_text_allowed_tags', $expandedtags, $string );

    return wp_kses( $string, $expandedtags );
}

if ( ! function_exists( 'faith_get_pages' ) ) :
/**
 * Return an array of pages
 *
 * @since 1.0.0.
 *
 * @return array                The list of pages.
 */
function faith_get_pages() {

	$choices = array( 0 );

	// Default
	$choices = array( 'none' => esc_html__( 'None', 'faith' ) );

	// Pages
	$type_terms = get_pages( array( 'sort_order' => 'asc' ) );
	if ( ! empty( $type_terms ) ) {

		$type_names = wp_list_pluck( $type_terms, 'post_title', 'ID' );
		$choices = $choices + $type_names;

	}

	return apply_filters( 'faith_get_pages', $choices );
}
endif;

if ( ! function_exists( 'faith_sanitize_pages' ) ) :
/**
 * Sanitize a value from a list of allowed values.
 *
 * @since 1.0.0.
 *
 * @param  mixed    $value      The value to sanitize.
 * @return mixed                The sanitized value.
 */
function faith_sanitize_pages( $value ) {

	$choices = faith_get_pages();
	$valid	 = array_keys( $choices );

	if ( ! in_array( $value, $valid ) ) {
		$value = 'none';
	}

	return $value;
}
endif;

if ( ! function_exists( 'faith_sanitize_checkbox' ) ) :
/**
 * Sanitize the checkbox.
 *
 * @param  mixed 	$input.
 * @return boolean	(true|false).
 */
function faith_sanitize_checkbox( $input ) {
	if ( 1 == $input ) {
		return true;
	} else {
		return false;
	}
}
endif;

if ( ! function_exists( 'faith_sanitize_widget_num' ) ) :
/**
 * Sanitize the Featured Category posts number.
 *
 * @param  boolean	$input.
 * @return boolean	(true|false).
 */
function faith_sanitize_widget_num( $input ) {
	$choices = array( '1', '2', '3', '4', '5', '6', '7', '8', '9', '10' );

	if ( ! in_array( $input, $choices ) ) {
		$input = '3';
	}

	return $input;
}
endif;

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function faith_customize_preview_js() {
	wp_enqueue_script( 'faith_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20160513', true );
}
add_action( 'customize_preview_init', 'faith_customize_preview_js' );

/**
 * Registers color schemes for Faith.
 *
 * Can be filtered with {@see 'faith_color_schemes'}.
 *
 * The order of colors in a colors array:
 * 1. Main Background Color.
 * 2. Page Background Color.
 * 3. Link Color.
 * 4. Main Text Color.
 * 5. Secondary Text Color.
 *
 * @since Faith 1.0
 *
 * @return array An associative array of color scheme options.
 */
function faith_get_color_schemes() {
	/**
	 * Filter the color schemes registered for use with Faith.
	 *
	 * The default schemes include 'default', 'dark', 'gray', 'red', and 'yellow'.
	 *
	 * @since Faith 1.0
	 *
	 * @param array $schemes {
	 *     Associative array of color schemes data.
	 *
	 *     @type array $slug {
	 *         Associative array of information for setting up the color scheme.
	 *
	 *         @type string $label  Color scheme label.
	 *         @type array  $colors HEX codes for default colors prepended with a hash symbol ('#').
	 *                              Colors are defined in the following order: Main background, page
	 *                              background, link, main text, secondary text.
	 *     }
	 * }
	 */
	 
	return apply_filters( 'faith_color_schemes', array(
		'default' => array(
			'label'  => __( 'Default', 'faith' ),
			'colors' => array(
				'#ffffff', // [0] background color 
				'#ffffff', // [1] content container background color
				'#f7f3f0', // [2] header background color 
				'#1e74a9', // [3] link color
				'#b1481b', // [4] link :hover color
				'#383838', // [5] main text color
				'#999999', // [6] secondary text color
				'#182122', // [7] footer background color
				'#b1481b', // [8] accent background color
				'#dddddd', // [9] footer text color
			),
		),
	) );
}

if ( ! function_exists( 'faith_get_color_scheme' ) ) :
/**
 * Retrieves the current Faith color scheme.
 *
 * Create your own faith_get_color_scheme() function to override in a child theme.
 *
 * @since Faith 1.0
 *
 * @return array An associative array of either the current or default color scheme HEX values.
 */
function faith_get_color_scheme() {
	$color_scheme_option = get_theme_mod( 'color_scheme', 'default' );
	$color_schemes       = faith_get_color_schemes();

	if ( array_key_exists( $color_scheme_option, $color_schemes ) ) {
		return $color_schemes[ $color_scheme_option ]['colors'];
	}

	return $color_schemes['default']['colors'];
}
endif; // faith_get_color_scheme

/**
 * Enqueues front-end CSS for the page background color.
 *
 * @since Faith 1.0
 *
 * @see wp_add_inline_style()
 */
function faith_page_background_color_css() {
	$color_scheme          = faith_get_color_scheme();
	$default_color         = $color_scheme[1];
	$page_background_color = get_theme_mod( 'page_background_color', $default_color );

	// Don't do anything if the current color is the default.
	if ( $page_background_color === $default_color ) {
		return;
	}

	$css = '
		/* Custom Page Background Color */
		.page-has-image .site-content-wrapper {
			background-color: %1$s;
		}';

	wp_add_inline_style( 'faith-style', sprintf( $css, esc_attr( $page_background_color ) ) );
}
add_action( 'wp_enqueue_scripts', 'faith_page_background_color_css', 11 );

/**
 * Enqueues front-end CSS for the header background color.
 *
 * @since Faith 1.0
 *
 * @see wp_add_inline_style()
 */
function faith_header_background_color_css() {
	$color_scheme          = faith_get_color_scheme();
	$default_color         = $color_scheme[2];
	$header_background_color = get_theme_mod( 'header_background_color', $default_color );

	// Don't do anything if the current color is the default.
	if ( $header_background_color === $default_color ) {
		return;
	}

	$css = '
		/* Custom Header Background Color */
		.site-header {
			background-color: %1$s;
		}';

	wp_add_inline_style( 'faith-style', sprintf( $css, esc_attr( $header_background_color ) ) );
}
add_action( 'wp_enqueue_scripts', 'faith_header_background_color_css', 11 );

/**
 * Enqueues front-end CSS for the footer background color.
 *
 * @since Faith 1.0
 *
 * @see wp_add_inline_style()
 */
function faith_footer_background_color_css() {
	$color_scheme          = faith_get_color_scheme();
	$default_color         = $color_scheme[7];
	$footer_background_color = get_theme_mod( 'footer_background_color', $default_color );

	// Don't do anything if the current color is the default.
	if ( $footer_background_color === $default_color ) {
		return;
	}

	$css = '
		/* Custom Footer Background Color */
		.site-footer {
			background-color: %1$s;
		}';

	wp_add_inline_style( 'faith-style', sprintf( $css, esc_attr( $footer_background_color ) ) );
}
add_action( 'wp_enqueue_scripts', 'faith_footer_background_color_css', 11 );

/**
 * Enqueues front-end CSS for the footer text color.
 *
 * @since Faith 1.1
 *
 * @see wp_add_inline_style()
 */
function faith_footer_text_color_css() {
	$color_scheme          = faith_get_color_scheme();
	$default_color         = $color_scheme[9];
	$footer_text_color = get_theme_mod( 'footer_text_color', $default_color );

	// Don't do anything if the current color is the default.
	if ( $footer_text_color === $default_color ) {
		return;
	}

	$css = '
		/* Custom Footer Text Color */
		.site-footer {
			color: %1$s;
		}';

	wp_add_inline_style( 'faith-style', sprintf( $css, esc_attr( $footer_text_color ) ) );
}
add_action( 'wp_enqueue_scripts', 'faith_footer_text_color_css', 11 );

/**
 * Enqueues front-end CSS for the Highlights background color.
 *
 * @since Faith 1.0
 *
 * @see wp_add_inline_style()
 */
function faith_highlight_background_color_css() {
	$color_scheme          = faith_get_color_scheme();
	$default_color         = $color_scheme[8];
	$highlight_background_color = get_theme_mod( 'highlight_background_color', $default_color );

	// Don't do anything if the current color is the default.
	if ( $highlight_background_color === $default_color ) {
		return;
	}

	$css = '
		/* Custom Accent Background Color */
		.sf-menu .menu-special a,
		#site-aside .widget_nav_menu .current-menu-item, .widget-ilovewp-related-pages .current-menu-item,
		.infinite-scroll #infinite-handle span,
		.post-navigation .nav-previous:hover,
		.post-navigation .nav-previous:focus,
		.post-navigation .nav-next:hover,
		.post-navigation .nav-next:focus,
		.posts-navigation .nav-previous:hover,
		.posts-navigation .nav-previous:focus,
		.posts-navigation .nav-next:hover,
		.posts-navigation .nav-next:focus {
			background-color: %1$s;
		}';

	wp_add_inline_style( 'faith-style', sprintf( $css, esc_attr( $highlight_background_color ) ) );
}
add_action( 'wp_enqueue_scripts', 'faith_highlight_background_color_css', 11 );

/**
 * Enqueues front-end CSS for the link color.
 *
 * @since Faith 1.0
 *
 * @see wp_add_inline_style()
 */
function faith_link_color_css() {
	$color_scheme    = faith_get_color_scheme();
	$default_color   = $color_scheme[3];
	$link_color = get_theme_mod( 'link_color', $default_color );

	// Don't do anything if the current color is the default.
	if ( $link_color === $default_color ) {
		return;
	}

	$css = '
		/* Custom Link Color */
		a,
		.ilovewp-posts-archive .post-meta a, 
		.ilovewp-page-intro .post-meta a {
			color: %1$s;
		}';

	wp_add_inline_style( 'faith-style', sprintf( $css, esc_attr( $link_color ) ) );
}
add_action( 'wp_enqueue_scripts', 'faith_link_color_css', 11 );

/**
 * Enqueues front-end CSS for the link :hover color.
 *
 * @since Faith 1.0
 *
 * @see wp_add_inline_style()
 */
function faith_link_color_hover_css() {
	$color_scheme    = faith_get_color_scheme();
	$default_color   = $color_scheme[4];
	$link_color = get_theme_mod( 'link_color_hover', $default_color );

	// Don't do anything if the current color is the default.
	if ( $link_color === $default_color ) {
		return;
	}

	$css = '
		/* Custom Link:hover Color */
		a:hover,
		a:focus,
		.ilovewp-post .post-meta .entry-date a:hover,
		.ilovewp-post .post-meta .entry-date a:focus,
		h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover,
		h1 a:focus, h2 a:focus, h3 a:focus, h4 a:focus, h5 a:focus, h6 a:focus,
		.ilovewp-posts-archive .title-post a:hover,
		.ilovewp-posts-archive .title-post a:focus,
		.ilovewp-posts-archive .post-meta a:hover,
		.ilovewp-posts-archive .post-meta a:focus,
		.ilovewp-post .post-meta .entry-date a:hover,
		.ilovewp-post .post-meta .entry-date a:focus {
			color: %1$s;
		}';

	wp_add_inline_style( 'faith-style', sprintf( $css, esc_attr( $link_color ) ) );
}
add_action( 'wp_enqueue_scripts', 'faith_link_color_hover_css', 11 );

/**
 * Enqueues front-end CSS for the main text color.
 *
 * @since Faith 1.0
 *
 * @see wp_add_inline_style()
 */
function faith_main_text_color_css() {
	$color_scheme    = faith_get_color_scheme();
	$default_color   = $color_scheme[5];
	$main_text_color = get_theme_mod( 'main_text_color', $default_color );

	// Don't do anything if the current color is the default.
	if ( $main_text_color === $default_color ) {
		return;
	}

	$css = '
		/* Custom Main Text Color */
		body {
			color: %1$s
		}';

	wp_add_inline_style( 'faith-style', sprintf( $css, esc_attr( $main_text_color ) ) );
}
add_action( 'wp_enqueue_scripts', 'faith_main_text_color_css', 11 );

/**
 * Enqueues front-end CSS for the secondary text color.
 *
 * @since Faith 1.0
 *
 * @see wp_add_inline_style()
 */
function faith_secondary_text_color_css() {
	$color_scheme    = faith_get_color_scheme();
	$default_color   = $color_scheme[6];
	$secondary_text_color = get_theme_mod( 'secondary_text_color', $default_color );

	// Don't do anything if the current color is the default.
	if ( $secondary_text_color === $default_color ) {
		return;
	}

	$css = '
		/* Custom Secondary Text Color */

		body:not(.search-results) .entry-summary {
			color: %1$s;
		}

		.ilovewp-posts-archive .post-meta span:before, 
		.ilovewp-page-intro .post-meta,
		.ilovewp-page-intro .post-meta span:before,
		.post-meta,
		.ilovewp-post .post-meta,
		#site-aside .widget_recent_entries .post-date, 
		#ilovewp-home-welcome .ilovewp-column-1 .post-date {
			color: %1$s;
		}';

	wp_add_inline_style( 'faith-style', sprintf( $css, esc_attr( $secondary_text_color ) ) );
}
add_action( 'wp_enqueue_scripts', 'faith_secondary_text_color_css', 11 );