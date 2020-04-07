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
 * Storms WooCommerce Cart file
 * General customizations on WooCommerce pages
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( \StormsFramework\Helper::is_woocommerce_activated() ) {

	function storms_wc_cart_init() {

		if( is_cart() ) {

			add_action( 'wp_enqueue_scripts', 'storms_wc_cart_register_scripts' );
		}
	}
	add_action( 'wp', 'storms_wc_cart_init' );

	//<editor-fold desc="Frontend modifications">

	/**
	 * Register the scripts for the cart manipulation
	 */
	function storms_wc_cart_register_scripts() {

		if( is_cart() ) {

			wp_register_script( 'jquery-mask',
				\StormsFramework\Helper::get_asset_url(  '/js/jquery/jquery.mask.min.js' ), array( 'jquery' ), '1.14.16', true );

			wp_enqueue_script( 'storms-wc-shipping-calculator-in-product-script',
				\StormsFramework\Helper::get_asset_url('/js/storms-wc-cart' . ( ( defined( 'WP_DEBUG' ) && WP_DEBUG ) ? '' : '.min' ) . '.js' ),
				array( 'jquery', 'jquery-mask' ), STORMS_FRAMEWORK_VERSION, true );

		}
	}

	//</editor-fold>
}
