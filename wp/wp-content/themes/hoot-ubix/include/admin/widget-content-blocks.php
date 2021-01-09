<?php
/**
 * Content Blocks Widget
 *
 * @package    Hoot
 * @subpackage Hoot Ubix
 */

/**
* Class Hootubix_Content_Blocks_Widget
*/
class Hootubix_Content_Blocks_Widget extends HybridExtend_WP_Widget {

	function __construct() {

		$settings['id'] = 'hootubix-content-blocks-widget';
		$settings['name'] = __( 'Hoot > Content Blocks (Pages)', 'hoot-ubix' );
		$settings['widget_options'] = array(
			'description'	=> __('Display Styled Content Blocks.', 'hoot-ubix'),
			// 'classname'		=> 'hootubix-content-blocks-widget', // CSS class applied to frontend widget container via 'before_widget' arg
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
				'name'		=> __( 'Blocks Style', 'hoot-ubix' ),
				'id'		=> 'style',
				'type'		=> 'images',
				'std'		=> 'style1',
				'options'	=> array(
					'style1'	=> HYBRIDEXTEND_INCURI . 'admin/images/content-block-style-1.png',
					'style2'	=> HYBRIDEXTEND_INCURI . 'admin/images/content-block-style-2.png',
					'style3'	=> HYBRIDEXTEND_INCURI . 'admin/images/content-block-style-3.png',
					'style4'	=> HYBRIDEXTEND_INCURI . 'admin/images/content-block-style-4.png',
				),
			),
			array(
				'name'		=> __( 'No. Of Columns', 'hoot-ubix' ),
				'id'		=> 'columns',
				'type'		=> 'select',
				'std'		=> '4',
				'options'	=> array(
					'1'	=> __( '1', 'hoot-ubix' ),
					'2'	=> __( '2', 'hoot-ubix' ),
					'3'	=> __( '3', 'hoot-ubix' ),
					'4'	=> __( '4', 'hoot-ubix' ),
					'5'	=> __( '5', 'hoot-ubix' ),
				),
			),
			array(
				'name'		=> __( 'Border', 'hoot-ubix' ),
				'desc'		=> __( 'Top and bottom borders.', 'hoot-ubix' ),
				'id'		=> 'border',
				'type'		=> 'select',
				'std'		=> 'none none',
				'options'	=> array(
					'line line'		=> __( 'Top - Line || Bottom - Line', 'hoot-ubix' ),
					'line shadow'	=> __( 'Top - Line || Bottom - DoubleLine', 'hoot-ubix' ),
					'line none'		=> __( 'Top - Line || Bottom - None', 'hoot-ubix' ),
					'shadow line'	=> __( 'Top - DoubleLine || Bottom - Line', 'hoot-ubix' ),
					'shadow shadow'	=> __( 'Top - DoubleLine || Bottom - DoubleLine', 'hoot-ubix' ),
					'shadow none'	=> __( 'Top - DoubleLine || Bottom - None', 'hoot-ubix' ),
					'none line'		=> __( 'Top - None || Bottom - Line', 'hoot-ubix' ),
					'none shadow'	=> __( 'Top - None || Bottom - DoubleLine', 'hoot-ubix' ),
					'none none'		=> __( 'Top - None || Bottom - None', 'hoot-ubix' ),
				),
			),
			array(
				'name'		=> __( 'Content Boxes', 'hoot-ubix' ),
				'id'		=> 'boxes',
				'type'		=> 'group',
				'options'	=> array(
					'item_name'	=> __( 'Content Box', 'hoot-ubix' ),
				),
				'fields'	=> array(
					array(
						'name'		=> __( 'Title/Content/Image', 'hoot-ubix' ),
						'desc'		=> __( 'Page Title, Content and Featured Image will be used.', 'hoot-ubix' ),
						'id'		=> 'page',
						'type'		=> 'select',
						'options'	=> HybridExtend_WP_Widget::get_wp_list('page'),
					),
					array(
						'name'		=> __( 'Sub Heading (optional)', 'hoot-ubix' ),
						'id'		=> 'subtitle',
						'type'		=> 'text',
					),
					array(
						'name'		=> __( 'Content', 'hoot-ubix' ),
						'id'		=> 'excerpt',
						'type'		=> 'select',
						'std'		=> 'excerpt',
						'options'	=> array(
							'excerpt'	=> __( 'Display Excerpt', 'hoot-ubix' ),
							'content'	=> __( 'Display Full Content', 'hoot-ubix' ),
							'none'		=> __( 'None', 'hoot-ubix' ),
						),
					),
					array(
						'name'		=> __( 'Custom Excerpt Length', 'hoot-ubix' ),
						'desc'		=> __( 'Select \'Display Excerpt\' in option above. Leave empty for default excerpt length.', 'hoot-ubix' ),
						'id'		=> 'excerptlength',
						'type'		=> 'text',
						'settings'	=> array( 'size' => 3, ),
						'sanitize'	=> 'absint',
					),
					array(
						'name'		=> __('Link Text (optional)', 'hoot-ubix'),
						'id'		=> 'link',
						'type'		=> 'text'),
					array(
						'name'		=> __('Link URL', 'hoot-ubix'),
						'id'		=> 'url',
						'type'		=> 'text',
						'sanitize'	=> 'url'),
					array(
						'name'		=> __('Icon', 'hoot-ubix'),
						'desc'		=> __( 'Use an icon instead of featured image of the page selected above.', 'hoot-ubix' ),
						'id'		=> 'icon',
						'type'		=> 'icon',
					),
					array(
						'name'		=> __( 'Icon Style', 'hoot-ubix' ),
						'id'		=> 'icon_style',
						'type'		=> 'select',
						'std'		=> 'circle',
						'options'	=> array(
							'none'		=> __( 'None', 'hoot-ubix' ),
							'circle'	=> __( 'Circle', 'hoot-ubix' ),
							'square'	=> __( 'Square', 'hoot-ubix' ),
						),
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

		$settings = apply_filters( 'hootubix_content_blocks_widget_settings', $settings );

		parent::__construct( $settings['id'], $settings['name'], $settings['widget_options'], $settings['control_options'], $settings['form_options'] );

	}

	/**
	 * Echo the widget content
	 */
	function display_widget( $instance, $before_title = '', $title='', $after_title = '' ) {
		extract( $instance, EXTR_SKIP );
		include( hybridextend_locate_widget( 'content-blocks' ) ); // Loads the widget/content-blocks or template-parts/widget-content-blocks.php template.
	}

}

/**
 * Register Widget
 */
function hootubix_content_blocks_widget_register(){
	register_widget('Hootubix_Content_Blocks_Widget');
}
add_action('widgets_init', 'hootubix_content_blocks_widget_register');