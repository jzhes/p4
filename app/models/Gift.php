<?php

class Gift extends Eloquent {

    # The guarded properties specifies which attributes should *not* be mass-assignable
    protected $guarded = array('id', 'created_at', 'updated_at');

    /**
    * Gift belongs to Recipient
    * Define an inverse one-to-many relationship.
    */
	public function recipient() {

        return $this->belongsTo('Recipient');

    }
	
	/**
	* Identify relation between Gift and User
	*/
	public function user() {

	   # Gift may only have one User
       return $this->belongsTo('User');
    }

    /**
    * Search among gifts, users, and recipients
    * @return Collection
    */
    public static function getData($criteria, $id) {

		# If there is criteria, get data using the criteria
  		if($criteria) {
			
			if ($criteria == "R") {
				$gifts = Gift::with('recipient')
					->where('user_id', '=', Session::get('user_id'))
					->where('recipient_id', '=', $id)
					->get();
			} 
			else
			if($criteria == "P") {
				$gifts = Gift::with('recipient')
					->where('user_id', '=', Session::get('user_id'))
					->where('purchased', '=', '1')
					->orderBy ('recipient_id')
					->get();
 				
            }
			else 
			if ($criteria == "NP") {
				$gifts = Gift::with('recipient')
					->where('user_id', '=', Session::get('user_id'))
					->where('purchased', '=', '0')
					-> orderBy ('recipient_id')
					->get();
			}
			else
			if ($criteria == "G") {
				$gifts = Gift::where('id', '=', $id)
						->first();
			} 
		}
        # If no criteria, fetch all gifts
		else {
				$gifts = Gift::with('recipient', 'user')
					->where('user_id', '=', Session::get('user_id'))
					-> orderBy ('recipient_id')
					->get();

		}

		return $gifts;

	}
	
	public static function calcTotal($gifts) {

		$total = 0;
 		foreach ($gifts as $gift) {
			$total += $gift->total;
		}

        return $total;
    }

}