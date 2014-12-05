@extends('_master')

@section('title')
	Log in
@stop

@section('content')

<h1>Log in</h1>

{{ Form::open(array('url' => '/login')) }}

    {{ Form::label('email') }}
	
	{{-- She added sam@gmail.com below just to make it easier for testing --}}
    {{ Form::text('email','sam@gmail.com') }}

	{{-- She added actual password "sam" below just to make it easier for testing --}}
    {{ Form::label('password') }} (sam)
    {{ Form::password('password') }}

    {{ Form::submit('Submit') }}

{{ Form::close() }}

@stop