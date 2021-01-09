<?php
/**
 * The template for displaying Comments.
 * @package HappenStance
 * @since HappenStance 1.0.0
*/
if ( post_password_required() )
	return;
?>

<div id="comments" class="comments-area<?php if ( get_theme_mod('happenstance_next_preview_post') == 'Display' && get_theme_mod('happenstance_display_related_posts') == 'Hide' && get_theme_mod('happenstance_display_related_posts') != '' ) { ?> comments-area-post<?php } ?><?php if ( get_theme_mod('happenstance_next_preview_post') == 'Hide' && get_theme_mod('happenstance_display_related_posts') == 'Hide' ) { ?> comments-area-post-hide<?php } ?>">

	<?php if ( have_comments() ) : ?>
    <h2 class="entry-headline"><?php printf( _n( '1 Comment', '%1$s Comments', get_comments_number(), 'happenstance' ), number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' ); ?></h2>

		<ol class="commentlist">
			<?php wp_list_comments( array( 'callback' => 'happenstance_comment', 'style' => 'ol' ) ); ?>
		</ol><!-- .commentlist -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
		<div id="comment-nav-below" class="navigation" role="navigation">
			<div class="nav-wrapper">
      <p class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'happenstance' ) ); ?> </p>
			<p class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'happenstance' ) ); ?></p>
      </div>
		</div>
		<?php endif; ?>

		<?php if ( ! comments_open() && get_comments_number() ) : ?>
		<p class="nocomments"><?php esc_html_e( 'Comments are closed.' , 'happenstance' ); ?></p>
		<?php endif; ?>

	<?php endif; ?>

	<?php $happenstance_placeholder_name = __( 'Your name' , 'happenstance' );
   $happenstance_placeholder_web = __( 'Website' , 'happenstance' );
   $happenstance_placeholder_comment = __( 'Comment...' , 'happenstance' );
   $happenstance_aria_req = ( $req ? " aria-required='true'" : '' );
   $happenstance_field_req = ( $req ? " *" : '' );
   $happenstance_comment_args = array(
'title_reply'=>__( 'Leave a Comment' , 'happenstance' ),
'fields' => apply_filters( 'comment_form_default_fields', array(
'author' => '<p class="comment-form-author">' . '<label for="author">' . __( '', 'happenstance' ) . '</label> ' . '<input id="author" name="author" type="text" placeholder="' . $happenstance_placeholder_name . $happenstance_field_req . '" value=""  size="30"' . $happenstance_aria_req . ' /></p>',   
'email'  => '<p class="comment-form-email">' .
'<label for="email">' . __( '', 'happenstance' ) . '</label> ' .
'<input id="email" name="email" type="text" placeholder="E-mail' . $happenstance_field_req .'" value="" size="30"' . $happenstance_aria_req . ' />'.'</p>',
'url'    => '<p class="comment-form-url">' .
'<label for="url">' . __( '', 'happenstance' ) . '</label> ' .
'<input id="url" name="url" type="text" placeholder="' . $happenstance_placeholder_web . '" value="" size="30" />'.'</p>' ) ),
'comment_field' => '<p>' .
'<label for="comment">' . __( '', 'happenstance' ) . '</label>' .
'<textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="' . $happenstance_placeholder_comment . '"></textarea>' .
'</p>',);
comment_form($happenstance_comment_args); ?>

</div><!-- #comments .comments-area -->