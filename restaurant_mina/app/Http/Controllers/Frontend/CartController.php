<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductDetail;
use App\Models\Branch;
use App\Models\Setting;
use Carbon\Carbon;
use DB;

class CartController extends Controller
{
    //
    protected $tax = 8; // for now tax will be 8% charge
    protected $product_type = "simple";
    protected $new_product_id;
    protected $new_product_number;
    //attribute to store the each cart item product price
    protected $product_price         = 0.00;
    protected $qty                   = 1;
    protected $cart_prefix           = "__cart_item_";
    protected $product_exist_in_cart = false;
    protected $spicy_level           = "A";
    protected $__extra_spicy_price   = 0.00;
    protected $bbq_pcs;
    protected $cart_details          = array();
    protected $total_items_in_cart   = 0;
    protected $cart_total            = 0.00;
    protected $cart_tax              = 0.00;
    protected $cart_discount         = 0.00;
    protected $sub_total             = 0.00;
    protected $grand_total           = 0.00;
    protected $line_total            = 0.00;
    protected $discount_perentage    = 0.00;
    protected $discount_amount       = 0.0;
    protected $product_details;
    protected $pickup_time           = "11:15";

    //change pickupt time attributes
    protected $free_offer_nan        = 0;
    protected $_total_curry_in_cart  = 0;
    protected $__offer_return_html   = "";
    protected $__offer_message       = "";
    protected $__offer_still_valid   = false;

    //offer type
    protected $__offer_type          = "lunch";
    protected $lunch_offer           = false;
    protected $dinner_offer          = false;
    protected $offer_details_change  = "";
    protected $change_total          = 0.00;
    protected $is_discount_enable    = true;
    protected $discount_type         = "all";
    protected $discount_amount_type  = "percent";
    protected $discount_value        = 0.00;
    protected $discount_name         = "";
    protected $discount_total        = 0.00;


    /**
     *
     * show the list of the cart
     * @param void
     *
     */
    public function index(){
        return view('frontend.cart');
    }

	/**
	* function to add the item to the session
	* @param \Illuminate\Http\Request
	* @return \Illuminate\Http\Response
	**/
    public function addItemToCart(Request $request){
    	$this->new_product_id     = $request->input('__productId');
    	$this->product_details    = Product::findOrFail($this->new_product_id);
    	$this->new_product_number = $request->input('__productNumber');
    	$this->qty                = $request->input('qty');

    	//check the added product is of curry type
    	if($request->has('spicy')):
    		$this->spicy_level    =  $request->input('spicy');
    	endif;
    	//check the added product if of bbq type
    	if($request->has('bbq_pcs')):
    		$this->bbq_pcs        = $request->input('bbq_pcs');
    	endif;
    	//check the product actually is in the cart or not
    	if($request->session()->has('cart_details')):
    		//there exists the product in the cart already
    		$this->cart_details = $request->session()->get('cart_details');
    		foreach($this->cart_details as $index=>$cart_item):
    			if($index == "__cart_item"):
	    			foreach($cart_item as $item=>$cart_product):
		    				foreach($cart_product as $key=>$value):
		    					//check the product_id exist in the cart or not
		    					if($key == "__product_id"):
		    						if($value == $this->new_product_id):
		    							$this->product_exist_in_cart = true;
		    						endif;
		    					endif;
		    					// update the item if exist or add new item
		    					if($this->product_exist_in_cart):
		    						$this->updateOrAddNewItemInCart($request,$cart_product,$index,$item,$update_qty=false);
                                    break 3;
		    					else:
                                    continue;
                                endif;
		    				endforeach; // end of the cart item product details
	    			endforeach; // end of the cart item loop
	    		endif;
    		endforeach; // end of the cart loop
            // no of the product has been added then
            if(!$this->product_exist_in_cart):
                $this->addNewItem($request);
            endif;
    	else:
    		//no item added in the cart yet
    		$this->addNewItem($request);
    	endif;
        //check the seesion have pickup time set and the request has spicy level then need to check for the offer as well and send the offer response back to client
    	//need to send success message to the client
        return response()->json(
            array(
                'status'                => 'success', 
                'message'               => __('form.added-to-takeout-msg'), 
                'title'                 => __('form.added-success-title'),
                'cart_details'          => view('frontend.inc.minaCart')->render(),
                '__total_items_in_cart' => $this->total_items_in_cart,
                '__total_items'         => __('form.items-in-cart',['item'=>$this->total_items_in_cart])
            ),200);
    }


    /**
	* function to remove the item from the session
	* @param \Illuminate\Http\Request, (string)$cart_item_id
	* @return \Illuminate\Http\Response
	**/
    public function removeItemFromCart(Request $request, $cart_item_id){
    	//remove the item from the cart
        if($request->session()->has('cart_details')):
            $this->cart_details = $request->session()->get('cart_details');
            if(array_key_exists($cart_item_id, $this->cart_details["__cart_item"])):
                //unset the key from the cart details
                unset($this->cart_details["__cart_item"][$cart_item_id]);
                //call the function to set and update the cart amount
                //check for the offer details and update cart
                if(Session::has('pickup_time')):
                    $this->checkFreeServiceNaan(Session::get('pickup_time'),$remove=true);
                else:
                    $this->updateCartAmount();
                endif;
                //show the empty cart when all the cart item has been removed
                if($this->total_items_in_cart == 0):
                    $cart_return_html = '<div class="__no_item_cart_header">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="__no_item_in_cart">
                                                        <h4>'. __("form.no-item-in-cart-heading").'</h4>
                                                        <p>'.__("form.no-item-in-cart").'</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>';
                    $cart_empty    = '<div class="no-cart-added">
                                        <div class="container">
                                            <div class="empty-cart-thumbnail">
                                                <img src="'.asset("/front-assets/images/empty_cart.png").'" alt="Mina empty cart">
                                            </div>
                                            <div class="empty-cart-message">
                                                <h3'.__("form.no-item-in-cart-heading").'</h3>
                                                <p>'. __("form.no-item-in-cart") .'</p>
                                                <a href="'.route("frontend.menupage").'" class="btn btn--primary">'. __("form.takeout.back-to-menu").'</a>
                                            </div>
                                        </div>
                                    </div>';
                    //unset the offer details as well
                    if(Session::has('__offer_details')):
                        Session::forget('__offer_details');
                    endif;
                else:
                    $cart_return_html = "";
                    $cart_empty       = "";
                endif;
                //send the valid response to the client
                return response()->json(
                    array(
                        'status'                => 'success' ,
                        'message'               =>__('form.item-removed'),
                        'title'                 => __('form.item-removed-title'),
                        '__cart_total'          => number_format($this->cart_total,0), 
                        '__cart_tax'            => number_format($this->cart_tax,0), 
                        '__grand_total'         => number_format($this->grand_total,0),
                        '__total_items_in_cart' => $this->total_items_in_cart, 
                        '__total_items'         => __('form.items-in-cart',['item'=>$this->total_items_in_cart]),
                        '__cart_html'           => $cart_return_html,
                        '__cart_empty_html'     => $cart_empty,
                        '__offer_details'       => $this->offer_details_change,
                        '__offer_total'         => number_format($this->change_total,0),
                        '__free_service_naan'   => $this->free_offer_nan,
                        'is_discount_enable'    => $this->is_discount_enable,
                        'discount_amount'       => number_format($this->cart_discount,0),
                        'discount_name'         => $this->discount_name,
                    ),200);
            else:
                return response()->json(
                    array(
                        'status'                => 'failed' ,
                        'message'               => __('form.item-removed-failed-msg') ,
                        'title'                 => __('form.item-removed-failed-title') ),200);
            endif;
        endif;
    	// call udpate cart amount
    }


