<?php


/* ========================================================================== 
 *	show 20 posts in search page
 * ========================================================================== */
function basic_pre_get_posts( $query ) {

	if ( is_admin() || ! $query->is_main_query() ) {
		return;
	}

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

	$css = basic_get_theme_option( 'custom_styles' );
	$js  = basic_get_theme_option( 'head_scripts' );

	if ( ! empty( $css ) ) {
		echo "\n<style id='basic-custom-css'>" . $css . "</style>\n";
	}
	if ( ! empty( $js ) ) {
		echo "\n" . wp_specialchars_decode( $js, ENT_QUOTES ) . "\n";
	}

}

add_action( 'wp_head', 'basic_print_custom_css_js', 20 );
/* ========================================================================== */


/* ==========================================================================
 * echo custom script in footer from options
 * ========================================================================== */
function basic_print_footer_js() {

	$footer_js = basic_get_theme_option( 'footer_scripts' );

	if ( ! empty( $footer_js ) ) {
		echo "\n" . wp_specialchars_decode( $footer_js, ENT_QUOTES ) . "\n";
	}

}

add_action( 'wp_footer', 'basic_print_footer_js' );
/* ========================================================================== */


/* ==========================================================================
 * add social button to the_content
 * ========================================================================== */
function basic_social_share_buttons( $content ) {

	$socbtn     = basic_get_theme_option( 'social_share' );

	$link_pages = wp_link_pages();

	if ( ! is_singular() || '' === $socbtn || 'hide' == $socbtn ) {
		return $content . $link_pages;
	}

	$soc_title = basic_get_theme_option( 'title_before_socshare' );
	$soc_html  = "<div class='social_share clearfix'>";
	$soc_html .= "<p class='socshare-title'>$soc_title</p>";

	switch ( $socbtn ) {
		case 'yandex':
			$yandex_social_list = apply_filters( 'basic_yandex_social_list', 'vkontakte,facebook,odnoklassniki,gplus,twitter' );
			$yandex_show_counter = apply_filters( 'basic_yandex_show_counter', true );
			$yandex_counter = ( !empty($yandex_show_counter) ) ? ' data-counter="" ' : '';
			$soc_html .= '<div class="ya-share2" data-services="'. $yandex_social_list .'"'. $yandex_counter .'></div>';
			break;
		case 'custom':
		default:
			$link  = get_permalink();
			$title = get_the_title();
			$soc_html .= '
			<a rel="nofollow" class="psb fb" target="_blank" href="http://www.facebook.com/sharer.php?u=' . $link . '&amp;t=' . urlencode( $title ) . '&amp;src=sp" title="' . __( 'Share in', 'basic' ) . ' Facebook"></a>
			<a rel="nofollow" class="psb vk" target="_blank" href="http://vkontakte.ru/share.php?url=' . $link . '" title="' . __( 'Share in VK', 'basic' ) . '"></a>
			<a rel="nofollow" class="psb ok" target="_blank" href="http://www.odnoklassniki.ru/dk?st.cmd=addShare&amp;st.s=1&amp;st._surl=' . $link . '&amp;st.comments=' . urlencode( $title ) . '" title="' . __( 'Share in OK', 'basic' ) . '"></a>
			<a rel="nofollow" class="psb gp" target="_blank" href="https://plus.google.com/share?url=' . $link . '"  title="' . __( 'Share in', 'basic' ) . ' Google+"></a>
			<a rel="nofollow" class="psb tw" target="_blank" href="http://twitter.com/share?url=' . $link . '&amp;text=' . urlencode( $title ) . '" title="' . __( 'Share in', 'basic' ) . ' Twitter"></a>
			';
			break;
	}
	$soc_html .= "</div>";

	$fitered_soc_html = apply_filters( 'basic_social_share', $soc_html );

	return $content . $link_pages . $fitered_soc_html;

}

add_action( 'the_content', 'basic_social_share_buttons', 10 );
/* ========================================================================== */


/* ========================================================================== *
 *
 * ========================================================================== */
if ( ! function_exists( 'basic_the_content_entry' ) ) :
	function basic_the_content_entry( $content ) {

		return '<div class="entry">' . "\n\n" . $content . "\n\n" . '</div>';

	}
endif;
add_action( 'the_content', 'basic_the_content_entry', 1 );
/* ========================================================================== */


/* ==========================================================================
 * add social button to the_content
 * ========================================================================== */
function basic_content_custom_codes_div( $content ) {

	if ( ! is_singular() ) {
		return $content;
	}

	return '<div class="html-before-content"></div>' . $content . '<div class="html-after-content"></div>';

}

add_action( 'the_content', 'basic_content_custom_codes_div', 1 );


function basic_content_custom_codes( $content ) {

	if ( ! is_singular() ) {
		return $content;
	}

	$before_content = basic_get_theme_option( 'before_content' );
	$after_content  = basic_get_theme_option( 'after_content' );

	$filtered_content = apply_filters( 'basic_singular_content', $content );

	$new_content = str_replace(
		array(
			'<div class="html-before-content"></div>',
			'<div class="html-after-content"></div>'
		),
		array(
			'<div class="html-before-content">' . wp_specialchars_decode( $before_content, ENT_QUOTES ) . '</div>',
			'<div class="html-after-content">' . wp_specialchars_decode( $after_content, ENT_QUOTES ) . '</div>'
		),
		$filtered_content
	);

	return $new_content;

}

add_action( 'the_content', 'basic_content_custom_codes', 10 );
/* ========================================================================== */


/* ==========================================================================
 * Highlight search results 
 * ========================================================================== */
if ( ! function_exists( 'basic_search_highlight' ) ) :
	function basic_search_highlight( $text ) {

		$s = get_query_var( 's' );

		if ( is_search() && '' != $s && in_the_loop() ) :

			$style       = 'color:red;font-weight:bold;';
			$query_terms = get_query_var( 'search_terms' );

			if ( empty( $query_terms ) ) {
				$query_terms = explode( ' ', $s );
			}
			if ( empty( $query_terms ) ) {
				return;
			}

			foreach ( $query_terms as $term ) {
				$term  = preg_quote( $term, '/' ); // like in search string
				$term1 = mb_strtolower( $term ); // lowercase
				$term2 = mb_strtoupper( $term ); // uppercase
				$term3 = mb_convert_case( $term, MB_CASE_TITLE, "UTF-8" );    // capitalise
				$term4 = mb_strtolower( mb_substr( $term, 0, 1 ) ) . mb_substr( $term2, 1 );    // first lowercase
				$text  = preg_replace( "@(?<!<|</)($term|$term1|$term2|$term3|$term4)@i", "<span style=\"{$style}\">$1</span>", $text );
			}

		endif; // is_search;

		return $text;

	}
endif;
add_filter( 'the_content', 'basic_search_highlight' );
add_filter( 'the_excerpt', 'basic_search_highlight' );
add_filter( 'the_title', 'basic_search_highlight' );
/* ========================================================================== */
