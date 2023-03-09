'use strict';

document.getElementById('s').addEventListener('keyup', function (e) {
  var value = e.target.value;
  var product_type = document.getElementsByName('post_type')[0].value;
  document.getElementsByClassName('storms-wc-searchbar-loader-image')[0].classList.toggle('hidden'); // storms_wc_searchbar_vars is required to continue, ensure the object exists

  if (typeof storms_wc_searchbar_vars === 'undefined') {
    return false;
  }

  var toggleSpinner = function toggleSpinner() {
    return document.getElementsByClassName('storms-wc-searchbar-loader-image')[0].classList.toggle('hidden');
  };

  var _data = {
    action: 'storms_wc_searchbar_load_posts',
    security: storms_wc_searchbar_vars.storms_wc_searchbar_nonce,
    s: value,
    post_type: product_type
  };
  fetch(storms_wc_searchbar_vars.ajax_url, {
    method: 'POST',
    body: new URLSearchParams(_data).toString(),
    headers: {
      'Content-type': 'application/x-www-form-urlencoded'
    }
  }).then(function (res) {
    return res.text();
  }).then(function (data) {
    console.log(data);
    toggleSpinner();
  })["catch"](function (err) {
    // There was an error
    console.warn('Something went wrong.', err);
    toggleSpinner();
  });
});
window.addEventListener('DOMContentLoaded', function () {});