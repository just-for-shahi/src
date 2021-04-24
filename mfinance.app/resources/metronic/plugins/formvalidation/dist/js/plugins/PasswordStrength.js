/**
 * FormValidation (https://formvalidation.io), v1.6.0 (4730ac5)
 * The best validation library for JavaScript
 * (c) 2013 - 2020 Nguyen Huu Phuoc <me@phuoc.ng>
 */

(function (global, factory) {
  typeof exports === 'object' && typeof module !== 'undefined' ? module.exports = factory() :
  typeof define === 'function' && define.amd ? define(factory) :
  (global = global || self, (global.FormValidation = global.FormValidation || {}, global.FormValidation.plugins = global.FormValidation.plugins || {}, global.FormValidation.plugins.PasswordStrength = factory()));
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

  var PasswordStrength =
  /*#__PURE__*/
  function (_Plugin) {
    _inherits(PasswordStrength, _Plugin);

    function PasswordStrength(opts) {
      var _this;

      _classCallCheck(this, PasswordStrength);

      _this = _possibleConstructorReturn(this, _getPrototypeOf(PasswordStrength).call(this, opts));
      _this.opts = Object.assign({}, {
        minimalScore: 3,
        onValidated: function onValidated() {}
      }, opts);
      _this.validatePassword = _this.checkPasswordStrength.bind(_assertThisInitialized(_this));
      _this.validatorValidatedHandler = _this.onValidatorValidated.bind(_assertThisInitialized(_this));
      return _this;
    }

    _createClass(PasswordStrength, [{
      key: "install",
      value: function install() {
        this.core.registerValidator(PasswordStrength.PASSWORD_STRENGTH_VALIDATOR, this.validatePassword);
        this.core.on('core.validator.validated', this.validatorValidatedHandler);
        this.core.addField(this.opts.field, {
          validators: _defineProperty({}, PasswordStrength.PASSWORD_STRENGTH_VALIDATOR, {
            message: this.opts.message,
            minimalScore: this.opts.minimalScore
          })
        });
      }
    }, {
      key: "uninstall",
      value: function uninstall() {
        this.core.off('core.validator.validated', this.validatorValidatedHandler);
        this.core.disableValidator(this.opts.field, PasswordStrength.PASSWORD_STRENGTH_VALIDATOR);
      }
    }, {
      key: "checkPasswordStrength",
      value: function checkPasswordStrength() {
        var _this2 = this;

        return {
          validate: function validate(input) {
            var value = input.value;

            if (value === '') {
              return {
                valid: true
              };
            }

            var result = zxcvbn(value);
            var score = result.score;
            var message = result.feedback.warning || 'The password is weak';

            if (score < _this2.opts.minimalScore) {
              return {
                message: message,
                meta: {
                  message: message,
                  score: score
                },
                valid: false
              };
            } else {
              return {
                meta: {
                  message: message,
                  score: score
                },
                valid: true
              };
            }
          }
        };
      }
    }, {
      key: "onValidatorValidated",
      value: function onValidatorValidated(e) {
        if (e.field === this.opts.field && e.validator === PasswordStrength.PASSWORD_STRENGTH_VALIDATOR && e.result.meta) {
          var message = e.result.meta['message'];
          var score = e.result.meta['score'];
          this.opts.onValidated(e.result.valid, message, score);
        }
      }
    }]);

    return PasswordStrength;
  }(Plugin);
  PasswordStrength.PASSWORD_STRENGTH_VALIDATOR = '___PasswordStrengthValidator';

  return PasswordStrength;

})));
