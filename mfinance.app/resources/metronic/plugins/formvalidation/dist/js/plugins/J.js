/**
 * FormValidation (https://formvalidation.io), v1.6.0 (4730ac5)
 * The best validation library for JavaScript
 * (c) 2013 - 2020 Nguyen Huu Phuoc <me@phuoc.ng>
 */

(function ($) {
  'use strict';

  $ = $ && $.hasOwnProperty('default') ? $['default'] : $;

  function _typeof(obj) {
    if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") {
      _typeof = function (obj) {
        return typeof obj;
      };
    } else {
      _typeof = function (obj) {
        return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj;
      };
    }

    return _typeof(obj);
  }

  var formValidation = FormValidation.formValidation;

  var version = $.fn.jquery.split(' ')[0].split('.');

  if (+version[0] < 2 && +version[1] < 9 || +version[0] === 1 && +version[1] === 9 && +version[2] < 1) {
    throw new Error('The J plugin requires jQuery version 1.9.1 or higher');
  }

  $.fn['formValidation'] = function (options) {
    var params = arguments;
    return this.each(function () {
      var $this = $(this);
      var data = $this.data('formValidation');
      var opts = 'object' === _typeof(options) && options;

      if (!data) {
        data = formValidation(this, opts);
        $this.data('formValidation', data).data('FormValidation', data);
      }

      if ('string' === typeof options) {
        data[options].apply(data, Array.prototype.slice.call(params, 1));
      }
    });
  };

}(jQuery));
