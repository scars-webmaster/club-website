<?php
// Get Content
global $hootubix_theme;
$hootubix_theme->topbar_left = is_active_sidebar( 'hoot-topbar-left' );
$hootubix_theme->topbar_right = is_active_sidebar( 'hoot-topbar-right' );

// Template modification Hook
do_action( 'hootubix_template_before_topbar' );

// Display Topbar
$hootubix_topbar_left = $hootubix_theme->topbar_left;
$hootubix_topbar_right = $hootubix_theme->topbar_right;
if ( !empty( $hootubix_topbar_left ) || !empty( $hootubix_topbar_right ) ) :

	?>
	<div <?php hybridextend_attr( 'topbar', '', 'inline-nav hgrid-stretch' ); ?>>
		<div class="hgrid">
			<div class="hgrid-span-12">

				<div class="topbar-inner table">
					<?php if ( $hootubix_topbar_left ): ?>
						<div id="topbar-left" class="table-cell-mid">
							<?php dynamic_sidebar( 'hoot-topbar-left' ); ?>
						</div>
					<?php endif; ?>

					<?php if ( $hootubix_topbar_right ): ?>
						<div id="topbar-right" class="table-cell-mid">
							<div class="topbar-right-inner">
								<?php
								dynamic_sidebar( 'hoot-topbar-right' );
								?>
							</div>
						</div>
					<?php endif; ?>
				</div>

			</div>
		</div>
	</div>
	<?php

endif;

// Template modification Hook
do_action( 'hootubix_template_after_topbar' );