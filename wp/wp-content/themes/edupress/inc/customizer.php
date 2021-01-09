<?php
/**
 * EduPress Theme Customizer.
 *
 * @package EduPress
 */

/**
 * Sets up the WordPress core custom header and custom background features.
 *
 * @since EduPress 1.0
 *
 * @see edupress_header_style()
 */
function edupress_custom_header_and_background() {
	$color_scheme             = edupress_get_color_scheme();
	$default_background_color = sanitize_hex_color_no_hash( $color_scheme[0], '#' );
	$default_text_color       = sanitize_hex_color_no_hash( $color_scheme[4], '#' );

	/**
	 * Filter the arguments used when adding 'custom-background' support in EduPress.
	 *
	 * @since EduPress 1.0
	 *
	 * @param array $args {
	 *     An array of custom-background support arguments.
	 *
	 *     @type string $default-color Default color of the background.
	 * }
	 */
	add_theme_support( 'custom-background', apply_filters( 'edupress_custom_background_args', array(
		'default-color' => $default_background_color,
	) ) );

}
add_action( 'after_setup_theme', 'edupress_custom_header_and_background' );

// Extra styles
function edupress_customizer_stylesheet() {
	
	// Stylesheet
	wp_enqueue_style( 'edupress-customizer-css', get_template_directory_uri().'/inc/customizer-styles.css', NULL, NULL, 'all' );
	
}

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function edupress_customize_register( $wp_customize ) {

	// Custom help section
	class Edupress_WP_Help_Customize_Control extends WP_Customize_Control {
		public $type = 'text_help';
		public function render_content() {
			$edupress_ep_activated = '';
			if ( get_option( 'edupress_ep_license_status' ) == 'valid' ) {
				$edupress_ep_activated = 'bnt-customizer-ep-active';
			}
			echo '
				<div class="bnt-customizer-help">
					<a class="bnt-customizer-link bnt-support-link" href="https://www.ilovewp.com/documentation/edupress/" target="_blank">
						<span class="dashicons dashicons-book">
						</span>
						'.esc_html__( 'Theme Documentation', 'edupress' ).'
					</a>
					<a class="bnt-customizer-link bnt-support-link" href="https://www.ilovewp.com/themes/edupress/" target="_blank">
						<span class="dashicons dashicons-info">
						</span>
						'.esc_html__( 'Official Theme Page', 'edupress' ).'
					</a>
					<a class="bnt-customizer-link bnt-support-link" href="https://wordpress.org/support/theme/edupress/" target="_blank">
						<span class="dashicons dashicons-sos">
						</span>
						'.esc_html__( 'Support Forum', 'edupress' ).'
					</a>
					<a class="bnt-customizer-link bnt-rate-link" href="https://wordpress.org/support/theme/edupress/reviews/" target="_blank">
						<span class="dashicons dashicons-heart">
						</span>
						'.esc_html__( 'Rate Edupress', 'edupress' ).'
					</a>
				</div>
			';
		}
	}

    $theme_header_style = array(
        'default' => esc_html__('Default', 'edupress'),
        'centered' => esc_html__('Centered', 'edupress')
    );

    $theme_sidebar_positions = array(
        'left'      => esc_html__('Left', 'edupress'),
        'right'     => esc_html__('Right', 'edupress')
    );

	$color_scheme = edupress_get_color_scheme();
	
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

		$wp_customize->add_section( 
			'edupress_theme_support', 
			array(
				'title' => esc_html__( 'Theme Help & Support', 'edupress' ),
				'priority' => 19,
			) 
		);
		
		$wp_customize->add_setting( 
			'edupress_support', 
			array(
				'type' => 'theme_mod',
				'default' => '',
				'sanitize_callback' => 'esc_attr',
			)
		);
		$wp_customize->add_control(
			new Edupress_WP_Help_Customize_Control(
			$wp_customize,
			'edupress_support', 
				array(
					'section' => 'edupress_theme_support',
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
			'label'       => __( 'Page Background Color', 'edupress' ),
			'section'     => 'colors',
		) ) );

		// Add link color setting and control.
		$wp_customize->add_setting( 'link_color', array(
			'default'           => $color_scheme[3],
			'sanitize_callback' => 'sanitize_hex_color',
		) );
	
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
			'label'       => __( 'Link Color', 'edupress' ),
			'section'     => 'colors',
		) ) );

		// Add link color setting and control.
		$wp_customize->add_setting( 'link_color_hover', array(
			'default'           => $color_scheme[4],
			'sanitize_callback' => 'sanitize_hex_color',
		) );
	
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color_hover', array(
			'label'       => __( 'Link Color :hover', 'edupress' ),
			'section'     => 'colors',
		) ) );
	
		// Add main text color setting and control.
		$wp_customize->add_setting( 'main_text_color', array(
			'default'           => $color_scheme[5],
			'sanitize_callback' => 'sanitize_hex_color',
		) );
	
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'main_text_color', array(
			'label'       => __( 'Main Text Color', 'edupress' ),
			'section'     => 'colors',
		) ) );
	
		// Add secondary text color setting and control.
		$wp_customize->add_setting( 'secondary_text_color', array(
			'default'           => $color_scheme[6],
			'sanitize_callback' => 'sanitize_hex_color',
		) );
	
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'secondary_text_color', array(
			'label'       => __( 'Secondary Text Color', 'edupress' ),
			'section'     => 'colors',
		) ) );

		$wp_customize->add_setting( 'header_background_color', array(
			'default'           => $color_scheme[2],
			'sanitize_callback' => 'sanitize_hex_color',
		) );
	
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_background_color', array(
			'label'       => __( 'Header Background Color', 'edupress' ),
			'section'     => 'colors',
		) ) );

		$wp_customize->add_setting( 'footer_background_color', array(
			'default'           => $color_scheme[7],
			'sanitize_callback' => 'sanitize_hex_color',
		) );
	
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_background_color', array(
			'label'       => __( 'Footer Background Color', 'edupress' ),
			'section'     => 'colors',
		) ) );
	
		// Remove the core header textcolor control, as it shares the main text color.
		$wp_customize->remove_control( 'header_textcolor' );
	
		$wp_customize->add_setting( 'header_background_bordercolor', array(
			'default'           => $color_scheme[8],
			'sanitize_callback' => 'sanitize_hex_color',
		) );
	
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_background_bordercolor', array(
			'label'       => __( 'Header Bottom Border Color', 'edupress' ),
			'section'     => 'colors',
		) ) );

		$wp_customize->add_setting( 'footer_background_bordercolor', array(
			'default'           => $color_scheme[10],
			'sanitize_callback' => 'sanitize_hex_color',
		) );
	
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_background_bordercolor', array(
			'label'       => __( 'Footer Top Border Color', 'edupress' ),
			'section'     => 'colors',
		) ) );

		$wp_customize->add_setting( 'highlight_background_color', array(
			'default'           => $color_scheme[9],
			'sanitize_callback' => 'sanitize_hex_color',
		) );
	
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'highlight_background_color', array(
			'label'       => __( 'Highlight Background Color', 'edupress' ),
			'section'     => 'colors',
		) ) );
		
		$wp_customize->add_setting( 'std_widget_title_background_color', array(
			'default'           => $color_scheme[11],
			'sanitize_callback' => 'sanitize_hex_color',
		) );
	
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'std_widget_title_background_color', array(
			'label'       => __( 'Widget Title Background Color', 'edupress' ),
			'section'     => 'colors',
		) ) );
		
		$wp_customize->add_setting( 'menu_widget_title_background_color', array(
			'default'           => $color_scheme[12],
			'sanitize_callback' => 'sanitize_hex_color',
		) );
	
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'menu_widget_title_background_color', array(
			'label'       => __( 'Menu Widget Title Background Color', 'edupress' ),
			'section'     => 'colors',
		) ) );

	$wp_customize->add_panel( 'edupress_panel', array(
		'priority'       => 130,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => esc_html__( 'Theme Settings', 'edupress' ),
		'description'    => esc_html__( 'EduPress Theme Settings', 'edupress' ),
	) );


	$wp_customize->add_section( 'edupress_other_options', array(
		'title'		  => esc_html__( 'General Options', 'edupress' ),
		'panel'		  => 'edupress_panel',
	) );

		$wp_customize->add_setting( 'theme-header-style', array(
			'default'           => 'default',
			'sanitize_callback' => 'ilovewp_sanitize_text',
		) );

		$wp_customize->add_control( 'theme-header-style', array(
			'label'             => esc_html__( 'Header Layout', 'edupress' ),
			'section'           => 'edupress_other_options',
			'type'              => 'select',
			'choices' 			=> $theme_header_style,
		) );

		$wp_customize->add_setting( 'theme-sidebar-position', array(
			'default'           => 'left',
			'sanitize_callback' => 'ilovewp_sanitize_text',
		) );

		$wp_customize->add_control( 'theme-sidebar-position', array(
			'label'             => esc_html__( 'Sidebar Position', 'edupress' ),
			'section'           => 'edupress_other_options',
			'type'              => 'select',
			'choices' 			=> $theme_sidebar_positions,
		) );

		$wp_customize->add_setting( 'edupress_single_featured_image', array(
			'default'           => 1,
			'sanitize_callback' => 'edupress_sanitize_checkbox',
		) );

		$wp_customize->add_control( 'edupress_single_featured_image', array(
			'label'             => esc_html__( 'Display Featured Image on Post Pages', 'edupress' ),
			'section'           => 'edupress_other_options',
			'description' => esc_html( 'The recommended width of featured images is 1220px.', 'edupress' ),
			'type'              => 'checkbox',
		) );

		$wp_customize->add_setting( 'edupress_single_gravatar', array(
			'default'           => 1,
			'sanitize_callback' => 'edupress_sanitize_checkbox',
		) );

		$wp_customize->add_control( 'edupress_single_gravatar', array(
			'label'             => esc_html__( 'Display Author Gravatar on Post Pages', 'edupress' ),
			'section'           => 'edupress_other_options',
			'type'              => 'checkbox',
		) );

		$wp_customize->add_setting( 'edupress_single_author', array(
			'default'           => 1,
			'sanitize_callback' => 'edupress_sanitize_checkbox',
		) );

		$wp_customize->add_control( 'edupress_single_author', array(
			'label'             => esc_html__( 'Display Author Name on Post Pages', 'edupress' ),
			'section'           => 'edupress_other_options',
			'type'              => 'checkbox',
		) );

		$wp_customize->add_setting( 'edupress_single_date', array(
			'default'           => 1,
			'sanitize_callback' => 'edupress_sanitize_checkbox',
		) );

		$wp_customize->add_control( 'edupress_single_date', array(
			'label'             => esc_html__( 'Display Date on Post Pages', 'edupress' ),
			'section'           => 'edupress_other_options',
			'type'              => 'checkbox',
		) );

		$wp_customize->add_setting( 'edupress_single_category', array(
			'default'           => 1,
			'sanitize_callback' => 'edupress_sanitize_checkbox',
		) );

		$wp_customize->add_control( 'edupress_single_category', array(
			'label'             => esc_html__( 'Display Category on Post Pages', 'edupress' ),
			'section'           => 'edupress_other_options',
			'type'              => 'checkbox',
		) );

	$wp_customize->add_section( 'edupress_front_page', array(
		'title'		  => esc_html__( 'Featured Content', 'edupress' ),
		'panel'		  => 'edupress_panel',
	) );

		// Featured Pages checkbox
		$wp_customize->add_setting( 'edupress_front_featured_pages', array(
			'default'           => 1,
			'sanitize_callback' => 'edupress_sanitize_checkbox',
		) );

		$wp_customize->add_control( 'edupress_front_featured_pages', array(
			'label'             => esc_html__( 'Show Featured Pages (Tabs) Section on the Front Page', 'edupress' ),
			'section'           => 'edupress_front_page',
			'type'              => 'checkbox',
		) );
		
		$wp_customize->add_setting( 'edupress_front_featured_pages_title', array(
			'default'           => 1,
			'sanitize_callback' => 'edupress_sanitize_checkbox',
		) );

		$wp_customize->add_control( 'edupress_front_featured_pages_title', array(
			'label'             => esc_html__( 'Show the page titles and excerpts for the Featured Pages', 'edupress' ),
			'section'           => 'edupress_front_page',
			'type'              => 'checkbox',
		) );

		// Featured Pages
		$wp_customize->add_setting( 'edupress_featured_page_1', array(
			'default'           => 'none',
			'sanitize_callback' => 'edupress_sanitize_pages',
		) );

		$wp_customize->add_control( 'edupress_featured_page_1', array(
			'label'             => esc_html__( 'Front Page: Featured Page #1', 'edupress' ),
			'description'		=> /* translators: pages URL */ sprintf( wp_kses( __( 'This list is populated with <a href="%1$s">Pages</a>.', 'edupress' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'edit.php?post_type=page' ) ) ),
			'section'           => 'edupress_front_page',
			'type'              => 'select',
			'choices' 			=> edupress_get_pages(),
		) );
		
		$wp_customize->add_setting( 'edupress_featured_page_2', array(
			'default'           => 'none',
			'sanitize_callback' => 'edupress_sanitize_pages',
		) );

		$wp_customize->add_control( 'edupress_featured_page_2', array(
			'label'             => esc_html__( 'Front Page: Featured Page #2', 'edupress' ),
			'section'           => 'edupress_front_page',
			'type'              => 'select',
			'choices' 			=> edupress_get_pages(),
		) );
		
		$wp_customize->add_setting( 'edupress_featured_page_3', array(
			'default'           => 'none',
			'sanitize_callback' => 'edupress_sanitize_pages',
		) );

		$wp_customize->add_control( 'edupress_featured_page_3', array(
			'label'             => esc_html__( 'Front Page: Featured Page #3', 'edupress' ),
			'section'           => 'edupress_front_page',
			'type'              => 'select',
			'choices' 			=> edupress_get_pages(),
		) );
		
		$wp_customize->add_setting( 'edupress_featured_page_4', array(
			'default'           => 'none',
			'sanitize_callback' => 'edupress_sanitize_pages',
		) );

		$wp_customize->add_control( 'edupress_featured_page_4', array(
			'label'             => esc_html__( 'Front Page: Featured Page #4', 'edupress' ),
			'section'           => 'edupress_front_page',
			'type'              => 'select',
			'choices' 			=> edupress_get_pages(),
		) );

		$wp_customize->add_setting( 'edupress_front_featured_pages_columns', array(
			'default'           => 1,
			'sanitize_callback' => 'edupress_sanitize_checkbox',
		) );

		$wp_customize->add_control( 'edupress_front_featured_pages_columns', array(
			'label'             => esc_html__( 'Show Featured Pages (Columns) Section on the Front Page', 'edupress' ),
			'section'           => 'edupress_front_page',
			'type'              => 'checkbox',
		) );

		$wp_customize->add_setting( 'edupress_front_featured_pages_columns_excerpt', array(
			'default'           => 1,
			'sanitize_callback' => 'edupress_sanitize_checkbox',
		) );

		$wp_customize->add_control( 'edupress_front_featured_pages_columns_excerpt', array(
			'label'             => esc_html__( 'Display the page excerpts for featured pages.', 'edupress' ),
			'section'           => 'edupress_front_page',
			'type'              => 'checkbox',
		) );

		$wp_customize->add_setting( 'edupress_featured_page_column_1', array(
			'default'           => 'none',
			'sanitize_callback' => 'edupress_sanitize_pages',
		) );

		$wp_customize->add_control( 'edupress_featured_page_column_1', array(
			'label'             => esc_html__( 'Front Page: Featured Page #1', 'edupress' ),
			'description'		=> /* translators: pages URL */ sprintf( wp_kses( __( 'This list is populated with <a href="%1$s">Pages</a>.', 'edupress' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'edit.php?post_type=page' ) ) ),
			'section'           => 'edupress_front_page',
			'type'              => 'select',
			'choices' 			=> edupress_get_pages(),
		) );
		
		$wp_customize->add_setting( 'edupress_featured_page_column_2', array(
			'default'           => 'none',
			'sanitize_callback' => 'edupress_sanitize_pages',
		) );

		$wp_customize->add_control( 'edupress_featured_page_column_2', array(
			'label'             => esc_html__( 'Front Page: Featured Page #2', 'edupress' ),
			'section'           => 'edupress_front_page',
			'type'              => 'select',
			'choices' 			=> edupress_get_pages(),
		) );
		
		$wp_customize->add_setting( 'edupress_featured_page_column_3', array(
			'default'           => 'none',
			'sanitize_callback' => 'edupress_sanitize_pages',
		) );

		$wp_customize->add_control( 'edupress_featured_page_column_3', array(
			'label'             => esc_html__( 'Front Page: Featured Page #3', 'edupress' ),
			'section'           => 'edupress_front_page',
			'type'              => 'select',
			'choices' 			=> edupress_get_pages(),
		) );

	return $wp_customize;

}
add_action( 'customize_register', 'edupress_customize_register' );


