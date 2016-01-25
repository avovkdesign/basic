<?php 


/* ========================================================================== 
 *	show 20 posts in search page
 * ========================================================================== */
function basic_pre_get_posts( $query ) {
	
	if ( is_admin() || ! $query->is_main_query() )
	    return;
	
	if ( is_search() ) {
	    $query->set( 'posts_per_page', 20 );
	}
}
add_action( 'pre_get_posts', 'basic_pre_get_posts' );
/* ========================================================================== */




/* ========================================================================== 
 * customize excerpt text
 * ========================================================================== */
function basic_change_the_excerpt( $more ) {
	
	return ' ...';

}
add_action( 'excerpt_more', 'basic_change_the_excerpt' );
/* ========================================================================== */





/* ========================================================================== 
 * echo custom css
 * ========================================================================== */
function basic_print_custom_css_js() {
	
	$css = get_avd_option('custom_styles');
	$js = get_avd_option('head_scripts');

	if ( !empty($css) ) {
		echo "\n<style>". $css ."</style>\n";
	}
	if ( !empty($js) ) {
		echo "\n". $js . "\n";
	}

}
add_action( 'wp_head', 'basic_print_custom_css_js' );
/* ========================================================================== */



/* ==========================================================================
 * echo custom script in footer from options
 * ========================================================================== */
function basic_print_footer_js() {
	
	$fjs = get_avd_option('footer_scripts');

	if ( !empty($fjs) ) {
		echo "\n". $fjs . "\n";
	}

}
add_action( 'wp_footer', 'basic_print_footer_js' );
/* ========================================================================== */





/* ==========================================================================
 * add social button to the_content
 * ========================================================================== */
function basic_social_share_buttons( $content ) {
	
	$socbtn = get_avd_option('social_share');
	$link_pages = wp_link_pages();

	if ( !is_singular() || empty($socbtn) || 'hide'==$socbtn )
		return $content . $link_pages;

	$soc_html = "<div class='social_share'>";

	switch ( $socbtn ) {
		case 'custom': 
			$link = get_permalink();
			$title = get_the_title();
			$soc_html .= '
			<a rel="nofollow" class="psb fb" target="_blank" href="http://www.facebook.com/sharer.php?u='.$link.'&amp;t='.urlencode($title).'&amp;src=sp" title="'. __( 'Share in', 'basic' ) .' Facebook"></a>
			<a rel="nofollow" class="psb vk" target="_blank" href="http://vkontakte.ru/share.php?url='.$link.'" title="'. __( 'Share in VK', 'basic' ) .'"></a>
			<a rel="nofollow" class="psb ok" target="_blank" href="http://www.odnoklassniki.ru/dk?st.cmd=addShare&amp;st.s=1&amp;st._surl='.$link.'&amp;st.comments='.urlencode($title).'" title="'. __( 'Share in OK', 'basic' ) .'"></a>
			<a rel="nofollow" class="psb gp" target="_blank" href="https://plus.google.com/share?url='.$link.'"  title="'. __( 'Share in', 'basic' ) .' Google+"></a>
			<a rel="nofollow" class="psb tw" target="_blank" href="http://twitter.com/share?url='.$link.'&amp;text='.urlencode($title).'" title="'. __( 'Share in', 'basic' ) .' Twitter"></a>
			';
			break;
		case 'share42': 
			$soc_html .= '<div class="share42init"></div>';
			break;
		case 'yandex': 
			$soc_html .= '<div class="ya-share2" data-services="vkontakte,facebook,odnoklassniki,gplus,twitter" data-counter=""></div>';
			break;
		default: break;
	}
	$soc_html .= "</div>";

	return $content . $link_pages . $soc_html;

}
add_action( 'the_content', 'basic_social_share_buttons' );
/* ========================================================================== */





/* ==========================================================================
 * Highlight search results 
 * ========================================================================== */
if ( ! function_exists( 'avd_search_highlight' ) ) :
function avd_search_highlight($text) {
	$s = get_query_var('s');
	if ( is_search() && ''!=$s && in_the_loop() ) :
		$style = 'color:red;font-weight:bold;';
		$query_terms = get_query_var('search_terms');

		if ( empty($query_terms) ) $query_terms = explode(' ', $s ); 
		if ( empty($query_terms) ) return;

		foreach ($query_terms as $term) {
			$term = preg_quote($term, '/'); // like in search string
			$term1 = mb_strtolower($term); // lowercase
			$term2 = mb_strtoupper($term); // uppercase
			$term3 = mb_convert_case($term, MB_CASE_TITLE, "UTF-8");	// capitalise
			$term4 = mb_strtolower(mb_substr($term, 0, 1)) . mb_substr($term2, 1);	// first lowercase
			$text = preg_replace("@(?<!<|</)($term|$term1|$term2|$term3|$term4)@i", "<span style=\"{$style}\">$1</span>", $text);
		}
	endif; // is_search;
    return $text;
}
endif;
add_filter('the_content', 'avd_search_highlight');
add_filter('the_excerpt', 'avd_search_highlight');
add_filter('the_title',   'avd_search_highlight');
/* ========================================================================== */
