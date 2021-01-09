<?php
/**
 * About/Welcome page
 *
 * @package    Hoot
 * @subpackage Hoot Ubix
 */

/** Determine whether to load about subpage **/
if ( ! apply_filters( 'hootubix_load_about_subpage', true ) )
	return;

/* Add the admin setup function to the 'admin_menu' hook. */
add_action( 'admin_menu', 'hootubix_appearance_subpage' );

/**
 * Sets up the Appearance Subpage
 *
 * @since 1.0
 * @access public
 * @return void
 */
function hootubix_appearance_subpage() {

	add_theme_page(
		__( 'Hoot Ubix', 'hoot-ubix' ), // Page Title
		__( 'About Theme Options', 'hoot-ubix' ), // Menu Title
		'edit_theme_options', // capability
		'hoot-ubix-welcome', // menu-slug
		'hootubix_theme_appearance_subpage' // function name
		);

	add_action( 'admin_enqueue_scripts', 'hootubix_admin_enqueue_upsell_styles' );

}

/**
 * Add a welcome notice if not already dismissed
 *
 * @since 1.7
 * @access public
 * @return void
 */
function hootubix_theme_welcome_notice(){
	if ( isset( $_GET['page'] ) && $_GET['page'] == 'hoot-ubix-welcome' )
		return;
	if ( ! get_option( 'hoot-ubix-dismiss-welcome' ) ) {
		add_action( 'admin_notices', 'hootubix_theme_add_welcome_notice' );
	}
}
add_action( 'admin_head', 'hootubix_theme_welcome_notice' );

/**
 * Display admin notice
 *
 * @since 1.7
 * @access public
 * @return void
 */
function hootubix_theme_add_welcome_notice() {
	?>
	<div id="hootubix-welcome-msg" class="notice notice-success is-dismissible">
		<p><?php
			/* Translators: 1 is the link start markup, 2 is link markup end */
			printf( esc_html__( 'Thank you for choosing Hoot Ubix! To get started and fully take advantage of our theme, please make sure you visit the welcome page for the %1$sQuick Start Guide%2$s.', 'hoot-ubix' ), '<a href="' . esc_url( admin_url( 'themes.php?page=hoot-ubix-welcome&tab=qstart' ) ) . '">', '</a>' );
			?></p>
		<p><?php
			/* Translators: 1 is the link start markup, 2 is link markup end */
			printf( esc_html__( '%1$sGet started with Hoot Ubix%2$s', 'hoot-ubix' ), '<a class="button-secondary" href="' . esc_url( admin_url( 'themes.php?page=hoot-ubix-welcome&tab=qstart' ) ) . '">', '</a>' );
			?></p>
	</div>
	<?php
}

/**
 * Ajax callback to set dismissable notice
 *
 * @since 1.7
 * @access public
 * @return void
 */
function hootubix_theme_dismiss_welcome_notice() {
	check_ajax_referer( 'dismiss-hoottheme-welcome', 'nonce' );
	update_option( 'hoot-ubix-dismiss-welcome', 1 );
	wp_die();
}
add_action( 'wp_ajax_hootubix_theme_dismiss_welcome_notice', 'hootubix_theme_dismiss_welcome_notice' );

/**
 * Enqueue CSS
 *
 * @since 1.0
 * @access public
 * @return void
 */
function hootubix_admin_enqueue_upsell_styles( $hook ) {
	if ( $hook == 'appearance_page_hoot-ubix-welcome' )
		wp_enqueue_style( 'hootubix-admin-about', HYBRIDEXTEND_INCURI . 'admin/css/about.css', array(),  HYBRIDEXTEND_VERSION );
	wp_enqueue_script( 'hootubix-admin-about', HYBRIDEXTEND_INCURI . 'admin/js/about.js', array( 'jquery' ),  HYBRIDEXTEND_VERSION, true );
	wp_localize_script( 'hootubix-admin-about', 'hootubix_dismissible_notice', array(
							'ajax_url' => esc_url( admin_url( 'admin-ajax.php' ) ),
							'ajax_action' => 'hootubix_theme_dismiss_welcome_notice',
							'nonce' => wp_create_nonce( 'dismiss-hoottheme-welcome' ),
						) );
}

/**
 * Display the Appearance Subpage
 *
 * @since 1.0
 * @access public
 * @return void
 */
