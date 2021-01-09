<?php
/**
 * Content Posts Blocks Widget
 *
 * @package    Hoot
 * @subpackage Hoot Ubix
 */

/**
* Class Hootubix_Content_Posts_Blocks_Widget
*/
class Hootubix_Content_Posts_Blocks_Widget extends HybridExtend_WP_Widget {

	function __construct() {

		$settings['id'] = 'hootubix-posts-blocks-widget';
		$settings['name'] = __( 'Hoot > Content Blocks (Posts)', 'hoot-ubix' );
		$settings['widget_options'] = array(
			'description'	=> __('Display Styled Content Blocks.', 'hoot-ubix'),
			// 'classname'		=> 'hootubix-posts-blocks-widget', // CSS class applied to frontend widget container via 'before_widget' arg
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
					// 'style3'	=> HYBRIDEXTEND_INCURI . 'admin/images/content-block-style-3.png',
					'style4'	=> HYBRIDEXTEND_INCURI . 'admin/images/content-block-style-4.png',
				),
			),
			array(
				'name'		=> __( 'Category (Optional)', 'hoot-ubix' ),
				'desc'		=> __( 'Leave empty to display posts from all categories.', 'hoot-ubix' ),
				'id'		=> 'category',
				'type'		=> 'select',
				'options'	=> array( '0' => '' ) + HybridExtend_WP_Widget::get_tax_list('category') ,
			),
			array(
				'name'		=> __( 'No. Of Columns', 'hoot-ubix' ),
				'id'		=> 'columns',
				'type'		=> 'smallselect',
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
				'name'		=> __( 'Number of Posts to show', 'hoot-ubix' ),
				'desc'		=> __( 'Default: 4', 'hoot-ubix' ),
				'id'		=> 'count',
				'type'		=> 'text',
				'settings'	=> array( 'size' => 3, ),
				'sanitize'	=> 'absint',
			),
			array(
				'name'		=> __( 'Offset', 'hoot-ubix' ),
				'desc'		=> __( 'Number of posts to skip from the start. Leave empty to start from the latest post.', 'hoot-ubix' ),
				'id'		=> 'offset',
				'type'		=> 'text',
				'settings'	=> array( 'size' => 3, ),
				'sanitize'	=> 'absint',
			),
			array(
				'name'		=> __( 'Show Author', 'hoot-ubix' ),
				'id'		=> 'show_author',
				'type'		=> 'checkbox',
			),
			array(
				'name'		=> __( 'Show Post Date', 'hoot-ubix' ),
				'id'		=> 'show_date',
				'type'		=> 'checkbox',
			),
			array(
				'name'		=> __( 'Show number of comments', 'hoot-ubix' ),
				'id'		=> 'show_comments',
				'type'		=> 'checkbox',
			),
			array(
				'name'		=> __( 'Show categories', 'hoot-ubix' ),
				'id'		=> 'show_cats',
				'type'		=> 'checkbox',
			),
			array(
				'name'		=> __( 'Show tags', 'hoot-ubix' ),
				'id'		=> 'show_tags',
				'type'		=> 'checkbox',
			),
			array(
				'name'		=> __( 'Content', 'hoot-ubix' ),
				'id'		=> 'fullcontent',
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

		$settings = apply_filters( 'hootubix_content_posts_blocks_widget_settings', $settings );

		parent::__construct( $settings['id'], $settings['name'], $settings['widget_options'], $settings['control_options'], $settings['form_options'] );

	}

	/**
	 * Echo the widget content
	 */
	function display_widget( $instance, $before_title = '', $title='', $after_title = '' ) {
		extract( $instance, EXTR_SKIP );
		include( hybridextend_locate_widget( 'content-posts-blocks' ) ); // Loads the widget/content-posts-blocks or template-parts/widget-content-posts-blocks.php template.
	}

}

/**
 * Register Widget
 */
function hootubix_content_posts_blocks_widget_register(){
	register_widget('Hootubix_Content_Posts_Blocks_Widget');
}
add_action('widgets_init', 'hootubix_content_posts_blocks_widget_register');