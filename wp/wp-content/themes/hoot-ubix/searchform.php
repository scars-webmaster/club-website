<?php

$searchlabel = apply_filters( 'hootubix_search_form_label', __( 'Search', 'hoot-ubix' ) );
$searchplaceholder = apply_filters( 'hootubix_search_form_placeholder', __( 'Type Search Term &hellip;', 'hoot-ubix' ) );
$searchsubmit = apply_filters( 'hootubix_search_form_submit', __( 'Search', 'hoot-ubix' ) );
$searchquery = get_search_query();

echo '<div class="searchbody">';

	echo '<form method="get" class="searchform" action="' . esc_url( home_url( '/' ) ) . '" >';

		echo '<label class="screen-reader-text">' . esc_html( $searchlabel ) . '</label>';
		echo '<i class="fas fa-search"></i>';
		echo '<input type="text" class="searchtext" name="s" placeholder="' . esc_attr( $searchplaceholder ) . '" value="' . esc_attr( $searchquery ) . '" />';
		echo '<input type="submit" class="submit" name="submit" value="' . esc_attr( $searchsubmit ) . '" />';

	echo '</form>';

echo '</div><!-- /searchbody -->';