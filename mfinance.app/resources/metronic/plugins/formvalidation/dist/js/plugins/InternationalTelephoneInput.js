/**
 * FormValidation (https://formvalidation.io), v1.6.0 (4730ac5)
 * The best validation library for JavaScript
 * (c) 2013 - 2020 Nguyen Huu Phuoc <me@phuoc.ng>
 */

(function (global, factory) {
  typeof exports === 'object' && typeof module !== 'undefined' ? module.exports = factory() :
  typeof define === 'function' && define.amd ? define(factory) :
  (global = global || self, (global.FormValidation = global.FormValidation || {}, global.FormValidation.plugins = global.FormValidation.plugins || {}, global.FormValidation.plugins.InternationalTelephoneInput = factory()));
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

  var InternationalTelephoneInput =
  /*#__PURE__*/
  function (_Plugin) {
    _inherits(InternationalTelephoneInput, _Plugin);

    function InternationalTelephoneInput(opts) {
      var _this;

      _classCallCheck(this, InternationalTelephoneInput);

      _this = _possibleConstructorReturn(this, _getPrototypeOf(InternationalTelephoneInput).call(this, opts));
      _this.intlTelInstances = new Map();
      _this.countryChangeHandler = new Map();
      _this.fieldElements = new Map();
      _this.opts = Object.assign({}, {
        autoPlaceholder: 'polite',
        utilsScript: ''
      }, opts);
      _this.validatePhoneNumber = _this.checkPhoneNumber.bind(_assertThisInitialized(_this));
      _this.fields = typeof _this.opts.field === 'string' ? _this.opts.field.split(',') : _this.opts.field;
      return _this;
    }

    _createClass(InternationalTelephoneInput, [{
      key: "install",
      value: function install() {
        var _this2 = this;

        this.core.registerValidator(InternationalTelephoneInput.INT_TEL_VALIDATOR, this.validatePhoneNumber);
        this.fields.forEach(function (field) {
          _this2.core.addField(field, {
            validators: _defineProperty({}, InternationalTelephoneInput.INT_TEL_VALIDATOR, {
              message: _this2.opts.message
            })
          });

          var ele = _this2.core.getElements(field)[0];

          var handler = function handler() {
            return _this2.core.revalidateField(field);
          };

          ele.addEventListener('countrychange', handler);

          _this2.countryChangeHandler.set(field, handler);

          _this2.fieldElements.set(field, ele);

          _this2.intlTelInstances.set(field, intlTelInput(ele, _this2.opts));
        });
      }
    }, {
      key: "uninstall",
      value: function uninstall() {
        var _this3 = this;

        this.fields.forEach(function (field) {
          var handler = _this3.countryChangeHandler.get(field);

          var ele = _this3.fieldElements.get(field);

          var intlTel = _this3.intlTelInstances.get(field);

          if (handler && ele && intlTel) {
            ele.removeEventListener('countrychange', handler);

            _this3.core.disableValidator(field, InternationalTelephoneInput.INT_TEL_VALIDATOR);

            intlTel.destroy();
          }
        });
      }
    }, {
      key: "checkPhoneNumber",
      value: function checkPhoneNumber() {
        var _this4 = this;

        return {
          validate: function validate(input) {
            var value = input.value;

            var intlTel = _this4.intlTelInstances.get(input.field);

            if (value === '' || !intlTel) {
              return {
                valid: true
              };
            }

            return {
              valid: intlTel.isValidNumber()
            };
          }
        };
      }
    }]);

    return InternationalTelephoneInput;
  }(Plugin);
  InternationalTelephoneInput.INT_TEL_VALIDATOR = '___InternationalTelephoneInputValidator';

  return InternationalTelephoneInput;

})));
