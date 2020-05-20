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
 * WooCommerce Configuration file
 * Here we setup the configurations for WooCommerce
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( \StormsFramework\Helper::is_woocommerce_activated() ) {

	if (!function_exists('storms_define_woocommerce_options')) {

		// Define WooCommerce options
		function storms_define_woocommerce_options()
		{

			// Avançado > WooCommerce.com - Não permitir que o uso do WooCommerce seja rastreado
			update_option('woocommerce_allow_tracking', 'no');
			// Avançado > WooCommerce.com - Não exibir sugestões dentro do WooCommerce
			update_option('woocommerce_show_marketplace_suggestions', 'no');

			// Image and thumbnail sizes
			update_option('woocommerce_single_image_width', 527);
			update_option('woocommerce_thumbnail_image_width', 400);

			// Permitir que seus clientes efetuem pedidos sem uma conta
			update_option('woocommerce_enable_guest_checkout', 'no');
			// Permitir que seus clientes façam login em uma conta existente durante a finalização da compra
			update_option('woocommerce_enable_checkout_login_reminder', 'yes');
			// Permitir que seus clientes criem uma conta durante a finalização da compra
			update_option('woocommerce_enable_signup_and_login_from_checkout', 'yes');
			// Permitir que seus clientes criem uma conta na página "Minha Conta"
			update_option('woocommerce_enable_myaccount_registration', 'yes');
			// Ao criar uma conta, gere automaticamente um nome de usuário da conta para o cliente com base em seu nome, sobrenome ou e-mail
			update_option('woocommerce_registration_generate_username', 'yes');
			// Quando uma conta for criada, gerar automaticamente uma senha para a conta
			update_option('woocommerce_registration_generate_password', 'no');

			// Política de privacidade de cadastro
			update_option('woocommerce_registration_privacy_policy_text', 'Seus dados pessoais serão usados para aprimorar a sua experiência em todo este site, para gerenciar o acesso a sua conta e para outros propósitos, como descritos em nossa [privacy_policy].');
			// Política de privacidade da finalização de pedido
			update_option('woocommerce_checkout_privacy_policy_text', 'Os seus dados pessoais serão utilizados para processar a sua compra, apoiar a sua experiência em todo este site e para outros fins descritos na nossa [privacy_policy].');

			// Endpoints da conta
			// If you see a 404 error, go to WordPress Admin > Settings > Permalinks and Save. This ensures that rewrite rules for endpoints exist and are ready to be used
			update_option('woocommerce_myaccount_orders_endpoint', 'pedidos');
			update_option('woocommerce_myaccount_view_order_endpoint', 'visualizar-pedidos');
			update_option('woocommerce_myaccount_downloads_endpoint', 'downloads');
			update_option('woocommerce_myaccount_edit_account_endpoint', 'editar-conta');
			update_option('woocommerce_myaccount_edit_address_endpoint', 'editar-endereco');
			update_option('woocommerce_myaccount_payment_methods_endpoint', 'metodos-de-pagamento');
			update_option('woocommerce_myaccount_lost_password_endpoint', 'perdi-minha-senha');
			update_option('woocommerce_logout_endpoint', 'sair');

			// Check for woocommerce-extra-checkout-fields-for-brazil plugin
			if (in_array('woocommerce-extra-checkout-fields-for-brazil/woocommerce-extra-checkout-fields-for-brazil.php', apply_filters('active_plugins', get_option('active_plugins')))) {

				update_option('wcbcf_settings', array(
					'person_type' => 1,
					'only_brazil' => 1,
					'ie' => 1,
					'birthdate_sex' => 1,
					'cell_phone' => 1,
					'mailcheck' => 1,
					'maskedinput' => 1,
					'addresscomplete' => 1,
					'validate_cpf' => 1,
					'validate_cnpj' => 1,
				));
			}
		}

		add_action('admin_init', 'storms_define_woocommerce_options');

	}

}
