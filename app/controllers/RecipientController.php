<?php

class RecipientController extends BaseController {

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

		# Step 1) Define the rules
		$rules = array(
			'name' => 'required',
			'state' => 'size:2',
			'zip' => 'size:5',
			'ext_zip' => 'size:4'
		);

		# Step 2)
		$validator = Validator::make(Input::all(), $rules);

		# Step 3
		if($validator->fails()) {

			return Redirect::to('/gift/recipient/create')
				->with('flash_message', 'Adding of recipient failed.  Please fix the errors listed below.')
				->withInput()
				->withErrors($validator);
		}
	
		$recipient = new Recipient();

		$recipient->fill(Input::all());

		try {
			$recipient->save();
		}
		catch (Exception $e) {
			return Redirect::to('/gift/recipient/create')
				->with('flash_message', 'Saving of new recipient failed. Please try again.')
				->withInput();
		}
		
		return Redirect::to('/gift/recipient/' . $recipient->id . '}')
			->with('flash_message', 'Your recipient ' . $recipient->name . ' has been added.');

	}

	/**
	* Show the "Edit a recipient form"
	* @return View
	*/
	public function getEdit($id) {
		
		try {
		    $recipient = Recipient::findOrFail($id);  
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
	        return Redirect::to('gift/recipient/all_recipients')->with('flash_message', 'Recipient not found');
	    }

		# Step 1) Define the rules
		$rules = array(
			'state' => 'size:2',
			'zip' => 'size:5',
			'ext_zip' => 'size:4'
		);

		# Step 2)
		$validator = Validator::make(Input::all(), $rules);

		# Step 3
		if($validator->fails()) {

			return Redirect::to('/gift/recipient/edit/$recipient->id')
				->with('flash_message', 'Editing of recipient failed; please fix the errors listed below.')
				->withInput()
				->withErrors($validator);
		}

	    $recipient->fill(Input::all());
		try {
			$recipient->save();
		}
		catch (Exception $e) {
			return Redirect::to('/gift/recipient/edit/$recipient->id')
				->with('flash_message', 'Editing of recipient failed. Please try again.')
				->withInput();
		}

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

		try {
			Recipient::destroy(Input::get('id'));
	    }
	    catch(exception $e) {
	        return Redirect::to('/')->with('flash_message', 'Cannot delete recipient - ' . $recipient->name . ' is already on your Christmas list!');
	    }

	    return Redirect::to('/gift/recipient/all_recipients')->with('flash_message', 'Recipient deleted.');

	}

}