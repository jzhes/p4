@extends('_master')

@section('title')
	Gifts
@stop

@section('content')

	<h1>Your Christmas List</h1>

	@if(sizeof($gifts) == 0)
		No results found
	@else
		Gifts found: {{ sizeof($gifts) }}

		@foreach($gifts as $gift)

			<section class='gift'>
				<h2>{{ $gift['item'] }}</h2>

				<p>
					<a href='/gift/edit/{{$gift['id']}}'>Edit</a>
				</p>

				<p>
					{{ $gift['recipient']['first_name'] . ' ' .$gift['recipient']['last_name']}} <br>
					Status: {{ $gift['recipient']['description'] }} <br>
					Quantity: {{ $gift['qty'] }} <br>
					Price: {{ $gift['price'] }} <br>
					Total: {{ $gift['total'] }} <br>
					Purchased? {{ $gift['purchased'] }}
				</p>
			</section>

		@endforeach

	@endif

@stop







