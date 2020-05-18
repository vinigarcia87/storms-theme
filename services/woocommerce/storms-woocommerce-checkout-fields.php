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
 * Storms WooCommerce Checkout Fields file
 * Changes to checkout fields, like the order they appear on screen
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( \StormsFramework\Helper::is_woocommerce_activated() ) {

	//<editor-fold desc="Field order modifications">

	/**
	 * Ordenamos os campos de billing, para ajustar campos no local desejado
	 * Return an array of billing fields in order
	 */
	function storms_wc_checkout_fields_order_billing_fields() {
		$order = array(
			"billing_first_name" 		=> 10,
			"billing_last_name" 		=> 20,
			"billing_email" 			=> 30,

			"billing_phone" 			=> 40,
			"billing_cellphone" 		=> 50,	// ecfb plugin
			"billing_birthdate" 		=> 60,	// ecfb plugin
			"billing_sex" 				=> 70,	// ecfb plugin

			"billing_persontype" 		=> 80,	// ecfb plugin

			"billing_cpf" 				=> 90,	// ecfb plugin
			"billing_rg"				=> 100,	// ecfb plugin

			"billing_company" 			=> 110,
			"billing_cnpj" 				=> 120,	// ecfb plugin
			"billing_ie" 				=> 130,	// ecfb plugin

			"billing_country" 			=> 160,
			"billing_postcode" 			=> 170,
			"billing_address_1" 		=> 180,
			"billing_number" 			=> 190,	// ecfb plugin
			"billing_address_2" 		=> 200,
			"billing_neighborhood" 		=> 210,	// ecfb plugin
			"billing_city" 				=> 220,
			"billing_state" 			=> 230,
		);

		return $order;
	}

	//</editor-fold>

	/**
	 * Reorder billing fields in WooCommerce Checkout
	 * @link : http://wordpress.stackexchange.com/a/127490/54025
	 */
	function storms_wc_checkout_fields_checkout_order_fields( $fields ) {

		$order = storms_wc_checkout_fields_order_billing_fields();

		foreach( $order as $field => $priority ) {
			if( isset( $fields["billing"][$field] ) ) {
				$fields["billing"][$field]['priority'] = $priority;
			}
		}

		return $fields;
	}
	add_filter( 'woocommerce_checkout_fields', 'storms_wc_checkout_fields_checkout_order_fields', 10 );

	/**
	 * Reorder billing fields in WooCommerce Address To Edit
	 */
	function storms_wc_checkout_fields_address_to_edit( $address, $load_address ) {

		$order = storms_wc_checkout_fields_order_billing_fields();

		if( $load_address == 'billing' ) {
			foreach( $order as $field => $priority ) {
				if( isset( $address[$field] ) ) {
					$address[$field]['priority'] = $priority;
				}
			}
		}

		return $address;
	}
	add_filter( 'woocommerce_address_to_edit', 'storms_wc_checkout_fields_address_to_edit', 10, 2 );
}
