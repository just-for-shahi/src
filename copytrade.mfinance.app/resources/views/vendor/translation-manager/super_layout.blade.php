<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Translation Manager</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
	<style>
		a.status-1 {
			font-weight: bold;
		}

		.editable-click {
			border-bottom-color: red;
			cursor: pointer;
		}

        .alert { margin: 0; }
        a.editable:hover { color: #f37160; }

        .editableform .control-group {
        	display: block;
        }

        .editable-input {
        	display: block;
        }

        .editable-buttons {
        	margin: 10px 0;
        	float: right;
        }

        .editable-buttons .editable-submit {
        	float: right;
        	margin-left: 10px;
        }

        .editable-locale-empty, 
        .editable-locale-empty:hover, 
        .editable-locale-empty:focus {
            color: #dd1144;
            font-style: italic;
            text-decoration: none;
        }

        .glyphicon.glyphicon-spinner {
		    -webkit-animation: glyphicon-spin-r 1s infinite linear;
		    animation: glyphicon-spin-r 1s infinite linear;
		}

		@-webkit-keyframes glyphicon-spin-r {
		    0% {
		        -webkit-transform: rotate(0deg);
		        transform: rotate(0deg);
		    }

		    100% {
		        -webkit-transform: rotate(359deg);
		        transform: rotate(359deg);
		    }
		}

		.table td,
		.table th {
			vertical-align: middle;
		}

		.table .btn-danger {
			padding: 3px 5px;
		}
	</style>
	@yield('css')
</head>
<body>

	@yield('content')

	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" 
		integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
	<script>
		window.Laravel = @php
			echo json_encode([
				'csrfToken' => csrf_token(),
				'urls' => [
					'index' => route('translation-manager.index'),
					'view' => route('translation-manager.view'),
				],
		]);
		@endphp;
	</script>
	<script>
		jQuery(document).ready(function($) {

			$.ajaxSetup({
			    headers: {
			        'X-CSRF-Token': window.Laravel.csrfToken
			    }
			});

			$('.editable').editable().on('hidden', function(e, reason) {
				var locale = $(this).data('locale');
				if(reason === 'save'){
					$(this).removeClass('status-0').addClass('status-1');
				}
				if(reason === 'save' || reason === 'nochange') {
					var $next = $(this).closest('tr').next().find('.editable.locale-' + locale);
					setTimeout(function() {
						$next.editable('show');
					}, 300);
				}
			});

			$('.group-select').on('change', function() {
				var group = $(this).val();
				if (group) {
					window.location.href = window.Laravel.urls.view + '/' + $(this).val();
				} else {
					window.location.href = window.Laravel.urls.index;
				}
			});

			$('a.delete-key').click(function(event) {
				event.preventDefault();

				var $this = $(this);
				var result = window.confirm($this.data('confirm'));
				if(result == false)
					return;

				var $row = $this.closest('tr');
				$.post($this.data('url'), {
					id: $row.attr('id')
				}, function() {
					var parent = $row.data('parent');
					$row.remove();
					if($('.table tr[data-parent="' + parent + '"]').length == 0)
						$('.table tr.empty[data-base="' + parent + '"]').remove();
				});
			});

			$('.form-import a').on('click', function(e) {
				e.preventDefault();

				var $form = $(this).closest('form');
				handleRequest(
					$form, 
					$form.find('button'), 
					{		
						replace: $(this).data('option')
					},
					function() {
						if($('.c-translation-module__file').length == 0) {
							window.location.reload();
						}
					}
				);
			});

			$('.form-export button').on('click', function(e) {
				e.preventDefault();

				var $btn = $(this);
				handleRequest(
					$btn.closest('form'), 
					$btn, 
					{		
						replace: $(this).data('option')
					},
					function() {
						if($('.c-translation-module__file.highlight').length > 0) {
							window.location.reload();
						}
					}
				);
			});

			$('.form-clean a').on('click', function(e) {
				e.preventDefault();

				var $form = $(this).closest('form');
				var resetOption = $(this).data('option');
				handleRequest(
					$form, 
					$form.find('button'), 
					{		
						reset: resetOption
					},
					function() {
						if(resetOption == 1) {
							if($('.c-translation-module__back').length > 0) {
								window.location.href = $('.c-translation-module__back').attr('href');
							} else {
								window.location.reload();
							}
						}
					}
				);
			});

			$('.form-search button').on('click', function(e) {
				e.preventDefault();

				var $btn = $(this);
				handleRequest(
					$btn.closest('form'), 
					$btn, 
					{},
					function() {
						if($('.c-translation-module__file.active').length > 0) {
							window.location.reload();
						}
					}
				);
			});

			$('.form-publish button').on('click', function(e) {
				e.preventDefault();

				var $btn = $(this);
				handleRequest(
					$btn.closest('form'), 
					$btn, 
					{},
					function() {
						$('.table .editable.status-1')
							.removeClass('status-1')
							.addClass('status-0');
					}
				);
			});

			$('.form-add button').on('click', function(e) {
				e.preventDefault();

				var $btn = $(this);
				var $form = $btn.closest('form');
				handleRequest(
					$form, 
					$btn, 
					{
						keys: $form.find(':input[name="keys"]').val()
					},
					function() {
						window.location.reload();
					}
				);
			});

			function handleRequest($form, $btn, data, callback) {
				$btn.data('content', $btn.html())
					.html('<i class="glyphicon glyphicon-refresh glyphicon-spinner"></i>');
				$.post($form.attr('action'), data, function() {
					$btn.addClass('btn-success').html('<i class="glyphicon glyphicon-ok"></i>');
					setTimeout(function() {
						$btn.removeClass('btn-success').html($btn.data('content'));
					}, 1500);
					if(callback != undefined)
						callback();
				});
			}
		});
	</script>
</body>
</html>
