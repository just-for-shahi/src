"use strict";

// Class definition
var KTSweetAlert2Demo = function () {
	var _init = function () {
		// Sweetalert Demo 1
		$('#kt_sweetalert_demo_1').click(function (e) {
			Swal.fire('آفرین!');
		});

		// Sweetalert Demo 2
		$('#kt_sweetalert_demo_2').click(function (e) {
			Swal.fire("عنوان اینجا قرار میگیره", "و اینجا می تونید متن اصلی رو قرار بدید");
		});

		// Sweetalert Demo 3
		$('#kt_sweetalert_demo_3_1').click(function (e) {
			Swal.fire("آفرین!", "کلیک کنید روی دکمه!", "warning");
		});

		$('#kt_sweetalert_demo_3_2').click(function (e) {
			Swal.fire("آفرین!", "کلیک کنید روی دکمه!", "error");
		});

		$('#kt_sweetalert_demo_3_3').click(function (e) {
			Swal.fire("آفرین!", "کلیک کنید روی دکمه!", "success");
		});

		$('#kt_sweetalert_demo_3_4').click(function (e) {
			Swal.fire("آفرین!", "کلیک کنید روی دکمه!", "info");
		});

		$('#kt_sweetalert_demo_3_5').click(function (e) {
			Swal.fire("آفرین!", "کلیک کنید روی دکمه!", "question");
		});

		// Sweetalert Demo 4
		$("#kt_sweetalert_demo_4").click(function (e) {
			Swal.fire({
				title: "آفرین!",
				text: "کلیک کنید روی دکمه!",
				icon: "success",
				buttonsStyling: false,
				confirmButtonText: "تایید کنید!",
				customClass: {
					confirmButton: "btn btn-primary"
				}
			});
		});

		// Sweetalert Demo 5
		$("#kt_sweetalert_demo_5").click(function (e) {
			Swal.fire({
				title: "آفرین!",
				text: "کلیک کنید روی دکمه!",
				icon: "success",
				buttonsStyling: false,
				confirmButtonText: "<i class='la la-headphones'></i> من هستم!",
				showCancelButton: true,
				cancelButtonText: "<i class='la la-thumbs-down'></i>نه ممنون",
				customClass: {
					confirmButton: "btn btn-danger",
					cancelButton: "btn btn-default"
				}
			});
		});

		$('#kt_sweetalert_demo_6').click(function (e) {
			Swal.fire({
				position: 'top-right',
				icon: 'success',
				title: 'کار شما ذخیره شده است',
				showConfirmButton: false,
				timer: 1500
			});
		});

		$('#kt_sweetalert_demo_7').click(function (e) {
			Swal.fire({
				title: 'نمونه اچ تی ام ال',
				showClass: {
			    	popup: 'animate__animated animate__wobble'
			  	},
			  	hideClass: {
			    	popup: 'animate__animated animate__swing'
			  	}
		  	});
		});


		$('#kt_sweetalert_demo_8').click(function (e) {
			Swal.fire({
				title: 'آیا مطمئن هستید؟',
				text: "شما نمی توانید این را برگردانید!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'بله حذف کن'
			}).then(function (result) {
				if (result.value) {
					Swal.fire(
						'حذف شد!',
						'فایل شما با موفقیت حذف شد.',
						'success'
					)
				}
			});
		});


		$('#kt_sweetalert_demo_9').click(function (e) {
			Swal.fire({
				title: 'آیا مطمئن هستید؟',
				text: "شما نمی توانید این را برگردانید!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'بله حذف کن',
				cancelButtonText: 'نه کنسل کن',
				reverseButtons: true
			}).then(function (result) {
				if (result.value) {
					Swal.fire(
						'حذف شده!',
						'فایل شما حذف شد.',
						'success'
					)
					// result.dismiss can be 'cancel', 'overlay',
					// 'close', and 'timer'
				} else if (result.dismiss === 'cancel') {
					Swal.fire(
						'لغو شده',
						'فایل شما حذف نشد :)',
						'error'
					)
				}
			});
		});

		$('#kt_sweetalert_demo_10').click(function (e) {
			Swal.fire({
				title: 'اسویت!',
				text: 'با یک عکس سفارشی.',
				imageUrl: 'https://unsplash.it/400/200',
				imageWidth: 400,
				imageHeight: 200,
				imageAlt: 'Custom image',
				animation: false
			});
		});

		$('#kt_sweetalert_demo_11').click(function (e) {
			Swal.fire({
				title: 'بسته شدن خودکار!',
				text: 'بسته شدن در 5 ثانیه',
				timer: 5000,
				onOpen: function () {
					Swal.showLoading()
				}
			}).then(function (result) {
				if (result.dismiss === 'timer') {
					console.log('من بسته شدم توسط تایمر خودکار')
				}
			})
		});
	};

	return {
		// Init
		init: function () {
			_init();
		},
	};
}();

// Class Initialization
jQuery(document).ready(function () {
	KTSweetAlert2Demo.init();
});
