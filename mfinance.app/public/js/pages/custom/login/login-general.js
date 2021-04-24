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
/******/ 	return __webpack_require__(__webpack_require__.s = 111);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/metronic/js/pages/custom/login/login-general.js":
/*!*******************************************************************!*\
  !*** ./resources/metronic/js/pages/custom/login/login-general.js ***!
  \*******************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";
 // Class Definition

var KTLogin = function () {
  var _login;

  var _showForm = function _showForm(form) {
    var cls = 'login-' + form + '-on';
    var form = 'kt_login_' + form + '_form';

    _login.removeClass('login-forgot-on');

    _login.removeClass('login-signin-on');

    _login.removeClass('login-signup-on');

    _login.addClass(cls);

    KTUtil.animateClass(KTUtil.getById(form), 'animate__animated animate__backInUp');
  };

  var _handleSignInForm = function _handleSignInForm() {
    var validation; // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/

    validation = FormValidation.formValidation(KTUtil.getById('kt_login_signin_form'), {
      fields: {
        username: {
          validators: {
            notEmpty: {
              message: 'Username is required'
            }
          }
        },
        password: {
          validators: {
            notEmpty: {
              message: 'Password is required'
            }
          }
        }
      },
      plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        submitButton: new FormValidation.plugins.SubmitButton(),
        //defaultSubmit: new FormValidation.plugins.DefaultSubmit(), // Uncomment this line to enable normal button submit after form validation
        bootstrap: new FormValidation.plugins.Bootstrap()
      }
    });
    $('#kt_login_signin_submit').on('click', function (e) {
      e.preventDefault();
      validation.validate().then(function (status) {
        if (status == 'Valid') {
          swal.fire({
            text: "All is cool! Now you submit this form",
            icon: "success",
            buttonsStyling: false,
            confirmButtonText: "Ok, got it!",
            customClass: {
              confirmButton: "btn font-weight-bold btn-light-primary"
            }
          }).then(function () {
            KTUtil.scrollTop();
          });
        } else {
          swal.fire({
            text: "Sorry, looks like there are some errors detected, please try again.",
            icon: "error",
            buttonsStyling: false,
            confirmButtonText: "Ok, got it!",
            customClass: {
              confirmButton: "btn font-weight-bold btn-light-primary"
            }
          }).then(function () {
            KTUtil.scrollTop();
          });
        }
      });
    }); // Handle forgot button

    $('#kt_login_forgot').on('click', function (e) {
      e.preventDefault();

      _showForm('forgot');
    }); // Handle signup

    $('#kt_login_signup').on('click', function (e) {
      e.preventDefault();

      _showForm('signup');
    });
  };

  var _handleSignUpForm = function _handleSignUpForm(e) {
    var validation;
    var form = KTUtil.getById('kt_login_signup_form'); // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/

    validation = FormValidation.formValidation(form, {
      fields: {
        fullname: {
          validators: {
            notEmpty: {
              message: 'Username is required'
            }
          }
        },
        email: {
          validators: {
            notEmpty: {
              message: 'Email address is required'
            },
            emailAddress: {
              message: 'The value is not a valid email address'
            }
          }
        },
        password: {
          validators: {
            notEmpty: {
              message: 'The password is required'
            }
          }
        },
        cpassword: {
          validators: {
            notEmpty: {
              message: 'The password confirmation is required'
            },
            identical: {
              compare: function compare() {
                return form.querySelector('[name="password"]').value;
              },
              message: 'The password and its confirm are not the same'
            }
          }
        },
        agree: {
          validators: {
            notEmpty: {
              message: 'You must accept the terms and conditions'
            }
          }
        }
      },
      plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        bootstrap: new FormValidation.plugins.Bootstrap()
      }
    });
    $('#kt_login_signup_submit').on('click', function (e) {
      e.preventDefault();
      validation.validate().then(function (status) {
        if (status == 'Valid') {
          swal.fire({
            text: "All is cool! Now you submit this form",
            icon: "success",
            buttonsStyling: false,
            confirmButtonText: "Ok, got it!",
            customClass: {
              confirmButton: "btn font-weight-bold btn-light-primary"
            }
          }).then(function () {
            KTUtil.scrollTop();
          });
        } else {
          swal.fire({
            text: "Sorry, looks like there are some errors detected, please try again.",
            icon: "error",
            buttonsStyling: false,
            confirmButtonText: "Ok, got it!",
            customClass: {
              confirmButton: "btn font-weight-bold btn-light-primary"
            }
          }).then(function () {
            KTUtil.scrollTop();
          });
        }
      });
    }); // Handle cancel button

    $('#kt_login_signup_cancel').on('click', function (e) {
      e.preventDefault();

      _showForm('signin');
    });
  };

  var _handleForgotForm = function _handleForgotForm(e) {
    var validation; // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/

    validation = FormValidation.formValidation(KTUtil.getById('kt_login_forgot_form'), {
      fields: {
        email: {
          validators: {
            notEmpty: {
              message: 'Email address is required'
            },
            emailAddress: {
              message: 'The value is not a valid email address'
            }
          }
        }
      },
      plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        bootstrap: new FormValidation.plugins.Bootstrap()
      }
    }); // Handle submit button

    $('#kt_login_forgot_submit').on('click', function (e) {
      e.preventDefault();
      validation.validate().then(function (status) {
        if (status == 'Valid') {
          // Submit form
          KTUtil.scrollTop();
        } else {
          swal.fire({
            text: "Sorry, looks like there are some errors detected, please try again.",
            icon: "error",
            buttonsStyling: false,
            confirmButtonText: "Ok, got it!",
            customClass: {
              confirmButton: "btn font-weight-bold btn-light-primary"
            }
          }).then(function () {
            KTUtil.scrollTop();
          });
        }
      });
    }); // Handle cancel button

    $('#kt_login_forgot_cancel').on('click', function (e) {
      e.preventDefault();

      _showForm('signin');
    });
  }; // Public Functions


  return {
    // public functions
    init: function init() {
      _login = $('#kt_login');

      _handleSignInForm();

      _handleSignUpForm();

      _handleForgotForm();
    }
  };
}(); // Class Initialization


jQuery(document).ready(function () {
  KTLogin.init();
});

/***/ }),

/***/ 111:
/*!*************************************************************************!*\
  !*** multi ./resources/metronic/js/pages/custom/login/login-general.js ***!
  \*************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\wamp64\www\keenthemes\themes\metronic\theme\html_laravel\demo1\skeleton\resources\metronic\js\pages\custom\login\login-general.js */"./resources/metronic/js/pages/custom/login/login-general.js");


/***/ })

/******/ });