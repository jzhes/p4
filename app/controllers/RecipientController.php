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
	* Show all recipients
	* @return View
	*/
	public function getAllRecipients() {
	
		$criteria = '';
		$id = '';
		$recipients = Recipient::getData($criteria, $id);

		return View::make('recipient_index')
			->with('recipients', $recipients);

	}

	/**
	* Display a single Recipient
	* @return View
	*/

	public function getRecipient($id) {
	
		$criteria = 'R';
		$recipient = Recipient::getData($criteria, $id)->first();
		return View::make('recipient_view')
			->with('recipient', $recipient);

	}

	/**
	* Show the "Add a recipient form"
	* @return View
	*/
	public function getCreate() {

    	return View::make('recipient_add');

	}

	/**
	* Process the "Add a recipient form"
	* @return Redirect
	*/
	public function postCreate() {

		# Instantiate the recipient model
		$recipient = new recipient();

		$recipient->fill(Input::all());

		# Magic: Eloquent
		$recipient->save();

		return Redirect::to('/gift/recipient/' . $recipient->id . '}')
			->with('flash_message', 'Your recipient ' . $recipient->name . ' has been added.');

	}

	/**
	* Show the "Edit a recipient form"
	* @return View
	*/
	public function getEdit($id) {
		try {
		    $recipient = Recipient::findOrFail($id);  // This does not need to be user/recipient
													  // because you already have the recipient id 
													  // which is unique to the table.
		}
		catch(exception $e) {
		    return Redirect::to('gift/recipient')->with('flash_message', 'Recipient not found');
		}

    	return View::make('recipient_edit')
			->with('recipient', $recipient);

	}

	/**
	* Process the "Edit a recipient form"
	* @return Redirect
	*/
	public function postEdit() {

		try {
	        $recipient = Recipient::findOrFail(Input::get('id'));
	    }
	    catch(exception $e) {
	        return Redirect::to('gift/recipient')->with('flash_message', 'Recipient not found');
	    }

	    $recipient->fill(Input::all());
	    $recipient->save();
		return Redirect::to('/gift/recipient/' . $recipient->id . '}')
			->with('flash_message', 'Your recipient ' . $recipient->name . ' has been updated.');

	}

	/**
	* Process recipient deletion
	*
	* @return Redirect
	*/
	public function postDelete() {

		try {
	        $recipient = Recipient::findOrFail(Input::get('id'));
	    }
	    catch(exception $e) {
	        return Redirect::to('/')->with('flash_message', 'Could not delete recipient - not found.');
	    }

	    Recipient::destroy(Input::get('id'));

	    return Redirect::to('/gift/recipient/all_recipients')->with('flash_message', 'Recipient deleted.');

	}

}