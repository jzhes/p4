<?php

class Recipient extends Eloquent {

	/**
	* Identify relation between Recipient and Gift
	*/
	public function gift() {
        # Recipient may have more than one gift
        # Define a one-to-many relationship.
        return $this->hasMany('Gift');
    }

    /**
	* When editing or adding a new gift, we need a select dropdown of recipients to choose from
	*
	* @return Array
	*/
    public static function getIdNamePair() {

		$recipients = Array();

		$collection = Recipient::all();

		foreach($collection as $recipient) {
			$recipients[$recipient->id] = $recipient->first_name;
		}

		return $recipients;
	}

}