<?php

class GiftController extends \BaseController {

	/**
	*
	*/
	public function __construct() {

		# Make sure BaseController construct gets called
		parent::__construct();

		$this->beforeFilter('auth', array('except' => 'getIndex'));

	}

	/**
	* Display all of the Gifts
	* @return View
	*/
	public function getAllGifts() {
	
		$criteria = '';
		$id = '';
		$gifts = Gift::getData($criteria, $id);
		$total = Gift::calcTotal($gifts);
		$recipients = Recipient::getData($criteria, Session::get('user_id'))->first();
		return View::make('gift_index')
			->with('criteria', $criteria)
			->with('recipients', $recipients)
			->with('total', $total)
			->with('gifts', $gifts);
	}

	/**
	* Display a single Gift
	* @return View
	*/
	public function getGift($id) {
	
		$criteria = 'G';
		$gift = Gift::getData($criteria, $id);

		return View::make('gift_view')
			->with('gift', $gift);
		
	}
		
	/**
	* Display only those Gifts which have been purchased
	* @return View
	*/
	public function getPurchasedGifts() {
	
		$criteria = 'P';
		$id = '';
		$gifts = Gift::getData($criteria, $id);
		$total = Gift::calcTotal($gifts);
		return View::make('gift_index')
			->with('criteria', $criteria)
			->with('total', $total)
			->with('gifts', $gifts);

	}
	
	/**
	* Display only those Gifts which have NOT been purchased
	* @return View
	*/
	public function getNotPurchasedGifts() {
	
		$criteria = 'NP';
		$id = '';
		$gifts = Gift::getData($criteria, $id);
		$total = Gift::calcTotal($gifts);
		return View::make('gift_index')
			->with('criteria', $criteria)
			->with('total', $total)
			->with('gifts', $gifts);
	}
	
	/**
	* Display only those Gifts for a specific Recipient
	* @return View
	*/
	public function getRecipientGifts($id) {
	
		$criteria = 'R';
		$gifts = Gift::getData($criteria, $id);
		$total = Gift::calcTotal($gifts);
		return View::make('gift_index')
			->with('criteria', $criteria)
			->with('total', $total)
			->with('gifts', $gifts);

	}


	/**
	* Show the "Add a gift form"
	* @return View
	*/
	public function getCreate() {

		$recipients = Recipient::getIdNamePair();

		if (!$recipients) {
			return Redirect::action('RecipientController@getCreate')->with('flash_message','You must add a recipient before adding a gift.');
		} 
		else {
			return View::make('gift_add')->with('recipients', $recipients);
		}
		
	}

	/**
	* Process the "Add a gift form"
	* @return Redirect
	*/
	public function postCreate() {

		# Step 1) Define the rules
		$rules = array(
			'item' => 'required',
			'quantity' => 'integer',
			'price' => 'numeric'
		);

		# Step 2)
		$validator = Validator::make(Input::all(), $rules);

		# Step 3
		if($validator->fails()) {

			return Redirect::to('/gift/create')
				->with('flash_message', 'Adding of gift failed. Please fix the errors listed below.')
				->withInput()
				->withErrors($validator);
		}
	
		# Instantiate the gift model
		$gift = new gift();

		$gift->fill(Input::all());
		if ($gift->price < 0) {
			return Redirect::to('/gift/create')
				->with('flash_message', 'Price must a number > 0. Please try again.')
				->withInput();
		}
		
		$gift->user_id = Session::get('user_id');
		$gift->total = $gift->qty * $gift->price;

		try {
			$gift->save();
		}
		catch (Exception $e) {
			return Redirect::to('/gift/create')
				->with('flash_message', 'Saving of new gift failed. Please try again.')
				->withInput();
		}

		return Redirect::to('/gift/' . $gift->id . '}')
			->with('flash_message', 'Your gift has been added.');
	

	}

	/**
	* Show the "Edit a gift form"
	* @return View
	*/
	public function getEdit($id) {

		try {
		    $gift    = Gift::findOrFail($id);  
		    $recipients = Recipient::getIdNamePair();
		}
		catch(exception $e) {
		    return Redirect::to('/gift/all_gifts')->with('flash_message', 'Gift not found');
		}

    	return View::make('gift_edit')
    		->with('gift', $gift)
    		->with('recipients', $recipients);

	}

	/**
	* Process the "Edit a gift form"
	* @return Redirect
	*/
	public function postEdit() {

		try {
	        $gift = Gift::findOrFail(Input::get('id'));
	    }
	    catch(exception $e) {
	        return Redirect::to('/gift/all_gifts')->with('flash_message', 'Gift not found');
	    }

		# Step 1) Define the rules
		$rules = array(
			'quantity' => 'integer',
			'price' => 'numeric'
		);

		# Step 2)
		$validator = Validator::make(Input::all(), $rules);

		# Step 3
		if($validator->fails()) {

			return Redirect::to('/gift/edit/$gift->id')
				->with('flash_message', 'Editing of gift failed; please fix the errors listed below.')
				->withInput()
				->withErrors($validator);
		}

	    $gift->fill(Input::all());

		if ($gift->price < 0) {
			return Redirect::to('/gift/edit/$gift->id')
				->with('flash_message', 'Price must a number > 0. Please try again.')
				->withInput();
		}

		$gift->total = $gift->qty * $gift->price;

		try {
			$gift->save();
		}
		catch (Exception $e) {
			return Redirect::to('/gift/edit/$gift->id')
				->with('flash_message', 'Saving of gift failed. Please try again.')
				->withInput();
		}

		return Redirect::to('/gift/' . $gift->id . '}')
			->with('flash_message', 'Your changes have been saved.');

	}

	/**
	* Process gift deletion
	*
	* @return Redirect
	*/

	public function postDelete() {

		try {
	        $gift = Gift::findOrFail(Input::get('id'));
	    }
	    catch(exception $e) {
	        return Redirect::to('/gift/all_gifts')->with('flash_message', 'Could not delete gift - not found.');
	    }

	    Gift::destroy(Input::get('id'));

	    return Redirect::to('/gift/all_gifts')->with('flash_message', 'Your gift was deleted.');

	}

}