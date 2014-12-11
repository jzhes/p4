@section('title')
	Search (Ajax)
@stop

@section('content')

	<h1>Search by recipient name or gift</h1>

	<label for='query'>Search:</label>
	<input type='text' id='query' name='query' value=''><br><br>

	{{ Form::token() }}

	<button id='search-html'>Search</button>

	<div id='results'></div>

@stop

@section('/body')
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="/js/search.js"></script>
@stop

{{-- Display the results --}}

<section>

	<h2>{{ $gift['item'] }}</h2>
	<p>
		{{ $gift['recipient']->first_name }} {{ $gift['recipient']->last_name }}
	</p>

	Item: {{ $gift['item'] }}
	<br>
	<a href='/gift/edit/{{ $gift->id }}'>Edit</a>
</section>

