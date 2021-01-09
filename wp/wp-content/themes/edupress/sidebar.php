<?php
if ( ! is_active_sidebar( 'sidebar-main' ) ) {
	return;
}
?>

<aside id="site-aside" role="complementary">

	<div class="site-aside-wrapper clearfix">
	
		<?php dynamic_sidebar( 'sidebar-main' ); ?>
		
	</div><!-- .site-aside-wrapper .clearfix -->

</aside><!-- #site-aside -->