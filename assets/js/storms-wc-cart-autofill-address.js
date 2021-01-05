"use strict";

/* global StormsWCCartCorreiosAutofillAddressParams */

/*!
 * Autofill address with postcodes on cart page.
 *
 * Version: 3.0.0
 */
jQuery(function ($) {
  /**
   * Autofill address class.
   *
   * @type {Object}
   */
  var StormsWCCartCorreiosAutofillAddress = {
    /**
     * Initialize actions.
     */
    init: function init() {
      // Initial load.
      this.autofill('calc_shipping', true);
      $(document.body).on('blur', '#calc_shipping_postcode', function () {
        StormsWCCartCorreiosAutofillAddress.autofill('calc_shipping');
      });
    },

    /**
     * Block checkout.
     */
    block: function block() {
      $('form.woocommerce-shipping-calculator').addClass('processing').block({
        message: null,
        overlayCSS: {
          background: '#fff',
          opacity: 0.6
        }
      });
    },

    /**
     * Unblock checkout.
     */
    unblock: function unblock() {
      $('form.woocommerce-shipping-calculator').removeClass('processing').unblock();
    },

    /**
     * Autocomplate address.
     *
     * @param {String} field Target.
     * @param {Boolean} copy
     */
    autofill: function autofill(field, copy) {
      copy = copy || false; // Checks with *_postcode field exist.

      if ($('#' + field + '_postcode').length) {
        // Valid CEP.
        var cep = $('#' + field + '_postcode').val().replace('.', '').replace('-', ''),
            country = $('#' + field + '_country').val(),
            //address_1 = $( '#' + field + '_address_1' ).val(),
        override = 'yes' === StormsWCCartCorreiosAutofillAddressParams.force ? true : 0 === address_1.length; // Check country is BR.

        if (cep !== '' && 8 === cep.length && 'BR' === country && override) {
          StormsWCCartCorreiosAutofillAddress.block(); // Gets the address.

          $.ajax({
            type: 'GET',
            url: StormsWCCartCorreiosAutofillAddressParams.url + '&postcode=' + cep,
            dataType: 'json',
            contentType: 'application/json',
            success: function success(address) {
              if (address.success) {
                StormsWCCartCorreiosAutofillAddress.fillFields(field, address.data); // if ( copy ) {
                // 	var newField = 'billing' === field ? 'shipping' : 'billing';
                //
                // 	StormsWCCartCorreiosAutofillAddress.fillFields( newField, address.data );
                // }
              }

              StormsWCCartCorreiosAutofillAddress.unblock();
            }
          });
        }
      }
    },

    /**
     * Fill fields.
     *
     * @param {String} field
     * @param {Object} data
     */
    fillFields: function fillFields(field, data) {
      // Address.
      // $( '#' + field + '_address_1' ).val( data.address ).change();
      // Neighborhood.
      // if ( $( '#' + field + '_neighborhood' ).length ) {
      // 	$( '#' + field + '_neighborhood' ).val( data.neighborhood ).change();
      // } else {
      // 	$( '#' + field + '_address_2' ).val( data.neighborhood ).change();
      // }
      // City.
      $('#' + field + '_city').val(data.city).change(); // State.

      $('#' + field + '_state option:selected').attr('selected', false).change();
      $('#' + field + '_state option[value="' + data.state + '"]').attr('selected', 'selected').change();
      $('#' + field + '_state').trigger('liszt:updated').trigger('chosen:updated'); // Chosen support.
    }
  };
  StormsWCCartCorreiosAutofillAddress.init();
});