@extends('layouts.app')

@section('header')
	{!! trans('titles.exceeded') !!}
@endsection

@section('content')
<body class="hold-transition" style="margin: 2% auto">
	<div class="container">
		<div class="row">
			<div class="col-md-12 offset-md-1">
				<div class="card card-default">
					<div class="card-header">{!! trans('titles.exceeded') !!}</div>
					<div class="card-body">
						<p>
							{!! trans('auth.tooManyEmails', ['email' => $email, 'hours' => $hours]) !!}
						</p>
						<p><a href='/activate' class="btn btn-primary">Try Again</a></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
@endsection
