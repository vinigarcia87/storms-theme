/**
 *
 */
/* global storms_vars */
jQuery( function( $ ) {

	// storms_vars is required to continue, ensure the object exists
	if ( typeof storms_vars === 'undefined' ) {
		return false;
	}

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

	$( document.body ).on( 'click', "button[name='apply_coupon']" , function( event ) {

		event.preventDefault();

		var container = $( this ).parents( '.woocommerce-checkout-review-order' );

		var $text_field = $( '#coupon_code' );
		var coupon_code = $text_field.val();

		var data = {
			security: storms_vars.apply_coupon_nonce,
			coupon_code: coupon_code
		};

		container.addClass( 'processing' ).block({
			message: null,
			overlayCSS: {
				background: '#fff',
				opacity: 0.6
			}
		});

		$.ajax({
			url : storms_vars.wc_ajax_url.toString().replace( '%%endpoint%%', 'apply_coupon' ),
			type : 'POST',
			data : data,
			dataType: 'html',
			success : function( response ) {
				$( '.woocommerce-error, .woocommerce-message, .woocommerce-info' ).remove();
				container.removeClass( 'processing' ).unblock();

				show_notice( response );

				$( document.body ).trigger( 'update_checkout', { update_shipping_method: false } );
			},
			complete: function() {
				container.removeClass( 'processing' ).unblock();
				$text_field.val( '' );
			},
			error: function ( jqXHR ) {
				if ( storms_vars.debug_mode ) {
					/* jshint devel: true */
					console.log( jqXHR.responseText );
				}
			}
		});
	});

} );
