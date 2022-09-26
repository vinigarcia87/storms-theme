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

//<editor-fold desc="Debug functions">

class StormsBuffer {
	static $return = [];
}

function storms_log_hook_calls() {

	if( ! isset( StormsBuffer::$return['storms_log_hook_calls'] ) ) {
		StormsBuffer::$return['storms_log_hook_calls'] = [];
	}

	$current_filter = current_filter();
	$count = did_action( $current_filter );

	if( in_array( $current_filter, [ 'load_textdomain', 'unload_textdomain' ] ) ) {
		return;
	}

	if( $count > 0 ) {
		StormsBuffer::$return['storms_log_hook_calls'][] = $current_filter . ' - Executed ' . $count . ' times';
	}
}
add_action( 'all', 'storms_log_hook_calls' );

function storms_shutdown() {
	\StormsFramework\Helper::debug( StormsBuffer::$return['storms_log_hook_calls'], 'storms_log_hook_calls' );
}
add_action( 'shutdown', 'storms_shutdown', 99999 );

function storms_log_widgets() {
	if ( empty ( $GLOBALS['wp_widget_factory'] ) ) {
		return;
	}

	$widgets = array_keys( $GLOBALS['wp_widget_factory']->widgets );
	\StormsFramework\Helper::debug( var_export( $widgets, true ), 'storms_log_widgets' );
}
add_action( 'wp_footer', 'storms_log_widgets' );

function storms_show_cron_jobs() {
	$cron_jobs = get_option( 'cron' );
	\StormsFramework\Helper::debug( $cron_jobs, 'storms_show_cron_jobs' );
}
add_action( 'admin_init', 'storms_show_cron_jobs' );

//</editor-fold>
