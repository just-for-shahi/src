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
      uri: uri
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
