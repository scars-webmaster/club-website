<?php
// Get border classes
$top_class = hootubix_widget_border_class( $border, 0, 'topborder-');
$bottom_class = hootubix_widget_border_class( $border, 1, 'bottomborder-');

// Link Text
$button_text = ( !empty( $button_text ) ) ? $button_text : hootubix_get_mod('read_more');
$button_text = ( empty( $button_text ) ) ? sprintf( __( 'Read More %s', 'hoot-ubix' ), '&rarr;' ) : $button_text;
?>

<div class="cta-widget-wrap <?php echo sanitize_html_class( $top_class ); ?> <?php echo sanitize_html_class( $bottom_class ); ?>">
	<div class="cta-widget">
		<?php if ( !empty( $headline ) ) { ?>
			<h3 class="cta-headline"><?php echo do_shortcode( esc_html( $headline ) ); ?></h3>
		<?php } ?>
		<?php if ( !empty( $description ) ) { ?>
			<div class="cta-description"><?php echo do_shortcode( wp_kses_post( wpautop( $description ) ) ); ?></div>
		<?php } ?>
		<?php if ( !empty( $url ) ) { ?>
			<a href="<?php echo esc_url( $url ); ?>" <?php hybridextend_attr( 'cta-widget-button', 'widget', 'button button-medium border-box' ); ?>><?php echo esc_html( $button_text ); ?></a>
		<?php } ?>
	</div>
</div>