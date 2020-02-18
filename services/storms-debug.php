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
 * Storms Debug file
 * Here we have some debug functions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function storms_inspect_scripts() {
	$wp_scripts = wp_scripts();
	\StormsFramework\Helper::debug( $wp_scripts->queue, 'storms_inspect_scripts' );
}
//add_action( 'wp_head', 'storms_inspect_scripts', 999 );

function storms_log_hook_calls() {
	if ( WP_DEBUG_LOG ) {
		error_log( date("d-m-Y, H:i:s") . ": " . current_filter() . " - " . did_action( current_filter() ) . "\n", 3, WP_CONTENT_DIR . '/storms-hook-calls-log.log' );
	}
}
//add_action( 'all', 'storms_log_hook_calls' );

function storms_log_widgets() {
	if ( empty ( $GLOBALS['wp_widget_factory'] ) )
		return;

	$widgets = array_keys( $GLOBALS['wp_widget_factory']->widgets );
	\StormsFramework\Helper::debug( var_export( $widgets, true ), 'storms_log_widgets' );
}
//add_action( 'wp_footer', 'storms_log_widgets' );

