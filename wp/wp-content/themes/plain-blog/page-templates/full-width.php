<?php
/**
 *  Template Name: Full Width
 */
get_header();
?>
<div class="col-md-12 no-padding">
    <div class="post_block" <?php post_class(); ?>>
        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
        <div class="content_wrap">
		 <header class="single-title">
         	<h1><?php the_title(); ?></h1>
         </header>
         <br />
         <br />

             <?php
			if(have_posts()) {
				while(have_posts()) {
					the_post();
					the_content();
				}
			}
		?>
      </div>
    </div>
    <?php
    if(is_single()) {
        comments_template();
        comment_form();
    }
    ?>
</div>
<?php
get_footer();