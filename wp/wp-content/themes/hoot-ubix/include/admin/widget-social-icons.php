<?php
/**
 * Social Icons Widget
 *
 * @package    Hoot
 * @subpackage Hoot Ubix
 */

/**
* Class Hootubix_Social_Icons_Widget
*/
class Hootubix_Social_Icons_Widget extends HybridExtend_WP_Widget {

	function __construct() {

		$settings['id'] = 'hootubix-social-icons-widget';
		$settings['name'] = __( 'Hoot > Social Icons', 'hoot-ubix' );
		$settings['widget_options'] = array(
			'description'	=> __('Display Social Icons', 'hoot-ubix'),
			// 'classname'		=> 'hootubix-social-icons-widget', // CSS class applied to frontend widget container via 'before_widget' arg
		);
		$settings['control_options'] = array();
		$settings['form_options'] = array(
			//'name' => can be empty or false to hide the name
			array(
				'name'		=> __( "Title (optional)", 'hoot-ubix' ),
				'id'		=> 'title',
				'type'		=> 'text',
			),
			array(
				'name'		=> __( 'Icon Size', 'hoot-ubix' ),
				'id'		=> 'size',
				'type'		=> 'select',
				'std'		=> 'small',
				'options'	=> array(
					'small'		=> __( 'Small', 'hoot-ubix' ),
					'medium'	=> __( 'Medium', 'hoot-ubix' ),
					'large'		=> __( 'Large', 'hoot-ubix' ),
					'huge'		=> __( 'Huge', 'hoot-ubix' ),
				),
			),
			array(
				'name'		=> __( 'Social Icons', 'hoot-ubix' ),
				'id'		=> 'icons',
				'type'		=> 'group',
				'options'	=> array(
					'item_name'	=> __( 'Icon', 'hoot-ubix' ),
				),
				'fields'	=> array(
					array(
						'name'		=> __( 'Social Icon', 'hoot-ubix' ),
						'id'		=> 'icon',
						'type'		=> 'select',
						'options'	=> hybridextend_enum_social_profiles(),
					),
					array(
						'name'		=> __( 'URL (enter username for Skype, email address for Email)', 'hoot-ubix' ),
						'id'		=> 'url',
						'type'		=> 'text',
						'sanitize'	=> 'social_icons_sanitize_url',
					),
				),
			),
			array(
				'name'		=> __( 'Widget CSS', 'hoot-ubix' ),
				'id'		=> 'customcss',
				'type'		=> 'collapse',
				'fields'	=> array(
					array(
						'name'		=> __( 'Custom CSS Class', 'hoot-ubix' ),
						'desc'		=> __( 'Give this widget a custom css classname', 'hoot-ubix' ),
						'id'		=> 'class',
						'type'		=> 'text',
					),
					array(
						'name'		=> __( 'Margin Top', 'hoot-ubix' ),
						'desc'		=> __( '(in pixels) Leave empty to load default margins', 'hoot-ubix' ),
						'id'		=> 'mt',
						'type'		=> 'text',
						'settings'	=> array( 'size' => 3 ),
						'sanitize'	=> 'integer',
					),
					array(
						'name'		=> __( 'Margin Bottom', 'hoot-ubix' ),
						'desc'		=> __( '(in pixels) Leave empty to load default margins', 'hoot-ubix' ),
						'id'		=> 'mb',
						'type'		=> 'text',
						'settings'	=> array( 'size' => 3 ),
						'sanitize'	=> 'integer',
					),
					array(
						'name'		=> __( 'Widget ID', 'hoot-ubix' ),
						'id'		=> 'widgetid',
						'type'		=> '<span class="widgetid" data-baseid="' . $settings['id'] . '">' . __( 'Save this widget to view its ID', 'hoot-ubix' ) . '</span>',
					),
				),
			),
		);

		$settings = apply_filters( 'hootubix_social_icons_widget_settings', $settings );

		parent::__construct( $settings['id'], $settings['name'], $settings['widget_options'], $settings['control_options'], $settings['form_options'] );

	}

	/**
	 * Echo the widget content
	 */
	function display_widget( $instance, $before_title = '', $title='', $after_title = '' ) {
		extract( $instance, EXTR_SKIP );
		include( hybridextend_locate_widget( 'social-icons' ) ); // Loads the widget/social-icons or template-parts/widget-social-icons.php template.
	}

}

/**
 * Register Widget
 */
function hootubix_social_icons_widget_register(){
	register_widget('Hootubix_Social_Icons_Widget');
}
add_action('widgets_init', 'hootubix_social_icons_widget_register');

/**
 * Custom Sanitization Function
 */
function hootubix_social_icons_sanitize_url( $value, $name, $instance ){
	if ( $name == 'social_icons_sanitize_url' ) {
		if ( !empty( $instance['icon'] ) && $instance['icon'] == 'fa-skype' )
			$new = sanitize_user( $value, true );
		elseif ( !empty( $instance['icon'] ) && $instance['icon'] == 'fa-envelope' )
			$new = ( is_email( $value ) ) ? sanitize_email( $value ) : '';
		else
			$new = esc_url_raw( $value );
		return $new;
	}
	return $value;
}
add_filter('widget_admin_sanitize_field', 'hootubix_social_icons_sanitize_url', 10, 3);