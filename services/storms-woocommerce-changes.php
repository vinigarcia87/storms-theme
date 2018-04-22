<?php
/**
 * 8KDesign (http://storms.com.br/)
 *
 * @author    Vinicius Garcia | storms@storms.com.br
 * @copyright (c) Copyright 2012-2018, Storms Websolutions
 * @license   GPLv2 - GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @package   Storms
 * @version   1.0.0
 *
 * storms-checkout-changes.php
 * {{ Why this file is here? }}
 */

// Remove CSS and/or JS for Select2 (SelectWoo) used by WooCommerce
// @see https://gist.github.com/Willem-Siebe/c6d798ccba249d5bf080
function storms_dequeue_stylesandscripts_select2() {
	if ( class_exists( 'woocommerce' ) ) {
		wp_dequeue_style( 'selectWoo' );
		wp_deregister_style( 'selectWoo' );

		wp_dequeue_script( 'selectWoo');
		wp_deregister_script('selectWoo');
	}
}
add_action( 'wp_enqueue_scripts', 'storms_dequeue_stylesandscripts_select2', 100 );

// Remove CSS e JS para o plugin yith wc wishlist
function storms_dequeue_stylesandscripts_yith_wc_wishlist() {
	wp_dequeue_style('yith-wcwl-main');
	wp_deregister_style('yith-wcwl-main');

	wp_dequeue_style('yith-wcwl-font-awesome');
	wp_dequeue_style('yith-wcwl-font-awesome');

	wp_dequeue_style('woocommerce_prettyPhoto_css');
	wp_dequeue_style('woocommerce_prettyPhoto_css');

	wp_dequeue_script('jquery-selectBox');
	wp_deregister_script('jquery-selectBox');
}
add_action( 'wp_enqueue_scripts', 'storms_dequeue_stylesandscripts_yith_wc_wishlist', 100 );

// Modificando o script do autofill dos correios para incluir melhorias
// Este script somente eh sobrescrito para incluir suporte para o Select2 (SelectWoo)
// Sem esse suporte, o Autofill nao consegue preencher o campo Estado do formulario de checkout
// A unica modificacao eh a inclusao do codigo `$( '#' + field + '_state' ).val( data.state ).trigger('change'); // Select2 support` no final do metodo `fillFields`
function storms_autofill_correios_frontend_scripts() {
	if ( is_checkout() || is_account_page() ) {
		wp_dequeue_script('woocommerce-correios-autofill-addresses');
		wp_enqueue_script( 'storms-woocommerce-correios-autofill-addresses', \StormsFramework\Storms\Helper::get_asset_url( '/js/storms-autofill-address.js' ), array( 'jquery', 'jquery-blockui' ), '3.5.1'/*WC_Correios::VERSION*/, true );

		$ajax_endpoint = 'correios_autofill_address';

		wp_localize_script(
			'storms-woocommerce-correios-autofill-addresses',
			'WCCorreiosAutofillAddressParams',
			array(
				'url'   => WC_AJAX::get_endpoint( $ajax_endpoint ),
				'force' => apply_filters( 'woocommerce_correios_autofill_addresses_force_autofill', 'no' ),
			)
		);
	}
}
add_action( 'wp_enqueue_scripts', 'storms_autofill_correios_frontend_scripts', 100 );

