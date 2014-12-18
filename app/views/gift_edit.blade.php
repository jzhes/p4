@extends('_master')

@section('title')
	Edit
@stop

@section('head')

@stop

@section('content')

	<div class="mainContent">

		<h2>Edit:  {{{ $gift['item'] }}} </h2>
		
		@foreach($errors->all() as $message)
			<div class='error'>{{ $message }}</div>
		@endforeach

		{{---- EDIT -----}}
		{{ Form::open(array('url' => '/gift/edit')) }}

			{{ Form::hidden('id',$gift['id']); }}

			<div class='form-group'>
				{{ Form::label('recipient_id', 'Recipient') }}
				{{ Form::select('recipient_id', $recipients, $gift->recipient_id); }}
			</div>

			<div class='form-group'>
				{{ Form::label('qty','Quantity') }}
				{{ Form::number('qty',$gift['qty']); }}
			</div>

			<div class='form-group'>
				{{ Form::label('price','Price') }}
				{{ Form::text('price',$gift['price'], array('size'=>'5')); }}
			</div>

			<div class='form-group'>
				{{ Form::label('purchased','Purchased') }}
				{{ Form::checkbox('purchased', $gift['purchased']); }}
			</div>

			<div class='form-group'>
				{{ Form::submit('Save'); }}
			</div>

		{{ Form::close() }}
 
	</div>

@stop