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
/******/ 	return __webpack_require__(__webpack_require__.s = 49);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/metronic/js/pages/crud/file-upload/uppy.js":
/*!**************************************************************!*\
  !*** ./resources/metronic/js/pages/crud/file-upload/uppy.js ***!
  \**************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
 // Class definition

var KTUppy = function () {
  var Tus = Uppy.Tus;
  var ProgressBar = Uppy.ProgressBar;
  var StatusBar = Uppy.StatusBar;
  var FileInput = Uppy.FileInput;
  var Informer = Uppy.Informer; // to get uppy companions working, please refer to the official documentation here: https://uppy.io/docs/companion/

  var Dashboard = Uppy.Dashboard;
  var Dropbox = Uppy.Dropbox;
  var GoogleDrive = Uppy.GoogleDrive;
  var Instagram = Uppy.Instagram;
  var Webcam = Uppy.Webcam; // Private functions

  var initUppy1 = function initUppy1() {
    var id = '#kt_uppy_1';
    var options = {
      proudlyDisplayPoweredByUppy: false,
      target: id,
      inline: true,
      replaceTargetContent: true,
      showProgressDetails: true,
      note: 'No filetype restrictions.',
      height: 470,
      metaFields: [{
        id: 'name',
        name: 'Name',
        placeholder: 'file name'
      }, {
        id: 'caption',
        name: 'Caption',
        placeholder: 'describe what the image is about'
      }],
      browserBackButtonClose: true
    };
    var uppyDashboard = Uppy.Core({
      autoProceed: true,
      restrictions: {
        maxFileSize: 1000000,
        // 1mb
        maxNumberOfFiles: 5,
        minNumberOfFiles: 1
      }
    });
    uppyDashboard.use(Dashboard, options);
    uppyDashboard.use(Tus, {
      endpoint: 'https://master.tus.io/files/'
    });
    uppyDashboard.use(GoogleDrive, {
      target: Dashboard,
      companionUrl: 'https://companion.uppy.io'
    });
    uppyDashboard.use(Dropbox, {
      target: Dashboard,
      companionUrl: 'https://companion.uppy.io'
    });
    uppyDashboard.use(Instagram, {
      target: Dashboard,
      companionUrl: 'https://companion.uppy.io'
    });
    uppyDashboard.use(Webcam, {
      target: Dashboard
    });
  };

  var initUppy2 = function initUppy2() {
    var id = '#kt_uppy_2';
    var options = {
      proudlyDisplayPoweredByUppy: false,
      target: id,
      inline: true,
      replaceTargetContent: true,
      showProgressDetails: true,
      note: 'Images and video only, 2–3 files, up to 1 MB',
      height: 470,
      metaFields: [{
        id: 'name',
        name: 'Name',
        placeholder: 'file name'
      }, {
        id: 'caption',
        name: 'Caption',
        placeholder: 'describe what the image is about'
      }],
      browserBackButtonClose: true
    };
    var uppyDashboard = Uppy.Core({
      autoProceed: true,
      restrictions: {
        maxFileSize: 1000000,
        // 1mb
        maxNumberOfFiles: 5,
        minNumberOfFiles: 1,
        allowedFileTypes: ['image/*', 'video/*']
      }
    });
    uppyDashboard.use(Dashboard, options);
    uppyDashboard.use(Tus, {
      endpoint: 'https://master.tus.io/files/'
    });
  };

  var initUppy3 = function initUppy3() {
    var id = '#kt_uppy_3';
    var uppyDrag = Uppy.Core({
      autoProceed: true,
      restrictions: {
        maxFileSize: 1000000,
        // 1mb
        maxNumberOfFiles: 5,
        minNumberOfFiles: 1,
        allowedFileTypes: ['image/*', 'video/*']
      }
    });
    uppyDrag.use(Uppy.DragDrop, {
      target: id + ' .uppy-drag'
    });
    uppyDrag.use(ProgressBar, {
      target: id + ' .uppy-progress',
      hideUploadButton: false,
      hideAfterFinish: false
    });
    uppyDrag.use(Informer, {
      target: id + ' .uppy-informer'
    });
    uppyDrag.use(Tus, {
      endpoint: 'https://master.tus.io/files/'
    });
    uppyDrag.on('complete', function (file) {
      var imagePreview = "";
      $.each(file.successful, function (index, value) {
        var imageType = /image/;
        var thumbnail = "";

        if (imageType.test(value.type)) {
          thumbnail = '<div class="uppy-thumbnail"><img src="' + value.uploadURL + '"/></div>';
        }

        var sizeLabel = "bytes";
        var filesize = value.size;

        if (filesize > 1024) {
          filesize = filesize / 1024;
          sizeLabel = "kb";

          if (filesize > 1024) {
            filesize = filesize / 1024;
            sizeLabel = "MB";
          }
        }

        imagePreview += '<div class="uppy-thumbnail-container" data-id="' + value.id + '">' + thumbnail + ' <span class="uppy-thumbnail-label">' + value.name + ' (' + Math.round(filesize, 2) + ' ' + sizeLabel + ')</span><span data-id="' + value.id + '" class="uppy-remove-thumbnail"><i class="flaticon2-cancel-music"></i></span></div>';
      });
      $(id + ' .uppy-thumbnails').append(imagePreview);
    });
    $(document).on('click', id + ' .uppy-thumbnails .uppy-remove-thumbnail', function () {
      var imageId = $(this).attr('data-id');
      uppyDrag.removeFile(imageId);
      $(id + ' .uppy-thumbnail-container[data-id="' + imageId + '"').remove();
    });
  };

  var initUppy4 = function initUppy4() {
    var id = '#kt_uppy_4';
    var uppyDrag = Uppy.Core({
      autoProceed: false,
      restrictions: {
        maxFileSize: 1000000,
        // 1mb
        maxNumberOfFiles: 5,
        minNumberOfFiles: 1
      }
    });
    uppyDrag.use(Uppy.DragDrop, {
      target: id + ' .uppy-drag'
    });
    uppyDrag.use(ProgressBar, {
      target: id + ' .uppy-progress'
    });
    uppyDrag.use(Informer, {
      target: id + ' .uppy-informer'
    });
    uppyDrag.use(Tus, {
      endpoint: 'https://master.tus.io/files/'
    });
    uppyDrag.on('complete', function (file) {
      var imagePreview = "";
      $.each(file.successful, function (index, value) {
        var imageType = /image/;
        var thumbnail = "";

        if (imageType.test(value.type)) {
          thumbnail = '<div class="uppy-thumbnail"><img src="' + value.uploadURL + '"/></div>';
        }

        var sizeLabel = "bytes";
        var filesize = value.size;

        if (filesize > 1024) {
          filesize = filesize / 1024;
          sizeLabel = "kb";

          if (filesize > 1024) {
            filesize = filesize / 1024;
            sizeLabel = "MB";
          }
        }

        imagePreview += '<div class="uppy-thumbnail-container" data-id="' + value.id + '">' + thumbnail + ' <span class="uppy-thumbnail-label">' + value.name + ' (' + Math.round(filesize, 2) + ' ' + sizeLabel + ')</span><span data-id="' + value.id + '" class="uppy-remove-thumbnail"><i class="flaticon2-cancel-music"></i></span></div>';
      });
      $(id + ' .uppy-thumbnails').append(imagePreview);
    });
    var uploadBtn = $(id + ' .uppy-btn');
    uploadBtn.click(function () {
      uppyDrag.upload();
    });
    $(document).on('click', id + ' .uppy-thumbnails .uppy-remove-thumbnail', function () {
      var imageId = $(this).attr('data-id');
      uppyDrag.removeFile(imageId);
      $(id + ' .uppy-thumbnail-container[data-id="' + imageId + '"').remove();
    });
  };

  var initUppy5 = function initUppy5() {
    // Uppy variables
    // For more info refer: https://uppy.io/
    var elemId = 'kt_uppy_5';
    var id = '#' + elemId;
    var $statusBar = $(id + ' .uppy-status');
    var $uploadedList = $(id + ' .uppy-list');
    var timeout;
    var uppyMin = Uppy.Core({
      debug: true,
      autoProceed: true,
      showProgressDetails: true,
      restrictions: {
        maxFileSize: 1000000,
        // 1mb
        maxNumberOfFiles: 5,
        minNumberOfFiles: 1
      }
    });
    uppyMin.use(FileInput, {
      target: id + ' .uppy-wrapper',
      pretty: false
    });
    uppyMin.use(Informer, {
      target: id + ' .uppy-informer'
    }); // demo file upload server

    uppyMin.use(Tus, {
      endpoint: 'https://master.tus.io/files/'
    });
    uppyMin.use(StatusBar, {
      target: id + ' .uppy-status',
      hideUploadButton: true,
      hideAfterFinish: false
    });
    $(id + ' .uppy-FileInput-input').addClass('uppy-input-control').attr('id', elemId + '_input_control');
    $(id + ' .uppy-FileInput-container').append('<label class="uppy-input-label btn btn-light-primary btn-sm btn-bold" for="' + (elemId + '_input_control') + '">Attach files</label>');
    var $fileLabel = $(id + ' .uppy-input-label');
    uppyMin.on('upload', function (data) {
      $fileLabel.text("Uploading...");
      $statusBar.addClass('uppy-status-ongoing');
      $statusBar.removeClass('uppy-status-hidden');
      clearTimeout(timeout);
    });
    uppyMin.on('complete', function (file) {
      $.each(file.successful, function (index, value) {
        var sizeLabel = "bytes";
        var filesize = value.size;

        if (filesize > 1024) {
          filesize = filesize / 1024;
          sizeLabel = "kb";

          if (filesize > 1024) {
            filesize = filesize / 1024;
            sizeLabel = "MB";
          }
        }

        var uploadListHtml = '<div class="uppy-list-item" data-id="' + value.id + '"><div class="uppy-list-label">' + value.name + ' (' + Math.round(filesize, 2) + ' ' + sizeLabel + ')</div><span class="uppy-list-remove" data-id="' + value.id + '"><i class="flaticon2-cancel-music"></i></span></div>';
        $uploadedList.append(uploadListHtml);
      });
      $fileLabel.text("Add more files");
      $statusBar.addClass('uppy-status-hidden');
      $statusBar.removeClass('uppy-status-ongoing');
    });
    $(document).on('click', id + ' .uppy-list .uppy-list-remove', function () {
      var itemId = $(this).attr('data-id');
      uppyMin.removeFile(itemId);
      $(id + ' .uppy-list-item[data-id="' + itemId + '"').remove();
    });
  };

  var initUppy6 = function initUppy6() {
    var id = '#kt_uppy_6';
    var options = {
      proudlyDisplayPoweredByUppy: false,
      target: id + ' .uppy-dashboard',
      inline: false,
      replaceTargetContent: true,
      showProgressDetails: true,
      note: 'No filetype restrictions.',
      height: 470,
      metaFields: [{
        id: 'name',
        name: 'Name',
        placeholder: 'file name'
      }, {
        id: 'caption',
        name: 'Caption',
        placeholder: 'describe what the image is about'
      }],
      browserBackButtonClose: true,
      trigger: id + ' .uppy-btn'
    };
    var uppyDashboard = Uppy.Core({
      autoProceed: true,
      restrictions: {
        maxFileSize: 1000000,
        // 1mb
        maxNumberOfFiles: 5,
        minNumberOfFiles: 1
      }
    });
    uppyDashboard.use(Dashboard, options);
    uppyDashboard.use(Tus, {
      endpoint: 'https://master.tus.io/files/'
    });
    uppyDashboard.use(GoogleDrive, {
      target: Dashboard,
      companionUrl: 'https://companion.uppy.io'
    });
    uppyDashboard.use(Dropbox, {
      target: Dashboard,
      companionUrl: 'https://companion.uppy.io'
    });
    uppyDashboard.use(Instagram, {
      target: Dashboard,
      companionUrl: 'https://companion.uppy.io'
    });
    uppyDashboard.use(Webcam, {
      target: Dashboard
    });
  };

  return {
    // public functions
    init: function init() {
      initUppy1();
      initUppy2();
      initUppy3();
      initUppy4();
      initUppy5();
      initUppy6();
      setTimeout(function () {
        swal.fire({
          "title": "Notice",
          "html": "Uppy demos uses <b>https://master.tus.io/files/</b> URL for resumable upload examples and your uploaded files will be temporarely stored in <b>tus.io</b> servers.",
          "type": "info",
          "buttonsStyling": false,
          "confirmButtonClass": "btn btn-primary",
          "confirmButtonText": "Ok, I understand",
          "onClose": function onClose(e) {
            console.log('on close event fired!');
          }
        });
      }, 2000);
    }
  };
}();

KTUtil.ready(function () {
  KTUppy.init();
});

/***/ }),

/***/ 49:
/*!********************************************************************!*\
  !*** multi ./resources/metronic/js/pages/crud/file-upload/uppy.js ***!
  \********************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\wamp64\www\keenthemes\themes\metronic\theme\html_laravel\demo1\skeleton\resources\metronic\js\pages\crud\file-upload\uppy.js */"./resources/metronic/js/pages/crud/file-upload/uppy.js");


/***/ })

/******/ });