    /**
	* function to add the item to the session
	* @param \Illuminate\Http\Request
	* @return \Illuminate\Http\Response
	**/
    public function udpateItemQty(Request $request, $item_id){
        $this->cart_details = $request->session()->get('cart_details');
        if(array_key_exists($item_id, $this->cart_details["__cart_item"])):
            $this->qty     = $request->input('__qty');
            $cart_product  = $this->cart_details["__cart_item"][$item_id];
        	$this->updateOrAddNewItemInCart($request,$cart_product,"__cart_item", $item_id,$update_qty=true);
            //return the success response
            return response()->json(
                array(
                    'status'                => 'success' ,
                    'message'               => __('form.cart-updated-success-msg') ,
                    'title'                 => __('form.cart-updated-success-title'), 
                    '__line_total'          => number_format($this->line_total,0), 
                    '__cart_total'          => number_format($this->cart_total,0), 
                    '__cart_tax'            => number_format($this->cart_tax,0), 
                    '__grand_total'         => number_format($this->grand_total,0),
                    "__total_items_in_cart" => $this->total_items_in_cart, 
                    '__total_items'         => __('form.items-in-cart',['item'=>$this->total_items_in_cart]),
                    '__offer_details'       => $this->offer_details_change,
                    '__offer_total'         => number_format($this->change_total,0),
                    '__free_service_naan'   => $this->free_offer_nan,
                    'is_discount_enable'    => $this->is_discount_enable,
                    'discount_amount'       => number_format($this->cart_discount,0),
                    'discount_name'         => $this->discount_name
                ),200);
        else:
            //return the false response
            return response()->json(
                array(
                    'status'    => 'failed' ,
                    'message'   => __('form.cart-update-failed-msg') ,
                    'title'     => __('form.cart-udpate-failed-title') 
                ),200);
        endif;
    }


    /**
	* function to add the item to the session
	* @param \Illuminate\Http\Request
	* @return \Illuminate\Http\Response
	**/
    public function updateItemSpicyLevel(Request $request,$item_id){
    	//udpate the item spicy level if it of curry type
        $this->cart_details = $request->session()->get('cart_details');
        //check the spicy level exits or not
        if(array_key_exists($item_id, $this->cart_details["__cart_item"])):
            //assign the requested qty in the variable
            $this->qty     = $request->input('__qty');
            //check the request has spicy level or not
            if($request->has('spicy')):
                $this->spicy_level    =  $request->input('spicy');
            endif;
            //assign the session data into the cart_product variable
            $cart_product  = $this->cart_details["__cart_item"][$item_id];
            //call the function to update or add new time in cart
            $this->updateOrAddNewItemInCart($request,$cart_product,"__cart_item", $item_id,$update_qty=true);
            //return the success response
            return response()->json(
            array(
                'status'                => 'success' ,
                'message'               => __('form.cart-updated-success-msg') ,
                'title'                 => __('form.cart-updated-success-title'), 
                '__line_total'          => number_format($this->line_total,0),
                '__cart_total'          => number_format($this->cart_total,0), 
                '__cart_tax'            => number_format($this->cart_tax,0), 
                '__grand_total'         => number_format($this->grand_total,0),
                '__extra_spicy_price'   => number_format($this->__extra_spicy_price,0),
                '__total_items_in_cart' => $this->total_items_in_cart,
                '__total_items'         => __('form.items-in-cart',['item'=>$this->total_items_in_cart]),
                '__offer_details'       => $this->offer_details_change,
                '__offer_total'         => number_format($this->change_total,0),
                '__free_service_naan'   => $this->free_offer_nan,
                'is_discount_enable'    => $this->is_discount_enable,
                'discount_amount'       => number_format($this->cart_discount,0),
                'discount_name'         => $this->discount_name,
            ),200);
        else:
            //return the false response
            return response()->json(
                array(
                    'status'    => 'failed' ,
                    'message'   => __('form.cart-update-failed-msg') ,
                    'title'     => __('form.cart-udpate-failed-title') 
                ),200);
        endif;
    }

    /**
	* function to add the item to the session
	* @param \Illuminate\Http\Request
	* @return \Illuminate\Http\Response
	**/
    public function updateItemPcs(Request $request,$item_id){
        //udpate the item spicy level if it of curry type
        $this->cart_details = $request->session()->get('cart_details');
        //check the spicy level exits or not
        if(array_key_exists($item_id, $this->cart_details["__cart_item"])):
            //assign the requested qty in the variable
            $this->qty     = $request->input('__qty');
            //check the request has spicy level or not
            if($request->has('bbq_pcs')):
                $this->bbq_pcs    =  $request->input('bbq_pcs');
            endif;
            //assign the session data into the cart_product variable
            $cart_product  = $this->cart_details["__cart_item"][$item_id];
            //call the function to update or add new time in cart
            $this->updateOrAddNewItemInCart($request,$cart_product,"__cart_item", $item_id,$update_qty=true);
            //return the success response
            return response()->json(
            array(
                'status'                => 'success' ,
                'message'               => __('form.cart-updated-success-msg') ,
                'title'                 => __('form.cart-updated-success-title'), 
                '__line_total'          => number_format($this->line_total,0),
                '__cart_total'          => number_format($this->cart_total,0), 
                '__cart_tax'            => number_format($this->cart_tax,0), 
                '__grand_total'         => number_format($this->grand_total,0),
                '__extra_spicy_price'   => number_format($this->__extra_spicy_price,0),
                '__total_items_in_cart' => $this->total_items_in_cart,
                '__product_price'       => number_format($this->product_price->price,0),
                '__total_items'         => __('form.items-in-cart',['item'=>$this->total_items_in_cart]),
                '__offer_details'       => $this->offer_details_change,
                '__offer_total'         => number_format($this->change_total,0),
                '__free_service_naan'   => $this->free_offer_nan,
                'is_discount_enable'    => $this->is_discount_enable,
                'discount_amount'       => number_format($this->cart_discount,0),
                'discount_name'         => $this->discount_name
            ),200);
        else:
            //return the false response
            return response()->json(
                array(
                    'status'    => 'failed' ,
                    'message'   => __('form.cart-update-failed-msg') ,
                    'title'     => __('form.cart-udpate-failed-title') 
                ),200);
        endif;
    }

