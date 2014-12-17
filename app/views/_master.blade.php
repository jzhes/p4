<!DOCTYPE html>
<html>
<head>

	<title>@yield('title','Giftr')</title>
	<meta charset='utf-8'>
	<link rel='stylesheet' href='/css/main.css' type='text/css'>

	@yield('head')


</head>
<body>

<div id="mainContent">

	<div class="contentWrapper">
		@if(Auth::check())
			<a href='/logout' id="logout">Log out {{ Auth::user()->email; }}</a>
		@else
			<div id="signin">
				<a href='/signup'>Sign up</a> | <a href='/login'>Log in</a>
			</div>
		@endif
		<a href='/'><img class='headimg' src='/images/red_ornament_with_stars_on_white.jpg' alt='Giftr logo'></a>
		@if(Auth::check())
			<h1>{{ Session::get('name') }}'s xmas giftr</h1>
		@endif	

		@if(Session::get('flash_message'))
			<div class='flash-message'>{{ Session::get('flash_message') }}</div>
		@endif

		<div id="sitenav">
			<ul>
			@if(Auth::check())
				<li><a href='/'>Home</a></li>
				<li><a href='/gift/recipient/create'>Add a Recipient</a></li>
				<li><a href='/gift/create'>Add a Gift</a></li>
				<li><a href='/gift/all_gifts'>View all Gifts</a></li>
				<li><a href='/gift/recipient/all_recipients'>View all Recipients</a></li>
				<li><a href='/gift/purchased_gifts'>View Gifts Purchased</a></li>
				<li><a href='/gift/not_purchased_gifts'>View Gifts Not Purchased</a></li>
			@endif
			</ul>
		</div>


		<div class="content">	
			@yield('content')
		<div>	

		@if(!Auth::check())
			<a href='/'><img class='contentimg' src='/images/white_tree_on_red.jpg' alt='Tree'></a>
		@endif

	</div>
</div>	
	@yield('/body')

</body>
</html>





