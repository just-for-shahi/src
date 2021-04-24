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
/******/ 	return __webpack_require__(__webpack_require__.s = 38);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/metronic/js/pages/crud/datatables/extensions/fixedheader.js":
/*!*******************************************************************************!*\
  !*** ./resources/metronic/js/pages/crud/datatables/extensions/fixedheader.js ***!
  \*******************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var KTDatatablesExtensionsFixedheader = function () {
  var initTable1 = function initTable1() {
    var table = $('#kt_table_1'); // begin first table

    table.DataTable({
      responsive: true,
      fixedHeader: {
        header: true,
        headerOffset: $('#kt_header').height()
      },
      paging: false,
      columnDefs: [{
        targets: -1,
        title: 'Actions',
        orderable: false,
        render: function render(data, type, full, meta) {
          return "\n                        <span class=\"dropdown\">\n                            <a href=\"#\" class=\"btn btn-sm btn-clean btn-icon btn-icon-md\" data-toggle=\"dropdown\" aria-expanded=\"true\">\n                              <i class=\"la la-ellipsis-h\"></i>\n                            </a>\n                            <div class=\"dropdown-menu dropdown-menu-right\">\n                                <a class=\"dropdown-item\" href=\"#\"><i class=\"la la-edit\"></i> Edit Details</a>\n                                <a class=\"dropdown-item\" href=\"#\"><i class=\"la la-leaf\"></i> Update Status</a>\n                                <a class=\"dropdown-item\" href=\"#\"><i class=\"la la-print\"></i> Generate Report</a>\n                            </div>\n                        </span>\n                        <a href=\"#\" class=\"btn btn-sm btn-clean btn-icon btn-icon-md\" title=\"View\">\n                          <i class=\"la la-edit\"></i>\n                        </a>";
        }
      }, {
        width: '75px',
        targets: 8,
        render: function render(data, type, full, meta) {
          var status = {
            1: {
              'title': 'Pending',
              'class': 'label-primary'
            },
            2: {
              'title': 'Delivered',
              'class': ' label-danger'
            },
            3: {
              'title': 'Canceled',
              'class': ' label-primary'
            },
            4: {
              'title': 'Success',
              'class': ' label-success'
            },
            5: {
              'title': 'Info',
              'class': ' label-info'
            },
            6: {
              'title': 'Danger',
              'class': ' label-danger'
            },
            7: {
              'title': 'Warning',
              'class': ' label-warning'
            }
          };

          if (typeof status[data] === 'undefined') {
            return data;
          }

          return '<span class="label ' + status[data]["class"] + ' label-inline label-pill">' + status[data].title + '</span>';
        }
      }, {
        width: '75px',
        targets: 9,
        render: function render(data, type, full, meta) {
          var status = {
            1: {
              'title': 'Online',
              'state': 'danger'
            },
            2: {
              'title': 'Retail',
              'state': 'primary'
            },
            3: {
              'title': 'Direct',
              'state': 'success'
            }
          };

          if (typeof status[data] === 'undefined') {
            return data;
          }

          return '<span class="label label-' + status[data].state + ' label-dot"></span>&nbsp;' + '<span class="font-weight-bold text-' + status[data].state + '">' + status[data].title + '</span>';
        }
      }]
    });
  };

  return {
    //main function to initiate the module
    init: function init() {
      initTable1();
    }
  };
}();

jQuery(document).ready(function () {
  KTDatatablesExtensionsFixedheader.init();
});

/***/ }),

/***/ 38:
/*!*************************************************************************************!*\
  !*** multi ./resources/metronic/js/pages/crud/datatables/extensions/fixedheader.js ***!
  \*************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\wamp64\www\keenthemes\themes\metronic\theme\html_laravel\demo1\skeleton\resources\metronic\js\pages\crud\datatables\extensions\fixedheader.js */"./resources/metronic/js/pages/crud/datatables/extensions/fixedheader.js");


/***/ })

/******/ });