    /**
	* function to add the item to the session
	* @param \Illuminate\Http\Request
	* @return \Illuminate\Http\Response
	**/
    protected function updateCartAmount($change_total=0, $has_offer_details = false,$remove_offer_details=true){
    	// here need to update the cart total, tax, discount and calculate the total
    	foreach($this->cart_details as $index=>$cart_item):
    		if($index == "__cart_item"):
	    		foreach($cart_item as $item=>$cart_product):
	    			foreach($cart_product as $key=>$value):
	    				if($key == "__line_total"):
	    					$this->cart_total += $value;
	    				endif;

                        if($key == "__qty"):
                            $this->total_items_in_cart += $value;
                        endif;

	    			endforeach;
	    		endforeach;
	    	endif;
    	endforeach;

    	//$this->cart_total   = $this->line_total;
        if($change_total > 0 && $has_offer_details):
            if(!$remove_offer_details):
                $this->cart_total   = ($this->cart_total + $change_total);
            else:
                //$this->cart_total   = ($this->cart_total - $change_total);
            endif;
        endif;
        $this->sub_total    = $this->cart_total;
    	$this->cart_tax     = round(($this->cart_total * $this->tax / 100));
        //check the cart discount exists or not
        $this->checkDiscountStatus();
        if($this->is_discount_enable):
            //calculate the cart discount
            $this->calculateDiscountTotal();
            $this->grand_total  = round(($this->cart_total + $this->cart_tax) - $this->cart_discount);
        else:
    	   $this->grand_total  = round($this->cart_total + $this->cart_tax);
        endif;
    	//set the data in the session
    	$this->cart_details['__cart_total']  		     = $this->cart_total;
    	$this->cart_details['__sub_total']   		     = $this->sub_total;
    	$this->cart_details['__cart_tax']    		     = round($this->cart_tax);
    	$this->cart_details['__grand_total'] 		     = round($this->grand_total);
    	$this->cart_details['__discount_name']           = $this->discount_name;
    	$this->cart_details['__discount_amount']         = round($this->cart_discount);
        $this->cart_details['__is_discount_enabled']     = round($this->is_discount_enable);

    	//if session has been set or not
    	if(Session::has('cart_details'))
    		Session::forget('cart_details');

        //unset the session
        if($this->total_items_in_cart <= 0):
            //session has the pickup branch name
            if(Session::has("_pickup_branch_name")):
                Session::forget('_pickup_branch_name');
            endif;
            //remove the pickup time
            if(Session::has('pickup_time')):
                Session::forget('pickup_time');
            endif;
        endif;
    	Session::put('cart_details',$this->cart_details);
    }



    /**
     * function to change the pickup time for the takeout
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     **/
    public function changePickupTime(Request $request){
        $pickup_time = $request->input('pickup_time');
        //delete the old pickup time if present
        if($request->session()->has('pickup_time'))
            $request->session()->forget('pickup_time');
        $request->session()->put('pickup_time',$pickup_time);
        $this->cart_details  = Session::get('cart_details');
        $check_free_naan = $this->checkFreeServiceNaan($pickup_time);
        if($check_free_naan):
            return response()->json(
                array(
                    'status'               => 'success',
                    'message'              => $this->__offer_message,
                    'title'                => __('form.change-takeout-time'),
                    '__offer_return_html'  => $this->__offer_return_html,
                    '__offer_still_valid'  => $this->__offer_still_valid,
                    '__cart_total'         => number_format($this->cart_details['__cart_total'],0),
                    '__cart_tax_total'     => number_format($this->cart_details['__cart_tax'],0),
                    '__cart_grand_total'   => number_format($this->cart_details['__grand_total'],0),
                    '__offer_total'        => number_format($this->change_total,0),
                    'is_discount_enable'   => $this->is_discount_enable,
                    'discount_amount'      => number_format($this->cart_discount),
                    'discount_name'        => $this->discount_name
                )
                ,200);
        else:
            return response()->json(
                array(
                    'status'            => 'success',
                    'message'           => __('form.change-takeout-time-success'),
                    'title'             => __('form.change-takeout-time'),
                    'offer_exist'       => false,
                ),200);
        endif;
    }



    /**
     * function to get the pickup time by branch name
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     **/
    public function getBranchPickupTime(Request $request){
        $pickup_branch_name = $request->input('_pickup_branch_name');
        //delete the old pickup time if present
        if($request->session()->has('_pickup_branch_name'))
            $request->session()->forget('_pickup_branch_name');
        $request->session()->put('_pickup_branch_name',$pickup_branch_name);
        //send the response back to the client
        //need to udpate the cart with the service naan available
        return response()->json(array('status' => 'success' ,'message' => __('form.change-takeout-time-lunch-offer'),'title' => __('form.change-takeout-time'),'__branch_pickup_time' => generateTakeoutTime($takeout_interval=15,$branch=$pickup_branch_name)),200);
    }

    /**
	* function to add the item to the session
	* @param time($pickup_time)
	* @return \Illuminate\Http\Response
	**/
    protected function checkFreeServiceNaan($pickup_time,$remove=false){
        $this->checkOfferType($pickup_time);
        //calcuate the total curry in the cart function call
        $this->calcuateCurryTotalInCart();
        //check the curry exits in cart
        if($this->_total_curry_in_cart > 0):
            //calculate the free offer naan
            $this->calculateFreeOfferNaan();
            if($this->free_offer_nan > 0):
                // check the session has offer details or not
                if(Session::has('__offer_details')):
                    //session has lunch offer but pickup time is for dinner
                    if($this->dinner_offer && ($this->__offer_type == "lunch")):
                        $this->updateOfferDetailsIfExists();
                    //session has dinner offer but pickup time is for lunch
                    elseif($this->lunch_offer && ($this->__offer_type == "dinner" )):
                        $this->updateOfferDetailsIfExists();
                    else:
                    //session offer match with the pickup time
                        $this->__offer_still_valid = true;
                        //check for the curry qty change or new curry has been added
                        $this->updateOfferDetailsWithCurryChange($remove);
                    endif;
                else:
                    $this->updateOfferDetailsIfExists();
                endif;
                //render the return html
                $this->renderOfferDetailsHtml();
                return true;
            else:
                $this->removeOfferDetailsSession();
                $this->updateCartAmount($change_total = 0,$has_offer_details = false,$remove_offer_details=false);
                return false;
            endif;
        else:
            //send the response back to the client
            $this->removeOfferDetailsSession();
            $this->updateCartAmount($change_total = 0,$has_offer_details = false,$remove_offer_details=false);
            return false;
        endif;

        //need to update the cart total 
    }

