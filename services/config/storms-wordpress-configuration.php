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
 * Wordpress Configuration file
 * Here we setup the configurations for Wordpress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( ! function_exists( 'storms_define_wordpress_options' ) ) {

    function storms_define_wordpress_options() {
    	/** @var \WP_Rewrite $wp_rewrite */
		global $wp_rewrite;

		// Only setup if user is an admin
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		// Permalink configuration
		// @ see https://wordpress.stackexchange.com/a/206222/54025
		$permalink = get_option( 'permalink_structure' );
 		if( empty( $permalink ) ) {

			// Add default wp permalink structure
			$wp_rewrite->set_permalink_structure( '/%postname%/' );

			// Needed to force htaccess to be rewrite
			update_option( 'rewrite_rules', false );

			// Flush the rules and tell it to write htaccess
			$wp_rewrite->flush_rules( true );
		}

 		// Qualquer pessoa pode se registrar
		//update_option( 'users_can_register', '1' );

		// Comments configuration
		update_option( 'default_comment_status', 'open' );
		update_option( 'comment_registration', '0' );
		update_option( 'require_name_email', '1' );
		update_option( 'page_comments', '1' );
		update_option( 'comments_per_page', 5 );

		update_option( 'default_pingback_flag', 'no' );
		update_option( 'default_ping_status', 0 );
    }
    add_action( 'admin_init', 'storms_define_wordpress_options' );

}

