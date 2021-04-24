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
/******/ 	return __webpack_require__(__webpack_require__.s = 88);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/metronic/js/pages/crud/ktdatatable/api/methods.js":
/*!*********************************************************************!*\
  !*** ./resources/metronic/js/pages/crud/ktdatatable/api/methods.js ***!
  \*********************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
 // Class definition

var KTDefaultDatatableDemo = function () {
  // Private functions
  // basic demo
  var demo = function demo() {
    var options = {
      // datasource definition
      data: {
        type: 'remote',
        source: {
          read: {
            url: HOST_URL + '/api/datatables/demos/default.php'
          }
        },
        pageSize: 20,
        // display 20 records per page
        serverPaging: true,
        serverFiltering: true,
        serverSorting: true
      },
      // layout definition
      layout: {
        scroll: true,
        // enable/disable datatable scroll both horizontal and vertical when needed.
        height: 550,
        // datatable's body's fixed height
        footer: false // display/hide footer

      },
      // column sorting
      sortable: true,
      pagination: true,
      search: {
        input: $('#kt_datatable_search_query'),
        key: 'generalSearch'
      },
      // columns definition
      columns: [{
        field: 'RecordID',
        title: '#',
        sortable: false,
        width: 30,
        type: 'number',
        selector: {
          "class": 'kt-checkbox--solid'
        },
        textAlign: 'center'
      }, {
        field: 'ID',
        title: 'ID',
        width: 30,
        type: 'number',
        template: function template(row) {
          return row.RecordID;
        }
      }, {
        field: 'OrderID',
        title: 'Order ID'
      }, {
        field: 'Country',
        title: 'Country',
        template: function template(row) {
          return row.Country + ' ' + row.ShipCountry;
        }
      }, {
        field: 'ShipDate',
        title: 'Ship Date',
        type: 'date',
        format: 'MM/DD/YYYY'
      }, {
        field: 'CompanyName',
        title: 'Company Name'
      }, {
        field: 'Status',
        title: 'Status',
        // callback function support for column rendering
        template: function template(row) {
          var status = {
            1: {
              'title': 'Pending',
              'class': 'label-light-primary'
            },
            2: {
              'title': 'Delivered',
              'class': ' label-light-danger'
            },
            3: {
              'title': 'Canceled',
              'class': ' label-light-primary'
            },
            4: {
              'title': 'Success',
              'class': ' label-light-success'
            },
            5: {
              'title': 'Info',
              'class': ' label-light-info'
            },
            6: {
              'title': 'Danger',
              'class': ' label-light-danger'
            },
            7: {
              'title': 'Warning',
              'class': ' label-light-warning'
            }
          };
          return '<span class="label ' + status[row.Status]["class"] + ' label-inline font-weight-bold label-lg">' + status[row.Status].title + '</span>';
        }
      }, {
        field: 'Type',
        title: 'Type',
        autoHide: false,
        // callback function support for column rendering
        template: function template(row) {
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
          return '<span class="label label-' + status[row.Type].state + ' label-dot mr-2"></span><span class="font-weight-bold text-' + status[row.Type].state + '">' + status[row.Type].title + '</span>';
        }
      }, {
        field: 'Actions',
        title: 'Actions',
        sortable: false,
        width: 125,
        overflow: 'visible',
        autoHide: false,
        template: function template() {
          return '\
							<div class="dropdown dropdown-inline">\
								<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" data-toggle="dropdown">\
	                                <i class="la la-cog"></i>\
	                            </a>\
							  	<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">\
									<ul class="nav nav-hoverable flex-column">\
							    		<li class="nav-item"><a class="nav-link" href="#"><i class="nav-icon la la-edit"></i><span class="nav-text">Edit Details</span></a></li>\
							    		<li class="nav-item"><a class="nav-link" href="#"><i class="nav-icon la la-leaf"></i><span class="nav-text">Update Status</span></a></li>\
							    		<li class="nav-item"><a class="nav-link" href="#"><i class="nav-icon la la-print"></i><span class="nav-text">Print</span></a></li>\
									</ul>\
							  	</div>\
							</div>\
							<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Edit details">\
								<i class="la la-edit"></i>\
							</a>\
							<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete">\
								<i class="la la-trash"></i>\
							</a>\
						';
        }
      }]
    };
    var datatable = $('#kt_datatable').KTDatatable(options); // both methods are supported
    // datatable.methodName(args); or $(datatable).KTDatatable(methodName, args);

    $('#kt_datatable_destroy').on('click', function () {
      // datatable.destroy();
      $('#kt_datatable').KTDatatable('destroy');
    });
    $('#kt_datatable_init').on('click', function () {
      datatable = $('#kt_datatable').KTDatatable(options);
    });
    $('#kt_datatable_reload').on('click', function () {
      // datatable.reload();
      $('#kt_datatable').KTDatatable('reload');
    });
    $('#kt_datatable_sort_asc').on('click', function () {
      datatable.sort('Status', 'asc');
    });
    $('#kt_datatable_sort_desc').on('click', function () {
      datatable.sort('Status', 'desc');
    }); // get checked record and get value by column name

    $('#kt_datatable_get').on('click', function () {
      // select active rows
      datatable.rows('.datatable-row-active'); // check selected nodes

      if (datatable.nodes().length > 0) {
        // get column by field name and get the column nodes
        var value = datatable.columns('CompanyName').nodes().text();
        console.log(value);
      }
    }); // record selection

    $('#kt_datatable_check').on('click', function () {
      var input = $('#kt_datatable_check_input').val();
      datatable.setActive(input);
    });
    $('#kt_datatable_check_all').on('click', function () {
      // datatable.setActiveAll(true);
      $('#kt_datatable').KTDatatable('setActiveAll', true);
    });
    $('#kt_datatable_uncheck_all').on('click', function () {
      // datatable.setActiveAll(false);
      $('#kt_datatable').KTDatatable('setActiveAll', false);
    });
    $('#kt_datatable_hide_column').on('click', function () {
      datatable.columns('ShipDate').visible(false);
    });
    $('#kt_datatable_show_column').on('click', function () {
      datatable.columns('ShipDate').visible(true);
    });
    $('#kt_datatable_remove_row').on('click', function () {
      datatable.rows('.datatable-row-active').remove();
    });
    $('#kt_datatable_search_status').on('change', function () {
      datatable.search($(this).val().toLowerCase(), 'Status');
    });
    $('#kt_datatable_search_type').on('change', function () {
      datatable.search($(this).val().toLowerCase(), 'Type');
    });
    $('#kt_datatable_search_status, #kt_datatable_search_type').selectpicker();
  };

  return {
    // public functions
    init: function init() {
      demo();
    }
  };
}();

jQuery(document).ready(function () {
  KTDefaultDatatableDemo.init();
});

/***/ }),

/***/ 88:
/*!***************************************************************************!*\
  !*** multi ./resources/metronic/js/pages/crud/ktdatatable/api/methods.js ***!
  \***************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\wamp64\www\keenthemes\themes\metronic\theme\html_laravel\demo1\skeleton\resources\metronic\js\pages\crud\ktdatatable\api\methods.js */"./resources/metronic/js/pages/crud/ktdatatable/api/methods.js");


/***/ })

/******/ });