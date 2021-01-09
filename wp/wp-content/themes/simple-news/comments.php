<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package SimpleNews
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div class="comments-area" id="comments">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>

		<h2 class="comments-title">

			<?php
			$comments_number = get_comments_number();
			if ( 1 === (int) $comments_number ) {
				printf(
					/* translators: %s: post title */
					esc_html_x( 'One thought on &ldquo;%s&rdquo;', 'comments title', 'simple-news' ),
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			} else {
				printf( // phpcs:ignore Standard.Category.SniffName.ErrorCode
					/* translators: 1: number of comments, 2: post title */
					esc_html( _nx(
						'%1$s thought on &ldquo;%2$s&rdquo;',
						'%1$s thoughts on &ldquo;%2$s&rdquo;',
						$comments_number,
						'comments title',
						'simple-news'
					) ),
					number_format_i18n( $comments_number ),// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			}
			?>

		</h2><!-- .comments-title -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through. ?>

			<nav class="nav border-top border-bottom comment-navigation py-2 mb-3" id="comment-nav-above">

				<h2 class="sr-only"><?php esc_html_e( 'Comment navigation', 'simple-news' ); ?></h2>

				<?php if ( get_previous_comments_link() ) { ?>
					<span class="nav-item nav-previous">
						<i class="fa fa-angle-double-left" aria-hidden="true"></i> <?php previous_comments_link( __( 'Older Comments', 'simple-news' ) ); ?>
					</span>
				<?php } ?>

				<?php if ( get_next_comments_link() ) { ?>
					<span class="nav-item nav-next ml-auto">
						<?php next_comments_link( __( 'Newer Comments', 'simple-news' ) ); ?> <i class="fa fa-angle-double-right" aria-hidden="true"></i>
					</span>
				<?php } ?>

			</nav><!-- #comment-nav-above -->

		<?php endif; // check for comment navigation. ?>

		<ol class="comment-list">

			<?php
			wp_list_comments(
				array(
					'style'			=> 'ol',
					'short_ping'	=> true,
					'reply_text'	=> '<i class="fa fa-comments-o" aria-hidden="true"></i> Reply',
				)
			);
			?>

		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through. ?>

			<nav class="nav border-top border-bottom comment-navigation py-2 mb-3" id="comment-nav-below">

				<h2 class="sr-only"><?php esc_html_e( 'Comment navigation', 'simple-news' ); ?></h2>

				<?php if ( get_previous_comments_link() ) { ?>
					<span class="nav-item nav-previous">
						<i class="fa fa-angle-double-left" aria-hidden="true"></i> <?php previous_comments_link( __( 'Older Comments', 'simple-news' ) ); ?>
					</span>
				<?php } ?>

				<?php if ( get_next_comments_link() ) { ?>
					<span class="nav-item nav-next ml-auto">
						<?php next_comments_link( __( 'Newer Comments', 'simple-news' ) ); ?> <i class="fa fa-angle-double-right" aria-hidden="true"></i>
					</span>
				<?php } ?>

			</nav><!-- #comment-nav-below -->

		<?php endif; // check for comment navigation. ?>

	<?php endif; // endif have_comments(). ?>

	<?php
	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
		?>

		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'simple-news' ); ?></p>

	<?php endif; ?>

	<?php comment_form(); // Render comments form. ?>

</div><!-- #comments -->
