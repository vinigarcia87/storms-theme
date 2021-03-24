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

	// Only setup if user is an admin
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	if ( 'local' === wp_get_environment_type() || 'development' === wp_get_environment_type() ) {

		// '1' if site visible by search engine, and '0' if site not visible by search engine
		update_option( 'blog_public', '0' );

		// Website admin email
		update_option( 'admin_email', 'vinicius.garcia@storms.com.br' );

	} elseif ( 'staging' === wp_get_environment_type()  || 'testing' === wp_get_environment_type() ) {

		// '1' if site visible by search engine, and '0' if site not visible by search engine
		update_option( 'blog_public', '0' );

		// Website admin email
		update_option( 'admin_email', 'vinicius.garcia@storms.com.br' );

	} else {

		// '1' if site visible by search engine, and '0' if site not visible by search engine
		update_option( 'blog_public', '1' );

		// Website admin email
		// update_option( 'admin_email', \StormsFramework\Helper::get_shop_contact_item( 'email' ) );

	}
}
add_action( 'admin_init', 'storms_environment_options', 100 );

function storms_environment_deactivate_plugins() {

	// Only setup if user is an admin
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	if ( 'local' === wp_get_environment_type() || 'development' === wp_get_environment_type() ) {

        deactivate_plugins( 'autoptimize/autoptimize.php' );
        deactivate_plugins( 'backwpup/backwpup.php' );
        deactivate_plugins( 'google-analytics-for-wordpress/googleanalytics.php' );
        deactivate_plugins( 'hummingbird-performance/wp-hummingbird.php' );
        deactivate_plugins( 'better-wp-security/better-wp-security.php' );
        deactivate_plugins( 'leverage-browser-caching/leverage-browser-caching.php' );
        deactivate_plugins( 'wp-super-cache/wp-cache.php' );
        deactivate_plugins( 'wp-optimize/wp-optimize.php' );

	} elseif ( 'staging' === wp_get_environment_type()  || 'testing' === wp_get_environment_type() ) {

        deactivate_plugins( 'google-analytics-for-wordpress/googleanalytics.php' );
		deactivate_plugins( 'query-monitor/query-monitor.php' );

	} elseif( wp_get_environment_type() == 'production' ) {
		deactivate_plugins( 'query-monitor/query-monitor.php' );
    }
}
//add_action( 'admin_init', 'storms_environment_deactivate_plugins' );