     /**
    * function to total curry qty in the cart
    * @param void
    * @return void
    **/
    protected function calcuateCurryTotalInCart(){
        //loop through the each items in cart
        foreach($this->cart_details as $index=>$cart_item):
            if($index == "__cart_item"):
                foreach($cart_item as $item=>$cart_product):
                    if(array_key_exists('__spicy_level',$cart_product)):
                        $this->_total_curry_in_cart  += $cart_product['__qty']; 
                    endif;
                endforeach;
            endif;
        endforeach;
    }

     /**
    * function to calculate free offer naan
    * @param void
    * @return void
    **/
    protected function calculateFreeOfferNaan(){
        if($this->lunch_offer):
            $this->free_offer_nan = $this->_total_curry_in_cart;
            //set the offer type to lunch offer
            $this->__offer_type    = Session::get('__offer_type');
            if(Session::has('__offer_type')):
                Session::forget('__offer_type');
            endif;
            Session::put('__offer_type','lunch');
        else:
            if($this->dinner_offer):
                if($this->_total_curry_in_cart >=3 ): //only 3 curry have 1 service naan free
                    for($i=3; $i <= $this->_total_curry_in_cart; $i+=3):
                        $this->free_offer_nan++;
                    endfor;
                endif;
                //check the free offer nan
                $this->__offer_type    = Session::get('__offer_type');
                if(Session::has('__offer_type')):
                    Session::forget('__offer_type');
                endif;
                 Session::put('__offer_type','dinner');
            endif;
        endif;
    }



     /**
    * function to remove the offer details session
    * @param void
    * @return void
    **/
    protected function removeOfferDetailsSession(){
        if(Session::has('__offer_details')):
            Session::forget('__offer_details');
        endif;
    }

     /**
    * function to render the offer details return html
    * @param void
    * @return void
    **/
    protected function renderOfferDetailsHtml(){
        $free_base_product    = Product::findOrFail(94);
        $this->__offer_return_html = '
                    <div class="item-price">
                       <div class="price">(<span class="__product_qty">'.$this->free_offer_nan.'</span> × '.$free_base_product->name.')</div>
                    </div>';
        if($this->lunch_offer):
            $this->__offer_message = __('form.change-takeout-time-lunch-offer');
        else:
            $this->__offer_message = __('form.change-takeout-time-dinner-offer');
        endif;
    }

     /**
    * function to check for the lunch offer or the dinner offer
    * @param $pickup_time
    * @return void
    **/
    protected function checkOfferType($pickup_time){
        $branch = Session::get('_pickup_branch_name');
        // check for the current time
        $current_date_time = Carbon::now();
        $weekday = Carbon::parse($current_date_time)->format('N');
        if($weekday == 6 || $weekday == 7):
        //luch open time
            $__lunch_open_time = Setting::where('meta_key',$branch.'-weekend-lunch-open-time')->first();
            //lunch close time
            $__lunch_close_time = Setting::where('meta_key',$branch.'-weekend-lunch-close-time')->first();
            //dinner open time 
            $__dinner_open_time = Setting::where('meta_key',$branch.'-weekend-dinner-open-time')->first();
            //dinner close time
            $__dinner_close_time = Setting::where('meta_key',$branch.'-weekend-dinner-close-time')->first();
        else:
            //mina weekday
            //luch open time
            $__lunch_open_time = Setting::where('meta_key',$branch.'-weekday-lunch-open-time')->first();
            //lunch close time
            $__lunch_close_time = Setting::where('meta_key',$branch.'-weekday-lunch-close-time')->first();
            //dinner open time 
            $__dinner_open_time = Setting::where('meta_key',$branch.'-weekday-dinner-open-time')->first();
            //dinner close time
            $__dinner_close_time = Setting::where('meta_key',$branch.'-weekday-dinner-close-time')->first();
        endif;
        //loop throgh the lunc time
        $__pickup_time      = strtotime($pickup_time);
        $_lunch_start_time  = strtotime($__lunch_open_time->meta_value);
        $_lunch_end_time    = strtotime($__lunch_close_time->meta_value);
        $_dinner_start_time = strtotime($__dinner_open_time->meta_value);
        $_dinner_end_time   = strtotime($__dinner_close_time->meta_value);
        // if the current time is within 10:30am - 02:30 pm then a curry with have the free service naan
        if($__pickup_time >= $_lunch_start_time && $__pickup_time <= $_lunch_end_time):
            //lunch offer get one naan free one curry
           $this->lunch_offer   = true;
        else:
            //dinner offer get 1 service naan free for 3 curry
            $this->dinner_offer = true;
            //check the
        endif;
    }

    /**
    * function to update the offer details as per the pickup time and offer
    * @param void
    * @return void
    **/
    protected function updateOfferDetailsIfExists(){
        $free_base_product    = Product::findOrFail(94);
        //add new offer details
        $offer_details['__offer_details']  = array(
            '__offer_qty'       => $this->free_offer_nan,
            '__change_qty'      => $this->free_offer_nan,
            '__change_total'    => 0.00,
            '__change_details'  => array(
                array(
                    '__product_id'    => 94,
                    '__product_name'  => $free_base_product->name,
                    '__product_price' => 0.00,
                    '__line_total'    => 0.00,
                    '__qty'           => $this->free_offer_nan
                )
            )
        ); 

        //set the data in the sesssion
        if(Session::has('__offer_details')):
            $session_offer_details = Session::get('__offer_details');
            $this->updateCartAmount($change_total = $session_offer_details['__offer_details']['__change_total'],$has_offer_details = true,$remove_offer_details=true);
            Session::forget('__offer_details');
        endif;
        //need to call the function to update the offer details
         $this->updateOfferAfterCurryAdjustment($offer_details,$this->free_offer_nan);
        Session::put('__offer_details',$offer_details);
    }


