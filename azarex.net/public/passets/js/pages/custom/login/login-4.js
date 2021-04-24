"use strict";

// Class Definition
var KTLogin = function() {
	var _buttonSpinnerClasses = 'spinner spinner-right spinner-white pr-15';

	var _handleFormSignin = function() {
		var form = KTUtil.getById('kt_login_singin_form');
		var formSubmitUrl = KTUtil.attr(form, 'action');
		var formSubmitButton = KTUtil.getById('kt_login_singin_form_submit_button');

		if (!form) {
			return;
		}

		FormValidation
		    .formValidation(
		        form,
		        {
		            fields: {
						email: {
							validators: {
								notEmpty: {
									message: 'وارد کردن ایمیل اجباری است'
								}
							}
						},
						password: {
							validators: {
								notEmpty: {
									message: 'وارد کردن رمزعبور اجباری است'
								}
							}
						}
		            },
		            plugins: {
						trigger: new FormValidation.plugins.Trigger(),
						submitButton: new FormValidation.plugins.SubmitButton(),
	            		defaultSubmit: new FormValidation.plugins.DefaultSubmit(), // Uncomment this line to enable normal button submit after form validation
						bootstrap: new FormValidation.plugins.Bootstrap({
						//	eleInvalidClass: '', // Repace with uncomment to hide bootstrap validation icons
						//	eleValidClass: '',   // Repace with uncomment to hide bootstrap validation icons
						})
		            }
		        }
		    )
		    .on('core.form.valid', function() {
				// Show loading state on button
				KTUtil.btnWait(formSubmitButton, _buttonSpinnerClasses, "لطفا صبر کنید");

				// Form Validation & Ajax Submission: https://formvalidation.io/guide/examples/using-ajax-to-submit-the-form
				/**
		        FormValidation.utils.fetch(formSubmitUrl, {
		            method: 'POST',
					dataType: 'json',
		            params: {
		                name: form.querySelector('[name="username"]').value,
		                email: form.querySelector('[name="password"]').value,
		            },
		        }).then(function(response) { // Return valid JSON
					// Release button
					KTUtil.btnRelease(formSubmitButton);

					if (response && typeof response === 'object' && response.status && response.status == 'success') {
						Swal.fire({
			                text: "همه چیز جالب است! اکنون این فرم را ارسال می کنید",
			                icon: "success",
			                buttonsStyling: false,
							confirmButtonText: "باشه فهمیدم!",
							customClass: {
								confirmButton: "btn font-weight-bold btn-light-primary"
							}
			            }).then(function() {
							KTUtil.scrollTop();
						});
					} else {
						Swal.fire({
			                text: "ببخشید ، مشکلی پیش آمد ، لطفاً دوباره امتحان کنید.",
			                icon: "error",
			                buttonsStyling: false,
							confirmButtonText: "باشه فهمیدم!",
							customClass: {
								confirmButton: "btn font-weight-bold btn-light-primary"
							}
			            }).then(function() {
							KTUtil.scrollTop();
						});
					}
		        });
				**/
		    })
			.on('core.form.invalid', function() {
				Swal.fire({
					text: "با عرض پوزش ، به نظر می رسد برخی از خطاها شناسایی شده اند ، لطفا دوباره امتحان کنید.",
					icon: "error",
					buttonsStyling: false,
					confirmButtonText: "باشه فهمیدم!",
					customClass: {
						confirmButton: "btn font-weight-bold btn-light-primary"
					}
				}).then(function() {
					KTUtil.scrollTop();
				});
		    });
    }

	var _handleFormForgot = function() {
		var form = KTUtil.getById('kt_login_forgot_form');
		var formSubmitUrl = KTUtil.attr(form, 'action');
		var formSubmitButton = KTUtil.getById('kt_login_forgot_form_submit_button');

		if (!form) {
			return;
		}

		FormValidation
		    .formValidation(
		        form,
		        {
		            fields: {
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
						submitButton: new FormValidation.plugins.SubmitButton(),
	            		defaultSubmit: new FormValidation.plugins.DefaultSubmit(), // Uncomment this line to enable normal button submit after form validation
						bootstrap: new FormValidation.plugins.Bootstrap({
						//	eleInvalidClass: '', // Repace with uncomment to hide bootstrap validation icons
						//	eleValidClass: '',   // Repace with uncomment to hide bootstrap validation icons
						})
		            }
		        }
		    )
		    .on('core.form.valid', function() {
				// Show loading state on button
				KTUtil.btnWait(formSubmitButton, _buttonSpinnerClasses, "لطفا صبر کنید");
		    })
			.on('core.form.invalid', function() {
				Swal.fire({
					text: "با عرض پوزش ، به نظر می رسد برخی از خطاها شناسایی شده اند ، لطفا دوباره امتحان کنید.",
					icon: "error",
					buttonsStyling: false,
					confirmButtonText: "باشه فهمیدم!",
					customClass: {
						confirmButton: "btn font-weight-bold btn-light-primary"
					}
				}).then(function() {
					KTUtil.scrollTop();
				});
		    });
    }

	var _handleFormSignup = function() {
		// Base elements
		var wizardEl = KTUtil.getById('kt_login');
		var form = KTUtil.getById('kt_login_signup_form');
		var wizardObj;
		var validations = [];

		if (!form) {
			return;
		}

		// Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
		// Step 1
		validations.push(FormValidation.formValidation(
			form,
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
		validations.push(FormValidation.formValidation(
			form,
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


		// Initialize form wizard
		wizardObj = new KTWizard(wizardEl, {
			startStep: 1, // initial active step number
			clickableSteps: false // to make steps clickable this set value true and add data-wizard-clickable="true" in HTML for class="wizard" element
		});

		// Validation before going to next page
		wizardObj.on('beforeNext', function (wizard) {
			validations[wizard.getStep() - 1].validate().then(function (status) {
				if (status == 'Valid') {
					wizardObj.goNext();
					KTUtil.scrollTop();
				} else {
					Swal.fire({
						text: "با عرض پوزش ، به نظر می رسد برخی از خطاها شناسایی شده اند ، لطفا دوباره امتحان کنید.",
						icon: "error",
						buttonsStyling: false,
						confirmButtonText: "باشه فهمیدم!",
						customClass: {
							confirmButton: "btn font-weight-bold btn-light-primary"
						}
					}).then(function () {
						KTUtil.scrollTop();
					});
				}
			});

			wizardObj.stop();  // Don't go to the next step
		});

		// Change event
		wizardObj.on('change', function (wizard) {
			KTUtil.scrollTop();
		});
    }

    // Public Functions
    return {
        init: function() {
            _handleFormSignin();
			_handleFormForgot();
			_handleFormSignup();
        }
    };
}();

// Class Initialization
jQuery(document).ready(function() {
    KTLogin.init();
});
