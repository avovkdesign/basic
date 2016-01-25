<?php


/* ==========================================================================
 * Customize pagination
 *
 *	@param 	$total (true) = show total pages
 *	@param 	$prev ( « Prev ) = PREV link text
 *	@param 	$next ( Next » ) = NEXT link text
 *
 *	@return 	echo pagination
 *
 *  Example: 	<?php avd_the_pagination(); ?>
 *
 * ========================================================================== */
if ( ! function_exists( 'avd_the_pagination' ) ) :
function avd_the_pagination( $total = true, $prev = '', $next = '' ){
	global $wp_query;

	$prev = ( !empty($prev) ) ? $prev : __( '&laquo; Prev', 'basic');
	$next = ( !empty($next) ) ? $next : __( 'Next &raquo;', 'basic');

	$big = 999999999;
	$currentpage = max( 1, get_query_var('paged') );
	$maxpage = $wp_query->max_num_pages;

	$res = '<div class="avd-pagination">';
	if ( $maxpage > 1 && $total ) {
		$res .= '<span class="total">'. __('Page ', 'basic') . $currentpage. _(' from ') .$maxpage.':  </span>';
	}
	$res .= paginate_links( array(
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' => '?paged=%#%',
		'current' => $currentpage,
		'total' => $maxpage,
		'mid_size' => 3,
		'prev_text' => $prev,
		'next_text' => $next
	));
	$res .= '</div>';
	echo $res;
}
endif;
/* ========================================================================== */
