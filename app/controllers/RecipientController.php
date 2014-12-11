<?php

class RecipientController extends \BaseController {

	/**
	*
	*/
	public function __construct() {

		# Make sure BaseController construct gets called
		parent::__construct();

		$this->beforeFilter('auth', array('except' => 'getIndex'));

	}

	/**
	* Process the searchform
	* @return View
	*/
	public function getSearch() {

		return View::make('gift_search');

	}

	/**
	* Process the searchform
	* @return View
	*/
	public function getShowAllGifts() {
	
		$criteria = '';
		$id = '';
		$gifts = Gift::getData($criteria, $id);
		return View::make('gift_index')
			->with('gifts', $gifts);

	}

	public function getShowPurchasedGifts() {
	
		$criteria = 'P';
		$id = '';
		$gifts = Gift::getData($criteria, $id);
		return View::make('gift_index')
			->with('gifts', $gifts);

	}
	
	public function getShowNotPurchasedGifts() {
	
		$criteria = 'NP';
		$id = '';
		$gifts = Gift::getData($criteria, $id);
		return View::make('gift_index')
			->with('gifts', $gifts);

	}
	
	public function getShowRecipientGifts($id) {
	
		$criteria = 'R';
		$gifts = Gift::getData($criteria, $id);
		return View::make('gift_index')
			->with('gifts', $gifts);

	}

	/**
	* Display all gifts
	* @return View
	*/
	public function getIndex() {

		$query  = Input::get('query');
		$gifts = Gift::search($query);

/*
		$query = Gift::search('1');
		$query = '1';
*/	
		return View::make('gift_index')
			->with('gifts', $gifts)
			->with('query', $query);
	}

	/**
	* Show the "Add a gift form"
	* @return View
	*/
	public function getCreate() {

		$recipients = Recipient::getIdNamePair();

    	return View::make('gift_add')->with('recipients',$recipients);

	}

	/**
	* Process the "Add a gift form"
	* @return Redirect
	*/
	public function postCreate() {

		# Instantiate the gift model
		$gift = new gift();

		$gift->fill(Input::all());
		$gift->user_id = Session::get('user_id');
		$gift->total = $gift->qty * $gift->price;

		
/////SET OTHER DEFAULT VALUES FOR FIELDS, E.G., TOTAL COST???

		# Magic: Eloquent
		$gift->save();

		return Redirect::action('GiftController@getIndex')->with('flash_message','Your gift has been added.');

	}

	/**
	* Show the "Edit a gift form"
	* @return View
	*/
	public function getEdit($id) {

		try {
		    $gift    = Gift::findOrFail($id);  // THIS NEEDS TO BE GIFT/RECIPIENT COMBO
		    $recipients = Recipient::getIdNamePair();
		}
		catch(exception $e) {
		    return Redirect::to('/gift')->with('flash_message', 'Gift not found');
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
	        return Redirect::to('/gift')->with('flash_message', 'Gift not found');
	    }

	    # http://laravel.com/docs/4.2/eloquent#mass-assignment
	    $gift->fill(Input::all());
	    $gift->save();

	   	return Redirect::action('GiftController@getIndex')->with('flash_message','Your changes have been saved.');

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
	        return Redirect::to('/gift/')->with('flash_message', 'Could not delete gift - not found.');
	    }

	    Gift::destroy(Input::get('id'));

	    return Redirect::to('/gift/')->with('flash_message', 'Gift deleted.');

	}

	/**
	* Process a gift search
	* Called w/ Ajax
	*/
	public function postSearch() {

		if(Request::ajax()) {

			$query  = Input::get('query');
echo "BEFORE SEARCH";
			# Do the actual query
	        $gifts  = Gift::search($query);

	        $results = '';
			foreach($gifts as $gift) {
				# Created a "stub" of a view called gift_search_result.php; all it is is a stub of code to display a gift
				# For each gift, we'll add a new stub to the results
				$results .= View::make('gift_search_result')->with('gift', $gift)->render();
			}

			# Return the HTML/View to JavaScript...
			return $results;
			
		}
	}

}