function hootubix_theme_appearance_subpage() {
	$activetab = 'upsell';
	if ( !empty( $_GET['tab'] ) )
		$activetab = ( $_GET['tab'] == 'import' ) ? 'import' : ( ( $_GET['tab'] == 'qstart' ) ? 'qstart' : $activetab );
	?>
	<div class="wrap">

		<h1 class="hootubix-about-title"><?php
			/* Translators: 1 is the theme name, 2 is the theme version */
			printf( esc_html__( 'About %1$s %2$s', 'hoot-ubix' ), HYBRIDEXTEND_THEME_NAME, HYBRIDEXTEND_THEME_VERSION );
			?></h1>

		<div id="hootubix-about-sub" class="hootubix-about-sub">
			<div class="hootubix-about-ss"><img src="<?php echo esc_url( HYBRID_PARENT_URI . 'screenshot.jpg' )  ?>"></div>
			<div class="hootubix-about-text">
				<p class="hootubix-about-intro"><?php esc_html_e( 'Hoot Ubix is a highly flexible, clean, modern and professionally designed theme with lightening fast loading speed built on a SEO friendly framework. Supports popular plugins like WooCommerce, Contact Form 7, Mappress, Newsletter etc.', 'hoot-ubix' ) ?></p>
				<p class="hootubix-about-textlinks">
					<a class="button button-primary" href="https://wphoot.com/themes/hoot-ubix/" target="_blank"><span class="dashicons dashicons-dashboard"></span> <?php esc_html_e( 'View Premium', 'hoot-ubix' ) ?></a>
					<a class="button" href="https://demo.wphoot.com/hoot-ubix/" target="_blank"><span class="dashicons dashicons-welcome-view-site"></span> <?php esc_html_e( 'View Demo', 'hoot-ubix' ) ?></a>
					<a class="button" href="https://wphoot.com/support/hoot-ubix/" target="_blank"><span class="dashicons dashicons-editor-aligncenter"></span> <?php esc_html_e( 'Documentation', 'hoot-ubix' ) ?></a>
					<a class="button" href="https://wphoot.com/support/" target="_blank"><span class="dashicons dashicons-sos"></span> <?php esc_html_e( 'Get Support', 'hoot-ubix' ) ?></a>
					<a class="button" href="https://wordpress.org/support/theme/hoot-ubix/reviews/#new-post" target="_blank"><span class="dashicons dashicons-thumbs-up"></span> <?php esc_html_e( 'Rate Us', 'hoot-ubix' ) ?></a>
				</p>
				<?php do_action( 'hootubix_theme_after_about_textlinks', 'hoot-ubix' ); ?>
				<?php /*
				<div class="hootubix-about-notice2">
					<h3><?php esc_html_e( '1 Click Demo Installation', 'hoot-ubix' ) ?></h3>
					<p><?php
						/* Translators: The %s are placeholders for HTML, so the order can't be changed. *//*
						printf( esc_html__( 'Use the OCDI plugin to install demo content with a single click to make your site look exactly like the %1$sDemo Site%2$s.%3$sNew users often find it easier to edit existing content rather than starting from scratch.', 'hoot-ubix' ), '<a href="https://demo.wphoot.com/hoot-ubix/" target="_blank">', '</a>', '<br />' );
					?></p>
					<p class="hootubix-about-textlinks">
						<a class="button" href="https://wphoot.com/support/hoot-ubix/#docs-section-demo-content-free" target="_blank"><span class="dashicons dashicons-art"></span> <?php esc_html_e( 'Install Demo Content', 'hoot-ubix' ) ?></a>
					</p>
				</div>
				*/ ?>
			</div>
			<div class="clear"></div>
		</div><!-- .hootubix-about-sub -->

		<div class="hootubix-abouttabs">

			<h2 id="nav-tabs" class="nav-tab-wrapper">
				<span class="nav-tab nav-upsell <?php if ( $activetab == 'upsell' ) echo 'nav-tab-active'; ?>" data-tabid="upsell"><?php esc_html_e( 'Premium Options', 'hoot-ubix' ) ?></span>
				<?php do_action( 'hootubix_theme_after_nav_tab_upsell', 'hoot-ubix', $activetab ); ?>
				<span class="nav-tab nav-qstart <?php if ( $activetab == 'qstart' ) echo 'nav-tab-active'; ?>" data-tabid="qstart"><?php esc_html_e( 'Quick Start Guide', 'hoot-ubix' ) ?></span>
			</h2>

			<div id="hootubix-upsell" class="hootubix-upsell hootubix-tab <?php if ( $activetab == 'upsell' ) echo 'hootubix-tab-active'; ?>">
				<h2 class="centered allcaps"><?php
					/* Translators: The %s are placeholders for HTML, so the order can't be changed. */
					printf( esc_html__( 'Upgrade to %1$sHoot Ubix %2$sPremium%3$s%4$s', 'hoot-ubix' ), '<span>', '<strong>', '</strong>', '</span>' );
					?></h2>
				<p class="hootubix-tab-intro centered"><?php
					/* Translators: The %s are placeholders for HTML, so the order can't be changed. */
					printf( esc_html__( 'If you have enjoyed using Hoot Ubix, you are going to love %1$sHoot Ubix Premium%2$s.%3$sIt is a robust upgrade to Hoot Ubix that gives you many useful features.', 'hoot-ubix' ), '<strong>', '</strong>', '<br />' );
					?></p>
				<p class="hootubix-tab-cta centered">
					<a class="button button-secondary secondary-cta" href="https://demo.wphoot.com/hoot-ubix/" target="_blank"><span class="dashicons dashicons-welcome-view-site"></span> <?php esc_html_e( 'View Demo Site', 'hoot-ubix' ) ?></a>
					<a class="button button-primary primary-cta" href="https://wphoot.com/themes/hoot-ubix/" target="_blank"><span class="dashicons dashicons-dashboard"></span> <?php esc_html_e( 'Buy Hoot Ubix Premium', 'hoot-ubix' ) ?></a>
				</p>
				<div class="hootubix-tab-sub"><div class="hootubix-tab-subinner">
					<?php hootubix_theme_tabsections( 'features' ); ?>
					<div class="tabsection hootubix-tab-cta centered">
						<a class="button button-secondary secondary-cta" href="https://demo.wphoot.com/hoot-ubix/" target="_blank"><span class="dashicons dashicons-welcome-view-site"></span> <?php esc_html_e( 'View Demo Site', 'hoot-ubix' ) ?></a>
						<a class="button button-primary primary-cta" href="https://wphoot.com/themes/hoot-ubix/" target="_blank"><span class="dashicons dashicons-dashboard"></span> <?php esc_html_e( 'Buy Hoot Ubix Premium', 'hoot-ubix' ) ?></a>
					</div>
				</div></div><!-- .hootubix-tab-sub -->
			</div><!-- #hootubix-upsell -->

			<?php do_action( 'hootubix_theme_after_hootubix_upsell', 'hoot-ubix', $activetab ); ?>

			<div id="hootubix-qstart" class="hootubix-qstart hootubix-tab <?php if ( $activetab == 'qstart' ) echo 'hootubix-tab-active'; ?>">
				<h2 class="centered allcaps"><span class="dashicons dashicons-clock"></span> <?php esc_html_e( 'Quick Start Guide', 'hoot-ubix' ); ?></h2>
				<p class="hootubix-tab-intro centered"><?php
					/* Translators: The %s are placeholders for HTML, so the order can't be changed. */
					printf( esc_html__( 'Follow these steps to quickly start developing your site.%1$sTo read the full documentation, or to get support from one of our support ninjas, click the buttons below.', 'hoot-ubix' ), '<br />' );
					?></p>
				<p class="hootubix-tab-cta centered">
					<a class="button button-primary primary-cta" href="https://wphoot.com/support/hoot-ubix/" target="_blank"><span class="dashicons dashicons-editor-aligncenter"></span> <?php esc_html_e( 'View Full Documentation', 'hoot-ubix' ) ?></a>
					<a class="button button-secondary secondary-cta" href="https://wphoot.com/support/" target="_blank"><span class="dashicons dashicons-sos"></span> <?php esc_html_e( 'Get Support', 'hoot-ubix' ) ?></a>
				</p>
				<div class="hootubix-tab-sub hootubix-qstart-sub"><div class="hootubix-tab-subinner">
					<?php hootubix_theme_tabsections( 'quickstart' ); ?>
					<div class="tabsection hootubix-tab-cta centered">
						<a class="button button-primary primary-cta" href="https://wphoot.com/support/hoot-ubix/" target="_blank"><span class="dashicons dashicons-editor-aligncenter"></span> <?php esc_html_e( 'View Full Documentation', 'hoot-ubix' ) ?></a>
						<a class="button button-secondary secondary-cta" href="https://wphoot.com/support/" target="_blank"><span class="dashicons dashicons-sos"></span> <?php esc_html_e( 'Get Support', 'hoot-ubix' ) ?></a>
					</div>
				</div></div><!-- .hootubix-tab-sub -->
			</div><!-- #hootubix-qstart -->


		</div><!-- .hootubix-abouttabs -->
		<a class="hootubix-abouttheme-top" href="#hootubix-about-sub"><span class="dashicons dashicons-arrow-up-alt"></span></a>
	</div><!-- .wrap -->
	<?php
}

