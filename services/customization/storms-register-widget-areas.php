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

/**
 * Register wp_nav_menu() menus
 * Main Menu
 * @link http://codex.wordpress.org/Function_Reference/register_nav_menus
 */
function storms_register_menus() {
	if( \StormsFramework\Helper::get_option( 'storms_add_storms_menu', 'yes' ) ) {
		register_nav_menus(array(
			'main_menu' => __( 'Main Menu', 'storms' ),
		));
	}
}
add_action( 'init', 'storms_register_menus' );
