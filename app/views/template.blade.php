<?php
error_reporting(E_ALL); # Report Errors, Warnings, and Notices
ini_set('display_errors', 1); # Display errors on page (instead of a log file)
date_default_timezone_set ('america/new_york'); 
?>

<!doctype html>
<html>
<head>
	@yield('title')
	@section('head')
		<link rel=stylesheet type="text/css" href="{{ URL::asset('/main.css') }}">
	@show
</head>
	<div id='header'>
		<ul id="navlist">
			<li><a href="/menu">Menu</a><li>
			<li><a href="/contact">Contact</a><li>
			@if(Auth::check())
				<li><a href="/bhealthy/logout">Logout</a><li>
			@else
				<li><a href="/bhealthy/signup">Sign Up</a>|<a href="/bhealthy/login">Login</a><li>
			@endif

			@if(Auth::check())
				<li>Hello {{ Auth::user()->firstname; }}!{/li>
			@endif
	</div><br><br>
	<div id="container">
<body>
	@yield('body')
</body>
</html>
	
			
				
			