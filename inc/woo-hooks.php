<?php
/**
 * WooCommerce Hooks
 *
 * @since 1.2.3
 *
 */


/**
 *
 * @return string
 */
if ( ! function_exists( 'basic_woo_custom_cart_button_text' ) ) :
	function basic_woo_custom_cart_button_text() {

		return __( 'Add to Cart', 'basic' );

	}
endif;
add_filter( 'woocommerce_product_single_add_to_cart_text', 'basic_woo_custom_cart_button_text' );
add_filter( 'woocommerce_product_add_to_cart_text', 'basic_woo_custom_cart_button_text' );


/**
 *
 * @param $cols
 *
 * @return int
 */
if ( ! function_exists( 'basic_woo_custom_cols' ) ) :
	function basic_woo_custom_cols( $cols ) {

		return 12;

	}
endif;
add_filter( 'loop_shop_per_page', 'basic_woo_custom_cols', 20 );