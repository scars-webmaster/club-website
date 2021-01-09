<?php
/**
 * The header template file.
 * @package HappenStance
 * @since HappenStance 1.0.0
*/
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>" /> 
  <meta name="viewport" content="width=device-width, initial-scale=1" />  
<?php if ( ! function_exists( '_wp_render_title_tag' ) ) { ?><title><?php wp_title( '|', true, 'right' ); ?></title><?php } ?>
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">  
<?php wp_head(); ?>  
</head> 
<body <?php body_class(); ?> id="wrapper">
<?php if ( get_theme_mod('happenstance_display_background_pattern') != 'Hide' ) { ?>
<div class="pattern"></div> 
<?php } ?>   
<div id="container">
<div id="container-shadow">
  <header id="header">
<?php if ( !is_page_template('template-landing-page.php') ) { ?>
<?php if ( has_nav_menu( 'secondary-navigation' ) ) { ?>
<?php if ( get_theme_mod('happenstance_secondary_menu_format') == 'Slider' ) { ?>
    <div id="ticker-wrapper">
      <div class="ticker-box">
        <div class="ticker-arrow-1"></div>
        <div class="ticker-arrow-2"></div>
<?php wp_nav_menu( array( 'menu_id'=>'ticker', 'theme_location'=>'secondary-navigation', 'link_before'=>'&raquo; ' ) ); ?>
      </div>
    </div>
<?php } else { ?>
    <div class="secondary-menu-box-container">
      <div class="secondary-menu-box-wrapper">
      <div class="secondary-menu-box">
<?php wp_nav_menu( array( 'menu_id'=>'nav-2', 'theme_location'=>'secondary-navigation' ) ); ?>
      </div>
      </div>
    </div>
<?php }} ?>
<?php if ( get_theme_mod('happenstance_header_address') != '' || get_theme_mod('happenstance_header_email') != '' || get_theme_mod('happenstance_header_phone') != '' || get_theme_mod('happenstance_header_skype') != '' || has_nav_menu('social-links-navigation') ) { ?>
  <div class="top-navigation-wrapper">
    <div class="top-navigation">
<?php if ( get_theme_mod('happenstance_header_address') != '' || get_theme_mod('happenstance_header_email') != '' || get_theme_mod('happenstance_header_phone') != '' || get_theme_mod('happenstance_header_skype') != '' ){ ?>
      <p class="header-contact">
<?php if ( get_theme_mod('happenstance_header_address') != '' ){ ?>
        <span class="header-contact-address"><i class="icon_house" aria-hidden="true"></i><?php echo esc_html(get_theme_mod('happenstance_header_address')); ?></span>
<?php } ?>
<?php if ( get_theme_mod('happenstance_header_email') != '' ){ ?>
        <span class="header-contact-email"><i class="icon_mail" aria-hidden="true"></i><?php echo esc_html(get_theme_mod('happenstance_header_email')); ?></span>
<?php } ?>
<?php if ( get_theme_mod('happenstance_header_phone') != '' ){ ?>
        <span class="header-contact-phone"><i class="icon_phone" aria-hidden="true"></i><?php echo esc_html(get_theme_mod('happenstance_header_phone')); ?></span>
<?php } ?>
<?php if ( get_theme_mod('happenstance_header_skype') != '' ){ ?>
        <span class="header-contact-skype"><i class="social_skype" aria-hidden="true"></i><?php echo esc_html(get_theme_mod('happenstance_header_skype')); ?></span>
      </p>
<?php }} ?>
<?php if ( has_nav_menu( 'social-links-navigation' ) ) { wp_nav_menu( array( 'menu_id'=>'social-links-nav', 'theme_location'=>'social-links-navigation', 'link_before'=>'<span class="screen-reader-text">', 'link_after'=>'</span>', 'depth'=>1 ) ); } ?>
    </div>
  </div>
<?php }} ?>   
    <div class="header-content-wrapper">
    <div class="header-content">
<?php $happenstance_logo_url = happenstance_custom_logo();
if ( $happenstance_logo_url == '' ) { ?>
      <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></p>
<?php } else { ?>
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img class="header-logo" src="<?php echo esc_url($happenstance_logo_url); ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>
<?php } ?>
<?php if ( get_theme_mod('happenstance_display_site_description') != 'Hide' ) { ?>
      <p class="site-description"><?php bloginfo( 'description' ); ?></p>
<?php } ?>
<?php if ( get_theme_mod('happenstance_display_search_form') != 'Hide' && !is_page_template('template-landing-page.php') ) { ?>
<?php get_search_form(); ?>
<?php } ?>
    </div>
    </div>
<?php if ( !is_page_template('template-landing-page.php') ) { ?>
  <div class="menu-box-container">
    <div class="menu-box-wrapper">
    <div class="menu-box">
      <a class="link-home" href="<?php echo esc_url( home_url( '/' ) ); ?>"><i class="icon_house" aria-hidden="true"></i></a>
<?php wp_nav_menu( array( 'menu_id'=>'nav', 'theme_location'=>'main-navigation' ) ); ?>
    </div>
    </div>
  </div>
<?php } ?>    
<?php if ( is_home() || is_front_page() ) { ?>
<?php if ( get_header_image() != '' ) { ?>    
    <div class="header-image">
      <img class="header-img" src="<?php header_image(); ?>" alt="<?php bloginfo( 'name' ); ?>" />
      <div class="header-image-container">
      <div class="header-image-text-wrapper">
        <div class="header-image-text">
<?php if ( get_theme_mod('happenstance_header_image_headline') != '' ) { ?>
          <p class="header-image-headline"><?php echo esc_html(get_theme_mod('happenstance_header_image_headline')); ?></p>
<?php } if ( get_theme_mod('happenstance_header_image_link_url') != '' && get_theme_mod('happenstance_header_image_link_text') != '' ) { ?>
          <p class="header-image-link-wrapper"><a class="header-image-link" href="<?php echo esc_url(get_theme_mod('happenstance_header_image_link_url')); ?>"><?php echo esc_html(get_theme_mod('happenstance_header_image_link_text')); ?></a></p>
<?php } ?>
        </div>
      </div>
      </div>
    </div>
<?php } ?>
<?php } else { ?>
<?php if ( get_header_image() != '' && get_theme_mod('happenstance_display_header_image') != 'Only on Homepage' ) { ?>
  <div class="header-image">
    <img class="header-img" src="<?php header_image(); ?>" alt="<?php bloginfo( 'name' ); ?>" />
  </div>
<?php }} ?>
  </header> <!-- end of header -->

  <div id="wrapper-content">
  <div id="main-content">
  <div id="content" class="hentry">