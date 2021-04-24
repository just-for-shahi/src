/**
 * FormValidation (https://formvalidation.io), v1.6.0 (4730ac5)
 * The best validation library for JavaScript
 * (c) 2013 - 2020 Nguyen Huu Phuoc <me@phuoc.ng>
 */

(function (global, factory) {
    typeof exports === 'object' && typeof module !== 'undefined' ? factory(exports) :
    typeof define === 'function' && define.amd ? define(['exports'], factory) :
    (global = global || self, factory(global.FormValidation = {}));
}(this, (function (exports) { 'use strict';

    function luhn(value) {
      var length = value.length;
      var prodArr = [[0, 1, 2, 3, 4, 5, 6, 7, 8, 9], [0, 2, 4, 6, 8, 1, 3, 5, 7, 9]];
      var mul = 0;
      var sum = 0;

      while (length--) {
        sum += prodArr[mul][parseInt(value.charAt(length), 10)];
        mul = 1 - mul;
      }

      return sum % 10 === 0 && sum > 0;
    }

    function mod11And10(value) {
      var length = value.length;
      var check = 5;

      for (var i = 0; i < length; i++) {
        check = ((check || 10) * 2 % 11 + parseInt(value.charAt(i), 10)) % 10;
      }

      return check === 1;
    }

    function mod37And36(value) {
      var alphabet = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
      var length = value.length;
      var modulus = alphabet.length;
      var check = Math.floor(modulus / 2);

      for (var i = 0; i < length; i++) {
        check = ((check || modulus) * 2 % (modulus + 1) + alphabet.indexOf(value.charAt(i))) % modulus;
      }

      return check === 1;
    }

    function verhoeff(value) {
      var d = [[0, 1, 2, 3, 4, 5, 6, 7, 8, 9], [1, 2, 3, 4, 0, 6, 7, 8, 9, 5], [2, 3, 4, 0, 1, 7, 8, 9, 5, 6], [3, 4, 0, 1, 2, 8, 9, 5, 6, 7], [4, 0, 1, 2, 3, 9, 5, 6, 7, 8], [5, 9, 8, 7, 6, 0, 4, 3, 2, 1], [6, 5, 9, 8, 7, 1, 0, 4, 3, 2], [7, 6, 5, 9, 8, 2, 1, 0, 4, 3], [8, 7, 6, 5, 9, 3, 2, 1, 0, 4], [9, 8, 7, 6, 5, 4, 3, 2, 1, 0]];
      var p = [[0, 1, 2, 3, 4, 5, 6, 7, 8, 9], [1, 5, 7, 6, 2, 8, 3, 0, 9, 4], [5, 8, 0, 3, 7, 9, 6, 1, 4, 2], [8, 9, 1, 6, 0, 4, 3, 5, 2, 7], [9, 4, 5, 3, 1, 2, 6, 8, 7, 0], [4, 2, 8, 6, 5, 7, 3, 9, 0, 1], [2, 7, 9, 3, 8, 0, 6, 4, 1, 5], [7, 0, 4, 6, 9, 1, 3, 2, 5, 8]];
      var invertedArray = value.reverse();
      var c = 0;

      for (var i = 0; i < invertedArray.length; i++) {
        c = d[c][p[i % 8][invertedArray[i]]];
      }

      return c === 0;
    }

    var index = {
      luhn: luhn,
      mod11And10: mod11And10,
      mod37And36: mod37And36,
      verhoeff: verhoeff
    };

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

    function emitter() {
      return {
        fns: {},
        clear: function clear() {
          this.fns = {};
        },
        emit: function emit(event) {
          for (var _len = arguments.length, args = new Array(_len > 1 ? _len - 1 : 0), _key = 1; _key < _len; _key++) {
            args[_key - 1] = arguments[_key];
          }

          (this.fns[event] || []).map(function (handler) {
            return handler.apply(handler, args);
          });
        },
        off: function off(event, func) {
          if (this.fns[event]) {
            var index = this.fns[event].indexOf(func);

            if (index >= 0) {
              this.fns[event].splice(index, 1);
            }
          }
        },
        on: function on(event, func) {
          (this.fns[event] = this.fns[event] || []).push(func);
        }
      };
    }

    function filter() {
      return {
        filters: {},
        add: function add(name, func) {
          (this.filters[name] = this.filters[name] || []).push(func);
        },
        clear: function clear() {
          this.filters = {};
        },
        execute: function execute(name, defaultValue, args) {
          if (!this.filters[name] || !this.filters[name].length) {
            return defaultValue;
          }

          var result = defaultValue;
          var filters = this.filters[name];
          var count = filters.length;

          for (var i = 0; i < count; i++) {
            result = filters[i].apply(result, args);
          }

          return result;
        },
        remove: function remove(name, func) {
          if (this.filters[name]) {
            this.filters[name] = this.filters[name].filter(function (f) {
              return f !== func;
            });
          }
        }
      };
    }

    function getFieldValue(form, field, element, elements) {
      var type = (element.getAttribute('type') || '').toLowerCase();
      var tagName = element.tagName.toLowerCase();

      switch (tagName) {
        case 'textarea':
          return element.value;

        case 'select':
          var select = element;
          var index = select.selectedIndex;
          return index >= 0 ? select.options.item(index).value : '';

        case 'input':
          if ('radio' === type || 'checkbox' === type) {
            var checked = elements.filter(function (ele) {
              return ele.checked;
            }).length;
            return checked === 0 ? '' : checked + '';
          } else {
            return element.value;
          }

        default:
          return '';
      }
    }

    function format(message, parameters) {
      var params = Array.isArray(parameters) ? parameters : [parameters];
      var output = message;
      params.forEach(function (p) {
        output = output.replace('%s', p);
      });
      return output;
    }

    function between() {
      var formatValue = function formatValue(value) {
        return parseFloat("".concat(value).replace(',', '.'));
      };

      return {
        validate: function validate(input) {
          var value = input.value;

          if (value === '') {
            return {
              valid: true
            };
          }

          var opts = Object.assign({}, {
            inclusive: true,
            message: ''
          }, input.options);
          var minValue = formatValue(opts.min);
          var maxValue = formatValue(opts.max);
          return opts.inclusive ? {
            message: format(input.l10n ? opts.message || input.l10n.between["default"] : opts.message, ["".concat(minValue), "".concat(maxValue)]),
            valid: parseFloat(value) >= minValue && parseFloat(value) <= maxValue
          } : {
            message: format(input.l10n ? opts.message || input.l10n.between.notInclusive : opts.message, ["".concat(minValue), "".concat(maxValue)]),
            valid: parseFloat(value) > minValue && parseFloat(value) < maxValue
          };
        }
      };
    }

    function blank() {
      return {
        validate: function validate(input) {
          return {
            valid: true
          };
        }
      };
    }

    function call(functionName, args) {
      if ('function' === typeof functionName) {
        return functionName.apply(this, args);
      } else if ('string' === typeof functionName) {
        var name = functionName;

        if ('()' === name.substring(name.length - 2)) {
          name = name.substring(0, name.length - 2);
        }

        var ns = name.split('.');
        var func = ns.pop();
        var context = window;
        var _iteratorNormalCompletion = true;
        var _didIteratorError = false;
        var _iteratorError = undefined;

        try {
          for (var _iterator = ns[Symbol.iterator](), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
            var t = _step.value;
            context = context[t];
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

        return typeof context[func] === 'undefined' ? null : context[func].apply(this, args);
      }
    }

    function callback() {
      return {
        validate: function validate(input) {
          var response = call(input.options.callback, [input]);
          return 'boolean' === typeof response ? {
            valid: response
          } : response;
        }
      };
    }

    function choice() {
      return {
        validate: function validate(input) {
          var numChoices = 'select' === input.element.tagName.toLowerCase() ? input.element.querySelectorAll('option:checked').length : input.elements.filter(function (ele) {
            return ele.checked;
          }).length;
          var min = input.options.min ? "".concat(input.options.min) : '';
          var max = input.options.max ? "".concat(input.options.max) : '';
          var msg = input.l10n ? input.options.message || input.l10n.choice["default"] : input.options.message;
          var isValid = !(min && numChoices < parseInt(min, 10) || max && numChoices > parseInt(max, 10));

          switch (true) {
            case !!min && !!max:
              msg = format(input.l10n ? input.l10n.choice.between : input.options.message, [min, max]);
              break;

            case !!min:
              msg = format(input.l10n ? input.l10n.choice.more : input.options.message, min);
              break;

            case !!max:
              msg = format(input.l10n ? input.l10n.choice.less : input.options.message, max);
              break;
          }

          return {
            message: msg,
            valid: isValid
          };
        }
      };
    }

    var CREDIT_CARD_TYPES = {
      AMERICAN_EXPRESS: {
        length: [15],
        prefix: ['34', '37']
      },
      DANKORT: {
        length: [16],
        prefix: ['5019']
      },
      DINERS_CLUB: {
        length: [14],
        prefix: ['300', '301', '302', '303', '304', '305', '36']
      },
      DINERS_CLUB_US: {
        length: [16],
        prefix: ['54', '55']
      },
      DISCOVER: {
        length: [16],
        prefix: ['6011', '622126', '622127', '622128', '622129', '62213', '62214', '62215', '62216', '62217', '62218', '62219', '6222', '6223', '6224', '6225', '6226', '6227', '6228', '62290', '62291', '622920', '622921', '622922', '622923', '622924', '622925', '644', '645', '646', '647', '648', '649', '65']
      },
      ELO: {
        length: [16],
        prefix: ['4011', '4312', '4389', '4514', '4573', '4576', '5041', '5066', '5067', '509', '6277', '6362', '6363', '650', '6516', '6550']
      },
      FORBRUGSFORENINGEN: {
        length: [16],
        prefix: ['600722']
      },
      JCB: {
        length: [16],
        prefix: ['3528', '3529', '353', '354', '355', '356', '357', '358']
      },
      LASER: {
        length: [16, 17, 18, 19],
        prefix: ['6304', '6706', '6771', '6709']
      },
      MAESTRO: {
        length: [12, 13, 14, 15, 16, 17, 18, 19],
        prefix: ['5018', '5020', '5038', '5868', '6304', '6759', '6761', '6762', '6763', '6764', '6765', '6766']
      },
      MASTERCARD: {
        length: [16],
        prefix: ['51', '52', '53', '54', '55']
      },
      SOLO: {
        length: [16, 18, 19],
        prefix: ['6334', '6767']
      },
      UNIONPAY: {
        length: [16, 17, 18, 19],
        prefix: ['622126', '622127', '622128', '622129', '62213', '62214', '62215', '62216', '62217', '62218', '62219', '6222', '6223', '6224', '6225', '6226', '6227', '6228', '62290', '62291', '622920', '622921', '622922', '622923', '622924', '622925']
      },
      VISA: {
        length: [16],
        prefix: ['4']
      },
      VISA_ELECTRON: {
        length: [16],
        prefix: ['4026', '417500', '4405', '4508', '4844', '4913', '4917']
      }
    };
    function creditCard() {
      return {
        validate: function validate(input) {
          if (input.value === '') {
            return {
              meta: {
                type: null
              },
              valid: true
            };
          }

          if (/[^0-9-\s]+/.test(input.value)) {
            return {
              meta: {
                type: null
              },
              valid: false
            };
          }

          var v = input.value.replace(/\D/g, '');

          if (!luhn(v)) {
            return {
              meta: {
                type: null
              },
              valid: false
            };
          }

          for (var _i = 0, _Object$keys = Object.keys(CREDIT_CARD_TYPES); _i < _Object$keys.length; _i++) {
            var tpe = _Object$keys[_i];

            for (var i in CREDIT_CARD_TYPES[tpe].prefix) {
              if (input.value.substr(0, CREDIT_CARD_TYPES[tpe].prefix[i].length) === CREDIT_CARD_TYPES[tpe].prefix[i] && CREDIT_CARD_TYPES[tpe].length.indexOf(v.length) !== -1) {
                return {
                  meta: {
                    type: tpe
                  },
                  valid: true
                };
              }
            }
          }

          return {
            meta: {
              type: null
            },
            valid: false
          };
        }
      };
    }

    function isValidDate(year, month, day, notInFuture) {
      if (isNaN(year) || isNaN(month) || isNaN(day)) {
        return false;
      }

      if (year < 1000 || year > 9999 || month <= 0 || month > 12) {
        return false;
      }

      var numDays = [31, year % 400 === 0 || year % 100 !== 0 && year % 4 === 0 ? 29 : 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

      if (day <= 0 || day > numDays[month - 1]) {
        return false;
      }

      if (notInFuture === true) {
        var currentDate = new Date();
        var currentYear = currentDate.getFullYear();
        var currentMonth = currentDate.getMonth();
        var currentDay = currentDate.getDate();
        return year < currentYear || year === currentYear && month - 1 < currentMonth || year === currentYear && month - 1 === currentMonth && day < currentDay;
      }

      return true;
    }

    function date() {
      var parseDate = function parseDate(input, inputFormat, separator) {
        var yearIndex = inputFormat.indexOf('YYYY');
        var monthIndex = inputFormat.indexOf('MM');
        var dayIndex = inputFormat.indexOf('DD');

        if (yearIndex === -1 || monthIndex === -1 || dayIndex === -1) {
          return null;
        }

        var sections = input.split(' ');
        var dateSection = sections[0].split(separator);

        if (dateSection.length < 3) {
          return null;
        }

        var d = new Date(parseInt(dateSection[yearIndex], 10), parseInt(dateSection[monthIndex], 10) - 1, parseInt(dateSection[dayIndex], 10));

        if (sections.length > 1) {
          var timeSection = sections[1].split(':');
          d.setHours(timeSection.length > 0 ? parseInt(timeSection[0], 10) : 0);
          d.setMinutes(timeSection.length > 1 ? parseInt(timeSection[1], 10) : 0);
          d.setSeconds(timeSection.length > 2 ? parseInt(timeSection[2], 10) : 0);
        }

        return d;
      };

      var formatDate = function formatDate(input, inputFormat) {
        var dateFormat = inputFormat.replace(/Y/g, 'y').replace(/M/g, 'm').replace(/D/g, 'd').replace(/:m/g, ':M').replace(/:mm/g, ':MM').replace(/:S/, ':s').replace(/:SS/, ':ss');
        var d = input.getDate();
        var dd = d < 10 ? "0".concat(d) : d;
        var m = input.getMonth() + 1;
        var mm = m < 10 ? "0".concat(m) : m;
        var yy = "".concat(input.getFullYear()).substr(2);
        var yyyy = input.getFullYear();
        var h = input.getHours() % 12 || 12;
        var hh = h < 10 ? "0".concat(h) : h;
        var H = input.getHours();
        var HH = H < 10 ? "0".concat(H) : H;
        var M = input.getMinutes();
        var MM = M < 10 ? "0".concat(M) : M;
        var s = input.getSeconds();
        var ss = s < 10 ? "0".concat(s) : s;
        var replacer = {
          H: "".concat(H),
          HH: "".concat(HH),
          M: "".concat(M),
          MM: "".concat(MM),
          d: "".concat(d),
          dd: "".concat(dd),
          h: "".concat(h),
          hh: "".concat(hh),
          m: "".concat(m),
          mm: "".concat(mm),
          s: "".concat(s),
          ss: "".concat(ss),
          yy: "".concat(yy),
          yyyy: "".concat(yyyy)
        };
        return dateFormat.replace(/d{1,4}|m{1,4}|yy(?:yy)?|([HhMs])\1?|"[^"]*"|'[^']*'/g, function (match) {
          return replacer[match] ? replacer[match] : match.slice(1, match.length - 1);
        });
      };

      return {
        validate: function validate(input) {
          if (input.value === '') {
            return {
              meta: {
                date: null
              },
              valid: true
            };
          }

          var opts = Object.assign({}, {
            format: input.element && input.element.getAttribute('type') === 'date' ? 'YYYY-MM-DD' : 'MM/DD/YYYY',
            message: ''
          }, input.options);
          var message = input.l10n ? input.l10n.date["default"] : opts.message;
          var invalidResult = {
            message: "".concat(message),
            meta: {
              date: null
            },
            valid: false
          };
          var formats = opts.format.split(' ');
          var timeFormat = formats.length > 1 ? formats[1] : null;
          var amOrPm = formats.length > 2 ? formats[2] : null;
          var sections = input.value.split(' ');
          var dateSection = sections[0];
          var timeSection = sections.length > 1 ? sections[1] : null;

          if (formats.length !== sections.length) {
            return invalidResult;
          }

          var separator = opts.separator || (dateSection.indexOf('/') !== -1 ? '/' : dateSection.indexOf('-') !== -1 ? '-' : dateSection.indexOf('.') !== -1 ? '.' : '/');

          if (separator === null || dateSection.indexOf(separator) === -1) {
            return invalidResult;
          }

          var dateStr = dateSection.split(separator);
          var dateFormat = formats[0].split(separator);

          if (dateStr.length !== dateFormat.length) {
            return invalidResult;
          }

          var yearStr = dateStr[dateFormat.indexOf('YYYY')];
          var monthStr = dateStr[dateFormat.indexOf('MM')];
          var dayStr = dateStr[dateFormat.indexOf('DD')];

          if (!/^\d+$/.test(yearStr) || !/^\d+$/.test(monthStr) || !/^\d+$/.test(dayStr) || yearStr.length > 4 || monthStr.length > 2 || dayStr.length > 2) {
            return invalidResult;
          }

          var year = parseInt(yearStr, 10);
          var month = parseInt(monthStr, 10);
          var day = parseInt(dayStr, 10);

          if (!isValidDate(year, month, day)) {
            return invalidResult;
          }

          var d = new Date(year, month - 1, day);

          if (timeFormat) {
            var hms = timeSection.split(':');

            if (timeFormat.split(':').length !== hms.length) {
              return invalidResult;
            }

            var h = hms.length > 0 ? hms[0].length <= 2 && /^\d+$/.test(hms[0]) ? parseInt(hms[0], 10) : -1 : 0;
            var m = hms.length > 1 ? hms[1].length <= 2 && /^\d+$/.test(hms[1]) ? parseInt(hms[1], 10) : -1 : 0;
            var s = hms.length > 2 ? hms[2].length <= 2 && /^\d+$/.test(hms[2]) ? parseInt(hms[2], 10) : -1 : 0;

            if (h === -1 || m === -1 || s === -1) {
              return invalidResult;
            }

            if (s < 0 || s > 60) {
              return invalidResult;
            }

            if (h < 0 || h >= 24 || amOrPm && h > 12) {
              return invalidResult;
            }

            if (m < 0 || m > 59) {
              return invalidResult;
            }

            d.setHours(h);
            d.setMinutes(m);
            d.setSeconds(s);
          }

          var minOption = typeof opts.min === 'function' ? opts.min() : opts.min;
          var min = minOption instanceof Date ? minOption : minOption ? parseDate(minOption, dateFormat, separator) : d;
          var maxOption = typeof opts.max === 'function' ? opts.max() : opts.max;
          var max = maxOption instanceof Date ? maxOption : maxOption ? parseDate(maxOption, dateFormat, separator) : d;
          var minOptionStr = minOption instanceof Date ? formatDate(min, opts.format) : minOption;
          var maxOptionStr = maxOption instanceof Date ? formatDate(max, opts.format) : maxOption;

          switch (true) {
            case !!minOptionStr && !maxOptionStr:
              return {
                message: format(input.l10n ? input.l10n.date.min : message, minOptionStr),
                meta: {
                  date: d
                },
                valid: d.getTime() >= min.getTime()
              };

            case !!maxOptionStr && !minOptionStr:
              return {
                message: format(input.l10n ? input.l10n.date.max : message, maxOptionStr),
                meta: {
                  date: d
                },
                valid: d.getTime() <= max.getTime()
              };

            case !!maxOptionStr && !!minOptionStr:
              return {
                message: format(input.l10n ? input.l10n.date.range : message, [minOptionStr, maxOptionStr]),
                meta: {
                  date: d
                },
                valid: d.getTime() <= max.getTime() && d.getTime() >= min.getTime()
              };

            default:
              return {
                message: "".concat(message),
                meta: {
                  date: d
                },
                valid: true
              };
          }
        }
      };
    }

    function different() {
      return {
        validate: function validate(input) {
          var compareWith = 'function' === typeof input.options.compare ? input.options.compare.call(this) : input.options.compare;
          return {
            valid: compareWith === '' || input.value !== compareWith
          };
        }
      };
    }

    function digits() {
      return {
        validate: function validate(input) {
          return {
            valid: input.value === '' || /^\d+$/.test(input.value)
          };
        }
      };
    }

    function emailAddress() {
      var splitEmailAddresses = function splitEmailAddresses(emailAddresses, separator) {
        var quotedFragments = emailAddresses.split(/"/);
        var quotedFragmentCount = quotedFragments.length;
        var emailAddressArray = [];
        var nextEmailAddress = '';

        for (var i = 0; i < quotedFragmentCount; i++) {
          if (i % 2 === 0) {
            var splitEmailAddressFragments = quotedFragments[i].split(separator);
            var splitEmailAddressFragmentCount = splitEmailAddressFragments.length;

            if (splitEmailAddressFragmentCount === 1) {
              nextEmailAddress += splitEmailAddressFragments[0];
            } else {
              emailAddressArray.push(nextEmailAddress + splitEmailAddressFragments[0]);

              for (var j = 1; j < splitEmailAddressFragmentCount - 1; j++) {
                emailAddressArray.push(splitEmailAddressFragments[j]);
              }

              nextEmailAddress = splitEmailAddressFragments[splitEmailAddressFragmentCount - 1];
            }
          } else {
            nextEmailAddress += '"' + quotedFragments[i];

            if (i < quotedFragmentCount - 1) {
              nextEmailAddress += '"';
            }
          }
        }

        emailAddressArray.push(nextEmailAddress);
        return emailAddressArray;
      };

      return {
        validate: function validate(input) {
          if (input.value === '') {
            return {
              valid: true
            };
          }

          var opts = Object.assign({}, {
            multiple: false,
            separator: /[,;]/
          }, input.options);
          var emailRegExp = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
          var allowMultiple = opts.multiple === true || "".concat(opts.multiple) === 'true';

          if (allowMultiple) {
            var separator = opts.separator || /[,;]/;
            var addresses = splitEmailAddresses(input.value, separator);
            var length = addresses.length;

            for (var i = 0; i < length; i++) {
              if (!emailRegExp.test(addresses[i])) {
                return {
                  valid: false
                };
              }
            }

            return {
              valid: true
            };
          } else {
            return {
              valid: emailRegExp.test(input.value)
            };
          }
        }
      };
    }

    function file() {
      return {
        validate: function validate(input) {
          if (input.value === '') {
            return {
              valid: true
            };
          }

          var extension;
          var extensions = input.options.extension ? input.options.extension.toLowerCase().split(',') : null;
          var types = input.options.type ? input.options.type.toLowerCase().split(',') : null;
          var html5 = window['File'] && window['FileList'] && window['FileReader'];

          if (html5) {
            var files = input.element.files;
            var total = files.length;
            var allSize = 0;

            if (input.options.maxFiles && total > parseInt("".concat(input.options.maxFiles), 10)) {
              return {
                meta: {
                  error: 'INVALID_MAX_FILES'
                },
                valid: false
              };
            }

            if (input.options.minFiles && total < parseInt("".concat(input.options.minFiles), 10)) {
              return {
                meta: {
                  error: 'INVALID_MIN_FILES'
                },
                valid: false
              };
            }

            var metaData = {};

            for (var i = 0; i < total; i++) {
              allSize += files[i].size;
              extension = files[i].name.substr(files[i].name.lastIndexOf('.') + 1);
              metaData = {
                ext: extension,
                file: files[i],
                size: files[i].size,
                type: files[i].type
              };

              if (input.options.minSize && files[i].size < parseInt("".concat(input.options.minSize), 10)) {
                return {
                  meta: Object.assign({}, {
                    error: 'INVALID_MIN_SIZE'
                  }, metaData),
                  valid: false
                };
              }

              if (input.options.maxSize && files[i].size > parseInt("".concat(input.options.maxSize), 10)) {
                return {
                  meta: Object.assign({}, {
                    error: 'INVALID_MAX_SIZE'
                  }, metaData),
                  valid: false
                };
              }

              if (extensions && extensions.indexOf(extension.toLowerCase()) === -1) {
                return {
                  meta: Object.assign({}, {
                    error: 'INVALID_EXTENSION'
                  }, metaData),
                  valid: false
                };
              }

              if (files[i].type && types && types.indexOf(files[i].type.toLowerCase()) === -1) {
                return {
                  meta: Object.assign({}, {
                    error: 'INVALID_TYPE'
                  }, metaData),
                  valid: false
                };
              }
            }

            if (input.options.maxTotalSize && allSize > parseInt("".concat(input.options.maxTotalSize), 10)) {
              return {
                meta: Object.assign({}, {
                  error: 'INVALID_MAX_TOTAL_SIZE',
                  totalSize: allSize
                }, metaData),
                valid: false
              };
            }

            if (input.options.minTotalSize && allSize < parseInt("".concat(input.options.minTotalSize), 10)) {
              return {
                meta: Object.assign({}, {
                  error: 'INVALID_MIN_TOTAL_SIZE',
                  totalSize: allSize
                }, metaData),
                valid: false
              };
            }
          } else {
            extension = input.value.substr(input.value.lastIndexOf('.') + 1);

            if (extensions && extensions.indexOf(extension.toLowerCase()) === -1) {
              return {
                meta: {
                  error: 'INVALID_EXTENSION',
                  ext: extension
                },
                valid: false
              };
            }
          }

          return {
            valid: true
          };
        }
      };
    }

    function greaterThan() {
      return {
        validate: function validate(input) {
          if (input.value === '') {
            return {
              valid: true
            };
          }

          var opts = Object.assign({}, {
            inclusive: true,
            message: ''
          }, input.options);
          var minValue = parseFloat("".concat(opts.min).replace(',', '.'));
          return opts.inclusive ? {
            message: format(input.l10n ? opts.message || input.l10n.greaterThan["default"] : opts.message, "".concat(minValue)),
            valid: parseFloat(input.value) >= minValue
          } : {
            message: format(input.l10n ? opts.message || input.l10n.greaterThan.notInclusive : opts.message, "".concat(minValue)),
            valid: parseFloat(input.value) > minValue
          };
        }
      };
    }

    function identical() {
      return {
        validate: function validate(input) {
          var compareWith = 'function' === typeof input.options.compare ? input.options.compare.call(this) : input.options.compare;
          return {
            valid: compareWith === '' || input.value === compareWith
          };
        }
      };
    }

    function integer() {
      return {
        validate: function validate(input) {
          if (input.value === '') {
            return {
              valid: true
            };
          }

          var opts = Object.assign({}, {
            decimalSeparator: '.',
            thousandsSeparator: ''
          }, input.options);
          var decimalSeparator = opts.decimalSeparator === '.' ? '\\.' : opts.decimalSeparator;
          var thousandsSeparator = opts.thousandsSeparator === '.' ? '\\.' : opts.thousandsSeparator;
          var testRegexp = new RegExp("^-?[0-9]{1,3}(".concat(thousandsSeparator, "[0-9]{3})*(").concat(decimalSeparator, "[0-9]+)?$"));
          var thousandsReplacer = new RegExp(thousandsSeparator, 'g');
          var v = "".concat(input.value);

          if (!testRegexp.test(v)) {
            return {
              valid: false
            };
          }

          if (thousandsSeparator) {
            v = v.replace(thousandsReplacer, '');
          }

          if (decimalSeparator) {
            v = v.replace(decimalSeparator, '.');
          }

          var n = parseFloat(v);
          return {
            valid: !isNaN(n) && isFinite(n) && Math.floor(n) === n
          };
        }
      };
    }

    function ip() {
      return {
        validate: function validate(input) {
          if (input.value === '') {
            return {
              valid: true
            };
          }

          var opts = Object.assign({}, {
            ipv4: true,
            ipv6: true
          }, input.options);
          var ipv4Regex = /^(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)(\/([0-9]|[1-2][0-9]|3[0-2]))?$/;
          var ipv6Regex = /^\s*((([0-9A-Fa-f]{1,4}:){7}([0-9A-Fa-f]{1,4}|:))|(([0-9A-Fa-f]{1,4}:){6}(:[0-9A-Fa-f]{1,4}|((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3})|:))|(([0-9A-Fa-f]{1,4}:){5}(((:[0-9A-Fa-f]{1,4}){1,2})|:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3})|:))|(([0-9A-Fa-f]{1,4}:){4}(((:[0-9A-Fa-f]{1,4}){1,3})|((:[0-9A-Fa-f]{1,4})?:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(([0-9A-Fa-f]{1,4}:){3}(((:[0-9A-Fa-f]{1,4}){1,4})|((:[0-9A-Fa-f]{1,4}){0,2}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(([0-9A-Fa-f]{1,4}:){2}(((:[0-9A-Fa-f]{1,4}){1,5})|((:[0-9A-Fa-f]{1,4}){0,3}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(([0-9A-Fa-f]{1,4}:){1}(((:[0-9A-Fa-f]{1,4}){1,6})|((:[0-9A-Fa-f]{1,4}){0,4}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(:(((:[0-9A-Fa-f]{1,4}){1,7})|((:[0-9A-Fa-f]{1,4}){0,5}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:)))(%.+)?\s*(\/(\d|\d\d|1[0-1]\d|12[0-8]))?$/;

          switch (true) {
            case opts.ipv4 && !opts.ipv6:
              return {
                message: input.l10n ? opts.message || input.l10n.ip.ipv4 : opts.message,
                valid: ipv4Regex.test(input.value)
              };

            case !opts.ipv4 && opts.ipv6:
              return {
                message: input.l10n ? opts.message || input.l10n.ip.ipv6 : opts.message,
                valid: ipv6Regex.test(input.value)
              };

            case opts.ipv4 && opts.ipv6:
            default:
              return {
                message: input.l10n ? opts.message || input.l10n.ip["default"] : opts.message,
                valid: ipv4Regex.test(input.value) || ipv6Regex.test(input.value)
              };
          }
        }
      };
    }

    function lessThan() {
      return {
        validate: function validate(input) {
          if (input.value === '') {
            return {
              valid: true
            };
          }

          var opts = Object.assign({}, {
            inclusive: true,
            message: ''
          }, input.options);
          var maxValue = parseFloat("".concat(opts.max).replace(',', '.'));
          return opts.inclusive ? {
            message: format(input.l10n ? opts.message || input.l10n.lessThan["default"] : opts.message, "".concat(maxValue)),
            valid: parseFloat(input.value) <= maxValue
          } : {
            message: format(input.l10n ? opts.message || input.l10n.lessThan.notInclusive : opts.message, "".concat(maxValue)),
            valid: parseFloat(input.value) < maxValue
          };
        }
      };
    }

    function notEmpty() {
      return {
        validate: function validate(input) {
          return {
            valid: input.value !== ''
          };
        }
      };
    }

    function numeric() {
      return {
        validate: function validate(input) {
          if (input.value === '') {
            return {
              valid: true
            };
          }

          var opts = Object.assign({}, {
            decimalSeparator: '.',
            thousandsSeparator: ''
          }, input.options);
          var v = "".concat(input.value);

          if (v.substr(0, 1) === opts.decimalSeparator) {
            v = "0".concat(opts.decimalSeparator).concat(v.substr(1));
          } else if (v.substr(0, 2) === "-".concat(opts.decimalSeparator)) {
            v = "-0".concat(opts.decimalSeparator).concat(v.substr(2));
          }

          var decimalSeparator = opts.decimalSeparator === '.' ? '\\.' : opts.decimalSeparator;
          var thousandsSeparator = opts.thousandsSeparator === '.' ? '\\.' : opts.thousandsSeparator;
          var testRegexp = new RegExp("^-?[0-9]{1,3}(".concat(thousandsSeparator, "[0-9]{3})*(").concat(decimalSeparator, "[0-9]+)?$"));
          var thousandsReplacer = new RegExp(thousandsSeparator, 'g');

          if (!testRegexp.test(v)) {
            return {
              valid: false
            };
          }

          if (thousandsSeparator) {
            v = v.replace(thousandsReplacer, '');
          }

          if (decimalSeparator) {
            v = v.replace(decimalSeparator, '.');
          }

          var n = parseFloat(v);
          return {
            valid: !isNaN(n) && isFinite(n)
          };
        }
      };
    }

    function promise() {
      return {
        validate: function validate(input) {
          return call(input.options.promise, [input]);
        }
      };
    }

    function regexp() {
      return {
        validate: function validate(input) {
          if (input.value === '') {
            return {
              valid: true
            };
          }

          var reg = input.options.regexp;

          if (reg instanceof RegExp) {
            return {
              valid: reg.test(input.value)
            };
          } else {
            var pattern = reg.toString();
            var exp = input.options.flags ? new RegExp(pattern, input.options.flags) : new RegExp(pattern);
            return {
              valid: exp.test(input.value)
            };
          }
        }
      };
    }

    function fetch(url, options) {
      var toQuery = function toQuery(obj) {
        return Object.keys(obj).map(function (k) {
          return "".concat(encodeURIComponent(k), "=").concat(encodeURIComponent(obj[k]));
        }).join('&');
      };

      return new Promise(function (resolve, reject) {
        var opts = Object.assign({}, {
          crossDomain: false,
          headers: {},
          method: 'GET',
          params: {}
        }, options);
        var params = Object.keys(opts.params).map(function (k) {
          return "".concat(encodeURIComponent(k), "=").concat(encodeURIComponent(opts.params[k]));
        }).join('&');
        var hasQuery = url.indexOf('?');
        var requestUrl = 'GET' === opts.method ? "".concat(url).concat(hasQuery ? '?' : '&').concat(params) : url;

        if (opts.crossDomain) {
          var script = document.createElement('script');
          var callback = "___fetch".concat(Date.now(), "___");

          window[callback] = function (data) {
            delete window[callback];
            resolve(data);
          };

          script.src = "".concat(requestUrl).concat(hasQuery ? '&' : '?', "callback=").concat(callback);
          script.async = true;
          script.addEventListener('load', function () {
            script.parentNode.removeChild(script);
          });
          script.addEventListener('error', function () {
            return reject;
          });
          document.head.appendChild(script);
        } else {
          var request = new XMLHttpRequest();
          request.open(opts.method, requestUrl);
          request.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

          if ('POST' === opts.method) {
            request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
          }

          Object.keys(opts.headers).forEach(function (k) {
            return request.setRequestHeader(k, opts.headers[k]);
          });
          request.addEventListener('load', function () {
            resolve(JSON.parse(this.responseText));
          });
          request.addEventListener('error', function () {
            return reject;
          });
          request.send(toQuery(opts.params));
        }
      });
    }

    function remote() {
      var DEFAULT_OPTIONS = {
        crossDomain: false,
        data: {},
        headers: {},
        method: 'GET',
        validKey: 'valid'
      };
      return {
        validate: function validate(input) {
          if (input.value === '') {
            return Promise.resolve({
              valid: true
            });
          }

          var opts = Object.assign({}, DEFAULT_OPTIONS, input.options);
          var data = opts.data;

          if ('function' === typeof opts.data) {
            data = opts.data.call(this, input);
          }

          if ('string' === typeof data) {
            data = JSON.parse(data);
          }

          data[opts.name || input.field] = input.value;
          var url = 'function' === typeof opts.url ? opts.url.call(this, input) : opts.url;
          return fetch(url, {
            crossDomain: opts.crossDomain,
            headers: opts.headers,
            method: opts.method,
            params: data
          }).then(function (response) {
            return Promise.resolve({
              message: response.message,
              meta: response,
              valid: "".concat(response[opts.validKey]) === 'true'
            });
          })["catch"](function (reason) {
            return Promise.reject({
              valid: false
            });
          });
        }
      };
    }

    function stringCase() {
      return {
        validate: function validate(input) {
          if (input.value === '') {
            return {
              valid: true
            };
          }

          var opts = Object.assign({}, {
            "case": 'lower'
          }, input.options);
          var caseOpt = (opts["case"] || 'lower').toLowerCase();
          return {
            message: opts.message || (input.l10n ? 'upper' === caseOpt ? input.l10n.stringCase.upper : input.l10n.stringCase["default"] : opts.message),
            valid: 'upper' === caseOpt ? input.value === input.value.toUpperCase() : input.value === input.value.toLowerCase()
          };
        }
      };
    }

    function stringLength() {
      var utf8Length = function utf8Length(str) {
        var s = str.length;

        for (var i = str.length - 1; i >= 0; i--) {
          var code = str.charCodeAt(i);

          if (code > 0x7f && code <= 0x7ff) {
            s++;
          } else if (code > 0x7ff && code <= 0xffff) {
            s += 2;
          }

          if (code >= 0xDC00 && code <= 0xDFFF) {
            i--;
          }
        }

        return "".concat(s);
      };

      return {
        validate: function validate(input) {
          var opts = Object.assign({}, {
            message: '',
            trim: false,
            utf8Bytes: false
          }, input.options);
          var v = opts.trim === true || "".concat(opts.trim) === 'true' ? input.value.trim() : input.value;

          if (v === '') {
            return {
              valid: true
            };
          }

          var min = opts.min ? "".concat(opts.min) : '';
          var max = opts.max ? "".concat(opts.max) : '';
          var length = opts.utf8Bytes ? utf8Length(v) : v.length;
          var isValid = true;
          var msg = input.l10n ? opts.message || input.l10n.stringLength["default"] : opts.message;

          if (min && length < parseInt(min, 10) || max && length > parseInt(max, 10)) {
            isValid = false;
          }

          switch (true) {
            case !!min && !!max:
              msg = format(input.l10n ? opts.message || input.l10n.stringLength.between : opts.message, [min, max]);
              break;

            case !!min:
              msg = format(input.l10n ? opts.message || input.l10n.stringLength.more : opts.message, "".concat(parseInt(min, 10) - 1));
              break;

            case !!max:
              msg = format(input.l10n ? opts.message || input.l10n.stringLength.less : opts.message, "".concat(parseInt(max, 10) + 1));
              break;
          }

          return {
            message: msg,
            valid: isValid
          };
        }
      };
    }

    function uri() {
      var DEFAULT_OPTIONS = {
        allowEmptyProtocol: false,
        allowLocal: false,
        protocol: 'http, https, ftp'
      };
      return {
        validate: function validate(input) {
          if (input.value === '') {
            return {
              valid: true
            };
          }

          var opts = Object.assign({}, DEFAULT_OPTIONS, input.options);
          var allowLocal = opts.allowLocal === true || "".concat(opts.allowLocal) === 'true';
          var allowEmptyProtocol = opts.allowEmptyProtocol === true || "".concat(opts.allowEmptyProtocol) === 'true';
          var protocol = opts.protocol.split(',').join('|').replace(/\s/g, '');
          var urlExp = new RegExp("^" + "(?:(?:" + protocol + ")://)" + (allowEmptyProtocol ? '?' : '') + "(?:\\S+(?::\\S*)?@)?" + "(?:" + (allowLocal ? '' : "(?!(?:10|127)(?:\\.\\d{1,3}){3})" + "(?!(?:169\\.254|192\\.168)(?:\\.\\d{1,3}){2})" + "(?!172\\.(?:1[6-9]|2\\d|3[0-1])(?:\\.\\d{1,3}){2})") + "(?:[1-9]\\d?|1\\d\\d|2[01]\\d|22[0-3])" + "(?:\\.(?:1?\\d{1,2}|2[0-4]\\d|25[0-5])){2}" + "(?:\\.(?:[1-9]\\d?|1\\d\\d|2[0-4]\\d|25[0-4]))" + "|" + "(?:(?:[a-z\\u00a1-\\uffff0-9]-?)*[a-z\\u00a1-\\uffff0-9]+)" + "(?:\\.(?:[a-z\\u00a1-\\uffff0-9]-?)*[a-z\\u00a1-\\uffff0-9])*" + "(?:\\.(?:[a-z\\u00a1-\\uffff]{2,}))" + (allowLocal ? '?' : '') + ")" + "(?::\\d{2,5})?" + "(?:/[^\\s]*)?$", "i");
          return {
            valid: urlExp.test(input.value)
          };
        }
      };
    }

    function base64() {
      return {
        validate: function validate(input) {
          return {
            valid: input.value === '' || /^(?:[A-Za-z0-9+/]{4})*(?:[A-Za-z0-9+/]{2}==|[A-Za-z0-9+/]{3}=|[A-Za-z0-9+/]{4})$/.test(input.value)
          };
        }
      };
    }

    function bic() {
      return {
        validate: function validate(input) {
          return {
            valid: input.value === '' || /^[a-zA-Z]{6}[a-zA-Z0-9]{2}([a-zA-Z0-9]{3})?$/.test(input.value)
          };
        }
      };
    }

    function color() {
      var SUPPORTED_TYPES = ['hex', 'rgb', 'rgba', 'hsl', 'hsla', 'keyword'];
      var KEYWORD_COLORS = ['aliceblue', 'antiquewhite', 'aqua', 'aquamarine', 'azure', 'beige', 'bisque', 'black', 'blanchedalmond', 'blue', 'blueviolet', 'brown', 'burlywood', 'cadetblue', 'chartreuse', 'chocolate', 'coral', 'cornflowerblue', 'cornsilk', 'crimson', 'cyan', 'darkblue', 'darkcyan', 'darkgoldenrod', 'darkgray', 'darkgreen', 'darkgrey', 'darkkhaki', 'darkmagenta', 'darkolivegreen', 'darkorange', 'darkorchid', 'darkred', 'darksalmon', 'darkseagreen', 'darkslateblue', 'darkslategray', 'darkslategrey', 'darkturquoise', 'darkviolet', 'deeppink', 'deepskyblue', 'dimgray', 'dimgrey', 'dodgerblue', 'firebrick', 'floralwhite', 'forestgreen', 'fuchsia', 'gainsboro', 'ghostwhite', 'gold', 'goldenrod', 'gray', 'green', 'greenyellow', 'grey', 'honeydew', 'hotpink', 'indianred', 'indigo', 'ivory', 'khaki', 'lavender', 'lavenderblush', 'lawngreen', 'lemonchiffon', 'lightblue', 'lightcoral', 'lightcyan', 'lightgoldenrodyellow', 'lightgray', 'lightgreen', 'lightgrey', 'lightpink', 'lightsalmon', 'lightseagreen', 'lightskyblue', 'lightslategray', 'lightslategrey', 'lightsteelblue', 'lightyellow', 'lime', 'limegreen', 'linen', 'magenta', 'maroon', 'mediumaquamarine', 'mediumblue', 'mediumorchid', 'mediumpurple', 'mediumseagreen', 'mediumslateblue', 'mediumspringgreen', 'mediumturquoise', 'mediumvioletred', 'midnightblue', 'mintcream', 'mistyrose', 'moccasin', 'navajowhite', 'navy', 'oldlace', 'olive', 'olivedrab', 'orange', 'orangered', 'orchid', 'palegoldenrod', 'palegreen', 'paleturquoise', 'palevioletred', 'papayawhip', 'peachpuff', 'peru', 'pink', 'plum', 'powderblue', 'purple', 'red', 'rosybrown', 'royalblue', 'saddlebrown', 'salmon', 'sandybrown', 'seagreen', 'seashell', 'sienna', 'silver', 'skyblue', 'slateblue', 'slategray', 'slategrey', 'snow', 'springgreen', 'steelblue', 'tan', 'teal', 'thistle', 'tomato', 'transparent', 'turquoise', 'violet', 'wheat', 'white', 'whitesmoke', 'yellow', 'yellowgreen'];

      var hex = function hex(value) {
        return /(^#[0-9A-F]{6}$)|(^#[0-9A-F]{3}$)/i.test(value);
      };

      var hsl = function hsl(value) {
        return /^hsl\((\s*(-?\d+)\s*,)(\s*(\b(0?\d{1,2}|100)\b%)\s*,)(\s*(\b(0?\d{1,2}|100)\b%)\s*)\)$/.test(value);
      };

      var hsla = function hsla(value) {
        return /^hsla\((\s*(-?\d+)\s*,)(\s*(\b(0?\d{1,2}|100)\b%)\s*,){2}(\s*(0?(\.\d+)?|1(\.0+)?)\s*)\)$/.test(value);
      };

      var keyword = function keyword(value) {
        return KEYWORD_COLORS.indexOf(value) >= 0;
      };

      var rgb = function rgb(value) {
        return /^rgb\((\s*(\b([01]?\d{1,2}|2[0-4]\d|25[0-5])\b)\s*,){2}(\s*(\b([01]?\d{1,2}|2[0-4]\d|25[0-5])\b)\s*)\)$/.test(value) || /^rgb\((\s*(\b(0?\d{1,2}|100)\b%)\s*,){2}(\s*(\b(0?\d{1,2}|100)\b%)\s*)\)$/.test(value);
      };

      var rgba = function rgba(value) {
        return /^rgba\((\s*(\b([01]?\d{1,2}|2[0-4]\d|25[0-5])\b)\s*,){3}(\s*(0?(\.\d+)?|1(\.0+)?)\s*)\)$/.test(value) || /^rgba\((\s*(\b(0?\d{1,2}|100)\b%)\s*,){3}(\s*(0?(\.\d+)?|1(\.0+)?)\s*)\)$/.test(value);
      };

      return {
        validate: function validate(input) {
          if (input.value === '') {
            return {
              valid: true
            };
          }

          var types = typeof input.options.type === 'string' ? input.options.type.toString().replace(/s/g, '').split(',') : input.options.type || SUPPORTED_TYPES;
          var _iteratorNormalCompletion = true;
          var _didIteratorError = false;
          var _iteratorError = undefined;

          try {
            for (var _iterator = types[Symbol.iterator](), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
              var type = _step.value;
              var tpe = type.toLowerCase();

              if (SUPPORTED_TYPES.indexOf(tpe) === -1) {
                continue;
              }

              var result = true;

              switch (tpe) {
                case 'hex':
                  result = hex(input.value);
                  break;

                case 'hsl':
                  result = hsl(input.value);
                  break;

                case 'hsla':
                  result = hsla(input.value);
                  break;

                case 'keyword':
                  result = keyword(input.value);
                  break;

                case 'rgb':
                  result = rgb(input.value);
                  break;

                case 'rgba':
                  result = rgba(input.value);
                  break;
              }

              if (result) {
                return {
                  valid: true
                };
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

          return {
            valid: false
          };
        }
      };
    }

    function cusip() {
      return {
        validate: function validate(input) {
          if (input.value === '') {
            return {
              valid: true
            };
          }

          var v = input.value.toUpperCase();

          if (!/^[0-9A-Z]{9}$/.test(v)) {
            return {
              valid: false
            };
          }

          var converted = v.split('').map(function (item) {
            var code = item.charCodeAt(0);
            return code >= 'A'.charCodeAt(0) && code <= 'Z'.charCodeAt(0) ? code - 'A'.charCodeAt(0) + 10 + '' : item;
          });
          var length = converted.length;
          var sum = 0;

          for (var i = 0; i < length - 1; i++) {
            var num = parseInt(converted[i], 10);

            if (i % 2 !== 0) {
              num *= 2;
            }

            if (num > 9) {
              num -= 9;
            }

            sum += num;
          }

          sum = (10 - sum % 10) % 10;
          return {
            valid: sum === parseInt(converted[length - 1], 10)
          };
        }
      };
    }

    function ean() {
      return {
        validate: function validate(input) {
          if (input.value === '') {
            return {
              valid: true
            };
          }

          if (!/^(\d{8}|\d{12}|\d{13}|\d{14})$/.test(input.value)) {
            return {
              valid: false
            };
          }

          var length = input.value.length;
          var sum = 0;
          var weight = length === 8 ? [3, 1] : [1, 3];

          for (var i = 0; i < length - 1; i++) {
            sum += parseInt(input.value.charAt(i), 10) * weight[i % 2];
          }

          sum = (10 - sum % 10) % 10;
          return {
            valid: "".concat(sum) === input.value.charAt(length - 1)
          };
        }
      };
    }

    function ein() {
      var CAMPUS = {
        ANDOVER: ['10', '12'],
        ATLANTA: ['60', '67'],
        AUSTIN: ['50', '53'],
        BROOKHAVEN: ['01', '02', '03', '04', '05', '06', '11', '13', '14', '16', '21', '22', '23', '25', '34', '51', '52', '54', '55', '56', '57', '58', '59', '65'],
        CINCINNATI: ['30', '32', '35', '36', '37', '38', '61'],
        FRESNO: ['15', '24'],
        INTERNET: ['20', '26', '27', '45', '46', '47'],
        KANSAS_CITY: ['40', '44'],
        MEMPHIS: ['94', '95'],
        OGDEN: ['80', '90'],
        PHILADELPHIA: ['33', '39', '41', '42', '43', '48', '62', '63', '64', '66', '68', '71', '72', '73', '74', '75', '76', '77', '81', '82', '83', '84', '85', '86', '87', '88', '91', '92', '93', '98', '99'],
        SMALL_BUSINESS_ADMINISTRATION: ['31']
      };
      return {
        validate: function validate(input) {
          if (input.value === '') {
            return {
              meta: null,
              valid: true
            };
          }

          if (!/^[0-9]{2}-?[0-9]{7}$/.test(input.value)) {
            return {
              meta: null,
              valid: false
            };
          }

          var campus = "".concat(input.value.substr(0, 2));

          for (var key in CAMPUS) {
            if (CAMPUS[key].indexOf(campus) !== -1) {
              return {
                meta: {
                  campus: key
                },
                valid: true
              };
            }
          }

          return {
            meta: null,
            valid: false
          };
        }
      };
    }

    function grid() {
      return {
        validate: function validate(input) {
          if (input.value === '') {
            return {
              valid: true
            };
          }

          var v = input.value.toUpperCase();

          if (!/^[GRID:]*([0-9A-Z]{2})[-\s]*([0-9A-Z]{5})[-\s]*([0-9A-Z]{10})[-\s]*([0-9A-Z]{1})$/g.test(v)) {
            return {
              valid: false
            };
          }

          v = v.replace(/\s/g, '').replace(/-/g, '');

          if ('GRID:' === v.substr(0, 5)) {
            v = v.substr(5);
          }

          return {
            valid: mod37And36(v)
          };
        }
      };
    }

    function hex() {
      return {
        validate: function validate(input) {
          return {
            valid: input.value === '' || /^[0-9a-fA-F]+$/.test(input.value)
          };
        }
      };
    }

    function iban() {
      var IBAN_PATTERNS = {
        AD: 'AD[0-9]{2}[0-9]{4}[0-9]{4}[A-Z0-9]{12}',
        AE: 'AE[0-9]{2}[0-9]{3}[0-9]{16}',
        AL: 'AL[0-9]{2}[0-9]{8}[A-Z0-9]{16}',
        AO: 'AO[0-9]{2}[0-9]{21}',
        AT: 'AT[0-9]{2}[0-9]{5}[0-9]{11}',
        AZ: 'AZ[0-9]{2}[A-Z]{4}[A-Z0-9]{20}',
        BA: 'BA[0-9]{2}[0-9]{3}[0-9]{3}[0-9]{8}[0-9]{2}',
        BE: 'BE[0-9]{2}[0-9]{3}[0-9]{7}[0-9]{2}',
        BF: 'BF[0-9]{2}[0-9]{23}',
        BG: 'BG[0-9]{2}[A-Z]{4}[0-9]{4}[0-9]{2}[A-Z0-9]{8}',
        BH: 'BH[0-9]{2}[A-Z]{4}[A-Z0-9]{14}',
        BI: 'BI[0-9]{2}[0-9]{12}',
        BJ: 'BJ[0-9]{2}[A-Z]{1}[0-9]{23}',
        BR: 'BR[0-9]{2}[0-9]{8}[0-9]{5}[0-9]{10}[A-Z][A-Z0-9]',
        CH: 'CH[0-9]{2}[0-9]{5}[A-Z0-9]{12}',
        CI: 'CI[0-9]{2}[A-Z]{1}[0-9]{23}',
        CM: 'CM[0-9]{2}[0-9]{23}',
        CR: 'CR[0-9]{2}[0-9][0-9]{3}[0-9]{14}',
        CV: 'CV[0-9]{2}[0-9]{21}',
        CY: 'CY[0-9]{2}[0-9]{3}[0-9]{5}[A-Z0-9]{16}',
        CZ: 'CZ[0-9]{2}[0-9]{20}',
        DE: 'DE[0-9]{2}[0-9]{8}[0-9]{10}',
        DK: 'DK[0-9]{2}[0-9]{14}',
        DO: 'DO[0-9]{2}[A-Z0-9]{4}[0-9]{20}',
        DZ: 'DZ[0-9]{2}[0-9]{20}',
        EE: 'EE[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{11}[0-9]{1}',
        ES: 'ES[0-9]{2}[0-9]{4}[0-9]{4}[0-9]{1}[0-9]{1}[0-9]{10}',
        FI: 'FI[0-9]{2}[0-9]{6}[0-9]{7}[0-9]{1}',
        FO: 'FO[0-9]{2}[0-9]{4}[0-9]{9}[0-9]{1}',
        FR: 'FR[0-9]{2}[0-9]{5}[0-9]{5}[A-Z0-9]{11}[0-9]{2}',
        GB: 'GB[0-9]{2}[A-Z]{4}[0-9]{6}[0-9]{8}',
        GE: 'GE[0-9]{2}[A-Z]{2}[0-9]{16}',
        GI: 'GI[0-9]{2}[A-Z]{4}[A-Z0-9]{15}',
        GL: 'GL[0-9]{2}[0-9]{4}[0-9]{9}[0-9]{1}',
        GR: 'GR[0-9]{2}[0-9]{3}[0-9]{4}[A-Z0-9]{16}',
        GT: 'GT[0-9]{2}[A-Z0-9]{4}[A-Z0-9]{20}',
        HR: 'HR[0-9]{2}[0-9]{7}[0-9]{10}',
        HU: 'HU[0-9]{2}[0-9]{3}[0-9]{4}[0-9]{1}[0-9]{15}[0-9]{1}',
        IE: 'IE[0-9]{2}[A-Z]{4}[0-9]{6}[0-9]{8}',
        IL: 'IL[0-9]{2}[0-9]{3}[0-9]{3}[0-9]{13}',
        IR: 'IR[0-9]{2}[0-9]{22}',
        IS: 'IS[0-9]{2}[0-9]{4}[0-9]{2}[0-9]{6}[0-9]{10}',
        IT: 'IT[0-9]{2}[A-Z]{1}[0-9]{5}[0-9]{5}[A-Z0-9]{12}',
        JO: 'JO[0-9]{2}[A-Z]{4}[0-9]{4}[0]{8}[A-Z0-9]{10}',
        KW: 'KW[0-9]{2}[A-Z]{4}[0-9]{22}',
        KZ: 'KZ[0-9]{2}[0-9]{3}[A-Z0-9]{13}',
        LB: 'LB[0-9]{2}[0-9]{4}[A-Z0-9]{20}',
        LI: 'LI[0-9]{2}[0-9]{5}[A-Z0-9]{12}',
        LT: 'LT[0-9]{2}[0-9]{5}[0-9]{11}',
        LU: 'LU[0-9]{2}[0-9]{3}[A-Z0-9]{13}',
        LV: 'LV[0-9]{2}[A-Z]{4}[A-Z0-9]{13}',
        MC: 'MC[0-9]{2}[0-9]{5}[0-9]{5}[A-Z0-9]{11}[0-9]{2}',
        MD: 'MD[0-9]{2}[A-Z0-9]{20}',
        ME: 'ME[0-9]{2}[0-9]{3}[0-9]{13}[0-9]{2}',
        MG: 'MG[0-9]{2}[0-9]{23}',
        MK: 'MK[0-9]{2}[0-9]{3}[A-Z0-9]{10}[0-9]{2}',
        ML: 'ML[0-9]{2}[A-Z]{1}[0-9]{23}',
        MR: 'MR13[0-9]{5}[0-9]{5}[0-9]{11}[0-9]{2}',
        MT: 'MT[0-9]{2}[A-Z]{4}[0-9]{5}[A-Z0-9]{18}',
        MU: 'MU[0-9]{2}[A-Z]{4}[0-9]{2}[0-9]{2}[0-9]{12}[0-9]{3}[A-Z]{3}',
        MZ: 'MZ[0-9]{2}[0-9]{21}',
        NL: 'NL[0-9]{2}[A-Z]{4}[0-9]{10}',
        NO: 'NO[0-9]{2}[0-9]{4}[0-9]{6}[0-9]{1}',
        PK: 'PK[0-9]{2}[A-Z]{4}[A-Z0-9]{16}',
        PL: 'PL[0-9]{2}[0-9]{8}[0-9]{16}',
        PS: 'PS[0-9]{2}[A-Z]{4}[A-Z0-9]{21}',
        PT: 'PT[0-9]{2}[0-9]{4}[0-9]{4}[0-9]{11}[0-9]{2}',
        QA: 'QA[0-9]{2}[A-Z]{4}[A-Z0-9]{21}',
        RO: 'RO[0-9]{2}[A-Z]{4}[A-Z0-9]{16}',
        RS: 'RS[0-9]{2}[0-9]{3}[0-9]{13}[0-9]{2}',
        SA: 'SA[0-9]{2}[0-9]{2}[A-Z0-9]{18}',
        SE: 'SE[0-9]{2}[0-9]{3}[0-9]{16}[0-9]{1}',
        SI: 'SI[0-9]{2}[0-9]{5}[0-9]{8}[0-9]{2}',
        SK: 'SK[0-9]{2}[0-9]{4}[0-9]{6}[0-9]{10}',
        SM: 'SM[0-9]{2}[A-Z]{1}[0-9]{5}[0-9]{5}[A-Z0-9]{12}',
        SN: 'SN[0-9]{2}[A-Z]{1}[0-9]{23}',
        TL: 'TL38[0-9]{3}[0-9]{14}[0-9]{2}',
        TN: 'TN59[0-9]{2}[0-9]{3}[0-9]{13}[0-9]{2}',
        TR: 'TR[0-9]{2}[0-9]{5}[A-Z0-9]{1}[A-Z0-9]{16}',
        VG: 'VG[0-9]{2}[A-Z]{4}[0-9]{16}',
        XK: 'XK[0-9]{2}[0-9]{4}[0-9]{10}[0-9]{2}'
      };
      var SEPA_COUNTRIES = ['AT', 'BE', 'BG', 'CH', 'CY', 'CZ', 'DE', 'DK', 'EE', 'ES', 'FI', 'FR', 'GB', 'GI', 'GR', 'HR', 'HU', 'IE', 'IS', 'IT', 'LI', 'LT', 'LU', 'LV', 'MC', 'MT', 'NL', 'NO', 'PL', 'PT', 'RO', 'SE', 'SI', 'SK', 'SM'];
      return {
        validate: function validate(input) {
          if (input.value === '') {
            return {
              valid: true
            };
          }

          var opts = Object.assign({}, {
            message: ''
          }, input.options);
          var v = input.value.replace(/[^a-zA-Z0-9]/g, '').toUpperCase();
          var country = opts.country || v.substr(0, 2);

          if (!IBAN_PATTERNS[country]) {
            return {
              message: opts.message,
              valid: false
            };
          }

          if (opts.sepa !== undefined) {
            var isSepaCountry = SEPA_COUNTRIES.indexOf(country) !== -1;

            if ((opts.sepa === 'true' || opts.sepa === true) && !isSepaCountry || (opts.sepa === 'false' || opts.sepa === false) && isSepaCountry) {
              return {
                message: opts.message,
                valid: false
              };
            }
          }

          var msg = format(input.l10n ? opts.message || input.l10n.iban.country : opts.message, input.l10n ? input.l10n.iban.countries[country] : country);

          if (!new RegExp("^".concat(IBAN_PATTERNS[country], "$")).test(input.value)) {
            return {
              message: msg,
              valid: false
            };
          }

          v = "".concat(v.substr(4)).concat(v.substr(0, 4));
          v = v.split('').map(function (n) {
            var code = n.charCodeAt(0);
            return code >= 'A'.charCodeAt(0) && code <= 'Z'.charCodeAt(0) ? code - 'A'.charCodeAt(0) + 10 : n;
          }).join('');
          var temp = parseInt(v.substr(0, 1), 10);
          var length = v.length;

          for (var i = 1; i < length; ++i) {
            temp = (temp * 10 + parseInt(v.substr(i, 1), 10)) % 97;
          }

          return {
            message: msg,
            valid: temp === 1
          };
        }
      };
    }

    function arId(value) {
      var v = value.replace(/\./g, '');
      return {
        meta: {},
        valid: /^\d{7,8}$/.test(v)
      };
    }

    function jmbg(value, countryCode) {
      if (!/^\d{13}$/.test(value)) {
        return false;
      }

      var day = parseInt(value.substr(0, 2), 10);
      var month = parseInt(value.substr(2, 2), 10);
      var rr = parseInt(value.substr(7, 2), 10);
      var k = parseInt(value.substr(12, 1), 10);

      if (day > 31 || month > 12) {
        return false;
      }

      var sum = 0;

      for (var i = 0; i < 6; i++) {
        sum += (7 - i) * (parseInt(value.charAt(i), 10) + parseInt(value.charAt(i + 6), 10));
      }

      sum = 11 - sum % 11;

      if (sum === 10 || sum === 11) {
        sum = 0;
      }

      if (sum !== k) {
        return false;
      }

      switch (countryCode.toUpperCase()) {
        case 'BA':
          return 10 <= rr && rr <= 19;

        case 'MK':
          return 41 <= rr && rr <= 49;

        case 'ME':
          return 20 <= rr && rr <= 29;

        case 'RS':
          return 70 <= rr && rr <= 99;

        case 'SI':
          return 50 <= rr && rr <= 59;

        default:
          return true;
      }
    }

    function baId(value) {
      return {
        meta: {},
        valid: jmbg(value, 'BA')
      };
    }

    function bgId(value) {
      if (!/^\d{10}$/.test(value) && !/^\d{6}\s\d{3}\s\d{1}$/.test(value)) {
        return {
          meta: {},
          valid: false
        };
      }

      var v = value.replace(/\s/g, '');
      var year = parseInt(v.substr(0, 2), 10) + 1900;
      var month = parseInt(v.substr(2, 2), 10);
      var day = parseInt(v.substr(4, 2), 10);

      if (month > 40) {
        year += 100;
        month -= 40;
      } else if (month > 20) {
        year -= 100;
        month -= 20;
      }

      if (!isValidDate(year, month, day)) {
        return {
          meta: {},
          valid: false
        };
      }

      var sum = 0;
      var weight = [2, 4, 8, 5, 10, 9, 7, 3, 6];

      for (var i = 0; i < 9; i++) {
        sum += parseInt(v.charAt(i), 10) * weight[i];
      }

      sum = sum % 11 % 10;
      return {
        meta: {},
        valid: "".concat(sum) === v.substr(9, 1)
      };
    }

    function brId(value) {
      var v = value.replace(/\D/g, '');

      if (!/^\d{11}$/.test(v) || /^1{11}|2{11}|3{11}|4{11}|5{11}|6{11}|7{11}|8{11}|9{11}|0{11}$/.test(v)) {
        return {
          meta: {},
          valid: false
        };
      }

      var d1 = 0;
      var i;

      for (i = 0; i < 9; i++) {
        d1 += (10 - i) * parseInt(v.charAt(i), 10);
      }

      d1 = 11 - d1 % 11;

      if (d1 === 10 || d1 === 11) {
        d1 = 0;
      }

      if ("".concat(d1) !== v.charAt(9)) {
        return {
          meta: {},
          valid: false
        };
      }

      var d2 = 0;

      for (i = 0; i < 10; i++) {
        d2 += (11 - i) * parseInt(v.charAt(i), 10);
      }

      d2 = 11 - d2 % 11;

      if (d2 === 10 || d2 === 11) {
        d2 = 0;
      }

      return {
        meta: {},
        valid: "".concat(d2) === v.charAt(10)
      };
    }

    function chId(value) {
      if (!/^756[\.]{0,1}[0-9]{4}[\.]{0,1}[0-9]{4}[\.]{0,1}[0-9]{2}$/.test(value)) {
        return {
          meta: {},
          valid: false
        };
      }

      var v = value.replace(/\D/g, '').substr(3);
      var length = v.length;
      var weight = length === 8 ? [3, 1] : [1, 3];
      var sum = 0;

      for (var i = 0; i < length - 1; i++) {
        sum += parseInt(v.charAt(i), 10) * weight[i % 2];
      }

      sum = 10 - sum % 10;
      return {
        meta: {},
        valid: "".concat(sum) === v.charAt(length - 1)
      };
    }

    function clId(value) {
      if (!/^\d{7,8}[-]{0,1}[0-9K]$/i.test(value)) {
        return {
          meta: {},
          valid: false
        };
      }

      var v = value.replace(/\-/g, '');

      while (v.length < 9) {
        v = "0".concat(v);
      }

      var weight = [3, 2, 7, 6, 5, 4, 3, 2];
      var sum = 0;

      for (var i = 0; i < 8; i++) {
        sum += parseInt(v.charAt(i), 10) * weight[i];
      }

      sum = 11 - sum % 11;
      var cd = "".concat(sum);

      if (sum === 11) {
        cd = '0';
      } else if (sum === 10) {
        cd = 'K';
      }

      return {
        meta: {},
        valid: cd === v.charAt(8).toUpperCase()
      };
    }

    function cnId(value) {
      var v = value.trim();

      if (!/^\d{15}$/.test(v) && !/^\d{17}[\dXx]{1}$/.test(v)) {
        return {
          meta: {},
          valid: false
        };
      }

      var adminDivisionCodes = {
        11: {
          0: [0],
          1: [[0, 9], [11, 17]],
          2: [0, 28, 29]
        },
        12: {
          0: [0],
          1: [[0, 16]],
          2: [0, 21, 23, 25]
        },
        13: {
          0: [0],
          1: [[0, 5], 7, 8, 21, [23, 33], [81, 85]],
          2: [[0, 5], [7, 9], [23, 25], 27, 29, 30, 81, 83],
          3: [[0, 4], [21, 24]],
          4: [[0, 4], 6, 21, [23, 35], 81],
          5: [[0, 3], [21, 35], 81, 82],
          6: [[0, 4], [21, 38], [81, 84]],
          7: [[0, 3], 5, 6, [21, 33]],
          8: [[0, 4], [21, 28]],
          9: [[0, 3], [21, 30], [81, 84]],
          10: [[0, 3], [22, 26], 28, 81, 82],
          11: [[0, 2], [21, 28], 81, 82]
        },
        14: {
          0: [0],
          1: [0, 1, [5, 10], [21, 23], 81],
          2: [[0, 3], 11, 12, [21, 27]],
          3: [[0, 3], 11, 21, 22],
          4: [[0, 2], 11, 21, [23, 31], 81],
          5: [[0, 2], 21, 22, 24, 25, 81],
          6: [[0, 3], [21, 24]],
          7: [[0, 2], [21, 29], 81],
          8: [[0, 2], [21, 30], 81, 82],
          9: [[0, 2], [21, 32], 81],
          10: [[0, 2], [21, 34], 81, 82],
          11: [[0, 2], [21, 30], 81, 82],
          23: [[0, 3], 22, 23, [25, 30], 32, 33]
        },
        15: {
          0: [0],
          1: [[0, 5], [21, 25]],
          2: [[0, 7], [21, 23]],
          3: [[0, 4]],
          4: [[0, 4], [21, 26], [28, 30]],
          5: [[0, 2], [21, 26], 81],
          6: [[0, 2], [21, 27]],
          7: [[0, 3], [21, 27], [81, 85]],
          8: [[0, 2], [21, 26]],
          9: [[0, 2], [21, 29], 81],
          22: [[0, 2], [21, 24]],
          25: [[0, 2], [22, 31]],
          26: [[0, 2], [24, 27], [29, 32], 34],
          28: [0, 1, [22, 27]],
          29: [0, [21, 23]]
        },
        21: {
          0: [0],
          1: [[0, 6], [11, 14], [22, 24], 81],
          2: [[0, 4], [11, 13], 24, [81, 83]],
          3: [[0, 4], 11, 21, 23, 81],
          4: [[0, 4], 11, [21, 23]],
          5: [[0, 5], 21, 22],
          6: [[0, 4], 24, 81, 82],
          7: [[0, 3], 11, 26, 27, 81, 82],
          8: [[0, 4], 11, 81, 82],
          9: [[0, 5], 11, 21, 22],
          10: [[0, 5], 11, 21, 81],
          11: [[0, 3], 21, 22],
          12: [[0, 2], 4, 21, 23, 24, 81, 82],
          13: [[0, 3], 21, 22, 24, 81, 82],
          14: [[0, 4], 21, 22, 81]
        },
        22: {
          0: [0],
          1: [[0, 6], 12, 22, [81, 83]],
          2: [[0, 4], 11, 21, [81, 84]],
          3: [[0, 3], 22, 23, 81, 82],
          4: [[0, 3], 21, 22],
          5: [[0, 3], 21, 23, 24, 81, 82],
          6: [[0, 2], 4, 5, [21, 23], 25, 81],
          7: [[0, 2], [21, 24], 81],
          8: [[0, 2], 21, 22, 81, 82],
          24: [[0, 6], 24, 26]
        },
        23: {
          0: [0],
          1: [[0, 12], 21, [23, 29], [81, 84]],
          2: [[0, 8], 21, [23, 25], 27, [29, 31], 81],
          3: [[0, 7], 21, 81, 82],
          4: [[0, 7], 21, 22],
          5: [[0, 3], 5, 6, [21, 24]],
          6: [[0, 6], [21, 24]],
          7: [[0, 16], 22, 81],
          8: [[0, 5], 11, 22, 26, 28, 33, 81, 82],
          9: [[0, 4], 21],
          10: [[0, 5], 24, 25, 81, [83, 85]],
          11: [[0, 2], 21, 23, 24, 81, 82],
          12: [[0, 2], [21, 26], [81, 83]],
          27: [[0, 4], [21, 23]]
        },
        31: {
          0: [0],
          1: [0, 1, [3, 10], [12, 20]],
          2: [0, 30]
        },
        32: {
          0: [0],
          1: [[0, 7], 11, [13, 18], 24, 25],
          2: [[0, 6], 11, 81, 82],
          3: [[0, 5], 11, 12, [21, 24], 81, 82],
          4: [[0, 2], 4, 5, 11, 12, 81, 82],
          5: [[0, 9], [81, 85]],
          6: [[0, 2], 11, 12, 21, 23, [81, 84]],
          7: [0, 1, 3, 5, 6, [21, 24]],
          8: [[0, 4], 11, 26, [29, 31]],
          9: [[0, 3], [21, 25], 28, 81, 82],
          10: [[0, 3], 11, 12, 23, 81, 84, 88],
          11: [[0, 2], 11, 12, [81, 83]],
          12: [[0, 4], [81, 84]],
          13: [[0, 2], 11, [21, 24]]
        },
        33: {
          0: [0],
          1: [[0, 6], [8, 10], 22, 27, 82, 83, 85],
          2: [0, 1, [3, 6], 11, 12, 25, 26, [81, 83]],
          3: [[0, 4], 22, 24, [26, 29], 81, 82],
          4: [[0, 2], 11, 21, 24, [81, 83]],
          5: [[0, 3], [21, 23]],
          6: [[0, 2], 21, 24, [81, 83]],
          7: [[0, 3], 23, 26, 27, [81, 84]],
          8: [[0, 3], 22, 24, 25, 81],
          9: [[0, 3], 21, 22],
          10: [[0, 4], [21, 24], 81, 82],
          11: [[0, 2], [21, 27], 81]
        },
        34: {
          0: [0],
          1: [[0, 4], 11, [21, 24], 81],
          2: [[0, 4], 7, 8, [21, 23], 25],
          3: [[0, 4], 11, [21, 23]],
          4: [[0, 6], 21],
          5: [[0, 4], 6, [21, 23]],
          6: [[0, 4], 21],
          7: [[0, 3], 11, 21],
          8: [[0, 3], 11, [22, 28], 81],
          10: [[0, 4], [21, 24]],
          11: [[0, 3], 22, [24, 26], 81, 82],
          12: [[0, 4], 21, 22, 25, 26, 82],
          13: [[0, 2], [21, 24]],
          14: [[0, 2], [21, 24]],
          15: [[0, 3], [21, 25]],
          16: [[0, 2], [21, 23]],
          17: [[0, 2], [21, 23]],
          18: [[0, 2], [21, 25], 81]
        },
        35: {
          0: [0],
          1: [[0, 5], 11, [21, 25], 28, 81, 82],
          2: [[0, 6], [11, 13]],
          3: [[0, 5], 22],
          4: [[0, 3], 21, [23, 30], 81],
          5: [[0, 5], 21, [24, 27], [81, 83]],
          6: [[0, 3], [22, 29], 81],
          7: [[0, 2], [21, 25], [81, 84]],
          8: [[0, 2], [21, 25], 81],
          9: [[0, 2], [21, 26], 81, 82]
        },
        36: {
          0: [0],
          1: [[0, 5], 11, [21, 24]],
          2: [[0, 3], 22, 81],
          3: [[0, 2], 13, [21, 23]],
          4: [[0, 3], 21, [23, 30], 81, 82],
          5: [[0, 2], 21],
          6: [[0, 2], 22, 81],
          7: [[0, 2], [21, 35], 81, 82],
          8: [[0, 3], [21, 30], 81],
          9: [[0, 2], [21, 26], [81, 83]],
          10: [[0, 2], [21, 30]],
          11: [[0, 2], [21, 30], 81]
        },
        37: {
          0: [0],
          1: [[0, 5], 12, 13, [24, 26], 81],
          2: [[0, 3], 5, [11, 14], [81, 85]],
          3: [[0, 6], [21, 23]],
          4: [[0, 6], 81],
          5: [[0, 3], [21, 23]],
          6: [[0, 2], [11, 13], 34, [81, 87]],
          7: [[0, 5], 24, 25, [81, 86]],
          8: [[0, 2], 11, [26, 32], [81, 83]],
          9: [[0, 3], 11, 21, 23, 82, 83],
          10: [[0, 2], [81, 83]],
          11: [[0, 3], 21, 22],
          12: [[0, 3]],
          13: [[0, 2], 11, 12, [21, 29]],
          14: [[0, 2], [21, 28], 81, 82],
          15: [[0, 2], [21, 26], 81],
          16: [[0, 2], [21, 26]],
          17: [[0, 2], [21, 28]]
        },
        41: {
          0: [0],
          1: [[0, 6], 8, 22, [81, 85]],
          2: [[0, 5], 11, [21, 25]],
          3: [[0, 7], 11, [22, 29], 81],
          4: [[0, 4], 11, [21, 23], 25, 81, 82],
          5: [[0, 3], 5, 6, 22, 23, 26, 27, 81],
          6: [[0, 3], 11, 21, 22],
          7: [[0, 4], 11, 21, [24, 28], 81, 82],
          8: [[0, 4], 11, [21, 23], 25, [81, 83]],
          9: [[0, 2], 22, 23, [26, 28]],
          10: [[0, 2], [23, 25], 81, 82],
          11: [[0, 4], [21, 23]],
          12: [[0, 2], 21, 22, 24, 81, 82],
          13: [[0, 3], [21, 30], 81],
          14: [[0, 3], [21, 26], 81],
          15: [[0, 3], [21, 28]],
          16: [[0, 2], [21, 28], 81],
          17: [[0, 2], [21, 29]],
          90: [0, 1]
        },
        42: {
          0: [0],
          1: [[0, 7], [11, 17]],
          2: [[0, 5], 22, 81],
          3: [[0, 3], [21, 25], 81],
          5: [[0, 6], [25, 29], [81, 83]],
          6: [[0, 2], 6, 7, [24, 26], [82, 84]],
          7: [[0, 4]],
          8: [[0, 2], 4, 21, 22, 81],
          9: [[0, 2], [21, 23], 81, 82, 84],
          10: [[0, 3], [22, 24], 81, 83, 87],
          11: [[0, 2], [21, 27], 81, 82],
          12: [[0, 2], [21, 24], 81],
          13: [[0, 3], 21, 81],
          28: [[0, 2], 22, 23, [25, 28]],
          90: [0, [4, 6], 21]
        },
        43: {
          0: [0],
          1: [[0, 5], 11, 12, 21, 22, 24, 81],
          2: [[0, 4], 11, 21, [23, 25], 81],
          3: [[0, 2], 4, 21, 81, 82],
          4: [0, 1, [5, 8], 12, [21, 24], 26, 81, 82],
          5: [[0, 3], 11, [21, 25], [27, 29], 81],
          6: [[0, 3], 11, 21, 23, 24, 26, 81, 82],
          7: [[0, 3], [21, 26], 81],
          8: [[0, 2], 11, 21, 22],
          9: [[0, 3], [21, 23], 81],
          10: [[0, 3], [21, 28], 81],
          11: [[0, 3], [21, 29]],
          12: [[0, 2], [21, 30], 81],
          13: [[0, 2], 21, 22, 81, 82],
          31: [0, 1, [22, 27], 30]
        },
        44: {
          0: [0],
          1: [[0, 7], [11, 16], 83, 84],
          2: [[0, 5], 21, 22, 24, 29, 32, 33, 81, 82],
          3: [0, 1, [3, 8]],
          4: [[0, 4]],
          5: [0, 1, [6, 15], 23, 82, 83],
          6: [0, 1, [4, 8]],
          7: [0, 1, [3, 5], 81, [83, 85]],
          8: [[0, 4], 11, 23, 25, [81, 83]],
          9: [[0, 3], 23, [81, 83]],
          12: [[0, 3], [23, 26], 83, 84],
          13: [[0, 3], [22, 24], 81],
          14: [[0, 2], [21, 24], 26, 27, 81],
          15: [[0, 2], 21, 23, 81],
          16: [[0, 2], [21, 25]],
          17: [[0, 2], 21, 23, 81],
          18: [[0, 3], 21, 23, [25, 27], 81, 82],
          19: [0],
          20: [0],
          51: [[0, 3], 21, 22],
          52: [[0, 3], 21, 22, 24, 81],
          53: [[0, 2], [21, 23], 81]
        },
        45: {
          0: [0],
          1: [[0, 9], [21, 27]],
          2: [[0, 5], [21, 26]],
          3: [[0, 5], 11, 12, [21, 32]],
          4: [0, 1, [3, 6], 11, [21, 23], 81],
          5: [[0, 3], 12, 21],
          6: [[0, 3], 21, 81],
          7: [[0, 3], 21, 22],
          8: [[0, 4], 21, 81],
          9: [[0, 3], [21, 24], 81],
          10: [[0, 2], [21, 31]],
          11: [[0, 2], [21, 23]],
          12: [[0, 2], [21, 29], 81],
          13: [[0, 2], [21, 24], 81],
          14: [[0, 2], [21, 25], 81]
        },
        46: {
          0: [0],
          1: [0, 1, [5, 8]],
          2: [0, 1],
          3: [0, [21, 23]],
          90: [[0, 3], [5, 7], [21, 39]]
        },
        50: {
          0: [0],
          1: [[0, 19]],
          2: [0, [22, 38], [40, 43]],
          3: [0, [81, 84]]
        },
        51: {
          0: [0],
          1: [0, 1, [4, 8], [12, 15], [21, 24], 29, 31, 32, [81, 84]],
          3: [[0, 4], 11, 21, 22],
          4: [[0, 3], 11, 21, 22],
          5: [[0, 4], 21, 22, 24, 25],
          6: [0, 1, 3, 23, 26, [81, 83]],
          7: [0, 1, 3, 4, [22, 27], 81],
          8: [[0, 2], 11, 12, [21, 24]],
          9: [[0, 4], [21, 23]],
          10: [[0, 2], 11, 24, 25, 28],
          11: [[0, 2], [11, 13], 23, 24, 26, 29, 32, 33, 81],
          13: [[0, 4], [21, 25], 81],
          14: [[0, 2], [21, 25]],
          15: [[0, 3], [21, 29]],
          16: [[0, 3], [21, 23], 81],
          17: [[0, 3], [21, 25], 81],
          18: [[0, 3], [21, 27]],
          19: [[0, 3], [21, 23]],
          20: [[0, 2], 21, 22, 81],
          32: [0, [21, 33]],
          33: [0, [21, 38]],
          34: [0, 1, [22, 37]]
        },
        52: {
          0: [0],
          1: [[0, 3], [11, 15], [21, 23], 81],
          2: [0, 1, 3, 21, 22],
          3: [[0, 3], [21, 30], 81, 82],
          4: [[0, 2], [21, 25]],
          5: [[0, 2], [21, 27]],
          6: [[0, 3], [21, 28]],
          22: [0, 1, [22, 30]],
          23: [0, 1, [22, 28]],
          24: [0, 1, [22, 28]],
          26: [0, 1, [22, 36]],
          27: [[0, 2], 22, 23, [25, 32]]
        },
        53: {
          0: [0],
          1: [[0, 3], [11, 14], 21, 22, [24, 29], 81],
          3: [[0, 2], [21, 26], 28, 81],
          4: [[0, 2], [21, 28]],
          5: [[0, 2], [21, 24]],
          6: [[0, 2], [21, 30]],
          7: [[0, 2], [21, 24]],
          8: [[0, 2], [21, 29]],
          9: [[0, 2], [21, 27]],
          23: [0, 1, [22, 29], 31],
          25: [[0, 4], [22, 32]],
          26: [0, 1, [21, 28]],
          27: [0, 1, [22, 30]],
          28: [0, 1, 22, 23],
          29: [0, 1, [22, 32]],
          31: [0, 2, 3, [22, 24]],
          34: [0, [21, 23]],
          33: [0, 21, [23, 25]],
          35: [0, [21, 28]]
        },
        54: {
          0: [0],
          1: [[0, 2], [21, 27]],
          21: [0, [21, 29], 32, 33],
          22: [0, [21, 29], [31, 33]],
          23: [0, 1, [22, 38]],
          24: [0, [21, 31]],
          25: [0, [21, 27]],
          26: [0, [21, 27]]
        },
        61: {
          0: [0],
          1: [[0, 4], [11, 16], 22, [24, 26]],
          2: [[0, 4], 22],
          3: [[0, 4], [21, 24], [26, 31]],
          4: [[0, 4], [22, 31], 81],
          5: [[0, 2], [21, 28], 81, 82],
          6: [[0, 2], [21, 32]],
          7: [[0, 2], [21, 30]],
          8: [[0, 2], [21, 31]],
          9: [[0, 2], [21, 29]],
          10: [[0, 2], [21, 26]]
        },
        62: {
          0: [0],
          1: [[0, 5], 11, [21, 23]],
          2: [0, 1],
          3: [[0, 2], 21],
          4: [[0, 3], [21, 23]],
          5: [[0, 3], [21, 25]],
          6: [[0, 2], [21, 23]],
          7: [[0, 2], [21, 25]],
          8: [[0, 2], [21, 26]],
          9: [[0, 2], [21, 24], 81, 82],
          10: [[0, 2], [21, 27]],
          11: [[0, 2], [21, 26]],
          12: [[0, 2], [21, 28]],
          24: [0, 21, [24, 29]],
          26: [0, 21, [23, 30]],
          29: [0, 1, [21, 27]],
          30: [0, 1, [21, 27]]
        },
        63: {
          0: [0],
          1: [[0, 5], [21, 23]],
          2: [0, 2, [21, 25]],
          21: [0, [21, 23], [26, 28]],
          22: [0, [21, 24]],
          23: [0, [21, 24]],
          25: [0, [21, 25]],
          26: [0, [21, 26]],
          27: [0, 1, [21, 26]],
          28: [[0, 2], [21, 23]]
        },
        64: {
          0: [0],
          1: [0, 1, [4, 6], 21, 22, 81],
          2: [[0, 3], 5, [21, 23]],
          3: [[0, 3], [21, 24], 81],
          4: [[0, 2], [21, 25]],
          5: [[0, 2], 21, 22]
        },
        65: {
          0: [0],
          1: [[0, 9], 21],
          2: [[0, 5]],
          21: [0, 1, 22, 23],
          22: [0, 1, 22, 23],
          23: [[0, 3], [23, 25], 27, 28],
          28: [0, 1, [22, 29]],
          29: [0, 1, [22, 29]],
          30: [0, 1, [22, 24]],
          31: [0, 1, [21, 31]],
          32: [0, 1, [21, 27]],
          40: [0, 2, 3, [21, 28]],
          42: [[0, 2], 21, [23, 26]],
          43: [0, 1, [21, 26]],
          90: [[0, 4]],
          27: [[0, 2], 22, 23]
        },
        71: {
          0: [0]
        },
        81: {
          0: [0]
        },
        82: {
          0: [0]
        }
      };
      var provincial = parseInt(v.substr(0, 2), 10);
      var prefectural = parseInt(v.substr(2, 2), 10);
      var county = parseInt(v.substr(4, 2), 10);

      if (!adminDivisionCodes[provincial] || !adminDivisionCodes[provincial][prefectural]) {
        return {
          meta: {},
          valid: false
        };
      }

      var inRange = false;
      var rangeDef = adminDivisionCodes[provincial][prefectural];
      var i;

      for (i = 0; i < rangeDef.length; i++) {
        if (Array.isArray(rangeDef[i]) && rangeDef[i][0] <= county && county <= rangeDef[i][1] || !Array.isArray(rangeDef[i]) && county === rangeDef[i]) {
          inRange = true;
          break;
        }
      }

      if (!inRange) {
        return {
          meta: {},
          valid: false
        };
      }

      var dob;

      if (v.length === 18) {
        dob = v.substr(6, 8);
      } else {
        dob = "19".concat(v.substr(6, 6));
      }

      var year = parseInt(dob.substr(0, 4), 10);
      var month = parseInt(dob.substr(4, 2), 10);
      var day = parseInt(dob.substr(6, 2), 10);

      if (!isValidDate(year, month, day)) {
        return {
          meta: {},
          valid: false
        };
      }

      if (v.length === 18) {
        var weight = [7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2];
        var sum = 0;

        for (i = 0; i < 17; i++) {
          sum += parseInt(v.charAt(i), 10) * weight[i];
        }

        sum = (12 - sum % 11) % 11;
        var checksum = v.charAt(17).toUpperCase() !== 'X' ? parseInt(v.charAt(17), 10) : 10;
        return {
          meta: {},
          valid: checksum === sum
        };
      }

      return {
        meta: {},
        valid: true
      };
    }

    function coId(value) {
      var v = value.replace(/\./g, '').replace('-', '');

      if (!/^\d{8,16}$/.test(v)) {
        return {
          meta: {},
          valid: false
        };
      }

      var length = v.length;
      var weight = [3, 7, 13, 17, 19, 23, 29, 37, 41, 43, 47, 53, 59, 67, 71];
      var sum = 0;

      for (var i = length - 2; i >= 0; i--) {
        sum += parseInt(v.charAt(i), 10) * weight[i];
      }

      sum = sum % 11;

      if (sum >= 2) {
        sum = 11 - sum;
      }

      return {
        meta: {},
        valid: "".concat(sum) === v.substr(length - 1)
      };
    }

    function czId(value) {
      if (!/^\d{9,10}$/.test(value)) {
        return {
          meta: {},
          valid: false
        };
      }

      var year = 1900 + parseInt(value.substr(0, 2), 10);
      var month = parseInt(value.substr(2, 2), 10) % 50 % 20;
      var day = parseInt(value.substr(4, 2), 10);

      if (value.length === 9) {
        if (year >= 1980) {
          year -= 100;
        }

        if (year > 1953) {
          return {
            meta: {},
            valid: false
          };
        }
      } else if (year < 1954) {
        year += 100;
      }

      if (!isValidDate(year, month, day)) {
        return {
          meta: {},
          valid: false
        };
      }

      if (value.length === 10) {
        var check = parseInt(value.substr(0, 9), 10) % 11;

        if (year < 1985) {
          check = check % 10;
        }

        return {
          meta: {},
          valid: "".concat(check) === value.substr(9, 1)
        };
      }

      return {
        meta: {},
        valid: true
      };
    }

    function dkId(value) {
      if (!/^[0-9]{6}[-]{0,1}[0-9]{4}$/.test(value)) {
        return {
          meta: {},
          valid: false
        };
      }

      var v = value.replace(/-/g, '');
      var day = parseInt(v.substr(0, 2), 10);
      var month = parseInt(v.substr(2, 2), 10);
      var year = parseInt(v.substr(4, 2), 10);

      switch (true) {
        case '5678'.indexOf(v.charAt(6)) !== -1 && year >= 58:
          year += 1800;
          break;

        case '0123'.indexOf(v.charAt(6)) !== -1:
        case '49'.indexOf(v.charAt(6)) !== -1 && year >= 37:
          year += 1900;
          break;

        default:
          year += 2000;
          break;
      }

      return {
        meta: {},
        valid: isValidDate(year, month, day)
      };
    }

    function esId(value) {
      var isDNI = /^[0-9]{8}[-]{0,1}[A-HJ-NP-TV-Z]$/.test(value);
      var isNIE = /^[XYZ][-]{0,1}[0-9]{7}[-]{0,1}[A-HJ-NP-TV-Z]$/.test(value);
      var isCIF = /^[A-HNPQS][-]{0,1}[0-9]{7}[-]{0,1}[0-9A-J]$/.test(value);

      if (!isDNI && !isNIE && !isCIF) {
        return {
          meta: {},
          valid: false
        };
      }

      var v = value.replace(/-/g, '');
      var check;
      var tpe;
      var isValid = true;

      if (isDNI || isNIE) {
        tpe = 'DNI';
        var index = 'XYZ'.indexOf(v.charAt(0));

        if (index !== -1) {
          v = index + v.substr(1) + '';
          tpe = 'NIE';
        }

        check = parseInt(v.substr(0, 8), 10);
        check = 'TRWAGMYFPDXBNJZSQVHLCKE'[check % 23];
        return {
          meta: {
            type: tpe
          },
          valid: check === v.substr(8, 1)
        };
      } else {
        check = v.substr(1, 7);
        tpe = 'CIF';
        var letter = v[0];
        var control = v.substr(-1);
        var sum = 0;

        for (var i = 0; i < check.length; i++) {
          if (i % 2 !== 0) {
            sum += parseInt(check[i], 10);
          } else {
            var tmp = '' + parseInt(check[i], 10) * 2;
            sum += parseInt(tmp[0], 10);

            if (tmp.length === 2) {
              sum += parseInt(tmp[1], 10);
            }
          }
        }

        var lastDigit = sum - Math.floor(sum / 10) * 10;

        if (lastDigit !== 0) {
          lastDigit = 10 - lastDigit;
        }

        if ('KQS'.indexOf(letter) !== -1) {
          isValid = control === 'JABCDEFGHI'[lastDigit];
        } else if ('ABEH'.indexOf(letter) !== -1) {
          isValid = control === '' + lastDigit;
        } else {
          isValid = control === '' + lastDigit || control === 'JABCDEFGHI'[lastDigit];
        }

        return {
          meta: {
            type: tpe
          },
          valid: isValid
        };
      }
    }

    function fiId(value) {
      if (!/^[0-9]{6}[-+A][0-9]{3}[0-9ABCDEFHJKLMNPRSTUVWXY]$/.test(value)) {
        return {
          meta: {},
          valid: false
        };
      }

      var day = parseInt(value.substr(0, 2), 10);
      var month = parseInt(value.substr(2, 2), 10);
      var year = parseInt(value.substr(4, 2), 10);
      var centuries = {
        '+': 1800,
        '-': 1900,
        'A': 2000
      };
      year = centuries[value.charAt(6)] + year;

      if (!isValidDate(year, month, day)) {
        return {
          meta: {},
          valid: false
        };
      }

      var individual = parseInt(value.substr(7, 3), 10);

      if (individual < 2) {
        return {
          meta: {},
          valid: false
        };
      }

      var n = parseInt(value.substr(0, 6) + value.substr(7, 3) + '', 10);
      return {
        meta: {},
        valid: '0123456789ABCDEFHJKLMNPRSTUVWXY'.charAt(n % 31) === value.charAt(10)
      };
    }

    function frId(value) {
      var v = value.toUpperCase();

      if (!/^(1|2)\d{2}\d{2}(\d{2}|\d[A-Z]|\d{3})\d{2,3}\d{3}\d{2}$/.test(v)) {
        return {
          meta: {},
          valid: false
        };
      }

      var cog = v.substr(5, 2);

      switch (true) {
        case /^\d{2}$/.test(cog):
          v = value;
          break;

        case cog === '2A':
          v = "".concat(value.substr(0, 5), "19").concat(value.substr(7));
          break;

        case cog === '2B':
          v = "".concat(value.substr(0, 5), "18").concat(value.substr(7));
          break;

        default:
          return {
            meta: {},
            valid: false
          };
      }

      var mod = 97 - parseInt(v.substr(0, 13), 10) % 97;
      var prefixWithZero = mod < 10 ? "0".concat(mod) : "".concat(mod);
      return {
        meta: {},
        valid: prefixWithZero === v.substr(13)
      };
    }

    function hkId(value) {
      var v = value.toUpperCase();

      if (!/^[A-MP-Z]{1,2}[0-9]{6}[0-9A]$/.test(v)) {
        return {
          meta: {},
          valid: false
        };
      }

      var alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
      var firstChar = v.charAt(0);
      var secondChar = v.charAt(1);
      var sum = 0;
      var digitParts = v;

      if (/^[A-Z]$/.test(secondChar)) {
        sum += 9 * (10 + alphabet.indexOf(firstChar));
        sum += 8 * (10 + alphabet.indexOf(secondChar));
        digitParts = v.substr(2);
      } else {
        sum += 9 * 36;
        sum += 8 * (10 + alphabet.indexOf(firstChar));
        digitParts = v.substr(1);
      }

      var length = digitParts.length;

      for (var i = 0; i < length - 1; i++) {
        sum += (7 - i) * parseInt(digitParts.charAt(i), 10);
      }

      var remaining = sum % 11;
      var checkDigit = remaining === 0 ? '0' : 11 - remaining === 10 ? 'A' : "".concat(11 - remaining);
      return {
        meta: {},
        valid: checkDigit === digitParts.charAt(length - 1)
      };
    }

    function hrId(value) {
      return {
        meta: {},
        valid: /^[0-9]{11}$/.test(value) && mod11And10(value)
      };
    }

    function idId(value) {
      if (!/^[2-9]\d{11}$/.test(value)) {
        return {
          meta: {},
          valid: false
        };
      }

      var converted = value.split("").map(function (item) {
        return parseInt(item, 10);
      });
      return {
        meta: {},
        valid: verhoeff(converted)
      };
    }

    function ieId(value) {
      if (!/^\d{7}[A-W][AHWTX]?$/.test(value)) {
        return {
          meta: {},
          valid: false
        };
      }

      var getCheckDigit = function getCheckDigit(v) {
        var input = v;

        while (input.length < 7) {
          input = "0".concat(input);
        }

        var alphabet = 'WABCDEFGHIJKLMNOPQRSTUV';
        var sum = 0;

        for (var i = 0; i < 7; i++) {
          sum += parseInt(input.charAt(i), 10) * (8 - i);
        }

        sum += 9 * alphabet.indexOf(input.substr(7));
        return alphabet[sum % 23];
      };

      var isValid = value.length === 9 && ('A' === value.charAt(8) || 'H' === value.charAt(8)) ? value.charAt(7) === getCheckDigit(value.substr(0, 7) + value.substr(8) + '') : value.charAt(7) === getCheckDigit(value.substr(0, 7));
      return {
        meta: {},
        valid: isValid
      };
    }

    function ilId(value) {
      if (!/^\d{1,9}$/.test(value)) {
        return {
          meta: {},
          valid: false
        };
      }

      return {
        meta: {},
        valid: luhn(value)
      };
    }

    function isId(value) {
      if (!/^[0-9]{6}[-]{0,1}[0-9]{4}$/.test(value)) {
        return {
          meta: {},
          valid: false
        };
      }

      var v = value.replace(/-/g, '');
      var day = parseInt(v.substr(0, 2), 10);
      var month = parseInt(v.substr(2, 2), 10);
      var year = parseInt(v.substr(4, 2), 10);
      var century = parseInt(v.charAt(9), 10);
      year = century === 9 ? 1900 + year : (20 + century) * 100 + year;

      if (!isValidDate(year, month, day, true)) {
        return {
          meta: {},
          valid: false
        };
      }

      var weight = [3, 2, 7, 6, 5, 4, 3, 2];
      var sum = 0;

      for (var i = 0; i < 8; i++) {
        sum += parseInt(v.charAt(i), 10) * weight[i];
      }

      sum = 11 - sum % 11;
      return {
        meta: {},
        valid: "".concat(sum) === v.charAt(8)
      };
    }

    function krId(value) {
      var v = value.replace('-', '');

      if (!/^\d{13}$/.test(v)) {
        return {
          meta: {},
          valid: false
        };
      }

      var sDigit = v.charAt(6);
      var year = parseInt(v.substr(0, 2), 10);
      var month = parseInt(v.substr(2, 2), 10);
      var day = parseInt(v.substr(4, 2), 10);

      switch (sDigit) {
        case '1':
        case '2':
        case '5':
        case '6':
          year += 1900;
          break;

        case '3':
        case '4':
        case '7':
        case '8':
          year += 2000;
          break;

        default:
          year += 1800;
          break;
      }

      if (!isValidDate(year, month, day)) {
        return {
          meta: {},
          valid: false
        };
      }

      var weight = [2, 3, 4, 5, 6, 7, 8, 9, 2, 3, 4, 5];
      var length = v.length;
      var sum = 0;

      for (var i = 0; i < length - 1; i++) {
        sum += weight[i] * parseInt(v.charAt(i), 10);
      }

      var checkDigit = (11 - sum % 11) % 10;
      return {
        meta: {},
        valid: "".concat(checkDigit) === v.charAt(length - 1)
      };
    }

    function ltId(value) {
      if (!/^[0-9]{11}$/.test(value)) {
        return {
          meta: {},
          valid: false
        };
      }

      var gender = parseInt(value.charAt(0), 10);
      var year = parseInt(value.substr(1, 2), 10);
      var month = parseInt(value.substr(3, 2), 10);
      var day = parseInt(value.substr(5, 2), 10);
      var century = gender % 2 === 0 ? 17 + gender / 2 : 17 + (gender + 1) / 2;
      year = century * 100 + year;

      if (!isValidDate(year, month, day, true)) {
        return {
          meta: {},
          valid: false
        };
      }

      var weight = [1, 2, 3, 4, 5, 6, 7, 8, 9, 1];
      var sum = 0;
      var i;

      for (i = 0; i < 10; i++) {
        sum += parseInt(value.charAt(i), 10) * weight[i];
      }

      sum = sum % 11;

      if (sum !== 10) {
        return {
          meta: {},
          valid: "".concat(sum) === value.charAt(10)
        };
      }

      sum = 0;
      weight = [3, 4, 5, 6, 7, 8, 9, 1, 2, 3];

      for (i = 0; i < 10; i++) {
        sum += parseInt(value.charAt(i), 10) * weight[i];
      }

      sum = sum % 11;

      if (sum === 10) {
        sum = 0;
      }

      return {
        meta: {},
        valid: "".concat(sum) === value.charAt(10)
      };
    }

    function lvId(value) {
      if (!/^[0-9]{6}[-]{0,1}[0-9]{5}$/.test(value)) {
        return {
          meta: {},
          valid: false
        };
      }

      var v = value.replace(/\D/g, '');
      var day = parseInt(v.substr(0, 2), 10);
      var month = parseInt(v.substr(2, 2), 10);
      var year = parseInt(v.substr(4, 2), 10);
      year = year + 1800 + parseInt(v.charAt(6), 10) * 100;

      if (!isValidDate(year, month, day, true)) {
        return {
          meta: {},
          valid: false
        };
      }

      var sum = 0;
      var weight = [10, 5, 8, 4, 2, 1, 6, 3, 7, 9];

      for (var i = 0; i < 10; i++) {
        sum += parseInt(v.charAt(i), 10) * weight[i];
      }

      sum = (sum + 1) % 11 % 10;
      return {
        meta: {},
        valid: "".concat(sum) === v.charAt(10)
      };
    }

    function meId(value) {
      return {
        meta: {},
        valid: jmbg(value, 'ME')
      };
    }

    function mkId(value) {
      return {
        meta: {},
        valid: jmbg(value, 'MK')
      };
    }

    function mxId(value) {
      var v = value.toUpperCase();

      if (!/^[A-Z]{4}\d{6}[A-Z]{6}[0-9A-Z]\d$/.test(v)) {
        return {
          meta: {},
          valid: false
        };
      }

      var blacklistNames = ['BACA', 'BAKA', 'BUEI', 'BUEY', 'CACA', 'CACO', 'CAGA', 'CAGO', 'CAKA', 'CAKO', 'COGE', 'COGI', 'COJA', 'COJE', 'COJI', 'COJO', 'COLA', 'CULO', 'FALO', 'FETO', 'GETA', 'GUEI', 'GUEY', 'JETA', 'JOTO', 'KACA', 'KACO', 'KAGA', 'KAGO', 'KAKA', 'KAKO', 'KOGE', 'KOGI', 'KOJA', 'KOJE', 'KOJI', 'KOJO', 'KOLA', 'KULO', 'LILO', 'LOCA', 'LOCO', 'LOKA', 'LOKO', 'MAME', 'MAMO', 'MEAR', 'MEAS', 'MEON', 'MIAR', 'MION', 'MOCO', 'MOKO', 'MULA', 'MULO', 'NACA', 'NACO', 'PEDA', 'PEDO', 'PENE', 'PIPI', 'PITO', 'POPO', 'PUTA', 'PUTO', 'QULO', 'RATA', 'ROBA', 'ROBE', 'ROBO', 'RUIN', 'SENO', 'TETA', 'VACA', 'VAGA', 'VAGO', 'VAKA', 'VUEI', 'VUEY', 'WUEI', 'WUEY'];
      var name = v.substr(0, 4);

      if (blacklistNames.indexOf(name) >= 0) {
        return {
          meta: {},
          valid: false
        };
      }

      var year = parseInt(v.substr(4, 2), 10);
      var month = parseInt(v.substr(6, 2), 10);
      var day = parseInt(v.substr(6, 2), 10);

      if (/^[0-9]$/.test(v.charAt(16))) {
        year += 1900;
      } else {
        year += 2000;
      }

      if (!isValidDate(year, month, day)) {
        return {
          meta: {},
          valid: false
        };
      }

      var gender = v.charAt(10);

      if (gender !== 'H' && gender !== 'M') {
        return {
          meta: {},
          valid: false
        };
      }

      var state = v.substr(11, 2);
      var states = ['AS', 'BC', 'BS', 'CC', 'CH', 'CL', 'CM', 'CS', 'DF', 'DG', 'GR', 'GT', 'HG', 'JC', 'MC', 'MN', 'MS', 'NE', 'NL', 'NT', 'OC', 'PL', 'QR', 'QT', 'SL', 'SP', 'SR', 'TC', 'TL', 'TS', 'VZ', 'YN', 'ZS'];

      if (states.indexOf(state) === -1) {
        return {
          meta: {},
          valid: false
        };
      }

      var alphabet = '0123456789ABCDEFGHIJKLMN&OPQRSTUVWXYZ';
      var sum = 0;
      var length = v.length;

      for (var i = 0; i < length - 1; i++) {
        sum += (18 - i) * alphabet.indexOf(v.charAt(i));
      }

      sum = (10 - sum % 10) % 10;
      return {
        meta: {},
        valid: "".concat(sum) === v.charAt(length - 1)
      };
    }

    function myId(value) {
      if (!/^\d{12}$/.test(value)) {
        return {
          meta: {},
          valid: false
        };
      }

      var year = parseInt(value.substr(0, 2), 10);
      var month = parseInt(value.substr(2, 2), 10);
      var day = parseInt(value.substr(4, 2), 10);

      if (!isValidDate(year + 1900, month, day) && !isValidDate(year + 2000, month, day)) {
        return {
          meta: {},
          valid: false
        };
      }

      var placeOfBirth = value.substr(6, 2);
      var notAvailablePlaces = ["17", "18", "19", "20", "69", "70", "73", "80", "81", "94", "95", "96", "97"];
      return {
        meta: {},
        valid: notAvailablePlaces.indexOf(placeOfBirth) === -1
      };
    }

    function nlId(value) {
      if (value.length < 8) {
        return {
          meta: {},
          valid: false
        };
      }

      var v = value;

      if (v.length === 8) {
        v = "0".concat(v);
      }

      if (!/^[0-9]{4}[.]{0,1}[0-9]{2}[.]{0,1}[0-9]{3}$/.test(v)) {
        return {
          meta: {},
          valid: false
        };
      }

      v = v.replace(/\./g, '');

      if (parseInt(v, 10) === 0) {
        return {
          meta: {},
          valid: false
        };
      }

      var sum = 0;
      var length = v.length;

      for (var i = 0; i < length - 1; i++) {
        sum += (9 - i) * parseInt(v.charAt(i), 10);
      }

      sum = sum % 11;

      if (sum === 10) {
        sum = 0;
      }

      return {
        meta: {},
        valid: "".concat(sum) === v.charAt(length - 1)
      };
    }

    function noId(value) {
      if (!/^\d{11}$/.test(value)) {
        return {
          meta: {},
          valid: false
        };
      }

      var firstCd = function firstCd(v) {
        var weight = [3, 7, 6, 1, 8, 9, 4, 5, 2];
        var sum = 0;

        for (var i = 0; i < 9; i++) {
          sum += weight[i] * parseInt(v.charAt(i), 10);
        }

        return 11 - sum % 11;
      };

      var secondCd = function secondCd(v) {
        var weight = [5, 4, 3, 2, 7, 6, 5, 4, 3, 2];
        var sum = 0;

        for (var i = 0; i < 10; i++) {
          sum += weight[i] * parseInt(v.charAt(i), 10);
        }

        return 11 - sum % 11;
      };

      return {
        meta: {},
        valid: "".concat(firstCd(value)) === value.substr(-2, 1) && "".concat(secondCd(value)) === value.substr(-1)
      };
    }

    function peId(value) {
      if (!/^\d{8}[0-9A-Z]*$/.test(value)) {
        return {
          meta: {},
          valid: false
        };
      }

      if (value.length === 8) {
        return {
          meta: {},
          valid: true
        };
      }

      var weight = [3, 2, 7, 6, 5, 4, 3, 2];
      var sum = 0;

      for (var i = 0; i < 8; i++) {
        sum += weight[i] * parseInt(value.charAt(i), 10);
      }

      var cd = sum % 11;
      var checkDigit = [6, 5, 4, 3, 2, 1, 1, 0, 9, 8, 7][cd];
      var checkChar = "KJIHGFEDCBA".charAt(cd);
      return {
        meta: {},
        valid: value.charAt(8) === "".concat(checkDigit) || value.charAt(8) === checkChar
      };
    }

    function plId(value) {
      if (!/^[0-9]{11}$/.test(value)) {
        return {
          meta: {},
          valid: false
        };
      }

      var sum = 0;
      var length = value.length;
      var weight = [1, 3, 7, 9, 1, 3, 7, 9, 1, 3, 7];

      for (var i = 0; i < length - 1; i++) {
        sum += weight[i] * parseInt(value.charAt(i), 10);
      }

      sum = sum % 10;

      if (sum === 0) {
        sum = 10;
      }

      sum = 10 - sum;
      return {
        meta: {},
        valid: "".concat(sum) === value.charAt(length - 1)
      };
    }

    function roId(value) {
      if (!/^[0-9]{13}$/.test(value)) {
        return {
          meta: {},
          valid: false
        };
      }

      var gender = parseInt(value.charAt(0), 10);

      if (gender === 0 || gender === 7 || gender === 8) {
        return {
          meta: {},
          valid: false
        };
      }

      var year = parseInt(value.substr(1, 2), 10);
      var month = parseInt(value.substr(3, 2), 10);
      var day = parseInt(value.substr(5, 2), 10);
      var centuries = {
        1: 1900,
        2: 1900,
        3: 1800,
        4: 1800,
        5: 2000,
        6: 2000
      };

      if (day > 31 && month > 12) {
        return {
          meta: {},
          valid: false
        };
      }

      if (gender !== 9) {
        year = centuries[gender + ''] + year;

        if (!isValidDate(year, month, day)) {
          return {
            meta: {},
            valid: false
          };
        }
      }

      var sum = 0;
      var weight = [2, 7, 9, 1, 4, 6, 3, 5, 8, 2, 7, 9];
      var length = value.length;

      for (var i = 0; i < length - 1; i++) {
        sum += parseInt(value.charAt(i), 10) * weight[i];
      }

      sum = sum % 11;

      if (sum === 10) {
        sum = 1;
      }

      return {
        meta: {},
        valid: "".concat(sum) === value.charAt(length - 1)
      };
    }

    function rsId(value) {
      return {
        meta: {},
        valid: jmbg(value, 'RS')
      };
    }

    function seId(value) {
      if (!/^[0-9]{10}$/.test(value) && !/^[0-9]{6}[-|+][0-9]{4}$/.test(value)) {
        return {
          meta: {},
          valid: false
        };
      }

      var v = value.replace(/[^0-9]/g, '');
      var year = parseInt(v.substr(0, 2), 10) + 1900;
      var month = parseInt(v.substr(2, 2), 10);
      var day = parseInt(v.substr(4, 2), 10);

      if (!isValidDate(year, month, day)) {
        return {
          meta: {},
          valid: false
        };
      }

      return {
        meta: {},
        valid: luhn(v)
      };
    }

    function siId(value) {
      return {
        meta: {},
        valid: jmbg(value, 'SI')
      };
    }

    function smId(value) {
      return {
        meta: {},
        valid: /^\d{5}$/.test(value)
      };
    }

    function thId(value) {
      if (value.length !== 13) {
        return {
          meta: {},
          valid: false
        };
      }

      var sum = 0;

      for (var i = 0; i < 12; i++) {
        sum += parseInt(value.charAt(i), 10) * (13 - i);
      }

      return {
        meta: {},
        valid: (11 - sum % 11) % 10 === parseInt(value.charAt(12), 10)
      };
    }

    function trId(value) {
      if (value.length !== 11) {
        return {
          meta: {},
          valid: false
        };
      }

      var sum = 0;

      for (var i = 0; i < 10; i++) {
        sum += parseInt(value.charAt(i), 10);
      }

      return {
        meta: {},
        valid: sum % 10 === parseInt(value.charAt(10), 10)
      };
    }

    function twId(value) {
      var v = value.toUpperCase();

      if (!/^[A-Z][12][0-9]{8}$/.test(v)) {
        return {
          meta: {},
          valid: false
        };
      }

      var length = v.length;
      var alphabet = 'ABCDEFGHJKLMNPQRSTUVXYWZIO';
      var letterIndex = alphabet.indexOf(v.charAt(0)) + 10;
      var letterValue = Math.floor(letterIndex / 10) + letterIndex % 10 * (length - 1);
      var sum = 0;

      for (var i = 1; i < length - 1; i++) {
        sum += parseInt(v.charAt(i), 10) * (length - 1 - i);
      }

      return {
        meta: {},
        valid: (letterValue + sum + parseInt(v.charAt(length - 1), 10)) % 10 === 0
      };
    }

    function uyId(value) {
      if (!/^\d{8}$/.test(value)) {
        return {
          meta: {},
          valid: false
        };
      }

      var weight = [2, 9, 8, 7, 6, 3, 4];
      var sum = 0;

      for (var i = 0; i < 7; i++) {
        sum += parseInt(value.charAt(i), 10) * weight[i];
      }

      sum = sum % 10;

      if (sum > 0) {
        sum = 10 - sum;
      }

      return {
        meta: {},
        valid: "".concat(sum) === value.charAt(7)
      };
    }

    function zaId(value) {
      if (!/^[0-9]{10}[0|1][8|9][0-9]$/.test(value)) {
        return {
          meta: {},
          valid: false
        };
      }

      var year = parseInt(value.substr(0, 2), 10);
      var currentYear = new Date().getFullYear() % 100;
      var month = parseInt(value.substr(2, 2), 10);
      var day = parseInt(value.substr(4, 2), 10);
      year = year >= currentYear ? year + 1900 : year + 2000;

      if (!isValidDate(year, month, day)) {
        return {
          meta: {},
          valid: false
        };
      }

      return {
        meta: {},
        valid: luhn(value)
      };
    }

    function id() {
      var COUNTRY_CODES = ['AR', 'BA', 'BG', 'BR', 'CH', 'CL', 'CN', 'CO', 'CZ', 'DK', 'EE', 'ES', 'FI', 'FR', 'HK', 'HR', 'ID', 'IE', 'IL', 'IS', 'KR', 'LT', 'LV', 'ME', 'MK', 'MX', 'MY', 'NL', 'NO', 'PE', 'PL', 'RO', 'RS', 'SE', 'SI', 'SK', 'SM', 'TH', 'TR', 'TW', 'UY', 'ZA'];
      return {
        validate: function validate(input) {
          if (input.value === '') {
            return {
              valid: true
            };
          }

          var opts = Object.assign({}, {
            message: ''
          }, input.options);
          var country = input.value.substr(0, 2);

          if ('function' === typeof opts.country) {
            country = opts.country.call(this);
          } else {
            country = opts.country;
          }

          if (COUNTRY_CODES.indexOf(country) === -1) {
            return {
              valid: true
            };
          }

          var result = {
            meta: {},
            valid: true
          };

          switch (country.toLowerCase()) {
            case 'ar':
              result = arId(input.value);
              break;

            case 'ba':
              result = baId(input.value);
              break;

            case 'bg':
              result = bgId(input.value);
              break;

            case 'br':
              result = brId(input.value);
              break;

            case 'ch':
              result = chId(input.value);
              break;

            case 'cl':
              result = clId(input.value);
              break;

            case 'cn':
              result = cnId(input.value);
              break;

            case 'co':
              result = coId(input.value);
              break;

            case 'cz':
              result = czId(input.value);
              break;

            case 'dk':
              result = dkId(input.value);
              break;

            case 'ee':
              result = ltId(input.value);
              break;

            case 'es':
              result = esId(input.value);
              break;

            case 'fi':
              result = fiId(input.value);
              break;

            case 'fr':
              result = frId(input.value);
              break;

            case 'hk':
              result = hkId(input.value);
              break;

            case 'hr':
              result = hrId(input.value);
              break;

            case 'id':
              result = idId(input.value);
              break;

            case 'ie':
              result = ieId(input.value);
              break;

            case 'il':
              result = ilId(input.value);
              break;

            case 'is':
              result = isId(input.value);
              break;

            case 'kr':
              result = krId(input.value);
              break;

            case 'lt':
              result = ltId(input.value);
              break;

            case 'lv':
              result = lvId(input.value);
              break;

            case 'me':
              result = meId(input.value);
              break;

            case 'mk':
              result = mkId(input.value);
              break;

            case 'mx':
              result = mxId(input.value);
              break;

            case 'my':
              result = myId(input.value);
              break;

            case 'nl':
              result = nlId(input.value);
              break;

            case 'no':
              result = noId(input.value);
              break;

            case 'pe':
              result = peId(input.value);
              break;

            case 'pl':
              result = plId(input.value);
              break;

            case 'ro':
              result = roId(input.value);
              break;

            case 'rs':
              result = rsId(input.value);
              break;

            case 'se':
              result = seId(input.value);
              break;

            case 'si':
              result = siId(input.value);
              break;

            case 'sk':
              result = czId(input.value);
              break;

            case 'sm':
              result = smId(input.value);
              break;

            case 'th':
              result = thId(input.value);
              break;

            case 'tr':
              result = trId(input.value);
              break;

            case 'tw':
              result = twId(input.value);
              break;

            case 'uy':
              result = uyId(input.value);
              break;

            case 'za':
              result = zaId(input.value);
              break;
          }

          var message = format(input.l10n ? opts.message || input.l10n.id.country : opts.message, input.l10n ? input.l10n.id.countries[country.toUpperCase()] : country.toUpperCase());
          return Object.assign({}, {
            message: message
          }, result);
        }
      };
    }

    function imei() {
      return {
        validate: function validate(input) {
          if (input.value === '') {
            return {
              valid: true
            };
          }

          switch (true) {
            case /^\d{15}$/.test(input.value):
            case /^\d{2}-\d{6}-\d{6}-\d{1}$/.test(input.value):
            case /^\d{2}\s\d{6}\s\d{6}\s\d{1}$/.test(input.value):
              var v = input.value.replace(/[^0-9]/g, '');
              return {
                valid: luhn(v)
              };

            case /^\d{14}$/.test(input.value):
            case /^\d{16}$/.test(input.value):
            case /^\d{2}-\d{6}-\d{6}(|-\d{2})$/.test(input.value):
            case /^\d{2}\s\d{6}\s\d{6}(|\s\d{2})$/.test(input.value):
              return {
                valid: true
              };

            default:
              return {
                valid: false
              };
          }
        }
      };
    }

    function imo() {
      return {
        validate: function validate(input) {
          if (input.value === '') {
            return {
              valid: true
            };
          }

          if (!/^IMO \d{7}$/i.test(input.value)) {
            return {
              valid: false
            };
          }

          var digits = input.value.replace(/^.*(\d{7})$/, '$1');
          var sum = 0;

          for (var i = 6; i >= 1; i--) {
            sum += parseInt(digits.slice(6 - i, -i), 10) * (i + 1);
          }

          return {
            valid: sum % 10 === parseInt(digits.charAt(6), 10)
          };
        }
      };
    }

    function isbn() {
      return {
        validate: function validate(input) {
          if (input.value === '') {
            return {
              meta: {
                type: null
              },
              valid: true
            };
          }

          var tpe;

          switch (true) {
            case /^\d{9}[\dX]$/.test(input.value):
            case input.value.length === 13 && /^(\d+)-(\d+)-(\d+)-([\dX])$/.test(input.value):
            case input.value.length === 13 && /^(\d+)\s(\d+)\s(\d+)\s([\dX])$/.test(input.value):
              tpe = 'ISBN10';
              break;

            case /^(978|979)\d{9}[\dX]$/.test(input.value):
            case input.value.length === 17 && /^(978|979)-(\d+)-(\d+)-(\d+)-([\dX])$/.test(input.value):
            case input.value.length === 17 && /^(978|979)\s(\d+)\s(\d+)\s(\d+)\s([\dX])$/.test(input.value):
              tpe = 'ISBN13';
              break;

            default:
              return {
                meta: {
                  type: null
                },
                valid: false
              };
          }

          var chars = input.value.replace(/[^0-9X]/gi, '').split('');
          var length = chars.length;
          var sum = 0;
          var i;
          var checksum;

          switch (tpe) {
            case 'ISBN10':
              sum = 0;

              for (i = 0; i < length - 1; i++) {
                sum += parseInt(chars[i], 10) * (10 - i);
              }

              checksum = 11 - sum % 11;

              if (checksum === 11) {
                checksum = 0;
              } else if (checksum === 10) {
                checksum = 'X';
              }

              return {
                meta: {
                  type: tpe
                },
                valid: "".concat(checksum) === chars[length - 1]
              };

            case 'ISBN13':
              sum = 0;

              for (i = 0; i < length - 1; i++) {
                sum += i % 2 === 0 ? parseInt(chars[i], 10) : parseInt(chars[i], 10) * 3;
              }

              checksum = 10 - sum % 10;

              if (checksum === 10) {
                checksum = '0';
              }

              return {
                meta: {
                  type: tpe
                },
                valid: "".concat(checksum) === chars[length - 1]
              };
          }
        }
      };
    }

    function isin() {
      var COUNTRY_CODES = 'AF|AX|AL|DZ|AS|AD|AO|AI|AQ|AG|AR|AM|AW|AU|AT|AZ|BS|BH|BD|BB|BY|BE|BZ|BJ|BM|BT|BO|BQ|BA|BW|' + 'BV|BR|IO|BN|BG|BF|BI|KH|CM|CA|CV|KY|CF|TD|CL|CN|CX|CC|CO|KM|CG|CD|CK|CR|CI|HR|CU|CW|CY|CZ|DK|DJ|DM|DO|EC|EG|' + 'SV|GQ|ER|EE|ET|FK|FO|FJ|FI|FR|GF|PF|TF|GA|GM|GE|DE|GH|GI|GR|GL|GD|GP|GU|GT|GG|GN|GW|GY|HT|HM|VA|HN|HK|HU|IS|' + 'IN|ID|IR|IQ|IE|IM|IL|IT|JM|JP|JE|JO|KZ|KE|KI|KP|KR|KW|KG|LA|LV|LB|LS|LR|LY|LI|LT|LU|MO|MK|MG|MW|MY|MV|ML|MT|' + 'MH|MQ|MR|MU|YT|MX|FM|MD|MC|MN|ME|MS|MA|MZ|MM|NA|NR|NP|NL|NC|NZ|NI|NE|NG|NU|NF|MP|NO|OM|PK|PW|PS|PA|PG|PY|PE|' + 'PH|PN|PL|PT|PR|QA|RE|RO|RU|RW|BL|SH|KN|LC|MF|PM|VC|WS|SM|ST|SA|SN|RS|SC|SL|SG|SX|SK|SI|SB|SO|ZA|GS|SS|ES|LK|' + 'SD|SR|SJ|SZ|SE|CH|SY|TW|TJ|TZ|TH|TL|TG|TK|TO|TT|TN|TR|TM|TC|TV|UG|UA|AE|GB|US|UM|UY|UZ|VU|VE|VN|VG|VI|WF|EH|' + 'YE|ZM|ZW';
      return {
        validate: function validate(input) {
          if (input.value === '') {
            return {
              valid: true
            };
          }

          var v = input.value.toUpperCase();
          var regex = new RegExp('^(' + COUNTRY_CODES + ')[0-9A-Z]{10}$');

          if (!regex.test(input.value)) {
            return {
              valid: false
            };
          }

          var length = v.length;
          var converted = '';
          var i;

          for (i = 0; i < length - 1; i++) {
            var c = v.charCodeAt(i);
            converted += c > 57 ? (c - 55).toString() : v.charAt(i);
          }

          var digits = '';
          var n = converted.length;
          var group = n % 2 !== 0 ? 0 : 1;

          for (i = 0; i < n; i++) {
            digits += parseInt(converted[i], 10) * (i % 2 === group ? 2 : 1) + '';
          }

          var sum = 0;

          for (i = 0; i < digits.length; i++) {
            sum += parseInt(digits.charAt(i), 10);
          }

          sum = (10 - sum % 10) % 10;
          return {
            valid: "".concat(sum) === v.charAt(length - 1)
          };
        }
      };
    }

    function ismn() {
      return {
        validate: function validate(input) {
          if (input.value === '') {
            return {
              meta: null,
              valid: true
            };
          }

          var tpe;

          switch (true) {
            case /^M\d{9}$/.test(input.value):
            case /^M-\d{4}-\d{4}-\d{1}$/.test(input.value):
            case /^M\s\d{4}\s\d{4}\s\d{1}$/.test(input.value):
              tpe = 'ISMN10';
              break;

            case /^9790\d{9}$/.test(input.value):
            case /^979-0-\d{4}-\d{4}-\d{1}$/.test(input.value):
            case /^979\s0\s\d{4}\s\d{4}\s\d{1}$/.test(input.value):
              tpe = 'ISMN13';
              break;

            default:
              return {
                meta: null,
                valid: false
              };
          }

          var v = input.value;

          if ('ISMN10' === tpe) {
            v = "9790".concat(v.substr(1));
          }

          v = v.replace(/[^0-9]/gi, '');
          var sum = 0;
          var length = v.length;
          var weight = [1, 3];

          for (var i = 0; i < length - 1; i++) {
            sum += parseInt(v.charAt(i), 10) * weight[i % 2];
          }

          sum = (10 - sum % 10) % 10;
          return {
            meta: {
              type: tpe
            },
            valid: "".concat(sum) === v.charAt(length - 1)
          };
        }
      };
    }

    function issn() {
      return {
        validate: function validate(input) {
          if (input.value === '') {
            return {
              valid: true
            };
          }

          if (!/^\d{4}\-\d{3}[\dX]$/.test(input.value)) {
            return {
              valid: false
            };
          }

          var chars = input.value.replace(/[^0-9X]/gi, '').split('');
          var length = chars.length;
          var sum = 0;

          if (chars[7] === 'X') {
            chars[7] = '10';
          }

          for (var i = 0; i < length; i++) {
            sum += parseInt(chars[i], 10) * (8 - i);
          }

          return {
            valid: sum % 11 === 0
          };
        }
      };
    }

    function mac() {
      return {
        validate: function validate(input) {
          return {
            valid: input.value === '' || /^([0-9A-Fa-f]{2}[:-]){5}([0-9A-Fa-f]{2})$/.test(input.value) || /^([0-9A-Fa-f]{4}\.){2}([0-9A-Fa-f]{4})$/.test(input.value)
          };
        }
      };
    }

    function meid() {
      return {
        validate: function validate(input) {
          if (input.value === '') {
            return {
              valid: true
            };
          }

          var v = input.value;

          switch (true) {
            case /^[0-9A-F]{15}$/i.test(v):
            case /^[0-9A-F]{2}[- ][0-9A-F]{6}[- ][0-9A-F]{6}[- ][0-9A-F]$/i.test(v):
            case /^\d{19}$/.test(v):
            case /^\d{5}[- ]\d{5}[- ]\d{4}[- ]\d{4}[- ]\d$/.test(v):
              var cd = v.charAt(v.length - 1).toUpperCase();
              v = v.replace(/[- ]/g, '');

              if (v.match(/^\d*$/i)) {
                return {
                  valid: luhn(v)
                };
              }

              v = v.slice(0, -1);
              var checkDigit = '';
              var i;

              for (i = 1; i <= 13; i += 2) {
                checkDigit += (parseInt(v.charAt(i), 16) * 2).toString(16);
              }

              var sum = 0;

              for (i = 0; i < checkDigit.length; i++) {
                sum += parseInt(checkDigit.charAt(i), 16);
              }

              return {
                valid: sum % 10 === 0 ? cd === '0' : cd === ((Math.floor((sum + 10) / 10) * 10 - sum) * 2).toString(16).toUpperCase()
              };

            case /^[0-9A-F]{14}$/i.test(v):
            case /^[0-9A-F]{2}[- ][0-9A-F]{6}[- ][0-9A-F]{6}$/i.test(v):
            case /^\d{18}$/.test(v):
            case /^\d{5}[- ]\d{5}[- ]\d{4}[- ]\d{4}$/.test(v):
              return {
                valid: true
              };

            default:
              return {
                valid: false
              };
          }
        }
      };
    }

    function phone() {
      var COUNTRY_CODES = ['AE', 'BG', 'BR', 'CN', 'CZ', 'DE', 'DK', 'ES', 'FR', 'GB', 'IN', 'MA', 'NL', 'PK', 'RO', 'RU', 'SK', 'TH', 'US', 'VE'];
      return {
        validate: function validate(input) {
          if (input.value === '') {
            return {
              valid: true
            };
          }

          var opts = Object.assign({}, {
            message: ''
          }, input.options);
          var v = input.value.trim();
          var country = v.substr(0, 2);

          if ('function' === typeof opts.country) {
            country = opts.country.call(this);
          } else {
            country = opts.country;
          }

          if (!country || COUNTRY_CODES.indexOf(country.toUpperCase()) === -1) {
            return {
              valid: true
            };
          }

          var isValid = true;

          switch (country.toUpperCase()) {
            case 'AE':
              isValid = /^(((\+|00)?971[\s\.-]?(\(0\)[\s\.-]?)?|0)(\(5(0|2|5|6)\)|5(0|2|5|6)|2|3|4|6|7|9)|60)([\s\.-]?[0-9]){7}$/.test(v);
              break;

            case 'BG':
              isValid = /^(0|359|00)(((700|900)[0-9]{5}|((800)[0-9]{5}|(800)[0-9]{4}))|(87|88|89)([0-9]{7})|((2[0-9]{7})|(([3-9][0-9])(([0-9]{6})|([0-9]{5})))))$/.test(v.replace(/\+|\s|-|\/|\(|\)/gi, ''));
              break;

            case 'BR':
              isValid = /^(([\d]{4}[-.\s]{1}[\d]{2,3}[-.\s]{1}[\d]{2}[-.\s]{1}[\d]{2})|([\d]{4}[-.\s]{1}[\d]{3}[-.\s]{1}[\d]{4})|((\(?\+?[0-9]{2}\)?\s?)?(\(?\d{2}\)?\s?)?\d{4,5}[-.\s]?\d{4}))$/.test(v);
              break;

            case 'CN':
              isValid = /^((00|\+)?(86(?:-| )))?((\d{11})|(\d{3}[- ]{1}\d{4}[- ]{1}\d{4})|((\d{2,4}[- ]){1}(\d{7,8}|(\d{3,4}[- ]{1}\d{4}))([- ]{1}\d{1,4})?))$/.test(v);
              break;

            case 'CZ':
              isValid = /^(((00)([- ]?)|\+)(420)([- ]?))?((\d{3})([- ]?)){2}(\d{3})$/.test(v);
              break;

            case 'DE':
              isValid = /^(((((((00|\+)49[ \-/]?)|0)[1-9][0-9]{1,4})[ \-/]?)|((((00|\+)49\()|\(0)[1-9][0-9]{1,4}\)[ \-/]?))[0-9]{1,7}([ \-/]?[0-9]{1,5})?)$/.test(v);
              break;

            case 'DK':
              isValid = /^(\+45|0045|\(45\))?\s?[2-9](\s?\d){7}$/.test(v);
              break;

            case 'ES':
              isValid = /^(?:(?:(?:\+|00)34\D?))?(?:5|6|7|8|9)(?:\d\D?){8}$/.test(v);
              break;

            case 'FR':
              isValid = /^(?:(?:(?:\+|00)33[ ]?(?:\(0\)[ ]?)?)|0){1}[1-9]{1}([ .-]?)(?:\d{2}\1?){3}\d{2}$/.test(v);
              break;

            case 'GB':
              isValid = /^\(?(?:(?:0(?:0|11)\)?[\s-]?\(?|\+)44\)?[\s-]?\(?(?:0\)?[\s-]?\(?)?|0)(?:\d{2}\)?[\s-]?\d{4}[\s-]?\d{4}|\d{3}\)?[\s-]?\d{3}[\s-]?\d{3,4}|\d{4}\)?[\s-]?(?:\d{5}|\d{3}[\s-]?\d{3})|\d{5}\)?[\s-]?\d{4,5}|8(?:00[\s-]?11[\s-]?11|45[\s-]?46[\s-]?4\d))(?:(?:[\s-]?(?:x|ext\.?\s?|\#)\d+)?)$/.test(v);
              break;

            case 'IN':
              isValid = /((\+?)((0[ -]+)*|(91 )*)(\d{12}|\d{10}))|\d{5}([- ]*)\d{6}/.test(v);
              break;

            case 'MA':
              isValid = /^(?:(?:(?:\+|00)212[\s]?(?:[\s]?\(0\)[\s]?)?)|0){1}(?:5[\s.-]?[2-3]|6[\s.-]?[13-9]){1}[0-9]{1}(?:[\s.-]?\d{2}){3}$/.test(v);
              break;

            case 'NL':
              isValid = /^((\+|00(\s|\s?\-\s?)?)31(\s|\s?\-\s?)?(\(0\)[\-\s]?)?|0)[1-9]((\s|\s?\-\s?)?[0-9])((\s|\s?-\s?)?[0-9])((\s|\s?-\s?)?[0-9])\s?[0-9]\s?[0-9]\s?[0-9]\s?[0-9]\s?[0-9]$/gm.test(v);
              break;

            case 'PK':
              isValid = /^0?3[0-9]{2}[0-9]{7}$/.test(v);
              break;

            case 'RO':
              isValid = /^(\+4|)?(07[0-8]{1}[0-9]{1}|02[0-9]{2}|03[0-9]{2}){1}?(\s|\.|\-)?([0-9]{3}(\s|\.|\-|)){2}$/g.test(v);
              break;

            case 'RU':
              isValid = /^((8|\+7|007)[\-\.\/ ]?)?([\(\/\.]?\d{3}[\)\/\.]?[\-\.\/ ]?)?[\d\-\.\/ ]{7,10}$/g.test(v);
              break;

            case 'SK':
              isValid = /^(((00)([- ]?)|\+)(421)([- ]?))?((\d{3})([- ]?)){2}(\d{3})$/.test(v);
              break;

            case 'TH':
              isValid = /^0\(?([6|8-9]{2})*-([0-9]{3})*-([0-9]{4})$/.test(v);
              break;

            case 'VE':
              isValid = /^0(?:2(?:12|4[0-9]|5[1-9]|6[0-9]|7[0-8]|8[1-35-8]|9[1-5]|3[45789])|4(?:1[246]|2[46]))\d{7}$/.test(v);
              break;

            case 'US':
            default:
              isValid = /^(?:(1\-?)|(\+1 ?))?\(?\d{3}\)?[\-\.\s]?\d{3}[\-\.\s]?\d{4}$/.test(v);
              break;
          }

          return {
            message: format(input.l10n ? opts.message || input.l10n.phone.country : opts.message, input.l10n ? input.l10n.phone.countries[country] : country),
            valid: isValid
          };
        }
      };
    }

    function rtn() {
      return {
        validate: function validate(input) {
          if (input.value === '') {
            return {
              valid: true
            };
          }

          if (!/^\d{9}$/.test(input.value)) {
            return {
              valid: false
            };
          }

          var sum = 0;

          for (var i = 0; i < input.value.length; i += 3) {
            sum += parseInt(input.value.charAt(i), 10) * 3 + parseInt(input.value.charAt(i + 1), 10) * 7 + parseInt(input.value.charAt(i + 2), 10);
          }

          return {
            valid: sum !== 0 && sum % 10 === 0
          };
        }
      };
    }

    function sedol() {
      return {
        validate: function validate(input) {
          if (input.value === '') {
            return {
              valid: true
            };
          }

          var v = input.value.toUpperCase();

          if (!/^[0-9A-Z]{7}$/.test(v)) {
            return {
              valid: false
            };
          }

          var weight = [1, 3, 1, 7, 3, 9, 1];
          var length = v.length;
          var sum = 0;

          for (var i = 0; i < length - 1; i++) {
            sum += weight[i] * parseInt(v.charAt(i), 36);
          }

          sum = (10 - sum % 10) % 10;
          return {
            valid: "".concat(sum) === v.charAt(length - 1)
          };
        }
      };
    }

    function siren() {
      return {
        validate: function validate(input) {
          return {
            valid: input.value === '' || /^\d{9}$/.test(input.value) && luhn(input.value)
          };
        }
      };
    }

    function siret() {
      return {
        validate: function validate(input) {
          if (input.value === '') {
            return {
              valid: true
            };
          }

          var length = input.value.length;
          var sum = 0;
          var tmp;

          for (var i = 0; i < length; i++) {
            tmp = parseInt(input.value.charAt(i), 10);

            if (i % 2 === 0) {
              tmp = tmp * 2;

              if (tmp > 9) {
                tmp -= 9;
              }
            }

            sum += tmp;
          }

          return {
            valid: sum % 10 === 0
          };
        }
      };
    }

    function step() {
      var round = function round(input, precision) {
        var m = Math.pow(10, precision);
        var x = input * m;
        var sign;

        switch (true) {
          case x === 0:
            sign = 0;
            break;

          case x > 0:
            sign = 1;
            break;

          case x < 0:
            sign = -1;
            break;
        }

        var isHalf = x % 1 === 0.5 * sign;
        return isHalf ? (Math.floor(x) + (sign > 0 ? 1 : 0)) / m : Math.round(x) / m;
      };

      var floatMod = function floatMod(x, y) {
        if (y === 0.0) {
          return 1.0;
        }

        var dotX = "".concat(x).split('.');
        var dotY = "".concat(y).split('.');
        var precision = (dotX.length === 1 ? 0 : dotX[1].length) + (dotY.length === 1 ? 0 : dotY[1].length);
        return round(x - y * Math.floor(x / y), precision);
      };

      return {
        validate: function validate(input) {
          if (input.value === '') {
            return {
              valid: true
            };
          }

          var v = parseFloat(input.value);

          if (isNaN(v) || !isFinite(v)) {
            return {
              valid: false
            };
          }

          var opts = Object.assign({}, {
            baseValue: 0,
            message: '',
            step: 1
          }, input.options);
          var mod = floatMod(v - opts.baseValue, opts.step);
          return {
            message: format(input.l10n ? opts.message || input.l10n.step["default"] : opts.message, "".concat(opts.step)),
            valid: mod === 0.0 || mod === opts.step
          };
        }
      };
    }

    function uuid() {
      return {
        validate: function validate(input) {
          if (input.value === '') {
            return {
              valid: true
            };
          }

          var opts = Object.assign({}, {
            message: ''
          }, input.options);
          var patterns = {
            3: /^[0-9A-F]{8}-[0-9A-F]{4}-3[0-9A-F]{3}-[0-9A-F]{4}-[0-9A-F]{12}$/i,
            4: /^[0-9A-F]{8}-[0-9A-F]{4}-4[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$/i,
            5: /^[0-9A-F]{8}-[0-9A-F]{4}-5[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$/i,
            all: /^[0-9A-F]{8}-[0-9A-F]{4}-[0-9A-F]{4}-[0-9A-F]{4}-[0-9A-F]{12}$/i
          };
          var version = opts.version ? "".concat(opts.version) : 'all';
          return {
            message: opts.version ? format(input.l10n ? opts.message || input.l10n.uuid.version : opts.message, opts.version) : input.l10n ? input.l10n.uuid["default"] : opts.message,
            valid: null === patterns[version] ? true : patterns[version].test(input.value)
          };
        }
      };
    }

    function arVat(value) {
      var v = value.replace('-', '');

      if (/^AR[0-9]{11}$/.test(v)) {
        v = v.substr(2);
      }

      if (!/^[0-9]{11}$/.test(v)) {
        return {
          meta: {},
          valid: false
        };
      }

      var weight = [5, 4, 3, 2, 7, 6, 5, 4, 3, 2];
      var sum = 0;

      for (var i = 0; i < 10; i++) {
        sum += parseInt(v.charAt(i), 10) * weight[i];
      }

      sum = 11 - sum % 11;

      if (sum === 11) {
        sum = 0;
      }

      return {
        meta: {},
        valid: "".concat(sum) === v.substr(10)
      };
    }

    function atVat(value) {
      var v = value;

      if (/^ATU[0-9]{8}$/.test(v)) {
        v = v.substr(2);
      }

      if (!/^U[0-9]{8}$/.test(v)) {
        return {
          meta: {},
          valid: false
        };
      }

      v = v.substr(1);
      var weight = [1, 2, 1, 2, 1, 2, 1];
      var sum = 0;
      var temp = 0;

      for (var i = 0; i < 7; i++) {
        temp = parseInt(v.charAt(i), 10) * weight[i];

        if (temp > 9) {
          temp = Math.floor(temp / 10) + temp % 10;
        }

        sum += temp;
      }

      sum = 10 - (sum + 4) % 10;

      if (sum === 10) {
        sum = 0;
      }

      return {
        meta: {},
        valid: "".concat(sum) === v.substr(7, 1)
      };
    }

    function beVat(value) {
      var v = value;

      if (/^BE[0]?[0-9]{9}$/.test(v)) {
        v = v.substr(2);
      }

      if (!/^[0]?[0-9]{9}$/.test(v)) {
        return {
          meta: {},
          valid: false
        };
      }

      if (v.length === 9) {
        v = "0".concat(v);
      }

      if (v.substr(1, 1) === '0') {
        return {
          meta: {},
          valid: false
        };
      }

      var sum = parseInt(v.substr(0, 8), 10) + parseInt(v.substr(8, 2), 10);
      return {
        meta: {},
        valid: sum % 97 === 0
      };
    }

    function bgVat(value) {
      var v = value;

      if (/^BG[0-9]{9,10}$/.test(v)) {
        v = v.substr(2);
      }

      if (!/^[0-9]{9,10}$/.test(v)) {
        return {
          meta: {},
          valid: false
        };
      }

      var sum = 0;
      var i = 0;

      if (v.length === 9) {
        for (i = 0; i < 8; i++) {
          sum += parseInt(v.charAt(i), 10) * (i + 1);
        }

        sum = sum % 11;

        if (sum === 10) {
          sum = 0;

          for (i = 0; i < 8; i++) {
            sum += parseInt(v.charAt(i), 10) * (i + 3);
          }
        }

        sum = sum % 10;
        return {
          meta: {},
          valid: "".concat(sum) === v.substr(8)
        };
      } else {
        var isEgn = function isEgn(input) {
          var year = parseInt(input.substr(0, 2), 10) + 1900;
          var month = parseInt(input.substr(2, 2), 10);
          var day = parseInt(input.substr(4, 2), 10);

          if (month > 40) {
            year += 100;
            month -= 40;
          } else if (month > 20) {
            year -= 100;
            month -= 20;
          }

          if (!isValidDate(year, month, day)) {
            return false;
          }

          var weight = [2, 4, 8, 5, 10, 9, 7, 3, 6];
          var s = 0;

          for (var j = 0; j < 9; j++) {
            s += parseInt(input.charAt(j), 10) * weight[j];
          }

          s = s % 11 % 10;
          return "".concat(s) === input.substr(9, 1);
        };

        var isPnf = function isPnf(input) {
          var weight = [21, 19, 17, 13, 11, 9, 7, 3, 1];
          var s = 0;

          for (var j = 0; j < 9; j++) {
            s += parseInt(input.charAt(j), 10) * weight[j];
          }

          s = s % 10;
          return "".concat(s) === input.substr(9, 1);
        };

        var isVat = function isVat(input) {
          var weight = [4, 3, 2, 7, 6, 5, 4, 3, 2];
          var s = 0;

          for (var j = 0; j < 9; j++) {
            s += parseInt(input.charAt(j), 10) * weight[j];
          }

          s = 11 - s % 11;

          if (s === 10) {
            return false;
          }

          if (s === 11) {
            s = 0;
          }

          return "".concat(s) === input.substr(9, 1);
        };

        return {
          meta: {},
          valid: isEgn(v) || isPnf(v) || isVat(v)
        };
      }
    }

    function brVat(value) {
      if (value === '') {
        return {
          meta: {},
          valid: true
        };
      }

      var cnpj = value.replace(/[^\d]+/g, '');

      if (cnpj === '' || cnpj.length !== 14) {
        return {
          meta: {},
          valid: false
        };
      }

      if (cnpj === '00000000000000' || cnpj === '11111111111111' || cnpj === '22222222222222' || cnpj === '33333333333333' || cnpj === '44444444444444' || cnpj === '55555555555555' || cnpj === '66666666666666' || cnpj === '77777777777777' || cnpj === '88888888888888' || cnpj === '99999999999999') {
        return {
          meta: {},
          valid: false
        };
      }

      var length = cnpj.length - 2;
      var numbers = cnpj.substring(0, length);
      var digits = cnpj.substring(length);
      var sum = 0;
      var pos = length - 7;
      var i;

      for (i = length; i >= 1; i--) {
        sum += parseInt(numbers.charAt(length - i), 10) * pos--;

        if (pos < 2) {
          pos = 9;
        }
      }

      var result = sum % 11 < 2 ? 0 : 11 - sum % 11;

      if (result !== parseInt(digits.charAt(0), 10)) {
        return {
          meta: {},
          valid: false
        };
      }

      length = length + 1;
      numbers = cnpj.substring(0, length);
      sum = 0;
      pos = length - 7;

      for (i = length; i >= 1; i--) {
        sum += parseInt(numbers.charAt(length - i), 10) * pos--;

        if (pos < 2) {
          pos = 9;
        }
      }

      result = sum % 11 < 2 ? 0 : 11 - sum % 11;
      return {
        meta: {},
        valid: result === parseInt(digits.charAt(1), 10)
      };
    }

    function chVat(value) {
      var v = value;

      if (/^CHE[0-9]{9}(MWST|TVA|IVA|TPV)?$/.test(v)) {
        v = v.substr(2);
      }

      if (!/^E[0-9]{9}(MWST|TVA|IVA|TPV)?$/.test(v)) {
        return {
          meta: {},
          valid: false
        };
      }

      v = v.substr(1);
      var weight = [5, 4, 3, 2, 7, 6, 5, 4];
      var sum = 0;

      for (var i = 0; i < 8; i++) {
        sum += parseInt(v.charAt(i), 10) * weight[i];
      }

      sum = 11 - sum % 11;

      if (sum === 10) {
        return {
          meta: {},
          valid: false
        };
      }

      if (sum === 11) {
        sum = 0;
      }

      return {
        meta: {},
        valid: "".concat(sum) === v.substr(8, 1)
      };
    }

    function cyVat(value) {
      var v = value;

      if (/^CY[0-5|9][0-9]{7}[A-Z]$/.test(v)) {
        v = v.substr(2);
      }

      if (!/^[0-5|9][0-9]{7}[A-Z]$/.test(v)) {
        return {
          meta: {},
          valid: false
        };
      }

      if (v.substr(0, 2) === '12') {
        return {
          meta: {},
          valid: false
        };
      }

      var sum = 0;
      var translation = {
        0: 1,
        1: 0,
        2: 5,
        3: 7,
        4: 9,
        5: 13,
        6: 15,
        7: 17,
        8: 19,
        9: 21
      };

      for (var i = 0; i < 8; i++) {
        var temp = parseInt(v.charAt(i), 10);

        if (i % 2 === 0) {
          temp = translation["".concat(temp)];
        }

        sum += temp;
      }

      return {
        meta: {},
        valid: "".concat('ABCDEFGHIJKLMNOPQRSTUVWXYZ'[sum % 26]) === v.substr(8, 1)
      };
    }

    function czVat(value) {
      var v = value;

      if (/^CZ[0-9]{8,10}$/.test(v)) {
        v = v.substr(2);
      }

      if (!/^[0-9]{8,10}$/.test(v)) {
        return {
          meta: {},
          valid: false
        };
      }

      var sum = 0;
      var i = 0;

      if (v.length === 8) {
        if ("".concat(v.charAt(0)) === '9') {
          return {
            meta: {},
            valid: false
          };
        }

        sum = 0;

        for (i = 0; i < 7; i++) {
          sum += parseInt(v.charAt(i), 10) * (8 - i);
        }

        sum = 11 - sum % 11;

        if (sum === 10) {
          sum = 0;
        }

        if (sum === 11) {
          sum = 1;
        }

        return {
          meta: {},
          valid: "".concat(sum) === v.substr(7, 1)
        };
      } else if (v.length === 9 && "".concat(v.charAt(0)) === '6') {
        sum = 0;

        for (i = 0; i < 7; i++) {
          sum += parseInt(v.charAt(i + 1), 10) * (8 - i);
        }

        sum = 11 - sum % 11;

        if (sum === 10) {
          sum = 0;
        }

        if (sum === 11) {
          sum = 1;
        }

        sum = [8, 7, 6, 5, 4, 3, 2, 1, 0, 9, 10][sum - 1];
        return {
          meta: {},
          valid: "".concat(sum) === v.substr(8, 1)
        };
      } else if (v.length === 9 || v.length === 10) {
        var year = 1900 + parseInt(v.substr(0, 2), 10);
        var month = parseInt(v.substr(2, 2), 10) % 50 % 20;
        var day = parseInt(v.substr(4, 2), 10);

        if (v.length === 9) {
          if (year >= 1980) {
            year -= 100;
          }

          if (year > 1953) {
            return {
              meta: {},
              valid: false
            };
          }
        } else if (year < 1954) {
          year += 100;
        }

        if (!isValidDate(year, month, day)) {
          return {
            meta: {},
            valid: false
          };
        }

        if (v.length === 10) {
          var check = parseInt(v.substr(0, 9), 10) % 11;

          if (year < 1985) {
            check = check % 10;
          }

          return {
            meta: {},
            valid: "".concat(check) === v.substr(9, 1)
          };
        }

        return {
          meta: {},
          valid: true
        };
      }

      return {
        meta: {},
        valid: false
      };
    }

    function deVat(value) {
      var v = value;

      if (/^DE[0-9]{9}$/.test(v)) {
        v = v.substr(2);
      }

      if (!/^[0-9]{9}$/.test(v)) {
        return {
          meta: {},
          valid: false
        };
      }

      return {
        meta: {},
        valid: mod11And10(v)
      };
    }

    function dkVat(value) {
      var v = value;

      if (/^DK[0-9]{8}$/.test(v)) {
        v = v.substr(2);
      }

      if (!/^[0-9]{8}$/.test(v)) {
        return {
          meta: {},
          valid: false
        };
      }

      var sum = 0;
      var weight = [2, 7, 6, 5, 4, 3, 2, 1];

      for (var i = 0; i < 8; i++) {
        sum += parseInt(v.charAt(i), 10) * weight[i];
      }

      return {
        meta: {},
        valid: sum % 11 === 0
      };
    }

    function eeVat(value) {
      var v = value;

      if (/^EE[0-9]{9}$/.test(v)) {
        v = v.substr(2);
      }

      if (!/^[0-9]{9}$/.test(v)) {
        return {
          meta: {},
          valid: false
        };
      }

      var sum = 0;
      var weight = [3, 7, 1, 3, 7, 1, 3, 7, 1];

      for (var i = 0; i < 9; i++) {
        sum += parseInt(v.charAt(i), 10) * weight[i];
      }

      return {
        meta: {},
        valid: sum % 10 === 0
      };
    }

    function esVat(value) {
      var v = value;

      if (/^ES[0-9A-Z][0-9]{7}[0-9A-Z]$/.test(v)) {
        v = v.substr(2);
      }

      if (!/^[0-9A-Z][0-9]{7}[0-9A-Z]$/.test(v)) {
        return {
          meta: {},
          valid: false
        };
      }

      var dni = function dni(input) {
        var check = parseInt(input.substr(0, 8), 10);
        return "".concat('TRWAGMYFPDXBNJZSQVHLCKE'[check % 23]) === input.substr(8, 1);
      };

      var nie = function nie(input) {
        var check = ['XYZ'.indexOf(input.charAt(0)), input.substr(1)].join('');
        var cd = 'TRWAGMYFPDXBNJZSQVHLCKE'[parseInt(check, 10) % 23];
        return "".concat(cd) === input.substr(8, 1);
      };

      var cif = function cif(input) {
        var firstChar = input.charAt(0);
        var check;

        if ('KLM'.indexOf(firstChar) !== -1) {
          check = parseInt(input.substr(1, 8), 10);
          check = 'TRWAGMYFPDXBNJZSQVHLCKE'[check % 23];
          return "".concat(check) === input.substr(8, 1);
        } else if ('ABCDEFGHJNPQRSUVW'.indexOf(firstChar) !== -1) {
          var weight = [2, 1, 2, 1, 2, 1, 2];
          var sum = 0;
          var temp = 0;

          for (var i = 0; i < 7; i++) {
            temp = parseInt(input.charAt(i + 1), 10) * weight[i];

            if (temp > 9) {
              temp = Math.floor(temp / 10) + temp % 10;
            }

            sum += temp;
          }

          sum = 10 - sum % 10;

          if (sum === 10) {
            sum = 0;
          }

          return "".concat(sum) === input.substr(8, 1) || 'JABCDEFGHI'[sum] === input.substr(8, 1);
        }

        return false;
      };

      var first = v.charAt(0);

      if (/^[0-9]$/.test(first)) {
        return {
          meta: {
            type: 'DNI'
          },
          valid: dni(v)
        };
      } else if (/^[XYZ]$/.test(first)) {
        return {
          meta: {
            type: 'NIE'
          },
          valid: nie(v)
        };
      } else {
        return {
          meta: {
            type: 'CIF'
          },
          valid: cif(v)
        };
      }
    }

    function fiVat(value) {
      var v = value;

      if (/^FI[0-9]{8}$/.test(v)) {
        v = v.substr(2);
      }

      if (!/^[0-9]{8}$/.test(v)) {
        return {
          meta: {},
          valid: false
        };
      }

      var weight = [7, 9, 10, 5, 8, 4, 2, 1];
      var sum = 0;

      for (var i = 0; i < 8; i++) {
        sum += parseInt(v.charAt(i), 10) * weight[i];
      }

      return {
        meta: {},
        valid: sum % 11 === 0
      };
    }

    function frVat(value) {
      var v = value;

      if (/^FR[0-9A-Z]{2}[0-9]{9}$/.test(v)) {
        v = v.substr(2);
      }

      if (!/^[0-9A-Z]{2}[0-9]{9}$/.test(v)) {
        return {
          meta: {},
          valid: false
        };
      }

      if (!luhn(v.substr(2))) {
        return {
          meta: {},
          valid: false
        };
      }

      if (/^[0-9]{2}$/.test(v.substr(0, 2))) {
        return {
          meta: {},
          valid: v.substr(0, 2) === "".concat(parseInt(v.substr(2) + '12', 10) % 97)
        };
      } else {
        var alphabet = '0123456789ABCDEFGHJKLMNPQRSTUVWXYZ';
        var check;

        if (/^[0-9]$/.test(v.charAt(0))) {
          check = alphabet.indexOf(v.charAt(0)) * 24 + alphabet.indexOf(v.charAt(1)) - 10;
        } else {
          check = alphabet.indexOf(v.charAt(0)) * 34 + alphabet.indexOf(v.charAt(1)) - 100;
        }

        return {
          meta: {},
          valid: (parseInt(v.substr(2), 10) + 1 + Math.floor(check / 11)) % 11 === check % 11
        };
      }
    }

    function gbVat(value) {
      var v = value;

      if (/^GB[0-9]{9}$/.test(v) || /^GB[0-9]{12}$/.test(v) || /^GBGD[0-9]{3}$/.test(v) || /^GBHA[0-9]{3}$/.test(v) || /^GB(GD|HA)8888[0-9]{5}$/.test(v)) {
        v = v.substr(2);
      }

      if (!/^[0-9]{9}$/.test(v) && !/^[0-9]{12}$/.test(v) && !/^GD[0-9]{3}$/.test(v) && !/^HA[0-9]{3}$/.test(v) && !/^(GD|HA)8888[0-9]{5}$/.test(v)) {
        return {
          meta: {},
          valid: false
        };
      }

      var length = v.length;

      if (length === 5) {
        var firstTwo = v.substr(0, 2);
        var lastThree = parseInt(v.substr(2), 10);
        return {
          meta: {},
          valid: 'GD' === firstTwo && lastThree < 500 || 'HA' === firstTwo && lastThree >= 500
        };
      } else if (length === 11 && ('GD8888' === v.substr(0, 6) || 'HA8888' === v.substr(0, 6))) {
        if ('GD' === v.substr(0, 2) && parseInt(v.substr(6, 3), 10) >= 500 || 'HA' === v.substr(0, 2) && parseInt(v.substr(6, 3), 10) < 500) {
          return {
            meta: {},
            valid: false
          };
        }

        return {
          meta: {},
          valid: parseInt(v.substr(6, 3), 10) % 97 === parseInt(v.substr(9, 2), 10)
        };
      } else if (length === 9 || length === 12) {
        var weight = [8, 7, 6, 5, 4, 3, 2, 10, 1];
        var sum = 0;

        for (var i = 0; i < 9; i++) {
          sum += parseInt(v.charAt(i), 10) * weight[i];
        }

        sum = sum % 97;
        var isValid = parseInt(v.substr(0, 3), 10) >= 100 ? sum === 0 || sum === 42 || sum === 55 : sum === 0;
        return {
          meta: {},
          valid: isValid
        };
      }

      return {
        meta: {},
        valid: true
      };
    }

    function grVat(value) {
      var v = value;

      if (/^(GR|EL)[0-9]{9}$/.test(v)) {
        v = v.substr(2);
      }

      if (!/^[0-9]{9}$/.test(v)) {
        return {
          meta: {},
          valid: false
        };
      }

      if (v.length === 8) {
        v = "0".concat(v);
      }

      var weight = [256, 128, 64, 32, 16, 8, 4, 2];
      var sum = 0;

      for (var i = 0; i < 8; i++) {
        sum += parseInt(v.charAt(i), 10) * weight[i];
      }

      sum = sum % 11 % 10;
      return {
        meta: {},
        valid: "".concat(sum) === v.substr(8, 1)
      };
    }

    function hrVat(value) {
      var v = value;

      if (/^HR[0-9]{11}$/.test(v)) {
        v = v.substr(2);
      }

      if (!/^[0-9]{11}$/.test(v)) {
        return {
          meta: {},
          valid: false
        };
      }

      return {
        meta: {},
        valid: mod11And10(v)
      };
    }

    function huVat(value) {
      var v = value;

      if (/^HU[0-9]{8}$/.test(v)) {
        v = v.substr(2);
      }

      if (!/^[0-9]{8}$/.test(v)) {
        return {
          meta: {},
          valid: false
        };
      }

      var weight = [9, 7, 3, 1, 9, 7, 3, 1];
      var sum = 0;

      for (var i = 0; i < 8; i++) {
        sum += parseInt(v.charAt(i), 10) * weight[i];
      }

      return {
        meta: {},
        valid: sum % 10 === 0
      };
    }

    function ieVat(value) {
      var v = value;

      if (/^IE[0-9][0-9A-Z\*\+][0-9]{5}[A-Z]{1,2}$/.test(v)) {
        v = v.substr(2);
      }

      if (!/^[0-9][0-9A-Z\*\+][0-9]{5}[A-Z]{1,2}$/.test(v)) {
        return {
          meta: {},
          valid: false
        };
      }

      var getCheckDigit = function getCheckDigit(inp) {
        var input = inp;

        while (input.length < 7) {
          input = "0".concat(input);
        }

        var alphabet = 'WABCDEFGHIJKLMNOPQRSTUV';
        var sum = 0;

        for (var i = 0; i < 7; i++) {
          sum += parseInt(input.charAt(i), 10) * (8 - i);
        }

        sum += 9 * alphabet.indexOf(input.substr(7));
        return alphabet[sum % 23];
      };

      if (/^[0-9]+$/.test(v.substr(0, 7))) {
        return {
          meta: {},
          valid: v.charAt(7) === getCheckDigit("".concat(v.substr(0, 7)).concat(v.substr(8)))
        };
      } else if ('ABCDEFGHIJKLMNOPQRSTUVWXYZ+*'.indexOf(v.charAt(1)) !== -1) {
        return {
          meta: {},
          valid: v.charAt(7) === getCheckDigit("".concat(v.substr(2, 5)).concat(v.substr(0, 1)))
        };
      }

      return {
        meta: {},
        valid: true
      };
    }

    function isVat(value) {
      var v = value;

      if (/^IS[0-9]{5,6}$/.test(v)) {
        v = v.substr(2);
      }

      return {
        meta: {},
        valid: /^[0-9]{5,6}$/.test(v)
      };
    }

    function itVat(value) {
      var v = value;

      if (/^IT[0-9]{11}$/.test(v)) {
        v = v.substr(2);
      }

      if (!/^[0-9]{11}$/.test(v)) {
        return {
          meta: {},
          valid: false
        };
      }

      if (parseInt(v.substr(0, 7), 10) === 0) {
        return {
          meta: {},
          valid: false
        };
      }

      var lastThree = parseInt(v.substr(7, 3), 10);

      if (lastThree < 1 || lastThree > 201 && lastThree !== 999 && lastThree !== 888) {
        return {
          meta: {},
          valid: false
        };
      }

      return {
        meta: {},
        valid: luhn(v)
      };
    }

    function ltVat(value) {
      var v = value;

      if (/^LT([0-9]{7}1[0-9]|[0-9]{10}1[0-9])$/.test(v)) {
        v = v.substr(2);
      }

      if (!/^([0-9]{7}1[0-9]|[0-9]{10}1[0-9])$/.test(v)) {
        return {
          meta: {},
          valid: false
        };
      }

      var length = v.length;
      var sum = 0;
      var i;

      for (i = 0; i < length - 1; i++) {
        sum += parseInt(v.charAt(i), 10) * (1 + i % 9);
      }

      var check = sum % 11;

      if (check === 10) {
        sum = 0;

        for (i = 0; i < length - 1; i++) {
          sum += parseInt(v.charAt(i), 10) * (1 + (i + 2) % 9);
        }
      }

      check = check % 11 % 10;
      return {
        meta: {},
        valid: "".concat(check) === v.charAt(length - 1)
      };
    }

    function luVat(value) {
      var v = value;

      if (/^LU[0-9]{8}$/.test(v)) {
        v = v.substr(2);
      }

      if (!/^[0-9]{8}$/.test(v)) {
        return {
          meta: {},
          valid: false
        };
      }

      return {
        meta: {},
        valid: "".concat(parseInt(v.substr(0, 6), 10) % 89) === v.substr(6, 2)
      };
    }

    function lv(value) {
      var v = value;

      if (/^LV[0-9]{11}$/.test(v)) {
        v = v.substr(2);
      }

      if (!/^[0-9]{11}$/.test(v)) {
        return {
          meta: {},
          valid: false
        };
      }

      var first = parseInt(v.charAt(0), 10);
      var length = v.length;
      var sum = 0;
      var weight = [];
      var i;

      if (first > 3) {
        sum = 0;
        weight = [9, 1, 4, 8, 3, 10, 2, 5, 7, 6, 1];

        for (i = 0; i < length; i++) {
          sum += parseInt(v.charAt(i), 10) * weight[i];
        }

        sum = sum % 11;
        return {
          meta: {},
          valid: sum === 3
        };
      } else {
        var day = parseInt(v.substr(0, 2), 10);
        var month = parseInt(v.substr(2, 2), 10);
        var year = parseInt(v.substr(4, 2), 10);
        year = year + 1800 + parseInt(v.charAt(6), 10) * 100;

        if (!isValidDate(year, month, day)) {
          return {
            meta: {},
            valid: false
          };
        }

        sum = 0;
        weight = [10, 5, 8, 4, 2, 1, 6, 3, 7, 9];

        for (i = 0; i < length - 1; i++) {
          sum += parseInt(v.charAt(i), 10) * weight[i];
        }

        sum = (sum + 1) % 11 % 10;
        return {
          meta: {},
          valid: "".concat(sum) === v.charAt(length - 1)
        };
      }
    }

    function mtVat(value) {
      var v = value;

      if (/^MT[0-9]{8}$/.test(v)) {
        v = v.substr(2);
      }

      if (!/^[0-9]{8}$/.test(v)) {
        return {
          meta: {},
          valid: false
        };
      }

      var weight = [3, 4, 6, 7, 8, 9, 10, 1];
      var sum = 0;

      for (var i = 0; i < 8; i++) {
        sum += parseInt(v.charAt(i), 10) * weight[i];
      }

      return {
        meta: {},
        valid: sum % 37 === 0
      };
    }

    function nlVat(value) {
      var v = value;

      if (/^NL[0-9]{9}B[0-9]{2}$/.test(v)) {
        v = v.substr(2);
      }

      if (!/^[0-9]{9}B[0-9]{2}$/.test(v)) {
        return {
          meta: {},
          valid: false
        };
      }

      var weight = [9, 8, 7, 6, 5, 4, 3, 2];
      var sum = 0;

      for (var i = 0; i < 8; i++) {
        sum += parseInt(v.charAt(i), 10) * weight[i];
      }

      sum = sum % 11;

      if (sum > 9) {
        sum = 0;
      }

      return {
        meta: {},
        valid: "".concat(sum) === v.substr(8, 1)
      };
    }

    function noVat(value) {
      var v = value;

      if (/^NO[0-9]{9}$/.test(v)) {
        v = v.substr(2);
      }

      if (!/^[0-9]{9}$/.test(v)) {
        return {
          meta: {},
          valid: false
        };
      }

      var weight = [3, 2, 7, 6, 5, 4, 3, 2];
      var sum = 0;

      for (var i = 0; i < 8; i++) {
        sum += parseInt(v.charAt(i), 10) * weight[i];
      }

      sum = 11 - sum % 11;

      if (sum === 11) {
        sum = 0;
      }

      return {
        meta: {},
        valid: "".concat(sum) === v.substr(8, 1)
      };
    }

    function plVat(value) {
      var v = value;

      if (/^PL[0-9]{10}$/.test(v)) {
        v = v.substr(2);
      }

      if (!/^[0-9]{10}$/.test(v)) {
        return {
          meta: {},
          valid: false
        };
      }

      var weight = [6, 5, 7, 2, 3, 4, 5, 6, 7, -1];
      var sum = 0;

      for (var i = 0; i < 10; i++) {
        sum += parseInt(v.charAt(i), 10) * weight[i];
      }

      return {
        meta: {},
        valid: sum % 11 === 0
      };
    }

    function ptVat(value) {
      var v = value;

      if (/^PT[0-9]{9}$/.test(v)) {
        v = v.substr(2);
      }

      if (!/^[0-9]{9}$/.test(v)) {
        return {
          meta: {},
          valid: false
        };
      }

      var weight = [9, 8, 7, 6, 5, 4, 3, 2];
      var sum = 0;

      for (var i = 0; i < 8; i++) {
        sum += parseInt(v.charAt(i), 10) * weight[i];
      }

      sum = 11 - sum % 11;

      if (sum > 9) {
        sum = 0;
      }

      return {
        meta: {},
        valid: "".concat(sum) === v.substr(8, 1)
      };
    }

    function roVat(value) {
      var v = value;

      if (/^RO[1-9][0-9]{1,9}$/.test(v)) {
        v = v.substr(2);
      }

      if (!/^[1-9][0-9]{1,9}$/.test(v)) {
        return {
          meta: {},
          valid: false
        };
      }

      var length = v.length;
      var weight = [7, 5, 3, 2, 1, 7, 5, 3, 2].slice(10 - length);
      var sum = 0;

      for (var i = 0; i < length - 1; i++) {
        sum += parseInt(v.charAt(i), 10) * weight[i];
      }

      sum = 10 * sum % 11 % 10;
      return {
        meta: {},
        valid: "".concat(sum) === v.substr(length - 1, 1)
      };
    }

    function rsVat(value) {
      var v = value;

      if (/^RS[0-9]{9}$/.test(v)) {
        v = v.substr(2);
      }

      if (!/^[0-9]{9}$/.test(v)) {
        return {
          meta: {},
          valid: false
        };
      }

      var sum = 10;
      var temp = 0;

      for (var i = 0; i < 8; i++) {
        temp = (parseInt(v.charAt(i), 10) + sum) % 10;

        if (temp === 0) {
          temp = 10;
        }

        sum = 2 * temp % 11;
      }

      return {
        meta: {},
        valid: (sum + parseInt(v.substr(8, 1), 10)) % 10 === 1
      };
    }

    function ruVat(value) {
      var v = value;

      if (/^RU([0-9]{10}|[0-9]{12})$/.test(v)) {
        v = v.substr(2);
      }

      if (!/^([0-9]{10}|[0-9]{12})$/.test(v)) {
        return {
          meta: {},
          valid: false
        };
      }

      var i = 0;

      if (v.length === 10) {
        var weight = [2, 4, 10, 3, 5, 9, 4, 6, 8, 0];
        var sum = 0;

        for (i = 0; i < 10; i++) {
          sum += parseInt(v.charAt(i), 10) * weight[i];
        }

        sum = sum % 11;

        if (sum > 9) {
          sum = sum % 10;
        }

        return {
          meta: {},
          valid: "".concat(sum) === v.substr(9, 1)
        };
      } else if (v.length === 12) {
        var weight1 = [7, 2, 4, 10, 3, 5, 9, 4, 6, 8, 0];
        var weight2 = [3, 7, 2, 4, 10, 3, 5, 9, 4, 6, 8, 0];
        var sum1 = 0;
        var sum2 = 0;

        for (i = 0; i < 11; i++) {
          sum1 += parseInt(v.charAt(i), 10) * weight1[i];
          sum2 += parseInt(v.charAt(i), 10) * weight2[i];
        }

        sum1 = sum1 % 11;

        if (sum1 > 9) {
          sum1 = sum1 % 10;
        }

        sum2 = sum2 % 11;

        if (sum2 > 9) {
          sum2 = sum2 % 10;
        }

        return {
          meta: {},
          valid: "".concat(sum1) === v.substr(10, 1) && "".concat(sum2) === v.substr(11, 1)
        };
      }

      return {
        meta: {},
        valid: true
      };
    }

    function seVat(value) {
      var v = value;

      if (/^SE[0-9]{10}01$/.test(v)) {
        v = v.substr(2);
      }

      if (!/^[0-9]{10}01$/.test(v)) {
        return {
          meta: {},
          valid: false
        };
      }

      v = v.substr(0, 10);
      return {
        meta: {},
        valid: luhn(v)
      };
    }

    function siVat(value) {
      var res = value.match(/^(SI)?([1-9][0-9]{7})$/);

      if (!res) {
        return {
          meta: {},
          valid: false
        };
      }

      var v = res[1] ? value.substr(2) : value;
      var weight = [8, 7, 6, 5, 4, 3, 2];
      var sum = 0;

      for (var i = 0; i < 7; i++) {
        sum += parseInt(v.charAt(i), 10) * weight[i];
      }

      sum = 11 - sum % 11;

      if (sum === 10) {
        sum = 0;
      }

      return {
        meta: {},
        valid: "".concat(sum) === v.substr(7, 1)
      };
    }

    function skVat(value) {
      var v = value;

      if (/^SK[1-9][0-9][(2-4)|(6-9)][0-9]{7}$/.test(v)) {
        v = v.substr(2);
      }

      if (!/^[1-9][0-9][(2-4)|(6-9)][0-9]{7}$/.test(v)) {
        return {
          meta: {},
          valid: false
        };
      }

      return {
        meta: {},
        valid: parseInt(v, 10) % 11 === 0
      };
    }

    function veVat(value) {
      var v = value;

      if (/^VE[VEJPG][0-9]{9}$/.test(v)) {
        v = v.substr(2);
      }

      if (!/^[VEJPG][0-9]{9}$/.test(v)) {
        return {
          meta: {},
          valid: false
        };
      }

      var types = {
        E: 8,
        G: 20,
        J: 12,
        P: 16,
        V: 4
      };
      var weight = [3, 2, 7, 6, 5, 4, 3, 2];
      var sum = types[v.charAt(0)];

      for (var i = 0; i < 8; i++) {
        sum += parseInt(v.charAt(i + 1), 10) * weight[i];
      }

      sum = 11 - sum % 11;

      if (sum === 11 || sum === 10) {
        sum = 0;
      }

      return {
        meta: {},
        valid: "".concat(sum) === v.substr(9, 1)
      };
    }

    function zaVat(value) {
      var v = value;

      if (/^ZA4[0-9]{9}$/.test(v)) {
        v = v.substr(2);
      }

      return {
        meta: {},
        valid: /^4[0-9]{9}$/.test(v)
      };
    }

    function vat() {
      var COUNTRY_CODES = ['AR', 'AT', 'BE', 'BG', 'BR', 'CH', 'CY', 'CZ', 'DE', 'DK', 'EE', 'EL', 'ES', 'FI', 'FR', 'GB', 'GR', 'HR', 'HU', 'IE', 'IS', 'IT', 'LT', 'LU', 'LV', 'MT', 'NL', 'NO', 'PL', 'PT', 'RO', 'RU', 'RS', 'SE', 'SK', 'SI', 'VE', 'ZA'];
      return {
        validate: function validate(input) {
          var value = input.value;

          if (value === '') {
            return {
              valid: true
            };
          }

          var opts = Object.assign({}, {
            message: ''
          }, input.options);
          var country = value.substr(0, 2);

          if ('function' === typeof opts.country) {
            country = opts.country.call(this);
          } else {
            country = opts.country;
          }

          if (COUNTRY_CODES.indexOf(country) === -1) {
            return {
              valid: true
            };
          }

          var result = {
            meta: {},
            valid: true
          };

          switch (country.toLowerCase()) {
            case 'ar':
              result = arVat(value);
              break;

            case 'at':
              result = atVat(value);
              break;

            case 'be':
              result = beVat(value);
              break;

            case 'bg':
              result = bgVat(value);
              break;

            case 'br':
              result = brVat(value);
              break;

            case 'ch':
              result = chVat(value);
              break;

            case 'cy':
              result = cyVat(value);
              break;

            case 'cz':
              result = czVat(value);
              break;

            case 'de':
              result = deVat(value);
              break;

            case 'dk':
              result = dkVat(value);
              break;

            case 'ee':
              result = eeVat(value);
              break;

            case 'el':
              result = grVat(value);
              break;

            case 'es':
              result = esVat(value);
              break;

            case 'fi':
              result = fiVat(value);
              break;

            case 'fr':
              result = frVat(value);
              break;

            case 'gb':
              result = gbVat(value);
              break;

            case 'gr':
              result = grVat(value);
              break;

            case 'hr':
              result = hrVat(value);
              break;

            case 'hu':
              result = huVat(value);
              break;

            case 'ie':
              result = ieVat(value);
              break;

            case 'is':
              result = isVat(value);
              break;

            case 'it':
              result = itVat(value);
              break;

            case 'lt':
              result = ltVat(value);
              break;

            case 'lu':
              result = luVat(value);
              break;

            case 'lv':
              result = lv(value);
              break;

            case 'mt':
              result = mtVat(value);
              break;

            case 'nl':
              result = nlVat(value);
              break;

            case 'no':
              result = noVat(value);
              break;

            case 'pl':
              result = plVat(value);
              break;

            case 'pt':
              result = ptVat(value);
              break;

            case 'ro':
              result = roVat(value);
              break;

            case 'rs':
              result = rsVat(value);
              break;

            case 'ru':
              result = ruVat(value);
              break;

            case 'se':
              result = seVat(value);
              break;

            case 'si':
              result = siVat(value);
              break;

            case 'sk':
              result = skVat(value);
              break;

            case 've':
              result = veVat(value);
              break;

            case 'za':
              result = zaVat(value);
              break;
          }

          var message = format(input.l10n ? opts.message || input.l10n.vat.country : opts.message, input.l10n ? input.l10n.vat.countries[country.toUpperCase()] : country.toUpperCase());
          return Object.assign({}, {
            message: message
          }, result);
        }
      };
    }

    function vin() {
      return {
        validate: function validate(input) {
          if (input.value === '') {
            return {
              valid: true
            };
          }

          if (!/^[a-hj-npr-z0-9]{8}[0-9xX][a-hj-npr-z0-9]{8}$/i.test(input.value)) {
            return {
              valid: false
            };
          }

          var v = input.value.toUpperCase();
          var chars = {
            A: 1,
            B: 2,
            C: 3,
            D: 4,
            E: 5,
            F: 6,
            G: 7,
            H: 8,
            J: 1,
            K: 2,
            L: 3,
            M: 4,
            N: 5,
            P: 7,
            R: 9,
            S: 2,
            T: 3,
            U: 4,
            V: 5,
            W: 6,
            X: 7,
            Y: 8,
            Z: 9,
            0: 0,
            1: 1,
            2: 2,
            3: 3,
            4: 4,
            5: 5,
            6: 6,
            7: 7,
            8: 8,
            9: 9
          };
          var weights = [8, 7, 6, 5, 4, 3, 2, 10, 0, 9, 8, 7, 6, 5, 4, 3, 2];
          var length = v.length;
          var sum = 0;

          for (var i = 0; i < length; i++) {
            sum += chars["".concat(v.charAt(i))] * weights[i];
          }

          var reminder = "".concat(sum % 11);

          if (reminder === '10') {
            reminder = 'X';
          }

          return {
            valid: reminder === v.charAt(8)
          };
        }
      };
    }

    function zipCode() {
      var COUNTRY_CODES = ['AT', 'BG', 'BR', 'CA', 'CH', 'CZ', 'DE', 'DK', 'ES', 'FR', 'GB', 'IE', 'IN', 'IT', 'MA', 'NL', 'PL', 'PT', 'RO', 'RU', 'SE', 'SG', 'SK', 'US'];

      var gb = function gb(value) {
        var firstChar = '[ABCDEFGHIJKLMNOPRSTUWYZ]';
        var secondChar = '[ABCDEFGHKLMNOPQRSTUVWXY]';
        var thirdChar = '[ABCDEFGHJKPMNRSTUVWXY]';
        var fourthChar = '[ABEHMNPRVWXY]';
        var fifthChar = '[ABDEFGHJLNPQRSTUWXYZ]';
        var regexps = [new RegExp("^(".concat(firstChar, "{1}").concat(secondChar, "?[0-9]{1,2})(\\s*)([0-9]{1}").concat(fifthChar, "{2})$"), 'i'), new RegExp("^(".concat(firstChar, "{1}[0-9]{1}").concat(thirdChar, "{1})(\\s*)([0-9]{1}").concat(fifthChar, "{2})$"), 'i'), new RegExp("^(".concat(firstChar, "{1}").concat(secondChar, "{1}?[0-9]{1}").concat(fourthChar, "{1})(\\s*)([0-9]{1}").concat(fifthChar, "{2})$"), 'i'), new RegExp('^(BF1)(\\s*)([0-6]{1}[ABDEFGHJLNPQRST]{1}[ABDEFGHJLNPQRSTUWZYZ]{1})$', 'i'), /^(GIR)(\s*)(0AA)$/i, /^(BFPO)(\s*)([0-9]{1,4})$/i, /^(BFPO)(\s*)(c\/o\s*[0-9]{1,3})$/i, /^([A-Z]{4})(\s*)(1ZZ)$/i, /^(AI-2640)$/i];

        for (var _i = 0, _regexps = regexps; _i < _regexps.length; _i++) {
          var reg = _regexps[_i];

          if (reg.test(value)) {
            return true;
          }
        }

        return false;
      };

      return {
        validate: function validate(input) {
          var opts = Object.assign({}, input.options);

          if (input.value === '' || !opts.country) {
            return {
              valid: true
            };
          }

          var country = input.value.substr(0, 2);

          if ('function' === typeof opts.country) {
            country = opts.country.call(this);
          } else {
            country = opts.country;
          }

          if (!country || COUNTRY_CODES.indexOf(country.toUpperCase()) === -1) {
            return {
              valid: true
            };
          }

          var isValid = false;
          country = country.toUpperCase();

          switch (country) {
            case 'AT':
              isValid = /^([1-9]{1})(\d{3})$/.test(input.value);
              break;

            case 'BG':
              isValid = /^([1-9]{1}[0-9]{3})$/.test(input.value);
              break;

            case 'BR':
              isValid = /^(\d{2})([\.]?)(\d{3})([\-]?)(\d{3})$/.test(input.value);
              break;

            case 'CA':
              isValid = /^(?:A|B|C|E|G|H|J|K|L|M|N|P|R|S|T|V|X|Y){1}[0-9]{1}(?:A|B|C|E|G|H|J|K|L|M|N|P|R|S|T|V|W|X|Y|Z){1}\s?[0-9]{1}(?:A|B|C|E|G|H|J|K|L|M|N|P|R|S|T|V|W|X|Y|Z){1}[0-9]{1}$/i.test(input.value);
              break;

            case 'CH':
              isValid = /^([1-9]{1})(\d{3})$/.test(input.value);
              break;

            case 'CZ':
              isValid = /^(\d{3})([ ]?)(\d{2})$/.test(input.value);
              break;

            case 'DE':
              isValid = /^(?!01000|99999)(0[1-9]\d{3}|[1-9]\d{4})$/.test(input.value);
              break;

            case 'DK':
              isValid = /^(DK(-|\s)?)?\d{4}$/i.test(input.value);
              break;

            case 'ES':
              isValid = /^(?:0[1-9]|[1-4][0-9]|5[0-2])\d{3}$/.test(input.value);
              break;

            case 'FR':
              isValid = /^[0-9]{5}$/i.test(input.value);
              break;

            case 'GB':
              isValid = gb(input.value);
              break;

            case 'IN':
              isValid = /^\d{3}\s?\d{3}$/.test(input.value);
              break;

            case 'IE':
              isValid = /^(D6W|[ACDEFHKNPRTVWXY]\d{2})\s[0-9ACDEFHKNPRTVWXY]{4}$/.test(input.value);
              break;

            case 'IT':
              isValid = /^(I-|IT-)?\d{5}$/i.test(input.value);
              break;

            case 'MA':
              isValid = /^[1-9][0-9]{4}$/i.test(input.value);
              break;

            case 'NL':
              isValid = /^[1-9][0-9]{3} ?(?!sa|sd|ss)[a-z]{2}$/i.test(input.value);
              break;

            case 'PL':
              isValid = /^[0-9]{2}\-[0-9]{3}$/.test(input.value);
              break;

            case 'PT':
              isValid = /^[1-9]\d{3}-\d{3}$/.test(input.value);
              break;

            case 'RO':
              isValid = /^(0[1-8]{1}|[1-9]{1}[0-5]{1})?[0-9]{4}$/i.test(input.value);
              break;

            case 'RU':
              isValid = /^[0-9]{6}$/i.test(input.value);
              break;

            case 'SE':
              isValid = /^(S-)?\d{3}\s?\d{2}$/i.test(input.value);
              break;

            case 'SG':
              isValid = /^([0][1-9]|[1-6][0-9]|[7]([0-3]|[5-9])|[8][0-2])(\d{4})$/i.test(input.value);
              break;

            case 'SK':
              isValid = /^(\d{3})([ ]?)(\d{2})$/.test(input.value);
              break;

            case 'US':
            default:
              isValid = /^\d{4,5}([\-]?\d{4})?$/.test(input.value);
              break;
          }

          return {
            message: format(input.l10n ? opts.message || input.l10n.zipCode.country : opts.message, input.l10n ? input.l10n.zipCode.countries[country] : country),
            valid: isValid
          };
        }
      };
    }

    var validators = {
      between: between,
      blank: blank,
      callback: callback,
      choice: choice,
      creditCard: creditCard,
      date: date,
      different: different,
      digits: digits,
      emailAddress: emailAddress,
      file: file,
      greaterThan: greaterThan,
      identical: identical,
      integer: integer,
      ip: ip,
      lessThan: lessThan,
      notEmpty: notEmpty,
      numeric: numeric,
      promise: promise,
      regexp: regexp,
      remote: remote,
      stringCase: stringCase,
      stringLength: stringLength,
      uri: uri,
      base64: base64,
      bic: bic,
      color: color,
      cusip: cusip,
      ean: ean,
      ein: ein,
      grid: grid,
      hex: hex,
      iban: iban,
      id: id,
      imei: imei,
      imo: imo,
      isbn: isbn,
      isin: isin,
      ismn: ismn,
      issn: issn,
      mac: mac,
      meid: meid,
      phone: phone,
      rtn: rtn,
      sedol: sedol,
      siren: siren,
      siret: siret,
      step: step,
      uuid: uuid,
      vat: vat,
      vin: vin,
      zipCode: zipCode
    };

    var Core =
    /*#__PURE__*/
    function () {
      function Core(form, fields) {
        _classCallCheck(this, Core);

        this.elements = {};
        this.ee = emitter();
        this.filter = filter();
        this.plugins = {};
        this.results = new Map();
        this.validators = {};
        this.form = form;
        this.fields = fields;
      }

      _createClass(Core, [{
        key: "on",
        value: function on(event, func) {
          this.ee.on(event, func);
          return this;
        }
      }, {
        key: "off",
        value: function off(event, func) {
          this.ee.off(event, func);
          return this;
        }
      }, {
        key: "emit",
        value: function emit(event) {
          var _this$ee;

          for (var _len = arguments.length, args = new Array(_len > 1 ? _len - 1 : 0), _key = 1; _key < _len; _key++) {
            args[_key - 1] = arguments[_key];
          }

          (_this$ee = this.ee).emit.apply(_this$ee, [event].concat(args));

          return this;
        }
      }, {
        key: "registerPlugin",
        value: function registerPlugin(name, plugin) {
          if (this.plugins[name]) {
            throw new Error("The plguin ".concat(name, " is registered"));
          }

          plugin.setCore(this);
          plugin.install();
          this.plugins[name] = plugin;
          return this;
        }
      }, {
        key: "deregisterPlugin",
        value: function deregisterPlugin(name) {
          var plugin = this.plugins[name];

          if (plugin) {
            plugin.uninstall();
          }

          delete this.plugins[name];
          return this;
        }
      }, {
        key: "registerValidator",
        value: function registerValidator(name, func) {
          if (this.validators[name]) {
            throw new Error("The validator ".concat(name, " is registered"));
          }

          this.validators[name] = func;
          return this;
        }
      }, {
        key: "registerFilter",
        value: function registerFilter(name, func) {
          this.filter.add(name, func);
          return this;
        }
      }, {
        key: "deregisterFilter",
        value: function deregisterFilter(name, func) {
          this.filter.remove(name, func);
          return this;
        }
      }, {
        key: "executeFilter",
        value: function executeFilter(name, defaultValue, args) {
          return this.filter.execute(name, defaultValue, args);
        }
      }, {
        key: "addField",
        value: function addField(field, options) {
          var opts = Object.assign({}, {
            selector: '',
            validators: {}
          }, options);
          this.fields[field] = this.fields[field] ? {
            selector: opts.selector || this.fields[field].selector,
            validators: Object.assign({}, this.fields[field].validators, opts.validators)
          } : opts;
          this.elements[field] = this.queryElements(field);
          this.emit('core.field.added', {
            elements: this.elements[field],
            field: field,
            options: this.fields[field]
          });
          return this;
        }
      }, {
        key: "removeField",
        value: function removeField(field) {
          if (!this.fields[field]) {
            throw new Error("The field ".concat(field, " validators are not defined. Please ensure the field is added first"));
          }

          var elements = this.elements[field];
          var options = this.fields[field];
          delete this.elements[field];
          delete this.fields[field];
          this.emit('core.field.removed', {
            elements: elements,
            field: field,
            options: options
          });
          return this;
        }
      }, {
        key: "validate",
        value: function validate() {
          var _this = this;

          this.emit('core.form.validating');
          return this.filter.execute('validate-pre', Promise.resolve(), []).then(function () {
            return Promise.all(Object.keys(_this.fields).map(function (field) {
              return _this.validateField(field);
            })).then(function (results) {
              switch (true) {
                case results.indexOf('Invalid') !== -1:
                  _this.emit('core.form.invalid');

                  return Promise.resolve('Invalid');

                case results.indexOf('NotValidated') !== -1:
                  _this.emit('core.form.notvalidated');

                  return Promise.resolve('NotValidated');

                default:
                  _this.emit('core.form.valid');

                  return Promise.resolve('Valid');
              }
            });
          });
        }
      }, {
        key: "validateField",
        value: function validateField(field) {
          var _this2 = this;

          var result = this.results.get(field);

          if (result === 'Valid' || result === 'Invalid') {
            return Promise.resolve(result);
          }

          this.emit('core.field.validating', field);
          var elements = this.elements[field];

          if (elements.length === 0) {
            this.emit('core.field.valid', field);
            return Promise.resolve('Valid');
          }

          var type = elements[0].getAttribute('type');

          if ('radio' === type || 'checkbox' === type || elements.length === 1) {
            return this.validateElement(field, elements[0]);
          } else {
            return Promise.all(elements.map(function (ele) {
              return _this2.validateElement(field, ele);
            })).then(function (results) {
              switch (true) {
                case results.indexOf('Invalid') !== -1:
                  _this2.emit('core.field.invalid', field);

                  _this2.results.set(field, 'Invalid');

                  return Promise.resolve('Invalid');

                case results.indexOf('NotValidated') !== -1:
                  _this2.emit('core.field.notvalidated', field);

                  _this2.results["delete"](field);

                  return Promise.resolve('NotValidated');

                default:
                  _this2.emit('core.field.valid', field);

                  _this2.results.set(field, 'Valid');

                  return Promise.resolve('Valid');
              }
            });
          }
        }
      }, {
        key: "validateElement",
        value: function validateElement(field, ele) {
          var _this3 = this;

          this.results["delete"](field);
          var elements = this.elements[field];
          var ignored = this.filter.execute('element-ignored', false, [field, ele, elements]);

          if (ignored) {
            this.emit('core.element.ignored', {
              element: ele,
              elements: elements,
              field: field
            });
            return Promise.resolve('Ignored');
          }

          var validatorList = this.fields[field].validators;
          this.emit('core.element.validating', {
            element: ele,
            elements: elements,
            field: field
          });
          var promises = Object.keys(validatorList).map(function (v) {
            return function () {
              return _this3.executeValidator(field, ele, v, validatorList[v]);
            };
          });
          return this.waterfall(promises).then(function (results) {
            var isValid = results.indexOf('Invalid') === -1;

            _this3.emit('core.element.validated', {
              element: ele,
              elements: elements,
              field: field,
              valid: isValid
            });

            var type = ele.getAttribute('type');

            if ('radio' === type || 'checkbox' === type || elements.length === 1) {
              _this3.emit(isValid ? 'core.field.valid' : 'core.field.invalid', field);
            }

            return Promise.resolve(isValid ? 'Valid' : 'Invalid');
          })["catch"](function (reason) {
            _this3.emit('core.element.notvalidated', {
              element: ele,
              elements: elements,
              field: field
            });

            return Promise.resolve(reason);
          });
        }
      }, {
        key: "executeValidator",
        value: function executeValidator(field, ele, v, opts) {
          var _this4 = this;

          var elements = this.elements[field];
          var name = this.filter.execute('validator-name', v, [v, field]);
          opts.message = this.filter.execute('validator-message', opts.message, [this.locale, field, name]);

          if (!this.validators[name] || opts.enabled === false) {
            this.emit('core.validator.validated', {
              element: ele,
              elements: elements,
              field: field,
              result: this.normalizeResult(field, name, {
                valid: true
              }),
              validator: name
            });
            return Promise.resolve('Valid');
          }

          var validator = this.validators[name];
          var value = this.getElementValue(field, ele, name);
          var willValidate = this.filter.execute('field-should-validate', true, [field, ele, value, v]);

          if (!willValidate) {
            this.emit('core.validator.notvalidated', {
              element: ele,
              elements: elements,
              field: field,
              validator: v
            });
            return Promise.resolve('NotValidated');
          }

          this.emit('core.validator.validating', {
            element: ele,
            elements: elements,
            field: field,
            validator: v
          });
          var result = validator().validate({
            element: ele,
            elements: elements,
            field: field,
            l10n: this.localization,
            options: opts,
            value: value
          });
          var isPromise = 'function' === typeof result['then'];

          if (isPromise) {
            return result.then(function (r) {
              var data = _this4.normalizeResult(field, v, r);

              _this4.emit('core.validator.validated', {
                element: ele,
                elements: elements,
                field: field,
                result: data,
                validator: v
              });

              return data.valid ? 'Valid' : 'Invalid';
            });
          } else {
            var data = this.normalizeResult(field, v, result);
            this.emit('core.validator.validated', {
              element: ele,
              elements: elements,
              field: field,
              result: data,
              validator: v
            });
            return Promise.resolve(data.valid ? 'Valid' : 'Invalid');
          }
        }
      }, {
        key: "getElementValue",
        value: function getElementValue(field, ele, validator) {
          var defaultValue = getFieldValue(this.form, field, ele, this.elements[field]);
          return this.filter.execute('field-value', defaultValue, [defaultValue, field, ele, validator]);
        }
      }, {
        key: "getElements",
        value: function getElements(field) {
          return this.elements[field];
        }
      }, {
        key: "getFields",
        value: function getFields() {
          return this.fields;
        }
      }, {
        key: "getFormElement",
        value: function getFormElement() {
          return this.form;
        }
      }, {
        key: "getLocale",
        value: function getLocale() {
          return this.locale;
        }
      }, {
        key: "getPlugin",
        value: function getPlugin(name) {
          return this.plugins[name];
        }
      }, {
        key: "updateFieldStatus",
        value: function updateFieldStatus(field, status, validator) {
          var _this5 = this;

          var elements = this.elements[field];
          var type = elements[0].getAttribute('type');
          var list = 'radio' === type || 'checkbox' === type ? [elements[0]] : elements;
          list.forEach(function (ele) {
            return _this5.updateElementStatus(field, ele, status, validator);
          });

          if (!validator) {
            switch (status) {
              case 'NotValidated':
                this.emit('core.field.notvalidated', field);
                this.results["delete"](field);
                break;

              case 'Validating':
                this.emit('core.field.validating', field);
                this.results["delete"](field);
                break;

              case 'Valid':
                this.emit('core.field.valid', field);
                this.results.set(field, 'Valid');
                break;

              case 'Invalid':
                this.emit('core.field.invalid', field);
                this.results.set(field, 'Invalid');
                break;
            }
          }

          return this;
        }
      }, {
        key: "updateElementStatus",
        value: function updateElementStatus(field, ele, status, validator) {
          var _this6 = this;

          var elements = this.elements[field];
          var fieldValidators = this.fields[field].validators;
          var validatorArr = validator ? [validator] : Object.keys(fieldValidators);

          switch (status) {
            case 'NotValidated':
              validatorArr.forEach(function (v) {
                return _this6.emit('core.validator.notvalidated', {
                  element: ele,
                  elements: elements,
                  field: field,
                  validator: v
                });
              });
              this.emit('core.element.notvalidated', {
                element: ele,
                elements: elements,
                field: field
              });
              break;

            case 'Validating':
              validatorArr.forEach(function (v) {
                return _this6.emit('core.validator.validating', {
                  element: ele,
                  elements: elements,
                  field: field,
                  validator: v
                });
              });
              this.emit('core.element.validating', {
                element: ele,
                elements: elements,
                field: field
              });
              break;

            case 'Valid':
              validatorArr.forEach(function (v) {
                return _this6.emit('core.validator.validated', {
                  element: ele,
                  field: field,
                  result: {
                    message: fieldValidators[v].message,
                    valid: true
                  },
                  validator: v
                });
              });
              this.emit('core.element.validated', {
                element: ele,
                elements: elements,
                field: field,
                valid: true
              });
              break;

            case 'Invalid':
              validatorArr.forEach(function (v) {
                return _this6.emit('core.validator.validated', {
                  element: ele,
                  field: field,
                  result: {
                    message: fieldValidators[v].message,
                    valid: false
                  },
                  validator: v
                });
              });
              this.emit('core.element.validated', {
                element: ele,
                elements: elements,
                field: field,
                valid: false
              });
              break;
          }

          return this;
        }
      }, {
        key: "resetForm",
        value: function resetForm(reset) {
          var _this7 = this;

          Object.keys(this.fields).forEach(function (field) {
            return _this7.resetField(field, reset);
          });
          this.emit('core.form.reset', {
            reset: reset
          });
          return this;
        }
      }, {
        key: "resetField",
        value: function resetField(field, reset) {
          if (reset) {
            var elements = this.elements[field];
            var type = elements[0].getAttribute('type');
            elements.forEach(function (ele) {
              if ('radio' === type || 'checkbox' === type) {
                ele.removeAttribute('selected');
                ele.removeAttribute('checked');
                ele.checked = false;
              } else {
                ele.setAttribute('value', '');

                if (ele instanceof HTMLInputElement || ele instanceof HTMLTextAreaElement) {
                  ele.value = '';
                }
              }
            });
          }

          this.updateFieldStatus(field, 'NotValidated');
          this.emit('core.field.reset', {
            field: field,
            reset: reset
          });
          return this;
        }
      }, {
        key: "revalidateField",
        value: function revalidateField(field) {
          this.updateFieldStatus(field, 'NotValidated');
          return this.validateField(field);
        }
      }, {
        key: "disableValidator",
        value: function disableValidator(field, validator) {
          return this.toggleValidator(false, field, validator);
        }
      }, {
        key: "enableValidator",
        value: function enableValidator(field, validator) {
          return this.toggleValidator(true, field, validator);
        }
      }, {
        key: "updateValidatorOption",
        value: function updateValidatorOption(field, validator, name, value) {
          if (this.fields[field] && this.fields[field].validators && this.fields[field].validators[validator]) {
            this.fields[field].validators[validator][name] = value;
          }

          return this;
        }
      }, {
        key: "destroy",
        value: function destroy() {
          var _this8 = this;

          Object.keys(this.plugins).forEach(function (id) {
            return _this8.plugins[id].uninstall();
          });
          this.ee.clear();
          this.filter.clear();
          this.results.clear();
          this.plugins = {};
          return this;
        }
      }, {
        key: "setLocale",
        value: function setLocale(locale, localization) {
          this.locale = locale;
          this.localization = localization;
          return this;
        }
      }, {
        key: "waterfall",
        value: function waterfall(promises) {
          return promises.reduce(function (p, c, i, a) {
            return p.then(function (res) {
              return c().then(function (result) {
                res.push(result);
                return res;
              });
            });
          }, Promise.resolve([]));
        }
      }, {
        key: "queryElements",
        value: function queryElements(field) {
          var selector = this.fields[field].selector ? '#' === this.fields[field].selector.charAt(0) ? "[id=\"".concat(this.fields[field].selector.substring(1), "\"]") : this.fields[field].selector : "[name=\"".concat(field, "\"]");
          return [].slice.call(this.form.querySelectorAll(selector));
        }
      }, {
        key: "normalizeResult",
        value: function normalizeResult(field, validator, result) {
          var opts = this.fields[field].validators[validator];
          return Object.assign({}, result, {
            message: result.message || (opts ? opts.message : '') || (this.localization && this.localization[validator] && this.localization[validator]["default"] ? this.localization[validator]["default"] : '') || "The field ".concat(field, " is not valid")
          });
        }
      }, {
        key: "toggleValidator",
        value: function toggleValidator(enabled, field, validator) {
          var _this9 = this;

          var validatorArr = this.fields[field].validators;

          if (validator && validatorArr && validatorArr[validator]) {
            this.fields[field].validators[validator].enabled = enabled;
          } else if (!validator) {
            Object.keys(validatorArr).forEach(function (v) {
              return _this9.fields[field].validators[v].enabled = enabled;
            });
          }

          return this.updateFieldStatus(field, 'NotValidated', validator);
        }
      }]);

      return Core;
    }();

    function formValidation(form, options) {
      var opts = Object.assign({}, {
        fields: {},
        locale: 'en_US',
        plugins: {}
      }, options);
      var core = new Core(form, opts.fields);
      core.setLocale(opts.locale, opts.localization);
      Object.keys(opts.plugins).forEach(function (name) {
        return core.registerPlugin(name, opts.plugins[name]);
      });
      Object.keys(validators).forEach(function (name) {
        return core.registerValidator(name, validators[name]);
      });
      Object.keys(opts.fields).forEach(function (field) {
        return core.addField(field, opts.fields[field]);
      });
      return core;
    }

    var Plugin =
    /*#__PURE__*/
    function () {
      function Plugin(opts) {
        _classCallCheck(this, Plugin);

        this.opts = opts;
      }

      _createClass(Plugin, [{
        key: "setCore",
        value: function setCore(core) {
          this.core = core;
          return this;
        }
      }, {
        key: "install",
        value: function install() {}
      }, {
        key: "uninstall",
        value: function uninstall() {}
      }]);

      return Plugin;
    }();

    var index$1 = {
      getFieldValue: getFieldValue
    };

    var Alias =
    /*#__PURE__*/
    function (_Plugin) {
      _inherits(Alias, _Plugin);

      function Alias(opts) {
        var _this;

        _classCallCheck(this, Alias);

        _this = _possibleConstructorReturn(this, _getPrototypeOf(Alias).call(this, opts));
        _this.opts = opts || {};
        _this.validatorNameFilter = _this.getValidatorName.bind(_assertThisInitialized(_this));
        return _this;
      }

      _createClass(Alias, [{
        key: "install",
        value: function install() {
          this.core.registerFilter('validator-name', this.validatorNameFilter);
        }
      }, {
        key: "uninstall",
        value: function uninstall() {
          this.core.deregisterFilter('validator-name', this.validatorNameFilter);
        }
      }, {
        key: "getValidatorName",
        value: function getValidatorName(alias, field) {
          return this.opts[alias] || alias;
        }
      }]);

      return Alias;
    }(Plugin);

    var Aria =
    /*#__PURE__*/
    function (_Plugin) {
      _inherits(Aria, _Plugin);

      function Aria() {
        var _this;

        _classCallCheck(this, Aria);

        _this = _possibleConstructorReturn(this, _getPrototypeOf(Aria).call(this, {}));
        _this.elementValidatedHandler = _this.onElementValidated.bind(_assertThisInitialized(_this));
        _this.fieldValidHandler = _this.onFieldValid.bind(_assertThisInitialized(_this));
        _this.fieldInvalidHandler = _this.onFieldInvalid.bind(_assertThisInitialized(_this));
        _this.messageDisplayedHandler = _this.onMessageDisplayed.bind(_assertThisInitialized(_this));
        return _this;
      }

      _createClass(Aria, [{
        key: "install",
        value: function install() {
          this.core.on('core.field.valid', this.fieldValidHandler).on('core.field.invalid', this.fieldInvalidHandler).on('core.element.validated', this.elementValidatedHandler).on('plugins.message.displayed', this.messageDisplayedHandler);
        }
      }, {
        key: "uninstall",
        value: function uninstall() {
          this.core.off('core.field.valid', this.fieldValidHandler).off('core.field.invalid', this.fieldInvalidHandler).off('core.element.validated', this.elementValidatedHandler).off('plugins.message.displayed', this.messageDisplayedHandler);
        }
      }, {
        key: "onElementValidated",
        value: function onElementValidated(e) {
          if (e.valid) {
            e.element.setAttribute('aria-invalid', 'false');
            e.element.removeAttribute('aria-describedby');
          }
        }
      }, {
        key: "onFieldValid",
        value: function onFieldValid(field) {
          var elements = this.core.getElements(field);

          if (elements) {
            elements.forEach(function (ele) {
              ele.setAttribute('aria-invalid', 'false');
              ele.removeAttribute('aria-describedby');
            });
          }
        }
      }, {
        key: "onFieldInvalid",
        value: function onFieldInvalid(field) {
          var elements = this.core.getElements(field);

          if (elements) {
            elements.forEach(function (ele) {
              return ele.setAttribute('aria-invalid', 'true');
            });
          }
        }
      }, {
        key: "onMessageDisplayed",
        value: function onMessageDisplayed(e) {
          e.messageElement.setAttribute('role', 'alert');
          e.messageElement.setAttribute('aria-hidden', 'false');
          var elements = this.core.getElements(e.field);
          var index = elements.indexOf(e.element);
          var id = "js-fv-".concat(e.field, "-").concat(index, "-").concat(Date.now(), "-message");
          e.messageElement.setAttribute('id', id);
          e.element.setAttribute('aria-describedby', id);
          var type = e.element.getAttribute('type');

          if ('radio' === type || 'checkbox' === type) {
            elements.forEach(function (ele) {
              return ele.setAttribute('aria-describedby', id);
            });
          }
        }
      }]);

      return Aria;
    }(Plugin);

    var Declarative =
    /*#__PURE__*/
    function (_Plugin) {
      _inherits(Declarative, _Plugin);

      function Declarative(opts) {
        var _this;

        _classCallCheck(this, Declarative);

        _this = _possibleConstructorReturn(this, _getPrototypeOf(Declarative).call(this, opts));
        _this.opts = Object.assign({}, {
          html5Input: false,
          pluginPrefix: 'data-fvp-',
          prefix: 'data-fv-'
        }, opts);
        return _this;
      }

      _createClass(Declarative, [{
        key: "install",
        value: function install() {
          var _this2 = this;

          this.parsePlugins();
          var opts = this.parseOptions();
          Object.keys(opts).forEach(function (field) {
            return _this2.core.addField(field, opts[field]);
          });
        }
      }, {
        key: "parseOptions",
        value: function parseOptions() {
          var _this3 = this;

          var prefix = this.opts.prefix;
          var opts = {};
          var fields = this.core.getFields();
          var form = this.core.getFormElement();
          var elements = [].slice.call(form.querySelectorAll("[name], [".concat(prefix, "field]")));
          elements.forEach(function (ele) {
            var validators = _this3.parseElement(ele);

            if (!_this3.isEmptyOption(validators)) {
              var field = ele.getAttribute('name') || ele.getAttribute("".concat(prefix, "field"));
              opts[field] = Object.assign({}, opts[field], validators);
            }
          });
          Object.keys(opts).forEach(function (field) {
            Object.keys(opts[field].validators).forEach(function (v) {
              opts[field].validators[v].enabled = opts[field].validators[v].enabled || false;

              if (fields[field] && fields[field].validators && fields[field].validators[v]) {
                Object.assign(opts[field].validators[v], fields[field].validators[v]);
              }
            });
          });
          return Object.assign({}, fields, opts);
        }
      }, {
        key: "createPluginInstance",
        value: function createPluginInstance(clazz, opts) {
          var arr = clazz.split('.');
          var fn = window || this;

          for (var i = 0, len = arr.length; i < len; i++) {
            fn = fn[arr[i]];
          }

          if (typeof fn !== 'function') {
            throw new Error("the plugin ".concat(clazz, " doesn't exist"));
          }

          return new fn(opts);
        }
      }, {
        key: "parsePlugins",
        value: function parsePlugins() {
          var _this4 = this;

          var form = this.core.getFormElement();
          var reg = new RegExp("^".concat(this.opts.pluginPrefix, "([a-z0-9-]+)(___)*([a-z0-9-]+)*$"));
          var numAttributes = form.attributes.length;
          var plugins = {};

          for (var i = 0; i < numAttributes; i++) {
            var name = form.attributes[i].name;
            var value = form.attributes[i].value;
            var items = reg.exec(name);

            if (items && items.length === 4) {
              var pluginName = this.toCamelCase(items[1]);
              plugins[pluginName] = Object.assign({}, items[3] ? _defineProperty({}, this.toCamelCase(items[3]), value) : {
                enabled: '' === value || 'true' === value
              }, plugins[pluginName]);
            }
          }

          Object.keys(plugins).forEach(function (pluginName) {
            var opts = plugins[pluginName];
            var enabled = opts['enabled'];
            var clazz = opts['class'];

            if (enabled && clazz) {
              delete opts['enabled'];
              delete opts['clazz'];

              var p = _this4.createPluginInstance(clazz, opts);

              _this4.core.registerPlugin(pluginName, p);
            }
          });
        }
      }, {
        key: "isEmptyOption",
        value: function isEmptyOption(opts) {
          var validators = opts.validators;
          return Object.keys(validators).length === 0 && validators.constructor === Object;
        }
      }, {
        key: "parseElement",
        value: function parseElement(ele) {
          var reg = new RegExp("^".concat(this.opts.prefix, "([a-z0-9-]+)(___)*([a-z0-9-]+)*$"));
          var numAttributes = ele.attributes.length;
          var opts = {};
          var type = ele.getAttribute('type');

          for (var i = 0; i < numAttributes; i++) {
            var name = ele.attributes[i].name;
            var value = ele.attributes[i].value;

            if (this.opts.html5Input) {
              switch (true) {
                case 'minlength' === name:
                  opts['stringLength'] = Object.assign({}, {
                    enabled: true,
                    min: parseInt(value, 10)
                  }, opts['stringLength']);
                  break;

                case 'maxlength' === name:
                  opts['stringLength'] = Object.assign({}, {
                    enabled: true,
                    max: parseInt(value, 10)
                  }, opts['stringLength']);
                  break;

                case 'pattern' === name:
                  opts['regexp'] = Object.assign({}, {
                    enabled: true,
                    regexp: value
                  }, opts['regexp']);
                  break;

                case 'required' === name:
                  opts['notEmpty'] = Object.assign({}, {
                    enabled: true
                  }, opts['notEmpty']);
                  break;

                case 'type' === name && 'color' === value:
                  opts['color'] = Object.assign({}, {
                    enabled: true,
                    type: 'hex'
                  }, opts['color']);
                  break;

                case 'type' === name && 'email' === value:
                  opts['emailAddress'] = Object.assign({}, {
                    enabled: true
                  }, opts['emailAddress']);
                  break;

                case 'type' === name && 'url' === value:
                  opts['uri'] = Object.assign({}, {
                    enabled: true
                  }, opts['uri']);
                  break;

                case 'type' === name && 'range' === value:
                  opts['between'] = Object.assign({}, {
                    enabled: true,
                    max: parseFloat(ele.getAttribute('max')),
                    min: parseFloat(ele.getAttribute('min'))
                  }, opts['between']);
                  break;

                case 'min' === name && type !== 'date' && type !== 'range':
                  opts['greaterThan'] = Object.assign({}, {
                    enabled: true,
                    min: parseFloat(value)
                  }, opts['greaterThan']);
                  break;

                case 'max' === name && type !== 'date' && type !== 'range':
                  opts['lessThan'] = Object.assign({}, {
                    enabled: true,
                    max: parseFloat(value)
                  }, opts['lessThan']);
                  break;
              }
            }

            var items = reg.exec(name);

            if (items && items.length === 4) {
              var v = this.toCamelCase(items[1]);
              opts[v] = Object.assign({}, items[3] ? _defineProperty({}, this.toCamelCase(items[3]), value) : {
                enabled: '' === value || 'true' === value
              }, opts[v]);
            }
          }

          return {
            validators: opts
          };
        }
      }, {
        key: "toUpperCase",
        value: function toUpperCase(input) {
          return input.charAt(1).toUpperCase();
        }
      }, {
        key: "toCamelCase",
        value: function toCamelCase(input) {
          return input.replace(/-./g, this.toUpperCase);
        }
      }]);

      return Declarative;
    }(Plugin);

    var DefaultSubmit =
    /*#__PURE__*/
    function (_Plugin) {
      _inherits(DefaultSubmit, _Plugin);

      function DefaultSubmit() {
        var _this;

        _classCallCheck(this, DefaultSubmit);

        _this = _possibleConstructorReturn(this, _getPrototypeOf(DefaultSubmit).call(this, {}));
        _this.onValidHandler = _this.onFormValid.bind(_assertThisInitialized(_this));
        return _this;
      }

      _createClass(DefaultSubmit, [{
        key: "install",
        value: function install() {
          var form = this.core.getFormElement();

          if (form.querySelectorAll('[type="submit"][name="submit"]').length) {
            throw new Error('Do not use `submit` for the name attribute of submit button');
          }

          this.core.on('core.form.valid', this.onValidHandler);
        }
      }, {
        key: "uninstall",
        value: function uninstall() {
          this.core.off('core.form.valid', this.onValidHandler);
        }
      }, {
        key: "onFormValid",
        value: function onFormValid() {
          var form = this.core.getFormElement();

          if (form instanceof HTMLFormElement) {
            form.submit();
          }
        }
      }]);

      return DefaultSubmit;
    }(Plugin);

    var Dependency =
    /*#__PURE__*/
    function (_Plugin) {
      _inherits(Dependency, _Plugin);

      function Dependency(opts) {
        var _this;

        _classCallCheck(this, Dependency);

        _this = _possibleConstructorReturn(this, _getPrototypeOf(Dependency).call(this, opts));
        _this.opts = opts || {};
        _this.triggerExecutedHandler = _this.onTriggerExecuted.bind(_assertThisInitialized(_this));
        return _this;
      }

      _createClass(Dependency, [{
        key: "install",
        value: function install() {
          this.core.on('plugins.trigger.executed', this.triggerExecutedHandler);
        }
      }, {
        key: "uninstall",
        value: function uninstall() {
          this.core.off('plugins.trigger.executed', this.triggerExecutedHandler);
        }
      }, {
        key: "onTriggerExecuted",
        value: function onTriggerExecuted(e) {
          if (this.opts[e.field]) {
            var dependencies = this.opts[e.field].split(' ');
            var _iteratorNormalCompletion = true;
            var _didIteratorError = false;
            var _iteratorError = undefined;

            try {
              for (var _iterator = dependencies[Symbol.iterator](), _step; !(_iteratorNormalCompletion = (_step = _iterator.next()).done); _iteratorNormalCompletion = true) {
                var d = _step.value;
                var dependentField = d.trim();

                if (this.opts[dependentField]) {
                  this.core.revalidateField(dependentField);
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
        }
      }]);

      return Dependency;
    }(Plugin);

    var Excluded =
    /*#__PURE__*/
    function (_Plugin) {
      _inherits(Excluded, _Plugin);

      function Excluded(opts) {
        var _this;

        _classCallCheck(this, Excluded);

        _this = _possibleConstructorReturn(this, _getPrototypeOf(Excluded).call(this, opts));
        _this.opts = Object.assign({}, {
          excluded: Excluded.defaultIgnore
        }, opts);
        _this.ignoreValidationFilter = _this.ignoreValidation.bind(_assertThisInitialized(_this));
        return _this;
      }

      _createClass(Excluded, [{
        key: "install",
        value: function install() {
          this.core.registerFilter('element-ignored', this.ignoreValidationFilter);
        }
      }, {
        key: "uninstall",
        value: function uninstall() {
          this.core.deregisterFilter('element-ignored', this.ignoreValidationFilter);
        }
      }, {
        key: "ignoreValidation",
        value: function ignoreValidation(field, element, elements) {
          return this.opts.excluded.apply(this, [field, element, elements]);
        }
      }], [{
        key: "defaultIgnore",
        value: function defaultIgnore(field, element, elements) {
          var isVisible = !!(element.offsetWidth || element.offsetHeight || element.getClientRects().length);
          var disabled = element.getAttribute('disabled');
          return disabled === '' || disabled === 'disabled' || element.getAttribute('type') === 'hidden' || !isVisible;
        }
      }]);

      return Excluded;
    }(Plugin);

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

    function addClass(element, classes) {
      classes.split(' ').forEach(function (clazz) {
        if (element.classList) {
          element.classList.add(clazz);
        } else if (" ".concat(element.className, " ").indexOf(" ".concat(clazz, " "))) {
          element.className += " ".concat(clazz);
        }
      });
    }

    function removeClass(element, classes) {
      classes.split(' ').forEach(function (clazz) {
        element.classList ? element.classList.remove(clazz) : element.className = element.className.replace(clazz, '');
      });
    }

    function classSet(element, classes) {
      var adding = [];
      var removing = [];
      Object.keys(classes).forEach(function (clazz) {
        if (clazz) {
          classes[clazz] ? adding.push(clazz) : removing.push(clazz);
        }
      });
      removing.forEach(function (clazz) {
        return removeClass(element, clazz);
      });
      adding.forEach(function (clazz) {
        return addClass(element, clazz);
      });
    }

    function matches(element, selector) {
      var nativeMatches = element.matches || element.webkitMatchesSelector || element['mozMatchesSelector'] || element['msMatchesSelector'];

      if (nativeMatches) {
        return nativeMatches.call(element, selector);
      }

      var nodes = [].slice.call(element.parentElement.querySelectorAll(selector));
      return nodes.indexOf(element) >= 0;
    }

    function closest(element, selector) {
      var ele = element;

      while (ele) {
        if (matches(ele, selector)) {
          break;
        }

        ele = ele.parentElement;
      }

      return ele;
    }

    var Message =
    /*#__PURE__*/
    function (_Plugin) {
      _inherits(Message, _Plugin);

      function Message(opts) {
        var _this;

        _classCallCheck(this, Message);

        _this = _possibleConstructorReturn(this, _getPrototypeOf(Message).call(this, opts));
        _this.messages = new Map();
        _this.defaultContainer = document.createElement('div');
        _this.opts = Object.assign({}, {
          container: function container(field, element) {
            return _this.defaultContainer;
          }
        }, opts);
        _this.elementIgnoredHandler = _this.onElementIgnored.bind(_assertThisInitialized(_this));
        _this.fieldAddedHandler = _this.onFieldAdded.bind(_assertThisInitialized(_this));
        _this.fieldRemovedHandler = _this.onFieldRemoved.bind(_assertThisInitialized(_this));
        _this.validatorValidatedHandler = _this.onValidatorValidated.bind(_assertThisInitialized(_this));
        _this.validatorNotValidatedHandler = _this.onValidatorNotValidated.bind(_assertThisInitialized(_this));
        return _this;
      }

      _createClass(Message, [{
        key: "install",
        value: function install() {
          this.core.getFormElement().appendChild(this.defaultContainer);
          this.core.on('core.element.ignored', this.elementIgnoredHandler).on('core.field.added', this.fieldAddedHandler).on('core.field.removed', this.fieldRemovedHandler).on('core.validator.validated', this.validatorValidatedHandler).on('core.validator.notvalidated', this.validatorNotValidatedHandler);
        }
      }, {
        key: "uninstall",
        value: function uninstall() {
          this.core.getFormElement().removeChild(this.defaultContainer);
          this.messages.forEach(function (message) {
            return message.parentNode.removeChild(message);
          });
          this.messages.clear();
          this.core.off('core.element.ignored', this.elementIgnoredHandler).off('core.field.added', this.fieldAddedHandler).off('core.field.removed', this.fieldRemovedHandler).off('core.validator.validated', this.validatorValidatedHandler).off('core.validator.notvalidated', this.validatorNotValidatedHandler);
        }
      }, {
        key: "onFieldAdded",
        value: function onFieldAdded(e) {
          var _this2 = this;

          var elements = e.elements;

          if (elements) {
            elements.forEach(function (ele) {
              var msg = _this2.messages.get(ele);

              if (msg) {
                msg.parentNode.removeChild(msg);

                _this2.messages["delete"](ele);
              }
            });
            this.prepareFieldContainer(e.field, elements);
          }
        }
      }, {
        key: "onFieldRemoved",
        value: function onFieldRemoved(e) {
          var _this3 = this;

          if (!e.elements.length || !e.field) {
            return;
          }

          var type = e.elements[0].getAttribute('type');
          var elements = 'radio' === type || 'checkbox' === type ? [e.elements[0]] : e.elements;
          elements.forEach(function (ele) {
            if (_this3.messages.has(ele)) {
              var container = _this3.messages.get(ele);

              container.parentNode.removeChild(container);

              _this3.messages["delete"](ele);
            }
          });
        }
      }, {
        key: "prepareFieldContainer",
        value: function prepareFieldContainer(field, elements) {
          var _this4 = this;

          if (elements.length) {
            var type = elements[0].getAttribute('type');

            if ('radio' === type || 'checkbox' === type) {
              this.prepareElementContainer(field, elements[0], elements);
            } else {
              elements.forEach(function (ele) {
                return _this4.prepareElementContainer(field, ele, elements);
              });
            }
          }
        }
      }, {
        key: "prepareElementContainer",
        value: function prepareElementContainer(field, element, elements) {
          var container;

          switch (true) {
            case 'string' === typeof this.opts.container:
              var selector = this.opts.container;
              selector = '#' === selector.charAt(0) ? "[id=\"".concat(selector.substring(1), "\"]") : selector;
              container = this.core.getFormElement().querySelector(selector);
              break;

            default:
              container = this.opts.container(field, element);
              break;
          }

          var message = document.createElement('div');
          container.appendChild(message);
          classSet(message, {
            'fv-plugins-message-container': true
          });
          this.core.emit('plugins.message.placed', {
            element: element,
            elements: elements,
            field: field,
            messageElement: message
          });
          this.messages.set(element, message);
        }
      }, {
        key: "getMessage",
        value: function getMessage(result) {
          return typeof result.message === 'string' ? result.message : result.message[this.core.getLocale()];
        }
      }, {
        key: "onValidatorValidated",
        value: function onValidatorValidated(e) {
          var elements = e.elements;
          var type = e.element.getAttribute('type');
          var element = 'radio' === type || 'checkbox' === type ? elements[0] : e.element;

          if (this.messages.has(element)) {
            var container = this.messages.get(element);
            var messageEle = container.querySelector("[data-field=\"".concat(e.field, "\"][data-validator=\"").concat(e.validator, "\"]"));

            if (!messageEle && !e.result.valid) {
              var ele = document.createElement('div');
              ele.innerHTML = this.getMessage(e.result);
              ele.setAttribute('data-field', e.field);
              ele.setAttribute('data-validator', e.validator);

              if (this.opts.clazz) {
                classSet(ele, _defineProperty({}, this.opts.clazz, true));
              }

              container.appendChild(ele);
              this.core.emit('plugins.message.displayed', {
                element: e.element,
                field: e.field,
                message: e.result.message,
                messageElement: ele,
                meta: e.result.meta,
                validator: e.validator
              });
            } else if (messageEle && !e.result.valid) {
              messageEle.innerHTML = this.getMessage(e.result);
              this.core.emit('plugins.message.displayed', {
                element: e.element,
                field: e.field,
                message: e.result.message,
                messageElement: messageEle,
                meta: e.result.meta,
                validator: e.validator
              });
            } else if (messageEle && e.result.valid) {
              container.removeChild(messageEle);
            }
          }
        }
      }, {
        key: "onValidatorNotValidated",
        value: function onValidatorNotValidated(e) {
          var elements = e.elements;
          var type = e.element.getAttribute('type');
          var element = 'radio' === type || 'checkbox' === type ? elements[0] : e.element;

          if (this.messages.has(element)) {
            var container = this.messages.get(element);
            var messageEle = container.querySelector("[data-field=\"".concat(e.field, "\"][data-validator=\"").concat(e.validator, "\"]"));

            if (messageEle) {
              container.removeChild(messageEle);
            }
          }
        }
      }, {
        key: "onElementIgnored",
        value: function onElementIgnored(e) {
          var elements = e.elements;
          var type = e.element.getAttribute('type');
          var element = 'radio' === type || 'checkbox' === type ? elements[0] : e.element;

          if (this.messages.has(element)) {
            var container = this.messages.get(element);
            var messageElements = [].slice.call(container.querySelectorAll("[data-field=\"".concat(e.field, "\"]")));
            messageElements.forEach(function (messageEle) {
              container.removeChild(messageEle);
            });
          }
        }
      }], [{
        key: "getClosestContainer",
        value: function getClosestContainer(element, upper, pattern) {
          var ele = element;

          while (ele) {
            if (ele === upper) {
              break;
            }

            ele = ele.parentElement;

            if (pattern.test(ele.className)) {
              break;
            }
          }

          return ele;
        }
      }]);

      return Message;
    }(Plugin);

    var Framework =
    /*#__PURE__*/
    function (_Plugin) {
      _inherits(Framework, _Plugin);

      function Framework(opts) {
        var _this;

        _classCallCheck(this, Framework);

        _this = _possibleConstructorReturn(this, _getPrototypeOf(Framework).call(this, opts));
        _this.results = new Map();
        _this.containers = new Map();
        _this.opts = Object.assign({}, {
          defaultMessageContainer: true,
          eleInvalidClass: '',
          eleValidClass: '',
          rowClasses: '',
          rowValidatingClass: ''
        }, opts);
        _this.elementIgnoredHandler = _this.onElementIgnored.bind(_assertThisInitialized(_this));
        _this.elementValidatingHandler = _this.onElementValidating.bind(_assertThisInitialized(_this));
        _this.elementValidatedHandler = _this.onElementValidated.bind(_assertThisInitialized(_this));
        _this.elementNotValidatedHandler = _this.onElementNotValidated.bind(_assertThisInitialized(_this));
        _this.iconPlacedHandler = _this.onIconPlaced.bind(_assertThisInitialized(_this));
        _this.fieldAddedHandler = _this.onFieldAdded.bind(_assertThisInitialized(_this));
        _this.fieldRemovedHandler = _this.onFieldRemoved.bind(_assertThisInitialized(_this));
        return _this;
      }

      _createClass(Framework, [{
        key: "install",
        value: function install() {
          var _classSet,
              _this2 = this;

          classSet(this.core.getFormElement(), (_classSet = {}, _defineProperty(_classSet, this.opts.formClass, true), _defineProperty(_classSet, 'fv-plugins-framework', true), _classSet));
          this.core.on('core.element.ignored', this.elementIgnoredHandler).on('core.element.validating', this.elementValidatingHandler).on('core.element.validated', this.elementValidatedHandler).on('core.element.notvalidated', this.elementNotValidatedHandler).on('plugins.icon.placed', this.iconPlacedHandler).on('core.field.added', this.fieldAddedHandler).on('core.field.removed', this.fieldRemovedHandler);

          if (this.opts.defaultMessageContainer) {
            this.core.registerPlugin('___frameworkMessage', new Message({
              clazz: this.opts.messageClass,
              container: function container(field, element) {
                var selector = 'string' === typeof _this2.opts.rowSelector ? _this2.opts.rowSelector : _this2.opts.rowSelector(field, element);
                var groupEle = closest(element, selector);
                return Message.getClosestContainer(element, groupEle, _this2.opts.rowPattern);
              }
            }));
          }
        }
      }, {
        key: "uninstall",
        value: function uninstall() {
          var _classSet2;

          this.results.clear();
          this.containers.clear();
          classSet(this.core.getFormElement(), (_classSet2 = {}, _defineProperty(_classSet2, this.opts.formClass, false), _defineProperty(_classSet2, 'fv-plugins-framework', false), _classSet2));
          this.core.off('core.element.ignored', this.elementIgnoredHandler).off('core.element.validating', this.elementValidatingHandler).off('core.element.validated', this.elementValidatedHandler).off('core.element.notvalidated', this.elementNotValidatedHandler).off('plugins.icon.placed', this.iconPlacedHandler).off('core.field.added', this.fieldAddedHandler).off('core.field.removed', this.fieldRemovedHandler);
        }
      }, {
        key: "onIconPlaced",
        value: function onIconPlaced(e) {}
      }, {
        key: "onFieldAdded",
        value: function onFieldAdded(e) {
          var _this3 = this;

          var elements = e.elements;

          if (elements) {
            elements.forEach(function (ele) {
              var groupEle = _this3.containers.get(ele);

              if (groupEle) {
                var _classSet3;

                classSet(groupEle, (_classSet3 = {}, _defineProperty(_classSet3, _this3.opts.rowInvalidClass, false), _defineProperty(_classSet3, _this3.opts.rowValidatingClass, false), _defineProperty(_classSet3, _this3.opts.rowValidClass, false), _defineProperty(_classSet3, 'fv-plugins-icon-container', false), _classSet3));

                _this3.containers["delete"](ele);
              }
            });
            this.prepareFieldContainer(e.field, elements);
          }
        }
      }, {
        key: "onFieldRemoved",
        value: function onFieldRemoved(e) {
          var _this4 = this;

          e.elements.forEach(function (ele) {
            var groupEle = _this4.containers.get(ele);

            if (groupEle) {
              var _classSet4;

              classSet(groupEle, (_classSet4 = {}, _defineProperty(_classSet4, _this4.opts.rowInvalidClass, false), _defineProperty(_classSet4, _this4.opts.rowValidatingClass, false), _defineProperty(_classSet4, _this4.opts.rowValidClass, false), _classSet4));
            }
          });
        }
      }, {
        key: "prepareFieldContainer",
        value: function prepareFieldContainer(field, elements) {
          var _this5 = this;

          if (elements.length) {
            var type = elements[0].getAttribute('type');

            if ('radio' === type || 'checkbox' === type) {
              this.prepareElementContainer(field, elements[0]);
            } else {
              elements.forEach(function (ele) {
                return _this5.prepareElementContainer(field, ele);
              });
            }
          }
        }
      }, {
        key: "prepareElementContainer",
        value: function prepareElementContainer(field, element) {
          var selector = 'string' === typeof this.opts.rowSelector ? this.opts.rowSelector : this.opts.rowSelector(field, element);
          var groupEle = closest(element, selector);

          if (groupEle !== element) {
            var _classSet5;

            classSet(groupEle, (_classSet5 = {}, _defineProperty(_classSet5, this.opts.rowClasses, true), _defineProperty(_classSet5, 'fv-plugins-icon-container', true), _classSet5));
            this.containers.set(element, groupEle);
          }
        }
      }, {
        key: "onElementValidating",
        value: function onElementValidating(e) {
          var elements = e.elements;
          var type = e.element.getAttribute('type');
          var element = 'radio' === type || 'checkbox' === type ? elements[0] : e.element;
          var groupEle = this.containers.get(element);

          if (groupEle) {
            var _classSet6;

            classSet(groupEle, (_classSet6 = {}, _defineProperty(_classSet6, this.opts.rowInvalidClass, false), _defineProperty(_classSet6, this.opts.rowValidatingClass, true), _defineProperty(_classSet6, this.opts.rowValidClass, false), _classSet6));
          }
        }
      }, {
        key: "onElementNotValidated",
        value: function onElementNotValidated(e) {
          this.removeClasses(e.element, e.elements);
        }
      }, {
        key: "onElementIgnored",
        value: function onElementIgnored(e) {
          this.removeClasses(e.element, e.elements);
        }
      }, {
        key: "removeClasses",
        value: function removeClasses(element, elements) {
          var _classSet7;

          var type = element.getAttribute('type');
          var ele = 'radio' === type || 'checkbox' === type ? elements[0] : element;
          classSet(ele, (_classSet7 = {}, _defineProperty(_classSet7, this.opts.eleValidClass, false), _defineProperty(_classSet7, this.opts.eleInvalidClass, false), _classSet7));
          var groupEle = this.containers.get(ele);

          if (groupEle) {
            var _classSet8;

            classSet(groupEle, (_classSet8 = {}, _defineProperty(_classSet8, this.opts.rowInvalidClass, false), _defineProperty(_classSet8, this.opts.rowValidatingClass, false), _defineProperty(_classSet8, this.opts.rowValidClass, false), _classSet8));
          }
        }
      }, {
        key: "onElementValidated",
        value: function onElementValidated(e) {
          var _classSet9,
              _this6 = this;

          var elements = e.elements;
          var type = e.element.getAttribute('type');
          var element = 'radio' === type || 'checkbox' === type ? elements[0] : e.element;
          classSet(element, (_classSet9 = {}, _defineProperty(_classSet9, this.opts.eleValidClass, e.valid), _defineProperty(_classSet9, this.opts.eleInvalidClass, !e.valid), _classSet9));
          var groupEle = this.containers.get(element);

          if (groupEle) {
            if (!e.valid) {
              var _classSet10;

              this.results.set(element, false);
              classSet(groupEle, (_classSet10 = {}, _defineProperty(_classSet10, this.opts.rowInvalidClass, true), _defineProperty(_classSet10, this.opts.rowValidatingClass, false), _defineProperty(_classSet10, this.opts.rowValidClass, false), _classSet10));
            } else {
              this.results["delete"](element);
              var isValid = true;
              this.containers.forEach(function (value, key) {
                if (value === groupEle && _this6.results.get(key) === false) {
                  isValid = false;
                }
              });

              if (isValid) {
                var _classSet11;

                classSet(groupEle, (_classSet11 = {}, _defineProperty(_classSet11, this.opts.rowInvalidClass, false), _defineProperty(_classSet11, this.opts.rowValidatingClass, false), _defineProperty(_classSet11, this.opts.rowValidClass, true), _classSet11));
              }
            }
          }
        }
      }]);

      return Framework;
    }(Plugin);

    var Icon =
    /*#__PURE__*/
    function (_Plugin) {
      _inherits(Icon, _Plugin);

      function Icon(opts) {
        var _this;

        _classCallCheck(this, Icon);

        _this = _possibleConstructorReturn(this, _getPrototypeOf(Icon).call(this, opts));
        _this.icons = new Map();
        _this.opts = Object.assign({}, {
          invalid: 'fv-plugins-icon--invalid',
          onPlaced: function onPlaced() {},
          onSet: function onSet() {},
          valid: 'fv-plugins-icon--valid',
          validating: 'fv-plugins-icon--validating'
        }, opts);
        _this.elementValidatingHandler = _this.onElementValidating.bind(_assertThisInitialized(_this));
        _this.elementValidatedHandler = _this.onElementValidated.bind(_assertThisInitialized(_this));
        _this.elementNotValidatedHandler = _this.onElementNotValidated.bind(_assertThisInitialized(_this));
        _this.elementIgnoredHandler = _this.onElementIgnored.bind(_assertThisInitialized(_this));
        _this.fieldAddedHandler = _this.onFieldAdded.bind(_assertThisInitialized(_this));
        return _this;
      }

      _createClass(Icon, [{
        key: "install",
        value: function install() {
          this.core.on('core.element.validating', this.elementValidatingHandler).on('core.element.validated', this.elementValidatedHandler).on('core.element.notvalidated', this.elementNotValidatedHandler).on('core.element.ignored', this.elementIgnoredHandler).on('core.field.added', this.fieldAddedHandler);
        }
      }, {
        key: "uninstall",
        value: function uninstall() {
          this.icons.forEach(function (icon) {
            return icon.parentNode.removeChild(icon);
          });
          this.icons.clear();
          this.core.off('core.element.validating', this.elementValidatingHandler).off('core.element.validated', this.elementValidatedHandler).off('core.element.notvalidated', this.elementNotValidatedHandler).off('core.element.ignored', this.elementIgnoredHandler).off('core.field.added', this.fieldAddedHandler);
        }
      }, {
        key: "onFieldAdded",
        value: function onFieldAdded(e) {
          var _this2 = this;

          var elements = e.elements;

          if (elements) {
            elements.forEach(function (ele) {
              var icon = _this2.icons.get(ele);

              if (icon) {
                icon.parentNode.removeChild(icon);

                _this2.icons["delete"](ele);
              }
            });
            this.prepareFieldIcon(e.field, elements);
          }
        }
      }, {
        key: "prepareFieldIcon",
        value: function prepareFieldIcon(field, elements) {
          var _this3 = this;

          if (elements.length) {
            var type = elements[0].getAttribute('type');

            if ('radio' === type || 'checkbox' === type) {
              this.prepareElementIcon(field, elements[0]);
            } else {
              elements.forEach(function (ele) {
                return _this3.prepareElementIcon(field, ele);
              });
            }
          }
        }
      }, {
        key: "prepareElementIcon",
        value: function prepareElementIcon(field, ele) {
          var i = document.createElement('i');
          i.setAttribute('data-field', field);
          ele.parentNode.insertBefore(i, ele.nextSibling);
          classSet(i, {
            'fv-plugins-icon': true
          });
          var e = {
            classes: {
              invalid: this.opts.invalid,
              valid: this.opts.valid,
              validating: this.opts.validating
            },
            element: ele,
            field: field,
            iconElement: i
          };
          this.core.emit('plugins.icon.placed', e);
          this.opts.onPlaced(e);
          this.icons.set(ele, i);
        }
      }, {
        key: "onElementValidating",
        value: function onElementValidating(e) {
          var _this$setClasses;

          var icon = this.setClasses(e.field, e.element, e.elements, (_this$setClasses = {}, _defineProperty(_this$setClasses, this.opts.invalid, false), _defineProperty(_this$setClasses, this.opts.valid, false), _defineProperty(_this$setClasses, this.opts.validating, true), _this$setClasses));
          var evt = {
            element: e.element,
            field: e.field,
            iconElement: icon,
            status: 'Validating'
          };
          this.core.emit('plugins.icon.set', evt);
          this.opts.onSet(evt);
        }
      }, {
        key: "onElementValidated",
        value: function onElementValidated(e) {
          var _this$setClasses2;

          var icon = this.setClasses(e.field, e.element, e.elements, (_this$setClasses2 = {}, _defineProperty(_this$setClasses2, this.opts.invalid, !e.valid), _defineProperty(_this$setClasses2, this.opts.valid, e.valid), _defineProperty(_this$setClasses2, this.opts.validating, false), _this$setClasses2));
          var evt = {
            element: e.element,
            field: e.field,
            iconElement: icon,
            status: e.valid ? 'Valid' : 'Invalid'
          };
          this.core.emit('plugins.icon.set', evt);
          this.opts.onSet(evt);
        }
      }, {
        key: "onElementNotValidated",
        value: function onElementNotValidated(e) {
          var _this$setClasses3;

          var icon = this.setClasses(e.field, e.element, e.elements, (_this$setClasses3 = {}, _defineProperty(_this$setClasses3, this.opts.invalid, false), _defineProperty(_this$setClasses3, this.opts.valid, false), _defineProperty(_this$setClasses3, this.opts.validating, false), _this$setClasses3));
          var evt = {
            element: e.element,
            field: e.field,
            iconElement: icon,
            status: 'NotValidated'
          };
          this.core.emit('plugins.icon.set', evt);
          this.opts.onSet(evt);
        }
      }, {
        key: "onElementIgnored",
        value: function onElementIgnored(e) {
          var _this$setClasses4;

          var icon = this.setClasses(e.field, e.element, e.elements, (_this$setClasses4 = {}, _defineProperty(_this$setClasses4, this.opts.invalid, false), _defineProperty(_this$setClasses4, this.opts.valid, false), _defineProperty(_this$setClasses4, this.opts.validating, false), _this$setClasses4));
          var evt = {
            element: e.element,
            field: e.field,
            iconElement: icon,
            status: 'Ignored'
          };
          this.core.emit('plugins.icon.set', evt);
          this.opts.onSet(evt);
        }
      }, {
        key: "setClasses",
        value: function setClasses(field, element, elements, classes) {
          var type = element.getAttribute('type');
          var ele = 'radio' === type || 'checkbox' === type ? elements[0] : element;

          if (this.icons.has(ele)) {
            var icon = this.icons.get(ele);
            classSet(icon, classes);
            return icon;
          } else {
            return null;
          }
        }
      }]);

      return Icon;
    }(Plugin);

    var Sequence =
    /*#__PURE__*/
    function (_Plugin) {
      _inherits(Sequence, _Plugin);

      function Sequence(opts) {
        var _this;

        _classCallCheck(this, Sequence);

        _this = _possibleConstructorReturn(this, _getPrototypeOf(Sequence).call(this, opts));
        _this.invalidFields = new Map();
        _this.opts = Object.assign({}, {
          enabled: true
        }, opts);
        _this.validatorHandler = _this.onValidatorValidated.bind(_assertThisInitialized(_this));
        _this.shouldValidateFilter = _this.shouldValidate.bind(_assertThisInitialized(_this));
        _this.fieldAddedHandler = _this.onFieldAdded.bind(_assertThisInitialized(_this));
        _this.elementNotValidatedHandler = _this.onElementNotValidated.bind(_assertThisInitialized(_this));
        _this.elementValidatingHandler = _this.onElementValidating.bind(_assertThisInitialized(_this));
        return _this;
      }

      _createClass(Sequence, [{
        key: "install",
        value: function install() {
          this.core.on('core.validator.validated', this.validatorHandler).on('core.field.added', this.fieldAddedHandler).on('core.element.notvalidated', this.elementNotValidatedHandler).on('core.element.validating', this.elementValidatingHandler).registerFilter('field-should-validate', this.shouldValidateFilter);
        }
      }, {
        key: "uninstall",
        value: function uninstall() {
          this.invalidFields.clear();
          this.core.off('core.validator.validated', this.validatorHandler).off('core.field.added', this.fieldAddedHandler).off('core.element.notvalidated', this.elementNotValidatedHandler).off('core.element.validating', this.elementValidatingHandler).deregisterFilter('field-should-validate', this.shouldValidateFilter);
        }
      }, {
        key: "shouldValidate",
        value: function shouldValidate(field, element, value, validator) {
          var stop = (this.opts.enabled === true || this.opts.enabled[field] === true) && this.invalidFields.has(element) && !!this.invalidFields.get(element).length && this.invalidFields.get(element).indexOf(validator) === -1;
          return !stop;
        }
      }, {
        key: "onValidatorValidated",
        value: function onValidatorValidated(e) {
          var validators = this.invalidFields.has(e.element) ? this.invalidFields.get(e.element) : [];
          var index = validators.indexOf(e.validator);

          if (e.result.valid && index >= 0) {
            validators.splice(index, 1);
          } else if (!e.result.valid && index === -1) {
            validators.push(e.validator);
          }

          this.invalidFields.set(e.element, validators);
        }
      }, {
        key: "onFieldAdded",
        value: function onFieldAdded(e) {
          if (e.elements) {
            this.clearInvalidFields(e.elements);
          }
        }
      }, {
        key: "onElementNotValidated",
        value: function onElementNotValidated(e) {
          this.clearInvalidFields(e.elements);
        }
      }, {
        key: "onElementValidating",
        value: function onElementValidating(e) {
          this.clearInvalidFields(e.elements);
        }
      }, {
        key: "clearInvalidFields",
        value: function clearInvalidFields(elements) {
          var _this2 = this;

          elements.forEach(function (ele) {
            return _this2.invalidFields["delete"](ele);
          });
        }
      }]);

      return Sequence;
    }(Plugin);

    var SubmitButton =
    /*#__PURE__*/
    function (_Plugin) {
      _inherits(SubmitButton, _Plugin);

      function SubmitButton(opts) {
        var _this;

        _classCallCheck(this, SubmitButton);

        _this = _possibleConstructorReturn(this, _getPrototypeOf(SubmitButton).call(this, opts));
        _this.isFormValid = false;
        _this.opts = Object.assign({}, {
          aspNetButton: false,
          selector: '[type="submit"]:not([formnovalidate])'
        }, opts);
        _this.submitHandler = _this.handleSubmitEvent.bind(_assertThisInitialized(_this));
        _this.buttonClickHandler = _this.handleClickEvent.bind(_assertThisInitialized(_this));
        return _this;
      }

      _createClass(SubmitButton, [{
        key: "install",
        value: function install() {
          var _this2 = this;

          if (!(this.core.getFormElement() instanceof HTMLFormElement)) {
            return;
          }

          var form = this.core.getFormElement();
          this.selectorButtons = [].slice.call(form.querySelectorAll(this.opts.selector));
          this.submitButtons = [].slice.call(form.querySelectorAll('[type="submit"]'));
          form.setAttribute('novalidate', 'novalidate');
          form.addEventListener('submit', this.submitHandler);
          this.hiddenClickedEle = document.createElement('input');
          this.hiddenClickedEle.setAttribute('type', 'hidden');
          form.appendChild(this.hiddenClickedEle);
          this.submitButtons.forEach(function (button) {
            button.addEventListener('click', _this2.buttonClickHandler);
          });
        }
      }, {
        key: "uninstall",
        value: function uninstall() {
          var _this3 = this;

          var form = this.core.getFormElement();

          if (form instanceof HTMLFormElement) {
            form.removeEventListener('submit', this.submitHandler);
          }

          this.submitButtons.forEach(function (button) {
            button.removeEventListener('click', _this3.buttonClickHandler);
          });
          this.hiddenClickedEle.parentElement.removeChild(this.hiddenClickedEle);
        }
      }, {
        key: "handleSubmitEvent",
        value: function handleSubmitEvent(e) {
          this.validateForm(e);
        }
      }, {
        key: "handleClickEvent",
        value: function handleClickEvent(e) {
          var target = e.currentTarget;

          if (target instanceof HTMLElement && this.selectorButtons.indexOf(target) !== -1) {
            if (this.opts.aspNetButton && this.isFormValid === true) ; else {
              var form = this.core.getFormElement();
              form.removeEventListener('submit', this.submitHandler);
              this.clickedButton = e.target;
              var name = this.clickedButton.getAttribute('name');
              var value = this.clickedButton.getAttribute('value');

              if (name && value) {
                this.hiddenClickedEle.setAttribute('name', name);
                this.hiddenClickedEle.setAttribute('value', value);
              }

              this.validateForm(e);
            }
          }
        }
      }, {
        key: "validateForm",
        value: function validateForm(e) {
          var _this4 = this;

          e.preventDefault();
          this.core.validate().then(function (result) {
            if (result === 'Valid' && _this4.opts.aspNetButton && !_this4.isFormValid && _this4.clickedButton) {
              _this4.isFormValid = true;

              _this4.clickedButton.removeEventListener('click', _this4.buttonClickHandler);

              _this4.clickedButton.click();
            }
          });
        }
      }]);

      return SubmitButton;
    }(Plugin);

    var Tooltip =
    /*#__PURE__*/
    function (_Plugin) {
      _inherits(Tooltip, _Plugin);

      function Tooltip(opts) {
        var _this;

        _classCallCheck(this, Tooltip);

        _this = _possibleConstructorReturn(this, _getPrototypeOf(Tooltip).call(this, opts));
        _this.messages = new Map();
        _this.opts = Object.assign({}, {
          placement: 'top',
          trigger: 'click'
        }, opts);
        _this.iconPlacedHandler = _this.onIconPlaced.bind(_assertThisInitialized(_this));
        _this.validatorValidatedHandler = _this.onValidatorValidated.bind(_assertThisInitialized(_this));
        _this.elementValidatedHandler = _this.onElementValidated.bind(_assertThisInitialized(_this));
        _this.documentClickHandler = _this.onDocumentClicked.bind(_assertThisInitialized(_this));
        return _this;
      }

      _createClass(Tooltip, [{
        key: "install",
        value: function install() {
          this.tip = document.createElement('div');
          classSet(this.tip, _defineProperty({
            'fv-plugins-tooltip': true
          }, "fv-plugins-tooltip--".concat(this.opts.placement), true));
          document.body.appendChild(this.tip);
          this.core.on('plugins.icon.placed', this.iconPlacedHandler).on('core.validator.validated', this.validatorValidatedHandler).on('core.element.validated', this.elementValidatedHandler);

          if ('click' === this.opts.trigger) {
            document.addEventListener('click', this.documentClickHandler);
          }
        }
      }, {
        key: "uninstall",
        value: function uninstall() {
          this.messages.clear();
          document.body.removeChild(this.tip);
          this.core.off('plugins.icon.placed', this.iconPlacedHandler).off('core.validator.validated', this.validatorValidatedHandler).off('core.element.validated', this.elementValidatedHandler);

          if ('click' === this.opts.trigger) {
            document.removeEventListener('click', this.documentClickHandler);
          }
        }
      }, {
        key: "onIconPlaced",
        value: function onIconPlaced(e) {
          var _this2 = this;

          classSet(e.iconElement, {
            'fv-plugins-tooltip-icon': true
          });

          switch (this.opts.trigger) {
            case 'hover':
              e.iconElement.addEventListener('mouseenter', function (evt) {
                return _this2.show(e.element, evt);
              });
              e.iconElement.addEventListener('mouseleave', function (evt) {
                return _this2.hide();
              });
              break;

            case 'click':
            default:
              e.iconElement.addEventListener('click', function (evt) {
                return _this2.show(e.element, evt);
              });
              break;
          }
        }
      }, {
        key: "onValidatorValidated",
        value: function onValidatorValidated(e) {
          if (!e.result.valid) {
            var elements = e.elements;
            var type = e.element.getAttribute('type');
            var ele = 'radio' === type || 'checkbox' === type ? elements[0] : e.element;
            var message = typeof e.result.message === 'string' ? e.result.message : e.result.message[this.core.getLocale()];
            this.messages.set(ele, message);
          }
        }
      }, {
        key: "onElementValidated",
        value: function onElementValidated(e) {
          if (e.valid) {
            var elements = e.elements;
            var type = e.element.getAttribute('type');
            var ele = 'radio' === type || 'checkbox' === type ? elements[0] : e.element;
            this.messages["delete"](ele);
          }
        }
      }, {
        key: "onDocumentClicked",
        value: function onDocumentClicked(e) {
          this.hide();
        }
      }, {
        key: "show",
        value: function show(ele, e) {
          e.preventDefault();
          e.stopPropagation();

          if (!this.messages.has(ele)) {
            return;
          }

          classSet(this.tip, {
            'fv-plugins-tooltip--hide': false
          });
          this.tip.innerHTML = "<span class=\"fv-plugins-tooltip__content\">".concat(this.messages.get(ele), "</span>");
          var icon = e.target;
          var rect = icon.getBoundingClientRect();
          var top = 0;
          var left = 0;

          switch (this.opts.placement) {
            case 'top':
            default:
              top = rect.top - rect.height;
              left = rect.left + rect.width / 2 - this.tip.clientWidth / 2;
              break;

            case 'top-left':
              top = rect.top - rect.height;
              left = rect.left;
              break;

            case 'top-right':
              top = rect.top - rect.height;
              left = rect.left + rect.width - this.tip.clientWidth;
              break;

            case 'bottom':
              top = rect.top + rect.height;
              left = rect.left + rect.width / 2 - this.tip.clientWidth / 2;
              break;

            case 'bottom-left':
              top = rect.top + rect.height;
              left = rect.left;
              break;

            case 'bottom-right':
              top = rect.top + rect.height;
              left = rect.left + rect.width - this.tip.clientWidth;
              break;

            case 'left':
              top = rect.top + rect.height / 2 - this.tip.clientHeight / 2;
              left = rect.left - this.tip.clientWidth;
              break;

            case 'right':
              top = rect.top + rect.height / 2 - this.tip.clientHeight / 2;
              left = rect.left + rect.width;
              break;
          }

          var scrollTop = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0;
          var scrollLeft = window.pageXOffset || document.documentElement.scrollLeft || document.body.scrollLeft || 0;
          top = top + scrollTop;
          left = left + scrollLeft;
          this.tip.setAttribute('style', "top: ".concat(top, "px; left: ").concat(left, "px"));
        }
      }, {
        key: "hide",
        value: function hide() {
          classSet(this.tip, {
            'fv-plugins-tooltip--hide': true
          });
        }
      }]);

      return Tooltip;
    }(Plugin);

    var Trigger =
    /*#__PURE__*/
    function (_Plugin) {
      _inherits(Trigger, _Plugin);

      function Trigger(opts) {
        var _this;

        _classCallCheck(this, Trigger);

        _this = _possibleConstructorReturn(this, _getPrototypeOf(Trigger).call(this, opts));
        _this.handlers = [];
        _this.timers = new Map();

        _this.ieVersion = function () {
          var v = 3;
          var div = document.createElement('div');
          var a = div['all'] || [];

          while (div.innerHTML = '<!--[if gt IE ' + ++v + ']><br><![endif]-->', a[0]) {}

          return v > 4 ? v : document['documentMode'];
        }();

        var ele = document.createElement('div');
        _this.defaultEvent = _this.ieVersion === 9 || !('oninput' in ele) ? 'keyup' : 'input';
        _this.opts = Object.assign({}, {
          delay: 0,
          event: _this.defaultEvent,
          threshold: 0
        }, opts);
        _this.fieldAddedHandler = _this.onFieldAdded.bind(_assertThisInitialized(_this));
        _this.fieldRemovedHandler = _this.onFieldRemoved.bind(_assertThisInitialized(_this));
        return _this;
      }

      _createClass(Trigger, [{
        key: "install",
        value: function install() {
          this.core.on('core.field.added', this.fieldAddedHandler).on('core.field.removed', this.fieldRemovedHandler);
        }
      }, {
        key: "uninstall",
        value: function uninstall() {
          this.handlers.forEach(function (item) {
            return item.element.removeEventListener(item.event, item.handler);
          });
          this.handlers = [];
          this.timers.forEach(function (t) {
            return window.clearTimeout(t);
          });
          this.timers.clear();
          this.core.off('core.field.added', this.fieldAddedHandler).off('core.field.removed', this.fieldRemovedHandler);
        }
      }, {
        key: "prepareHandler",
        value: function prepareHandler(field, elements) {
          var _this2 = this;

          elements.forEach(function (ele) {
            var events = [];

            switch (true) {
              case !!_this2.opts.event && _this2.opts.event[field] === false:
                events = [];
                break;

              case !!_this2.opts.event && !!_this2.opts.event[field]:
                events = _this2.opts.event[field].split(' ');
                break;

              case 'string' === typeof _this2.opts.event && _this2.opts.event !== _this2.defaultEvent:
                events = _this2.opts.event.split(' ');
                break;

              default:
                var type = ele.getAttribute('type');
                var tagName = ele.tagName.toLowerCase();
                var event = 'radio' === type || 'checkbox' === type || 'file' === type || 'select' === tagName ? 'change' : _this2.ieVersion >= 10 && ele.getAttribute('placeholder') ? 'keyup' : _this2.defaultEvent;
                events = [event];
                break;
            }

            events.forEach(function (evt) {
              var evtHandler = function evtHandler(e) {
                return _this2.handleEvent(e, field, ele);
              };

              _this2.handlers.push({
                element: ele,
                event: evt,
                field: field,
                handler: evtHandler
              });

              ele.addEventListener(evt, evtHandler);
            });
          });
        }
      }, {
        key: "handleEvent",
        value: function handleEvent(e, field, ele) {
          var _this3 = this;

          if (this.exceedThreshold(field, ele) && this.core.executeFilter('plugins-trigger-should-validate', true, [field, ele])) {
            var handler = function handler() {
              return _this3.core.validateElement(field, ele).then(function (_) {
                _this3.core.emit('plugins.trigger.executed', {
                  element: ele,
                  event: e,
                  field: field
                });
              });
            };

            var delay = this.opts.delay[field] || this.opts.delay;

            if (delay === 0) {
              handler();
            } else {
              var timer = this.timers.get(ele);

              if (timer) {
                window.clearTimeout(timer);
              }

              this.timers.set(ele, window.setTimeout(handler, delay * 1000));
            }
          }
        }
      }, {
        key: "onFieldAdded",
        value: function onFieldAdded(e) {
          this.handlers.filter(function (item) {
            return item.field === e.field;
          }).forEach(function (item) {
            return item.element.removeEventListener(item.event, item.handler);
          });
          this.prepareHandler(e.field, e.elements);
        }
      }, {
        key: "onFieldRemoved",
        value: function onFieldRemoved(e) {
          this.handlers.filter(function (item) {
            return item.field === e.field && e.elements.indexOf(item.element) >= 0;
          }).forEach(function (item) {
            return item.element.removeEventListener(item.event, item.handler);
          });
        }
      }, {
        key: "exceedThreshold",
        value: function exceedThreshold(field, element) {
          var threshold = this.opts.threshold[field] === 0 || this.opts.threshold === 0 ? false : this.opts.threshold[field] || this.opts.threshold;

          if (!threshold) {
            return true;
          }

          var type = element.getAttribute('type');

          if (['button', 'checkbox', 'file', 'hidden', 'image', 'radio', 'reset', 'submit'].indexOf(type) !== -1) {
            return true;
          }

          var value = this.core.getElementValue(field, element);
          return value.length >= threshold;
        }
      }]);

      return Trigger;
    }(Plugin);

    var index$2 = {
      Alias: Alias,
      Aria: Aria,
      Declarative: Declarative,
      DefaultSubmit: DefaultSubmit,
      Dependency: Dependency,
      Excluded: Excluded,
      FieldStatus: FieldStatus,
      Framework: Framework,
      Icon: Icon,
      Message: Message,
      Sequence: Sequence,
      SubmitButton: SubmitButton,
      Tooltip: Tooltip,
      Trigger: Trigger
    };

    function hasClass(element, clazz) {
      return element.classList ? element.classList.contains(clazz) : new RegExp("(^| )".concat(clazz, "( |$)"), 'gi').test(element.className);
    }

    var index$3 = {
      call: call,
      classSet: classSet,
      closest: closest,
      fetch: fetch,
      format: format,
      hasClass: hasClass,
      isValidDate: isValidDate
    };

    var locales = {};

    exports.Plugin = Plugin;
    exports.algorithms = index;
    exports.filters = index$1;
    exports.formValidation = formValidation;
    exports.locales = locales;
    exports.plugins = index$2;
    exports.utils = index$3;
    exports.validators = validators;

    Object.defineProperty(exports, '__esModule', { value: true });

})));
