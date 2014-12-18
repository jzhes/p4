@extends('_master')

@section('title')
	Recipient
@stop

@section('content')

	<div class="mainContent">

		<h2>{{ $recipient['name'] }}</h2>

		Address Line 1: {{ $recipient['address_line_1'] }}<br>
		Address Line 2: {{ $recipient['address_line_2'] }}<br>
				  City: {{ $recipient['city'] }}<br>
				 State: {{ $recipient['state'] }}<br>
				   Zip: {{ trim($recipient['zip'])}}
							@if($recipient['ext_zip']!= '')-{{ $recipient['ext_zip'] }}
							@endif 
	</div>
		
@stop







