(function (global, factory) {
	typeof exports === 'object' && typeof module !== 'undefined' ? module.exports = factory() :
	typeof define === 'function' && define.amd ? define(factory) :
	(global.bootstrap = factory());
}(this, (function () { 'use strict';

function _AsyncGenerator(gen) {
  var front, back;

  function resume(key, arg) {
    try {
      var result = gen[key](arg),
          value = result.value,
          overloaded = value instanceof _OverloadYield;
      Promise.resolve(overloaded ? value.v : value).then(function (arg) {
        if (overloaded) {
          var nextKey = "return" === key ? "return" : "next";
          if (!value.k || arg.done) return resume(nextKey, arg);
          arg = gen[nextKey](arg).value;
        }

        settle(result.done ? "return" : "normal", arg);
      }, function (err) {
        resume("throw", err);
      });
    } catch (err) {
      settle("throw", err);
    }
  }

  function settle(type, value) {
    switch (type) {
      case "return":
        front.resolve({
          value: value,
          done: !0
        });
        break;

      case "throw":
        front.reject(value);
        break;

      default:
        front.resolve({
          value: value,
          done: !1
        });
    }

    (front = front.next) ? resume(front.key, front.arg) : back = null;
  }

  this._invoke = function (key, arg) {
    return new Promise(function (resolve, reject) {
      var request = {
        key: key,
        arg: arg,
        resolve: resolve,
        reject: reject,
        next: null
      };
      back ? back = back.next = request : (front = back = request, resume(key, arg));
    });
  }, "function" != typeof gen.return && (this.return = void 0);
}

_AsyncGenerator.prototype["function" == typeof Symbol && Symbol.asyncIterator || "@@asyncIterator"] = function () {
  return this;
}, _AsyncGenerator.prototype.next = function (arg) {
  return this._invoke("next", arg);
}, _AsyncGenerator.prototype.throw = function (arg) {
  return this._invoke("throw", arg);
}, _AsyncGenerator.prototype.return = function (arg) {
  return this._invoke("return", arg);
};

function _OverloadYield(value, kind) {
  this.v = value, this.k = kind;
}

function ownKeys(object, enumerableOnly) {
  var keys = Object.keys(object);

  if (Object.getOwnPropertySymbols) {
    var symbols = Object.getOwnPropertySymbols(object);
    enumerableOnly && (symbols = symbols.filter(function (sym) {
      return Object.getOwnPropertyDescriptor(object, sym).enumerable;
    })), keys.push.apply(keys, symbols);
  }

  return keys;
}

function _objectSpread2(target) {
  for (var i = 1; i < arguments.length; i++) {
    var source = null != arguments[i] ? arguments[i] : {};
    i % 2 ? ownKeys(Object(source), !0).forEach(function (key) {
      _defineProperty(target, key, source[key]);
    }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)) : ownKeys(Object(source)).forEach(function (key) {
      Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key));
    });
  }

  return target;
}

function _typeof(obj) {
  "@babel/helpers - typeof";

  return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) {
    return typeof obj;
  } : function (obj) {
    return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj;
  }, _typeof(obj);
}

function _classCallCheck(instance, Constructor) {
  if (!(instance instanceof Constructor)) {
    throw new TypeError("Cannot call a class as a function");
  }
}

function _defineProperties(target, props) {
  for (var i = 0; i < props.length; i++) {
    var descriptor = props[i];
    descriptor.enumerable = descriptor.enumerable || false;
    descriptor.configurable = true;
    if ("value" in descriptor) descriptor.writable = true;
    Object.defineProperty(target, descriptor.key, descriptor);
  }
}

function _createClass(Constructor, protoProps, staticProps) {
  if (protoProps) _defineProperties(Constructor.prototype, protoProps);
  if (staticProps) _defineProperties(Constructor, staticProps);
  Object.defineProperty(Constructor, "prototype", {
    writable: false
  });
  return Constructor;
}

function _defineProperty(obj, key, value) {
  if (key in obj) {
    Object.defineProperty(obj, key, {
      value: value,
      enumerable: true,
      configurable: true,
      writable: true
    });
  } else {
    obj[key] = value;
  }

  return obj;
}

function _inherits(subClass, superClass) {
  if (typeof superClass !== "function" && superClass !== null) {
    throw new TypeError("Super expression must either be null or a function");
  }

  subClass.prototype = Object.create(superClass && superClass.prototype, {
    constructor: {
      value: subClass,
      writable: true,
      configurable: true
    }
  });
  Object.defineProperty(subClass, "prototype", {
    writable: false
  });
  if (superClass) _setPrototypeOf(subClass, superClass);
}

function _getPrototypeOf(o) {
  _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf.bind() : function _getPrototypeOf(o) {
    return o.__proto__ || Object.getPrototypeOf(o);
  };
  return _getPrototypeOf(o);
}

function _setPrototypeOf(o, p) {
  _setPrototypeOf = Object.setPrototypeOf ? Object.setPrototypeOf.bind() : function _setPrototypeOf(o, p) {
    o.__proto__ = p;
    return o;
  };
  return _setPrototypeOf(o, p);
}

function _isNativeReflectConstruct() {
  if (typeof Reflect === "undefined" || !Reflect.construct) return false;
  if (Reflect.construct.sham) return false;
  if (typeof Proxy === "function") return true;

  try {
    Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], function () {}));
    return true;
  } catch (e) {
    return false;
  }
}

function _assertThisInitialized(self) {
  if (self === void 0) {
    throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
  }

  return self;
}

function _possibleConstructorReturn(self, call) {
  if (call && (typeof call === "object" || typeof call === "function")) {
    return call;
  } else if (call !== void 0) {
    throw new TypeError("Derived constructors may only return object or undefined");
  }

  return _assertThisInitialized(self);
}

function _createSuper(Derived) {
  var hasNativeReflectConstruct = _isNativeReflectConstruct();

  return function _createSuperInternal() {
    var Super = _getPrototypeOf(Derived),
        result;

    if (hasNativeReflectConstruct) {
      var NewTarget = _getPrototypeOf(this).constructor;

      result = Reflect.construct(Super, arguments, NewTarget);
    } else {
      result = Super.apply(this, arguments);
    }

    return _possibleConstructorReturn(this, result);
  };
}

function _superPropBase(object, property) {
  while (!Object.prototype.hasOwnProperty.call(object, property)) {
    object = _getPrototypeOf(object);
    if (object === null) break;
  }

  return object;
}

function _get() {
  if (typeof Reflect !== "undefined" && Reflect.get) {
    _get = Reflect.get.bind();
  } else {
    _get = function _get(target, property, receiver) {
      var base = _superPropBase(target, property);

      if (!base) return;
      var desc = Object.getOwnPropertyDescriptor(base, property);

      if (desc.get) {
        return desc.get.call(arguments.length < 3 ? target : receiver);
      }

      return desc.value;
    };
  }

  return _get.apply(this, arguments);
}

function _slicedToArray(arr, i) {
  return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest();
}

function _toConsumableArray(arr) {
  return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread();
}

function _arrayWithoutHoles(arr) {
  if (Array.isArray(arr)) return _arrayLikeToArray(arr);
}

function _arrayWithHoles(arr) {
  if (Array.isArray(arr)) return arr;
}

function _iterableToArray(iter) {
  if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter);
}

function _iterableToArrayLimit(arr, i) {
  var _i = arr == null ? null : typeof Symbol !== "undefined" && arr[Symbol.iterator] || arr["@@iterator"];

  if (_i == null) return;
  var _arr = [];
  var _n = true;
  var _d = false;

  var _s, _e;

  try {
    for (_i = _i.call(arr); !(_n = (_s = _i.next()).done); _n = true) {
      _arr.push(_s.value);

      if (i && _arr.length === i) break;
    }
  } catch (err) {
    _d = true;
    _e = err;
  } finally {
    try {
      if (!_n && _i["return"] != null) _i["return"]();
    } finally {
      if (_d) throw _e;
    }
  }

  return _arr;
}

