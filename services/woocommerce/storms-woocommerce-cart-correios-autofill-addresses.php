<?php
/**
 * Storms Websolutions (http://storms.com.br/)
 *
 * @author    Vinicius Garcia | vinicius.garcia@storms.com.br
 * @copyright (c) Copyright 2012-2020, Storms Websolutions
 * @license   GPLv2 - GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @package   Storms
 * @version   1.0.0
 *
 * Storms WooCommerce Cart Correios Autofill Addresses file
 * Apply the Correios autofill address to woocommerce cart shipping calculator
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( \StormsFramework\Helper::is_plugin_activated( 'woocommerce-correios/woocommerce-correios.php' ) ) {

	/**
	 * Adicionamos o script para preencher endereço no carrinho
	 * O arquivo abaixo eh uma copia alterada do original 'wp-content/plugins/woocommerce-correios/assets/js/frontend/autofill-address.js'
	 * O original so funciona no checkout, entao alteramos para que funcione tbem no carrinho
	 */
	function storms_woocommerce_cart_correios_autofill_addresses_frontend_scripts() {
		if ( is_cart() ) {
			$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

			wp_enqueue_script( 'storms-wc-cart-correios-autofill-addresses',
				\StormsFramework\Helper::get_asset_url('/js/storms-wc-cart-autofill-address' . ( ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min' ) . '.js')
				, array( 'jquery', 'jquery-blockui' ), WC_CORREIOS_VERSION, true );

			wp_localize_script(
				'storms-wc-cart-correios-autofill-addresses',
				'StormsWCCartCorreiosAutofillAddressParams',
				array(
					'url'   => WC_AJAX::get_endpoint( 'correios_autofill_address' ),
					'force' => apply_filters( 'woocommerce_correios_autofill_addresses_force_autofill', 'no' ),
				)
			);
		}
	}
	add_action( 'wp_enqueue_scripts', 'storms_woocommerce_cart_correios_autofill_addresses_frontend_scripts' );

}
