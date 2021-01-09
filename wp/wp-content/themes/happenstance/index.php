<?php
/**
 * The main template file.
 * @package HappenStance
 * @since HappenStance 1.0.0
*/
get_header(); ?> 
<?php if ( is_active_sidebar( 'sidebar-6' ) ) { ?>
  <div class="widgets-blog">
<?php dynamic_sidebar( 'sidebar-6' ); ?>
  </div>
<?php } ?>
<?php if (get_theme_mod('happenstance_latest_posts_headline', __( 'Latest Posts' , 'happenstance' )) != '') { ?>
<h1 class="entry-headline"><span class="entry-headline-text"><?php echo esc_html(get_theme_mod('happenstance_latest_posts_headline', __( 'Latest Posts' , 'happenstance' ))); ?></span></h1> 
<?php } ?>
    <div class="home-latest-posts<?php if (get_theme_mod('happenstance_post_entry_format') == 'Grid - Masonry') { ?> js-masonry<?php } ?>">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<?php if (get_theme_mod('happenstance_post_entry_format') == 'Grid - Masonry') {
get_template_part( 'content', 'grid' ); } else {
get_template_part( 'content', 'archives' ); } ?>
<?php endwhile; endif; ?>
   </div>   
<?php happenstance_content_nav( 'nav-below' ); ?>
  </div> <!-- end of content -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>