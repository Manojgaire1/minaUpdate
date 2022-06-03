<?php

namespace App\Http\Middleware;

use Closure;

class CheckCartItemsBeforeCheckout
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->session()->has('cart_details')):
            // a cart is empty but have record of the cart total and others
            $cart_details = $request->session()->get('cart_details');
            if(count($cart_details["__cart_item"]) && $request->session()->has('pickup_time')): // && $request->session()->has('pickup_time')
                return $next($request);
            else:
                return redirect()->route('frontend.homepage');
            endif;

        else:
            return redirect()->route('frontend.homepage');
        endif;
    }
}