if ( ! function_exists( 'edupress_get_terms' ) ) :
/**
 * Return an array of tag names and slugs
 *
 * @since 1.0.0.
 *
 * @return array                The list of terms.
 */
function edupress_get_terms() {

	$choices = array( 0 );

	// Default
	$choices = array( 'none' => esc_html__( 'None', 'edupress' ) );

	// Post Tags
	$type_terms = get_terms( 'post_tag' );
	if ( ! empty( $type_terms ) ) {
		$type_slugs = wp_list_pluck( $type_terms, 'slug' );
		$type_names = wp_list_pluck( $type_terms, 'name' );
		$type_list = array_combine( $type_slugs, $type_names );
		$choices = $choices + $type_list;
	}

	return apply_filters( 'edupress_get_terms', $choices );
}
endif;

if ( ! function_exists( 'edupress_sanitize_terms' ) ) :
/**
 * Sanitize a value from a list of allowed values.
 *
 * @since 1.0.0.
 *
 * @param  mixed    $value      The value to sanitize.
 * @return mixed                The sanitized value.
 */
function edupress_sanitize_terms( $value ) {

	$choices = edupress_get_terms();
	$valid	 = array_keys( $choices );

	if ( ! in_array( $value, $valid ) ) {
		$value = 'none';
	}

	return $value;
}
endif;

