<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Faith
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="ilovewp-page-intro ilovewp-page-inner">
		<h1 class="title-page"><?php the_title(); ?></h1>
		<?php if ( 1 == get_theme_mod( 'faith_single_gravatar', 1 ) ) { ?><span class="post-meta-gravatar"><?php echo get_avatar( get_the_author_meta( 'ID' ), '60' ); ?></span><?php } ?>

		<?php if ( is_single() && get_post_type() == 'post' ) { ?>
		<p class="post-meta">
			<span class="posted-on"><time class="entry-date published" datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date(); ?></time></span>
			<span class="post-meta-category"><?php the_category(esc_html_x( ', ', 'Used on archive and post pages to separate multiple categories.', 'faith' )); ?></span>
			<?php if ( function_exists('the_views') ) { echo '<span class="post-views"><span class="genericon genericon-show"></span> '; the_views(); echo '</span>'; } ?>
		</p><!-- .post-meta --><?php } ?>

	</header><!-- .ilovewp-page-intro -->

	<div class="post-single clearfix">

		<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'faith' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );
		?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'faith' ),
				'after'  => '</div>',
			) );
		?>

		<?php
		$tags_list = get_the_tag_list( '', esc_html__( '&nbsp;', 'faith' ) );
		if ( $tags_list ) {
			/* translators: %s: list of tags */
			printf( '<p class="tags-links">' . esc_html__( 'Tags: %1$s', 'faith' ) . '</p>', $tags_list );
		}
		?>

	</div><!-- .post-single -->

</article><!-- #post-<?php the_ID(); ?> -->