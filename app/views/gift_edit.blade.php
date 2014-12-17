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

	<h2>{{{ $gift['item'] }}}</h2>

	{{---- EDIT -----}}
	{{ Form::open(array('url' => '/gift/edit')) }}

		{{ Form::hidden('id',$gift['id']); }}

		<div class='form-group'>
			{{ Form::label('recipient_id', 'Recipient') }}
			{{ Form::select('recipient_id', $recipients, $gift->recipient_id); }}
		<div class='form-group'>

		<div class='form-group'>
			{{ Form::label('qty','Quantity') }}
			{{ Form::number('qty',$gift['qty']); }}
		</div>

		<div class='form-group'>
			{{ Form::label('price','Price') }}
			{{ Form::text('price',$gift['price']); }}
		</div>

		<div class='form-group'>
			{{ Form::label('purchased','Purchased') }}
			{{ Form::checkbox('purchased', $gift['purchased']); }}
		</div>

		{{ Form::submit('Save'); }}

	{{ Form::close() }}

@stop