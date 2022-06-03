<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Branch extends Model
{
    //
    public function getNameAttribute($value){
		return $this->{app()->getLocale().'_name'};
	}

	public function addBranch($data){
		$new_branch                  			= new static();
		$new_branch->en_name                	= $data['branch_name'] ?? null;
		$new_branch->jp_name            		= $data['jp_branch_name'] ?? null;
		$new_branch->slug            			= isset($data['branch_name']) ? Str::slug($data['branch_name'],'-') : null;
		$new_branch->jp_slug         			= isset($data['jp_branch_name']) ? Str::slug($data['jp_branch_name'],'-') : null;
		$new_branch->phone     			        = $data['phone'] ?? 0;
		$new_branch->email     			        = $data['email'] ?? 0;
		$new_branch->en_description     		= $data['description'] ?? null;
		$new_branch->jp_description  			= $data['jp_description'] ?? null;
		$new_branch->status          			= $data['status'] ?? '1';
		$new_branch->is_main_branch   	        = $data['is_main_branch'] ?? '1';
		$new_branch->save();
		return $new_branch;
	}


	public function udpateBranch($data,$id){
		$selected_branch                  			= $this::findOrFail($id);
		$selected_branch->en_name                	= $data['branch_name'] ?? null;
		$selected_branch->jp_name            		= $data['jp_branch_name'] ?? null;
		$selected_branch->slug            			= isset($data['branch_name']) ? Str::slug($data['branch_name'],'-') : null;
		$selected_branch->jp_slug         			= isset($data['jp_branch_name']) ? Str::slug($data['jp_branch_name'],'-') : null;
		$selected_branch->phone     			    = $data['phone'] ?? 0;
		$selected_branch->email     			    = $data['email'] ?? 0;
		$selected_branch->en_description     		= $data['description'] ?? null;
		$selected_branch->jp_description  			= $data['jp_description'] ?? null;
		$selected_branch->status          			= $data['status'] ?? '1';
		$selected_branch->is_main_branch   	        = $data['is_main_branch'] ?? '1';
		$selected_branch->save();
		return $selected_branch;
	}
}
