<!DOCTYPE html>
<html>
<head>

	<title>@yield('title','Giftr')</title>
	<meta charset='utf-8'>
	<link rel='stylesheet' href='/css/gift.css' type='text/css'>

	@yield('head')


</head>
<body>

{{--	ADD TITLE/DESC/ETC HERE  	--}}
{{--	CREATE HEADING CLASS IN CSS  	--}}
	<a href='/'><img class='headimg' src='/images/white_tree_on_red.jpg' alt='Giftr logo'></a>
	<h1>The Christmas Giftr</h1>

	@if(Session::get('flash_message'))
		<div class='flash-message'>{{ Session::get('flash_message') }}</div>
	@endif

	<nav>
		<ul>
		@if(Auth::check())
		 	SESSION USER ID: {{ Session::get('user_id') }}<br><br>
			<li><a href='/logout'>Log out {{ Auth::user()->email; }}</a></li>
			<li><a href='/gift'>All Gifts</a></li>
			<li><a href='/gift/search'>Search Gift List</a></li>
			<li><a href='/recipient'>All Recipients</a></li>
			<li><a href='/gift/create'>+ Add to Gift List</a></li>
			<li><a href='/gift/show_all_gifts'>View all Gifts</a></li>
			<li><a href='/gift/show_purchased_gifts'>View Gifts Purchased</a></li>
			<li><a href='/gift/show_not_purchased_gifts'>View Gifts Not Purchased</a></li>
			<li><a href='/gift/show_all_recipients'>View all Recipients</a></li>
			<li><a href='/recipient/create'>+ Add a Recipient</a></li>
			<li><a href='/debug/routes'>Routes</a></li>
		@else
			<li><a href='/signup'>Sign up</a> | <a href='/login'>Log in</a></li>
		@endif
		</ul>
	</nav>

	@yield('content')

	@yield('/body')

</body>
</html>





