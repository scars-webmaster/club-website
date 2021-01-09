<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package EduPress
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="ilovewp-page-intro ilovewp-page-inner">
		<h1 class="title-page"><?php the_title(); ?></h1>
		<?php if ( 1 == get_theme_mod( 'edupress_single_gravatar', 1 ) ) { ?><span class="post-meta-gravatar"><?php echo get_avatar( get_the_author_meta( 'ID' ), '60' ); ?></span><?php } ?>

		<p class="post-meta">
			<?php if ( 1 == get_theme_mod( 'edupress_single_author', 1 ) ) { ?><span class="posted-by"><?php esc_html_e('By','edupress'); ?> <?php echo esc_url( the_author_posts_link() ); ?></span><?php } ?>
			<?php if ( 1 == get_theme_mod( 'edupress_single_date', 1 ) ) { ?><span class="posted-on"><?php esc_html_e('Published','edupress'); ?> <time class="entry-date published" datetime="<?php echo get_the_date('c'); ?>"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo get_the_date(); ?></a></time></span><?php } ?>
			<?php if ( 1 == get_theme_mod( 'edupress_single_category', 1 ) ) { ?><span class="post-meta-category"><?php the_category(esc_html_x( ', ', 'Used on archive and post pages to separate multiple categories.', 'edupress' )); ?></span><?php } ?>
		</p><!-- .post-meta -->

	</header><!-- .ilovewp-page-intro -->

	<div class="post-single clearfix">

		<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'edupress' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );
		?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'edupress' ),
				'after'  => '</div>',
			) );
		?>

		<?php
		$tags_list = get_the_tag_list( '', esc_html__( '&nbsp;', 'edupress' ) );
		if ( $tags_list ) {
			/* translators: %s: list of tags */
			printf( '<p class="tags-links">' . esc_html__( 'Tags: %1$s', 'edupress' ) . '</p>', $tags_list ); // WPCS: XSS OK.
		}
		?>

	</div><!-- .post-single -->

</article><!-- #post-<?php the_ID(); ?> -->