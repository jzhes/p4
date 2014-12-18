<?php

class Recipient extends Eloquent {

    # The guarded properties specifies which attributes should *not* be mass-assignable
    protected $guarded = array('id', 'created_at', 'updated_at');

	/**
	* Identify relation between Recipient and Gift
	*/
	public function gift() {
        # Recipient may have more than one gift
        # Define a one-to-many relationship.
        return $this->hasMany('Gift');
    }

	/**
	* Identify relation between Recipient and User
	*/
	public function user() {
	
       # Recipient may only have one User
       return $this->belongsTo('User');
    }

    /**
	* When editing or adding a new gift, we need a select dropdown of recipients to choose from
	*
	* @return Array
	*/
    public static function getIdNamePair() {

		$recipients = Array();

		$collection = Recipient::where('user_id', '=', Session::get('user_id'))
			->get();

		foreach($collection as $recipient) {
			$recipients[$recipient->id] = $recipient->name;
		}

		return $recipients;

	}

    /**
    * Search among gifts, recipients and statuses
    * @return Collection
    */
    public static function getData($criteria, $id) {

	# If there is criteria, get data using the criteria
  		if($criteria == 'R') {
			$recipient = Recipient::where('id', '=', $id)
				->get();
		}

        # If no criteria, fetch all gifts
		else { 
				$recipient = Recipient::with('user')
					->where('user_id', '=', Session::get('user_id'))
					->get();
		}

		return $recipient;

	}
	
}