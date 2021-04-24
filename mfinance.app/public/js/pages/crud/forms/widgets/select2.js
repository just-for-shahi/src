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
/******/ 	return __webpack_require__(__webpack_require__.s = 77);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/metronic/js/pages/crud/forms/widgets/select2.js":
/*!*******************************************************************!*\
  !*** ./resources/metronic/js/pages/crud/forms/widgets/select2.js ***!
  \*******************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// Class definition
var KTSelect2 = function () {
  // Private functions
  var demos = function demos() {
    // basic
    $('#kt_select2_1, #kt_select2_1_validate').select2({
      placeholder: 'Select a state'
    }); // nested

    $('#kt_select2_2, #kt_select2_2_validate').select2({
      placeholder: 'Select a state'
    }); // multi select

    $('#kt_select2_3, #kt_select2_3_validate').select2({
      placeholder: 'Select a state'
    }); // basic

    $('#kt_select2_4').select2({
      placeholder: "Select a state",
      allowClear: true
    }); // loading data from array

    var data = [{
      id: 0,
      text: 'Enhancement'
    }, {
      id: 1,
      text: 'Bug'
    }, {
      id: 2,
      text: 'Duplicate'
    }, {
      id: 3,
      text: 'Invalid'
    }, {
      id: 4,
      text: 'Wontfix'
    }];
    $('#kt_select2_5').select2({
      placeholder: "Select a value",
      data: data
    }); // loading remote data

    function formatRepo(repo) {
      if (repo.loading) return repo.text;
      var markup = "<div class='select2-result-repository clearfix'>" + "<div class='select2-result-repository__meta'>" + "<div class='select2-result-repository__title'>" + repo.full_name + "</div>";

      if (repo.description) {
        markup += "<div class='select2-result-repository__description'>" + repo.description + "</div>";
      }

      markup += "<div class='select2-result-repository__statistics'>" + "<div class='select2-result-repository__forks'><i class='fa fa-flash'></i> " + repo.forks_count + " Forks</div>" + "<div class='select2-result-repository__stargazers'><i class='fa fa-star'></i> " + repo.stargazers_count + " Stars</div>" + "<div class='select2-result-repository__watchers'><i class='fa fa-eye'></i> " + repo.watchers_count + " Watchers</div>" + "</div>" + "</div></div>";
      return markup;
    }

    function formatRepoSelection(repo) {
      return repo.full_name || repo.text;
    }

    $("#kt_select2_6").select2({
      placeholder: "Search for git repositories",
      allowClear: true,
      ajax: {
        url: "https://api.github.com/search/repositories",
        dataType: 'json',
        delay: 250,
        data: function data(params) {
          return {
            q: params.term,
            // search term
            page: params.page
          };
        },
        processResults: function processResults(data, params) {
          // parse the results into the format expected by Select2
          // since we are using custom formatting functions we do not need to
          // alter the remote JSON data, except to indicate that infinite
          // scrolling can be used
          params.page = params.page || 1;
          return {
            results: data.items,
            pagination: {
              more: params.page * 30 < data.total_count
            }
          };
        },
        cache: true
      },
      escapeMarkup: function escapeMarkup(markup) {
        return markup;
      },
      // let our custom formatter work
      minimumInputLength: 1,
      templateResult: formatRepo,
      // omitted for brevity, see the source of this page
      templateSelection: formatRepoSelection // omitted for brevity, see the source of this page

    }); // custom styles
    // tagging support

    $('#kt_select2_12_1, #kt_select2_12_2, #kt_select2_12_3, #kt_select2_12_4').select2({
      placeholder: "Select an option"
    }); // disabled mode

    $('#kt_select2_7').select2({
      placeholder: "Select an option"
    }); // disabled results

    $('#kt_select2_8').select2({
      placeholder: "Select an option"
    }); // limiting the number of selections

    $('#kt_select2_9').select2({
      placeholder: "Select an option",
      maximumSelectionLength: 2
    }); // hiding the search box

    $('#kt_select2_10').select2({
      placeholder: "Select an option",
      minimumResultsForSearch: Infinity
    }); // tagging support

    $('#kt_select2_11').select2({
      placeholder: "Add a tag",
      tags: true
    }); // disabled results

    $('.kt-select2-general').select2({
      placeholder: "Select an option"
    });
  };

  var modalDemos = function modalDemos() {
    $('#kt_select2_modal').on('shown.bs.modal', function () {
      // basic
      $('#kt_select2_1_modal').select2({
        placeholder: "Select a state"
      }); // nested

      $('#kt_select2_2_modal').select2({
        placeholder: "Select a state"
      }); // multi select

      $('#kt_select2_3_modal').select2({
        placeholder: "Select a state"
      }); // basic

      $('#kt_select2_4_modal').select2({
        placeholder: "Select a state",
        allowClear: true
      });
    });
  }; // Public functions


  return {
    init: function init() {
      demos();
      modalDemos();
    }
  };
}(); // Initialization


jQuery(document).ready(function () {
  KTSelect2.init();
});

/***/ }),

/***/ 77:
/*!*************************************************************************!*\
  !*** multi ./resources/metronic/js/pages/crud/forms/widgets/select2.js ***!
  \*************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\wamp64\www\keenthemes\themes\metronic\theme\html_laravel\demo1\skeleton\resources\metronic\js\pages\crud\forms\widgets\select2.js */"./resources/metronic/js/pages/crud/forms/widgets/select2.js");


/***/ })

/******/ });