if ( ! function_exists( 'edupress_get_categories' ) ) :
/**
 * Return an array of tag names and slugs
 *
 * @since 1.0.0.
 *
 * @return array                The list of terms.
 */
function edupress_get_categories() {

	$choices = array( 0 );

	// Default
	$choices = array( 'none' => esc_html__( 'None', 'edupress' ) );

	// Categories
	$type_terms = get_terms( 'category' );
	if ( ! empty( $type_terms ) ) {

		$type_names = wp_list_pluck( $type_terms, 'name', 'term_id' );
		$choices = $choices + $type_names;

	}

	return apply_filters( 'edupress_get_categories', $choices );
}
endif;

if ( ! function_exists( 'edupress_sanitize_categories' ) ) :
/**
 * Sanitize a value from a list of allowed values.
 *
 * @since 1.0.0.
 *
 * @param  mixed    $value      The value to sanitize.
 * @return mixed                The sanitized value.
 */
function edupress_sanitize_categories( $value ) {

	$choices = edupress_get_categories();
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

if ( ! function_exists( 'edupress_get_pages' ) ) :
/**
 * Return an array of pages
 *
 * @since 1.0.0.
 *
 * @return array                The list of pages.
 */
function edupress_get_pages() {

	$choices = array( 0 );

	// Default
	$choices = array( 'none' => esc_html__( 'None', 'edupress' ) );

	// Pages
	$type_terms = get_pages( array( 'sort_order' => 'asc' ) );
	if ( ! empty( $type_terms ) ) {

		$type_names = wp_list_pluck( $type_terms, 'post_title', 'ID' );
		$choices = $choices + $type_names;

	}

	return apply_filters( 'edupress_get_pages', $choices );
}
endif;

if ( ! function_exists( 'edupress_sanitize_pages' ) ) :
/**
 * Sanitize a value from a list of allowed values.
 *
 * @since 1.0.0.
 *
 * @param  mixed    $value      The value to sanitize.
 * @return mixed                The sanitized value.
 */
function edupress_sanitize_pages( $value ) {

	$choices = edupress_get_pages();
	$valid	 = array_keys( $choices );

	if ( ! in_array( $value, $valid ) ) {
		$value = 'none';
	}

	return $value;
}
endif;

if ( ! function_exists( 'edupress_sanitize_checkbox' ) ) :
/**
 * Sanitize the checkbox.
 *
 * @param  mixed 	$input.
 * @return boolean	(true|false).
 */
function edupress_sanitize_checkbox( $input ) {
	if ( 1 == $input ) {
		return true;
	} else {
		return false;
	}
}
endif;

if ( ! function_exists( 'edupress_sanitize_widget_num' ) ) :
/**
 * Sanitize the Featured Category posts number.
 *
 * @param  boolean	$input.
 * @return boolean	(true|false).
 */
function edupress_sanitize_widget_num( $input ) {
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
function edupress_customize_preview_js() {
	wp_enqueue_script( 'edupress_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20160513', true );
}
add_action( 'customize_preview_init', 'edupress_customize_preview_js' );

/**
 * Registers color schemes for EduPress.
 *
 * Can be filtered with {@see 'edupress_color_schemes'}.
 *
 * The order of colors in a colors array:
 * 1. Main Background Color.
 * 2. Page Background Color.
 * 3. Link Color.
 * 4. Main Text Color.
 * 5. Secondary Text Color.
 *
 * @since EduPress 1.0
 *
 * @return array An associative array of color scheme options.
 */
function edupress_get_color_schemes() {
	/**
	 * Filter the color schemes registered for use with EduPress.
	 *
	 * The default schemes include 'default', 'dark', 'gray', 'red', and 'yellow'.
	 *
	 * @since EduPress 1.0
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
	 
	return apply_filters( 'edupress_color_schemes', array(
		'default' => array(
			'label'  => __( 'Default', 'edupress' ),
			'colors' => array(
				'#f2f0ed', // [0] background color 
				'#ffffff', // [1] content container background color
				'#042351', // [2] header background color 
				'#1e74a9', // [3] link color
				'#c70000', // [4] link :hover color
				'#383838', // [5] main text color
				'#999999', // [6] secondary text color
				'#042351', // [7] footer background color
				'#c70000', // [8] main menu background color
				'#c70000', // [9] highlight background color
				'#c70000', // [10] secondary menu background color
				'#2f2f2f', // [11] widget title background color
				'#c70000', // [12] menu widget title background color
			),
		),
	) );
}

if ( ! function_exists( 'edupress_get_color_scheme' ) ) :
/**
 * Retrieves the current EduPress color scheme.
 *
 * Create your own edupress_get_color_scheme() function to override in a child theme.
 *
 * @since EduPress 1.0
 *
 * @return array An associative array of either the current or default color scheme HEX values.
 */
function edupress_get_color_scheme() {
	$color_scheme_option = get_theme_mod( 'color_scheme', 'default' );
	$color_schemes       = edupress_get_color_schemes();

	if ( array_key_exists( $color_scheme_option, $color_schemes ) ) {
		return $color_schemes[ $color_scheme_option ]['colors'];
	}

	return $color_schemes['default']['colors'];
}
endif; // edupress_get_color_scheme

/**
 * Enqueues front-end CSS for the page background color.
 *
 * @since EduPress 1.0
 *
 * @see wp_add_inline_style()
 */
function edupress_page_background_color_css() {
	$color_scheme          = edupress_get_color_scheme();
	$default_color         = $color_scheme[1];
	$page_background_color = get_theme_mod( 'page_background_color', $default_color );

	// Don't do anything if the current color is the default.
	if ( $page_background_color === $default_color ) {
		return;
	}

	$css = '
		/* Custom Page Background Color */
		.wrapper-main {
			background-color: %1$s;
		}
	';

	wp_add_inline_style( 'edupress-style', sprintf( $css, esc_attr( $page_background_color ) ) );
}
add_action( 'wp_enqueue_scripts', 'edupress_page_background_color_css', 11 );

/**
 * Enqueues front-end CSS for the header background color.
 *
 * @since EduPress 1.0
 *
 * @see wp_add_inline_style()
 */
function edupress_header_background_color_css() {
	$color_scheme          = edupress_get_color_scheme();
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
		}
	';

	wp_add_inline_style( 'edupress-style', sprintf( $css, esc_attr( $header_background_color ) ) );
}
add_action( 'wp_enqueue_scripts', 'edupress_header_background_color_css', 11 );

/**
 * Enqueues front-end CSS for the footer background color.
 *
 * @since EduPress 1.0
 *
 * @see wp_add_inline_style()
 */
function edupress_footer_background_color_css() {
	$color_scheme          = edupress_get_color_scheme();
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
		}
	';

	wp_add_inline_style( 'edupress-style', sprintf( $css, esc_attr( $footer_background_color ) ) );
}
add_action( 'wp_enqueue_scripts', 'edupress_footer_background_color_css', 11 );

/**
 * Enqueues front-end CSS for the Header border color.
 *
 * @since EduPress 1.0
 *
 * @see wp_add_inline_style()
 */
function edupress_header_bordercolor_css() {
	$color_scheme          = edupress_get_color_scheme();
	$default_color         = $color_scheme[8];
	$header_border_color = get_theme_mod( 'header_background_bordercolor', $default_color );

	// Don't do anything if the current color is the default.
	if ( $header_border_color === $default_color ) {
		return;
	}

	$css = '
		/* Custom Footer Border Color */
		.site-header {
			border-color: %1$s;
		}
	';

	wp_add_inline_style( 'edupress-style', sprintf( $css, esc_attr( $header_border_color ) ) );
}
add_action( 'wp_enqueue_scripts', 'edupress_header_bordercolor_css', 11 );

/**
 * Enqueues front-end CSS for the Footer border color.
 *
 * @since EduPress 1.0
 *
 * @see wp_add_inline_style()
 */
function edupress_footer_bordercolor_css() {
	$color_scheme          = edupress_get_color_scheme();
	$default_color         = $color_scheme[10];
	$footer_border_color = get_theme_mod( 'footer_background_bordercolor', $default_color );

	// Don't do anything if the current color is the default.
	if ( $footer_border_color === $default_color ) {
		return;
	}

	$css = '
		/* Custom Footer Border Color */
		.site-footer {
			border-color: %1$s;
		}
	';

	wp_add_inline_style( 'edupress-style', sprintf( $css, esc_attr( $footer_border_color ) ) );
}
add_action( 'wp_enqueue_scripts', 'edupress_footer_bordercolor_css', 11 );

/**
 * Enqueues front-end CSS for the Secondary Menu background color.
 *
 * @since EduPress 1.0
 *
 * @see wp_add_inline_style()
 */
function edupress_secondary_menu_background_color_css() {
	$color_scheme          = edupress_get_color_scheme();
	$default_color         = $color_scheme[10];
	$secmenu_background_color = get_theme_mod( 'secondary_menu_background_color', $default_color );

	// Don't do anything if the current color is the default.
	if ( $secmenu_background_color === $default_color ) {
		return;
	}

	$css = '
		/* Custom Secondary Menu Background Color */
		#site-header-navigation-secondary {
			background-color: %1$s;
		}
	';

	wp_add_inline_style( 'edupress-style', sprintf( $css, esc_attr( $secmenu_background_color ) ) );
}
add_action( 'wp_enqueue_scripts', 'edupress_secondary_menu_background_color_css', 11 );

