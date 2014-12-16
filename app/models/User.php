<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model
	 *
	 * @var array
	 */
	protected $hidden = array('password');
	
	/**
	* Identify relation between Gift and User
	*/
	public function gift() {
	
       # User may have many gifts
       return $this->hasMany('Gift');

   }

	/**
	* Identify relation between Recipient and User
	*/
	public function recipient() {
       
	   # User may have many recipients
       return $this->hasMany('Recipient');
	   
    }

	
	public static function getUser($email) {

   		return User::where('email','=', $email)->first();

    }

}
