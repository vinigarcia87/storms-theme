<?php
/**
 * Storms Framework (http://storms.com.br/)
 *
 * @author    Vinicius Garcia | vinicius.garcia@storms.com.br
 * @copyright (c) Copyright 2012-2017, Storms Websolutions
 * @license   GPLv2 - GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @package   Storms
 * @version   1.0.0
 *
 * WordPress Default Configuration file
 * Here we setup the configurations for WordPress that is needed for any website
 * We configure default WooCommerce options here too
 */

use StormsFramework\Storms;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( ! function_exists( 'storms_define_wordpress_options' ) ) {

    // Define WordPress options
    function storms_define_wordpress_options() {

        // Comments configuration
        update_option( 'comment_registration', 'no' );
        update_option( 'page_comments', 'yes' );
        update_option( 'comments_per_page', 5 );

    }
    add_action( 'init', 'storms_define_wordpress_options' );

}

if( ! function_exists( 'storms_define_woocommerce_options' ) ) {

    // Define WooCommerce options
    function storms_define_woocommerce_options() {

        // Image and thumbnail sizes
        update_option( 'woocommerce_single_image_width', 527);
        update_option( 'woocommerce_thumbnail_image_width', 400);

        // Permitir que seus clientes efetuem pedidos sem uma conta
        update_option( 'woocommerce_enable_guest_checkout', 'no' );
        // Permitir que seus clientes criem uma conta durante a finalização da compra
        update_option( 'woocommerce_enable_signup_and_login_from_checkout', 'no' );
        // Permitir que seus clientes façam login em uma conta existente durante a finalização da compra
        update_option( 'woocommerce_enable_checkout_login_reminder', 'no' );

    }
    add_action( 'init', 'storms_define_woocommerce_options' );

}