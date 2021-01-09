<?php
/**
 * Template for displaying search forms in gurukul-education
 *
 * @subpackage gurukul-education
 * @since 1.0
 * @version 1.4
 */

?>

<?php $unique_id = esc_attr( uniqid( 'search-form-' ) ); ?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label >
		<span class="screen-reader-text"><?php echo esc_html_x( 'Search for:', 'label', 'gurukul-education' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search', 'placeholder', 'gurukul-education' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	</label>
	<button rol="tab" type="submit" class="search-submit"><?php echo esc_html_x( 'Search', 'submit button', 'gurukul-education' ); ?></button>
</form>