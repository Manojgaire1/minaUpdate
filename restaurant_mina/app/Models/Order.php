<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Order extends Model
{
    //


    public function createOrder($data){
    	$new_entry                      = new static();
    	$new_entry->customer_first_name = $data['first_name'] ?? null;
    	$new_entry->customer_last_name = $data['last_name'] ?? null;
    	$new_entry->customer_full_name = $data['first_name'] .' '. $data['last_name'];
    	$new_entry->customer_email     = $data['email'] ?? null;
    	$new_entry->customer_phone     = $data['phone'] ?? null;
    	$new_entry->total_amount       = $data['__cart_total'] ?? 0.00;
    	$new_entry->total_tax_amount   = $data['__cart_tax_total'] ?? 0.00;
    	$new_entry->grand_total_amount = $data['__cart_grand_total'] ?? 0.00;
    	$new_entry->branch_id          = $data['branch_id'] ?? null;
    	$new_entry->message            = $data['checkout_message'] ?? null;
    	//check the takeout type
    	if(array_key_exists("pickup_option", $data) && $data['pickup_option'] == "as_soon_as_possible"):
    		//as soon as possible
    		$current_time                = Carbon::now();
            $next_pickup_time            = $current_time->addMinutes(20);
            $new_entry->pickup_time      = Carbon::parse($next_pickup_time)->format('H:i');
    	elseif(array_key_exists("pickup_option", $data) && $data['pickup_option'] == "later"):
    		//at fixed time
    		$new_entry->pickup_type      = "1";
    		$new_entry->pickup_time      = Carbon::parse($data['selected_pickup_time'])->format('H:i');
    	endif;

    	//create the new record in the storage now
    	$new_entry->save();
    	return $new_entry;
    }
}
