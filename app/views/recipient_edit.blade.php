@extends('_master')

@section('title')
	Edit
@stop

@section('head')

@stop

@section('content')

	<div class="mainContent">

		<h2>Edit Recipient:	 {{{ $recipient['name'] }}} </h2>

		@foreach($errors->all() as $message)
			<div class='error'>{{ $message }}</div>
		@endforeach

		{{---- EDIT -----}}
		{{ Form::open(array('url' => 'gift/recipient/edit')) }}

			{{ Form::hidden('id', $recipient['id']); }}
			
			<div class='form-group'>
				{{ Form::label('address_line_1','Address Line 1') }}
				{{ Form::text('address_line_1',$recipient['address_line_1']) }}
			</div>

			<div class='form-group'>
				{{ Form::label('address_line_2','Address Line 2') }}
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

	</div>	
		
@stop