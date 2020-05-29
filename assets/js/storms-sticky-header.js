"use strict";

/**
 * Fix bootstrap navbar on scroll
 * @source https://stackoverflow.com/a/21301752/1003020
 * @source https://codepen.io/JGallardo/pen/lJoyk
 * @source https://codepen.io/malZiiirA/pen/cbfED
 *
 *
 * // Adiciona o script que monitora se o nav do menu principal esta 'grudado' no topo
 * wp_enqueue_script( 'storms-sticky-header-script',
 * \StormsFramework\Helper::get_asset_url('/js/storms-sticky-header' . ( ( defined( 'WP_DEBUG' ) && WP_DEBUG ) ? '' : '.min' ) . '.js'), array('jquery'),
 * STORMS_FRAMEWORK_VERSION, true );
 *
 * // Add WordPress data to a Javascript file
 * wp_localize_script( 'storms-sticky-header-script', 'storms_sticky_header_vars', [
 * 'alturaHeader'  => 160, // Informar a altura do header - elemento que contem o menu
 * 'alturaMenu'    => 65,  // Informar a altura do menu - elemento que sera sticky no top
 * 'wrapMarginTop' => 75,	// Informar a margin adequada para o wrap - o valor precisa compensar o scroll do menu
 * ] );
 */

/* global storms_sticky_header_vars */
jQuery(function ($) {
  // storms_sticky_header_vars is required to continue, ensure the object exists
  if (typeof storms_sticky_header_vars === 'undefined') {
    return false;
  }

  var stickyHeader = function stickyHeader(event) {
    var $navbar = $('.main-menu');
    var $navbar_container = $('.main-menu .nav-container');
    var $wrap = $('#wrap');
    var alturaHeader = storms_sticky_header_vars.alturaHeader; // Informar a altura do header - elemento que contem o menu

    var alturaMenu = storms_sticky_header_vars.alturaMenu; // Informar a altura do menu - elemento que sera sticky no top

    var wrapMarginTop = storms_sticky_header_vars.wrapMarginTop; // Informar a margin adequada para o wrap - o valor precisa compensar o scroll do menu

    var threshold = alturaHeader - alturaMenu;
    var scrollTop = $(document).scrollTop();

    if (scrollTop > threshold) {
      $navbar.closest('header').addClass('menu-is-fixed');
      $navbar.removeClass('position-static').addClass('fixed-top');
      $wrap.css('margin-top', wrapMarginTop.toString() + 'px');
    } else {
      $navbar.closest('header').removeClass('menu-is-fixed');
      $navbar.removeClass('fixed-top').addClass('position-static');
      $wrap.css('margin-top', '0px');
    }
  };

  $(document).scroll(stickyHeader);
  stickyHeader();
});