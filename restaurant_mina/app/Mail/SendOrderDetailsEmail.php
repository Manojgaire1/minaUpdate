<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Product;
use App\Models\ProductDetail;
use Session;

class SendOrderDetailsEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $order_data;
    public $cart_details;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order_data)
    {
        //
        $this->order_data = $order_data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //function to render the variable product number
        $this->renderVariableProductNumber();
        return $this->subject('New takeout received')->view('frontend.email.orderEmail');
    }


    protected function renderVariableProductNumber(){
        $this->cart_details = Session::get('cart_details');
        $i = 1;
        foreach($this->cart_details as $index=>$cart_item):
                if($index == "__cart_item"):
                    foreach($cart_item as $item=>$cart_product):
                        foreach($cart_product as $key=>$value):
                            if($key == "__bbq_pcs"){
                                //get the product id 
                                $product_id = $this->cart_details[$index]["__cart_item_".$i]['__product_id'];
                                $product_details = Product::findOrFail($product_id);
                                //get the variable product number
                                $variable_product_number = ProductDetail::select('variable_product_number')->where('product_id',$product_id)->where('bbq_pcs',$value)->select('variable_product_number as product_id')->first();
                                $new_product_id = $variable_product_number->product_id;
                                //set the product number
                                //add 3 to each and every product except tabasaki

                                if($product_id != 60){
                                    $this->cart_details[$index]["__cart_item_".$i]['__product_number'] = '3'.$new_product_id;
                                }else{
                                    $this->cart_details[$index]["__cart_item_".$i]['__product_number'] = $new_product_id;
                                }
                            }else{
                                if($key == "__product_number"):
                                    if($value != 300):
                                        $this->cart_details[$index]["__cart_item_".$i]['__product_number'] = '3'.$this->cart_details[$index]["__cart_item_".$i]['__product_number'];
                                    else:
                                         $this->cart_details[$index]["__cart_item_".$i]['__product_number'] =$this->cart_details[$index]["__cart_item_".$i]['__product_number'];
                                    endif;
                                endif;
                            }
                        endforeach;
                        $i++;
                    endforeach;
                endif;
        endforeach;

        //forget the session and add new details
        Session::forget('cart_details');
        Session::put('cart_details',$this->cart_details);
    }
}
