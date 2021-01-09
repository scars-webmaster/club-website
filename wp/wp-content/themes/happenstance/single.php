<?php
/**
 * The post template file.
 * @package HappenStance
 * @since HappenStance 1.0.0
*/
get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<?php if ( !has_post_format('aside') ) { ?>
<?php happenstance_get_breadcrumb(); ?>
    <div class="content-headline">   
      <h1 class="entry-headline title single-title entry-title"><span class="entry-headline-text"><?php the_title(); ?></span></h1>
    </div>
<?php } ?>
<?php happenstance_get_display_image_post(); ?>
<?php if ( get_theme_mod('happenstance_display_meta_post') != 'Hide' ) { ?>
    <p class="post-meta">
      <span class="post-info-author vcard author"><i class="icon_pencil-edit" aria-hidden="true"></i><span class="fn"><?php the_author_posts_link(); ?></span></span>
      <span class="post-info-date post_date date updated"><i class="icon_calendar" aria-hidden="true"></i><?php echo get_the_date(); ?></span>
<?php if ( comments_open() ) : ?>
      <span class="post-info-comments"><i class="icon_comment_alt" aria-hidden="true"></i><a href="<?php comments_link(); ?>"><?php printf( _n( '1 Comment', '%1$s Comments', get_comments_number(), 'happenstance' ), number_format_i18n( get_comments_number() ), get_the_title() ); ?></a></span>
<?php endif; ?>
    </p>
    <div class="post-info">
      <p class="post-category"><span class="post-info-category"><i class="icon_folder-alt" aria-hidden="true"></i><?php the_category(', '); ?></span></p>
<?php if ( has_tag() ) { ?>
      <p class="post-tags"><?php the_tags( '<span class="post-info-tags"><i class="icon_tag_alt" aria-hidden="true"></i>', ', ', '</span>' ); ?></p>
<?php } ?>
    </div>
<?php } ?>
    <div class="entry-content">
<?php if ( $post->post_excerpt && get_theme_mod('happenstance_display_excerpt_post') != 'Hide' ) { ?>
<p class="manual-excerpt"><?php echo esc_html($post->post_excerpt); ?></p>
<?php } ?>
<?php the_content(); ?>
<?php wp_link_pages( array( 'before' => '<p class="page-link"><span>' . __( 'Pages:', 'happenstance' ) . '</span>', 'after' => '</p>', 'link_before' => '<span class="link-before">', 'link_after' => '</span>' ) ); ?>
<?php edit_post_link( __( 'Edit', 'happenstance' ), '<p class="edit-link">', '</p>' ); ?>
<?php endwhile; endif; ?>
<?php if ( get_theme_mod('happenstance_next_preview_post') != 'Hide' ) { ?>
<?php happenstance_prev_next('happenstance-post-nav'); ?>
<?php } ?>
<?php if ( get_theme_mod('happenstance_display_related_posts') != 'Hide' ) { ?>
<?php $orig_post = $post;
global $post;
$categories = get_the_category($post->ID);
if ($categories) {
$category_ids = array();
foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
$args=array(
'category__in' => $category_ids,
'post__not_in' => array($post->ID),
'posts_per_page' => get_theme_mod('happenstance_related_posts_number', '6'),
'ignore_sticky_posts' => true );
$my_query = new wp_query( $args );
if( $my_query->have_posts() ) { ?>
<div class="wrapper-related-posts">
      <h2 class="entry-headline"><?php echo esc_html(get_theme_mod('happenstance_related_posts_headline', __( 'Related Posts' , 'happenstance' ))); ?></h2>  
      <div <?php if ( get_theme_mod('happenstance_related_posts_format') != 'Unordered List' ) { ?>class="flexslider"<?php } ?>>      
        <ul <?php if ( get_theme_mod('happenstance_related_posts_format') != 'Unordered List' ) { ?>class="slides"<?php } else { ?>class="unordered-list"<?php } ?>>
<?php while( $my_query->have_posts() ) {
$my_query->the_post();?>
	       <li><?php if ( get_theme_mod('happenstance_related_posts_format') != 'Unordered List' ) { ?><a title="<?php the_title(); ?>" href="<?php echo get_permalink(); ?>"><?php if ( has_post_thumbnail() ) { ?><?php the_post_thumbnail( 'thumbnail' ); ?><?php } else { ?><img class="attachment-slider-thumb wp-post-image" src="<?php echo get_template_directory_uri(); ?>/images/slide.jpg" alt="<?php the_title(); ?>" /><?php } ?></a><?php } ?><a <?php if ( get_theme_mod('happenstance_related_posts_format') != 'Unordered List' ) { ?>class="slider-link" title="<?php the_title(); ?>"<?php } ?> href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></li>
<?php } ?>
        </ul>
      </div>
</div>
<?php }
}
$post = $orig_post;
wp_reset_query(); ?>
<?php } ?>
<?php comments_template( '', true ); ?>
    </div>   
  </div> <!-- end of content -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>