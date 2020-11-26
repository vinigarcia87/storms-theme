<?php
/**
 * Storms Websolutions (http://storms.com.br/)
 *
 * @author    Vinicius Garcia | vinicius.garcia@storms.com.br
 * @copyright (c) Copyright 2012-2020, Storms Websolutions
 * @license   GPLv2 - GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @package   Storms
 * @version   1.0.0
 *
 * Storms WooCommerce Apply Cupon URL file
 * Apply a cupon through an URL
 * Example: http://myecommerce.dev/?cupom-de-desconto={cupon-code}
 * This will apply the cupon {cupon-code} to the user's cart
 * The slug of the URL is customizable
 * The user must be logged in to aplly the cupon
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Set coupon code as custom data in cart session
 * example: http://myecommerce.dev/?cupom-de-desconto={cupon-code}
 * @see https://stackoverflow.com/a/47499236/1003020
 */
function storms_wc_apply_cupon_url_add_coupon_code_to_cart_session() {
	$slug = get_option( 'storms_wc_url_coupons_slug', __( 'cupom-de-desconto', 'storms' ) );

	// Exit if no code in URL or if the coupon code is already set cart session
	if ( is_admin() || empty( $_GET[ $slug ] ) || ! empty( WC()->session->get( 'storms_wc_url_coupon' ) ) ) {
		return;
	}

	$coupon_code = ! empty( $_GET[ $slug ] ) ? esc_attr( $_GET[ $slug ] ) : WC()->session->get( 'storms_wc_url_coupon' );

	// If there is an existing non empty cart active session we apply the coupon
	if ( ! WC()->cart->is_empty() ) {
		WC()->cart->apply_coupon( $coupon_code );

		// Redirect to cart
		wp_safe_redirect( wc_get_cart_url() );
		exit;

	} elseif ( empty( WC()->session->get( 'storms_wc_url_coupon' ) ) ) {
		WC()->session->set( 'storms_wc_url_coupon', $coupon_code );

		// Redirect to url without params
		wp_safe_redirect( remove_query_arg( array( $slug, 'add-to-cart' ) ) );
		exit;
	}
}
add_action( 'wp_loaded', 'storms_wc_apply_cupon_url_add_coupon_code_to_cart_session' );

/**
 * Add coupon code when a product is added to cart once
 *
 * @param $cart_item_key
 * @param $product_id
 * @param $quantity
 * @param $variation_id
 * @param $variation
 * @param $cart_item_data
 */
function storms_wc_apply_cupon_url_add_coupon_code_to_cart( $cart_item_key, $product_id, $quantity, $variation_id, $variation, $cart_item_data ) {
	$coupon_code = WC()->session->get( 'storms_wc_url_coupon' );
	$applied_coupons = WC()->session->get( 'applied_coupons' );

	if ( empty( $coupon_code ) || in_array( wc_format_coupon_code( $coupon_code ), $applied_coupons ) ) {
		return;
	}

	WC()->cart->apply_coupon( $coupon_code );
}
add_action( 'woocommerce_add_to_cart', 'storms_wc_apply_cupon_url_add_coupon_code_to_cart', 10, 6 );

/**
 * Remove coupon code when user empty his cart
 *
 * @param $cart_item_key
 * @param WC_Cart $cart
 */
function storms_wc_apply_cupon_url_check_coupon_code_cart_items_removed( $cart_item_key, $cart ) {
	$coupon_code = WC()->session->get( 'storms_wc_url_coupon' );

	if ( $cart->has_discount( $coupon_code ) && $cart->is_empty() ) {
		$cart->remove_coupon( $coupon_code );
		WC()->session->__unset( 'storms_wc_url_coupon' );
	}
}
add_action( 'woocommerce_cart_item_removed', 'storms_wc_apply_cupon_url_check_coupon_code_cart_items_removed', 10, 6 );