    /**
    * function to update the offer details as per curry qty change or newly added
    * @param boolean($remove)
    * @return void
    **/
    protected function updateOfferDetailsWithCurryChange($remove){
        // get the existing offer details
        $found = false;
        $found_index = 0;
        $offer_details        = Session::get('__offer_details');
        $offer_change_details = $offer_details['__offer_details']['__change_details'];
        // get free naan qty
        $__free_service_naan  = $this->free_offer_nan;
        // get change total qty
        $__change_qty         = $offer_details['__offer_details']['__change_qty'];
        // comapare total qty
        if($__free_service_naan > $__change_qty):
            // new spicy has been added
            //check the offer details has 
            foreach($offer_change_details as $index=>$change_details):
                if($change_details['__product_id'] == 94):
                    //increase qty of 94 
                    //found true
                    $found_index = $index;
                    $found = true;
                endif;
            endforeach;
            // plain naan has been added already need to increase the qty only
            if($found){
                $offer_details['__offer_details']['__change_details'][$found_index]['__qty'] = ($offer_details['__offer_details']['__change_details'][$found_index]['__qty'] + ($__free_service_naan - $offer_details['__offer_details']['__offer_qty']));
                $this->updateOfferAfterCurryAdjustment($offer_details,$__free_service_naan);
                
            }else{
                //add new item to the free offers
                 $free_base_product    = Product::findOrFail(94);
                 $new_added_offer       =  array(
                    '__product_id'      => 94,
                    '__product_name'    => $free_base_product->name,
                    '__product_price'   => 0.00,
                    '__line_total'      => 0.00,
                    '__qty'             => ($__free_service_naan - $offer_details['__offer_details']['__offer_qty']),
                 );
                  $offer_details['__offer_details']['__change_details'][] = $new_added_offer;
                $this->updateOfferAfterCurryAdjustment($offer_details,$__free_service_naan);
            }
        elseif($__free_service_naan == $__change_qty):
            //equal to the change no need to update the offer details
            $this->updateCartAmount($offer_details['__offer_details']['__change_total'],$has_offer_details=true,$remove_offer_details=false);
            $this->renderOfferHtmlAfterCurryAdjustment($offer_details);
        else:
            if(!$remove):
                //need to deduct the offer details
                // get the offer change details last
                $change_items_count   = count($offer_details['__offer_details']['__change_details']);
                // if qty greater than 1 
                $change_details_last_item_qty = $offer_details['__offer_details']['__change_details'][--$change_items_count]['__qty'];
                $change_details_last_item_product_id = $offer_details['__offer_details']['__change_details'][$change_items_count]['__product_id'];

                //if the last item is not plain naan then we need to recalcuate the offer details and cart total
                if($change_details_last_item_product_id == 94):
                    //just deduct the qty or remove the item is equal to 1
                    if($change_details_last_item_qty > 1):
                        $offer_details['__offer_details']['__change_details'][$change_items_count]['__qty'] = ($offer_details['__offer_details']['__change_details'][$change_items_count]['__qty'] - ($offer_details['__offer_details']['__offer_qty'] - $__free_service_naan));
                    else:
                        unset($offer_details['__offer_details']['__change_details'][$change_items_count]);
                    endif;
                    $this->updateOfferAfterCurryAdjustment($offer_details,$__free_service_naan);
                else:
                    //deduct the qty or remove the item is equal to 1
                    if($change_details_last_item_qty > 1):
                        $offer_details['__offer_details']['__change_details'][$change_items_count]['__qty'] = ($offer_details['__offer_details']['__change_details'][$change_items_count]['__qty'] - ($offer_details['__offer_details']['__offer_qty'] - $__free_service_naan));
                        // get the product price
                        $product_price = $offer_details['__offer_details']['__change_details'][$change_items_count]['__product_price'];
                        //update the line total
                        $offer_details['__offer_details']['__change_details'][$change_items_count]['__line_total'] = ( $offer_details['__offer_details']['__change_details'][$change_items_count]['__qty'] * $product_price);
                    else:
                        unset($offer_details['__offer_details']['__change_details'][$change_items_count]);
                    endif;
                    // update offer total
                     $__change_total = 0.00;
                     foreach($offer_details['__offer_details']['__change_details'] as $change_details):
                        $__change_total += $change_details['__line_total'];
                     endforeach;
                     $offer_details['__offer_details']['__change_total'] = $__change_total;
                     $this->updateOfferAfterCurryAdjustment($offer_details,$__free_service_naan);
                endif;
            else:
                //item has been remove from the cart
                //get the total item to dedcut
                // buffer_qty = change_qty - free offer naan
                $total_item_to_deduct = ($offer_details['__offer_details']['__change_qty'] - $this->free_offer_nan);
                // buffer offer details = offer_details['change_details']
                $deduct_buffer_details = $offer_change_details;
                $deduct_buffer_details_length = count($deduct_buffer_details);
                $i = 1;
                $buffer_qty = 0;
                foreach($deduct_buffer_details as $deduct_buffer_detail):
                    //get last item
                    $last_buffer_item = $deduct_buffer_details[($deduct_buffer_details_length - $i)];
                    $buffer_qty += $last_buffer_item['__qty'];
                    if($buffer_qty > $total_item_to_deduct):
                        //deduct the qty buffer qty - $this->free_offer_naan from change details and calcualte the line total and break it
                        if($deduct_buffer_details_length == 1):
                            $offer_change_details[$deduct_buffer_details_length - $i]['__qty'] = ($this->free_offer_nan);
                            $offer_change_details[$deduct_buffer_details_length - $i]['__line_total'] = $last_buffer_item['__product_price'] * ($this->free_offer_nan);
                        else:
                             $offer_change_details[$deduct_buffer_details_length - $i]['__qty'] = ($buffer_qty - $total_item_to_deduct);
                            $offer_change_details[$deduct_buffer_details_length - $i]['__line_total'] = $last_buffer_item['__product_price'] * ($buffer_qty - $total_item_to_deduct);
                        endif;
                        break;
                    elseif($buffer_qty == $this->free_offer_nan):
                        // remove all item and break it
                        unset($offer_change_details[$deduct_buffer_details_length - $i]);
                        break;
                    else:
                        // remove item and continue to next item
                        unset($offer_change_details[$deduct_buffer_details_length - $i]);
                    endif;
                    $i++;
                endforeach;
                // calculate the change total
                $buffer_change_total = 0;
                foreach($offer_change_details as $offer_change){
                    $buffer_change_total += $offer_change['__line_total'];
                }
                $offer_details['__offer_details']['__change_total'] = $buffer_change_total;
                $offer_details['__offer_details']['__change_details'] = $offer_change_details;
                //now call the function to render the 
                $this->updateOfferAfterCurryAdjustment($offer_details, $this->free_offer_nan);
            endif;
        endif;
    }

