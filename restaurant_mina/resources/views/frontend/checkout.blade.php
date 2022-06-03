@extends('frontend.layouts.master')
@section('page_name',__('menu.checkout'))
@section('page_specific_css')
<style>
    .offer-item-price{
        margin-top: -30px;
    }

    .hideDiscount{
        display: none !important;
    }
</style>
@endsection
@section('content')
@include('frontend.inc.breadcumb')
<section class="checkout form-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="checkout__form">
                    <form action="#" name="__checkout_form" id="__checkout_form" method="POST">
                        @csrf
                        <div class="row">
                             <div class="col-lg-6">
                                <div class="form-group">
                                    <label>{{ __('form.takeout.lastname') }}<span class="__form_required">*</span> <span class="name_help">{{__('form.takeout.lastname-in-english')}}</span></label>
                                    <input type="text" class="form-control" placeholder="{{ __('form.takeout.lastname') }}" name="last_name">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>{{ __('form.takeout.firstname') }}<span class="__form_required">*</span> <span class="name_help">{{__('form.takeout.firstname-in-english')}}</span></label>
                                    <input type="text" class="form-control" placeholder="{{ __('form.takeout.firstname') }}" name="first_name">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>{{ __('form.email') }}</label>
                                    <input type="email" class="form-control" placeholder="{{ __('form.email') }}" name="email">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>{{ __('form.phone')}}<span class="__form_required">*</span></label>
                                    <input type="number" class="form-control" placeholder="{{ __('form.phone') }}" name="phone">
                                </div>
                            </div>
                            {{--
                            <div class="col-lg-12">
                                <label>{{ __('form.takeout.pickup-time') }} <span class="__form_required">*</span></label>
                            </div>--}}
                            <div class="col-lg-6">
                                {{--
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="as_soon_as_possible" name="pickup_option" class="custom-control-input" value="as_soon_as_possible">
                                    <label class="custom-control-label" for="as_soon_as_possible">{{ __('form.takeout.as-soon-as-possible') }}</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="pickup_later" name="pickup_option" class="custom-control-input" checked="checked" value="later">
                                     <label class="custom-control-label" for="pickup_later" >{{ __('form.takeout.later') }}</label>
                                </div>--}}
                                <div class="form-group">
                                    <label>{{ __('form.takeout.pickup-time') }} <span class="__form_required">*</span></label>
                                    <div class="__branch_pickup_time">
                                        @include('frontend.inc.pickupTime')
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>{{ __('form.branch') }} <span class="__form_required">*</span></label>
                                    <select class="form-control" name="branch" id="__pickup_branch" disabled="disabled">
                                        @foreach($branches as $branch)
                                            <option value="{{$branch->slug}}" @if(session()->has('_pickup_branch_name'))@if(session()->get('_pickup_branch_name') == $branch->slug){{'selected'}}@endif @endif>{{$branch->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="hidden" name="selected_branch" value="{{session()->get('_pickup_branch_name')}}"/>
                                <input type="hidden" name="selected_pickup_time" value="{{session()->get('pickup_time')}}"/>
                                <input type="hidden" id="pickup_later" name="pickup_option" class="custom-control-input" value="later">
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>{{ __('form.message') }}</label>
                                    <textarea id="takeout_message" class="form-control" name="checkout_message"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button class="btn  btn--place--order btn--primary">{{ __('form.takeout.place-order') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="checkout-details">
                    <h5>{{ __('form.takeout-details') }}</h5>
                    @include('frontend.inc.minaCart')
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end section  -->
<div class="checkout__message checkout__message--success">
    <div class="container">
        <div class="checkout__message__wrapper">
            <div class="hide-popup">&times;</div>
            <div class="content">
                <p>{{ __('form.checkout-success-msg') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
@section('page_specific_js')
<script>
var __checkout_form = document.getElementById('__checkout_form');
$(document).ready(function(){
    //
    $('#__pickup_time').attr('disabled',true)

 const fc = FormValidation.formValidation(
    __checkout_form,
    {
        fields: {
            first_name:{
                validators:{
                    notEmpty:{
                        message: "{{ __('form.invalid-first-name') }}",
                    }
                }
            },
            last_name:{
                validators:{
                    notEmpty:{
                        message: "{{ __('form.invalid-last-name') }}",
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
                        min:9,
                        max:14,
                        message: "{{ __('form.invalid-phone-format') }}",
                    }
                }

            },
            __pickup_time:{
                validators:{
                    notEmpty:{
                        message: "{{__('form.pickup-time-not-set')}}"
                    }
                }

            },
            branch: {
                validateField: {}

            },
            checkout_message: {
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
        result = new FormData($(__checkout_form)[0]);
        $.ajax({
            url: "{{route('frontend.takeout.store')}}",
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
                    $(__checkout_form)[0].reset();
                    //show message in the div
                    $('.ajax-loader').hide();
                    swal({
                        title: data.title,
                        text: data.message,
                        icon: "success",
                        button: "OK",
                    }).then(function(){
                        window.location = "{{route('frontend.homepage')}}"
                    });
                }else if(data.status == "cartEmpty"){
                     $('.ajax-loader').hide();
                     swal({
                        title: data.title,
                        text: data.message,
                        icon: "error",
                        button: "OK",
                    }).then(function(){
                        window.location = "{{route('frontend.homepage')}}"
                    });

                }   
                else{
                    $('.ajax-loader').hide();
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
    //track the branch is changed or not
    $('body').on('change','#__pickup_branch',function(e){
        //prevent the default action
        e.preventDefault()
        var __select_pickup_branch = $(this).val();
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
            },
            error:function(jqXHR,textStatus,errorThrown){
                //show the sweet alert
            }
        })
    })
});
</script>
@endsection