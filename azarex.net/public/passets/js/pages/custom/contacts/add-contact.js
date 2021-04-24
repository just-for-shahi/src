"use strict";

// Class definition
var KTContactsAdd = function () {
	// Base elements
	var _wizardEl;
	var _formEl;
	var _wizard;
	var _avatar;
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
						text: "متأسفیم ، به نظر می رسد برخی از خطاها شناسایی شده اند ، لطفاً دوباره امتحان کنید.",
						icon: "error",
						buttonsStyling: false,
						confirmButtonText: "متوجه شدم",
						customClass: {
							confirmButton: "btn font-weight-bold btn-light"
						}
					}).then(function () {
						KTUtil.scrollTop();
					});
				}
			});
		});

		// Change Event
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
								message: 'وارد کردن نام اجباری است'
							}
						}
					},
					lastname: {
						validators: {
							notEmpty: {
								message: 'وارد کردن نام خانوادگی اجباری است'
							}
						}
					},
					companyname: {
						validators: {
							notEmpty: {
								message: 'وارد کردن نام شرکت اجباری است'
							}
						}
					},
					phone: {
						validators: {
							notEmpty: {
								message: 'وارد کردن تلفن اجباری است'
							},
							phone: {
								country: 'US',
								message: 'این شماره تلفن معتبر ایالات متحده نیست. (e.g 5554443333)'
							}
						}
					},
					email: {
						validators: {
							notEmpty: {
								message: 'ایمیل لازم است'
							},
							emailAddress: {
								message: 'ایمیل وارد شده معتبر نمی باشد'
							}
						}
					},
					companywebsite: {
						validators: {
							notEmpty: {
								message: 'وب سایت وارد شده معتبر نمی باشد'
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
					// Step 2
					communication: {
						validators: {
							choice: {
								min: 1,
								message: 'لطفا یک گزینه را انتخاب کنید'
							}
						}
					},
					language: {
						validators: {
							notEmpty: {
								message: 'لطفا زبان  را انتخاب کنید'
							}
						}
					},
					timezone: {
						validators: {
							notEmpty: {
								message: 'لطفا وقت محلی را انتخاب کنید'
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
					address1: {
						validators: {
							notEmpty: {
								message: 'وارد کردن آدرس اجباری است'
							}
						}
					},
					postcode: {
						validators: {
							notEmpty: {
								message: 'وارد کردن کد پستی اجباری است'
							}
						}
					},
					city: {
						validators: {
							notEmpty: {
								message: 'وارد کردن شهر اجباری است'
							}
						}
					},
					state: {
						validators: {
							notEmpty: {
								message: 'وارد کردن استان اجباری است'
							}
						}
					},
					country: {
						validators: {
							notEmpty: {
								message: 'وارد کردن کشور اجباری است'
							}
						}
					},
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					bootstrap: new FormValidation.plugins.Bootstrap()
				}
			}
		));
	}

	var initAvatar = function () {
		_avatar = new KTImageInput('kt_contact_add_avatar');
	}

	return {
		// public functions
		init: function () {
			_wizardEl = KTUtil.getById('kt_contact_add');
			_formEl = KTUtil.getById('kt_contact_add_form');

			initWizard();
			initValidation();
			initAvatar();
		}
	};
}();

jQuery(document).ready(function () {
	KTContactsAdd.init();
});
