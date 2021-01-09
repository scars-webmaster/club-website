<?php
/**
 * Template Name: Logged In
 * The template file for displaying a page content only for logged in users. 
 * @package HappenStance
 * @since HappenStance 1.0.0
*/
get_header(); ?>
<?php if ( is_user_logged_in() ) { ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<?php happenstance_get_breadcrumb(); ?>
    <div class="content-headline">
      <h1 class="entry-headline"><span class="entry-headline-text"><?php the_title(); ?></span></h1>
    </div>
<?php happenstance_get_display_image_page(); ?>
    <div class="entry-content">
<?php the_content(); ?>
<?php wp_link_pages( array( 'before' => '<p class="page-link"><span>' . __( 'Pages:', 'happenstance' ) . '</span>', 'after' => '</p>' ) ); ?>
<?php edit_post_link( __( 'Edit', 'happenstance' ), '<p class="edit-link">', '</p>' ); ?>    
<?php endwhile; endif; ?>
<?php comments_template( '', true ); ?>
    </div> 
<?php } else { ?>
<?php happenstance_get_breadcrumb(); ?>
    <div class="content-headline">
      <h1 class="entry-headline"><span class="entry-headline-text"><?php the_title(); ?></span></h1>
    </div>
    <div class="entry-content">
      <p class="logged-in-message"><?php esc_html_e( 'You must be logged in to view this page.', 'happenstance' ); ?></p>
<?php wp_login_form(); ?>
    </div>
<?php } ?>  
  </div> <!-- end of content -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>