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
 * Theme Setup file
 * Here we setup all configurations for the theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( ! function_exists( 'theme_setup' ) ) {
    // Theme setup
    function storms_theme_setup() {
        // Enable backend support
        add_theme_support( 'style-backend' );
        // Enable branding support
        add_theme_support( 'brand-customization' );
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

		update_option('load_external_jquery', 'yes'); // Load jquery from Google CDN

		update_option('number_of_footer_sidebars', 4);
		update_option('footer_size_col_1', 'sidebar-footer-top col-sm-12');
		update_option('footer_size_col_2', 'sidebar-footer-left col-sm-4');
		update_option('footer_size_col_3', 'sidebar-footer-mid col-sm-4');
		update_option('footer_size_col_4', 'sidebar-footer-right col-sm-4');

		// Define WooCommerce product and shop pages layout
		update_option('product_layout', '1c');
		update_option('shop_layout', '2c-l');
    }
    add_action( 'admin_init', 'storms_define_theme_options' );
}
