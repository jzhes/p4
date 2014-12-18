@extends('_master')

@section('title')
	Log in
@stop

@section('content')

	<div class="mainContent">
	<h1 class="header">xmas giftr</h1>

			<h2 class="subhead">Log in</h2>

			@if ((Session::get('flash_message')))
				<div class='flash-message'>{{ Session::get('flash_message') }}</div>
			@endif

			@foreach($errors->all() as $message)
				<div class='error'>{{ $message }}</div>
			@endforeach

			{{ Form::open(array('url' => '/login')) }}

				<div class='form-group'>
					{{ Form::label('email') }}
					{{ Form::text('email', '', array('size'=>'25')) }}
				</div>
				
				<div class='form-group'>
					{{ Form::label('password') }} 
					{{ Form::password('password') }}
				</div>

				<div class='form-group'>
					{{ Form::submit('Submit') }}
				</div>

			{{ Form::close() }}

	</div>
	
@stop