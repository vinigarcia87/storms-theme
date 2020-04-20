"use strict";

/**
 *
 */

/* global storms_wc_checkout_coupon_vars */
jQuery(function ($) {
  // storms_wc_checkout_coupon_vars is required to continue, ensure the object exists
  if (typeof storms_wc_checkout_coupon_vars === 'undefined') {
    return false;
  }

  var is_cart = $(document.body).hasClass('woocommerce-cart');
  var is_checkout = $(document.body).hasClass('woocommerce-checkout'); // Probably, will get trouble when using caching for assets... above approach is better
  //var is_cart = ( 'yes' === storms_wc_checkout_coupon_vars.is_cart );
  //var is_checkout = ( 'yes' === storms_wc_checkout_coupon_vars.is_checkout );

  /**
   * Check if a node is blocked for processing.
   *
   * @param {JQuery Object} $node
   * @return {bool} True if the DOM Element is UI Blocked, false if not.
   */

  var is_blocked = function is_blocked($node) {
    return $node.is('.processing') || $node.parents('.processing').length;
  };
  /**
   * Block a node visually for processing.
   *
   * @param {JQuery Object} $node
   */


  var block = function block($node) {
    if (!is_blocked($node)) {
      $node.addClass('processing').block({
        message: null,
        overlayCSS: {
          background: '#fff',
          opacity: 0.6
        }
      });
    }
  };
  /**
   * Unblock a node after processing is complete.
   *
   * @param {JQuery Object} $node
   */


  var unblock = function unblock($node) {
    $node.removeClass('processing').unblock();
  };
  /**
   * Shows new notices on the page.
   *
   * @param {Object} The Notice HTML Element in string or object form.
   */


  var show_notice = function show_notice(html_element, $target) {
    if (!$target) {
      $target = $('.woocommerce-notices-wrapper:first') || $('.cart-empty').closest('.woocommerce') || $('.woocommerce-cart-form');
    }

    $target.prepend(html_element);
  };
  /**
   * Update the .cart_totals div with a string of html.
   *
   * @param {String} html_str The HTML string with which to replace the div.
   */


  var update_cart_totals_div = function update_cart_totals_div(html_str) {
    $('.cart_totals').replaceWith(html_str);
    $(document.body).trigger('updated_cart_totals');
  };
  /**
   * Update the .woocommerce div with a string of html.
   *
   * @param {String} html_str The HTML string with which to replace the div.
   * @param {bool} preserve_notices Should notices be kept? False by default.
   */


  var update_wc_div = function update_wc_div(html_str, preserve_notices) {
    var $html = $.parseHTML(html_str);
    var $new_form = $('.woocommerce-cart-form', $html);
    var $new_totals = $('.cart_totals', $html);
    var $notices = $('.woocommerce-error, .woocommerce-message, .woocommerce-info', $html); // No form, cannot do this.

    if ($('.woocommerce-cart-form').length === 0) {
      window.location.reload();
      return;
    } // Remove errors


    if (!preserve_notices) {
      $('.woocommerce-error, .woocommerce-message, .woocommerce-info').remove();
    }

    if ($new_form.length === 0) {
      // If the checkout is also displayed on this page, trigger reload instead.
      if ($('.woocommerce-checkout').length) {
        window.location.reload();
        return;
      } // No items to display now! Replace all cart content.


      var $cart_html = $('.cart-empty', $html).closest('.woocommerce');
      $('.woocommerce-cart-form__contents').closest('.woocommerce').replaceWith($cart_html); // Display errors

      if ($notices.length > 0) {
        show_notice($notices);
      } // Notify plugins that the cart was emptied.


      $(document.body).trigger('wc_cart_emptied');
    } else {
      // If the checkout is also displayed on this page, trigger update event.
      if ($('.woocommerce-checkout').length) {
        $(document.body).trigger('update_checkout');
      }

      $('.woocommerce-cart-form').replaceWith($new_form);
      $('.woocommerce-cart-form').find(':input[name="update_cart"]').prop('disabled', true);

      if ($notices.length > 0) {
        show_notice($notices);
      }

      update_cart_totals_div($new_totals);
    }

    $(document.body).trigger('updated_wc_div');
  };

  var update_cart = function update_cart(preserve_notices) {
    var $form = $('.woocommerce-cart-form');
    block($form);
    block($('div.cart_totals')); // Make call to actual form post URL.

    $.ajax({
      type: $form.attr('method'),
      url: $form.attr('action'),
      data: $form.serialize(),
      dataType: 'html',
      success: function success(response) {
        update_wc_div(response, preserve_notices);
      },
      complete: function complete() {
        unblock($form);
        unblock($('div.cart_totals'));
        $.scroll_to_notices($('[role="alert"]'));
      }
    });
  };
  /**
   * CHECKOUT PAGE : button[name='apply_coupon']
   * CART PAGE : input[name='apply_coupon']
   */


  $(document.body).on('click', "button[name='apply_coupon'], input[name='apply_coupon']", function (event) {
    event.preventDefault();

    if (!is_cart && !is_checkout) {
      return;
    }

    var $wrapper = '';

    if (is_checkout) {
      $wrapper = $(this).parents('.woocommerce-checkout-review-order');
    } else {
      $wrapper = $(event.currentTarget).closest('.cart_totals');
    }

    var $text_field = $('#coupon_code');
    var coupon_code = $text_field.val();
    var data = {
      security: storms_wc_checkout_coupon_vars.apply_coupon_nonce,
      coupon_code: coupon_code
    };
    block($wrapper);
    $.ajax({
      url: storms_wc_checkout_coupon_vars.wc_ajax_url.toString().replace('%%endpoint%%', 'apply_coupon'),
      type: 'POST',
      data: data,
      dataType: 'html',
      success: function success(response) {
        $('.woocommerce-error, .woocommerce-message, .woocommerce-info').remove();
        unblock($wrapper);
        show_notice(response);

        if (is_checkout) {
          $(document.body).trigger('update_checkout', {
            update_shipping_method: false
          });
        } else {
          update_cart(true);
        }
      },
      complete: function complete() {
        unblock($wrapper);
        $text_field.val('');
      },
      error: function error(jqXHR) {
        if (storms_wc_checkout_coupon_vars.debug_mode) {
          /* jshint devel: true */
          console.log(jqXHR.responseText);
        }
      }
    });
  });
});