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
 * Correios Configuration file
 * Here we setup the configurations for Correios
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( \StormsFramework\Helper::is_plugin_activated( 'woocommerce-correios/woocommerce-correios.php' ) ) {

	if( ! function_exists( 'storms_define_correios_options' ) ) {

		function storms_define_correios_options() {

			// Only setup if user is an admin
			if ( ! current_user_can( 'manage_options' ) ) {
				return;
			}

			$woocommerce_correios_settings = array(

				// Tabela do histórico de rastreamento
				'tracking' 				  => '',
				'tracking_enable' 		  => 'no',
				'tracking_login' 		  => '',
				'tracking_password' 	  => '',
				'tracking_debug' 		  => 'no',
				// Autopreenchimento de endereços
				'autofill_addresses' 	  => '',
				'autofill_enable' 		  => 'yes',
				'autofill_validity' 	  => 'forever',
				'autofill_force' 		  => 'yes',
				'autofill_empty_database' => '',
				'autofill_debug' 		  => '',

			);

			update_option( 'woocommerce_correios-integration_settings', $woocommerce_correios_settings );
		}
		add_action( 'admin_init', 'storms_define_correios_options' );

	}

}
