<?php

/* set custom body classes
 * ========================================================================== */
if ( ! function_exists( 'basic_set_body_class' ) ) :
function basic_set_body_class( $classes ){
	
	// page layout
	$classes[] = 'layout-' . basic_get_layout();
	
	return $classes;
}
endif;
add_filter('body_class', 'basic_set_body_class');
/* ========================================================================== */


/* set page layout
 * ========================================================================== */
if ( ! function_exists( 'basic_get_layout' ) ) :
function basic_get_layout(){
	global $post;
	
	$layout = 'rightbar';

	$layout_def  = get_avd_option('layout_default');
	$layout_home = get_avd_option('layout_home');
	$layout_post = get_avd_option('layout_post');
	$layout_page = get_avd_option('layout_page');


	// get custom page layout
	if ( is_singular() ) { 
		$custom = get_post_meta( $post->ID, 'basic_page_layout', true ); 
		if ( ''==$custom || 'default'==$custom)  unset( $custom );
	}
	
	// get settings for 'post' layout
	if ( is_single() && isset($layout_post) ) {
		$layout = ( isset($custom) ) 
			? $custom 
			: $layout_post;
	} 
	// get settings for 'page' layout
	elseif( is_page() && $layout_page ) {
		$layout = ( isset($custom) ) 
			? $custom 
			: $layout_page;
	} 
	// get home layout settings 
	elseif( is_home() && $layout_home ) {
		$layout = $layout_home;
	} 
	// get default layout settings 
	elseif( $layout_def ) {
		$layout = $layout_def;
		if ( is_search() ) { 
			$layout = 'center';
		}
	} 
	
	return $layout;
}
endif;
/* ========================================================================== */




/* set custom posts classes
 * ========================================================================== */
if ( ! function_exists( 'basic_set_post_class' ) ) :
function basic_set_post_class( $pc ){
	global $post;
	
	$classes[] = 'post post-'. $post->ID;
	
	if ( !is_singular() ) {
		$classes[] = 'anons';
	}
	
	if ( is_search() ) {
		$classes[] = 'serp';
	}

	if ( in_array( 'sticky', $pc ) ) {
		$classes[] = 'sticky';
	}

	return $classes;
}
endif;
add_filter('post_class', 'basic_set_post_class');
/* ========================================================================== */



/* clear nav menu classes
 * ========================================================================== */
if ( ! function_exists( 'basic_set_nav_menu_class' ) ) :
function basic_set_nav_menu_class($classes) {

    $custom_classes = array();

    foreach($classes as $class) {    	
        if( $class=='menu-item' || 'current-menu-item'==$class)
        	$custom_classes[] = $class;
        if( 'menu-item-has-children' == $class)
        	$custom_classes[] = $class;
    }

    return $custom_classes;
}
endif;
add_filter('nav_menu_css_class', 'basic_set_nav_menu_class');
/* ========================================================================== */





/* exclude link to current page IN MENU and CATEGORIES
 * ========================================================================== */
function basic_no_link_current_category( $output ) { 
    return preg_replace( '%((current-cat)[^<]+)[^>]+>([^<]+)</a>%', '$1<span>$3</span>', $output, 1 );
} 
add_filter('wp_list_categories', 'basic_no_link_current_category');

function basic_no_link_current_page( $output ) {
    return preg_replace( '%((current_page_item|current-menu-item)[^<]+)[^>]+>([^<]+)</a>%', '$1<span>$3</span>', $output, 1 );
}
add_filter('wp_nav_menu', 'basic_no_link_current_page');
/* ========================================================================== */



/* change main color
 * ========================================================================== */
function basic_change_main_color( $p ) { 
	
	// get color option
	$color = get_avd_option('maincolor');

	$x = <<<EOT

<!-- theme custom color -->	
<style>a:hover,#logo,.bx-controls a:hover .fa{color:$color}a:hover{color:$color}blockquote,q,input:focus,textarea:focus{border-color:$color}input[type=submit],input[type=button],.submit,.button,#mobile-menu:hover,.menu,.more-link,.avd-pagination a:hover,.avd-pagination .current,#footer{background-color:$color}@media only screen and (min-width:768px){.menu .sub-menu,.menu .children{background-color:$color}}</style>
<!-- end theme custom -->


EOT;

	if ( !empty($color) && '#936'!=$color && '#993366'!=$color) {
	    echo $x;	
	}

} 
add_filter('wp_head', 'basic_change_main_color');
/* ========================================================================== */




/* set default setting for galleries
 * ========================================================================== */
if ( ! function_exists( 'basic_set_gallery_defaults' ) ) :
function basic_set_gallery_defaults( $attr ){
//	var_dump( $attr );
	
	$attr['itemtag'] = 'div';
	$attr['icontag'] = 'div';
	$attr['captiontag'] = 'p';
	// $attr['size'] = 'full';
	// $attr['link'] = 'none';
	

//	var_dump( $attr );
		
	return $attr;
}
endif;
add_filter('shortcode_atts_gallery', 'basic_set_gallery_defaults');
/* ========================================================================== */
