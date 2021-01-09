<?php
//about theme info
add_action( 'admin_menu', 'gurukul_education_gettingstarted' );
function gurukul_education_gettingstarted() {    	
	add_theme_page( esc_html__('About Theme', 'gurukul-education'), esc_html__('About Theme', 'gurukul-education'), 'edit_theme_options', 'gurukul_education_guide', 'gurukul_education_mostrar_guide');   
}

// Add a Custom CSS file to WP Admin Area
function gurukul_education_admin_theme_style() {
   wp_enqueue_style('custom-admin-style', get_template_directory_uri() . '/inc/getting-started/getting-started.css');
}
add_action('admin_enqueue_scripts', 'gurukul_education_admin_theme_style');

//guidline for about theme
function gurukul_education_mostrar_guide() { 
	//custom function about theme customizer
	$return = add_query_arg( array()) ;
	$theme = wp_get_theme( 'gurukul-education' );

?>

<div class="wrapper-info">
	<div class="col-left">
		<div class="intro">
			<h3><?php esc_html_e( 'Welcome to Gurukul Education WordPress Theme', 'gurukul-education' ); ?> <span>Version: <?php echo esc_html($theme['Version']);?></span></h3>
		</div>
		<div class="started">
			<hr>
			<div class="free-doc">
				<div class="lz-4">
					<h4><?php esc_html_e( 'Start Customizing', 'gurukul-education' ); ?></h4>
					<ul>
						<span><?php esc_html_e( 'Go to', 'gurukul-education' ); ?> <a target="_blank" href="<?php echo esc_url( admin_url('customize.php') ); ?>"><?php esc_html_e( 'Customizer', 'gurukul-education' ); ?> </a> <?php esc_html_e( 'and start customizing your website', 'gurukul-education' ); ?></span>
					</ul>
				</div>
				<div class="lz-4">
					<h4><?php esc_html_e( 'Support', 'gurukul-education' ); ?></h4>
					<ul>
						<span><?php esc_html_e( 'Send your query to our', 'gurukul-education' ); ?> <a href="<?php echo esc_url( GURUKUL_EDUCATION_SUPPORT ); ?>" target="_blank"> <?php esc_html_e( 'Support', 'gurukul-education' ); ?></a></span>
					</ul>
				</div>
			</div>
			<p><?php esc_html_e( 'LZ Gurukul Education is a Education WordPress theme developed especially for websites that deal with educational web, College, Academy, University, School, Kindergarten, tution classes and coaching classes. This clean Education theme is purely mobile responsive supporting all screen size devices. The theme is so user-friendly and easily customizable that even if you arent a professional developer, you can work on it. You get ample of personalization options to modify the theme into your choice of look and appearance. The theme has an elegant banner thereby allowing you to feature your business in the best manner on the homepage itself. The testimonial section makes it more alluring as it displays the feedback given by people who have visited your WordPress website. Furthermore, the Call to action (CTA) button drives in abundance of clicks giving a boost in lead generation. The Gurukul Education is highly interactive with a number of pages to display stunning meals! The different shortcodes keep you away from indulging in the source code. The social media integration removes the need to have additional social media plugins. The SEO friendly nature of the theme guarantees to bring your site on top of search engines. Built on Bootstrap, using optimized codes, the theme is clean and extremely lightweight.', 'gurukul-education')?></p>
			<hr>			
			<div class="col-left-inner">
				<h3><?php esc_html_e( 'Get started with Free Education Theme', 'gurukul-education' ); ?></h3>
				<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/customizer-image.png" alt="" />
			</div>
		</div>
	</div>
	<div class="col-right">
		<div class="col-left-area">
			<h3><?php esc_html_e('Premium Theme Information', 'gurukul-education'); ?></h3>
			<hr>
		</div>
		<div class="centerbold">
			<a href="<?php echo esc_url( GURUKUL_EDUCATION_LIVE_DEMO ); ?>" target="_blank"><?php esc_html_e('Live Demo', 'gurukul-education'); ?></a>
			<a href="<?php echo esc_url( GURUKUL_EDUCATION_BUY_NOW ); ?>"><?php esc_html_e('Buy Pro', 'gurukul-education'); ?></a>
			<a href="<?php echo esc_url( GURUKUL_EDUCATION_PRO_DOCS ); ?>" target="_blank"><?php esc_html_e('Pro Documentation', 'gurukul-education'); ?></a>
			<hr class="secondhr">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/gurukul.jpg" alt="" />
		</div>
		<h3><?php esc_html_e( 'PREMIUM THEME FEATURES', 'gurukul-education'); ?></h3>
		<div class="lz-6">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/icon01.png" alt="" />
			<h4><?php esc_html_e( 'Banner Slider', 'gurukul-education'); ?></h4>
		</div>
		<div class="lz-6">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/icon02.png" alt="" />
			<h4><?php esc_html_e( 'Theme Options', 'gurukul-education'); ?></h4>
		</div>
		<div class="lz-6">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/icon03.png" alt="" />
			<h4><?php esc_html_e( 'Custom Innerpage Banner', 'gurukul-education'); ?></h4>
		</div>
		<div class="lz-6">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/icon04.png" alt="" />
			<h4><?php esc_html_e( 'Custom Colors and Images', 'gurukul-education'); ?></h4>
		</div>
		<div class="lz-6">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/icon05.png" alt="" />
			<h4><?php esc_html_e( 'Fully Responsive', 'gurukul-education'); ?></h4>
		</div>
		<div class="lz-6">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/icon06.png" alt="" />
			<h4><?php esc_html_e( 'Hide/Show Sections', 'gurukul-education'); ?></h4>
		</div>
		<div class="lz-6">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/icon07.png" alt="" />
			<h4><?php esc_html_e( 'Woocommerce Support', 'gurukul-education'); ?></h4>
		</div>
		<div class="lz-6">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/icon08.png" alt="" />
			<h4><?php esc_html_e( 'Limit to display number of Posts', 'gurukul-education'); ?></h4>
		</div>
		<div class="lz-6">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/icon09.png" alt="" />
			<h4><?php esc_html_e( 'Multiple Page Templates', 'gurukul-education'); ?></h4>
		</div>
		<div class="lz-6">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/icon10.png" alt="" />
			<h4><?php esc_html_e( 'Custom Read More link', 'gurukul-education'); ?></h4>
		</div>
		<div class="lz-6">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/icon11.png" alt="" />
			<h4><?php esc_html_e( 'Code written with WordPress standard', 'gurukul-education'); ?></h4>
		</div>
		<div class="lz-6">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getting-started/images/icon12.png" alt="" />
			<h4><?php esc_html_e( '100% Multi language', 'gurukul-education'); ?></h4>
		</div>
	</div>
</div>
<?php } ?>