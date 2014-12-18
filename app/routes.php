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

// Helpful DEBUG Info 
Route::get('/debug', function() {

    echo '<pre>';

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

    echo '</pre>';

});


/**
* Index
*/
Route::get('/', 'IndexController@getIndex');

/**
* User
* (Explicit Routing)
*/
Route::get('/signup','UserController@getSignup' ); 
Route::get('/login', 'UserController@getLogin' );
Route::post('/signup', 'UserController@postSignup' );
Route::post('/login', 'UserController@postLogin' );
Route::get('/logout', 'UserController@getLogout' );
 
/**
* Gift
* (Explicit Routing)
*/
Route::get('/gift/edit/{id}', 'GiftController@getEdit');
Route::post('/gift/edit', 'GiftController@postEdit');
Route::get('/gift/create', 'GiftController@getCreate');
Route::post('/gift/create', 'GiftController@postCreate');
Route::post('/gift/delete', 'GiftController@postDelete');

// Views of Gifts
Route::get('/gift/all_gifts', 'GiftController@getAllGifts');
Route::get('/gift/recipient_gifts/{id}', 'GiftController@getRecipientGifts');
Route::get('/gift/purchased_gifts', 'GiftController@getPurchasedGifts');
Route::get('/gift/not_purchased_gifts', 'GiftController@getNotPurchasedGifts');
Route::get('/gift/{id}', 'GiftController@getGift');

/**
* Recipient
* (Explicit Routing)
*/
Route::get('gift/recipient/edit/{id}', 'RecipientController@getEdit');
Route::post('gift/recipient/edit', 'RecipientController@postEdit');
Route::get('gift/recipient/create', 'RecipientController@getCreate');
Route::post('gift/recipient/create', 'RecipientController@postCreate');
Route::post('gift/recipient/delete', 'RecipientController@postDelete');

// Views of Recipients
Route::get('/gift/recipient/all_recipients', 'RecipientController@getAllRecipients');
Route::get('/gift/recipient/{id}', 'RecipientController@getRecipient');