/**
 * About Page displat Tab's content sections
 *
 * @since 1.7
 * @access public
 * @return mixed
 */
function hootubix_theme_tabsections( $string ) {
	if ( in_array( $string, array( 'features', 'quickstart' ) ) ) :
		$features = hootubix_theme_upstrings( $string );
		if ( !empty( $features ) && is_array( $features ) ) :
			foreach ( $features as $key => $feature ) :
				$style = empty( $feature['style'] ) ? 'std' : $feature['style'];
				?>
				<div class="tabsection <?php
					if ( $style == 'hero-top' || $style == 'hero-bottom' ) echo "tabsection-hero tabsection-{$style}";
					elseif ( $style == 'side' ) echo 'tabsection-sideinfo';
					elseif ( $style == 'aside' ) echo 'tabsection-asideinfo';
					else echo "tabsection-std";
					?>">

					<?php if ( $style == 'hero-top' || $style == 'hero-bottom' ) :
						if ( $style == 'hero-top' ) : ?>
							<h4 class="heading"><?php echo $feature['name']; ?></h4>
							<?php if ( !empty( $feature['desc'] ) ) echo '<div class="tabsection-hero-text">' . $feature['desc'] . '</div>'; ?>
						<?php endif; ?>
						<?php if ( !empty( $feature['img'] ) ) : ?>
							<div class="tabsection-hero-img">
								<img src="<?php echo esc_url( $feature['img'] ); ?>" />
							</div>
						<?php endif; ?>
						<?php if ( $style == 'hero-bottom' ) : ?>
							<h4 class="heading"><?php echo $feature['name']; ?></h4>
							<?php if ( !empty( $feature['desc'] ) ) echo '<div class="tabsection-hero-text">' . $feature['desc'] . '</div>'; ?>
						<?php endif; ?>

					<?php elseif ( $style == 'side' ) : ?>
						<div class="tabsection-side-wrap">
							<div class="tabsection-side-img">
								<img src="<?php echo esc_url( $feature['img'] ); ?>" />
							</div>
							<div class="tabsection-side-textblock">
								<?php if ( !empty( $feature['name'] ) ) : ?>
									<h4 class="heading"><?php echo $feature['name']; ?></h4>
								<?php endif; ?>
								<?php if ( !empty( $feature['desc'] ) ) echo '<div class="tabsection-side-text">' . $feature['desc'] . '</div>'; ?>
							</div>
							<div class="clear"></div>
						</div>

					<?php elseif ( $style == 'aside' ) : ?>
						<?php if ( !empty( $feature['blocks'] ) ) : ?>
							<div class="tabsection-aside-wrap">
							<?php foreach ( $feature['blocks'] as $key => $block ) {
								echo '<div class="tabsection-aside-block tabsection-aside-'.($key+1).'">';
									if ( !empty( $block['img'] ) ) : ?>
										<div class="tabsection-aside-img">
											<img src="<?php echo esc_url( $block['img'] ); ?>" />
										</div>
									<?php endif;
									if ( !empty( $block['name'] ) ) : ?>
										<h4 class="heading"><?php echo $block['name']; ?></h4>
									<?php endif;
									if ( !empty( $block['desc'] ) ) echo '<div class="tabsection-aside-text">' . $block['desc'] . '</div>';
								echo '</div>';
							} ?>
							<div class="clear"></div>
							</div>
						<?php endif; ?>

					<?php else : ?>
						<?php if ( $style != 'img-bottom' && !empty( $feature['img'] ) ) : ?>
							<div class="tabsection-std-img attop">
								<img src="<?php echo esc_url( $feature['img'] ); ?>" />
							</div>
						<?php endif; ?>
						<div class="tabsection-std-textblock <?php if ( $style == 'img-bottom' ) echo 'attop'; else echo 'atbottom'; ?>">
							<?php if ( !empty( $feature['name'] ) ) : ?>
								<div class="tabsection-std-heading"><h4 class="heading"><?php echo $feature['name']; ?></h4></div>
							<?php endif; ?>
							<?php if ( !empty( $feature['desc'] ) ) echo '<div class="tabsection-std-text">' . $feature['desc'] . '</div>'; ?>
							<div class="clear"></div>
						</div>
						<?php if ( $style == 'img-bottom' && !empty( $feature['img'] ) ) : ?>
							<div class="tabsection-std-img atbottom">
								<img src="<?php echo esc_url( $feature['img'] ); ?>" />
							</div>
						<?php endif; ?>
					<?php endif; ?>

				</div><!-- .tabsection -->
				<?php
			endforeach;
		endif;
	endif;
}

