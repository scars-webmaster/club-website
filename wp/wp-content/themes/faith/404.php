<?php
get_header(); ?>

	<?php get_template_part( 'template-parts/header-image', '' ); ?>

	<div id="site-main" class="page-has-frame<?php if ( isset($ilovewp_has_image) && $ilovewp_has_image === TRUE) { echo ' page-has-image'; } ?>">

		<div class="wrapper wrapper-main clearfix">

			<div class="wrapper-frame clearfix">
			
				<main id="site-content" class="site-main" role="main">
				
					<div class="site-content-wrapper clearfix">
	
						<div class="ilovewp-page-intro ilovewp-archive-intro">
							<h1 class="title-page"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'faith' ); ?></h1>
							<div class="taxonomy-description"><p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'faith' ); ?></p></div>
						</div><!-- .ilovewp-page-intro -->
	
						<div class="post-single clearfix">

							<?php get_search_form(); ?>
	
							<?php
								$args = array(
									'before_title'  => '<p class="widget-title">',
									'after_title'   => '</p>',
									'show_date'   => true
								);
							?>
	
							<?php if ( faith_categorized_blog() ) : // Only show the widget if site has multiple categories. ?>
							
							<div class="widget widget_categories">
								<p class="widget-title"><?php esc_html_e( 'Popular Categories', 'faith' ); ?></p>
								<ul>
								<?php
									wp_list_categories( array(
										'orderby'    => 'count',
										'order'      => 'DESC',
										'show_count' => 1,
										'title_li'   => '',
										'number'     => 0,
									) );
								?>
								</ul>
							</div><!-- .widget -->
							<?php endif; ?>
	
							<?php the_widget( 'WP_Widget_Archives', 'dropdown=1', $args ); ?>

						</div><!-- .post-single .clearfix -->
						
					</div><!-- .site-content-wrapper .clearfix -->
					
				</main><!-- #site-content -->
				
				<?php get_sidebar(); ?>
			
			</div><!-- .wrapper-frame -->
		
		</div><!-- .wrapper .wrapper-main -->

	</div><!-- #site-main -->

<?php get_footer(); ?>