<?php
/**
 * The sidebar template file.
 * @package HappenStance
 * @since HappenStance 1.0.0
*/
?>
<?php if ( get_theme_mod('happenstance_display_sidebar') != 'Without Sidebar' ) { ?>
<aside id="sidebar">
<?php if ( dynamic_sidebar( 'sidebar-1' ) ) : else : ?>
<?php endif; ?>
</aside> <!-- end of sidebar -->
<?php } ?>