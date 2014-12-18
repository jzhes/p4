@extends('_master')

@section('title')
	Add a new gift
@stop

@section('content')

	<div class="mainContent">

		<h2>Add a new gift</h2>
		
		@foreach($errors->all() as $message)
			<div class='error'>{{ $message }}</div>
		@endforeach

		{{ Form::open(array('url' => '/gift/create')) }}

		{{ Form :: hidden ( 'user_id', Session::get('user_id') ) }}
		
			<div class='form-group'>
				{{ Form::label('item','Item') }}
				{{ Form::text('item'); }}
			</div>
			
			<div class='form-group'>
				{{ Form::label('recipient_id', 'Recipient') }}
				{{ Form::select('recipient_id', $recipients); }}
			</div>

			<div class='form-group'>
				{{ Form::label('qty','Quantity') }}
				{{ Form::number('qty', '1'); }}
			</div>

			<div class='form-group'>
				{{ Form::label('price','Price') }}
				{{ Form::number('price', '0'); }}
			</div>
				
			<div class='form-group'>
				{{ Form::label('purchased','Purchased?') }}
				{{ Form::checkbox('purchased'); }}
			</div>

			<div class='form-group'>
				{{ Form::submit('Add'); }}
			</div>

		{{ Form::close() }}

	</div>	
		
@stop
