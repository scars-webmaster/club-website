<?php
/**
 * The search results template file.
 * @package HappenStance
 * @since HappenStance 1.0.0
*/
get_header(); ?>
<?php if ( have_posts() ) : ?> 
<?php happenstance_get_breadcrumb(); ?>  
    <div class="content-headline">
      <h1 class="entry-headline"><span class="entry-headline-text"><?php printf( __( 'Search Results for: %s', 'happenstance' ), '<span>' . get_search_query() . '</span>' ); ?></span></h1>
    </div>
    <div class="archive-meta"><p class="number-of-results"><?php esc_html_e( 'Number of Results: ', 'happenstance' ); ?><?php echo $wp_query->found_posts; ?></p></div>
    <div<?php if (get_theme_mod('happenstance_post_entry_format') == 'Grid - Masonry') { ?> class="js-masonry"<?php } ?>>
<?php while (have_posts()) : the_post(); ?>
<?php if (get_theme_mod('happenstance_post_entry_format') == 'Grid - Masonry') {
get_template_part( 'content', 'grid' ); } else {
get_template_part( 'content', 'archives' ); } ?>
<?php endwhile; ?>
    </div> 

<?php if ( $wp_query->max_num_pages > 1 ) : ?>
		<div class="navigation" role="navigation">
			<h2 class="navigation-headline section-heading"><?php esc_html_e( 'Search results navigation', 'happenstance' ); ?></h2>
      <div class="nav-wrapper">
			 <p class="navigation-links">
<?php $happenstance_big = 999999999;
echo paginate_links( array(
	'format' => '?paged=%#%',
	'current' => max( 1, get_query_var('paged') ),
  'prev_text' => __( '&larr; Previous', 'happenstance' ),
	'next_text' => __( 'Next &rarr;', 'happenstance' ),
	'total' => $wp_query->max_num_pages,
	'add_args' => false
) );
?>
        </p>
      </div>
    </div>
<?php endif; ?>

<?php else : ?>
<?php happenstance_get_breadcrumb(); ?>
    <div class="content-headline">
      <h1 class="entry-headline"><span class="entry-headline-text"><?php esc_html_e( 'Nothing Found', 'happenstance' ); ?></span></h1>
    </div>
    <p><?php esc_html_e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'happenstance' ); ?></p>
<?php get_search_form(); ?>
<?php endif; ?>  
  </div> <!-- end of content -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>