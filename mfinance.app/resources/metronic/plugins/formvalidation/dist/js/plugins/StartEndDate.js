/**
 * FormValidation (https://formvalidation.io), v1.6.0 (4730ac5)
 * The best validation library for JavaScript
 * (c) 2013 - 2020 Nguyen Huu Phuoc <me@phuoc.ng>
 */

(function (global, factory) {
  typeof exports === 'object' && typeof module !== 'undefined' ? module.exports = factory() :
  typeof define === 'function' && define.amd ? define(factory) :
  (global = global || self, (global.FormValidation = global.FormValidation || {}, global.FormValidation.plugins = global.FormValidation.plugins || {}, global.FormValidation.plugins.StartEndDate = factory()));
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

  var StartEndDate =
  /*#__PURE__*/
  function (_Plugin) {
    _inherits(StartEndDate, _Plugin);

    function StartEndDate(opts) {
      var _this;

      _classCallCheck(this, StartEndDate);

      _this = _possibleConstructorReturn(this, _getPrototypeOf(StartEndDate).call(this, opts));
      _this.fieldValidHandler = _this.onFieldValid.bind(_assertThisInitialized(_this));
      _this.fieldInvalidHandler = _this.onFieldInvalid.bind(_assertThisInitialized(_this));
      return _this;
    }

    _createClass(StartEndDate, [{
      key: "install",
      value: function install() {
        var _this2 = this;

        var fieldOptions = this.core.getFields();
        this.startDateFieldOptions = fieldOptions[this.opts.startDate.field];
        this.endDateFieldOptions = fieldOptions[this.opts.endDate.field];
        var form = this.core.getFormElement();
        this.core.on('core.field.valid', this.fieldValidHandler).on('core.field.invalid', this.fieldInvalidHandler).addField(this.opts.startDate.field, {
          validators: {
            date: {
              format: this.opts.format,
              max: function max() {
                var endDateField = form.querySelector("[name=\"".concat(_this2.opts.endDate.field, "\"]"));
                return endDateField.value;
              },
              message: this.opts.startDate.message
            }
          }
        }).addField(this.opts.endDate.field, {
          validators: {
            date: {
              format: this.opts.format,
              message: this.opts.endDate.message,
              min: function min() {
                var startDateField = form.querySelector("[name=\"".concat(_this2.opts.startDate.field, "\"]"));
                return startDateField.value;
              }
            }
          }
        });
      }
    }, {
      key: "uninstall",
      value: function uninstall() {
        this.core.removeField(this.opts.startDate.field);

        if (this.startDateFieldOptions) {
          this.core.addField(this.opts.startDate.field, this.startDateFieldOptions);
        }

        this.core.removeField(this.opts.endDate.field);

        if (this.endDateFieldOptions) {
          this.core.addField(this.opts.endDate.field, this.endDateFieldOptions);
        }

        this.core.off('core.field.valid', this.fieldValidHandler).off('core.field.invalid', this.fieldInvalidHandler);
      }
    }, {
      key: "onFieldInvalid",
      value: function onFieldInvalid(field) {
        switch (field) {
          case this.opts.startDate.field:
            this.startDateValid = false;
            break;

          case this.opts.endDate.field:
            this.endDateValid = false;
            break;
        }
      }
    }, {
      key: "onFieldValid",
      value: function onFieldValid(field) {
        switch (field) {
          case this.opts.startDate.field:
            this.startDateValid = true;

            if (this.endDateValid === false) {
              this.core.revalidateField(this.opts.endDate.field);
            }

            break;

          case this.opts.endDate.field:
            this.endDateValid = true;

            if (this.startDateValid === false) {
              this.core.revalidateField(this.opts.startDate.field);
            }

            break;
        }
      }
    }]);

    return StartEndDate;
  }(Plugin);

  return StartEndDate;

})));
