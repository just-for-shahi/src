"use strict";

// Class definition
var KTWizard6 = function () {
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
			clickableSteps: true  // allow step clicking
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
					firstname: {
						validators: {
							notEmpty: {
								message: "نام لازم است"
							}
						}
					},
					lastname: {
						validators: {
							notEmpty: {
								message: 'نام خانوادگی را وارد کنید'
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
					address2: {
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
	}

	return {
		// public functions
		init: function () {
			_wizardEl = KTUtil.getById('kt_wizard');
			_formEl = KTUtil.getById('kt_wizard_form');

			initWizard();
			initValidation();
		}
	};
}();

jQuery(document).ready(function () {
	KTWizard6.init();
});
