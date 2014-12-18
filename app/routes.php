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

