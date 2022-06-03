@extends('frontend.layouts.master')

@section('page_name','Home')

@section('page_specific_css')
<style>
    .__menu_top_content{
        background: #d90b17;
        color: #fff !important;
        padding: 5px;
        border-radius: 50px;
        text-align: center;
    }
</style>

@endsection

@section('content')

@include('frontend.inc.banner')

<section id="_mina_short_intro">

    <div class="container">

        <div class="row _top_heading_row">

            <div class="col-lg-12">

                <h2 class="_top_heading" data-aos="fade-up" data-aos-duration="1000">{{ __('lang.welcome-to-mina') }}</h2>

                <p class="_top_content" data-aos="fade-up" data-aos-duration="1500">{{ __('lang.welcome-tagline') }}</p>

            </div>

        </div>

        <div class="row">

            <div class="col-lg-5">

                <div class="_short_desc class=" _top_heading" data-aos="fade-up" data-aos-duration="1000">

                    

                    <p>{{ __('lang.ceo-voice') }}</p>

                    

                    <div class="welcome-image">

                        <img src="{{asset('/front-assets/images/photo-md.jpg')}}" alt="">

                    </div>

                    <h3>{{ __('lang.ceo-name') }} / {{ __('lang.ceo-position') }}</h3>

                    <!-- <a href="{{route('frontend.aboutpage')}}" class="btn btn-small btn-view-more">{{ __('lang.learn-more-btn') }}</a> -->

                </div>

            </div>

            <div class="col-lg-7 d-sm-block">

                <div class="row">

                    <div class="col-md-6">

                        <div class="about_image _upper_image" class="_top_heading" data-aos="fade-up" data-aos-duration="1000">

                            <img src="{{asset('/front-assets/images/butter_chicken_curry.jpg')}}">

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="about_image _upper_image" class="_top_heading" data-aos="fade-up" data-aos-duration="1000">

                            <img src="{{asset('/front-assets/images/dal_curry.jpg')}}">

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="about_image" class="_top_heading" data-aos="fade-up" data-aos-duration="2000">

                            <img src="{{asset('/front-assets/images/prawn_green_asparagus_curry.jpg')}}">

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="about_image" class="_top_heading" data-aos="fade-up" data-aos-duration="2000">

                            <img src="{{asset('/front-assets/images/chicken_baigan_curry.jpg')}}">

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<!--end of short introduction div-->

<section id="_mina_grand_menu">

    <div class="container grand_menu_container">

        <div class="row">

            <div class="col-lg-12">

                <div class="mina_menu_heading">

                    <h2 class="_top_heading" class="_top_heading" data-aos="fade-up" data-aos-duration="1000">{{ __('lang.our-speical-menu') }}</h2>

                    <p class="_top_content" class="_top_heading" data-aos="fade-up" data-aos-duration="1500">{{ __('lang.our-speical-menu-tagline') }}</p>

                </div>

            </div>

        </div>

        @if($menus->count() > 0)

        <div class="mina_menu_tabs">

            <ul class="nav nav-tabs slider-nav">

                @php($i = 0)

                @foreach($menus as $menu)

                    <li class="@if($i == 0){{'active'}}@endif"><a data-toggle="tab" href="#{{$menu->slug}}">{{$menu->name}}</a></li>

                @php($i++)

                @endforeach

            </ul>

            @php($i=0)

            <div class="tab-content slider-for">

                @foreach($menus as $menu)

                 <div id="{{$menu->slug}}" class="tab-pane fade @if($i == 0){{'in show active'}}@endif">

                    <div class="row">
                        @if($menu->id == 12)
                            <div class="col-md-12">
                                <p class="__menu_top_content">{{ __('form.free-service-naan-for-lunch-and-dinner') }}</p>
                            </div>
                        @endif
                        @foreach($menu->products()->where('status','1')->limit(6)->get() as $product)

                            @include('frontend.inc.productDetails',['product' => $product])

                        @endforeach

                    </div>

                </div>

                @php($i++)

                @endforeach

            </div>

        </div>

        <div class="mina_all_menu">

            <a href="{{route('frontend.menupage')}}" class="btn btn-large show_more_menu">{{ __('lang.explore-more-btn') }}</a>

        </div>

        @endif

    </div>

