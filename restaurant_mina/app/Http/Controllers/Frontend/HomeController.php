<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Branch;
use App\Models\Product;
use App\Models\Setting;
use App;
use Carbon\Carbon;

class HomeController extends Controller
{

    protected $product_details, $cart_details;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('frontend.index')->with([
            'menus' => Category::where('status','1')->where('show_in_nav','1')->orderBy('order','asc')->get(),
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
        //
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


    /**
     * Change the website langauge
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
     public function changeLanguage(Request $request)
    {
        //
        $to_language = $request->input('to_language');
        if($to_language){
            //check for the english and japanese only
            if(!in_array($to_language,['en','jp'])){
                //return failed response
                return response()->json(array('status' => 'failed', 'message' => 'The language does not exits'),200);
            }

            if(!App::isLocale($to_language))
                session()->put('mina_locale',$to_language);
            //to do check the session data and change the title of the product after change
            $this->localizeCartProductTitle($request,$to_language);
            //return success response
            return response()->json(array('status' => 'success', 'message' => 'The language has been switched successfully'),200);
        }else{
            //return the false response
            return response()->json(array('status' => 'failed', 'message' => 'The language does not exits'),200);
        }
    }


    /**
     * function to change the product name that is already in session
     * @param \Illuminate\Http\Request, string($lo_language)
     * @return void
     **/

    protected function localizeCartProductTitle($request,$to_language){
        //check the request has the session or not
        if($request->session()->has('cart_details') && count($request->session()->get('cart_details')) > 0):
            // product exists in the cart
            $this->cart_details = $request->session()->get('cart_details');
            foreach($this->cart_details["__cart_item"] as $item=>$cart_product):
                //check the array have __product_id as the key or not
                if(array_key_exists("__product_id", $cart_product)):
                    //get the product details by by the product_id
                    $this->product_details = Product::findOrFail($cart_product['__product_id']);
                    if($this->product_details):
                        $this->cart_details['__cart_item'][$item]['__product_name'] = $this->product_details->{$to_language .'_name'};
                    else:
                        continue;
                    endif;
                else:
                    continue;
                endif;
            endforeach;
            //remvoe the cart data and replace with the new one
            $request->session()->forget('cart_details');
            //regenerate the cart details with the localize cart data
            $request->session()->put('cart_details',$this->cart_details);
        endif;
    }


}
