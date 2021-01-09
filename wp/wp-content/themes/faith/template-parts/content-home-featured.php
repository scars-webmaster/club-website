<?php
/**
 * The template used for displaying featured pages on the Front Page.
 *
 * @package Faith
 */
?>

<?php
	$page_ids = array();
	if ( absint(get_theme_mod( 'faith_featured_page_1', false )) != 0 ) { $page_ids[] = absint(get_theme_mod( 'faith_featured_page_1', false )); }
	if ( absint(get_theme_mod( 'faith_featured_page_2', false )) != 0 ) { $page_ids[] = absint(get_theme_mod( 'faith_featured_page_2', false )); }
	if ( absint(get_theme_mod( 'faith_featured_page_3', false )) != 0 ) { $page_ids[] = absint(get_theme_mod( 'faith_featured_page_3', false )); }
	if ( absint(get_theme_mod( 'faith_featured_page_4', false )) != 0 ) { $page_ids[] = absint(get_theme_mod( 'faith_featured_page_4', false )); }
	if ( absint(get_theme_mod( 'faith_featured_page_5', false )) != 0 ) { $page_ids[] = absint(get_theme_mod( 'faith_featured_page_5', false )); }
	$page_count = 0;
	$page_count = count($page_ids);
	
	if ( $page_count > 0 ) {
		$custom_loop = new WP_Query( array( 'post_type' => 'page', 'post__in' => $page_ids, 'orderby' => 'post__in' ) );

		if ( $custom_loop->have_posts() ) : ?>

		<div id="ilovewp-hero" class="ilovewp-hero-withimage flexslider">
			<ul class="ilovewp-slides ilovewp-slideshow">
				<?php 
				while ( $custom_loop->have_posts() ) : $custom_loop->the_post();
				if ( has_post_thumbnail() ) {
					$large_image_url = wp_get_attachment_image_url( get_post_thumbnail_id(), 'faith-large-thumbnail' );
				}
				?>
				<li class="ilovewp-slide">
					<div class="ilovewp-hero-wrapper"<?php if ( isset($large_image_url) ) { echo ' style="background-image: url( ' . esc_url($large_image_url) . ');"'; } ?>>
						<div class="wrapper">
							<div class="content-wrapper">
								<div class="content-aligner">
									<?php the_title( sprintf( '<h1 class="hero-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
									<p class="hero-description"><?php echo wp_kses_post(get_the_excerpt()); ?></p>
									<span class="hero-button-span"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="hero-button-anchor"><?php _e('Read More','faith'); ?></a></span>
								</div><!-- .content-aligner -->
							</div><!-- .content-wrapper -->
						</div><!-- .wrapper -->
					</div><!-- .ilovewp-hero-wrapper -->
				</li><!-- .ilovewp-slide -->
				<?php 
				if ( isset($large_image_url) ) { unset($large_image_url); }
				endwhile; 
				global $ilovewp_has_slideshow;
				$ilovewp_has_slideshow = TRUE;
				?>
			</ul><!-- .ilovewp-slideshow -->
		</div><!-- #ilovewp-hero -->

<?php else : ?>

	 <?php if ( current_user_can( 'publish_posts' ) && is_customize_preview() ) : ?>

		<div id="ilovewp-featured-content">

			<div class="ilovewp-page-intro ilovewp-nofeatured">
				<h1 class="title-page"><?php esc_html_e( 'No Featured Pages Found', 'faith' ); ?></h1>
				<div class="taxonomy-description">

					<p><?php printf( esc_html__( 'This section will display your featured pages. Configure (or disable) it via the Customizer.', 'faith' ) ); ?></p>
					<p><strong><?php printf( esc_html__( 'Important: This message is NOT visible to site visitors, only to admins and editors.', 'faith' ) ); ?></strong></p>

				</div><!-- .taxonomy-description -->
			</div><!-- .ilovewp-page-intro .ilovewp-nofeatured -->

		</div><!-- #ilovewp-featured-content -->

	<?php endif; ?>

<?php
		endif;
	}