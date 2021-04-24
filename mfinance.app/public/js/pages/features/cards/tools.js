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
/******/ 	return __webpack_require__(__webpack_require__.s = 132);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/metronic/js/pages/features/cards/tools.js":
/*!*************************************************************!*\
  !*** ./resources/metronic/js/pages/features/cards/tools.js ***!
  \*************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var KTCardTools = function () {
  // Toastr
  var initToastr = function initToastr() {
    toastr.options.showDuration = 1000;
  }; // Demo 1


  var demo1 = function demo1() {
    // This card is lazy initialized using data-card="true" attribute. You can access to the card object as shown below and override its behavior
    var card = new KTCard('kt_card_1'); // Toggle event handlers

    card.on('beforeCollapse', function (card) {
      setTimeout(function () {
        toastr.info('Before collapse event fired!');
      }, 100);
    });
    card.on('afterCollapse', function (card) {
      setTimeout(function () {
        toastr.warning('Before collapse event fired!');
      }, 2000);
    });
    card.on('beforeExpand', function (card) {
      setTimeout(function () {
        toastr.info('Before expand event fired!');
      }, 100);
    });
    card.on('afterExpand', function (card) {
      setTimeout(function () {
        toastr.warning('After expand event fired!');
      }, 2000);
    }); // Remove event handlers

    card.on('beforeRemove', function (card) {
      toastr.info('Before remove event fired!');
      return confirm('Are you sure to remove this card ?'); // remove card after user confirmation
    });
    card.on('afterRemove', function (card) {
      setTimeout(function () {
        toastr.warning('After remove event fired!');
      }, 2000);
    }); // Reload event handlers

    card.on('reload', function (card) {
      toastr.info('Leload event fired!');
      KTApp.block(card.getSelf(), {
        overlayColor: '#ffffff',
        type: 'loader',
        state: 'primary',
        opacity: 0.3,
        size: 'lg'
      }); // update the content here

      setTimeout(function () {
        KTApp.unblock(card.getSelf());
      }, 2000);
    });
  }; // Demo 2


  var demo2 = function demo2() {
    // This card is lazy initialized using data-card="true" attribute. You can access to the card object as shown below and override its behavior
    var card = new KTCard('kt_card_2'); // Toggle event handlers

    card.on('beforeCollapse', function (card) {
      setTimeout(function () {
        toastr.info('Before collapse event fired!');
      }, 100);
    });
    card.on('afterCollapse', function (card) {
      setTimeout(function () {
        toastr.warning('Before collapse event fired!');
      }, 2000);
    });
    card.on('beforeExpand', function (card) {
      setTimeout(function () {
        toastr.info('Before expand event fired!');
      }, 100);
    });
    card.on('afterExpand', function (card) {
      setTimeout(function () {
        toastr.warning('After expand event fired!');
      }, 2000);
    }); // Remove event handlers

    card.on('beforeRemove', function (card) {
      toastr.info('Before remove event fired!');
      return confirm('Are you sure to remove this card ?'); // remove card after user confirmation
    });
    card.on('afterRemove', function (card) {
      setTimeout(function () {
        toastr.warning('After remove event fired!');
      }, 2000);
    }); // Reload event handlers

    card.on('reload', function (card) {
      toastr.info('Leload event fired!');
      KTApp.block(card.getSelf(), {
        overlayColor: '#000000',
        type: 'spinner',
        state: 'primary',
        opacity: 0.05,
        size: 'lg'
      }); // update the content here

      setTimeout(function () {
        KTApp.unblock(card.getSelf());
      }, 2000);
    });
  }; // Demo 3


  var demo3 = function demo3() {
    // This card is lazy initialized using data-card="true" attribute. You can access to the card object as shown below and override its behavior
    var card = new KTCard('kt_card_3'); // Toggle event handlers

    card.on('beforeCollapse', function (card) {
      setTimeout(function () {
        toastr.info('Before collapse event fired!');
      }, 100);
    });
    card.on('afterCollapse', function (card) {
      setTimeout(function () {
        toastr.warning('Before collapse event fired!');
      }, 2000);
    });
    card.on('beforeExpand', function (card) {
      setTimeout(function () {
        toastr.info('Before expand event fired!');
      }, 100);
    });
    card.on('afterExpand', function (card) {
      setTimeout(function () {
        toastr.warning('After expand event fired!');
      }, 2000);
    }); // Remove event handlers

    card.on('beforeRemove', function (card) {
      toastr.info('Before remove event fired!');
      return confirm('Are you sure to remove this card ?'); // remove card after user confirmation
    });
    card.on('afterRemove', function (card) {
      setTimeout(function () {
        toastr.warning('After remove event fired!');
      }, 2000);
    }); // Reload event handlers

    card.on('reload', function (card) {
      toastr.info('Leload event fired!');
      KTApp.block(card.getSelf(), {
        type: 'loader',
        state: 'success',
        message: 'Please wait...'
      }); // update the content here

      setTimeout(function () {
        KTApp.unblock(card.getSelf());
      }, 2000);
    }); // Reload event handlers

    card.on('afterFullscreenOn', function (card) {
      toastr.warning('After fullscreen on event fired!');
      var scrollable = $(card.getBody()).find('> .kt-scroll');

      if (scrollable) {
        scrollable.data('original-height', scrollable.css('height'));
        scrollable.css('height', '100%');
        KTUtil.scrollUpdate(scrollable[0]);
      }
    });
    card.on('afterFullscreenOff', function (card) {
      toastr.warning('After fullscreen off event fired!');
      var scrollable = $(card.getBody()).find('> .kt-scroll');

      if (scrollable) {
        var scrollable = $(card.getBody()).find('> .kt-scroll');
        scrollable.css('height', scrollable.data('original-height'));
        KTUtil.scrollUpdate(scrollable[0]);
      }
    });
  }; // Demo 4


  var demo4 = function demo4() {
    // This card is lazy initialized using data-card="true" attribute. You can access to the card object as shown below and override its behavior
    var card = new KTCard('kt_card_4'); // Toggle event handlers

    card.on('beforeCollapse', function (card) {
      setTimeout(function () {
        toastr.info('Before collapse event fired!');
      }, 100);
    });
    card.on('afterCollapse', function (card) {
      setTimeout(function () {
        toastr.warning('Before collapse event fired!');
      }, 2000);
    });
    card.on('beforeExpand', function (card) {
      setTimeout(function () {
        toastr.info('Before expand event fired!');
      }, 100);
    });
    card.on('afterExpand', function (card) {
      setTimeout(function () {
        toastr.warning('After expand event fired!');
      }, 2000);
    }); // Remove event handlers

    card.on('beforeRemove', function (card) {
      toastr.info('Before remove event fired!');
      return confirm('Are you sure to remove this card ?'); // remove card after user confirmation
    });
    card.on('afterRemove', function (card) {
      setTimeout(function () {
        toastr.warning('After remove event fired!');
      }, 2000);
    }); // Reload event handlers

    card.on('reload', function (card) {
      toastr.info('Leload event fired!');
      KTApp.block(card.getSelf(), {
        type: 'loader',
        state: 'primary',
        message: 'Please wait...'
      }); // update the content here

      setTimeout(function () {
        KTApp.unblock(card.getSelf());
      }, 2000);
    }); // Reload event handlers

    card.on('afterFullscreenOn', function (card) {
      toastr.warning('After fullscreen on event fired!');
      var scrollable = $(card.getBody()).find('> .kt-scroll');

      if (scrollable) {
        scrollable.data('original-height', scrollable.css('height'));
        scrollable.css('height', '100%');
        KTUtil.scrollUpdate(scrollable[0]);
      }
    });
    card.on('afterFullscreenOff', function (card) {
      toastr.warning('After fullscreen off event fired!');
      var scrollable = $(card.getBody()).find('> .kt-scroll');

      if (scrollable) {
        var scrollable = $(card.getBody()).find('> .kt-scroll');
        scrollable.css('height', scrollable.data('original-height'));
        KTUtil.scrollUpdate(scrollable[0]);
      }
    });
  };

  return {
    //main function to initiate the module
    init: function init() {
      initToastr(); // init demos

      demo1();
      demo2();
      demo3();
      demo4();
    }
  };
}();

jQuery(document).ready(function () {
  KTCardTools.init();
});

/***/ }),

/***/ 132:
/*!*******************************************************************!*\
  !*** multi ./resources/metronic/js/pages/features/cards/tools.js ***!
  \*******************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\wamp64\www\keenthemes\themes\metronic\theme\html_laravel\demo1\skeleton\resources\metronic\js\pages\features\cards\tools.js */"./resources/metronic/js/pages/features/cards/tools.js");


/***/ })

/******/ });