/**
 * About Page Strings
 *
 * @since 1.7
 * @access public
 * @return mixed
 */
function hootubix_theme_upstrings( $string ) {

	$features = $quickstart = array();
	$imagepath =  esc_url( HYBRIDEXTEND_INCURI . 'admin/images/' );

	$features[] = array(
		/* Translators: The %s are placeholders for HTML, so the order can't be changed. */
		'name' => sprintf( esc_html__( 'Complete %1$sStyle %2$sCustomization%3$s', 'hoot-ubix' ), '<br />', '<strong>', '</strong>' ),
		'desc' => esc_html__( 'Different looks and styles. Choose from an extensive range of customization features in Hoot Ubix Premium to setup your own unique front page. Give youe site the personality it deserves.', 'hoot-ubix' ),
		// 'img' => $imagepath . 'premium-style.jpg',
		'style' => 'hero-top',
		);

	$features[] = array(
		'name' => esc_html__( 'Custom Colors &amp; Backgrounds for Sections', 'hoot-ubix' ),
		'desc' => esc_html__( 'Hoot Ubix Premium lets you select custom colors and backgrounds for different sections of your site like header, footer, logo background, menu dropdown, content area, page title area etc.', 'hoot-ubix' ),
		'img' => $imagepath . 'premium-colors.jpg',
		);

	$features[] = array(
		/* Translators: The %s are placeholders for HTML, so the order can't be changed. */
		'name' => sprintf( esc_html__( 'Fonts and %1$sTypography Control%2$s', 'hoot-ubix' ), '<span>', '</span>' ),
		'desc' => esc_html__( 'Assign different typography (fonts, text size, font color) to menu, topbar, logo, content headings, sidebar, footer etc.', 'hoot-ubix' ),
		'img' => $imagepath . 'premium-typography.jpg',
		);

	$features[] = array(
		'name' => esc_html__( '600+ Google Fonts', 'hoot-ubix' ),
		'desc' => esc_html__( "With the integrated Google Fonts library, you can find the fonts that match your site's personality, and there's over 600 options to choose from.", 'hoot-ubix' ),
		'img' => $imagepath . 'premium-googlefonts.jpg',
		);

	$features[] = array(
		'name' => esc_html__( 'Unlimites Sliders, Unlimites Slides', 'hoot-ubix' ),
		/* Translators: The %s are placeholders for HTML, so the order can't be changed. */
		'desc' => sprintf( esc_html__( 'Hoot Ubix Premium allows you to create unlimited sliders with as many slides as you need.%1$s%2$sAdd as Shortcodes%3$sYou can use these sliders on your Frontpage, or add them anywhere using shortcodes - like in your Posts, Sidebars or Footer.', 'hoot-ubix' ), '<hr>', '<h4>', '</h4>' ),
		'img' => $imagepath . 'premium-sliders.jpg',
		);

	$features[] = array(
		/* Translators: The %s are placeholders for HTML, so the order can't be changed. */
		'name' => sprintf( esc_html__( 'Shortcodes with %1$sEasy Generator%2$s', 'hoot-ubix' ), '<span>', '</span>' ),
		/* Translators: The %s is placeholders for line break divider. */
		'desc' => sprintf( esc_html__( 'Enjoy the flexibility of using shortcodes throughout your site with Hoot Ubix premium. These shortcodes were specially designed for this theme and are very well integrated into the code to reduce loading times, thereby maximizing performance!%1$sUse shortcodes to insert buttons, sliders, tabs, toggles, columns, breaks, icons, lists, and a lot more design and layout modules.%1$sThe intuitive Shortcode Generator has been built right into the Edit screen, so you dont have to hunt for shortcode syntax.', 'hoot-ubix' ), '<hr>' ),
		'img' => $imagepath . 'premium-shortcodes.jpg',
		);

	$features[] = array(
		'name' => esc_html__( 'Image Carousels', 'hoot-ubix' ),
		'desc' => esc_html__( 'Add carousel widgets to your post, in your sidebar, on your frontpage or in your footer. A simple drag and drop interface allows you to easily create and manage carousels.', 'hoot-ubix' ),
		'img' => $imagepath . 'premium-carousels.jpg',
		);

	$features[] = array(
		/* Translators: The %s are placeholders for HTML, so the order can't be changed. */
		'name' => sprintf( esc_html__( 'Floating %1$s%2$s\'Sticky\' Header%3$s &amp; %2$s\'Goto Top\'%3$s button (optional)', 'hoot-ubix' ), '<br>', '<span>', '</span>' ),
		/* Translators: The %s are placeholders for HTML, so the order can't be changed. */
		'desc' => sprintf( esc_html__( 'The floating header follows the user down your page as they scroll, which means they never have to scroll back up to access your navigation menu, improving user experience.%1$sOr, use the \'Goto Top\' button appears on the screen when users scroll down your page, giving them a quick way to go back to the top of the page.', 'hoot-ubix' ), '<hr>' ),
		'img' => $imagepath . 'premium-header-top.jpg',
		);

	$features[] = array(
		/* Translators: The %s are placeholders for HTML, so the order can't be changed. */
		'name' => sprintf( esc_html__( 'One Page %1$sScrolling Website /%2$s %1$sLanding Page%2$s', 'hoot-ubix' ), '<span>', '</span>' ),
		/* Translators: The %s are placeholders for HTML, so the order can't be changed. */
		'desc' => sprintf( esc_html__( 'Make One Page websites with menu items linking to different sections on the page. Watch the scroll animation kick in when a user clicks a menu item to jump to a page section.%1$sCreate different landing pages on your site. Change the menu for each page so that the menu items point to sections of the page being displayed.', 'hoot-ubix' ), '<hr>' ),
		'img' => $imagepath . 'premium-scroller.jpg',
		'style' => 'side',
		);

	$features[] = array(
		/* Translators: The %s are placeholders for HTML, so the order can't be changed. */
		'name' => sprintf( esc_html__( 'Additional Blog Layouts (including pinterest %1$stype mosaic)%2$s', 'hoot-ubix' ), '<span>', '</span>' ),
		'desc' => esc_html__( 'Hoot Ubix Premium gives you the option to display your post archives in different layouts including a mosaic type layout similar to pinterest.', 'hoot-ubix' ),
		'img' => $imagepath . 'premium-blogstyles.jpg',
		);

	$features[] = array(
		'name' => esc_html__( 'Custom Widgets', 'hoot-ubix' ),
		'desc' => esc_html__( 'Custom widgets crafted and designed specifically for Hoot Ubix Premium Theme to give you the flexibility of adding stylized content.', 'hoot-ubix' ),
		'img' => $imagepath . 'premium-widgets.jpg',
		);

	$features[] = array(
		'name' => esc_html__( 'Menu Icons', 'hoot-ubix' ),
		'desc' => esc_html__( 'Select from over 900 icons for your main navigation menu links.', 'hoot-ubix' ),
		'img' => $imagepath . 'premium-menuicons.jpg',
		);

	$features[] = array(
		'name' => esc_html__( 'Premium Background Patterns (CC0)', 'hoot-ubix' ),
		'desc' => esc_html__( 'Hoot Ubix Premium comes with many additional premium background patterns. You can always upload your own background image/pattern to match your site design.', 'hoot-ubix' ),
		// 'img' => $imagepath . 'premium-backgrounds.jpg',
		);

	$features[] = array(
		/* Translators: The %s are placeholders for HTML, so the order can't be changed. */
		'name' => sprintf( esc_html__( 'Automatic Image Lightbox and %1$sWordPress Gallery%2$s', 'hoot-ubix' ), '<span>', '</span>' ),
		/* Translators: The %s are placeholders for HTML, so the order can't be changed. */
		'desc' => sprintf( esc_html__( 'Automatically open image links on your site with the integrates lightbox in Hoot Ubix Premium.%1$sAutomatically convert standard WordPress galleries to beautiful lightbox gallery slider.', 'hoot-ubix' ), '<hr>' ),
		'img' => $imagepath . 'premium-lightbox.jpg',
		);

	$features[] = array(
		/* Translators: The %s are placeholders for HTML, so the order can't be changed. */
		'name' => sprintf( esc_html__( 'Developers %1$slove {LESS}', 'hoot-ubix' ), '<br />' ),
		'desc' => esc_html__( 'CSS is passe! Developers love the modularity and ease of using LESS, which is why Hoot Ubix Premium comes with properly organized LESS files for the main stylesheet.', 'hoot-ubix' ),
		'img' => $imagepath . 'premium-lesscss.jpg',
		);

	$features[] = array(
		'name' => esc_html__( 'Easy Import/Export', 'hoot-ubix' ),
		'desc' => esc_html__( 'Moving to a new host? Or applying a new child theme? Easily import/export your customizer settings with just a few clicks - right from the backend.', 'hoot-ubix' ),
		// 'img' => $imagepath . 'premium-import-export.jpg',
		);

	$features[] = array(
		'style' => 'aside',
		'blocks' => array(
			array(
				/* Translators: The %s are placeholders for HTML, so the order can't be changed. */
				'name' => sprintf( esc_html__( 'Custom Javascript &amp; %1$sGoogle Analytics%2$s', 'hoot-ubix' ), '<span>', '</span>' ),
				'desc' => esc_html__( 'Easily insert any javascript snippet to your header without modifying the code files. This helps in adding scripts for Google Analytics, Adsense or any other custom code.', 'hoot-ubix' ),
				// 'img' => $imagepath . 'premium-customjs.jpg',
				),
			array(
				/* Translators: The %s are placeholders for HTML, so the order can't be changed. */
				'name' => sprintf( esc_html__( 'Continued %1$sLifetime Updates', 'hoot-ubix' ), '<br />' ),
				'desc' => esc_html__( 'You will help support the continued development of Hoot Ubix - ensuring it works with future versions of WordPress for years to come.', 'hoot-ubix' ),
				// 'img' => $imagepath . 'premium-updates.jpg',
				),
			),
		);

	$features[] = array(
		/* Translators: The %s are placeholders for HTML, so the order can't be changed. */
		'name' => sprintf( esc_html__( 'Premium %1$sPriority Support', 'hoot-ubix' ), '<br />' ),
		/* Translators: The %s are placeholders for HTML, so the order can't be changed. */
		'desc' => sprintf( esc_html__( 'Need help setting up Hoot Ubix? Upgrading to Hoot Ubix Premium gives you prioritized support. We have a growing support team ready to help you with your questions.%1$sNeed small modifications? If you are not a developer yourself, you can count on our support staff to help you with CSS snippets to get the look you are after. Best of all, your changes will persist across updates.', 'hoot-ubix' ), '<hr>' ),
		'img' => $imagepath . 'premium-support.jpg',
		// 'style' => 'side',
		);



	$settinglink = admin_url( 'options-reading.php' );
	$addpagelink = admin_url( 'post-new.php?post_type=page' );
	$quickstart[] = array(
		'name' => esc_html__( 'Setup Frontpage and Blog Page', 'hoot-ubix' ),
		/* Translators: The %s are placeholders for HTML, so the order can't be changed. */
		'desc' => sprintf( esc_html__( 'Users often want to create a landing Homepage/Frontpage to welcome their visitors, while a separate \'Blog\' page to list all their blog posts. To do this, follow these steps:%9$s%1$s
			%3$sIn your wp-admin area, click %11$sPages > Add New%12$s%4$s
			%3$sGive page a Title %7$s(lets call it "My Home Page")%8$s and %5$sPublish%6$s%4$s
			%3$sIn your wp-admin area, click %11$sPages > Add New%12$s%4$s
			%3$sGive page a Title %7$s(lets call it "My Blog")%8$s and %5$sPublish%6$s%4$s
			%3$sIn your wp-admin area, go to %10$sSettings > Reading%12$s%4$s
			%3$sSelect the %5$sStatic Page%6$s option.%4$s
			%3$sSelect the pages you created in Step 2 and 4 above.%4$s
			%3$s%5$sSave%6$s the Changes.%4$s
			%2$s', 'hoot-ubix' ), '<ol>', '</ol>', '<li>', '</li>', '<strong>', '</strong>', '<em>', '</em>', '<br />',
										'<a href="' . esc_url( $settinglink ) . '">',
										'<a href="' . esc_url( $addpagelink ) . '">',
										'</a>'
				),
		'img' => $imagepath . 'qstart-staticpage.png',
		'style' => 'img-bottom',
		);

	$menulink = admin_url( 'nav-menus.php' );
	$quickstart[] = array(
		'name' => esc_html__( 'Setup Main Navigation Menu', 'hoot-ubix' ),
		/* Translators: The %s are placeholders for HTML, so the order can't be changed. */
		'desc' => sprintf( esc_html__( '%1$s
			%3$sIn your wp-admin, go to %10$sAppearance > Menus%12$s%4$s
			%3$sClick on %5$screate a new menu%6$s link. %9$s%7$s(If you already have an existing menu, jump to Step 6)%8$s%4$s
			%3$sGive your menu a name and click %5$sCreate Menu%6$s%4$s
			%3$sNow add pages, categories, custom links etc to this menu.%4$s
			%3$sClick %5$sSave Menu%6$s%4$s
			%3$sClick %11$sManage Locations%12$s tab at the top%4$s
			%3$sSelect the menu you just created in the dropdown options.%4$s
			%3$sClick %5$sSave Changes%6$s%4$s
			%2$s%7$sTip: You can add "My Home Page" and "My Blog" pages created in above section to your menu.%8$s
			', 'hoot-ubix' ), '<ol>', '</ol>', '<li>', '</li>', '<strong>', '</strong>', '<em>', '</em>', '<br />',
										'<a href="' . esc_url( $menulink ) . '">',
										'<a href="' . esc_url( $menulink ) . '?action=locations">',
										'</a>'
				),
		);

	$widgetslink = admin_url( 'widgets.php' );
	$customizelink = admin_url( 'customize.php' );
	$quickstart[] = array(
		'name' => esc_html__( 'Add Content to Frontpage', 'hoot-ubix' ),
		/* Translators: The %s are placeholders for HTML, so the order can't be changed. */
		'desc' => sprintf( esc_html__( '%1$s
			%3$sIn your wp-admin, go to %10$sAppearance > Widgets%12$s%4$s
			%3$sAdd Widgets to the %5$sFrontpage Widget Areas%6$s%4$s
			%3$sYou can further manage Frontpage modules in your wp-admin by going to %11$sAppearance > Customizer%12$s and click %5$sFrontpage Modules%6$s section.%4$s
			%2$s
			%9$s%9$s
			%13$sAdd a full width slider%14$s
			You can display a full width slider on your frontpage by going to %11$sAppearance > Customizer > Frontpage Slider%12$s section and selecting the %5$sfull width%6$s option.
			', 'hoot-ubix' ), '<ol>', '</ol>', '<li>', '</li>', '<strong>', '</strong>', '<em>', '</em>', '<hr>',
										'<a href="' . esc_url( $widgetslink ) . '">',
										'<a href="' . esc_url( $customizelink ) . '">',
										'</a>', '<h4>', '</h4>'
				),
		'img' => $imagepath . 'qstart-fpmodule.png',
		'style' => 'img-bottom',
		);

	$quickstart[] = array(
		/* Translators: 1 is a line break */
		'name' => sprintf( esc_html__( '[Optional]%1$sInstall Demo Content', 'hoot-ubix' ), '<br />' ),
		/* Translators: The %s are placeholders for HTML, so the order can't be changed. */
		'desc' => sprintf( esc_html__( '%14$sIt is recommended to install demo content only on a fresh new site%15$s
			Installing demo content is the easiest way to setup your theme and make it look like the %10$sDemo Site%13$s.%9$s
			%7$sYour existing content (posts, pages, categories, images etc) will NOT be deleted or modified. However new content (posts, images, menus etc.) will be imported and added to your site.%8$s
			%1$s
			%3$sDownload the Demo files from the %11$sSupport Documentation%13$s%4$s
			%3$sInstall the %11$sOne Click Demo Import%13$s plugin.%4$s
			%3$sIn your wp-admin, go to %5$sAppearance &gt; Import Demo Data%6$s%4$s
			%3$sUpload the files from Step 1 and click the %5$sImport%6$s button.%4$s
			%2$s', 'hoot-ubix' ), '<ol>', '</ol>', '<li>', '</li>', '<strong>', '</strong>', '<em>', '</em>', '<hr>',
										'<a href="https://demo.wphoot.com/hoot-ubix/" target="_blank">',
										'<a href="https://wphoot.com/support/hoot-ubix/#docs-section-demo-content-free" target="_blank">',
										'<a href="https://wordpress.org/plugins/one-click-demo-import/" target="_blank">',
										'</a>', '<h4>', '</h4>'
				),
		);


	return ( !empty( $$string ) ) ? $$string : '';


}