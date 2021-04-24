@extends('translation-manager::super_layout')

@section('css')
<style>

	.c-translation-module {
		padding-top: 15px;
	}

	.c-translation-module__menu {
		margin-left: 0;
		padding-left: 10px;
	}

	.c-translation-module__file {
		list-style: none;
	}

	.c-translation-module__file a {
		color: black;
		padding: 10px;
		display: block;
	}

	.c-translation-module__file a:hover {
		color: black;
		text-decoration: none;
		background: #eee;
	}

	.c-translation-module__file.highlight a {
		color: navy;
		font-weight: bold;
	}

	.c-translation-module__file.active a {
		color: green;
	}

	.c-translation-module__file a[nohref] {
		color: #c6c6c6;
	}

	.c-translation-module__file a[nohref]:hover {
		background: transparent;
	}
</style>
@endsection

@section('content')

<div class="c-translation-module">
	<nav class="col-xs-12 col-sm-3">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h5>{{ trans('translation-manager::panel.welcome.availableFiles') }}</h5>
			</div>
			<div class="panel-body">
				@include('translation-manager::files_list', ['groups' => $groups, 'indent' => 0])
			</div>
   			@if($canManage)
				<div class="panel-footer">
					@include('translation-manager::menu_actions')
				</div>
			@endif
		</div>                 
	</nav>
	<section class="col-xs-12 col-sm-9">
		@include('translation-manager::index_manage')
	</section>
	<div class="clearfix"></div>
</div>

@endsection