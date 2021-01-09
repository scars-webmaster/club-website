<?php
/**
 * Theme Customizer
 *
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function super_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	

/***********************************************************************************
 * Sanitize Functions
***********************************************************************************/
					
		function super_sanitize_checkbox( $input ) {
			if ( $input ) {
				return 1;
			}
			return 0;
		}
/***********************************************************************************/
		
		function super_sanitize_social( $input ) {
			$valid = array(
				'' => esc_attr__( ' ', 'super' ),
				'_self' => esc_attr__( '_self', 'super' ),
				'_blank' => esc_attr__( '_blank', 'super' ),
			);

			if ( array_key_exists( $input, $valid ) ) {
				return $input;
			} else {
				return '';
			}
		}
/********************************************
* Breadcrumb
*********************************************/ 
		
		$wp_customize->add_section( 'super_premium_hide_section' , array(
			'title'       => __( 'Breadcrumb', 'super' ),
			'priority'		=> 70,
		) );
				
		$wp_customize->add_setting( 'super_home_activate_breadcrumb', array (
			'sanitize_callback'	=> 'super_sanitize_checkbox',
		) );
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'super_home_activate_breadcrumb', array(
			'label'    => __( 'Activate Breadcrumb', 'super' ),
			'section'  => 'super_premium_hide_section',
			'settings' => 'super_home_activate_breadcrumb',
			'type'     =>  'checkbox',
		) ) );		

/***********************************************************************************
 * Contacts
***********************************************************************************/
 
		$wp_customize->add_section( 'super_contacts_header' , array(
			'title'       => __( 'Header Contacts', 'super' ),
			'priority'   => 65,
		) );
		
		$wp_customize->add_setting( 'super_contacts_header_phone', array (
			'sanitize_callback' => 'sanitize_text_field',
		) );
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'super_contacts_header_phone', array(
			'label'    => __( 'Phone Number', 'super' ),
		'description' => __('  Add content and activate the phone.', 'super'),        
			
			'section'  => 'super_contacts_header',
			'settings' => 'super_contacts_header_phone',
			'type'     =>  'text'		
		) ) );

		
		$wp_customize->add_setting( 'super_contacts_header_address', array (
			'sanitize_callback' => 'sanitize_text_field',
		) );
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'super_contacts_header_address', array(
			'label'    => __( 'Address', 'super' ),
		'description' => __(' Add content and activate the address.', 'super'),        
			
			'section'  => 'super_contacts_header',
			'settings' => 'super_contacts_header_address',
			'type'     =>  'text'		
		) ) );
		
/***********************************************************************************
 * Social media option
***********************************************************************************/
 
		$wp_customize->add_section( 'super_social_section' , array(
			'title'       => __( 'Social Media', 'super' ),
			'description' => __( 'Social media buttons', 'super' ),
			'priority'   => 64,
		) );
		
		$wp_customize->add_setting( 'social_media_activate_header', array (
			'sanitize_callback' => 'super_sanitize_checkbox',
		) );
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_media_activate_header', array(
			'label'    => __( 'Activate Social Icons in Header:', 'super' ),
			'section'  => 'super_social_section',
			'settings' => 'social_media_activate_header',
			'type' => 'checkbox',
		) ) );
		
		$wp_customize->add_setting( 'social_media_activate', array (
			'sanitize_callback' => 'super_sanitize_checkbox',
		) );
				
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_media_activate', array(
			'label'    => __( 'Activate Social Icons in Footer:', 'super' ),
			'section'  => 'super_social_section',
			'settings' => 'social_media_activate',
			'type' => 'checkbox',
		) ) );
		
		$wp_customize->add_setting( 'super_social_link_type', array (
			'sanitize_callback' => 'super_sanitize_social',
		) );
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'super_social_link_type', array(
			'label'    => __( 'Link Type', 'super' ),
			'section'  => 'super_social_section',
			'settings' => 'super_social_link_type',
			'type'     =>  'select',
            'choices'  => array(
				'' => esc_attr__( ' ', 'super' ),
				'_self' => esc_attr__( '_self', 'super' ),
				'_blank' => esc_attr__( '_blank', 'super' ),
            ),			
		) ) );
		
		$wp_customize->add_setting( 'social_media_color', array (
			'sanitize_callback' => 'sanitize_hex_color',
		) );
				
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'social_media_color', array(
			'label'    => __( 'Social Icons Color:', 'super' ),
			'section'  => 'super_social_section',
			'settings' => 'social_media_color',
		) ) );
				
		$wp_customize->add_setting( 'social_media_hover_color', array (
			'sanitize_callback' => 'sanitize_hex_color',
		) );
				
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'social_media_hover_color', array(
			'label'    => __( 'Social Hover Icons Color:', 'super' ),
			'section'  => 'super_social_section',
			'settings' => 'social_media_hover_color',
		) ) );
		
		$wp_customize->add_setting( 'super_facebook', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'super_facebook', array(
			'label'    => __( 'Enter Facebook url', 'super' ),
			'section'  => 'super_social_section',
			'settings' => 'super_facebook',
		) ) );
	
		$wp_customize->add_setting( 'super_twitter', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'super_twitter', array(
			'label'    => __( 'Enter Twitter url', 'super' ),
			'section'  => 'super_social_section',
			'settings' => 'super_twitter',
		) ) );

		$wp_customize->add_setting( 'super_google', array (
			'sanitize_callback' => 'esc_url_raw',
		) );
		
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'super_google', array(
			'label'    => __( 'Enter Google+ url', 'super' ),
			'section'  => 'super_social_section',
			'settings' => 'super_google',
		) ) );
			
		
