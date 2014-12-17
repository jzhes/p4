@extends('_master')

@section('title')
	Add a new recipient
@stop

@section('content')

		<h2>Add a new recipient</h2>

		@foreach($errors->all() as $message)
			<div class='error'>{{ $message }}</div>
		@endforeach
			
		{{ Form::open(array('url' => 'gift/recipient/create')) }}
			{{ Form :: hidden ( 'user_id', Session::get('user_id') ) }}

			{{ Form::label('name','Name') }}
			{{ Form::text('name'); }}<br><br>

			{{ Form::label('Address Line 1') }}
			{{ Form::text('address_line_1') }}<br><br>

			{{ Form::label('Address Line 2') }}
			{{ Form::text('address_line_2') }}<br><br>

			{{ Form::label('City') }}
			{{ Form::text('city') }}<br><br>

			{{ Form::label('State') }}
			{{ Form::text('state') }}<br><br>

			{{ Form::label('Zip') }}
			{{ Form::text('zip') }}<br><br>

			{{ Form::label('Extended Zip') }}
			{{ Form::text('ext_zip') }}<br><br>
			
			{{ Form::submit('Add'); }}

		{{ Form::close() }}

@stop
