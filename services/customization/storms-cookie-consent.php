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
 * Storms Cookie Consent file
 * Here we make all custom changes this theme needs
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Adicionando html da modal que sera exibida
 * quando um usuario estiver saindo do ecomm
 */
function storms_cookie_consent_modal() {

	if( \StormsFramework\Helper::is_woocommerce_activated() ) {
		$privacy_page_id = wc_privacy_policy_page_id();
		$terms_page_id = wc_terms_and_conditions_page_id();
	} else {
		$privacy_page_id = 0;
		$terms_page_id = 0;
	}
	$privacy_link    = $privacy_page_id ? '<a href="' . esc_url( get_permalink( $privacy_page_id ) ) . '" class="woocommerce-privacy-policy-link" target="_blank">' . __( 'privacy policy', 'woocommerce' ) . '</a>' : __( 'privacy policy', 'woocommerce' );
	$terms_link      = $terms_page_id ? '<a href="' . esc_url( get_permalink( $terms_page_id ) ) . '" class="woocommerce-terms-and-conditions-link" target="_blank">' . __( 'terms and conditions', 'woocommerce' ) . '</a>' : __( 'terms and conditions', 'woocommerce' );

	?>
	<div id="storms-cookie-consent-popup" class="hidden">
		<strong>POLÍTICA DE COOKIES E PRIVACIDADE</strong>
		<p>Nós utilizamos cookies para estatísticas de visitas e para melhorar sua experiência de navegação em nosso site. Ao continuar, você concorda com nossa <?php echo $privacy_link ?>.</p>
		<a id="storms-cookie-consent-accept" href="#" title="Eu aceito cookies!" class="btn btn-primary" role="button">Eu aceito o uso de cookies</a>
	</div>
	<?php
}
add_action( 'wp_footer', 'storms_cookie_consent_modal' );

/**
 * Register the scripts for the cookie consent manipulation
 */
function storms_cookie_consent_register_scripts() {

	wp_enqueue_script('storms-cookie-consent-script',
		\StormsFramework\Helper::get_asset_url('/js/storms-cookie-consent' . ((defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) ? '' : '.min') . '.js'),
		array('main-script'), STORMS_FRAMEWORK_VERSION, true);

	wp_localize_script( 'storms-cookie-consent-script', 'storms_cookie_consent_vars', [
		'modal_id' => 'storms-cookie-consent-popup',
		'accept_btn_id' => 'storms-cookie-consent-accept',
	] );

}
add_action( 'wp_enqueue_scripts', 'storms_cookie_consent_register_scripts' );