/**
 * Enqueues front-end CSS for the Highlights background color.
 *
 * @since EduPress 1.0
 *
 * @see wp_add_inline_style()
 */
function edupress_highlight_background_color_css() {
	$color_scheme          = edupress_get_color_scheme();
	$default_color         = $color_scheme[9];
	$highlight_background_color = get_theme_mod( 'highlight_background_color', $default_color );

	// Don't do anything if the current color is the default.
	if ( $highlight_background_color === $default_color ) {
		return;
	}

	$css = '
		/* Custom Highlight Background Color */
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
		}
	';

	wp_add_inline_style( 'edupress-style', sprintf( $css, esc_attr( $highlight_background_color ) ) );
}
add_action( 'wp_enqueue_scripts', 'edupress_highlight_background_color_css', 11 );

/**
 * Enqueues front-end CSS for the link color.
 *
 * @since EduPress 1.0
 *
 * @see wp_add_inline_style()
 */
function edupress_link_color_css() {
	$color_scheme    = edupress_get_color_scheme();
	$default_color   = $color_scheme[2];
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
		}
	';

	wp_add_inline_style( 'edupress-style', sprintf( $css, esc_attr( $link_color ) ) );
}
add_action( 'wp_enqueue_scripts', 'edupress_link_color_css', 11 );

