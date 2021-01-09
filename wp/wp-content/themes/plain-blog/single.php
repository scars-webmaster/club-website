<?php
/**
 * This file handles how each individual post will look like.
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
    </div> <!--col-md-9 end-->
    <?php get_sidebar(); ?>
<?php
get_footer();