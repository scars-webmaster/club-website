<?php
// Template modification Hook
do_action( 'hootubix_template_before_below_header' );

// Dispay Sidebar if sidebar has widgets
if ( is_active_sidebar( 'hoot-below-header' ) ) :

	?>
	<div <?php hybridextend_attr( 'below-header', '', 'inline-nav hgrid-stretch highlight-typo' ); ?>>
		<div class="hgrid">
			<div class="hgrid-span-12">
				<?php

				// Template modification Hook
				do_action( 'hootubix_template_sidebar_start', 'below-header' );

				?>
				<aside <?php hybridextend_attr( 'sidebar', 'below-header' ); ?>>
					<?php dynamic_sidebar( 'hoot-below-header' ); ?>
				</aside>
				<?php

				// Template modification Hook
				do_action( 'hootubix_template_sidebar_end', 'below-header' );

				?>
			</div>
		</div>
	</div>
	<?php

endif;

// Template modification Hook
do_action( 'hootubix_template_after_below_header' );