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
 * Storms WooCommerce YITH Wishlist file
 * This code customize the YITH Wishlist
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if( \StormsFramework\Helper::is_woocommerce_activated() ) {

	// Required plugin: YITH Wishlist
	if( defined( 'YITH_WCWL' ) ) {

		// Incluindo os scripts de manipulaçao do YITH Wishlist
		function storms_wc_yith_wishlist_scripts() {

			wp_enqueue_script('storms-wc-yith-wishlist-script',
				\StormsFramework\Helper::get_asset_url( '/js/storms-wc-yith-wishlist' . ( ( defined( 'WP_DEBUG' ) && WP_DEBUG ) ? '' : '.min' ) . '.js' ),
				array( 'jquery' ), STORMS_FRAMEWORK_VERSION, true );

			// Add WordPress data to a Javascript file
			wp_localize_script( 'storms-wc-yith-wishlist-script', 'storms_wc_yith_wishlist_vars', [
				'ajax_url' => admin_url( 'admin-ajax.php' ),
				'wc_ajax_url' => WC_AJAX::get_endpoint( "%%endpoint%%" ),
				'debug_mode' => defined( 'WP_DEBUG' ) && WP_DEBUG,
			] );
		}

		add_action( 'wp_enqueue_scripts', 'storms_wc_yith_wishlist_scripts' );

		function storms_wc_wishlist_link() {
			echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
		}
		add_action( 'woocommerce_after_add_to_cart_button', 'storms_wc_wishlist_link' );
		add_action( 'storms_wc_after_add_to_cart_btn', 'storms_wc_wishlist_link' );

		function storms_wc_yith_wcwl_ajax_update_count() {
			wp_send_json( array(
				'count' => yith_wcwl_count_all_products()
			) );
		}
		add_action( 'wp_ajax_yith_wcwl_update_wishlist_count', 'storms_wc_yith_wcwl_ajax_update_count' );
		add_action( 'wp_ajax_nopriv_yith_wcwl_update_wishlist_count', 'storms_wc_yith_wcwl_ajax_update_count' );
	}

}
