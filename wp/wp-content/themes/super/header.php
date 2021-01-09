<?php
/**
 * The Header template
 */ 
 ?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html itemscope itemtype="http://schema.org/WebPage" <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">	
	<?php endif; ?>
	<?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>
<?php if ( function_exists( 'wp_body_open' ) ) { wp_body_open(); } ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'super' ); ?></a>

		<?php if (esc_attr(get_theme_mod( 'social_media_activate_header' )) or esc_attr(get_theme_mod('super_contacts_header_address')) or esc_attr(get_theme_mod('super_contacts_header_phone')) ) { ?>
		
		<div class="social">
				<div class="fa-icons">
					<?php if (esc_attr(get_theme_mod( 'social_media_activate_header' ))) {echo super_social_section ();} ?>		

				</div>
				<div class="soc-right">
						<?php if (esc_attr(get_theme_mod('super_contacts_header_address'))) { ?><span itemprop="address" itemscope itemtype="http://schema.org/PostalAddress"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo esc_attr(get_theme_mod('super_contacts_header_address')); ?></span><?php } ?>
						<?php if (esc_attr(get_theme_mod('super_contacts_header_phone'))) { ?><span itemprop="telephone"><i class="fa fa-volume-control-phone" aria-hidden="true"></i> <?php echo esc_attr(get_theme_mod('super_contacts_header_phone')); ?></span><?php } ?>
				</div>
				<div class="clear"></div>
		</div>	 
		<?php } ?>

	<div class="nav-center">

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
					
			<a href="#" id="menu-icon">	
				<span class="menu-button"> </span>
				<span class="menu-button"> </span>
				<span class="menu-button"> </span>
			</a>	

			</button>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
		</nav><!-- #site-navigation -->
		
	</div>
	<?php if(get_theme_mod('super_home_activate_breadcrumb')and ( !is_front_page() || !is_home())) { ?>
		<div class="breadcrumb" itemprop="breadcrumb"> <!-- breadcrumb -->
			<ul itemscope="" itemtype="http://schema.org/BreadcrumbList">
				<meta name="numberOfItems" content="2">
				<meta name="itemListOrder" content="Ascending">
				<li class="trail-item trail-begin" itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<span itemprop="name">
							<span class="dashicons dashicons-admin-home"></span>
							<span style=" display: none;"><?php echo get_bloginfo( 'name' ); ?></span>
						</span>
					</a>
					<meta content="1" itemprop="position">
				</li>
				<li class="trail-item trail-end" itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
					<span itemprop="name"><?php the_title(); ?></span>
					<meta content="2" itemprop="position">
				</li>
			</ul>
		</div> <!-- breadcrumb -->	
	<?php } ?>	
	<?php if ( has_nav_menu( 'left' ) ) { ?>
	<div class="left-menu">
		<div id="mySidenav" class="sidenav" role="navigation">
		  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
			<?php wp_nav_menu( array( 'theme_location' => 'left', 'menu_id' => 'left-menu' ) ); ?>
		</div>
		<span style="font-size: 30px; background: none; cursor:pointer; display: inline-block;padding: 0 6px 2px 6px;" onclick="openNav()">&#9776;</span>
	</div>	
	<?php } ?>
	
	<header id="masthead" class="site-header" role="banner" itemscope="itemscope" itemtype="http://schema.org/WPHeader">
	