    /**
    * function to change offer details after curry addition or deletion
    * @param (array) $offer_details, (int) $__free_service_naan
    * @return void
    **/
    protected function updateOfferAfterCurryAdjustment($offer_details,$__free_service_naan){
         $offer_details['__offer_details']['__offer_qty'] = $__free_service_naan;
         $offer_details['__offer_details']['__change_qty'] = $__free_service_naan;
         Session::forget('__offer_details');
         Session::put('__offer_details',$offer_details);
         //need to update the cart amount
         $this->updateCartAmount($offer_details['__offer_details']['__change_total'],$has_offer_details=true,$remove_offer_details=false);

         //call the render offer html function
         $this->renderOfferHtmlAfterCurryAdjustment($offer_details);
    }


    /**
    * function to render the offer html after curry addition or deletion
    * @param (array) $offer_details
    * @return void
    **/
    protected function renderOfferHtmlAfterCurryAdjustment($offer_details){

        foreach($offer_details['__offer_details']['__change_details'] as $change_details){
            $product_name[] = $change_details['__product_name'];
            $product_qty[]  = $change_details['__qty'];
            $this->change_total += $change_details['__line_total'];
        }

        for($i=0; $i < count($product_name); $i++){
            if($product_qty[$i] > 0):
                    $this->offer_details_change .= '<div class="item-price">
                       <div class="price">(<span class="__product_qty">'.$product_qty[$i].'</span> × '.$product_name[$i].')</div>
                    </div>';
            endif;
        }

    }




    /**
    * function to update the service naan details
    * @param \Illuminate\Http\Request
    * @return \Illuminate\Http\Response
    **/
    public function updateServiceNaan(Request $request){
        $__change_details            = array();
        $return_html                 = "";
        //get the request data
        $__change_free_naan_product  = $request->get('__change_free_naan_product');
        $__change_free_naan_qty      = $request->get('__change_free_naan_qty');
        //initialize the variable
        $__change_total              = 0.00;
        $__change_qty                = 0;
        $__offer_qty                 = $request->input('__free_service_naan');

        //loop through the request
        for($i=0; $i < count($__change_free_naan_product); $i++):
            $__product_details     = Product::findOrFail($__change_free_naan_product[$i]);
            $__product_price       = $__product_details->productDetails()->first()->change_price;
            $__product_qty         = $__change_free_naan_qty[$i];
            $__line_total          = ($__product_price * $__product_qty);
            $__change_total       += $__line_total;
            $__change_qty         += $__product_qty;
            $return_html          .= "<div class='price'>( <span class='__product_qty'>".$__product_qty."<span> ×". " ".$__product_details->name." )</div>";

            $__change_details[$i]   = [
                '__product_id'    => $__product_details->id,
                '__product_name'  => $__product_details->name,
                '__product_price' => $__product_price,
                '__line_total'    => $__line_total,
                '__qty'           => $__product_qty
                ]; 
        endfor;

        //check the change total is equal or less than change details
        if($__offer_qty > $__change_qty){
            $free_base_product      = Product::findOrFail(94);
            $__change_details[$i]   = [
                '__product_id'    => $free_base_product->id,
                '__product_name'  => $free_base_product->name,
                '__product_price' => $__product_price,
                '__line_total'    => '0.00',
                '__qty'           => ($__offer_qty - $__change_qty)
                ]; 
             $return_html          .= "<div class='price'>( <span class='__product_qty'>".($__offer_qty - $__change_qty)."<span> *". " ".$free_base_product->name." )</div>";
        }

        //render the data to add to the session
        $offer_details['__offer_details']  = array(
            '__offer_qty'          => $__offer_qty,
            '__change_qty'         => $__change_qty,
            '__change_total'       => $__change_total,
            '__change_details'     => $__change_details
        ); 

        //forget the session
        if($request->session()->has('__offer_details')):
            $request->session()->forget('__offer_details');
        endif;
        //set the data in the sesssion
        $request->session()->put('__offer_details',$offer_details);
        $this->cart_details     = Session::get('cart_details');

        //update the cart total
        $this->updateCartAmount($change_total = $__change_total,$has_offer_details=true,$remove_offer_details=false);
        //get cart total details from the cart sessions
        $cart_total       = $this->cart_details['__cart_total'];
        $cart_tax         = $this->cart_details['__cart_tax'];
        $cart_grand_total = $this->cart_details['__grand_total'];

        //send the response back to the client 
        return response()->json(array(
            'status'                => 'success',
            'message'               => __('form.change-service-naan-sucess'),
            'title'                 => __('form.change-service-naan-success-title'),
            'return_html'           => $return_html,
            'change_total'          => number_format($__change_total,0),
            '__cart_total'          => number_format($cart_total,0),
            '__cart_tax'            => number_format($cart_tax,0),
            '__cart_grand_total'    => number_format($cart_grand_total,0),
            'is_discount_enable'    => $this->is_discount_enable,
            'discount_amount'       => number_format($this->cart_discount,0),
            'discount_name'         => $this->discount_name,

        ),200); 
    }

    /**
	* function to add the item to the session
	* @param \Illuminate\Http\Request
	* @return \Illuminate\Http\Response
	**/
    public function changeServiceNaan(){
    	//remove the service naan if all the service naan are changed

    	// update the cart item details

    	// update cart total amount
    }


    protected function calculateSpicyPrice($spicy_level,$qty){
 
    	if($spicy_level == 20 || $spicy_level == 25 || $spicy_level == 30):
    		$this->__extra_spicy_price = 50.00 * $qty;
    	elseif($spicy_level == 40 || $spicy_level == 50):
    		$this->__extra_spicy_price = 100.00 * $qty;
    	elseif($spicy_level == 60 || $spicy_level == 70 || $spicy_level == 80 ):
    		$this->__extra_spicy_price = 150.00 * $qty;
    	elseif($spicy_level == 90 || $spicy_level == 100):
    		$this->__extra_spicy_price = 200.00 * $qty;
    	endif;

    	return $this->__extra_spicy_price;
    }