function _unsupportedIterableToArray(o, minLen) {
  if (!o) return;
  if (typeof o === "string") return _arrayLikeToArray(o, minLen);
  var n = Object.prototype.toString.call(o).slice(8, -1);
  if (n === "Object" && o.constructor) n = o.constructor.name;
  if (n === "Map" || n === "Set") return Array.from(o);
  if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen);
}

function _arrayLikeToArray(arr, len) {
  if (len == null || len > arr.length) len = arr.length;

  for (var i = 0, arr2 = new Array(len); i < len; i++) arr2[i] = arr[i];

  return arr2;
}

function _nonIterableSpread() {
  throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.");
}

function _nonIterableRest() {
  throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.");
}

function _createForOfIteratorHelper(o, allowArrayLike) {
  var it = typeof Symbol !== "undefined" && o[Symbol.iterator] || o["@@iterator"];

  if (!it) {
    if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") {
      if (it) o = it;
      var i = 0;

      var F = function () {};

      return {
        s: F,
        n: function () {
          if (i >= o.length) return {
            done: true
          };
          return {
            done: false,
            value: o[i++]
          };
        },
        e: function (e) {
          throw e;
        },
        f: F
      };
    }

    throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.");
  }

  var normalCompletion = true,
      didErr = false,
      err;
  return {
    s: function () {
      it = it.call(o);
    },
    n: function () {
      var step = it.next();
      normalCompletion = step.done;
      return step;
    },
    e: function (e) {
      didErr = true;
      err = e;
    },
    f: function () {
      try {
        if (!normalCompletion && it.return != null) it.return();
      } finally {
        if (didErr) throw err;
      }
    }
  };
}

var MILLISECONDS_MULTIPLIER = 1000;
var TRANSITION_END = 'transitionend'; // Shout-out Angus Croll (https://goo.gl/pxwQGp)

var toType = function toType(object) {
  if (object === null || object === undefined) {
    return "".concat(object);
  }

  return Object.prototype.toString.call(object).match(/\s([a-z]+)/i)[1].toLowerCase();
};
var getSelector = function getSelector(element) {
  var selector = element.getAttribute('data-bs-target');

  if (!selector || selector === '#') {
    var hrefAttribute = element.getAttribute('href'); // The only valid content that could double as a selector are IDs or classes,
    // so everything starting with `#` or `.`. If a "real" URL is used as the selector,
    // `document.querySelector` will rightfully complain it is invalid.
    // See https://github.com/twbs/bootstrap/issues/32273

    if (!hrefAttribute || !hrefAttribute.includes('#') && !hrefAttribute.startsWith('.')) {
      return null;
    } // Just in case some CMS puts out a full URL with the anchor appended


    if (hrefAttribute.includes('#') && !hrefAttribute.startsWith('#')) {
      hrefAttribute = "#".concat(hrefAttribute.split('#')[1]);
    }

    selector = hrefAttribute && hrefAttribute !== '#' ? hrefAttribute.trim() : null;
  }

  return selector;
};

var getElementFromSelector = function getElementFromSelector(element) {
  var selector = getSelector(element);
  return selector ? document.querySelector(selector) : null;
};

var getTransitionDurationFromElement = function getTransitionDurationFromElement(element) {
  if (!element) {
    return 0;
  } // Get transition-duration of the element


  var _window$getComputedSt = window.getComputedStyle(element),
      transitionDuration = _window$getComputedSt.transitionDuration,
      transitionDelay = _window$getComputedSt.transitionDelay;

  var floatTransitionDuration = Number.parseFloat(transitionDuration);
  var floatTransitionDelay = Number.parseFloat(transitionDelay); // Return 0 if element or transition duration is not found

  if (!floatTransitionDuration && !floatTransitionDelay) {
    return 0;
  } // If multiple durations are defined, take the first


  transitionDuration = transitionDuration.split(',')[0];
  transitionDelay = transitionDelay.split(',')[0];
  return (Number.parseFloat(transitionDuration) + Number.parseFloat(transitionDelay)) * MILLISECONDS_MULTIPLIER;
};

var triggerTransitionEnd = function triggerTransitionEnd(element) {
  element.dispatchEvent(new Event(TRANSITION_END));
};

var isElement = function isElement(object) {
  if (!object || _typeof(object) !== 'object') {
    return false;
  }

  if (typeof object.jquery !== 'undefined') {
    object = object[0];
  }

  return typeof object.nodeType !== 'undefined';
};

var getElement = function getElement(object) {
  // it's a jQuery object or a node element
  if (isElement(object)) {
    return object.jquery ? object[0] : object;
  }

  if (typeof object === 'string' && object.length > 0) {
    return document.querySelector(object);
  }

  return null;
};

var isVisible = function isVisible(element) {
  if (!isElement(element) || element.getClientRects().length === 0) {
    return false;
  }

  var elementIsVisible = getComputedStyle(element).getPropertyValue('visibility') === 'visible'; // Handle `details` element as its content may falsie appear visible when it is closed

  var closedDetails = element.closest('details:not([open])');

  if (!closedDetails) {
    return elementIsVisible;
  }

  if (closedDetails !== element) {
    var summary = element.closest('summary');

    if (summary && summary.parentNode !== closedDetails) {
      return false;
    }

    if (summary === null) {
      return false;
    }
  }

  return elementIsVisible;
};

var isDisabled = function isDisabled(element) {
  if (!element || element.nodeType !== Node.ELEMENT_NODE) {
    return true;
  }

  if (element.classList.contains('disabled')) {
    return true;
  }

  if (typeof element.disabled !== 'undefined') {
    return element.disabled;
  }

  return element.hasAttribute('disabled') && element.getAttribute('disabled') !== 'false';
};

/**
 * Trick to restart an element's animation
 *
 * @param {HTMLElement} element
 * @return void
 *
 * @see https://www.charistheo.io/blog/2021/02/restart-a-css-animation-with-javascript/#restarting-a-css-animation
 */


var reflow = function reflow(element) {
  element.offsetHeight; // eslint-disable-line no-unused-expressions
};

var getjQuery = function getjQuery() {
  if (window.jQuery && !document.body.hasAttribute('data-bs-no-jquery')) {
    return window.jQuery;
  }

  return null;
};

var DOMContentLoadedCallbacks = [];

var onDOMContentLoaded = function onDOMContentLoaded(callback) {
  if (document.readyState === 'loading') {
    // add listener on the first call when the document is in loading state
    if (!DOMContentLoadedCallbacks.length) {
      document.addEventListener('DOMContentLoaded', function () {
        var _iterator = _createForOfIteratorHelper(DOMContentLoadedCallbacks),
            _step;

        try {
          for (_iterator.s(); !(_step = _iterator.n()).done;) {
            var _callback = _step.value;

            _callback();
          }
        } catch (err) {
          _iterator.e(err);
        } finally {
          _iterator.f();
        }
      });
    }

    DOMContentLoadedCallbacks.push(callback);
  } else {
    callback();
  }
};

var isRTL = function isRTL() {
  return document.documentElement.dir === 'rtl';
};

var defineJQueryPlugin = function defineJQueryPlugin(plugin) {
  onDOMContentLoaded(function () {
    var $ = getjQuery();
    /* istanbul ignore if */

    if ($) {
      var name = plugin.NAME;
      var JQUERY_NO_CONFLICT = $.fn[name];
      $.fn[name] = plugin.jQueryInterface;
      $.fn[name].Constructor = plugin;

      $.fn[name].noConflict = function () {
        $.fn[name] = JQUERY_NO_CONFLICT;
        return plugin.jQueryInterface;
      };
    }
  });
};

var execute = function execute(callback) {
  if (typeof callback === 'function') {
    callback();
  }
};

