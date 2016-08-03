<?php

/**
 *
 * @since  1.1.6
 *
 */
if ( ! function_exists( 'basic_the_custom_logo' ) ):
	function basic_the_custom_logo(){

		if ( function_exists('the_custom_logo') ) {
			the_custom_logo();
		}

	}
endif;
add_action( 'basic_before_sitelogo', 'basic_the_custom_logo' );




/**
 * echo post meta information
 *  filter `basic_post_meta_list` accept values:  'date', 'category', 'comments', 'author'
 *
 * @since  1.1.6
 */
if ( ! function_exists( 'basic_get_postmeta' ) ):
function basic_get_postmeta() {

	$default_meta_list = get_theme_mod( 'postmeta_list', array( 'date', 'category', 'comments' ) );
	$default_meta_list = !is_array( $default_meta_list ) ? explode( '_', $default_meta_list ) : $default_meta_list;

	$meta_list = apply_filters( 'basic_post_meta_list', $default_meta_list );
	$displayed_meta_list = $meta_list;

	if ( is_customize_preview() ){
		$all = array_merge( $meta_list, array('date', 'category', 'comments', 'tags', 'author') );
		$meta_list = array_unique( $all );
	}

	if ( empty($meta_list) ){
		return;
	}

	$meta_html = array();

	foreach ( $meta_list as $meta ) {
		$preview = ( ! in_array( $meta, $displayed_meta_list ) ) ? ' hide' : '';
		switch ( $meta ) {
			case 'date':
				$meta_html[ $meta ] = '<span class="date'. $preview .'">' . get_the_time( get_option( 'date_format' ) ) . '</span>';
				break;
			case 'author':
				$meta_html[ $meta ] = '<span class="author'. $preview .'">'. get_the_author() .'</span>';
				break;
			case 'category':
				$meta_html[ $meta ] = '<span class="category'. $preview .'">' . get_the_category_list( ', ' ) . '</span>';
				break;
			case 'comments':
				$meta_html[ $meta ] = '<span class="comments'. $preview .'"><a href="' . get_comments_link() . '">' . __( 'Comments', 'basic' ) . ': ' . get_comments_number() . '</a></span>';
				break;
			case 'tags':
				$meta_html[ $meta ] = '<span class="tags'. $preview .'">' . get_the_tag_list( __( 'Tags: ', 'basic' ), ', ' ) . '</span>';
				break;
		}
	}
	$meta_html = apply_filters( 'basic_post_meta_list_html', $meta_html );


	$html = '';
	foreach ( $meta_list as $meta ) {
		$html .= $meta_html[ $meta ];
	}

	$html = apply_filters( 'basic_post_meta_html', $html );

	echo '<aside class="meta">';
	do_action( 'basic_post_meta_before_first' );

	echo $html;

	do_action( 'basic_post_meta_after_last' );
	echo '</aside>';
}
endif;
add_action( 'basic_after_post_title', 'basic_get_postmeta', 10 );