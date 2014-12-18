@extends('_master')

@section('title')
	Gifts
@stop

@section('content')

	@if($criteria == 'NP')
		<h2>Gifts Not Purchased</h2>
	@elseif ($criteria == 'P')
		<h2>Gifts Purchased</h2>
	@else
		<h2>Your Christmas Gift List</h2>
	@endif	

	@if(sizeof($gifts) == 0)
		@if((($criteria != 'NP') && ($criteria != 'P') && sizeof($recipients) == 0))
			Before adding your your first gift, you must add one or more recipients.
		@else
			No gifts found.
		@endif	
	@else

		<table class="gifttable">
			<thead>
				<tr>
					<th>Gift</th>
					<th>Recipient</th>
					<th>Quantity</th>
					<th>Price</th>
					<th>Total</th>
					<th>Purchased</th>
					<th>Edit</th>
					<th>Delete</th>
				</tr>
			</thead>
	
			<tbody>
				@foreach($gifts as $gift)
				<tr>
					<td>{{ $gift['item'] }}</td>
					<td>{{ $gift['recipient']['name']}}</td>
					<td>{{ $gift['qty'] }}</td>
					<td>${{ $gift['price'] }}</td>
					<td>${{ $gift['total'] }}</td>
					<td>{{ ($gift['purchased']) ? 'Yes' : 'No' }}</td>
					<td><a href='/gift/edit/{{$gift['id']}}'><img src='/images/edit_pencil.svg' alt='Edit'></a></td>
					<td>
						<div>
							{{---- DELETE -----}}
							{{ Form::open(array('url' => '/gift/delete')) }}
								{{ Form::hidden('id',$gift['id']); }}
								<button onClick='parentNode.submit();return false;'><img src='/images/delete_circle.svg' alt='Delete'></button>
							{{ Form::close() }}
						</div>
					</td>
				</tr>
				@endforeach
				<tr class="total">
					<td>TOTAL:  </td>
					<td>${{ $total }}</td>
				</tr>	
			</tbody>
		</table>
	@endif

@stop







