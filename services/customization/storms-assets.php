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

		// Adiciona o script que verifica qual media-query esta ativa e inclui uma classe informando
		wp_enqueue_script( 'storms-media-query-breakpoints-script',
			\StormsFramework\Helper::get_asset_url('/js/src/storms-media-query-breakpoints' . ( ( defined( 'WP_DEBUG' ) && WP_DEBUG ) ? '' : '.min' ) . '.js'), array('jquery'),
			STORMS_FRAMEWORK_VERSION, true );
		// Add WordPress data to a Javascript file
		wp_localize_script( 'storms-media-query-breakpoints-script', 'storms_media_query_breakpoints_vars', [
			'resizeMonitor'  => true, // Check when window is resized or run only on start
		] );

		// Adiciona o script que monitora se o nav do menu principal esta 'grudado' no topo
		wp_enqueue_script( 'storms-sticky-nav-observer-script',
			\StormsFramework\Helper::get_asset_url('/js/storms-sticky-nav-observer' . ( ( defined( 'WP_DEBUG' ) && WP_DEBUG ) ? '' : '.min' ) . '.js'), array('jquery', 'storms-media-query-breakpoints-script'),
			STORMS_FRAMEWORK_VERSION, true );

		/*
		// Adiciona o script que monitora se o nav do menu principal esta 'grudado' no topo
		wp_enqueue_script( 'storms-sticky-header-script',
			\StormsFramework\Helper::get_asset_url('/js/storms-sticky-header' . ( ( defined( 'WP_DEBUG' ) && WP_DEBUG ) ? '' : '.min' ) . '.js'), array('jquery'),
			STORMS_FRAMEWORK_VERSION, true );

		// Add WordPress data to a Javascript file
		wp_localize_script( 'storms-sticky-header-script', 'storms_sticky_header_vars', [
			'alturaHeader'  => 160, // Informar a altura do header - elemento que contem o menu
			'alturaMenu'    => 65,  // Informar a altura do menu - elemento que sera sticky no top
			'wrapMarginTop' => 75,	// Informar a margin adequada para o wrap - o valor precisa compensar o scroll do menu
		] );
		*/

		// Adiciona o script que torna a imagem do produto clickavel
		if( \StormsFramework\Helper::is_woocommerce_activated() && is_product() ) {
			wp_enqueue_script('storms-improve-product-image-script',
				\StormsFramework\Helper::get_asset_url('/js/storms-improve-product-image' . ((defined('WP_DEBUG') && WP_DEBUG) ? '' : '.min') . '.js'), array('jquery'),
				STORMS_FRAMEWORK_VERSION, true);
		}

		// Adiciona o script principal - /js/scripts.js
		wp_enqueue_script( 'main-script',
			\StormsFramework\Helper::get_asset_url('/js/scripts' . ( ( defined( 'WP_DEBUG' ) && WP_DEBUG ) ? '' : '.min' ) . '.js'), array('jquery'),
			STORMS_FRAMEWORK_VERSION, true );
		// Add WordPress data to a Javascript file
		wp_localize_script( 'main-script', 'storms_main_vars', [
			'ajax_url' => admin_url('admin-ajax.php'),
			'wc_ajax_url' => WC_AJAX::get_endpoint("%%endpoint%%")
		] );
	}

	add_action( 'wp_enqueue_scripts', 'storms_frontend_scripts' );

}
