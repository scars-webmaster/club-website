<?php
/**
 * The searchform template file.
 * @package HappenStance
 * @since HappenStance 1.0.0
*/
?>
<form id="searchform" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
  <div class="searchform-wrapper"><input type="text" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" id="s" placeholder="<?php esc_attr_e( 'Search here...', 'happenstance' ); ?>" />
  <input type="submit" class="send icon_search" name="searchsubmit" value="<?php echo esc_attr( '&amp;#x55;' ); ?>" /></div>
</form>