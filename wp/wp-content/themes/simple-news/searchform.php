<?php
/**
 * The template for displaying search forms
 *
 * @package SimpleNews
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
	<label class="sr-only" for="s"><?php esc_html_e( 'Search', 'simple-news' ); ?></label>
	<div class="input-group">
		<input class="field form-control" id="s" name="s" type="text" aria-label="<?php esc_attr_e( 'Search input', 'simple-news' ); ?>" placeholder="<?php esc_attr_e( 'Search &hellip;', 'simple-news' ); ?>" value="<?php the_search_query(); ?>">
		<span class="input-group-append">
			<button class="submit btn btn-primary" id="searchsubmit" type="submit" aria-label="<?php esc_attr_e( 'Search submit', 'simple-news' ); ?>"><i class="fa fa-search" aria-hidden="true"></i></button>
		</span>
	</div>
</form>
