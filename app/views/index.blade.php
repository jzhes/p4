@extends('_master')

@section('title')
	Welcome to Giftr!
@stop

@section('head')

@stop

@section('content')

	@if(!(Auth::check()))
	<h2>Welcome to the Christmas Giftr!</h2>	
		<p>	Where you can track and store your Christmas Gift List!  Christmas is such a 
			busy time of year but with Christmas Giftr, you can easily manage your Christmas
			Gift List. 
		</p>
	@endif

@stop