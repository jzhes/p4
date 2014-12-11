<?php

class UserController extends BaseController {

	/**
	*
	*/
	public function __construct() {

		# Make sure BaseController construct gets called
		parent::__construct();

        # You have to be a guest on the getLogin and getSignup
		# so if you are already logged in, do not let me go to the
		# login or signup page
		$this->beforeFilter('guest',
        	array(
        		'only' => array('getLogin','getSignup')
        	));

    }

    /**
	* Show the new user signup form
	* @return View
	*/
	public function getSignup() {

		return View::make('user_signup');

	}

	/**
	* Process the new user signup
	* @return Redirect
	*/
	public function postSignup() {

		# Step 1) Define the rules
		$rules = array(
			'email' => 'required|email|unique:users,email',
			'password' => 'required|min:6'
		);

		# Step 2)
		$validator = Validator::make(Input::all(), $rules);

		# Step 3
		if($validator->fails()) {

			return Redirect::to('/signup')
				->with('flash_message', 'Sign up failed; please fix the errors listed below.')
				->withInput()
				->withErrors($validator);
		}

		$user = new User;
		$user->email    = Input::get('email');
		$user->password = Hash::make(Input::get('password'));

		try {
			$user->save();
		}
		catch (Exception $e) {
			return Redirect::to('/signup')
				->with('flash_message', 'Sign up failed; please try again.')
				->withInput();
		}

		# Log in the new user that's been created (no need to see if they're logged in 
		# just created the new user
		Auth::login($user);
		
		# Store the user_id in the session, to be accessed later:
		Session::put('user_id', $user->id);

		# redirect back to the home page
		return Redirect::to('/')->with('flash_message', 'Hello! Login was successful!'); 
// REMOVE IF NO ADD FIRST NAME
//		return Redirect::to('/')->with('flash_message', 'Hello '. $user->firstname .'!'); 

	}

	/**
	* Display the login form
	* @return View
	*/
	public function getLogin() {

		return View::make('user_login');

	}

	/**
	* Process the login form
	* @return View
	*/
	public function postLogin() {

		$credentials = Input::only('email', 'password');

// NEED TO DO A QUERY USING EMAIL TO GET USER_ID TO STORE SESSION USER_ID
		# Store the user_id in the session, to be accessed later:
//		Session::put('user_id', $user->user_id);
// THIS IS JUST FOR TESTING UNTIL CAN FIX ABOVE PROBLEM WITH GETTING USER_ID
		Session::put('user_id', '1');

		# Note we don't have to hash the password before attempting to auth - Auth::attempt will take care of that for us
		if (Auth::attempt($credentials, $remember = false)) {
			return Redirect::intended('/')->with('flash_message', 'Welcome Back!');

// REMOVE IF NO ADD FIRST NAME
//			return Redirect::intended('/')->with('flash_message', 'Welcome Back'. $user->name . '!');
		}
		else {
			return Redirect::to('/login')
				->with('flash_message', 'Log in failed; please try again.')
				->withInput();
		}

	}

	/**
	* Logout
	* @return Redirect
	*/
	public function getLogout() {

		# Log out
		Auth::logout();

		# Send them to the homepage
		return Redirect::to('/');

	}

}