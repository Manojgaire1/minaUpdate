<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Branch;
use App\Models\Product;
use Carbon\Carbon;
use App\Mail\SendOrderDetailsEmail;
use App\Mail\SendTakeoutDetailsToOwner;
use Mail;

class TakeoutController extends Controller
{
    protected $cart_details;
    protected $order_details, $order, $branch;
    protected $product_details;
    protected $__cart_total=0.00;
    protected $__cart_tax_total=0.00;
    protected $__cart_grand_total=0.00;
    protected $__cart_discount_total=0.00;
    protected $__total_items_in_cart=0;
    protected $current_time;


    public function __construct(Order $order, Branch $branch, OrderDetails $order_details){
        $this->order = $order;
        $this->branch = $branch;
        $this->order_details = $order_details;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('frontend.checkout')->with([
            'page_name' => 'Checkout',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //here need to validaton for the user input
        $validateData = $request->validate([
            'first_name'        => 'required',
            'last_name'         => 'required',
            //'email'             => 'required|email',
            'phone'             => 'required|min:9|max:14',
            'selected_branch'   => 'required',
        ]);

        $data                  = $request->except('__token');
        //store the data in the database
        if($request->session()->has('cart_details')):
            $this->cart_details = $request->session()->get('cart_details');
            if(count($this->cart_details['__cart_item']) > 0):
                //get the brand details by the branch slug
                $order_branch_details        = $this->branch->where('slug',$request->input('selected_branch'))->first();
                $data['branch_id']           = $order_branch_details->id;
                $data['__cart_total']        = $this->cart_details['__cart_total'];
                $data['__cart_tax_total']    = $this->cart_details['__cart_tax'];
                $data['__cart_grand_total']  = $this->cart_details['__grand_total'];
                //save the order details in the storage
                $new_order_details           = $this->order->createOrder($data);
                if($new_order_details):
                    //save order details
                    //check the cart has product or not
                    if(count($this->cart_details["__cart_item"]) > 0):
                        //cart has product on it
                        $i = 0;
                        foreach($this->cart_details["__cart_item"] as $item=>$cart_product):
                            //here need to store the roder details
                            $this->__total_items_in_cart += $cart_product['__qty'];
                            $order_details_data[$i] = [
                                'product_id'        => $cart_product['__product_id'],
                                'price'             => $cart_product['__product_price'],
                                'qty'               => $cart_product['__qty'],
                                'order_id'          => $new_order_details->id,
                                'line_total_amount' => $cart_product['__line_total'],
                                'bbq_pcs'           => null,
                                'spicy_level'       => null,
                                'spicy_price'       => 0.00
                            ];
                            //check the product type
                            if(array_key_exists('__spicy_level', $cart_product)):
                                $order_details_data[$i]['spicy_price']  = $cart_product['__extra_spicy_price'];
                                $order_details_data[$i]['spicy_level']  = $cart_product['__spicy_level'];
                            elseif(array_key_exists('__bbq_pcs', $cart_product)):
                                $order_details_data[$i]['bbq_pcs'] =  $cart_product['__bbq_pcs'];
                            endif;
                            $order_details_data[$i]['created_at'] = Carbon::now();
                            $order_details_data[$i]['updated_at'] = Carbon::now();
                            $i++;
                        endforeach;
                        //store the product details
                        $orderData = $this->order_details->insert($order_details_data);
                        if($orderData):
                            //send email to the respective branch
                            $data['__total_items_in_cart'] = $this->__total_items_in_cart;
                            $data['branch_name']           = $order_branch_details->en_name;
                            //set the pickup time
                            if($request->has('pickup_option') && $request->get('pickup_option') == "as_soon_as_possible"):
                                $this->current_time = Carbon::now();
                                //add 20 mins for the current time
                                $pickup_time = $this->current_time->addMinutes(20);
                                $data['pickup_time'] = Carbon::parse($pickup_time)->format('H:i');
                            elseif($request->has('pickup_option') && $request->get('pickup_option') == "later"):
                                $data['pickup_time'] = Carbon::parse($request->input('selected_pickup_time'))->format('H:i');
                            endif; 
                            Mail::to($order_branch_details->email)->send(new SendOrderDetailsEmail($data));
                            Mail::to('tanka@indianrestaurantmina.com')->send(new SendTakeoutDetailsToOwner($data));
                            //remove the session data
                            $request->session()->forget('cart_details');
                            $request->session()->forget('__offer_details');
                            $request->session()->forget('pickup_time');
                            $request->session()->forget('_pickup_branch_name');
                            //return response back to the client
                             return response()->json(
                                array(
                                    'status'  => 'success',
                                    'message' => __('form.checkout-success-msg'),
                                    'title'   => __('form.checkout-success-title')
                                ),200
                            );
                        else:
                            //order details cannot be saved
                        endif;
                    else:
                        //send the failed response back to client
                        return response()->json(
                            array(
                                'status'  => 'failed',
                                'message' => __('form.checkout-failed-msg'),
                                'title'   => __('form.checkout-failed-title'),
                            ),200
                        );
                    endif;
                else:
                    //we cannot save the order details in the storage
                   return response()->json(
                            array(
                                'status'  => 'failed',
                                'message' => __('form.checkout-failed-msg'),
                                'title'   => __('form.checkout-failed-title'),
                            ),200
                        );
                endif;
            else:
                 //send the failed response back to the client
                return response()->json(
                            array(
                                'status'  => 'cartEmpty',
                                'message' => __('form.checkout-no-item-in-cart'),
                                'title'   => __('form.checkout-failed-title'),
                            ),200
                        );
            endif;
        else:
            //send the failed response back to the client
            return response()->json(
                        array(
                            'status'  => 'cartEmpty',
                            'message' => __('form.checkout-no-item-in-cart'),
                            'title'   => __('form.checkout-failed-title'),
                        ),200
                    );
        endif;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function sendOrderEmail(){
        return view('frontend.email.orderEmail');
    }
}
