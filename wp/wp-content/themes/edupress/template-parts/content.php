<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package EduPress
 */

?>

<?php global $edupress_i; $edupress_i++; ?>

<?php $classes = array('ilovewp-post','ilovewp-post-archive','ilovewp-post-'.$edupress_i, 'clearfix'); ?>

<li <?php post_class($classes); ?>>

	<article id="post-<?php the_ID(); ?>">
	
		<?php if ( has_post_thumbnail() ) : ?>
		<div class="post-cover-wrapper">
			<div class="post-cover">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
				<?php the_post_thumbnail(); ?>
				</a>
			</div><!-- .post-cover -->
		</div><!-- .post-cover-wrapper -->
		<?php endif; ?>
	
		<div class="post-preview">
			<?php the_title( sprintf( '<h2 class="title-post"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
			<p class="post-excerpt"><?php echo wp_kses_post(get_the_excerpt()); ?></p>
			<p class="post-meta">
				<span class="posted-by"><?php esc_html_e('By','edupress'); ?> <?php echo esc_url( the_author_posts_link() ); ?></span>
				<span class="posted-on"><?php esc_html_e('Published','edupress'); ?> <time class="entry-date published" datetime="<?php echo get_the_date('c'); ?>"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo get_the_date(); ?></a></time></span>
				<span class="post-meta-category"><?php the_category(esc_html_x( ', ', 'Used on archive and post pages to separate multiple categories.', 'edupress' )); ?></span>
				<?php if ( function_exists('the_views') ) { echo '<span class="post-views"><span class="genericon genericon-show"></span> '; the_views(); echo '</span>'; } ?>
			</p><!-- .post-meta -->
		</div><!-- .post-preview -->
	
	</article><!-- #post-<?php the_ID(); ?> -->

</li><!-- .ilovewp-post .ilovewp-post-archive .clearfix -->

<?php if ( $edupress_i == 2) { $edupress_i = 0; } ?>