//....?
@section('head')
//	<link rel=stylesheet type = "text/css" href"{{ URL::asset('/...
@show

<head>
	<div id= 'header'>
		<ul id = "navlist">
			<li><a href="/">BHealthy</a><li>
			<li><a href="/contactus">Contact Us</a><li>
			
			@if(Auth::check())
				<li><a href="/logout">Logout</a></li>
			@else
				<li><a href="/signup">Sign Up</a>|<a href="/login




<head>