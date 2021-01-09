<?php
get_header(); ?>

	<div id="site-main" class="content-home">

		<div class="wrapper wrapper-main clearfix">
		
			<div class="wrapper-frame clearfix">
			
				<main id="site-content" class="site-main" role="main">
				
					<div class="site-content-wrapper clearfix">
	
						<div class="ilovewp-page-intro ilovewp-archive-intro">					
							<h1 class="title-page widget-title"><?php /* translators: search results term */ printf( esc_html__( 'Search Results for: %s', 'edupress' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
							<?php get_search_form(); ?>						
						</div><!-- .ilovewp-page-intro -->
						
						<?php if ( have_posts() ) : $i = 0; ?>
						
						<?php /* Start the Loop */ ?>
						<ul id="recent-posts" class="ilovewp-posts ilovewp-posts-archive clearfix">
						<?php while ( have_posts() ) : the_post(); ?>
			
							<?php
			
								/**
								 * Run the loop for the search to output the results.
								 * If you want to overload this in a child theme then include a file
								 * called content-search.php and that will be used instead.
								 */
								get_template_part( 'template-parts/content', 'search' );
							?>
			
						<?php endwhile; ?>
						
						</ul><!-- .ilovewp-posts .ilovewp-posts-archive -->
			
						<?php
						the_posts_pagination( array( 'mid_size' => 4 ) );
						?>
			
					<?php else : ?>
			
						<?php get_template_part( 'template-parts/content', 'none' ); ?>
			
					<?php endif; ?>
						
					</div><!-- .site-content-wrapper .clearfix -->
					
				</main><!-- #site-content -->
				
				<?php get_sidebar(); ?>
			
			</div><!-- .wrapper-frame -->
		
		</div><!-- .wrapper .wrapper-main -->

	</div><!-- #site-main -->

<?php get_footer(); ?>