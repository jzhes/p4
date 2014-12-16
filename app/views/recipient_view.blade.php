@extends('_master')

@section('title')
	Recipient
@stop

@section('content')

		<h1>{{ $recipient['name'] }}</h1>

		Address Line 1: {{ $recipient['address_line_1'] }}<br>
		Address Line 2: {{ $recipient['address_line_2'] }}<br>
				  City: {{ $recipient['city'] }}<br>
				 State:	{{ $recipient['state'] }}<br>
				   Zip:	{{ trim($recipient['zip'])}}
							@if($recipient['ext_zip']!= '')-{{ $recipient['ext_zip'] }}
							@endif 
							<br><br>

		<a href='/gift/recipient/all_recipients'>Back to Recipient List</a>
@stop







