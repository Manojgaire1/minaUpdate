<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    //

	//create the resevation requested from the reservatiion modal
	public function createModalReservation($data){
		$new_entry  						= new static();
		$new_entry->customer_full_name  	= $data['customerFullname'] ?? null;
		$new_entry->email  					= $data['customerEmail'] ?? null;
		$new_entry->phone  					= $data['customerPhone'] ?? null;
		$new_entry->reservation_date_time 	= $data['reservationDate'] ?? now();
		$new_entry->no_of_peoples  		    = $data['reservationPersons'] ?? '1';
		$new_entry->branch_name  		    = $data['reservationBranch'] ?? 'norimatsu-store';
		$new_entry->message  		        = $data['reservationMessage'] ?? null;
		$new_entry->save();
		return $new_entry;
	}

	//create the reservation from the reservation form
	public function createReservation($data){
		$new_entry  						= new static();
		$new_entry->customer_full_name  	= $data['fullname'] ?? null;
		$new_entry->email  					= $data['email'] ?? null;
		$new_entry->phone  					= $data['phone'] ?? null;
		$new_entry->reservation_date_time 	= $data['reservation_date'] ?? now();
		$new_entry->no_of_peoples  		    = $data['persons'] ?? '1';
		$new_entry->branch_name  		    = $data['branch'] ?? 'norimatsu-store';
		$new_entry->message  		        = $data['message'] ?? null;
		$new_entry->save();
		return $new_entry;
	}

    public static function changeStatus($data,$id){
    	$reservation_status = Reservation::where('id',$id)->update($data);
    	return $reservation_status;
    }

}
