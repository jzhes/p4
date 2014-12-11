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
    * Search among gifts, recipients and statuses
    * @return Collection
    */
    public static function getData($criteria, $id) {

        # If there is criteria, get data using the criteria
  		if($criteria) {
			
			if ($criteria == "R") {
				# Eager load recipients
				$gifts = Gift::with('recipient')
				->where('recipient_id', '=', $id)
					->get();
			} 
			else
			if($criteria == "P") {
				# Eager load recipients
				$gifts = Gift::with('recipient')
					->where('purchased', '=', '1')
					->get();
 				
            }
			else 
			if ($criteria == "NP") {
				# Eager load recipients
				$gifts = Gift::with('recipient')
					->where('purchased', '=', '0')
					->get();
			}
		}
        # If no criteria, fetch all gifts
		else {
				$gifts = Gift::with('recipient')->get();
		}

		return $gifts;

	}
	
	   public static function search($query) {

        # If there is a query, search with that query
  
 		if($query) {

            # Eager load statuses and recipients
            $gifts = Gift::with('recipient')
				->whereHas('recipient', function($q) use($query) {
					$q->where('first_name', 'LIKE', "%$query%");
				})
				->orWhere('item', 'LIKE', "%$query%")
				->get();

		}

	   # Otherwise, just fetch all gifts
 	else {
		
            $gifts = Gift::with('recipient')->get();
        }

        return $gifts;
    }
	
}