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
 * Storms WooCommerce Improve Refreshed Fragments file
 *
 * Automatically detect when a request contains GET[‘wc-ajax’] = get_refreshed_fragments
 * and will check that the WooCommerce cart is empty, to avoid any issues with the content of the cart .
 * If the cart condition is respected, we will save the request content into a transient, which will
 * be returned the next time the same request will be executed.
 * @see https://docs.wp-rocket.me/article/1100-optimize-woocommerce-get-refreshed-fragments
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if( \StormsFramework\Helper::is_woocommerce_activated() ) {

	/**
	 * Checks if the request is for get_refreshed_fragments and the cart is empty
	 *
	 * @return boolean
	 */
	function storms_is_get_refreshed_fragments() {
		if ( ! isset( $_GET['wc-ajax'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
			return false;
		}

		if ( 'get_refreshed_fragments' !== $_GET['wc-ajax'] ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
			return false;
		}

		if ( ! empty( $_COOKIE['woocommerce_cart_hash'] ) ) {
			return false;
		}

		if ( ! empty( $_COOKIE['woocommerce_items_in_cart'] ) ) {
			return false;
		}

		return true;
	}

	/**
	 * Gets the empty cart cache
	 *
	 * @return string
	 */
	function storms_get_cache_empty_cart() {
		return get_transient( 'storms_get_refreshed_fragments_cache' );
	}

	/**
	 * Saves the empty cart JSON in a transient
	 *
	 * @param string $content Current buffer content.
	 * @return string
	 */
	function storms_save_cache_empty_cart( $content ) {
		set_transient( 'storms_get_refreshed_fragments_cache', $content, 7 * DAY_IN_SECONDS );
		return $content;
	}

	/**
	 * Serves the empty cart cache
	 *
	 * @return void
	 */
	function storms_serve_cache_empty_cart() {
		if ( ! storms_is_get_refreshed_fragments() ) {
			return;
		}

		$cart = storms_get_cache_empty_cart();

		if ( false !== $cart ) {
			@header( 'Content-Type: application/json; charset=' . get_option( 'blog_charset' ) ); // phpcs:ignore WordPress.PHP.NoSilencedErrors.Discouraged
			echo $cart; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Dynamic content is properly escaped in the view.
			die();
		}
	}

	/**
	 * Creates the empty cart cache
	 *
	 * @return void
	 */
	function storms_cache_empty_cart() {
		if ( ! storms_is_get_refreshed_fragments() ) {
			return;
		}

		$cart = storms_get_cache_empty_cart();

		if ( false !== $cart ) {
			return;
		}

		ob_start( 'save_cache_empty_cart' );
	}

	/**
	 * Deletes the empty cart cache
	 *
	 * @return void
	 */
	function storms_delete_cache_empty_cart() {
		delete_transient( 'storms_get_refreshed_fragments_cache' );
	}

	/**
	 * Filters activation of WooCommerce empty cart caching
	 *
	 * @param bool true to activate, false to deactivate.
	 */
	if ( apply_filters( 'storms_cache_wc_empty_cart', true ) ) {

		add_action( 'after_setup_theme', 'storms_serve_cache_empty_cart', 11 );
		add_action( 'template_redirect', 'storms_cache_empty_cart', -1 );
		add_action('switch_theme', 'storms_delete_cache_empty_cart' );

	}

}
