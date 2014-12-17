@extends('_master')

@section('title')
	Log in
@stop

@section('content')

<h1>Log in</h1>

	@foreach($errors->all() as $message)
		<div class='error'>{{ $message }}</div>
	@endforeach

	{{ Form::open(array('url' => '/login')) }}

		{{ Form::label('email') }}
		
		{{-- REMOVE BELOW BEFORE FINAL --}}
		{{ Form::text('email','test@test.com') }}

		{{-- REMOVE BELOW BEFORE FINAL --}}
		{{ Form::label('password') }} (testtest)
		{{ Form::password('password') }}

		{{ Form::submit('Submit') }}

	{{ Form::close() }}

@stop