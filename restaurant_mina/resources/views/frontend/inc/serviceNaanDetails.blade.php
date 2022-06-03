@if(Session::has('__offer_details'))
@php($offer_details = Session::get('__offer_details'))
<h5>{{__('form.service-naan-change-available',['item' => $offer_details['__offer_details']['__offer_qty']])}}</h5>
@php($j=1)
@php($change_qty = 0)
@php($qty_range = $offer_details['__offer_details']['__offer_qty'] )
@php($offer_qty = $offer_details['__offer_details']['__offer_qty'])
@foreach($offer_details['__offer_details']['__change_details'] as $change_details)
<div class="free-items">
	<div class="col item">
		<select class="form-control __change_free_naan_product" name="__change_free_naan_product[]">
				@foreach($products as $product)
					<option value="{{$product->id}}" data-product-id="{{$product->id}}" data-product-price="{{number_format($product->productDetails()->first()->change_price,0)}}" @if($change_details['__product_id'] ==  $product->id) {{'selected'}}@endif>{{$product->name}}(¥{{number_format($product->productDetails()->first()->change_price,0) }})</option>
				@endforeach
		</select>
	</div>
	<input type="hidden" name="__free_service_naan" id="__free_service_naan" value="{{$offer_details['__offer_details']['__offer_qty']}}"/>
	<div class="col">
		<select class="form-control __change_free_naan_qty" name="__change_free_naan_qty[]">
			@for($i = 1; $i <= $qty_range; $i++)
			<option value="{{$i}}" @if($i == $change_details['__qty']){{'selected'}}@endif>{{$i}}</option>
			@endfor
		</select>
	</div>
	<div class="col">
		<div class="price">¥<span class="__line_total">{{number_format($change_details['__line_total'],0)}}</span></div>
	</div>
@if($j > 1)
	<div class="col">
		<div class="remove_service_naan">
		<a class="free_service_delete_btn" href="javascript:void(0);"><img src="{{asset('/front-assets/images/delete_icon.png')}}" class="mCS_img_loaded"></a>
		</div>
	</div>
@endif
@php($j++)
</div>
@php($change_qty += $change_details['__qty'])
@php($qty_range = ($qty_range - $change_details['__qty']))
@endforeach
	<!-- <div class="col">
		<div class="remove">
		<a class="item_delete_btn" href="javascript:void(0);"><img src="{{asset('/front-assets/images/delete_icon.png')}}" class="mCS_img_loaded"></a>
		</div>
	</div> -->
@if($change_qty < $offer_qty)
<div class="add-item">
	<div class="add">+
		</div>
</div>
@endif
<div class="change-amount">
	<div class="left">{{ __('form.service-naan-change-total') }}</div>
	<div class="right">¥<span class="__update_total">{{number_format($offer_details['__offer_details']['__change_total'],0)}}</span></div>
</div>
@endif