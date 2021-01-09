<?php
/**
 * This file handles how search results will look like.
 */
get_header();
?>
    <!--col-md-9 start-->
    <div class="col-md-9">
    
    	<header class="page-title nothing-found">
			<h1><?php printf( __( 'Search Results for: %s', 'plain-blog' ), get_search_query() ); ?></h1>
        </header>    
        <?php
        if(have_posts()) {
            while(have_posts()) {
                the_post();
                get_template_part('content');
            }
        }
	   else{
	    ?>
		 <div class="post_block" <?php post_class(); ?>>
         	<div class="content_wrap">	<h2><?php printf( __( 'Nothing Found for : %s', 'plain-blog' ), get_search_query() ); ?></h2>
            <br/>
            <br/>
            <?php echo get_search_form(); ?>	
         </div>
		</div>
		<?php }?>
        
        
        <!--pagination start-->
        <?php plain_blog_numeric_posts_nav(); ?>
        <!--pagination end-->
    </div> <!--col-md-9 end-->

<?php get_sidebar(); ?>
<?php
get_footer();