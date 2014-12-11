@extends('_master')

@section('title')
	Add a new gift
@stop

@section('content')

	<h1>Add a new gift</h1>
	SESSION USER ID: {{ Session::get('user_id'); }}
		
	{{ Form::open(array('url' => '/gift/create')) }}

		{{ Form::label('item','Item') }}
		{{ Form::text('item'); }}

		{{ Form::label('recipient_id', 'Recipient') }}
		{{ Form::select('recipient_id', $recipients); }}

		{{ Form::label('qty','Quantity') }}
		{{ Form::number('qty', '1'); }}

		{{ Form::label('price','Price') }}
		{{ Form::number('price', '0'); }}
		
		{{-- SHOULD SET DEFAULT VALUE FOR PURCHASED? AND TOTAL --}}

		{{ Form::label('online','Purchase Online?') }}
		{{ Form::checkbox('online', 'no'); }}

		{{ Form::submit('Add'); }}

	{{ Form::close() }}

@stop
