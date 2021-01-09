<?php
/**
 * The template used for displaying featured pages on the Front Page.
 *
 * @package EduPress
 */
?>

<?php
	$page_ids = array();
	$page_ids[] = absint(get_theme_mod( 'edupress_featured_page_1', false ));
	$page_ids[] = absint(get_theme_mod( 'edupress_featured_page_2', false ));
	$page_ids[] = absint(get_theme_mod( 'edupress_featured_page_3', false ));
	$page_ids[] = absint(get_theme_mod( 'edupress_featured_page_4', false ));
	
	$custom_loop = new WP_Query( array( 'post_type' => 'page', 'post__in' => $page_ids, 'orderby' => 'post__in' ) );
?>

<?php if ( $custom_loop->have_posts() ) : $i = 0; ?>

	<div id="ilovewp-featured-content" class="flexslider">
		<ul class="ilovewp-slides">
	
			<?php while ( $custom_loop->have_posts() ) : $custom_loop->the_post(); $i++; ?>

			<li class="ilovewp-slide">
				<div class="ilovewp-post-wrapper">
					<?php if ( has_post_thumbnail() ) { ?>
					<div class="image-wrapper">
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('edupress-large-thumbnail'); ?></a>
					</div><!-- .image-wrapper -->
					<?php } ?>
					<?php if ( 1 == get_theme_mod( 'edupress_front_featured_pages_title', 1 ) ) { ?>
					<div class="<?php if ( has_post_thumbnail() ) { echo 'post-preview'; } else { echo 'post-preview-nothumb'; } ?>">
						<div class="post-preview-wrapper">
							<?php the_title( sprintf( '<h2 class="title-post"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
							<p class="post-excerpt"><?php echo wp_kses_post(get_the_excerpt()); ?></p>
						</div><!-- .post-preview-wrapper -->
					</div><!-- .post-preview -->
					<?php } ?>
				</div><!-- .ilovewp-post-wrapper -->
			</li><!-- .ilovewp-slide -->

            <?php endwhile; ?>
	
		</ul><!-- .ilovewp-slides -->

	</div><!-- #ilovewp-featured-content .flexslider -->

	<div id="ilovewp-featured-tabs" class="flexslider">
		<ul class="ilovewp-tabs ilovewp-tabs-<?php echo esc_attr($i); ?> clearfix">
			<?php $i = 0; while ( $custom_loop->have_posts() ) : $custom_loop->the_post(); $i++; ?>
			<li class="ilovewp-tab ilovewp-tab-<?php echo esc_attr($i); ?>">
				<span class="image-description"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></span>
			</li><!-- .ilovewp-tab -->
			<?php endwhile; ?>
		</ul><!-- .ilovewp-tabs -->
	</div><!-- #ilovewp-featured-tabs .flexslider -->

<?php else : ?>

	 <?php if ( current_user_can( 'publish_posts' ) && is_customize_preview() ) : ?>

		<div id="ilovewp-featured-content">

			<div class="ilovewp-page-intro ilovewp-nofeatured">
				<h1 class="title-page"><?php esc_html_e( 'No Featured Pages Found', 'edupress' ); ?></h1>
				<div class="taxonomy-description">

					<p><?php printf( esc_html__( 'This section will display your featured pages. Configure (or disable) it via the Customizer.', 'edupress' ) ); ?></p>
					<p><strong><?php printf( esc_html__( 'Important: This message is NOT visible to site visitors, only to admins and editors.', 'edupress' ) ); ?></strong></p>

				</div><!-- .taxonomy-description -->
			</div><!-- .ilovewp-page-intro .ilovewp-nofeatured -->

		</div><!-- #ilovewp-featured-content -->

	<?php endif; ?>

<?php endif; ?>