@extends('_master')

@section('title')
	Edit
@stop

@section('head')

@stop

@section('content')

	<h1>Edit</h1>
	<h2>{{{ $gift['item'] }}}</h2>

	{{---- EDIT -----}}
	{{ Form::open(array('url' => '/gift/edit')) }}

		{{ Form::hidden('id',$gift['id']); }}

		<div class='form-group'>
			{{ Form::label('item','Item') }}
			{{ Form::text('item',$gift['item']); }}
		</div>

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
{{-- FIX THE PURCHASED CHECKBOX BELOW --}}		
{{-- Form::checkbox('tags[]', $id, $book->tags->contains($id)); }} {{ $tag }} --}} 
{{-- Form::checkbox('purchased','yes', $gift['purchased']); --}}

		<div class='form-group'>
			{{ Form::label('purchased','Purchased') }}
			{{ Form::checkbox('purchased',$gift['purchased']); }}
		</div>

		{{ Form::submit('Save'); }}

	{{ Form::close() }}

@stop