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
 * Assets file
 * Here we load all the theme assets
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( ! function_exists( 'storms_frontend_scripts' ) ) {

	// Incluindo os scripts do theme
	function storms_frontend_scripts() {

		// Adiciona o script principal - /js/scripts.js
		wp_enqueue_script( 'main-script',
			\StormsFramework\Helper::get_asset_url('/js/scripts' . ( ( defined( 'WP_DEBUG' ) && WP_DEBUG ) ? '' : '.min' ) . '.js'), array('jquery'),
			STORMS_FRAMEWORK_VERSION, true );

		// Add WordPress data to a Javascript file
//		wp_localize_script( 'main-script', 'storms_main_vars', [
//			'ajax_url' => admin_url('admin-ajax.php'),
//			'wc_ajax_url' => WC_AJAX::get_endpoint("%%endpoint%%")
//		] );
	}

	add_action( 'wp_enqueue_scripts', 'storms_frontend_scripts' );

}
