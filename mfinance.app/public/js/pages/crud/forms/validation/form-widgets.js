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
/******/ 	return __webpack_require__(__webpack_require__.s = 60);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/metronic/js/pages/crud/forms/validation/form-widgets.js":
/*!***************************************************************************!*\
  !*** ./resources/metronic/js/pages/crud/forms/validation/form-widgets.js ***!
  \***************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// Class definition
var KTFormWidgetsValidation = function () {
  // Private functions
  var validator;

  var _initWidgets = function _initWidgets() {
    // Initialize Plugins
    // Datepicker
    $('#kt_datepicker').datepicker({
      todayHighlight: true,
      templates: {
        leftArrow: '<i class=\"la la-angle-left\"></i>',
        rightArrow: '<i class=\"la la-angle-right\"></i>'
      }
    }).on('changeDate', function (e) {
      // Revalidate field
      validator.revalidateField('date');
    }); // Datetimepicker

    $('#kt_datetimepicker').datetimepicker({
      pickerPosition: 'bottom-left',
      todayHighlight: true,
      autoclose: true,
      format: 'yyyy.mm.dd hh:ii'
    });
    $('#kt_datetimepicker').change(function () {
      // Revalidate field
      validator.revalidateField('datetime');
    }); // Timepicker

    $('#kt_timepicker').timepicker({
      minuteStep: 1,
      showSeconds: true,
      showMeridian: true
    });
    $('#kt_timepicker').change(function () {
      // Revalidate field
      validator.revalidateField('time');
    }); // Daterangepicker

    $('#kt_daterangepicker').daterangepicker({
      buttonClasses: ' btn',
      applyClass: 'btn-primary',
      cancelClass: 'btn-light-primary'
    }, function (start, end, label) {
      var input = $('#kt_daterangepicker').find('.form-control');
      input.val(start.format('YYYY/MM/DD') + ' / ' + end.format('YYYY/MM/DD')); // Revalidate field

      validator.revalidateField('daterangepicker');
    }); // Bootstrap Switch

    $('[data-switch=true]').bootstrapSwitch();
    $('[data-switch=true]').on('switchChange.bootstrapSwitch', function () {
      // Revalidate field
      validator.revalidateField('switch');
    }); // Bootstrap Select

    $('#kt_bootstrap_select').selectpicker();
    $('#kt_bootstrap_select').on('changed.bs.select', function () {
      // Revalidate field
      validator.revalidateField('select');
    }); // Select2

    $('#kt_select2').select2({
      placeholder: "Select a state"
    });
    $('#kt_select2').on('change', function () {
      // Revalidate field
      validator.revalidateField('select2');
    }); // Typeahead

    var countries = new Bloodhound({
      datumTokenizer: Bloodhound.tokenizers.whitespace,
      queryTokenizer: Bloodhound.tokenizers.whitespace,
      prefetch: HOST_URL + '/api/?file=typeahead/countries.json'
    });
    $('#kt_typeahead').typeahead(null, {
      name: 'countries',
      source: countries
    });
    $('#kt_typeahead').bind('typeahead:select', function (ev, suggestion) {
      // Revalidate field
      validator.revalidateField('typeahead');
    });
  };

  var _initValidation = function _initValidation() {
    // Validation Rules
    validator = FormValidation.formValidation(document.getElementById('kt_form'), {
      fields: {
        date: {
          validators: {
            notEmpty: {
              message: 'Date is required'
            }
          }
        },
        daterangepicker: {
          validators: {
            notEmpty: {
              message: 'Daterange is required'
            }
          }
        },
        datetime: {
          validators: {
            notEmpty: {
              message: 'Datetime is required'
            }
          }
        },
        time: {
          validators: {
            notEmpty: {
              message: 'Time is required'
            }
          }
        },
        select: {
          validators: {
            notEmpty: {
              message: 'Select is required'
            }
          }
        },
        select2: {
          validators: {
            notEmpty: {
              message: 'Select2 is required'
            }
          }
        },
        typeahead: {
          validators: {
            notEmpty: {
              message: 'Typeahead is required'
            }
          }
        },
        "switch": {
          validators: {
            notEmpty: {
              message: 'Typeahead is required'
            }
          }
        },
        markdown: {
          validators: {
            notEmpty: {
              message: 'Typeahead is required'
            }
          }
        }
      },
      plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        // Validate fields when clicking the Submit button
        submitButton: new FormValidation.plugins.SubmitButton(),
        // Submit the form when all fields are valid
        defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
        // Bootstrap Framework Integration
        bootstrap: new FormValidation.plugins.Bootstrap({
          eleInvalidClass: '',
          eleValidClass: ''
        })
      }
    });
  };

  return {
    // public functions
    init: function init() {
      _initWidgets();

      _initValidation();
    }
  };
}();

jQuery(document).ready(function () {
  KTFormWidgetsValidation.init();
});

/***/ }),

/***/ 60:
/*!*********************************************************************************!*\
  !*** multi ./resources/metronic/js/pages/crud/forms/validation/form-widgets.js ***!
  \*********************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\wamp64\www\keenthemes\themes\metronic\theme\html_laravel\demo1\skeleton\resources\metronic\js\pages\crud\forms\validation\form-widgets.js */"./resources/metronic/js/pages/crud/forms/validation/form-widgets.js");


/***/ })

/******/ });