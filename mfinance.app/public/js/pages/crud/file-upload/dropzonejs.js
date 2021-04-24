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
/******/ 	return __webpack_require__(__webpack_require__.s = 47);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/metronic/js/pages/crud/file-upload/dropzonejs.js":
/*!********************************************************************!*\
  !*** ./resources/metronic/js/pages/crud/file-upload/dropzonejs.js ***!
  \********************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
 // Class definition

var KTDropzoneDemo = function () {
  // Private functions
  var demo1 = function demo1() {
    // single file upload
    $('#kt_dropzone_1').dropzone({
      url: "https://keenthemes.com/scripts/void.php",
      // Set the url for your upload script location
      paramName: "file",
      // The name that will be used to transfer the file
      maxFiles: 1,
      maxFilesize: 5,
      // MB
      addRemoveLinks: true,
      accept: function accept(file, done) {
        if (file.name == "justinbieber.jpg") {
          done("Naha, you don't.");
        } else {
          done();
        }
      }
    }); // multiple file upload

    $('#kt_dropzone_2').dropzone({
      url: "https://keenthemes.com/scripts/void.php",
      // Set the url for your upload script location
      paramName: "file",
      // The name that will be used to transfer the file
      maxFiles: 10,
      maxFilesize: 10,
      // MB
      addRemoveLinks: true,
      accept: function accept(file, done) {
        if (file.name == "justinbieber.jpg") {
          done("Naha, you don't.");
        } else {
          done();
        }
      }
    }); // file type validation

    $('#kt_dropzone_3').dropzone({
      url: "https://keenthemes.com/scripts/void.php",
      // Set the url for your upload script location
      paramName: "file",
      // The name that will be used to transfer the file
      maxFiles: 10,
      maxFilesize: 10,
      // MB
      addRemoveLinks: true,
      acceptedFiles: "image/*,application/pdf,.psd",
      accept: function accept(file, done) {
        if (file.name == "justinbieber.jpg") {
          done("Naha, you don't.");
        } else {
          done();
        }
      }
    });
  };

  var demo2 = function demo2() {
    // set the dropzone container id
    var id = '#kt_dropzone_4'; // set the preview element template

    var previewNode = $(id + " .dropzone-item");
    previewNode.id = "";
    var previewTemplate = previewNode.parent('.dropzone-items').html();
    previewNode.remove();
    var myDropzone4 = new Dropzone(id, {
      // Make the whole body a dropzone
      url: "https://keenthemes.com/scripts/void.php",
      // Set the url for your upload script location
      parallelUploads: 20,
      previewTemplate: previewTemplate,
      maxFilesize: 1,
      // Max filesize in MB
      autoQueue: false,
      // Make sure the files aren't queued until manually added
      previewsContainer: id + " .dropzone-items",
      // Define the container to display the previews
      clickable: id + " .dropzone-select" // Define the element that should be used as click trigger to select files.

    });
    myDropzone4.on("addedfile", function (file) {
      // Hookup the start button
      file.previewElement.querySelector(id + " .dropzone-start").onclick = function () {
        myDropzone4.enqueueFile(file);
      };

      $(document).find(id + ' .dropzone-item').css('display', '');
      $(id + " .dropzone-upload, " + id + " .dropzone-remove-all").css('display', 'inline-block');
    }); // Update the total progress bar

    myDropzone4.on("totaluploadprogress", function (progress) {
      $(this).find(id + " .progress-bar").css('width', progress + "%");
    });
    myDropzone4.on("sending", function (file) {
      // Show the total progress bar when upload starts
      $(id + " .progress-bar").css('opacity', '1'); // And disable the start button

      file.previewElement.querySelector(id + " .dropzone-start").setAttribute("disabled", "disabled");
    }); // Hide the total progress bar when nothing's uploading anymore

    myDropzone4.on("complete", function (progress) {
      var thisProgressBar = id + " .dz-complete";
      setTimeout(function () {
        $(thisProgressBar + " .progress-bar, " + thisProgressBar + " .progress, " + thisProgressBar + " .dropzone-start").css('opacity', '0');
      }, 300);
    }); // Setup the buttons for all transfers

    document.querySelector(id + " .dropzone-upload").onclick = function () {
      myDropzone4.enqueueFiles(myDropzone4.getFilesWithStatus(Dropzone.ADDED));
    }; // Setup the button for remove all files


    document.querySelector(id + " .dropzone-remove-all").onclick = function () {
      $(id + " .dropzone-upload, " + id + " .dropzone-remove-all").css('display', 'none');
      myDropzone4.removeAllFiles(true);
    }; // On all files completed upload


    myDropzone4.on("queuecomplete", function (progress) {
      $(id + " .dropzone-upload").css('display', 'none');
    }); // On all files removed

    myDropzone4.on("removedfile", function (file) {
      if (myDropzone4.files.length < 1) {
        $(id + " .dropzone-upload, " + id + " .dropzone-remove-all").css('display', 'none');
      }
    });
  };

  var demo3 = function demo3() {
    // set the dropzone container id
    var id = '#kt_dropzone_5'; // set the preview element template

    var previewNode = $(id + " .dropzone-item");
    previewNode.id = "";
    var previewTemplate = previewNode.parent('.dropzone-items').html();
    previewNode.remove();
    var myDropzone5 = new Dropzone(id, {
      // Make the whole body a dropzone
      url: "https://keenthemes.com/scripts/void.php",
      // Set the url for your upload script location
      parallelUploads: 20,
      maxFilesize: 1,
      // Max filesize in MB
      previewTemplate: previewTemplate,
      previewsContainer: id + " .dropzone-items",
      // Define the container to display the previews
      clickable: id + " .dropzone-select" // Define the element that should be used as click trigger to select files.

    });
    myDropzone5.on("addedfile", function (file) {
      // Hookup the start button
      $(document).find(id + ' .dropzone-item').css('display', '');
    }); // Update the total progress bar

    myDropzone5.on("totaluploadprogress", function (progress) {
      $(id + " .progress-bar").css('width', progress + "%");
    });
    myDropzone5.on("sending", function (file) {
      // Show the total progress bar when upload starts
      $(id + " .progress-bar").css('opacity', "1");
    }); // Hide the total progress bar when nothing's uploading anymore

    myDropzone5.on("complete", function (progress) {
      var thisProgressBar = id + " .dz-complete";
      setTimeout(function () {
        $(thisProgressBar + " .progress-bar, " + thisProgressBar + " .progress").css('opacity', '0');
      }, 300);
    });
  };

  return {
    // public functions
    init: function init() {
      demo1();
      demo2();
      demo3();
    }
  };
}();

KTUtil.ready(function () {
  KTDropzoneDemo.init();
});

/***/ }),

/***/ 47:
/*!**************************************************************************!*\
  !*** multi ./resources/metronic/js/pages/crud/file-upload/dropzonejs.js ***!
  \**************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\wamp64\www\keenthemes\themes\metronic\theme\html_laravel\demo1\skeleton\resources\metronic\js\pages\crud\file-upload\dropzonejs.js */"./resources/metronic/js/pages/crud/file-upload/dropzonejs.js");


/***/ })

/******/ });