var executeAfterTransition = function executeAfterTransition(callback, transitionElement) {
  var waitForTransition = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : true;

  if (!waitForTransition) {
    execute(callback);
    return;
  }

  var durationPadding = 5;
  var emulatedDuration = getTransitionDurationFromElement(transitionElement) + durationPadding;
  var called = false;

  var handler = function handler(_ref) {
    var target = _ref.target;

    if (target !== transitionElement) {
      return;
    }

    called = true;
    transitionElement.removeEventListener(TRANSITION_END, handler);
    execute(callback);
  };

  transitionElement.addEventListener(TRANSITION_END, handler);
  setTimeout(function () {
    if (!called) {
      triggerTransitionEnd(transitionElement);
    }
  }, emulatedDuration);
};

/**
 * --------------------------------------------------------------------------
 * Bootstrap (v5.2.1): dom/event-handler.js
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
 * --------------------------------------------------------------------------
 */
/**
 * Constants
 */

var namespaceRegex = /[^.]*(?=\..*)\.|.*/;
var stripNameRegex = /\..*/;
var stripUidRegex = /::\d+$/;
var eventRegistry = {}; // Events storage

var uidEvent = 1;
var customEvents = {
  mouseenter: 'mouseover',
  mouseleave: 'mouseout'
};
var nativeEvents = new Set(['click', 'dblclick', 'mouseup', 'mousedown', 'contextmenu', 'mousewheel', 'DOMMouseScroll', 'mouseover', 'mouseout', 'mousemove', 'selectstart', 'selectend', 'keydown', 'keypress', 'keyup', 'orientationchange', 'touchstart', 'touchmove', 'touchend', 'touchcancel', 'pointerdown', 'pointermove', 'pointerup', 'pointerleave', 'pointercancel', 'gesturestart', 'gesturechange', 'gestureend', 'focus', 'blur', 'change', 'reset', 'select', 'submit', 'focusin', 'focusout', 'load', 'unload', 'beforeunload', 'resize', 'move', 'DOMContentLoaded', 'readystatechange', 'error', 'abort', 'scroll']);
/**
 * Private methods
 */

function makeEventUid(element, uid) {
  return uid && "".concat(uid, "::").concat(uidEvent++) || element.uidEvent || uidEvent++;
}

function getElementEvents(element) {
  var uid = makeEventUid(element);
  element.uidEvent = uid;
  eventRegistry[uid] = eventRegistry[uid] || {};
  return eventRegistry[uid];
}

function bootstrapHandler(element, fn) {
  return function handler(event) {
    hydrateObj(event, {
      delegateTarget: element
    });

    if (handler.oneOff) {
      EventHandler.off(element, event.type, fn);
    }

    return fn.apply(element, [event]);
  };
}

function bootstrapDelegationHandler(element, selector, fn) {
  return function handler(event) {
    var domElements = element.querySelectorAll(selector);

    for (var target = event.target; target && target !== this; target = target.parentNode) {
      var _iterator = _createForOfIteratorHelper(domElements),
          _step;

      try {
        for (_iterator.s(); !(_step = _iterator.n()).done;) {
          var domElement = _step.value;

          if (domElement !== target) {
            continue;
          }

          hydrateObj(event, {
            delegateTarget: target
          });

          if (handler.oneOff) {
            EventHandler.off(element, event.type, selector, fn);
          }

          return fn.apply(target, [event]);
        }
      } catch (err) {
        _iterator.e(err);
      } finally {
        _iterator.f();
      }
    }
  };
}

function findHandler(events, callable) {
  var delegationSelector = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : null;
  return Object.values(events).find(function (event) {
    return event.callable === callable && event.delegationSelector === delegationSelector;
  });
}

function normalizeParameters(originalTypeEvent, handler, delegationFunction) {
  var isDelegated = typeof handler === 'string'; // todo: tooltip passes `false` instead of selector, so we need to check

  var callable = isDelegated ? delegationFunction : handler || delegationFunction;
  var typeEvent = getTypeEvent(originalTypeEvent);

  if (!nativeEvents.has(typeEvent)) {
    typeEvent = originalTypeEvent;
  }

  return [isDelegated, callable, typeEvent];
}

function addHandler(element, originalTypeEvent, handler, delegationFunction, oneOff) {
  if (typeof originalTypeEvent !== 'string' || !element) {
    return;
  }

  var _normalizeParameters = normalizeParameters(originalTypeEvent, handler, delegationFunction),
      _normalizeParameters2 = _slicedToArray(_normalizeParameters, 3),
      isDelegated = _normalizeParameters2[0],
      callable = _normalizeParameters2[1],
      typeEvent = _normalizeParameters2[2]; // in case of mouseenter or mouseleave wrap the handler within a function that checks for its DOM position
  // this prevents the handler from being dispatched the same way as mouseover or mouseout does


  if (originalTypeEvent in customEvents) {
    var wrapFunction = function wrapFunction(fn) {
      return function (event) {
        if (!event.relatedTarget || event.relatedTarget !== event.delegateTarget && !event.delegateTarget.contains(event.relatedTarget)) {
          return fn.call(this, event);
        }
      };
    };

    callable = wrapFunction(callable);
  }

  var events = getElementEvents(element);
  var handlers = events[typeEvent] || (events[typeEvent] = {});
  var previousFunction = findHandler(handlers, callable, isDelegated ? handler : null);

  if (previousFunction) {
    previousFunction.oneOff = previousFunction.oneOff && oneOff;
    return;
  }

  var uid = makeEventUid(callable, originalTypeEvent.replace(namespaceRegex, ''));
  var fn = isDelegated ? bootstrapDelegationHandler(element, handler, callable) : bootstrapHandler(element, callable);
  fn.delegationSelector = isDelegated ? handler : null;
  fn.callable = callable;
  fn.oneOff = oneOff;
  fn.uidEvent = uid;
  handlers[uid] = fn;
  element.addEventListener(typeEvent, fn, isDelegated);
}

function removeHandler(element, events, typeEvent, handler, delegationSelector) {
  var fn = findHandler(events[typeEvent], handler, delegationSelector);

  if (!fn) {
    return;
  }

  element.removeEventListener(typeEvent, fn, Boolean(delegationSelector));
  delete events[typeEvent][fn.uidEvent];
}

function removeNamespacedHandlers(element, events, typeEvent, namespace) {
  var storeElementEvent = events[typeEvent] || {};

  for (var _i = 0, _Object$keys = Object.keys(storeElementEvent); _i < _Object$keys.length; _i++) {
    var handlerKey = _Object$keys[_i];

    if (handlerKey.includes(namespace)) {
      var event = storeElementEvent[handlerKey];
      removeHandler(element, events, typeEvent, event.callable, event.delegationSelector);
    }
  }
}

function getTypeEvent(event) {
  // allow to get the native events from namespaced events ('click.bs.button' --> 'click')
  event = event.replace(stripNameRegex, '');
  return customEvents[event] || event;
}

