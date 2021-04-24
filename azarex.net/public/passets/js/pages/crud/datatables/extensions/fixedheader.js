"use strict";
var KTDatatablesExtensionsFixedheader = function() {

	var initTable1 = function() {
		var table = $('#kt_table_1');

		// begin first table
		table.DataTable({
			responsive: true,
			fixedHeader: {
				header: true,
				headerOffset: $('#kt_header').height(),
			},
			paging: false,
			columnDefs: [
				{
					targets: -1,
					title: 'عملیات',
					orderable: false,
					render: function(data, type, full, meta) {
						return `
                        <span class="dropdown">
                            <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown" aria-expanded="true">
                              <i class="la la-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>
                                <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>
                                <a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>
                            </div>
                        </span>
                        <a href="#" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="View">
                          <i class="la la-edit"></i>
                        </a>`;
					},
				},
				{
					width: '75px',
					targets: 8,
					render: function(data, type, full, meta) {
						var status = {
							1: {'title': 'در حال انجام', 'class': 'label-primary'},
							2: {'title': 'تحویل داده شده', 'class': ' label-danger'},
							3: {'title': 'لغو شده', 'class': ' label-primary'},
							4: {'title': 'موفق', 'class': ' label-success'},
							5: {'title': 'اطلاعات', 'class': ' label-info'},
							6: {'title': 'خطار', 'class': ' label-danger'},
							7: {'title': 'هشدار', 'class': ' label-warning'},
						};
						if (typeof status[data] === 'undefined') {
							return data;
						}
						return '<span class="label ' + status[data].class + ' label-inline label-pill">' + status[data].title + '</span>';
					},
				},
				{
					width: '75px',
					targets: 9,
					render: function(data, type, full, meta) {
						var status = {
							1: {'title': 'برخط', 'state': 'danger'},
							2: {'title': 'خرده فروشی', 'state': 'primary'},
							3: {'title': 'مستقیم', 'state': 'success'},
						};
						if (typeof status[data] === 'undefined') {
							return data;
						}
						return '<span class="label label-' + status[data].state + ' label-dot"></span>&nbsp;' +
							'<span class="font-weight-bold text-' + status[data].state + '">' + status[data].title + '</span>';
					},
				},
			],
		});

	};

	return {

		//main function to initiate the module
		init: function() {
			initTable1();
		},

	};

}();

jQuery(document).ready(function() {
	KTDatatablesExtensionsFixedheader.init();
});
