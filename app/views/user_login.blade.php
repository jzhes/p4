@extends('_master')

@section('title')
	Log in
@stop

@section('content')

	<div class="mainContent">
	<h1 class="header">xmas giftr</h1>


			<h2 class="subhead">Log in</h2>

			@foreach($errors->all() as $message)
				<div class='error'>{{ $message }}</div>
			@endforeach

			{{ Form::open(array('url' => '/login')) }}

				<div class='form-group'>
					{{ Form::label('email:') }}
					{{ Form::text('email') }}
				</div>
				
				<div class='form-group'>
					{{ Form::label('password:') }} 
					{{ Form::password('password') }}
				</div>

				<div class='form-group'>
					{{ Form::submit('Submit') }}
				</div>

			{{ Form::close() }}

	</div>
	
@stop