var EventHandler = {
  on: function on(element, event, handler, delegationFunction) {
    addHandler(element, event, handler, delegationFunction, false);
  },
  one: function one(element, event, handler, delegationFunction) {
    addHandler(element, event, handler, delegationFunction, true);
  },
  off: function off(element, originalTypeEvent, handler, delegationFunction) {
    if (typeof originalTypeEvent !== 'string' || !element) {
      return;
    }

    var _normalizeParameters3 = normalizeParameters(originalTypeEvent, handler, delegationFunction),
        _normalizeParameters4 = _slicedToArray(_normalizeParameters3, 3),
        isDelegated = _normalizeParameters4[0],
        callable = _normalizeParameters4[1],
        typeEvent = _normalizeParameters4[2];

    var inNamespace = typeEvent !== originalTypeEvent;
    var events = getElementEvents(element);
    var storeElementEvent = events[typeEvent] || {};
    var isNamespace = originalTypeEvent.startsWith('.');

    if (typeof callable !== 'undefined') {
      // Simplest case: handler is passed, remove that listener ONLY.
      if (!Object.keys(storeElementEvent).length) {
        return;
      }

      removeHandler(element, events, typeEvent, callable, isDelegated ? handler : null);
      return;
    }

    if (isNamespace) {
      for (var _i2 = 0, _Object$keys2 = Object.keys(events); _i2 < _Object$keys2.length; _i2++) {
        var elementEvent = _Object$keys2[_i2];
        removeNamespacedHandlers(element, events, elementEvent, originalTypeEvent.slice(1));
      }
    }

    for (var _i3 = 0, _Object$keys3 = Object.keys(storeElementEvent); _i3 < _Object$keys3.length; _i3++) {
      var keyHandlers = _Object$keys3[_i3];
      var handlerKey = keyHandlers.replace(stripUidRegex, '');

      if (!inNamespace || originalTypeEvent.includes(handlerKey)) {
        var event = storeElementEvent[keyHandlers];
        removeHandler(element, events, typeEvent, event.callable, event.delegationSelector);
      }
    }
  },
  trigger: function trigger(element, event, args) {
    if (typeof event !== 'string' || !element) {
      return null;
    }

    var $ = getjQuery();
    var typeEvent = getTypeEvent(event);
    var inNamespace = event !== typeEvent;
    var jQueryEvent = null;
    var bubbles = true;
    var nativeDispatch = true;
    var defaultPrevented = false;

    if (inNamespace && $) {
      jQueryEvent = $.Event(event, args);
      $(element).trigger(jQueryEvent);
      bubbles = !jQueryEvent.isPropagationStopped();
      nativeDispatch = !jQueryEvent.isImmediatePropagationStopped();
      defaultPrevented = jQueryEvent.isDefaultPrevented();
    }

    var evt = new Event(event, {
      bubbles: bubbles,
      cancelable: true
    });
    evt = hydrateObj(evt, args);

    if (defaultPrevented) {
      evt.preventDefault();
    }

    if (nativeDispatch) {
      element.dispatchEvent(evt);
    }

    if (evt.defaultPrevented && jQueryEvent) {
      jQueryEvent.preventDefault();
    }

    return evt;
  }
};

function hydrateObj(obj, meta) {
  var _loop = function _loop() {
    var _Object$entries$_i = _slicedToArray(_Object$entries[_i4], 2),
        key = _Object$entries$_i[0],
        value = _Object$entries$_i[1];

    try {
      obj[key] = value;
    } catch (_unused) {
      Object.defineProperty(obj, key, {
        configurable: true,
        get: function get() {
          return value;
        }
      });
    }
  };

  for (var _i4 = 0, _Object$entries = Object.entries(meta || {}); _i4 < _Object$entries.length; _i4++) {
    _loop();
  }

  return obj;
}

/**
 * --------------------------------------------------------------------------
 * Bootstrap (v5.2.1): dom/data.js
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
 * --------------------------------------------------------------------------
 */

/**
 * Constants
 */
var elementMap = new Map();
var Data = {
  set: function set(element, key, instance) {
    if (!elementMap.has(element)) {
      elementMap.set(element, new Map());
    }

    var instanceMap = elementMap.get(element); // make it clear we only want one instance per element
    // can be removed later when multiple key/instances are fine to be used

    if (!instanceMap.has(key) && instanceMap.size !== 0) {
      // eslint-disable-next-line no-console
      console.error("Bootstrap doesn't allow more than one instance per element. Bound instance: ".concat(Array.from(instanceMap.keys())[0], "."));
      return;
    }

    instanceMap.set(key, instance);
  },
  get: function get(element, key) {
    if (elementMap.has(element)) {
      return elementMap.get(element).get(key) || null;
    }

    return null;
  },
  remove: function remove(element, key) {
    if (!elementMap.has(element)) {
      return;
    }

    var instanceMap = elementMap.get(element);
    instanceMap["delete"](key); // free up element references if there are no instances left for an element

    if (instanceMap.size === 0) {
      elementMap["delete"](element);
    }
  }
};

/**
 * --------------------------------------------------------------------------
 * Bootstrap (v5.2.1): dom/manipulator.js
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
 * --------------------------------------------------------------------------
 */
function normalizeData(value) {
  if (value === 'true') {
    return true;
  }

  if (value === 'false') {
    return false;
  }

  if (value === Number(value).toString()) {
    return Number(value);
  }

  if (value === '' || value === 'null') {
    return null;
  }

  if (typeof value !== 'string') {
    return value;
  }

  try {
    return JSON.parse(decodeURIComponent(value));
  } catch (_unused) {
    return value;
  }
}

function normalizeDataKey(key) {
  return key.replace(/[A-Z]/g, function (chr) {
    return "-".concat(chr.toLowerCase());
  });
}

var Manipulator = {
  setDataAttribute: function setDataAttribute(element, key, value) {
    element.setAttribute("data-bs-".concat(normalizeDataKey(key)), value);
  },
  removeDataAttribute: function removeDataAttribute(element, key) {
    element.removeAttribute("data-bs-".concat(normalizeDataKey(key)));
  },
  getDataAttributes: function getDataAttributes(element) {
    if (!element) {
      return {};
    }

    var attributes = {};
    var bsKeys = Object.keys(element.dataset).filter(function (key) {
      return key.startsWith('bs') && !key.startsWith('bsConfig');
    });

    var _iterator = _createForOfIteratorHelper(bsKeys),
        _step;

    try {
      for (_iterator.s(); !(_step = _iterator.n()).done;) {
        var key = _step.value;
        var pureKey = key.replace(/^bs/, '');
        pureKey = pureKey.charAt(0).toLowerCase() + pureKey.slice(1, pureKey.length);
        attributes[pureKey] = normalizeData(element.dataset[key]);
      }
    } catch (err) {
      _iterator.e(err);
    } finally {
      _iterator.f();
    }

    return attributes;
  },
  getDataAttribute: function getDataAttribute(element, key) {
    return normalizeData(element.getAttribute("data-bs-".concat(normalizeDataKey(key))));
  }
};

/**
 * --------------------------------------------------------------------------
 * Bootstrap (v5.2.1): util/config.js
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
 * --------------------------------------------------------------------------
 */
/**
 * Class definition
 */

var Config = /*#__PURE__*/function () {
  function Config() {
    _classCallCheck(this, Config);
  }

  _createClass(Config, [{
    key: "_getConfig",
    value: function _getConfig(config) {
      config = this._mergeConfigObj(config);
      config = this._configAfterMerge(config);

      this._typeCheckConfig(config);

      return config;
    }
  }, {
    key: "_configAfterMerge",
    value: function _configAfterMerge(config) {
      return config;
    }
  }, {
    key: "_mergeConfigObj",
    value: function _mergeConfigObj(config, element) {
      var jsonConfig = isElement(element) ? Manipulator.getDataAttribute(element, 'config') : {}; // try to parse

      return _objectSpread2(_objectSpread2(_objectSpread2(_objectSpread2({}, this.constructor.Default), _typeof(jsonConfig) === 'object' ? jsonConfig : {}), isElement(element) ? Manipulator.getDataAttributes(element) : {}), _typeof(config) === 'object' ? config : {});
    }
  }, {
    key: "_typeCheckConfig",
    value: function _typeCheckConfig(config) {
      var configTypes = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : this.constructor.DefaultType;

      for (var _i = 0, _Object$keys = Object.keys(configTypes); _i < _Object$keys.length; _i++) {
        var property = _Object$keys[_i];
        var expectedTypes = configTypes[property];
        var value = config[property];
        var valueType = isElement(value) ? 'element' : toType(value);

        if (!new RegExp(expectedTypes).test(valueType)) {
          throw new TypeError("".concat(this.constructor.NAME.toUpperCase(), ": Option \"").concat(property, "\" provided type \"").concat(valueType, "\" but expected type \"").concat(expectedTypes, "\"."));
        }
      }
    }
  }], [{
    key: "Default",
    get: // Getters
    function get() {
      return {};
    }
  }, {
    key: "DefaultType",
    get: function get() {
      return {};
    }
  }, {
    key: "NAME",
    get: function get() {
      throw new Error('You have to implement the static method "NAME", for each component!');
    }
  }]);

  return Config;
}();

/**
 * --------------------------------------------------------------------------
 * Bootstrap (v5.2.1): base-component.js
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
 * --------------------------------------------------------------------------
 */
