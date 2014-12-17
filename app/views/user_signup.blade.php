@extends('_master')

@section('title')
	Sign up
@stop

@section('content')

<h2>Sign up</h2>

@foreach($errors->all() as $message)
	<div class='error'>{{ $message }}</div>
@endforeach

{{ Form::open(array('url' => '/signup')) }}

    {{ Form::label('Email') }}
    {{ Form::text('email') }}<br><br>

    {{ Form::label('Name') }}
    {{ Form::text('name') }}<br><br>

    {{ Form::label('Password') }}
    {{ Form::password('password') }}<br><br>
    Minimum 6 characters

    {{ Form::submit('Submit') }}

{{ Form::close() }}
@stop