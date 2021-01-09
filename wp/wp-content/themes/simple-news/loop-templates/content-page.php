<?php
/**
 * Partial template for content in page.php
 *
 * @package SimpleNews
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class( 'mb-3 border-bottom' ); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">

		<?php the_title( '<h1 class="entry-title border-bottom mb-12px">', '</h1>' ); ?>

	</header>

	<?php echo get_the_post_thumbnail( $post->ID, 'full', array( 'class' => 'd-block mx-auto mb-3' ) ); ?>

	<div class="entry-content mb-3">

		<?php the_content(); ?>

		<div class="clearfix"></div>

		<?php
		wp_link_pages(
			array(
				'before' => '<div class="multipages mt-3 py-2 border-top border-bottom">' . __( 'Pages:', 'simple-news' ),
				'after' => '</div>'
			)
		);
		?>

	</div>

	<?php simplenews_edit_link(); ?>

</article>
