<?php
get_header(); ?>

	<div id="site-main" class="content-home">

		<div class="wrapper wrapper-main clearfix">
		
			<div class="wrapper-frame clearfix">
			
				<main id="site-content" class="site-main" role="main">
				
					<section class="error-404 not-found">
					
						<div class="site-content-wrapper clearfix">
		
							<div class="ilovewp-page-intro ilovewp-archive-intro">
								<h1 class="title-page"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'edupress' ); ?></h1>
								<div class="taxonomy-description"><p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'edupress' ); ?></p></div>
							</div><!-- .ilovewp-page-intro -->
						
							<div class="post-single">
							
							<?php get_search_form(); ?>
	
							<?php
								$args = array(
									'before_title'  => '<p class="widget-title">',
									'after_title'   => '</p>',
									'show_date'   => true
								);
	
								the_widget( 'WP_Widget_Recent_Posts', 'number=10&show_date=1', $args );
							?>
	
							<?php if ( edupress_categorized_blog() ) : // Only show the widget if site has multiple categories. ?>
							
							<div class="widget widget_categories">
								<p class="widget-title"><?php esc_html_e( 'Popular Categories', 'edupress' ); ?></p>
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
							
							</div>
	
						</div><!-- .site-content-wrapper .clearfix -->
					
					</section><!-- .error-404 -->
					
				</main><!-- #site-content -->
				
				<?php get_sidebar(); ?>
			
			</div><!-- .wrapper-frame -->
		
		</div><!-- .wrapper .wrapper-main -->

	</div><!-- #site-main -->

<?php get_footer(); ?>