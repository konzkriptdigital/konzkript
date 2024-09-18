/*!************************************!*\
  !*** ./resources/js/ghl/helper.js ***!
  \************************************/
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _regeneratorRuntime() { "use strict"; /*! regenerator-runtime -- Copyright (c) 2014-present, Facebook, Inc. -- license (MIT): https://github.com/facebook/regenerator/blob/main/LICENSE */ _regeneratorRuntime = function _regeneratorRuntime() { return e; }; var t, e = {}, r = Object.prototype, n = r.hasOwnProperty, o = Object.defineProperty || function (t, e, r) { t[e] = r.value; }, i = "function" == typeof Symbol ? Symbol : {}, a = i.iterator || "@@iterator", c = i.asyncIterator || "@@asyncIterator", u = i.toStringTag || "@@toStringTag"; function define(t, e, r) { return Object.defineProperty(t, e, { value: r, enumerable: !0, configurable: !0, writable: !0 }), t[e]; } try { define({}, ""); } catch (t) { define = function define(t, e, r) { return t[e] = r; }; } function wrap(t, e, r, n) { var i = e && e.prototype instanceof Generator ? e : Generator, a = Object.create(i.prototype), c = new Context(n || []); return o(a, "_invoke", { value: makeInvokeMethod(t, r, c) }), a; } function tryCatch(t, e, r) { try { return { type: "normal", arg: t.call(e, r) }; } catch (t) { return { type: "throw", arg: t }; } } e.wrap = wrap; var h = "suspendedStart", l = "suspendedYield", f = "executing", s = "completed", y = {}; function Generator() {} function GeneratorFunction() {} function GeneratorFunctionPrototype() {} var p = {}; define(p, a, function () { return this; }); var d = Object.getPrototypeOf, v = d && d(d(values([]))); v && v !== r && n.call(v, a) && (p = v); var g = GeneratorFunctionPrototype.prototype = Generator.prototype = Object.create(p); function defineIteratorMethods(t) { ["next", "throw", "return"].forEach(function (e) { define(t, e, function (t) { return this._invoke(e, t); }); }); } function AsyncIterator(t, e) { function invoke(r, o, i, a) { var c = tryCatch(t[r], t, o); if ("throw" !== c.type) { var u = c.arg, h = u.value; return h && "object" == _typeof(h) && n.call(h, "__await") ? e.resolve(h.__await).then(function (t) { invoke("next", t, i, a); }, function (t) { invoke("throw", t, i, a); }) : e.resolve(h).then(function (t) { u.value = t, i(u); }, function (t) { return invoke("throw", t, i, a); }); } a(c.arg); } var r; o(this, "_invoke", { value: function value(t, n) { function callInvokeWithMethodAndArg() { return new e(function (e, r) { invoke(t, n, e, r); }); } return r = r ? r.then(callInvokeWithMethodAndArg, callInvokeWithMethodAndArg) : callInvokeWithMethodAndArg(); } }); } function makeInvokeMethod(e, r, n) { var o = h; return function (i, a) { if (o === f) throw Error("Generator is already running"); if (o === s) { if ("throw" === i) throw a; return { value: t, done: !0 }; } for (n.method = i, n.arg = a;;) { var c = n.delegate; if (c) { var u = maybeInvokeDelegate(c, n); if (u) { if (u === y) continue; return u; } } if ("next" === n.method) n.sent = n._sent = n.arg;else if ("throw" === n.method) { if (o === h) throw o = s, n.arg; n.dispatchException(n.arg); } else "return" === n.method && n.abrupt("return", n.arg); o = f; var p = tryCatch(e, r, n); if ("normal" === p.type) { if (o = n.done ? s : l, p.arg === y) continue; return { value: p.arg, done: n.done }; } "throw" === p.type && (o = s, n.method = "throw", n.arg = p.arg); } }; } function maybeInvokeDelegate(e, r) { var n = r.method, o = e.iterator[n]; if (o === t) return r.delegate = null, "throw" === n && e.iterator["return"] && (r.method = "return", r.arg = t, maybeInvokeDelegate(e, r), "throw" === r.method) || "return" !== n && (r.method = "throw", r.arg = new TypeError("The iterator does not provide a '" + n + "' method")), y; var i = tryCatch(o, e.iterator, r.arg); if ("throw" === i.type) return r.method = "throw", r.arg = i.arg, r.delegate = null, y; var a = i.arg; return a ? a.done ? (r[e.resultName] = a.value, r.next = e.nextLoc, "return" !== r.method && (r.method = "next", r.arg = t), r.delegate = null, y) : a : (r.method = "throw", r.arg = new TypeError("iterator result is not an object"), r.delegate = null, y); } function pushTryEntry(t) { var e = { tryLoc: t[0] }; 1 in t && (e.catchLoc = t[1]), 2 in t && (e.finallyLoc = t[2], e.afterLoc = t[3]), this.tryEntries.push(e); } function resetTryEntry(t) { var e = t.completion || {}; e.type = "normal", delete e.arg, t.completion = e; } function Context(t) { this.tryEntries = [{ tryLoc: "root" }], t.forEach(pushTryEntry, this), this.reset(!0); } function values(e) { if (e || "" === e) { var r = e[a]; if (r) return r.call(e); if ("function" == typeof e.next) return e; if (!isNaN(e.length)) { var o = -1, i = function next() { for (; ++o < e.length;) if (n.call(e, o)) return next.value = e[o], next.done = !1, next; return next.value = t, next.done = !0, next; }; return i.next = i; } } throw new TypeError(_typeof(e) + " is not iterable"); } return GeneratorFunction.prototype = GeneratorFunctionPrototype, o(g, "constructor", { value: GeneratorFunctionPrototype, configurable: !0 }), o(GeneratorFunctionPrototype, "constructor", { value: GeneratorFunction, configurable: !0 }), GeneratorFunction.displayName = define(GeneratorFunctionPrototype, u, "GeneratorFunction"), e.isGeneratorFunction = function (t) { var e = "function" == typeof t && t.constructor; return !!e && (e === GeneratorFunction || "GeneratorFunction" === (e.displayName || e.name)); }, e.mark = function (t) { return Object.setPrototypeOf ? Object.setPrototypeOf(t, GeneratorFunctionPrototype) : (t.__proto__ = GeneratorFunctionPrototype, define(t, u, "GeneratorFunction")), t.prototype = Object.create(g), t; }, e.awrap = function (t) { return { __await: t }; }, defineIteratorMethods(AsyncIterator.prototype), define(AsyncIterator.prototype, c, function () { return this; }), e.AsyncIterator = AsyncIterator, e.async = function (t, r, n, o, i) { void 0 === i && (i = Promise); var a = new AsyncIterator(wrap(t, r, n, o), i); return e.isGeneratorFunction(r) ? a : a.next().then(function (t) { return t.done ? t.value : a.next(); }); }, defineIteratorMethods(g), define(g, u, "Generator"), define(g, a, function () { return this; }), define(g, "toString", function () { return "[object Generator]"; }), e.keys = function (t) { var e = Object(t), r = []; for (var n in e) r.push(n); return r.reverse(), function next() { for (; r.length;) { var t = r.pop(); if (t in e) return next.value = t, next.done = !1, next; } return next.done = !0, next; }; }, e.values = values, Context.prototype = { constructor: Context, reset: function reset(e) { if (this.prev = 0, this.next = 0, this.sent = this._sent = t, this.done = !1, this.delegate = null, this.method = "next", this.arg = t, this.tryEntries.forEach(resetTryEntry), !e) for (var r in this) "t" === r.charAt(0) && n.call(this, r) && !isNaN(+r.slice(1)) && (this[r] = t); }, stop: function stop() { this.done = !0; var t = this.tryEntries[0].completion; if ("throw" === t.type) throw t.arg; return this.rval; }, dispatchException: function dispatchException(e) { if (this.done) throw e; var r = this; function handle(n, o) { return a.type = "throw", a.arg = e, r.next = n, o && (r.method = "next", r.arg = t), !!o; } for (var o = this.tryEntries.length - 1; o >= 0; --o) { var i = this.tryEntries[o], a = i.completion; if ("root" === i.tryLoc) return handle("end"); if (i.tryLoc <= this.prev) { var c = n.call(i, "catchLoc"), u = n.call(i, "finallyLoc"); if (c && u) { if (this.prev < i.catchLoc) return handle(i.catchLoc, !0); if (this.prev < i.finallyLoc) return handle(i.finallyLoc); } else if (c) { if (this.prev < i.catchLoc) return handle(i.catchLoc, !0); } else { if (!u) throw Error("try statement without catch or finally"); if (this.prev < i.finallyLoc) return handle(i.finallyLoc); } } } }, abrupt: function abrupt(t, e) { for (var r = this.tryEntries.length - 1; r >= 0; --r) { var o = this.tryEntries[r]; if (o.tryLoc <= this.prev && n.call(o, "finallyLoc") && this.prev < o.finallyLoc) { var i = o; break; } } i && ("break" === t || "continue" === t) && i.tryLoc <= e && e <= i.finallyLoc && (i = null); var a = i ? i.completion : {}; return a.type = t, a.arg = e, i ? (this.method = "next", this.next = i.finallyLoc, y) : this.complete(a); }, complete: function complete(t, e) { if ("throw" === t.type) throw t.arg; return "break" === t.type || "continue" === t.type ? this.next = t.arg : "return" === t.type ? (this.rval = this.arg = t.arg, this.method = "return", this.next = "end") : "normal" === t.type && e && (this.next = e), y; }, finish: function finish(t) { for (var e = this.tryEntries.length - 1; e >= 0; --e) { var r = this.tryEntries[e]; if (r.finallyLoc === t) return this.complete(r.completion, r.afterLoc), resetTryEntry(r), y; } }, "catch": function _catch(t) { for (var e = this.tryEntries.length - 1; e >= 0; --e) { var r = this.tryEntries[e]; if (r.tryLoc === t) { var n = r.completion; if ("throw" === n.type) { var o = n.arg; resetTryEntry(r); } return o; } } throw Error("illegal catch attempt"); }, delegateYield: function delegateYield(e, r, n) { return this.delegate = { iterator: values(e), resultName: r, nextLoc: n }, "next" === this.method && (this.arg = t), y; } }, e; }
function asyncGeneratorStep(n, t, e, r, o, a, c) { try { var i = n[a](c), u = i.value; } catch (n) { return void e(n); } i.done ? t(u) : Promise.resolve(u).then(r, o); }
function _asyncToGenerator(n) { return function () { var t = this, e = arguments; return new Promise(function (r, o) { var a = n.apply(t, e); function _next(n) { asyncGeneratorStep(a, r, o, _next, _throw, "next", n); } function _throw(n) { asyncGeneratorStep(a, r, o, _next, _throw, "throw", n); } _next(void 0); }); }; }
function _createForOfIteratorHelper(r, e) { var t = "undefined" != typeof Symbol && r[Symbol.iterator] || r["@@iterator"]; if (!t) { if (Array.isArray(r) || (t = _unsupportedIterableToArray(r)) || e && r && "number" == typeof r.length) { t && (r = t); var _n = 0, F = function F() {}; return { s: F, n: function n() { return _n >= r.length ? { done: !0 } : { done: !1, value: r[_n++] }; }, e: function e(r) { throw r; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var o, a = !0, u = !1; return { s: function s() { t = t.call(r); }, n: function n() { var r = t.next(); return a = r.done, r; }, e: function e(r) { u = !0, o = r; }, f: function f() { try { a || null == t["return"] || t["return"](); } finally { if (u) throw o; } } }; }
function _unsupportedIterableToArray(r, a) { if (r) { if ("string" == typeof r) return _arrayLikeToArray(r, a); var t = {}.toString.call(r).slice(8, -1); return "Object" === t && r.constructor && (t = r.constructor.name), "Map" === t || "Set" === t ? Array.from(r) : "Arguments" === t || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(t) ? _arrayLikeToArray(r, a) : void 0; } }
function _arrayLikeToArray(r, a) { (null == a || a > r.length) && (a = r.length); for (var e = 0, n = Array(a); e < a; e++) n[e] = r[e]; return n; }
var ElementObserver = {
  observers: new Map(),
  observe: function observe(selector) {
    var _this = this;
    var options = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
    var _options$properties = options.properties,
      properties = _options$properties === void 0 ? [] : _options$properties,
      callback = options.callback,
      _options$throttleTime = options.throttleTime,
      throttleTime = _options$throttleTime === void 0 ? 100 : _options$throttleTime,
      _options$id = options.id,
      id = _options$id === void 0 ? selector : _options$id;

    // If an observer with this ID already exists, disconnect it first
    if (this.observers.has(id)) {
      this.disconnect(id);
    }
    var lastExecutionTime = 0;
    var throttledCallback = function throttledCallback() {
      var now = Date.now();
      if (now - lastExecutionTime >= throttleTime) {
        lastExecutionTime = now;
        callback.apply(void 0, arguments);
      }
    };
    var observer = new MutationObserver(function () {
      var element = document.querySelector(selector);
      if (element && _this._hasProperties(element, properties)) {
        throttledCallback(element);
      }
    });
    var targetNode = document.body;
    var config = {
      childList: true,
      subtree: true
    };
    observer.observe(targetNode, config);
    this.observers.set(id, observer);

    // Trigger initial check immediately
    var element = document.querySelector(selector);
    if (element && this._hasProperties(element, properties)) {
      throttledCallback(element);
    }
  },
  _hasProperties: function _hasProperties(element, properties) {
    return properties.every(function (propertyPath) {
      try {
        return propertyPath.split('.').reduce(function (obj, prop) {
          return obj && obj[prop];
        }, element);
      } catch (e) {
        return false;
      }
    });
  },
  disconnect: function disconnect(id) {
    if (this.observers.has(id)) {
      this.observers.get(id).disconnect();
      this.observers["delete"](id);
    }
  },
  disconnectAll: function disconnectAll() {
    var _this2 = this;
    this.observers.forEach(function (observer, id) {
      observer.disconnect();
      _this2.observers["delete"](id);
    });
  }
};

/**
 * A helper object for interacting with the DOM and Vue.
 * @namespace KONZKRIPT_HELPER
 */

var KONZKRIPT_HELPER = {
  app: $('#app'),
  av: 'v',
  au: 'u',
  ae: 'e',
  get vString() {
    /**
     * Gets the string representation of the Vue instance.
     * @returns {string} The string representation of the Vue instance.
     */
    return "__".concat(this.av).concat(this.au).concat(this.ae, "__");
  },
  get v() {
    /**
     * Gets the Vue instance of the current page.
     * @returns {Vue} The Vue instance of the current page.
     */
    return document.querySelector('#app')[this.vString];
  },
  getScriptBaseUrl: function getScriptBaseUrl() {
    /**
     * Gets the base URL of the script element.
     * @returns {string} The base URL of the script element.
     */
    var scriptElement = document.getElementById('acquirely--script');
    var scriptSrc = scriptElement.getAttribute('src');
    var url = new URL(scriptSrc);
    var localUrls = ['127.0.0.1', 'localhost'];
    var isLocal = localUrls.includes(url.hostname);
    return "".concat(url.protocol, "//").concat(url.host);
  },
  getCompanyId: function getCompanyId() {
    /**
     * Gets the company ID from the script element.
     * @returns {string} The company ID.
     */
    var scriptElement = document.getElementById('acquirely--script');
    var scriptSrc = scriptElement.getAttribute('src');
    var url = new URL(scriptSrc);
    var segments = url.pathname.split('/').filter(Boolean);
    var lastSegment = segments.pop();
    return lastSegment;
  },
  setIframe: function setIframe(src, id) {
    /**
     * Sets up an iframe with the specified source and ID.
     * @param {string} src - The source URL of the iframe.
     * @param {string} id - The ID of the iframe.
     * @returns {void}
     */
    if (this.query("#".concat(id))) return;
    var iframe = "<iframe id=\"".concat(id, "\" src=\"").concat(src, "\" scrolling=\"yes\" frameborder=\"0\"></iframe>");
    // const iframe = `<iframe id="konzkriptEditorIframe" src="${this.getScriptBaseUrl()}/editor/${this.getCompanyId()}"></iframe>`;
    this.app.append(iframe);
  },
  initPostMessage: function initPostMessage() {
    var _this3 = this;
    /**
     * Process the message received in the parent window.
     * The message can be a string or an object.
     * If the message is a string, it is processed as a key-value pair.
     * If the message is an object, it is processed as a key-value pair.
     * The key-value pairs are processed using the processPostMessageData function.
     * @param {Event} event - The event object containing the message received in the parent window.
     * @returns {void}
     */
    var onMessage = function onMessage(event) {
      console.log('event =>>> ', event);
      if (typeof event.data === 'string') {
        _this3.processPostMessageData(event.data);
      } else {
        if (event.data.hasOwnProperty('app')) {
          var data = event.data.app;
          _this3.processPostMessageData(data);
        }
      }
    };

    /**
     * Add an event listener for the message event.
     * The event listener will be triggered when a message is received in the parent window.
     * The message can be a string or an object.
     */
    if (window.addEventListener) {
      window.addEventListener("message", onMessage, false);
    }
    if (window.attachEvent) {
      window.attachEvent("onmessage", onMessage, false);
    }
  },
  processPostMessageData: function processPostMessageData(data) {
    /**
     * Process the data received in the parent window.
     * The data is used to trigger specific actions based on the data.
     * The data is used to pass data to the action.
     * @param {*} data - The data received in the parent window.
     * @returns {void}
     */

    if (data.userId) {
      UserActivity.init(data.userId.id);
    }

    // console.log('data =>>> ', data)
    if (data.hasOwnProperty("User List Component")) {
      var _data$UserListCompo = data['User List Component'],
        isLoaded = _data$UserListCompo.isLoaded,
        height = _data$UserListCompo.height,
        value = _data$UserListCompo.value;
      if (isLoaded) {
        Activity.renderUserList(true);
      }
      if (height) {
        $('#user--list').css({
          height: height + 'px'
        });
      }
      if (value && value.event && value.user) {
        Activity.updateStatus(value);
      }
    }
  },
  sendPostMessage: function sendPostMessage(data, id) {
    /**
     * Send a message to the specified iframe.
     * @param {*} data - The data to be sent to the iframe.
     * @param {string} id - The ID of the iframe.
     * @returns {void}
     */
    var iframe = this.query(id);
    console.log('sendPostMessage => ', iframe, data, id);
    iframe.contentWindow.postMessage(data, '*');
  },
  query: function query(element) {
    /**
     * Query the specified element.
     * @param {string} element - The CSS selector of the element to query.
     * @returns {Element|null} The element found by the CSS selector or null if no element is found.
     */
    return document.querySelector(element);
  },
  queryAll: function queryAll(element) {
    /**
     * Query all elements matching the specified CSS selector.
     * @param {string} element - The CSS selector of the elements to query.
     * @returns {NodeList} A NodeList containing all elements matching the specified CSS selector.
     */
    return document.querySelectorAll(element);
  },
  createStyle: function createStyle(css, selector) {
    var className = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : null;
    /**
     * Create a style element with the specified CSS and append it to the head of the document.
     * @param {string} css - The CSS to be applied to the style element.
     * @param {string} selector - The ID of the style element.
     * @param {string} className - The class name of the style element.
     * @returns {void}
     */
    if (this.query("#".concat(selector))) return;
    var style = document.createElement('style');
    style.id = selector;
    style.innerHTML = css;
    if (className) {
      style.classList.add(className);
    }
    document.getElementsByTagName('head')[0].appendChild(style);
  },
  appWatch: function appWatch(elements, properties, callback) {
    /**
     * Watches the specified elements for changes in their properties.
     * @param {string} elements - The CSS selector of the elements to watch.
     * @param {string[]} properties - An array of property names to watch.
     * @param {function} callback - The function to call when the properties change.
     * @returns {function} A function that stops watching the elements.
     *
     * @example
     * // Watch for changes in the 'title' property of the element with the ID 'my-element'
     * const stopWatching = KONZKRIPT_HELPER.appWatch('#my-element', ['title'], (value) => {
     *   console.log('Title changed:', value);
     * });
     *
     * // Stop watching the elements
     * stopWatching();
     */
    var watcher; // Variable to store the watcher function

    function watchHandler(value) {
      callback(value);
    }
    function startWatching() {
      var vElement = query(elements);
      if (vElement && vElement.hasOwnProperty("__".concat(av).concat(au).concat(ae, "__"))) {
        vElement = vElement["__".concat(av).concat(au).concat(ae, "__")];
      } else {
        setTimeout(function () {
          startWatching();
        }, 100);
        return;
      }
      watcher = vElement.$watch(properties, watchHandler);
    }
    startWatching(); // Start watching when the function is called

    return function stopWatching() {
      // This function can be used to stop the watcher
      if (watcher) {
        watcher(); // Stop the watcher
        console.log('Stopped watching:', properties);
      }
    };
  },
  generateUuid: function generateUuid() {
    /**
     * Generates a UUID (Universally Unique Identifier) using the built-in Math.random() function.
     * @returns {string} A UUID string.
     */
    return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function (c) {
      var r = Math.random() * 16 | 0,
        v = c === 'x' ? r : r & 0x3 | 0x8;
      return v.toString(16);
    });
  },
  abbreviateSentence: function abbreviateSentence(sentence) {
    /**
     * Abbreviates a sentence by keeping the first two words and removing the rest.
     * @param {string} sentence - The sentence to be abbreviated.
     * @returns {string} The abbreviated sentence.
     */

    if (!sentence) return;
    var words = sentence.split(' ');
    var abbreviation = words.slice(0, 2).map(function (word) {
      return word.charAt(0);
    }).join('');
    return abbreviation;
  },
  interpolateString: function interpolateString(template) {
    /**
     * Interpolates a string template with data from the current user and the location.
     * @param {string} template - The string template to be interpolated.
     * @returns {string} The interpolated string.
     */
    if (!template) return;
    var v = getV();
    var data = {
      user: v.user._data,
      location: acquirely_location,
      custom_values: window.acquirely_customValues
    };
    if (!data.user.hasOwnProperty('name')) {
      data.user.name = data.user.first_name + " " + data.user.last_name;
    }
    var getObjectValue = function getObjectValue(obj, key) {
      // Split the key into parts (e.g., "user.first_name" -> ["user", "first_name"])
      var keys = key.split('.');

      // Iterate through the keys to access the nested value
      var value = obj;
      var _iterator = _createForOfIteratorHelper(keys),
        _step;
      try {
        for (_iterator.s(); !(_step = _iterator.n()).done;) {
          var k = _step.value;
          if (value && value.hasOwnProperty(k)) {
            value = value[k];
          } else {
            // If any key is not found, return undefined
            return undefined;
          }
        }
      } catch (err) {
        _iterator.e(err);
      } finally {
        _iterator.f();
      }
      return value;
    };

    // Regular expression to match placeholders like {{ key }}
    var placeholderRegex = /\{\{([^}]+)\}\}/g;

    // Replace each placeholder with the corresponding value from the data object
    var interpolatedString = template.replace(placeholderRegex, function (match, key) {
      // Trim any extra spaces around the key
      key = key.trim();

      // Access the value from the data object using the key
      var value = getObjectValue(data, key);

      // If the value is found, use it; otherwise, keep the original placeholder
      return value !== undefined ? value : match;
    });

    // console.log('interpolatedString => ', interpolatedString, template, data)

    return interpolatedString;
  },
  capitalizeLetterAfterUnderscore: function capitalizeLetterAfterUnderscore(data) {
    // console.log(data)
    /**
     * Checks if the input is an object or a string.
     * If it is an object, it capitalizes the first letter after an underscore in each key of the object.
     * If it is a string, it capitalizes the first letter after an underscore in the string.
     * @param {object|string} data - The input to be checked.
     * @returns {object|string} The input with the first letter after an underscore capitalized.
     */

    if (typeof data === 'string') return string.replace(/_([a-z])/g, function (_, letter) {
      return letter.toUpperCase();
    });
    var transformedObj = {};
    for (var key in data) {
      if (data.hasOwnProperty(key)) {
        var transformedKey = key.replace(/_([a-z])/g, function (match, letter) {
          return letter.toUpperCase();
        });
        transformedObj[transformedKey] = data[key];
      }
    }
    return transformedObj;
  },
  restoreConsoleLog: function restoreConsoleLog() {
    /**
     * Restores the console.log function to its original state.
     */
    if (!("console" in window) || !("firebug" in console)) {
      console.log = null;
      delete console.log;
      var i = document.createElement('iframe');
      i.style.display = 'none';
      document.body.appendChild(i);
      window.console = i.contentWindow.console;
    }
  }
};
function test(_x) {
  return _test.apply(this, arguments);
}
function _test() {
  _test = _asyncToGenerator( /*#__PURE__*/_regeneratorRuntime().mark(function _callee(num) {
    return _regeneratorRuntime().wrap(function _callee$(_context) {
      while (1) switch (_context.prev = _context.next) {
        case 0:
          return _context.abrupt("return", new Promise(function (resolve) {
            setTimeout(function () {
              console.log('test =>> ' + num);
              resolve();
            }, 2000);
          }));
        case 1:
        case "end":
          return _context.stop();
      }
    }, _callee);
  }));
  return _test.apply(this, arguments);
}
