@extends('frontend.layouts.master')

@section('page_name',__('menu.contact'))

@section('page_specific_css')

@endsection

@section('content')

@include('frontend.inc.breadcumb')

<section id="reservation" class="contact-reservation">

    <!-- reservation section -->

    <div class="container">

        <div class="row">

            <div class="col-sm-12">

                <div class="form-wrapper">

                    <form action="#" method="post" name="contact_mina" id="contactForm">

                        @csrf

                        <div class="row">

                            <div class="col-sm-6 col-md-6">

                                <div class="form-group">

                                    <label>{{ __('form.fullname') }} <span class="__form_required">*</span></label>

                                    <input type="text" class="form-control" name="fullname" id="fullname" />

                                </div>

                            </div>

                            <div class="col-sm-6 col-md-6">

                                <div class="form-group">

                                    <label>{{ __('form.phone') }} <span class="__form_required">*</span></label>

                                    <input type="number" class="form-control" name="phone" id="phone" />

                                </div>

                            </div>

                            <div class="col-sm-6 col-md-6">

                                <div class="form-group">

                                    <label>{{ __('form.email') }} <span class="__form_required">*</span></label>

                                    <input type="email" class="form-control" name="email" id="email" placeholder="" />

                                </div>

                            </div>

                            <div class="col-sm-6 col-md-6">

                                <div class="form-group">

                                    <label>{{ __('form.subject') }} <span class="__form_required">*</span></label>

                                    <input type="text" class="form-control" name="subject" id="subject" placeholder="" />

                                </div>

                            </div>

                            <div class="col-sm-12 col-md-12">

                                <div class="form-group">

                                    <label>{{ __('form.message') }}</label>

                                    <textarea class="form-control" name="message" rows="5"></textarea>

                                </div>

                            </div>

                        </div>

                        <div class="reservation_submit_btn">

                            <button type="submit" class="btn btn-large btn-reservation-submit-btn">{{ __('form.submit') }}</button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- reservations sections ends -->