/**
 * Enqueues front-end CSS for the link :hover color.
 *
 * @since EduPress 1.0
 *
 * @see wp_add_inline_style()
 */
function edupress_link_color_hover_css() {
	$color_scheme    = edupress_get_color_scheme();
	$default_color   = $color_scheme[3];
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
		}
	';

	wp_add_inline_style( 'edupress-style', sprintf( $css, esc_attr( $link_color ) ) );
}
add_action( 'wp_enqueue_scripts', 'edupress_link_color_hover_css', 11 );

/**
 * Enqueues front-end CSS for the main text color.
 *
 * @since EduPress 1.0
 *
 * @see wp_add_inline_style()
 */
function edupress_main_text_color_css() {
	$color_scheme    = edupress_get_color_scheme();
	$default_color   = $color_scheme[4];
	$main_text_color = get_theme_mod( 'main_text_color', $default_color );

	// Don't do anything if the current color is the default.
	if ( $main_text_color === $default_color ) {
		return;
	}

	$css = '
		/* Custom Main Text Color */
		body {
			color: %1$s
		}
	';

	wp_add_inline_style( 'edupress-style', sprintf( $css, esc_attr( $main_text_color ) ) );
}
add_action( 'wp_enqueue_scripts', 'edupress_main_text_color_css', 11 );

