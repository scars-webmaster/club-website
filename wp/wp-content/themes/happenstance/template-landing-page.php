<?php
/**
 * Template Name: Landing Page
 * The template file for displaying a landing page without menus, sidebar and footer widget areas.
 * @package HappenStance
 * @since HappenStance 1.0.0
*/
get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<?php happenstance_get_display_image_page(); ?>
    <div class="content-headline">
      <h1 class="entry-headline"><span class="entry-headline-text"><?php the_title(); ?></span></h1>
    </div>
    <div class="entry-content">
<?php the_content(); ?>
<?php wp_link_pages( array( 'before' => '<p class="page-link"><span>' . __( 'Pages:', 'happenstance' ) . '</span>', 'after' => '</p>' ) ); ?>
<?php edit_post_link( __( 'Edit', 'happenstance' ), '<p class="edit-link">', '</p>' ); ?>
<?php endwhile; endif; ?>
    </div>   
  </div> <!-- end of content -->
<?php get_footer(); ?>