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
 * Storms WooCommerce LGPD file
 * General customizations on WooCommerce pages
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( \StormsFramework\Helper::is_woocommerce_activated() ) {

	//<editor-fold desc="Privacy Policy">

	/**
	 * Add Privacy Policy Checkbox at WooCommerce My Account Registration Form
	 * @source https://businessbloomer.com/?p=74128
	 */
	function storms_add_registration_privacy_policy() {

		$privacy_page_id = wc_privacy_policy_page_id();
		$terms_page_id   = wc_terms_and_conditions_page_id();
		$privacy_link    = $privacy_page_id ? '<a href="' . esc_url( get_permalink( $privacy_page_id ) ) . '" class="woocommerce-privacy-policy-link" target="_blank">' . __( 'privacy policy', 'woocommerce' ) . '</a>' : __( 'privacy policy', 'woocommerce' );
		$terms_link      = $terms_page_id ? '<a href="' . esc_url( get_permalink( $terms_page_id ) ) . '" class="woocommerce-terms-and-conditions-link" target="_blank">' . __( 'terms and conditions', 'woocommerce' ) . '</a>' : __( 'terms and conditions', 'woocommerce' );

		woocommerce_form_field( 'privacy_policy_reg', array(
			'type'          => 'checkbox',
			'class'         => array('form-row storms-privacy-policy-check'),
			'label_class'   => array('woocommerce-form__label woocommerce-form__label-for-checkbox checkbox'),
			'input_class'   => array('woocommerce-form__input woocommerce-form__input-checkbox input-checkbox'),
			'required'      => true,
			'label'         => sprintf( __( 'Eu li e concordo com o %s', 'storms' ), $privacy_link ),
		));

	}
	add_action( 'woocommerce_register_form', 'storms_add_registration_privacy_policy', 25 );

	/**
	 * Show error if user does not agree with Privacy Policy at registration
	 *
	 * @param $errors
	 * @param $username
	 * @param $email
	 * @return mixed
	 */
	function storms_validate_privacy_registration( $errors, $username, $email ) {

		if ( ! is_checkout() ) {

			if ( ! (int) isset( $_POST['privacy_policy_reg'] ) ) {
				$errors->add( 'privacy_policy_reg_error', __( 'O campo Politica de Privacidade é obrigatório!', 'storms' ) );
			}

		}
		return $errors;

	}
	add_filter( 'woocommerce_registration_errors', 'storms_validate_privacy_registration', 10, 3 );

	/**
	 * Add Privacy Policy Checkbox at WooCommerce Checkout Form
	 * @source https://www.businessbloomer.com/woocommerce-additional-acceptance-checkbox-checkout/
	 */
	function storms_add_checkout_privacy_policy() {

		$privacy_page_id = wc_privacy_policy_page_id();
		$terms_page_id   = wc_terms_and_conditions_page_id();
		$privacy_link    = $privacy_page_id ? '<a href="' . esc_url( get_permalink( $privacy_page_id ) ) . '" class="woocommerce-privacy-policy-link" target="_blank">' . __( 'privacy policy', 'woocommerce' ) . '</a>' : __( 'privacy policy', 'woocommerce' );
		$terms_link      = $terms_page_id ? '<a href="' . esc_url( get_permalink( $terms_page_id ) ) . '" class="woocommerce-terms-and-conditions-link" target="_blank">' . __( 'terms and conditions', 'woocommerce' ) . '</a>' : __( 'terms and conditions', 'woocommerce' );

		woocommerce_form_field( 'privacy_policy', array(
			'type'          => 'checkbox',
			'class'         => array('form-row storms-privacy-policy-check'),
			'label_class'   => array('woocommerce-form__label woocommerce-form__label-for-checkbox checkbox'),
			'input_class'   => array('woocommerce-form__input woocommerce-form__input-checkbox input-checkbox'),
			'required'      => true,
			'label'         => sprintf( __( 'Li e concordo com a %s', 'storms' ), $privacy_link ),
		));

	}
	add_action( 'woocommerce_checkout_after_terms_and_conditions', 'storms_add_checkout_privacy_policy', 5 );

	/**
	 * Show error if user does not agree with Privacy Policy at checkout
	 */
	function storms_validate_privacy_checkout() {

		if ( ! (int) isset( $_POST['privacy_policy'] ) ) {
			wc_add_notice( __( 'O campo Politica de Privacidade é obrigatório!', 'storms' ), 'error' );
		}

	}
	add_action( 'woocommerce_checkout_process', 'storms_validate_privacy_checkout' );

	/**
	 * Save "Privacy Policy" at Checkout
	 * @source https://www.businessbloomer.com/woocommerce-save-terms-conditions-user-acceptance-checkout/
	 *
	 * @param $order_id
	 */
	function storms_save_privacy_policy_acceptance( $order_id ) {

		if ( $_POST['privacy_policy'] ) {
			update_post_meta( $order_id, 'privacy_policy', esc_attr( $_POST['privacy_policy'] ) );
		}

	}
	add_action( 'woocommerce_checkout_update_order_meta', 'storms_save_privacy_policy_acceptance' );

	/**
	 * Display "Privacy Policy" @ Single Order Page
	 *
	 * @param WC_Order $order
	 */
	function storms_display_privacy_policy_acceptance( $order ) {

		if ( get_post_meta( $order->get_id(), 'privacy_policy', true ) == '1' ) {
			echo '<p><strong>Politica de Privacidade: </strong>Aceito pelo Cliente</p>';
		} else {
			echo '<p><strong>Politica de Privacidade: </strong>N/A</p>';
		}

	}
	add_action( 'woocommerce_admin_order_data_after_billing_address', 'storms_display_privacy_policy_acceptance' );

	//</editor-fold>

	//<editor-fold desc="Terms & Conditions">

	/**
	 * Save "Terms and Conditions" at Checkout
	 * @source https://www.businessbloomer.com/woocommerce-save-terms-conditions-user-acceptance-checkout/
	 *
	 * @param $order_id
	 */
	function storms_save_terms_conditions_acceptance( $order_id ) {

		if ( $_POST['terms'] ) {
			update_post_meta( $order_id, 'terms', esc_attr( $_POST['terms'] ) );
		}

	}
	add_action( 'woocommerce_checkout_update_order_meta', 'storms_save_terms_conditions_acceptance' );

	/**
	 * Display "Terms and Conditions" @ Single Order Page
	 *
	 * @param WC_Order $order
	 */
	function storms_display_terms_conditions_acceptance( $order ) {

		if ( get_post_meta( $order->get_id(), 'terms', true ) == 'on' ) {
			echo '<p><strong>Termos e Condições: </strong>Aceito pelo Cliente</p>';
		} else {
			echo '<p><strong>Termos e Condições: </strong>N/A</p>';
		}

	}
	add_action( 'woocommerce_admin_order_data_after_billing_address', 'storms_display_terms_conditions_acceptance' );

	//</editor-fold>

}
