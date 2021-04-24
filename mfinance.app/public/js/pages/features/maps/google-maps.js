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
/******/ 	return __webpack_require__(__webpack_require__.s = 140);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/metronic/js/pages/features/maps/google-maps.js":
/*!******************************************************************!*\
  !*** ./resources/metronic/js/pages/features/maps/google-maps.js ***!
  \******************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
 // Class definition

var KTGoogleMapsDemo = function () {
  // Private functions
  var demo1 = function demo1() {
    var map = new GMaps({
      div: '#kt_gmap_1',
      lat: -12.043333,
      lng: -77.028333
    });
  };

  var demo2 = function demo2() {
    var map = new GMaps({
      div: '#kt_gmap_2',
      zoom: 16,
      lat: -12.043333,
      lng: -77.028333,
      click: function click(e) {
        alert('click');
      },
      dragend: function dragend(e) {
        alert('dragend');
      }
    });
  };

  var demo3 = function demo3() {
    var map = new GMaps({
      div: '#kt_gmap_3',
      lat: -51.38739,
      lng: -6.187181
    });
    map.addMarker({
      lat: -51.38739,
      lng: -6.187181,
      title: 'Lima',
      details: {
        database_id: 42,
        author: 'HPNeo'
      },
      click: function click(e) {
        if (console.log) console.log(e);
        alert('You clicked in this marker');
      }
    });
    map.addMarker({
      lat: -12.042,
      lng: -77.028333,
      title: 'Marker with InfoWindow',
      infoWindow: {
        content: '<span style="color:#000">HTML Content!</span>'
      }
    });
    map.setZoom(5);
  };

  var demo4 = function demo4() {
    var map = new GMaps({
      div: '#kt_gmap_4',
      lat: -12.043333,
      lng: -77.028333
    });
    GMaps.geolocate({
      success: function success(position) {
        map.setCenter(position.coords.latitude, position.coords.longitude);
      },
      error: function error(_error) {
        alert('Geolocation failed: ' + _error.message);
      },
      not_supported: function not_supported() {
        alert("Your browser does not support geolocation");
      },
      always: function always() {//alert("Geolocation Done!");
      }
    });
  };

  var demo5 = function demo5() {
    var map = new GMaps({
      div: '#kt_gmap_5',
      lat: -12.043333,
      lng: -77.028333,
      click: function click(e) {
        console.log(e);
      }
    });
    var path = [[-12.044012922866312, -77.02470665341184], [-12.05449279282314, -77.03024273281858], [-12.055122327623378, -77.03039293652341], [-12.075917129727586, -77.02764635449216], [-12.07635776902266, -77.02792530422971], [-12.076819390363665, -77.02893381481931], [-12.088527520066453, -77.0241058385925], [-12.090814532191756, -77.02271108990476]];
    map.drawPolyline({
      path: path,
      strokeColor: '#131540',
      strokeOpacity: 0.6,
      strokeWeight: 6
    });
  };

  var demo6 = function demo6() {
    var map = new GMaps({
      div: '#kt_gmap_6',
      lat: -12.043333,
      lng: -77.028333
    });
    var path = [[-12.040397656836609, -77.03373871559225], [-12.040248585302038, -77.03993927003302], [-12.050047116528843, -77.02448169303511], [-12.044804866577001, -77.02154422636042]];
    var polygon = map.drawPolygon({
      paths: path,
      strokeColor: '#BBD8E9',
      strokeOpacity: 1,
      strokeWeight: 3,
      fillColor: '#BBD8E9',
      fillOpacity: 0.6
    });
  };

  var demo7 = function demo7() {
    var map = new GMaps({
      div: '#kt_gmap_7',
      lat: -12.043333,
      lng: -77.028333
    });
    $('#kt_gmap_7_btn').click(function (e) {
      e.preventDefault();
      KTUtil.scrollTo('kt_gmap_7_btn', 400);
      map.travelRoute({
        origin: [-12.044012922866312, -77.02470665341184],
        destination: [-12.090814532191756, -77.02271108990476],
        travelMode: 'driving',
        step: function step(e) {
          $('#kt_gmap_7_routes').append('<li>' + e.instructions + '</li>');
          $('#kt_gmap_7_routes li:eq(' + e.step_number + ')').delay(800 * e.step_number).fadeIn(500, function () {
            map.setCenter(e.end_location.lat(), e.end_location.lng());
            map.drawPolyline({
              path: e.path,
              strokeColor: '#131540',
              strokeOpacity: 0.6,
              strokeWeight: 6
            });
          });
        }
      });
    });
  };

  var demo8 = function demo8() {
    var map = new GMaps({
      div: '#kt_gmap_8',
      lat: -12.043333,
      lng: -77.028333
    });

    var handleAction = function handleAction() {
      var text = $.trim($('#kt_gmap_8_address').val());
      GMaps.geocode({
        address: text,
        callback: function callback(results, status) {
          if (status == 'OK') {
            var latlng = results[0].geometry.location;
            map.setCenter(latlng.lat(), latlng.lng());
            map.addMarker({
              lat: latlng.lat(),
              lng: latlng.lng()
            });
            KTUtil.scrollTo('kt_gmap_8');
          }
        }
      });
    };

    $('#kt_gmap_8_btn').click(function (e) {
      e.preventDefault();
      handleAction();
    });
    $("#kt_gmap_8_address").keypress(function (e) {
      var keycode = e.keyCode ? e.keyCode : e.which;

      if (keycode == '13') {
        e.preventDefault();
        handleAction();
      }
    });
  };

  return {
    // public functions
    init: function init() {
      // default charts
      demo1();
      demo2();
      demo3();
      demo4();
      demo5();
      demo6();
      demo7();
      demo8();
    }
  };
}();

jQuery(document).ready(function () {
  KTGoogleMapsDemo.init();
});

/***/ }),

/***/ 140:
/*!************************************************************************!*\
  !*** multi ./resources/metronic/js/pages/features/maps/google-maps.js ***!
  \************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\wamp64\www\keenthemes\themes\metronic\theme\html_laravel\demo1\skeleton\resources\metronic\js\pages\features\maps\google-maps.js */"./resources/metronic/js/pages/features/maps/google-maps.js");


/***/ })

/******/ });