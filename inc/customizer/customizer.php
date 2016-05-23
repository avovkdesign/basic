<?php



if ( !defined('APP_NAME') ) {
	define( 'APP_NAME', get_template() );
}

define( 'BASIC_OPTION_NAME', 'theme_options_' . APP_NAME );


require_once( get_template_directory() . '/inc/customizer/customizer-settings.php' );



/* ==========================================================================
* 	customize get_option for theme options
* ========================================================================== */
if ( ! function_exists( 'basic_get_option' ) ) :
	function basic_get_option( $key ) {

		$cache = wp_cache_get( 'avd_'. BASIC_OPTION_NAME );
		if ( $cache ) {
			return ( isset($cache[$key]) ) ? $cache[$key] : false;
		}

		$opt = get_option( BASIC_OPTION_NAME );
		wp_cache_add( 'avd_'. BASIC_OPTION_NAME, $opt  );

		return ( isset($opt[$key]) ) ? $opt[$key] : false;
	}
endif;
/* ============================================================================= */



/**
 * CUSTOM STYLES
 */
function basic_customizer_css() {

	$style = '';


// ---- header -----
	$bgimg      = get_header_image();
	$bg_repeat  = basic_get_option( 'header_image_repeat' );

	if ( ! empty( $bgimg ) ) {
		$style .= "#header{background-image:url('$bgimg')}";
		$style .= "#header{background-repeat:$bg_repeat}";
	}

	$header_h   = get_custom_header()->height;
	$fit_height = basic_get_option( 'fix_header_height' );
	if ( ! empty( $fit_height ) && !empty( $header_h ) ) {
		$style .= "@media screen and (min-width:1024px){.sitetitle{height:{$header_h}px}}";
	}


	$header_textcolor = get_theme_mod( 'header_textcolor', false );
	if ( ! empty( $header_textcolor ) ) {
		$style .= "a#logo{color:#$header_textcolor}";
	}

	$main_color = basic_get_option( 'maincolor' );
	if ( ! empty( $main_color ) && '#936' != $main_color && '#993366' != $main_color ) {
		$style .= "a:hover,#logo,.bx-controls a:hover .fa{color:$main_color}";
		$style .= "a:hover{color:$main_color}";
		$style .= "blockquote,q,input:focus,textarea:focus{border-color:$main_color}";
		$style .= "input[type=submit],input[type=button],.submit,.button,#mobile-menu:hover,.top-menu,.top-menu .sub-menu,.top-menu .children,.more-link,.avd-pagination a:hover,.avd-pagination .current,#footer{background-color:$main_color}";
	}

	echo ( $style )
		? "<!-- BEGIN Customizer CSS -->\n<style type='text/css' id='basic-customizer-css'>$style</style>\n<!-- END Customizer CSS -->\n"
		: "";

}

add_action( 'wp_head', 'basic_customizer_css' );
/* ======================================================================== */


/* ======================================================================== *
 * Customizer functions
 * ======================================================================== */

// ------------------------
function basic_sanitize_text( $value ) {
	return sanitize_text_field( $value );
}


// ------------------------
function basic_sanitize_html( $value ) {
	return esc_html( $value );
}


// ------------------------
function basic_sanitize_textarea( $value ) {
	return esc_textarea( $value );
}


// ------------------------
function callback_single() {
	return is_single();
}

// ------------------------
function callback_page() {
	return is_page();
}

// ------------------------
function callback_singular() {
	return is_singular();
}

// ------------------------
function callback_default_layout() {
	return ! is_singular() && ! is_page() && ! is_home();
}


// ------------------------
if ( class_exists( 'WP_Customize_Control' ) ) {
	class Group_Title_Control extends WP_Customize_Control {
		public function render_content() {
			?>
			<!--			<br>-->
			<?php echo ( ! empty( $this->label ) ) ? '<h2 style="margin:20px 0 3px">' . esc_html( $this->label ) . '</h2>' : ''; ?>
			<?php echo ( ! empty( $this->description ) ) ? '<p class="description">' . esc_html( $this->description ) . '</p>' : ''; ?>
			<hr />
			<?php
		}
	}
}
/* ======================================================================== */



/* ========================================================================
 *            script & styles for CUSTOMIZER 
 * ======================================================================== */
function basic_customizer_live() {

	wp_enqueue_script(
		'basic-customizer-js',
		get_template_directory_uri() . '/inc/customizer/customizer-preview.js', // URL
		array( 'jquery' ), null, true
	);
	wp_localize_script( 'basic-customizer-js', 'optname', BASIC_OPTION_NAME );

}

add_action( 'customize_preview_init', 'basic_customizer_live' );
/* ======================================================================== */


