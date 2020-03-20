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
 * Storms WooCommerce Shipping Calculator in Product file
 * General customizations on WooCommerce pages
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( \StormsFramework\Helper::is_woocommerce_activated() ) {

	function storms_wc_shipping_calculator_in_product_init() {

		if( is_product() && 'yes' == get_option( 'storms_wc_scip_show_shipping_calculator_in_product', 'yes' ) ) {

			add_action( 'wp_enqueue_scripts', 'storms_wc_shipping_calculator_in_product_register_scripts' );

			$position_options = array(
				'woocommerce_before_add_to_cart_button', // 'Antes do botão de Compra'
				'woocommerce_after_add_to_cart_button' , //  'Depois do botão de Compra'
				'woocommerce_short_description'        , //  'Antes da descrição curta'
				'woocommerce_before_add_to_cart_form'  , //  'Depois da descrição curta'
				'woocommerce_product_meta_end'         , //  'Depois das metas (tags, categorias, etc)'
				'shortcode'                            , //  'Shortcode'
			);
			$position = get_option( 'storms_wc_scip_position', 'woocommerce_after_add_to_cart_button' );
			if( ! in_array( $position, $position_options )  ) {
				$position = 'woocommerce_after_add_to_cart_button';
			}
			add_action( $position, 'storms_wc_shipping_calculator_in_product_load_form_shipping' );

			add_shortcode( 'shipping_calculator_on_product_page', 'storms_wc_shipping_calculator_in_product_add_shortcode' );

			add_action( 'wp_ajax_wscp_ajax_postcode', 'storms_wc_shipping_calculator_in_product_ajax_postcode' );
			add_action( 'wp_ajax_nopriv_wscp_ajax_postcode', 'storms_wc_shipping_calculator_in_product_ajax_postcode' );
		}
	}
	add_action( 'wp', 'storms_wc_shipping_calculator_in_product_init' );

	//<editor-fold desc="Frontend modifications">

	function storms_wc_shipping_calculator_in_product_register_scripts() {
		wp_enqueue_script(  'storms-wc-shipping-calculator-in-product-script',
			\StormsFramework\Helper::get_asset_url( '/js/storms-wc-shipping-calculator-in-product' . ( ( defined( 'WP_DEBUG' ) && WP_DEBUG ) ? '' : '.min' ) . '.js' ),
			array( 'jquery' ), STORMS_FRAMEWORK_VERSION, true );

		// Add WordPress data to a Javascript file
		wp_localize_script( 'storms-wc-shipping-calculator-in-product-script', 'storms_wc_shipping_calculator_in_product_vars', [
			'ajax_url' => admin_url( 'admin-ajax.php' ),
			'wc_ajax_url' => WC_AJAX::get_endpoint( "%%endpoint%%" ),
			'debug_mode' => defined( 'WP_DEBUG' ) && WP_DEBUG,
		] );
	}

	function storms_wc_shipping_calculator_in_product_load_form_shipping( $content = null ) {
		global $post;

		$product = wc_get_product( $post->ID );
		if( ! $product->needs_shipping() || get_option( 'woocommerce_calc_shipping' ) === 'no' ) {
			//return null;
		}

		wc_get_template_part( 'shipping-calculator-in-product' );

		return $content;
	}

	function storms_wc_shipping_calculator_in_product_add_shortcode( $atts, $content = '' ) {
		if( !is_product() ) {
			return;
		}

		if( 'shortcode' != get_option('wscip_position') ) {
			return;
		}

		ob_start();
		storms_wc_shipping_calculator_in_product_load_form_shipping();
		return ob_get_clean();
	}

	//</editor-fold>

	//<editor-fold desc="Ajax endpoint">

	function storms_wc_shipping_calculator_in_product_ajax_postcode() {

	}

	//</editor-fold>
}
