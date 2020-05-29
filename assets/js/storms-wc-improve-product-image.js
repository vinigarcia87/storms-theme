"use strict";

jQuery(function ($) {
  $('body').on('click', '.woocommerce-product-gallery__wrapper', function () {
    // Open lightbox on image click
    $('.woocommerce-product-gallery__trigger').trigger('click');
  });
});