<?php
/**
 * Template to display single static page content
 */

/**
 * If viewing a single page (pages can occur in archive lists as well. Example: search results)
 */
if ( is_page() ) :
?>

	<article <?php hybridextend_attr( 'page' ); ?>>

		<div <?php hybridextend_attr( 'entry-content' ); ?>>

			<div class="entry-the-content">
				<?php the_content(); ?>
			</div>
			<?php wp_link_pages(); ?>

		</div><!-- .entry-content -->

		<div class="screen-reader-text" itemprop="datePublished" itemtype="https://schema.org/Date"><?php echo get_the_date('Y-m-d'); ?></div>

		<?php
		$hide_meta_info = apply_filters( 'hootubix_hide_meta_info', false, 'bottom' );
		if ( !$hide_meta_info && 'bottom' == hootubix_get_mod( 'post_meta_location' ) ):
			$metarray = hootubix_get_mod('page_meta');
			if ( hootubix_meta_info_display( $metarray, 'page', true ) ) :
			?>
			<footer class="entry-footer">
				<?php hootubix_meta_info_blocks( $metarray, 'page' ); ?>
			</footer><!-- .entry-footer -->
			<?php
			endif;
		endif;
		?>

	</article><!-- .entry -->

<?php
/**
 * If not viewing a single page i.e. viewing the page in a list index (Example: search results)
 */
else :

	if ( ! apply_filters( 'hootubix_searchresults_hide_pages', false ) ) {

		$archive_type = apply_filters( 'hootubix_default_archive_type', 'big', 'content-page' );
		$archive_template = apply_filters( 'hootubix_default_archive_location', 'template-parts/content-archive', $archive_type, 'content-page' );

		// Loads the template-parts/content-archive-{type}.php template.
		get_template_part( $archive_template, $archive_type );

	}

endif;
?>