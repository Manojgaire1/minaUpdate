
		<section id="mina_footer"><!-- footer main section begins -->
			<div class="container footer_container">
				<div class="row"><!--footer main row-->
					<div class="col-sm-6 col-md-2">
						<div class="mina_footer_desc">
							<img src="{{asset('/front-assets/images/footer_logo.png')}}">
							<p>{{ __('lang.short-desc') }}</p>
						</div>
						<div class="ft-icons">
							<ul class="social-icons">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-instagram"></i></a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6 col-md-4">
						<div class="footer_border_left">
							<div class="footer_menu_section footer_menu">
								<h3>{{ __('lang.popular-link') }}</h3>
								<ul>
									<li><a href="{{route('frontend.homepage')}}" class="footer-nav-link">{{ __('menu.home') }}</a></li>
									<li><a href="{{route('frontend.aboutpage')}}" class="footer-nav-link">{{ __('menu.about') }}</a></li>
									<li><a href="{{route('frontend.gallerypage')}}" class="footer-nav-link">{{ __('menu.gallery') }}</a></li>
									<li><a href="{{route('frontend.contactpage')}}" class="footer-nav-link">{{ __('menu.contact') }}</a></li>
									<li><a href="{{route('frontend.menupage')}}" class="footer-nav-link">{{ __('menu.menu') }}</a></li>
								</ul>
								<h4>{{ __('lang.opening-hours') }}</h4>
								<h5>{{__('lang.singu-tobato-and-munakata')}}</h5>
								<p>{{__('lang.weekdays')}}</p>
								<p>
									<i class="fa fa-clock-o"></i> 11:00 - 15:00 ({{__('menu.lunch').'-'.__('menu.last_order')}} 14:30)</br>
									<i class="fa fa-clock-o"></i> 17:00 - 23:00 ({{__('menu.dinner').'-'.__('menu.last_order')}} 22:30)
								</p>
								<p>{{__('lang.weekends')}}</p>
								<p>
									<i class="fa fa-clock-o"></i> 11:00 - 23:00 ({{__('menu.lunch').'-'.__('menu.last_order')}} 15:00 {{__('menu.dinner').'-'.__('menu.last_order')}} 22:30)</br>
								</p>
								<h5>{{__('lang.norimatsu-and-nakama')}}</h5>
								<p>{{__('lang.weekdays-and-weekends')}}</p>
								<p>
								   <i class="fa fa-clock-o"></i> 11:00 - 15:00 ({{__('menu.lunch').'-'.__('menu.last_order')}} 14:30)</br>
								   <i class="fa fa-clock-o"></i> 17:00 - 22:00 ({{__('menu.dinner').'-'.__('menu.last_order')}} 21:30)</br>
								</p>
							</div>
						</div>
					</div>
					<div class="col-sm-12 col-md-6">
						<div class="footer_border_left">
							<div class="footer_menu_section">
								<h3>{{ __('lang.main-branch') }}</h3>
								<div class="row">
									<div class="col-sm-12 col-md-12">
										<div class="ft-address-block">
											<h4>{{ __('lang.branch-name.norimatsu') }}</h4>
											<address>
												〒807-0831 北九州市八幡西区則松7-2-8</br>
												〒Kitakyushu-Shi Yahatanishi-ku Norimatsu 7-2-8 </br>
												Phone no : 093-692-8144
											</address>
										</div>
									</div>
									<div class="col-lg-12">
										<div class="sub-branches">
										<h3>{{ __('lang.branches') }}</h3>
											<div class="row">
											<div class="col-sm-12 col-md-6">
												<div class="ft-address-block">
													<h4>{{ __('lang.branch-name.tobata') }}</h4>
													<address>
														〒804-0022 北九州市戸畑区金比羅2-1</br>
														Kitakyushu-Shi Tobata-ku Konpira 2-1</br>
														Phone no : 093-883-1323
													</address>
												</div>
											</div>
											<div class="col-sm-12 col-md-6">
												<div class="ft-address-block">
													<h4>{{ __('lang.branch-name.munakata') }}</h4>
													<address>
														〒811-3423 福岡県宗像市野坂2648-1</br>
														Fukuoka-ken Munakata-Shi Nosaka 2648-1</br>
														Phone no : 0940-36-8282
													</address>
												</div>
											</div>
											<div class="col-sm-12 col-md-6">
												<div class="ft-address-block">
													<h4>{{ __('lang.branch-name.singu') }}</h4>
													<address>
														〒811-0101 福岡県糟屋郡新宮町原上1615-4</br>
														Fukuoka-ken Khasuyagun Singumachi Harugami 1615-4</br>
														Phone no : 092-962-3630
													</address>
												</div>
											</div>
											<div class="col-sm-12 col-md-6">
												<div class="ft-address-block">
													<h4>{{ __('lang.branch-name.nakama') }}</h4>
													<address>〒809-0013   福岡県中間市上蓮花寺4-1-3</br>4-1-3 Kamirengeji, Nakamashi, Fukuokaken </br>
														Phone no : 093-245-3566
													</address>
												</div>
											</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div><!--footer main row ends-->
			</div>
		</section><!--footer main section ends-->
		<section id="mina_copyright">
			<div class="container">
				<div class="row">
					<div class="col-sm-12 col-md-12">
						<p>Copyright © 2019 All rights were reserved to restaurant Mina</p>
					</div>
				</div>
			</div>
		</section>
	</div>
	<div class="modal" tabindex="-1" role="dialog" id="reservationModal">
		  <div class="modal-dialog modal-lg" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		      	<div class="row">
		      		<div class="col-sm-12">
		        		<h2 class="modal-title">{{ __('menu.reservation') }}</h5>
		        		<p class="modal-title-desc">{{ __('lang.reservation-tagline') }}</p>
		        	</div>
		        </div>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          &times;
		        </button>
		      </div>
		      <div class="modal-body">
		        @include('frontend.inc.reservationModal')
		      </div>
		    </div>
		  </div>
		</div>


	<div class="modal fade" id="modal-spiecy-level" tabindex="-1" role="dialog" aria-labelledby="modal-spiecy-level-Title" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5>ご注文のカレーの辛さをお選びください。<br>Please select the hotness of your curry.</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="table-responsive">
						<table class="table table-bordered">
							<tbody>
								<tr>
									<td>甘口<br>Sweet</td>
									<td></td>
									<td>お子様、甘いものが好きな方におすすめ。<br>(Recommended for children and those who like sweets)</td>
								</tr>
								<!-- end tr  -->

								<tr>
									<td>Mild</td>
									<td>0 倍</td>
									<td>全く辛みのスパイスを加えてないカレーのスパイスのみ。<br>(Only curry spice without pungent taste)</td>
								</tr>
								<!-- end tr  -->

								<tr>
									<td>>></td>
									<td>3 倍</td>
									<td>少しだけ辛みのスパイスを加えました。<br>(just a little bit of spiciness)</td>
								</tr>
								<!-- end tr  -->

								<tr>
									<td>中辛<br>Medium</td>
									<td>5 倍</td>
									<td>中辛の方は、このあたりからスタート.<br>(added a little the pungency of the spices)</td>
								</tr>
								<!-- end tr  -->

								<tr>
									<td>>></td>
									<td>7 倍</td>
									<td>5倍より少し辛みのレベルをあげてみたい方。<br>(Those who want to raise the level of spiciness a little more than 5 times.) </td>
								</tr>
								<!-- end tr  -->

								<tr>
									<td>辛口<br>Hot</td>
									<td>10 倍</td>
									<td>辛口が好きな方は、まずはここからスタート！<br>(if you like to have hot level spice)</td>
								</tr>
								<!-- end tr  -->

								<tr>
									<td>>></td>
									<td>13 倍</td>
									<td>10倍より少し辛みのレベルをあげてみたい方。<br>(Those who want to raise the level of spiciness a little more than 10 times.)</td>
								</tr>
								<!-- end tr  -->

								<tr>
									<td>激辛<br>Super hot</td>
									<td>15 倍</td>
									<td>辛党の方は、ここからチャレンジ！<br>(if you drink alcohol or you like pungent taste )</td>
								</tr>
								<!-- end tr  -->

								<tr>
									<td>¥50</td>
									<td>16~30 倍</td>
									<td>自信のある方におすすめルーの甘みと相乗的に。<br>(if you are confident to take more hotness of pungent taste)</td>
								</tr>
								<!-- end tr  -->

								<tr>
									<td>¥100</td>
									<td>31~50 倍</td>
									<td>本場のインドカレーはここからレッツチャレンジ。<br>(Let's challenge the authentic Indian curry from here)</td>
								</tr>
								<tr>
									<td>¥150</td>
									<td>51~80 倍</td>
									<td>辛いカレーが好きで、全く辛みを感じないかたへ。<br>(For those who like spicy curry and do not feel spicy at all.)</td>
								</tr>
								<tr>
									<td>¥200</td>
									<td>81~100 倍</td>
									<td>手加減なしのミナスパイス大変気をつけましょう。<br>(Let's be very careful with Mina Spice may be harmful.)</td>
								</tr>
								<!-- end tr  -->
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- change modal  -->
	<div class="modal fade" id="changeModal" tabindex="-1" role="dialog" aria-labelledby="changeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    	<form action="#" method="POST" name="__change_service_naan_form" id="__change_service_naan_form">
	        <div class="modal-content">
	            <div class="modal-header">
	                <h4 class="modal-title" id="changeModalLabel">{{ __('form.change-service-naan') }}</h4>
	                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                    <span aria-hidden="true">&times;</span>
	                </button>
	            </div>
	            <div class="modal-body">
	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn--primary" data-dismiss="modal">{{ __('form.close') }}</button>
	                <button type="submit" class="btn show_more_menu">{{ __('form.update') }}</button>
	            </div>
	        </div>
	    </form>
    </div>
</div>

	<div class="scrollToTop">
		<i class="fa fa-arrow-up"></i>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js" type="text/javascript"/></script>
	<script src="{{asset('/front-assets/js/jquery-migrate.min.js')}}" type="text/javascript"/></script>
	<script src="{{asset('/front-assets/js/slick.min.js')}}" type="text/javascript"/></script>
	<script src="{{asset('/front-assets/js/bootstrap.min.js')}}" type="text/javascript"/></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollToFixed/1.0.8/jquery-scrolltofixed-min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
	<script src="{{asset('/front-assets/js/aos.min.js')}}"></script>
	<script src="{{asset('/front-assets/js/jquery.matchHeight-min.js')}}"></script>
	<script src="https://malihu.github.io/custom-scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script src="{{asset('admin-assets/formvalidation/dist/js/FormValidation.min.js')}}"></script>
	<script src="{{asset('admin-assets/formvalidation/dist/js/plugins/Bootstrap.min.js')}}"></script>
	<script src="{{asset('/front-assets/js/custom.js')}}" type="text/javascript"/></script>
	@yield('page_specific_js')
	<script>
		var form = document.getElementById('reservationModalForm');
		var current_click,url,qty,spicy,data,bbq_pcs;
		var change_btn;
		var save_url = "{{route('frontend.reservations.store')}}";
		$(document).ready(function(){
			$("ul.language_switcher li a").on('click',function(){
				//get the current click data lang
				var to_switch_language = $(this).attr('data-lang')
				//render the data object
				var data = {
					'to_language' : to_switch_language
				}
				$.get("{{url('/changeLanguage')}}",data,function(response){
					if(response.status == "success"){
						//reload the page
						location.reload();
					}else{
						//show the error messagge
					}
				})
			})
			 $('#reservation').on('click', function(e) {
		        //prevent the default action
		        e.preventDefault();
		        $('#reservationModal').modal('show');
		    })

			const fv = FormValidation.formValidation(
	        form,
	        {
	            fields: {
	                customerFullname:{
	                    validators:{
	                        notEmpty:{
	                            message: "{{ __('form.invalid-name') }}",
	                        },

	                        stringLength:{
	                            min: 4,
	                            message: "{{ __('form.invalid-name-length') }}",
	                        }
	                    }
	                },
	                customerEmail: {
	                    validators: {
	                        notEmpty: {
	                            message: "{{ __('form.invalid-email') }}",
	                        },
	                        emailAddress:{
	                        	message: "{{ __('form.invalid-email-format') }}",
	                        }
	                    }
	                },
	                customerPhone: {
	                    validators: {
	                    	notEmpty:{
	                    		message: "{{ __('form.invalid-phone') }}",
	                    	},
	                    	stringLength:{
	                    		min:8,
	                    		max:14,
	                    		message: "{{ __('form.invalid-phone-format') }}",
	                    	}
	                    }

	                },
	                reservationDate: {
	                    validators: {
	                        notEmpty: {
	                            message: "{{ __('form.invalid-reservation-date') }}",
	                        },
	                    }

	                },
	                reservationMessage: {
	                    validateField: {}

	                }
	            },
	            plugins: {
	                trigger: new FormValidation.plugins.Trigger(),
	                submitButton: new FormValidation.plugins.SubmitButton(),
	                //defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
	                // Support the form made in Bootstrap 4
	                bootstrap: new FormValidation.plugins.Bootstrap(),
	                // Show the feedback icons taken from FontAwesome
	                icon: new FormValidation.plugins.Icon({
	                    valid: 'fa fa-check',
	                    invalid: 'fa fa-times',
	                    validating: 'fa fa-refresh',
	                }),
	            },

	        }).on('core.form.valid', function () {
	            // get the input values
	            result = new FormData($(form)[0]);
	            $.ajax({
	                url: save_url,
	                data: result,
	                dataType: "Json",
	                contentType: false,
	                processData: false,
	                type: "POST",
	                beforeSend:function(){
	                	$(".ajax-loader").show();
	                },
	                success: function (data) {
	                    if(data.status == "success"){
	                        fv.resetForm(true);
	                    	$(form)[0].reset();
	                        $('#reservationModal').modal('hide');
	                        $(".ajax-loader").hide();
	                        swal({
	                            title: data.title,
	                            text: data.message,
	                            icon: "success",
	                            button: "OK",
	                        });
	                    }else{
	                        swal({
	                            title: data.title,
	                            text: data.message,
	                            icon: "error",
	                            button: "OK"
	                        })
	                    }

	                },
	                error: function (jqXHR,textStatus,errorThrown) {
	                    if(jqXHR.status == 500){
	                        console.log('There is server error adding the new menu, please try again');
	                    }
	                }

	            });
	        });

	         //remove the time from the cart
	        $('body').on('click','a.item_delete_btn',function(e){
	            //prevent the default action
	            e.preventDefault();
	            current_click = $(this);
	            var cart_item_id = $(this).data('cart-item-id');
	            //ask the user do they really want to remove the item from the cart 
	            swal({
		            title: "{{ __('form.delete-option') }}",
		            text: "{{ __('form.delete-msg') }}",
		            icon: "warning",
		            buttons: {
		                cancel: " {{ __('form.cancel') }}",
		                catch: {
		                    text: "{{ __('form.delete') }}",
		                    value: "catch",
		                },
		            },
		            showCancelButton: true,
		            confirmButtonClass: "btn-danger",
		            confirmButtonText: "Yes, delete it!",
		            cancelButtonText: "No, cancel please!",
		            closeOnConfirm: false,
		            closeOnCancel: false
		        }).then(function (isConfirm) {
		            if (isConfirm) {
		            	$.ajax({
		            		url: "{{url('/carts/removeItem')}}" + "/" + cart_item_id,
		            		type: "GET",
		            		dataType: "JSON",
		            		beforeSend: function(){
		            			$('.ajax-loader').show();
		            		},
		            		success:function(response){
		            			// check the response type
		            			$('.ajax-loader').hide();
				                if(response.status == "success"){
				                    // swal({
				                    //     title: response.title,
				                    //     text: response.message,
				                    //     icon: "success",
				                    //     button: "OK",
				                    // });
				                    //$('nav ul li.dropdown_cart_list').html(response.cart_details);
				                    $('span.__total_items_in_cart').html(response.__total_items_in_cart);
				                    $(current_click).parent().closest('li').remove();
				                    //remove the cart td as well
				                    $(current_click).parent().closest('tr').remove();
				                    if(response.__total_items_in_cart > 0){
		    							$('span.__total_items').html(response.__total_items);
					                    //update the cart
					                    $(".cart-footer .__cart_total").html("¥" + response.__cart_total);
		    							$(".cart-footer .__cart_tax").html("¥" + response.__cart_tax);
		    							$(".cart-footer .__cart_grand_total").html("¥" + response.__grand_total);
		    							$("span.__cart_grand_total").html("¥" + response.__grand_total);
		    							if(response.is_discount_enable){
				                            $('.cart-footer .discountLeft').html(response.discount_name)
				                            $('.cart-footer .discountRight').html("¥"+ response.discount_amount)
				                            $('.cart-footer .discount').removeClass('hideDiscount')
				                        }else{
				                            $('.cart-footer .discount').addClass('hideDiscount')
				                        }
		    							change_btn = $('body').find('.change-variation .btn')
				    				    $(change_btn).parent().closest('.item_details').find('.price').remove()
							 			$(change_btn).parent().closest('.item_details').find('.item-price').html(response.__offer_details)
							 			$(change_btn).parent().closest('tr.__offer_row').find('.__line_total').html("¥" + response.__offer_total)
							 			$('body').find('tr.__offer_row').show()
		    						}else{
		    							$('div.mini_cart_details').html(response.__cart_html)
		    							$('div.cart-page-section').html(response.__cart_empty_html)
		    						}

		    						if(response.__free_service_naan == 0){
		    							$('body').find('tr.__offer_row').hide();
		    						}
				                }
		            		}
		            	})
		            }
		         })
		     })

	        //update cart when the qty increase
	        $('body').on('click','.cart-variations .sp-plus ,.cart-variations .sp-minus',function(e){
	        	//prevent the default action
	        	e.preventDefault()
	        	//check the spicy level
	        	var spicy_level_set_or_not = $(this).parent().closest('div.cart-variations').find('select.__product_spicy_level').val();
	        	if(typeof spicy_level_set_or_not !== "undefined"){
	        		$(this).parent().closest('div.cart-variations').find('select.__product_spicy_level').trigger('change');
	        	}else{
	        		//check the click is for the cart page or not
	        		spicy_level_set_or_not = $(this).parent().closest('tr').find('select.__product_spicy_level').val()
	        		if(typeof spicy_level_set_or_not !== "undefined"){
	        			$(this).parent().closest('tr').find('select.__product_spicy_level').trigger('change');
	        		}else{
	        			//call the function to update cartQty
			        	current_click = $(this)
			        	url = "{{url('/carts/updateItemQty')}}"
			        	updateCartQuantity(current_click,url,spicy=false,bbq_pcs=false)
	        		}

	        	}

	        })

	         $('body').on('click','.change-variation .btn', function(e) {
		        //prevent the default action
		        e.preventDefault()
		        change_btn = $(this)
		        $.get("{{route('frontend.carts.getServiceNaanDetails')}}",function(response){
		        	//append the content
		        	$("#changeModal .modal-body").html(response.return_html)
		        	$('#changeModal').modal('show');
		        })
		        // console.log('i need to show the modal');
		    })

	         //track when the change product qty change

	         //track when the product change
	         $('body').on('change','.__change_free_naan_product, .__change_free_naan_qty',function(e){
	         	//prevent the default action
	         	e.preventDefault()
	         	var current_click  = $(this);
	         	changeServiceNaan(current_click)

	         })

	          $('body').on('change','.__change_free_naan_qty',function(e){
	          	e.preventDefault()
	         	var current_click  = $(this);
	         	changeServiceNaan(current_click)
	         	var free_naan_qty = parseInt($("#__free_service_naan").val())
	         	//get total change item
	         	var total_change_qty_list    = $('.__change_free_naan_qty')
	         	var total_change_qty  = 0
	         	var button_text       = ""
	         	$.each(total_change_qty_list,function(index,value){
	         		total_change_qty	+= parseInt($(this).val())
	         	})
	         	var total_previous_siblings_qty = parseInt($(current_click).val())
	         	var total_next_siblings_qty = 0

	         	//first check current change had sibings before or not
	         	var previous_siblings = $(current_click).parent().closest('.free-items').prevAll('div.free-items').find('.__change_free_naan_qty')
	         	if(previous_siblings.length > 0){
	         			// get the total qty of the provious one
	         			$.each(previous_siblings, function(index,value){
	         				total_previous_siblings_qty += parseInt($(this).val())
	         				
	         			})
	         			total_next_siblings_qty     = total_previous_siblings_qty

	         			//check for the total silbings qty
	         			if(total_previous_siblings_qty	>= free_naan_qty){
	         				$(current_click).parent().closest('.free-items').nextAll('div.free-items').remove()
	         				$('body').find('div.add-item').remove()
	         			}else{
	         				findCurrentChangeNextSiblings(current_click,total_next_siblings_qty,free_naan_qty)
	         			}
	         	}else{
	         		//check the total qty is equal to free naan
	         		if(parseInt($(current_click).val()) == free_naan_qty){
	         			$(this).parent().closest('.free-items').nextAll('div.free-items').remove()
	         			$('body').find('div.add-item').remove()
	         			calculateUpdateCartTotal()

	         		}else{
	         			total_next_siblings_qty  = parseInt($(current_click).val())
	         			findCurrentChangeNextSiblings(current_click,total_next_siblings_qty,free_naan_qty)
	         		}
	         	}
	          })
	         //body on click add-item add then add new row
	         $('body').on('click','.add-item .add',function(e){
	         	e.preventDefault()
	     		e.stopPropagation()
	     		$(this).prop('disabled',true)
	         	var total_change_qty_list    = $('.__change_free_naan_qty')
	         	var total_change_qty  = 0
	         	$.each(total_change_qty_list,function(index,value){
	         		total_change_qty	+= parseInt($(this).val())
	         	})
	         	$.get("{{route('frontend.carts.addNewServiceNaan')}}",{_total_change_qty: parseInt(total_change_qty)},function(response){
		        	//append the content
		        	$(".free-items").last().after(response.return_html)
		        	// $('#changeModal').modal('show');
		        	$('body').find('div.add-item').remove()
		        })
	         })

	         //remove the item when delete button is clicked
	         $('body').on('click','.remove_service_naan a',function(e){
	         	e.preventDefault()
	         	//check for the next siblings and increase the options of them
	         	$(this).parent().closest('div.free-items').remove()
	         	$('div.free-items').first().find('.__change_free_naan_qty').trigger('change')
	         	//need to calculate the total price
	         	button_text	= '<div class="add-item"><div class="add">+</div>'
	         	$('body').find('div.add-item').remove()
	         	$(".free-items:last").after(button_text)
	         	calculateUpdateCartTotal()
			 })

			 $('body').on('click','button.show_more_menu',function(e){
			 	e.preventDefault()
			 	//get the total changed qty
	         	var total_change_qty_list    = $('.__change_free_naan_qty')
	         	var total_change_qty  = 0
	         	$.each(total_change_qty_list,function(index,value){
	         		total_change_qty	+= parseInt($(this).val())
	         	})
			 	//get the free naan qty
			 	var free_naan_qty = parseInt($("#__free_service_naan").val())
			 	//if the total changed qty is greater than the naan qty
			 	if(total_change_qty > free_naan_qty){
			 		//show message
			 		swal({
			 			title:"Change failed!",
			 			text:"Change service naan exceeds than 10 free service naan you have",
			 			icon:"error",
			 			button: "Ok"
			 		})
			 	}
			 	else{
			 		//send the request to the server to 
			 		var result = new FormData($("#__change_service_naan_form")[0]);
			 		result.append('_token',"{{csrf_token()}}")
				 	$.ajax({
				 		url:"{{route('frontend.carts.updateServiceNaan')}}",
				 		type: "POST",
				 		dataType: "JSON",
				 		contentType: false,
	                	processData: false,
	                	cache: false,
				 		data:result,
				 		beforeSend:function(){
				 			$('.ajax-loader').show()
				 		},
				 		success:function(response){
				 			//append the data 
				 			$(change_btn).parent().closest('.item_details').find('.price').remove()
				 			$(change_btn).parent().closest('.item_details').find('.item-price').html(response.return_html)
				 			$(change_btn).parent().closest('tr.__offer_row').find('.__line_total').html("¥" + response.change_total)

				 			//need to update the cart total as well
				 			$('.__cart_total').html("¥" + response.__cart_total)
				 			$('.__cart_tax').html("¥" + response.__cart_tax)
				 			$('.__cart_grand_total').html("¥" + response.__cart_grand_total)
				 			if(response.is_discount_enable){
	                            $('.cart-footer .discountLeft').html(response.discount_name)
	                            $('.cart-footer .discountRight').html("¥"+ response.discount_amount)
	                            $('.cart-footer .discount').removeClass('hideDiscount')
	                        }else{
	                            $('.cart-footer .discount').addClass('hideDiscount')
	                        }
				 			//close the modal
				 			 $('#changeModal').modal('hide')
				 			//hide the ajax loader
				 			$('.ajax-loader').hide()
				 		},
				 		error:function(jqXHR,textStatus){

				 		}
				 	})
				}
			 })

	        //update cart when the product spicy level change
	        $('body').on('change','select.__product_spicy_level',function(e){
	        	//prevent the default action
	        	e.preventDefault()
	        	current_click = $(this)
	        	url = "{{url('/carts/updateItemSpicyLevel')}}"
	        	updateCartQuantity(current_click,url,spicy=true,bbq_pcs=false);
	        })

	        // update cart when the bbq_pcs change
	        $('body').on('change','.__product_bbq_pcs',function(e){
	        	//prevent the default action
	        	e.preventDefault()
	        	current_click = $(this)
	        	url = "{{url('/carts/updateItemPcs')}}"
	        	updateCartQuantity(current_click,url,spicy=false,bbq_pcs=true)

	        })

	        //check the pickup time when the add to checkout button was clicked
	        $('body').on('click','.btn-procced-to-takeout',function(event){
	        	event.preventDefault();
	        	event.stopPropagation();
	        	//check for the pickup branch has been set or not
	        	var __pickup_branch  = $("select#__pickup_branch").val()
	        	if(__pickup_branch != null){
	        		var __pickup_time  = $("select#__pickup_time").val()
		        	if(__pickup_time != null)
		        	{
		        		//$('#__pickup_time').trigger('change');
		        		//changePickuptime(__pickup_time, show_alert=false);
		        		window.location = "{{route('frontend.checkoutpage')}}"

		        	}else{
		        		//check the pickup time has option or not
		        		if($("select#__pickup_time option").length > 1){
		        			//show the error message 
		        			swal({
			        			 title: "{{__('form.takeout.select-pickup-time')}}",
					             text: "{{__('form.pickup-time-not-set')}}",
					             icon: "error",
					             button: "OK",
			        		})
		        		}else{
		        			swal({
			        			 title: "{{__('form.takeout-closed')}}",
					             text: "{{__('form.takeout-closed-msg')}}",
					             icon: "error",
					             button: "OK",
			        		})
		        		}
		        	}
	        	}else{
	        		swal({
	        			 title: "{{__('form.takeout.select-branch')}}",
			             text: "{{__('form.pickup-branch-not-set')}}",
			             icon: "error",
			             button: "OK",
	        		})
	        	}
	        	
	        })

	        //track the user action when the pickup time is changed
	        // $('body').on('change','#__pickup_time',function(event){
	        // 	//prevent the default action
	        // 	event.preventDefault()
	        // 	var __pickup_time = $(current_click).val()
	        // 	//only request to the server if the pickup time was set
	        // 	changePickuptime(__pickup_time, show_alert=true);
	        // })

	        //need to fetch the updated takeout time data from the server in each 9 minutes


	        $('.modal').on('hidden.bs.modal',function(){
	        	$(form)[0].reset();
	        	fv.resetForm(true);
	        })
		})


	//function to calcualte the update free naan total
	function calculateUpdateCartTotal(){
		var __total_amount      = 0.00;
     	var line_total_occurance = $('body').find('.free-items div.price span')
     	$.each(line_total_occurance,function(index,value){
     		__total_amount   += parseFloat($(this).text())
     	})
     	//set the total value here
     	$('body').find('.change-amount span.__update_total').html(__total_amount.toFixed(0))
	}


	//function to calucalte the next siblings of the update cart
	function findCurrentChangeNextSiblings(current_click,total_next_siblings_qty,free_naan_qty){
		var next_siblings     = $(current_click).parent().closest('.free-items').nextAll('div.free-items').find('.__change_free_naan_qty')
     	if(next_siblings.length > 0){
     		// get the total qty of the next one
 			$.each(next_siblings, function(index,value){
 				//if the total qty exteeds remove the next all
 				if(total_next_siblings_qty >= free_naan_qty){
 					$(this).parent().closest('.free-items').nextAll('div.free-items').remove()
						$('body').find('div.add-item').remove()
						var selected_next_siblings_qty = $(this).val()
						var new_options = ""
						var i =1
						for(i; i <= (free_naan_qty - total_next_siblings_qty); i++){
							new_options += "<option value='" + i + "'>" + i + "</option>"
						}

						$(this).find('option').remove().end().append(new_options).val(selected_next_siblings_qty)
						//need to calculate the total
						calculateUpdateCartTotal()
 				}else{
 					    var selected_next_siblings_qty = parseInt($(this).val())
						var new_options = ""
						var i =1
						for(i; i <= (free_naan_qty - total_next_siblings_qty); i++){
							new_options += "<option value='" + i + "'>" + i + "</option>"
						}

						//check the selected value if greater than i
						if(selected_next_siblings_qty < i){
							$(this).find('option').remove().end().append(new_options).val(selected_next_siblings_qty)
						}else{
							$(this).find('option').remove().end().append(new_options).val(1)
							var change_product     = $(this).parent().closest('div.free-items').find('.__change_free_naan_product option:selected')
					     	var change_product_qty = $(this).parent().closest('div.free-items').find('.__change_free_naan_qty').val()
					     	var product_id         = change_product.data('product-id')
					     	var product_price      = change_product.data('product-price')
					     	var __line_total       = parseFloat(parseFloat(product_price) * parseInt(change_product_qty))
					     	$(this).parent().closest('div.free-items').find('.price span').html(__line_total.toFixed(0))
							calculateUpdateCartTotal()
						}

						total_next_siblings_qty += parseInt($(this).val())
						if(total_next_siblings_qty >= free_naan_qty){
     					$(this).parent().closest('.free-items').nextAll('div.free-items').remove()
							$('body').find('div.add-item').remove()
						}

 				}
 				
 			})
     	}else{
     		//no next siblings exts show the add item button

     		button_text	= '<div class="add-item"><div class="add">+</div>'
				$('body').find('div.add-item').remove()
				$(".free-items:last").after(button_text)
     	}
	}

	//function to update the cart quantity
	function updateCartQuantity(current_click,url,spicy=false,bbq_pcs=true){
    	var cart_item_id = $(current_click).parent().closest('div.item_details_row').find('a.item_delete_btn').data('cart-item-id')
    	if(typeof cart_item_id	 == "undefined"){
    		cart_item_id = $(current_click).parent().closest('tr').find('a.item_delete_btn').data('cart-item-id')
    	}

    	if(spicy){
    		//spy level
    		qty           = $(current_click).parent().closest('div.cart-variations').find('input.quntity-input').val()
    		if(typeof qty	 == "undefined"){
    			//check for the cart page
    			qty        = $(current_click).parent().closest('tr').find('input.quntity-input').val()
    		}
    		spicy         = $(current_click).val() 
    		data ={
    			__qty : qty,
    			spicy : spicy
    		}
    	}else if(bbq_pcs){
    		//bbq_pcs
    		qty           = $(current_click).parent().closest('div.cart-variations').find('input.quntity-input').val()
    		if(typeof qty	 == "undefined"){
    			qty       = $(current_click).parent().closest('tr').find('input.quntity-input').val()
    		}
    		bbq_pcs     = $(current_click).val()
    		data        = {
    			__qty   : qty,
    			bbq_pcs : bbq_pcs
    		}
    	}
    	else{
    		//normal qty
    		//check the spicy has set or not
    		qty           = $(current_click).parent().find('input').val();
    		data          = {
	    		__qty : qty
	    	}
    	}
    	if(parseInt(qty) >= 1){
    		//make the request to update cart
    		$.ajax({
    			url: url + "/" + cart_item_id,
    			type: "GET",
    			dataType: "JSON",
    			data: data,
    			beforeSend:function(){
    				$('.ajax-loader').show();
    			},
    			success:function(response){
    				if(response.status == "success"){
	    				$(current_click).parent().closest('div.item_details_row').find('div.item-total').html("¥"+ response.__line_total)
	    				$(current_click).parent().closest('tr').find('div.__line_total').html("¥"+ response.__line_total)
	    				$(current_click).parent().closest('div.item_details_row').find('span.__product_qty').html(qty)
	    				$(current_click).parent().closest('tr').find('span.__product_qty').html(qty)
	    				$('span.__total_items_in_cart').html(response.__total_items_in_cart);
	    				$('span.__total_items').html(response.__total_items);
	    				if(spicy){
	    					$(current_click).parent().closest('div.item_details_row').find('span.__extra_spicy_price').html(" + ¥" + response.__extra_spicy_price)
	    					$(current_click).parent().closest('tr').find('span.__extra_spicy_price').html(" + ¥" + response.__extra_spicy_price);
	    					$(current_click).parent().closest('tr').find('div.spicy-price').html(" Spicy price: ¥" + response.__extra_spicy_price)
	    					//update the 
	    					
	    				}

	    				if(bbq_pcs){
	    					$(current_click).parent().closest('div.item_details_row').find('div.price').html("<span class='__product_qty'>"+ qty + "</span> × ¥" + response.__product_price);
	    					$(current_click).parent().closest('tr').find('div.price').html("(<span class='__product_qty'>"+ qty + "</span> × ¥" + response.__product_price + ")");
	    				}
	    				//update the cart amount
	    				$(".cart-footer .__cart_total").html("¥" + response.__cart_total);
	    				$(".cart-footer .__cart_tax").html("¥" + response.__cart_tax);
	    				$(".cart-footer .__cart_grand_total").html("¥" + response.__grand_total);
	    				$("span.__cart_grand_total").html("¥" + response.__grand_total);
	    				if(response.is_discount_enable){
                            $('.cart-footer .discountLeft').html(response.discount_name)
                            $('.cart-footer .discountRight').html("¥"+ response.discount_amount)
                            $('.cart-footer .discount').removeClass('hideDiscount')
                        }else{
                            $('.cart-footer .discount').addClass('hideDiscount')
                        }
	    				$('.ajax-loader').hide();

	    				if(response.__free_service_naan > 0){
	    					change_btn = $('body').find('.change-variation .btn')
	    				    $(change_btn).parent().closest('.item_details').find('.price').remove()
				 			$(change_btn).parent().closest('.item_details').find('.item-price').html(response.__offer_details)
				 			$(change_btn).parent().closest('tr.__offer_row').find('.__line_total').html("¥" + response.__offer_total)
				 			if(response.is_discount_enable){
	                            $('.cart-footer .discountLeft').html(response.discount_name)
	                            $('.cart-footer .discountRight').html("¥"+ response.discount_amount)
	                            $('.cart-footer .discount').removeClass('hideDiscount')
	                        }else{
	                            $('.cart-footer .discount').addClass('hideDiscount')
	                        }
	    					$('body').find('tr.__offer_row').show()
	    				}else{
	    					$('body').find('tr.__offer_row').hide()
	    				}
	    			}
    			}

    		})

    		//remove the disabled from minus 
    	}else{
    		$(current_click).parent().closest('div.item_details_row').find('span.__product_qty').html(qty);
    	}
	}

	// function to calcualte the price when the service naan changed
	function changeServiceNaan(current_click){
		var change_product     = $(current_click).parent().closest('div.free-items').find('.__change_free_naan_product option:selected')
     	var change_product_qty = $(current_click).parent().closest('div.free-items').find('.__change_free_naan_qty').val()
     	var product_id         = change_product.data('product-id')
     	var product_price      = change_product.data('product-price')
     	var __line_total       = parseFloat(parseFloat(product_price) * parseInt(change_product_qty))
     	$(current_click).parent().closest('div.free-items').find('.price span').html(__line_total.toFixed(0))
     	//get all the line total
     	var __total_amount      = 0.00;
     	var line_total_occurance = $('body').find('.free-items div.price span')
     	$.each(line_total_occurance,function(index,value){
     		__total_amount   += parseFloat($(this).text())
     	})

     	//set the total value here
     	$('body').find('.change-amount span.__update_total').html(__total_amount.toFixed(0))
	}

	//change the pickup time ajax call function
	function changePickuptime(__pickup_time, show_alert=false){
		if(__pickup_time.length > 0){
    		$.ajax({
    			url: "{{route('frontend.carts.changePickuptime')}}",
    			type: "GET",
    			dataType: "JSON",
    			data:{
    				__pickup_time : __pickup_time,
    				show_alert    : show_alert
    			},
    			beforeSend:function(){
					if(show_alert){
						$('.ajax-loader').show()	
					}
    			},
    			success:function(response){
    				if(show_alert){
						$('.ajax-loader').hide()
						//need to show the message
						swal({
							title: response.title,
							text : response.message,
							icon: "success",
							button: 'Ok'
						})	
					}
    			},
    			error:function(){

    			}
    		})
    	}

	}
	</script>
</body>
</html>