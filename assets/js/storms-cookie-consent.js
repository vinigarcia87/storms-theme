"use strict";
/* global storms_cookie_consent_vars */

function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); if (enumerableOnly) symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; }); keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i] != null ? arguments[i] : {}; if (i % 2) { ownKeys(Object(source), true).forEach(function (key) { _defineProperty(target, key, source[key]); }); } else if (Object.getOwnPropertyDescriptors) { Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)); } else { ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }

function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(n); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function _iterableToArrayLimit(arr, i) { if (typeof Symbol === "undefined" || !(Symbol.iterator in Object(arr))) return; var _arr = []; var _n = true; var _d = false; var _e = undefined; try { for (var _i = arr[Symbol.iterator](), _s; !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"] != null) _i["return"](); } finally { if (_d) throw _e; } } return _arr; }

function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }

var cookieConsentCookieStorage = {
  getItem: function getItem(item) {
    var cookies = document.cookie.split(';').map(function (cookie) {
      return cookie.split('=');
    }).reduce(function (acc, _ref) {
      var _ref2 = _slicedToArray(_ref, 2),
          key = _ref2[0],
          value = _ref2[1];

      return _objectSpread({}, acc, _defineProperty({}, key.trim(), value));
    }, {});
    return cookies[item];
  },
  setItem: function setItem(item, value) {
    if (location.protocol !== 'https:') {
      document.cookie = "".concat(item, "=").concat(value, ";path=/;SameSite=Strict;");
    }

    document.cookie = "".concat(item, "=").concat(value, ";path=/;SameSite=Strict;Secure;");
  }
};
var cookieConsentStorageType = cookieConsentCookieStorage;
var cookieConsentPropertyName = 'storms_cookie_consent_accepted';

var shouldShowCookieConsentPopup = function shouldShowCookieConsentPopup() {
  return !cookieConsentStorageType.getItem(cookieConsentPropertyName);
};

var saveCookieConsentToStorage = function saveCookieConsentToStorage() {
  return cookieConsentStorageType.setItem(cookieConsentPropertyName, true);
};

window.onload = function () {
  // storms_cookie_consent_vars is required to continue, ensure the object exists
  if (typeof storms_cookie_consent_vars === 'undefined') {
    return false;
  }

  var acceptFn = function acceptFn(event) {
    saveCookieConsentToStorage(cookieConsentStorageType);
    consentPopup.classList.add('hidden');
    event.preventDefault();
  };

  var consentPopup = document.getElementById(storms_cookie_consent_vars.modal_id);
  var acceptBtn = document.getElementById(storms_cookie_consent_vars.accept_btn_id);
  acceptBtn.addEventListener('click', acceptFn);

  if (shouldShowCookieConsentPopup(cookieConsentStorageType)) {
    setTimeout(function () {
      consentPopup.classList.remove('hidden');
    }, 2000);
  }
};