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
			'password' => 'required|min:6',
			'name' => 'required'
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
		$user->email = Input::get('email');
		$user->password = Hash::make(Input::get('password'));
		$user->name = Input::get('name');

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

		# Store the name in the session, to be accessed later:
		Session::put('name', $user->name);

		# redirect back to the home page
		return Redirect::to('/')->with('flash_message', 'Welcome '. $user->name .'!'); 

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
	* @return View	*/
	public function postLogin() {

		# Step 1) Define the rules
		$rules = array(
			'email' => 'required|email',
			'password' => 'required|min:6'
		);

		# Step 2)
		$validator = Validator::make(Input::all(), $rules);

		# Step 3
		if($validator->fails()) {

			return Redirect::to('/login')
				->with('flash_message', 'Login failed; please fix the errors listed below.')
				->withInput()
				->withErrors($validator);
		}

		$email = Input::only('email');
		$password = Input::only('password');
		$credentials = Input::only('email', 'password');
	
 		# Note we don't have to hash the password before attempting to auth - Auth::attempt will take care of that for us
		if (Auth::attempt($credentials)) {
			
			$user = User::getUser($email);

			# Store the user_id in the session, to be accessed later:
			Session::put('user_id', $user->id);
			Session::put('name', $user->name);
			
			return Redirect::intended('/')->with('flash_message', 'Welcome Back '. $user->name . '!');
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