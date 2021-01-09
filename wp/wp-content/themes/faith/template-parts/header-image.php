<?php 
global $ilovewp_has_image;

if ( is_singular() && ( has_post_thumbnail() && 1 == get_theme_mod( 'faith_single_featured_image', 1 ) ) ) {
	$large_image_url = wp_get_attachment_image_url( get_post_thumbnail_id(), 'faith-large-thumbnail' );
	?>
	<div id="ilovewp-hero" class="ilovewp-hero-withimage">
		<div class="ilovewp-hero-wrapper" style="background-image: url(<?php echo esc_url($large_image_url); ?>);">
		</div><!-- .ilovewp-hero-wrapper -->
	</div><!-- #ilovewp-hero -->
	<?php
	$ilovewp_has_image = TRUE;
}
elseif ( !isset( $ilovewp_has_image ) && get_header_image() ) { ?>
	<div id="ilovewp-hero" class="ilovewp-hero-withimage">
		<div class="ilovewp-hero-wrapper" style="background-image: url(<?php echo header_image(); ?>);">
		</div><!-- .ilovewp-hero-wrapper -->
	</div><!-- #ilovewp-hero -->
	<?php
	$ilovewp_has_image = TRUE;
} else { ?>
	<div id="ilovewp-hero" class="ilovewp-hero-blankfill">
	</div><!-- #ilovewp-hero -->
<?php }