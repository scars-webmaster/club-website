<?php
/**
 * The 404 page (Not Found) template file.
 * @package HappenStance
 * @since HappenStance 1.0.0
*/
get_header(); ?>
<?php happenstance_get_breadcrumb(); ?>
    <div class="content-headline">
      <h1 class="entry-headline"><span class="entry-headline-text"><?php esc_html_e( 'Nothing Found', 'happenstance' ); ?></span></h1>
    </div>
    <div class="entry-content">
<p><?php esc_html_e( 'Apologies, but no results were found for your request. Perhaps searching will help you to find a related content.', 'happenstance' ); ?></p>
<?php get_search_form(); ?>
    </div>   
  </div> <!-- end of content -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>