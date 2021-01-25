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
 * Storms Debug file
 * Here we have some debug functions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function storms_log_scripts() {
	if( ! is_admin() ) {
		$wp_scripts = wp_scripts();
		\StormsFramework\Helper::debug( $wp_scripts->queue, 'storms_inspect_scripts' );
	}
}
//add_action( 'wp_head', 'storms_log_scripts', 999 );

function storms_log_hook_calls() {
	$current_filter = current_filter();
	$count = did_action( $current_filter );

	if( $count > 0 ) {
		\StormsFramework\Helper::debug( $current_filter . ' - Executed ' . $count . ' times', 'storms_log_hook_calls' );
	}
}
add_action( 'all', 'storms_log_hook_calls' );

function storms_log_widgets() {
	if ( empty ( $GLOBALS['wp_widget_factory'] ) ) {
		return;
	}

	$widgets = array_keys( $GLOBALS['wp_widget_factory']->widgets );
	\StormsFramework\Helper::debug( var_export( $widgets, true ), 'storms_log_widgets' );
}
add_action( 'wp_footer', 'storms_log_widgets' );

