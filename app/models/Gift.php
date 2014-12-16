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
				# Eager load recipients
				$gifts = Gift::with('recipient')
					->where('user_id', '=', Session::get('user_id'))
					->where('recipient_id', '=', $id)
					->get();
			} 
			else
			if($criteria == "P") {
				# Eager load recipients
				$gifts = Gift::with('recipient')
					->where('user_id', '=', Session::get('user_id'))
					->where('purchased', '=', '1')
					->orderBy ('recipient_id')
					->get();
 				
            }
			else 
			if ($criteria == "NP") {
				# Eager load recipients
				$gifts = Gift::with('recipient')
					->where('user_id', '=', Session::get('user_id'))
					->where('purchased', '=', '0')
					-> orderBy ('recipient_id')
					->get();
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

    /**********************************************************/
	public static function search($query) {

        # If there is a query, search with that query
  		if($query) {

            # Eager load statuses and recipients
            $gifts = Gift::with('recipient')
				->whereHas('recipient', function($q) use($query) {
					$q->where('first_name', 'LIKE', "%$query%");
				})
				->where('user_id', '=', Session::get('user_id'))
				->orWhere('item', 'LIKE', "%$query%")
				->get();

		}

   # Otherwise, just fetch all gifts
 	else {
		
            $gifts = Gift::with('recipient')
				->where('user_id', '=', Session::get('user_id'))
				->get();
        }

        return $gifts;
    }	
}