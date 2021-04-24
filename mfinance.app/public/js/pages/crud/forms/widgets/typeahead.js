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
/******/ 	return __webpack_require__(__webpack_require__.s = 79);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/metronic/js/pages/crud/forms/widgets/typeahead.js":
/*!*********************************************************************!*\
  !*** ./resources/metronic/js/pages/crud/forms/widgets/typeahead.js ***!
  \*********************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// Class definition
var KTTypeahead = function () {
  var states = ['Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California', 'Colorado', 'Connecticut', 'Delaware', 'Florida', 'Georgia', 'Hawaii', 'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana', 'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota', 'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire', 'New Jersey', 'New Mexico', 'New York', 'North Carolina', 'North Dakota', 'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island', 'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont', 'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming']; // Private functions

  var demo1 = function demo1() {
    var substringMatcher = function substringMatcher(strs) {
      return function findMatches(q, cb) {
        var matches, substringRegex; // an array that will be populated with substring matches

        matches = []; // regex used to determine if a string contains the substring `q`

        substrRegex = new RegExp(q, 'i'); // iterate through the pool of strings and for any string that
        // contains the substring `q`, add it to the `matches` array

        $.each(strs, function (i, str) {
          if (substrRegex.test(str)) {
            matches.push(str);
          }
        });
        cb(matches);
      };
    };

    $('#kt_typeahead_1, #kt_typeahead_1_modal').typeahead({
      hint: true,
      highlight: true,
      minLength: 1
    }, {
      name: 'states',
      source: substringMatcher(states)
    });
  };

  var demo2 = function demo2() {
    // constructs the suggestion engine
    var bloodhound = new Bloodhound({
      datumTokenizer: Bloodhound.tokenizers.whitespace,
      queryTokenizer: Bloodhound.tokenizers.whitespace,
      // `states` is an array of state names defined in \"The Basics\"
      local: states
    });
    $('#kt_typeahead_2, #kt_typeahead_2_modal').typeahead({
      hint: true,
      highlight: true,
      minLength: 1
    }, {
      name: 'states',
      source: bloodhound
    });
  };

  var demo3 = function demo3() {
    var countries = new Bloodhound({
      datumTokenizer: Bloodhound.tokenizers.whitespace,
      queryTokenizer: Bloodhound.tokenizers.whitespace,
      // url points to a json file that contains an array of country names, see
      // https://github.com/twitter/typeahead.js/blob/gh-pages/data/countries.json
      prefetch: HOST_URL + '/api/?file=typeahead/countries.json'
    }); // passing in `null` for the `options` arguments will result in the default
    // options being used

    $('#kt_typeahead_3, #kt_typeahead_3_modal').typeahead(null, {
      name: 'countries',
      source: countries
    });
  };

  var demo4 = function demo4() {
    var bestPictures = new Bloodhound({
      datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
      queryTokenizer: Bloodhound.tokenizers.whitespace,
      prefetch: HOST_URL + '/api/?file=typeahead/movies.json'
    });
    $('#kt_typeahead_4').typeahead(null, {
      name: 'best-pictures',
      display: 'value',
      source: bestPictures,
      templates: {
        empty: ['<div class=\"empty-message\" style=\"padding: 10px 15px; text-align: center;\">', 'unable to find any Best Picture winners that match the current query', '</div>'].join('\n'),
        suggestion: Handlebars.compile('<div><strong>{{value}}</strong> – {{year}}</div>')
      }
    });
  };

  var demo5 = function demo5() {
    var nbaTeams = new Bloodhound({
      datumTokenizer: Bloodhound.tokenizers.obj.whitespace('team'),
      queryTokenizer: Bloodhound.tokenizers.whitespace,
      prefetch: HOST_URL + '/api/?file=typeahead/nba.json'
    });
    var nhlTeams = new Bloodhound({
      datumTokenizer: Bloodhound.tokenizers.obj.whitespace('team'),
      queryTokenizer: Bloodhound.tokenizers.whitespace,
      prefetch: HOST_URL + '/api/?file=typeahead/nhl.json'
    });
    $('#kt_typeahead_5').typeahead({
      highlight: true
    }, {
      name: 'nba-teams',
      display: 'team',
      source: nbaTeams,
      templates: {
        header: '<h3 class=\"league-name\" style=\"padding: 5px 15px; font-size: 1.2rem; margin:0;\">NBA Teams</h3>'
      }
    }, {
      name: 'nhl-teams',
      display: 'team',
      source: nhlTeams,
      templates: {
        header: '<h3 class=\"league-name\" style=\"padding: 5px 15px; font-size: 1.2rem; margin:0;\">NHL Teams</h3>'
      }
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
    }
  };
}();

jQuery(document).ready(function () {
  KTTypeahead.init();
});

/***/ }),

/***/ 79:
/*!***************************************************************************!*\
  !*** multi ./resources/metronic/js/pages/crud/forms/widgets/typeahead.js ***!
  \***************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\wamp64\www\keenthemes\themes\metronic\theme\html_laravel\demo1\skeleton\resources\metronic\js\pages\crud\forms\widgets\typeahead.js */"./resources/metronic/js/pages/crud/forms/widgets/typeahead.js");


/***/ })

/******/ });