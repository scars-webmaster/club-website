<?php
/**
 * Static hero sidebar setup
 *
 * @package SimpleNews
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$simplenews_container = get_theme_mod( 'simplenews_container_type' );
?>

<?php if ( is_active_sidebar( 'statichero' ) ) : ?>

	<!-- ******************* The Hero Widget Area ******************* -->

	<div class="wrapper" id="wrapper-static-hero">

			<div class="<?php echo esc_attr( $simplenews_container ); ?>" id="wrapper-static-content" tabindex="-1">

				<div class="row">

					<?php dynamic_sidebar( 'statichero' ); ?>

				</div>

			</div>

	</div><!-- #wrapper-static-hero -->

<?php endif;
