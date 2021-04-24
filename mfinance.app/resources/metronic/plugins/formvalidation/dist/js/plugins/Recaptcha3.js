/**
 * FormValidation (https://formvalidation.io), v1.6.0 (4730ac5)
 * The best validation library for JavaScript
 * (c) 2013 - 2020 Nguyen Huu Phuoc <me@phuoc.ng>
 */

(function (global, factory) {
  typeof exports === 'object' && typeof module !== 'undefined' ? module.exports = factory() :
  typeof define === 'function' && define.amd ? define(factory) :
  (global = global || self, (global.FormValidation = global.FormValidation || {}, global.FormValidation.plugins = global.FormValidation.plugins || {}, global.FormValidation.plugins.Recaptcha3 = factory()));
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

  var Recaptcha3 =
  /*#__PURE__*/
  function (_Plugin) {
    _inherits(Recaptcha3, _Plugin);

    function Recaptcha3(opts) {
      var _this;

      _classCallCheck(this, Recaptcha3);

      _this = _possibleConstructorReturn(this, _getPrototypeOf(Recaptcha3).call(this, opts));
      _this.opts = Object.assign({}, {
        minimumScore: 0
      }, opts);
      _this.iconPlacedHandler = _this.onIconPlaced.bind(_assertThisInitialized(_this));
      return _this;
    }

    _createClass(Recaptcha3, [{
      key: "install",
      value: function install() {
        var _this2 = this;

        this.core.on('plugins.icon.placed', this.iconPlacedHandler);
        var loadPrevCaptcha = typeof window[Recaptcha3.LOADED_CALLBACK] === 'undefined' ? function () {} : window[Recaptcha3.LOADED_CALLBACK];

        window[Recaptcha3.LOADED_CALLBACK] = function () {
          loadPrevCaptcha();
          var tokenField = document.createElement('input');
          tokenField.setAttribute('type', 'hidden');
          tokenField.setAttribute('name', Recaptcha3.CAPTCHA_FIELD);
          document.getElementById(_this2.opts.element).appendChild(tokenField);

          _this2.core.addField(Recaptcha3.CAPTCHA_FIELD, {
            validators: {
              promise: {
                message: _this2.opts.message,
                promise: function promise(input) {
                  return new Promise(function (resolve, reject) {
                    window['grecaptcha'].execute(_this2.opts.siteKey, {
                      action: _this2.opts.action
                    }).then(function (token) {
                      fetch(_this2.opts.backendVerificationUrl, {
                        method: 'POST',
                        params: _defineProperty({}, Recaptcha3.CAPTCHA_FIELD, token)
                      }).then(function (response) {
                        var isValid = "".concat(response.success) === 'true' && response.score >= _this2.opts.minimumScore;

                        resolve({
                          message: response.message || _this2.opts.message,
                          meta: response,
                          valid: isValid
                        });
                      })["catch"](function (_) {
                        reject({
                          valid: false
                        });
                      });
                    });
                  });
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
        this.core.off('plugins.icon.placed', this.iconPlacedHandler);
        var src = this.getScript();
        var scripts = [].slice.call(document.body.querySelectorAll("script[src=\"".concat(src, "\"]")));
        scripts.forEach(function (s) {
          return s.parentNode.removeChild(s);
        });
        this.core.removeField(Recaptcha3.CAPTCHA_FIELD);
      }
    }, {
      key: "getScript",
      value: function getScript() {
        var lang = this.opts.language ? "&hl=".concat(this.opts.language) : '';
        return 'https://www.google.com/recaptcha/api.js?' + "onload=".concat(Recaptcha3.LOADED_CALLBACK, "&render=").concat(this.opts.siteKey).concat(lang);
      }
    }, {
      key: "onIconPlaced",
      value: function onIconPlaced(e) {
        if (e.field === Recaptcha3.CAPTCHA_FIELD) {
          e.iconElement.style.display = 'none';
        }
      }
    }]);

    return Recaptcha3;
  }(Plugin);
  Recaptcha3.CAPTCHA_FIELD = '___g-recaptcha-token___';
  Recaptcha3.LOADED_CALLBACK = '___reCaptcha3Loaded___';

  return Recaptcha3;

})));
