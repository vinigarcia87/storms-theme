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


	/**
	 * Remove screen-reader-text css class from address_2 field
	 * This class hides the field label and we don't want that
	 *
	 * @param $fields
	 * @return mixed
	 */
	function storms_wc_default_address_fields( $fields ) {

		if( isset( $fields['address_2'] ) ) {

			$fields['address_2']['label_class'] = array_filter( $fields['address_2']['label_class'], function ( $array_item ) {
				return 'screen-reader-text' !== $array_item;
			} );
		}

		return $fields;
	}
	add_filter( 'woocommerce_default_address_fields', 'storms_wc_default_address_fields' );

	/**
	 * Change the billing_neighborhood field to be required
	 *
	 * @param $fields
	 * @return mixed
	 */
	function storms_wcbcf_billing_fields( $fields ) {

		$fields['billing_neighborhood']['required'] = true;

		return $fields;
	}
	add_filter( 'wcbcf_billing_fields', 'storms_wcbcf_billing_fields' );

	/**
	 * Change the shipping_neighborhood field to be required
	 *
	 * @param $fields
	 * @return mixed
	 */
	function storms_wcbcf_shipping_fields( $fields ) {

		$fields['shipping_neighborhood']['required'] = true;

		return $fields;
	}
	add_filter( 'wcbcf_shipping_fields', 'storms_wcbcf_shipping_fields' );

	//<editor-fold desc="Field order modifications">

	/**
	 * Ordenamos os campos de billing, para ajustar campos no local desejado
	 * Return an array of billing fields in order
	 */
	function storms_wc_checkout_fields_order_billing_fields() {
		$fields = [
			'first_name' 		=> 10,
			'last_name' 		=> 20,
			'email' 			=> 30,

			'phone' 			=> 40,
			'cellphone' 		=> 50,	// ecfb plugin
			'birthdate' 		=> 60,	// ecfb plugin
			'sex' 				=> 70,	// ecfb plugin

			'persontype' 		=> 80,	// ecfb plugin

			'cpf' 				=> 90,	// ecfb plugin
			'rg'				=> 100,	// ecfb plugin

			'company' 			=> 110,
			'cnpj' 				=> 120,	// ecfb plugin
			'ie' 				=> 130,	// ecfb plugin

			'country' 			=> 160,
			'postcode' 			=> 170,
			'address_1' 		=> 180,
			'number' 			=> 190,	// ecfb plugin
			'address_2' 		=> 200,
			'neighborhood' 		=> 210,	// ecfb plugin
			'city' 				=> 220,
			'state' 			=> 230,
		];

		return $fields;
	}

	/**
	 * Reorder billing/shipping fields in WooCommerce Checkout
	 *
	 * @param $fields
	 * @return mixed
	 */
	function storms_wc_checkout_fields_checkout_order_fields( $fields ) {

		$fields_ordered = storms_wc_checkout_fields_order_billing_fields();
		foreach( [ 'billing', 'shipping' ] as $field_type ) {
			foreach( $fields_ordered as $field => $priority ) {
				$field_name = $field_type . '_' . $field;
				if( isset( $fields[$field_type][$field_name] ) ) {
					$fields[$field_type][$field_name]['priority'] = $priority;
				}
			}
		}
		return $fields;
	}
	add_filter( 'woocommerce_checkout_fields', 'storms_wc_checkout_fields_checkout_order_fields', 999 );

	/**
	 * Reorder billing/shipping fields in WooCommerce Address To Edit
	 *
	 * @param $address
	 * @param $load_address
	 * @return mixed
	 */
	function storms_wc_checkout_fields_address_to_edit( $fields, $field_type ) {

		$fields_ordered = storms_wc_checkout_fields_order_billing_fields();
		foreach( $fields_ordered as $field => $priority ) {
			$field_name = $field_type . '_' . $field;
			if( isset( $fields[$field_name] ) ) {
				$fields[$field_name]['priority'] = $priority;
			}
		}
		return $fields;
	}
	add_filter( 'woocommerce_address_to_edit', 'storms_wc_checkout_fields_address_to_edit', 10, 2 );

	/**
	 * Filter WooCommerce i18n functions to ensure field orders
	 *
	 * @param $locales
	 * @return mixed
	 */
	function storms_wc_get_country_locale( $locales ) {

		$field = 'postcode';
		$fields_ordered = storms_wc_checkout_fields_order_billing_fields();

		$locales['BR'][$field]['priority'] = $fields_ordered[$field];

		return $locales;
	}
	add_filter( 'woocommerce_get_country_locale', 'storms_wc_get_country_locale' );

	/**
	 * Filter WooCommerce i18n functions to ensure field orders
	 *
	 * @param $default_locale
	 * @return mixed
	 */
	function storms_wc_get_country_locale_default( $default_locale ) {

		$fields = [ 'first_name', 'last_name', 'company', 'country', 'address_1', 'address_2', 'city', 'state', 'postcode' ];
		$fields_ordered = storms_wc_checkout_fields_order_billing_fields();

		foreach( $fields as $field ) {
			$default_locale[$field]['priority'] = $fields_ordered[$field];
		}

		return $default_locale;
	}
	add_filter( 'woocommerce_get_country_locale_default', 'storms_wc_get_country_locale_default' );

	//</editor-fold>
}
