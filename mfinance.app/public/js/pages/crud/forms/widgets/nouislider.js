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
/******/ 	return __webpack_require__(__webpack_require__.s = 76);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/metronic/js/pages/crud/forms/widgets/nouislider.js":
/*!**********************************************************************!*\
  !*** ./resources/metronic/js/pages/crud/forms/widgets/nouislider.js ***!
  \**********************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// Class definition
var KTnoUiSliderDemos = function () {
  // Private functions
  var demo1 = function demo1() {
    // init slider
    var slider = document.getElementById('kt_nouislider_1');
    noUiSlider.create(slider, {
      start: [0],
      step: 2,
      range: {
        'min': [0],
        'max': [10]
      },
      format: wNumb({
        decimals: 0
      })
    }); // init slider input

    var sliderInput = document.getElementById('kt_nouislider_1_input');
    slider.noUiSlider.on('update', function (values, handle) {
      sliderInput.value = values[handle];
    });
    sliderInput.addEventListener('change', function () {
      slider.noUiSlider.set(this.value);
    });
  };

  var demo2 = function demo2() {
    // init slider
    var slider = document.getElementById('kt_nouislider_2');
    noUiSlider.create(slider, {
      start: [20000],
      connect: [true, false],
      step: 1000,
      range: {
        'min': [20000],
        'max': [80000]
      },
      format: wNumb({
        decimals: 3,
        thousand: '.',
        postfix: ' (US $)'
      })
    }); // init slider input

    var sliderInput = document.getElementById('kt_nouislider_2_input');
    slider.noUiSlider.on('update', function (values, handle) {
      sliderInput.value = values[handle];
    });
    sliderInput.addEventListener('change', function () {
      slider.noUiSlider.set(this.value);
    });
  };

  var demo3 = function demo3() {
    // init slider
    var slider = document.getElementById('kt_nouislider_3');
    noUiSlider.create(slider, {
      start: [20, 80],
      connect: true,
      direction: 'rtl',
      tooltips: [true, wNumb({
        decimals: 1
      })],
      range: {
        'min': [0],
        '10%': [10, 10],
        '50%': [80, 50],
        '80%': 150,
        'max': 200
      }
    }); // init slider input

    var sliderInput0 = document.getElementById('kt_nouislider_3_input');
    var sliderInput1 = document.getElementById('kt_nouislider_3.1_input');
    var sliderInputs = [sliderInput1, sliderInput0];
    slider.noUiSlider.on('update', function (values, handle) {
      sliderInputs[handle].value = values[handle];
    });
  };

  var demo4 = function demo4() {
    var slider = document.getElementById('kt_nouislider_input_select'); // Append the option elements

    for (var i = -20; i <= 40; i++) {
      var option = document.createElement("option");
      option.text = i;
      option.value = i;
      slider.appendChild(option);
    } // init slider


    var html5Slider = document.getElementById('kt_nouislider_4');
    noUiSlider.create(html5Slider, {
      start: [10, 30],
      connect: true,
      range: {
        'min': -20,
        'max': 40
      }
    }); // init slider input

    var inputNumber = document.getElementById('kt_nouislider_input_number');
    html5Slider.noUiSlider.on('update', function (values, handle) {
      var value = values[handle];

      if (handle) {
        inputNumber.value = value;
      } else {
        slider.value = Math.round(value);
      }
    });
    slider.addEventListener('change', function () {
      html5Slider.noUiSlider.set([this.value, null]);
    });
    inputNumber.addEventListener('change', function () {
      html5Slider.noUiSlider.set([null, this.value]);
    });
  };

  var demo5 = function demo5() {
    // init slider
    var slider = document.getElementById('kt_nouislider_5');
    noUiSlider.create(slider, {
      start: 20,
      range: {
        min: 0,
        max: 100
      },
      pips: {
        mode: 'values',
        values: [20, 80],
        density: 4
      }
    });
    var sliderInput = document.getElementById('kt_nouislider_5_input');
    slider.noUiSlider.on('update', function (values, handle) {
      sliderInput.value = values[handle];
    });
    sliderInput.addEventListener('change', function () {
      slider.noUiSlider.set(this.value);
    });
    slider.noUiSlider.on('change', function (values, handle) {
      if (values[handle] < 20) {
        slider.noUiSlider.set(20);
      } else if (values[handle] > 80) {
        slider.noUiSlider.set(80);
      }
    });
  };

  var demo6 = function demo6() {
    // init slider             
    var verticalSlider = document.getElementById('kt_nouislider_6');
    noUiSlider.create(verticalSlider, {
      start: 40,
      orientation: 'vertical',
      range: {
        'min': 0,
        'max': 100
      }
    }); // init slider input

    var sliderInput = document.getElementById('kt_nouislider_6_input');
    verticalSlider.noUiSlider.on('update', function (values, handle) {
      sliderInput.value = values[handle];
    });
    sliderInput.addEventListener('change', function () {
      verticalSlider.noUiSlider.set(this.value);
    });
  }; // Modal demo


  var modaldemo1 = function modaldemo1() {
    var slider = document.getElementById('kt_nouislider_modal1');
    noUiSlider.create(slider, {
      start: [0],
      step: 2,
      range: {
        'min': [0],
        'max': [10]
      },
      format: wNumb({
        decimals: 0
      })
    }); // init slider input

    var sliderInput = document.getElementById('kt_nouislider_modal1_input');
    slider.noUiSlider.on('update', function (values, handle) {
      sliderInput.value = values[handle];
    });
    sliderInput.addEventListener('change', function () {
      slider.noUiSlider.set(this.value);
    });
  };

  var modaldemo2 = function modaldemo2() {
    var slider = document.getElementById('kt_nouislider_modal2');
    noUiSlider.create(slider, {
      start: [20000],
      connect: [true, false],
      step: 1000,
      range: {
        'min': [20000],
        'max': [80000]
      },
      format: wNumb({
        decimals: 3,
        thousand: '.',
        postfix: ' (US $)'
      })
    }); // init slider input

    var sliderInput = document.getElementById('kt_nouislider_modal2_input');
    slider.noUiSlider.on('update', function (values, handle) {
      sliderInput.value = values[handle];
    });
    sliderInput.addEventListener('change', function () {
      slider.noUiSlider.set(this.value);
    });
  };

  var modaldemo3 = function modaldemo3() {
    var slider = document.getElementById('kt_nouislider_modal3');
    noUiSlider.create(slider, {
      start: [20, 80],
      connect: true,
      direction: 'rtl',
      tooltips: [true, wNumb({
        decimals: 1
      })],
      range: {
        'min': [0],
        '10%': [10, 10],
        '50%': [80, 50],
        '80%': 150,
        'max': 200
      }
    }); // init slider input

    var sliderInput0 = document.getElementById('kt_nouislider_modal1.1_input');
    var sliderInput1 = document.getElementById('kt_nouislider_modal1.2_input');
    var sliderInputs = [sliderInput1, sliderInput0];
    slider.noUiSlider.on('update', function (values, handle) {
      sliderInputs[handle].value = values[handle];
    });
  };

  return {
    // public functions
    init: function init() {
      demo1();
      demo2();
      demo3();
      demo4();
      demo5();
      demo6();
      modaldemo1();
      modaldemo2();
      modaldemo3();
    }
  };
}();

jQuery(document).ready(function () {
  KTnoUiSliderDemos.init();
});

/***/ }),

/***/ 76:
/*!****************************************************************************!*\
  !*** multi ./resources/metronic/js/pages/crud/forms/widgets/nouislider.js ***!
  \****************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\wamp64\www\keenthemes\themes\metronic\theme\html_laravel\demo1\skeleton\resources\metronic\js\pages\crud\forms\widgets\nouislider.js */"./resources/metronic/js/pages/crud/forms/widgets/nouislider.js");


/***/ })

/******/ });