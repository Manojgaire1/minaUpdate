<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    //

	public function addCategory($data){
		$new_category                  = new static();
		$new_category->en_name         = $data['category_name'] ?? null;
		$new_category->slug            = $data['category_name'] ?? Str::slug($data['category_name'],'-') ?? null;
		$new_category->jp_name         = $data['jp_category_name'] ?? null;
		$new_category->jp_slug         = $data['jp_category_name'] ?? Str::slug($data['jp_category_name'],'-') ?? null;
		$new_category->parent          = $data['parent_category_id'] ?? 0;
		$new_category->en_description     = $data['description'] ?? null;
		$new_category->jp_description  = $data['jp_description'] ?? null;
		$new_category->status          = $data['status'] ?? '1';
		$new_category->show_in_nav     = $data['show_in_nav'] ?? '1';
		$new_category->order           = $data['order'] ?? '10';
		$new_category->image_path      = $data['image_path'] ?? null;
		$new_category->save();
		return $new_category;

	}

	public function updateCategory($data,$id){
		$selected_category   = $this::findOrFail($id);
		$selected_category->en_name         = $data['category_name'] ?? $selected_category->name;
		$selected_category->slug            = $data['category_name'] ?? Str::slug($data['category_name'],'-') ?? $selected_category->slug;
		$selected_category->jp_name         = $data['jp_category_name'] ?? $selected_category->jp_name;
		$selected_category->jp_slug         = $data['jp_category_name'] ?? Str::slug($data['jp_category_name'],'-') ?? $selected_category->jp_slug;
		$selected_category->parent          = $data['parent_category_id'] ?? $selected_category->parent;
		$selected_category->en_description     = $data['description'] ?? null;
		$selected_category->jp_description     = $data['jp_description'] ?? null;
		$selected_category->status             = $data['status'] ?? $selected_category->status;
		$selected_category->show_in_nav        = $data['show_in_nav'] ?? $selected_category->show_in_nav;
		$selected_category->order           = $data['order'] ?? $selected_category->order;
		$selected_category->image_path      = $data['image_path'] ?? $selected_category->image_path;
		$selected_category->save();
		return $selected_category;
	}

	
    public function products(){
    	return $this->hasMany('App\Models\Product');
    }

    public function parent(){
    	return $this->belongsTo('App\Models\Category','parent')->where('parent',0)->with('parent');
    }

    protected function lastOrder(){
    	$last_order = $this->orderBy('created_at','desc')->select('order')->first();
    	if($last_order)
    		return $last_order->order;
    	return 0;
    }

    public function getNameAttribute($value){
        return $this->{app()->getLocale().'_name'};
    }

    public function getDescriptionAttribute($value){
        return $this->{app()->getLocale().'_description'};
    }


}
