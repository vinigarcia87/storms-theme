<?php
/**
 * Storms Websolutions (http://storms.com.br/)
 *
 * @author    Vinicius Garcia | vinicius.garcia@storms.com.br
 * @copyright (c) Copyright 2012-2020, Storms Websolutions
 * @license   GPLv2 - GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @package   Storms
 * @version   4.0.0
 *
 * Storms WooCommerce Checkout Coupon file
 * Change the position of the add coupon form in checkout page, to be in order review table
 * Add functionality to add coupon via ajax call
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( \StormsFramework\Helper::is_woocommerce_activated() ) {

	// Removemos o aviso de cupons, pois alteramos sua posiçao para ficar no review order
	remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );

	// Incluindo os scripts de manipulaçao do coupon no checkout
	function storms_wc_checkout_coupon_scripts() {

		if( is_cart() || is_checkout() ) {

			wp_enqueue_script('storms-wc-checkout-coupon-script',
				\StormsFramework\Helper::get_asset_url( '/js/storms-wc-checkout-coupon' . ( ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min' ) . '.js' ),
					array( 'jquery' ), STORMS_FRAMEWORK_VERSION, true );

			// Add WordPress data to a Javascript file
			wp_localize_script( 'storms-wc-checkout-coupon-script', 'storms_wc_checkout_coupon_vars', [

				// Probably, will get trouble when using caching for assets... full js approach is better
				//'is_cart' => ( is_cart() ? 'yes' : 'no' ),
				//'is_checkout' => ( is_checkout() ? 'yes' : 'no' ),

				'ajax_url' => admin_url( 'admin-ajax.php' ),
				'wc_ajax_url' => WC_AJAX::get_endpoint( "%%endpoint%%" ),
				'apply_coupon_nonce' => wp_create_nonce( 'apply-coupon' ),
				'debug_mode' => defined( 'WP_DEBUG' ) && WP_DEBUG,
			] );
		}
	}

	add_action( 'wp_enqueue_scripts', 'storms_wc_checkout_coupon_scripts' );

}
