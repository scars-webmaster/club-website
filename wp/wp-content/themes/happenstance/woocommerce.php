<?php
/**
 * The template file for WooCommerce pages.
 * @package HappenStance
 * @since HappenStance 1.0.0
*/
get_header(); ?>
<?php happenstance_get_breadcrumb(); ?>
    <div class="content-headline">
      <h1 class="entry-headline"><span class="entry-headline-text"><?php if ( !is_product() ) { woocommerce_page_title(); } else { the_title(); } ?></span></h1>
    </div>
    <div class="entry-content">
<?php woocommerce_content(); ?>
    </div>   
  </div> <!-- end of content -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>