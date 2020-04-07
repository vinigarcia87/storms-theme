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
require_once 'services/config/storms-theme-setup.php';
require_once 'services/config/storms-environment-config.php';
require_once 'services/config/storms-wp-default-configuration.php';

/*********************************
 *  Configuração Storms Theme
 *********************************/

// Theme customizations
require_once 'services/customization/storms-assets.php';
require_once 'services/woocommerce/storms-woocommerce-pages.php';
require_once 'services/woocommerce/storms-woocommerce-checkout-coupon.php';
require_once 'services/woocommerce/storms-woocommerce-wishlist.php';
require_once 'services/woocommerce/storms-woocommerce-cart.php';
require_once 'services/woocommerce/storms-woocommerce-shipping-calculator-in-product.php';

//require_once 'services/storms-debug.php';
//require_once 'services/storms-temporary.php';
// JS files yet not included on this theme: storms-autofill-address.js

/**
 * =====================================================================================================================
 */

/**
 * You need to testing things?
 * Do it here!
 */
if( ! function_exists( 'storms_testing' ) ) {
	function storms_testing() {
		\StormsFramework\Helper::debug( 'Debugging Storms Theme', 'Storms Theme' );
	}
	//add_action( 'wp', 'storms_testing' );
}

