'use strict';

document.getElementById('s').addEventListener('keyup', function (e) {
  /* global storms_wc_searchbar_vars */
  // storms_wc_searchbar_vars is required to continue, ensure the object exists
  if (typeof storms_wc_searchbar_vars === 'undefined') {
    return false;
  }

  var value = e.target.value;
  var product_type = document.getElementsByName('post_type')[0].value;
  var results_container = document.querySelector('.storms-wc-searchbar-results'); // Adjustment on spinner position

  var searchBtnWidth = document.querySelector('#searchsubmit').offsetWidth;
  document.querySelector('.storms-wc-searchbar-loader-image').style.right = 10 + searchBtnWidth + 'px';

  var toggleSpinner = function toggleSpinner() {
    return document.querySelector('.storms-wc-searchbar-loader-image').classList.toggle('hidden');
  };

  var toggleResults = function toggleResults(action) {
    var results_container = document.querySelector('.storms-wc-searchbar-results-container');

    if (action === 'hide') {
      results_container.classList.add('hidden');
    } else if (action === 'show') {
      results_container.classList.remove('hidden');
    }
  };

  document.querySelector('.storms-wc-searchbar-results-container').style.width = document.getElementById('storms-wc-searchbar-form').offsetWidth + 'px';

  if (value.length < 3) {
    toggleResults('hide');
    results_container.innerHTML = '';
    return;
  }

  toggleSpinner();
  var _data = {
    action: 'storms_wc_searchbar_load_posts',
    security: storms_wc_searchbar_vars.storms_wc_searchbar_nonce,
    s: value,
    post_type: product_type
  };
  fetch(storms_wc_searchbar_vars.ajax_url, {
    method: 'POST',

    /* global URLSearchParams */
    body: new URLSearchParams(_data).toString(),
    headers: {
      'Content-type': 'application/x-www-form-urlencoded'
    }
  }).then(function (res) {
    return res.text();
  }).then(function (data) {
    results_container.innerHTML = data;
    toggleSpinner();
    toggleResults('show');
  })["catch"](function (err) {
    // There was an error
    console.warn('Something went wrong.', err);
    results_container.innerHTML = '';
    toggleSpinner();
  });
});
document.getElementById('s').addEventListener('click', function (e) {
  var value = e.target.value;

  if (value.length >= 3) {
    // Create a new event
    var event = new Event('keyup'); // Dispatch it.

    e.target.dispatchEvent(event);
  }
});
document.querySelector('.storms-wc-searchbar-results').addEventListener('click', function (e) {
  var target = e.target.closest('.storms-wc-searchbar-show-more-results');

  if (target) {
    document.getElementById('storms-wc-searchbar-form').submit();
  }
});
document.body.addEventListener('click', function (e) {
  var target = e.target.closest('.storms-wc-searchbar-container');

  if (!target) {
    document.querySelector('.storms-wc-searchbar-results-container').classList.add('hidden');
  }
});