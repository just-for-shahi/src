/**
 * FormValidation (https://formvalidation.io), v1.6.0 (4730ac5)
 * The best validation library for JavaScript
 * (c) 2013 - 2020 Nguyen Huu Phuoc <me@phuoc.ng>
 */

(function (global, factory) {
  typeof exports === 'object' && typeof module !== 'undefined' ? module.exports = factory() :
  typeof define === 'function' && define.amd ? define(factory) :
  (global = global || self, (global.FormValidation = global.FormValidation || {}, global.FormValidation.plugins = global.FormValidation.plugins || {}, global.FormValidation.plugins.AutoFocus = factory()));
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

  var FieldStatus =
  /*#__PURE__*/
  function (_Plugin) {
    _inherits(FieldStatus, _Plugin);

    function FieldStatus(opts) {
      var _this;

      _classCallCheck(this, FieldStatus);

      _this = _possibleConstructorReturn(this, _getPrototypeOf(FieldStatus).call(this, opts));
      _this.statuses = new Map();
      _this.opts = Object.assign({}, {
        onStatusChanged: function onStatusChanged() {}
      }, opts);
      _this.elementValidatingHandler = _this.onElementValidating.bind(_assertThisInitialized(_this));
      _this.elementValidatedHandler = _this.onElementValidated.bind(_assertThisInitialized(_this));
      _this.elementNotValidatedHandler = _this.onElementNotValidated.bind(_assertThisInitialized(_this));
      _this.elementIgnoredHandler = _this.onElementIgnored.bind(_assertThisInitialized(_this));
      _this.fieldAddedHandler = _this.onFieldAdded.bind(_assertThisInitialized(_this));
      _this.fieldRemovedHandler = _this.onFieldRemoved.bind(_assertThisInitialized(_this));
      return _this;
    }

    _createClass(FieldStatus, [{
      key: "install",
      value: function install() {
        this.core.on('core.element.validating', this.elementValidatingHandler).on('core.element.validated', this.elementValidatedHandler).on('core.element.notvalidated', this.elementNotValidatedHandler).on('core.element.ignored', this.elementIgnoredHandler).on('core.field.added', this.fieldAddedHandler).on('core.field.removed', this.fieldRemovedHandler);
      }
    }, {
      key: "uninstall",
      value: function uninstall() {
        this.statuses.clear();
        this.core.off('core.element.validating', this.elementValidatingHandler).off('core.element.validated', this.elementValidatedHandler).off('core.element.notvalidated', this.elementNotValidatedHandler).off('core.element.ignored', this.elementIgnoredHandler).off('core.field.added', this.fieldAddedHandler).off('core.field.removed', this.fieldRemovedHandler);
      }
    }, {
      key: "areFieldsValid",
      value: function areFieldsValid() {
        return Array.from(this.statuses.values()).every(function (value) {
          return value === 'Valid' || value === 'NotValidated' || value === 'Ignored';
        });
      }
    }, {
      key: "getStatuses",
      value: function getStatuses() {
        return this.statuses;
      }
    }, {
      key: "onFieldAdded",
      value: function onFieldAdded(e) {
        this.statuses.set(e.field, 'NotValidated');
      }
    }, {
      key: "onFieldRemoved",
      value: function onFieldRemoved(e) {
        if (this.statuses.has(e.field)) {
          this.statuses["delete"](e.field);
        }

        this.opts.onStatusChanged(this.areFieldsValid());
      }
    }, {
      key: "onElementValidating",
      value: function onElementValidating(e) {
        this.statuses.set(e.field, 'Validating');
        this.opts.onStatusChanged(false);
      }
    }, {
      key: "onElementValidated",
      value: function onElementValidated(e) {
        this.statuses.set(e.field, e.valid ? 'Valid' : 'Invalid');

        if (e.valid) {
          this.opts.onStatusChanged(this.areFieldsValid());
        } else {
          this.opts.onStatusChanged(false);
        }
      }
    }, {
      key: "onElementNotValidated",
      value: function onElementNotValidated(e) {
        this.statuses.set(e.field, 'NotValidated');
        this.opts.onStatusChanged(false);
      }
    }, {
      key: "onElementIgnored",
      value: function onElementIgnored(e) {
        this.statuses.set(e.field, 'Ignored');
        this.opts.onStatusChanged(this.areFieldsValid());
      }
    }]);

    return FieldStatus;
  }(Plugin);

  var AutoFocus =
  /*#__PURE__*/
  function (_Plugin) {
    _inherits(AutoFocus, _Plugin);

    function AutoFocus(opts) {
      var _this;

      _classCallCheck(this, AutoFocus);

      _this = _possibleConstructorReturn(this, _getPrototypeOf(AutoFocus).call(this, opts));
      _this.fieldStatusPluginName = '___autoFocusFieldStatus';
      _this.opts = Object.assign({}, {
        onPrefocus: function onPrefocus() {}
      }, opts);
      _this.invalidFormHandler = _this.onFormInvalid.bind(_assertThisInitialized(_this));
      return _this;
    }

    _createClass(AutoFocus, [{
      key: "install",
      value: function install() {
        this.core.on('core.form.invalid', this.invalidFormHandler).registerPlugin(this.fieldStatusPluginName, new FieldStatus());
      }
    }, {
      key: "uninstall",
      value: function uninstall() {
        this.core.off('core.form.invalid', this.invalidFormHandler).deregisterPlugin(this.fieldStatusPluginName);
      }
    }, {
      key: "onFormInvalid",
      value: function onFormInvalid() {
        var plugin = this.core.getPlugin(this.fieldStatusPluginName);
        var statuses = plugin.getStatuses();
        var invalidFields = Object.keys(this.core.getFields()).filter(function (key) {
          return statuses.get(key) === 'Invalid';
        });

        if (invalidFields.length > 0) {
          var firstInvalidField = invalidFields[0];
          var elements = this.core.getElements(firstInvalidField);

          if (elements.length > 0) {
            var firstElement = elements[0];
            var e = {
              firstElement: firstElement,
              field: firstInvalidField
            };
            this.core.emit('plugins.autofocus.prefocus', e);
            this.opts.onPrefocus(e);
            firstElement.focus();
          }
        }
      }
    }]);

    return AutoFocus;
  }(Plugin);

  return AutoFocus;

})));
