@extends('frontend.layouts.master')
@section('page_name',__('menu.takeout'))
@section('page_specific_css')
<style>
    .hideDiscount{
        display: none !important;
    }
</style>
@endsection
@section('content')
<div class="cart-page-section">
    @if(Session::has('cart_details') && count(Session::get('cart_details')['__cart_item']) > 0)
    @php($cart_details = Session::get('cart_details'))
    <div class="container">
        <div class="table-respomsive cart-table">
            <table class="table">
                <thead>
                    <tr>
                        <th class="delete"></th>
                        <th class="thumbnail">{{__('form.cart.image')}}</th>
                        <th class="description">{{__('form.cart.particulars')}}</th>
                        <th class="rate">{{__('form.cart.rate')}}</th>
                        <th class="quantity">{{__('form.cart.quantity')}}</th>
                        <th class="total">{{__('form.cart.total')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart_details as $index=>$cart_item)
                    @if($index == "__cart_item")
                        @foreach($cart_item as $item=>$cart_product)
                        <tr>
                            <td class="delete">
                                <div class="remove-icon">
                                    <a class="item_delete_btn" href="javascript:void(0);" data-cart-item-id="{{$item}}"><img src="{{asset('/front-assets/images/delete_icon.png')}}"></a>
                                </div>
                            </td>
                            <td class="thumbnail" data-label="{{__('form.cart.image')}}">
                                <div class="item_image">
                                    <img src="{{asset('uploads/products/small/'.$cart_product["__product_image"])}}" class="img-responsive" />
                                </div>
                            </td>
                            <td class="description" data-label="{{__('form.cart.particulars')}}">
                                <div class="item_details">
                                    <p class="item_name">{{ $cart_product['__product_number'].'. '. $cart_product['__product_name'] }}
                                    </p>
                                </div>
                                @if(array_key_exists('__spicy_level',$cart_product))
                                    <div class="spicy-price">
                                        {{__('form.spicy-price')}}@if(array_key_exists('__extra_spicy_price',$cart_product)) 
                                        ¥{{number_format($cart_product['__extra_spicy_price'],0)}}
                                        @endif
                                    </div>
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
                                    <div class="inner-variation spicy-labels">
                                        <label>{{ __('form.pcs') }}</label>
                                        <select class="form-control __product_bbq_pcs" name="__product_bbq_pcs">
                                            @foreach($cart_product['__bbq_pcs_variation'] as $bbq_pcs)
                                                <option value="{{$bbq_pcs}}" @if($cart_product['__bbq_pcs'] == $bbq_pcs){{'selected'}}@endif>{{ucwords($bbq_pcs)}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif

                                <div class="item-price">
                                   <div class="price">(<span class="__product_qty">{{$cart_product['__qty']}}</span> × ¥{{number_format($cart_product['__product_price'],0)}}@if(array_key_exists('__extra_spicy_price',$cart_product))<span class="__extra_spicy_price"> + ¥{{number_format($cart_product['__extra_spicy_price'],0)}}</span>@endif)</div>
                                </div>
                            </td>
                            <td class="rate" data-label="{{__('form.cart.rate')}}">
                                <div class="item-total __product_price">¥{{number_format($cart_product['__product_price'],0)}}</div>
                            </td>
                            <td class="quantity cart-variations" data-label="{{__('form.cart.quantity')}}">
                                <div class="spicy-labels">
                                    <div class="sp-quantity">
                                        <div class="sp-minus @if($cart_product['__qty'] == '1'){{'disabled'}}@endif"> <a class="input-qty">-</a>
                                        </div>
                                        <div class="sp-input">
                                            <input type="text" class="quntity-input" value="{{$cart_product['__qty']}}" readonly="readonly">
                                        </div>
                                        <div class="sp-plus"> <a class="input-qty">+</a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="total" data-label="{{__('form.cart.total')}}">
                            <div class="item-total __line_total">¥{{number_format($cart_product['__line_total'],0)}}</div>
                            </td>
                        </tr>
                        @endforeach
                    @endif
                    @endforeach
                        <tr class="__offer_row @if(Session::has('__offer_details')){{'show'}}@else{{'hide'}}@endif">
                            <td class="delete">
                            </td>
                            <td class="thumbnail" data-label="{{__('form.cart.image')}}">
                                <div class="item_image">
                                    <img src="{{asset('/front-assets/images/service_nan.png')}}" class="img-responsive" />
                                </div>
                            </td>
                            <td class="description" data-label="{{__('form.cart.particulars')}}">
                                <div class="item_details">
                                    <p class="item_name">{{ __('form.service-naan') }}</p>
                                    <div class="change-variation">
                                        <span class="btn btn--primary">{{__("form.change-btn")}}</span>
                                    </div>
                                    <div class="item-price">
                                        @if(Session::has('__offer_details'))
                                            @php($offer_details = Session::get('__offer_details'))
                                                @foreach($offer_details['__offer_details']['__change_details'] as $change_detail)
                                                    <div class="price">(<span class="__product_qty">{{$change_detail['__qty']}}</span> × {{$change_detail['__product_name']}})</div>
                                                @endforeach
                                        @endif
                                    </div>
                                    
                                </div>
                                
                            </td>
                            <td class="rate" data-label="{{__('form.cart.rate')}}">
                                <!-- <div class="item-total">¥0.00</div> -->
                            </td>
                            <td class="quantity" data-label="{{__('form.cart.quantity')}}">
                                
                            </td>
                            <td class="total" data-label="{{__('form.cart.total')}}">
                                @if(Session::has('__offer_details'))
                                    <div class="item-total __line_total">¥{{number_format($offer_details['__offer_details']['__change_total'],0)}}</div>
                                @else
                                    <div class="item-total __line_total">¥0.00</div>
                                @endif
                            </td>
                        </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="3" data-label="Branch">
                        <div class="row">
                            <div class="col-md-6">
                            <label for="">{{ __('form.branch') }}</label>
                            </div>
                            <div class="col-md-6">
                            <select name="_pickup_branch" id="__pickup_branch" class="form-control">
                                <option value="" selected="" disabled="">{{__('form.takeout.select-branch')}}</option>
                                @foreach($branches as $branch)
                                    <option value="{{$branch->slug}}" @if(session()->has('_pickup_branch_name'))@if(session()->get('_pickup_branch_name') == $branch->slug){{'selected'}}@endif @endif>{{$branch->name}}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                    </td>
                    <td colspan="3" data-label="Pickup Time">
                        <div class="row">
                            <div class="col-md-6">
                           
                            <label for="__pickup_time">{{ __('form.takeout.pickup-time') }}</label>
                            </div>
                            <div class="col-md-6 __branch_pickup_time">
                                <?php echo generateTakeoutTime();?>
                            </div>
                        </div>
                    </td>
                </tr>
                    
                </tfoot>
            </table>
        </div>

        <div class="takeout">
            <div class="takeout__summary cart-footer">
                <h4>{{ __('form.takeout-summary') }}</h4>
                <div class="total">
                    <div class="left">{{ __('form.total') }}</div>
                    <div class="right __cart_total">¥{{number_format($cart_details['__cart_total'],0)}}</div>
                </div>
                <div class="tax">
                    <div class="left">{{ __('form.tax') }}(8%)</div>
                    <div class="right __cart_tax">¥{{number_format($cart_details['__cart_tax'],0)}}</div>
                </div>
                <div class="discount tax tax--two @if($cart_details['__is_discount_enabled'])@else{{'hideDiscount'}}@endif">
                    <div class="discountLeft left">{{$cart_details['__discount_name']}}</div>
                    <div class="discountRight right __cart_discount">¥{{number_format($cart_details['__discount_amount'],0)}}</div>
                </div>
                <div class="grand-total">
                    <div class="left">{{ __('form.grand-total') }}</div>
                    <div class="right __cart_grand_total">¥{{number_format($cart_details['__grand_total'],0)}}</div>
                </div>
                
                <div class="proceed_to_checkout_btn">
                    <a class="btn btn-large btn--primary btn-procced-to-takeout" href="{{route('frontend.checkoutpage')}}">{{__('form.proceed-to-checkout')}}</a>
                </div>
            </div>
        </div>
    </div>
@else
<!-- end section  -->
<div class="no-cart-added">
    <div class="container">
        <div class="empty-cart-thumbnail">
            <img src="{{asset('/front-assets/images/empty_cart.png')}}" alt="Mina empty cart">
        </div>
        <div class="empty-cart-message">
            <h3>{{ __('form.no-item-in-cart-heading')}}</h3>
            <p>{{ __('form.no-item-in-cart') }}</p>
            <a href="{{route('frontend.menupage')}}" class="btn btn--primary">{{ __('form.takeout.back-to-menu')}}</a>
        </div>
    </div>
</div>
<!-- end section  -->
@endif
</div>
@endsection
@section('page_specific_js')
<script>
    window.setInterval(changeBranch, 100000);
    $(document).ready(function(){
        var cart_change_btn;
        //track the branch is changed or not
        $('body').on('change','#__pickup_branch',function(e){
            //prevent the default action
            e.preventDefault()
            var __select_pickup_branch = $(this).val();
            if(__select_pickup_branch != null){
                // get the takeout list by the branch
                $.ajax({
                    url:"{{route('frontend.carts.getBranchPickuptime')}}",
                    type:"GET",
                    data:{
                        _pickup_branch_name: __select_pickup_branch
                    },
                    dataType: "JSON",
                    beforeSend:function(){
                        $('.ajax-loader').show()
                    },
                    success:function(response){
                        $('.ajax-loader').hide()
                        $('.__branch_pickup_time').html(response.__branch_pickup_time)

                    },
                    error:function(jqXHR,textStatus,errorThrown){
                        //show the sweet alert
                    }
                })
            }
        })
        //track the takeout time is change or not
        $('body').on('change','#__pickup_time',function(e){
            //prevent the default action
            e.preventDefault()
            var __selected_pickup_time = $(this).val()
            //update cart as pwer the pickup time if possible
            $.ajax({
                url:"{{route('frontend.carts.changePickuptime')}}",
                type:"GET",
                data:{
                    pickup_time : __selected_pickup_time
                },
                dataType: "JSON",
                beforeSend:function(){
                    $('.ajax-loader').show() 
                },
                success:function(response){
                    $('.ajax-loader').hide()
                    swal({
                        title: response.title,
                        text : response.message,
                        icon: "success",
                        button: 'Ok'
                    }) 
                    //
                    if(response.__offer_still_valid == false){
                        cart_change_btn = $('body').find('.change-variation .btn')
                        $(cart_change_btn).parent().closest('.item_details').find('.price').remove()
                        $(cart_change_btn).parent().closest('.item_details').find('.item-price').html(response.__offer_return_html)
                        $(cart_change_btn).parent().closest('tr.__offer_row').find('.__line_total').html("¥" + response.__offer_total)
                        $('body').find('tr.__offer_row').show()
                        $(".cart-footer .__cart_total").html("¥" + response.__cart_total);
                        $(".cart-footer .__cart_tax").html("¥" + response.__cart_tax_total);
                        $(".cart-footer .__cart_grand_total").html("¥" + response.__cart_grand_total);
                    }

                    if(response.is_discount_enable){
                        $('.cart-footer .discountLeft').html(response.discount_name)
                        $('.cart-footer .discountRight').html("¥"+ response.discount_amount)
                        $('.cart-footer .discount').removeClass('hideDiscount')
                    }else{
                        $('.cart-footer .discount').addClass('hideDiscount')
                    }

                    // check for the offer exits
                    if(response.offer_exist == false){
                        $('body').find('tr.__offer_row').hide()
                    }
                     
                },
                error:function(jqXHR,textStatus,errorThrown){
                    //show the sweet alert
                }
            })
        })
    })

    function changeBranch(){
        $('body').find("#__pickup_branch").trigger('change')
    }

    function changePickupTime(){
        //need to trigger pickup time change
        $('body').find("#__pickup_time").trigger('change')
    }
</script>
@endsection