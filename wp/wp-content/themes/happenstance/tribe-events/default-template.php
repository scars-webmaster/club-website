<?php
/**
 * Default Events template file.
 * Created according to the Themer’s Guide for The Events Calendar plugin (https://theeventscalendar.com/knowledgebase/themers-guide/). 
 * @package HappenStance
 * @since HappenStance 1.0.0
*/
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
get_header(); ?>
    <div class="entry-content">
	    <div id="tribe-events-pg-template">
<?php tribe_events_before_html(); ?> 
<?php tribe_get_view(); ?>   
<?php tribe_events_after_html(); ?>
	    </div> <!-- end of tribe-events-pg-template -->
    </div>   
  </div> <!-- end of content -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>