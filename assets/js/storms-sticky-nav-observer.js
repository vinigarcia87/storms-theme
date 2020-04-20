"use strict";

/**
 * Observer to help stick the menu element to the top
 * @see https://stackoverflow.com/a/56678169/1003020
 * @see https://www.youtube.com/watch?v=RxnV9Xcw914
 */
// Check if the WP adminbar is present
var has_wp_adminbar = document.querySelector('body').classList.contains('admin-bar');
var header_el = document.querySelector('header > div'); // This is the element right on top of the menu we wanna stick

var sticky_el = document.querySelector('[data-toggle="sticky-onscroll"]'); // This is the menu we wanna stick

var wrap_el = document.querySelector('#wrap'); // This is the element right after the menu we wanna stick
// The height of the sticky menu

var margin = sticky_el.offsetHeight;
var headerObserverOptions = {
  rootMargin: has_wp_adminbar ? "-32px" : "0px"
};
var headerObserver = new IntersectionObserver(function (entries, headerObserver) {
  entries.forEach(function (entry) {
    // When the element right on top the menu is out of the viewport, we stick the menu
    if (!entry.isIntersecting) {
      // Add classes to stick the menu
      sticky_el.classList.remove('position-static');
      sticky_el.classList.add('fixed-top'); // Fix the position of the wrap element, so the screen don't "jump"

      wrap_el.style.marginTop = margin.toString() + 'px';
    } else {
      // When the element right on top the menu is back, whe unstick the menu
      sticky_el.classList.add('position-static');
      sticky_el.classList.remove('fixed-top');
      wrap_el.style.marginTop = "0";
    }
  });
}, headerObserverOptions);
headerObserver.observe(header_el);