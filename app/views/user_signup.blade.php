@extends('_master')

@section('title')
	Sign up
@stop

@section('content')
<h1>Sign up</h1>

@foreach($errors->all() as $message)
	<div class='error'>{{ $message }}</div>
@endforeach

{{ Form::open(array('url' => '/signup')) }}

    {{ Form::label('Email') }}
    {{ Form::text('email') }}<br><br>

    {{ Form::label('First Name') }}
    {{ Form::text('firstname') }}<br><br>

    {{ Form::label('Last Name') }}
    {{ Form::text('lastname') }}<br><br>
	
	{{-- FILL IN HERE --}}

    {{ Form::label('Password') }}
    {{ Form::password('password') }}<br><br>
    <small>Min 6 characters</small>

    {{ Form::submit('Submit') }}

{{ Form::close() }}
@stop