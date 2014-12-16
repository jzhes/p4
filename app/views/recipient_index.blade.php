@extends('_master')

@section('title')
	Recipients
@stop

@section('content')

	@if(sizeof($recipients) == 1)
		<h1>Your Recipient</h1>
	@else
		<h1>Your Recipients</h1>
	@endif	

	@if(sizeof($recipients) == 0)
		No recipients found
	@else
		<table class="recipienttable">
			<thead>
				<tr>
					<th>Name</th>
					<th>Address Line 1</th>
					<th>Address Line 2</th>
					<th>City</th>
					<th>State</th>
					<th>Zip</th>
					<th>Edit</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody>
				@foreach($recipients as $recipient)
				<tr>
					<td>{{ $recipient['name'] }}</td>
					<td>{{ $recipient['address_line_1'] }}</td>
					<td>{{ $recipient['address_line_2'] }}</td>
					<td>{{ $recipient['city'] }}</td>
					<td>{{ $recipient['state'] }}</td>
					<td>{{ trim($recipient['zip'])}}
							@if($recipient['ext_zip']!= '')-{{ $recipient['ext_zip'] }}
							@endif</td>
					<td><a href='/gift/recipient/edit/{{$recipient['id']}}'><img src='/images/edit_pencil.svg' alt='Edit'></a></td>
					<td>
						<div>
							{{---- DELETE -----}}
							{{ Form::open(array('url' => 'gift/recipient/delete')) }}
								{{ Form::hidden('id',$recipient['id']); }}
								<button onClick='parentNode.submit();return false;'><img src='/images/delete_circle.svg' alt='Delete'></button>
							{{ Form::close() }}
						</div>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	@endif

@stop







