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
 * Storms WooCommerce Pages file
 * General customizations on WooCommerce pages
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if( \StormsFramework\Helper::is_woocommerce_activated() ) {

	/**
	 * Add wc recent products shortcode in 404 page and on search page when nothing is found
	 */
	if( ! function_exists( 'storms_show_recent_products' ) ) {
		function storms_show_recent_products()
		{
			echo apply_filters('storms_show_recent_products_title', '<h2>' . __('Recent Products', 'storms') . '</h2>');
			echo WC_Shortcodes::recent_products(array(
				'limit' => '8',
				'columns' => '4',
				'orderby' => 'date',
				'order' => 'DESC',
			));
		}
	}
	add_action( 'storms_after_404_content', 'storms_show_recent_products', 10 );
	add_action( 'woocommerce_no_products_found', 'storms_show_recent_products', 20 );

	/**
	 * Change the position that cross-sell products are displayed on cart page
	 */
	remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
	add_action( 'woocommerce_after_cart', 'woocommerce_cross_sell_display' );
}
