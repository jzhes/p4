@extends('_master')

@section('title')
	xmas giftr
@stop

@section('head')

@stop

@section('content')

		@if(!(Auth::check()))
		<h1>Welcome to the xmas giftr!</h1>	
			<p class="description">	Where you can track and store your Christmas Gift List!  Christmas is such a 
				busy time of year but with xmas giftr, you can easily manage your Christmas
				Gift List. xmas giftr lets you organize and track your gift list. 
				Sign up or Login to get started!
			</p>
		@endif

@stop