/**
 * Constants
 */

var VERSION = '5.2.1';
/**
 * Class definition
 */

var BaseComponent = /*#__PURE__*/function (_Config) {
  _inherits(BaseComponent, _Config);

  var _super = _createSuper(BaseComponent);

  function BaseComponent(element, config) {
    var _this;

    _classCallCheck(this, BaseComponent);

    _this = _super.call(this);
    element = getElement(element);

    if (!element) {
      return _possibleConstructorReturn(_this);
    }

    _this._element = element;
    _this._config = _this._getConfig(config);
    Data.set(_this._element, _this.constructor.DATA_KEY, _assertThisInitialized(_this));
    return _this;
  } // Public


  _createClass(BaseComponent, [{
    key: "dispose",
    value: function dispose() {
      Data.remove(this._element, this.constructor.DATA_KEY);
      EventHandler.off(this._element, this.constructor.EVENT_KEY);

      var _iterator = _createForOfIteratorHelper(Object.getOwnPropertyNames(this)),
          _step;

      try {
        for (_iterator.s(); !(_step = _iterator.n()).done;) {
          var propertyName = _step.value;
          this[propertyName] = null;
        }
      } catch (err) {
        _iterator.e(err);
      } finally {
        _iterator.f();
      }
    }
  }, {
    key: "_queueCallback",
    value: function _queueCallback(callback, element) {
      var isAnimated = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : true;
      executeAfterTransition(callback, element, isAnimated);
    }
  }, {
    key: "_getConfig",
    value: function _getConfig(config) {
      config = this._mergeConfigObj(config, this._element);
      config = this._configAfterMerge(config);

      this._typeCheckConfig(config);

      return config;
    } // Static

  }], [{
    key: "getInstance",
    value: function getInstance(element) {
      return Data.get(getElement(element), this.DATA_KEY);
    }
  }, {
    key: "getOrCreateInstance",
    value: function getOrCreateInstance(element) {
      var config = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
      return this.getInstance(element) || new this(element, _typeof(config) === 'object' ? config : null);
    }
  }, {
    key: "VERSION",
    get: function get() {
      return VERSION;
    }
  }, {
    key: "DATA_KEY",
    get: function get() {
      return "bs.".concat(this.NAME);
    }
  }, {
    key: "EVENT_KEY",
    get: function get() {
      return ".".concat(this.DATA_KEY);
    }
  }, {
    key: "eventName",
    value: function eventName(name) {
      return "".concat(name).concat(this.EVENT_KEY);
    }
  }]);

  return BaseComponent;
}(Config);

/**
 * --------------------------------------------------------------------------
 * Bootstrap (v5.2.1): util/component-functions.js
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
 * --------------------------------------------------------------------------
 */
var enableDismissTrigger = function enableDismissTrigger(component) {
  var method = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 'hide';
  var clickEvent = "click.dismiss".concat(component.EVENT_KEY);
  var name = component.NAME;
  EventHandler.on(document, clickEvent, "[data-bs-dismiss=\"".concat(name, "\"]"), function (event) {
    if (['A', 'AREA'].includes(this.tagName)) {
      event.preventDefault();
    }

    if (isDisabled(this)) {
      return;
    }

    var target = getElementFromSelector(this) || this.closest(".".concat(name));
    var instance = component.getOrCreateInstance(target); // Method argument is left, for Alert and only, as it doesn't implement the 'hide' method

    instance[method]();
  });
};

/**
 * --------------------------------------------------------------------------
 * Bootstrap (v5.2.1): alert.js
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
 * --------------------------------------------------------------------------
 */
/**
 * Constants
 */

var NAME = 'alert';
var DATA_KEY = 'bs.alert';
var EVENT_KEY = ".".concat(DATA_KEY);
var EVENT_CLOSE = "close".concat(EVENT_KEY);
var EVENT_CLOSED = "closed".concat(EVENT_KEY);
var CLASS_NAME_FADE = 'fade';
var CLASS_NAME_SHOW = 'show';
/**
 * Class definition
 */

var Alert = /*#__PURE__*/function (_BaseComponent) {
  _inherits(Alert, _BaseComponent);

  var _super = _createSuper(Alert);

  function Alert() {
    _classCallCheck(this, Alert);

    return _super.apply(this, arguments);
  }

  _createClass(Alert, [{
    key: "close",
    value: // Public
    function close() {
      var _this = this;

      var closeEvent = EventHandler.trigger(this._element, EVENT_CLOSE);

      if (closeEvent.defaultPrevented) {
        return;
      }

      this._element.classList.remove(CLASS_NAME_SHOW);

      var isAnimated = this._element.classList.contains(CLASS_NAME_FADE);

      this._queueCallback(function () {
        return _this._destroyElement();
      }, this._element, isAnimated);
    } // Private

  }, {
    key: "_destroyElement",
    value: function _destroyElement() {
      this._element.remove();

      EventHandler.trigger(this._element, EVENT_CLOSED);
      this.dispose();
    } // Static

  }], [{
    key: "NAME",
    get: // Getters
    function get() {
      return NAME;
    }
  }, {
    key: "jQueryInterface",
    value: function jQueryInterface(config) {
      return this.each(function () {
        var data = Alert.getOrCreateInstance(this);

        if (typeof config !== 'string') {
          return;
        }

        if (data[config] === undefined || config.startsWith('_') || config === 'constructor') {
          throw new TypeError("No method named \"".concat(config, "\""));
        }

        data[config](this);
      });
    }
  }]);

  return Alert;
}(BaseComponent);
/**
 * Data API implementation
 */


enableDismissTrigger(Alert, 'close');
/**
 * jQuery
 */

defineJQueryPlugin(Alert);

/**
 * --------------------------------------------------------------------------
 * Bootstrap (v5.2.1): dom/selector-engine.js
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
 * --------------------------------------------------------------------------
 */
/**
 * Constants
 */

var SelectorEngine = {
  find: function find(selector) {
    var _ref;

    var element = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : document.documentElement;
    return (_ref = []).concat.apply(_ref, _toConsumableArray(Element.prototype.querySelectorAll.call(element, selector)));
  },
  findOne: function findOne(selector) {
    var element = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : document.documentElement;
    return Element.prototype.querySelector.call(element, selector);
  },
  children: function children(element, selector) {
    var _ref2;

    return (_ref2 = []).concat.apply(_ref2, _toConsumableArray(element.children)).filter(function (child) {
      return child.matches(selector);
    });
  },
  parents: function parents(element, selector) {
    var parents = [];
    var ancestor = element.parentNode.closest(selector);

    while (ancestor) {
      parents.push(ancestor);
      ancestor = ancestor.parentNode.closest(selector);
    }

    return parents;
  },
  prev: function prev(element, selector) {
    var previous = element.previousElementSibling;

    while (previous) {
      if (previous.matches(selector)) {
        return [previous];
      }

      previous = previous.previousElementSibling;
    }

    return [];
  },
  // TODO: this is now unused; remove later along with prev()
  next: function next(element, selector) {
    var next = element.nextElementSibling;

    while (next) {
      if (next.matches(selector)) {
        return [next];
      }

      next = next.nextElementSibling;
    }

    return [];
  },
  focusableChildren: function focusableChildren(element) {
    var focusables = ['a', 'button', 'input', 'textarea', 'select', 'details', '[tabindex]', '[contenteditable="true"]'].map(function (selector) {
      return "".concat(selector, ":not([tabindex^=\"-\"])");
    }).join(',');
    return this.find(focusables, element).filter(function (el) {
      return !isDisabled(el) && isVisible(el);
    });
  }
};

/**
 * --------------------------------------------------------------------------
 * Bootstrap (v5.2.1): util/scrollBar.js
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
 * --------------------------------------------------------------------------
 */
/**
 * Constants
 */

var SELECTOR_FIXED_CONTENT = '.fixed-top, .fixed-bottom, .is-fixed, .sticky-top';
var SELECTOR_STICKY_CONTENT = '.sticky-top';
var PROPERTY_PADDING = 'padding-right';
var PROPERTY_MARGIN = 'margin-right';
/**
 * Class definition
 */

