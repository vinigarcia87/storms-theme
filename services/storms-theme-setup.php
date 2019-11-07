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
 * Theme Setup file
 * Here we setup all configurations for the theme
 */

use StormsFramework\Storms;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( ! function_exists( 'theme_setup' ) ) {
    // Theme setup
    function storms_theme_setup() {
        // Enable backend support
        add_theme_support( 'style-backend' );
        // Enable frontend support
        add_theme_support( 'style-frontend' );
        // Enable layout support
        add_theme_support( 'style-layout' );
        // Enable template support
        add_theme_support( 'theme-layouts');
        // Enable bootstrap support
        add_theme_support( 'use-bootstrap' );
        // Enable woocommerce support
        add_theme_support( 'use-woocommerce' );

        // YOST SEO Breadcrumbs
        add_theme_support( 'yoast-seo-breadcrumbs');
    }
    add_action( 'after_setup_theme', 'storms_theme_setup' );
}

if( ! function_exists( 'storms_define_theme_options' ) ) {
    // Define storms framework options
    function storms_define_theme_options() {
        update_option( 'load_external_jquery', true ); // Load jquery from Google CDN

        update_option( 'meta_description' , '' );
        update_option( 'meta_keywords' , '' );

        update_option( 'number_of_footer_sidebars', 4 );
        update_option( 'footer_size_col_1', 'sidebar-footer-top col-sm-12 col-md-5' );
        update_option( 'footer_size_col_2', 'sidebar-footer-left col-sm-4 col-md-2' );
        update_option( 'footer_size_col_3', 'sidebar-footer-mid col-sm-4 col-md-2 no-padding-left' );
        update_option( 'footer_size_col_4', 'sidebar-footer-right col-sm-4 col-md-3' );

        // Define WooCommerce product and shop pages layout
        update_option( 'product_layout', '2c-r' );
        update_option( 'shop_layout', '1c-r' );
    }
    add_action( 'init', 'storms_define_theme_options' );
}
