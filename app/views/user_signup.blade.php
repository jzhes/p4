@extends('_master')

@section('title')
	Sign up
@stop

@section('content')

	<div class="mainContent">
	<h1 class="header">xmas giftr</h1>

		<h2 class="subhead">Sign Up</h2>

		@foreach($errors->all() as $message)
			<div class='error'>{{ $message }}</div>
		@endforeach

		{{ Form::open(array('url' => '/signup')) }}

			<div class='form-group'>
				{{ Form::label('email') }}
				{{ Form::text('email') }}<br><br>
			</div>
				
			<div class='form-group'>
				{{ Form::label('name') }}
				{{ Form::text('name') }}<br><br>
			</div>

			<div class='form-group'>
				{{ Form::label('password') }}
				{{ Form::password('password') }}
				<p class="pswd">(Minimum 6 characters)</p>
			</div>

			<div class='form-group'>
				{{ Form::submit('Submit') }}
			</div>

		{{ Form::close() }}
		
	</div>
	
@stop