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

use \StormsFramework\Helper;

if( \StormsFramework\Helper::is_woocommerce_activated() ) {

	function storms_wc_shipping_calculator_in_product_init() {

		if( is_product() && 'yes' == Helper::get_option( 'storms_wc_scip_show_shipping_calculator_in_product', 'yes' ) ) {

			add_action( 'wp_enqueue_scripts', 'storms_wc_shipping_calculator_in_product_register_scripts' );

			$position_options = array(
				'woocommerce_single_product_summary',	 // 'Dentro do bloco de summary do produto'
				'woocommerce_before_add_to_cart_button', // 'Antes do botão de Compra'
				'woocommerce_after_add_to_cart_button' , // 'Depois do botão de Compra'
				'woocommerce_short_description'        , // 'Antes da descrição curta'
				'woocommerce_before_add_to_cart_form'  , // 'Depois da descrição curta'
				'woocommerce_product_meta_end'         , // 'Depois das metas (tags, categorias, etc)'
				'shortcode'                            , // 'Shortcode'
			);
			$position = Helper::get_option( 'storms_wc_scip_position', 'woocommerce_single_product_summary' );
			if( ! in_array( $position, $position_options )  ) {
				$position = 'woocommerce_single_product_summary';
			}
			add_action( $position, 'storms_wc_shipping_calculator_in_product_load_form_shipping', 90 );

			add_shortcode( 'shipping_calculator_on_product_page', 'storms_wc_shipping_calculator_in_product_add_shortcode' );
		}
	}
	add_action( 'wp', 'storms_wc_shipping_calculator_in_product_init' );

	//<editor-fold desc="Frontend modifications">

	/**
	 * Register the scripts for the shipping calculator manipulation
	 */
	function storms_wc_shipping_calculator_in_product_register_scripts() {

		if( is_product() ) {

			wp_register_script( 'jquery-mask',
				\StormsFramework\Helper::get_asset_url(  '/js/jquery/jquery.mask.min.js' ), array( 'jquery' ), '1.14.16', true );

			wp_enqueue_script( 'storms-wc-shipping-calculator-in-product-script',
				\StormsFramework\Helper::get_asset_url('/js/storms-wc-shipping-calculator-in-product' . ( ( defined( 'WP_DEBUG' ) && WP_DEBUG ) ? '' : '.min' ) . '.js' ),
				array( 'jquery', 'jquery-mask' ), STORMS_FRAMEWORK_VERSION, true );

			// Add WordPress data to a Javascript file
			wp_localize_script('storms-wc-shipping-calculator-in-product-script', 'storms_wc_shipping_calculator_in_product_vars', [
				'ajax_url' => admin_url('admin-ajax.php'),
				'wc_ajax_url' => WC_AJAX::get_endpoint("%%endpoint%%"),
				'debug_mode' => defined('WP_DEBUG') && WP_DEBUG,
			]);

		}
	}

	/**
	 * Set shipping calculator form on product page
	 *
	 * @param null $content
	 * @return null
	 */
	function storms_wc_shipping_calculator_in_product_load_form_shipping( $content = null ) {
		global $post;

		$product = wc_get_product( $post->ID );
		if( ! $product->needs_shipping() || 'no' === get_option( 'woocommerce_enable_shipping_calc' ) ) {
			return null;
		}

		wc_get_template( 'cart/shipping-calculator.php' );

		return $content;
	}

	/**
	 * Create a shortcode, to set the shipping calculator form anywhere needed - in the product page
	 *
	 * @param $atts
	 * @param string $content
	 * @return false|string|void
	 */
	function storms_wc_shipping_calculator_in_product_add_shortcode( $atts, $content = '' ) {
		if( !is_product() ) {
			return;
		}

		if( 'shortcode' !== get_option('wscip_position') ) {
			return;
		}

		ob_start();
		storms_wc_shipping_calculator_in_product_load_form_shipping();
		return ob_get_clean();
	}

	//</editor-fold>

	//<editor-fold desc="Ajax endpoint">

	/**
	 * Get shipping methods.
	 * Based on wc_cart_totals_shipping_html()
	 */
	function storms_wc_shipping_calculator_in_product_shipping_html( $calculated_packages ) {
		$packages = $calculated_packages; // WC()->shipping()->get_packages();
		$first    = true;

		foreach ( $packages as $i => $package ) {
			$chosen_method = isset( WC()->session->chosen_shipping_methods[ $i ] ) ? WC()->session->chosen_shipping_methods[ $i ] : '';
			$product_names = array();

			if ( count( $packages ) > 1 ) {
				foreach ( $package['contents'] as $item_id => $values ) {
					$product_names[ $item_id ] = $values['data']->get_name() . ' &times;' . $values['quantity'];
				}
				$product_names = apply_filters( 'woocommerce_shipping_package_details_array', $product_names, $package );
			}

			wc_get_template(
				'cart/cart-shipping.php',
				//'shipping-calculator-in-product-response.php',
				array(
					'package'                  => $package,
					'available_methods'        => $package['rates'],
					'show_package_details'     => count( $packages ) > 1,
					'show_shipping_calculator' => is_cart() && apply_filters( 'woocommerce_shipping_show_shipping_calculator', $first, $i, $package ),
					'package_details'          => implode( ', ', $product_names ),
					/* translators: %d: shipping package number */
					'package_name'             => apply_filters( 'woocommerce_shipping_package_name', ( ( $i + 1 ) > 1 ) ? sprintf( _x( 'Shipping %d', 'shipping packages', 'woocommerce' ), ( $i + 1 ) ) : _x( 'Shipping', 'shipping packages', 'woocommerce' ), $i, $package ),
					'index'                    => $i,
					'chosen_method'            => $chosen_method,
					'formatted_destination'    => WC()->countries->get_formatted_address( $package['destination'], ', ' ),
					'has_calculated_shipping'  => WC()->customer->has_calculated_shipping(),

					'storms_wc_shipping_calculator_in_product' => true,
				)
			);

			$first = false;
		}
	}

	/**
	 * Calculate shipping rates for a package,
	 *
	 * Calculates each shipping methods cost. Rates are stored in the session based on the package hash to avoid re-calculation every page load.
	 *
	 * We change this method, to ignore the session cache
	 *
	 * @param array $package Package of cart items.
	 * @param int   $package_key Index of the package being calculated. Used to cache multiple package rates.
	 *
	 * @return array|bool
	 */
	function storms_wc_shipping_calculator_in_product_calculate_shipping_for_package( $package = array(), $package_key = 0 ) {
		// If the package is invalid, return false.
		if ( empty( $package ) ) {
			return false;
		}

		$package['rates'] = array();

		// If the package is not shippable, e.g. trying to ship to an invalid country, do not calculate rates.
		if ( WC()->shipping()->is_package_shippable( $package ) ) {
			// Check if we need to recalculate shipping for this package.
			$package_to_hash = $package;

			// Remove data objects so hashes are consistent.
			foreach ( $package_to_hash['contents'] as $item_id => $item ) {
				unset( $package_to_hash['contents'][ $item_id ]['data'] );
			}

			foreach ( WC()->shipping()->load_shipping_methods( $package ) as $shipping_method ) {
				if ( ! $shipping_method->supports( 'shipping-zones' ) || $shipping_method->get_instance_id() ) {
					$package['rates'] = $package['rates'] + $shipping_method->get_rates_for_package( $package ); // + instead of array_merge maintains numeric keys
				}
			}

			// Filter the calculated rates.
			$package['rates'] = apply_filters( 'woocommerce_package_rates', $package['rates'], $package );
		}
		return $package;
	}

	/**
	 * Calculate shipping for (multiple) packages of cart items.
	 * Based on WC()->shipping()->calculate_shipping( $packages )
	 *
	 * @param array $packages multi-dimensional array of cart items to calc shipping for.
	 * @return array Array of calculated packages.
	 */
	function storms_wc_shipping_calculator_in_product_calculate_shipping( $packages ) {

		$calculated_packages = array();

		if ( empty( $packages ) ) {
			return array();
		}

		// Calculate costs for passed packages.
		foreach ( $packages as $package_key => $package ) {
			$calculated_packages[ $package_key ] = storms_wc_shipping_calculator_in_product_calculate_shipping_for_package( $package, $package_key );
		}

		/**
		 * Allow packages to be reorganized after calculating the shipping.
		 *
		 * This filter can be used to apply some extra manipulation after the shipping costs are calculated for the packages
		 * but before WooCommerce does anything with them. A good example of usage is to merge the shipping methods for multiple
		 * packages for marketplaces.
		 *
		 * @since 2.6.0
		 *
		 * @param array $packages The array of packages after shipping costs are calculated.
		 */
		$calculated_packages = array_filter( (array) apply_filters( 'woocommerce_shipping_packages', $calculated_packages ) );

		return $calculated_packages;
	}

	/**
	 * Calculate the shipping costs to the selected product and address
	 * @TODO We should cache this request, to avoid trouble
	 *
	 * @param array $request
	 * @return array|string|void
	 */
	function storms_wc_shipping_calculator_in_product_shipping_estimate_ajax() {

		check_ajax_referer( 'storms-wc-scip-nonce', 'security' );

		$response = array();

		try {
			$product = wc_get_product( sanitize_text_field( $_POST['product_id'] ) );

			$country = sanitize_text_field( $_POST['country'] );
			$state = sanitize_text_field( $_POST['state'] );
			$city = sanitize_text_field( $_POST['city'] );
			$postcode = sanitize_text_field( $_POST['postcode'] );

			$product_id        = apply_filters( 'woocommerce_add_to_cart_product_id', absint( $_POST['product_id'] ) );
			$product           = wc_get_product( $product_id );
			$quantity          = empty( $_POST['quantity'] ) ? 1 : wc_stock_amount( wp_unslash( $_POST['quantity'] ) );
			$passed_validation = apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity );
			$product_status    = get_post_status( $product_id );
			$variation_id      = 0;
			$variation         = array();

			if ( $product && 'variation' === $product->get_type() ) {
				$variation_id = $product_id;
				$product_id   = $product->get_parent_id();
				$variation    = $product->get_variation_attributes();
			}

			if( $product == null ) {
				throw new Exception( __( 'Não foi possível encontrar o produto informado', 'storms' ) );
			}

			if( ! $product->needs_shipping() || get_option( 'woocommerce_calc_shipping' ) === 'no' ) {
				throw new Exception( __( 'Não foi possível calcular a entrega deste produto', 'storms' ) );
			}

			if( ! $product->is_in_stock() ) {
				throw new Exception( __( 'Não foi possível calcular a entrega deste produto, pois o mesmo não está disponível.', 'storms' ) );
			}

			if( ! WC_Validation::is_postcode( $postcode, WC()->customer->get_shipping_country() ) ) {
				throw new Exception( __( 'Por favor, insira um CEP válido.', 'storms' ) );
			}

			if ( ! $passed_validation || 'publish' !== $product_status ) {
				throw new Exception( __( 'Este produto não está disponível para compra.', 'storms' ) );
			}

			$contents = array(
				'0' => array(
					'key'           => '0',
					'product_id'    => $product_id,
					'variation_id'  => $variation_id,
					'variation'     => $variation,
					'quantity'      => $quantity,
					'line_subtotal' => wc_format_decimal( $product->get_price() * $quantity ),
					'line_total'    => wc_format_decimal( $product->get_price() * $quantity ),
					'data'          => $product,
					'data_hash'     => wc_get_cart_item_data_hash( $product ),
				),
			);
			$contents_cost = array_sum( wp_list_pluck( $contents, 'line_total' ) );
			$packages = array(
				array(
					'contents'        => $contents,
					'contents_cost'   => $contents_cost,
					'applied_coupons' => array(),
					'user'            => array(
						'ID' => get_current_user_id(),
					),
					'destination'     => array(
						'country'   => $country,
						'state'     => $state,
						'postcode'  => $postcode,
						'city'      => $city,
						// Eh necessario buscar o endereço correto para o CEP? Consulta API Correios?
						'address'   => WC()->customer->get_shipping_address(),
						'address_1' => WC()->customer->get_shipping_address(), // Provide both address and address_1 for backwards compatibility.
						'address_2' => WC()->customer->get_shipping_address_2(),
					),
					'cart_subtotal'   => $contents_cost,
				),
			);

			// Uses the shipping class to calculate shipping then gets the totals when its finished.
			$calculated_packages = storms_wc_shipping_calculator_in_product_calculate_shipping( $packages );

			// Get shipping methods.
			ob_start();
			storms_wc_shipping_calculator_in_product_shipping_html( $calculated_packages );
			$response['html'] = ob_get_clean();

		} catch ( Exception $e ) {
			wp_send_json_error( array( 'error' => $e->getMessage() ) );
		}

		// wp_send_json_success must be outside the try block not to break phpunit tests.
		wp_send_json_success( $response );
	}
	add_action( 'wp_ajax_storms_wc_scip', 'storms_wc_shipping_calculator_in_product_shipping_estimate_ajax' );
	add_action( 'wp_ajax_nopriv_storms_wc_scip', 'storms_wc_shipping_calculator_in_product_shipping_estimate_ajax' );

	//</editor-fold>
}
