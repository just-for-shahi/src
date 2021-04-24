/**
 * FormValidation (https://formvalidation.io), v1.6.0 (4730ac5)
 * The best validation library for JavaScript
 * (c) 2013 - 2020 Nguyen Huu Phuoc <me@phuoc.ng>
 */

(function (global, factory) {
  typeof exports === 'object' && typeof module !== 'undefined' ? module.exports = factory() :
  typeof define === 'function' && define.amd ? define(factory) :
  (global = global || self, (global.FormValidation = global.FormValidation || {}, global.FormValidation.plugins = global.FormValidation.plugins || {}, global.FormValidation.plugins.MandatoryIcon = factory()));
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

  var classSet = FormValidation.utils.classSet;

  var MandatoryIcon =
  /*#__PURE__*/
  function (_Plugin) {
    _inherits(MandatoryIcon, _Plugin);

    function MandatoryIcon(opts) {
      var _this;

      _classCallCheck(this, MandatoryIcon);

      _this = _possibleConstructorReturn(this, _getPrototypeOf(MandatoryIcon).call(this, opts));
      _this.removedIcons = {
        Invalid: '',
        NotValidated: '',
        Valid: '',
        Validating: ''
      };
      _this.icons = new Map();
      _this.elementValidatingHandler = _this.onElementValidating.bind(_assertThisInitialized(_this));
      _this.elementValidatedHandler = _this.onElementValidated.bind(_assertThisInitialized(_this));
      _this.elementNotValidatedHandler = _this.onElementNotValidated.bind(_assertThisInitialized(_this));
      _this.iconPlacedHandler = _this.onIconPlaced.bind(_assertThisInitialized(_this));
      _this.iconSetHandler = _this.onIconSet.bind(_assertThisInitialized(_this));
      return _this;
    }

    _createClass(MandatoryIcon, [{
      key: "install",
      value: function install() {
        this.core.on('core.element.validating', this.elementValidatingHandler).on('core.element.validated', this.elementValidatedHandler).on('core.element.notvalidated', this.elementNotValidatedHandler).on('plugins.icon.placed', this.iconPlacedHandler).on('plugins.icon.set', this.iconSetHandler);
      }
    }, {
      key: "uninstall",
      value: function uninstall() {
        this.icons.clear();
        this.core.off('core.element.validating', this.elementValidatingHandler).off('core.element.validated', this.elementValidatedHandler).off('core.element.notvalidated', this.elementNotValidatedHandler).off('plugins.icon.placed', this.iconPlacedHandler).off('plugins.icon.set', this.iconSetHandler);
      }
    }, {
      key: "onIconPlaced",
      value: function onIconPlaced(e) {
        var _this2 = this;

        var validators = this.core.getFields()[e.field].validators;
        var elements = this.core.getElements(e.field);

        if (validators && validators['notEmpty'] && validators['notEmpty'].enabled !== false && elements.length) {
          this.icons.set(e.element, e.iconElement);
          var eleType = elements[0].getAttribute('type');
          var type = !eleType ? '' : eleType.toLowerCase();
          var elementArray = 'checkbox' === type || 'radio' === type ? [elements[0]] : elements;
          var _iteratorNormalCompletion = true;
          var _didIteratorError = false;
          var _iteratorError = undefined;

          try {
            for (var _iterator = elementArray[Symbol.iterator](), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
              var ele = _step.value;

              if (this.core.getElementValue(e.field, ele) === '') {
                classSet(e.iconElement, _defineProperty({}, this.opts.icon, true));
              }
            }
          } catch (err) {
            _didIteratorError = true;
            _iteratorError = err;
          } finally {
            try {
              if (!_iteratorNormalCompletion && _iterator["return"] != null) {
                _iterator["return"]();
              }
            } finally {
              if (_didIteratorError) {
                throw _iteratorError;
              }
            }
          }
        }

        this.iconClasses = e.classes;
        var icons = this.opts.icon.split(' ');
        var feedbackIcons = {
          Invalid: this.iconClasses.invalid ? this.iconClasses.invalid.split(' ') : [],
          Valid: this.iconClasses.valid ? this.iconClasses.valid.split(' ') : [],
          Validating: this.iconClasses.validating ? this.iconClasses.validating.split(' ') : []
        };
        Object.keys(feedbackIcons).forEach(function (status) {
          var classes = [];
          var _iteratorNormalCompletion2 = true;
          var _didIteratorError2 = false;
          var _iteratorError2 = undefined;

          try {
            for (var _iterator2 = icons[Symbol.iterator](), _step2; !(_iteratorNormalCompletion2 = (_step2 = _iterator2.next()).done); _iteratorNormalCompletion2 = true) {
              var clazz = _step2.value;

              if (feedbackIcons[status].indexOf(clazz) === -1) {
                classes.push(clazz);
              }
            }
          } catch (err) {
            _didIteratorError2 = true;
            _iteratorError2 = err;
          } finally {
            try {
              if (!_iteratorNormalCompletion2 && _iterator2["return"] != null) {
                _iterator2["return"]();
              }
            } finally {
              if (_didIteratorError2) {
                throw _iteratorError2;
              }
            }
          }

          _this2.removedIcons[status] = classes.join(' ');
        });
      }
    }, {
      key: "onElementValidating",
      value: function onElementValidating(e) {
        this.updateIconClasses(e.element, 'Validating');
      }
    }, {
      key: "onElementValidated",
      value: function onElementValidated(e) {
        this.updateIconClasses(e.element, e.valid ? 'Valid' : 'Invalid');
      }
    }, {
      key: "onElementNotValidated",
      value: function onElementNotValidated(e) {
        this.updateIconClasses(e.element, 'NotValidated');
      }
    }, {
      key: "updateIconClasses",
      value: function updateIconClasses(ele, status) {
        var icon = this.icons.get(ele);

        if (icon && this.iconClasses && (this.iconClasses.valid || this.iconClasses.invalid || this.iconClasses.validating)) {
          var _classSet2;

          classSet(icon, (_classSet2 = {}, _defineProperty(_classSet2, this.removedIcons[status], false), _defineProperty(_classSet2, this.opts.icon, false), _classSet2));
        }
      }
    }, {
      key: "onIconSet",
      value: function onIconSet(e) {
        var icon = this.icons.get(e.element);

        if (icon && e.status === 'NotValidated' && this.core.getElementValue(e.field, e.element) === '') {
          classSet(icon, _defineProperty({}, this.opts.icon, true));
        }
      }
    }]);

    return MandatoryIcon;
  }(Plugin);

  return MandatoryIcon;

})));
