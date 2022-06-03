<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Product extends Model
{
    //
    public function addProduct($data){
		$new_product                  			= new static();
		$new_product->number                	= $data['food_number'] ?? null;
		$new_product->en_name            		= $data['food_name'] ?? null;
		$new_product->slug            			= $data['food_name'] ?? Str::slug($data['food_name'],'-') ?? null;
		$new_product->jp_name         			= $data['jp_food_name'] ?? null;
		$new_product->jp_slug         			= $data['jp_food_name'] ?? Str::slug($data['jp_food_name'],'-') ?? null;
		$new_product->category_id     			= $data['category_id'] ?? 0;
		$new_product->en_description     		= $data['description'] ?? null;
		$new_product->jp_description  			= $data['jp_description'] ?? null;
		$new_product->status          			= $data['status'] ?? '1';
		$new_product->is_open_for_takeout   	= $data['is_takeout'] ?? '1';
		$new_product->is_available_for_change   = $data['__is_available_for_change'] ?? '0';
		$new_product->type                      = $this->checkProductType($data);
		$new_product->save();
		return $new_product;

	}

	public function updateProduct($data,$id){
		$selected_product   = $this::findOrFail($id);
		$selected_product->number               = $data['food_number'] ?? $selected_product->number;
		$selected_product->en_name              = $data['food_name'] ?? $selected_product->name;
		$selected_product->slug                 = $data['food_name'] ?? Str::slug($data['food_name'],'-') ?? $selected_product->slug;
		$selected_product->jp_name              = $data['jp_food_name'] ?? $selected_product->jp_name;
		$selected_product->jp_slug              = $data['jp_food_name'] ?? Str::slug($data['jp_food_name'],'-') ?? $selected_product->jp_slug;
		$selected_product->category_id           = $data['category_id'] ?? $selected_product->category_id;
		$selected_product->en_description         = $data['description'] ?? null;
		$selected_product->jp_description          = $data['jp_description'] ?? null;
		$selected_product->status                  = $data['status'] ?? $selected_product->status;
		$selected_product->is_open_for_takeout     = $data['is_takeout'] ?? $selected_product->is_open_for_takeout;
		$selected_product->is_available_for_change   = $data['__is_available_for_change'] ?? $selected_product->is_available_for_change;

		$selected_product->type            = $this->checkProductType($data);
		$selected_product->save();
		return $selected_product;
	}


	//a product have many orders but the order details was stored in teh order_details table
	public function orders(){
		return $this->belongsToMany('App\Models\Order','order_details','product_id');
	}


	public function images(){
		return $this->hasMany('App\Models\ProductImage');
	}

	public function productDetails(){
		return $this->hasMany('App\Models\ProductDetail');
	}

	public function category(){
		return $this->belongsTo('App\Models\Category');
	}

	/**
	 * function to check the product type
	 * @param $data
	 * @return string (simple / variable )
	 */
	protected function checkProductType($data){
		if(isset($data['product_type']) && $data['product_type'] == "simple")
			return "simple";
		return "variable";
	}

	public function getNameAttribute($value){
		return $this->{app()->getLocale().'_name'};
	}

	public function getDescriptionAttribute($value){
		return $this->{app()->getLocale().'_description'};
	}
}


