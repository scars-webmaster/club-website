<?php
/**
 * The author archive template file.
 * @package HappenStance
 * @since HappenStance 1.0.0
*/
get_header(); ?>
<?php if ( have_posts() ) : ?>
<?php the_post(); ?>   
<?php happenstance_get_breadcrumb(); ?>
    <div class="content-headline">
      <h1 class="entry-headline"><span class="entry-headline-text"><?php printf( __( 'Author Archive: %s', 'happenstance' ), '<span class="vcard">' . get_the_author() . '</span>' ); ?></span></h1>
    </div>
<?php rewind_posts(); ?>
<?php if ( get_the_author_meta( 'description' ) ) : ?>
    <div class="archive-meta">
      <div class="author-info">
		    <div class="author-description">
          <div class="author-avatar">
<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'happenstance_author_bio_avatar_size', 60 ) ); ?>
		      </div>
			    <p><?php the_author_meta( 'description' ); ?></p>
		    </div>
		  </div>
    </div>
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