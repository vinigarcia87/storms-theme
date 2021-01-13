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
 * Storms REST API Log Configuration file
 * General customizations for REST API Log
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( \StormsFramework\Helper::is_plugin_activated( 'wp-rest-api-log/wp-rest-api-log.php' ) ) {

	if( ! function_exists( 'storms_define_rest_api_log_options' ) ) {

		// Define REST API Log options
		function storms_define_rest_api_log_options() {

			// Only setup if user is an admin
			if ( ! current_user_can( 'manage_options' ) ) {
				return;
			}

			update_option('wp-rest-api-log-settings-general', array(
				'logging-enabled' 	 => '1',
				'purge-days' 		 => '90',
				'ip-address-display' => 'http_x_forwarded_for'
			) );

			update_option('wp-rest-api-log-settings-routes', array(
				'ignore-core-oembed' => '1',
				'route-log-matching-mode' 		 => 'exclude_matches',
				'route-filters' => "/wc-analytics/\n/wc-admin/"
			) );

		}
		add_action( 'admin_init', 'storms_define_rest_api_log_options' );

	}

}
