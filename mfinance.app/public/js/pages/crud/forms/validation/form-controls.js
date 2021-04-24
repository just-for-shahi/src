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
/******/ 	return __webpack_require__(__webpack_require__.s = 59);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/metronic/js/pages/crud/forms/validation/form-controls.js":
/*!****************************************************************************!*\
  !*** ./resources/metronic/js/pages/crud/forms/validation/form-controls.js ***!
  \****************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// Class definition
var KTFormControls = function () {
  // Private functions
  var _initDemo1 = function _initDemo1() {
    FormValidation.formValidation(document.getElementById('kt_form_1'), {
      fields: {
        email: {
          validators: {
            notEmpty: {
              message: 'Email is required'
            },
            emailAddress: {
              message: 'The value is not a valid email address'
            }
          }
        },
        url: {
          validators: {
            notEmpty: {
              message: 'Website URL is required'
            },
            uri: {
              message: 'The website address is not valid'
            }
          }
        },
        digits: {
          validators: {
            notEmpty: {
              message: 'Digits is required'
            },
            digits: {
              message: 'The velue is not a valid digits'
            }
          }
        },
        creditcard: {
          validators: {
            notEmpty: {
              message: 'Credit card number is required'
            },
            creditCard: {
              message: 'The credit card number is not valid'
            }
          }
        },
        phone: {
          validators: {
            notEmpty: {
              message: 'US phone number is required'
            },
            phone: {
              country: 'US',
              message: 'The value is not a valid US phone number'
            }
          }
        },
        option: {
          validators: {
            notEmpty: {
              message: 'Please select an option'
            }
          }
        },
        options: {
          validators: {
            choice: {
              min: 2,
              max: 5,
              message: 'Please select at least 2 and maximum 5 options'
            }
          }
        },
        memo: {
          validators: {
            notEmpty: {
              message: 'Please enter memo text'
            },
            stringLength: {
              min: 50,
              max: 100,
              message: 'Please enter a menu within text length range 50 and 100'
            }
          }
        },
        checkbox: {
          validators: {
            choice: {
              min: 1,
              message: 'Please kindly check this'
            }
          }
        },
        checkboxes: {
          validators: {
            choice: {
              min: 2,
              max: 5,
              message: 'Please check at least 1 and maximum 2 options'
            }
          }
        },
        radios: {
          validators: {
            choice: {
              min: 1,
              message: 'Please kindly check this'
            }
          }
        }
      },
      plugins: {
        //Learn more: https://formvalidation.io/guide/plugins
        trigger: new FormValidation.plugins.Trigger(),
        // Bootstrap Framework Integration
        bootstrap: new FormValidation.plugins.Bootstrap(),
        // Validate fields when clicking the Submit button
        submitButton: new FormValidation.plugins.SubmitButton(),
        // Submit the form when all fields are valid
        defaultSubmit: new FormValidation.plugins.DefaultSubmit()
      }
    });
  };

  var _initDemo2 = function _initDemo2() {
    FormValidation.formValidation(document.getElementById('kt_form_2'), {
      fields: {
        billing_card_name: {
          validators: {
            notEmpty: {
              message: 'Card Holder Name is required'
            }
          }
        },
        billing_card_number: {
          validators: {
            notEmpty: {
              message: 'Credit card number is required'
            },
            creditCard: {
              message: 'The credit card number is not valid'
            }
          }
        },
        billing_card_exp_month: {
          validators: {
            notEmpty: {
              message: 'Expiry Month is required'
            }
          }
        },
        billing_card_exp_year: {
          validators: {
            notEmpty: {
              message: 'Expiry Year is required'
            }
          }
        },
        billing_card_cvv: {
          validators: {
            notEmpty: {
              message: 'CVV is required'
            },
            digits: {
              message: 'The CVV velue is not a valid digits'
            }
          }
        },
        billing_address_1: {
          validators: {
            notEmpty: {
              message: 'Address 1 is required'
            }
          }
        },
        billing_city: {
          validators: {
            notEmpty: {
              message: 'City 1 is required'
            }
          }
        },
        billing_state: {
          validators: {
            notEmpty: {
              message: 'State 1 is required'
            }
          }
        },
        billing_zip: {
          validators: {
            notEmpty: {
              message: 'Zip Code is required'
            },
            zipCode: {
              country: 'US',
              message: 'The Zip Code value is invalid'
            }
          }
        },
        billing_delivery: {
          validators: {
            choice: {
              min: 1,
              message: 'Please kindly select delivery type'
            }
          }
        },
        "package": {
          validators: {
            choice: {
              min: 1,
              message: 'Please kindly select package type'
            }
          }
        }
      },
      plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        // Validate fields when clicking the Submit button
        submitButton: new FormValidation.plugins.SubmitButton(),
        // Submit the form when all fields are valid
        defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
        // Bootstrap Framework Integration
        bootstrap: new FormValidation.plugins.Bootstrap({
          eleInvalidClass: '',
          eleValidClass: ''
        })
      }
    });
  };

  return {
    // public functions
    init: function init() {
      _initDemo1();

      _initDemo2();
    }
  };
}();

jQuery(document).ready(function () {
  KTFormControls.init();
});

/***/ }),

/***/ 59:
/*!**********************************************************************************!*\
  !*** multi ./resources/metronic/js/pages/crud/forms/validation/form-controls.js ***!
  \**********************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\wamp64\www\keenthemes\themes\metronic\theme\html_laravel\demo1\skeleton\resources\metronic\js\pages\crud\forms\validation\form-controls.js */"./resources/metronic/js/pages/crud/forms/validation/form-controls.js");


/***/ })

/******/ });