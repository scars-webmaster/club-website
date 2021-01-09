<article <?php hybridextend_attr( 'post' ); ?>>

	<?php if ( apply_filters ( 'hootubix_display_404_content_title', true ) ) : ?>
		<header class="entry-header">
			<?php
			global $hootubix_theme;
			$tag = ( !empty( $hootubix_theme->loop_meta_displayed ) ) ? 'h2' : 'h1';
			echo "<{$tag} class='entry-title'>" . __( 'Nothing found', 'hoot-ubix' ) . "</{$tag}>";
			?>
		</header><!-- .entry-header -->
	<?php endif; ?>

	<div <?php hybridextend_attr( 'entry-content', '', 'no-shadow' ); ?>>
		<div class="entry-the-content">
			<?php do_action( 'hootubix_404_content' ); ?>
		</div>
	</div><!-- .entry-content -->

</article><!-- .entry -->