<?php
if ( 'posts' == get_option( 'show_on_front' ) ) :

	get_template_part( 'index' );

else :

?>
	<?php get_header();

	if ( is_front_page() && !is_paged() ) {

		if ( 1 == get_theme_mod( 'faith_front_featured_pages', 1 ) ) {
			get_template_part( 'template-parts/content', 'home-featured' );
		}
		if ( is_active_sidebar( 'home-col-1' ) || is_active_sidebar( 'home-col-2' ) ) : ?>

		<div id="ilovewp-home-welcome" class="<?php if ( !isset($ilovewp_has_slideshow) || $ilovewp_has_slideshow != 1 ) { echo 'ilovewp-home-noslideshow'; } else { echo 'ilovewp-home-hasslideshow'; } ?>">

			<div class="wrapper clearfix">

				<div class="ilovewp-columns ilovewp-columns-2 clearfix">

					<div class="ilovewp-column ilovewp-column-1">

						<div class="ilovewp-column-wrapper clearfix">

							<?php if ( is_active_sidebar( 'home-col-1' ) ) {
								dynamic_sidebar( 'home-col-1' );
							} else { _e('&nbsp;','faith'); } ?>

						</div><!-- .ilovewp-column-wrapper .clearfix -->

					</div><!-- .ilovewp-column .ilovewp-column-1 --><!-- ws fix

					--><div class="ilovewp-column ilovewp-column-2">

						<div class="ilovewp-column-wrapper clearfix">

							<?php if ( is_active_sidebar( 'home-col-2' ) ) {
								dynamic_sidebar( 'home-col-2' );
							} else { _e('&nbsp;','faith'); } ?>

						</div><!-- .ilovewp-column-wrapper .clearfix -->

					</div><!-- .ilovewp-column .ilovewp-column-2 -->

				</div><!-- .ilovewp-columns .ilovewp-columns-2 .clearfix -->

			</div><!-- .wrapper -->

		</div><!-- #ilovewp-home-welcome -->

		<?php endif; ?>
		<?php
		if ( 1 == get_theme_mod( 'faith_front_featured_pages_columns', 1 ) ) {
			get_template_part( 'template-parts/content', 'home-pages' );
		}

	}
	?>
	<div id="site-main" class="content-home">

		<div class="wrapper wrapper-main clearfix">
			
			<div class="wrapper-frame clearfix">
			
				<main id="site-content" class="site-main" role="main">
				
					<div class="site-content-wrapper clearfix">
	
						<?php while ( have_posts() ) : the_post(); ?>
						
						<div class="clearfix">
		
							<?php get_template_part( 'template-parts/content', 'home' ); ?>

							<?php
								// If comments are open or we have at least one comment, load up the comment template
								if ( comments_open() || '0' != get_comments_number() ) {
									comments_template();
								}
							?>
							
						</div><!-- .clearfix -->
						
						<?php endwhile; // End of the loop. ?>

					</div><!-- .site-content-wrapper .clearfix -->
				
				</main><!-- #site-content -->
				
				<?php get_sidebar(); ?>
			
			</div><!-- .wrapper-frame -->
		
		</div><!-- .wrapper .wrapper-main -->

	</div><!-- #site-main -->

	<?php get_footer(); ?>

<?php endif; ?>