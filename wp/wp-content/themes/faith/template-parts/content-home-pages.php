<?php
/**
 * The template used for displaying featured pages on the Front Page.
 *
 * @package Faith
 */
?>

<?php
	$page_ids = array();
	if ( absint(get_theme_mod( 'faith_featured_page_column_1', false )) != 0 ) { $page_ids[] = absint(get_theme_mod( 'faith_featured_page_column_1', false )); }
	if ( absint(get_theme_mod( 'faith_featured_page_column_2', false )) != 0 ) { $page_ids[] = absint(get_theme_mod( 'faith_featured_page_column_2', false )); }
	if ( absint(get_theme_mod( 'faith_featured_page_column_3', false )) != 0 ) { $page_ids[] = absint(get_theme_mod( 'faith_featured_page_column_3', false )); }
	if ( absint(get_theme_mod( 'faith_featured_page_column_4', false )) != 0 ) { $page_ids[] = absint(get_theme_mod( 'faith_featured_page_column_4', false )); }
	if ( absint(get_theme_mod( 'faith_featured_page_column_5', false )) != 0 ) { $page_ids[] = absint(get_theme_mod( 'faith_featured_page_column_5', false )); }
	$page_count = 0;
	$page_count = count($page_ids);
	
	if ( $page_count > 0 ) {
		$custom_loop = new WP_Query( array( 'post_type' => 'page', 'post__in' => $page_ids, 'orderby' => 'post__in', 'nopaging' => 1 ) );
		
		if ( $custom_loop->have_posts() ) : $i = 0; ?>

<div id="ilovewp-featured-pages">
	<div class="wrapper">
		<ul class="ilovewp-featured-pages ilovewp-featured-pages-<?php echo esc_attr($page_count); ?> clearfix">

			<?php while ( $custom_loop->have_posts() ) : $custom_loop->the_post(); $i++; ?><li class="ilovewp-featured-page ilovewp-featured-page-<?php echo esc_attr($i); ?>">
				<div class="ilovewp-post-wrapper">
					<?php if ( has_post_thumbnail() ) : ?>
					<div class="post-cover-wrapper">
						<div class="post-cover">
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
							<?php the_post_thumbnail('faith-normal-thumbnail'); ?>
							</a>
						</div><!-- .post-cover -->
					</div><!-- .post-cover-wrapper -->
					<?php endif; ?>
					<div class="post-preview">
						<div class="post-preview-wrapper">
							<?php the_title( sprintf( '<h2 class="title-post"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
							<?php if ( 1 == get_theme_mod( 'faith_front_featured_pages_columns_excerpt', 1 ) ) { ?>
							<p class="post-excerpt"><?php echo wp_kses_post(get_the_excerpt()); ?></p>
							<?php } ?>
						</div><!-- .post-preview-wrapper -->
					</div><!-- .post-preview -->
				</div><!-- .ilovewp-post-wrapper -->
			</li><!-- .ilovewp-featured-page .ilovewp-featured-page-<?php echo esc_attr($i); ?> --><?php endwhile; ?>

		</ul><!-- .ilovewp-featured-pages -->
	</div><!-- .wrapper -->

</div><!-- #ilovewp-featured-pages -->

<?php
		endif;
	}