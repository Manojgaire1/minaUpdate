@php($offer_details = Session::get('__offer_details'))
@php($offer_qty = $offer_details['__offer_details']['__offer_qty'])
<div class="free-items added-service-naan">
	<div class="col item">
		<select class="form-control __change_free_naan_product" name="__change_free_naan_product[]">
				@foreach($products as $product)
					<option value="{{$product->id}}" data-product-id="{{$product->id}}" data-product-price="{{number_format($product->productDetails()->first()->change_price,0)}}" @if($product->id == 94) {{'selected'}}@endif>{{$product->name}}(¥{{number_format($product->productDetails()->first()->change_price,0) }})</option>
				@endforeach
		</select>
	</div>
	<div class="col">
		<select class="form-control __change_free_naan_qty" name="__change_free_naan_qty[]">
			@for($i = 1; $i <= ($offer_qty - $change_qty); $i++)
			<option value="{{$i}}" @if($i == ($offer_qty - $change_qty)){{'selected'}}@endif>{{$i}}</option>
			@endfor
		</select>
	</div>
	<div class="col">
		<div class="price">¥<span class="__line_total">{{number_format(0,0)}}</span></div>
	</div>
	<div class="col">
		<div class="remove_service_naan">
		<a class="free_service_delete_btn" href="javascript:void(0);"><img src="{{asset('/front-assets/images/delete_icon.png')}}" class="mCS_img_loaded"></a>
		</div>
	</div>
</div>