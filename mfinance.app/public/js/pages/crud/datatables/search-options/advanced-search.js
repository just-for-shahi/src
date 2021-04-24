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
/******/ 	return __webpack_require__(__webpack_require__.s = 45);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/metronic/js/pages/crud/datatables/search-options/advanced-search.js":
/*!***************************************************************************************!*\
  !*** ./resources/metronic/js/pages/crud/datatables/search-options/advanced-search.js ***!
  \***************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var KTDatatablesSearchOptionsAdvancedSearch = function () {
  $.fn.dataTable.Api.register('column().title()', function () {
    return $(this.header()).text().trim();
  });

  var initTable1 = function initTable1() {
    // begin first table
    var table = $('#kt_datatable').DataTable({
      responsive: true,
      // Pagination settings
      dom: "<'row'<'col-sm-12'tr>>\n\t\t\t<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>",
      // read more: https://datatables.net/examples/basic_init/dom.html
      lengthMenu: [5, 10, 25, 50],
      pageLength: 10,
      language: {
        'lengthMenu': 'Display _MENU_'
      },
      searchDelay: 500,
      processing: true,
      serverSide: true,
      ajax: {
        url: HOST_URL + '/api//datatables/demos/server.php',
        type: 'POST',
        data: {
          // parameters for custom backend script demo
          columnsDef: ['RecordID', 'OrderID', 'Country', 'ShipCity', 'CompanyAgent', 'ShipDate', 'Status', 'Type', 'Actions']
        }
      },
      columns: [{
        data: 'RecordID'
      }, {
        data: 'OrderID'
      }, {
        data: 'Country'
      }, {
        data: 'ShipCity'
      }, {
        data: 'CompanyAgent'
      }, {
        data: 'ShipDate'
      }, {
        data: 'Status'
      }, {
        data: 'Type'
      }, {
        data: 'Actions',
        responsivePriority: -1
      }],
      initComplete: function initComplete() {
        this.api().columns().every(function () {
          var column = this;

          switch (column.title()) {
            case 'Country':
              column.data().unique().sort().each(function (d, j) {
                $('.datatable-input[data-col-index="2"]').append('<option value="' + d + '">' + d + '</option>');
              });
              break;

            case 'Status':
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
              column.data().unique().sort().each(function (d, j) {
                $('.datatable-input[data-col-index="6"]').append('<option value="' + d + '">' + status[d].title + '</option>');
              });
              break;

            case 'Type':
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
              column.data().unique().sort().each(function (d, j) {
                $('.datatable-input[data-col-index="7"]').append('<option value="' + d + '">' + status[d].title + '</option>');
              });
              break;
          }
        });
      },
      columnDefs: [{
        targets: -1,
        title: 'Actions',
        orderable: false,
        render: function render(data, type, full, meta) {
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
      }, {
        targets: 6,
        render: function render(data, type, full, meta) {
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

          if (typeof status[data] === 'undefined') {
            return data;
          }

          return '<span class="label label-lg font-weight-bold' + status[data]["class"] + ' label-inline">' + status[data].title + '</span>';
        }
      }, {
        targets: 7,
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

          return '<span class="label label-' + status[data].state + ' label-dot mr-2"></span>' + '<span class="font-weight-bold text-' + status[data].state + '">' + status[data].title + '</span>';
        }
      }]
    });

    var filter = function filter() {
      var val = $.fn.dataTable.util.escapeRegex($(this).val());
      table.column($(this).data('col-index')).search(val ? val : '', false, false).draw();
    };

    var asdasd = function asdasd(value, index) {
      var val = $.fn.dataTable.util.escapeRegex(value);
      table.column(index).search(val ? val : '', false, true);
    };

    $('#kt_search').on('click', function (e) {
      e.preventDefault();
      var params = {};
      $('.datatable-input').each(function () {
        var i = $(this).data('col-index');

        if (params[i]) {
          params[i] += '|' + $(this).val();
        } else {
          params[i] = $(this).val();
        }
      });
      $.each(params, function (i, val) {
        // apply search params to datatable
        table.column(i).search(val ? val : '', false, false);
      });
      table.table().draw();
    });
    $('#kt_reset').on('click', function (e) {
      e.preventDefault();
      $('.datatable-input').each(function () {
        $(this).val('');
        table.column($(this).data('col-index')).search('', false, false);
      });
      table.table().draw();
    });
    $('#kt_datepicker').datepicker({
      todayHighlight: true,
      templates: {
        leftArrow: '<i class="la la-angle-left"></i>',
        rightArrow: '<i class="la la-angle-right"></i>'
      }
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
  KTDatatablesSearchOptionsAdvancedSearch.init();
});

/***/ }),

/***/ 45:
/*!*********************************************************************************************!*\
  !*** multi ./resources/metronic/js/pages/crud/datatables/search-options/advanced-search.js ***!
  \*********************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\wamp64\www\keenthemes\themes\metronic\theme\html_laravel\demo1\skeleton\resources\metronic\js\pages\crud\datatables\search-options\advanced-search.js */"./resources/metronic/js/pages/crud/datatables/search-options/advanced-search.js");


/***/ })

/******/ });