    /**
     * function to update or add new item in the cart as per the cart item exist
     * @param \Illuminate\Http\Request, array($cart_product),string($index), string($item)
     * @return void
     *
     */
    protected function updateOrAddNewItemInCart($request,$cart_product,$index,$item,$update_qty=false){
        //check the request have spicy
         if(!$update_qty):
            $product_qty = (int)($cart_product['__qty'] + $this->qty);
        else:
            $product_qty = (int)$this->qty;
        endif;
        if($request->has('spicy')):
            //simple  curry product
            if(array_key_exists('__spicy_level', $cart_product)):
                if($cart_product['__spicy_level'] == $this->spicy_level):
                    //update qty only
                    if(!$update_qty):
                        $this->line_total  = ($cart_product['__product_price'] * $product_qty) + $cart_product['__extra_spicy_price'];
                        $this->cart_details[$index][$item]['__qty']        = $product_qty;
                        $this->cart_details[$index][$item]['__line_total'] = $this->line_total;
                    else:
                        $this->cart_details[$index][$item]['__spicy_level'] = $this->spicy_level;
                        $this->cart_details[$index][$item]['__extra_spicy_price'] = $this->calculateSpicyPrice($this->spicy_level,$product_qty);
                        $this->cart_details[$index][$item]['__qty'] = $product_qty;
                        $this->line_total = ($product_qty * $cart_product['__product_price'] ) + $this->__extra_spicy_price;
                        $this->cart_details[$index][$item]['__line_total'] = ($product_qty * $cart_product['__product_price'] ) + $this->__extra_spicy_price;
                    endif;
                    //update cart amount
                    if(Session::has('pickup_time')):
                        $this->checkFreeServiceNaan(Session::get('pickup_time'));
                    else:
                        $this->updateCartAmount();
                    endif;
                else:
                    if($update_qty):
                        $this->cart_details[$index][$item]['__spicy_level'] = $this->spicy_level;
                        $this->cart_details[$index][$item]['__extra_spicy_price'] = $this->calculateSpicyPrice($this->spicy_level,$product_qty);
                        $this->line_total = ($product_qty * $cart_product['__product_price'] ) + $this->__extra_spicy_price;
                        $this->cart_details[$index][$item]['__line_total'] = ($product_qty * $cart_product['__product_price'] ) + $this->__extra_spicy_price;
                        if(Session::has('pickup_time')):
                            $this->checkFreeServiceNaan(Session::get('pickup_time'));
                        else:
                            $this->updateCartAmount();
                        endif;
                    else:
                        //add a new item to cart
                        $this->product_exist_in_cart = false;
                    endif;
                endif;
            else:
                //add a new item to cart
                $this->product_exist_in_cart = false;
            endif;
        elseif($request->has('bbq_pcs')):
            //variable bbq product
            if(array_key_exists('__bbq_pcs', $cart_product)):
                if($cart_product['__bbq_pcs'] == $this->bbq_pcs):
                    //update qty only
                    $this->line_total  = $cart_product['__product_price'] * $product_qty;
                    $this->cart_details[$index][$item]['__qty']        = $product_qty;
                    $this->cart_details[$index][$item]['__line_total'] = $this->line_total;
                    //update cart amount
                    if(Session::has('pickup_time')):
                        $this->checkFreeServiceNaan(Session::get('pickup_time'));
                    else:
                        $this->updateCartAmount();
                    endif;
                else:
                    if($update_qty):
                        $item_product          = Product::findOrFail($cart_product['__product_id']);
                        $this->product_price   = $item_product->productDetails()->where('bbq_pcs',$this->bbq_pcs)->first();
                        $this->line_total  = $this->product_price->price * $product_qty;
                        $this->cart_details[$index][$item]['__bbq_pcs']    = $this->bbq_pcs;
                        $this->cart_details[$index][$item]['__product_price']    = $this->product_price->price;
                        $this->cart_details[$index][$item]['__line_total'] = $this->line_total;
                        if(Session::has('pickup_time')):
                            $this->checkFreeServiceNaan(Session::get('pickup_time'));
                        else:
                            $this->updateCartAmount();
                        endif;
                    else:
                        //add a new item to cart
                        $this->product_exist_in_cart = false;
                    endif;
                endif;
            else:
                //add a new item to cart
                $this->product_exist_in_cart =false;
            endif;
        else:
            // simple product
            // update qty only
            $this->line_total  = $cart_product['__product_price'] * $product_qty;
            $this->cart_details[$index][$item]['__qty']        = $product_qty;
            $this->cart_details[$index][$item]['__line_total'] = $this->line_total;
            //update cart amount
            if(Session::has('pickup_time')):
                $this->checkFreeServiceNaan(Session::get('pickup_time'));
            else:
                $this->updateCartAmount();
            endif;
        endif;
    }


   /**
     * function to get the price of the product based on the product type
     * @param void
     * @return void
     */
    protected function addNewItem($request){
    	if(count($this->cart_details) <= 0):
    		$count = 1;
    	else:
    		$total_cart_item = count($this->cart_details['__cart_item']);
    		$count = $total_cart_item + 1;
    	endif;
    	$this->cart_prefix = $this->cart_prefix.$count;
    	//customer has not added the product in the cart yet
		$this->cart_details['__cart_item'][$this->cart_prefix] = [
			'__product_id'       => $this->new_product_id,
			'__product_number'   => $this->new_product_number,
            '__product_name'     => $this->product_details->name,
			'__qty'				 => $this->qty,
			'__product_image'    => $this->product_details->images()->first()->image_path ?? null,
			'__product_type'     => $this->product_details->type,
		];
        //get the product price as per the product type
		$this->getProductPrice($request);
        //check for added product is curry
        if($request->has('spicy')):
            //check the offer details exits or not
            if(Session::has('__offer_details')):
                $pickup_time = Session::get('pickup_time');
                $this->checkFreeServiceNaan($pickup_time);
            else:
                $this->updateCartAmount();
            endif;
        else:
          //update cart amount with the line_total and discount
		  $this->updateCartAmount();
        endif;
    }


    /**
     * function to get the price of the product based on the product type
     * @param void
     * @return void
     */
    protected function getProductPrice($request){
    	//udpate product price
		if($this->product_details->type == "simple" && !$request->has('spicy')):
			//simple product
			$this->cart_details['__cart_item'][$this->cart_prefix]['__product_price'] = $this->product_details->productDetails()->first()->price;
			$this->cart_details['__cart_item'][$this->cart_prefix]['__line_total']    = $this->qty * $this->product_details->productDetails()->first()->price;

		elseif($this->product_details->type == "simple" && $request->has('spicy')):
			//simple curry type of product
			$this->cart_details['__cart_item'][$this->cart_prefix]['__product_price'] = $this->product_details->productDetails()->first()->price;
			$this->cart_details['__cart_item'][$this->cart_prefix]['__spicy_level'] = $this->spicy_level;
			$this->cart_details['__cart_item'][$this->cart_prefix]['__extra_spicy_price'] = $this->calculateSpicyPrice($this->spicy_level,$this->qty);
			$this->cart_details['__cart_item'][$this->cart_prefix]['__line_total'] = ($this->qty * $this->product_details->productDetails()->first()->price ) + $this->__extra_spicy_price;
		else:
			//variable product
			$this->cart_details['__cart_item'][$this->cart_prefix][ '__product_price'] = $this->product_details->productDetails()->where('bbq_pcs',$this->bbq_pcs)->first()->price;
			$this->cart_details['__cart_item'][$this->cart_prefix][ '__bbq_pcs'] = $this->bbq_pcs;
			$this->cart_details['__cart_item'][$this->cart_prefix][ '__line_total'] = ($this->qty * $this->product_details->productDetails()->where('bbq_pcs',$this->bbq_pcs)->first()->price );
            $__bbq_pcs_variation = array();
            foreach($this->product_details->productDetails()->get() as $bbq_pcs):
                $__bbq_pcs_variation[] = $bbq_pcs->bbq_pcs;
            endforeach;
            $this->cart_details['__cart_item'][$this->cart_prefix][ '__bbq_pcs_variation'] = $__bbq_pcs_variation;
		endif;
    }


