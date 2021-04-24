/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 20);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/metronic/js/pages/builder.js":
/*!************************************************!*\
  !*** ./resources/metronic/js/pages/builder.js ***!
  \************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
 // Class definition

var KTLayoutBuilder = function () {
  var formAction;
  var exporter = {
    init: function init() {
      formAction = $('.form').attr('action');
    },
    startLoad: function startLoad(options) {
      $('#builder_export').addClass('spinner spinner-right spinner-primary').find('span').text('Exporting...').closest('.card-footer').find('.btn').attr('disabled', true);
      toastr.info(options.title, options.message);
    },
    doneLoad: function doneLoad() {
      $('#builder_export').removeClass('spinner spinner-right spinner-primary').find('span').text('Export').closest('.card-footer').find('.btn').attr('disabled', false);
    },
    exportHtml: function exportHtml(demo) {
      exporter.startLoad({
        title: 'Generate HTML Partials',
        message: 'Process started and it may take a while.'
      });
      $.ajax(formAction, {
        method: 'POST',
        data: {
          builder_export: 1,
          export_type: 'partial',
          demo: demo,
          theme: 'metronic'
        }
      }).done(function (r) {
        var result = JSON.parse(r);

        if (result.message) {
          exporter.stopWithNotify(result.message);
          return;
        }

        var timer = setInterval(function () {
          $.ajax(formAction, {
            method: 'POST',
            data: {
              builder_export: 1,
              builder_check: result.id
            }
          }).done(function (r) {
            var result = JSON.parse(r);
            if (typeof result === 'undefined') return; // export status 1 is completed

            if (result.export_status !== 1) return;
            $('<iframe/>').attr({
              src: formAction + '?builder_export&builder_download&id=' + result.id,
              style: 'visibility:hidden;display:none'
            }).ready(function () {
              toastr.success('Export HTML Version Layout', 'HTML version exported.');
              exporter.doneLoad(); // stop the timer

              clearInterval(timer);
            }).appendTo('body');
          });
        }, 15000);
      });
    },
    stopWithNotify: function stopWithNotify(message, type) {
      type = type || 'danger';

      if (typeof toastr[type] !== 'undefined') {
        toastr[type]('Verification failed', message);
      }

      exporter.doneLoad();
    }
  }; // Private functions

  var preview = function preview() {
    $('[name="builder_submit"]').click(function (e) {
      e.preventDefault();

      var _self = $(this);

      $(_self).addClass('spinner spinner-right spinner-white').closest('.card-footer').find('.btn').attr('disabled', true); // keep remember tab id

      $('.nav[data-remember-tab]').each(function () {
        var tab = $(this).data('remember-tab');
        var tabId = $(this).find('.nav-link.active[data-toggle="tab"]').attr('href');
        $('#' + tab).val(tabId);
      });
      $.ajax(formAction + '?demo=' + $(_self).data('demo'), {
        method: 'POST',
        data: $('[name]').serialize()
      }).done(function (r) {
        toastr.success('Preview updated', 'Preview has been updated with current configured layout.');
      }).always(function () {
        setTimeout(function () {
          location.reload();
        }, 600);
      });
    });
  };

  var reset = function reset() {
    $('[name="builder_reset"]').click(function (e) {
      e.preventDefault();

      var _self = $(this);

      $(_self).addClass('spinner spinner-right spinner-primary').closest('.card-footer').find('.btn').attr('disabled', true);
      $.ajax(formAction + '?demo=' + $(_self).data('demo'), {
        method: 'POST',
        data: {
          builder_reset: 1,
          demo: $(_self).data('demo')
        }
      }).done(function (r) {}).always(function () {
        location.reload();
      });
    });
  };

  var verify = {
    reCaptchaVerified: function reCaptchaVerified() {
      return $.ajax('../tools/builder/recaptcha.php?recaptcha', {
        method: 'POST',
        data: {
          response: $('#g-recaptcha-response').val()
        }
      }).fail(function () {
        grecaptcha.reset();
        $('#alert-message').removeClass('alert-success d-hide').addClass('alert-danger').html('Invalid reCaptcha validation');
      });
    },
    init: function init() {
      var exportReadyTrigger; // click event

      $('#builder_export').click(function (e) {
        e.preventDefault();
        exportReadyTrigger = $(this);
        $('#kt-modal-purchase').modal('show');
        $('#alert-message').addClass('d-hide');
        grecaptcha.reset();
      });
      $('#submit-verify').click(function (e) {
        e.preventDefault();

        if (!$('#g-recaptcha-response').val()) {
          $('#alert-message').removeClass('alert-success d-hide').addClass('alert-danger').html('Invalid reCaptcha validation');
          return;
        }

        verify.reCaptchaVerified().done(function (response) {
          if (response.success) {
            $('[data-dismiss="modal"]').trigger('click');
            var demo = $(exportReadyTrigger).data('demo');

            switch ($(exportReadyTrigger).attr('id')) {
              case 'builder_export':
                exporter.exportHtml(demo);
                break;

              case 'builder_export_html':
                exporter.exportHtml(demo);
                break;
            }
          } else {
            grecaptcha.reset();
            $('#alert-message').removeClass('alert-success d-hide').addClass('alert-danger').html('Invalid reCaptcha validation');
          }
        });
      });
    }
  }; // basic demo

  var _init = function init() {
    exporter.init();
    preview();
    reset();
  };

  return {
    // public functions
    init: function init() {
      verify.init();

      _init();
    }
  };
}();

jQuery(document).ready(function () {
  KTLayoutBuilder.init();
});

/***/ }),

/***/ 20:
/*!******************************************************!*\
  !*** multi ./resources/metronic/js/pages/builder.js ***!
  \******************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\wamp64\www\keenthemes\themes\metronic\theme\html_laravel\demo1\skeleton\resources\metronic\js\pages\builder.js */"./resources/metronic/js/pages/builder.js");


/***/ })

/******/ });