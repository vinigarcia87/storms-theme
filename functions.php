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


require_once 'services/storms-temporary.php';

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
	}
	//add_action( 'init', 'storms_testing' );
}

function storms_inspect_scripts() {
    $wp_scripts = wp_scripts();
    \StormsFramework\Helper::debug( $wp_scripts->queue );
}
//add_action( 'wp_head', 'storms_inspect_scripts', 999 );