/**
 * Enqueues front-end CSS for the secondary text color.
 *
 * @since EduPress 1.0
 *
 * @see wp_add_inline_style()
 */
function edupress_secondary_text_color_css() {
	$color_scheme    = edupress_get_color_scheme();
	$default_color   = $color_scheme[4];
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

		.post-meta,
		.ilovewp-post .post-meta {
			color: %1$s;
		}
	';

	wp_add_inline_style( 'edupress-style', sprintf( $css, esc_attr( $secondary_text_color ) ) );
}
add_action( 'wp_enqueue_scripts', 'edupress_secondary_text_color_css', 11 );

/**
 * Enqueues front-end CSS for the Widget Title background color.
 *
 * @since EduPress 1.0
 *
 * @see wp_add_inline_style()
 */
function edupress_widget_title_background_color_css() {
	$color_scheme          = edupress_get_color_scheme();
	$default_color         = $color_scheme[11];
	$widget_background_color = get_theme_mod( 'std_widget_title_background_color', $default_color );

	// Don't do anything if the current color is the default.
	if ( $widget_background_color === $default_color ) {
		return;
	}

	$css = '
		/* Custom Widget Title Background Color */
		#site-main .widget-title, 
		.comments-area .comments-title {
			background-color: %1$s;
		}
	';

	wp_add_inline_style( 'edupress-style', sprintf( $css, esc_attr( $widget_background_color ) ) );
}
add_action( 'wp_enqueue_scripts', 'edupress_widget_title_background_color_css', 11 );

/**
 * Enqueues front-end CSS for the Menu Widget Title background color.
 *
 * @since EduPress 1.0
 *
 * @see wp_add_inline_style()
 */
function edupress_menu_widget_title_background_color_css() {
	$color_scheme          = edupress_get_color_scheme();
	$default_color         = $color_scheme[12];
	$widget_background_color = get_theme_mod( 'menu_widget_title_background_color', $default_color );

	// Don't do anything if the current color is the default.
	if ( $widget_background_color === $default_color ) {
		return;
	}

	$css = '
		/* Custom Menu Widget Title Background Color */
		#site-aside .widget_nav_menu .widget-title {
			background-color: %1$s;
		}
	';

	wp_add_inline_style( 'edupress-style', sprintf( $css, esc_attr( $widget_background_color ) ) );
}
add_action( 'wp_enqueue_scripts', 'edupress_menu_widget_title_background_color_css', 11 );