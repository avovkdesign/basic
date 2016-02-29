<?php 


function basic_customizer_styles() {
	
	$style = '';

	$header_textcolor = get_header_textcolor();
	if ( !empty($header_textcolor) ) {
		$style .= "#logo{color:#$header_textcolor}";
	}

	$header_image = get_header_image();
	if ($header_image){ 
		$style .= '#header{background-image:url("'. esc_url( $header_image ) .'");}'; 
	}

	if ( !empty($style) )  {
		echo '<style>'. $style .'</style>';
	}

}
add_action( 'wp_head', 'basic_customizer_styles', 100 );