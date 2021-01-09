<?php
/**
 * This file handles how search results will look like.
 */
get_header();
?>
    <!--col-md-9 start-->
    <div class="col-md-9">
    	 <div class="post_block" <?php post_class(); ?>>
			<header class="page-title nothing-found">
				<h1><?php _e( '404. Nothing here', 'plain-blog' ); ?></h1>
           </header>
          <div class="content_wrap">
          	<?php echo get_search_form(); ?>
          </div> 
       </div>
	</div> <!--col-md-9 end-->

<?php get_sidebar(); ?>
<?php
get_footer();