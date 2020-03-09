<?php
/**
 * Storms Websolutions (http://storms.com.br/)
 *
 * @author    Vinicius Garcia | vinicius.garcia@storms.com.br
 * @copyright (c) Copyright 2012-2019, Storms Websolutions
 * @license   GPLv2 - GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @package   Storms
 * @version   4.0.0
 *
 * Functions file
 * Here we load all code we gonna need
 */

defined( 'ABSPATH' ) || exit;

/*********************************
 *  Configuração Storms Framework
 *********************************/

// Define the Storms Theme version
if ( !defined( 'STORMS_THEME_VERSION' ) ) {
	define( 'STORMS_THEME_VERSION', '1.0.0' );
}

// System Environment
if ( !defined( 'SF_ENV' ) ) {
    define( 'SF_ENV', 'DEV' );
}

// Define the System Version
if ( !defined( 'STORMS_SYSTEM_VERSION' ) ) {
	define( 'STORMS_SYSTEM_VERSION', 'YYYY.MM.DD' );
}

// Require services of this theme
require_once 'services/storms-theme-setup.php';
require_once 'services/storms-assets.php';
require_once 'services/storms-environment-config.php';
require_once 'services/storms-wp-default-configuration.php';

// Theme customizations
require_once 'services/storms-woocommerce-checkout-coupon.php';

//require_once 'services/storms-debug.php';
//require_once 'services/storms-temporary.php';

/**
 * Add wc recent products shortcode in 404 page and on search page when nothing is found
 */
if( ! function_exists( 'storms_show_recent_products' ) ) {
	function storms_show_recent_products()
	{
		echo apply_filters('storms_show_recent_products_title', '<h2>' . __('Recent Products', 'storms') . '</h2>');
		echo WC_Shortcodes::recent_products(array(
			'limit' => '8',
			'columns' => '4',
			'orderby' => 'date',
			'order' => 'DESC',
		));
	}
}
add_action( 'storms_after_404_content', 'storms_show_recent_products', 10 );
add_action( 'woocommerce_no_products_found', 'storms_show_recent_products', 20 );

/**
 * =====================================================================================================================
 */

/**
 * You need to testing things?
 * Do it here!
 */
if( ! function_exists( 'storms_testing' ) ) {
	function storms_testing() {
		\StormsFramework\Helper::debug( 'Debugging' );

		\StormsFramework\Helper::debug( array(
			'ajax_url'    => WC()->ajax_url(),
			'wc_ajax_url' => WC_AJAX::get_endpoint( '%%endpoint%%' ),
		) );
	}
	add_action( 'init', 'storms_testing' );
}

