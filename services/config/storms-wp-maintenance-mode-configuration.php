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
 * WP Maintenance Mode Configuration file
 * Here we setup the configurations for WP Maintenance Mode plugin
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Check for wp-maintenance-mode plugin
if ( \StormsFramework\Helper::is_plugin_activated( 'wp-maintenance-mode/wp-maintenance-mode.php' ) ) {

	if( ! function_exists( 'storms_define_wp_maintenance_mode_options' ) ) {

		// Define WordPress options
		function storms_define_wp_maintenance_mode_options() {

			// Only setup if user is an admin
			if ( ! current_user_can( 'manage_options' ) ) {
				return;
			}

			$wpmm_settings = get_option('wpmm_settings');

			//$wpmm_settings['general']['status'] = 1; // 1 to force maintenance mode
			$wpmm_settings['general']['backend_role'] = array('shop_manager');
			$wpmm_settings['general']['frontend_role'] = array('shop_manager');
			$wpmm_settings['general']['exclude'] = array('feed', 'wp-login', 'login', 'minha-conta');

			update_option('wpmm_settings', $wpmm_settings);

		}
		add_action( 'admin_init', 'storms_define_wp_maintenance_mode_options' );

	}

}
