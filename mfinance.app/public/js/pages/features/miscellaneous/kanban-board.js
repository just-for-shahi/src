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
/******/ 	return __webpack_require__(__webpack_require__.s = 149);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/metronic/js/pages/features/miscellaneous/kanban-board.js":
/*!****************************************************************************!*\
  !*** ./resources/metronic/js/pages/features/miscellaneous/kanban-board.js ***!
  \****************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
 // Class definition

var KTKanbanBoardDemo = function () {
  // Private functions
  var _demo1 = function _demo1() {
    var kanban = new jKanban({
      element: '#kt_kanban_1',
      gutter: '0',
      widthBoard: '250px',
      boards: [{
        'id': '_inprocess',
        'title': 'In Process',
        'item': [{
          'title': '<span class="font-weight-bold">You can drag me too</span>'
        }, {
          'title': '<span class="font-weight-bold">Buy Milk</span>'
        }]
      }, {
        'id': '_working',
        'title': 'Working',
        'item': [{
          'title': '<span class="font-weight-bold">Do Something!</span>'
        }, {
          'title': '<span class="font-weight-bold">Run?</span>'
        }]
      }, {
        'id': '_done',
        'title': 'Done',
        'item': [{
          'title': '<span class="font-weight-bold">All right</span>'
        }, {
          'title': '<span class="font-weight-bold">Ok!</span>'
        }]
      }]
    });
  };

  var _demo2 = function _demo2() {
    var kanban = new jKanban({
      element: '#kt_kanban_2',
      gutter: '0',
      widthBoard: '250px',
      boards: [{
        'id': '_inprocess',
        'title': 'In Process',
        'class': 'primary',
        'item': [{
          'title': '<span class="font-weight-bold">You can drag me too</span>',
          'class': 'light-primary'
        }, {
          'title': '<span class="font-weight-bold">Buy Milk</span>',
          'class': 'light-primary'
        }]
      }, {
        'id': '_working',
        'title': 'Working',
        'class': 'success',
        'item': [{
          'title': '<span class="font-weight-bold">Do Something!</span>',
          'class': 'light-success'
        }, {
          'title': '<span class="font-weight-bold">Run?</span>',
          'class': 'light-success'
        }]
      }, {
        'id': '_done',
        'title': 'Done',
        'class': 'danger',
        'item': [{
          'title': '<span class="font-weight-bold">All right</span>',
          'class': 'light-danger'
        }, {
          'title': '<span class="font-weight-bold">Ok!</span>',
          'class': 'light-danger'
        }]
      }]
    });
  };

  var _demo3 = function _demo3() {
    var kanban = new jKanban({
      element: '#kt_kanban_3',
      gutter: '0',
      widthBoard: '250px',
      click: function click(el) {
        alert(el.innerHTML);
      },
      boards: [{
        'id': '_todo',
        'title': 'To Do',
        'class': 'light-primary',
        'dragTo': ['_working'],
        'item': [{
          'title': 'My Task Test',
          'class': 'primary'
        }, {
          'title': 'Buy Milk',
          'class': 'primary'
        }]
      }, {
        'id': '_working',
        'title': 'Working',
        'class': 'light-warning',
        'item': [{
          'title': 'Do Something!',
          'class': 'warning'
        }, {
          'title': 'Run?',
          'class': 'warning'
        }]
      }, {
        'id': '_done',
        'title': 'Done',
        'class': 'light-success',
        'dragTo': ['_working'],
        'item': [{
          'title': 'All right',
          'class': 'success'
        }, {
          'title': 'Ok!',
          'class': 'success'
        }]
      }, {
        'id': '_notes',
        'title': 'Notes',
        'class': 'light-danger',
        'item': [{
          'title': 'Warning Task',
          'class': 'danger'
        }, {
          'title': 'Do not enter',
          'class': 'danger'
        }]
      }]
    });
  };

  var _demo4 = function _demo4() {
    var kanban = new jKanban({
      element: '#kt_kanban_4',
      gutter: '0',
      click: function click(el) {
        alert(el.innerHTML);
      },
      boards: [{
        'id': '_backlog',
        'title': 'Backlog',
        'class': 'light-dark',
        'item': [{
          'title': "\n                                <div class=\"d-flex align-items-center\">\n                        \t        <div class=\"symbol symbol-success mr-3\">\n                        \t            <img alt=\"Pic\" src=\"assets/media/users/300_24.jpg\" />\n                        \t        </div>\n                        \t        <div class=\"d-flex flex-column align-items-start\">\n                        \t            <span class=\"text-dark-50 font-weight-bold mb-1\">SEO Optimization</span>\n                        \t            <span class=\"label label-inline label-light-success font-weight-bold\">In progress</span>\n                        \t        </div>\n                        \t    </div>\n                            "
        }, {
          'title': "\n                                <div class=\"d-flex align-items-center\">\n                        \t        <div class=\"symbol symbol-success mr-3\">\n                        \t            <span class=\"symbol-label font-size-h4\">A.D</span>\n                        \t        </div>\n                        \t        <div class=\"d-flex flex-column align-items-start\">\n                        \t            <span class=\"text-dark-50 font-weight-bold mb-1\">Finance</span>\n                        \t            <span class=\"label label-inline label-light-danger font-weight-bold\">Pending</span>\n                        \t        </div>\n                        \t    </div>\n                            "
        }]
      }, {
        'id': '_todo',
        'title': 'To Do',
        'class': 'light-danger',
        'item': [{
          'title': "\n                                <div class=\"d-flex align-items-center\">\n                        \t        <div class=\"symbol symbol-success mr-3\">\n                        \t            <img alt=\"Pic\" src=\"assets/media/users/300_16.jpg\" />\n                        \t        </div>\n                        \t        <div class=\"d-flex flex-column align-items-start\">\n                        \t            <span class=\"text-dark-50 font-weight-bold mb-1\">Server Setup</span>\n                        \t            <span class=\"label label-inline label-light-dark font-weight-bold\">Completed</span>\n                        \t        </div>\n                        \t    </div>\n                            "
        }, {
          'title': "\n                                <div class=\"d-flex align-items-center\">\n                        \t        <div class=\"symbol symbol-success mr-3\">\n                        \t            <img alt=\"Pic\" src=\"assets/media/users/300_15.jpg\" />\n                        \t        </div>\n                        \t        <div class=\"d-flex flex-column align-items-start\">\n                        \t            <span class=\"text-dark-50 font-weight-bold mb-1\">Report Generation</span>\n                        \t            <span class=\"label label-inline label-light-warning font-weight-bold\">Due</span>\n                        \t        </div>\n                        \t    </div>\n                            "
        }]
      }, {
        'id': '_working',
        'title': 'Working',
        'class': 'light-primary',
        'item': [{
          'title': "\n                                <div class=\"d-flex align-items-center\">\n                        \t        <div class=\"symbol symbol-success mr-3\">\n                            \t         <img alt=\"Pic\" src=\"assets/media/users/300_24.jpg\" />\n                        \t        </div>\n                        \t        <div class=\"d-flex flex-column align-items-start\">\n                        \t            <span class=\"text-dark-50 font-weight-bold mb-1\">Marketing</span>\n                        \t            <span class=\"label label-inline label-light-danger font-weight-bold\">Planning</span>\n                        \t        </div>\n                        \t    </div>\n                            "
        }, {
          'title': "\n                                <div class=\"d-flex align-items-center\">\n                        \t        <div class=\"symbol symbol-light-info mr-3\">\n                        \t            <span class=\"symbol-label font-size-h4\">A.P</span>\n                        \t        </div>\n                        \t        <div class=\"d-flex flex-column align-items-start\">\n                        \t            <span class=\"text-dark-50 font-weight-bold mb-1\">Finance</span>\n                        \t            <span class=\"label label-inline label-light-primary font-weight-bold\">Done</span>\n                        \t        </div>\n                        \t    </div>\n                            "
        }]
      }, {
        'id': '_done',
        'title': 'Done',
        'class': 'light-success',
        'item': [{
          'title': "\n                                <div class=\"d-flex align-items-center\">\n                        \t        <div class=\"symbol symbol-success mr-3\">\n                        \t            <img alt=\"Pic\" src=\"assets/media/users/300_11.jpg\" />\n                        \t        </div>\n                        \t        <div class=\"d-flex flex-column align-items-start\">\n                        \t            <span class=\"text-dark-50 font-weight-bold mb-1\">SEO Optimization</span>\n                        \t            <span class=\"label label-inline label-light-success font-weight-bold\">In progress</span>\n                        \t        </div>\n                        \t    </div>\n                            "
        }, {
          'title': "\n                                <div class=\"d-flex align-items-center\">\n                        \t        <div class=\"symbol symbol-success mr-3\">\n                        \t            <img alt=\"Pic\" src=\"assets/media/users/300_20.jpg\" />\n                        \t        </div>\n                        \t        <div class=\"d-flex flex-column align-items-start\">\n                        \t            <span class=\"text-dark-50 font-weight-bold mb-1\">Product Team</span>\n                        \t            <span class=\"label label-inline label-light-danger font-weight-bold\">In progress</span>\n                        \t        </div>\n                        \t    </div>\n                            "
        }]
      }, {
        'id': '_deploy',
        'title': 'Deploy',
        'class': 'light-primary',
        'item': [{
          'title': "\n                                <div class=\"d-flex align-items-center\">\n                        \t        <div class=\"symbol symbol-light-warning mr-3\">\n                        \t            <span class=\"symbol-label font-size-h4\">D.L</span>\n                        \t        </div>\n                        \t        <div class=\"d-flex flex-column align-items-start\">\n                        \t            <span class=\"text-dark-50 font-weight-bold mb-1\">SEO Optimization</span>\n                        \t            <span class=\"label label-inline label-light-success font-weight-bold\">In progress</span>\n                        \t        </div>\n                        \t    </div>\n                            "
        }, {
          'title': "\n                                <div class=\"d-flex align-items-center\">\n                        \t        <div class=\"symbol symbol-light-danger mr-3\">\n                        \t            <span class=\"symbol-label font-size-h4\">E.K</span>\n                        \t        </div>\n                        \t        <div class=\"d-flex flex-column align-items-start\">\n                        \t            <span class=\"text-dark-50 font-weight-bold mb-1\">Requirement Study</span>\n                        \t            <span class=\"label label-inline label-light-warning font-weight-bold\">Scheduled</span>\n                        \t        </div>\n                        \t    </div>\n                            "
        }]
      }]
    });
    var toDoButton = document.getElementById('addToDo');
    toDoButton.addEventListener('click', function () {
      kanban.addElement('_todo', {
        'title': "\n                        <div class=\"d-flex align-items-center\">\n                            <div class=\"symbol symbol-light-primary mr-3\">\n                                <img alt=\"Pic\" src=\"assets/media/users/300_14.jpg\" />\n                            </div>\n                            <div class=\"d-flex flex-column align-items-start\">\n                                <span class=\"text-dark-50 font-weight-bold mb-1\">Requirement Study</span>\n                                <span class=\"label label-inline label-light-success font-weight-bold\">Scheduled</span>\n                            </div>\n                        </div>\n                    "
      });
    });
    var addBoardDefault = document.getElementById('addDefault');
    addBoardDefault.addEventListener('click', function () {
      kanban.addBoards([{
        'id': '_default',
        'title': 'New Board',
        'class': 'primary-light',
        'item': [{
          'title': "\n                                <div class=\"d-flex align-items-center\">\n                                    <div class=\"symbol symbol-success mr-3\">\n                                        <img alt=\"Pic\" src=\"assets/media/users/300_13.jpg\" />\n                                    </div>\n                                    <div class=\"d-flex flex-column align-items-start\">\n                                        <span class=\"text-dark-50 font-weight-bold mb-1\">Payment Modules</span>\n                                        <span class=\"label label-inline label-light-primary font-weight-bold\">In development</span>\n                                    </div>\n                                </div>\n                        "
        }, {
          'title': "\n                                <div class=\"d-flex align-items-center\">\n                                    <div class=\"symbol symbol-success mr-3\">\n                                        <img alt=\"Pic\" src=\"assets/media/users/300_12.jpg\" />\n                                    </div>\n                                    <div class=\"d-flex flex-column align-items-start\">\n                                    <span class=\"text-dark-50 font-weight-bold mb-1\">New Project</span>\n                                    <span class=\"label label-inline label-light-danger font-weight-bold\">Pending</span>\n                                </div>\n                            </div>\n                        "
        }]
      }]);
    });
    var removeBoard = document.getElementById('removeBoard');
    removeBoard.addEventListener('click', function () {
      kanban.removeBoard('_done');
    });
  }; // Public functions


  return {
    init: function init() {
      _demo1();

      _demo2();

      _demo3();

      _demo4();
    }
  };
}();

jQuery(document).ready(function () {
  KTKanbanBoardDemo.init();
});

/***/ }),

/***/ 149:
/*!**********************************************************************************!*\
  !*** multi ./resources/metronic/js/pages/features/miscellaneous/kanban-board.js ***!
  \**********************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\wamp64\www\keenthemes\themes\metronic\theme\html_laravel\demo1\skeleton\resources\metronic\js\pages\features\miscellaneous\kanban-board.js */"./resources/metronic/js/pages/features/miscellaneous/kanban-board.js");


/***/ })

/******/ });