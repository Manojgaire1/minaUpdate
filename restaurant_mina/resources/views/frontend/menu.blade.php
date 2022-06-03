@extends('frontend.layouts.master')

@section('page_name',__('menu.menu'))

@section('page_specific_css')
<style>
    .__menu_top_content{
        background: #d90b17;
        color: #fff !important;
        padding: 5px;
        border-radius: 50px;
    }
</style>
@endsection

@section('content')

@include('frontend.inc.breadcumb')

<section id="_mina_grand_menu" class="mina_grand_menu_wrapper">

    <div class="container grand_menu_container">

        <div class="row">

            <div class="col-lg-12">

                <div class="mina_menu_heading">

                    <h2 class="_top_heading" class="_top_heading" data-aos="fade-up" data-aos-duration="1000">{{ __('lang.our-speical-menu') }}</h2>

                   <p class="_top_content __menu_top_content"  data-aos="fade-up" data-aos-duration="1500">{{ __('form.free-service-naan-for-lunch-and-dinner') }}</p>

                </div>

            </div>

        </div>



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

                        @foreach($menu->products()->where('status','1')->get() as $product)

                            @include('frontend.inc.productDetails',['product' => $product])

                        @endforeach

                    </div>

                </div>

                @php($i++)

                @endforeach

            </div>

        </div>

</section>





<section class="mina_grand_menu-next"></section>

@endsection

@section('page_specific_js')

<script>

$(document).ready(function(){

 //add to takeout button clicked

    $('body').on('click','.__add_to_takeout_btn',function(event){

        event.preventDefault();

        var current_click = $(this);

        var current_click_id = $(current_click).data('product-number');

        var form_data = new FormData($('#__addTakeout' + current_click_id)[0]);

        form_data.append('_token',"{{csrf_token()}}");

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

                    $('nav li.dropdown_cart_list').html(response.cart_details)

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