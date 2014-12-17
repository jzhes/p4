@extends('_master')

@section('title')
	Gift
@stop

@section('content')

		<h2>{{ $gift['item'] }}</h2>

		Recipient: {{ $gift['recipient']['name']}}<br>
		 Quantity: {{ $gift['qty'] }}<br>
			Price: ${{ $gift['price'] }}<br>
			Total: ${{ $gift['total'] }}<br>
		Purchased:	{{ ($gift['purchased']) ? 'Yes' : 'No' }}<br>
		<br><br>

	   <a href='/gift/all_gifts'>Back to Gift List</a>

@stop







