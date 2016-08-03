<?php


if( !function_exists('basic_get_postmeta') ):
function basic_get_postmeta() {

	$html = '<aside class="meta">';

	do_action( 'basic_post_meta_before_first' );

	$html .= '<span class="date">'. get_the_time( get_option('date_format') ) .'</span>';
	$html .= '<span class="category">'. get_the_category_list(', ') .'</span>';
	$html .= '<span class="comments"><a href="'. get_comments_link() .'">'. __('Comments', 'basic') .': ' . get_comments_number() .'</a></span>';

	do_action( 'basic_post_meta_after_last' );

	$html .= '</aside>';

	apply_filters( 'basic_the_postmeta', $html );

	echo $html;
}
endif;
add_action( 'basic_after_post_title', 'basic_get_postmeta', 10 );