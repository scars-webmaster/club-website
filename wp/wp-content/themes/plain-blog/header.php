<?php
/**
 * This file is responsible for the rendering of the header of the theme.
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php
    if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
    wp_head();
    ?>
</head>
<body <?php body_class(); ?>>
    <!--main_container-->
    <div id="main_container">
        <div class="col-md-12 no-padding">
            <div class="header">
                <div class="container">
                    <div class="pull-left">
                        <a href="<?php echo esc_url(home_url()); ?>" class="logo">
						<?php if(is_home() && is_front_page()) { ?>
							<h1><?php bloginfo('name'); ?></h1>
                        <?php }
						   else {
						 ?>
                      	 	<p><?php bloginfo('name'); ?></p>
                        <?php } ?>     
                        </a>
                    </div>
                    <div class="pull-right">
                        <div id='navigation'>
                              <?php if ( has_nav_menu( 'primary' ) ) { ?>
                                <?php wp_nav_menu( 
										array( 
											'theme_location' => 'primary',
											'container' => '',
											'menu_class' => '',
											'items_wrap' => '<ul>%3$s</ul>',
											'walker' => new DropDown_Nav_Menu()
                                		) ); 
								?>
                              <?php } else{ ?>  
                                <ul class="menu clearfix">
										<?php wp_list_categories('title_li='); ?>
									</ul>
                                <?php } ?>
                            
                        </div>
                    </div>
                </div>
            </div>

            <div class="banner_heading header_bg">
                <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
        <!--middle section Start here-->
        <div class="middle_section col-md-12">
            <!--container start-->
            <div class="container">
                <!--row start-->
                <div class="row">
           