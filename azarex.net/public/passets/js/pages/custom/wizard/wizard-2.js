"use strict";

// Class definition
var KTWizard2 = function () {
	// Base elements
	var _wizardEl;
	var _formEl;
	var _wizard;
	var _validations = [];

	// Private functions
	var initWizard = function () {
		// Initialize form wizard
		_wizard = new KTWizard(_wizardEl, {
			startStep: 1, // initial active step number
			clickableSteps: false // to make steps clickable this set value true and add data-wizard-clickable="true" in HTML for class="wizard" element
		});

		// Validation before going to next page
		_wizard.on('beforeNext', function (wizard) {
			// Don't go to the next step yet
			_wizard.stop();

			// Validate form
			var validator = _validations[wizard.getStep() - 1]; // get validator for currnt step
			validator.validate().then(function (status) {
				if (status == 'Valid') {
					_wizard.goNext();
					KTUtil.scrollTop();
				} else {
					Swal.fire({
						text: "با عرض پوزش ، به نظر می رسد برخی از خطاها شناسایی شده اند ، لطفا دوباره امتحان کنید.",
						icon: "error",
						buttonsStyling: false,
						confirmButtonText: "باشه فهمیدم!",
						customClass: {
							confirmButton: "btn font-weight-bold btn-light"
						}
					}).then(function () {
						KTUtil.scrollTop();
					});
				}
			});
		});

		// Change event
		_wizard.on('change', function (wizard) {
			KTUtil.scrollTop();
		});
	}

	var initValidation = function () {
		// Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
		// Step 1
		_validations.push(FormValidation.formValidation(
			_formEl,
			{
				fields: {
					fname: {
						validators: {
							notEmpty: {
								message: "نام لازم است"
							}
						}
					},
					lname: {
						validators: {
							notEmpty: {
								message: "نام خانوادگی لازم است"
							}
						}
					},
					phone: {
						validators: {
							notEmpty: {
								message: "تلفن لازم است"
							}
						}
					},
					email: {
						validators: {
							notEmpty: {
								message: 'ایمیل لازم است'
							},
							emailAddress: {
								message: "مقدار یک آدرس ایمیل معتبر نیست"
							}
						}
					}
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					bootstrap: new FormValidation.plugins.Bootstrap()
				}
			}
		));

		// Step 2
		_validations.push(FormValidation.formValidation(
			_formEl,
			{
				fields: {
					address1: {
						validators: {
							notEmpty: {
								message: "آدرس لازم است"
							}
						}
					},
					postcode: {
						validators: {
							notEmpty: {
								message: "کدپستی لازم است"
							}
						}
					},
					city: {
						validators: {
							notEmpty: {
								message: "شهر مورد نیاز است"
							}
						}
					},
					state: {
						validators: {
							notEmpty: {
								message: "استان لازم است"
							}
						}
					},
					country: {
						validators: {
							notEmpty: {
								message: "کشور مورد نیاز است"
							}
						}
					}
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					bootstrap: new FormValidation.plugins.Bootstrap()
				}
			}
		));

		// Step 3
		_validations.push(FormValidation.formValidation(
			_formEl,
			{
				fields: {
					delivery: {
						validators: {
							notEmpty: {
								message: "نوع تحویل الزامی است"
							}
						}
					},
					packaging: {
						validators: {
							notEmpty: {
								message: 'نوع بسته بندی لازم است'
							}
						}
					},
					preferreddelivery: {
						validators: {
							notEmpty: {
								message: "نحوه ی تحویل لازم است"
							}
						}
					}
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					bootstrap: new FormValidation.plugins.Bootstrap()
				}
			}
		));

		// Step 4
		_validations.push(FormValidation.formValidation(
			_formEl,
			{
				fields: {
					locaddress1: {
						validators: {
							notEmpty: {
								message: "آدرس لازم است"
							}
						}
					},
					locpostcode: {
						validators: {
							notEmpty: {
								message: "کدپستی لازم است"
							}
						}
					},
					loccity: {
						validators: {
							notEmpty: {
								message: "شهر مورد نیاز است"
							}
						}
					},
					locstate: {
						validators: {
							notEmpty: {
								message: "استان لازم است"
							}
						}
					},
					loccountry: {
						validators: {
							notEmpty: {
								message: "کشور مورد نیاز است"
							}
						}
					}
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					bootstrap: new FormValidation.plugins.Bootstrap()
				}
			}
		));

		// Step 5
		_validations.push(FormValidation.formValidation(
			_formEl,
			{
				fields: {
					ccname: {
						validators: {
							notEmpty: {
								message: 'نام کارت اعتباری الزامی است'
							}
						}
					},
					ccnumber: {
						validators: {
							notEmpty: {
								message: "شماره کارت اعتباری لازم است"
							},
							creditCard: {
								message: "شماره کارت اعتباری معتبر نیست"
							}
						}
					},
					ccmonth: {
						validators: {
							notEmpty: {
								message: "ماه کارت اعتباری لازم است"
							}
						}
					},
					ccyear: {
						validators: {
							notEmpty: {
								message: "سال کارت اعتباری لازم است"
							}
						}
					},
					cccvv: {
						validators: {
							notEmpty: {
								message: "CVV کارت اعتباری لازم است"
							},
							digits: {
								message: "مقدار CVV معتبر نیست. فقط شماره مجاز است "
							}
						}
					}
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					bootstrap: new FormValidation.plugins.Bootstrap()
				}
			}
		));
	}

	return {
		// public functions
		init: function () {
			_wizardEl = KTUtil.getById('kt_wizard_v2');
			_formEl = KTUtil.getById('kt_form');

			initWizard();
			initValidation();
		}
	};
}();

jQuery(document).ready(function () {
	KTWizard2.init();
});
