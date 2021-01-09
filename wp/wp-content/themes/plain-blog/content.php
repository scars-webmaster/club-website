<?php
/**
 * This file is responsible for the post's rendering on the pages.
 */
 
 if(is_page()): 
 		$content_md = "col-md-12"; 
	else: 
		$content_md = "col-md-11"; 
	endif; 

?>
 
<div class="content">
<?php
if(!is_page()) {
?>
    <div class="col-md-1 no-padding date-wrapper">
        <div class="date"><?php the_time("d\nM"); ?></div>
    </div>
<?php
}
?>
<div class="<?php echo $content_md; ?> no-padding">
    <div class="post_block" <?php post_class(); ?>>
        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
        <div class="content_wrap">
            <?php
            if(!is_page()) {
            ?>
            <div class="categories_row">
                <ul>
                    <li><i class="fa fa-user"></i> <?php the_author_posts_link(); ?></li>
                    <?php if(is_single()) {?> <li><i class="fa fa-clock-o"></i> <a href="<?php the_permalink(); ?>"><?php the_date(); ?></a></li> <?php }  ?>
                    <li><a href="<?php comments_link(); ?>"> <i
                 	   class="fa fa-comments"></i> <?php comments_number(__('0 comments', 'plain-blog'), __('1 comment', 'plain-blog'), __('% comments', 'plain-blog')); ?>
                    </a></li>
                    <li><i class="fa fa-bookmark"></i> <?php the_category(', '); ?></li>
                   <?php if(get_the_tags()) : ?> <li><i class="fa fa-tags"></i> <?php the_tags( ' ',', ',' '); ?></li> <?php endif;?>
                 </ul>
                <div class="clearfix"></div>
            </div>
            <?php
           	 }
            ?>
            
            <?php 
                if(is_single()  || is_singular()) {?>
						 <h1 class="single-title"><?php the_title(); ?></h1>
				<?php
				}
				else{
				?>
                 <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <?php } ?>
           	
            <div class="entry-content">
            			
               <?php if ( is_category() || is_archive() ) {
					the_excerpt();
				} else {
					the_content();
				} ?>
            </div>
             
            <?php wp_link_pages('before=<div id="page-links">&after=</div>'); ?>
        </div>
    </div>
    <?php
    if(is_single()) {
        comments_template();
        comment_form();
    }
    ?>
</div>

</div><!-- Content -->