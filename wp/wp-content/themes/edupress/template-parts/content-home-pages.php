<?php
/**
 * The template used for displaying featured pages on the Front Page.
 *
 * @package EduPress
 */
?>

<?php
	$page_ids = array();
	$page_ids[] = absint(get_theme_mod( 'edupress_featured_page_column_1', false ));
	$page_ids[] = absint(get_theme_mod( 'edupress_featured_page_column_2', false ));
	$page_ids[] = absint(get_theme_mod( 'edupress_featured_page_column_3', false ));
	
	$custom_loop = new WP_Query( array( 'post_type' => 'page', 'post__in' => $page_ids, 'orderby' => 'post__in' ) );
?>

<?php if ( $custom_loop->have_posts() ) : $i = 0; ?>

	<div id="ilovewp-featured-pages">
		<ul class="ilovewp-featured-pages clearfix">
	
			<?php while ( $custom_loop->have_posts() ) : $custom_loop->the_post(); $i++; ?>

			<li class="ilovewp-featured-page ilovewp-featured-page-<?php echo esc_attr($i); ?>">
				<div class="ilovewp-post-wrapper">
					<?php if ( has_post_thumbnail() ) : ?>
					<div class="post-cover-wrapper">
						<div class="post-cover">
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
							<?php the_post_thumbnail(); ?>
							</a>
						</div><!-- .post-cover -->
					</div><!-- .post-cover-wrapper -->
					<?php endif; ?>
					<div class="post-preview">
						<div class="post-preview-wrapper">
							<?php the_title( sprintf( '<h2 class="title-post"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
							<?php if ( 1 == get_theme_mod( 'edupress_front_featured_pages_columns_excerpt', 1 ) ) { ?>
							<p class="post-excerpt"><?php echo wp_kses_post(get_the_excerpt()); ?></p>
							<?php } ?>
						</div><!-- .post-preview-wrapper -->
					</div><!-- .post-preview -->
				</div><!-- .ilovewp-post-wrapper -->
			</li><!-- .ilovewp-featured-page .ilovewp-featured-page-<?php echo esc_attr($i); ?> -->

            <?php endwhile; ?>
	
		</ul><!-- .ilovewp-featured-pages -->

	</div><!-- #ilovewp-featured-pages -->

<?php endif; ?>