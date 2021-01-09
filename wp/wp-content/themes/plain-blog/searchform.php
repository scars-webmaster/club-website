<?php
/**
 * This file defines the markup of the search form.
 */
?>
<div class="search_section"> 
    <i class="fa fa-search"></i>
    <h3><?php _e('Need to find something?', 'plain-blog'); ?></h3>
    <form id="searchform" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <input class="subscribe" placeholder="<?php _e('Start typing...', 'plain-blog'); ?>" name="s" type="text">
        <input class="subscribe_btn" value="<?php _e('SUBMIT', 'plain-blog'); ?>" name="" type="submit">
    </form>
</div>