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
/******/ 	return __webpack_require__(__webpack_require__.s = 138);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/metronic/js/pages/features/charts/google-charts.js":
/*!**********************************************************************!*\
  !*** ./resources/metronic/js/pages/features/charts/google-charts.js ***!
  \**********************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
 // Class definition

var KTGoogleChartsDemo = function () {
  // Private functions
  var main = function main() {
    // GOOGLE CHARTS INIT
    google.load('visualization', '1', {
      packages: ['corechart', 'bar', 'line']
    });
    google.setOnLoadCallback(function () {
      KTGoogleChartsDemo.runDemos();
    });
  };

  var demoColumnCharts = function demoColumnCharts() {
    // COLUMN CHART
    var data = new google.visualization.DataTable();
    data.addColumn('timeofday', 'Time of Day');
    data.addColumn('number', 'Motivation Level');
    data.addColumn('number', 'Energy Level');
    data.addRows([[{
      v: [8, 0, 0],
      f: '8 am'
    }, 1, .25], [{
      v: [9, 0, 0],
      f: '9 am'
    }, 2, .5], [{
      v: [10, 0, 0],
      f: '10 am'
    }, 3, 1], [{
      v: [11, 0, 0],
      f: '11 am'
    }, 4, 2.25], [{
      v: [12, 0, 0],
      f: '12 pm'
    }, 5, 2.25], [{
      v: [13, 0, 0],
      f: '1 pm'
    }, 6, 3], [{
      v: [14, 0, 0],
      f: '2 pm'
    }, 7, 4], [{
      v: [15, 0, 0],
      f: '3 pm'
    }, 8, 5.25], [{
      v: [16, 0, 0],
      f: '4 pm'
    }, 9, 7.5], [{
      v: [17, 0, 0],
      f: '5 pm'
    }, 10, 10]]);
    var options = {
      title: 'Motivation and Energy Level Throughout the Day',
      focusTarget: 'category',
      hAxis: {
        title: 'Time of Day',
        format: 'h:mm a',
        viewWindow: {
          min: [7, 30, 0],
          max: [17, 30, 0]
        }
      },
      vAxis: {
        title: 'Rating (scale of 1-10)'
      },
      colors: ['#6e4ff5', '#fe3995']
    };
    var chart = new google.visualization.ColumnChart(document.getElementById('kt_gchart_1'));
    chart.draw(data, options);
    var chart = new google.visualization.ColumnChart(document.getElementById('kt_gchart_2'));
    chart.draw(data, options);
  };

  var demoPieCharts = function demoPieCharts() {
    var data = google.visualization.arrayToDataTable([['Task', 'Hours per Day'], ['Work', 11], ['Eat', 2], ['Commute', 2], ['Watch TV', 2], ['Sleep', 7]]);
    var options = {
      title: 'My Daily Activities',
      colors: ['#fe3995', '#f6aa33', '#6e4ff5', '#2abe81', '#c7d2e7', '#593ae1']
    };
    var chart = new google.visualization.PieChart(document.getElementById('kt_gchart_3'));
    chart.draw(data, options);
    var options = {
      pieHole: 0.4,
      colors: ['#fe3995', '#f6aa33', '#6e4ff5', '#2abe81', '#c7d2e7', '#593ae1']
    };
    var chart = new google.visualization.PieChart(document.getElementById('kt_gchart_4'));
    chart.draw(data, options);
  };

  var demoLineCharts = function demoLineCharts() {
    // LINE CHART
    var data = new google.visualization.DataTable();
    data.addColumn('number', 'Day');
    data.addColumn('number', 'Guardians of the Galaxy');
    data.addColumn('number', 'The Avengers');
    data.addColumn('number', 'Transformers: Age of Extinction');
    data.addRows([[1, 37.8, 80.8, 41.8], [2, 30.9, 69.5, 32.4], [3, 25.4, 57, 25.7], [4, 11.7, 18.8, 10.5], [5, 11.9, 17.6, 10.4], [6, 8.8, 13.6, 7.7], [7, 7.6, 12.3, 9.6], [8, 12.3, 29.2, 10.6], [9, 16.9, 42.9, 14.8], [10, 12.8, 30.9, 11.6], [11, 5.3, 7.9, 4.7], [12, 6.6, 8.4, 5.2], [13, 4.8, 6.3, 3.6], [14, 4.2, 6.2, 3.4]]);
    var options = {
      chart: {
        title: 'Box Office Earnings in First Two Weeks of Opening',
        subtitle: 'in millions of dollars (USD)'
      },
      colors: ['#6e4ff5', '#f6aa33', '#fe3995']
    };
    var chart = new google.charts.Line(document.getElementById('kt_gchart_5'));
    chart.draw(data, options);
  };

  return {
    // public functions
    init: function init() {
      main();
    },
    runDemos: function runDemos() {
      demoColumnCharts();
      demoLineCharts();
      demoPieCharts();
    }
  };
}();

KTGoogleChartsDemo.init();

/***/ }),

/***/ 138:
/*!****************************************************************************!*\
  !*** multi ./resources/metronic/js/pages/features/charts/google-charts.js ***!
  \****************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\wamp64\www\keenthemes\themes\metronic\theme\html_laravel\demo1\skeleton\resources\metronic\js\pages\features\charts\google-charts.js */"./resources/metronic/js/pages/features/charts/google-charts.js");


/***/ })

/******/ });