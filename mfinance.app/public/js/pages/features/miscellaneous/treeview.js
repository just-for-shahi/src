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
/******/ 	return __webpack_require__(__webpack_require__.s = 155);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/metronic/js/pages/features/miscellaneous/treeview.js":
/*!************************************************************************!*\
  !*** ./resources/metronic/js/pages/features/miscellaneous/treeview.js ***!
  \************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var KTTreeview = function () {
  var _demo1 = function _demo1() {
    $('#kt_tree_1').jstree({
      "core": {
        "themes": {
          "responsive": false
        }
      },
      "types": {
        "default": {
          "icon": "fa fa-folder"
        },
        "file": {
          "icon": "fa fa-file"
        }
      },
      "plugins": ["types"]
    });
  };

  var _demo2 = function _demo2() {
    $('#kt_tree_2').jstree({
      "core": {
        "themes": {
          "responsive": false
        }
      },
      "types": {
        "default": {
          "icon": "fa fa-folder text-warning"
        },
        "file": {
          "icon": "fa fa-file  text-warning"
        }
      },
      "plugins": ["types"]
    }); // handle link clicks in tree nodes(support target="_blank" as well)

    $('#kt_tree_2').on('select_node.jstree', function (e, data) {
      var link = $('#' + data.selected).find('a');

      if (link.attr("href") != "#" && link.attr("href") != "javascript:;" && link.attr("href") != "") {
        if (link.attr("target") == "_blank") {
          link.attr("href").target = "_blank";
        }

        document.location.href = link.attr("href");
        return false;
      }
    });
  };

  var _demo3 = function _demo3() {
    $('#kt_tree_3').jstree({
      'plugins': ["wholerow", "checkbox", "types"],
      'core': {
        "themes": {
          "responsive": false
        },
        'data': [{
          "text": "Same but with checkboxes",
          "children": [{
            "text": "initially selected",
            "state": {
              "selected": true
            }
          }, {
            "text": "custom icon",
            "icon": "fa fa-warning text-danger"
          }, {
            "text": "initially open",
            "icon": "fa fa-folder text-default",
            "state": {
              "opened": true
            },
            "children": ["Another node"]
          }, {
            "text": "custom icon",
            "icon": "fa fa-warning text-waring"
          }, {
            "text": "disabled node",
            "icon": "fa fa-check text-success",
            "state": {
              "disabled": true
            }
          }]
        }, "And wholerow selection"]
      },
      "types": {
        "default": {
          "icon": "fa fa-folder text-warning"
        },
        "file": {
          "icon": "fa fa-file  text-warning"
        }
      }
    });
  };

  var _demo4 = function _demo4() {
    $("#kt_tree_4").jstree({
      "core": {
        "themes": {
          "responsive": false
        },
        // so that create works
        "check_callback": true,
        'data': [{
          "text": "Parent Node",
          "children": [{
            "text": "Initially selected",
            "state": {
              "selected": true
            }
          }, {
            "text": "Custom Icon",
            "icon": "flaticon2-hourglass-1 text-danger"
          }, {
            "text": "Initially open",
            "icon": "fa fa-folder text-success",
            "state": {
              "opened": true
            },
            "children": [{
              "text": "Another node",
              "icon": "fa fa-file text-waring"
            }]
          }, {
            "text": "Another Custom Icon",
            "icon": "flaticon2-drop text-waring"
          }, {
            "text": "Disabled Node",
            "icon": "fa fa-check text-success",
            "state": {
              "disabled": true
            }
          }, {
            "text": "Sub Nodes",
            "icon": "fa fa-folder text-danger",
            "children": [{
              "text": "Item 1",
              "icon": "fa fa-file text-waring"
            }, {
              "text": "Item 2",
              "icon": "fa fa-file text-success"
            }, {
              "text": "Item 3",
              "icon": "fa fa-file text-default"
            }, {
              "text": "Item 4",
              "icon": "fa fa-file text-danger"
            }, {
              "text": "Item 5",
              "icon": "fa fa-file text-info"
            }]
          }]
        }, "Another Node"]
      },
      "types": {
        "default": {
          "icon": "fa fa-folder text-primary"
        },
        "file": {
          "icon": "fa fa-file  text-primary"
        }
      },
      "state": {
        "key": "demo2"
      },
      "plugins": ["contextmenu", "state", "types"]
    });
  };

  var _demo5 = function _demo5() {
    $("#kt_tree_5").jstree({
      "core": {
        "themes": {
          "responsive": false
        },
        // so that create works
        "check_callback": true,
        'data': [{
          "text": "Parent Node",
          "children": [{
            "text": "Initially selected",
            "state": {
              "selected": true
            }
          }, {
            "text": "Custom Icon",
            "icon": "flaticon2-warning text-danger"
          }, {
            "text": "Initially open",
            "icon": "fa fa-folder text-success",
            "state": {
              "opened": true
            },
            "children": [{
              "text": "Another node",
              "icon": "fa fa-file text-waring"
            }]
          }, {
            "text": "Another Custom Icon",
            "icon": "flaticon2-bell-5 text-waring"
          }, {
            "text": "Disabled Node",
            "icon": "fa fa-check text-success",
            "state": {
              "disabled": true
            }
          }, {
            "text": "Sub Nodes",
            "icon": "fa fa-folder text-danger",
            "children": [{
              "text": "Item 1",
              "icon": "fa fa-file text-waring"
            }, {
              "text": "Item 2",
              "icon": "fa fa-file text-success"
            }, {
              "text": "Item 3",
              "icon": "fa fa-file text-default"
            }, {
              "text": "Item 4",
              "icon": "fa fa-file text-danger"
            }, {
              "text": "Item 5",
              "icon": "fa fa-file text-info"
            }]
          }]
        }, "Another Node"]
      },
      "types": {
        "default": {
          "icon": "fa fa-folder text-success"
        },
        "file": {
          "icon": "fa fa-file  text-success"
        }
      },
      "state": {
        "key": "demo2"
      },
      "plugins": ["dnd", "state", "types"]
    });
  };

  var _demo6 = function _demo6() {
    $("#kt_tree_6").jstree({
      "core": {
        "themes": {
          "responsive": false
        },
        // so that create works
        "check_callback": true,
        'data': {
          'url': function url(node) {
            return HOST_URL + '/api//jstree/ajax_data.php';
          },
          'data': function data(node) {
            return {
              'parent': node.id
            };
          }
        }
      },
      "types": {
        "default": {
          "icon": "fa fa-folder text-primary"
        },
        "file": {
          "icon": "fa fa-file  text-primary"
        }
      },
      "state": {
        "key": "demo3"
      },
      "plugins": ["dnd", "state", "types"]
    });
  };

  return {
    //main function to initiate the module
    init: function init() {
      _demo1();

      _demo2();

      _demo3();

      _demo4();

      _demo5();

      _demo6();
    }
  };
}();

jQuery(document).ready(function () {
  KTTreeview.init();
});

/***/ }),

/***/ 155:
/*!******************************************************************************!*\
  !*** multi ./resources/metronic/js/pages/features/miscellaneous/treeview.js ***!
  \******************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\wamp64\www\keenthemes\themes\metronic\theme\html_laravel\demo1\skeleton\resources\metronic\js\pages\features\miscellaneous\treeview.js */"./resources/metronic/js/pages/features/miscellaneous/treeview.js");


/***/ })

/******/ });