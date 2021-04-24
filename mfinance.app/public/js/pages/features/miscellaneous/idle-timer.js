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
/******/ 	return __webpack_require__(__webpack_require__.s = 148);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/metronic/js/pages/features/miscellaneous/idle-timer.js":
/*!**************************************************************************!*\
  !*** ./resources/metronic/js/pages/features/miscellaneous/idle-timer.js ***!
  \**************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var KTIdleTimerDemo = function () {
  var _initDemo1 = function _initDemo1() {
    //Define default
    var docTimeout = 5000;
    /*
    Handle raised idle/active events
    */

    $(document).on("idle.idleTimer", function (event, elem, obj) {
      $("#docStatus").val(function (i, v) {
        return v + "Idle @ " + moment().format() + " \n";
      }).removeClass("alert-success").addClass("alert-warning").scrollTop($("#docStatus")[0].scrollHeight);
    });
    $(document).on("active.idleTimer", function (event, elem, obj, e) {
      $("#docStatus").val(function (i, v) {
        return v + "Active [" + e.type + "] [" + e.target.nodeName + "] @ " + moment().format() + " \n";
      }).addClass("alert-success").removeClass("alert-warning").scrollTop($("#docStatus")[0].scrollHeight);
    });
    /*
    Handle button events
    */

    $("#btPause").click(function () {
      $(document).idleTimer("pause");
      $("#docStatus").val(function (i, v) {
        return v + "Paused @ " + moment().format() + " \n";
      }).scrollTop($("#docStatus")[0].scrollHeight);
      $(this).blur();
      return false;
    });
    $("#btResume").click(function () {
      $(document).idleTimer("resume");
      $("#docStatus").val(function (i, v) {
        return v + "Resumed @ " + moment().format() + " \n";
      }).scrollTop($("#docStatus")[0].scrollHeight);
      $(this).blur();
      return false;
    });
    $("#btElapsed").click(function () {
      $("#docStatus").val(function (i, v) {
        return v + "Elapsed (since becoming active): " + $(document).idleTimer("getElapsedTime") + " \n";
      }).scrollTop($("#docStatus")[0].scrollHeight);
      $(this).blur();
      return false;
    });
    $("#btDestroy").click(function () {
      $(document).idleTimer("destroy");
      $("#docStatus").val(function (i, v) {
        return v + "Destroyed: @ " + moment().format() + " \n";
      }).removeClass("alert-success").removeClass("alert-warning").scrollTop($("#docStatus")[0].scrollHeight);
      $(this).blur();
      return false;
    });
    $("#btInit").click(function () {
      // for demo purposes show init with just object
      $(document).idleTimer({
        timeout: docTimeout
      });
      $("#docStatus").val(function (i, v) {
        return v + "Init: @ " + moment().format() + " \n";
      }).scrollTop($("#docStatus")[0].scrollHeight); //Apply classes for default state

      if ($(document).idleTimer("isIdle")) {
        $("#docStatus").removeClass("alert-success").addClass("alert-warning");
      } else {
        $("#docStatus").addClass("alert-success").removeClass("alert-warning");
      }

      $(this).blur();
      return false;
    }); //Clear old statuses

    $("#docStatus").val(""); //Start timeout, passing no options
    //Same as $.idleTimer(docTimeout, docOptions);

    $(document).idleTimer(docTimeout); //For demo purposes, style based on initial state

    if ($(document).idleTimer("isIdle")) {
      $("#docStatus").val(function (i, v) {
        return v + "Initial Idle State @ " + moment().format() + " \n";
      }).removeClass("alert-success").addClass("alert-warning").scrollTop($("#docStatus")[0].scrollHeight);
    } else {
      $("#docStatus").val(function (i, v) {
        return v + "Initial Active State @ " + moment().format() + " \n";
      }).addClass("alert-success").removeClass("alert-warning").scrollTop($("#docStatus")[0].scrollHeight);
    } //For demo purposes, display the actual timeout on the page


    $("#docTimeout").text(docTimeout / 1000);
  };

  var _initDemo2 = function _initDemo2() {
    //Define textarea settings
    var taTimeout = 3000;
    /*
    Handle raised idle/active events
    */

    $("#elStatus").on("idle.idleTimer", function (event, elem, obj) {
      //If you dont stop propagation it will bubble up to document event handler
      event.stopPropagation();
      $("#elStatus").val(function (i, v) {
        return v + "Idle @ " + moment().format() + " \n";
      }).removeClass("alert-success").addClass("alert-warning").scrollTop($("#elStatus")[0].scrollHeight);
    });
    $("#elStatus").on("active.idleTimer", function (event) {
      //If you dont stop propagation it will bubble up to document event handler
      event.stopPropagation();
      $("#elStatus").val(function (i, v) {
        return v + "Active @ " + moment().format() + " \n";
      }).addClass("alert-success").removeClass("alert-warning").scrollTop($("#elStatus")[0].scrollHeight);
    });
    /*
    Handle button events
    */

    $("#btReset").click(function () {
      $("#elStatus").idleTimer("reset").val(function (i, v) {
        return v + "Reset @ " + moment().format() + " \n";
      }).scrollTop($("#elStatus")[0].scrollHeight); //Apply classes for default state

      if ($("#elStatus").idleTimer("isIdle")) {
        $("#elStatus").removeClass("alert-success").addClass("alert-warning");
      } else {
        $("#elStatus").addClass("alert-success").removeClass("alert-warning");
      }

      $(this).blur();
      return false;
    });
    $("#btRemaining").click(function () {
      $("#elStatus").val(function (i, v) {
        return v + "Remaining: " + $("#elStatus").idleTimer("getRemainingTime") + " \n";
      }).scrollTop($("#elStatus")[0].scrollHeight);
      $(this).blur();
      return false;
    });
    $("#btLastActive").click(function () {
      $("#elStatus").val(function (i, v) {
        return v + "LastActive: " + $("#elStatus").idleTimer("getLastActiveTime") + " \n";
      }).scrollTop($("#elStatus")[0].scrollHeight);
      $(this).blur();
      return false;
    });
    $("#btState").click(function () {
      $("#elStatus").val(function (i, v) {
        return v + "State: " + ($("#elStatus").idleTimer("isIdle") ? "idle" : "active") + " \n";
      }).scrollTop($("#elStatus")[0].scrollHeight);
      $(this).blur();
      return false;
    }); //Clear value if there was one cached & start time

    $("#elStatus").val("").idleTimer(taTimeout); //For demo purposes, show initial state

    if ($("#elStatus").idleTimer("isIdle")) {
      $("#elStatus").val(function (i, v) {
        return v + "Initial Idle @ " + moment().format() + " \n";
      }).removeClass("alert-success").addClass("alert-warning").scrollTop($("#elStatus")[0].scrollHeight);
    } else {
      $("#elStatus").val(function (i, v) {
        return v + "Initial Active @ " + moment().format() + " \n";
      }).addClass("alert-success").removeClass("alert-warning").scrollTop($("#elStatus")[0].scrollHeight);
    } // Display the actual timeout on the page


    $("#elTimeout").text(taTimeout / 1000);
  };

  return {
    //main function to initiate the module
    init: function init() {
      _initDemo1();

      _initDemo2();
    }
  };
}();

jQuery(document).ready(function () {
  KTIdleTimerDemo.init();
});

/***/ }),

/***/ 148:
/*!********************************************************************************!*\
  !*** multi ./resources/metronic/js/pages/features/miscellaneous/idle-timer.js ***!
  \********************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\wamp64\www\keenthemes\themes\metronic\theme\html_laravel\demo1\skeleton\resources\metronic\js\pages\features\miscellaneous\idle-timer.js */"./resources/metronic/js/pages/features/miscellaneous/idle-timer.js");


/***/ })

/******/ });