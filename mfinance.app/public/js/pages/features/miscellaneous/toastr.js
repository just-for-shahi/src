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
/******/ 	return __webpack_require__(__webpack_require__.s = 154);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/metronic/js/pages/features/miscellaneous/toastr.js":
/*!**********************************************************************!*\
  !*** ./resources/metronic/js/pages/features/miscellaneous/toastr.js ***!
  \**********************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
 // Class definition

var KTToastrDemo = function () {
  // Private functions
  // basic demo
  var demo = function demo() {
    var i = -1;
    var toastCount = 0;
    var $toastlast;

    var getMessage = function getMessage() {
      var msgs = ['New order has been placed!', 'Are you the six fingered man?', 'Inconceivable!', 'I do not think that means what you think it means.', 'Have fun storming the castle!'];
      i++;

      if (i === msgs.length) {
        i = 0;
      }

      return msgs[i];
    };

    var getMessageWithClearButton = function getMessageWithClearButton(msg) {
      msg = msg ? msg : 'Clear itself?';
      msg += '<br /><br /><button type="button" class="btn btn-outline-light btn-sm--air--wide clear">Yes</button>';
      return msg;
    };

    $('#showtoast').click(function () {
      var shortCutFunction = $("#toastTypeGroup input:radio:checked").val();
      var msg = $('#message').val();
      var title = $('#title').val() || '';
      var $showDuration = $('#showDuration');
      var $hideDuration = $('#hideDuration');
      var $timeOut = $('#timeOut');
      var $extendedTimeOut = $('#extendedTimeOut');
      var $showEasing = $('#showEasing');
      var $hideEasing = $('#hideEasing');
      var $showMethod = $('#showMethod');
      var $hideMethod = $('#hideMethod');
      var toastIndex = toastCount++;
      var addClear = $('#addClear').prop('checked');
      toastr.options = {
        closeButton: $('#closeButton').prop('checked'),
        debug: $('#debugInfo').prop('checked'),
        newestOnTop: $('#newestOnTop').prop('checked'),
        progressBar: $('#progressBar').prop('checked'),
        positionClass: $('#positionGroup input:radio:checked').val() || 'toast-top-right',
        preventDuplicates: $('#preventDuplicates').prop('checked'),
        onclick: null
      };

      if ($('#addBehaviorOnToastClick').prop('checked')) {
        toastr.options.onclick = function () {
          alert('You can perform some custom action after a toast goes away');
        };
      }

      if ($showDuration.val().length) {
        toastr.options.showDuration = $showDuration.val();
      }

      if ($hideDuration.val().length) {
        toastr.options.hideDuration = $hideDuration.val();
      }

      if ($timeOut.val().length) {
        toastr.options.timeOut = addClear ? 0 : $timeOut.val();
      }

      if ($extendedTimeOut.val().length) {
        toastr.options.extendedTimeOut = addClear ? 0 : $extendedTimeOut.val();
      }

      if ($showEasing.val().length) {
        toastr.options.showEasing = $showEasing.val();
      }

      if ($hideEasing.val().length) {
        toastr.options.hideEasing = $hideEasing.val();
      }

      if ($showMethod.val().length) {
        toastr.options.showMethod = $showMethod.val();
      }

      if ($hideMethod.val().length) {
        toastr.options.hideMethod = $hideMethod.val();
      }

      if (addClear) {
        msg = getMessageWithClearButton(msg);
        toastr.options.tapToDismiss = false;
      }

      if (!msg) {
        msg = getMessage();
      }

      $('#toastrOptions').text('toastr.options = ' + JSON.stringify(toastr.options, null, 2) + ';' + '\n\ntoastr.' + shortCutFunction + '("' + msg + (title ? '", "' + title : '') + '");');
      var $toast = toastr[shortCutFunction](msg, title); // Wire up an event handler to a button in the toast, if it exists

      $toastlast = $toast;

      if (typeof $toast === 'undefined') {
        return;
      }

      if ($toast.find('#okBtn').length) {
        $toast.delegate('#okBtn', 'click', function () {
          alert('you clicked me. i was toast #' + toastIndex + '. goodbye!');
          $toast.remove();
        });
      }

      if ($toast.find('#surpriseBtn').length) {
        $toast.delegate('#surpriseBtn', 'click', function () {
          alert('Surprise! you clicked me. i was toast #' + toastIndex + '. You could perform an action here.');
        });
      }

      if ($toast.find('.clear').length) {
        $toast.delegate('.clear', 'click', function () {
          toastr.clear($toast, {
            force: true
          });
        });
      }
    });

    function getLastToast() {
      return $toastlast;
    }

    $('#clearlasttoast').click(function () {
      toastr.clear(getLastToast());
    });
    $('#cleartoasts').click(function () {
      toastr.clear();
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
  KTToastrDemo.init();
});

/***/ }),

/***/ 154:
/*!****************************************************************************!*\
  !*** multi ./resources/metronic/js/pages/features/miscellaneous/toastr.js ***!
  \****************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\wamp64\www\keenthemes\themes\metronic\theme\html_laravel\demo1\skeleton\resources\metronic\js\pages\features\miscellaneous\toastr.js */"./resources/metronic/js/pages/features/miscellaneous/toastr.js");


/***/ })

/******/ });