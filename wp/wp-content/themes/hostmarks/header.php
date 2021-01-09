<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="container">

	<header id="branding" role="banner">
    
      <div id="inner-header" class="clearfix">
      
		<div id="site-heading">
			<?php if ( get_theme_mod( 'custom_logo' ) ) : 
				$custom_logo_id = get_theme_mod( 'custom_logo' );
				$custom_logo_url = wp_get_attachment_image_url( $custom_logo_id , 'full' ); ?>
            <div id="site-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo esc_url( $custom_logo_url ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" /></a></div>
            <?php else : ?>
			<div id="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></div>
            <?php endif; ?>
		</div>

		<nav id="access" role="navigation" class="clearfix">
			<h1 class="assistive-text section-heading"><?php _e( 'Main menu', 'hostmarks' ); ?></h1>
			<div class="skip-link screen-reader-text"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'hostmarks' ); ?>"><?php _e( 'Skip to content', 'hostmarks' ); ?></a></div>
			<?php hostmarks_main_nav(); // Adjust using Menus in WordPress Admin ?>
		</nav><!-- #access -->
        
      </div>

	</header><!-- #branding -->