var ScrollBarHelper = /*#__PURE__*/function () {
  function ScrollBarHelper() {
    _classCallCheck(this, ScrollBarHelper);

    this._element = document.body;
  } // Public


  _createClass(ScrollBarHelper, [{
    key: "getWidth",
    value: function getWidth() {
      // https://developer.mozilla.org/en-US/docs/Web/API/Window/innerWidth#usage_notes
      var documentWidth = document.documentElement.clientWidth;
      return Math.abs(window.innerWidth - documentWidth);
    }
  }, {
    key: "hide",
    value: function hide() {
      var width = this.getWidth();

      this._disableOverFlow(); // give padding to element to balance the hidden scrollbar width


      this._setElementAttributes(this._element, PROPERTY_PADDING, function (calculatedValue) {
        return calculatedValue + width;
      }); // trick: We adjust positive paddingRight and negative marginRight to sticky-top elements to keep showing fullwidth


      this._setElementAttributes(SELECTOR_FIXED_CONTENT, PROPERTY_PADDING, function (calculatedValue) {
        return calculatedValue + width;
      });

      this._setElementAttributes(SELECTOR_STICKY_CONTENT, PROPERTY_MARGIN, function (calculatedValue) {
        return calculatedValue - width;
      });
    }
  }, {
    key: "reset",
    value: function reset() {
      this._resetElementAttributes(this._element, 'overflow');

      this._resetElementAttributes(this._element, PROPERTY_PADDING);

      this._resetElementAttributes(SELECTOR_FIXED_CONTENT, PROPERTY_PADDING);

      this._resetElementAttributes(SELECTOR_STICKY_CONTENT, PROPERTY_MARGIN);
    }
  }, {
    key: "isOverflowing",
    value: function isOverflowing() {
      return this.getWidth() > 0;
    } // Private

  }, {
    key: "_disableOverFlow",
    value: function _disableOverFlow() {
      this._saveInitialAttribute(this._element, 'overflow');

      this._element.style.overflow = 'hidden';
    }
  }, {
    key: "_setElementAttributes",
    value: function _setElementAttributes(selector, styleProperty, callback) {
      var _this = this;

      var scrollbarWidth = this.getWidth();

      var manipulationCallBack = function manipulationCallBack(element) {
        if (element !== _this._element && window.innerWidth > element.clientWidth + scrollbarWidth) {
          return;
        }

        _this._saveInitialAttribute(element, styleProperty);

        var calculatedValue = window.getComputedStyle(element).getPropertyValue(styleProperty);
        element.style.setProperty(styleProperty, "".concat(callback(Number.parseFloat(calculatedValue)), "px"));
      };

      this._applyManipulationCallback(selector, manipulationCallBack);
    }
  }, {
    key: "_saveInitialAttribute",
    value: function _saveInitialAttribute(element, styleProperty) {
      var actualValue = element.style.getPropertyValue(styleProperty);

      if (actualValue) {
        Manipulator.setDataAttribute(element, styleProperty, actualValue);
      }
    }
  }, {
    key: "_resetElementAttributes",
    value: function _resetElementAttributes(selector, styleProperty) {
      var manipulationCallBack = function manipulationCallBack(element) {
        var value = Manipulator.getDataAttribute(element, styleProperty); // We only want to remove the property if the value is `null`; the value can also be zero

        if (value === null) {
          element.style.removeProperty(styleProperty);
          return;
        }

        Manipulator.removeDataAttribute(element, styleProperty);
        element.style.setProperty(styleProperty, value);
      };

      this._applyManipulationCallback(selector, manipulationCallBack);
    }
  }, {
    key: "_applyManipulationCallback",
    value: function _applyManipulationCallback(selector, callBack) {
      if (isElement(selector)) {
        callBack(selector);
        return;
      }

      var _iterator = _createForOfIteratorHelper(SelectorEngine.find(selector, this._element)),
          _step;

      try {
        for (_iterator.s(); !(_step = _iterator.n()).done;) {
          var sel = _step.value;
          callBack(sel);
        }
      } catch (err) {
        _iterator.e(err);
      } finally {
        _iterator.f();
      }
    }
  }]);

  return ScrollBarHelper;
}();

/**
 * --------------------------------------------------------------------------
 * Bootstrap (v5.2.1): util/backdrop.js
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
 * --------------------------------------------------------------------------
 */
/**
 * Constants
 */

var NAME$2 = 'backdrop';
var CLASS_NAME_FADE$2 = 'fade';
var CLASS_NAME_SHOW$2 = 'show';
var EVENT_MOUSEDOWN = "mousedown.bs.".concat(NAME$2);
var Default$1 = {
  className: 'modal-backdrop',
  clickCallback: null,
  isAnimated: false,
  isVisible: true,
  // if false, we use the backdrop helper without adding any element to the dom
  rootElement: 'body' // give the choice to place backdrop under different elements

};
var DefaultType$1 = {
  className: 'string',
  clickCallback: '(function|null)',
  isAnimated: 'boolean',
  isVisible: 'boolean',
  rootElement: '(element|string)'
};
/**
 * Class definition
 */

var Backdrop = /*#__PURE__*/function (_Config) {
  _inherits(Backdrop, _Config);

  var _super = _createSuper(Backdrop);

  function Backdrop(config) {
    var _this;

    _classCallCheck(this, Backdrop);

    _this = _super.call(this);
    _this._config = _this._getConfig(config);
    _this._isAppended = false;
    _this._element = null;
    return _this;
  } // Getters


  _createClass(Backdrop, [{
    key: "show",
    value: // Public
    function show(callback) {
      if (!this._config.isVisible) {
        execute(callback);
        return;
      }

      this._append();

      var element = this._getElement();

      if (this._config.isAnimated) {
        reflow(element);
      }

      element.classList.add(CLASS_NAME_SHOW$2);

      this._emulateAnimation(function () {
        execute(callback);
      });
    }
  }, {
    key: "hide",
    value: function hide(callback) {
      var _this2 = this;

      if (!this._config.isVisible) {
        execute(callback);
        return;
      }

      this._getElement().classList.remove(CLASS_NAME_SHOW$2);

      this._emulateAnimation(function () {
        _this2.dispose();

        execute(callback);
      });
    }
  }, {
    key: "dispose",
    value: function dispose() {
      if (!this._isAppended) {
        return;
      }

      EventHandler.off(this._element, EVENT_MOUSEDOWN);

      this._element.remove();

      this._isAppended = false;
    } // Private

  }, {
    key: "_getElement",
    value: function _getElement() {
      if (!this._element) {
        var backdrop = document.createElement('div');
        backdrop.className = this._config.className;

        if (this._config.isAnimated) {
          backdrop.classList.add(CLASS_NAME_FADE$2);
        }

        this._element = backdrop;
      }

      return this._element;
    }
  }, {
    key: "_configAfterMerge",
    value: function _configAfterMerge(config) {
      // use getElement() with the default "body" to get a fresh Element on each instantiation
      config.rootElement = getElement(config.rootElement);
      return config;
    }
  }, {
    key: "_append",
    value: function _append() {
      var _this3 = this;

      if (this._isAppended) {
        return;
      }

      var element = this._getElement();

      this._config.rootElement.append(element);

      EventHandler.on(element, EVENT_MOUSEDOWN, function () {
        execute(_this3._config.clickCallback);
      });
      this._isAppended = true;
    }
  }, {
    key: "_emulateAnimation",
    value: function _emulateAnimation(callback) {
      executeAfterTransition(callback, this._getElement(), this._config.isAnimated);
    }
  }], [{
    key: "Default",
    get: function get() {
      return Default$1;
    }
  }, {
    key: "DefaultType",
    get: function get() {
      return DefaultType$1;
    }
  }, {
    key: "NAME",
    get: function get() {
      return NAME$2;
    }
  }]);

  return Backdrop;
}(Config);

