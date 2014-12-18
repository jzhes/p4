@extends('_master')

@section('title')
	Add a new recipient
@stop

@section('content')

	<div class="mainContent">
	
		<h2>Add a new recipient</h2>

		@foreach($errors->all() as $message)
			<div class='error'>{{ $message }}</div>
		@endforeach
		
		{{ Form::open(array('url' => 'gift/recipient/create')) }}
			{{ Form :: hidden ( 'user_id', Session::get('user_id') ) }}

			<div class='form-group'>
				{{ Form::label('name') }}
				{{ Form::text('name', '', array('size' => '30')); }}
			</div>
				
			<div class='form-group'>
				{{ Form::label('address_line_1') }}
				{{ Form::text('address_line_1') }}
			</div>

			<div class='form-group'>
				{{ Form::label('address_line_2') }}
				{{ Form::text('address_line_2') }}
			</div>

			<div class='form-group'>
				{{ Form::label('city') }}
				{{ Form::text('city', '', array('size' => '32')) }}
			</div>

			<div class='form-group'>
				{{ Form::label('state') }}
				{{ Form::text('state', '', array('size' => '1', 'maxlength' => '2')) }}
			</div>

			<div class='form-group'>
				{{ Form::label('zip') }}
				{{ Form::text('zip', '', array('size' => '2', 'maxlength' => '5')) }}-
				{{ Form::text('ext_zip', '', array('size' => '2', 'maxlength' => '4')) }}
			</div>
		
			<div class='form-group'>
				{{ Form::submit('Add'); }}
			</div>

		{{ Form::close() }}

	</div>	
		
@stop
