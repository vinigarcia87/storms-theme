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
 * Temporary file
 * Just stuff we gonna delete later
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// @TODO Revisar!!
//require_once 'storms-woocommerce-changes.php';

/**
 * 					REVISAR ESSES CODIGOS!
 * =====================================================================================================================
 */

/*
add_action( 'rest_api_init', function () {
    register_rest_route( 'wc-storms/v1', '/clean-user-session', array(
        'methods' => 'POST',
        'callback' => 'clean_user_session',
    ) );
} );
function clean_user_session( WP_REST_Request $request ) {
    $user_id = 2;
    $session_handler = new WC_Session_Handler();
    $session = $session_handler->get_session($user_id);

    \StormsFramework\Helper::debug( $session, 'SESSION DE OUTRO USUARIO ' . $user_id . '!' );

    // TODO Unset any shipping_for_package_ in the session
    unset( $session['shipping_for_package_0'] );

    storms_save_cache_data( $user_id, $session );
}
function storms_save_cache_data( $customer_id, $data ) {
    global $wpdb;

    $wpdb->query(
        $wpdb->prepare(
            "INSERT INTO {$wpdb->prefix}woocommerce_sessions (`session_key`, `session_value`, `session_expiry`) VALUES (%s, %s, %d)
                ON DUPLICATE KEY UPDATE `session_value` = VALUES(`session_value`), `session_expiry` = VALUES(`session_expiry`)",
            $customer_id,
            maybe_serialize( $data ),
            time()
        )
    );

    wp_cache_set( WC_Cache_Helper::get_cache_prefix( WC_SESSION_CACHE_GROUP ) . $customer_id, $data, WC_SESSION_CACHE_GROUP, time() - 3600 );
}
add_filter( 'woocommerce_package_rates', function( $package_rates, $package ) {

    \StormsFramework\Helper::debug( 'PEGOU O SHIPPING FORA DO CACHE! woocommerce_shipping_debug_mode = ' . get_option( 'woocommerce_shipping_debug_mode', 'no' ) );

    return $package_rates;
}, 10, 2 );
*/