/**
 * --------------------------------------------------------------------------
 * Bootstrap (v5.2.1): util/focustrap.js
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
 * --------------------------------------------------------------------------
 */
/**
 * Constants
 */

var NAME$3 = 'focustrap';
var DATA_KEY$2 = 'bs.focustrap';
var EVENT_KEY$2 = ".".concat(DATA_KEY$2);
var EVENT_FOCUSIN = "focusin".concat(EVENT_KEY$2);
var EVENT_KEYDOWN_TAB = "keydown.tab".concat(EVENT_KEY$2);
var TAB_KEY = 'Tab';
var TAB_NAV_FORWARD = 'forward';
var TAB_NAV_BACKWARD = 'backward';
var Default$2 = {
  autofocus: true,
  trapElement: null // The element to trap focus inside of

};
var DefaultType$2 = {
  autofocus: 'boolean',
  trapElement: 'element'
};
/**
 * Class definition
 */

var FocusTrap = /*#__PURE__*/function (_Config) {
  _inherits(FocusTrap, _Config);

  var _super = _createSuper(FocusTrap);

  function FocusTrap(config) {
    var _this;

    _classCallCheck(this, FocusTrap);

    _this = _super.call(this);
    _this._config = _this._getConfig(config);
    _this._isActive = false;
    _this._lastTabNavDirection = null;
    return _this;
  } // Getters


  _createClass(FocusTrap, [{
    key: "activate",
    value: // Public
    function activate() {
      var _this2 = this;

      if (this._isActive) {
        return;
      }

      if (this._config.autofocus) {
        this._config.trapElement.focus();
      }

      EventHandler.off(document, EVENT_KEY$2); // guard against infinite focus loop

      EventHandler.on(document, EVENT_FOCUSIN, function (event) {
        return _this2._handleFocusin(event);
      });
      EventHandler.on(document, EVENT_KEYDOWN_TAB, function (event) {
        return _this2._handleKeydown(event);
      });
      this._isActive = true;
    }
  }, {
    key: "deactivate",
    value: function deactivate() {
      if (!this._isActive) {
        return;
      }

      this._isActive = false;
      EventHandler.off(document, EVENT_KEY$2);
    } // Private

  }, {
    key: "_handleFocusin",
    value: function _handleFocusin(event) {
      var trapElement = this._config.trapElement;

      if (event.target === document || event.target === trapElement || trapElement.contains(event.target)) {
        return;
      }

      var elements = SelectorEngine.focusableChildren(trapElement);

      if (elements.length === 0) {
        trapElement.focus();
      } else if (this._lastTabNavDirection === TAB_NAV_BACKWARD) {
        elements[elements.length - 1].focus();
      } else {
        elements[0].focus();
      }
    }
  }, {
    key: "_handleKeydown",
    value: function _handleKeydown(event) {
      if (event.key !== TAB_KEY) {
        return;
      }

      this._lastTabNavDirection = event.shiftKey ? TAB_NAV_BACKWARD : TAB_NAV_FORWARD;
    }
  }], [{
    key: "Default",
    get: function get() {
      return Default$2;
    }
  }, {
    key: "DefaultType",
    get: function get() {
      return DefaultType$2;
    }
  }, {
    key: "NAME",
    get: function get() {
      return NAME$3;
    }
  }]);

  return FocusTrap;
}(Config);

/**
 * --------------------------------------------------------------------------
 * Bootstrap (v5.2.1): modal.js
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
 * --------------------------------------------------------------------------
 */
/**
 * Constants
 */

var NAME$1 = 'modal';
var DATA_KEY$1 = 'bs.modal';
var EVENT_KEY$1 = ".".concat(DATA_KEY$1);
var DATA_API_KEY = '.data-api';
var ESCAPE_KEY = 'Escape';
var EVENT_HIDE = "hide".concat(EVENT_KEY$1);
var EVENT_HIDE_PREVENTED = "hidePrevented".concat(EVENT_KEY$1);
var EVENT_HIDDEN = "hidden".concat(EVENT_KEY$1);
var EVENT_SHOW = "show".concat(EVENT_KEY$1);
var EVENT_SHOWN = "shown".concat(EVENT_KEY$1);
var EVENT_RESIZE = "resize".concat(EVENT_KEY$1);
var EVENT_CLICK_DISMISS = "click.dismiss".concat(EVENT_KEY$1);
var EVENT_MOUSEDOWN_DISMISS = "mousedown.dismiss".concat(EVENT_KEY$1);
var EVENT_KEYDOWN_DISMISS = "keydown.dismiss".concat(EVENT_KEY$1);
var EVENT_CLICK_DATA_API = "click".concat(EVENT_KEY$1).concat(DATA_API_KEY);
var CLASS_NAME_OPEN = 'modal-open';
var CLASS_NAME_FADE$1 = 'fade';
var CLASS_NAME_SHOW$1 = 'show';
var CLASS_NAME_STATIC = 'modal-static';
var OPEN_SELECTOR = '.modal.show';
var SELECTOR_DIALOG = '.modal-dialog';
var SELECTOR_MODAL_BODY = '.modal-body';
var SELECTOR_DATA_TOGGLE = '[data-bs-toggle="modal"]';
var Default = {
  backdrop: true,
  focus: true,
  keyboard: true
};
var DefaultType = {
  backdrop: '(boolean|string)',
  focus: 'boolean',
  keyboard: 'boolean'
};
/**
 * Class definition
 */