<section id="storeInfromation">

    <div class="container">

		<h2 class="_top_heading">{{ __('lang.our-stores')}}</h2>

        <p class="_top_content">{{ __('lang.contact-tagline') }}</p>

        <div class="row">

            <div class="col-lg-4">

                <h3>{{ __('lang.branch-name.munakata') }}</h3>

                <address>

						    〒811-3423 福岡県宗像市野坂2648-1<br>

							Fukuoka-ken Munakata-Shi Nosaka 2648-1<br>

							Tel/Fax : 0940-36-8282

						</address>

                <h5>{{__('lang.opening-hours')}}</h5>

               <p>{{__('lang.seat-capacity')}}: 50 {{__('lang.seats')}}</p>

                <p>{{__('lang.weekdays')}}</p>

                <p>11:00 - 15:00 ({{__('menu.last_order')}} 14:30)</p>

                <p>17:00 - 23:00 ({{__('menu.last_order')}} 22:30)</p>

                <p>{{__('lang.weekends')}}</p>

                <p>11:00 - 23:00 ({{__('menu.last_order')}} 22:30)</p>

            </div>

            <div class="col-lg-8">

                <div class="map">

                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3315.9885100234414!2d130.56147701505714!3d33.78679488067898!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x35422c1075fcac9d%3A0x24985c5647c06379!2z5pel5pys44CB44CSODExLTM0MjMg56aP5bKh55yM5a6X5YOP5biC6YeO5Z2C77yS77yW77yU77yY4oiS77yR!5e0!3m2!1sja!2sdk!4v1594199374127!5m2!1sja!2sdk" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>

                </div>

            </div>

		</div>

		

        <div class="row">

            <div class="col-lg-4">

                <h3>{{ __('lang.branch-name.tobata') }}</h3>

                <address>

						    〒804-0022 北九州市戸畑区金比羅2-1</br>

							Kitakyushu-Shi Tobata-ku Konpira 2-1</br>

							Tel/Fax : 093-883-1323

						</address>

                <h5>{{__('lang.opening-hours')}}</h5>

                <p>{{__('lang.seat-capacity')}}: 65 {{__('lang.seats')}}</p>

                <p>{{__('lang.weekdays')}}</p>

                <p>11:00 - 15:00 ({{__('menu.last_order')}} 14:30)</p>

                <p>17:00 - 23:00 ({{__('menu.last_order')}} 22:30)</p>

                <p>{{__('lang.weekends')}}</p>

                <p>11:00 - 23:00 ({{__('menu.last_order')}} 22:30)</p>

            </div>

            <div class="col-lg-8">

                <div class="map">

                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3312.3451392258003!2d130.83993941505994!3d33.88076398065286!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3543c779f35e49f9%3A0x5d0b342c92050c63!2z5pel5pys44CB44CSODA0LTAwMjIg56aP5bKh55yM5YyX5Lmd5bee5biC5oi455WR5Yy66YeR5q-U576F55S677yS4oiS77yR!5e0!3m2!1sja!2sdk!4v1594199944768!5m2!1sja!2sdk" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>

                </div>

            </div>

		</div>

		

        <div class="row">

            <div class="col-lg-4">

                <h3><h3>{{ __('lang.branch-name.singu') }}</h3></h3>

                <address>

						    〒811-0101 福岡県糟屋郡新宮町原上1615-4</br>

							Fukuoka-ken Khasuyagun Singumachi Harugami 1615-4</br>

							Tel/Fax : 092-962-3630 

						</address>

                <h5>{{__('lang.opening-hours')}}</h5>

                <p>{{__('lang.seat-capacity')}}: 60 {{__('lang.seats')}}</p>

                <p>{{__('lang.weekdays')}}</p>

                <p>11:00 - 15:00 ({{__('menu.last_order')}} 14:30)</p>

                <p>17:00 - 23:00 ({{__('menu.last_order')}} 22:30)</p>

                <p>{{__('lang.weekends')}}</p>

                <p>11:00 - 23:00 ({{__('menu.last_order')}} 22:30)</p>

            </div>

            <div class="col-lg-8">

                <div class="map">

                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3319.6372040402684!2d130.44879311505454!3d33.69245708070531!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x354188eb25608053%3A0xe6193f8e6d32a11b!2z5pel5pys44CB44CSODExLTAxMDEg56aP5bKh55yM57Of5bGL6YOh5paw5a6u55S65aSn5a2X5Y6f5LiK77yR77yW77yR77yV4oiS77yU!5e0!3m2!1sja!2sdk!4v1594200039091!5m2!1sja!2sdk" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>

                </div>

            </div>

		</div>

		

        <div class="row">



            <div class="col-lg-4">

                <h3>{{ __('lang.branch-name.norimatsu') }}</h3>

                <address>

						    〒807-0831 北九州市八幡西区則松7-2-8</br>

						    〒Kitakyushu-Shi Yahatanishi-ku Norimatsu 7-2-8 </br>

							Tel/Fax : 093-692-8144

						</address>

                <h5>{{__('lang.opening-hours')}}</h5>
                <h6 style="color:red;">{{__('lang.norimatsu-close-time')}}</h6>

                <p>{{__('lang.seat-capacity')}}: 60 {{__('lang.seats')}}</p>

                <p>{{__('lang.weekdays')}}</p>

                <p>11:00 - 15:00 ({{__('menu.last_order')}} 14:30)</p>

                <p>17:00 - 22:00 ({{__('menu.last_order')}} 21:30)</p>

                <p>{{__('lang.weekends')}}</p>

                <p>11:00 - 15:30 ({{__('menu.last_order')}} 15:00)</p>

                <p>17:00 - 22:00 ({{__('menu.last_order')}} 21:30)</p>

            </div>



            <div class="col-lg-8">

                <div class="map">

                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3313.4826468997494!2d130.71958761505923!3d33.85145028066105!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3543cea5c58961bb%3A0x99aebad3fe5635e4!2z5pel5pys44CB44CSODA3LTA4MzEg56aP5bKh55yM5YyX5Lmd5bee5biC5YWr5bmh6KW_5Yy65YmH5p2-77yX5LiB55uu77yS4oiS77yY!5e0!3m2!1sja!2sdk!4v1594200096010!5m2!1sja!2sdk" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>

                </div>

            </div>



        </div>

         <div class="row">

            <div class="col-lg-4">

                <h3>{{ __('lang.branch-name.nakama') }}</h3>

                <address>

						    〒809-0013 福岡県中間市上蓮花寺4-1-3</br>4-1-3 Kamirengeji, Nakamashi, Fukuokaken</br>

							Tel/Fax : 093-245-3566

						</address>

                <h5>{{__('lang.opening-hours')}}</h5>
                <h6 style="color:red;">{{__('lang.nakama-close-time')}}</h6>

                <p>{{__('lang.seat-capacity')}}: 40 {{__('lang.seats')}}</p>

                <p>{{__('lang.weekdays')}}</p>

                <p>11:00 - 15:00 ({{__('menu.last_order')}} 14:30)</p>

                <p>17:00 - 22:00 ({{__('menu.last_order')}} 21:30)</p>

                <p>{{__('lang.weekends')}}</p>

                <p>11:00 - 15:30 ({{__('menu.last_order')}} 15:00)</p>

                <p>17:00 - 22:00 ({{__('menu.last_order')}} 21:30)</p>

            </div>

            <div class="col-lg-8">

                <div class="map">

                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3313.4826468997494!2d130.71958761505923!3d33.85145028066105!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3543cea5c58961bb%3A0x99aebad3fe5635e4!2z5pel5pys44CB44CSODA3LTA4MzEg56aP5bKh55yM5YyX5Lmd5bee5biC5YWr5bmh6KW_5Yy65YmH5p2-77yX5LiB55uu77yS4oiS77yY!5e0!3m2!1sja!2sdk!4v1594200357800!5m2!1sja!2sdk" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>

                </div>

            </div>

		</div>

    </div>

</section>	

@endsection

@section('page_specific_js')

<script>

    var contactForm = document.getElementById('contactForm');

    $(document).ready(function(){

        const fc = FormValidation.formValidation(

            contactForm,

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

                            notEmpty: {

                                message: "{{ __('form.invalid-email') }}"

                            },

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

                    subject: {

                        validators: {

                            notEmpty: {

                                message: "{{ __('form.invalid-subject') }}",

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

                result = new FormData($(contactForm)[0]);

                $.ajax({

                    url: "{{route('frontend.save.feedback')}}",

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

                            $(contactForm)[0].reset();

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

                            $('.ajax-loader').hide();

                            swal({

                                title: 'Server error',

                                text: 'we are currently having the server error, please try again',

                                icon: "error",

                                button: "OK"

                            })

                            console.log('There is server error adding the new menu, please try again');

                        }

                    }



                });

            });



    })

</script>

@endsection