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
 * MonsterInsights Google Analytics for Wordpress Configuration file
 * Here we setup the configurations for MonsterInsights Google Analytics for Wordpress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( \StormsFramework\Helper::is_plugin_activated( 'google-analytics-for-wordpress/googleanalytics.php' ) ) {

	if( ! function_exists( 'storms_define_google_analytics_for_wordpress_options' ) ) {

		function storms_define_google_analytics_for_wordpress_options() {

			// Only setup if user is an admin
			if ( ! current_user_can( 'manage_options' ) ) {
				return;
			}

			// Remove all notices that trash the admin area
			remove_action( 'admin_notices', 'monsterinsights_admin_setup_notices' );
			remove_action( 'network_admin_notices', 'monsterinsights_admin_setup_notices' );
			add_filter( 'monsterinsights_get_option_hide_am_notices', '__return_true' );
			add_filter( 'monsterinsights_get_option_network_hide_am_notices', '__return_true' );
			remove_action( 'adminmenu', 'monsterinsights_get_admin_menu_tooltip' );
		}
		add_action( 'admin_init', 'storms_define_google_analytics_for_wordpress_options', 10 );
	}

}
