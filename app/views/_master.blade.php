<!DOCTYPE html>
<html>
<head>

	<title>@yield('title','Giftr')</title>
	<meta charset='utf-8'>
	<link rel='stylesheet' href='/css/main.css' type='text/css'>

	@yield('head')


</head>
<body>

	<a href='/'><img class='headimg' src='/images/white_tree_on_red.jpg' alt='Giftr logo'></a>
	@if(Auth::check())
		<h1>{{ Session::get('name') }}'s xmas giftr</h1>
		<a href='/logout'>Log out {{ Auth::user()->email; }}</a>
	@endif
		
<div id="mainContent">
	<div class="contentWrapper">
		<div id="sitenav">
			<ul>
			@if(Auth::check())
				SESSION USER ID: {{ Session::get('user_id') }}<br>
				SESSION NAME: {{ Session::get('name') }}<br><br>
				<li><a href='/'>Home</a></li>
				<li><a href='/gift/recipient/create'>Add a Recipient</a></li>
				<li><a href='/gift/create'>Add to Gift List</a></li>
				<li><a href='/gift/all_gifts'>View all Gifts</a></li>
				<li><a href='/gift/recipient/all_recipients'>View all Recipients</a></li>
				<li><a href='/gift/purchased_gifts'>View Gifts Purchased</a></li>
				<li><a href='/gift/not_purchased_gifts'>View Gifts Not Purchased</a></li>
			@else
				<h1>xmas giftr</h1>
				<li><a href='/signup'>Sign up</a> | <a href='/login'>Log in</a></li>
			@endif
			</ul>
		</nav>

		@if(Session::get('flash_message'))
			<div class='flash-message'>{{ Session::get('flash_message') }}</div>
		@endif
		
		@yield('content')
	</div>
</div>	
	@yield('/body')

</body>
</html>





