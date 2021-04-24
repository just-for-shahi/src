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
/******/ 	return __webpack_require__(__webpack_require__.s = 62);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/metronic/js/pages/crud/forms/widgets/bootstrap-datepicker.js":
/*!********************************************************************************!*\
  !*** ./resources/metronic/js/pages/crud/forms/widgets/bootstrap-datepicker.js ***!
  \********************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// Class definition
var KTBootstrapDatepicker = function () {
  var arrows;

  if (KTUtil.isRTL()) {
    arrows = {
      leftArrow: '<i class="la la-angle-right"></i>',
      rightArrow: '<i class="la la-angle-left"></i>'
    };
  } else {
    arrows = {
      leftArrow: '<i class="la la-angle-left"></i>',
      rightArrow: '<i class="la la-angle-right"></i>'
    };
  } // Private functions


  var demos = function demos() {
    // minimum setup
    $('#kt_datepicker_1, #kt_datepicker_1_validate').datepicker({
      rtl: KTUtil.isRTL(),
      todayHighlight: true,
      orientation: "bottom left",
      templates: arrows
    }); // minimum setup for modal demo

    $('#kt_datepicker_1_modal').datepicker({
      rtl: KTUtil.isRTL(),
      todayHighlight: true,
      orientation: "bottom left",
      templates: arrows
    }); // input group layout 

    $('#kt_datepicker_2, #kt_datepicker_2_validate').datepicker({
      rtl: KTUtil.isRTL(),
      todayHighlight: true,
      orientation: "bottom left",
      templates: arrows
    }); // input group layout for modal demo

    $('#kt_datepicker_2_modal').datepicker({
      rtl: KTUtil.isRTL(),
      todayHighlight: true,
      orientation: "bottom left",
      templates: arrows
    }); // enable clear button 

    $('#kt_datepicker_3, #kt_datepicker_3_validate').datepicker({
      rtl: KTUtil.isRTL(),
      todayBtn: "linked",
      clearBtn: true,
      todayHighlight: true,
      templates: arrows
    }); // enable clear button for modal demo

    $('#kt_datepicker_3_modal').datepicker({
      rtl: KTUtil.isRTL(),
      todayBtn: "linked",
      clearBtn: true,
      todayHighlight: true,
      templates: arrows
    }); // orientation 

    $('#kt_datepicker_4_1').datepicker({
      rtl: KTUtil.isRTL(),
      orientation: "top left",
      todayHighlight: true,
      templates: arrows
    });
    $('#kt_datepicker_4_2').datepicker({
      rtl: KTUtil.isRTL(),
      orientation: "top right",
      todayHighlight: true,
      templates: arrows
    });
    $('#kt_datepicker_4_3').datepicker({
      rtl: KTUtil.isRTL(),
      orientation: "bottom left",
      todayHighlight: true,
      templates: arrows
    });
    $('#kt_datepicker_4_4').datepicker({
      rtl: KTUtil.isRTL(),
      orientation: "bottom right",
      todayHighlight: true,
      templates: arrows
    }); // range picker

    $('#kt_datepicker_5').datepicker({
      rtl: KTUtil.isRTL(),
      todayHighlight: true,
      templates: arrows
    }); // inline picker

    $('#kt_datepicker_6').datepicker({
      rtl: KTUtil.isRTL(),
      todayHighlight: true,
      templates: arrows
    });
  };

  return {
    // public functions
    init: function init() {
      demos();
    }
  };
}();

jQuery(document).ready(function () {
  KTBootstrapDatepicker.init();
});

/***/ }),

/***/ 62:
/*!**************************************************************************************!*\
  !*** multi ./resources/metronic/js/pages/crud/forms/widgets/bootstrap-datepicker.js ***!
  \**************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\wamp64\www\keenthemes\themes\metronic\theme\html_laravel\demo1\skeleton\resources\metronic\js\pages\crud\forms\widgets\bootstrap-datepicker.js */"./resources/metronic/js/pages/crud/forms/widgets/bootstrap-datepicker.js");


/***/ })

/******/ });