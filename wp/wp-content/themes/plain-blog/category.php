<?php
/**
 * This file handles how categories will look like.
 */
get_header();
?>
    <!--col-md-9 start-->
    <div class="col-md-9">
       
       	<header class="page-title">
            <h1><?php printf( __( 'Category Archives: %s', 'plain-blog' ), single_cat_title( '', false ) ); ?></h1>
            <?php echo category_description(); ?>
        </header>
       
       <?php
        if(have_posts()) {
            while(have_posts()) {
                the_post();
                get_template_part('content');
            }
        }
        ?>
		<div class="clearboth"></div>
        <!--pagination start-->
        <?php plain_blog_numeric_posts_nav(); ?>
        <!--pagination end-->
    </div> <!--col-md-9 end-->

<?php get_sidebar(); ?>
<?php
get_footer();