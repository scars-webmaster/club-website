<?php
/**
 * Template Name: Full Width without Title
 * The template file for full-width pages without the page title.
 * @package HappenStance
 * @since HappenStance 1.0.0
*/
get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<?php if (function_exists( 'bcn_display' ) && !is_front_page()) {
happenstance_get_breadcrumb();
} ?>
<?php happenstance_get_display_image_page(); ?>
    <div class="entry-content">
<?php the_content(); ?>
<?php wp_link_pages( array( 'before' => '<p class="page-link"><span>' . __( 'Pages:', 'happenstance' ) . '</span>', 'after' => '</p>' ) ); ?>
<?php edit_post_link( __( 'Edit', 'happenstance' ), '<p class="edit-link">', '</p>' ); ?>
<?php endwhile; endif; ?>
<?php comments_template( '', true ); ?>
    </div>   
  </div> <!-- end of content -->
<?php get_footer(); ?>