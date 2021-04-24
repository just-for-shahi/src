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
/******/ 	return __webpack_require__(__webpack_require__.s = 97);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/metronic/js/pages/custom/chat/chat.js":
/*!*********************************************************!*\
  !*** ./resources/metronic/js/pages/custom/chat/chat.js ***!
  \*********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
 // Class definition

var KTAppChat = function () {
  var _chatAsideEl;

  var _chatAsideOffcanvasObj;

  var _chatContentEl; // Private functions


  var _initAside = function _initAside() {
    // Mobile offcanvas for mobile mode
    _chatAsideOffcanvasObj = new KTOffcanvas(_chatAsideEl, {
      overlay: true,
      baseClass: 'offcanvas-mobile',
      //closeBy: 'kt_chat_aside_close',
      toggleBy: 'kt_app_chat_toggle'
    }); // User listing

    var cardScrollEl = KTUtil.find(_chatAsideEl, '.scroll');
    var cardBodyEl = KTUtil.find(_chatAsideEl, '.card-body');
    var searchEl = KTUtil.find(_chatAsideEl, '.input-group');

    if (cardScrollEl) {
      // Initialize perfect scrollbar(see:  https://github.com/utatti/perfect-scrollbar)
      KTUtil.scrollInit(cardScrollEl, {
        mobileNativeScroll: true,
        // Enable native scroll for mobile
        desktopNativeScroll: false,
        // Disable native scroll and use custom scroll for desktop
        resetHeightOnDestroy: true,
        // Reset css height on scroll feature destroyed
        handleWindowResize: true,
        // Recalculate hight on window resize
        rememberPosition: true,
        // Remember scroll position in cookie
        height: function height() {
          // Calculate height
          var height;

          if (KTUtil.isBreakpointUp('lg')) {
            height = KTLayoutContent.getHeight();
          } else {
            height = KTUtil.getViewPort().height;
          }

          if (_chatAsideEl) {
            height = height - parseInt(KTUtil.css(_chatAsideEl, 'margin-top')) - parseInt(KTUtil.css(_chatAsideEl, 'margin-bottom'));
            height = height - parseInt(KTUtil.css(_chatAsideEl, 'padding-top')) - parseInt(KTUtil.css(_chatAsideEl, 'padding-bottom'));
          }

          if (cardScrollEl) {
            height = height - parseInt(KTUtil.css(cardScrollEl, 'margin-top')) - parseInt(KTUtil.css(cardScrollEl, 'margin-bottom'));
          }

          if (cardBodyEl) {
            height = height - parseInt(KTUtil.css(cardBodyEl, 'padding-top')) - parseInt(KTUtil.css(cardBodyEl, 'padding-bottom'));
          }

          if (searchEl) {
            height = height - parseInt(KTUtil.css(searchEl, 'height'));
            height = height - parseInt(KTUtil.css(searchEl, 'margin-top')) - parseInt(KTUtil.css(searchEl, 'margin-bottom'));
          } // Remove additional space


          height = height - 2;
          return height;
        }
      });
    }
  };

  return {
    // Public functions
    init: function init() {
      // Elements
      _chatAsideEl = KTUtil.getById('kt_chat_aside');
      _chatContentEl = KTUtil.getById('kt_chat_content'); // Init aside and user list

      _initAside(); // Init inline chat example


      KTLayoutChat.setup(KTUtil.getById('kt_chat_content')); // Trigger click to show popup modal chat on page load

      if (KTUtil.getById('kt_app_chat_toggle')) {
        setTimeout(function () {
          KTUtil.getById('kt_app_chat_toggle').click();
        }, 1000);
      }
    }
  };
}();

jQuery(document).ready(function () {
  KTAppChat.init();
});

/***/ }),

/***/ 97:
/*!***************************************************************!*\
  !*** multi ./resources/metronic/js/pages/custom/chat/chat.js ***!
  \***************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\wamp64\www\keenthemes\themes\metronic\theme\html_laravel\demo1\skeleton\resources\metronic\js\pages\custom\chat\chat.js */"./resources/metronic/js/pages/custom/chat/chat.js");


/***/ })

/******/ });