@extends('_master')

@section('title')
	Search (Ajax)
@stop

@section('content')

	<h1>Search by recipient or gift</h1>

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