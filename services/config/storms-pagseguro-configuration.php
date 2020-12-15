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
 * Storms PagSeguro Configuration file
 * General customizations for PagSeguro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( \StormsFramework\Helper::is_plugin_activated( 'woocommerce-pagseguro/woocommerce-pagseguro.php' ) ) {

	if( ! function_exists( 'storms_define_pagseguro_options' ) ) {

		// Define PagSeguro options
		function storms_define_pagseguro_options() {

			// Only setup if user is an admin
			if ( ! current_user_can( 'manage_options' ) ) {
				return;
			}

			$woocommerce_pagseguro_settings = array(

				'enabled' 				=> 'yes',
				'title' 				=> '',
				'description' 			=> "Pagar com PagSeguro, a forma mais segura de comprar.\nDiversas opções de cartões para você pagar sua compra.\nPague também utilizando boleto bancário.",

				// Integração
				'integration' 			=> '',
				'method' 				=> 'transparent',

				'email' 				=> '', 		// TODO Add email
				'token' 				=> '', 		// TODO Add token

				'sandbox' 				=> 'no', 	// TODO PROD: 'no' / DEV and TST: 'yes'
				'sandbox_email' 		=> '', 		// TODO Add sandbox email
				'sandbox_token' 		=> '', 		// TODO Add sandbox token

				// Opções do Checkout Transparente
				'transparent_checkout' 	=> '',
				'tc_credit' 			=> 'yes',
				'tc_transfer' 			=> 'yes',
				'tc_ticket' 			=> 'yes',
				'tc_ticket_message' 	=> 'yes',

				// Comportamento da integração
				'behavior' 				=> '',
				'send_only_total' 		=> 'no',
				'invoice_prefix' 		=> 'StormseComm-', // TODO Change this

				// Testes
				'testing' 				=> '',
				'debug' 				=> 'yes',

			);

			update_option( 'woocommerce_pagseguro_settings', $woocommerce_pagseguro_settings );
		}
		//add_action( 'admin_init', 'storms_define_pagseguro_options' ); // Example of how to configure PagSeguro

	}

	/**
	 * Solving cURL error 60: Peer's Certificate issuer is not recognized on requests to PagSeguro Sandbox
	 * Source: https://core.trac.wordpress.org/ticket/34935
	 * Source: https://github.com/ibericode/mailchimp-for-wordpress/issues/219#issuecomment-163173120
	 *
	 * @param $args
	 * @param $url
	 * @return mixed
	 */
	function storms_http_request_args_for_pagseguro($args, $url)
	{
		// Only act on requests to sandbox.pagseguro.uol.com.br
		if (strpos($url, 'sandbox.pagseguro.uol.com.br') === false) {
			return $args;
		}

		$args['sslverify'] = false;
		return $args;

	}

	add_filter('http_request_args', 'storms_http_request_args_for_pagseguro', 10, 2);

	/**
	 * Permite que o PagSeguro Sandbox faça requisições via POST (CORS) para sua URL de notificação.
	 * Adiciona o cabeçalho access-control-allow-origin no código da página
	 */
	function storms_add_cors_http_header_for_pagseguro_notifications()
	{
		if ('/wc-api/WC_PagSeguro_Gateway/' === $_SERVER['REQUEST_URI']) {
			header("Access-Control-Allow-Origin: https://sandbox.pagseguro.uol.com.br");
		}
	}

	add_action('init', 'storms_add_cors_http_header_for_pagseguro_notifications');

	/**
	 * Forçamos uma copia do email para um email pessoal
	 * Porem, somente quando existe um remetente de testes do PagSeguro
	 * @sandbox.pagseguro.com.br
	 *
	 * @param $recipient
	 * @param $object
	 * @return string
	 */
	function storms_woocommerce_email_recipient_customer_processing_order($recipient, $object)
	{

		if (strpos($recipient, '@sandbox.pagseguro.com.br') !== false) {
			$recipient .= ', vinigarcia87@gmail.com';
		}
		return $recipient;
	}

	add_filter('woocommerce_email_recipient_customer_processing_order', 'storms_woocommerce_email_recipient_customer_processing_order', 10, 2);

}
