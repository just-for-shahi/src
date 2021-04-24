// Class definition
var KTFormControls = function () {
	// Private functions
	var _initDemo1 = function () {
		FormValidation.formValidation(
			document.getElementById('kt_form_1'),
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
					},

					url: {
						validators: {
							notEmpty: {
								message: 'آدرس وب سایت لازم است'
							},
							uri: {
								message: "آدرس وب سایت معتبر نیست"
							}
						}
					},

					digits: {
						validators: {
							notEmpty: {
								message: 'ارقام لازم است'
							},
							digits: {
								message: "مقدار یک رقم معتبر نیست"
							}
						}
					},

					creditcard: {
						validators: {
							notEmpty: {
								message: "شماره کارت اعتباری لازم است"
							},
							creditCard: {
								message: "شماره کارت اعتباری معتبر نیست"
							}
						}
					},

					phone: {
						validators: {
							notEmpty: {
								message: 'شماره تلفن ایالات متحده مورد نیاز است'
							},
							phone: {
								country: 'US',
								message: "این مقدار شماره تلفن معتبر ایالات متحده نیست"
							}
						}
					},

					option: {
						validators: {
							notEmpty: {
								message: 'لطفا یک گزینه را انتخاب کنید'
							}
						}
					},

					options: {
						validators: {
							choice: {
								min:2,
								max:5,
								message: "لطفا حداقل 2 و حداکثر 5 گزینه را انتخاب کنید"
							}
						}
					},

					memo: {
						validators: {
							notEmpty: {
								message: "لطفا متن یادداشت را وارد کنید"
							},
							stringLength: {
								min:50,
								max:100,
								message: "لطفاً یک فهرست را در محدوده متن 50 و 100 وارد کنید"
							}
						}
					},

					checkbox: {
						validators: {
							choice: {
								min:1,
								message: "لطفا با مهربانی این را بررسی کنید"
							}
						}
					},

					checkboxes: {
						validators: {
							choice: {
								min:2,
								max:5,
								message: "لطفا حداقل 1 و حداکثر 2 گزینه را بررسی کنید"
							}
						}
					},

					radios: {
						validators: {
							choice: {
								min:1,
								message: "لطفا با مهربانی این را بررسی کنید"
							}
						}
					},
				},

				plugins: { //Learn more: https://formvalidation.io/guide/plugins
					trigger: new FormValidation.plugins.Trigger(),
					// Bootstrap Framework Integration
					bootstrap: new FormValidation.plugins.Bootstrap(),
					// Validate fields when clicking the Submit button
					submitButton: new FormValidation.plugins.SubmitButton(),
            		// Submit the form when all fields are valid
            		defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
				}
			}
		);
	}

	var _initDemo2 = function () {
		FormValidation.formValidation(
			document.getElementById('kt_form_2'),
			{
				fields: {
					billing_card_name: {
						validators: {
							notEmpty: {
								message: "نام دارنده کارت لازم است"
							}
						}
					},
					billing_card_number: {
						validators: {
							notEmpty: {
								message: "شماره کارت اعتباری لازم است"
							},
							creditCard: {
								message: "شماره کارت اعتباری معتبر نیست"
							}
						}
					},
					billing_card_exp_month: {
						validators: {
							notEmpty: {
								message: "ماه انقضا لازم است"
							}
						}
					},
					billing_card_exp_year: {
						validators: {
							notEmpty: {
								message: "سال انقضا لازم است"
							}
						}
					},
					billing_card_cvv: {
						validators: {
							notEmpty: {
								message: "CVV لازم است"
							},
							digits: {
								message: 'مقدار CVV یک رقم معتبر نیست'
							}
						}
					},

					billing_address_1: {
						validators: {
							notEmpty: {
								message: 'آدرس 1 الزامی است'
							}
						}
					},
					billing_city: {
						validators: {
							notEmpty: {
								message: 'شهر 1 مورد نیاز است'
							}
						}
					},
					billing_state: {
						validators: {
							notEmpty: {
								message: "حالت 1 لازم است"
							}
						}
					},
					billing_zip: {
						validators: {
							notEmpty: {
								message: 'کد پستی لازم است'
							},
							zipCode: {
								country: 'US',
								message: "مقدار کد پستی نامعتبر است"
							}
						}
					},

					billing_delivery: {
						validators: {
							choice: {
								min:1,
								message: 'لطفا نوع تحویل را لطفاً انتخاب کنید'
							}
						}
					},
					package: {
						validators: {
							choice: {
								min:1,
								message: "لطفاً نوع بسته را انتخاب کنید"
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
						eleValidClass: '',
					})
				}
			}
		);
	}

	return {
		// public functions
		init: function() {
			_initDemo1();
			_initDemo2();
		}
	};
}();

jQuery(document).ready(function() {
	KTFormControls.init();
});
