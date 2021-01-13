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
 * Storms Lazy Load by WP Rocket Configuration file
 * General customizations for Lazy Load by WP Rocket
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( \StormsFramework\Helper::is_plugin_activated( 'rocket-lazy-load/rocket-lazy-load.php' ) ) {

	if( ! function_exists( 'storms_define_rocket_lazy_load_options' ) ) {

		function storms_define_rocket_lazy_load_options() {

			// Only setup if user is an admin
			if ( ! current_user_can( 'manage_options' ) ) {
				return;
			}

			update_option( 'rocket_lazyload_options', [ 'images' => '1', 'iframes' => '1', 'youtube' => '1' ] );

		}
		add_action( 'admin_init', 'storms_define_rocket_lazy_load_options' );

	}

}
