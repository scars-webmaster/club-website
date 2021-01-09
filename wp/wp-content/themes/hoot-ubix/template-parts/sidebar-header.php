<?php
// Dispay Sidebar if sidebar has widgets
if ( is_active_sidebar( 'hoot-header' ) ) :

	?>
	<div <?php hybridextend_attr( 'header-sidebar', '', 'inline-nav hgrid-stretch' ); ?>>
		<?php

		// Template modification Hook
		do_action( 'hootubix_template_sidebar_start', 'header-sidebar' );

		?>
		<aside <?php hybridextend_attr( 'sidebar', 'header-sidebar' ); ?>>
			<?php dynamic_sidebar( 'hoot-header' ); ?>
		</aside>
		<?php

		// Template modification Hook
		do_action( 'hootubix_template_sidebar_end', 'header-sidebar' );

		?>
	</div>
	<?php

endif;