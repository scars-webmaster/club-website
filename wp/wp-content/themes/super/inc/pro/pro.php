<?php if( ! defined( 'ABSPATH' ) ) exit;
/**
 * Pro
 */

if ( class_exists( 'WP_Customize_control' ) ) {

	class customize_Info_Text extends Wp_Customize_Control {
		
		public function render_content(){ ?>
    	    <span class="customize-control-title">
    			<?php echo esc_html( $this->label ); ?>
    		</span>
    
    		<?php if( $this->description ){ ?>
    			<span class="description customize-control-description">
    			<?php echo wp_kses_post($this->description); ?>
    			</span>
    		<?php }
        }
	}
}

if( class_exists( 'WP_Customize_Section' ) ) :


class customize_Customize_Section_Pro extends WP_Customize_Section {


	public $type = 'pro-section';
	public $pro_text = '';
	public $pro_url = '';


	public function json() {
		$json = parent::json();

		$json['pro_text'] = $this->pro_text;
		$json['pro_url']  = esc_url( $this->pro_url );

		return $json;
	}


	protected function render_template() { ?>
		<li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">
			<h3 class="accordion-section-title">
				{{ data.title }}
				<# if ( data.pro_text && data.pro_url ) { #>
					<a href="{{ data.pro_url }}" class="button button-secondary alignright" target="_blank">{{ data.pro_text }}</a>
				<# } #>
			</h3>
		</li>
	<?php }
}
endif;

add_action( 'customize_register', 'super_page_sections_pro' );
function super_page_sections_pro( $manager ) {
	// Register custom section types.
	$manager->register_section_type( 'customize_Customize_Section_Pro' );

	// Register sections.
	$manager->add_section(
		new customize_Customize_Section_Pro(
			$manager,
			'customize_page_view_pro',
			array(
				'title'    => esc_html__( 'PRO Feature', 'super' ),
				'priority' => 1, 
				'pro_text' => esc_html__( 'View PRO Feature', 'super' ),
				'pro_url'  => 'https://seosthemes.com/super-wordpress-theme/'
			)
		)
	);
}

function super_customizer_scripts() {
    wp_enqueue_style( 'best-wp-pro-css',get_template_directory_uri().'/inc/pro/pro.css', '', 'screen' );
    wp_enqueue_script( 'best-wp-pro-js', get_template_directory_uri() . '/inc/pro/pro.js', array( 'jquery' ), '20170404', true );
}
add_action( 'customize_controls_enqueue_scripts', 'super_customizer_scripts' );