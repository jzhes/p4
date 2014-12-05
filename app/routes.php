<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

// Test DB Connection:
Route::get('mysql-test', function() {

    # Print environment
    echo 'Environment: '.App::environment().'<br>';

    # Use the DB component to select all the databases
    $results = DB::select('SHOW DATABASES;');

    # If the "Pre" package is not installed, you should output using print_r instead
	### echo print_r($results);
    echo Pre::render($results);

});

Route::get('/debug', function() {

 //   echo '<pre>';

    echo '<h1>environment.php</h1>';
    $path   = base_path().'/environment.php';

    try {
        $contents = 'Contents: '.File::getRequire($path);
        $exists = 'Yes';
    }
    catch (Exception $e) {
        $exists = 'No. Defaulting to `production`';
        $contents = '';
    }

    echo "Checking for: ".$path.'<br>';
    echo 'Exists: '.$exists.'<br>';
    echo $contents;
    echo '<br>';

    echo '<h1>Environment</h1>';
    echo App::environment().'</h1>';

    echo '<h1>Debugging?</h1>';
    if(Config::get('app.debug')) echo "Yes"; else echo "No";

    echo '<h1>Database Config</h1>';
    print_r(Config::get('database.connections.mysql'));

    echo '<h1>Test Database Connection</h1>';
    try {
        $results = DB::select('SHOW DATABASES;');
        echo '<strong style="background-color:green; padding:5px;">Connection confirmed</strong>';
        echo "<br><br>Your Databases:<br><br>";
        print_r($results);
    } 
    catch (Exception $e) {
        echo '<strong style="background-color:crimson; padding:5px;">Caught exception: ', $e->getMessage(), "</strong>\n";
    }

 //   echo '</pre>';

});

Route::get('/', function()
{
	return View::make('hello');
});

/*
Note there are no before=>csrf filters in here - it's being handled in the BaseController
*/

/**
* NOTE:	 THIS IS JUST FOR TESTING, MUST REMOVE 
*/
Route::get('/test', function() {
	Session::set('foo', 'bar');
});
Route::get('/test-b', function() {
	echo Session::get('foo');
});

/**
* END OF TESTING CODE 
*/
/**
* Index
*/
Route::get('/', 'IndexController@getIndex');


/**
* User
* (Explicit Routing)
*/
Route::get('/signup','UserController@getSignup' ); 
// Filter checks that they are not already signed-up ('before'=>'guest')
// section8: 
Route::get('signup', array('before' => 'guest', function() {
	return View::make('signup');
  }));
  
// Below is what happens after the form is submitted:
Route::post('signup', array('before' => 'csrf', function() {
	$user = new User;
	$user -> firstname = Input::get('firstname');
	$user -> lastname = Input::get('lastname');
//	$FILL IN REST HERE
	$user -> email = Input::get('email');
	$user -> email = Input::get('email');
	$user -> password = Hash::make(Input::get('password'));
	
	try {
		$user->save();
	}
	catch (Exception $e) {
	//or should it be ('signup' vs '/signup????')
		return Redirect::to('/signup')->with('flash_message', 'Sign up failed; Please try again.')->withInput();
	}

	# Log the user in
	Auth::login($user);
	
	return Redirect::to('/signup');
   }
)
);

// FROM SECTION 8:

// Is '/logout' or 'logout'
Route::get('/logout', function() {

	Auth::logout();
	
	// Redirect to Home Page:
	// Is below correct for home page???
	return Redirect::to('/');

});

Route::post('/login', array('before' => 'csrf', function() {
	$credentials = Input::only('email', 'password');
	
	if (Auth::attempt($credentials, $remember = true)) {
//FINISH LINE BELOW
//		return Redirect::intended('/')->with('flash_message', 'Welcome Back'....
	}
	else {
//FINISH LINE BELOW
//		return Redirect::to('/login')->with('flash_message', 'Login Failed'...
	}
	return Redirect::to('/login');
	}
)
);	

Route::get('/login', 'UserController@getLogin' );
Route::post('/signup', 'UserController@postSignup' );
Route::post('/login', 'UserController@postLogin' );
Route::get('/logout', 'UserController@getLogout' );
 

/**
* Book
* (Explicit Routing)
*/
Route::get('/book', 'BookController@getIndex');
Route::get('/book/edit/{id}', 'BookController@getEdit');
Route::post('/book/edit', 'BookController@postEdit');
Route::get('/book/create', 'BookController@getCreate');
Route::post('/book/create', 'BookController@postCreate');
Route::post('/book/delete', 'BookController@postDelete');

## Ajax examples
Route::get('/book/search', 'BookController@getSearch');
Route::post('/book/search', 'BookController@postSearch');


/**
* Debug
* (Implicit Routing)
*/
Route::controller('debug', 'DebugController');


/**
* Tag
* (Implicit RESTful Routing)
*/
Route::resource('tag', 'TagController');


/**
* Demos
* (Explicit Routing)
*/
Route::get('/demo/csrf-example', 'DemoController@csrf');
Route::get('/demo/collections', 'DemoController@collections');
Route::get('/demo/js-vars', 'DemoController@jsVars');

Route::get('/demo/crud-create', 'DemoController@crudCreate');
Route::get('/demo/crud-read', 'DemoController@crudRead');
Route::get('/demo/crud-update', 'DemoController@crudUpdate');
Route::get('/demo/crud-delete', 'DemoController@crudDelete');

Route::get('/demo/collections', 'DemoController@collections');
Route::get('/demo/query-without-constraints', 'DemoController@queryWithoutConstraints');
Route::get('/demo/query-with-constraints', 'DemoController@queryWithConstraints');
Route::get('/demo/query-responsibility', 'DemoController@queryResponsibility');
Route::get('/demo/query-with-order', 'DemoController@queryWithOrder');

Route::get('/demo/query-relationships-author', 'DemoController@queryRelationshipsAuthor');
Route::get('/demo/query-relationships-tags', 'DemoController@queryRelationshipstags');
Route::get('/demo/query-eager-loading-authors', 'DemoController@queryEagerLoadingAuthors');
Route::get('/demo/query-eager-loading-tags-and-authors', 'DemoController@queryEagerLoadingTagsAndAuthors');

Route::get('/demo/simple-ajax', 'DemoController@getSimpleAjax');
Route::post('/demo/simple-ajax', 'DemoController@postSimpleAjax');



	