</section>

<section class="mina_grand_menu-next"></section>

<section id="reservation">

    <!-- reservation section -->

    <div class="container">

		<div class="reservation_heading">

			<h2 class="_top_heading" data-aos="fade-up" data-aos-duration="1000">{{ __('menu.reservation') }}</h2>

			<p class="_top_content" data-aos="fade-up" data-aos-duration="1500">{{ __('lang.reservation-tagline') }}</p>

		</div>

		

		@include('frontend.inc.reservation')



    </div>

</section><!-- reservations sections ends -->

@include('frontend.inc.testimonials')

@endsection

@section('page_specific_js')

<script>

    var reservationForm = document.getElementById('reservationForm');

    $(document).ready(function(){

         const fc = FormValidation.formValidation(

            reservationForm,

            {

                fields: {

                    fullname:{

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

                    email: {

                        validators: {

                            // notEmpty: {

                            //     message: "{{ __('form.invalid-email') }}"

                            // },

                            emailAddress:{

                                message: "{{ __('form.invalid-email-format') }}",

                            }

                        }

                    },

                    phone: {

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

                    reservation_date: {

                        validators: {

                            notEmpty: {

                                message: "{{ __('form.invalid-reservation-date') }}",

                            },

                        }



                    },

                    message: {

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

                result = new FormData($(reservationForm)[0]);

                $.ajax({

                    url: save_url,

                    data: result,

                    dataType: "Json",

                    contentType: false,

                    processData: false,

                    type: "POST",

                    beforeSend:function(){

                        $('.ajax-loader').show();

                    },

                    success: function (data) {

                        if(data.status == "success"){

                            //resert the form field

                            fc.resetForm(true);

                            $(reservationForm)[0].reset();

                            //show message in the div

                            $('.ajax-loader').hide();

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





        //add to takeout button clicked

        $('body').on('click','.__add_to_takeout_btn',function(event){

            event.preventDefault();

            var current_click = $(this);

            var current_click_id = $(current_click).data('product-number');

            var form_data = new FormData($('#__addTakeout' + current_click_id)[0]);

            form_data.append('_token',"{{csrf_token()}}");

            //check for the pickup time

            $.ajax({

                url: "{{route('frontend.carts.add')}}",

                type: "POST",

                dataType: "JSON",

                data: form_data,

                contentType: false,

                processData: false,

                beforeSend:function(){

                    $('.ajax-loader').show();

                    $(".mini_cart_dropwn ul.mini_cart_list").mCustomScrollbar("destroy"); //Destroy

                },

                success:function(response){

                    $('.ajax-loader').hide();

                    if(response.status == "success"){

                        //success message from the server

                        //need to reset the form 

                        $("#__addTakeout" + current_click_id)[0].reset();

                        swal({

                            title: response.title,

                            text: response.message,

                            icon: "success",

                            button: "OK",

                        });

                        $('nav li.dropdown_cart_list').html(response.cart_details);

                        $('span.__total_items_in_cart').html(response.__total_items_in_cart)

                        $('span.__total_items').html(response.__total_items)



                    }

                    else if (response.status == "failed"){

                        //failed response from the server

                        swal({

                            title: response.title,

                            text: response.message,

                            icon: "error",

                            button: "OK"

                        })

                    }

                },

                complete:function(){

                    $(".mini_cart_dropwn ul.mini_cart_list").mCustomScrollbar({

                        theme: "dark",

                    });

                },

                error:function(jqXHR,textStatus,errorThrown){



                }

            })

        })

    })

</script>

@endsection