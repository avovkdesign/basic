<?php

if ( !defined('APP_NAME') ) {
	$theme_name = sanitize_key( '' . wp_get_theme() );
	define( 'APP_NAME', $theme_name );
}

define( 'BASIC_OPTION_NAME', 'theme_options_' . APP_NAME );





/* ==========================================================================
* 	customize get_option for theme options
* ========================================================================== */
if ( ! function_exists( 'basic_get_theme_option' ) ) :
	function basic_get_theme_option( $key ) {

		$cache = wp_cache_get( BASIC_OPTION_NAME );
		if ( $cache ) {
			return ( isset($cache[$key]) ) ? $cache[$key] : false;
		}

		$opt = get_option( BASIC_OPTION_NAME );

		wp_cache_add( BASIC_OPTION_NAME, $opt  );

		return ( isset($opt[$key]) ) ? $opt[$key] : false;
	}
endif;
/* ============================================================================= */