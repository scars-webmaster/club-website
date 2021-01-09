<?php
/**
 * Post rendering content according to caller of get_template_part.
 *
 * @package SimpleNews
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class('card rounded-0 border-top-0 border-left-0 border-right-0 pb-3'); ?> id="post-<?php the_ID(); ?>">

	<?php if ( has_post_thumbnail() ) { ?>
		<div class="text-center pt-1 mb-3">
		<a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail(); ?></a>
		</div>
	<?php } ?>

	<header class="entry-header">

	<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),'</a></h2>' ); ?>

	<?php if ( 'post' === get_post_type() ) : ?>
	<div class="entry-meta small mb-2">
		<?php simplenews_posted_on(); ?>
	</div>
	<?php endif; ?>

	</header>

	<div class="entry-content">
		<?php the_excerpt(); ?>
	</div>

	<footer class="entry-footer small">
		<?php simplenews_entry_footer(); ?>
	</footer>

</article>
