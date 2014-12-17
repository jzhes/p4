@extends('_master')

@section('title')
	Add a new gift
@stop

@section('content')

	<h1>Add a new gift</h1>
	
	@foreach($errors->all() as $message)
		<div class='error'>{{ $message }}</div>
	@endforeach

	{{ Form::open(array('url' => '/gift/create')) }}

	{{ Form :: hidden ( 'user_id', Session::get('user_id') ) }}
	
		{{ Form::label('item','Item') }}
		{{ Form::text('item'); }}<br><br>

		{{ Form::label('recipient_id', 'Recipient') }}
		{{ Form::select('recipient_id', $recipients); }}<br><br>

		{{ Form::label('qty','Quantity') }}
		{{ Form::number('qty', '1'); }}<br><br>

		{{ Form::label('price','Price') }}
		{{ Form::number('price', '0'); }}<br><br>
		
		{{ Form::label('purchased','Purchased?') }}
		{{ Form::checkbox('purchased'); }}<br><br>

		{{ Form::submit('Add'); }}

	{{ Form::close() }}

@stop