/********************************************
* Footer Options
*********************************************/ 

		$wp_customize->add_section( 'footer_options' , array(
			'title'       => __( 'Footer Copyright', 'super' ),
			'priority'		=> 70,
		) );
				
/******************************************** Footer Deactivat *********************************************/ 

		$wp_customize->add_setting( 'super_premium_copyright1', array(
			'default'			=> '',
			'sanitize_callback' => 'wp_kses'
		));
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize, 'super_premium_copyright1', array(
					'label'		=> __( 'Custom Copyright Text', 'super' ),
					'section'	=> 'footer_options',
					'settings'	=> 'super_premium_copyright1',
					'type'		=> 'textarea'
				)
			)
		);			
}
add_action( 'customize_register', 'super_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function super_customize_preview_js() {
	wp_enqueue_script( 'super_customizer', get_template_directory_uri() . '/framework/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'super_customize_preview_js' );


		function super_customize_all_css() {
    ?>
		<style type="text/css">
			<?php if ( (!is_front_page() or !is_home()) and get_theme_mod('custom_header_position') == "home") { ?> .site-header { display: none;} <?php } ?> 
			<?php if ( get_theme_mod('custom_header_position') == "deactivate") { ?> .site-header { display: none;} <?php } ?> 
			<?php if(get_theme_mod('super_aside_background_color')) { ?>#content aside h2 {background:<?php echo esc_attr (get_theme_mod('super_aside_background_color')); ?>;} <?php } ?> 
			<?php if(get_theme_mod('super_aside_background_color1')) { ?>#content aside ul, #content .widget {background:<?php echo esc_attr (get_theme_mod('super_aside_background_color1')); ?>;} <?php } ?> 
			<?php if(get_theme_mod('super_aside_title_color')) { ?>#content aside h2 {color:<?php echo esc_attr (get_theme_mod('super_aside_title_color')); ?>;} <?php } ?> 
			<?php if(get_theme_mod('super_aside_link_color')) { ?>#content aside a {color:<?php echo esc_attr (get_theme_mod('super_aside_link_color')); ?>;} <?php } ?> 
			<?php if(get_theme_mod('super_aside_link_hover_color')) { ?>#content aside a:hover {color:<?php echo esc_attr (get_theme_mod('super_aside_link_hover_color')); ?>;} <?php } ?> 
			
			<?php if(get_theme_mod('social_media_color')) { ?> .social .fa-icons i {color:<?php echo esc_attr (get_theme_mod('social_media_color')); ?> !important;} <?php } ?> 
			<?php if(get_theme_mod('social_media_hover_color')) { ?> .social .fa-icons i:hover {color:<?php echo esc_attr (get_theme_mod('social_media_hover_color')); ?> !important;} <?php } ?>

			<?php if(get_theme_mod('super_titles_setting_1')) { ?> .single-title, .sr-no-sidebar .entry-title, .full-p .entry-title { display: none !important;} <?php } ?>

		</style>
		
    <?php	
}
		add_action('wp_head', 'super_customize_all_css');
		
/**************************************
Sidebar Options
**************************************/


	function super_sidebar_width () {
		if(get_theme_mod('super_sidebar_width')) {
	
	$super_content_width = 96;
	$super_sidebar_width = esc_attr(get_theme_mod('super_sidebar_width'));
	$super_sidebar_sum = $super_content_width - $super_sidebar_width;

	?>
		<style>
			#content aside {width: <?php echo esc_attr(get_theme_mod('super_sidebar_width')); ?>% !important;}
			#content main {width: <?php echo esc_attr($super_sidebar_sum); ?>%  !important;}
		</style>
		
	<?php }
}
	add_action('wp_head','super_sidebar_width');
	

	
/*********************************************************************************************************
* Sidebar Position
**********************************************************************************************************/

	function super_sidebar(){
	$option_sidebar = get_theme_mod( 'super_sidebar_position');		
	if($option_sidebar == '2') { 
			wp_enqueue_style( 'best-wp-seos-right-sidebar', get_template_directory_uri() . '/css/right-sidebar.css');
		}

	$option_sidebar = get_theme_mod( 'super_sidebar_position');			
		if($option_sidebar == '3') { 
			wp_enqueue_style( 'best-wp-seos-no-sidebar', get_template_directory_uri() . '/css/no-sidebar.css');
		}
	}
	add_action( 'wp_enqueue_scripts', 'super_sidebar' );
	
		
		
