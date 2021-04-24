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
/******/ 	return __webpack_require__(__webpack_require__.s = 146);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/metronic/js/pages/features/miscellaneous/cropper.js":
/*!***********************************************************************!*\
  !*** ./resources/metronic/js/pages/features/miscellaneous/cropper.js ***!
  \***********************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
 // Class definition

var KTCropperDemo = function () {
  // Private functions
  var initCropperDemo = function initCropperDemo() {
    var image = document.getElementById('image');
    var options = {
      crop: function crop(event) {
        document.getElementById('dataX').value = Math.round(event.detail.x);
        document.getElementById('dataY').value = Math.round(event.detail.y);
        document.getElementById('dataWidth').value = Math.round(event.detail.width);
        document.getElementById('dataHeight').value = Math.round(event.detail.height);
        document.getElementById('dataRotate').value = event.detail.rotate;
        document.getElementById('dataScaleX').value = event.detail.scaleX;
        document.getElementById('dataScaleY').value = event.detail.scaleY;
        var lg = document.getElementById('cropper-preview-lg');
        lg.innerHTML = '';
        lg.appendChild(cropper.getCroppedCanvas({
          width: 256,
          height: 160
        }));
        var md = document.getElementById('cropper-preview-md');
        md.innerHTML = '';
        md.appendChild(cropper.getCroppedCanvas({
          width: 128,
          height: 80
        }));
        var sm = document.getElementById('cropper-preview-sm');
        sm.innerHTML = '';
        sm.appendChild(cropper.getCroppedCanvas({
          width: 64,
          height: 40
        }));
        var xs = document.getElementById('cropper-preview-xs');
        xs.innerHTML = '';
        xs.appendChild(cropper.getCroppedCanvas({
          width: 32,
          height: 20
        }));
      }
    };
    var cropper = new Cropper(image, options);
    var buttons = document.getElementById('cropper-buttons');
    var methods = buttons.querySelectorAll('[data-method]');
    methods.forEach(function (button) {
      button.addEventListener('click', function (e) {
        var method = button.getAttribute('data-method');
        var option = button.getAttribute('data-option');
        var option2 = button.getAttribute('data-second-option');

        try {
          option = JSON.parse(option);
        } catch (e) {}

        var result;

        if (!option2) {
          result = cropper[method](option, option2);
        } else if (option) {
          result = cropper[method](option);
        } else {
          result = cropper[method]();
        }

        if (method === 'getCroppedCanvas') {
          var modal = document.getElementById('getCroppedCanvasModal');
          var modalBody = modal.querySelector('.modal-body');
          modalBody.innerHTML = '';
          modalBody.appendChild(result);
        }

        var input = document.querySelector('#putData');

        try {
          input.value = JSON.stringify(result);
        } catch (e) {
          if (!result) {
            input.value = result;
          }
        }
      });
    }); // set aspect ratio option buttons

    var radioOptions = document.getElementById('setAspectRatio').querySelectorAll('[name="aspectRatio"]');
    radioOptions.forEach(function (button) {
      button.addEventListener('click', function (e) {
        cropper.setAspectRatio(e.target.value);
      });
    }); // set view mode

    var viewModeOptions = document.getElementById('viewMode').querySelectorAll('[name="viewMode"]');
    viewModeOptions.forEach(function (button) {
      button.addEventListener('click', function (e) {
        cropper.destroy();
        cropper = new Cropper(image, Object.assign({}, options, {
          viewMode: e.target.value
        }));
      });
    });
    var toggleoptions = document.getElementById('toggleOptionButtons').querySelectorAll('[type="checkbox"]');
    toggleoptions.forEach(function (checkbox) {
      checkbox.addEventListener('click', function (e) {
        var appendOption = {};
        appendOption[e.target.getAttribute('name')] = e.target.checked;
        options = Object.assign({}, options, appendOption);
        cropper.destroy();
        cropper = new Cropper(image, options);
      });
    });
  };

  return {
    // public functions
    init: function init() {
      initCropperDemo();
    }
  };
}();

jQuery(document).ready(function () {
  KTCropperDemo.init();
});

/***/ }),

/***/ 146:
/*!*****************************************************************************!*\
  !*** multi ./resources/metronic/js/pages/features/miscellaneous/cropper.js ***!
  \*****************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\wamp64\www\keenthemes\themes\metronic\theme\html_laravel\demo1\skeleton\resources\metronic\js\pages\features\miscellaneous\cropper.js */"./resources/metronic/js/pages/features/miscellaneous/cropper.js");


/***/ })

/******/ });