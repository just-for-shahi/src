"use strict";
var KTDatatablesExtensionButtons = function() {

	var initTable1 = function() {

		// begin first table
		var table = $('#kt_datatable1').DataTable({
			responsive: true,
			// Pagination settings
			dom: `<'row'<'col-sm-6 text-left'f><'col-sm-6 text-right'B>>
			<'row'<'col-sm-12'tr>>
			<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,

			buttons: [
				'print',
				'copyHtml5',
				'excelHtml5',
				'csvHtml5',
				'pdfHtml5',
			],
			columnDefs: [
				{
					width: '75px',
					targets: 6,
					render: function(data, type, full, meta) {
						var status = {
							1: {'title': 'در حال انجام', 'class': 'label-light-primary'},
							2: {'title': 'تحویل داده شده', 'class': ' label-light-danger'},
							3: {'title': 'لغو شده', 'class': ' label-light-primary'},
							4: {'title': 'موفق', 'class': ' label-light-success'},
							5: {'title': 'اطلاعات', 'class': ' label-light-info'},
							6: {'title': 'خطار', 'class': ' label-light-danger'},
							7: {'title': 'هشدار', 'class': ' label-light-warning'},
						};
						if (typeof status[data] === 'undefined') {
							return data;
						}
						return '<span class="label label-lg font-weight-bold' + status[data].class + ' label-inline">' + status[data].title + '</span>';
					},
				},
				{
					width: '75px',
					targets: 7,
					render: function(data, type, full, meta) {
						var status = {
							1: {'title': 'برخط', 'state': 'danger'},
							2: {'title': 'خرده فروشی', 'state': 'primary'},
							3: {'title': 'مستقیم', 'state': 'success'},
						};
						if (typeof status[data] === 'undefined') {
							return data;
						}
						return '<span class="label label-' + status[data].state + ' label-dot mr-2"></span>' +
							'<span class="font-weight-bold text-' + status[data].state + '">' + status[data].title + '</span>';
					},
				},
			],
		});

	};

	var initTable2 = function() {

		// begin first table
		var table = $('#kt_datatable2').DataTable({
			responsive: true,

			buttons: [
				'print',
				'copyHtml5',
				'excelHtml5',
				'csvHtml5',
				'pdfHtml5',
			],
			processing: true,
			serverSide: true,
			ajax: {
				url: HOST_URL + '/api/datatables/demos/server.php',
				type: 'POST',
				data: {
					// parameters for custom backend script demo
					columnsDef: [
						'OrderID', 'Country',
						'ShipCity', 'ShipAddress', 'CompanyAgent', 'CompanyName',
						'Status', 'Type'],
				},
			},
			columns: [
				{data: 'OrderID'},
				{data: 'Country'},
				{data: 'ShipCity'},
				{data: 'ShipAddress'},
				{data: 'CompanyAgent'},
				{data: 'CompanyName'},
				{data: 'Status'},
				{data: 'Type'},
			],
			columnDefs: [
				{
					targets: 6,
					render: function(data, type, full, meta) {
						var status = {
							1: {'title': 'در حال انجام', 'class': 'label-light-primary'},
							2: {'title': 'تحویل داده شده', 'class': ' label-light-danger'},
							3: {'title': 'لغو شده', 'class': ' label-light-primary'},
							4: {'title': 'موفق', 'class': ' label-light-success'},
							5: {'title': 'اطلاعات', 'class': ' label-light-info'},
							6: {'title': 'خطار', 'class': ' label-light-danger'},
							7: {'title': 'هشدار', 'class': ' label-light-warning'},
						};
						if (typeof status[data] === 'undefined') {
							return data;
						}
						return '<span class="label label-lg font-weight-bold' + status[data].class + ' label-inline">' + status[data].title + '</span>';
					},
				},
				{
					targets: 7,
					render: function(data, type, full, meta) {
						var status = {
							1: {'title': 'برخط', 'state': 'danger'},
							2: {'title': 'خرده فروشی', 'state': 'primary'},
							3: {'title': 'مستقیم', 'state': 'success'},
						};
						if (typeof status[data] === 'undefined') {
							return data;
						}
						return '<span class="label label-' + status[data].state + ' label-dot mr-2"></span>' +
							'<span class="font-weight-bold text-' + status[data].state + '">' + status[data].title + '</span>';
					},
				},
			],
		});

		$('#export_print').on('click', function(e) {
			e.preventDefault();
			table.button(0).trigger();
		});

		$('#export_copy').on('click', function(e) {
			e.preventDefault();
			table.button(1).trigger();
		});

		$('#export_excel').on('click', function(e) {
			e.preventDefault();
			table.button(2).trigger();
		});

		$('#export_csv').on('click', function(e) {
			e.preventDefault();
			table.button(3).trigger();
		});

		$('#export_pdf').on('click', function(e) {
			e.preventDefault();
			table.button(4).trigger();
		});

	};

	return {

		//main function to initiate the module
		init: function() {
			initTable1();
			initTable2();
		},

	};

}();

jQuery(document).ready(function() {
	KTDatatablesExtensionButtons.init();
});
