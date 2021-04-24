/**
 * FormValidation (https://formvalidation.io), v1.6.0 (4730ac5)
 * The best validation library for JavaScript
 * (c) 2013 - 2020 Nguyen Huu Phuoc <me@phuoc.ng>
 */

(function (global, factory) {
  typeof exports === 'object' && typeof module !== 'undefined' ? module.exports = factory() :
  typeof define === 'function' && define.amd ? define(factory) :
  (global = global || self, (global.FormValidation = global.FormValidation || {}, global.FormValidation.plugins = global.FormValidation.plugins || {}, global.FormValidation.plugins.Semantic = factory()));
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

  function _superPropBase(object, property) {
    while (!Object.prototype.hasOwnProperty.call(object, property)) {
      object = _getPrototypeOf(object);
      if (object === null) break;
    }

    return object;
  }

  function _get(target, property, receiver) {
    if (typeof Reflect !== "undefined" && Reflect.get) {
      _get = Reflect.get;
    } else {
      _get = function _get(target, property, receiver) {
        var base = _superPropBase(target, property);

        if (!base) return;
        var desc = Object.getOwnPropertyDescriptor(base, property);

        if (desc.get) {
          return desc.get.call(receiver);
        }

        return desc.value;
      };
    }

    return _get(target, property, receiver || target);
  }

  var classSet = FormValidation.utils.classSet;

  var hasClass = FormValidation.utils.hasClass;

  var Framework = FormValidation.plugins.Framework;

  var Semantic =
  /*#__PURE__*/
  function (_Framework) {
    _inherits(Semantic, _Framework);

    function Semantic(opts) {
      var _this;

      _classCallCheck(this, Semantic);

      _this = _possibleConstructorReturn(this, _getPrototypeOf(Semantic).call(this, Object.assign({}, {
        formClass: 'fv-plugins-semantic',
        messageClass: 'ui pointing red label',
        rowInvalidClass: 'error',
        rowPattern: /^.*(field|column).*$/,
        rowSelector: '.fields',
        rowValidClass: 'fv-has-success'
      }, opts)));
      _this.messagePlacedHandler = _this.onMessagePlaced.bind(_assertThisInitialized(_this));
      return _this;
    }

    _createClass(Semantic, [{
      key: "install",
      value: function install() {
        _get(_getPrototypeOf(Semantic.prototype), "install", this).call(this);

        this.core.on('plugins.message.placed', this.messagePlacedHandler);
      }
    }, {
      key: "uninstall",
      value: function uninstall() {
        _get(_getPrototypeOf(Semantic.prototype), "uninstall", this).call(this);

        this.core.off('plugins.message.placed', this.messagePlacedHandler);
      }
    }, {
      key: "onIconPlaced",
      value: function onIconPlaced(e) {
        var type = e.element.getAttribute('type');

        if ('checkbox' === type || 'radio' === type) {
          var parent = e.element.parentElement;
          classSet(e.iconElement, {
            'fv-plugins-icon-check': true
          });
          parent.parentElement.insertBefore(e.iconElement, parent.nextSibling);
        }
      }
    }, {
      key: "onMessagePlaced",
      value: function onMessagePlaced(e) {
        var type = e.element.getAttribute('type');
        var numElements = e.elements.length;

        if (('checkbox' === type || 'radio' === type) && numElements > 1) {
          var last = e.elements[numElements - 1];
          var parent = last.parentElement;

          if (hasClass(parent, type) && hasClass(parent, 'ui')) {
            parent.parentElement.insertBefore(e.messageElement, parent.nextSibling);
          }
        }
      }
    }]);

    return Semantic;
  }(Framework);

  return Semantic;

})));
