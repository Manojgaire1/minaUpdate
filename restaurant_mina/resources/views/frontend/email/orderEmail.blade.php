<html>

<head>
</head>
<style>
    td {
        vertical-align: top;
        font-size: 14px;
    }
    @media (max-width: 767px) {
        table,center {
            width: 100% !important;
        }
    }
</style>

<body style="margin: 0px; font-family: Poppins, sans-serif; font-size: 14px; background-color: rgba(0, 0, 0, 0); ">
    <center style="width: 650px;margin: 0 auto;">
        <table style="border-collapse: collapse; width: 650px;margin: 0 auto;">
            <tbody>
                <tr>
                    <td style="padding: 15px; text-align: center;">
                        <a href="#" target="_blank"><img alt="banner" src="{{asset('/front-assets/images/logo.png')}}" height="65px" width="135px"></a>
                    </td>
                </tr>
                <!-- end table row   -->
                <tr>
                    <td>
                        <table style="border-collapse: collapse; margin: 0 auto;">
                            <tbody>
                                <tr>
                                    <td style=" padding: 15px 0px;">
                                        Hello {{$order_data['branch_name']}},
                                    </td>
                                </tr>
                                <tr>
                                    <td style=" padding: 15px 0px;">
                                        A new takeout has been received from <span style="font-weight:600">{{ ucwords($order_data['last_name'] .' '. $order_data['first_name'])}}</span>. Please call the customer to confirm the takeout if you have any queries.
                                        The takeout details is shown in the table below.
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <!-- end table row -->
                <tr>
                    <td>
                        <table style=" width: 100%; border-collapse: collapse; margin: 0 auto; border: 1px solid #d90b17; margin-bottom: -2px; border-bottom: none;">
                            <tbody>
                                <tr style="text-align: center;">
                                    <td colspan="2" style="font-size:20px;font-weight: 600;">{{ ucwords($order_data['last_name'] .' '. $order_data['first_name'])}}</td>
                                </tr>
                                <tr style="text-align:center;">
                                    <td colspan="2">{{ $order_data['email'] ?? ''}}</td>
                                </tr>
                                <tr style="text-align:center;">
                                     <td colspan="2">{{ $order_data['phone'] ?? '' }}</td>
                                </tr>
                                <tr style="text-align: center;">
                                    <td colspan="2" style="font-size:12px;">{{ $order_data['checkout_message'] ?? ''}}</td>
                                </tr>
                                <tr>
                                     <td style="width: 50%; padding-left: 10px;"><span style="font-weight: 600;">Branch:</span> {{$order_data['branch_name']}}</td>
                                     <td style="width: 50%; padding-right: 10px; float: right;"><span style="font-weight: 600;">Takeout:</span> {{$order_data['pickup_time']}}</td>
                                </tr>
                                <tr>
                                    <td style="width: 50%; padding-left: 10px;"><span style="font-weight: 600;">Total items:</span> {{ $order_data['__total_items_in_cart']}} </td>
                                    <td style="width: 50%; padding-right: 10px; float: right; padding-bottom: 10px;"><span style="font-weight: 600;">Subtotal:</span> ¥{{number_format($order_data['__cart_grand_total'],2)}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table style=" width: 100%; border-collapse: collapse; margin: 0 auto; border: 1px solid #d90b17;">
                            <thead>
                                <tr>
                                    <th style=" text-align: left; padding: 10px; border: 1px solid #d90b17; font-weight: 600; font-size: 14px;">Image</th>
                                    <th style=" text-align: left; padding: 10px; border: 1px solid #d90b17; font-weight: 600; font-size: 14px;">Particulars</th>
                                    <th style=" text-align: left; padding: 10px; border: 1px solid #d90b17; font-weight: 600; font-size: 14px;">Qty</th>
                                    <th style=" text-align: left; padding: 10px; border: 1px solid #d90b17; font-weight: 600; font-size: 14px;">Rate</th>
                                    <th style=" text-align: left; padding: 10px; border: 1px solid #d90b17; font-weight: 600; font-size: 14px;">Line Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($cart_details = session()->get('cart_details'))
                                @foreach($cart_details['__cart_item'] as $item=>$cart_product)
                                    <tr>
                                    <td style=" text-align: center; padding: 10px; border: 1px solid #d90b17;">
                                        <img src="{{asset('uploads/products/small'.'/'. $cart_product['__product_image'])}}" style="width: 40px;" alt="">
                                    </td>
                                    <td style=" text-align: left; padding: 10px; border: 1px solid #d90b17;">{{ $cart_product['__product_number']}}. {{ $cart_product['__product_name']}}@if(array_key_exists('__spicy_level', $cart_product))<br><span style="font-size:12px;">Spicy Level: {{$cart_product['__spicy_level']}}</span><br><span style="font-size:12px;">Spicy Price: ¥{{number_format($cart_product['__extra_spicy_price'])}}</span>@elseif(array_key_exists('__bbq_pcs',$cart_product))<br><span style="font-size:12px">{{ucwords($cart_product['__bbq_pcs'])}}@endif</td>
                                    <td style=" text-align: left; padding: 10px; border: 1px solid #d90b17;">{{ $cart_product['__qty']}}</td>
                                    <td style=" text-align: left; padding: 10px; border: 1px solid #d90b17;">¥{{$cart_product['__product_price']}}</td>
                                    <td style=" text-align: left; padding: 10px; border: 1px solid #d90b17;">¥{{number_format($cart_product['__line_total'],2)}}</td>
                                </tr>
                                @endforeach
                                <!--need to check for the offer details as well-->
                                @php($offer_details = session()->get('__offer_details'))
                                @if($offer_details)
                                    @foreach($offer_details as $key=>$offer_detail)
                                        <tr>
                                            <td style=" text-align: center; padding: 10px; border: 1px solid #d90b17;">
                                                <img src="{{asset('/front-assets/images/service_nan.png')}}" style="width: 40px;" alt="">
                                            </td>
                                             <td style=" text-align: left; padding: 10px; border: 1px solid #d90b17;">
                                                {{ __('form.service-naan') }}
                                                @foreach($offer_detail['__change_details'] as $change_detail)
                                                <br>
                                                <span style="font-size: 12px;">
                                                    {{$change_detail['__qty']}} × {{$change_detail['__product_name']}}
                                                </span>
                                                @endforeach
                                            </td>
                                             <td style=" text-align: left; padding: 10px; border: 1px solid #d90b17;"></td>
                                             <td style=" text-align: left; padding: 10px; border: 1px solid #d90b17;"></td>
                                            <td style=" text-align: left; padding: 10px; border: 1px solid #d90b17;">¥{{number_format($offer_details['__offer_details']['__change_total'],2)}}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4" style=" width: 90%; text-align: left; padding: 10px; border: 1px solid #d90b17; font-weight: 600; font-size: 14px;">Total</th>
                                    <td style="width: 10%; text-align: left; padding: 10px; border: 1px solid #d90b17; text-align: right;font-size: 14px; font-weight: 600;">¥{{number_format($cart_details['__cart_total'],2)}}</td>
                                </tr>

                                <tr>
                                    <th colspan="4" style=" width: 90%; text-align: left; padding: 10px; border: 1px solid #d90b17; font-weight: 600; font-size: 14px;">Tax(8%)</th>
                                    <td style="width: 10%; text-align: left; padding: 10px; border: 1px solid #d90b17; text-align: right;font-size: 14px; font-weight: 600;">¥{{number_format($cart_details['__cart_tax'],2)}}</td>
                                </tr>
                                @if($cart_details['__is_discount_enabled'])
                                <tr>
                                    <th colspan="4" style=" width: 90%; text-align: left; padding: 10px; border: 1px solid #d90b17; font-weight: 600; font-size: 14px;">{{ $cart_details['__discount_name'] }}</th>
                                    <td style="width: 10%; text-align: left; padding: 10px; border: 1px solid #d90b17; text-align: right;font-size: 14px; font-weight: 600;">¥{{number_format($cart_details['__discount_amount'],2)}}</td>
                                </tr>
                                @endif
                                <tr>
                                    <th colspan="4" style=" width: 50%; text-align: left; padding: 10px; border: 1px solid #d90b17; font-weight: 600; font-size: 14px; font-weight: 600;">Grand Total</th>
                                    <td  style="width: 10%; text-align: left; padding: 10px; border: 1px solid #d90b17; text-align: right;font-size: 14px; font-weight: 600;">¥{{number_format($cart_details['__grand_total'],2)}}</td>
                                </tr>
                            </tfoot>
                        </table>

                    </td>
                </tr>
                <!-- end table row   -->

            </tbody>
        </table>
    </center>
</body>

</html>