    /**
     * function to get service naan details
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Resonse
     */
    public function getServiceNaanDetails(Request $request){
        //get the change product details
        $change_product_details = Product::where('is_available_for_change','1')->get();
        $return_html = view('frontend.inc.serviceNaanDetails')->with([
            'products'  => $change_product_details
        ])->render();
        return response()->json(array(
            'status'       => 'success',
            'message'      => 'service naan details has been fetched successfully!',
            'return_html'  => $return_html
        ),200);
    }


    /**
     * function to add new service naan
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Resonse
     */
    public function addNewServiceNaan(Request $request){
        $change_product_details = Product::where('is_available_for_change','1')->get();
        $return_html = view('frontend.inc.addServiceNaan')->with([
            'products'   => $change_product_details,
            'change_qty' => $request->input('_total_change_qty')
        ])->render();
        return response()->json(array(
            'status'       => 'success',
            'message'      => 'service naan details has been fetched successfully!',
            'return_html'  => $return_html
        ),200);
    }



    /** 
    * function to check the mina discount status
    * 
    *
    **/

    public function checkDiscountStatus(){
        //check the session have the pickup time
        if(Session::has('pickup_time')){
            // get the discount status
            $discount_status = Setting::where('meta_key','enable_discount')->select('meta_value')->first();
            if($discount_status){
                if($discount_status->meta_value == "disable"){
                    $this->is_discount_enable   = false;
                }else{
                    // need to check for the discount date validaty
                    $discount_start_date = Setting::where('meta_key','discount_start_date')->select('meta_value')->first();
                    $discount_end_date   = Setting::where('meta_key','discount_end_date')->select('meta_value')->first();
                    $current_date         = Carbon::now();
                    $current_date_        = Carbon::parse(Carbon::now())->format('Y-m-d');
                    if($discount_start_date && $discount_end_date){
                        // compare the current date and current date should be within the discount start date and end date
                        $current_date_        = strtotime($current_date_);
                        $discount_start_date_ = strtotime($discount_start_date->meta_value);
                        $discount_end_date_   = strtotime($discount_end_date->meta_value);
                        if($current_date_ >= $discount_start_date_ &&  $current_date_ <= $discount_end_date_){
                            // date range is valid
                            // check for the week day
                            $current_weekday   = strtolower($current_date->isoFormat('dddd'));
                            //get the weekday frequency from the database
                            $discount_weekly_frequency = Setting::where('meta_key','discount_weekly_frequency')->select('meta_value')->first();
                            //unserialize the value
                            $discount_weekly_frequency  = unserialize($discount_weekly_frequency->meta_value);
                            if(in_array($current_weekday, $discount_weekly_frequency)){
                                //get the discount type for the full day or lunch or dinner or lunch and dinner
                                $discount_type  = Setting::where('meta_key','discount_type')->select('meta_value')->first();
                                //if for all day 
                                if($discount_type){
                                    $this->discount_type = $discount_type->meta_value;
                                    if($this->lunch_offer){
                                        //lunch offer
                                        if($discount_type->meta_value == "all"){
                                            //get the discount amount type
                                            $this->setDiscountAmountType("discount_amount_type","discount_amount");

                                        }elseif($discount_type->meta_value == "lunch_and_dinner"){
                                             //get the discount amount type
                                            $this->setDiscountAmountType("discount_lunch_amount_type","discount_lunch_amount");
                                        }elseif($discount_type->meta_value  == "lunch_only"){
                                             //get the discount amount type
                                            $this->setDiscountAmountType("discount_amount_type","discount_amount");
                                        }else{
                                            $this->is_discount_enable   = false;
                                        }
                                    }else{
                                        //dinner offer
                                        if($discount_type->meta_value == "all"){
                                             $this->setDiscountAmountType("discount_amount_type","discount_amount");
                                            //
                                        }elseif($discount_type->meta_value == "lunch_and_dinner"){
                                            $this->setDiscountAmountType("discount_dinner_amount_type","discount_dinner_amount");

                                        }elseif($discount_type->meta_value  == "dinner_only"){
                                            $this->setDiscountAmountType("discount_amount_type","discount_amount");
                                        }else{
                                            $this->is_discount_enable   = false;
                                        }
                                    }
                                }else{
                                    $this->is_discount_enable = false;
                                }
                            }else{
                                $this->is_discount_enable = false;
                            }
                        }else{
                            $this->is_discount_enable = false;
                        }

                    }
                }
            }

        }else{
            $this->is_discount_enable = false;
        }
    }



    /**
    * function to check set the discount amount type and discount value
    **/
    protected function setDiscountAmountType($meta_amount_key,$meta_value_key){
        $discount_amount_type = Setting::where('meta_key',$meta_amount_key)->select('meta_value')->first();
        if($discount_amount_type){
            $this->discount_amount_type  = $discount_amount_type->meta_value;
        }
        // get the discount amount
        $discount_amount = Setting::where('meta_key',$meta_value_key)->select('meta_value')->first();
        if($discount_amount){
            $this->discount_value  = $discount_amount->meta_value;
        }
    }


    /**
     * function to calucate the discount amount and set the discount name
     * @param void
     * @return void
     **/

    protected function calculateDiscountTotal(){
        //check the discount type is percent or amount
        $cart_total_after_tax  = round($this->cart_total + $this->cart_tax);
        if($this->discount_amount_type == "percent"):
            //percentage discount
            $cart_discount         = round(($cart_total_after_tax * $this->discount_value) / 100);
            $this->cart_discount   = $cart_discount;
            $this->discount_total  = $cart_discount;
        else:
            //amount discount
            $cart_discount         = round($cart_total_after_tax - $this->discount_value);
            $this->cart_discount   = $cart_discount;
            $this->discount_total  = $cart_discount;
        endif;
        $this->setDiscountName();
    }



    /** 
     * function to set the discount name
     * @param void
     * @return void
     */

    protected function setDiscountName(){
        $discount_name = Setting::where('meta_key','discount_name')->select('meta_value')->first();
        if($discount_name){
            $this->discount_name = __('form.discount-amount').'('.$discount_name->meta_value.')';
        }
    }


}
