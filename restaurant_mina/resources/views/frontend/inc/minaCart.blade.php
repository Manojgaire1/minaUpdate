@if(Session::has('cart_details') && count(Session::get('cart_details')['__cart_item']) > 0)
    @php($cart_details = Session::get('cart_details'))
    @php($qty = 0)
    @php($grand_total = $cart_details['__grand_total'])
    @foreach($cart_details["__cart_item"] as $cart_item)
        @php($qty += $cart_item['__qty'])
    @endforeach
    @if(!Request::is('checkout*'))
        <a class="nav-item-link"><span class="__total_items_in_cart">{{$qty}}</span> <span><img src="{{asset('/front-assets/images/cart_icon.png')}}" style="width:20px;"></span></a>
    @endif
    <div class="mini_cart_dropwn">
    @if(!Request::is('checkout*'))
    <div class="hide-minicart">×</div>
    @endif
    <div class="mini_cart_details">
            <div class="cart-header">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <div class="cart-items">
                            <span class="number __total_items">{{ __('form.items-in-cart',['item'=> $qty])}}</span>
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-8">
                        {{--@if(!Request::is('checkout*'))
                        <div class="row">
                            <div class="col-sm-5">
                                <label for="__pickup_time" class="control-label">{{ __('form.takeout.pickup-time')}}</label>
                            </div>
                            <div class="col-sm-7">
                                @include('frontend.inc.pickupTime')
                            </div>
                        </div>
                        @else--}}
                        <div class="sub-total">
                            {{__('form.sub-total')}}: <span class="subtotal __cart_grand_total">¥{{number_format($grand_total,0)}}</span>
                        </div>
                       {{-- @endif --}}
                    </div>
                </div>
            </div>
            <ul class="mini_cart_list">
                @foreach($cart_details as $index=>$cart_item)
                    @if($index == "__cart_item")
                        @foreach($cart_item as $item=>$cart_product)
                                <li>
                                    <div class="mini_cart_list_details">
                                        <div class="row item_details_row">
                                             @if(array_key_exists("__product_image",$cart_product))
                                                <div class="col-sm-3">
                                                    <div class="item_image">
                                                        <img src="{{asset('uploads/products/small/'.$cart_product["__product_image"])}}" class="img-responsive" />
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="col-sm-9">
                                                <div class="item_details">

                                                    <p class="item_name">{{ $cart_product['__product_number'].'. '. $cart_product['__product_name'] }}
                                                    </p>
                                                    <div class="item-price">
                                                        <div class="price"><span class="__product_qty">{{$cart_product['__qty']}}</span> × ¥{{number_format($cart_product['__product_price'],0)}}@if(array_key_exists('__extra_spicy_price',$cart_product))<span class="__extra_spicy_price"> + ¥{{number_format($cart_product['__extra_spicy_price'],0)}}</span>@endif</div>
                                                        <div class="item-total">¥{{number_format($cart_product['__line_total'],0)}}</div>
                                                    </div>
                                                </div>
                                                @if(!Request::is('checkout*'))
                                                <div class="cart-variations">
                                                    <div class="spicy-labels">
                                                    <label >{{ __('form.quantity') }}</label>
                                                        <div class="sp-quantity">
                                                            <div class="sp-minus"> <a class="input-qty">-</a>
                                                            </div>
                                                            <div class="sp-input">
                                                                <input type="text" class="quntity-input" value="{{$cart_product['__qty']}}" readonly="readonly" />
                                                            </div>
                                                            <div class="sp-plus"> <a class="input-qty">+</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if(array_key_exists('__spicy_level',$cart_product))
                                                    <div class="inner-variation spicy-labels">
                                                    <label >{{ __('form.spicy-level') }} <span class="info">?</span></label>
                                                        <select class="form-control __product_spicy_level" name="__product_spicy_level">
                                                            <option value="A" @if($cart_product['__spicy_level'] == "A"){{ 'selected'}}@endif>Sweet</option>
                                                            <option value="0" @if($cart_product['__spicy_level'] == "0"){{ 'selected'}}@endif>0</option>
                                                            <option value="3" @if($cart_product['__spicy_level'] == "3"){{ 'selected'}}@endif>3</option>
                                                            <option value="5" @if($cart_product['__spicy_level'] == "5"){{ 'selected'}}@endif>5</option>
                                                            <option value="7" @if($cart_product['__spicy_level'] == "7"){{ 'selected'}}@endif>7</option>
                                                            <option value="10" @if($cart_product['__spicy_level'] == "10"){{ 'selected'}}@endif>10</option>
                                                            <option value="13" @if($cart_product['__spicy_level'] == "13"){{ 'selected'}}@endif>13</option>
                                                            <option value="15" @if($cart_product['__spicy_level'] == "15"){{ 'selected'}}@endif>15</option>
                                                            <option value="20" @if($cart_product['__spicy_level'] == "20"){{ 'selected'}}@endif>20 (+ ¥50)</option>
                                                            <option value="25" @if($cart_product['__spicy_level'] == "25"){{ 'selected'}}@endif>25 (+ ¥50)</option>
                                                            <option value="30" @if($cart_product['__spicy_level'] == "30"){{ 'selected'}}@endif>30 (+ ¥50)</option>
                                                            <option value="40" @if($cart_product['__spicy_level'] == "40"){{ 'selected'}}@endif>40 (+ ¥100)</option>
                                                            <option value="50" @if($cart_product['__spicy_level'] == "50"){{ 'selected'}}@endif>50 (+ ¥100)</option>
                                                            <option value="60" @if($cart_product['__spicy_level'] == "60"){{ 'selected'}}@endif>60 (+ ¥150)</option>
                                                            <option value="70" @if($cart_product['__spicy_level'] == "70"){{ 'selected'}}@endif>70 (+ ¥150)</option>
                                                            <option value="80" @if($cart_product['__spicy_level'] == "80"){{ 'selected'}}@endif>80 (+ ¥150)</option>
                                                            <option value="90" @if($cart_product['__spicy_level'] == "90"){{ 'selected'}}@endif>90 (+ ¥200)</option>
                                                            <option value="100" @if($cart_product['__spicy_level'] == "100"){{ 'selected'}}@endif>100 (+ ¥200)</option>
                                                        </select>
                                                    </div>
                                                    @endif
                                                    @if(array_key_exists('__bbq_pcs',$cart_product))
                                                    <div class="inner-variation">
                                                        <label>{{ __('form.pcs') }}</label>
                                                        <select class="form-control __product_bbq_pcs" name="__product_bbq_pcs">
                                                            @foreach($cart_product['__bbq_pcs_variation'] as $bbq_pcs)
                                                                <option value="{{$bbq_pcs}}" @if($cart_product['__bbq_pcs'] == $bbq_pcs){{'selected'}}@endif>{{ucwords($bbq_pcs)}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    @endif
                                                    <div class="remove-item">
                                                        <a class="item_delete_btn" href="javascript:void(0);" data-cart-item-id="{{$item}}"><img src="{{asset('/front-assets/images/delete_icon.png')}}"></a>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </li>
                        @endforeach
                    @endif
                @endforeach
                @if(Session::has('__offer_details'))
                @php($offer_details = Session::get('__offer_details'))
                     @if(Request::is('checkout*'))
                     <li>
                        <div class="mini_cart_list_details">
                            <div class="row item_details_row">
                                <div class="col-sm-3">
                                    <div class="item_image">
                                        <img src="{{asset('/front-assets/images/service_nan.png')}}" class="img-responsive" />
                                    </div>
                                </div>
                                <div class="col-sm-9">
                                     <div class="item_details">
                                        <p class="item_name">{{ __('form.service-naan') }}</p>
                                        <div class="item-price">
                                            <div class="price">
                                            </div>
                                            <div class="item-total">¥{{number_format($offer_details['__offer_details']['__change_total'],0)}}</div>
                                        </div>
                                        <div class="offer-item-price">
                                            @foreach($offer_details['__offer_details']['__change_details'] as $change_detail)
                                            <div class="price">
                                                <span class="__product_qty">{{$change_detail['__qty']}}</span> × {{$change_detail['__product_name']}}
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    @endif
                @endif
            </ul>
            <div class="cart-footer">
                <div class="total">
                    <div class="left">{{ __('form.total') }}</div>
                    <div class="right __cart_total">¥{{number_format($cart_details['__cart_total'],0)}}</div>
                </div>
                <div class="tax">
                    <div class="left">{{ __('form.tax') }}(8%)</div>
                    <div class="right __cart_tax">¥{{number_format($cart_details['__cart_tax'],0)}}</div>
                </div>
                @if(Request::is('checkout*'))
                    <div class="discount tax tax--two @if($cart_details['__is_discount_enabled'])@else{{'hideDiscount'}}@endif">
                    <div class="discountLeft left">{{$cart_details['__discount_name']}}</div>
                    <div class="discountRight right __cart_discount">¥{{number_format($cart_details['__discount_amount'],0)}}</div>
                </div>
                @endif
                <div class="grand-total">
                    <div class="left">{{ __('form.grand-total') }}</div>
                    <div class="right __cart_grand_total">¥{{number_format($cart_details['__grand_total'],0)}}</div>
                </div>
                @if(!Request::is('checkout*')) 
                <div class="proceed_to_checkout_btn">
                    <a class="btn btn-large btn-procced" href="{{route('frontend.carts.index')}}">{{ __('form.view-takeout') }}</a>
                </div>
                @endif
            </div>
        </div>
    </div>
@else
<a class="nav-item-link">0 <span><img src="{{asset('/front-assets/images/cart_icon.png')}}" style="width:20px;"></span></a>
<div class="mini_cart_dropwn">
    <div class="hide-minicart d-block d-sm-block d-md-block d-lg-none">×</div>
    <div class="mini_cart_details">
        <div class="__no_item_cart_header">
            <div class="row">
                <div class="col-md-12">
                    <div class="__no_item_in_cart">
                        <h4> {{ __('form.no-item-in-cart-heading')}}</h4>
                        <p>{{ __('form.no-item-in-cart') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
