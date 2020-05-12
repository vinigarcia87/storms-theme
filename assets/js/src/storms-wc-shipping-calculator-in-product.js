/**
 *
 */
/* global storms_wc_shipping_calculator_in_product_vars */
jQuery( function( $ ) {

	// storms_wc_shipping_calculator_in_product_vars is required to continue, ensure the object exists
	if ( typeof storms_wc_shipping_calculator_in_product_vars === 'undefined' ) {
		return false;
	}

	/**
	 * Check if a node is blocked for processing.
	 *
	 * @param {JQuery Object} $node
	 * @return {bool} True if the DOM Element is UI Blocked, false if not.
	 */
	var is_blocked = function( $node ) {
		return $node.is( '.processing' ) || $node.parents( '.processing' ).length;
	};

	/**
	 * Block a node visually for processing.
	 *
	 * @param {JQuery Object} $node
	 */
	var block = function( $node ) {
		if ( ! is_blocked( $node ) ) {
			$node.addClass( 'processing' ).block( {
				message: null,
				overlayCSS: {
					background: '#fff',
					opacity: 0.6
				}
			} );
		}
	};

	/**
	 * Unblock a node after processing is complete.
	 *
	 * @param {JQuery Object} $node
	 */
	var unblock = function( $node ) {
		$node.removeClass( 'processing' ).unblock();
	};

	/**
	 * Shows new notices on the page.
	 *
	 * @param {Object} The Notice HTML Element in string or object form.
	 */
	var show_notice = function( html_element, $target ) {
		if ( ! $target ) {
			$target = $( '.woocommerce-notices-wrapper:first' ) || $( '.cart-empty' ).closest( '.woocommerce' ) || $( '.woocommerce-cart-form' );
		}
		$target.prepend( html_element );
	};

	var removeResponseBlock = function () {
		var $shipping_calculator_rates = $( '#shipping-calculator-rates' );
		if( $shipping_calculator_rates.length > 0 ) {
			$shipping_calculator_rates.remove();
		}
	};

	/**
	 * Get the product/variation id
	 * TODO group and external products
	 *
	 * @returns {boolean|int}
	 */
	var get_product_id = function() {
		// Simple product
		var $btn_add_to_cart = $( '[name="add-to-cart"]' );
		// Variable product
		var $input_variation_id = $( '[name="variation_id"]' );

		var product_id = 0;
		var variation_id = 0;

		if( $input_variation_id.length > 0 ) {
			return $input_variation_id.val() > 0 ? $input_variation_id.val() : false;
		} else {
			if( $btn_add_to_cart.length > 0 ) {
				return $btn_add_to_cart.val() > 0 ? $btn_add_to_cart.val() : false;
			}
		}
		return false;
	};

	$( '#calc_shipping_postcode' ).mask( '00000-000' ).attr( 'type', 'tel' );

	$( document.body ).on( 'click', 'button[name="calc_shipping"]' , function( event ) {

		event.preventDefault();

		var $wrapper = $(this).parents( '.shipping-calculator-form' );

		var $country_field = $( '#calc_shipping_country' );
		var country = $country_field.val();
		var $state_field = $( '#calc_shipping_state' );
		var state = $state_field.val();
		var $city_field = $( '#calc_shipping_city' );
		var city = $city_field.val();
		var $postcode_field = $( '#calc_shipping_postcode' );
		var postcode = $postcode_field.val();

		var product_id = get_product_id();

		if( product_id === 0 ) {
			show_notice( '<div class="woocommerce-error" role="alert">Por favor, escolha uma opção antes de calcular o frete.</div>' );
			return;
		}

		var $quantity_field = $('.quantity input.qty');
		var quantity = ( $quantity_field.length ? $quantity_field.val() : 1 );

		var $nonce_field = $( '#storms-wc-scip-nonce' );
		var nonce = $nonce_field.val();

		var data = {
			security: nonce,
			country: country,
			state: state,
			city: city,
			postcode: postcode,
			product_id: product_id,
			quantity: quantity
		};

		block( $wrapper );

		$.ajax({
			url : storms_wc_shipping_calculator_in_product_vars.ajax_url.toString() + '?action=storms_wc_scip',
			type : 'POST',
			data : data,
			dataType: 'json',
			success : function( response ) {
				$( '.woocommerce-error, .woocommerce-message, .woocommerce-info' ).remove();

				if( response ) {
					if( response.success ) {

						removeResponseBlock();

						var $response_field = $( '.shipping-calculator-form' );
						$response_field.after( '<table id="shipping-calculator-rates" class="shop_table shop_table_responsive ">' + response.data.html + '</table>' );
					} else {
						show_notice( '<div class="woocommerce-error" role="alert">' + response.data.error + '</div>' );
					}
				}

			},
			complete: function() {
				unblock( $wrapper );
			},
			error: function ( jqXHR ) {

				removeResponseBlock();

				if ( storms_wc_shipping_calculator_in_product_vars.debug_mode ) {
					/* jshint devel: true */
					console.log( jqXHR.responseText );
				}
			}
		});
	} );
} );
