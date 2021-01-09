<?php
/**
 * The header for our theme
 *
 * @subpackage gurukul-education
 * @since 1.0
 * @version 1.4
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php if ( function_exists( 'wp_body_open' ) ) {
    wp_body_open();
} else {
    do_action( 'wp_body_open' );
}?>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'gurukul-education' ); ?></a>

	<header role="banner" id="masthead" class="site-header">
		<div class="social-icon">
			<div class="container">
				<div class="row">
					<div class="offset-lg-6 col-lg-6 offset-md-6 col-md-6 ">
						<?php if( get_theme_mod( 'gurukul_education_facebook','' ) != '') { ?>
							<a href="<?php echo esc_url( get_theme_mod('gurukul_education_facebook','') ); ?>"><i class="fab fa-facebook-f"></i><span class="screen-reader-text"><?php esc_html_e( 'Facebook','gurukul-education' );?></span></a>
						<?php } ?>
						<?php if( get_theme_mod( 'gurukul_education_twitter','' ) != '') { ?>
							<a href="<?php echo esc_url( get_theme_mod('gurukul_education_twitter','') ); ?>"><i class="fab fa-twitter"></i><span class="screen-reader-text"><?php esc_html_e( 'Twitter','gurukul-education' );?></span></a>
						<?php } ?>
						<?php if( get_theme_mod( 'gurukul_education_instagram','' ) != '') { ?>
							<a href="<?php echo esc_url( get_theme_mod('gurukul_education_instagram','') ); ?>"><i class="fab fa-instagram"></i><span class="screen-reader-text"><?php esc_html_e( 'Instagram','gurukul-education' );?></span></a>
						<?php } ?>
						<?php if( get_theme_mod( 'gurukul_education_linkdin','' ) != '') { ?>
							<a href="<?php echo esc_url( get_theme_mod('gurukul_education_linkdin','') ); ?>"><i class="fab fa-linkedin-in"></i><span class="screen-reader-text"><?php esc_html_e( 'Linkedin','gurukul-education' );?></span></a>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="main-top">
				<div class="row m-0">
					<div class="col-lg-4 col-md-4">
						<div class="logo">
					        <?php if ( has_custom_logo() ) : ?>
						        <div class="site-logo"><?php the_custom_logo(); ?></div>
						    <?php endif; ?>
				            <?php if (get_theme_mod('gurukul_education_show_site_title',true)) {?>
						        <?php $blog_info = get_bloginfo( 'name' ); ?>
						        <?php if ( ! empty( $blog_info ) ) : ?>
						            <?php if ( is_front_page() && is_home() ) : ?>
							            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						        	<?php else : ?>
					            		<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						            <?php endif; ?>
						        <?php endif; ?>
						    <?php }?>
				        	<?php if (get_theme_mod('gurukul_education_show_tagline',true)) {?>
						        <?php
						        $description = get_bloginfo( 'description', 'display' );
						        if ( $description || is_customize_preview() ) :
						          ?>
							        <p class="site-description">
							            <?php echo esc_html($description); ?>
							        </p>
						        <?php endif; ?>
						    <?php }?>
					    </div>
					</div>
					<div class="col-lg-8 col-md-8 call-details">
						<div class="row">
							<div class="col-lg-6 col-md-6 offset-md-2">
								<div class="mail">
									<?php if( get_theme_mod( 'gurukul_education_mail1','' ) != '') { ?>
										<p><?php echo esc_html( get_theme_mod('gurukul_education_mail','')); ?></p>
								        <p class="col-org"><a href="mailto:<?php echo esc_url( get_theme_mod('gurukul_education_mail1','')); ?>"><?php echo esc_html( get_theme_mod('gurukul_education_mail1','')); ?></a></p>
								    <?php } ?>
								</div>
						   	</div>
						   	<div class="col-lg-4 col-md-4">
						   		<div class="call">
							   		<?php if( get_theme_mod( 'gurukul_education_call1','' ) != '') { ?>
										<p><?php echo esc_html( get_theme_mod('gurukul_education_call','') ); ?></p>
								        <p class="col-org"><a href="tel:<?php echo esc_url( get_theme_mod('gurukul_education_call1','')); ?>"><?php echo esc_html( get_theme_mod('gurukul_education_call1','') ); ?></a></p>
								    <?php } ?>
								</div>
						   	</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="theme-menu">
			<div class="container">
				<div class="row">
					<div class="col-lg-9 col-md-7 col-3">
						<?php if (has_nav_menu('top')){ ?>
							<div class="toggle-menu responsive-menu">
					            <button onclick="gurukul_education_open()" role="tab" class="mobile-menu"><i class="fas fa-bars"></i><span class="screen-reader-text"><?php esc_html_e('Open Menu','gurukul-education'); ?></span></button>
					        </div>
							<div id="sidelong-menu" class="nav sidenav">
				                <nav id="primary-site-navigation" class="nav-menu" role="navigation" aria-label="<?php esc_attr_e( 'Top Menu', 'gurukul-education' ); ?>">
				                  <?php 
				                    wp_nav_menu( array( 
				                      'theme_location' => 'top',
				                      'container_class' => 'main-menu-navigation clearfix' ,
				                      'menu_class' => 'clearfix',
				                      'items_wrap' => '<ul id="%1$s" class="%2$s mobile_nav">%3$s</ul>',
				                      'fallback_cb' => 'wp_page_menu',
				                    ) ); 
				                  ?>
				                  <a href="javascript:void(0)" class="closebtn responsive-menu" onclick="gurukul_education_close()"><i class="fas fa-times"></i><span class="screen-reader-text"><?php esc_html_e('Close Menu','gurukul-education'); ?></span></a>
				                </nav>
				            </div>
				        <?php }?>
					</div>
					<div class="search-box col-lg-3 col-md-5 col-9">
						<?php get_search_form(); ?>
					</div>
				</div>
			</div>
		</div>
	</header>

	<div class="site-content-contain">
		<div id="content" class="site-content">