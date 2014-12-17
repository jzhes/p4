@extends('_master')

@section('title')
	Edit
@stop

@section('head')

@stop

@section('content')

	<h1>Edit</h1>

	@foreach($errors->all() as $message)
		<div class='error'>{{ $message }}</div>
	@endforeach
			{{ Form::TEXT('id', $recipient['id']); }}

	<h2>{{{ $recipient['name'] }}}</h2> 

	{{---- EDIT -----}}
	{{ Form::open(array('url' => 'gift/recipient/edit')) }}

		{{ Form::hidden('id', $recipient['id']); }}
		
		<div class='form-group'>
			{{ Form::label('address_line_1','Address Line 1') }}
			{{ Form::text('address_line_1',$recipient['address_line_1']) }}
		</div>

		<div class='form-group'>
			{{ Form::label('address_line_2','name Line 2') }}
			{{ Form::text('address_line_2',$recipient['address_line_2']) }}
		</div>

		<div class='form-group'>
			{{ Form::label('city','City') }}
			{{ Form::text('city',$recipient['city']) }}
		</div>

		<div class='form-group'>
			{{ Form::label('state','State') }}
			{{ Form::text('state',$recipient['state']) }}
		</div>

		<div class='form-group'>
			{{ Form::label('zip','Zip') }}
			{{ Form::text('zip',$recipient['zip']) }}
		</div>

		<div class='form-group'>
			{{ Form::label('ext_zip','Extension Zip') }}
			{{ Form::text('ext_zip',$recipient['ext_zip']) }}
		</div>

		{{ Form::submit('Save'); }}

	{{ Form::close() }}

@stop