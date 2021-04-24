/**
 * FormValidation (https://formvalidation.io), v1.6.0 (4730ac5)
 * The best validation library for JavaScript
 * (c) 2013 - 2020 Nguyen Huu Phuoc <me@phuoc.ng>
 */

(function (global, factory) {
  typeof exports === 'object' && typeof module !== 'undefined' ? module.exports = factory() :
  typeof define === 'function' && define.amd ? define(factory) :
  (global = global || self, (global.FormValidation = global.FormValidation || {}, global.FormValidation.plugins = global.FormValidation.plugins || {}, global.FormValidation.plugins.Recaptcha = factory()));
}(this, (function () { 'use strict';

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
    if (superClass) _setPrototypeOf(subClass, superClass);
  }

  function _getPrototypeOf(o) {
    _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf : function _getPrototypeOf(o) {
      return o.__proto__ || Object.getPrototypeOf(o);
    };
    return _getPrototypeOf(o);
  }

  function _setPrototypeOf(o, p) {
    _setPrototypeOf = Object.setPrototypeOf || function _setPrototypeOf(o, p) {
      o.__proto__ = p;
      return o;
    };

    return _setPrototypeOf(o, p);
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
    }

    return _assertThisInitialized(self);
  }

  var Plugin = FormValidation.Plugin;

  var fetch = FormValidation.utils.fetch;

  var Recaptcha =
  /*#__PURE__*/
  function (_Plugin) {
    _inherits(Recaptcha, _Plugin);

    function Recaptcha(opts) {
      var _this;

      _classCallCheck(this, Recaptcha);

      _this = _possibleConstructorReturn(this, _getPrototypeOf(Recaptcha).call(this, opts));
      _this.widgetIds = new Map();
      _this.captchaStatus = 'NotValidated';
      _this.opts = Object.assign({}, Recaptcha.DEFAULT_OPTIONS, opts);
      _this.fieldResetHandler = _this.onResetField.bind(_assertThisInitialized(_this));
      _this.preValidateFilter = _this.preValidate.bind(_assertThisInitialized(_this));
      _this.iconPlacedHandler = _this.onIconPlaced.bind(_assertThisInitialized(_this));
      return _this;
    }

    _createClass(Recaptcha, [{
      key: "install",
      value: function install() {
        var _this2 = this;

        this.core.on('core.field.reset', this.fieldResetHandler).on('plugins.icon.placed', this.iconPlacedHandler).registerFilter('validate-pre', this.preValidateFilter);
        var loadPrevCaptcha = typeof window[Recaptcha.LOADED_CALLBACK] === 'undefined' ? function () {} : window[Recaptcha.LOADED_CALLBACK];

        window[Recaptcha.LOADED_CALLBACK] = function () {
          loadPrevCaptcha();
          var captchaOptions = {
            'badge': _this2.opts.badge,
            'callback': function callback() {
              if (_this2.opts.backendVerificationUrl === '') {
                _this2.captchaStatus = 'Valid';

                _this2.core.updateFieldStatus(Recaptcha.CAPTCHA_FIELD, 'Valid');
              } else {
                _this2.core.revalidateField(Recaptcha.CAPTCHA_FIELD);
              }
            },
            'error-callback': function errorCallback() {
              _this2.captchaStatus = 'Invalid';

              _this2.core.updateFieldStatus(Recaptcha.CAPTCHA_FIELD, 'Invalid');
            },
            'expired-callback': function expiredCallback() {
              _this2.captchaStatus = 'NotValidated';

              _this2.core.updateFieldStatus(Recaptcha.CAPTCHA_FIELD, 'NotValidated');
            },
            'sitekey': _this2.opts.siteKey,
            'size': _this2.opts.size
          };
          var widgetId = window['grecaptcha'].render(_this2.opts.element, captchaOptions);

          _this2.widgetIds.set(_this2.opts.element, widgetId);

          _this2.core.addField(Recaptcha.CAPTCHA_FIELD, {
            validators: {
              promise: {
                message: _this2.opts.message,
                promise: function promise(input) {
                  var value = _this2.widgetIds.has(_this2.opts.element) ? window['grecaptcha'].getResponse(_this2.widgetIds.get(_this2.opts.element)) : input.value;

                  if (value === '') {
                    _this2.captchaStatus = 'Invalid';
                    return Promise.resolve({
                      valid: false
                    });
                  } else if (_this2.opts.backendVerificationUrl === '') {
                    _this2.captchaStatus = 'Valid';
                    return Promise.resolve({
                      valid: true
                    });
                  } else if (_this2.captchaStatus === 'Valid') {
                    return Promise.resolve({
                      valid: true
                    });
                  } else {
                    return fetch(_this2.opts.backendVerificationUrl, {
                      method: 'POST',
                      params: _defineProperty({}, Recaptcha.CAPTCHA_FIELD, value)
                    }).then(function (response) {
                      var isValid = "".concat(response['success']) === 'true';
                      _this2.captchaStatus = isValid ? 'Valid' : 'Invalid';
                      return Promise.resolve({
                        meta: response,
                        valid: isValid
                      });
                    })["catch"](function (reason) {
                      _this2.captchaStatus = 'NotValidated';
                      return Promise.reject({
                        valid: false
                      });
                    });
                  }
                }
              }
            }
          });
        };

        var src = this.getScript();

        if (!document.body.querySelector("script[src=\"".concat(src, "\"]"))) {
          var script = document.createElement('script');
          script.type = 'text/javascript';
          script.async = true;
          script.defer = true;
          script.src = src;
          document.body.appendChild(script);
        }
      }
    }, {
      key: "uninstall",
      value: function uninstall() {
        if (this.timer) {
          clearTimeout(this.timer);
        }

        this.core.off('core.field.reset', this.fieldResetHandler).off('plugins.icon.placed', this.iconPlacedHandler).deregisterFilter('validate-pre', this.preValidateFilter);
        this.widgetIds.clear();
        var src = this.getScript();
        var scripts = [].slice.call(document.body.querySelectorAll("script[src=\"".concat(src, "\"]")));
        scripts.forEach(function (s) {
          return s.parentNode.removeChild(s);
        });
        this.core.removeField(Recaptcha.CAPTCHA_FIELD);
      }
    }, {
      key: "getScript",
      value: function getScript() {
        var lang = this.opts.language ? "&hl=".concat(this.opts.language) : '';
        return "https://www.google.com/recaptcha/api.js?onload=".concat(Recaptcha.LOADED_CALLBACK, "&render=explicit").concat(lang);
      }
    }, {
      key: "preValidate",
      value: function preValidate() {
        var _this3 = this;

        if (this.opts.size === 'invisible' && this.widgetIds.has(this.opts.element)) {
          var widgetId = this.widgetIds.get(this.opts.element);
          return this.captchaStatus === 'Valid' ? Promise.resolve() : new Promise(function (resolve, reject) {
            window['grecaptcha'].execute(widgetId).then(function () {
              if (_this3.timer) {
                clearTimeout(_this3.timer);
              }

              _this3.timer = window.setTimeout(resolve, 1 * 1000);
            });
          });
        } else {
          return Promise.resolve();
        }
      }
    }, {
      key: "onResetField",
      value: function onResetField(e) {
        if (e.field === Recaptcha.CAPTCHA_FIELD && this.widgetIds.has(this.opts.element)) {
          var widgetId = this.widgetIds.get(this.opts.element);
          window['grecaptcha'].reset(widgetId);
        }
      }
    }, {
      key: "onIconPlaced",
      value: function onIconPlaced(e) {
        if (e.field === Recaptcha.CAPTCHA_FIELD) {
          if (this.opts.size === 'invisible') {
            e.iconElement.style.display = 'none';
          } else {
            var captchaContainer = document.getElementById(this.opts.element);

            if (captchaContainer) {
              captchaContainer.parentNode.insertBefore(e.iconElement, captchaContainer.nextSibling);
            }
          }
        }
      }
    }]);

    return Recaptcha;
  }(Plugin);
  Recaptcha.CAPTCHA_FIELD = 'g-recaptcha-response';
  Recaptcha.DEFAULT_OPTIONS = {
    backendVerificationUrl: '',
    badge: 'bottomright',
    size: 'normal',
    theme: 'light'
  };
  Recaptcha.LOADED_CALLBACK = '___reCaptchaLoaded___';

  return Recaptcha;

})));
