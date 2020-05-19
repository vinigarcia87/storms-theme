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
 * storms-environment-config.php
 * This file makes sure that some configurations exclusive from some environment, will not be able on another environment
 * For example, 'WooCommerce Force HTTPS on Checkout' must be TRUE on Production and Testing, but FALSE on Development
 */

defined( 'ABSPATH' ) || exit;

function storms_environment_options() {

	if (SF_ENV == 'DEV') {

		// '1' if site visible by search engine, and '0' if site not visible by search engine
		update_option('blog_public', '0');

		update_option('woocommerce_force_ssl_checkout', 'no');

		update_option('woocommerce_shipping_debug_mode', 'no');

		//$wc_pagseguro_options = get_option( 'woocommerce_pagseguro_settings' );
		//$wc_pagseguro_options['sandbox'] = 'yes';
		//update_option( 'woocommerce_pagseguro_settings', $wc_pagseguro_options );

	} elseif (SF_ENV == 'TST') {

		// '1' if site visible by search engine, and '0' if site not visible by search engine
		update_option('blog_public', '0');

		update_option('woocommerce_force_ssl_checkout', 'no');

		update_option('woocommerce_shipping_debug_mode', 'yes');

		//$wc_pagseguro_options = get_option( 'woocommerce_pagseguro_settings' );
		//$wc_pagseguro_options['sandbox'] = 'yes';
		//update_option( 'woocommerce_pagseguro_settings', $wc_pagseguro_options );

	} else {

		// '1' if site visible by search engine, and '0' if site not visible by search engine
		update_option('blog_public', '1');

		update_option('woocommerce_force_ssl_checkout', 'yes');

		update_option('woocommerce_shipping_debug_mode', 'no');

	}
}
add_action( 'admin_init', 'storms_environment_options' );

function storms_environment_deactivate_plugins() {

    if( SF_ENV == 'DEV' ) {

        deactivate_plugins( 'autoptimize/autoptimize.php' );
        deactivate_plugins( 'backwpup/backwpup.php' );
        deactivate_plugins( 'google-analytics-for-wordpress/googleanalytics.php' );
        deactivate_plugins( 'hummingbird-performance/wp-hummingbird.php' );
        deactivate_plugins( 'better-wp-security/better-wp-security.php' );
        deactivate_plugins( 'leverage-browser-caching/leverage-browser-caching.php' );
        deactivate_plugins( 'wp-super-cache/wp-cache.php' );
        deactivate_plugins( 'wp-optimize/wp-optimize.php' );

    } elseif( SF_ENV == 'TST' ) {

        deactivate_plugins( 'google-analytics-for-wordpress/googleanalytics.php' );
		deactivate_plugins( 'query-monitor/query-monitor.php' );

	} elseif( SF_ENV == 'PRD' ) {
		deactivate_plugins( 'query-monitor/query-monitor.php' );
    }
}
//add_action( 'admin_init', 'storms_environment_deactivate_plugins' );
