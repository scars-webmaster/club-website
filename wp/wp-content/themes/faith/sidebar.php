<?php
if ( ! is_active_sidebar( 'sidebar-main' ) && 1 != get_theme_mod( 'faith_single_dynamic_menu', 1 ) ) {
	return;
}
?>

<aside id="site-aside" role="complementary">

	<div class="site-aside-wrapper clearfix">
	
		<?php if ( ( is_page() || is_page_template() ) ) { get_template_part('related-pages'); } ?>

		<?php dynamic_sidebar( 'sidebar-main' ); ?>
		
	</div><!-- .site-aside-wrapper .clearfix -->

</aside><!-- #site-aside -->