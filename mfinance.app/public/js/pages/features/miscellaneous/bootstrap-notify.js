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
/******/ 	return __webpack_require__(__webpack_require__.s = 145);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/metronic/js/pages/features/miscellaneous/bootstrap-notify.js":
/*!********************************************************************************!*\
  !*** ./resources/metronic/js/pages/features/miscellaneous/bootstrap-notify.js ***!
  \********************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
 // Class definition

var KTBootstrapNotifyDemo = function () {
  // Private functions
  // basic demo
  var demo = function demo() {
    // init bootstrap switch
    $('[data-switch=true]').bootstrapSwitch(); // handle the demo

    $('#kt_notify_btn').click(function () {
      var content = {};
      content.message = 'New order has been placed';

      if ($('#kt_notify_title').prop('checked')) {
        content.title = 'Notification Title';
      }

      if ($('#kt_notify_icon').val() != '') {
        content.icon = 'icon ' + $('#kt_notify_icon').val();
      }

      if ($('#kt_notify_url').prop('checked')) {
        content.url = 'www.keenthemes.com';
        content.target = '_blank';
      }

      var notify = $.notify(content, {
        type: $('#kt_notify_state').val(),
        allow_dismiss: $('#kt_notify_dismiss').prop('checked'),
        newest_on_top: $('#kt_notify_top').prop('checked'),
        mouse_over: $('#kt_notify_pause').prop('checked'),
        showProgressbar: $('#kt_notify_progress').prop('checked'),
        spacing: $('#kt_notify_spacing').val(),
        timer: $('#kt_notify_timer').val(),
        placement: {
          from: $('#kt_notify_placement_from').val(),
          align: $('#kt_notify_placement_align').val()
        },
        offset: {
          x: $('#kt_notify_offset_x').val(),
          y: $('#kt_notify_offset_y').val()
        },
        delay: $('#kt_notify_delay').val(),
        z_index: $('#kt_notify_zindex').val(),
        animate: {
          enter: 'animate__animated animate__' + $('#kt_notify_animate_enter').val(),
          exit: 'animate__animated animate__' + $('#kt_notify_animate_exit').val()
        }
      });

      if ($('#kt_notify_progress').prop('checked')) {
        setTimeout(function () {
          notify.update('message', '<strong>Saving</strong> Page Data.');
          notify.update('type', 'primary');
          notify.update('progress', 20);
        }, 1000);
        setTimeout(function () {
          notify.update('message', '<strong>Saving</strong> User Data.');
          notify.update('type', 'warning');
          notify.update('progress', 40);
        }, 2000);
        setTimeout(function () {
          notify.update('message', '<strong>Saving</strong> Profile Data.');
          notify.update('type', 'danger');
          notify.update('progress', 65);
        }, 3000);
        setTimeout(function () {
          notify.update('message', '<strong>Checking</strong> for errors.');
          notify.update('type', 'success');
          notify.update('progress', 100);
        }, 4000);
      }
    });
  };

  return {
    // public functions
    init: function init() {
      demo();
    }
  };
}();

jQuery(document).ready(function () {
  KTBootstrapNotifyDemo.init();
});

/***/ }),

/***/ 145:
/*!**************************************************************************************!*\
  !*** multi ./resources/metronic/js/pages/features/miscellaneous/bootstrap-notify.js ***!
  \**************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\wamp64\www\keenthemes\themes\metronic\theme\html_laravel\demo1\skeleton\resources\metronic\js\pages\features\miscellaneous\bootstrap-notify.js */"./resources/metronic/js/pages/features/miscellaneous/bootstrap-notify.js");


/***/ })

/******/ });