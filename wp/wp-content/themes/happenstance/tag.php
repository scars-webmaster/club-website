<?php
/**
 * The tag archive template file.
 * @package HappenStance
 * @since HappenStance 1.0.0
*/
get_header(); ?>
<?php if ( have_posts() ) : ?>   
<?php happenstance_get_breadcrumb(); ?>
    <div class="content-headline">
      <h1 class="entry-headline"><span class="entry-headline-text"><?php printf( __( 'Tag Archive: %s', 'happenstance' ), '<span>' . single_tag_title( '', false ) . '</span>' ); ?></span></h1>
    </div>
<?php if ( tag_description() ) : ?>
    <div class="archive-meta"><?php echo tag_description(); ?></div>
<?php endif; ?>
    <div<?php if (get_theme_mod('happenstance_post_entry_format') == 'Grid - Masonry') { ?> class="js-masonry"<?php } ?>>
<?php while (have_posts()) : the_post(); ?>
<?php if (get_theme_mod('happenstance_post_entry_format') == 'Grid - Masonry') {
get_template_part( 'content', 'grid' ); } else {
get_template_part( 'content', 'archives' ); } ?>
<?php endwhile; ?>
    </div> 
<?php endif; ?> 
<?php happenstance_content_nav( 'nav-below' ); ?>  
  </div> <!-- end of content -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>