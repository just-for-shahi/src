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
/******/ 	return __webpack_require__(__webpack_require__.s = 106);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/metronic/js/pages/custom/education/student/calendar.js":
/*!**************************************************************************!*\
  !*** ./resources/metronic/js/pages/custom/education/student/calendar.js ***!
  \**************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var KTAppsEducationStudentCalendar = function () {
  return {
    //main function to initiate the module
    init: function init() {
      var todayDate = moment().startOf('day');
      var YM = todayDate.format('YYYY-MM');
      var YESTERDAY = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
      var TODAY = todayDate.format('YYYY-MM-DD');
      var TOMORROW = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');
      var calendarEl = document.getElementById('kt_calendar');
      var calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: ['bootstrap', 'interaction', 'dayGrid', 'timeGrid', 'list'],
        themeSystem: 'bootstrap',
        isRTL: KTUtil.isRTL(),
        header: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        height: 800,
        contentHeight: 780,
        aspectRatio: 3,
        // see: https://fullcalendar.io/docs/aspectRatio
        nowIndicator: true,
        now: TODAY + 'T09:25:00',
        // just for demo
        views: {
          dayGridMonth: {
            buttonText: 'month'
          },
          timeGridWeek: {
            buttonText: 'week'
          },
          timeGridDay: {
            buttonText: 'day'
          }
        },
        defaultView: 'dayGridMonth',
        defaultDate: TODAY,
        editable: true,
        eventLimit: true,
        // allow "more" link when too many events
        navLinks: true,
        events: [{
          title: 'All Day Event',
          start: YM + '-01',
          description: 'Toto lorem ipsum dolor sit incid idunt ut',
          className: "fc-event-danger fc-event-solid-warning"
        }, {
          title: 'Reporting',
          start: YM + '-14T13:30:00',
          description: 'Lorem ipsum dolor incid idunt ut labore',
          end: YM + '-14',
          className: "fc-event-success"
        }, {
          title: 'Company Trip',
          start: YM + '-02',
          description: 'Lorem ipsum dolor sit tempor incid',
          end: YM + '-03',
          className: "fc-event-primary"
        }, {
          title: 'ICT Expo 2017 - Product Release',
          start: YM + '-03',
          description: 'Lorem ipsum dolor sit tempor inci',
          end: YM + '-05',
          className: "fc-event-light fc-event-solid-primary"
        }, {
          title: 'Dinner',
          start: YM + '-12',
          description: 'Lorem ipsum dolor sit amet, conse ctetur',
          end: YM + '-10'
        }, {
          id: 999,
          title: 'Repeating Event',
          start: YM + '-09T16:00:00',
          description: 'Lorem ipsum dolor sit ncididunt ut labore',
          className: "fc-event-danger"
        }, {
          id: 1000,
          title: 'Repeating Event',
          description: 'Lorem ipsum dolor sit amet, labore',
          start: YM + '-16T16:00:00'
        }, {
          title: 'Conference',
          start: YESTERDAY,
          end: TOMORROW,
          description: 'Lorem ipsum dolor eius mod tempor labore',
          className: "fc-event-primary"
        }, {
          title: 'Meeting',
          start: TODAY + 'T10:30:00',
          end: TODAY + 'T12:30:00',
          description: 'Lorem ipsum dolor eiu idunt ut labore'
        }, {
          title: 'Lunch',
          start: TODAY + 'T12:00:00',
          className: "fc-event-info",
          description: 'Lorem ipsum dolor sit amet, ut labore'
        }, {
          title: 'Meeting',
          start: TODAY + 'T14:30:00',
          className: "fc-event-warning",
          description: 'Lorem ipsum conse ctetur adipi scing'
        }, {
          title: 'Happy Hour',
          start: TODAY + 'T17:30:00',
          className: "fc-event-info",
          description: 'Lorem ipsum dolor sit amet, conse ctetur'
        }, {
          title: 'Dinner',
          start: TOMORROW + 'T05:00:00',
          className: "fc-event-solid-danger fc-event-light",
          description: 'Lorem ipsum dolor sit ctetur adipi scing'
        }, {
          title: 'Birthday Party',
          start: TOMORROW + 'T07:00:00',
          className: "fc-event-primary",
          description: 'Lorem ipsum dolor sit amet, scing'
        }, {
          title: 'Click for Google',
          url: 'http://google.com/',
          start: YM + '-28',
          className: "fc-event-solid-info fc-event-light",
          description: 'Lorem ipsum dolor sit amet, labore'
        }],
        eventRender: function eventRender(info) {
          var element = $(info.el);

          if (info.event.extendedProps && info.event.extendedProps.description) {
            if (element.hasClass('fc-day-grid-event')) {
              element.data('content', info.event.extendedProps.description);
              element.data('placement', 'top');
              KTApp.initPopover(element);
            } else if (element.hasClass('fc-time-grid-event')) {
              element.find('.fc-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>');
            } else if (element.find('.fc-list-item-title').lenght !== 0) {
              element.find('.fc-list-item-title').append('<div class="fc-description">' + info.event.extendedProps.description + '</div>');
            }
          }
        }
      });
      calendar.render();
    }
  };
}();

jQuery(document).ready(function () {
  KTAppsEducationStudentCalendar.init();
});

/***/ }),

/***/ 106:
/*!********************************************************************************!*\
  !*** multi ./resources/metronic/js/pages/custom/education/student/calendar.js ***!
  \********************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\wamp64\www\keenthemes\themes\metronic\theme\html_laravel\demo1\skeleton\resources\metronic\js\pages\custom\education\student\calendar.js */"./resources/metronic/js/pages/custom/education/student/calendar.js");


/***/ })

/******/ });