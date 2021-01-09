<?php
/**
 * gurukul-education: Customizer
 *
 * @subpackage gurukul-education
 * @since 1.0
 */

function gurukul_education_customize_register( $wp_customize ) {

	$wp_customize->add_setting('gurukul_education_show_site_title',array(
       'default' => true,
       'sanitize_callback'	=> 'gurukul_education_sanitize_checkbox'
    ));
    $wp_customize->add_control('gurukul_education_show_site_title',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide Site Title','gurukul-education'),
       'section' => 'title_tagline'
    ));

    $wp_customize->add_setting('gurukul_education_show_tagline',array(
       'default' => true,
       'sanitize_callback'	=> 'gurukul_education_sanitize_checkbox'
    ));
    $wp_customize->add_control('gurukul_education_show_tagline',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide Site Tagline','gurukul-education'),
       'section' => 'title_tagline'
    ));

	$wp_customize->add_panel( 'gurukul_education_panel_id', array(
	    'priority' => 10,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Theme Settings', 'gurukul-education' ),
	    'description' => __( 'Description of what this panel does.', 'gurukul-education' ),
	) );

	$wp_customize->add_section( 'gurukul_education_theme_options_section', array(
    	'title'      => __( 'General Settings', 'gurukul-education' ),
		'priority'   => 30,
		'panel' => 'gurukul_education_panel_id'
	) );

	// Add Settings and Controls for Layout
	$wp_customize->add_setting('gurukul_education_theme_options',array(
        'default' => 'Right Sidebar',
        'sanitize_callback' => 'gurukul_education_sanitize_choices'	        
	));
	$wp_customize->add_control('gurukul_education_theme_options', array(
        'type' => 'radio',
        'label' => __('Do you want this section','gurukul-education'),
        'section' => 'gurukul_education_theme_options_section',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','gurukul-education'),
            'Right Sidebar' => __('Right Sidebar','gurukul-education'),
            'One Column' => __('One Column','gurukul-education'),
            'Three Columns' => __('Three Columns','gurukul-education'),
            'Four Columns' => __('Four Columns','gurukul-education'),
            'Grid Layout' => __('Grid Layout','gurukul-education')
    	),
	));

	// Contact Details
	$wp_customize->add_section( 'gurukul_education_contact_details', array(
    	'title'      => __( 'Contact Details', 'gurukul-education' ),
		'priority'   => 30,
		'panel' => 'gurukul_education_panel_id'
	) );

	$wp_customize->add_setting('gurukul_education_facebook',array(
		'default'=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('gurukul_education_facebook',array(
		'label'	=> __('Add Facebook Link','gurukul-education'),
		'section'=> 'gurukul_education_contact_details',
		'setting'=> 'gurukul_education_facebook',
		'type'=> 'url'
	));

	$wp_customize->add_setting('gurukul_education_twitter',array(
		'default'=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('gurukul_education_twitter',array(
		'label'	=> __('Add Twitter Link','gurukul-education'),
		'section'=> 'gurukul_education_contact_details',
		'setting'=> 'gurukul_education_twitter',
		'type'=> 'url'
	));

	$wp_customize->add_setting('gurukul_education_instagram',array(
		'default'=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('gurukul_education_instagram',array(
		'label'	=> __('Add Instagram Link','gurukul-education'),
		'section'=> 'gurukul_education_contact_details',
		'setting'=> 'gurukul_education_instagram',
		'type'=> 'url'
	));

	$wp_customize->add_setting('gurukul_education_linkdin',array(
		'default'=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('gurukul_education_linkdin',array(
		'label'	=> __('Add Linkedin Link','gurukul-education'),
		'section'=> 'gurukul_education_contact_details',
		'setting'=> 'gurukul_education_linkdin',
		'type'=> 'url'
	));	

	$wp_customize->add_setting('gurukul_education_mail',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('gurukul_education_mail',array(
		'label'	=> __('Email Text','gurukul-education'),
		'section'=> 'gurukul_education_contact_details',
		'setting'=> 'gurukul_education_mail',
		'type'=> 'text'
	));	

	$wp_customize->add_setting('gurukul_education_mail1',array(
		'default'=> '',
		'sanitize_callback'	=> 'gurukul_education_sanitize_email'
	));
	$wp_customize->add_control('gurukul_education_mail1',array(
		'label'	=> __('Email Address','gurukul-education'),
		'section'=> 'gurukul_education_contact_details',
		'setting'=> 'gurukul_education_mail1',
		'type'=> 'text'
	));	

	$wp_customize->add_setting('gurukul_education_call',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('gurukul_education_call',array(
		'label'	=> __('Call Text','gurukul-education'),
		'section'=> 'gurukul_education_contact_details',
		'setting'=> 'gurukul_education_call',
		'type'=> 'text'
	));	

	$wp_customize->add_setting('gurukul_education_call1',array(
		'default'=> '',
		'sanitize_callback'	=> 'gurukul_education_sanitize_phone_number'
	));
	$wp_customize->add_control('gurukul_education_call1',array(
		'label'	=> __('Phone Number','gurukul-education'),
		'section'=> 'gurukul_education_contact_details',
		'setting'=> 'gurukul_education_call1',
		'type'=> 'text'
	));	

	//home page slider
	$wp_customize->add_section( 'gurukul_education_slider_section' , array(
    	'title'      => __( 'Slider Settings', 'gurukul-education' ),
		'priority'   => null,
		'panel' => 'gurukul_education_panel_id'
	) );

	for ( $count = 1; $count <= 4; $count++ ) {
		$wp_customize->add_setting( 'gurukul_education_slider' . $count, array(
			'default'           => '',
			'sanitize_callback' => 'gurukul_education_sanitize_dropdown_pages'
		) );
		$wp_customize->add_control( 'gurukul_education_slider' . $count, array(
			'label'    => __( 'Select Slide Image Page', 'gurukul-education' ),
			'section'  => 'gurukul_education_slider_section',
			'type'     => 'dropdown-pages'
		) );
	}

	//OUR services
	$wp_customize->add_section('gurukul_education_our_services',array(
		'title'	=> __('Our Services','gurukul-education'),
		'description'=> __('This section will appear below the slider.','gurukul-education'),
		'panel' => 'gurukul_education_panel_id',
	));	

	$wp_customize->add_setting('gurukul_education_section_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('gurukul_education_section_title',array(
		'label'	=> __('Section Title','gurukul-education'),
		'section'=> 'gurukul_education_our_services',
		'setting'=> 'gurukul_education_section_title',
		'type'=> 'text'
	));

	$wp_customize->add_setting('gurukul_education_section_subtitle',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('gurukul_education_section_subtitle',array(
		'label'	=> __('Section Sub Title','gurukul-education'),
		'section'=> 'gurukul_education_our_services',
		'setting'=> 'gurukul_education_section_subtitle',
		'type'=> 'text'
	));	

	for ( $count = 0; $count <= 2; $count++ ) {
		$wp_customize->add_setting( 'gurukul_education_services' . $count, array(
			'default'           => '',
			'sanitize_callback' => 'gurukul_education_sanitize_dropdown_pages'
		));
		$wp_customize->add_control( 'gurukul_education_services' . $count, array(
			'label'    => __( 'Select Service Page', 'gurukul-education' ),
			'section'  => 'gurukul_education_our_services',
			'type'     => 'dropdown-pages'
		));
	}

	//Footer
    $wp_customize->add_section( 'gurukul_education_footer', array(
    	'title'      => __( 'Footer Text', 'gurukul-education' ),
		'priority'   => null,
		'panel' => 'gurukul_education_panel_id'
	) );

    $wp_customize->add_setting('gurukul_education_footer_copy',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('gurukul_education_footer_copy',array(
		'label'	=> __('Footer Text','gurukul-education'),
		'section'	=> 'gurukul_education_footer',
		'setting'	=> 'gurukul_education_footer_copy',
		'type'		=> 'text'
	));

	$wp_customize->get_setting( 'blogname' )->transport          = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport   = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport  = 'postMessage';

	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector' => '.site-title a',
		'render_callback' => 'gurukul_education_customize_partial_blogname',
	) );
	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector' => '.site-description',
		'render_callback' => 'gurukul_education_customize_partial_blogdescription',
	) );

	//front page
	$num_sections = apply_filters( 'gurukul_education_front_page_sections', 4 );

	// Create a setting and control for each of the sections available in the theme.
	for ( $i = 1; $i < ( 1 + $num_sections ); $i++ ) {
		$wp_customize->add_setting( 'panel_' . $i, array(
			'default'           => false,
			'sanitize_callback' => 'gurukul_education_sanitize_dropdown_pages',
			'transport'         => 'postMessage',
		) );

		$wp_customize->add_control( 'panel_' . $i, array(
			/* translators: %d is the front page section number */
			'label'          => sprintf( __( 'Front Page Section %d Content', 'gurukul-education' ), $i ),
			'description'    => ( 1 !== $i ? '' : __( 'Select pages to feature in each area from the dropdowns. Add an image to a section by setting a featured image in the page editor. Empty sections will not be displayed.', 'gurukul-education' ) ),
			'section'        => 'theme_options',
			'type'           => 'dropdown-pages',
			'allow_addition' => true,
			'active_callback' => 'gurukul_education_is_static_front_page',
		) );

		$wp_customize->selective_refresh->add_partial( 'panel_' . $i, array(
			'selector'            => '#panel' . $i,
			'render_callback'     => 'gurukul_education_front_page_section',
			'container_inclusive' => true,
		) );
	}
}
add_action( 'customize_register', 'gurukul_education_customize_register' );

function gurukul_education_sanitize_colorscheme( $input ) {
	$valid = array( 'light', 'dark', 'custom' );

	if ( in_array( $input, $valid, true ) ) {
		return $input;
	}

	return 'light';
}

function gurukul_education_customize_partial_blogname() {
	bloginfo( 'name' );
}

function gurukul_education_customize_partial_blogdescription() {
	bloginfo( 'description' );
}


function gurukul_education_is_static_front_page() {
	return ( is_front_page() && ! is_home() );
}

function gurukul_education_is_view_with_layout_option() {
	// This option is available on all pages. It's also available on archives when there isn't a sidebar.
	return ( is_page() || ( is_archive() && ! is_active_sidebar( 'sidebar-1' ) ) );
}

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Gurukul_Education_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		load_template( trailingslashit( get_template_directory() ) . '/inc/section-pro.php' );

		// Register custom section types.
		$manager->register_section_type( 'Gurukul_Education_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new Gurukul_Education_Customize_Section_Pro(
				$manager,
				'gurukul_education_example_1',
				array(
					'priority' => 9,
					'title'    => esc_html__( 'Education Pro Theme', 'gurukul-education' ),
					'pro_text' => esc_html__( 'Upgrade Pro',         'gurukul-education' ),
					'pro_url'  => esc_url( 'https://www.luzuk.com/product/premium-gurukul-education-wordpress-theme/' ),
				)
			)
		);
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'gurukul-education-customize-controls', trailingslashit( get_template_directory_uri() ) . '/assets/js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'gurukul-education-customize-controls', trailingslashit( get_template_directory_uri() ) . '/assets/css/customize-controls.css' );
	}
}

// Doing this customizer thang!
Gurukul_Education_Customize::get_instance();