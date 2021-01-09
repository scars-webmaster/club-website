<?php
/**
 * The archive template file.
 * @package HappenStance
 * @since HappenStance 1.0.0
*/
get_header(); ?>
<?php if ( have_posts() ) : ?> 
<?php happenstance_get_breadcrumb(); ?>  
    <div class="content-headline">
      <h1 class="entry-headline"><span class="entry-headline-text"><?php if ( is_day() ) :
						printf( __( 'Daily Archive: %s', 'happenstance' ), '<span>' . get_the_date() . '</span>' );
					elseif ( is_month() ) :
						printf( __( 'Monthly Archive: %s', 'happenstance' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'happenstance' ) ) . '</span>' );
					elseif ( is_year() ) :
						printf( __( 'Yearly Archive: %s', 'happenstance' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'happenstance' ) ) . '</span>' );
					else :
						esc_html_e( 'Archive', 'happenstance' );
					endif ;?></span></h1>
    </div>
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