var Modal = /*#__PURE__*/function (_BaseComponent) {
  _inherits(Modal, _BaseComponent);

  var _super = _createSuper(Modal);

  function Modal(element, config) {
    var _this;

    _classCallCheck(this, Modal);

    _this = _super.call(this, element, config);
    _this._dialog = SelectorEngine.findOne(SELECTOR_DIALOG, _this._element);
    _this._backdrop = _this._initializeBackDrop();
    _this._focustrap = _this._initializeFocusTrap();
    _this._isShown = false;
    _this._isTransitioning = false;
    _this._scrollBar = new ScrollBarHelper();

    _this._addEventListeners();

    return _this;
  } // Getters


  _createClass(Modal, [{
    key: "toggle",
    value: // Public
    function toggle(relatedTarget) {
      return this._isShown ? this.hide() : this.show(relatedTarget);
    }
  }, {
    key: "show",
    value: function show(relatedTarget) {
      var _this2 = this;

      if (this._isShown || this._isTransitioning) {
        return;
      }

      var showEvent = EventHandler.trigger(this._element, EVENT_SHOW, {
        relatedTarget: relatedTarget
      });

      if (showEvent.defaultPrevented) {
        return;
      }

      this._isShown = true;
      this._isTransitioning = true;

      this._scrollBar.hide();

      document.body.classList.add(CLASS_NAME_OPEN);

      this._adjustDialog();

      this._backdrop.show(function () {
        return _this2._showElement(relatedTarget);
      });
    }
  }, {
    key: "hide",
    value: function hide() {
      var _this3 = this;

      if (!this._isShown || this._isTransitioning) {
        return;
      }

      var hideEvent = EventHandler.trigger(this._element, EVENT_HIDE);

      if (hideEvent.defaultPrevented) {
        return;
      }

      this._isShown = false;
      this._isTransitioning = true;

      this._focustrap.deactivate();

      this._element.classList.remove(CLASS_NAME_SHOW$1);

      this._queueCallback(function () {
        return _this3._hideModal();
      }, this._element, this._isAnimated());
    }
  }, {
    key: "dispose",
    value: function dispose() {
      for (var _i = 0, _arr = [window, this._dialog]; _i < _arr.length; _i++) {
        var htmlElement = _arr[_i];
        EventHandler.off(htmlElement, EVENT_KEY$1);
      }

      this._backdrop.dispose();

      this._focustrap.deactivate();

      _get(_getPrototypeOf(Modal.prototype), "dispose", this).call(this);
    }
  }, {
    key: "handleUpdate",
    value: function handleUpdate() {
      this._adjustDialog();
    } // Private

  }, {
    key: "_initializeBackDrop",
    value: function _initializeBackDrop() {
      return new Backdrop({
        isVisible: Boolean(this._config.backdrop),
        // 'static' option will be translated to true, and booleans will keep their value,
        isAnimated: this._isAnimated()
      });
    }
  }, {
    key: "_initializeFocusTrap",
    value: function _initializeFocusTrap() {
      return new FocusTrap({
        trapElement: this._element
      });
    }
  }, {
    key: "_showElement",
    value: function _showElement(relatedTarget) {
      var _this4 = this;

      // try to append dynamic modal
      if (!document.body.contains(this._element)) {
        document.body.append(this._element);
      }

      this._element.style.display = 'block';

      this._element.removeAttribute('aria-hidden');

      this._element.setAttribute('aria-modal', true);

      this._element.setAttribute('role', 'dialog');

      this._element.scrollTop = 0;
      var modalBody = SelectorEngine.findOne(SELECTOR_MODAL_BODY, this._dialog);

      if (modalBody) {
        modalBody.scrollTop = 0;
      }

      reflow(this._element);

      this._element.classList.add(CLASS_NAME_SHOW$1);

      var transitionComplete = function transitionComplete() {
        if (_this4._config.focus) {
          _this4._focustrap.activate();
        }

        _this4._isTransitioning = false;
        EventHandler.trigger(_this4._element, EVENT_SHOWN, {
          relatedTarget: relatedTarget
        });
      };

      this._queueCallback(transitionComplete, this._dialog, this._isAnimated());
    }
  }, {
    key: "_addEventListeners",
    value: function _addEventListeners() {
      var _this5 = this;

      EventHandler.on(this._element, EVENT_KEYDOWN_DISMISS, function (event) {
        if (event.key !== ESCAPE_KEY) {
          return;
        }

        if (_this5._config.keyboard) {
          event.preventDefault();

          _this5.hide();

          return;
        }

        _this5._triggerBackdropTransition();
      });
      EventHandler.on(window, EVENT_RESIZE, function () {
        if (_this5._isShown && !_this5._isTransitioning) {
          _this5._adjustDialog();
        }
      });
      EventHandler.on(this._element, EVENT_MOUSEDOWN_DISMISS, function (event) {
        EventHandler.one(_this5._element, EVENT_CLICK_DISMISS, function (event2) {
          // a bad trick to segregate clicks that may start inside dialog but end outside, and avoid listen to scrollbar clicks
          if (_this5._dialog.contains(event.target) || _this5._dialog.contains(event2.target)) {
            return;
          }

          if (_this5._config.backdrop === 'static') {
            _this5._triggerBackdropTransition();

            return;
          }

          if (_this5._config.backdrop) {
            _this5.hide();
          }
        });
      });
    }
  }, {
    key: "_hideModal",
    value: function _hideModal() {
      var _this6 = this;

      this._element.style.display = 'none';

      this._element.setAttribute('aria-hidden', true);

      this._element.removeAttribute('aria-modal');

      this._element.removeAttribute('role');

      this._isTransitioning = false;

      this._backdrop.hide(function () {
        document.body.classList.remove(CLASS_NAME_OPEN);

        _this6._resetAdjustments();

        _this6._scrollBar.reset();

        EventHandler.trigger(_this6._element, EVENT_HIDDEN);
      });
    }
  }, {
    key: "_isAnimated",
    value: function _isAnimated() {
      return this._element.classList.contains(CLASS_NAME_FADE$1);
    }
  }, {
    key: "_triggerBackdropTransition",
    value: function _triggerBackdropTransition() {
      var _this7 = this;

      var hideEvent = EventHandler.trigger(this._element, EVENT_HIDE_PREVENTED);

      if (hideEvent.defaultPrevented) {
        return;
      }

      var isModalOverflowing = this._element.scrollHeight > document.documentElement.clientHeight;
      var initialOverflowY = this._element.style.overflowY; // return if the following background transition hasn't yet completed

      if (initialOverflowY === 'hidden' || this._element.classList.contains(CLASS_NAME_STATIC)) {
        return;
      }

      if (!isModalOverflowing) {
        this._element.style.overflowY = 'hidden';
      }

      this._element.classList.add(CLASS_NAME_STATIC);

      this._queueCallback(function () {
        _this7._element.classList.remove(CLASS_NAME_STATIC);

        _this7._queueCallback(function () {
          _this7._element.style.overflowY = initialOverflowY;
        }, _this7._dialog);
      }, this._dialog);

      this._element.focus();
    }
    /**
     * The following methods are used to handle overflowing modals
     */

  }, {
    key: "_adjustDialog",
    value: function _adjustDialog() {
      var isModalOverflowing = this._element.scrollHeight > document.documentElement.clientHeight;

      var scrollbarWidth = this._scrollBar.getWidth();

      var isBodyOverflowing = scrollbarWidth > 0;

      if (isBodyOverflowing && !isModalOverflowing) {
        var property = isRTL() ? 'paddingLeft' : 'paddingRight';
        this._element.style[property] = "".concat(scrollbarWidth, "px");
      }

      if (!isBodyOverflowing && isModalOverflowing) {
        var _property = isRTL() ? 'paddingRight' : 'paddingLeft';

        this._element.style[_property] = "".concat(scrollbarWidth, "px");
      }
    }
  }, {
    key: "_resetAdjustments",
    value: function _resetAdjustments() {
      this._element.style.paddingLeft = '';
      this._element.style.paddingRight = '';
    } // Static

  }], [{
    key: "Default",
    get: function get$$1() {
      return Default;
    }
  }, {
    key: "DefaultType",
    get: function get$$1() {
      return DefaultType;
    }
  }, {
    key: "NAME",
    get: function get$$1() {
      return NAME$1;
    }
  }, {
    key: "jQueryInterface",
    value: function jQueryInterface(config, relatedTarget) {
      return this.each(function () {
        var data = Modal.getOrCreateInstance(this, config);

        if (typeof config !== 'string') {
          return;
        }

        if (typeof data[config] === 'undefined') {
          throw new TypeError("No method named \"".concat(config, "\""));
        }

        data[config](relatedTarget);
      });
    }
  }]);

  return Modal;
}(BaseComponent);
/**
 * Data API implementation
 */


EventHandler.on(document, EVENT_CLICK_DATA_API, SELECTOR_DATA_TOGGLE, function (event) {
  var _this8 = this;

  var target = getElementFromSelector(this);

  if (['A', 'AREA'].includes(this.tagName)) {
    event.preventDefault();
  }

  EventHandler.one(target, EVENT_SHOW, function (showEvent) {
    if (showEvent.defaultPrevented) {
      // only register focus restorer if modal will actually get shown
      return;
    }

    EventHandler.one(target, EVENT_HIDDEN, function () {
      if (isVisible(_this8)) {
        _this8.focus();
      }
    });
  }); // avoid conflict when clicking modal toggler while another one is open

  var alreadyOpen = SelectorEngine.findOne(OPEN_SELECTOR);

  if (alreadyOpen) {
    Modal.getInstance(alreadyOpen).hide();
  }

  var data = Modal.getOrCreateInstance(target);
  data.toggle(this);
});
enableDismissTrigger(Modal);
/**
 * jQuery
 */

defineJQueryPlugin(Modal);

/**
 * Bootstrap 5 Javascript modules
 */
// import Carousel from '../bootstrap/carousel'
// import Collapse from '../bootstrap/collapse'
// import Dropdown from '../bootstrap/dropdown'

// import Popover from '../bootstrap/popover'
// import ScrollSpy from '../bootstrap/scrollspy'
// import Tab from '../bootstrap/tab'
// import Toast from '../bootstrap/toast'
// import Tooltip from '../bootstrap/tooltip'

var bootstrap = {
  Alert: Alert,
  // Button,
  // Carousel,
  // Collapse,
  // Dropdown,
  Modal: Modal // Offcanvas,
  // Popover,
  // ScrollSpy,
  // Tab,
  // Toast,
  // Tooltip

};

return bootstrap;

})));
