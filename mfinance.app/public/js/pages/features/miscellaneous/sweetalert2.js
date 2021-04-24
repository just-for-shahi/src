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
/******/ 	return __webpack_require__(__webpack_require__.s = 153);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/metronic/js/pages/features/miscellaneous/sweetalert2.js":
/*!***************************************************************************!*\
  !*** ./resources/metronic/js/pages/features/miscellaneous/sweetalert2.js ***!
  \***************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
 // Class definition

var KTSweetAlert2Demo = function () {
  var _init = function _init() {
    // Sweetalert Demo 1
    $('#kt_sweetalert_demo_1').click(function (e) {
      Swal.fire('Good job!');
    }); // Sweetalert Demo 2

    $('#kt_sweetalert_demo_2').click(function (e) {
      Swal.fire("Here's the title!", "...and here's the text!");
    }); // Sweetalert Demo 3

    $('#kt_sweetalert_demo_3_1').click(function (e) {
      Swal.fire("Good job!", "You clicked the button!", "warning");
    });
    $('#kt_sweetalert_demo_3_2').click(function (e) {
      Swal.fire("Good job!", "You clicked the button!", "error");
    });
    $('#kt_sweetalert_demo_3_3').click(function (e) {
      Swal.fire("Good job!", "You clicked the button!", "success");
    });
    $('#kt_sweetalert_demo_3_4').click(function (e) {
      Swal.fire("Good job!", "You clicked the button!", "info");
    });
    $('#kt_sweetalert_demo_3_5').click(function (e) {
      Swal.fire("Good job!", "You clicked the button!", "question");
    }); // Sweetalert Demo 4

    $("#kt_sweetalert_demo_4").click(function (e) {
      Swal.fire({
        title: "Good job!",
        text: "You clicked the button!",
        icon: "success",
        buttonsStyling: false,
        confirmButtonText: "Confirm me!",
        customClass: {
          confirmButton: "btn btn-primary"
        }
      });
    }); // Sweetalert Demo 5

    $("#kt_sweetalert_demo_5").click(function (e) {
      Swal.fire({
        title: "Good job!",
        text: "You clicked the button!",
        icon: "success",
        buttonsStyling: false,
        confirmButtonText: "<i class='la la-headphones'></i> I am game!",
        showCancelButton: true,
        cancelButtonText: "<i class='la la-thumbs-down'></i> No, thanks",
        customClass: {
          confirmButton: "btn btn-danger",
          cancelButton: "btn btn-default"
        }
      });
    });
    $('#kt_sweetalert_demo_6').click(function (e) {
      Swal.fire({
        position: 'top-right',
        icon: 'success',
        title: 'Your work has been saved',
        showConfirmButton: false,
        timer: 1500
      });
    });
    $('#kt_sweetalert_demo_7').click(function (e) {
      Swal.fire({
        title: 'jQuery HTML example',
        showClass: {
          popup: 'animate__animated animate__wobble'
        },
        hideClass: {
          popup: 'animate__animated animate__swing'
        }
      });
    });
    $('#kt_sweetalert_demo_8').click(function (e) {
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!'
      }).then(function (result) {
        if (result.value) {
          Swal.fire('Deleted!', 'Your file has been deleted.', 'success');
        }
      });
    });
    $('#kt_sweetalert_demo_9').click(function (e) {
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
      }).then(function (result) {
        if (result.value) {
          Swal.fire('Deleted!', 'Your file has been deleted.', 'success'); // result.dismiss can be 'cancel', 'overlay',
          // 'close', and 'timer'
        } else if (result.dismiss === 'cancel') {
          Swal.fire('Cancelled', 'Your imaginary file is safe :)', 'error');
        }
      });
    });
    $('#kt_sweetalert_demo_10').click(function (e) {
      Swal.fire({
        title: 'Sweet!',
        text: 'Modal with a custom image.',
        imageUrl: 'https://unsplash.it/400/200',
        imageWidth: 400,
        imageHeight: 200,
        imageAlt: 'Custom image',
        animation: false
      });
    });
    $('#kt_sweetalert_demo_11').click(function (e) {
      Swal.fire({
        title: 'Auto close alert!',
        text: 'I will close in 5 seconds.',
        timer: 5000,
        onOpen: function onOpen() {
          Swal.showLoading();
        }
      }).then(function (result) {
        if (result.dismiss === 'timer') {
          console.log('I was closed by the timer');
        }
      });
    });
  };

  return {
    // Init
    init: function init() {
      _init();
    }
  };
}(); // Class Initialization


jQuery(document).ready(function () {
  KTSweetAlert2Demo.init();
});

/***/ }),

/***/ 153:
/*!*********************************************************************************!*\
  !*** multi ./resources/metronic/js/pages/features/miscellaneous/sweetalert2.js ***!
  \*********************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\wamp64\www\keenthemes\themes\metronic\theme\html_laravel\demo1\skeleton\resources\metronic\js\pages\features\miscellaneous\sweetalert2.js */"./resources/metronic/js/pages/features/miscellaneous/sweetalert2.js");


/***/ })

/******/ });