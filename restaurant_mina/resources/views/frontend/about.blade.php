@extends('frontend.layouts.master')

@section('page_name',__('menu.about'))

@section('page_specific_css')

@endsection

@section('content')

@include('frontend.inc.breadcumb')

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

                <div class="_short_desc class="_top_heading" data-aos="fade-up" data-aos-duration="1000">

                    

                    <p>{{ __('lang.ceo-voice') }}</p>

                    

                    <div class="welcome-image">

                        <img src="{{asset('/front-assets/images/photo-md.jpg') }}" alt="">

                    </div>

                    <h3>{{ __('lang.ceo-name') }} / {{ __('lang.ceo-position') }}</h3>

                </div>

            </div>

            <div class="col-lg-7 d-sm-block">

                <div class="row">

                    <div class="col-md-6">

                        <div class="about_image _upper_image" class="_top_heading" data-aos="fade-up" data-aos-duration="1000">

                            <img src="{{asset('/front-assets/images/butter_chicken_curry.jpg') }}">

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="about_image _upper_image" class="_top_heading" data-aos="fade-up" data-aos-duration="1000">

                            <img src="{{asset('/front-assets/images/dal_curry.jpg') }}">

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="about_image" class="_top_heading" data-aos="fade-up" data-aos-duration="2000">

                            <img src="{{asset('/front-assets/images/prawn_green_asparagus_curry.jpg') }}">

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="about_image" class="_top_heading" data-aos="fade-up" data-aos-duration="2000">

                            <img src="{{asset('/front-assets/images/chicken_baigan_curry.jpg') }}">

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- end section  -->

{{--<section class="menu__slider">

    <div class="menu__slider__item">

        <img src="{{asset('/front-assets/images/slider/1.jpg') }}" alt="">

    </div>



    <div class="menu__slider__item">

        <img src="{{asset('/front-assets/images/slider/2.jpg') }}" alt="">

    </div>



    <div class="menu__slider__item">

        <img src="{{asset('/front-assets/images/slider/3.jpg') }}" alt="">

    </div>



    <div class="menu__slider__item">

        <img src="{{asset('/front-assets/images/slider/4.jpg') }}" alt="">

    </div>



    <div class="menu__slider__item">

        <img src="{{asset('/front-assets/images/slider/1.jpg') }}" alt="">

    </div>

    <div class="menu__slider__item">

        <img src="{{asset('/front-assets/images/slider/2.jpg') }}" alt="">

    </div>

</section>--}}

@endsection

@section('page_specific_js')

@endsection