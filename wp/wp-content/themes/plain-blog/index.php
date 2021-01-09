<?php
/**
 * This is the index file handling the view of the homepage of the blog.
 */
get_header();
?>
    <!--col-md-9 start-->
    <div class="col-md-9">
        <?php
        if(have_posts()) {
            while(have_posts()) {
                the_post();
                get_template_part('content');
            }
        }
        ?>
	    <!--pagination start-->
        <?php plain_blog_numeric_posts_nav(); ?>
        <!--pagination end-->
    </div> <!--col-md-9 end-->

    <?php get_sidebar(); ?>
<?php
get_footer();