<?php
/**
 * Storms Websolutions (http://storms.com.br/)
 *
 * @author    Vinicius Garcia | vinicius.garcia@storms.com.br
 * @copyright (c) Copyright 2012-2019, Storms Websolutions
 * @license   GPLv2 - GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @package   Storms
 * @version   4.0.0
 *
 * WC_Wishlist
 * This code customize the YITH Wishlist
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Required plugin: YITH Wishlist
if( defined( 'YITH_WCWL' ) )
{
    function storms_wishlist_link() {
        echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
    }
    add_action( 'woocommerce_after_add_to_cart_button', 'storms_wishlist_link' );
    add_action( 'storms_wc_after_add_to_cart_btn', 'storms_wishlist_link' );

    function storms_yith_wcwl_ajax_update_count() {
        wp_send_json( array(
            'count' => yith_wcwl_count_all_products()
        ) );
    }
    add_action( 'wp_ajax_yith_wcwl_update_wishlist_count', 'storms_yith_wcwl_ajax_update_count' );
    add_action( 'wp_ajax_nopriv_yith_wcwl_update_wishlist_count', 'storms_yith_wcwl_ajax_update_count' );
}
