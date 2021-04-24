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
/******/ 	return __webpack_require__(__webpack_require__.s = 63);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/metronic/js/pages/crud/forms/widgets/bootstrap-daterangepicker.js":
/*!*************************************************************************************!*\
  !*** ./resources/metronic/js/pages/crud/forms/widgets/bootstrap-daterangepicker.js ***!
  \*************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// Class definition
var KTBootstrapDaterangepicker = function () {
  // Private functions
  var demos = function demos() {
    // minimum setup
    $('#kt_daterangepicker_1, #kt_daterangepicker_1_modal').daterangepicker({
      buttonClasses: ' btn',
      applyClass: 'btn-primary',
      cancelClass: 'btn-secondary'
    }); // input group and left alignment setup

    $('#kt_daterangepicker_2').daterangepicker({
      buttonClasses: ' btn',
      applyClass: 'btn-primary',
      cancelClass: 'btn-secondary'
    }, function (start, end, label) {
      $('#kt_daterangepicker_2 .form-control').val(start.format('YYYY-MM-DD') + ' / ' + end.format('YYYY-MM-DD'));
    });
    $('#kt_daterangepicker_2_modal').daterangepicker({
      buttonClasses: ' btn',
      applyClass: 'btn-primary',
      cancelClass: 'btn-secondary'
    }, function (start, end, label) {
      $('#kt_daterangepicker_2 .form-control').val(start.format('YYYY-MM-DD') + ' / ' + end.format('YYYY-MM-DD'));
    }); // left alignment setup

    $('#kt_daterangepicker_3').daterangepicker({
      buttonClasses: ' btn',
      applyClass: 'btn-primary',
      cancelClass: 'btn-secondary'
    }, function (start, end, label) {
      $('#kt_daterangepicker_3 .form-control').val(start.format('YYYY-MM-DD') + ' / ' + end.format('YYYY-MM-DD'));
    });
    $('#kt_daterangepicker_3_modal').daterangepicker({
      buttonClasses: ' btn',
      applyClass: 'btn-primary',
      cancelClass: 'btn-secondary'
    }, function (start, end, label) {
      $('#kt_daterangepicker_3 .form-control').val(start.format('YYYY-MM-DD') + ' / ' + end.format('YYYY-MM-DD'));
    }); // date & time

    $('#kt_daterangepicker_4').daterangepicker({
      buttonClasses: ' btn',
      applyClass: 'btn-primary',
      cancelClass: 'btn-secondary',
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY h:mm A'
      }
    }, function (start, end, label) {
      $('#kt_daterangepicker_4 .form-control').val(start.format('MM/DD/YYYY h:mm A') + ' / ' + end.format('MM/DD/YYYY h:mm A'));
    }); // date picker

    $('#kt_daterangepicker_5').daterangepicker({
      buttonClasses: ' btn',
      applyClass: 'btn-primary',
      cancelClass: 'btn-secondary',
      singleDatePicker: true,
      showDropdowns: true,
      locale: {
        format: 'MM/DD/YYYY'
      }
    }, function (start, end, label) {
      $('#kt_daterangepicker_5 .form-control').val(start.format('MM/DD/YYYY') + ' / ' + end.format('MM/DD/YYYY'));
    }); // predefined ranges

    var start = moment().subtract(29, 'days');
    var end = moment();
    $('#kt_daterangepicker_6').daterangepicker({
      buttonClasses: ' btn',
      applyClass: 'btn-primary',
      cancelClass: 'btn-secondary',
      startDate: start,
      endDate: end,
      ranges: {
        'Today': [moment(), moment()],
        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month': [moment().startOf('month'), moment().endOf('month')],
        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      }
    }, function (start, end, label) {
      $('#kt_daterangepicker_6 .form-control').val(start.format('MM/DD/YYYY') + ' / ' + end.format('MM/DD/YYYY'));
    });
  };

  var validationDemos = function validationDemos() {
    // input group and left alignment setup
    $('#kt_daterangepicker_1_validate').daterangepicker({
      buttonClasses: ' btn',
      applyClass: 'btn-primary',
      cancelClass: 'btn-secondary'
    }, function (start, end, label) {
      $('#kt_daterangepicker_1_validate .form-control').val(start.format('YYYY-MM-DD') + ' / ' + end.format('YYYY-MM-DD'));
    }); // input group and left alignment setup

    $('#kt_daterangepicker_2_validate').daterangepicker({
      buttonClasses: ' btn',
      applyClass: 'btn-primary',
      cancelClass: 'btn-secondary'
    }, function (start, end, label) {
      $('#kt_daterangepicker_3_validate .form-control').val(start.format('YYYY-MM-DD') + ' / ' + end.format('YYYY-MM-DD'));
    }); // input group and left alignment setup

    $('#kt_daterangepicker_3_validate').daterangepicker({
      buttonClasses: ' btn',
      applyClass: 'btn-primary',
      cancelClass: 'btn-secondary'
    }, function (start, end, label) {
      $('#kt_daterangepicker_3_validate .form-control').val(start.format('YYYY-MM-DD') + ' / ' + end.format('YYYY-MM-DD'));
    });
  };

  return {
    // public functions
    init: function init() {
      demos();
      validationDemos();
    }
  };
}();

jQuery(document).ready(function () {
  KTBootstrapDaterangepicker.init();
});

/***/ }),

/***/ 63:
/*!*******************************************************************************************!*\
  !*** multi ./resources/metronic/js/pages/crud/forms/widgets/bootstrap-daterangepicker.js ***!
  \*******************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\wamp64\www\keenthemes\themes\metronic\theme\html_laravel\demo1\skeleton\resources\metronic\js\pages\crud\forms\widgets\bootstrap-daterangepicker.js */"./resources/metronic/js/pages/crud/forms/widgets/bootstrap-daterangepicker.js");


/***/ })

/******/ });