<!---------------- Deactivate Header Image ---------------->	
		
		<?php if (get_theme_mod('custom_header_position') != "deactivate") { ?>
		
<!---------------- All Pages Header Image ---------------->		
	
		<?php if ( get_theme_mod('custom_header_position') == "all" ) : ?>

	
		<?php if (has_header_image() !=""){ ?><img class="header-img" src="<?php header_image(); ?>" /><?php } ?>
	
			<div class="site-branding">
				<div class="dotted">
				<?php if ( has_custom_logo() ) : ?>
					
						<?php if ( is_front_page() && is_home() ) : ?>
							<h1 class="site-title aniview" data-av-animation="bounceInLeft" itemscope itemtype="http://schema.org/Brand">
								<span class="site-title" itemprop="logo" itemscope itemtype="http://schema.org/ImageObject"><?php the_custom_logo(); ?><span>
							</h1>
						<?php else : ?>
							<p class="site-title aniview" data-av-animation="bounceInLeft" itemscope itemtype="http://schema.org/Brand">
								<p class="site-title" itemprop="logo" itemscope itemtype="http://schema.org/ImageObject"><?php the_custom_logo(); ?></p>
							</p>
						<?php endif;

						$ap_description = esc_html (get_bloginfo( 'description', 'display' ));
						if ( $ap_description || is_customize_preview() ) : ?>
							<p class="site-description aniview" data-av-animation="bounceInRight" <?php if ( is_front_page() or is_home() ) { ?>itemprop="headline" <?php } ?>>
								<span class="ml2"><?php echo $ap_description; ?></span>
							</p>
						<?php endif;  ?>
						
					<?php else : ?>
					
						<?php if ( is_front_page() && is_home() ) : ?>
							<h1 class="site-title aniview" itemscope itemtype="http://schema.org/Brand">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><span class="ml2"><?php bloginfo( 'name' ); ?></span></a>
							</h1>
						<?php else : ?>
							<p class="site-title aniview" itemscope itemtype="http://schema.org/Brand">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><span class="ml2"><?php bloginfo( 'name' ); ?></span></a>
							</p>
						<?php endif;

						$ap_description = esc_html (get_bloginfo( 'description', 'display' ));
						if ( $ap_description || is_customize_preview() ) : ?>
						<p class="site-description aniview" data-av-animation="bounceInRight" <?php if ( is_front_page() or is_home() ) { ?>itemprop="headline" <?php } ?>>
							<span class="ml2"><?php echo $ap_description; ?></span>
						</p>
						
				<?php endif;  endif;  ?>			
				
				</div><!-- .site-branding -->
			</div>	
		
		
		<?php endif;  ?>
		
<!---------------- Home Page Header Image ---------------->
		
		<?php if ( ( is_front_page() || is_home() ) and get_theme_mod('custom_header_position') == "home" ) { ?>

		<?php if (has_header_image() !=""){ ?><img class="header-img" src="<?php header_image(); ?>" /><?php } ?>
					
			<div class="site-branding">
				<div class="dotted">			
				<?php if ( has_custom_logo() ) : ?>
					
						<?php if ( is_front_page() && is_home() ) : ?>
							<h1 class="site-title aniview" data-av-animation="bounceInLeft" itemscope itemtype="http://schema.org/Brand">
								<span class="site-title" itemprop="logo" itemscope itemtype="http://schema.org/ImageObject"><?php the_custom_logo(); ?><span>
							</h1>
						<?php else : ?>
							<p class="site-title aniview" data-av-animation="bounceInLeft">
								<p class="site-title" itemscope itemtype="http://schema.org/Brand"><p class="site-title" itemprop="logo" itemscope itemtype="http://schema.org/ImageObject"><?php the_custom_logo(); ?></p></p>
							</p>
						<?php endif;

						$ap_description = esc_html (get_bloginfo( 'description', 'display' ));
						if ( $ap_description || is_customize_preview() ) : ?>
							<p class="site-description aniview" data-av-animation="bounceInRight" <?php if ( is_front_page() or is_home() ) { ?>itemprop="headline" <?php } ?>>
								<span class="ml2"><?php echo $ap_description; ?></span>
							</p>
						<?php endif;  ?>
						
					<?php else : ?>
					
						<?php if ( is_front_page() && is_home() ) : ?>
							<h1 class="site-title aniview" itemscope itemtype="http://schema.org/Brand">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><span class="ml2"><?php bloginfo( 'name' ); ?></span></a>
							</h1>
						<?php else : ?>
							<p class="site-title aniview" itemscope itemtype="http://schema.org/Brand">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><span class="ml2"><?php bloginfo( 'name' ); ?></span></a>
							</p>
						<?php endif;

						$ap_description = esc_html (get_bloginfo( 'description', 'display' ));
						if ( $ap_description || is_customize_preview() ) : ?>
						<p class="site-description aniview" data-av-animation="bounceInRight" <?php if ( is_front_page() or is_home() ) { ?>itemprop="headline" <?php } ?>>
							<span class="ml2"><?php echo $ap_description; ?></span>
						</p>
						
				<?php endif;  endif;  ?>		
				</div>
			</div><!-- .site-branding -->
		
	<?php } 

	} ?> 
<!---------------- Default Header Image ---------------->

		<?php if (  has_header_image() !="") { ?>
		
		<?php if ( get_theme_mod('custom_header_position') != "all") { ?>

		<?php if ( get_theme_mod('custom_header_position') != "home" ) { ?>
		
			<?php if (has_header_image() !=""){ ?><img class="header-img" src="<?php echo esc_url(get_template_directory_uri()). "/framework/images/header.jpg"; ?>" /><?php } ?>
			<div class="site-branding">
				<div class="dotted">					
			
				<?php if ( has_custom_logo() ) : ?>
					
						<?php if ( is_front_page() && is_home() ) : ?>
							<h1 class="site-title aniview" data-av-animation="bounceInLeft">
								<span class="site-title" itemprop="logo" itemscope itemtype="http://schema.org/ImageObject"><?php the_custom_logo(); ?><span>
							</h1>
						<?php else : ?>
							<p class="site-title aniview" data-av-animation="bounceInLeft">
							<p class="site-title">
								<p class="site-title" itemprop="logo" itemscope itemtype="http://schema.org/ImageObject"><?php the_custom_logo(); ?></p>
							</p>
							</p>
						<?php endif;

						$ap_description = esc_html (get_bloginfo( 'description', 'display' ));
						if ( $ap_description || is_customize_preview() ) : ?>
							<p class="site-description aniview" data-av-animation="bounceInRight" <?php if ( is_front_page() or is_home() ) { ?>itemprop="headline" <?php } ?>>
								<span class="ml2"><?php echo $ap_description; ?></span>
							</p>
						<?php endif;  ?>
						
					<?php else : ?>
					
						<?php if ( is_front_page() && is_home() ) : ?>
							<h1 class="site-title aniview" itemscope itemtype="http://schema.org/Brand">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><span class="ml2"><?php bloginfo( 'name' ); ?></span></a>
							</h1>
						<?php else : ?>
							<p class="site-title aniview" itemscope itemtype="http://schema.org/Brand">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><span class="ml2"><?php bloginfo( 'name' ); ?></span></a>
							</p>
						<?php endif;

						$ap_description = esc_html (get_bloginfo( 'description', 'display' ));
						if ( $ap_description || is_customize_preview() ) : ?>
						<p class="site-description aniview" data-av-animation="bounceInRight" <?php if ( is_front_page() or is_home() ) { ?>itemprop="headline" <?php } ?>>
							<span class="ml2"><?php echo $ap_description; ?></span>
						</p>
						
				<?php endif;  endif;  ?>			
				</div>
			</div><!-- .site-branding -->

<?php } } } ?>

	</header><!-- #masthead -->

	<div class="clear"></div>
	
	<div id="content" class="site-content">