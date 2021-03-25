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
 * Easy WP SMTP Configuration file
 * Here we setup the configurations for Easy WP SMTP
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( \StormsFramework\Helper::is_plugin_activated( 'easy-wp-smtp/easy-wp-smtp.php' ) ) {

	if( ! function_exists( 'storms_define_easy_wp_smtp_options' ) ) {

		function storms_define_easy_wp_smtp_options() {

			// Only setup if user is an admin
			if ( ! current_user_can( 'manage_options' ) ) {
				return;
			}

			$swpsmtp_options = get_option( 'swpsmtp_options' ) ?? [];

			$swpsmtp_options = array_merge( $swpsmtp_options, [
				'from_email_field' 		  => 'contato@storms.com.br',
				'from_name_field' 		  => 'Storms Websolutions',
				'force_from_name_replace' => 0,
				'sub_mode' 				  => 0,
				'reply_to_email' 		  => '',
				'bcc_email' 			  => '',
				'email_ignore_list' 	  => '',
				'enable_domain_check' 	  => 0,
			] );

			//$easy_wp_smtp = EasyWPSMTP::get_instance();
			$smtp_settings = $swpsmtp_options['smtp_settings'] ?? [];
			$swpsmtp_options['smtp_settings'] = array_merge( $smtp_settings, [
				'host' 			  	  => 'smtp.gmail.com',
				'type_encryption' 	  => 'ssl',
				'port' 			  	  => '465',
				'autentication'   	  => 'yes',
				// Access your gmail account (https://myaccount.google.com/) > Security > Less secure apps > Enabled
				'username' 		  	  => 'vinicius.garcia@storms.com.br',
				//'password' 		  	  => '', // $easy_wp_smtp->encrypt_password( $smtp_password ),
				'enable_debug' 	  	  => 0,
				'insecure_ssl' 	  	  => 0,
				'encrypt_pass' 	  	  => 0
			] );

			update_option( 'swpsmtp_options', $swpsmtp_options );

		}
		add_action( 'admin_init', 'storms_define_easy_wp_smtp_options', 10 );

	}

}
