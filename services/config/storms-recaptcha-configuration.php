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
 * reCaptcha Configuration file
 * Here we setup the configurations for reCaptcha
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( \StormsFramework\Helper::is_plugin_activated( 'google-captcha/google-captcha.php' ) ) {

	if( ! function_exists( 'storms_define_recaptcha_options' ) ) {

		function storms_define_recaptcha_options() {
			global $gglcptch_plugin_info;

			// Only setup if user is an admin
			if ( ! current_user_can( 'manage_options' ) ) {
				return;
			}

			$gglcptch_options = array(
				'allowlist_message'			=> __( 'You are in the allow list', 'google-captcha' ),
				'public_key'				=> '',
				'private_key'				=> '',
				'login_form'				=> 1,
				'registration_form'			=> 1,
				'reset_pwd_form'			=> 1,
				'comments_form'				=> 1,
				'contact_form'				=> 1,
				'testimonials'				=> 0,
				'theme_v2'					=> 'light',
				'recaptcha_version'			=> 'v3',
				'plugin_option_version'		=> $gglcptch_plugin_info['Version'],
				'first_install'				=>	strtotime( '01-01-2020' ),
				'display_settings_notice'	=> 0,
				'suggest_feature_banner'	=> 1,
				'score_v3'                  => 0.5,
				'hide_badge'                => 0,
				'disable_submit_button'     => 0,
				'use_globally'              => 0,
				'hide_premium_options'		=> array( 1 ),
			);

			if ( get_option( 'gglcptch_options' ) ) {
				$gglcptch_options = array_merge( get_option( 'gglcptch_options' ), $gglcptch_options );
			}

			update_option( 'gglcptch_options', $gglcptch_options );
		}
		add_action( 'admin_init', 'storms_define_recaptcha_options' );

	}

	if( \StormsFramework\Helper::is_woocommerce_activated() ) {

		/**
		 * Add reCaptcha to WooCommerce pages
		 */
		function storms_woocommerce_add_recaptcha() {
			do_shortcode( '[bws_google_captcha]' );
		}
		add_action( 'woocommerce_after_customer_login_form', 'storms_woocommerce_add_recaptcha' );
		add_action( 'woocommerce_after_lost_password_form', 'storms_woocommerce_add_recaptcha' );
		add_action( 'woocommerce_after_reset_password_form', 'storms_woocommerce_add_recaptcha' );
		add_action( 'woocommerce_after_checkout_form', 'storms_woocommerce_add_recaptcha' );
	}

}
