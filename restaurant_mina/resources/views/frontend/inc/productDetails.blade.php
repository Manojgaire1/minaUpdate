<div class="col-md-6 col-lg-4">
    <div class="mina_menu_item" data-aos="fade-up" data-aos-duration="1000">
        <div class="mina_item_list">
            <div class="mina_item_image">
                @if($product->images()->count() > 0)
                    @if($product->images()->first()->image_path != null)
                        <img src="{{asset('/uploads/products/medium/'.$product->images()->first()->image_path)}}" class="img-responsive">
                    @else
                    <!--show the default image-->
                        <img src="{{asset('/front-assets/images/logo.png')}}"/ class="img-responsive"/>
                    @endif
                @else
                    <!--show the default image-->
                    <img src="{{asset('/front-assets/images/logo.png')}}"/ class="img-responsive"/>
                @endif
            </div>
            <div class="mina_item_content">
                @if($product->type == "simple")
                    <div class="item_title_price">
                        <h2>
                            <em>{{$product->number}}.</em> {{$product->name}}
                            <span class="price">¥{{number_format($product->productDetails()->first()->price,0)}}</span>
                        </h2>
                </div>
                @else
                <div class="item_title_price has__multiprice">
                    <h2><em>{{$product->number}}.</em> {{$product->name}}</h2>
                    <div class="price-level">
                        @foreach($product->productDetails()->get() as $product_price)
                            <span class="price">¥{{number_format($product_price->price,0)}}<span class="item_tax_label">({{$product_price->bbq_pcs}})</span></span>
                        @endforeach
                    </div>
                </div>
                @endif
                <div class="mina_item_description">
                   {!!$product->description!!}
                </div>
                @if($product->is_open_for_takeout == '1')
                <div class="spicy-labels">
                    <form action="#" method="post" id="__addTakeout{{$product->number}}">
                        <input type="hidden" name="__productId" value="{{$product->id}}"/>
                        <input type="hidden" name="__productNumber" value="{{$product->number }}"/>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="">{{ __('form.quantity') }}</label>
                                    <div class="sp-quantity">
                                        <div class="sp-minus"> <a class="input-qty">-</a>
                                        </div>
                                        <div class="sp-input">
                                            <input type="text" class="quntity-input" value="1" name="qty"  readonly="readonly" />
                                        </div>
                                        <div class="sp-plus"> <a class="input-qty">+</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if($product->category_id == 12 )
                            <div class="col-md-5">
                                <div class="form-group">
                                    @include('frontend.inc.spicyLevel')
                                </div>
                            </div>
                            @elseif($product->category_id == 14)
                                @if($product->type == "variable")
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>Piece</label>
                                        <select class="form-control" name="bbq_pcs">
                                            @foreach($product->productDetails()->get() as $product_price)
                                                <option value="{{$product_price->bbq_pcs}}">{{ucwords($product_price->bbq_pcs)}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @endif
                            @endif
                            <div class="col-lg-12">
                                <div class="add_to_takeout_btn">
                                    <a class="btn btn-sm btn--primary __add_to_takeout_btn" data-product-number="{{$product->number}}">{{ __('form.add-to-takeout') }}</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>